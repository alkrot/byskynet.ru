<?
	include_once('config.php');
	mysql_connect($dbhost, $dbuser, $dbpassword) or die (mysql_error ());
	mysql_select_db($dbname) or die(mysql_error());
	$comment = trim(htmlspecialchars($_POST['comment_message']));
	$wall_url = strstr($_POST['url'],'wall');
	if( $comment != "" && $wall_url != ""){
		preg_match_all("/\d+/",$wall_url,$out);
		$group_id = -$out[0][0];
		$post_id = $out[0][1];
		$reply = count($out[0]) > 2 ? $out[0][2] : '';
		if($group_id == 0 || $post_id == 0) echo "Что то не так ссылкой"; 
		else 
		{
			$query = "INSERT INTO comment (messages,group_id,post_id,reply) VALUES ('$comment','$group_id','$post_id','$reply')";
			$result = mysql_query($query) or die("Ошибка ". mysql_error());
			if($result) echo "Отправлено"; else echo "Не отправлено";
		}
		mysql_close();
	}else echo "Пустая ссылка или комментарий";
?>