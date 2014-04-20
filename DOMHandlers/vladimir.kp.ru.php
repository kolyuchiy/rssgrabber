<?php

        require_once('rss.php');

	$html = file_get_contents('http://vladimir.kp.ru/');
	$html = iconv('windows-1251', 'utf-8//IGNORE', $html);

	$html = '
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
' . $html;

	error_reporting(E_ALL & ~E_WARNING);

	$doc = new DOMDocument();
	$doc->preserveWhiteSpace = false;
	$doc->loadHTML($html);

	$xp = new DOMXPath($doc);

	$entries = array();
	$entries[0] = $xp->query('//*[@id="top-atricle"]/div[@class="text"]')->item(0);
	$entries[1] = $xp->query('//*[@id="second-article"]/div[@class="text"]')->item(0);
	$entries[2] = $xp->query('//*[@id="third-article"]/div[@class="text"]')->item(0);

	RSSWriter::beginRSS(
	'utf-8',
	'Комсомольская правда Владимир',
	'http://vladimir.kp.ru/',
	'Новостная лента',
	'ru');

	foreach($entries as $entry) {
		$title = $entry->childNodes->item(1)->textContent;
		$href = $entry->childNodes->item(1)->childNodes->item(0)->attributes->item(0)->nodeValue;
		$description = $entry->childNodes->item(5)->textContent;

		RSSWriter::doItem($href, $title, $description);
	}

	RSSWriter::endRSS();

?>
