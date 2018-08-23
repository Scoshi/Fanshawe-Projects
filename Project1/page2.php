<!-- start the session and check the page number to be sent to the right page -->
<?php session_start(); 
	if (!isset($_SESSION['page'])){		// if the session is not set, send user to index page
		$_SESSION['page'] = 0; ?>
	<script>location.assign("./index.php")</script>	
	<?php	
	} 
	else if ($_SESSION['page'] == 1){	// if session is correct stay on this page, if not go to correct page #
	?>
	<script>location.assign("./page1.php");</script>
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
	<title>Scott Shields Project 1 - Page 2</title>
</head>
<body>

<!-- check that user made selection in all fields and validate fields from the form when they click the submit button -->
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$error_msg = validate_fields();
	if (count($error_msg) > 0){		// if there are any errors call display errors function
		display_error($error_msg);	 
		if (!(isset($_POST['howPurchased']))) {
			$_POST['howPurchased'] = "";
		}
		if (!(isset($_POST['purchased']))) {
			$_POST['purchased'] = "";
		}
		form_1($_POST['howPurchased'], $_POST['purchased']);
	} else {
		display_success();		// if no errors then call display success function
	}
} else {
	form_1("", "");
} ?>

</body>
</html>

<!-- form for user inputs -->
<?php function form_1($showPurchased, $purchased){ ?>
	<form method="POST">
		<label>How did you complete your purchase?</label>
		<br>
			<input type="radio" name="howPurchased" id ="howPurchased" value="online">Online</input>
			<br>
			<input type="radio" name="howPurchased" id="howPurchased" value="byPhone">By Phone</input>
			<br>
			<input type="radio" name="howPurchased" id="howPurchased" value="mobileApp">Mobile App</input>
			<br>
			<input type="radio" name="howPurchased" id="howPurchased" value="inStore">In Store</input>
			<br>

		<label>Which of the following did you purchase?</label>
		<br>
			<input type="checkbox" name="purchased[]" id="purchased" value="phone">Phone</input>
			<br>
			<input type="checkbox" name="purchased[]" id="purchased" value="smartTv">Smart TV</input>
			<br>
			<input type="checkbox" name="purchased[]" id="purchased" value="laptop">Laptop</input>
			<br>
			<input type="checkbox" name="purchased[]" id="purchased" value="tablet">Tablet</input>
			<br>
			<input type="checkbox" name="purchased[]" id="purchased" value="homeTheater">Home Theater</input>
			<br><br>
			<input type="submit" value="Submit"/>
	</form>
<?php } ?>

<!-- check that user has selected in all fields -->
<?php function validate_fields(){
	$error_msg = array();
	if (!isset($_POST['howPurchased'])){	// if how they purchased is not selected send error message to error array
		$error_msg[] = "Please select how you made your purchase.";
	} 

	if (!isset($_POST['purchased'])){		// if no item/items are selected send error message to error array
		$error_msg[] = "Please select at least one item.";
	}

	return $error_msg;		// print out error message
} ?>

<!-- When all user selections are valid save them, and go to the next page -->
<?php function display_success(){ 
	$_SESSION['page'] = 3;
	$_SESSION['purchased'] = $_POST['purchased']
	?>
<script>
location.assign("./page3.php");		// go to page 3
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