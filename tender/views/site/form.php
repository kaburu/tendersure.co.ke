<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesapal API Integration</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <h1 align="center">Pesapal API Integration</h1>
    <div class="progress">
  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
  </div>
</div>

 <div class="jumbotron" style="height:510px;" align="center">
  <h4>Step1: Transaction Details Form</h4>
  <form class="navbar-form navbar-center" role="search" id="rightcol" action="pesapal/iframe.php" method="post">
    <table>
      <tr><td>First Name:</td><td><input type="text" name="first_name" class="form-control" placeholder="" required></td></tr>
      <tr><td>&nbsp;<br/></td><td></td></tr>
      <tr><td>Last Name:</td><td><input type="text" name="last_name" class="form-control" placeholder="" required></td></tr>
      <tr><td>&nbsp;<br/></td><td></td></tr>
      <tr><td>Email:</td><td><input type="text" name="email" class="form-control" placeholder="" required></td></tr>
      <tr><td>&nbsp;<br/></td><td></td></tr>
      <tr><td>Phone Number:</td><td><input type="text" name="phone_number" class="form-control" placeholder="" required></td></tr>
      <tr><td>&nbsp;<br/></td><td></td></tr>
      <tr><td>Amount:</td><td><select name="currency" id="currency" class="form-control" >
                                     <option value="KES">Kenya shillings</option>  
                                     <option value="UGX">Ugandan Shillings</option> 
                                     <option value="TZS">Tanzanian shillings</option>  
                                     <option value="USD">US Dollars</option>  
                                    </select><input type="text" name="amount" class="form-control" placeholder="" required></td></tr>
      <tr><td>&nbsp;<br/></td><td></td></tr>
      <tr><td>Description:</td><td><textarea name="description" class="form-control" cols="51" rows="3" required>Payments to XYZ Company</textarea></td></tr>
      <tr><td>&nbsp;<br/></td><td></td></tr>
      <tr><td></td><td><button type="submit" class="btn btn-primary btn-lg">Proceed to checkout</button></td></tr>
    </table>
    <input type="hidden" name="reference" class="form-control" value="">
  
</form>
 
</div>
<p align="right"><a href="https://www.pesapal.com/">&copy;Pesapal <?php echo date('Y');?></a></p>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>