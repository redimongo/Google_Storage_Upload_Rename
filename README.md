# Google Storage Rename & Upload

The code will automaticlly generate a filename based on users current time, HTTP_USER_AGENT and users current IP address.
I came up with this because Google did not have an easy way to rename an uploaded file that a user wants to upload.

Please folk this code and improve apon it.


## What this code does

* Creates a new file with the contents of the old file
* Generates a MD5 hashed filename (this should not be used as a key)
* Uploads new file to google


## What it does not do

* This code does not check to see how big the file is.
* Does not block filetypes (you may want to add this if you are only after images for example)
* Does not check to see if the image has already been uploaded (you could make a script to check if the file contents already exists in your bucket)
* Does not delete the new file once it has been uploaded to google from you local cache folder.

### COMING SOON

* Filetype allow/disallow
* UID
* Geo-location

### Follow me

 Twitter @russellharrower
