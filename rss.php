<?php
    /*
RSS Grabber / Выдиралка RSS
Converts any HTML page to RSS feed
Copyright (C) 2004  Kolia Morev <kolyuchiy@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
     */

class RSSWriter {

    function beginRSS($encoding, $title, $link, $description, $language) {
        $output = <<<xml
<?xml version="1.0" encoding="$encoding"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
	<channel>
		<title>$title</title>
		<link>$link</link>
		<description>$description</description>
		<language>$language</language>

xml;
        echo $output;
    }

    function endRSS() {
        $output = <<<xml

	</channel>
</rss>
xml;
        echo $output;
    }

    function beginItem() {
        $output = <<<xml
		<item>

xml;
        echo $output;
    }

    function endItem() {
        $output = <<<xml

		</item>

xml;
        echo $output;
    }

    function beginTitle() {
        echo "\t\t\t<title>";
    }

    function endTitle() {
        echo "</title>\n";
    }

    function putTitle($data) {
        echo $data;
    }

    function beginDescription() {
        echo "\t\t\t<description>";
    }

    function endDescription() {
        echo "</description>\n";
    }

    function putDescription($data) {
        echo $data;
    }

    function beginLink() {
        echo "\t\t\t<link>";
    }

    function endLink() {
        echo "</link>\n";
    }

    function putLink($data) {
        echo $data;
    }

    function doItem($link, $title, $description = NULL) {
    	print "
    	<item>
    		<link>$link</link>
    		<title>$title</title>
    		";
    	if (isset($description)) {
    		print "
    		<description>$description</description>
    		";
    	}
    	print "
    	</item>
    	";
    }
}

?>
