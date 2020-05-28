<?php

function idExists($id){
	include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
	$row = $conn->query("select * from urls where id='$id'");
	//echo "select * from urls where id='$id'";
	//var_dump($row); die;
	if($row->num_rows>0){
		return true;
	} 	else {
		return false;
	}	
}
	function getURLID($url){
		include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
		$row = $conn->query("select id from urls where link = '$url'");
		return $row->fetch_assoc()['id'];
	}
	function insertID($id,$url){
		include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
		$date = date('Y-m-d');
	$conn->query("insert into urls (id,link,hitno,createdate) values ('$id','$url',0,'$date')");
     if(strlen($conn->error)==0){
		 return true;
	 }	     		 
	}
     function urlhasbeenShortend($url){
		 include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
		 $row = $conn->query("select * from urls where link = '$url'");
		 if($row->num_rows>0){
			 return true;
		 } else {
			 return false;
		 }
	 }
	 function getUrlLocation($id){
		 include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
		$row = $conn->query("select hitno from urls where id = '$id'");
		//var_dump($row->fetch_assoc()['link']);die;
		$hitno = $row->fetch_assoc()['hitno'];
		//$url =$row->fetch_assoc()['link'];
		$newhitno = $hitno+1;
		$update = $conn->query("UPDATE urls
SET hitno = '$newhitno' WHERE id ='$id';");
$rows = $conn->query("select link from urls where id = '$id'");
		return $rows->fetch_assoc()['link'];
	 }
	 function getAllData(){
	include $_SERVER['DOCUMENT_ROOT'].'/ShortenUrl/includes/init.php';
	$row = $conn->query("select * from urls");
	//echo "select * from urls where id='$id'";
	//var_dump($row); die;
	if($row->num_rows>0){
		$table = "<table style='width:100%'>
    <th>URL</th>
    <th>Shorten URL</th>
    <th>Visits</th>
	<th>Created Date</th>";
		while ($r = $row->fetch_assoc()) {
			$table = $table."<tr>
    <td>".$r['link']."</td>
    <td><a href='http://localhost/ShortenUrl?id=$r[id]'>ShortenUrl?id=".$r['id']."</td>
    <td>".$r['hitno']."</td>
	<td>".$r['createdate']."</td>
  </tr>";

			//echo $r['id'];
}
$table = $table."</table>";
echo $table;
		//var_dump($row->fetch_assoc()); die;
		//return $result = $row->fetch_array();
	} 	else {
		return false;
	}
	 }
	 ?>