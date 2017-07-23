	function addLi(){
		var list = document.getElementById('answers');
		var children = list.childNodes;
		var count = children.length - 1;
		if(count == 11){
			return error('Больше 10 нельзя');
		}else{
			var li = document.createElement('LI');
	
			li.innerHTML = '<input type="text" class="answer_poll" name="answer' + count +  '" placeholder="Вариант ответа">';
			list.appendChild(li);
		}
		delError();
	}
	
	function deleteLi(){
		delError();
		var list = document.getElementById('answers');
		var children = list.childNodes;
		var count = children.length - 1;
		if(count == 2){
			return error('Нужен хотя бы один ответ');
		}
		var lastNode = list.lastChild;
		while(lastNode && lastNode.nodeType!=1) {
			//перейти к предыдущему узлу
			lastNode = lastNode.previousSibling;
			}
			//если у узла myID мы нашли элемент
		if (lastNode) {
			//то его необходимо удалить
			lastNode.parentNode.removeChild(lastNode);
		}
	}
	
	function isAnon(){
		var check = document.getElementById('anon_poll').checked;
		if(check){
			document.getElementById('btn_anon').innerHTML = 'Открытый';
			document.getElementById('anon_poll').checked = !check;
		}else{
			document.getElementById('btn_anon').innerHTML = 'Анонимный';
			document.getElementById('anon_poll').checked = !check;
		}
	}
	
	function error(msg){
		var error = document.getElementById('error');
		error.innerHTML = msg;
		return false;
	}
	
	function delError(){
		var error = document.getElementById('error');
		if(error) error.innerHTML ="";
	}
	
	function placeHolder(id) {
		var el = document.getElementById(id);
		if(el.innerHTML){
			el.innerHTML = "";
		}else{
			el.innerHTML = "Введите текст";
		}
	}
