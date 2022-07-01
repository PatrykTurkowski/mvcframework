<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register(array $data):bool
    {
        $this->db->query('INSERT INTO users (user_name, user_email, password)
                              VALUES(:username, :email, :password)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login(string $email,string $password):mixed {
        $this->db->query('SELECT * FROM users WHERE user_email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();
        @$hashedPassword = $row->password;
    
        if(password_verify($password,$hashedPassword)) {
            return $row;
        }else {
            return false;
        }
    }

    public function findUserByEmail(string $email):bool
    {
        $this->db->query("SELECT * FROM users where user_email=:email");
        $this->db->bind(':email', $email);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewUser(bool $isValid, array $data):void{
        // Hash password
        if($isValid){
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            
           //Register user from model function
           if ($this->register($data)) {
               //Redirect to the login page
               header('location:' . URLROOT . 'users/login');
           } else {
               die('Something went wrong.');
           }
        }
       
   }
}
