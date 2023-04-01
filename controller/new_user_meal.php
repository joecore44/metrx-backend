<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

if(check_permission('create_meals')){

    $user = cleardata($_POST['user_id']);
    $meal = cleardata($_POST['meal_id']);
    $author = cleardata($_POST['author_id']);

    $statement = connect()->prepare("SELECT * FROM meals_users WHERE meal_id = :meal_id AND user_id = :user_id");
	$statement->execute(array(
        ':meal_id' => $meal,
        ':user_id' => $user
    ));
	$result = $statement->fetch();

	if ($result != false) {
		
	    echo "exist";
	
	}else{

        $statment = connect()->prepare("INSERT INTO meals_users (meal_id,user_id,author_id) VALUES (:meal_id, :user_id, :author_id)");

        $statment->execute(array(
            ':meal_id' => $meal,
            ':user_id' => $user,
            ':author_id' => $author
        ));

        echo "success";

    }


}else{

	echo "access_denied";
}

}else{
	
	exit();		
}

?>