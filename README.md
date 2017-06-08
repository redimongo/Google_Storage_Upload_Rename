# Google Storage Rename & Upload
#### VERSON 0.2

The code will automaticlly generate a filename based on users current time, HTTP_USER_AGENT and users current IP address.
I came up with this because Google did not have an easy way to rename an uploaded file that a user wants to upload.

Please folk this code and improve apon it.

# To Set It Up
## Step 1
1. Install Google/Cloud using composer [Google Cloud GitHub](https://github.com/GoogleCloudPlatform/google-cloud-php)
2. Get your .JSON file and verify your domain with google.

## Step 2:
Edit google_storage_rename_upload.php

1. Put the name of your bucket here

``` $b_name = 'BUCKET NAME HERE'; ```

2. Once you have our .json file from google cloud store it in a path that is not accessable via browser (example: /home/ACCOUNTNAME/google/access_key.json)
 then put that **FULL** path below.

```putenv('GOOGLE_APPLICATION_CREDENTIALS=YOUR PATH TO JSON API CREDENTIALS');```

3. Lastly we need to get the projectID from Google Cloud, this should be all numbers.

``` $storage = new StorageClient([   'projectId' => 'XXXXXX' ]); ```

## What this code does

* Creates a new file with the contents of the old file
* Generates a MD5 hashed filename (this should not be used as a key)
* Uploads new file to google
* Deletes the newly created cache file once image is uploaded to Google Storage
* Makes uploaded file public (default) - you can bracket out the code if you don't want the uploads to be public.


## What it does not do

* This code does not check to see how big the file is.
* Does not block filetypes (you may want to add this if you are only after images for example)
* Does not check to see if the image has already been uploaded (you could make a script to check if the file contents already exists in your bucket)

### COMING SOON

* Filetype allow/disallow
* UID
* Geo-location

### Follow me

 Twitter [@russellharrower](http://twitter.com/russellharrower)
