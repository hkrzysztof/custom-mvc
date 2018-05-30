<?php
/*
 * APP CORE CLASS
 * Creates URL, loads core controller
 * URL FORMAT - /controller/method/params
*/

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
//        print_r($this->getUrl());
        $url = $this->getUrl();

        //Looking in controllers for the first value of the array
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            //If true, then we set it as the currentController
            $this->currentController = ucwords($url[0]);
            //Unset the 0 index
            unset($url[0]);
        }

        //Requiring the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instatiate the controller
        $this->currentController = new $this->currentController;

        //Checking for 2nd part of the URL
        if (isset($url[1])) {
            //Check to see if method exists in the controller
            if (method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //Unset the 1 index
                unset($url[1]);
            }
        }

        //Get params (the rest of the URL)
        $this->params = $url ? array_values($url) : [];

        //Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}