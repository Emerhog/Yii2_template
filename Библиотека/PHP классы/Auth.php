<?php

require_once('Classes.php');

abstract class AccountData{

    protected string $login;
    protected string $password;

    protected function __construct($login, $password){
        
        $this->login = $login;
        $this->password = $password;

        $this->select = new getMySql;
        $this->update = new setMySql;
    }
}

class Registration extends AccountData{

    private $email;

    public function __construct($login, $password, $email = null){
        
        $this->email = $email;

        parent::__construct($login, $password);
    }
    
    public function accountCreate(){

        if($this->email != null){

            preg_match('/(\D).*@(\D{2,5})\.(\D{2,3})/', $this->email, $matches);
            
            if($this->email === $matches[0]){

                return $this->update->changeTable("INSERT INTO `users` (email, login, password) 
                VALUES ('$this->email', '$this->login', '$this->password')");
            }
            else{

                throw new Exception("Введите корректный email!!!");
            }
        }
        else{

            return "Укажите email!!!";
        }
    }
}

class Authentication extends AccountData{

    public function __construct($login, $password){
        
        parent::__construct($login, $password);
    }

    public function LogIn(){

        $request = $this->select->readRow("SELECT `login`, `password`, `id` FROM users WHERE `login` = '$this->login' AND `password` = '$this->password'");
        if($request != null){
            $userId = $request[2];

            return setcookie("userId", $userId, time()+3600*12, "/");
        }
        else{
            
            throw new Exception("Такой пользователь не найден");
        }

    }
}