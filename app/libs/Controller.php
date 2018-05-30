<?php
/*
 * BASE CONTROLLER
 * Loads the models and views
*/

class Controller{
    //Load model
    public function model($model){
        //Require the model file
        require_once '../app/models/' . $model . '.php';

        //Instatiate the model
        return new $model();
    }

    //Load view
    public function view($view, $data = []){
        //Check the view file
        if (file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            //View does not exists
            die('View does not exist');
        }
    }
}