<?php
namespace Ride\PHP\Model;

use \PDO;
use \PDOException;

require_once('database.php');

class Caronas{

    private $idcaronas;
    private $data;
    private $origem;
    private $destino;
    private $vagas;
    private $preco;


    public function __construct(){
        $database = new Database();
        $this->conn = $database->dbSet();
    }

    public function create(){ 
        $query = "INSERT INTO `caronas`(`data`, `origem`, `destino`, `vagas`, `preco`) VALUES (:data, :origem, :destino, :vagas, :preco);";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':data', $this->data);
        $stmt->bindValue(':origem', $this->origem);
        $stmt->bindValue(':destino', $this->destino);
        $stmt->bindValue(':vagas', $this->vagas);
        $stmt->bindValue(':preco', $this->preco);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function read()
    {
        $query = "SELECT `idcaronas`, `data`, `origem`, `destino`, `vagas`, `preco` FROM `caronas` WHERE `idcaronas` = :idcaronas;"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':idcaronas', $this->idcaronas);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update(){ 
        $query = "UPDATE `caronas` SET `data`= :data, `origem`= :origem, `destino`= :destino, `vagas`= :vagas, `preco`= :preco WHERE `idcaronas` = :idcaronas;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':idcaronas', $this->idcaronas);
        $stmt->bindValue(':data', $this->data);
        $stmt->bindValue(':origem', $this->origem);
        $stmt->bindValue(':destino', $this->destino);
        $stmt->bindValue(':vagas', $this->vagas);
        $stmt->bindValue(':preco', $this->preco);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete()
    {
        $query = "DELETE FROM `caronas` WHERE `idcaronas` = :idcaronas;"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':idcaronas', $this->idcaronas);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    } 

    public function index()
    {
        $query = "SELECT `idcaronas`, date_format(`data`, '%Y-%m-%d') as dataform, date_format(`data`, '%d-%m-%Y') as data, date_format(`data`, '%h:%i') as hora, `origem`, `destino`, `vagas`, `preco` FROM `caronas` WHERE 1;"; 
        $stmt = $this->conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function setIDCaronas($idcaronas){
        $this->idcaronas = $idcaronas;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function setOrigem($origem){
        $this->origem = $origem;
    }

    public function setDestino($destino){
        $this->destino = $destino;
    }

    public function setVagas($vagas){
        $this->vagas = $vagas;
    }

    public function setPreco($preco){
        $this->preco = $preco;
    }    

}

?>