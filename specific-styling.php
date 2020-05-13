<?php

function deleteTags($html, $start_tag, $end_tag) {
	$after_start = explode($start_tag, $html);
	if(isset($after_start[1])) {
		$between = explode($end_tag, $after_start[1])[0];
	}
	
	return $start_tag.$between.$end_tag;
}

function site_specific($html, $url, $domain) {
	if($url == "duckduckgo.com") {
		$html_links_repointed1 = str_replace('https://duckduckgo.com/l/?kh=-1&amp;uddg=','',$html);
		$html_links_repointed2 = str_replace('%3A',':',$html_links_repointed1);
		$html_links_repointed3 = str_replace('%2F','/',$html_links_repointed2);
		$html_links_repointed4 = str_replace('%2D','-',$html_links_repointed3);
		
		$find_form = deleteTags($html_links_repointed4,'<form action="/lite/" method="post"','</form>');
		$html_forms_removed1 = str_replace($find_form,'<!-- '.$find_form.' -->', $html_links_repointed4);
		
		$html = $html_forms_removed1;
	}
	
	return $html;
}

?>