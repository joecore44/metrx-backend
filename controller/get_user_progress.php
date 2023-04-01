<?php

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

if(check_permission('view_users')){

    $data = array();

    $workouts = get_all_workouts();

    $id = cleardata(getId());

    $database = $factory->createDatabase();
    $reference = $database->getReference('progress/'.$id.'/workouts');
    $progress = $reference->getValue();

    $progressData = remove_empty_keys($progress);

    if(!empty($progress)){

        foreach($workouts as $workout_key => $workout_value){

            foreach($progressData as $progress_key => $progress_value){
       
               if($workout_value['workout_id'] == $progress_key){
       
                   $total_exercises = ($workout_value['workout_type'] == "single" ? getTotalOfExercisesBySingle($workout_value['workout_exercises']) : getTotalOfExercisesByWeek($workout_value['workout_exercises']));
                   $data[$workout_key]['workout_id'] = $workout_value['workout_id'];
                   $data[$workout_key]['workout_title'] = $workout_value['workout_title'];
                   $data[$workout_key]['workout_image'] = $workout_value['workout_image'];
                   $data[$workout_key]['total_exercises'] = $total_exercises;
                   $data[$workout_key]['progress_date'] = $progress_value['date'];
                   $data[$workout_key]['progress_time'] = $progress_value['time'];
                   $data[$workout_key]['progress_total'] = $progress_value['exercises_completed'];
                   $data[$workout_key]['progress_percentage'] = $progress_value['percentage'];
               }
       
             }
           }

    }

    $results = array(
        "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
        "aaData"=>$data);
    echo json_encode($results);

}else{
	
	header('Location: ./denied.php');
	
}

}else{

    header('Location:'.SITE_URL);
}

?>