<?php

class ValidationLogin
{

    private $email;
    private $password;
    private bool $isError;



    public function __construct(string $email, string $password)
    {
        $this->email = $email;

        $this->password = $password;

        $this->isError = false;
    }

    public function errorValidEmail(): string
    {
        if (empty($this->email)) {
            $this->isError = true;
            return 'Please enter a email.';
        }else
        return '';
    }



    public function errorValidPassword(): string
    {
        if (empty($this->password)) {
            $this->isError = true;
            return 'Please enter a password.';
        }else
        return '';
    }

    public function isValid():bool
    {
        if ($this->isError) {
            return true;
        } else {
            return false;
        }
    }
}
