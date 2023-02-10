<?php

class Session {

    private $signed_in = false;
    private $user_id;
    public $msg;

    function __construct() {

        session_start();
        $this->check_login();
        $this->verify_message();

    }

    public function get_logged_user_id() {

        return $this->user_id;

    }

    public function login($user) {

        if($user) {

            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;

        }

    }

    public function logout() {

        if($this->is_signed_in()) {

            unset($this->user_id);
            unset($_SESSION['user_id']);
            $this->signed_in = false;

        }

    }

    public function is_signed_in() {

        return $this->signed_in;

    }

    private function check_login() {

        if(isset($_SESSION['user_id'])) {

            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;

        } else {

            unset($this->user_id);
            $signed_in = false;

        }

    }

    public function message($msg="") {

        if(!empty($msg)) {

            $_SESSION['msg'] = $msg;

        } else {

            return $this->msg;

        }

    }

    private function verify_message() {

        if(isset($_SESSION['msg'])) {

            $this->msg = $_SESSION['msg'];
            unset($_SESSION['msg']);

        } else {

            $this->msg = "";

        }

    }

}

$session = new Session();

?>