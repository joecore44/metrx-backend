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

$id_member = cleardata(getId());

if(!$id_member){
	header('Location: home.php');
}

if(check_permission('view_members')){

$member = get_member_per_id($id_member);

if(!$member){
	header('Location: ./home.php');
}

$siteSettings = get_settings();

require '../views/member.details.view.php';

}else{

	header('Location: ./denied.php');		
}

}else{
	header('Location:'.SITE_URL);
}


?>