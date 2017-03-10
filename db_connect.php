<?php
$host		='prover04.mysql.ukraine.com.ua';
$user		='prover04_db';
$database	='prover04_db';
$pass	    ='dkXGgbBW';

$connection = mysqli_connect($host,$user,$pass);

mysqli_select_db($connection, $database) or die("База данных не подключена!".mysqli_error());
mysqli_query($connection, "SET NAMES 'cp1251'");
?>