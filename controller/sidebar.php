<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

include_once '../menu.php';

if(check_session() == true){
 
$settings = get_settings();

$memberInfo = get_member_information();

$trainer = get_trainer_per_member_id($memberInfo['member_id']);

require '../views/sidebar.view.php';

}else{

    header('Location:'.SITE_URL);
}

?>