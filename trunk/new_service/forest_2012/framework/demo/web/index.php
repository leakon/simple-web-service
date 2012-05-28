<?php

require_once(dirname(__FILE__) . '/../../require.php');

$config         = array();

$config['routing']      = array(
                            'base'  => '/include/fhero/framework/demo/web',
                        );

$config['dir']          = array(
                            'lib'   => dirname(__FILE__) . '/../lib/',
                            'apps'  => dirname(__FILE__) . '/../apps/',
                        );

$core   = new SPF_Core($app = 'front', $config);

$core->dispatch();
