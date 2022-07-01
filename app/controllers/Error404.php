<?php

    class Error404 extends Controller{
        public function __construct()
        {
           
        }

        public function index() :void {
           
            $data = [
                'title' => 'error page - 404',
               
            ];
            $this->view('error/404', $data);
        }
    }