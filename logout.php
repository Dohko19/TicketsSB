<?php
include("Config/usuario.php");
$user = new Usuario;
$user->killSession();
header("Location: ./");

  ?>