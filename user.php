<?php

require_once('dbmanager.php');

class User {

    public $email;
    public $password;
    public $name;
    public $type;
    public $currentTest;

    public function __construct($email, $password, $name, $type, $currentTest) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->type = $type;
        $this->currentTest = $currentTest;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }
    
    function getCurrentTest() {
        return $this->currentTest;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    
    function setCurrentTest($currentTest) {
        $this->currentTest = $currentTest;
    }

    /*
     * SQLs
     * */
    
    public function insert() {
        try {
            $db = dbmanager::getConnection();
            /* Begin a transaction, turning off autocommit */
            $sql = 'INSERT INTO user(email, password, name, type, current_test) VALUES (:email,:pass,:name,:type,:currentTest)';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email',       $this->email,          SQLITE3_TEXT);
            $stmt->bindValue(':pass',        $this->password,       SQLITE3_TEXT);
            $stmt->bindValue(':name',        $this->name,           SQLITE3_TEXT);
            $stmt->bindValue(':type',        $this->type,           SQLITE3_INTEGER);
            $stmt->bindValue(':currentTest', $this->currentTest,    SQLITE3_INTEGER);
            $result = $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return FALSE;
        }
        return $result;
    }
    public function update() {
        try {
            $db = dbmanager::getConnection();
            /* Begin a transaction, turning off autocommit */
            $sql = 'UPDATE user set password = :pass, name = :name, type = :type, current_test = :ct where email = :email';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email',     $this->email,     SQLITE3_TEXT);
            $stmt->bindValue(':pass',      $this->password,  SQLITE3_TEXT);
            $stmt->bindValue(':name',      $this->name,      SQLITE3_TEXT);
            $stmt->bindValue(':type',      $this->type,      SQLITE3_INTEGER);
            $stmt->bindValue(':ct',        $this->currentTest,        SQLITE3_INTEGER);
            $result = $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
    
    public static function selectByLoginAndPassword($email, $password) {
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from user where email=:email and password=:pass';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':pass', $password, SQLITE3_TEXT);
            $result = $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
        if (empty($result)) {
            return null;
        } else {
            $row = $result->fetchArray();
            return self::toObject($row);
        }
    }
    
    public static function selectByEmail($email) {
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from user where email=:email';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $result = $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
        if (empty($result)) {
            return null;
        } else {
            $row = $result->fetchArray();
            return self::toObject($row);
        }
    }

    public static function selectAll() {
        $users = array();
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from user';
            $results = $db->query($sql);
            while ($row = $results->fetchArray()) {
                array_push($users, self::toObject($row));
            }
        } catch (Exception $e) {
            throw $e;
        }
        return $users;
    }

    public static function toObject($array) {
        $tupla = new User($array[0], $array[1], $array[2], $array[3], $array[4]);
        return $tupla;
    }

}
