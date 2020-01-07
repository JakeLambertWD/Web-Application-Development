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
                echo "<H5>Input required</H5>";
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
                    echo "<td><a href='bookingform.php?ID=" . $data[$i]["ID"] . "'>Book</a><br>"; 
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
            
        </div>
    </div>
	
</body>
</html>			      