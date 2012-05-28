<?php

/**
 * 适用于小型站点的简易 PHP 框架
 * SPF = Simple PHP Framework
 *
 */

/**
 * 核心类
 *
 */
class SPF_Core {
    
    protected 
                $appName    = '',
                $config     = array(),
                $context    = array();
    
    
    public function __construct($app, $conf) {
        
        // debug
        header('Content-Type: text/plain; charset=UTF-8');
        
        $this->appName  = $app;
        
        $this->config   = $conf;
        
    }
    
    public function dispatch() {
        
        try {
            
            SPF_Autoload::register($this->config['dir']['lib']);
        
            $requestUri     = $_SERVER['REQUEST_URI'];
            
#            echo    'dispatch ' . $requestUri . "\n";
            
            $context        = SPF_Context::getInstance();
            
            $context->set('dir', $this->config['dir']);
            
            $context->set('response', new SPF_Response());
            
            // find a route and forward request to module
            $this->context['routnig']   = new SPF_Routing($this->config['routing']['base'], $requestUri);
            $context->set('routing', new SPF_Routing($this->config['routing']['base'], $requestUri));
            
            // 
            $parameters                 = $this->context['routnig']->getInfo();
            #$this->context['request']   = new SPF_Request($parameters['parameters'], $_REQUEST);
            $context->set('request', new SPF_Request($parameters['parameters'], $_REQUEST));
            
            #print_r($parameters);
            
            #print_r($_SERVER);
            
            
            $module     = $parameters['module'];
            $action     = $parameters['action'];
            
            $actionFile = sprintf('%s%s/modules/%s/actions/actions.php', 
                                                $this->config['dir']['apps'], $this->appName, $module
                                 );
            
            if (!file_exists($actionFile)) {
                throw new Exception(sprintf('Action class %s is not exist.', $actionFile));
            }
            
            require_once($actionFile);
            
            $className      = sprintf('%sActions', $module);
            
            if (!class_exists($className)) {
                throw new Exception(sprintf('Action class %s is not defined.', $className));
            }
            
            $this->context['action']    = new $className();
            $context->set('action', new $className());
            
#            print_r($this->context);
            
            
            
            #$result     = $this->context['action']->execute($action, $this->context['request']);
            $result         = $context->getAction()->execute($action, $context->getRequest());
            
            if (SPF_View::NONE == $result) {
                
                $output     = '';
                
            } else {
                
                $templateName   = $action;
                
                // 支持 action return 一个模板的名字
                $bool_1     = is_string($result);
                $bool_2     = SPF_View::ERROR != $result || SPF_View::SUCESS != $result;
                
                if ($bool_1 && $bool_2) {
                    $templateName   = $result;
                    $result         = SPF_View::SUCESS;
                } else {
                    $result         = SPF_View::SUCESS;
                }
                
                
    #            var_dump($export);
                
                $templateFile   = sprintf('%s%s/modules/%s/templates/%s%s.php', 
                                                $this->config['dir']['apps'], $this->appName, $module,
                                                $templateName, $result
                                          );
                
                
    #            var_dump($templateFile);
                
                $appDir     = sprintf('%s%s/', $this->config['dir']['apps'], $this->appName);
                                     
                #$export     = $this->context['action']->export();
                $export     = $context->getAction()->export();
                
                
                #$this->context['view']      = new SPF_View($appDir, $export, $this->context);
                $context->set('view', new SPF_View($appDir, $export));
                
                #$content    = $this->context['view']->renderTemplate($templateFile);
                $content    = $context->getView()->renderTemplate($templateFile);
                
                
                // set content into layout
                
                #$output     = $this->context['view']->renderLayout($content);
                $output     = $context->getView()->renderLayout($content);
                
            }
            
            $context->getResponse()->setOutput($output)->sendHtml();
            
        } catch (Exception $exp) {
            
            print_r($exp);
            
        }
            
            
        
        
    }
    
}

class SPF_Autoload {
    
    protected static $classes   = array();
    
    public static function getFiles($dir) {

		$arrFiles	= array();

		$strBaseDir	= realpath($dir);

		if (false !== $strBaseDir && $handle = opendir($strBaseDir)) {

			while (false !== ($file = readdir($handle))) {

				if ('.' == $file || '..' == $file) {
					continue;
				}

				$fileName	= $strBaseDir . '/' . $file;

				if (is_dir($fileName)) {

					$arr			= call_user_func(array('self', 'getFiles'), $fileName);
					if (count($arr)) {
						$arrFiles	= array_merge($arrFiles, $arr);
					}

				} else {

					// 扩展名
					$arrInfo	= pathinfo($fileName);
					$extName	= $arrInfo['extension'];

					$fileName	= str_replace("\\", '/', $fileName);

					$arrFiles[]	= $fileName;

				}
			}

			closedir($handle);

		}

		return	$arrFiles;

        
    }
    
