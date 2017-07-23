<?
	include_once('config.php');
	
	mysql_connect($dbhost, $dbuser, $dbpassword) or die (mysql_error ());
	mysql_select_db($dbname) or die(mysql_error());

	$message = trim(htmlspecialchars($_POST['post_message']));
	
	if( $message != ""){
	
		$query = "INSERT INTO post (messages) VALUES ('$message')";
		$result = mysql_query($query) or die("Ошибка ". mysql_error());
		if($result) echo "Отправлено";
		else echo "Не отправленно";
	}else echo "Пустое сообщение";
	mysql_close();
?>