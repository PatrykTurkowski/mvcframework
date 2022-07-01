<?php

    class Pages extends Controller{
        public function __construct()
        {
          
        }

        public function index() :void {
           
            $data = [
                'title' => 'Home page',
               
            ];
            $this->view('/pages/index', $data);
        }
    }