<!-- start the session and check the page number to be sent to the right page -->
<?php session_start(); 
	if (!isset($_SESSION['page'])){			// if the session is not set, send user to index page
		$_SESSION['page'] = 0; ?>
	<script>location.assign("./index.php")</script>	
	<?php	
	} 
	else if ($_SESSION['page'] == 1){		// if session is correct stay on this page, if not go to correct page #
	?>
	<script>location.assign("./page1.php");</script>
	<?php
	} 
	else if ($_SESSION['page'] == 2){
	?>
	<script>location.assign("./page2.php");</script>
	<?php
	}
?>
<html>
<head>
	<title>Scott Shields Project 1 - Page 3</title>
</head>
<body>

<!-- check that user made selection in all fields and validate fields from the form when they click the submit button -->
	<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$error_msg = validate_fields();
	if (count($error_msg) > 0){		// if there are any errors call display errors function
		display_error($error_msg);
		if (!(isset($_POST['cusSatisfaction']))) {
			$_POST['cusSatisfaction'] = "";
		}
		if (!(isset($_POST['cusRecommend']))) {
			$_POST['cusRecommend'] = "";
		}
		form_1($_POST['cusSatisfaction'], $_POST['cusRecommend']);
	} else {
		display_success();		// if no errors then call display success function
	}
} else {
	itemSatisfaction();
} ?>

</body>
</html>

<?php function itemSatisfaction(){ ?>
	<form method="POST">
	<?php foreach($_SESSION['purchased'] as $v) { ?>	<!-- call each item purchased by name and ask user for a rating -->
		<label>How happy are you with this new <?php echo $v; ?> on a scale of 1 (not satisfied) to 5 (very satisfied)?</label>
		<br>
			<input type="radio" name="<?php echo $v; ?>satisfaction" id ="cusSatisfaction" value="1">1</input>
			<br>
			<input type="radio" name="<?php echo $v; ?>satisfaction" id="cusSatisfaction" value="2">2</input>
			<br>
			<input type="radio" name="<?php echo $v; ?>satisfaction" id="cusSatisfaction" value="3">3</input>
			<br>
			<input type="radio" name="<?php echo $v; ?>satisfaction" id="cusSatisfaction" value="4">4</input>
			<br>
			<input type="radio" name="<?php echo $v; ?>satisfaction" id="cusSatisfaction" value="5">5</input>
			<br>

		<!-- call each item by name and get user to recommend or not -->
		<label>Would you recommend the purchase of this <?php echo $v; ?> to a friend?</label>	
		<br>
			<select name="<?php echo $v; ?>recommend" id="cusRecommend">
			<option value="0" selected disabled="disabled"></option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
			<br><br>
			<?php } ?>
			<input type="submit" value="Submit"/>
	</form>
<?php } ?>

<!-- check that all user input is entered and correct -->
<?php function validate_fields(){
	$error_msg = array();
	foreach ($_SESSION['purchased'] as $v) {	// for each item purchased ask customer for rating
		if (!isset($_POST[$v.'satisfaction'])){		// if how the user does not give a rating, send error message to error array
			$error_msg[] = "Please give a rating.";
		}

		if (!isset($_POST[$v.'recommend'])){	// if user does not pick a selection, send error message to error array
			$error_msg[] = "Please select one, Yes or No.";
		}

	} 
	return $error_msg;		// print out error message
} ?>

<!-- display a thank you message to user and present all user information in a table based on what they entered -->
<?php function display_success(){
	echo "Thank you for your time!"; ?>
	<br><br>
	<table border="1px solid black">
		<caption>Customer Survey</caption>
		<tr>
			<td>Name: </td>
			<td><?php echo $_SESSION['name'] ?></td>
		</tr>
		<tr>
			<td>Age: </td>
			<td><?php echo $_SESSION['age'] ?></td>
		</tr>
		<tr>
			<td>Student: </td>
			<td><?php echo $_SESSION['student'] ?></td>
		</tr>

	<?php foreach($_SESSION['purchased'] as $v){	// loop to go through array of what was purchased, the rating and the recommend answer
		?>
		<tr>
			<td>What you purchased: </td>
			<td><?php echo $v; ?></td>
		</tr>
		<tr>
			<td>Satisfaction Rating: </td>
			<td><?php echo $_POST[$v . 'satisfaction'][0]; ?></td>
		</tr>
		<tr>
			<td>Recommend: </td>
			<td><?php echo $_POST[$v . 'recommend']; ?></td>
		</tr>

	<?php } ?>
	</table>
<?php } ?> 

<!-- function to display each error message -->
<?php function display_error($error_msg){
	echo "<p>\n";
	foreach($error_msg as $v){		// display each error in the error array
		echo $v."<br>\n";
	}
	echo "</p>\n";
} ?>