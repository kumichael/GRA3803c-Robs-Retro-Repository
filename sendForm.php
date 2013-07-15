<?php
	session_start();
	
	if(isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart_count = count($cart);
	}
	else{
		$cart_count = 0;
	}
	
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['body'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$body = $_POST['body'];
		
		if($name == '' || $email == '' || $body == '' || $subject == ''){
			$pass = false;
		}
		else{
			$pass = true;
		}
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
						<?php
							if($pass == false){
								print "
									<h1>There seems to have been a problem...</h1>
									<p>
										There was something missing in at least of of the fields 
										in the form you sent. Please go back and try again.
										<br /><br />
										<a href= 'contact.php'>Back to Contact Form Page</a>										
									</p>
								";
							}

							else{
								print "
									<h1>Form Submitted!</h1>
									<p>
										We got your letter! Thanks for taking your time to 
										contact us. We will get back to you within the next 
										48 hours so keep your eyes open for the e-mail!
										<br /><br />
										<a href= 'catalog.php'>Get back to shopping!</a>										
									</p>
								";
							}
						?>
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