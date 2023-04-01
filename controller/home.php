<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';	

if(check_session() == true){ 

$exercises_total = exercises_total(); 
$workouts_total = workouts_total(); 
$bodyparts_total = bodyparts_total(); 
$equipments_total = equipments_total(); 
$levels_total = levels_total(); 
$goals_total = goals_total(); 
$recipes_total = recipes_total(); 
$meals_total = meals_total(); 
$posts_total = posts_total(); 
$trainers_total = trainers_total(); 
$products_total = products_total(); 
$latestexercises = get_all_exercises(5);
$latestworkouts = get_all_workouts(5);

require '../views/home.view.php';
    
}else{

	header('Location:'.SITE_URL);
}


?>