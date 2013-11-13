<?php

//defining the global variables
define('RATING_MIN', 5);
define('RECOM_NUM', 20);
define('SIM_NUM', 0.0);


  
$sql= "SELECT * FROM book_ratings ORDER BY userid";//When I delete the limitation, the webpage turn to blank.
$result=mysql_query($sql);

$critics=array();
$current_user=null;
while ($row=mysql_fetch_row($result)) 
	{
		$critics[$row[0]][$row[1]]=$row[2];	
	}

//print_r($critics);

// foreach($critics as $key => $value){
//     echo $key.' ';
//     foreach($value as $isbn => $rate){
//         echo $isbn." ".$rate.'<br/>';
//     }
// }

/***************************WEIQIN ADD END****************************/


error_reporting(0);
$recommendedBooks = get_recommendations($critics, $_SESSION['uid']);





//hack this to add the similarity factor of - based in same country, in same profession
function sim_distance($prefs, $p1, $p2){
	//returns the distance based on the similarity between the persons
	$sharedItems = array();
	$sum_sq = 0;
	//get the movie list for person 2
	$keys = array_keys($prefs[$p2]);
	//print_r($keys);

	//get the list of common things between the two
	foreach($prefs[$p1] as $k => $v){
		if(in_array($k, $keys)){
			$sharedItems[] = $k;
			//calculating the diiference in rating
			$diff = $prefs[$p2][$k] - $prefs[$p1][$k];
			$sum_sq += pow($diff, 2); 
		}
	}
	//echoing everything
	//print_r($sharedItems);

	//if there is no similarity return the zero
	if($sum_sq === 0){
		return 0;
	}

	//calculating the distance
	$dist = pow($sum_sq, 1/2);
	return 1 / (1 + $dist);
}

//this function will determine the order in which we should present the books
function top_matches($prefs, $p, $dist){
	//get the top rated books only
	$topBooks = array();
	foreach($prefs[$p] as $k => $v){
		if ($v > RATING_MIN){
			//add the code to increase the rating if there is a similarity between the users
			//checking if the distance is greater that SOMEthING, then bumping up the rating
			if ($dist > SIM_NUM){
				$v += $v*$dist;		
			}
			$topBooks[$k] = $v;
		}
	}
	arsort($topBooks);
	//print_r($topBooks);
	return $topBooks;
}

function get_recommendations($prefs, $p1){
	//get the similarity of one person with respect to other users // taking the top 3 distances
	//if he is very similar, then get the books from those that he has not read

	//saving the array in a different array
	$prefsOriginal = $prefs;

	//unsetting the person from the array - for whom we are getting the recommendation
	unset($prefs[$p1]);

	//array to save the person and the distance
	$personDistance = array();

	//calculating the similarity of this person with other users
	foreach($prefs as $k => $v){
		$dist = sim_distance($prefsOriginal, $p1, $k);
		$personDistance[$k] = $dist;
	}

	//sorting the array based on the distance - nearest first
	arsort($personDistance);

	//printing the top recommenders
	//print_r($personDistance);

	//getting the books from the distance people - taking top 3
	$i = 0;
	$recommendedBooks = array();
	$topBooks = array();
	foreach($personDistance as $k => $v){
		//get the top books for this person
		$topBooks = top_matches($prefs, $k, $v);
		if(sizeof($topBooks) >= 1){
			$recommendedBooks[] = $topBooks;
			$i += 1;
		}
		if($i > RECOM_NUM) break; //condition to take the recommendations only from the top matches
	}
	//printing the combine array
	//print_r($recommendedBooks);

	//echo ('<br><br>');

	$recBooks = array();

	//merging the arrays based on the RECOM_NUM
	foreach($recommendedBooks as $rks){
		foreach ($rks as $key => $value) {
			//check if the key already exists
			if(array_key_exists($key, $recBooks)){
				//see whether the value that we are going to insert is higher
				if($recBooks[$key] < $value){
					$recBooks[$key] = $value;
				} else {
					$value = $recBooks[$key];
				}
			}

			$recBooks[$key] = $value;	
			
		}
	}


	//getting the name of the books
	//$recBooks = array_keys($recBooks);
	//print_r($recBooks);

	//subtracting the items that the user has already seen
	foreach($prefsOriginal[$p1] as $k => $v){
		// echo('kitaab hai = '.$k);
		// echo ('<br>');
		if (in_array($k, $recBooks)){
			$key = array_search($k, $recBooks);
			//print $key;
			unset($recBooks[$key]);
		}
	}

	//getting the order of the books in which to display based on the rating match
	//sorting the array based on the key
	arsort($recBooks);

	//printing after removing the read books
	//echo ('<br><br>');

	return $recBooks;

}

?>