<?php
    if(isset($_POST["submit"])) {
        //Gets all the data from the POST method
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["uid"];
        $pwd = $_POST["pwd"];
        $pwdrepeat = $_POST["pwdrepeat"];

        require_once "functions.inc.php";
        require_once "dbh.inc.php";
        
        //Checks the the signup inputs are OK

        if(emptyInputs($name, $email, $username, $pwd, $pwdrepeat)) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }

        if(invalidUid($username)) {
            header("location: ../signup.php?error=invaliduid");
            exit();
        }
        
        if(invalidEmail($email)) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
        
        if(pwdDontMatch($pwd, $pwdrepeat)) {
            header("location: ../signup.php?error=notmatchingpasswords");
            exit();
        }

        if($user->uidExists($username, $email)) {
            header("location: ../signup.php?error=usernametaken");
            exit();
        }

        if(!$user->register($name, $email, $username, $pwd)) { //Failed to create user
            header("location: ../signup.php?error=stmtfail");
            exit();
        }

        //User has been created
        header("location: ../signup.php?error=none");
        exit();

    }
    else {
        header("location: ../signup.php");
        exit();
    }
?>