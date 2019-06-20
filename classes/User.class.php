<?php
//User.class.php

require_once 'DB.class.php';

class User
{
    public $id;
    public $username;
    public $displayname;
    public $hashedPassword;
    public $email;
    public $joinDate;
    public $f;
    public $i;
    public $o;
    public $admin;

    function __construct($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : "";
        $this->username = (isset($data['username'])) ? $data['username'] : "";
        $this->displayname = (isset($data['displayname'])) ? $data['displayname'] : "";
        $this->hashedPassword = (isset($data['password'])) ? $data['password'] : "";
        $this->email = (isset($data['email'])) ? $data['email'] : "";
        $this->joinDate = (isset($data['join_date'])) ? $data['join_date'] : "";
        $this->f = (isset($data['f'])) ? $data['f'] : "";
        $this->i = (isset($data['i'])) ? $data['i'] : "";
        $this->o = (isset($data['o'])) ? $data['o'] : "";
        $this->admin = (isset($data['admin'])) ? $data['admin'] : "";
    }

    public function save($isNewUser = false)
    {
        $db = new DB();
        if (!$isNewUser) {
            $data = array(
                "username" => "'$this->username'",
                "password" => "'$this->hashedPassword'",
                "email" => "'$this->email'",
                "f" => "'$this->f'",
                "i" => "'$this->i'",
                "o" => "'$this->o'",
                "admin" => "'$this->admin'"
            );

            $db->update($data, 'users', 'id = ' . $this->id);
        } else {
            $data = array(
                "username" => "'$this->username'",
                "password" => "'$this->hashedPassword'",
                "email" => "'$this->email'",
                "join_date" => "'" . date("Y-m-d H:i:s", time()) . "'",
                "f" => "'$this->f'",
                "i" => "'$this->i'",
                "o" => "'$this->o'",
                "admin" => "0"
            );
            $this->id = $db->insert($data, 'users');
            $this->joinDate = time();
        }
        return true;
    }
}

?>