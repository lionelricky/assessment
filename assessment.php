
<?php
//
//Insert new user into Database
//
function insert_user($update){
	// Connect to the database 
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	if (!$dbc) {
	die("Connection failed: " . mysqli_connect_error());
	}
	
	// escape variables for security
	$user_inserted = mysqli_real_escape_string($dbc, trim($_POST['user_inserted']));
	$user_modified = mysqli_real_escape_string($dbc, trim($_POST['user_modified']));
	$first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	$last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	$job_title = mysqli_real_escape_string($dbc, trim($_POST['job_title']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	$address1 = mysqli_real_escape_string($dbc, trim($_POST['address1']));
	$address2 = mysqli_real_escape_string($dbc, trim($_POST['address2']));
	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	$postal_code = mysqli_real_escape_string($dbc, trim($_POST['postal_code']));
	$province = mysqli_real_escape_string($dbc, trim($_POST['province']));
	$country = mysqli_real_escape_string($dbc, trim($_POST['country']));
	$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
	$salt = mysqli_real_escape_string($dbc, trim($_POST['salt']));
	$date_of_birth = mysqli_real_escape_string($dbc, trim($_POST['date_of_birth']));
	$disable = mysqli_real_escape_string($dbc, trim($_POST['disable']));
	$reset_password = mysqli_real_escape_string($dbc, trim($_POST['reset_password']));
	$role_id = mysqli_real_escape_string($dbc, trim($_POST['role_id']));
	
	//Check if user already registered using email
	if(!empty($_POST['email']))
	{
		// Retrieve the data from database
		$query = "SELECT email FROM users WHERE email = '$email';";
		$data = mysqli_query($dbc, $query) or die('DATABASE ERROR: ERROR VALIDATING EMAIL');
		
		if(mysqli_num_rows($data) == 0) // no match insert new user
		{
			$query = "INSERT INTO `users` (user_inserted, user_modified, first_name, last_name, job_title, email, 
			address1, address2, city, postal_code, province, country, phone, password, salt,date_of_birth, disable, 
			reset_password, role_id) VALUES ('$user_inserted','$user_modified','$first_name','$last_name','$job_title',
			'$email','$address1','$address2','$city','$postal_code','$province',$country',$phone',SHA('$password'),'$salt',
			'$date_of_birth','$disable','$reset_password','$role_id');";
			$data = mysqli_query($dbc, $query) or die ('ERROR: GETTING USER INFORMATION')
			
			//show success message
			echo('Success! New user added.')
			
		}elseif($update == true){ // user found update requested
			$query = "UPDATE users SET user_inserted='$user_inserted', user_modified='$user_modified', 
			first_name='$first_name', last_name='$last_name', job_title='$job_title', email='$email', address1='$address1', 
			address2='$address2', city='$city', postal_code='$postal_code', province='$province', country='$country', 
			phone='$phone', password=SHA('$password'), salt='$salt',date_of_birth='$date_of_birth', disable='$disable', 
			reset_password='$password', role_id='$role_id' WHERE user_id = '$user_id'";
			$data = mysqli_query($dbc, $query) or die ('ERROR: GETTING USER INFORMATION')
				
			//show success message and update user information
			echo('Success! Information updated')
		}else{ // user found ask to update instead.
				// if yes set $update = true call insert again -> this code ommitted
			echo('This email already exists, would you like to update your information instead?') 
		}
	}
	else{ //show error message if email empty
			echo('Please enter a valid email')
	}
	//close connection
	mysqli_close($dbc);
}
if(isset($_POST['submit']))
{
	$update = $_POST['update']
	insert_user($update);
}
?>	
	
	
	
<?php
//
//Update existing user
//
function update_user(){
	// Connect to the database 
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 
	if (!$dbc) {
	die("Connection failed: " . mysqli_connect_error());
	}
	// escape variables for security
	$user_inserted = mysqli_real_escape_string($dbc, trim($_POST['user_inserted']));
	$user_modified = mysqli_real_escape_string($dbc, trim($_POST['user_modified']));
	$first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	$last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	$job_title = mysqli_real_escape_string($dbc, trim($_POST['job_title']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	$address1 = mysqli_real_escape_string($dbc, trim($_POST['address1']));
	$address2 = mysqli_real_escape_string($dbc, trim($_POST['address2']));
	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	$postal_code = mysqli_real_escape_string($dbc, trim($_POST['postal_code']));
	$province = mysqli_real_escape_string($dbc, trim($_POST['province']));
	$country = mysqli_real_escape_string($dbc, trim($_POST['country']));
	$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
	$salt = mysqli_real_escape_string($dbc, trim($_POST['salt']));
	$date_of_birth = mysqli_real_escape_string($dbc, trim($_POST['date_of_birth']));
	$disable = mysqli_real_escape_string($dbc, trim($_POST['disable']));
	$reset_password = mysqli_real_escape_string($dbc, trim($_POST['reset_password']));
	$role_id = mysqli_real_escape_string($dbc, trim($_POST['role_id']));

	$query = "UPDATE users SET user_inserted='$user_inserted', user_modified='$user_modified', first_name='$first_name', 
	last_name='$last_name', job_title='$job_title', email='$email', address1='$address1', address2='$address2', city='$city', 
	postal_code='$postal_code', province='$province', country='$country', phone='$phone', password=SHA('$password'), salt='$salt',
	date_of_birth='$date_of_birth', disable='$disable', reset_password='$password', role_id='$role_id' WHERE user_id = '$user_id'";
	$data = mysqli_query($dbc, $query) or die ('ERROR: GETTING USER INFORMATION')
				
	//show success message and update user information
	echo('Success! Information updated')

	//close connection
	mysqli_close($dbc);
	}
if(isset($_POST['submit']))
{
	update_user();
}
?>



<?PHP
//
// Delete user
//
function delete_user($validate_delete){
	$user_id = $_POST['user_id'];
	
	if ($validate_delete == true){
		// Connect to the database
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
		// Look up the username and password in the database	
		$query = "DELETE FROM users WHERE user_id = '$user_id'";
		mysqli_query($dbc, $query) or die('DATABASE ERROR: Error deleting the course');
	}
	else{//ask user for confirmation
		// if yes set validate_delete=true & call delete again -> this code ommitted
		echo('are you sure you want to delete the user' .$user_id. '?')
	}
	//Close connection
	mysqli_close($dbc);
}
if(isset($_POST['user_id']))
{
	$validate_delete = $_POST['validate_delete']
	delete_user($validate_delete);
}	
?>	
	
