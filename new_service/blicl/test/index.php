<?php

require_once('web.inc.php');

$controller	= BLUrl::getController();

var_dump($controller);


var_dump($_GET);

// include all templates
BLTemplate::showTemplate('tpl');


