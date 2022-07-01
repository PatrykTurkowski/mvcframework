<?php
require_once '../app/models/ValidationRegister.php';
require_once '../app/models/ValidationLogin.php';
class Users extends Controller
{
    private object $validationRegisterModel;
    private object $validationLoginModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');

    }

    public function register() :void
    {
        $data = [
            'title' => 'register page',
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',

        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',

            ];
            $this->validationRegisterModel = new ValidationRegister($data['username'], $data['email'],
                $data['password'], $data['confirmPassword'],
                $this->userModel);
            //Validate username on letters/numbers
            $data['usernameError'] = $this->validationRegisterModel->errorValidUsername();
            //Validate username on letters/numbers
            $data['emailError'] = $this->validationRegisterModel->errorValidEmail();

            //Validate password on length and numeric values
            $data['passwordError'] = $this->validationRegisterModel->errorValidPassword();

            //Validate confirm password
            $data['confirmPasswordError'] = $this->validationRegisterModel->errorValidConfirmPassword();

            //if is all alright adding new user
            $this->userModel->addNewUser($this->validationRegisterModel->isValid(), $data);

        }
        $this->view('/users/register', $data);
    }
    public function login() :void
    {
        $data = [
            'title' => 'Login page',
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => '',
            ];

            $this->validationLoginModel = new ValidationLogin($data['email'], $data['password']);
            $data['emailError'] = $this->validationLoginModel->errorValidEmail();

            $data['passwordError'] = $this->validationLoginModel->errorValidPassword();

           
            if (!$this->validationLoginModel->isValid()) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    // $data['passwordError'] = 'Password or email is incorrect. Please try again.';
                    $data['passwordError'] = $data['email'] . $data['password'];

                    
                }
            }

        } 
        $this->view('users/login', $data);
    }
    public function createUserSession($user) :void
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['username'] = $user->user_name;
        $_SESSION['email'] = $user->user_email;
        header('location:' . URLROOT . 'pages/index');
    }

    public function logout() :void
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . 'users/login');
    }

}
