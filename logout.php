<?
session_start();
unset($_SESSION['auth']);
$_SESSION['flash']['success']='Déconnexion réussie';
header('Location:login.php');