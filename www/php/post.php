<?
	require_once("wall.php");
	include_once("config.php");
	
	date_default_timezone_set("Europe/Moscow");
	$text = "Проверка постов была в ".date("H:i:s");
	
	mysql_connect($dbhost, $dbuser, $dbpassword) or die (mysql_error ());
	mysql_select_db($dbname) or die(mysql_error());


		$select = "SELECT * FROM post order by 'id' asc limit 1";
	
		$res = mysql_query($select);
		while($row = mysql_fetch_array($res)) {
			$result = $row['messages'];
			$id = $row['id'];
			if($result != ""){
				$result = htmlspecialchars_decode($result);
				$post = postMessage($token1,'-'.$gid,$result);
				$arr = json_decode($post,true);
				if($arr["response"]["post_id"] > 0) {
					$strsql = "delete from `post` where `id` = '".$id."'";
					$result = mysql_query($strsql);
				}
			}
			break;
		}
	
	mysql_close();

	$result = wallGetSuggest($token2,'-'.$gid);
	
	$count = $result['response']['count'];

	if($count > 0){
		$post_id = $result['response']['post_id'];
		$pos = stripos($result['response']['text'],'[анон]');
		$signed = ($pos === false) ? 1 : 0;
		$attachments = $result['response']['attachments'];
		postSuggestSigned($token2,'-'.$gid,$post_id,$signed,$attachments);
	}
	
	statusSet($token2,$text,$gid);
?>