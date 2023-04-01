<?php

require_once __DIR__ . '/../classes/vendor/autoload.php';

use voku\helper\AntiXSS;

function connect(){

    global $database;

    try{
        $connect = new PDO('mysql:host='.$database['host'].';dbname='.$database['db'],$database['user'],$database['pass'], array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        return $connect;
        
    }catch (PDOException $e){
        return false;
    }
}

function getImage($src){

    return SITE_URL.'/images/'.$src;
}

function getStrings($connect){
    
    $sentence = $connect->prepare("SELECT * FROM strings"); 
    $sentence->execute();
    return $sentence->fetch();
}

function countFormat($num) {

      if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }

  return $num;
}

function formatHTML($content){

    $content = str_replace(array("\n","\r","\t"),'', $content);
    $content = str_replace("</li>", "</li><br />", $content);
    $content = str_replace("</h1>", "</h3><br />", $content);
    $content = str_replace("</h2>", "</h3><br />", $content);
    $content = str_replace("</h3>", "</h3><br />", $content);
    $content = str_replace("</h4>", "</h3><br />", $content);
    $content = str_replace("</h5>", "</h3><br />", $content);
    $content = str_replace("</h6>", "</h3><br />", $content);
    return $content;
    
}

function clearGetData($data){

    $antiXss = new AntiXSS();
    $data = $antiXss->xss_clean($data);
    return $data;
}

function getParamsQuery(){
    
    return isset($_GET['query']) && !empty($_GET['query']) && $_GET['query'] ? clearGetData($_GET['query']) : NULL;
}

function getParamsCategory(){
    
    return isset($_GET['category']) && !empty($_GET['category']) && $_GET['category'] ? clearGetData($_GET['category']) : NULL;
}

function getParamsFeatured(){
    
    return isset($_GET['featured']) && !empty($_GET['featured']) && $_GET['featured'] ? clearGetData($_GET['featured']) : NULL;
}

function getParamsGoal(){
    
    return isset($_GET['goal']) && !empty($_GET['goal']) ? clearGetData($_GET['goal']) : NULL;
}

function getParamsLevel(){
    
    return isset($_GET['level']) && !empty($_GET['level']) ? clearGetData($_GET['level']) : NULL;
}

function getParamsAvailability(){
    
    return isset($_GET['availability']) && !empty($_GET['availability']) ? clearGetData($_GET['availability']) : NULL;
}

function getParamsWeek(){
    
    return isset($_GET['week']) && !empty($_GET['week']) ? clearGetData($_GET['week']) : NULL;
}

function getParamsWorkout(){
    
    return isset($_GET['workout']) && !empty($_GET['workout']) ? clearGetData($_GET['workout']) : NULL;
}

function getParamsDay(){
    
    return isset($_GET['day']) && !empty($_GET['day']) ? clearGetData($_GET['day']) : NULL;
}

function getParamsEquipment(){
    
    return isset($_GET['equipment']) && !empty($_GET['equipment']) ? clearGetData($_GET['equipment']) : NULL;
}

function getParamsMuscle(){
    
    return isset($_GET['muscle']) && !empty($_GET['muscle']) ? clearGetData($_GET['muscle']) : NULL;
}

function getParamsTag(){
    
    return isset($_GET['tag']) && !empty($_GET['tag']) ? clearGetData($_GET['tag']) : NULL;
}

function getParamsType(){
    
    return isset($_GET['type']) && !empty($_GET['type']) ? clearGetData($_GET['type']) : NULL;
}

function getParamsUser(){
    
    return isset($_GET['user']) && !empty($_GET['user']) ? clearGetData($_GET['user']) : NULL;
}

function getParamsID(){
    
    return isset($_GET['id']) && !empty($_GET['id']) ? clearGetData($_GET['id']) : NULL;
}

function getParamsSort(){
    
    return isset($_GET['sortby']) && !empty($_GET['sortby']) && $_GET['sortby'] !== 'undefined' ? clearGetData($_GET['sortby']) : NULL;
}

function is_json($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
    }

  function json_to_array_exercises($json) {

    $results = array();
    
    foreach ($json as $key => $value) {
        if (is_json($value)) {

        if($key === "exercise_bodyparts"){

        $results[$key] = getBodypartsById($value);

        }elseif($key === "exercise_equipments"){

        $results[$key] = getEquipmentsById($value);

        }elseif($key === "exercise_levels"){

        $results[$key] = getLevelsById($value);

        }else{

        $results[$key] = json_decode($value);

        }

        } else {

            if($key === "exercise_image"){

            $results[$key] = getImage($value);

            }else{
            $results[$key] = $value;
            }

        }
    }
    return $results;
}

function getCategoriesById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT category_id, category_title FROM categories WHERE category_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}

function getGoalsById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT goal_id, goal_title FROM goals WHERE goal_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}

function getLevelsById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT level_id, level_title FROM levels WHERE level_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);

}

function getEquipmentsById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT equipment_id, equipment_title FROM equipments WHERE equipment_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);

}

function getBodypartsById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT bodypart_id, bodypart_title FROM bodyparts WHERE bodypart_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
    
}

function getTagsById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT tag_id, tag_title FROM tags WHERE tag_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}

