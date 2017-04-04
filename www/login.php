	<?php


		session_start();

	      # title
		  $page_title = "login";

		  # load db connection
		  include ('includes/db.php');

		  	# include  header
			include ('includes/header.php');

			# include function
			include ('includes/function.php');

			# cache errors
		if(array_key_exists('submit', $_POST)) {
			$errors = [];


			# validate email and password

			if(empty('email')) {
				$errors['email'] = "please enter email address";}
		
			

			if(empty('password')) {
				$errors['password'] = "please enter password";
			}

			if(empty($errors)) {
			// do database stuff
 			

				$clean = array_map('trim', $_POST);

				#login admin
				doadminlogin($conn, $clean);


			} 
			


			

		}

	?>

	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<?php 
					 //if(isset($errors['email'])){ echo '<span class="err">'. $errors['email']. '</span>';}
			//	$display = displayErrors($Errors, 'email');
				//   echo $display;
				 ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
					//if(isset($errors['password'])) { echo '<span class="err">'. $errors['password']. '</span>' ; }
				//$display = displayErrors($Errors, 'password');
			     //	echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="submit" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

	<?php
		# include footer
	     include ('includes/footer.php');
	?>
