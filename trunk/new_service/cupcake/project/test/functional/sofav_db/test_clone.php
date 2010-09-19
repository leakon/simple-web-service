<?php

require_once(dirname(__FILE__) . '/require.inc.php');


class SimpleModel {

	protected	$id, $name, $mail;

	protected	$property;

	public function __construct() {

		$this->property	= array(
			'first_name'	=> 'Leakon',
			'last_name'	=> 'Liu',
			'gender'	=> 'mail',
			'mobile'	=> '13800138000',
			'country'	=> 'PRC',
			'address'	=> 'Beijing',
			'zipcode'	=> '100000',
			'company'	=> 'Baidu',
			'notebook'	=> 'ThinkPad',
		);

	}

	public function setId($v) {
		$this->id	= $v;
	}
	public function setName($v) {
		$this->name	= $v;
	}
	public function setMail($v) {
		$this->mail	= $v;
	}

	public function getId() {
		return	$this->mail;
	}
	public function getName() {
		return	$this->mail;
	}
	public function getMail() {
		return	$this->mail;
	}
}

$count		= 1000;

$arrList	= array();
$arrClone	= array();

$timer_create	= new sfTimer();
for ($i = 0; $i < $count; $i++) {
	$arrList[]	= new SimpleModel();
}

$time_create	= $timer_create->getElapsedTime();


$timer_clone	= new sfTimer();
$sample		= new SimpleModel();

for ($i = 0; $i < $count; $i++) {
	$arrClone[]	= clone $sample;
}
$time_clone	= $timer_clone->getElapsedTime();

echo	"Create: $time_create \n";
echo	"Clones: $time_clone \n";

