<?php

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

if(check_session() == true){

if(check_permission('view_settings') || check_permission('edit_settings')){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

if(check_permission('edit_settings')){

	$st_dateformat = $_POST['st_dateformat'];
	$st_timezone = $_POST['st_timezone'];
	$st_recipientemail = $_POST['st_recipientemail'];
	$st_smtphost = $_POST['st_smtphost'];
	$st_smtpemail = $_POST['st_smtpemail'];
	$st_smtppassword = $_POST['st_smtppassword'];
	$st_smtpencrypt = $_POST['st_smtpencrypt'];
	$st_smtpport = $_POST['st_smtpport'];
	$st_aboutus = $_POST['st_aboutus'];
	$st_privacypolicy = $_POST['st_privacypolicy'];
	$st_termsofservice = $_POST['st_termsofservice'];

	$statment = connect()->prepare(
	"UPDATE settings SET
	st_dateformat = :st_dateformat,
	st_timezone = :st_timezone,
	st_recipientemail = :st_recipientemail,
	st_smtphost = :st_smtphost,
	st_smtpemail = :st_smtpemail,
	st_smtppassword = :st_smtppassword,
	st_smtpencrypt = :st_smtpencrypt,
	st_smtpport = :st_smtpport,
	st_aboutus = :st_aboutus,
	st_privacypolicy = :st_privacypolicy,
	st_termsofservice = :st_termsofservice
	
	");

	$statment->execute(array(
	':st_dateformat' => $st_dateformat,
	':st_timezone' => $st_timezone,
	':st_recipientemail' => $st_recipientemail,
	':st_smtphost' => $st_smtphost,
	':st_smtpemail' => $st_smtpemail,
	':st_smtppassword' => $st_smtppassword,
	':st_smtpencrypt' => $st_smtpencrypt,
	':st_smtpport' => $st_smtpport,
	':st_aboutus' => $st_aboutus,
	':st_privacypolicy' => $st_privacypolicy,
	':st_termsofservice' => $st_termsofservice
	));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{

header('Location: ./denied.php');		

}

}

$settings = get_settings();

require '../views/settings.view.php';

}else{

header('Location: ./denied.php');		

}

}else{

header('Location:'.SITE_URL);

}

?>