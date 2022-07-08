<!--HTML Template taken from https://www.w3schools.com/w3css/w3css_templates.asp-->

<!DOCTYPE html>
<html lang="en">
<head>
<title>ESA</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}

</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"></i></a>
    <a href="index.html" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">MISSION <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="mission.php" class="w3-bar-item w3-button">See Our Missions</a>
        <a href="Addmission.php" class="w3-bar-item w3-button">Insert</a>
        <a href="Deletemission.php" class="w3-bar-item w3-button">Delete</a>
      </div>
    </div>

    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">ASTRONAUT <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="astronaut.php" class="w3-bar-item w3-button">See Our Astronauts</a>
        <a href="Addastronaut.php" class="w3-bar-item w3-button">Insert</a>
        <a href="Deleteastronaut.php" class="w3-bar-item w3-button">Delete</a>
      </div>
    </div>

    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">TARGET <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="target.php" class="w3-bar-item w3-button">See Our Targets</a>
        <a href="Addtarget.php" class="w3-bar-item w3-button">Insert</a>
        <a href="Deletetarget.php" class="w3-bar-item w3-button">Delete</a>
      </div>
    </div>
  </div>
</div>


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

		
<h2>Please Add a New Mission to the Database: </h2>
		
		<?php
		
		//Connection made
		$link = mysqli_connect("localhost", "root", "", "esa");
		// Check connection
		if ($link === false) { //Error message if unsuccessful
			die("Connection failed: ");
		}
		?>
	
		<hr>
		
		<!--Form tag is ideal to use for submitting	data to webserver for processing-->
		<form method="post" action="Addmission.php"  >
		
			<!--Input sections for each section with a given name that can later be used to obtain the data inputted by the user-->
			<label>Astronaut: </label> <!--use php in select tag to show the existing astronauts-->
            <select name="astronaut">
				<?php
				$sql = mysqli_query($link, "SELECT astronaut_id, astronaut_name FROM astronaut");
				while ($row = $sql->fetch_assoc()){
				echo "<option value='{$row['astronaut_id']}'>{$row['astronaut_name']}</option>";
				}
				?>
			</select>

            <br><br>

            <label>Target: </label> <!--use php in select tag to show the existing targets-->
            <select name="target">
				<?php
				$sql = mysqli_query($link, "SELECT target_id, target_name FROM target");
				while ($row = $sql->fetch_assoc()){
				echo "<option value='{$row['target_id']}'>{$row['target_name']}</option>";
				}
				?>
			</select>	
			
			<br><br>

			<label>Mission Name: </label>
			<input type="text" name="name">

			<br><br>

			<label>Destination:</label>
			<input type="text" name="dest">

			<br><br>

			<label>Launch Date:</label>
			<input type="date" name="date">	

			<br><br>

            <label>Mission Type:</label>
			<input type="text" name="type">	

			<br><br>

            <label>Mission Aim:</label>
			<input type="text" name="aim">	

			<br><br>

            <label>Crew Size:</label>
			<input type="number" name="size">	

			<br><br>

            <label>Mission Life (Years)</label>
			<input type="number" name="life">	

			<br><br>

            <label>Mission Site:</label>
			<input type="text" name="site">	

			<br><br>

            <label>Launcher:</label>
			<input type="text" name="launcher">	

			<br><br>

            <label>Prime Contractor:</label>
			<input type="text" name="contract">	

			<br><br>
         

			
			<!--The submit button will submit all the inputted data to the back-end-->
			<input type="submit" name="submit">
		
		</form>
		
		<?php

		//Making sure that data is not null		
		if (isset($_POST['submit'])) {
		
			$astronaut = $_POST['astronaut']; //Store in variables dor ater use
			$target = $_POST['target'];
			$name = $_POST['name'];
			$destination = $_POST['dest'];
            $date = $_POST['date'];
            $type = $_POST['type'];
            $aim = $_POST['aim'];
            $size = $_POST['size'];
            $life = $_POST['life'];
            $site = $_POST['site'];
            $launcher = $_POST['launcher'];
            $contract = $_POST['contract'];



					
			$sql = "INSERT INTO mission (astronaut_id, target_id, mission_name, destination, launch_date, mission_type, mission_aim, crew_size, mission_life, mission_site, launcher, prime_contractor) 
            VALUES ('$astronaut', '$target','$name','$destination', '$date','$type','$aim', '$size', '$life', '$site', '$launcher', '$contract')";
			//Query to insert the specified data in each attribute

			if($name == null || $destination == null || $date == null || $type == null || $aim == null || $size == null || $life == null || $site = null || $launcher == null 
            || $contract == null ) { //Making sure that all fields have been filled out so as not to submit unfilled data
				echo "Not all fields have been filled out ";
			} else {
				if (mysqli_query($link, $sql)) {  //If query has been succesfully sent then a message will appear
			  		echo "New record created successfully";
				}
			  else {
			  echo "Error adding record ";
			}

		}

		}
		
		
		
		$link->close(); //Make sure to close connection otherwise it may keep running
		?>
	
		<hr>
	
</div>

  
<!-- End Page Content -->
</div>


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p class="w3-medium"><a href="index.html">EUROPEAN SPACE AGENCY</a>
  </p>
</footer>

<script>


//Code to stop automatic submission upon refresh found at: https://www.webtrickshome.com/forum/how-to-stop-form-resubmission-on-page-refresh 
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}


if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST'){
 $data = // processing codes here
 unset $data;
}


</script>

</body>
</html>
