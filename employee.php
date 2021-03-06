<?php
session_start();
$id=$_SESSION["employee_id"];
$name=$_SESSION["name"];
if(!isset($_SESSION['employee_id']))
{
  $error="Sorry you are not logged in or not registered with us.You will be redirected to signup page.";
  echo "<script type='text/javascript'>alert('$error');window.location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee's View</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css" >
	.vis-container
	{

			max-width:1200px;
			margin:0 auto;
	}
	.panel
	{
		min-height:300px;
	}
	.form-group
	{
		margin:10px;
	}
	.text-center
	{
		margin-top:20%;
		text-decoration: underline;
	}
	.glyphicon
	{
		float:right;
	}
	.glyphicon-ok
	{
		color: green;
	}
	.glyphicon-remove
	{
		color:red;
	}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Employee's View</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <!-- <ul class="nav navbar-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Targets Completed<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">By Date</a></li>
            <li><a href="#">By Title</a></li>
          </ul>
        </li>
        <li><a href="#">Visualizations</a></li>
      </ul> -->
      <ul class="nav navbar-nav navbar-right">
        <li>
                    <a>Welcome,<?php echo $name;?>
                        <!-- <span class="menu-icon pull-right hidden-xs showopacity "></span> -->
                    </a>
                </li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span>LogOut</a></li>
        <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
      </ul>
    </div>
  </div>
</nav>

<section class="vis-container">
<div class="row">
<div class="col-md-4">
   <div class="panel panel-danger">
      <div class="panel-heading">Declined Requests(Latest 5)</div>
      <div class="panel-body">
      <table class="table table-bordered">
  <div class="table responsive">
  <thead>
  <tr>
  <th>Holiday Request Date</th>
  <th>Holiday Reason</th>
  </tr>
  </thead>
  <tbody>
      <?php
      include('connection.php');
      $decline=mysqli_query($conn,"select * from employee_holiday where status='Declined' and employee_id=$id order by 'DESC' limit 5");
      $count=mysqli_num_rows($decline);
if(mysqli_num_rows($decline)>0)
{
  while($row=mysqli_fetch_assoc($decline))
  {
    
    echo "<tr>".
    "<td>".$row["holiday_date"]."</td>".
    "<td>".$row["holiday_reason"]."</td>".
    //'<td><button class="btn btn-primary btn-modal" onclick="modalname()">Donate</button></td>'.
    "</tr>";
  }
}
else
{
  echo "no results";
}
mysqli_close($conn);
      ?>
      </tbody>
  </div>
</table>
</div>
    </div>
</div>

<div class="col-md-4">
   <div class="panel panel-warning">
      <div class="panel-heading">Request Holiday</div>
      <form method="post" action="holiday.php">
        <div class="form-group">
      <label for="holiday_date">Holiday Date</label>
      <input type="date" class="form-control" id="holiday_date" name="holiday_date" required="">
    </div>
    <div class="form-group">
      <label for="reason_holiday">Reason</label>
      <input type="text" class="form-control" id="reason_holiday" placeholder="Enter Reason for holiday" name="reason_holiday" required="">
    </div>
    <div class="form-group">
    <button type="submit"  name="submit" class="btn btn-primary form-control">Submit Request</button>
    </div>
    </form>
    </div>
</div>

<div class="col-md-4">
   <div class="panel panel-primary">
      <div class="panel-heading">Approved Requests(Latest 5)</div>
      <div class="panel-body">
      	  <table class="table table-bordered">
  <div class="table responsive">
  <thead>
  <tr>
  <th>Holiday Request Date</th>
  <th>Holiday Reason</th>
  </tr>
  </thead>
  <tbody>
      <?php
      include('connection.php');
      $decline=mysqli_query($conn,"select * from employee_holiday where status='Approve' and employee_id=$id order by 'DESC' limit 5");
      $count=mysqli_num_rows($decline);
if(mysqli_num_rows($decline)>0)
{
  while($row=mysqli_fetch_assoc($decline))
  {
    
    echo "<tr>".
    "<td>".$row["holiday_date"]."</td>".
    "<td>".$row["holiday_reason"]."</td>".
    //'<td><button class="btn btn-primary btn-modal" onclick="modalname()">Donate</button></td>'.
    "</tr>";
  }
}
else
{
  echo "no results";
}
mysqli_close($conn);
      ?>
      </tbody>
  </div>
</table>

      </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-md-6">

   <div class="panel panel-default">
      <div class="panel-heading">Enter Suggestion</div>
<form method="post" action="feedback.php">
        <div class="form-group">
        <h3>Feedback Type</h3>
      <label  for="feedback_type">Type</label>
      <select name="type" class="form-control">
      	<option value="Feedback">Feedback</option>
      	<option value="Complaint">Complaint</option>
      </select>
    </div>
    <div class="form-group">
      <label for="feed_back">Feedback / Complaint</label>
      <input type="text" class="form-control" id="feed_back" placeholder="Enter Here" name="feed_back" required="">
    </div>
    <div class="form-group">
    <button type="submit" name="submit" class="btn btn-primary form-control">Submit Feedback</button>

    </div>
    </form>
</div>
</div>
<div class="col-md-6">

   <div class="panel panel-default">
      <div class="panel-heading">Submit Resignation</div>
<form method="post" action="resignation.php">

        <div class="form-group">
        <label for="resign">Resignation Reason</label>
         <select name="resign" id="resign" class="form-control">
        <option value="Environment">Environment</option>
        <option value="Colleagues">Colleagues</option>
        <option value="Other">Other</option>
      </select>
    </div>
    <div class="form-group">
      <label for="resign_explain">Resignation Explaination</label>
      <textarea class="form-control rounded-0" id="resign_explain" placeholder="Enter your Resignation here in detail" name="resign_explain" rows="3" required=""></textarea>
    </div>
    <div class="form-group">
    <button type="submit" name="submit" class="btn btn-danger form-control" style="margin-top: 10px;">Submit Resignation</button>
    </div>
    </form>
</div>
</div>
</section>
</body>
</html>