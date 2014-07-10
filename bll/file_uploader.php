<?php

try {
	
	// Undefined | Multiple Files | $_FILES Corruption Attack
	// If this request falls under any of them, treat it invalid.
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 0) {
		throw new Exception(sprintf('The server was unable to handle that much POST data (%s bytes) due to its current configuration', $_SERVER['CONTENT_LENGTH']));
	}

	if (
	!isset($_FILES['upfile']['error']) ||
	is_array($_FILES['upfile']['error'])
	) {
		throw new RuntimeException("Invalid parameters ".$_FILES['upfile']['error']." ".$_FILES['upfile']['error']);
	}
	// Check $_FILES['upfile']['error'] value.
	switch ($_FILES['upfile']['error']) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new RuntimeException('No file sent.');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			throw new RuntimeException('Exceeded filesize limit error.');
		default:
			throw new RuntimeException('Unknown errors.');
	}

	// You should also check filesize here.
	if ($_FILES['upfile']['size'] > 10000000) {
		throw new RuntimeException('Exceeded filesize limit.');
	}
	// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
	// Check MIME Type by yourself.
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	if (false === $ext = array_search(
	$finfo->file($_FILES['upfile']['tmp_name']),
	// allow pdf, tiff, tif
	array(
        'pdf' => 'application/pdf',
		'tiff' => 'image/tiff',
        'tif' => 'image/tif',
	),
	true
	)) {
		throw new RuntimeException('Invalid file format: pdf,tiff is allowed.');
	}

	// You should name it uniquely.
	// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
	// On this example, obtain safe unique name from its binary data.
	$uploaddir = '/var/www/sipcom/data/fax/faxsending/';
	$uploadfile = $uploaddir . basename($_FILES['upfile']['name']);

	if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {
		//file will be replaced if they have the same name, just what we need
		throw new RuntimeException('Failed to move uploaded file.');
	}
	//chmod($uploadfile, 0666);
	//chmod($uploaddir, 0666);

	echo 'File is uploaded successfully.';

} catch (RuntimeException $e) {

	echo $e->getMessage();

}

?>