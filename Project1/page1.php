<!-- start the session and check the page number to be sent to the right page -->
<?php session_start(); 
	if (!isset($_SESSION['page'])){		// if the session is not set, send user to index page	
		$_SESSION['page'] = 0; ?>
	<script>location.assign("./index.php")</script>	
	<?php 
	} 
	else if ($_SESSION['page'] == 2){	// if session is correct stay on this page, if not go to correct page #
	?>
	<script>location.assign("./page2.php");</script>
	<?php
	} 
	else if ($_SESSION['page'] == 3){
	?>
	<script>location.assign("./page3.php");</script>
	<?php
	}
?>

<html>
<head>
	<title>Scott Shields Project 1 - Page 1</title>
</head>
<body>

<!-- check for user input and validate fields from the form when they click the submit button -->
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$error_msg = validate_fields();
	if (count($error_msg) > 0){		// if there are any errors call display errors function
		display_error($error_msg);
		form_1($_POST['name'], $_POST['age'], $_POST['student']);
	} else {
		display_success();	// if no errors then call display success function
	}
} else {
	form_1("", "", "");
} ?>

</body>
</html>

<!-- form for user inputs -->
<?php function form_1($name, $age, $student){ ?>
	<form method="POST">
		<label for="name">Name</label>
		<input type="text" size="20" maxlength="50" id ="name" name="name" value="<?php echo $name; ?>"></input><br>
		<br>
		<label for="age">Age</label>
		<input type="text" size="20" maxlength="3" id ="age" name="age" value="<?php echo $age; ?>"></input><br>
		<br>
		<label for="student">Are you a student?</label>
		<select name="student" id="student" value="<?php echo $student; ?>">
			<option value="0" selected disabled="disabled"></option>
			<option value="Yes, Full Time">Yes, Full Time</option>
			<option value="Yes, Part Time">Yes, Part Time</option>
			<option value="No">No</option>
		</select>
		<br>
		<br>
		<input type="submit" value="Submit"/>
	</form>
<?php } ?>

<!-- check that all user input is entered and correct -->
<?php function validate_fields(){
	$error_msg = array();
	if (!isset($_POST['name'])){	// if name is not set, send error message to error array		
		$error_msg[] = "Name field not defined";
	} else if (isset($_POST['name'])){	// if name is set, strip any white spaces away
		$name = trim($_POST['name']);
		if (empty($name)){		// if name is empty, send error message to error array
			$error_msg[] = "The name field is empty.";
		} else {
			if (strlen($name) >  50){	// if name is to many characters, send error message to error array
				$error_msg[] = "The name field contains too many characters";
			}
		}
	}
	if (!isset($_POST['age'])){
		$error_msg[] = "Age field not defined";
	} else if (isset($_POST['age'])){
		$age = trim($_POST['age']);
		if (empty($age)){
			$error_msg[] = "The age field is empty.";
		} else {
			if (strlen($age) >  3){
				$error_msg[] = "The age field contains too many characters";
			}
		}
	}
	if (!isset($_POST['student'])){
		$error_msg[] = "Student field not defined. Please select one.";
		$_POST['student'] = "";
	}
	return $error_msg;		// print out error message
} ?>

<!-- function for when all user inputs are valid to save them, and go to the next page -->
<?php function display_success(){ 
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['age'] = $_POST['age'];
	$_SESSION['student'] = $_POST['student'];
	$_SESSION['page'] = 2;		// change session page to page 2
	?>
<script>
location.assign("./page2.php");		// go to page 2
</script>
 
<?php } ?>

<!-- function to display each error message -->
<?php function display_error($error_msg){
	echo "<p>\n";
	foreach($error_msg as $v){		// display each error in the error array  		
		echo $v."<br>\n";
	}
	echo "</p>\n";
} ?>

