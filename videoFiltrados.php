<?php

require_once('dbmanager.php');

class videoFiltrados {

    private $id;
    private $idOriginal;
    private $name;
    private $url;
    
    function __construct($id, $idOriginal, $name, $url) {
        $this->id = $id;
        $this->idOriginal = $idOriginal;
        $this->name = $name;
        $this->url = $url;
    }
    
    function getId() {
        return $this->id;
    }

    function getIdOriginal() {
        return $this->idOriginal;
    }

    function getName() {
        return $this->name;
    }

    function getUrl() {
        return $this->url;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setIdOriginal($idOriginal) {
        $this->idOriginal = $idOriginal;
        return $this;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setUrl($url) {
        $this->url = $url;
        return $this;
    }
    

    /*
     * SQLs
     * */

    public static function selectById($id) {
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from VIDEO_FILTRADOS where key=:key';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':key', $id, SQLITE3_INTEGER);
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
    
    public static function selectByOriginalVideoId($id) {
        $data = array();
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from VIDEO_FILTRADOS where key_original=:key';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':key', $id, SQLITE3_INTEGER);
            $result = $stmt->execute();
            while ($row = $result->fetchArray()) {
                array_push($data, self::toObject($row));
            }
        } catch (Exception $e) {
            throw $e;
        }
        return $data;
    }
    
    public static function selectAll() {
        $users = array();
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from VIDEO_FILTRADOS';
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
        $tupla = new videoFiltrados($array[0], $array[1], $array[2], $array[3]);
        return $tupla;
    }

}
