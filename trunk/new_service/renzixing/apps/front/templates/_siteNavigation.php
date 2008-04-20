<?php
// Retrieving controller information
$moduleName  = $sf_context->getModuleName();
$actionName  = $sf_context->getActionName();

$arrNav	= array(
		'issue'		=> array('list', 'create', 'involved'),
		'customer'	=> array('list', 'create'),
		'product'	=> array('list', 'create'),
		'maintance'	=> array('list', 'create'),
		'user'		=> array('list', 'manage'),
	);

$arrStr	= array(
		'issue'	=> array(
				'module'	=> '流程管理',
				'actions'	=> array(
							'create'	=> '创建',
							'list'		=> '列表',
							'involved'	=> '我的流程',
						),
			),
		'customer'	=> array(
				'module'	=> '客户管理',
				'actions'	=> array(
							'create'	=> '创建',
							'list'		=> '列表',
						),
			),
		'product'	=> array(
				'module'	=> '产品管理',
				'actions'	=> array(
							'create'	=> '创建',
							'list'		=> '列表',
						),
			),
		'maintance'	=> array(
				'module'	=> '维护信息',
				'actions'	=> array(
							'create'	=> '创建',
							'list'		=> '列表',
						),
			),
		'user'	=> array(
				'module'	=> '帐户管理',
				'actions'	=> array(
							'manage'	=> '管理',
							'list'		=> '列表',
						),
			),
	);



?>
<ul id="adminmenu">
<?php foreach ($arrNav as $module => $actions) : ?>
<li>
<a href="<?php echo url_for($module) ?>" <?php if ($module == $moduleName) : ?> class="current"<?php endif ?>><?php echo $arrStr[$module]['module'] ?></a>
</li>

<?php endforeach ?>
</ul>

<ul id="submenu">
<?php foreach ($arrNav[$moduleName] as $action) : ?>
<li>
<a href="<?php echo url_for("$moduleName/$action") ?>" <?php if ($action == $actionName) : ?> class="current"<?php endif ?>><?php echo $arrStr[$moduleName]['actions'][$action] ?></a>
</li>
<?php endforeach ?>
</ul>