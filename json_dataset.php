<?php

include_once 'Recommender.php';

$data = '{
		"Dennis Ritchie": {"Programming language theory": 3.45, "Systems programming": 5.0, "Software engineering": 4.83}, 
		"John Backus": {"Programming language theory": 4.58, "Systems programming": 4.43, "Databases": 2.8, "Software engineering": 4.38, "Formal methods": 2.42}, 
		"Donald Knuth": {"Programming language theory": 4.33, "Systems programming": 3.57, "Algorithms": 5.0, "Computation": 4.39}, 
		"Edgar Codd": {"Formal methods": 1.53, "Systems programming": 4.6, "Concurrency": 4.28, "Software engineering": 3.54, "Databases": 5.0}, 
		"Robert Floyd": {"Concurrency": 2.92, "Formal methods": 5.0, "Systems programming": 2.17, "Algorithms": 5.0, "Computation": 3.18, "Programming language theory": 4.24}, 
		"Robin Milner": {"Programming language theory": 5.0, "Systems programming": 1.66, "Concurrency": 4.62, "Formal methods": 3.94}, 
		"Tony Hoare": {"Software engineering": 3.62, "Formal methods": 4.72, "Systems programming": 4.38, "Algorithms": 4.38, "Concurrency": 4.88, "Programming language theory": 4.64}, 
		"Michael Stonebraker": {"Systems programming": 4.67, "Concurrency": 4.14, "Software engineering": 3.86, "Databases": 5.0}, 
		"Marvin Minsky": {"Systems programming": 2.54, "Algorithms": 2.76, "Computation": 4.32, "Artificial intelligence": 5.0}, 
		"Edsger Dijkstra": {"Software engineering": 4.04, "Formal methods": 5.0, "Systems programming": 4.52, "Algorithms": 4.92, "Concurrency": 3.97, "Programming language theory": 4.34}, 
		"Alan Perlis": {"Systems programming": 5.0, "Software engineering": 3.34, "Artificial intelligence": 1.46, "Databases": 2.32}, 
		"John McCarthy": {"Concurrency": 3.61, "Formal methods": 3.58, "Systems programming": 3.25, "Algorithms": 3.03, "Computation": 3.23, "Programming language theory": 4.72, "Artificial intelligence": 5.0}, 
		"Leslie Lamport": {"Software engineering": 3.76, "Formal methods": 4.93, "Systems programming": 2.76, "Algorithms": 4.63, "Concurrency": 5.0, "Programming language theory": 1.5}, 
		"Niklaus Wirth": {"Programming language theory": 4.23, "Systems programming": 4.22, "Algorithms": 3.95, "Software engineering": 4.74, "Formal methods": 3.83}}';

$dataset = json_decode($data, true);

$recommend = new Recommender;


echo '<h1>Similiar Users</h1>';
$similarUsers = $recommend->similarUsers($dataset,'Niklaus Wirth');
foreach ($similarUsers as $user => $probabilty) {
	echo $user.' with probabilty - '.round($probabilty, 2).'<br>';
}

echo '<h1>Recommended Movies</h1>';
$recommend = $recommend->recommend($dataset,'Niklaus Wirth');
foreach ($recommend as $key => $value) {
	echo $value.'<br>';
}
?>