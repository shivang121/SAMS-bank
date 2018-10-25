<?php 
			session_start(); 
			//echo $_SESSION["login"].'<br>';
$url="localhost";
$username='wordpress_b5';
$password='niIm75#1';
$uname1=$_SESSION["login"];
$conn=mysqli_connect($url,$username,$password,"wordpress_b3");
if(!$conn){
die('Could not Connect My Sql:' .mysql_error());
}
			$rs=mysqli_query($conn,"select * from customers where id='$uname1'");
			$row=mysqli_fetch_array($rs,MYSQLI_BOTH);
?>


<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<script type="text/javascript">
		function validateForm() {
 			var amount = document.forms[0]["Amount"].value;
			var acc_no2 = document.forms[0]["Acc_no2"].value;
    
			if ( amount == null || amount == "" || acc_no2== null || acc_no2=="" ) {
	        		alert("Fields with * are compulsory");
        			return false;
        
    				} 
			}
	</script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <title>SAMS Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Banking system" />
    <meta name="keywords" content="DSW project" />
    <meta name="author" content="Shivang Samyak Mridul Anushree" />
	<link rel="shortcut icon" href="xyz.ico">
	
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/main.css" type="text/css">

    <link rel="stylesheet" href="preview/lmpixels-demo-panel.css" type="text/css">
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
	<script src="js/jquery-2.1.0.min.js"></script>
	
  </head>

  <body >
    <div id="main-container">

      <!-- Header -->
      <header id="header" class="header">
        <div class="container clearfix">
          <div class="logo-container">
            <div class="header-logo">SAMS BANK (we brings everyone together)</div>
          </div>

          <div class="header-date mobile-hidden">
            <p id="header-date"></p>
			<script>
			var d = new Date();
			document.getElementById("header-date").innerHTML = d.toDateString();
			</script>
          </div>
          <a class="menu-toggle mobile-visible">
            <i class="fa fa-bars"></i>
          </a>
        </div>
      </header>
      <!-- /Header -->

      <!-- Site Navigation -->
      <nav class="main-nav mobile-menu-hide">
        <div class="container">
          <ul class="nav navbar-nav">
            <li>
              <a href="consumer.php" >Home</a>
            </li>
			<li>
              <a href="logout.php" style="width:auto;" method=get name="logout">Logout</a>
			</li>
			</ul>
        </div>
      </nav>
      <!-- /Site Navigation -->
	  <div class="sections">
        <!-- Home Section -->
        <section id="home" class="home-section clearfix">
      
            <center><h1>Welcome <?php echo $row['name'];?><br> </h1></center>
      <h5 style="margin-left: 10%;">Account No: <?php echo$row['id'];?><br>Address: <?php echo$row['address'];?><br>Phone No.: <?php echo$row['phone'];?><br>Email Id: <?php echo$row['email'];?><br></h3>
	  <h4 style="margin-left:10%;">Balance: <?php echo$row['balance'];?></h4>
	  
	  <center>
	  <?php


if(isset($_POST['Amount']) && !empty($_POST['Amount']) && isset($_POST['Acc_no2']) && !empty($_POST['Acc_no2']) ){


	
	$date=date("Y/m/d");
	$amount=$_POST['Amount'];

	if($amount>0)
	{

		$acc_no_credit=$_POST['Acc_no2'];
		$acc_no=$_SESSION["login"];
		
		$query3="SELECT * FROM CUSTOMERS WHERE id='$acc_no_credit'";
		$query3_data=mysqli_query($conn,$query3);
		
		if(mysqli_num_rows($query3_data)==1)
		{
			
			$a=$row['balance'];
			
			if($amount<=$a-5000)
			{
				$query1="INSERT INTO transaction(Date,Ac1,Ac2,Amount) VALUES('$date','$acc_no','$acc_no_credit','$amount')";
				$query4="UPDATE CUSTOMERS SET balance=balance-'$amount' WHERE id='$acc_no'";
				$query2="UPDATE CUSTOMERS SET balance=balance+'$amount' WHERE id='$acc_no_credit'";

				if( $query1_data=mysqli_query($conn,$query1) && $query2_data=mysqli_query($conn,$query2) && $query4_data=mysqli_query($conn,$query4) )
				{	
					echo '<br>'.'<span style="color:#0F0691;"><h2>Money Transfer Successful</h2>';//.$query1_data;
					echo '<h4>Account Number :</h4>'.$acc_no.'<h4>Amount transfered:</h4>'.$amount.'<h4>Amount transfered to:</h4>'.$acc_no_credit;
				}
				else 
					echo '<br>'.'<h2>Couldnot Transfer</h2>';
			}

			else 
				echo '<h1>You do not have sufficient balance</h1>';
		}
		else
			echo '<br>'.'<h2>Account number does not exist </h2>';			
	}
	
	else{ 
		die('<br>'.'<h2>Amount entered is not valid</h2>'); }
		}
		else {
		echo '
		<h2>Transfer money</h2>
		<form role="form" action="consumer.php" id="templatemo-preferences-form" method="POST" onsubmit="return validateForm()">
                <div class="row" style="margin-left: 32%;">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="Amount" class="control-label">Amount</label>
                    <input type="number" class="form-control" id="Amount" name="Amount" placeholder="Enter Amount" >                  
                  </div>
</div>
 
<div class="row"style="margin-left: 32%;">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="Acc_no2" class="control-label">Account Number</label>
                    <input type="text" class="form-control" id="Acc_no2" name="Acc_no2" placeholder="Account Number" required>                  
                  </div>
</div>

<div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-default">Reset</button>    
                </div>
              </div>
</form>
<script type="text/javascript">
		function validateForm() {
 			var amount = document.forms[0]["Amount"].value;
			var acc_no2 = document.forms[0]["Acc_no2"].value;
    
			if ( amount == null || amount == "" || acc_no2== null || acc_no2=="" ) {
	        		alert(" All Fields  are compulsory");
        			return false;
        
    				} 
			}
	</script>

		';
		};?>
	  </center>
	  </section>
	  
	  </div>
	  
	  
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/validator.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.malihu.PageScroll2id.min.js"></script>
    <script src="js/main.js"></script>
 </body>
</html>
