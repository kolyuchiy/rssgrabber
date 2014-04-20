<?php

        require_once('rss.php');

	$html = file_get_contents('http://vladimir.rfn.ru/');
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

        $entries = $xp->query('/html/body/table[3]/tbody/tr/td[3]/table');

	RSSWriter::beginRSS(
	'utf-8',
	'Владимирская ГТРК',
	'http://vladimir.rfn.ru/',
	'Новостная лента',
	'ru');

	$i = 0;
	foreach($entries as $entry) {
		$i++;
		if ($i == 1) continue;
		$title = $entry->lastChild->firstChild->textContent;
		$href = 'http://vladimir.rfn.ru/'.$entry->lastChild->firstChild->firstChild->firstChild->firstChild->attributes->item(0)->nodeValue;
		$description = $entry->lastChild->childNodes->item(1)->nodeValue;

		RSSWriter::doItem($href, $title, $description);
	}

	RSSWriter::endRSS();

?>
