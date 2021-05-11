<!DOCTYPE html>

<html lang="en">
<head>
	 <meta charset="UTF-8">
  	<title>Test</title>
	<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
		  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" rel="stylesheet">
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

</head>
	<body class="text-center">
		<form action="makeTest*.php" method="post">
			<div class="col text-center" id="formDiv" style="max-width: 330px">
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
include_once ("/home/xpolakovam/public_html/skuskoveZadanieWT2/path.php");
require_once ROOT_PATH . '/config.php';
	include_once ROOT_PATH . '/connection/ConnectionFactory.php';
//echo ROOT_PATH;
include_once("questions/ShortAnswerQuestion.php");
include_once ("app/Database.php");
include_once ("repository/SharedRepository.php");
include_once ("questions/ChoiceQuestion.php");
	$connectionFactory = new ConnectionFactory();
	$conn = $connectionFactory->createConnection();
//$conn = (new Database())->createConnectioon();

	//addQuestionToDBSA("2","Ake farba zacina na c", null, "3","cierna", null);
	//submitAnswersSA("20", "4", "cier");
	//submitAnswersSA("21", "4", " Cierna ");
	$ids = array("17", "18", "19");
	var_dump($ids);echo $ids[0];
	addQuestionToDBCh("2", "Preco to robim?", 11, "2", ["musim"=>"true", "chcem"=>"false", "nerobim"=>"false"], $ids);

?>


	</body>
</html>
