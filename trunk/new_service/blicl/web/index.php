<?php

require_once('web.inc.php');

$controller	= BLUrl::getController($req);

#var_dump($controller);

// include all templates
BLTemplate::showTemplate('tpl');


