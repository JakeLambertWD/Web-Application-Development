<?php

// if login details supplied in the form
if(isset($_POST['username']) && isset($_POST['password'])) 
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
}
// otherwise, use HTTP authentication
else 
{
    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = $_SERVER['PHP_AUTH_PW'];

}

// connect to database
$conn = new PDO("mysql:host=localhost;dbname=lambertj","lambertj","gopooves");
$result=$conn->query("SELECT * FROM acc_users WHERE username='$user' AND password='$pass'");
$login = $result->fetch();

if($login==false)
{
    header("HTTP/1.1 401 Unauthorized");
}
else
{

    $id = $_POST["accID"];
    $date = $_POST["thedate"]; 
    $npeople = $_POST["npeople"];
    
    $check = $conn->query("SELECT * FROM acc_dates WHERE thedate = '$date' AND accID = '$id'");
    $row = $check->fetch();
    
    $checkdate = $conn->query("SELECT * FROM acc_dates WHERE thedate = '$date'");
    $rows = $checkdate->fetch();
    

        if ($date == "")
        {
            header("HTTP/1.1 400 Bad Request");
        }
        else if($rows == false)
        {
            header("HTTP/1.1 406 Not Acceptable");
        }
        else if($row == false)
        {
            header("HTTP/1.1 404 Not Found");
        }
        else 
        {
            if($row[availability] < 1)
                {
                    header("HTTP/1.1 410 GONE");
                }
            else
            {
                if($npeople == "")
                {

                        header("HTTP/1.1 200 OK");

                        $book = $conn->query("INSERT INTO acc_bookings (accID, thedate, username, npeople) VALUES ($id, $date, '$user', 1)");

                        $updateDate = $conn->query("UPDATE acc_dates SET availability =  availability - 1 WHERE accID = $id AND thedate = $date");

                }
                else
                {
                    if($row[availability] >= $npeople)
                    {
                        header("HTTP/1.1 200 OK");

                        $book = $conn->query("INSERT INTO acc_bookings (accID, thedate, username, npeople) VALUES ($id, $date, '$user', $npeople)");

                        $updateDate = $conn->query("UPDATE acc_dates SET availability =  availability - $npeople WHERE accID = $id AND thedate = $date");
                    }
                    else
                    {
                        header("HTTP/1.1 413 Payload Too Large");
                    }
                }
            }
            
        }
}
?>