<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

if(check_permission('create_workouts')){

    $user = cleardata($_POST['user_id']);
    $workout = cleardata($_POST['workout_id']);
    $author = cleardata($_POST['author_id']);

    $statement = connect()->prepare("SELECT * FROM workouts_users WHERE workout_id = :workout_id AND user_id = :user_id");
	$statement->execute(array(
        ':workout_id' => $workout,
        ':user_id' => $user
    ));
	$result = $statement->fetch();

	if ($result != false) {
		
	    echo "exist";
	
	}else{

        $statment = connect()->prepare("INSERT INTO workouts_users (workout_id,user_id,author_id) VALUES (:workout_id, :user_id, :author_id)");

        $statment->execute(array(
            ':workout_id' => $workout,
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