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
    //le formulaire n'est pas vide
    if(isset($userInputRegisterData['inputUserEmailAddress'])){
        //vérifier que les deux pwds sont identiques
        if($userInputRegisterData['inputUserPwd'] == $userInputRegisterData['inputUserPwdCheck']){
            //tenter le register
            if(isRegistrationCorrect($userInputRegisterData['inputUserEmailAddress'],$userInputRegisterData['inputUserPwd'])) {
                login($userInputRegisterData);
            }else{
                //on détecte une erreur de register et on affiche le formulaire
                $error = "registration not possible";
                require "view/register.php";
            }
        }
        $error = "passwords check failed";
        require "view/register.php";
    }else{
        //on affiche le formulaire vide
        require "view/register.php";
    }
}