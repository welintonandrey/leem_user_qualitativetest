<?php

require_once('dbmanager.php');

class testeUsuario {

    private $id;
    private $email;
    private $final;
    private $vOriginal;
    private $v1;
    private $v2;
    private $v3;
    private $v4;
    private $vEscolha;

    function __construct($email, $final, $vOriginal, $v1, $v2, $v3, $v4, $vEscolha) {
        $this->id = -1;
        $this->email = $email;
        $this->final = $final;
        $this->vOriginal = $vOriginal;
        $this->v1 = $v1;
        $this->v2 = $v2;
        $this->v3 = $v3;
        $this->v4 = $v4;
        $this->vEscolha = $vEscolha;
    }

    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getFinal() {
        return $this->final;
    }

    function getVOriginal() {
        return $this->vOriginal;
    }

    function getV1() {
        return $this->v1;
    }

    function getV2() {
        return $this->v2;
    }

    function getV3() {
        return $this->v3;
    }

    function getV4() {
        return $this->v4;
    }

    function getVEscolha() {
        return $this->vEscolha;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setFinal($final) {
        $this->final = $final;
        return $this;
    }

    function setVOriginal($vOriginal) {
        $this->vOriginal = $vOriginal;
        return $this;
    }

    function setV1($v1) {
        $this->v1 = $v1;
        return $this;
    }

    function setV2($v2) {
        $this->v2 = $v2;
        return $this;
    }

    function setV3($v3) {
        $this->v3 = $v3;
        return $this;
    }

    function setV4($v4) {
        $this->v4 = $v4;
        return $this;
    }

    function setVEscolha($vEscolha) {
        $this->vEscolha = $vEscolha;
        return $this;
    }

    /*
     * SQLs
     * */

    public function insert() {
        try {
            $db = dbmanager::getConnection();
            /* Begin a transaction, turning off autocommit */
            $sql = 'INSERT INTO TESTE_USUARIO(email, final, v_original, v1, v2, v3, v4, v_escolha) VALUES (:email, :final, :vOriginal,:v1,:v2,:v3,:v4,:vEscolha)';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email',     $this->email,     SQLITE3_TEXT);
            $stmt->bindValue(':final',     $this->final,     SQLITE3_INTEGER);
            $stmt->bindValue(':vOriginal', $this->vOriginal, SQLITE3_INTEGER);
            $stmt->bindValue(':v1',        $this->v1,        SQLITE3_INTEGER);
            $stmt->bindValue(':v2',        $this->v2,        SQLITE3_INTEGER);
            $stmt->bindValue(':v3',        $this->v3,        SQLITE3_INTEGER);
            $stmt->bindValue(':v4',        $this->v4,        SQLITE3_INTEGER);
            $stmt->bindValue(':vEscolha',  $this->vEscolha,  SQLITE3_INTEGER);
            $result = $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function update() {
        try {
            $db = dbmanager::getConnection();
            /* Begin a transaction, turning off autocommit */
            $sql = 'UPDATE TESTE_USUARIO set email = :email, final = :final, v_original = :vOriginal, '
                    . 'v1 = :v1, v2 = :v2, v3 = :v3, v4 = :v4, v_escolha = :vEscolha where key = :id';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email',     $this->email,     SQLITE3_TEXT);
            $stmt->bindValue(':final',     $this->final,     SQLITE3_INTEGER);
            $stmt->bindValue(':vOriginal', $this->vOriginal, SQLITE3_INTEGER);
            $stmt->bindValue(':v1',        $this->v1,        SQLITE3_INTEGER);
            $stmt->bindValue(':v2',        $this->v2,        SQLITE3_INTEGER);
            $stmt->bindValue(':v3',        $this->v3,        SQLITE3_INTEGER);
            $stmt->bindValue(':v4',        $this->v4,        SQLITE3_INTEGER);
            $stmt->bindValue(':vEscolha',  $this->vEscolha,  SQLITE3_INTEGER);
            $stmt->bindValue(':id',        $this->id,        SQLITE3_INTEGER);
            $result = $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public static function selectFirstTest($email) {
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from TESTE_USUARIO where V_ESCOLHA is NULL and email like :email LIMIT 1';
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

    public static function selectCurrentTest($email){
        try {
            $db = dbmanager::getConnection();
            $sql = 'select TU.KEY, TU.EMAIL, TU.FINAL, TU.V_ORIGINAL, TU.V1, TU.V2, TU.V3, TU.V4, TU.V_ESCOLHA from TESTE_USUARIO as TU, USER as U where U.CURRENT_TEST == TU.KEY and TU.email like :email and U.EMAIL like :email';
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

    public static function selectFinalTest($email, $vOriginal) {
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from TESTE_USUARIO where final=1 and email like :email and v_original=:vOriginal';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, SQLITE3_TEXT);
            $stmt->bindValue(':vOriginal', $vOriginal, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $row = $result->fetchArray();

        } catch (Exception $e) {
            throw $e;
        }
        return self::toObject($row);
    }

    public static function selectById($id) {
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from TESTE_USUARIO where key=:key';
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':key', $id, SQLITE3_INTEGER);
            $result = $stmt->execute();
            $row = $result->fetchArray();

        } catch (Exception $e) {
            throw $e;
        }
        return self::toObject($row);
    }

    public static function selectAll() {
        $users = array();
        try {
            $db = dbmanager::getConnection();
            $sql = 'select * from TESTE_USUARIO';
            $results = $db->query($sql);
            while ($row = $results->fetchArray()) {
                array_push($users, self::toObject($row));
            }
        } catch (Exception $e) {
            throw $e;
        }
        return $users;
    }

    public static function selectTotalTestUser($email) {
        try {
          $db = dbmanager::getConnection();
          $sql = "select count(*) from TESTE_USUARIO where email like :email";
          $stmt = $db->prepare($sql);
          $stmt->bindValue(':email', $email, SQLITE3_TEXT);
          $result = $stmt->execute();
          $total = $result->fetchArray();
        } catch (Exception $e) {
            throw $e;
        }
        return $total['count(*)'];
    }

    public static function selectTotalAnswerTestUser($email) {
        try {
          $db = dbmanager::getConnection();
          $sql = "select count(*) from teste_usuario where email like :email and v_escolha is not null";
          $stmt = $db->prepare($sql);
          $stmt->bindValue(':email', $email, SQLITE3_TEXT);
          $result = $stmt->execute();
          $total = $result->fetchArray();
        } catch (Exception $e) {
            throw $e;
        }
        return $total['count(*)'];
    }

    public static function toObject($array) {
        $tupla = new testeUsuario($array["EMAIL"], $array["FINAL"], $array["V_ORIGINAL"], $array["V1"],
                                  $array["V2"], $array["V3"], $array["V4"], $array["V_ESCOLHA"]);
        $tupla->setId($array["KEY"]);
        return $tupla;
    }

}
