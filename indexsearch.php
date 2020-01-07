<!DOCTYPE html>
   
<html>
	<head>
		<title>Visit Hampshire</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>

<body>
<?php
           
    $type = $_GET["type"];   

    $connection = curl_init();

    curl_setopt($connection, CURLOPT_URL, "http://edward2.solent.ac.uk/~lambertj/searchwebservice.php?location=Hampshire&type=$type");

    curl_setopt($connection,CURLOPT_RETURNTRANSFER,1);

    curl_setopt($connection,CURLOPT_USERPWD,"$username:$password");    

    $response = curl_exec($connection);

    $httpCode = curl_getinfo($connection,CURLINFO_HTTP_CODE);

    curl_close($connection);

    if($type == "")
    {
        echo "<H2>Input required</H2>";
    }

    else if($httpCode == 200) 
    {
        echo "<H4>You have searched for: $type</H4>";
        echo "<br/>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th><br/>";
        echo "<th>Type</th><br/>";
        echo "<th>Location</th><br/>";
        echo "<th>Longitude</th><br/>";
        echo "<th>Latitude</th><br/>";
        echo "<th>Description</th><br/>";
        echo "</tr>";
        $data = json_decode($response, true);
        for($i=0; $i<count($data); $i++)
        {
            echo  "<tr>";
            echo  "<td>" . $data[$i]["name"] . "</td>";
            echo  "<td>" . $data[$i]["type"] . "</td>";
            echo "<td>" . $data[$i]["location"] . "</td>";
            echo  "<td>" . $data[$i]["longitude"] . "</td>";
            echo  "<td>" . $data[$i]["latitude"] . "</td>";
            echo  "<td>" . $data[$i]["description"] . "</td>"; 
            echo "</tr>";					  
        } 
        echo "</table>";
    } 
    else if ($httpCode == 400) 
    {
        echo "<H2>Please Enter your Type of Accomodation</H2>";
    }    
    else if ($httpCode == 404)    
    {
        echo "<H2>Type of accomodation doesn't exist</H2>";
    }
                
?>
    
</body>
</html>    