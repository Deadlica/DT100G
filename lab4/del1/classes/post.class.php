<?php
    class Post {
        private $name = "";
        private $message = "";
        private $time = "";

        function __construct($post)
        {
            if(!empty($post)) {
                $this->name = $post[0];
                $this->message = $post[1];
                $this->time = $post[2];
            }
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