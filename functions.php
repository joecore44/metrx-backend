<?php

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

if(!isset($_SESSION)) { 
    session_start(); 
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/classes/vendor/autoload.php';
require_once __DIR__ . '/classes/slugify.php';
require_once __DIR__ . '/classes/class.fileuploader.php';
require_once __DIR__ . '/lang/languages.php';
require_once __DIR__ . '/permissions.php';
require_once __DIR__ . '/languages.php';
require_once __DIR__ . '/timezones.php';
require_once __DIR__ . '/email_fields.php';

$target_dir = "../images/";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use voku\helper\AntiXSS;
use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount(__DIR__.'/classes/google-service-account.json')
    ->withDatabaseUri(FIREBASE_URL);

function connect(){

global $database;

try{
    $connect = new PDO('mysql:host='.DATABASE_SERVER.';dbname='.DATABASE_NAME,DATABASE_USERNAME,DATABASE_PASSWORD, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    return $connect;
    
}catch (PDOException $e){
    return false;
}
}

function check_permission($permission){

    if($permission){

        $memberEmail = filter_var(strtolower($_SESSION['member_email']), FILTER_SANITIZE_EMAIL);

        $sentence = connect()->prepare("SELECT members.member_email, members.member_role, roles.role_permissions AS role_permissions FROM members, roles WHERE members.member_role = roles.role_id AND members.member_email = :email"); 
        $sentence->execute(array(
            ":email" => $memberEmail
        ));

        $row = $sentence->fetch();

        $role_permissions = (!empty($row['role_permissions']) && isset($row['role_permissions']) ? $row['role_permissions'] : "[]");

        if(!in_array($permission, json_decode($role_permissions))){
            return false;
        }else{
            return true;
        }

    }else{
        return false;
    }
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

function check_session(){

    if (isset($_SESSION['member_email'])) {

        $memberEmail = filter_var(strtolower($_SESSION['member_email']), FILTER_SANITIZE_EMAIL);

        $sentence = connect()->prepare("SELECT members.*, roles.* FROM members LEFT JOIN roles ON members.member_role = roles.role_id WHERE members.member_status = 1 AND members.member_email = :member_email"); 
        $sentence->execute(array(
            ":member_email" => $memberEmail
        ));

        $row = $sentence->fetch();

        if($row != false){
            return true;
        }else{
            return false;
        }

    }else{
        return false;
    }
}

function isAdmin(){

    if (isset($_SESSION['member_email'])) {

        $memberEmail = filter_var(strtolower($_SESSION['member_email']), FILTER_SANITIZE_EMAIL);

        $sentence = connect()->prepare("SELECT members.*, roles.* FROM members LEFT JOIN roles ON members.member_role = roles.role_id WHERE members.member_status = 1 AND members.member_email = :member_email"); 
        $sentence->execute(array(
            ":member_email" => $memberEmail
        ));

        $row = $sentence->fetch();

        if($row != false){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

function echoOutput($data){
    $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');

    if (empty($data)) {
        return "-";
    }else{
        return $data;
    }
}

function cleardata($data){
    $antiXss = new AntiXSS();
    $data = $antiXss->xss_clean($data);
    return $data;
}

function getId(){
    
    return isset($_GET['id']) && !empty($_GET['id']) ? cleardata($_GET['id']) : NULL;
}

function get_member_information(){

    if(isset($_SESSION['member_email'])) {

    $emailSession = filter_var(strtolower($_SESSION['member_email']), FILTER_SANITIZE_EMAIL);

    $sentence = connect()->prepare("SELECT * FROM members WHERE member_email = :member_email LIMIT 1");
    $sentence->execute(array(
        ":member_email" => $emailSession
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;

    }else{
        return false;
    }

}

function currentPage(){

    return isset($_GET['p']) ? (int)$_GET['p'] : 1;
}

function goToPage($parameter, $value) { 
    $params = array(); 
    $output = "?"; 
    $firstRun = true; 
    foreach($_GET as $key=>$val) { 
        if($key != $parameter) { 
            if(!$firstRun) { 
                $output .= "&"; 
            } else { 
                $firstRun = false; 
            } 
            $output .= $key."=".urlencode($val); 
        } 
    } 

    if(!$firstRun) 
        $output .= "&"; 
    $output .= $parameter."=".urlencode($value); 
    return htmlentities($output); 
} 

// roles  ---------------------------------------

function get_role_per_id($id_role){
    $sentence = connect()->prepare("SELECT * FROM roles WHERE role_id = :role_id LIMIT 1");
    $sentence->execute(array(
        ':role_id' => $id_role
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

function get_all_roles(){

    $sentence = connect()->prepare("SELECT * FROM roles ORDER BY role_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

// trainers  ---------------------------------------

function trainers_total(){

    $total_numbers = connect()->prepare("SELECT * FROM trainers");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_trainers(){

    $sql = "SELECT trainers.*, members.*, (SELECT COUNT(*) FROM workouts WHERE workouts.workout_trainer = trainers.trainer_member) AS total_workouts, (SELECT COUNT(*) FROM meals WHERE meals.meal_trainer = trainers.trainer_member) AS total_meals, (SELECT COUNT(*) FROM trainers_users WHERE trainers_users.trainer_id = trainers.trainer_member) AS total_users FROM trainers LEFT JOIN members ON members.member_id = trainers.trainer_member ORDER BY trainers.trainer_id DESC";
    $sentence = connect()->prepare($sql); 
    $sentence->execute();
    return $sentence->fetchAll();
}


function get_trainer_per_id($id_trainer){
    $sentence = connect()->prepare("SELECT trainers.*, members.* FROM trainers LEFT JOIN members ON trainers.trainer_member = members.member_id WHERE trainers.trainer_id = :trainer_id LIMIT 1");
    $sentence->execute(array(
        ':trainer_id' => $id_trainer
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

function get_trainer_per_member_id($id_member){
    $sentence = connect()->prepare("SELECT trainers.*, members.* FROM trainers LEFT JOIN members ON trainers.trainer_member = members.member_id WHERE trainers.trainer_member = :trainer_member LIMIT 1");
    $sentence->execute(array(
        ':trainer_member' => $id_member
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// posts  ---------------------------------------

function posts_total(){

    $total_numbers = connect()->prepare("SELECT * FROM posts");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_posts(){

    $sentence = connect()->prepare("SELECT posts.*, members.* FROM posts LEFT JOIN members ON posts.post_author = members.member_id ORDER BY post_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_post_per_id($id_post){
    $sentence = connect()->prepare("SELECT posts.*, members.* FROM posts LEFT JOIN members ON posts.post_author = members.member_id WHERE post_id = :post_id LIMIT 1");
    $sentence->execute(array(
        ':post_id' => $id_post
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// products  ---------------------------------------

function products_total(){

    $total_numbers = connect()->prepare("SELECT * FROM products");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_products(){

    $sentence = connect()->prepare("SELECT products.*, members.* FROM products LEFT JOIN members ON products.product_author = members.member_id ORDER BY product_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_product_per_id($id_product){
    $sentence = connect()->prepare("SELECT products.*, members.* FROM products LEFT JOIN members ON products.product_author = members.member_id WHERE product_id = :product_id LIMIT 1");
    $sentence->execute(array(
        ':product_id' => $id_product
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// recipes  ---------------------------------------

function recipes_total(){

    $total_numbers = connect()->prepare("SELECT * FROM recipes");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_recipes(){

    $sentence = connect()->prepare("SELECT recipes.*, members.* FROM recipes LEFT JOIN members ON recipes.recipe_author = members.member_id ORDER BY recipe_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_recipe_per_id($id_recipe){
    $sentence = connect()->prepare("SELECT recipes.*, members.* FROM recipes LEFT JOIN members ON recipes.recipe_author = members.member_id WHERE recipe_id = :recipe_id LIMIT 1");
    $sentence->execute(array(
        ':recipe_id' => $id_recipe
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// product_tags  ---------------------------------------

function product_tags_total(){

    $total_numbers = connect()->prepare("SELECT * FROM product_tags");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_product_tags(){

    $sentence = connect()->prepare("SELECT * FROM product_tags ORDER BY tag_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_product_tag_per_id($id_tag){
    $sentence = connect()->prepare("SELECT * FROM product_tags WHERE tag_id = :tag_id LIMIT 1");
    $sentence->execute(array(
        ':tag_id' => $id_tag
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// tags  ---------------------------------------

function tags_total(){

    $total_numbers = connect()->prepare("SELECT * FROM tags");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_tags(){

    $sentence = connect()->prepare("SELECT * FROM tags ORDER BY tag_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_tag_per_id($id_tag){
    $sentence = connect()->prepare("SELECT * FROM tags WHERE tag_id = :tag_id LIMIT 1");
    $sentence->execute(array(
        ':tag_id' => $id_tag
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// meals  ---------------------------------------

function meals_total(){

    $total_numbers = connect()->prepare("SELECT * FROM meals");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_meals(){

    $sentence = connect()->prepare("SELECT meals.*, members.*, trainers.* FROM meals LEFT JOIN trainers ON meals.meal_trainer = trainers.trainer_member LEFT JOIN members ON meals.meal_author = members.member_id ORDER BY meal_id DESC");
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_meal_per_id($id_meal){
    $sentence = connect()->prepare("SELECT meals.*, members.*, trainers.* FROM meals LEFT JOIN trainers ON meals.meal_trainer = trainers.trainer_member LEFT JOIN members ON meals.meal_author = members.member_id WHERE meal_id = :meal_id LIMIT 1");
    $sentence->execute(array(
        ':meal_id' => $id_meal
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// workouts  ---------------------------------------

function workouts_total(){

    $total_numbers = connect()->prepare("SELECT * FROM workouts");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_workouts($limit = null){

    $sql = "SELECT workouts.*, members.*, trainers.* FROM workouts LEFT JOIN trainers ON workouts.workout_trainer = trainers.trainer_member LEFT JOIN members ON workouts.workout_author = members.member_id ORDER BY workout_id DESC";

    if($limit && is_int($limit)){
        $sql .= " LIMIT $limit";
    }

    $sentence = connect()->prepare($sql);
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_workout_per_id($id_workout){
    $sentence = connect()->prepare("SELECT workouts.*, members.*, trainers.* FROM workouts LEFT JOIN trainers ON workouts.workout_trainer = trainers.trainer_member LEFT JOIN members ON workouts.workout_author = members.member_id WHERE workout_id = :workout_id LIMIT 1");
    $sentence->execute(array(
        ':workout_id' => $id_workout
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

function get_all_workouts_by_user($uid){

    $sql = "SELECT workouts_users.*, workouts.*, trainers.* FROM workouts_users LEFT JOIN workouts ON workouts.workout_id = workouts_users.workout_id LEFT JOIN trainers ON trainers.trainer_member = workouts_users.author_id WHERE workouts.workout_id = workouts_users.workout_id AND workouts_users.user_id = :user_id";
    $sentence = connect()->prepare($sql);
    $sentence->execute(array(
        ':user_id' => $uid
    ));

    return $sentence->fetchAll();

}

function get_all_meals_by_user($uid){

    $sql = "SELECT meals_users.*, meals.*, trainers.* FROM meals_users LEFT JOIN meals ON meals.meal_id = meals_users.meal_id LEFT JOIN trainers ON trainers.trainer_member = meals_users.author_id WHERE meals.meal_id = meals_users.meal_id AND meals_users.user_id = :user_id";
    $sentence = connect()->prepare($sql);
    $sentence->execute(array(
        ':user_id' => $uid
    ));

    return $sentence->fetchAll();

}

// exercises  ---------------------------------------

function exercises_total(){

    $total_numbers = connect()->prepare("SELECT * FROM exercises");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_exercises($limit = null){

    $sql = "SELECT * FROM exercises ORDER BY exercise_id DESC";

    if($limit && is_int($limit)){
        $sql .= " LIMIT $limit";
    }

    $sentence = connect()->prepare($sql); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_exercise_per_id($id_exercise){
    $sentence = connect()->prepare("SELECT exercises.*, members.* FROM exercises LEFT JOIN members ON exercises.exercise_author = members.member_id WHERE exercise_id = :exercise_id LIMIT 1");
    $sentence->execute(array(
        ':exercise_id' => $id_exercise
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// levels  ---------------------------------------

function levels_total(){

    $total_numbers = connect()->prepare("SELECT * FROM levels");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_levels(){

    $sentence = connect()->prepare("SELECT * FROM levels ORDER BY level_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_level_per_id($id_level){
    $sentence = connect()->prepare("SELECT * FROM levels WHERE level_id = :level_id LIMIT 1");
    $sentence->execute(array(
        ':level_id' => $id_level
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// goals  ---------------------------------------

function goals_total(){

    $total_numbers = connect()->prepare("SELECT * FROM goals");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_goals(){

    $sentence = connect()->prepare("SELECT * FROM goals ORDER BY goal_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_goal_per_id($id_goal){
    $sentence = connect()->prepare("SELECT * FROM goals WHERE goal_id = :goal_id LIMIT 1");
    $sentence->execute(array(
        ':goal_id' => $id_goal
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// bodyparts  ---------------------------------------

function bodyparts_total(){

    $total_numbers = connect()->prepare("SELECT * FROM bodyparts");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_bodyparts(){

    $sentence = connect()->prepare("SELECT * FROM bodyparts ORDER BY bodypart_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_bodypart_per_id($id_bodypart){
    $sentence = connect()->prepare("SELECT * FROM bodyparts WHERE bodypart_id = :bodypart_id LIMIT 1");
    $sentence->execute(array(
        ':bodypart_id' => $id_bodypart
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// equipments  ---------------------------------------

function equipments_total(){

    $total_numbers = connect()->prepare("SELECT * FROM equipments");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_equipments(){

    $sentence = connect()->prepare("SELECT * FROM equipments ORDER BY equipment_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_equipment_per_id($id_equipment){
    $sentence = connect()->prepare("SELECT * FROM equipments WHERE equipment_id = :equipment_id LIMIT 1");
    $sentence->execute(array(
        ':equipment_id' => $id_equipment
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// categories  ---------------------------------------

function categories_total(){

    $total_numbers = connect()->prepare("SELECT * FROM categories");
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

function get_all_categories(){

    $sentence = connect()->prepare("SELECT * FROM categories ORDER BY category_id DESC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_category_per_id($id_category){
    $sentence = connect()->prepare("SELECT * FROM categories WHERE category_id = :category_id LIMIT 1");
    $sentence->execute(array(
        ':category_id' => $id_category
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

// members ---------------------------------------

function get_active_members(){

    $sentence = connect()->prepare("SELECT * FROM members WHERE member_status = 1 ORDER BY member_id ASC"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function totalMembers($items_per_page){

    $total_items = connect()->prepare("SELECT COUNT(*) AS total FROM members");
    $total_items->execute();
    $total_items = $total_items->fetch()['total'];

    $number_pages = ceil($total_items / $items_per_page);
    return $number_pages;
}

function total_properties_by_member($id_member){

    $total_items = connect()->prepare("SELECT COUNT(*) AS total FROM properties WHERE pt_agent = $id_member");
    $total_items->execute();
    $total_items = $total_items->fetch()['total'];
    return $total_items;    

}

function get_all_members($limit = null){

    $sql = "SELECT members.*, roles.role_permissions AS role_permissions FROM members LEFT JOIN roles ON members.member_role = roles.role_id ORDER BY members.member_created DESC";

    if($limit && is_int($limit)){
        $sql .= " LIMIT $limit";
    }

    $sentence = connect()->prepare($sql); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function get_member_per_id($id_member){
    $sentence = connect()->prepare("SELECT members.*,roles.role_permissions AS role_permissions, roles.role_title AS role_title FROM members LEFT JOIN roles ON members.member_role = roles.role_id WHERE members.member_id = :member_id LIMIT 1");
    $sentence->execute(array(
        ':member_id' => $id_member
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

function members_total(){

    $total_numbers = connect()->prepare('SELECT * FROM members');
    $total_numbers->execute();
    $total_numbers->fetchAll();
    $total = $total_numbers->rowCount();
    return $total;
}

// EMAILS ---------------------------------------

function get_etemplate_by_id($id){

    $sentence = connect()->prepare("SELECT * FROM emailtemplates WHERE email_id = :email_id");
    $sentence->execute(array(
        ':email_id' => $id
    ));
    $row = $sentence->fetch();
    return ($row) ? $row : false;
}

function get_all_email_templates(){

    $sentence = connect()->prepare("SELECT * FROM emailtemplates"); 
    $sentence->execute();
    return $sentence->fetchAll();
}

function getEmailTemplate($id){

    if (!empty($id) && (int)($id)) {

        $sentence = connect()->prepare("SELECT * FROM emailtemplates WHERE email_id = :email_id");
        $sentence->execute(array(
        ':email_id' => $id
        ));
        $row = $sentence->fetch();
        return ($row) ? $row : false;

    }else{

        return null;
    }  
}

function checkMail($settings){

    $smtp = new SMTP;

//Enable connection-level debug output
//$smtp->do_debug = SMTP::DEBUG_CONNECTION;

    $result = "";

    try {
    //Connect to an SMTP server
        if (!$smtp->connect($settings['st_smtphost'], $settings['st_smtpport'])) {
         $result = "Connect failed";
     }
    //Say hello
     if (!$smtp->hello(gethostname())) {
        $result = "EHLO failed";
    }
    //Get the list of ESMTP services the server offers
    $e = $smtp->getServerExtList();
    //If server can do TLS encryption, use it
    if (is_array($e) && array_key_exists($settings['st_smtpencrypt'], $e)) {
        $tlsok = $smtp->startTLS();
        if (!$tlsok) {
            $result = 'Failed to start encryption: ' . $smtp->getError()['error'];
        }
        //Repeat EHLO after STARTTLS
        if (!$smtp->hello(gethostname())) {
            $result = 'EHLO (2) failed: ' . $smtp->getError()['error'];
        }
        //Get new capabilities list, which will usually now include AUTH if it didn't before
        $e = $smtp->getServerExtList();
    }
    //If server supports authentication, do it (even if no encryption)
    if (is_array($e) && array_key_exists('AUTH', $e)) {
        if ($smtp->authenticate($settings['st_smtpemail'], $settings['st_smtppassword'])) {
        } else{
            $result = 'Authentication failed: ' . $smtp->getError()['error'];
        }
    }

} catch (Exception $e) {
    $result = 'SMTP error: ' . $e->getMessage();
}

return $result;

}

function sendMail($array_content, $email_content, $destinationmail, $fromName, $subject, $isHtml, $settings) {

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();                                          
        $mail->Host       = $settings['st_smtphost'];                
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = $settings['st_smtpemail'];              
        $mail->Password   = $settings['st_smtppassword'];                             
        $mail->SMTPSecure = $settings['st_smtpencrypt'];
        $mail->Port       = $settings['st_smtpport'];

        $mail->setFrom($settings['st_smtpemail'], $fromName);
        $mail->CharSet = "UTF-8";
        $mail->AddAddress($destinationmail); 
        $mail->isHTML($isHtml);
        
        $find = array_keys($array_content);
        $replace = array_values($array_content);

        $mailcontent = str_replace($find, $replace, $email_content);
        $mailsubject = str_replace($find, $replace, $subject);

        $mail->Subject = $mailsubject;

        $mail->Body = $mailcontent;
        if (!$mail->send())
        {
            $result = $mail->ErrorInfo;
        }
        else 
        {
            $result = TRUE;
        }

        return $result;

    } catch (Exception $e) {
       return null;
   }

} 

// OTHERS ---------------------------------------

function get_settings(){

    $sentence = connect()->prepare("SELECT * FROM settings"); 
    $sentence->execute();
    $row = $sentence->fetch();
    return $row;
}

function FormatDate($date){

    $sentence = connect()->prepare("SELECT st_dateformat FROM settings");
    $sentence->execute();
    $row = $sentence->fetch();

    $newDate = date($row['st_dateformat'], strtotime($date));
    return $newDate;
}

function hexToRgb($hex, $alpha = false) {
 $hex = str_replace('#', '', $hex);
 $length = strlen($hex);
 $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
 $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
 $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
 if ( $alpha ) {
  $rgb['a'] = $alpha;
}

return implode(array_keys($rgb)) . '(' . implode(', ', $rgb) . ')';
}

function allowedFileExt(){
    return array("jpg", "jpeg", "png", "gif");
}

function allowedFileSize(){

    /*
    
    1Mb = 1048576;
    2Mb = 2097152;
    3Mb = 3145728;
    4Mb = 4194304;

    */

    return 1048576;
}

function get_timezone(){

    $sentence = connect()->prepare("SELECT st_timezone FROM settings");
    $sentence->execute();
    $row = $sentence->fetch();

    if(!empty($row['st_timezone'])){

        return $row['st_timezone'];

    }else{

        return "UTC";
    }

}

function getTotalOfExercisesBySingle($array) {

    $totalExerciseIds = 0;
    
    $array = json_decode($array, true);
    
    foreach ($array as $exercise) {
        if (isset($exercise['exercise_id'])) {
            $totalExerciseIds++;
        }
    }
    
    return $totalExerciseIds;
    
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

function get_date_by_timezone($format = null){

    $sentence = connect()->prepare("SELECT st_timezone FROM settings");
    $sentence->execute();
    $row = $sentence->fetch();

    $date = new DateTime("now", new DateTimeZone($row['st_timezone']) );

    if($format){
        return $date->format($format);
    }else{
        return $date->format('Y-m-d H:i');
    }

}

function remove_empty_keys($array){

    if(is_array($array)){

        foreach($array as $key => $value){
            if(empty($value)){
                unset($array[$key]);
            }
        }
        return $array;

    }else{
        return false;
    }

}

function convert_time($time){

    $output = "";
    $sentence = connect()->prepare("SELECT * FROM settings");
    $sentence->execute();
    $row = $sentence->fetch();

    if($row['st_timeformat'] == "12hour"){

        $output = date("g:i a", strtotime($time));

    }elseif($row['st_timeformat'] == "24hour"){

        $output = date("H:i", strtotime($time));

    }else{

        $output = date("H:i", strtotime($time));

    }

    return $output;

}

function get_language_from_locale($array, $locale) {

    if(!isset($array[$locale])) {
        return $locale;
    } else {
        return $array[$locale];
    }
}

?>