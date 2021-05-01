<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	session_start();

	require_once("app/Database.php");
	$conn = (new Database())->createConnectioon();
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		//var_dump($_POST);
		var_dump($_POST);
		if (isset($_POST["password"]) && isset($_POST["email"]) && !empty($_POST["password"])  && !empty($_POST["email"]) ){
			//teacher
			$sql = "SELECT * FROM users WHERE email = ?";

			$stm = $conn->prepare($sql);
			$stm->execute([$_POST["email"]]);

			$user = $stm->fetch(PDO::FETCH_ASSOC);

			//var_dump($user);
			if (password_verify($_POST['password'], $user['password'])){
				$_SESSION['username']=$_POST["email"];
				$id = $user['id'];
				//echo "successfully";
				header("location: index.php");//TODO set page
			}else{
				echo "bad password";
			}
		}elseif (isset($_POST["examCode"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && !empty($_POST["examCode"])  && !empty($_POST["firstName"]) && !empty($_POST["lastName"])){
			//student
			$sql = "SELECT * FROM tests WHERE code = ?";

			$stm = $conn->prepare($sql);
			$stm->execute([$_POST["examCode"]]);

			$exam = $stm->fetch(PDO::FETCH_ASSOC);

			//var_dump($exam);
			if (isset($exam['id'])){
				//echo "successfully";
				header("location: index.php");//TODO set page
			}else{
				echo "bad examcode";
			}
		}
		/**/
	}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	 <meta charset="UTF-8">
  	<title>Sign In</title>
	<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
		  integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" rel="stylesheet">
	<link href="style/style.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

</head>
	<body class="text-center">
		<form action="login.php" method="post">
			<div class="col text-center" id="formDiv" style="max-width: 330px">
			<div class="row" style="margin-left: 2px">
				<button class="btn btn-lg btn-info " id="studentBTN" onclick="student(); return false;" style="width: 48%; background-color: #2C606A" ;>Student</button>
				<button class="btn btn-lg btn-info" id="teacherBTN" onclick="teacher(); return false;" style="width: 48%">Teacher</button>
			</div>
			<div id="formContent">
				<div id="codeDiv" class="form-group">
					<input type="text" id="code" class="form-control" placeholder="Exam code" name="examCode">
				</div>
				<div id="firstNameDiv" class="form-group">
					<input type="text" id="firstName" class="form-control" placeholder="First name" name="firstName">
				</div>
				<div id="lastNameDiv" class="form-group">
					<input type="text" id="lastName" class="form-control" placeholder="Last name" name="lastName">
				</div>
			</div>
				<button type="submit" class="btn btn-lg btn-info btn-block"  >Sign In</button>

			</div>
			<div class="container signin">
    		<p>Does not have an account? <a href="register.php">Register</a>.</p>
  		</div>
		</form>

		<script>
			function student() {
				document.getElementById("teacherBTN").style.backgroundColor = '#2DA2B8';
				var stbtn = document.getElementById("studentBTN");
				stbtn.style.backgroundColor= '#2C606A';

				var parent = document.getElementById("formContent");
				while (parent.firstChild) {
					parent.removeChild(parent.firstChild);
				}
				var y = document.createElement("INPUT");
				y.setAttribute("type", "text");
				y.setAttribute("class", "form-control");
				y.setAttribute("id", "examCode");
				y.setAttribute("placeholder", "Exam code");
				y.setAttribute("name", "examCode");
				parent.appendChild(y);

				var x = document.createElement("INPUT");
				x.setAttribute("type", "text");
				x.setAttribute("class", "form-control");
				x.setAttribute("id", "firstName");
				x.setAttribute("placeholder", "First name");
				x.setAttribute("name", "firstName");
				parent.appendChild(x);

				var z = document.createElement("INPUT");
				z.setAttribute("type", "text");
				z.setAttribute("class", "form-control");
				z.setAttribute("id", "lastName");
				z.setAttribute("placeholder", "Last name");
				z.setAttribute("name", "lastName");
				parent.appendChild(z);
			}
			function teacher() {
				console.log("teacher")
				document.getElementById("teacherBTN").style.backgroundColor = '#2C606A';
				document.getElementById("studentBTN").style.backgroundColor= '#2DA2B8';
				var parent = document.getElementById("formContent");
				while (parent.firstChild) {
					parent.removeChild(parent.firstChild);
				}
				var y = document.createElement("INPUT");
				y.setAttribute("type", "email");
				y.setAttribute("class", "form-control");
				y.setAttribute("id", "email");
				y.setAttribute("placeholder", "Email address");
				y.setAttribute("name", "email");
				parent.appendChild(y);

				var x = document.createElement("INPUT");
				x.setAttribute("type", "password");
				x.setAttribute("class", "form-control");
				x.setAttribute("id", "password");
				x.setAttribute("placeholder", "Password");
				x.setAttribute("name", "password");
				parent.appendChild(x);

			}


		</script>

	</body>
</html>
