<?php
	session_start();
	include_once("connection.php");
	
	if(isset($_GET['id']) && isset($_GET['rating'])){
		$id = $_GET['id'];
		$rating = $_GET['rating'];
		
		$query = "INSERT INTO toy_ratings (id, rating) VALUES ('$id', '$rating');";
		$result = mysql_query($query) or die ('Error sending rating');
		
		header("Location: product.php?id=$id");
	}
?>