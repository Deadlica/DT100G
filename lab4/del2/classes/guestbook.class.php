<?php

class Guestbook {
    private $conn = "";
    private $table = "";
    private $row = "";

    function __construct($server_name, $db_username, $db_password, $db_name) {
        $this->conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);
        if(!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function add($post) {
        $sql_add_post = "INSERT INTO guestbooktable (Username, Post, PostDate) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($this->conn);
        //Adds sql command to the stmt
        if(!mysqli_stmt_prepare($stmt, $sql_add_post)) {
            header("location: ../index.php?error=stmtfail");
            exit();
        }

        //Sets the parameters to the sql commands placeholders
        mysqli_stmt_bind_param($stmt, "sss", $post->getName(), $post->getMessage(), $post->getTime());
        //Executes it
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function delete($removeID, $tableName) {
        $sql_command = "DELETE FROM $tableName WHERE ID = $removeID";
        
        $result = $this->conn->query($sql_command);

        if(!$result) {
            header("location: ../index.php?error=queryfail");
            exit();
        }

    }

    function getTable($tableName) {
        $sql_command = "SELECT * FROM " . $tableName;

        $stmt = mysqli_stmt_init($this->conn);
    
        if(!mysqli_stmt_prepare($stmt, $sql_command)) {
            header("location: ../index.php?error=stmtfail");
            exit();
        }
    
        mysqli_stmt_execute($stmt);
    
        $table = mysqli_stmt_get_result($stmt);
    
        return $table;
    }

    function getRowNumber($table) {
        $row_num = mysqli_num_rows($table);
        return $row_num;
    }

    function getRow($table) {
        return mysqli_fetch_row($table);
    }

}

?>