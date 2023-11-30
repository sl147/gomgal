<?php

	spl_autoload_register(function ($class_name)
	{
		$array_path = array(
		'models/' , 
		'components/' ,
		'classes/' 
			);	

		foreach ($array_path as $path) {
			$path = $path.$class_name.".php";		
			if (is_file($path)) include_once $path;
		}
	});
?>