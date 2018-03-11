<?php

/**
* Example of Recommender class implemented using SQL database.
*/

include_once 'Recommender.php';

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

$uname = 'Niklaus Wirth';
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