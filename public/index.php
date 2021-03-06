<?php
try {
		//读取配置文件
		$config=new Phalcon\Config\Adapter\Ini(__DIR__.'/../app/config/config.ini');

		$loader = new \Phalcon\Loader();
		$loader->registerDirs(
			array(
				__DIR__.$config->application->controllersDir,
				__DIR__.$config->application->pluginsDir,
				__DIR__.$config->application->libraryDir,
				__DIR__.$config->application->modelsDir,
			)
		)->register();

		$di = new Phalcon\DI\FactoryDefault();  //创建 DI

	/*
	  
		//Start the session the first time when some component request the session service
		$di->set('session', function(){
			$session = new Phalcon\Session\Adapter\Files();
			$session->start();
			return $session;
		});
*/
		// Database connection is created based in the parameters defined in the configuration file
		$di->set('db', function() use ($config) {
			return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
				'host' => $config->database->host,
				'username' => $config->database->username,
				'password' => $config->database->password,
				'dbname' => $config->database->name,
				'charset' => 'utf8' //数据库编码
			));
		});

		 //设置视图目录
		$di->set('view', function(){
			 $view = new \Phalcon\Mvc\View();
			 $view->setViewsDir('../app/views/');
			 return $view;
		});

		$application = new \Phalcon\Mvc\Application();
		$application->setDI($di);
		echo $application->handle()->getContent();
} catch(\Phalcon\Exception $e) {echo 'Error: ', $e->getMessage();}

