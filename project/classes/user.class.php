<?php

class User {
    private $conn; //Database connection

    function __construct($server_name, $db_username, $db_password, $db_name) {
        $this->conn = mysqli_connect($server_name, $db_username, $db_password, $db_name); //Connects to database
        if(!$this->conn) { //Connection failed
            die("Connection failed!" . mysqli_connect_error());
        }
    }

    function uidExists($username, $email) {
         //SQL Command
        $sql_command = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
        //Pointer to a statement to the DB
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql_command)) {
            header("location: ../signup.php?error=stmtfail");
            exit();
        }
        //Add parameters to the SQL statement
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        //Executes the statement
        mysqli_stmt_execute($stmt);
        //Gets the result
        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) { //If a row was returned
            return $row;
        }
        else {
            return false;
        }

        mysqli_stmt_close($stmt);
    }

    function register($name, $email, $username, $pwd) {
        $profilePicture = "../../writeable/profile-icon.png";
        //Inserts values into table
        $sql_command = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, usersPicture) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($this->conn); //Initiazizes statement
        if(!mysqli_stmt_prepare($stmt, $sql_command)) { //Checks that it works
            return false;
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //Hash password for extra security

        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $hashedPwd, $profilePicture); //Bind parameters
        mysqli_stmt_execute($stmt); //Executes
        mysqli_stmt_close($stmt);

        return true;
    }

    function login($username, $pwd) {
        $uidExists = $this->uidExists($username, $username); //Gets row from database with the username/email

        if(!$uidExists) {//No row was returned
            return "wronglogin";
        }
    
        $matchingPasswords = password_verify($pwd, $uidExists["usersPwd"]); //Checks password match
    
        if(!$matchingPasswords) {
            return "wronglogin";
        }
        
        else if($matchingPasswords) { //User logged in
            session_start();
            //Sets session variables for later usage
            $_SESSION["userid"] = $uidExists["usersID"];
            $_SESSION["userusername"] = $uidExists["usersUid"];
            $_SESSION["username"] = $uidExists["usersName"];
            $_SESSION["useremail"] = $uidExists["usersEmail"];
            $_SESSION["userwpm"] = $uidExists["usersWPM"];
            $_SESSION["activity"] = time();
            return;
        }
    }

    function updateProfileImage($filepath) {
        session_start();
        //Sets filepath attribute to the logged in users tuple
        $sql_command = "UPDATE users SET usersPicture = ? WHERE usersID = ?;";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql_command)) { //statement failed
            header("location: ../profile.php?databasefailure");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "ss", $filepath, $_SESSION["userid"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return true;
    }

    function getImagePath() {
        //Gets filepath for the logged in user.
        $sql_command = "SELECT usersPicture FROM users WHERE usersID = ?;";
        $stmt = mysqli_stmt_init($this->conn);
        if(!mysqli_stmt_prepare($stmt, $sql_command)) {
            header("location: ../profile.php?databasefailure");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $_SESSION["userid"]);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt); //Gets the table

        mysqli_stmt_close($stmt);

        $imagePath = mysqli_fetch_assoc($result); //Gets the row as an array

        return $imagePath["usersPicture"]; //The picture attribute from the tuple
    }

    function submitWPM($wpm) {
        session_start();
        $wpm = (int) $wpm;
        if($wpm > ((int) $_SESSION["userwpm"])) { //Checks if new score is greater than database score
            $_SESSION["userwpm"] = $wpm; //Sets wpm $_SESSION variable
            //Replaces old database score with the new one
            $sql_command = "UPDATE users SET usersWPM = ? WHERE usersID = ?";
            $stmt = mysqli_stmt_init($this->conn);
            if(!mysqli_stmt_prepare($stmt, $sql_command)) {
                header("location: ..typeracer.php?failedScoreSubmit");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "is", $wpm, $_SESSION["userid"]);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            return true;
        }
    }
}

?>