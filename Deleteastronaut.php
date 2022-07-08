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

  <!-- Show astronaut table-->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="show-table">
  <h2>Here are the astronauts currently in the data system: </h2>

    <form method="get" action="Deleteastronaut.php">
		
		<p class="w3-opacity">Click delete button to delete a row</p>

      <table>
		
			<tr>
				<th width="150px" id="id">Astronaut ID<br><hr></th>
				<th width="250px">Astronaut Name<br><hr></th>
        <th width="250px">No. of Missions<br><hr></th>
        <th width="250px">Nationality<br><hr></th>
        <th width="250px">Gender<br><hr></th>
			</tr>
					
            <?php

                //This code is taken from: https://stackoverflow.com/questions/70714833/php-delete-button-for-every-row-change-value-in-table-for-this-row 
                //First a connection is established, ensuring that all the necessary fields (servername, username, password and dataase are specified) 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "esa";


                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                //The quary below selects all the attributes in astronaut to be shown for the specified id
                $sql = "SELECT astronaut_id, astronaut_name, no_missions, nationality, gender FROM astronaut";
                $result = $conn->query($sql);//Ensures that the query is sent to the database system via the connection made earlier


                if ($result->num_rows > 0) { //Making sure there is at least one row of data
                // output data of each row
                while($row = $result->fetch_assoc()) { //For every existing row, data in the different attributes (from the selected ones) will be fetched as an array of data 
                    echo "
                    <tr>
                    <th>{$row['astronaut_id']}</th>
                    <th>{$row['astronaut_name']}</th>
                    <th>{$row['no_missions']}</th>
                    <th>{$row['nationality']}</th>
                    <th>{$row['gender']}</th>

                    <td><a href='Deleteastronaut.php?id=" . $row["astronaut_id"] . "'>Delete</a></td>
                    </tr>";

                  }  // For each row, there is a link that deletes that row. What happends is the id (primary key) for that row is added to the end of the url and then later used
                } else {
                echo "0 results";
                }

                //Making the variable $_GET['id'] is not null and is indeed is data retrieved from the url
                if(isset($_GET['id'])) {
                    $sql = "DELETE FROM astronaut WHERE astronaut_id= '" . $_GET['id'] . "'"; //entire row for that id is deleted

                }

                if ($conn->query($sql) === TRUE) { //making sure the query has been successfully sent and there are no problems (false returns)
                      echo "Record deleted successfully";

                  } else {
                      echo "Error deleting record: " . $conn->error;
                  }
                $conn->close();
              ?>
	
	     	<hr>
        </table>
    
    </form>	
		
  </div>

	
		<hr>

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
