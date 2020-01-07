<html>
<head>
<style type='text/css'>
td, th { border: 1px solid black; border-collapse: collapse; }
table { border-collapse: collapse; }
body { font-family: helvetica, arial,sans-serif; }
th { background-color : #c0c0ff;  }
td { background-color: #ffffc0; }
</style>
</head>
<body>
<h1>Your Database</h1>
<?php

include ('include.php');
include ('dbview_funcs.php');

$db = new PDO("mysql:host=localhost;dbname=".USERNAME, USERNAME, PASSWORD);

display_results("accommodation", $db);
display_results("acc_users", $db);
display_results("acc_dates", $db);
display_results("acc_bookings", $db);


?>
</body>
</html>
