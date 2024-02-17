<?php

//Checks if any of the input variables are empty
function emptyInputs($name, $email, $username, $pwd, $pwdrepeat) {
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)) {
        return true;
    }
    return false;
}

//Checks that the username only has letters, numbers
function invalidUid($username) {
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        return true;
    }
    return false;
}

//Checks if the email is valid
function invalidEmail($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

//Checks if the passwords dont match
function pwdDontMatch($pwd, $pwdrepeat) {
    if($pwd !== $pwdrepeat) {
        return true;
    }
    return false;
}

//Checks if the username or password is empty
function emptyInputLogin($username, $pwd) {
    if(empty($username) || empty($pwd)) {
        return true;
    }
    return false;
}

?>