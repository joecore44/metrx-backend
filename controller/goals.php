<?php

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

if(check_permission('view_goals')){
    
require '../views/goals.view.php';
	
}else{

	header('Location: ./denied.php');
}

}else{

	header('Location:'.SITE_URL);
}


?>