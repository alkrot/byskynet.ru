<?
	require_once("config.php");
	require_once("wall.php");
	$gid1 = '117857510';
	$res = json_decode(photosGetWallUploadServer($token3,$gid1));
	
	$image_real_path = realpath('src/1.jpg');
	
	$curl_file = curl_file_create($image_real_path,'image/jpg','test_name.jpg');
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $res->response->upload_url,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => array("photo"=>$curl_file),
		CURLOPT_HTTPHEADER => array('Content-Type: multipart/form-data; charset=UTF-8')
	));
	$result = curl_exec($ch);
	curl_close($ch);
	
	$save_img = json_decode($result);
	
	$server = $save_img->server;
	$photo = stripslashes($save_img->photo);
	$hash = $save_img->hash;
	$results = json_decode(photosaveWallPhoto($token3,$gid1,$photo,$server,$hash),true);
	var_dump($results);
	$photo = 'photo'.$results['response'][0]['owner_id'].'_'.$results['response'][0]['id'];
	echo postMessage($token3,'-'.$gid1,'test',$photo);
?>