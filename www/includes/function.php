<?php

		# admin register
	function doAdminRegister($dbconn, $input){
		# hash the password
		$hash = password_hash($input['password'], PASSWORD_BCRYPT);

		    # insert data
		$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn,:ln,:e,:h)"); 	


			# bind params...
	    $data = [
		        ':fn'  => $input['fname'],
				 ':ln' => $input['lname'],
				 ':e'  => $input['email'],
				 ':h'  => $hash
				 ];

				 $stmt->execute($data);

	}
				# admin login
    function doadminlogin($dbconn, $input){
	
	      //INSERT DATA INTO TABLE
	     $stmt = $dbconn->prepare("SELECT* FROM admin WHERE email=:e");


	     # bind params....

	      $stmt->bindparam(":e", $input['email']);
	      $stmt->execute();
	      $count = $stmt->rowCount();
	

	   if($count == 1){
		

		      $result = $stmt->fetch(PDO::FETCH_ASSOC);

		   if(password_verify($input['password'], $result['hash'])) {
			  $_session['id'] = $result['admin_id'];	
			  $_session['admin_name'] = $result['email'];	


			  header("location:home.php");
		    }

		    else {


			 $login_error = "Invalid Username /password";

			 header("Location:login.php?login_error=$login_error");
		    }
		
	    }


    }


	    function doesEmailExist($dbconn, $email){
	    		$result = false;
	$stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:e");

	    	   # bind params....
	    	$stmt->bindParam(":e", $email);
	    	$stmt->execute();

	    	    # get number of rows returned
	    	$count = $stmt->rowcount();

	    	if($count > 0) {
	    		$result = true;
	    	}

	    	return $result;

	}


					# display errors
			function displayErrors($dummy, $name) {

						$result = "";

				if(isset($dummy[$name])) {
					$result = '<span class="err">'. $dummy[$name]. '</span>';
				}

					return $result;
			}


				# function fileupload
			function fileUploads($up){
			      $ext = ["image/jpg", "image/jpeg", "image/png"];
			    
			    # check extension....
		 	       if(!in_array($_FILES['pic']['type'], $ext)) {
			           $errors[] = "invalid file type";
			        }


				#generate random number to append
				  $rnd = rand(0000000000, 9999999999);

				#strip filename for spaces
		         $strip_name = str_replace("","_", $_FILES['pic']['name']);

		        $filename = $rnd.$strip_name;
	            $destination = 'uploads/'.$filename;

		        # check file size.....
		           if ($_FILES['pic']['size'] > MAX_FILE_SIZE) {
			           $errors[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
		         	}

		         	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)) {
			           $errors[] = "file upload failed";
			        }
		

	
		
		}
		
		


?>  