    public static function parseClasses($arrFiles) {
        
        $classes        = array();
        
        $regex          = '~^\s*(?:abstract\s+|final\s+)?(?:class|interface)\s+(\w+)~mi';
        
        foreach ($arrFiles as $file) {
            
            preg_match_all($regex, file_get_contents($file), $classes);
            
            foreach ($classes[1] as $class) {
                
                $classes[$class] = $file;
                
            }
            
        }
        
        return  $classes;
        
    }
    
    
    public static function register($libDir) {
        
        $arrFiles       = self::getFiles($libDir);
        
        $arrClasses     = self::parseClasses($arrFiles);
        
        self::$classes  = $arrClasses;
        
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        
        if (false === spl_autoload_register(array('self', 'autoload')))  {
            throw new Exception(sprintf('Unable to register autoload as an autoloading method.'));
        }
        
    }
    
    /**
     * Tries to load a class that has been specified in autoload.yml.
     *
     * @param string $class A class name.
     *
     * @return boolean Returns true if the class has been loaded
     */
    public static function autoload($class)  {
        
        // class already exists
        if (class_exists($class, false) || interface_exists($class, false))
        {
          return true;
        }
        
        // we have a class path, let's include it
        if (isset(self::$classes[$class]))
        {
          require(self::$classes[$class]);
        
          return true;
        }
        
        return false;
    }
    
}

class SPF_Context {
    
    protected static $instance  = NULL;
    
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new SPF_Context();
        }
        return  self::$instance;
    }
    
    protected $holder       = array();
    
    public function __construct() {
    }
    
    public function getRouting() {
        return  $this->holder['routing'];
    }
    
    public function getAction() {
        return  $this->holder['action'];
    }
    
    public function getRequest() {
        return  $this->holder['request'];
    }
    
    public function getView() {
        return  $this->holder['view'];
    }
    
    public function getResponse() {
        return  $this->holder['response'];
    }
    
    public function getDir() {
        return  $this->holder['dir'];
    }
    
    public function set($key, $obj) {
        $this->holder[$key]     = $obj;
    }
    
}

class SPF_Response {
    
    protected $output   = '';
    protected $headers  = array(
                            'Content-Type'  => 'text/html; charset=UTF-8',
                        );
    
    public function __construct() {
    }
    
    public function setOutput($output = '') {
        $this->output   = $output;
        return  $this;
    }
    
    public function sendJson() {
        $this->setHeader('Content-Type', 'text/plain; charset=UTF-8');
        $this->output   = json_encode($this->output);
        $this->sendOutput();
        $this->output   = '';
    }
    
    public function sendHtml() {
        $this->setHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->sendOutput();
    }
    
    public function sendRedirect($url) {
        $this->setHeader('Location', $url);
        $this->output   = '';
        $this->sendOutput(true);
    }
    
    protected function setHeader($key, $value) {
        $this->headers[$key]    = $value;
    }
    
    protected function sendOutput($sendHeader = false) {
        if (strlen($this->output) || $sendHeader) {
            foreach ($this->headers as $key => $value) {
                header($key . ': ' . $value);
            }
            echo    $this->output;
        }
    }
    
}

class SPF_Controller {
    
    
    protected static $defaults  = array(
                                    'layout'    => 'layout.php',
                                );
    
    
    public static function getConfig($appDir, $name) {
      
        // read config
        
        $configFile = sprintf('%sconfig/%s.php', $appDir, $name);
        
        
        if (!file_exists($configFile)) {
            return  self::$defaults;
        }
        
        $overwrite  = include($configFile);
        
        if (!is_array($overwrite)) {
            return  self::$defaults;
        }
        
        $config     = self::$defaults;
            
        foreach ($config as $key => $value) {
            
            if (isset($overwrite[$key])) {
                $config[$key]   = $overwrite[$key];
            }
            
        }
        
        return  $config;
    
    }
    
}



class SPF_View {
    
    const
            NONE        = 'None',
            SUCESS      = 'Success',
            ERROR       = 'Error';
    
    protected 
                $appDir     = '',
                $export     = array();
    
    public function __construct($appDir, $export) {
        
        $this->appDir   = $appDir;
        $this->export   = $export;
        
    }
    
