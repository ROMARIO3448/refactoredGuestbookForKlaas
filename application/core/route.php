<?php
class Route
{
	static public function start()
	{
		$controller_name = 'Guestbook';
		$action_name = 'index';
		$params = [];

        $url_parts = parse_url($_SERVER['REQUEST_URI']);
        $path = trim($url_parts['path'], '/');
		
		$routes = explode('/', $path);

		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		if (!empty($url_parts['query'])) {
        	parse_str($url_parts['query'], $params);
        }

		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include "application/models/".$model_file;
		}

		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include "application/controllers/".$controller_file;
		}
		else
		{
			self::ErrorPage404();
		}
		
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			$controller->$action($params);
		}
		else
		{
			self::ErrorPage404();
		}
	}
	
	static public function ErrorPage404()
	{
    	$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    	http_response_code(404);
    	header('Location:' . $host . '404');
    	exit();
	}

}