<!DOCTYPE html>
   
<html>
	<head>
		<title>Places To Stay</title>
        
		<link rel="stylesheet" type="text/css" href="main.css">
        <script type='text/javascript' src='http://www.free-map.org.uk/osmuk/jslib/leaflet.js'></script>
        <link rel='stylesheet' type='text/css' href='http://www.free-map.org.uk/osmuk/jslib/leaflet.css' />
        <script type='text/javascript' src="main.js">
        </script>
	</head> 
    
<body onload="init()">  
    <div id="wrapper" >
        <br>
        <H4>Places To Stay</H4>
        <div id="section">
            <a href="http://edward.solent.ac.uk/~lambertj/VisitHampshire.php">Visit Hampshire</a>
            <br><H1>Search for Accomodation</H1>
            <br/>
            <form id="searchForm">
                 
                <input type="text" placeholder="Location to stay" id="location" /> <br/>
                 
                <input type="text" placeholder="Type of accomodation" id="type" /> <br/>
                <input type="button" class="button" id="searchButton" value="Search">
                <div id="feedback"></div>
            </form>
        </div>
        
        <div id="aside">
          
        </div> 
        
        <div id="section2" >
            <div id="map1" style="width:100%; height:100%"> </div> 
        </div>
        
        <div id="bookform">
                
                <form id="markerBook">
                <H1>Book</H1>
                <input type="text" placeholder="Username" id="username"><br>
                <input type="text" placeholder="Password" id="password"><br>
                <input type="text" placeholder="No. of people" id="npeople"><br>
                <input type="text" placeholder="180401 - 180402 - 180403" id="thedate"><br>
                <input type="hidden" id="accID">
                <input type="button" class="button" id="bookBtn" value="Book place">
                    
        </form>
            
        </div>
        <div id="remove"></div>
        </div>
	
</body>
</html>			      