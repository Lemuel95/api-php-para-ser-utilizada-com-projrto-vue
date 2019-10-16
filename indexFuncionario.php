<?php
// permite o acesso de outras api a fazer requisicao a esse sitema que controla o acesso de dados ao banco fazendo o controle do servido

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require('models/Funcionario.php');

// permitindo o acesso atravez do metodo  get a class funcionario atravez da url
if(isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
  $func = new Funcionario();
  echo json_encode($func->findOne($_GET['id']));
}

// cadastrando um novo funcionario no sistema do servido
if(isset($_POST['action']) && $_POST['action'] == 'store') {
  $func = new Funcionario();
  echo json_encode($func->store($_POST));
  return;
}

// atualizando o funcionario cadastrado no banco funcionario
if(isset($_POST['action']) && $_POST['action'] == 'update') {
  $func = new Funcionario();
  if($func->update($_POST)) {
    echo 'Updated!';
  }
  return;
}

// removendo  funcionario do sistema
if(isset($_GET['action']) && $_GET['action'] == 'destroy' && isset($_GET['id'])) {
  $func = new Funcionario();
  if($func->destroy($_GET['id'])) {
    echo 'Deleted!';
  }
  return;
}

// listando todos os funcionario do sistema
if(!isset($_GET['action'])) {
  $funcionarios = new Funcionario();
  echo json_encode($funcionarios->findAll());
}
