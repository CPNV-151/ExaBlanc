<?php
require_once 'model/dbConnector.php';

const SEPARATOR = '\'';

function isLoginCorrect($userEmailAddress, $userPwd):bool{
    $userPwdDb = getUserPwd($userEmailAddress);

    if(password_verify($userPwd,$userPwdDb)){
        return true;
    }
    return false;
}

function getUserPwd($userEmailAddress):string{
    $loginQuery = 'SELECT userHashPsw FROM users WHERE userEmailAddress =' . SEPARATOR.$userEmailAddress.SEPARATOR;
    $queryResults = executeQuerySelect($loginQuery);
    if($queryResults==null){
        return "";
    }
    return $queryResults[0][0];
}

function isRegistrationCorrect($userEmailAddress, $userPwd):bool
{
    $strSeparator = '\'';

    $userHashPsw = hashPassword($userPwd);

    $registerQuery = 'INSERT INTO users (`userEmailAddress`, `userHashPsw`) VALUES (' . $strSeparator . $userEmailAddress . $strSeparator . ',' . $strSeparator . $userHashPsw . $strSeparator . ')';

    $queryResult = executeQueryInsert($registerQuery);
    if ($queryResult) {
        return true;
    }
    return false;
}

function hashPassword(string $pwd){
    return password_hash($pwd, PASSWORD_DEFAULT);
}