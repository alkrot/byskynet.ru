<?
	require_once("wall.php");
	include_once("config.php");
	
	date_default_timezone_set("Europe/Moscow");
	$text = "Проверка опросов была в ".date("H:i:s");
	
	mysql_connect($dbhost, $dbuser, $dbpassword) or die (mysql_error ());
	mysql_select_db($dbname) or die(mysql_error());
	
	$select = "SELECT * FROM poll order by 'id' asc limit 1";
	
	$res = mysql_query($select);
	while($row = mysql_fetch_array($res)) {
		$id = $row['id'];
		$question = htmlspecialchars_decode($row['question']);
		$answers = html_entity_decode($row['answers']);
		$open_poll = $row['open'];
		if(strlen($question) > 0 && strlen($answers) > 0){
			$answers = json_encode(explode(',',$answers));
			$poll = createPoll($token1,$question,'-'.$gid,$answers,$open_poll);
			$arr = json_decode($poll,true);
			$poll_id = $arr['response']['poll_id'];
			$owner_id = $arr['response']['owner_id'];
			if($poll_id > 0){
				$post = postPoll($token1,$owner_id,'poll'.$owner_id.'_'.$poll_id);
				$arr = json_decode($post,true);
				if($arr["response"]["post_id"] > 0) {
					$strsql = "delete from `poll` where `id` = '".$id."'";
					$result = mysql_query($strsql);
				}
			}
		}
		break;
	}
	
	mysql_close();
	statusSet($token2,$text,$gid);
?>