# CCVShell for PHP

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CCVShell it's a virtual SSH developed for Linux and Windows Servers. CCVShell comes with two editions client version and the server version. Server version is stored in the Webhost (Web server), in the public_html (or public root) directory. The Client version is stored in your computer, it is a executable program installed using a regular windows installer and can be used via the Command Prompt. See the tutorial for help.

## COMMANDS OF CCVSHELL
- Navigation through files in the server
	-	pwd : See the current directory
	- cd : Change the current directory
- Copy, move, rename, and delete files
	- move : Move files
	- ren : Rename files in your server
	- rm : Remove files from your server (delete files)
	- copy : Copy files in your server
- Get Server information easily
	- serverinfo : Get server information
- Zipping and Unzipping files
	- zip : Zip files, add directories, and files to a specified zip file
	- unzip : Extract files to a specified location
- CPM (SSH Package Manager)
	- cpm install : Easily install packages like Twitter Bootstrap, jQuery, Materialize, Tether and etc.
- File Searching
	- search : Search files with case insensitivity and with extensions specified
- Syncing files between local and remote directories
	- sync up : upload files to the remote server
	- sync down : download remote files from the remote server to the local directory
- Using the web server as a HTML proxy
	- http : used to send HTTP GET requests to a specified server and obtain raw html data from it. Use -copy attribute to copy that to the clipboard
- Editing files without downloading and uploading.
	- edit : edit files in notepad or specified program without downloading or uploading, let ccvshell client do it's task

## INSTALLATION (SERVER)

**1. Download and copy the CCVShell directory to your public_html (or the public root) of your web server.**
You can use your cpanel or ftp to upload that directory to your web server<br><br>
**2. Create a file named *config.json* one directory up in the web server's public_html directory (previous directory, so that publicly no one can access it)**

```
{ "password" : "INSERT_PASSWORD_HERE" }
```
(This file contains the CCVShell password that is used from the client to access the server)
<br><br>
**3. You have successfully installed CCVShell Server on your web server. Install the CCVShell Client and follow the steps given there. :D**
