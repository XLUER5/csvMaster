<?php
session_start();
if(!isset($_SESSION['codEmpleado'])){
    header('location:login.php');
}