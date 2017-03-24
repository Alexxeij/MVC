<?php

/**
 * Created by PhpStorm.
 * Date: 23.03.2017
 * Time: 16:56
 */
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath =ROOT.'/config/routes.php';
        $this->routes=include($routesPath);
    }


    /**
     * Returns request string
     */
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }
    public function run()
    {
        //print_r($this->routes);
        //echo "Class Router, method run";
        $uri=$this->getURI();
        //echo $uri;

        foreach ($this->routes as $uriPattern=>$path){
            //echo "$uriPattern->$path".PHP_EOL;
            //Сравниваю $uriPattern и $uri
            if(preg_match("~$uriPattern~",$uri)){

                $internalRoute = preg_replace("~$uriPattern~",$path,$uri);

                $seqments=explode('/',$internalRoute);

                //print_r($seqments);
                $controllerName =array_shift($seqments).'Controller';
                $controllerName = ucfirst($controllerName);
                //echo "<pre>";
                //echo $controllerName;

                $actionName='action'.ucfirst(array_shift($seqments));
                //echo $actionName;
                $parameters =$seqments;
                //echo "<pre>";
                //print_r($parameters);

                $controllerFile=ROOT.'/controllers/'.$controllerName.'.php';
                //echo $controllerFile;

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                $controllerObject = new $controllerName;

                $result=call_user_func_array(array($controllerObject,$actionName),$parameters);
                //$result = $controllerObject->$actionName($parameters);
                if($result!=null){
                    break;
                }


            }
        }
    }
}
