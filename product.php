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
	
	if(!isset($_GET['id'])){
		header('Location: catalog.php');
	}
	else{
		$product = $_GET['id'];
	}
?>

<html>
	<head>
		<title>Rob's Robot Repository - Product</title>
				
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/fancybox.css"/>
		<link href='http://fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/styles.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/fancybox.pack.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
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
				<div id = "product">
					<?php
						$query = "SELECT * from toy_products WHERE id = $product";
						$result = mysql_query($query) or die ('Error getting products');
						
						while($product = mysql_fetch_array($result)){
							$id = $product['id'];
							$name = $product['name'];
							$category = $product['category'];
							$description = $product['description'];
							$long_description = $product['long_description'];
							$manufacturer = $product['manufacturer'];
							$country = $product['country'];
							$images = $product['image'];
							$price = $product['price'];
							
							$description_split = explode('*', $description);
							$images_split = explode('*', $images);
							
							$description_count = count($description_split);
							$images_count = count($images_split);
							
							
							$rating_query = "SELECT * from toy_ratings WHERE id = $id";
							$rating_result = mysql_query($rating_query) or die ('Error getting ratings');
					
							if(mysql_num_rows($rating_result) == 0){
								$round = 0;
								$rating_total = 0;
								$rating_tally = 0;
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
								<div id = 'breadcrumbs'>
									<ul>
										<li><a href = 'catalog.php'>Catalog</a></li>
										<li> > </li>
										<li><a href = 'catalog.php?category=Robots'>$category</a></li>
										<li> > </li>
										<li><a href = 'product.php?id=$id'>$name</a></li>
									</ul>
								</div>
								<div id = 'images'>
									<div id = 'main'>
										<a href = '' />
											<a class = 'fancybox' rel = 'gallery' href = 'img/products/$images_split[0]' title = '$name - Image 1 of $images_count' ><img src = 'img/products/$images_split[0]' alt = '$name' /></a>
										</a>
									</div>
							";	
								
							if($images_count > 1){
								print "<div class = 'minor'>";
								
								for($j = 1; $j < $images_count; $j++){
									$k = $j + 1;
									print"
										<div class = 'thumb'>
											<a href = '' />
												<a class = 'fancybox' rel = 'gallery' href = 'img/products/$images_split[$j]' title = '$name - Image $k of $images_count' ><img src = 'img/products/$images_split[$j]' alt = '$name' /></a>
											</a>
										</div>
									";
								}
								
								print "</div>";
							}
							
							print "
								</div>
								<div id = 'title'>
									<h1>$name</h1>
									<p>by</p>
									<h2>$manufacturer</h2>
								</div>
								<div id = 'rating'>
							";
							
							for($j = 0; $j < $round; $j++){
								print "<img src = 'img/star_full.png' alt = 'Star' />";
							}
							
							for($j = 0; $j < $blank; $j++){
								print "<img src = 'img/star_empty.png' alt = 'Star' />";
							}
							
							if($rating_tally == 1){
								print " ($rating_tally rating)";
							}
							
							else{
								print " ($rating_tally ratings)";
							}
							
							print "
								<div id = 'rate'>
									<form action = 'rateProduct.php?id=$id' method = 'GET'>
										<input type = 'hidden' value = '$id' name = 'id'></input>
										<select name = 'rating'>
											<option value = '5'>5 stars</option>
											<option value = '4'>4 stars</option>
											<option value = '3'>3 stars</option>
											<option value = '2'>2 stars</option>
											<option value = '1'>1 stars</option>
										</select> 
										<input type = 'submit' value = 'Rate Me!'></input> 
									</form>
								</div>
								</div>						
								<div id = 'description'>
									<div id = 'price_container'>
										<div id = 'price'>
											Price: 
											<p><strong>$$price</strong> + ($5.99 S&H)</p>
										</div>
										<div id = 'cart_button'>
											<a href = 'addToCart.php?id=$id'>Add to Cart</a>
										</div>
									</div>
									<ul>
										<li>Made in $country</li>
							";
							
							for($i = 0; $i < $description_count; $i++){
								print "
									<li>$description_split[$i]</li>
								";
							}
							
							print "
									</ul>
								</div>
								<div id = 'long_description'>
									<p>
										$long_description
									</p>
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