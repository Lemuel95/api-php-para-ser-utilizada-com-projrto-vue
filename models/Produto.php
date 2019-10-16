<?php

require('core/Db.php');

class Produto{

	private $connection;

	public function __construct(){
		$this->connection = (new Db())->connect();
	}
//listando todos produtos no banco de dados
	public function findAll(){
		$sql = 'SELECT * FROM produtos';
		$produto = $this->connection->prepare($sql);
		$produto->execute();
		return $produto->fetchAll(PDO::FETCH_OBJ);
	}

	public function findOne($id){
		$sql = 'SELECT * FROM produtos WHERE id = :id';
		$produto = $this->connection->prepare($sql);
		$produto->bindValue(':id', $id, PDO::PARAM_INT);
		$produto->execute();
		return $produto->fetch(PDO::FETCH_OBJ);
	}
//funcao pra cadastra produto no banco
	public function store($data){
		$sql = 'INSERT INTO produtos (produto, descricao, quantidade, preco) ';
    	$sql .= 'VALUES (:produto, :descricao, :quantidade, :preco)';

    	$produto = $this->connection->prepare($sql);

	    $produto->bindValue(':produto', $data['produto'], PDO::PARAM_STR);
      $produto->bindValue(':descricao', $data['descricao'], PDO::PARAM_STR);
	    $produto->bindValue(':quantidade', $data['quantidade'], PDO::PARAM_STR);
	    $produto->bindValue(':preco', $data['preco'], PDO::PARAM_STR);

	    if ($data['produto'] == '' || $data['descricao'] == '' || $data['quantidade'] == '' || $data['preco'] == '') {
      echo "Não pode haver campo nulo!";
      }else{
        $produto->execute();
        return $this->connection->lastInsertId();
      }
	}
//funcao pra atualizar o produto no sistema
  	public function update($data){
	    $sql = 'UPDATE produtos SET produto = :produto, descricao = :descricao, quantidade = :quantidade, preco = :preco WHERE id = :id';

	    $produto = $this->connection->prepare($sql);

	    $produto->bindValue(':id', $data['id'], PDO::PARAM_INT);
	    $produto->bindValue(':produto', $data['produto'], PDO::PARAM_STR);
      $produto->bindValue(':descricao', $data['descricao'], PDO::PARAM_STR);
	    $produto->bindValue(':quantidade', $data['quantidade'], PDO::PARAM_STR);
	    $produto->bindValue(':preco', $data['preco'], PDO::PARAM_STR);

	    return $produto->execute();
  }
  	//funcao pra excluir o produto do sistema 
  	public function destroy($id){
    	$sql = 'DELETE FROM produtos WHERE id = :id';
    	$produto = $this->connection->prepare($sql);
    	$produto->bindValue(':id', $id, PDO::PARAM_INT);
    	return $produto->execute();
  	}
}
