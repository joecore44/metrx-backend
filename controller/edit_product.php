<?php 

/*--------------------*/
// Description: FitPro - Personal Trainer
// Author: Wicombit
// Author URI: https://www.wicombit.com
/*--------------------*/

require '../config.php';
require '../functions.php';

$errors = array();

if(check_session() == true){

$id_product = cleardata(getId());

if(!$id_product){
	header('Location: home.php');
}

if(check_permission('view_products') || check_permission('edit_products')){

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(check_permission('edit_products')){

	$product_id = cleardata($_POST['product_id']);
	$product_title = cleardata($_POST['product_title']);
	$product_description = cleardata($_POST['product_description']);
	$product_status = cleardata($_POST['product_status']);
	$product_link = cleardata($_POST['product_link']);
	$product_price = cleardata($_POST['product_price']);
	$product_old_price = cleardata($_POST['product_old_price']);
	$product_availability = cleardata($_POST['product_availability']);
	$product_featured = cleardata($_POST['product_featured']);
	$product_tags = (isset($_POST['product_tags']) && !empty($_POST['product_tags']) ? json_encode($_POST['product_tags']) : "");

	$required_fields = ['product_title', 'product_link', 'product_price'];

	foreach($required_fields as $field) {
		if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]))) {
				$errors[] = "<b>".$field."</b> " . _ERRORREQUIREDFIELD;  
		}
	}
	
	$image = ['product_image' => isset($_FILES['product_image']['name']) && !empty($_FILES['product_image']['name'])];

	$uploadedImages = [];

	foreach(['product_image'] as $image_key) {

		if($image[$image_key]) {

			$file_name = $_FILES[$image_key]['name'];
			$file_size = $_FILES[$image_key]['size'];
			$file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_temp = $_FILES[$image_key]['tmp_name'];

			if (!in_array($file_extension, allowedFileExt())) {

				$errors[] = "<b>".$image_key."</b> " . _ERRORALLOWEDFILEFORMATS;  
	
			} else if ($file_size > allowedFileSize()) {
	
				$errors[] = "<b>".$image_key."</b> " . _ERRORFILETOOLARGE;  
	
			}

			if(empty($errors)){

				$image_new_name = md5(time()) . '.' . $file_extension;
				move_uploaded_file($file_temp, $target_dir . $image_new_name);
				$uploadedImages += [$image_key => $image_new_name];

			}

		}

	}

	if(empty($errors)){

	$statment = connect()->prepare("UPDATE products SET
	product_title = :product_title,
	product_description = :product_description,
	product_status = :product_status,
	product_tags = :product_tags,
	product_link = :product_link,
	product_price = :product_price,
	product_old_price = :product_old_price,
	product_availability = :product_availability,
	product_featured = :product_featured,
	product_image = :product_image
	WHERE product_id = :product_id");

	$statment->execute(array(
	':product_id' => $product_id,
	':product_title' => $product_title,
	':product_description' => $product_description,
	':product_status' => $product_status,
	':product_tags' => (isset($_POST['product_tags']) && !empty($_POST['product_tags']) ? $product_tags : ""),
	':product_link' => $product_link,
	':product_price' => $product_price,
	':product_old_price' => $product_old_price,
	':product_availability' => $product_availability,
	':product_featured' => $product_featured,
	':product_image' => (isset($uploadedImages['product_image']) ? $uploadedImages['product_image'] : $_POST['product_image_save'])
	));

	header('Location: ' . $_SERVER['HTTP_REFERER']);

}
		
}else{

header('Location: ./denied.php');		

}

}

$productDetails = get_product_per_id($id_product);

if(!$productDetails){
	header('Location: home.php');
}

$tags = get_all_product_tags();

require '../views/edit.product.view.php';

}else{

header('Location: ./denied.php');		

}

}else{

header('Location:'.SITE_URL);

}

?>