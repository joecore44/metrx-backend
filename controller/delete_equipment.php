<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){
    
$id_item = cleardata(getId());

if(!$id_item){
	exit();
}

if(check_permission('delete_equipments')){

	$statement = connect()->prepare("DELETE FROM equipments WHERE equipment_id = :equipment_id");
	$statement->execute(array('equipment_id' => $id_item));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{

	echo "access_denied";
}

}else{
	
	exit();		
}

?>