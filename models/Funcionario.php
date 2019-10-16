<?php

require('core/Db.php');

class Funcionario{

	private $connection;


	public function __construct(){
		$this->connection = (new Db())->connect();
	}
// funcao pra lisar todos funcionarios do sistema
	public function findAll(){
		$sql = 'SELECT * FROM funcionarios';
		$funcionarios = $this->connection->prepare($sql);
		$funcionarios->execute();
		return $funcionarios->fetchAll(PDO::FETCH_OBJ);
	}
// funcaoa pra atualizar o funcionario no sistema
	public function findOne($id){
		$sql = 'SELECT * FROM funcionarios WHERE id = :id';
		$func = $this->connection->prepare($sql);
		$func->bindValue(':id', $id, PDO::PARAM_INT);
		$func->execute();
		return $func->fetch(PDO::FETCH_OBJ);
	}
//funcao pra colocar no banco de dados um funcionario
	public function store($data){
		$sql = 'INSERT INTO funcionarios (nome) ';
    	$sql .= 'VALUES (:nome)';

    	$func = $this->connection->prepare($sql);

	    $func->bindValue(':nome', $data['nome'], PDO::PARAM_STR);

	    if ($data['nome'] == '') {
      echo "Não pode haver campo nulo!";
      }else{
        $func->execute();
        return $this->connection->lastInsertId();
      }
	}
//atualizar um funcionario do sistema 
  	public function update($data){
	    $sql = 'UPDATE funcionarios SET nome = :nome WHERE id = :id';

	    $func = $this->connection->prepare($sql);

	    $func->bindValue(':id', $data['id'], PDO::PARAM_INT);
	    $func->bindValue(':nome', $data['nome'], PDO::PARAM_STR);

	    return $func->execute();
  }
  	//funcao pra deleta o funcionario do sistema
  	public function destroy($id){
    	$sql = 'DELETE FROM funcionarios WHERE id = :id';
    	$func = $this->connection->prepare($sql);
    	$func->bindValue(':id', $id, PDO::PARAM_INT);
    	return $func->execute();
  	}
}
