<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>File upload</title>
</head>
<body>
	<?php
	$dbh = new PDO("mysql:host=localhost;dbname=mydata", "root", "");
	if(isset($_POST['btn']))
	{
		$name = $_FILES['myfile']['name'];
		$type = $_FILES['myfile']['type'];
		$data = file_get_contents($_FILES['myfile']['tmp_name']);
		$stmt = $dbh->prepare("insert into file values('',?,?,?)");
		$stmt->bindParam(1,$name);
		$stmt->bindParam(2,$type);
		$stmt->bindParam(3,$data);
		$stmt->execute();
	}
	?>
	<form method="post" enctype="multipart/form-data">
	  <input type="file" name="myfile"/>
	  <button name="btn">upload</button>
	</form>
	<p></p>
	<ol>
	<?php
	$stat = $dbh->prepare("select * from file");
	$stat->execute();
	while($row = $stat->fetch()){
		echo "<li><a target='_blank' href='view.php?id=".$row['id']."'>".$row['name']."</a> </li>";
	}
	?>
	</ol>
</body>
</html>