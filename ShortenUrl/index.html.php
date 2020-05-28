<?php
include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/functions.php';
if(isset($_GET['id'])){
	$id =$_GET['id'];
 $url = getUrlLocation($id);
header('Location:'.$url);
}	
?>
<?php 
echo phpinfo();?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
<title>Shorten Url</title>
</head>
<body>
<input type ="text" name= "url">
<input type="submit" name="shorten url" value="Shorten Url">
<p class="errors"></p>
<p class="listview"></p>
<script type="text/javascript">
$(document).ready(function(){
	$('input[type="submit"]').click(function(e){
		e.preventDefault();
		$('.errors').html('');
		var url = $('input[name="url"]').val();
		if(url.length == 0) {
			$('.errors').html('Enter valid url');
		}
		$.post('/ShortenUrl/includes/process.php',{
			url:url
		}, function(data,textStatus,xhr){
			$.post('/ShortenUrl/includes/listurls.php',{	
		}, function(data,textStatus,xhr){
			$('.listview').html(data);
	});
		});
		
		});
		$.post('/ShortenUrl/includes/listurls.php',{	
		}, function(data,textStatus,xhr){
			$('.listview').html(data);
	});
});
</script>
</body>
</html>