<!doctype html>
<html lang="en">
  <head>
  <style>
   
    table{
      border:2px solid red;
      margin-left:20px;
      margin-top:10px;
      /* margin-right:200px; */
      /* width:800px; */
     
      
    }
  table :hover{
    background-color:burlywood;
  }
  .container {
  position: relative;
  width:100%;
  left:-100px;
  color: white;
  margin-top:10px;
  overflow:hidden;
  /* border:1px solid red; */
  
}
  .top-left {
  position: absolute;
  top: 200px;
  margin-left: 350px;
}
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
<div style ="margin-top:-20px " > <marquee width="100%" direction="left" ><p style="font-family: Impact; font-size: 18pt ;color:red;">**PLEASE NOTE : FOR ANY FURTHE QUERY ,KINDLY VISIT OUR CONTACT-US PAGE ....**</p></marquee></div>
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
$query1 = "select * from customers";
$result = mysqli_query($conn, $query1);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table class=\"table table-hover table-inverse table-responsive\">
        <thead class=\"thead-inverse\">
            <tr>
                <th> NAME</th>
                <th> EMAIL </th>
                <th> CURRENT BALANCE</th>
                <th>                  </th>
            </tr>
            </thead>";
            
    while($row = mysqli_fetch_assoc($result)) {
      $url = "view_details.php?filter=".$row["email"];
      
        echo "<tbody>
             <tr style=\"nth-child(even){background:pink}\">
                    <td scope=\"row\">".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>". $row["current_balance"]."</td>                    
                    <td><a href=$url><button type=\"button\" class=\"btn btn-outline-primary\">VIEW</button></a></td></tr>";

                    
                     
                    
               

               
           
    //   echo "NAME: " . . " - EMAIL:  " . $row["email"]. " CURRENT BALANCE:  " . $row["current balance"]. "<br><BR>";
    }
    echo "</tbody>
    </table></div>";

  } else {
    echo "0 results";
  }
  
  mysqli_close($conn);
// echo "Connected successfully";


?>