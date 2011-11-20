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


require_once('Cache/Lite.php');

// Set a id for this cache
$id = $_GET['id'];

// Set a few options
$options = array(
    'cacheDir' => 'tmp/',
    'lifeTime' => 3600
);

// Create a Cache_Lite object
$Cache_Lite = new Cache_Lite($options);

// Test if thereis a valide cache for this id
if ($data = $Cache_Lite->get($id)) {

} else { // No valid cache found (you have to make the page)

    require_once('XML/HTMLSax3.php');
    require_once("Handlers/$id.php");


    // Instantiate the handler
    $handler = new $id();

    $doc = file_get_contents($handler->url);

    // Instantiate the parser
    $parser =& new XML_HTMLSax3();

    // Register the handler with the parser
    $parser->set_object($handler);

    // Set a parser option
    $parser->set_option('XML_OPTION_TRIM_DATA_NODES');

    // Set the handlers
    $parser->set_element_handler('openHandler','closeHandler');
    $parser->set_data_handler('dataHandler');

    // Parse the document
    ob_start();
    ob_implicit_flush(false);
    $parser->parse($doc);
    $data = ob_get_contents();
    ob_end_clean();

    $Cache_Lite->save($data);
}

header('Content-Type: text/xml');
echo $data;

// Статистика

define("_BBC_PAGE_NAME", $id . " RSS"); 
define("_BBCLONE_DIR", "../stats/");
define("COUNTER", _BBCLONE_DIR."mark_page.php");
if (is_readable(COUNTER)) include_once(COUNTER); 
?>

