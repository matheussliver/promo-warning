<?php
	if(isset($_POST['action']) && !empty($_POST['action'])) {
	    switch($_POST['action']) {
	        case 'adrenaline':
	        	adrenaline();
	        	break;
	        case 'hardmob' :
	        	hardmob();
	        	break;
	        case 'promobug' :
	        	promobug();
	        	break;
	    }
	}
	function adrenaline(){
		$id = $_POST['id'];
		$html = file_get_contents('http://adrenaline.uol.com.br/forum/forums/for-sale.221/');
		if(empty($html) || $html == '' || $html == null)
			return false;
		preg_match_all("/<li id=\"thread-(.*?)<\/li>/s", $html, $matches);
		if(empty($matches) || $matches == '' || $matches == null)
			return false;
		
		$arrayIds = array();
		foreach($matches[0] as $match):
			preg_match("/<li id=\"thread-(.*?)\"/s", $match, $ids);
			array_push($arrayIds, $ids[1]);
		endforeach;
		if(empty($arrayIds))
			return;
		rsort($arrayIds);
		/*if($id == 0):
			$j=0;
			for($i = 4; $i >= 0; $i--):
				preg_match("/<li id=\"thread-$arrayIds[$i]\"(.*?)<\/li>/s", $html, $matches);
				preg_match("/data-previewUrl=\"(.*?)\/preview\">/s", $matches[1], $url);
				preg_match("/preview\">(.*?)<\/a>/s", $matches[1], $title);
				$retorno[$j]['link'] = "<a href=\"http://adrenaline.uol.com.br/forum/$url[1]\" target=\"_blank\">$title[1]</a>";
				$retorno[$j++]['id'] = $arrayIds[$i];
			endfor;
			echo json_encode($retorno);
		else:*/
			if($id < $arrayIds[0]):
				preg_match("/<li id=\"thread-$arrayIds[0]\"(.*?)<\/li>/s", $html, $matches);
				preg_match("/data-previewUrl=\"(.*?)\/preview\">/s", $matches[1], $url);
				preg_match("/preview\">(.*?)<\/a>/s", $matches[1], $title);
				$retorno['link'] = "<a href=\"http://adrenaline.uol.com.br/forum/$url[1]\" target=\"_blank\">$title[1]</a>";
				$retorno['id'] = $arrayIds[0];
				echo json_encode($retorno);
			else:
				return false;
			endif;
		//endif;
	}
	function hardmob(){
		$id = $_POST['id'];
		$html = file_get_contents('http://www.hardmob.com.br/promocoes/');
		//echo htmlspecialchars($html);
		if(empty($html) || $html == '' || $html == null)
			return false;
		preg_match_all("/<li id=\"thread_(.*?)<\/li>/s", $html, $matches);
		if(empty($matches) || $matches == '' || $matches == null)
			return false;
		
		$arrayIds = array();
		foreach($matches[0] as $match):
			preg_match("/<li id=\"thread_(.*?)\"/s", $match, $ids);
			array_push($arrayIds, $ids[1]);
		endforeach;
		if(empty($arrayIds))
			return;
		
		rsort($arrayIds);
		print_r($arrayIds);
		if($id < $arrayIds[0]):
			preg_match("/<li id=\"thread_$arrayIds[0]\"(.*?)<\/li>/s", $html, $matches);
			preg_match("/<a class=\"title threadtitle_unread\" href=\"(.*?)\" id=\"/s", $matches[1], $url);
			preg_match("id=\"thread_title_$arrayIds[0]\">(.*?)<\/a>/s", $matches[1], $title);
			$title[1] = htmlspecialchars($title[1]);
			$retorno['link'] = "<a href=\"http://www.hardmob.com.br/promocoes/$url[1]\" target=\"_blank\">$title[1]</a>";
			$retorno['id'] = $arrayIds[0];
			return json_encode($retorno);
		else:
			return false;
		endif;
	}
	function promobug(){
		$id = $_POST['id'];
		$html = file_get_contents('http://www.promobugs.com.br/forums/promocoes.4/');
		
		if(empty($html) || $html == '' || $html == null)
			return false;
		preg_match_all("/<li id=\"thread-(.*?)<\/li>/s", $html, $matches);
		if(empty($matches) || $matches == '' || $matches == null)
			return false;
		
		$arrayIds = array();
		foreach($matches[0] as $match):
			preg_match("/<li id=\"thread-(.*?)\"/s", $match, $ids);
			array_push($arrayIds, $ids[1]);
		endforeach;
		if(empty($arrayIds))
			return;
		rsort($arrayIds);
		/*if($id == 0):
			$j=0;
			for($i = 4; $i >= 0; $i--):
				preg_match("/<li id=\"thread-$arrayIds[$i]\"(.*?)<\/li>/s", $html, $matches);
				preg_match("/data-previewUrl=\"(.*?)\/preview\">/s", $matches[1], $url);
				preg_match("/preview\">(.*?)<\/a>/s", $matches[1], $title);
				$retorno[$j]['link'] = "<a href=\"http://www.promobugs.com.br/$url[1]\" target=\"_blank\">$title[1]</a>";
				$retorno[$j++]['id'] = $arrayIds[$i];
			endfor;
			echo json_encode($retorno);
		else:*/
			if($id < $arrayIds[0]):
				preg_match("/<li id=\"thread-$arrayIds[0]\"(.*?)<\/li>/s", $html, $matches);
				preg_match("/data-previewUrl=\"(.*?)\/preview\">/s", $matches[1], $url);
				preg_match("/preview\">(.*?)<\/a>/s", $matches[1], $title);
				$title[1] = htmlspecialchars($title[1]);
				$retorno['link'] = "<a href=\"http://www.promobugs.com.br/$url[1]\" target=\"_blank\">$title[1]</a>";
				$retorno['id'] = $arrayIds[0];
				echo json_encode($retorno);
			else:
				return false;
			endif;
		//endif;
	}