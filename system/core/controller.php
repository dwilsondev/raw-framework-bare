<?php

    /**
     *
     * controller is the main controller class. It provides methods for accessing
     * views and models.
     *
     */
    class Controller
    {

        /**
         * View function
         *
         * Load php and html files from the app/views folder.
         *
         * @param string $view_name The path to the html or php file.
         *
         * @param array $data Data array the page has access to.
         *
         * @return void
         */
        public function view($view_name, $data = [])
        {
            $view_name = filter_var($view_name, FILTER_SANITIZE_STRING);
            
            if (file_exists(VIEW_PATH.strtolower($view_name).".php")) {
                include VIEW_PATH.strtolower($view_name).".php";
            } elseif (file_exists(VIEW_PATH.strtolower($view_name).".html")) {
                include VIEW_PATH.strtolower($view_name).".html";
            } else {
                echo 'The view "'.$view_name.'" could not be found in '.'/app/views/';
            }
        }
    
        /**
         * Model function
         *
         * Loads models and instantiates model class.
         *
         * @param string $model_name The path to the file located in app/models.
         *
         * @return void
         */
        public function model($model_name)
        {
            include MODEL_PATH.strtolower($model_name).".php";

            return new $model_name();
        }
    }
