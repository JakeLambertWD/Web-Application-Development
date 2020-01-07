<!DOCTYPE html>
   
<html>
	<head>
		<title>Visit Hampshire</title>
		<link rel="stylesheet" type="text/css" href="main.css">
        
        <script type='text/javascript'>
        </script>
	</head> 
    
<body>
    
    <div id="wrapper" >
        <div id="section">
            <a href="http://edward2.solent.ac.uk/~lambertj/PlacesToStay.php">Places To Stay</a>
            <H1>Visit Hampshire</H1>
            <br/><br/>
            
            <form method="get" action="curlsearch.php">
            <p>Type: </p> 
            <input type="text" name="type" /> <br/>
            <input type="submit" class ="button" value="Search!"  />
            </form>
        
            
        </div>    
        <div id="aside">
            
            <br/>
            <br />
            <H2>Book Accomodation</H2>
            <br /><br/>
            
            <?php 
            $accID = $_POST["accID"]; 
            ?>
              
            <form method="post" action="clientbooking.php">
            <?php echo "<input type='hidden' name='accID' value= '$accID' />";
            ?>
            <p>Username: </p>
            <input type="text" name="username" /> <br/>  
            <p>Password: </p>
            <input type="text" name="password" /> <br/>    
            <p>Date: DD/MM/YY  </p> 
            <input type="text" name="thedate" /> <br/>
            <p>No. of people:  </p>
            <input type="text" name="npeople" /> <br/>    
            <br />
            <input type="submit" class ="button" value="Book!"  />
            </form>
            <div id="feedback"></div>
            <?php
            
            $username = $_POST["username"];
            $password = $_POST["password"];
			
            $date = $_POST["thedate"];
            $npeople = $_POST["npeople"];
            
			$connection = curl_init();
			curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~lambertj/bookwebservice.php");
			
			$dataToPost = array("accID" => $accID,
                                "thedate" => $date,
                                "npeople" => $npeople);
			
			curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($connection,CURLOPT_USERPWD,"$username:$password");
			curl_setopt($connection,CURLOPT_POSTFIELDS,$dataToPost);
            	
            $response = curl_exec($connection);
            
            $httpCode= curl_getinfo($connection,CURLINFO_HTTP_CODE);
            
            if($httpCode == 200)
            {
                echo "<H3>Successully booked!</H3>";
            }
            else if ($httpCode == 401)
            {
                echo "<H5>Please enter your login detials correctly</H5>";
            }
            else if ($httpCode == 400)
            {
                echo "<H5>Please enter a date</H5>";
            }
            else if ($httpCode == 404)
            {
                echo "<H5>No bookings for this accomodation available</H5>";
            }
            else if ($httpCode == 413)
            {
                echo "<H5>You have too many people, try less!</H5>";
            }
            else if($httpCode == 410)
            {
                echo "<h5>Sorry no rooms available</H5>";
            }
            else if($httpCode == 406)
            {
                echo "<h5>Enter a valid date</H5>";
            }
            
            curl_close($connection);
       
            ?>
        </div>
    </div>
	
</body>
</html>			      y