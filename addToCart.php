<?php
	session_start();
	
	if(isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
	}
	else{
		$cart = array();
	}
	
	if(isset($_GET['id'])){
		$item = $_GET['id'];
		array_push($cart, $item);
	}
	
	$_SESSION['cart'] = $cart;
	
	header('Location: cart.php');
?>