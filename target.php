<!--HTML Template taken from https://www.w3schools.com/w3css/w3css_templates.asp and the css sheets are online-->

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


<!-- Navbar: easy navigation across the different webpages -->
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

  <!-- Show target table-->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="show-table">
  <h2>Here are the targets currently in the data system: </h2>
		<hr>

	
		<table>

            <tr> <!--Each attribute is presented as a column and the table tag is used to appropriately structur-->
                <th width="150px">Target ID<br><hr></th>
                <th width="250px">Target Name<br><hr></th>
                <th width="250px">First Mission<br><hr></th>
                <th width="250px">Target Type<br><hr></th>
                <th width="250px">No. Missions<br><hr></th>
                <th width="250px">Target Aim<br><hr></th>

			</tr>

            <?php
		
            //This code is taken from: https://stackoverflow.com/questions/70714833/php-delete-button-for-every-row-change-value-in-table-for-this-row  
                
             //First a connection is established, ensuring that all the necessary fields (servername, username, password and dataase are specified)
                $servername = "localhost"; //several variables are made to store the data for each necessary field
                $username = "root";
                $password = "";
                $dbname = "esa";


                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error); //Incase the connection has failed, a message is shown and the script is stopped
                }



                $sql = "SELECT target_id, target_name, first_mission, target_type, no_missions, target_aim FROM target"; 
                $result = $conn->query($sql); //Ensures that the query is sent to the database system via the connection made earlier 



                if ($result->num_rows > 0) { //Provided that the result of query is not empty...
                // output data of each row
                while($row = $result->fetch_assoc()) { //For every existing row, data in the different attributes (from the selected ones) will be fetched as an array of data 
                    echo " 
                    <tr>
                    <th>{$row['target_id']}</th>
                    <th>{$row['target_name']}</th>
                    <th>{$row['first_mission']}</th>
                    <th>{$row['target_type']}</th>
                    <th>{$row['no_missions']}</th>
                    <th>{$row['target_aim']}</th>
                    ";
                    
                } //Then each piece of data will be added to the columns of the table specified earlier (front-end), each of these attributes will create rows of data 
                //For every row fetched and displayed, a link is displayed that enables the user to modify data from that row via id (primary key)
                //When modify is clicked, the id is added at the end of the url, it can then be used later to retrive (via GET) data
                } else {
                echo "0 results"; 
              }

              $conn->close(); //Connection to the database is closed, by doing this perfromance is improved
              ?>

            </table>    
		<hr>
  </div>




  <!-- EDIT TABLE -->
  <div class="w3-black" id="edit">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
      <h2 class="w3-wide w3-center">EDIT</h2>

      <!--Each card is a link that allows you to eithr modify, delete or insert data-->
      <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>Add a new target to the database</b></p>
            <button class="w3-button w3-black w3-margin-bottom" onclick="window.location.href='#show-table'">MODIFY</button>
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>Delete an existing target from the database</b></p>
            <button class="w3-button w3-black w3-margin-bottom" onclick="window.location.href='Deletetarget.php'">DELETE</button> 
          </div>
        </div>
        <div class="w3-third w3-margin-bottom">
          <div class="w3-container w3-white">
            <p><b>Edit the details of an existing target</b></p>
            <button class="w3-button w3-black w3-margin-bottom" onclick="window.location.href='Addtarget.php'">INSERT</button> 
          </div>
        </div>
      </div>
    </div>
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

</body>
</html>