    public function renderTemplate($template) {
        
        if (!file_exists($template)) {
            throw new Exception(sprintf('Template %s is not exist.', $template));
        }
        
        #$context    = $this->context;
        $context    = SPF_Context::getInstance();
        
        ob_start();
        
        extract($this->export);
        
        include($template);
        
        $content    = ob_get_contents();
    
        ob_end_clean();
        
        return  $content;
        
    }
    
    public function renderLayout($content) {
        
        $appConfig  = SPF_Controller::getConfig($this->appDir, 'view');
        
        $layout     = $appConfig['layout'];
        
        $file       = sprintf('%stemplates/%s', $this->appDir, $layout);
        
        if (!file_exists($file)) {
            throw new Exception(sprintf('Layout %s is not exist.', $file));
        }
        
        $context    = SPF_Context::getInstance();
        
        ob_start();
        
        extract($this->export);
        
        include($file);
        
        $output     = ob_get_contents();
    
        ob_end_clean();
        
        return  $output;
        
    }
    
    public function renderPartial($template, $variables) {
        
        $explode    = explode('/', $template);
        
        if (count($explode) != 2) {
            throw new Exception(sprintf('RenderPartial with invalid template. [%s]', $template));
        }
        
        if (isset($explode[0]) && $explode[0] == 'global') {
            // 全局模板
            
            $file       = sprintf('%stemplates/_%s.php', $this->appDir, $explode[1]);
            
        } else {
            // 本 module 模板
            
            $file       = sprintf('%smodules/%s/templates/_%s.php', $this->appDir, $explode[0], $explode[1]);
            
        }
        
        if (!file_exists($file)) {
            throw new Exception(sprintf('Partial template %s is not exist.', $file));
        }
        
        $context    = SPF_Context::getInstance();
        
        ob_start();
        
        extract($variables);
        
        include($file);
        
        $output     = ob_get_contents();
    
        ob_end_clean();
        
        return  $output;
        
        
    }
    
}

class SPF_Model {
    
    
}

class SPF_ParameterHolder {
    
    protected $parameters = array();
    
    public function & getAll() {
        return $this->parameters;
    }
    
    public function set($name, $value) {
        $this->parameters[$name] = $value;
    }
    
    public function setByRef($name, & $value) {
        $this->parameters[$name] =& $value;
    }
    
    public function & get($name, $default = null) {
        if (array_key_exists($name, $this->parameters)) {
            $value = & $this->parameters[$name];
        } else {
            $value = $default;
        }
        return $value;
    }
    
    public function has($name) {
        if (array_key_exists($name, $this->parameters)) {
            return true;
        }
        return false;
    }
    
    public function remove($name, $default = null) {
        $retval = $default;
        if (array_key_exists($name, $this->parameters)) {
            $retval = $this->parameters[$name];
            unset($this->parameters[$name]);
        }
        return $retval;
    }
    
}


class SPF_Actions {
    
	protected $variables    = array();
    
    
    public function __construct() {
        $this->variables    = new SPF_ParameterHolder();
    }
    
    public function execute($action, $request) {
        
        $methodName      = sprintf('execute%s', ucfirst($action));
            
        if (!method_exists($this, $methodName)) {
            throw new Exception(sprintf('Method %s is not defined.', $methodName));
        }
        
        $this->preExecute();
        
        $result     = $this->$methodName($request);
        
        $this->postExecute();
        
        return  $result;
        
    }
    
	public function export() {
	    return  $this->variables->getAll();
	}
	
	public function & __get($key) {
	    return  $this->variables->get($key);
	}
	
	public function __set($key, $value) {
        return $this->variables->setByRef($key, $value);
	}
	
	public function getContext() {
        return  SPF_Context::getInstance();
	}
	
	public function __isset($key) {
        return $this->variables->has($key);
	}
	
	public function __unset($key) {
        $this->variables->remove($key);
	}
	
	public function preExecute() {
	    
	}
	
	public function postExecute() {
	    
	}
	
	public function redirect($uri, $parameter) {
	    
	    $routing    = self::getContext()->getRouting();
	    
	    $url        = $routing->generate($uri, $parameter);
	    
	    $this->getContext()->getResponse()->sendRedirect($url);
	    
	    exit;
	    
	}
    
}

class SPF_Request {
    
    protected $parameterHolder  = array();
    
    public function __construct($parameters, $PHP_REQUEST) {
        $this->parameterHolder  = array_merge($PHP_REQUEST, $parameters);
    }
    
    public function getParameter($key, $default = '') {
        return  isset($this->parameterHolder[$key]) ? $this->parameterHolder[$key] : $default;
    }
    
    public function getParameterHolder() {
        return  $this->parameterHolder;
    }
    
