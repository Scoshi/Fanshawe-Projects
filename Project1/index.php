<!-- start the session and check the page number to be sent to the right page -->
<?php session_start();
	if (!isset($_SESSION['page'])){		// if session is not set, set it to 0/index page	
		$_SESSION['page'] = 0;	
	} 
	if ($_SESSION['page'] == 1){	// if the session number is 1, 2 or 3, send the user to the corresponding page using JS 	
	?>
	<script>location.assign("./page1.php");</script>
	<?php 
	}
	else if ($_SESSION['page'] == 2){
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
	<title>Scott Shields Project 1 - Index</title>
</head>
<body>

<h1>Thank you for your purchase!</h1>
<p>You have just purchased an electronic device from "Uncle Ray's everything must go Electronics!". Please take a moment to fill out our customer survey. Thank you for your time and business. </p>

<!-- button to move forward and start the survey -->
<form method="POST">
	<input type="submit" name="Begin" id="Begin" value="Begin">
</form>

<!-- if clicked set the session page to move to page 1 -->
<?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$_SESSION ['page'] = 1
	?>
<script>
location.assign("./page1.php");
</script>
<?php
}
?>

</body>
</html>