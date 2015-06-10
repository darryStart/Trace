<?php
return array(
		// '配置项'=>'配置值'
		
		/****************数据库配置****************/
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => 'localhost', // 服务器地址
		'DB_NAME' => 'getwhere', // 数据库名
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => 'root', // 密码
		'DB_PORT' => 3306, // 端口
		'DB_PREFIX' => 't_', // 数据库表前缀
		
		/******************邮箱配置******************/
		'SMTP_SERVER' =>'smtp.qq.com',	//邮件服务器
		'SMTP_PORT' =>25,	//邮件服务器端口
		'SMTP_USER_EMAIL' =>'2350840395@qq.com', //SMTP服务器的用户邮箱(一般发件人也得用这个邮箱)
		'SMTP_USER'=>'2350840395@qq.com',	//SMTP服务器账户名
		'SMTP_PWD'=>'910623zqp!@#dq',	//SMTP服务器账户密码
		'SMTP_MAIL_TYPE'=>'HTML',	//发送邮件类型:HTML,TXT(注意都是大写)
		'SMTP_TIME_OUT'=>30,	//超时时间
		'SMTP_AUTH'=>true,	//邮箱验证(一般都要开启)
);
?>