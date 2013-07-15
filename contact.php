<?php
	session_start();
	
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
		<title>Rob's Robot Repository - Contact</title>
		
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
						<li><a href = "catalog.php">Shop</a></li>
						<li><a href = "contact.php" class = "active">Contact</a></li>
						<li><a href = "about.php">About</a></li>
					</ul>
					<form action = "catalog.php" method = "GET">	
						<input type = "text" placeholder = "Search" name = "search"/>
					</form>
				</div>
			</div>
			<div id = "body">
				<div id = "contact">
					<div id = 'contact_text'>
						<h1>Contact Us</h1>
						<p>
							If any problems should arise with your order, feel free to contact us 
							at anytime for customer support. We are available 24/7 and will try to 
							respond to your inquiry as soon as possible.
						</p>
						
						<p>
							Please use the contact form below or feel free to write or call our 
							facilities located at:
						</p>
						
						<p id = "indent">
							Rob's Retro Repository<br />
							123 Main St. <br />
							Meyersdale, PA 15552 <br />
						</p>
						<form action = "sendForm.php" method = "POST">
							<input name = "name" type = "text" placeholder = "Name" id = "name">
							<input name = "email" type = "text" placeholder = "E-Mail" id = "email">
							<input name = "subject" type = "text" placeholder = "Subject" id = "subject">
							<textarea name = "body" id = "inquiry" placeholder = "Inquiry"></textarea>
							<input type = "submit" id = "submit_form" value = "Send it!">
						</form>
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