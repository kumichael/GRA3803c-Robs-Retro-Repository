<?php
	session_start();
	
	if(isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$count = count($cart);	
		print "$count";
		
		if(isset($_GET['id'])){
			$item = $_GET['id'];
			
			for($i = 0; $i < $count; $i++){
				if($cart[$i] == $item){
					unset($cart[$i]);
					$cart = array_values($cart);
					break;
				}
			}
		}
		
		$_SESSION['cart'] = $cart;
	}
	
	header('Location: cart.php');
?>