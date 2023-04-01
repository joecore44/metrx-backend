<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require_once '../config.php';
require_once '../functions.php';

$connect = connect();

if(!$connect){
	header('Location: ./error.php');
}

if(check_session() == true){


if(!isset($siteSettings)){

	$siteSettings = get_settings();

}

require '../views/header.view.php';

}else{
	
	header('Location:'.SITE_URL);

}

?>