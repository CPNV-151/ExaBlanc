<?php

require "./model/usersService.php";

$error = null;

function login($userInputLoginData):void{
    if(isset($userInputLoginData['inputUserEmailAddress'])){
        if(isLoginCorrect($userInputLoginData['inputUserEmailAddress'], $userInputLoginData['inputUserPwd'])) {
            $_SESSION['userEmailAddress'] = $userInputLoginData['inputUserEmailAddress'];
            snows();
        }else{
            $error = "Erreur de login";
            require "view/login.php";
        }
    }else{
        require "view/login.php";
    }
}

function logout():void{
    $_SESSION = array();
    session_destroy();
    require "view/home.php";
}

function register($userInputRegisterData):void{
    if(isset($userInputRegisterData['inputUserEmailAddress'])){
        if(isRegistrationCorrect($userInputRegisterData['inputUserEmailAddress'],$userInputRegisterData['inputUserPwd'])) {
            login($userInputRegisterData);
        }else{
            $error = "registration not possible";
            require "view/register.php";
        }
    }else{
        require "view/register.php";
    }
}