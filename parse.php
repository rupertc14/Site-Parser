<?php
//if blank page, turn on show errors
$domain = $_SERVER['SERVER_NAME'];
$uri = $_SERVER['REQUEST_URI'];
$url = str_replace('/parse.php/','',$uri);
$site_url = explode("/",$url);
$home_url = $site_url[0].'/'.$site_url[1].'/'.$site_url[2];

$url = str_replace('www.reddit.com','old.reddit.com',$url);
$url = str_replace('www.npr.org','text.npr.org',$url);
$base_url = $site_url[2];

include "specific-styling.php";

//load url
$html = file_get_contents($url);


if($html == "") {
	header('Location: /parse.php/https://duckduckgo.com/lite/?q='.$url);
}

//UI - navbar
echo '<div style="height:5%;width:75%;position:relative;left:25%;font-size:1.5em;">';
echo '<a href="/">HOME</a>';
echo '<form method="post" action="/">
			<input type="text" name="url" style="width:25%" placeholder="Search URL"/>
			<input type="submit" name="submit" value="Go"/>
		</form>';
echo '</div>';
		

//edit HTML
$html_links_repointed1 = str_replace('href="//','href="http://',$html);
$html_links_repointed2 = str_replace('href="/','href="'.$home_url.'/',$html_links_repointed1);
$html_links_repointed_http = str_replace('href="http://','href="/parse.php/http://',$html_links_repointed2);
$html_links_repointed_https = str_replace('href="https://','href="/parse.php/https://',$html_links_repointed_http);

$html_final = $html_links_repointed_https;

$html_final = site_specific($html_final, $base_url, $domain);

//output edited HTML

echo '<div style="width:100%;height:95%;position:relative;top:5%;">';
echo $html_final;
echo '</div>';
?>