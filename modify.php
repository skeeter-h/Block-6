<!--HTML Template taken from https://www.w3schools.com/w3css/w3css_templates.asp and the css sheets are online -->

<html>

<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<h2>Choose what attribute you would like to change: </h2>


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
        $sql = "SELECT astronaut_id, astronaut_name, no_missions, nationality, gender FROM astronaut WHERE astronaut_id='" . $_GET['id'] ."'";
        $result = $conn->query($sql); //Ensures that the query is sent to the database system via the connection made earlier 



        if ($result->num_rows > 0) {
             //That data in that row is then brought to the front-end 
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <th>ID: {$row['astronaut_id']}</th> <br>
                    <th>Name: {$row['astronaut_name']}</th> <br>
                    <th>Number of Missions: {$row['no_missions']}</th> <br>
                    <th>Nationality: {$row['nationality']}</th> <br>
                    <th>Gender: {$row['gender']}</th>
                    </tr> <br> <br><br>";
                  }  
                } 

    ?>    
    
    <!--HTML and PHP here is similar when inserting an astronaut-->
    <!--Form is used, ideal for retrieving the data inputted by users and sending to the back-end -->
    <form method="post"> <!--This method "post" will later be used to retrieve the information inputted by the user in a secure way-->
		
            <!---->
			<label>Astronaut Name: </label>
			<input id="demo-input" type="text" name="name">
			
			<br><br>

			<label>Number of Missions: </label>
			<input type="number" name="missions">

			<br><br>

			<label>Nationality:</label>
			<input type="text" name="nationality">

			<br><br>

			<label>Gender:</label>
			<select name="gender">
				<option>Female</option>
				<option>Male</option>
				<option>Other</option>
			</select>	

			<br><br>
			
			<input type="submit" name="submit">
		
	</form>

    <?php

        //Ensure that variable is declared and not null
		if (isset($_POST['submit'])) {
		
			$name = $_POST['name']; //Each input for each section (attribute) listed is stored in a variable and then used in the query
			$missions = $_POST['missions'];
			$nat = $_POST['nationality'];
			$gender = $_POST['gender'];

					
			$sql = "UPDATE astronaut SET astronaut_name='$name', no_missions='$missions', nationality= '$nat', gender='$gender' WHERE astronaut_id='" . $_GET['id'] ."'"; 
            /**In the previous file (astronaut.php) the modify link would display the id at the end of the url
             * This can then be used in the SQL query to specify the row in which the data can be modified
            */

            //Making sure that all fields are filled
			if($name == null || $missions == null || $nat == null) {
				echo "Not all fields have been filled out ";
			} else {
				if (mysqli_query($conn, $sql) && $missions >= 0) {
			  		echo "Record changed successfully";
				}
			  else {
			  echo "Error adding record ";
			}

        }

		}
		
		$conn->close(); //Connection closed for connectivity and better security
		?>     
    
    
</body>    

</html>