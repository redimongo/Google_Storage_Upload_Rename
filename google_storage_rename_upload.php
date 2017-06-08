<?php
/******
* NAME: Google Cloud Storeage - Image/file rename and uploaded
* AUTHOR: Russell Harrower 
* DATE: LAST UPDATED: 8/06/17
* PLEASE FEEL FREE TO IMPROVE ON THIS CODE
******/



	# Includes the autoloader for libraries installed with composer
	require '../vendor/autoload.php';
	use Google\Cloud\Storage\StorageClient;

	putenv('GOOGLE_APPLICATION_CREDENTIALS=YOUR PATH TO JSON API CREDENTIALS');
	$client = new Google_Client();
	$client->useApplicationDefaultCredentials();

	$client->setSubject($user_to_impersonate);

	$storage = new StorageClient([
      'projectId' => 'XXXXXX'
	]);



   $bucket = $storage->bucket('XXXXX');

   // CODE STARTS HERE TO GENERATE NEW FILENAME

	$new_file_name     =   md5(time().md5($_SERVER['REMOTE_ADDR']).md5($_SERVER['HTTP_USER_AGENT']));
	$path = "./test.jpg";
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$current = file_get_contents('./test.jpg');
	$rand = $new_file_name.".".$ext;
	echo $rand;
	file_put_contents("./cache/".$rand, $current);
   
   // CODE ENDS HERE

   // Upload a file to the bucket.
	$bucket->upload(
		fopen('./cache/'.$rand, 'r')
	);

?>
