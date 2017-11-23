<?php
Class Recommender{
	public function euclidean($dataset, $person1, $person2){
		# Returns ratio Euclidean distance score of person1 and person2 

		# Finding Euclidean distance 
		$sum_of_eclidean_distance = [];
		$both_viewed = [];
		foreach ($dataset[$person1] as $key1 => $value) {
			if(array_key_exists($key1, $dataset[$person2])){
					$both_viewed[$key1] = 1;
					// Add new data in array
					array_push($sum_of_eclidean_distance ,pow($dataset[$person1][$key1] - $dataset[$person2][$key1],2));
				}
			# Conditions to check they both have an common rating items	

			if(count($both_viewed) == 0)
				return 0;
		}
		$sum_of_eclidean_distance = array_sum($sum_of_eclidean_distance);
		return 1/(1+sqrt($sum_of_eclidean_distance));
	}

	public function pearson_correlation($dataset, $person1, $person2){
		# To get both rated items
		$both_rated = [];
		foreach ($dataset[$person1] as $key1 => $value) {
			if(array_key_exists($key1, $dataset[$person2])){
					$both_rated[$key1] = 1;
				}
		}
		$number_of_ratings = count($both_rated);

		# Checking for number of ratings in common
		if($number_of_ratings == 0)
			return 0;

		# Add up all the preferences of each user
		$person1_preferences_sum = 0;
		$person1_preferences = [];
		$person2_preferences_sum = 0;
		$person2_preferences = [];
		# Sum up the squares of preferences of each user
		$person1_square_preferences_sum = 0;
		$person1_square_preferences = [];
		$person2_square_preferences_sum = 0;
		$person2_square_preferences = [];
		# Sum up the product value of both preferences for each item
		$product_sum_of_both_users = 0;
		$product_of_both_users = [];
		foreach ($both_rated as $key => $value) {
			array_push($person1_preferences, $dataset[$person1][$key]);
			array_push($person1_square_preferences, pow($dataset[$person1][$key],2));
			array_push($person2_preferences, $dataset[$person2][$key]);
			array_push($person2_square_preferences, pow($dataset[$person2][$key],2));
			array_push($product_of_both_users, $dataset[$person1][$key] * $dataset[$person2][$key]);
		}
		$person1_preferences_sum = array_sum($person1_preferences);
		$person1_square_preferences_sum = array_sum($person1_square_preferences);
		$person2_preferences_sum = array_sum($person2_preferences);
		$person2_square_preferences_sum = array_sum($person2_square_preferences);
		$product_sum_of_both_users = array_sum($product_of_both_users);

		# Calculate the pearson score
		$numerator_value = $product_sum_of_both_users - ($person1_preferences_sum * $person2_preferences_sum / $number_of_ratings);
		$denominator_value = sqrt(($person1_square_preferences_sum - pow($person1_preferences_sum, 2) / $number_of_ratings) * ($person2_square_preferences_sum - pow($person2_preferences_sum, 2) / $number_of_ratings));

		if($denominator_value == 0){
			return 0;
		}
		else{
			$r = $numerator_value / $denominator_value;
			return $r;	
		}

	}

	public function similarUsers($dataset, $person, $number_of_users=4){
		$scores = [];
		foreach ($dataset as $otherperson => $value) {
			if($otherperson != $person) {
				$scores[$otherperson] = $this->pearson_correlation($dataset,$person,$otherperson);
			}
		}
		arsort($scores);
		$result = [];
		$i = 0;
		foreach ($scores as $key => $value) {
			$result[$key] = $value;
			++$i;
			if($i == $number_of_users)
				break;
		}
		return $result;
	}

	public function recommend($dataset,$person,$number_of_items = null){
		# Gets recommendations for a person by using a weighted average of every other user's rankings
		$totals = [];
		$simSums = [];
		$rankings_list = [];
		foreach ($dataset as $other => $value) {
			# don't compare me to myself
			if ($other == $person)
				continue;
		
			$sim = $this->pearson_correlation($dataset,$person,$other);

			# ignore scores of zero or lower
			if($sim <= 0)
				continue;

			foreach ($dataset[$other] as $item => $value) {
				# only score movies i haven't seen yet

				if(array_key_exists($item, $dataset[$person]) != 1 || $dataset[$person][$item] == 0){

					$totals[$item] = isset($totals[$item]) ? $totals[$item] : 0;
					$simSums[$item] = isset($simSums[$item]) ? $simSums[$item] : 0;

					# Similrity * score
					$totals[$item] += $dataset[$other][$item] * $sim;
					# sum of similarities
					$simSums[$item] += $sim;

				}
			}
		}
		# Create the normalized list
		$rankings = [];
		foreach ($totals as $item => $total) {
			$rankings[$item] = $total/$simSums[$item];
		}
		arsort($rankings);
		$recommendataions_list = [];
		foreach ($rankings as $recommend_item => $score) {
			array_push($recommendataions_list, $recommend_item);
		}
		$result = [];
		$i = 0;
		if ($number_of_items == null) {
			return $recommendataions_list;
		}
		foreach ($recommendataions_list as $key => $value) {
			$result[$key] = $value;
			++$i;
			if($i == $number_of_items)
				break;
		}
		return $result;
	}
}