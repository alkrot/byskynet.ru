<?
	function statusSet($access_token,$text,$group_id){
		$request = "https://api.vk.com/method/status.set";
          $params = array(
            'text'     => $text,
            'group_id'      => $group_id,
            'access_token' => $access_token);
 
          $res = callMethod($request, $params);
 
          return $res;
	}

	function postMessage($access_token, $owner_id,$message,$attachments = '')    {
          $request = "https://api.vk.com/method/wall.post";
          $params = array(
            'owner_id'     => $owner_id,
            'message'      => $message,
			'attachments' => $attachments,
            'access_token' => $access_token);
 
          $res = callMethod($request, $params);
 
          return $res;
    }
	
	function postPoll( $access_token, $owner_id,$attachments)    {
          $request = "https://api.vk.com/method/wall.post";
          $params = array(
            'owner_id'     => $owner_id,
            'attachments'      => $attachments,
            'access_token' => $access_token);
 
          $res = callMethod($request, $params);
 
          return $res;
    }
	
	function postSuggestSigned($access_token,$owner_id,$post_id,$signed,$attachments){
		$request = "https://api.vk.com/method/wall.post";
          	$params = array(
            	'owner_id'     => $owner_id,
            	'signed'      => $signed,
				'attachments' => $attachments,
				'post_id' => $post_id,
            	'access_token' => $access_token);
 
          $res = callMethod($request, $params);
 
          return $res;
	}
	
	function wallGetSuggest($access_token, $owner_id){
		$request = "https://api.vk.com/method/execute.wallGetSuggest";
			$params = array(
				'owner_id'     => $owner_id,
				'access_token' => $access_token);
 
			$res = callMethod($request, $params);
 
			return json_decode($res,true);
	}
	
	function setOnline($access_token){
		$request = "https://api.vk.com/method/account.setOnline";
		$params = array(
		'voip'=> 0,
		'access_token'=> $access_token
		);
		$res = callMethod($request, $params);
	    return $res;
	}
	
	function wallAddComment($access_token,$owner_id,$post_id,$text,$reply_to_comment){
		$request = "https://api.vk.com/method/wall.addComment";
		$params = array(
		'owner_id'=>$owner_id,
		'post_id'=>$post_id,
		'from_group'=> 1,
		'text'=>$text,
		'reply_to_comment'=>$reply_to_comment,
		'access_token'=> $access_token
		);
		$res = callMethod($request, $params);
	    return $res;
	}
	
	function createPoll($access_token, $question, $owner_id, $add_answers,$is_anonymous){
		$request = "https://api.vk.com/method/polls.create";
		
		$params = array(
			'question' => $question,
			'is_anonymous'=> $is_anonymous,
			'owner_id' => $owner_id,
			'add_answers' => $add_answers,
			'access_token' => $access_token
		);
		
		$res = callMethod($request,$params);
		return $res;
	}
	
	function photosGetWallUploadServer($access_token,$group_id){
		$request ="https://api.vk.com/method/photos.getWallUploadServer";
		
		$params = array(
			'group_id' => $group_id,
			'access_token'=>$access_token
		);
		
		$res = callMethod($request,$params);
		return $res;
	}
	
	function photosaveWallPhoto($access_token,$group_id,$photo,$server,$hash){
		$request = "https://api.vk.com/method/photos.saveWallPhoto";
		$params = array(
			'group_id' => $group_id,
			'photo' => $photo,
			'server' => $server,
			'hash' => $hash,
			'v' => '5.53',
			'access_token'=> $access_token
		);
		$res = callMethod($request,$params);
		return $res;
	}
 
    function callMethod($request, $params)        {
          
          $c=curl_init();
          curl_setopt($c, CURLOPT_URL, $request);
          curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt($c, CURLOPT_POST, true);
          curl_setopt($c, CURLOPT_POSTFIELDS, $params);
          curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 10);
          curl_setopt($c, CURLOPT_TIMEOUT, 30);
          $result=curl_exec($c);
          curl_close($c);
 
          return $result;
    }
?>