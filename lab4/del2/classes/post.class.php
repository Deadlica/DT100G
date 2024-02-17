<?php
    class Post {
        private $name = "";
        private $message = "";
        private $time = "";

        function __construct($name, $message)
        {
            $this->name = $name;
            $this->message = $message;
        }

        function setTime() {
            $this->time = date("Y-m-d H:i:s");
        }

        function getName() {
            return $this->name;
        }

        function getMessage() {
            return $this->message;
        }

        function getTime() {
            return $this->time;
        }
    }
?>