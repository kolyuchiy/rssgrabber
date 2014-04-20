<?php

$content = file_get_contents('index.html.1');

$tokens = array(
	'<tr><td colspan="2"><span class=mainhead4>'	=>	'beforeitem'
);

while ($content = strstr($content, $before_item)) {
	$content = substr($content, strlen($before_item), strlen($content)-strlen($before_item));
	print $content;
}

?>
