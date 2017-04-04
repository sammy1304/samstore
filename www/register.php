<?php

	 # title 
     $page_title = "Register";

     # load db connection
     include ('includes/db.php');

     # load functions
     include ('includes/function.php');
     
     # include header
     include ('includes/header.php');

 

     	# cache errors
    if(array_key_exists('register', $_POST)) {
    	$errors = [];

     	# validate first name
     	if(empty($_POST['fname'])) {
     		$errors['fname'] = "please enter a first name";
     	}

     	if(empty($_POST['lname'])) {
     		$errors['lname'] = "please enter a last name";
     	}

     	if(empty($_POST['email'])) {
     		$errors['email'] = "please enter an email";
     	}

     	if(doesEmailExist($conn, $_POST['email'])) {
     		$errors['email'] = "email already exists";
     	}

     	if(empty($_POST['password'])) {
     		$errors['password'] = "please enter a password";
     	}

     	if($_POST['password'] != $_POST['pword']) {
     		$errors['pword'] = "please enter password again/passwords do not match";
     	}

     	if(empty($errors)) {
     		// do database stuff

     		# eliminate unwanted spaces from values in the $_POST array
     		$clean = array_map('trim', $_POST);
     		
     		# register admin
     		doAdminRegister($conn,$clean);

     	 /*	# hash the password
			$hash = password_hash($clean['password'], PASSWORD_BCRYPT);   

			# insert data(
						$stmt = $conn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)"); 

			# bind params....
			$data = [
			    ':fn' => $clean['fname'],
			    ':ln' => $clean['lname'],
			    ':e'  => $clean['email'],
			    ':h'  => $hash

			];

			$stmt->execute($data);*/

     	}

    }	
?>

<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php
					 //if(isset($errors['fname'])) { echo '<span class="err">'. $errors['fname']. '</span>'; }
					 $display = displayErrors($errors, 'fname');
					 echo $display;					
				?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
			    <?php
				   // if(isset($errors['lname'])) { echo '<span class="err">'. $errors['lname']. '</span>'; }
			    $display = displayErrors($errors, 'lname');
			    echo $display;
				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
			    <?php
				    // if(isset($errors['email'])) { echo '<span class="err">'.$errors['email']. '</span>'; }

			    $display = displayErrors($errors, 'email');
			     echo $display;
			    ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
			    <?php 
			     	 //  if(isset($errors['password'])) { echo '<span class="err">'. $errors['password']. '</span>'; }

			    $display = displayErrors($errors, 'password');
			      echo $display;
			    ?>

				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>

			     <?php 
			          //if (isset($errors['pword'])) { echo '<span class="err">'. $errors['pword'].'</span>'; }
			     $display = displayErrors($errors, 'pword');
			        echo $display;
			     ?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
	</div>

	<?php
		 # include footer
	     include  ('includes/footer.php');

	?>
