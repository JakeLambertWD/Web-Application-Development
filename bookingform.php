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
            $id = $_GET["ID"]; 
            ?>
              
            <form method="post" action="clientbooking.php">
            <?php echo "<input type='hidden' name='accID' value= '$id' />";
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
        </div>
    </div>
	
</body>
</html>			      