<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

$errors = array();

if(check_session() == true){

$id_user = cleardata(getId());

if(!$id_user){
	header('Location: home.php');
}

if(check_permission('view_users')){

    $auth = $factory->createAuth();
	$user = $auth->getUser($id_user);

	if(!$user){
		header('Location: ./home.php');
	}

	$workouts = get_all_workouts();
	$meals = get_all_meals();

	require '../views/user.details.view.php';

}else{

	header('Location: ./denied.php');		
}

}else{
	header('Location:'.SITE_URL);
}


?>