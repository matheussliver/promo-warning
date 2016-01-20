<?php
	function adrenaline($id = 0){
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
		if($id < $arrayIds[0]):
			preg_match("/<li id=\"thread-$arrayIds[0]\"(.*?)<\/li>/s", $html, $matches);
			preg_match("/data-previewUrl=\"(.*?)\/preview\">/s", $matches[1], $url);
			preg_match("/preview\">(.*?)<\/a>/s", $matches[1], $title);
			echo "<a href=\"http://adrenaline.uol.com.br/forum/$url[1]\" target=\"_blank\">$title[1]</a>";
		else:
			return false;
		endif;
	}
	function hardmob($id = 0){
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
			echo "<a href=\"http://www.hardmob.com.br/promocoes/$url[1]\" target=\"_blank\">$title[1]</a>";
		else:
			return false;
		endif;
	}
	function promobug($id = 0){
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
		if($id < $arrayIds[0]):
			preg_match("/<li id=\"thread-$arrayIds[0]\"(.*?)<\/li>/s", $html, $matches);
			preg_match("/data-previewUrl=\"(.*?)\/preview\">/s", $matches[1], $url);
			preg_match("/preview\">(.*?)<\/a>/s", $matches[1], $title);
			echo "<a href=\"http://www.promobugs.com.br/$url[1]\" target=\"_blank\">$title[1]</a>";
		else:
			return false;
		endif;
	}
	adrenaline();
	echo '<br>';
	promobug();