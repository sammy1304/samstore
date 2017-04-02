	<?php

	      # title
		  $page_title = "login";

		  # load db connection
		  include ('includes/db.php');

		  	# include  header
			include ('includes/header.php');

		if(array_key_exists('login', $_POST)) {
			$errors = [];

			if(empty($_POST['email'])) {
				$errors['email'] = "please enter email address";

			}

			if(empty($_POST['password'])) {
				$errors['password'] = "please enter password";
			}

			if(empty($rrors)) {
			// do database stuff

			} 

		}

	?>

	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<?php 
					 if(isset($errors['email'])){ echo '<span class="err">'. $errors['email']. '</span>';
					   }
				 ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php
					if(isset($errors['password'])) { echo '<span class="err">'. $errors['password']. '</span>' ; }
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

	<?php
		# include footer
	     include ('includes/footer.php');
	?>
