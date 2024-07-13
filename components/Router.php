<?php

class Router {
	private $routes;

	public function __construct() {
		$this->routes = include( 'config/routes.php' );
	}

	private function getURI() { 
		if (!empty($_SERVER["REQUEST_URI"])) {
			return trim($_SERVER["REQUEST_URI"],'/');
		}
	}

	public function run() {
		$uri = $this->getURI();
		foreach ($this->routes as $uriPattern => $path) {
			if (preg_match("`$uriPattern`", $uri)) {
				$internalRoute  = preg_replace("`$uriPattern`", $path, $uri);
				$segments       = explode("/", $internalRoute);
				$controllerName = array_shift($segments)."Controller";
				$controllerName = ucfirst($controllerName);
				$actionName     = "action".ucfirst(array_shift($segments));
				$parametrs      = $segments;
				$ControllerFile = "controllers/".$controllerName.".php";
				if (file_exists($ControllerFile)) {
					include_once ($ControllerFile);
					$controllerObject = new $controllerName;
					if (method_exists($controllerObject,$actionName)) {
						$result = call_user_func_array(array($controllerObject,$actionName), $parametrs);
						if ($result != NULL) break;
					}
					else {
						$ControllerFile   = 'controllers/SiteController.php';
						$controllerObject = new $controllerName;
						$actionName       = 'actionIndex';
						$result           = call_user_func_array(array($controllerObject,$actionName), $parametrs);
						if ($result != NULL) break;	
					}
				}
			}
		}
	}
}