function getProductTagsById($array){

    $array = json_decode($array);

    if(empty($array)) {
        return null;
    }

    $array = implode(',', $array);

    $sentence = connect()->prepare("SELECT tag_id, tag_title FROM product_tags WHERE tag_id IN ({$array})");
    $sentence->execute();
    return $sentence->fetchAll(PDO::FETCH_ASSOC);
}

function getProductGalleryById($id) {

    $array = array();

    $sentence = connect()->prepare("SELECT * FROM product_gallery WHERE product = :product ORDER BY product_gallery.index ASC");
    $sentence->execute(array(
        ":product" => $id
    ));

    $results = $sentence->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $key => $item) {
        $array[$key]["index"] = $item["index"];
        $array[$key]["file"] = getImage($item["file"]);
    }

	return $array;

  }

  
  function getTotalOfExercisesBySingle($array) {

    $totalExerciseIds = 0;
    
    if(!is_array($array)) {
        return null;
    }else{
    
        $array = json_decode($array, true);
    
        foreach ($array as $exercise) {
            if (isset($exercise['exercise_id'])) {
                $totalExerciseIds++;
            }
        }
        
        return $totalExerciseIds;
    
    }
    
    }

function getTotalOfExercisesByWeek($array) {

    $totalExerciseIds = 0;
    
    $array = json_decode($array, true);

    foreach($array as $week){
        foreach($week as $days){
            foreach($days as $exercise){
                foreach($exercise as $data){
                    if(isset($data['exercise_id'])){
                        $totalExerciseIds++;
                    }
                }
            }
        }
    }
    
    return $totalExerciseIds;
    
}

function getExercisesBySingle($array) {

    $array = json_decode($array, true);

    if(empty($array)) {
        return null;
    }

    $sentence = connect()->prepare("SELECT * FROM exercises WHERE exercise_status = 1");
    $sentence->execute();
    $results = $sentence->fetchAll(PDO::FETCH_ASSOC);

    $exercises = $results;

    foreach ($array as $key => $value) {

        if (!isset($value["rest_time"])) {

	  foreach ($exercises as $exercise) {

        if(isset($value["exercise_id"])){

		if($value["exercise_id"] == $exercise["exercise_id"]) {
		  $array[$key]["exercise_title"] = $exercise["exercise_title"];
		  $array[$key]["exercise_image"] = getImage($exercise["exercise_image"]);
		  $array[$key]["exercise_video"] = $exercise["exercise_video"];

		}

		}

	  }
	}

	}

	return $array;

  }

  function getExercisesByWeek($array) {

    $array = json_decode($array, true);

    if(empty($array)) {
        return null;
    }

    $sentence = connect()->prepare("SELECT * FROM exercises WHERE exercise_status = 1");
    $sentence->execute();
    $results = $sentence->fetchAll(PDO::FETCH_ASSOC);

    $exercises = $results;

    foreach ($array as $weeks_key => $weeks_values) {
    foreach ($weeks_values as $week_key => $week_values) {
    foreach ($week_values as $days_key => $days_values) {
    foreach ($days_values as $day_key => $day_values) {

        if (!isset($day_values["rest_time"])) {

            foreach ($exercises as $exercise) {

                if(isset($day_values["exercise_id"])){

                    if ($day_values["exercise_id"] == $exercise["exercise_id"]) {
                        $array[$weeks_key][$week_key][$days_key][$day_key]['exercise_title'] = $exercise['exercise_title'];
                        $array[$weeks_key][$week_key][$days_key][$day_key]['exercise_image'] = getImage($exercise['exercise_image']);
                        $array[$weeks_key][$week_key][$days_key][$day_key]['exercise_video'] = $exercise['exercise_video'];
                    }

                }

               }
        }
      }
     }
    }
   }

	return $array;

  }

  function getRecipesByMeal($array) {

    $array = json_decode($array, true);

    if(empty($array)) {
        return null;
    }

    $sentence = connect()->prepare("SELECT * FROM recipes WHERE recipe_status = 1");
    $sentence->execute();
    $results = $sentence->fetchAll(PDO::FETCH_ASSOC);

    $recipes = $results;

    foreach ($array as $weeks_key => $weeks_values) {
    foreach ($weeks_values as $week_key => $week_values) {
    foreach ($week_values as $days_key => $days_values) {
    foreach ($days_values as $day_key => $day_values) {

        if (!isset($day_values["title"])) {

            foreach ($recipes as $recipe) {
                if ($day_values["recipeid"] == $recipe["recipe_id"]) {
                    $array[$weeks_key][$week_key][$days_key][$day_key]['id'] = $recipe['recipe_id'];
                    $array[$weeks_key][$week_key][$days_key][$day_key]['title'] = $recipe['recipe_title'];
                    $array[$weeks_key][$week_key][$days_key][$day_key]['image'] = getImage($recipe['recipe_image']);
                }
               }
        }
      }
     }
    }
   }

	return $array;

  }

  function formatDate($date){

    $sentence = connect()->prepare("SELECT st_dateformat FROM settings");
    $sentence->execute();
    $row = $sentence->fetch();

    $newDate = date($row['st_dateformat'], strtotime($date));
    return $newDate;
}

?>