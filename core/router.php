<?php

class Router{
  public static $path = null;
  
  public static function instance() {
    static $instance = null;
    
    if( $instance === null ) {
      $instance = new Url;
    }
    
    return $instance;
  }

  public static function run() {
    if( !static::$route_found ) { 
      $url = Url::instance();
      Router::pre_dispatch($url->get_uri(false));
    }
    
    ob_end_flush();
  }

  public static function get($route, $path) {
    self::$path = $path;
  }

  public static function pre_dispatch($uri) {
    $path = explode('/', $uri);
    $controller = $path[0];
    $action = (empty($path[1])) ? 'index' : $path[1];
    $format = 'html';
    if( preg_match('/\.(\w+)$/', $action, $matches) ) {
      $action = str_replace($matches[0], '', $action);
      $format = $matches[1];
    }
	
    $path[2] = '';
    self::$path = $controller . '#' . $action;
    self::dispatch($format, $path[2]);
    
  }
  
  public static function dispatch($format, $param = '') {
    // runs when find a matching route
    $path = explode('#', self::$path);
	if(empty($path[0]))
		$path[0] = 'Api_Controller';
		
    $controller = $path[0];
    $action = $path[1];
    
    $class_name = ucfirst($controller);
        
    // include the app_controller
    //self::load_controller('app');
    
    // include the matching route controller
    //self::load_controller($controller);

    try{
      $class = new $controller;
	  if(!empty($param)){
		 $class->$action($param);
	  }     

      // run the matching action
      if( is_callable(array($class, $action)) ) {
        $class->$action();
      }else
        die('The action <strong>' . $action . '</strong> could not be called from the controller <strong>' . $class_name . '</strong>');
    }catch(Exception $e){
      die('The class <strong>' . $class_name . '</strong> could not be found in <pre> controllers/' . $controller . '</pre>');
    }
  }

}