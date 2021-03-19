<!doctype html>
<html lang="en">
  <head>
  <style>
  
  </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<div style="height:100%; width:100%;overflow: hidden;">
            <embed type="text/html" src="header.html" width="100%" height="20%" >
       

</div>
</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_task1";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else{
  // echo "Connected successfully";
  if(isset($_GET["filter"])){
    $query="select * from customers where email='".$_GET["filter"]."'";
   
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo "<table class=\"table table-striped table-inverse table-responsive\">
        <thead class=\"thead-inverse\">
            <tr>
                <th> NAME</th>
                <th> EMAIL </th>
                <th> CURRENT BALANCE</th>
                <th></th>
            </tr>
            </thead>";
            while($row = mysqli_fetch_assoc($result)) {
              $url="transfer.php?sender=".$row["email"];
        echo "<tbody>
        <tr style=\"nth-child(even){background:pink}\">
               <td scope=\"row\">".$row["name"]."</td>
               <td>".$row["email"]."</td>
               <td>". $row["current_balance"]."</td>
              <td><a href=$url><button type=\"button\" class=\"btn btn-outline-primary\">Transfer</button></a></td></tr>";
}
echo "</tbody>
</table>";

echo "";

}
 else {
echo "0 results";
}

mysqli_close($conn);

  }
}
?>
