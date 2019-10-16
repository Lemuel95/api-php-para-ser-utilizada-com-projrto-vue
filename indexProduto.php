<?php
// allow requests from other applications
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require('models/Produto.php');

// show product
if(isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
  $produto = new Produto();
  echo json_encode($produto->findOne($_GET['id']));
}

// new product
if(isset($_POST['action']) && $_POST['action'] == 'store') {
  $produto = new Produto();
  echo json_encode($produto->store($_POST));
  return;
}

// update product
if(isset($_POST['action']) && $_POST['action'] == 'update') {
  $produto = new Produto();
  if($produto->update($_POST)) {
    echo 'Updated!';
  }
  return;
}

// remove product
if(isset($_GET['action']) && $_GET['action'] == 'destroy' && isset($_GET['id'])) {
  $produto = new Produto();
  if($produto->destroy($_GET['id'])) {
    echo 'Deleted!';
  }
  return;
}

// all products
if(!isset($_GET['action'])) {
  $produtos = new Produto();
  echo json_encode($produtos->findAll());
}
