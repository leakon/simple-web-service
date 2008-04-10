<?php

class KFConfig {



	public static function getAllRoles() {

		$arrRoles	= array(

			'support'	=> 'support',		// 客服中心
			'product'	=> 'product',		// 产品管理
			'developer'	=> 'developer',		// 研发
			'employee'	=> 'employee',		// 雇员（其他）

		);

		return	$arrRoles;

	}


}