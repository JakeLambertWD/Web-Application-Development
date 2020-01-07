<!DOCTYPE html>
   
<html>
	<head>
		<title>Visit Hampshire</title>
		<link rel="stylesheet" type="text/css" href="main.css">
      
	</head> 
    
<body>

<?php
            
    $username = $_POST["username"];
    $password = $_POST["password"];
    $accID = $_POST["accID"];
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
    
</body>
</html>	