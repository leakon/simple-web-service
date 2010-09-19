<?php

/**
 *
 * @version	2009-11-05
 */

class ProjConstant {

	const

		WORD_SEPARATOR		= ',',		// for tag, category join into a string
		DENIED_TAG_CHAR		= ' ',		// 禁止使用的 tag 字符

		SECRET_KEY		= '374705bc8057061ff384d6e9b0f7d3e3',

		TOOLBAR_WINDOW_VAR	= 'SoFav.Wnd',
		TOOLBAR_RENDER_VAR	= 'SoFav.Vars.strLoaderContent',

		//			   P3P: CP="NOI DEVa TAIa OUR BUS UNI"		(Diigo.com)
		P3P_HEADER		= 'P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"',

		// Model_Map_Base::MYSQL_IN_LENGTH，也包含类似的定义，更新时注意同步
		MYSQL_IN_LENGTH		= 100,		// 用于 MySQL 的 WHERE IN (x, x, x) 最大长度限制，即最多接受 100 个 id


		SIMPLE_REQUEST_TIMEOUT	= 10,		// SimpleRequest 超时时间，单位：秒

		COMMON_DATETIME_FORMAT	= 'Y-m-d H:i:s',		// MYSQL 数据库 datetime 字段 date() 函数格式
		MYSQL_DATETIME_FORMAT	= 'Y-m-d H:i:s',		// MYSQL 数据库 datetime 字段 date() 函数格式

		VERSION			= '2009-05-03';


}

