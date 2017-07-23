<?
	require_once("wall.php");
	require_once("config.php");
	
	date_default_timezone_set("Europe/Moscow");
	$text = "Проверка комментариев была в ".date("H:i:s");
	
	mysql_connect($dbhost, $dbuser, $dbpassword) or die (mysql_error ());
	mysql_select_db($dbname) or die(mysql_error());


	$select = "SELECT * FROM comment order by 'id' asc limit 1";
	
		$res = mysql_query($select);
		while($row = mysql_fetch_array($res)) {
			$id = $row['id'];
			$result = $row['messages'];
			$group_id = $row['group_id'];
			$post_id = $row['post_id'];
			$reply = $row['reply'];
			if($result != ""){
				$result = htmlspecialchars_decode($result);
				$comment = wallAddComment($token1,$group_id,$post_id,$result,$reply); 
				$arr = json_decode($comment,true);
				if($arr["response"]["cid"] > 0) {
					//$strsql = "delete from `users` order by `id` asc limit 1";
					$strsql = "delete from `comment` where `id` = '".$id."'";
					$result = mysql_query($strsql);
				}
			}
			break;
		}
	statusSet($token2,$text,$gid);
	mysql_close();
?>