<?php 


/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

session_start();

include '../classes/csrf.php';
require '../config.php';
require '../functions.php';

$csrf = new CSRF();

$errors = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$captcha = $_POST["captcha"];
$captchaMember = cleardata($_POST['captcha']);

if(isset($_SESSION['CAPTCHA_CODE']) && $_SESSION['CAPTCHA_CODE'] == $captchaMember){

if ($csrf->validate('login-token')) {

	$member_email = filter_var(strtolower($_POST['member_email']), FILTER_SANITIZE_EMAIL);
	$member_password = cleardata($_POST['member_password']);
	$password = hash('sha512', $member_password);

	try{        
	$connect;

	}catch (PDOException $e){

	echo "Error: ." . $e->getMessage();  

	}

	$statement = connect()->prepare("SELECT members.*, roles.* FROM members LEFT JOIN roles ON members.member_role = roles.role_id WHERE member_email = :member_email AND member_password = :member_password AND member_status = 1");
	
	$statement->execute(array(
	':member_email' => $member_email,
	':member_password' => $password
	));

	$result_login = $statement->fetch();

	if($result_login !== false){

	$_SESSION['signedin'] = true;
	$_SESSION['member_email'] = $member_email;
	$_SESSION['member_name'] = $result_login['member_name'];

	header('Location: ./home.php');

	}else{

	$errors .= _LOGINACCESSDENIED;

	}

}else{

	$errors .= _LOGININVALIDTOKEN;
}

}else{

	$errors .= _LOGININVALIDCAPTCHA;
}

}
	  
require '../views/header.view.php';
require '../views/login.view.php';
require '../views/footer.view.php';

?>