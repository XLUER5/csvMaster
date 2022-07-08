<?php
session_start();
$token = $_GET['token'];
$usuario = $_GET['usuario'];
$url = $_GET['url'];
$_SESSION['sesion'] = "activa";
$_SESSION['token'] = $token;
$_SESSION['usuario'] = $usuario;
$_SESSION['url']=$url;
header('location:pages/perfil.php');

