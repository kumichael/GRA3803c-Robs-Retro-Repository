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
		<title>Rob's Retro Repository - Home</title>
		
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
						<li><a href = "index.php" class = "active">Home</a></li>
						<li><a href = "catalog.php">Shop</a></li>
						<li><a href = "contact.php">Contact</a></li>
						<li><a href = "about.php">About</a></li>
					</ul>
					<form action = "catalog.php" method = "GET">	
						<input type = "text" placeholder = "Search" name = "search"/>
					</form>
				</div>
			</div>
			<div id = "body">
				<div id = "featured_large">
					<div class = "featured_panel small">
						<a href = "product.php?id=5" />
							<img src = "img/featured/small_1.png" />
						</a>
					</div>
					<div class = "featured_panel small">
						<a href = "product.php?id=4" />
							<img src = "img/featured/small_2.png" />
						</a>
					</div>
					<div class = "featured_panel large">
						<div class = "overlay">
							<div class = "text">
								<p class = "sub">Give a great big welcome to</p>
								<p class = "main">Rob's Robot Friends!</p>
							</div>
						</div>
						<a href = "product.php?id=2" />
							<img src = "img/featured/large_1.png" />
						</a>
					</div>
					<div class = "featured_panel small">
						<a href = "product.php?id=6" />
							<img src = "img/featured/small_3.png" />
						</a>
					</div>
					<div class = "featured_panel small right">
						<a href = "product.php?id=3" />
							<img src = 'img/featured/small_4.png' />
						</a>
					</div>
				</div>
				<div class = "products featured">
					<div class = "product_header">
						<p>Featured Toys</p>
					</div>
					<?php
						$query = "SELECT * from toy_products WHERE featured = 1 LIMIT 10";
						$result = mysql_query($query) or die ('Error getting products');
						
						while($product = mysql_fetch_array($result)){
							$id = $product['id'];
							$name = $product['name'];
							$category = $product['category'];
							//$description = $product['description'];
							$price = $product['price'];
							$images = $product['image'];
							
							//$description_split = explode('*', $description);
							$images_split = explode('*', $images);
							
							//$description_count = count($description_split);
							//$images_count = count($images_split);
							
							
							$rating_query = "SELECT * from toy_ratings WHERE id = $id";
							$rating_result = mysql_query($rating_query) or die ('Error getting ratings');
							
							if(mysql_num_rows($rating_result) == 0){
								$round = 0;
							}
							
							else{
								$rating_total = 0;
								$rating_tally = 0;
								
								while($rating = mysql_fetch_array($rating_result)){
									$rating_number = $rating['rating'];
									$rating_total = $rating_total + $rating_number;
									$rating_tally = $rating_tally + 1;
								}
								
								$rating_average = $rating_total/$rating_tally;
								$round = ceil($rating_average);
							}
							
							$blank = 5 - $round;
							
							print "
								<div class = 'item'>
									<div class = 'product'>
										<a href = 'product.php?id=$id' />
											<img src = 'img/products/$images_split[0]' />
										</a>
									</div>
									<div class = 'name'>
										<a href = 'product.php?id=$id' />
											<strong>$name</strong>
											<p>$$price</p>
										</a>
									</div>
									<div class = 'rating'>
										<a href = 'product.php?id=$id'>
							";
							
							for($j = 0; $j < $round; $j++){
								print "<img src = 'img/star_full.png' alt = 'Star' />";
							}
							
							for($j = 0; $j < $blank; $j++){
								print "<img src = 'img/star_empty.png' alt = 'Star' />";
							}
							
							print "
										</a>
									</div>
								</div>
							";
						}
					?>
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