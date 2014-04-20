<?php
$content = file_get_contents('index.html.1');
for ($i=strlen($content)/2-1; $i>=1; $i--) {
	print "$i length pattern search\n";
	for ($j=0; $j<strlen($content)-$i; $j++) {
		$str1 = substr($content, $j, $i);
		for ($k=1; $k<strlen($content)-$i; $k++) {
			$str2 = substr($content, $j+$k, $i);
			if ($str1 == $str2) {
				print "$str1 $str2\n";
				exit;
			}
		}
	}
}
?>
