<?php

/**
* Example of Recommender class implemented using SQL database.
*/

include_once '../Recommender.php';

$myPDO = new PDO('sqlite:database.sqlite');
$sql1 = "SELECT * FROM `users`";
$sql2 = "SELECT * FROM `books`";
// $r2 = mysql_query($sql2);
$r2 = $myPDO->query($sql2);
$books = [];
foreach($r2 as $row2) {
	$books[$row2['id']] = $row2['name'];
}

$r1 = $myPDO->query($sql1);
$array = [];
$subArray = [];
foreach($r1 as $row1){
	$id = $row1['userid'];
	$name = $row1['name'];
	$sql3 = "SELECT * FROM `ratings` WHERE user_id = $id";

	$r3 = $myPDO->query($sql3);
	foreach($r3 as $row3){
		$subArray[$row3['book_id']] = $row3['rating'];
	}
	$array[$name] = $subArray;
}
// print_r($array);


$recommend = new Recommender($array);

if(isset($_GET['user'])){
	$uname = $_GET['user'];
}else{
	$uname = 'Lakpa Sherpa';
}



// Includs database connection
include "db_connect.php";

// Makes query with rowid
$query = "SELECT rowid, * FROM ratings";
$query1 = "SELECT rowid, * FROM books";
$query2 = "SELECT rowid, * FROM users";

// Run the query and set query result in $result
// Here $db comes from "db_connection.php"
$result = $db->query($query);
$result1 = $db->query($query1);
$result2 = $db->query($query2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<?php
			echo "<h1>User - {$uname}</h1>";
			echo '<h1>Similiar Users</h1>';
			$similarUsers = $recommend->similarUsers($uname);
			foreach ($similarUsers as $user => $probabilty) {
				echo $user.' with probabilty - '.round($probabilty, 2).'<br>';
			}

			echo '<h1>Recommended Movies</h1>';
			$recommend = $recommend->recommend($uname);
			foreach ($recommend as $key => $value) {
				echo ++$key.') '.$books[$key].'<br>';
			}
			?>
		</div>
		<div class="col-md-6">
			<h1>Choose User</h1>
			<form method="get" action="#" class="form">
				<div class="form-group">
					<select class="form-control" name="user">
						<option value="<?php echo $uname; ?>"><?php echo $uname; ?></option>
					<?php
						while($row = $result2->fetchArray()) {
							echo "<option value='{$row['name']}'>{$row['name']}</option>";
						} 
					?>
					</select>
					<br>
					<input type="submit" class="btn btn-lg pull-right" />
				</div>
			</form>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3">
			<h1>Users</h1>
			<table class="table table-striped">
				<tr>
					<td>id</td>
					<td>Name</td>
				</tr>
				<?php 
				$allUser = [];
				while($row2 = $result2->fetchArray()) {
					$allUser[$row2['rowid']] =  $row2['name'];
				?>
				<tr>
					<td><?php echo $row2['rowid'];?></td>
					<td><?php echo $row2['name'];?></td>
			
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="col-md-4">
			<h1>Books</h1>
			<table width="100%" class="table table-striped">
				<tr>
					<td>id</td>
					<td>Name</td>
				</tr>
				<?php 
				$allBook = [];
				while($row = $result1->fetchArray()) {
					$allBook[$row['rowid']] = $row['name']; 
				?>
				<tr>
					<td><?php echo $row['rowid'];?></td>
					<td><?php echo $row['name'];?></td>
					
				</tr>
				<?php } ?>
			</table>
		</div>
		<div class="col-md-5">
			<h1>Ratings</h1>
			<table class="table table-striped">
				<tr>
					<td>id</td>
					<td>Name</td>
					<td>Book</td>
					<td>Rating</td>
				</tr>
				<?php 
				while($row = $result->fetchArray()) {?>
				<tr>
					<td><?php echo $row['rowid'];?></td>
					<td><?php echo $allUser[$row['user_id']];?></td>
					<td><?php echo $allBook[$row['book_id']];?></td>
					<td><?php echo $row['rating'];?></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</div>

</body>
</html>
