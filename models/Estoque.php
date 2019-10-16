<?php

require('core/Db.php');

class Estoque{

	public function __construct(){
		$this->connection = (new Db())->connect();
	}
	public function findAll(){
		$sql = 'SELECT * FROM estoque';
		$estoque = $this->connection->prepare($sql);
		$estoque->execute();
		return $estoque->fetchAll(PDO::FETCH_OBJ);
	}
	public function findOne($id){
		$sql = 'SELECT * FROM estoque WHERE id = :id';
		$stoq = $this->connection->prepare($sql);
		$stoq->bindValue(':id', $id, PDO::PARAM_INT);
		$stoq->execute();
		return $stoq->fetch(PDO::FETCH_OBJ);
	}
	public function store($data){
		$sql = 'INSERT INTO estoque (qtd) ';
    	$sql .= 'VALUES (:qtd)';

    	$stoq = $this->connection->prepare($sql);

	    $stoq->bindValue(':qtd', $data['qtd'], PDO::PARAM_STR);

	    if ($data['qtd'] == '') {
      echo "Não pode haver campo nulo!";
      }else{
        $stoq->execute();
        return $this->connection->lastInsertId();
      }
	}
}