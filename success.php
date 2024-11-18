<?php
@include 'config.php';
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$table=$_POST["phone"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="UkojH5TS";
if($email==NULL || $firstname==NULL||$amount==NULL||$table==NULL)
{
      echo'<script>location.href = "failure.php"</script>';
}
else
{
     date_default_timezone_set('Asia/Kolkata');
      $timestamp = time();
      $date_time_string = date("Y-m-d H:i:s", $timestamp);
      $sql="INSERT INTO `menu` (`email`, `Name`, `Table.NO`, `Items`, `Price`, `datetime`, `status`,`paymentmode`) VALUES ('$email', '$firstname', '$table', '$productinfo', '$amount', '$date_time_string', 'pending','Online')";
      $res=mysqli_query($conn,$sql);
      if($res)
      {
            session_start();
            $_SESSION['Gateway']=true;
            $_SESSION['Gatewayemail']=$email;
            echo'<script>location.href = "conform.php"</script>';
      }
      else
      {
            echo'<script>location.href = "failure.php"</script>';
      }
      echo "<h3>Thank You. Your order status is ". $status .".</h3>";
      echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
      echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
}
?>