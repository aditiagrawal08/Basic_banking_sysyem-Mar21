<!doctype html>
<html lang="en">
  <head>
  <style>
  tr:nth-child(even) {background-color: pink;}
  .card{
    box-shadow: 5px 10px 20px grey inset;
  }
  label{
    font-size:20px;
  }
  .top-left {
  position: absolute;
  top: 50%;
  left: 50%;
  font-style:oblique;
  font-size: 50px;
  transform: translate(-50%, -50%);
}
.container {
  position: relative;
  text-align: center;
  color: white;
}
  </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body background="image\b5.jpg" >
<div style="height:100%; width:100%;overflow: hidden;";>
            <embed type="text/html" src="header.html" width="100%" height="20%" >
            <!-- <div class="container">
                    <img src="image\b4.jpg" alt="Snow" style="width:100%;"> -->
                    
                    <!-- <div class="top-left"></div> -->
                    <!-- </div> -->
                  
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
  if(isset($_GET["sender"])){
    $query="select name from customers where email='".$_GET["sender"]."'";
    $queryrec= "select name from customers where email !='".$_GET["sender"]."'";
    $result = mysqli_query($conn, $query);
    $resultrec = mysqli_query($conn, $queryrec);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);


    echo"<div class=\"card\" style=\"width: 38rem;height:28rem;margin-top:4%;margin-left:30%;border: 2px solid black\">".
    "   <div class=\"card-body \" style=\"margin-left:30%;margin-top:4%\">"."<h5 class=\"card-title\">"."<form action=\"#\" method=\"Post\">
    <div class=\"form-group\">
             <label for=\"\"><b>SENDER</b></label>
             <select class=\"form-control\" name=\"sender\" id=\"\" style=\"width:200px\">
             <option value=".$row['name'].">".$row['name']."</option>
             </select>
             </div>
             </h5>"."  
      <p class=\"card-text\">";
      if (mysqli_num_rows($resultrec) > 0) {
        echo"<div class=\"form-group\">
        <label for=\"\"><b>RECEIVER</b></label>
        <select class=\"form-control\" name=\"receiver\" id=\"\" style=\"width:200px\">";
       while($row_list = mysqli_fetch_assoc($resultrec)) {
         echo "<option value=".$row_list['name'].">".$row_list['name']."</option>";


}

     echo  "</p><p class=\"card-text\" >
     <div class=\"form-group\" >
     <label for=\"\"></label>
     <input type=\"number\"
       class=\"form-control\" name=\"credit\" id=\"\" aria-describedby=\"helpId\" placeholder=\"Enter Amount\" style=\"width:200px; margin-top:35px;\">
       </p>
       <button type=\"submit\" class=\"btn btn-outline-success\" style=\"width:300px; margin-top:35px;margin-left:-50px;\">Transfer</button>
   </div>
   </form>
  </div>
</div>";
    
    }
   
    echo" </select>
             </div>
             ";
}
  }

if(isset($_POST['sender'])){
$sender=$_POST["sender"];
$receiver=$_POST["receiver"];
$credit=$_POST["credit"];

 $query="insert into transfers(sender,receiver,trans_amt) values('$sender','$receiver',$credit)";
 $result = mysqli_query($conn, $query);
 if($result)
{
  $sender_bal="select current_balance from customers where name='".$sender."'";
  $result_sender_bal=mysqli_query($conn,$sender_bal);
  $receiver_bal="select current_balance from customers where name='".$receiver."'";
  $result_rec_bal=mysqli_query($conn,$receiver_bal);
  if (mysqli_num_rows($result_sender_bal) > 0 && mysqli_num_rows($result_rec_bal) > 0){
    $row_sen= mysqli_fetch_assoc($result_sender_bal);
    $senbal=$row_sen["current_balance"];
    $row_rec= mysqli_fetch_assoc($result_rec_bal);
    $recbal=$row_rec["current_balance"];
    $senupd=(int)($senbal-$credit);
    $sender_update ="update customers set current_balance =".$senupd." where name='".$sender."'";
    $result_sen=mysqli_query($conn,$sender_update);
    
    $recupd=(int)($recbal+$credit);
    $rec_update="update customers set current_balance=".$recupd." where name='".$receiver."'";
    $result_rec=mysqli_query($conn,$rec_update);
   if($result_sen && $result_rec){
    echo '<script>alert("Transaction successful!!")</script>';
    echo '<script>window.location.href = "view cust.php"</script>';
   }
   else if(mysqli_error($conn)){
    echo '<script>alert("Transaction Failed. Try Again!!")</script>';
    echo '<script>window.location.href = "view cust.php"</script>';
   }
  }
  
  
}
 else
 echo mysqli_error($conn)." failed!!";
}
mysqli_close($conn);
  }

?>
