<?php
// Retrieving controller information
$moduleName  = $sf_context->getModuleName();
$actionName  = $sf_context->getActionName();

$arrNav	= array(
		'issue'	=> array('list', 'create'),
		'user'	=> array('list', 'manage')
	);

$arrStr	= array(
		'issue'	=> array(
				'module'	=> 'Issue',
				'actions'	=> array(
							'create'	=> 'Create',
							'list'		=> 'List',
						),
			),
		'user'	=> array(
				'module'	=> 'User',
				'actions'	=> array(
							'manage'	=> 'Manage',
							'list'		=> 'List',
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