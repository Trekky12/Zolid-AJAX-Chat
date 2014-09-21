<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

  
    <title>Zolid Chat Control Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    
    <div class="container-fluid">
      <div class="row">
  <h2 class="sub-header">Zolid Chat Control Panel</h2>
          <div class="table-responsive">
          

<?php
$reply_livechat = $_GET['reply_chat']; 

if(isset($reply_livechat)) {
    
    $reply_chat = str_replace("%20", "&nbsp;", "$reply_livechat");
?>
<div class='col-md-5'><div class='alert alert-danger' role='alert'><p><?php echo "$reply_chat"; ?> </p></div></div><br><br>
<?php
}
?> 
<br><br><br>
 <form class="form-horizontal" action='request.php' method='post'>
 <fieldset>
<!-- Form Name -->
<legend>Clear All Records</legend>

<!-- Button -->
<div class="form-group">
<label class="col-md-1 control-label" for="singlebutton"></label>
  <label class="col-md-4 control-label" for="singlebutton">Clear</label>
  <div class="col-md-4">
  <input type='hidden' name='request' value='clear_data_all'>
  
   <input type='submit' id="singlebutton" class="btn btn-primary" value='Submit'>
  </div>
</div>

</fieldset>
</form>
<br>
<form class="form-horizontal" action='request.php' method='post'>
<fieldset>

<!-- Form Name -->
<legend>Clear All for Username</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="user">Username</label>  
  <div class="col-md-4">
  <input id="user" name="user" type="text" placeholder="Username" class="form-control input-md" required="">
  <input type='hidden' name='request' value='clear_data_user'>
  <span class="help-block">Enter the Username to clear</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <input type='submit' id="singlebutton" class="btn btn-primary" value='Submit'>
  </div>
</div>

</fieldset>
</form>

<form class="form-horizontal" action='request.php' method='post'>
<fieldset>

<!-- Form Name -->
<legend>Clear Last Records</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
  <input type='hidden' name='request' value='clear_data_last'>
    <label class="col-md-5 control-label" for="n">Records to clear</label>
  <div class="col-md-4">
    <select id="n" name="n" class="form-control">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      </div>
    </select> <br><input type='submit' id="singlebutton" class="btn btn-primary" value='Submit'>
  </div>
</div>

</fieldset>
</form>

        </div>
      </div> 
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
  </body>
</html>
