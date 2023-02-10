<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = ['username', 'email', 'password'];
    public $id;
    public $username;
    public $email;
    public $password;

    public function verify_user($username, $password) {

        global $db;

        $username = $db->escape_string($username);
        $password = $db->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

        $result = self::execute_query($sql);

        return !empty($result) ? array_shift($result) : false;

    }

    public function email_exists($email) {

        global $db;

        $email = $db->escape_string($email);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE email = '{$email}'";

        $result = self::execute_query($sql);

        return !empty($result) ? array_shift($result) : false;

    }

}

?>