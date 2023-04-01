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

$id_trainer = cleardata(getId());

if(!$id_trainer){
	header('Location: home.php');
}

if(check_permission('view_trainers')){

$trainer = get_trainer_per_id($id_trainer);

if(!$trainer){
	header('Location: ./home.php');
}

$siteSettings = get_settings();

require '../views/trainer.details.view.php';

}else{

	header('Location: ./denied.php');		
}

}else{
	header('Location:'.SITE_URL);
}


?>