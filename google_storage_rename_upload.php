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
	$b_name = 'BUCKET NAME HERE';


 
   $bucket = $storage->bucket($b_name);

   
	$new_file_name     =   md5(time().md5($_SERVER['REMOTE_ADDR']).md5($_SERVER['HTTP_USER_AGENT']));
	$path = "./test.jpg";
	$ext = pathinfo($path, PATHINFO_EXTENSION);
	$current = file_get_contents('./test.jpg');
	$rand = $new_file_name.".".$ext;
	file_put_contents("./cache/".$rand, $current);
   
	// Upload a file to the bucket.
	$bucket->upload(
		fopen('./cache/'.$rand, 'r')
	);
	
	// Removes new file from cache/
	unlink('./cache/'.$rand);

	// makes uploaded file publicly accessable
	function make_public($bucketName, $objectName)
	{
		$storage = new StorageClient();
		$bucket = $storage->bucket($bucketName);
		$object = $bucket->object($objectName);
		$object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
	//	printf('gs://%s/%s is now public' . PHP_EOL, $bucketName, $objectName);
	}

	make_public($b_name,$rand);

	echo "<h1>FILE UPLOADED</h1><p>You can now view the file at <a href='//storage.googleapis.com/".$b_name."/".$rand."' target='_blank' title='New upload'>//storage.googleapis.com/".$b_name."/".$rand."</a></p>"



?>
