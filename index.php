<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require './config.php';
require './functions.php';

if (check_session() == true){

    header('Location: ./controller/home.php');

}else{
    
    header('Location: ./controller/login.php');

}

?>