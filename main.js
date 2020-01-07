var map;
function init()
{
    map = L.map ("map1");
    var attrib="Map data copyright OpenStreetMap contributors, Open Database Licence";
    L.tileLayer
        ("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            { attribution: attrib } ).addTo(map);
    map.setView([50.908,-1.4], 13);
    
    document.getElementById("searchButton").addEventListener("click", ajaxsearch);
    document.getElementById("bookBtn").addEventListener("click", bookAcc);
    
}
            
     
function ajaxsearch()
{
    var xhr2 = new XMLHttpRequest();
    xhr2.addEventListener ("load", (e) =>
    {
        if (e.target.status == 400)
        {
            document.getElementById('feedback').innerHTML = "<h5>Input required</H5>";
            document.getElementById('aside').innerHTML = "";
        }
        else if (e.target.status == 404)
        {
            document.getElementById('feedback').innerHTML = "<h5>Location or Type does not exist</H5>";
            document.getElementById('aside').innerHTML = "";
        }
        else
        {
            document.getElementById('remove').innerHTML = "";
            document.getElementById('feedback').innerHTML = "";
            var output = "<table><tr><th>Name</th><th>Type</th><th>Location</th><th>Description</th>"; 
            var array = [];
            var data = JSON.parse(e.target.responseText);
            
            for(var i=0; i<data.length; i++) 
            {
                output = output + '<tr><td>' + data[i].name + '</td><td>' + data[i].type + '</td><td>' + data[i].location + '</td><td>' + data[i].description + '</td></tr>';
                
                var accID = data[i].ID;
                
                // Set marker
                var latlon = [data[i].latitude, data[i].longitude];
                var marker = L.marker(latlon).addTo(map);
                array.push(marker);
                map.setView(latlon, 10);
                
                
                var p = document.createElement("p");
                var text = document.createTextNode(data[i].name + ' + ' +  data[i].type + ' + ' + data[i].location  + ' + ' + data[i].description) 
                p.appendChild(text);
                
                var el = document.createElement("a");
                
                var textNode = document.createTextNode("Book now!");
                
                el.setAttribute('href', "#markerBook");
                el.setAttribute('id', 'link' + accID);
                el.appendChild(textNode);
                el.addEventListener("click", complete);
                
                // Append popup to marker
                p.appendChild(el);
                marker.bindPopup(p);
                
            }
            
            output = output + "</table>";

            document.getElementById('aside').innerHTML = output;
        }
    } );

    var a = document.getElementById("location").value;
    var b = document.getElementById("type").value;

    xhr2.open("GET" , "/~lambertj/searchwebservice.php?location=" + a + "&type=" + b);
    xhr2.send();  
}

function complete()
{
    //get id from link id
    var ID = this.id.substring(4);
   
    document.getElementById("markerBook").style.display = "block";
    //set hidden field value to id
    document.getElementById("accID").value = ID;
}

function responseReceived(e)
    {
        var results = document.getElementById('remove')
        var httpcode = e.target.status;
        
        if(httpcode == 401)
        {
            results.innerHTML = "<h3>Please enter your login detials correctly</H3>";
        }
        else if(httpcode == 404)
        {
            results.innerHTML = "<h3>No bookings for this accomodation available</H3>";
        }
        else if(httpcode == 410)
        {
            results.innerHTML = "<h3>Sorry no rooms available</H3>";
        }
        else if(httpcode == 200)
        {
            results.innerHTML = "<h6>Your booking has been confirmed</H6>";
        }
        else if(httpcode == 413)
        {
            results.innerHTML = "<h3>You have too many people, try less!</H3>";
        }
        else if(httpcode == 400)
        {
            results.innerHTML = "<h3>Please enter a date</H3>";
        }
        else if(httpcode == 406)
        {
            results.innerHTML = "<h3>Enter a valid date</H3>";
        }
    }
            
            
function bookAcc()
    {
        
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var accID = document.getElementById('accID').value;
        var thedate = document.getElementById('thedate').value;
        var npeople = document.getElementById('npeople').value;

        var xhr2 = new XMLHttpRequest();
        var data = new FormData();

        data.append("accID", accID);
        data.append("thedate", thedate);
        data.append("npeople", npeople);
        xhr2.addEventListener("load", responseReceived);

        xhr2.open("POST", "/~lambertj/bookwebservice.php");
        xhr2.setRequestHeader("Authorization","Basic " + btoa(username+":"+password));
        xhr2.send(data);
    }
            