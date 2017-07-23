<?
	include_once('config.php');
	mysql_connect($dbhost, $dbuser, $dbpassword) or die (mysql_error ());
	mysql_select_db($dbname) or die(mysql_error());
	
	$question = trim(htmlspecialchars(array_shift($_POST)));
	if(isset($_POST['anon_poll'])){
		$open_poll = 1;
		unset($_POST['anon_poll']);
	}else {
		$open_poll = 0;
	}
	
	$answers = trim(htmlspecialchars(implode(',',array_filter($_POST))));
	if($question !="" && strlen($answers) > 0){
		$answers = $answers;
		$query = "INSERT INTO poll (question,answers,open) VALUES ('$question','$answers','$open_poll')";
		$result = mysql_query($query) or die("Ошибка ". mysql_error());
		if($result) echo "Отправлено";
		else echo "Не отправленно";
		mysql_close();
	}else echo "Пустой заголовок или варианты ответов не заполнены";
?>