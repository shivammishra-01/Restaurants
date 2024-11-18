<?php
session_start();
if(isset($_SESSION['payment'])){
$MERCHANT_KEY = "L6Mzdt";
$SALT = "G50bVOHzXBBkwzGp9u5LkPeRVQdrkV8F";

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
// Merchant Key and Salt as provided by Payu.

// $PAYU_BASE_URL = "https://test.payu.in";		// For Sandbox Mode
// $PAYU_BASE_URL = "https://sandboxsecure.payu.in";    // For Sandbox Mode
$PAYU_BASE_URL = "https://secure.payu.in";    // For Live Mode

$action = '';
$Amount=$_SESSION['TotalPrice'];
$name=$_SESSION['name'];
$email=$_SESSION['user'];
$foods=$_SESSION['foods'];
$table=$_SESSION['Tablenumber'];
$posted = array(
  'key' =>  $MERCHANT_KEY,
  'txnid' =>  $txnid,
  'amount'  =>  $Amount,
  'firstname' =>  $name,
  'email' =>  $email,
  'phone' =>  $table,   //mobile no
  'productinfo' =>  $foods,
  'surl'  =>  'http://localhost/dummy/success.php',
  'furl'  =>  'http://localhost/dummy/failure.php',
  'service_provider'  =>  'payu_paisa',
);

if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {
    $posted[$key] = $value;
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCC | pkd | payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="image/fevicon.png">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        margin: 0 auto;
        margin-top: 50px;
        max-width: 500px;
        border: none;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #fff;
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        border-bottom: none;
    }

    .card-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: bold;
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .form-control {
        font-size: 1.2rem;
        border-radius: 0;
        border: none;
        border-bottom: 2px solid #ddd;
        box-shadow: none;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-bottom-color: #1abc9c;
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .form-control:invalid {
        border-bottom-color: #e74c3c;
    }

    .input-group-text {
        border: none;
        border-radius: 0;
        background-color: #f8f9fa;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn-primary {
        border-radius: 0;
        font-size: 1.2rem;
        font-weight: bold;
        background-color: #1abc9c;
        border: none;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #16a085;
    }
    </style>
</head>

<body>
    <div class="container">
        <form action="<?php echo $action; ?>" method="post" name="payuForm">
            <div class="card">
                <div class="card-header">
                    Payment
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tableNumber" class="form-label">Table Number</label>
                        <input name="phone" id="phone" class="form-control"
                            value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="productInfo" class="form-label">Items Info</label>
                        <textarea class="form-control" id="productInfo" readonly
                            name="productInfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="form-label">Total Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" readonly>
                    </div>
                </div>
                <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                <input type="hidden" name="hash" value="<?php echo $hash ?>" />
                <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                <input name="firstname" id="firstname" type="hidden"
                    value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />

                <input name="email" id="email" type="hidden"
                    value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" />
                <input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>"
                    size="64" />

                <input name="furl" type="hidden" value="<?php echo (empty($posted['furl'])) ? '' : $posted['furl'] ?>"
                    size="64" />
                <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                <?php if(!$hash) { ?>
                <input type="submit" value="Submit" />
                <?php } ?>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary px-5">Pay Now</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

</html>
<?php } else{
  echo'<script>location.href = "explore-menu.php"</script>';
}
?>