<?php 
    
    class ValidationRegister {

        private $username;
        private $email;
        private $password;
        private $confirmPassword;
        public  $model;
        private bool $isError;



        public function __construct(string $username,string $email, string $password,string $confirmPassword, object $model)
        {
            $this->username= $username;
            $this->email= $email;
            $this->password= $password;
            $this->confirmPassword= $confirmPassword;
            $this->model=$model;
            $this->isError=false;
        }
        
        public function errorValidUsername() :string {
            $nameValidation = "/^[a-zA-Z0-9]*$/";
            if (empty($this->username)) {
                $this->isError=true;
                return 'Please enter username.';
            } elseif (!preg_match($nameValidation, $this->username)) {
                $this->isError=true;
                return 'Name can only contain letters and numbers.';
            }else
                return '';
        }

        public function errorValidEmail() :string {
            if (empty($this->email)) {
                $this->isError=true;
                return 'Please enter email address.';
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->isError=true;
                return 'Please enter the correct format.';
            } elseif($this->model->findUserByEmail($this->email)) {
                $this->isError=true;
                //Check if email exists.
                return 'Email is already taken.';
            }else
                return '';
        }

        public function errorValidPassword() :string {
            $passwordValidation = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/i";
            if (empty($this->password)) {
                $this->isError=true;
                return 'Please enter password.';
            } elseif (strlen($this->password) < 7) {
                $this->isError=true;
                return 'Password must be at least 8 characters';
            } elseif (!preg_match($passwordValidation, $this->password)) {
                $this->isError=true;
                return 'Password Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.';
            }else
                return '';
        }

        public function errorValidConfirmPassword() :string {
            if (empty($this->confirmPassword)) {
                $this->isError=true;
                return'Please enter password.';
            } elseif ($this->password != $this->confirmPassword) {
                $this->isError=true;
                return'Passwords do not match, please try again.';
            }else
                return '';
                
            
        }

        public function isValid() :bool{
            if($this->isError){
                return false;
            }else{
                return true;
            }
        }
    }