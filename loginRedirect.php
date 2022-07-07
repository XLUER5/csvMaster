<?php
session_start();
$token = $_GET['token'];
$usuario = $_GET['usuario'];
$_SESSION['sesion'] = "activa";
$_SESSION['token'] = $token;
$_SESSION['usuario'] = $usuario;
header('location:pages/perfil.php');