    public function isPost() {
        return  'POST' == $_SERVER['REQUEST_METHOD'];
    }
    
    
}

class SPF_Routing {
    
    protected 
    
            $request        = array(
                                'module'        => 'home',
                                'action'        => 'index',
                                'query'         => '',
                                'parameters'    => array(),
                            ),
                            
            $baseUri        = '';
    
    public function __construct($base, $requestUri) {
        
        
        // includes path/query
        $parsed         = parse_url($requestUri);
        $requestPath    = isset($parsed['path']) ? $parsed['path'] : '';
        $requestQuery   = isset($parsed['query']) ? $parsed['query'] : '';
        
        $this->baseUri  = rtrim($base, '/') . '/';
        #$requestPath    = rtrim($requestPath, '/') . '/';
        
        #print_r($parsed);
        
        $this->request['query']     = $requestQuery;
        
        #print_r($this->request);
        
        $routingBasePos = strpos($requestPath . '/', $this->baseUri);
        
        #var_dump($requestPath, $this->baseUri, $routingBasePos);
        
        if (false !== $routingBasePos) {
            // found base uri
            
            $length     = strlen($this->baseUri);
            
            $path       = substr($requestPath, $routingBasePos + $length);
            
        } else {
            
            $this->baseUri  = '/';
            
            $path           = $requestPath;
            
        }
        
        $keyValues  = '';
        
        if (strlen($path)) {
            
            // parse module and action
            $explode    = explode('/', $path);
            
            #print_r($explode);
            
            $count      = count($explode);
            
            if ($count > 1) {
                
                $this->request['module']    = strlen($explode[0]) ? $explode[0] : $this->request['module'];
                $this->request['action']    = strlen($explode[1]) ? $explode[1] : $this->request['action'];
                
                unset($explode[0]);
                unset($explode[1]);
                
                $keyValues  = implode('/', $explode);
                
            } else {
                // count == 1, need default action
                
                $this->request['module']    = $explode[0];
                
            }
        
        } // EndOf strlen($path)
        
        parse_str($this->request['query'], $queryParams);
        
#        print_r(self::parseKeyValues($keyValues));
        
        $this->request['parameters']    = array_merge(self::parseKeyValues($keyValues), $queryParams);
        
#        print_r($this->request);
        
        return  $this;
        
    }
    
    public function getInfo() {
        return  $this->request;
    }
    
    public function genStatic($uri) {
        
        $base       = rtrim($this->baseUri, '/');
        
        $pinfo      = pathinfo($base);
        
        $path       = $pinfo['dirname'] . '/' . $uri;
        
        return  $path;
        
    }
    
    public function generate($uri, $parameters = array()) {
        
        $pathParam  = array();
        
        foreach ($parameters as $key => $val) {
            $pathParam[]    = urlencode($key) . '/' . urlencode($val);
        }
        
        $followParam    = count($pathParam) ? ('/' . implode('/', $pathParam)) : '';
        
        $urls   = array(
                    $this->baseUri,
                    $uri,
                    $followParam,
                );
        
        $url    = implode($urls);
        
        return  $url;
        
    }
    
    
    public function getModule() {
        return  $this->request['module'];
    }
    
    public function getAction() {
        return  $this->request['action'];
    }
    
    
    /**
     * parse "key-1/value-1/key-2/value-2" into parameters, like parse query string.
     *
     */
    protected static function parseKeyValues($strKeyValues) {
        
        $strKeyValues   = trim($strKeyValues, '/');
        
#        var_dump($strKeyValues);
        
        if (strlen($strKeyValues)) {
            $explode    = explode('/', $strKeyValues);
        } else {
            $explode    = array();
        }
        
        $length     = count($explode);
        
        $parameters = array();
        
        for ($idx = 0; $idx < $length; $idx += 2) {
            
            if (isset($explode[$idx])) {
                
                $key    = urldecode($explode[$idx]);
                $value  = isset($explode[$idx + 1]) ? urldecode($explode[$idx + 1]) : NULL;
                
                $parameters[$key]   = $value;
                
            }
            
        }
        
        return  $parameters;
        
    }
            
    
}

// 以下是 formHelper

function HSC($var) {
    return  htmlspecialchars($var);
}

function genOptions($options, $selectValue) {
    
    $arrHtml    = array();
    
    foreach ($options as $key => $val) {
        
        $selected   = $selectValue == $key ? 'selected="selected"' : '';
        
        $arrHtml[]  = sprintf('<option value="%s" %s>%s</option>', $key, $selected, HSC($val));
        
    }
    
    return  implode("\n", $arrHtml);
    
}

