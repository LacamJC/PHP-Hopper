<?php 
namespace Database\Gateway;
use PDO;


class UserGateway
{
    private static $conn;
    private $data;

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }

    public function __get($prop)
    {
        return $this->data[$prop];
    }

    public static function setConnection(PDO $conn)
    {
        self::$conn = $conn;
    }

    public function save()
    {
        if (empty($this->data['id'])) {
            $sql = "INSERT INTO user(nome, email, senha) VALUES " .
                "(" .
                "'{$this->nome}', " .
                "'{$this->email}', " .
                "'{$this->senha}' " .
                ")";
        } else {
            $sql = "UPDATE user SET " .
                "nome = '{$this->nome}', " .
                "email = '{$this->email}' " .
                "WHERE id = '{$this->id}'";
        }

        echo $sql . '<br>';
        return self::$conn->exec($sql);
    }

    public static function login($nome, $password)
    {
        $sql = "SELECT * FROM user WHERE nome = '$nome' AND  senha = '$password'";
        $result = self::$conn->query($sql);

        return $result->fetchObject(__CLASS__);
    }

    public static function findByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE nome = '$username'";
        $result = self::$conn->query($sql);

        return $result->fetchObject(__CLASS__);
    }

    public static function findByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = self::$conn->query($sql);

        return $result->fetchObject(__CLASS__);
    }

    public static function find($id)
    {

        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = self::$conn->query($sql);

        return $result->fetchObject(__CLASS__);
    }

    public static function all(){
        $sql = "SELECT * FROM user";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public function delete() {
        $sql = "DELETE FROM user WHERE id = '{$this->id}'"; 
        echo $sql;
        return self::$conn->query($sql);
    }
}
