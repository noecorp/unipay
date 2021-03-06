<?php
    require("config.php");
    if(empty($_SESSION['user'])) 
    {
        header("Location: http://188.226.133.180/logout.php");
        die("Redirecting to http://188.226.133.180/logout.php"); 
    }
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UniPay User Handling System</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>
            <?php 
$balanceid = $_SESSION['username'];
	// Gets the info from the db
	$query=mysql_query("SELECT * FROM users WHERE username = '$balanceid'  ") or die(mysql_error());
	$info = mysql_fetch_array( $query ); 
	 
	// Selects everything from cards
 	$cardlineresult = mysql_query("SELECT * FROM cards WHERE username = '$balanceid' ");
 	$num_rows = mysql_num_rows($cardlineresult);
	 
	?>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="maindash.php">UniPay</a>

            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down">  <?php  echo $_SESSION['username'];	?></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="userprofile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="cards.php"><i class="fa fa-gear fa-fw"></i> Cards</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="http://188.226.133.180/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="maindash.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
              
                    <li>
                        <a href="transactions.php"><i class="fa fa-table fa-fw"></i> Transactions</a>
                    </li>
                    <li>
                        <a href="addmoney.php"><i class="fa fa-money fa-fw"></i> Add money</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Card overview for <?php print nl2br($info['username']); ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
	
    <!-- /.table-responsive -->
    <div class="well">
        <h4>Add cards</h4>
        <p>You can add more than one card of phone to your account, just press the button underneath, and type in the data about the card, or use the mobile account.
						<?php print "There is "."$num_rows transactions"."for this user";?>
		</p>
        <a class="btn btn-default btn btn-block" target="_blank" href="#Addcardaction">Add card to account</a>
    </div>
	
	
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
					<th>Type</th>
					<th>UID</th>
                    <th>Card Number</th>
					<th>Tech</th>
					<th>Actions</th>
                </tr>
            </thead>
            <tbody>
				<?php
				while ($row = mysql_fetch_array($cardlineresult)) {
					print '<tr>';
					print '<td>' . $row['type'] . '</td>';
					print '<td>' . $row['uid'] . '</td>';
					print '<td>' . $row['cardno'] . '</td>';
					print '<td>' . $row['tech'] . '</td>';
                    print'<td class="center">
						<div class="btn-group  btn-group-xs">
							<button type="button" class="btn btn-default">Change card</button>
							<button type="button" class="btn btn-default">Delete card</button>
						</div>
                    </td>';
					print '</tr>';
					}
				?>
            </tbody>
        </table>
    </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
