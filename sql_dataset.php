<?php
include_once 'Recommender.php';

$con = mysql_connect('localhost','root','');
mysql_select_db('majorproject');
$sql1 = "SELECT * FROM `users`";
$sql2 = "SELECT * FROM `books`";
$r2 = mysql_query($sql2);
$books = [];
while ($row2 = mysql_fetch_assoc($r2)) {
	$books[$row2['id']] = $row2['name'];
}
$r1 = mysql_query($sql1);
$array = [];
$subArray = [];
while($row1 = mysql_fetch_assoc($r1)){
	$id = $row1['userid'];
	$name = $row1['name'];
	$sql3 = "SELECT * FROM `ratings` WHERE user_id = $id";
	$r3 = mysql_query($sql3);
	while ($row3 = mysql_fetch_assoc($r3)) {	
		$subArray[$row3['book_id']] = $row3['rating'];
	}
	$array[$name] = $subArray;
}
// print_r($array);


$recommend = new Recommender;


echo '<h1>Similiar Users</h1>';
$similarUsers = $recommend->similarUsers($array,'Niklaus Wirth');
foreach ($similarUsers as $user => $probabilty) {
	echo $user.' with probabilty - '.round($probabilty, 2).'<br>';
}

echo '<h1>Recommended Movies</h1>';
$recommend = $recommend->recommend($array,'Niklaus Wirth');
foreach ($recommend as $key => $value) {
	echo ++$key.') '.$books[$key].'<br>';
}
?>