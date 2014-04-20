<?php

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

	// Parse the document
	ob_start();
	ob_implicit_flush(false);

        require_once("DOMHandlers/$id.php");

	$data = ob_get_contents();
	ob_end_clean();

	$Cache_Lite->save($data);
}

header('Content-Type: text/xml; charset=utf-8');
echo $data;

?>
