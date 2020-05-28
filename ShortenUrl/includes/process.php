<?php
//print_r($_POST);
include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/functions.php';
$id = rand(111,999);
$url = $_POST['url'];
//echo $id; echo $url; die;
if(idExists($id)==true){
	$id = rand(111,999);
}
if(urlhasbeenShortend($url)) {
	//echo "http://localhost/ShortenUrl?id=".getURLID($url);
	return true;
}
insertID($id,$url);

?>