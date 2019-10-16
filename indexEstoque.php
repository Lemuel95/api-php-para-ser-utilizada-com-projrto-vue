<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require('models/estoque.php');
// permitindo o acesso a class estoque atravez do metodo get e post pela url
if(isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
  $stoq = new Estoque();
  echo json_encode($stoq->findOne($_GET['id']));
}

if(isset($_POST['action']) && $_POST['action'] == 'store') {
  $stoq = new Estoque();
  echo json_encode($stoq->store($_POST));
  return;
}

if(!isset($_GET['action'])) {
  $estoque = new Estoque();
  echo json_encode($estoque->findAll());
}