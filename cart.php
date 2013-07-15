<?php
	session_start();
	include_once("connection.php");
	
	if(isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart_count = count($cart);
	}
	else{
		$cart_count = 0;
	}
?>

<html>
	<head>
		<title>Rob's Retro Repository - Cart</title>
		
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link href='http://fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
	</head>
		
	<body>
		<div id = "container">
			<div id = "header">
				<div id = "background">
					<div id = "logo">
						<a href = "index.php">
							<img src = "img/logo.png" alt = "Rob's Retro Repository" />
						</a>
					</div>
					<div id = "title">
						<a href = "index.php">
							<img src = "img/title.png" alt = "Rob's Retro Repository" />
						</a>
						<div id = "cart">
							<a href = "cart.php">
								<img src = "img/cart.png" alt = "Shopping Cart" />Shopping Cart (<?php print "$cart_count"; ?>)
							</a>
						</div>
					</div>
				</div>
				<div id = "navi">
					<ul>
						<li><a href = "index.php">Home</a></li>
						<li><a href = "catalog.php" class = "active">Shop</a></li>
						<li><a href = "contact.php">Contact</a></li>
						<li><a href = "about.php">About</a></li>
					</ul>
					<form action = "catalog.php" method = "GET">	
						<input type = "text" placeholder = "Search" name = "search"/>
					</form>
				</div>
			</div>
			<div id = "body">
				<div id = "cart_display">
					<?php
						if(isset($cart)){
							$total_price = 0;
							
							for($i = 0; $i < $cart_count; $i++){
								$query = "SELECT * from toy_products WHERE id = $cart[$i]";
								$result = mysql_query($query) or die ('Error getting products');
								while($product = mysql_fetch_array($result)){
									$id = $product['id'];
									$name = $product['name'];
									$images = $product['image'];
									$manufacturer = $product['manufacturer'];
									$price = $product['price'];
									
									$images_split = explode('*', $images);
									
									print "
										<div class = 'cart_item'>
											<div class = 'cart_image'>
												<img src = 'img/products/$images_split[0]' />
											</div>
											<div class = 'cart_name'>
												$name
												<p>$manufacturer</p>
											</div>
											<div class = 'cart_price'>
												<strong>$$price</strong> <p>+ ($5.99 S&H)</p>
												<a href = 'removeFromCart.php?id=$id'>Delete</a>
											</div>
										</div>
									";
									
									$total_price = $total_price + $price + 5.99;
								}
							}
							$total_split = explode('.', $total_price);
							$decimal_count = strlen($total_split[1]);
							
							if($decimal_count == 1){
								$total_price = "$total_price"."0";
							}
						}
						else{
						}
					?>
					<div class = 'cart_item'>
						<div class = 'cart_price'>
							<strong>Total:</strong> $
								<?php 
									if(isset($_SESSION['cart'])){
										print "$total_price";
									}
									else{
										print "0.00";
									}
								?>
						</div>
					</div>					
				</div>
				<div id = "categories">
					<div id = "top">
						<div class = "category">
							<div class = "overlay">
								<div class = "text">
									<p class = "main">Robots</p>
								</div>
							</div>
							<a href = "catalog.php?category=Robots">
								<img src = "img/categories/category_1.png" />
							</a>
						</div>
						<div class = "category right">
							<div class = "overlay">
								<div class = "text">
									<p class = "main">Trains</p>
								</div>
							</div>
							<a href = "catalog.php?category=Trains">
								<img src = "img/categories/category_2.png" />
							</a>
						</div>
					</div>
					<div id = "bottom">
						<div class = "category">
							<div class = "overlay">
								<div class = "text">
									<p class = "main">Boats</p>
								</div>
							</div>
							<a href = "catalog.php?category=Boats">
								<img src = "img/categories/category_3.png" />
							</a>
						</div>
						<div class = "category right">
							<div class = "overlay">
								<div class = "text">
									<p class = "main">Misc.</p>
								</div>
							</div>
							<a href = "catalog.php?category=Misc">
								<img src = "img/categories/category_4.png" />
							</a>
						</div>
					</div>
				</div>
				<div id = "footer">
					<div id = "bar"></div>
					<div id = "footer_links">
						<div class = "bar">
							Sitemap
							<ul>
								<li><a href = "index.php">Home</a></li>
								<li><a href = "catalog.php">Shop</a></li>
								<li><a href = "contact.php">Contact</a></li>
								<li><a href = "about.php">About</a></li>
							</ul>
						</div>
						<div class = "bar last">
							<a href = "catalog.php" id = "black">Shop</a>
							<ul>
								<li><a href = "catalog.php?category=Robots">Robots</li>
								<li><a href = "catalog.php?category=Trains">Trains</li>
								<li><a href = "catalog.php?category=Boats">Boats</li>
								<li><a href = "catalog.php?category=Misc">Misc.</a></li>
							</ul>
						</div>
					</div>
					<div id = "foot"><a href = "about.php">Copyright &copy; Rob's Retro Repository 2012</a></div>
				</div>
			</div>
		</div>
		
	</body>
</html>