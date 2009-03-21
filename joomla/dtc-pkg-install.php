<?php

require_once 'HTTP/Request.php';


/*

DTC Package installer for Joomla 1.5.9.

Problem with the HTTP_Post function is that we need to make sure that we support cookies...
Does a first get request, gets the cookies required, then does the post requests
needed.

Requires: php-http-request

Author: Mike Dawson, PAIWASTOON - mike@paiwastoon.com.af

*/


// Before calling this function, it is granted that the following parameters are valid
// (look into $_REQUEST[""] for each of them):
  // database_name=plaf&
  // dtcpkg_db_pass=xxxx&
  // dtcpkg_email=thomas%40goirand.fr&
  // dtcpkg_login=zigo&
  // dtcpkg_pass=toto&
  // action=do_install&
  // dtcpkg_directory=forums
  // pkg=phpbb&
  // subdomain=www
// On top of that the following parameters are set as global:
  // $adm_login
  // $edit_domain
  // $dtcpkg_db_login

//the language that Joomla will be installed in
$jooma_lang = 'en-US';

//things for debug / testing
$install_debug_savesteps = FALSE;
$install_debug_savesteps_path = "/var/www/joomlainstall/installation/";


function do_test_install() {
    install_joomla("http://localhost/joomlainstall", "mike@paiwastoon.com.af", "admin", "joomla_install", "installme", "joomla_install");
}

//do_test_install();

/*
 * Isolated function to do the Joomla installation so that we can use / test
 * it in another context
 *
 * joomla_base_url - the url (without /) to the base of joomla (e.g. localhost/joomla
 * admin_email - the email of the admin for Joomla
 * admin_password - the admin password for the system
 * db_username - the username for the database
 * db_password - the password for the database
 * db_dbname - the name of the database
 * admin_password - the admin password for the system
 *
 * ASSUMED FOR NOW - dbhost = localhost
 */
function install_joomla($joomla_base_url, $admin_email, $admin_password, 
    $db_username, $db_password, $db_dbname) {
   //Multi dimensional array to represent installer data - each array represents one post
  global $joomla_lang;
  global $install_debug_savesteps;
  global $install_debug_savesteps_path;
  
  //set the path to the installer file
  $installer_url = $joomla_base_url . "/installation/index.php";
  
  $data = array();

  //First step
  $data[0] = array();
  $data[0]['vars%5B%lang%5D'] = $joomla_lang;
  $data[0]['task'] = 'preinstall';

  //second
  $data[1] = array();
  $data[1]['task'] = 'license';
  
  //third
  $data[2] = array();
  $data[2]['task'] = 'dbconfig';

  //fourth
  $data[3] = array();
  $data[3]['vars%5BDBtype%5D'] = 'mysql';
  $data[3]['vars%5BDBhostname%5D'] = 'localhost';
  $data[3]['vars%5BDBuserName%5D'] = $db_username;
  $data[3]['vars%5BDBpassword%5D'] = $db_password;
  $data[3]['vars%5BDBname%5D'] = $db_dbname;
  $data[3]['vars%5BDBOld%5D'] = 'bu';
  $data[3]['vars%5BDBPrefix%5D'] = 'jos_';
  $data[3]['vars%5Blang%5D'] = 'en-US';
  $data[3]['task'] = 'makedb';
  $data[3]['vars%5BftpEnable%5D'] = '0';

  //fifth
  $data[4] = array();
  $data[4]['vars%5BftpEnable%5D'] = '0';
  $data[4]['vars%5BftpUser%5D'] = '';
  $data[4]['vars%5BftpPassword%5D'] = '';
  $data[4]['vars%5BftpRoot%5D'] = '';
  $data[4]['vars%5BftpHost%5D'] = '127.0.0.1';
  $data[4]['vars%5BftpPort%5D'] = '21';
  $data[4]['vars%5BftpSavePass%5D'] = '0';
  $data[4]['task'] = 'mainconfig';
  $data[4]['lang'] = $joomla_lang;
  
  //sixth
  $data[5] = array();
  $data[5]['vars%5BsiteName%5D'] = 'My Joomla Site';
  $data[5]['vars%5BadminEmail%5D'] = $admin_email;
  $data[5]['vars%5BadminPassword%5D'] = $admin_password;
  $data[5]['task'] = 'saveconfig';
  

  

  //do an initial post to get the first cookie
  $req =& new HTTP_Request($installer_url);
  $req->setMethod(HTTP_REQUEST_METHOD_GET);
  $req->sendRequest();
  $cookies = $req->getResponseCookies();

  echo "Checking Cookies";

  for ($i = 0; $i < sizeof($data); $i++) {
	$req =& new HTTP_Request($installer_url);
    $req->setMethod(HTTP_REQUEST_METHOD_POST);
    foreach($data[$i] as $key=>$value) {
		$req->addPostData($key, $value);
	}
	
	do_cookie_add($cookies, $req);
	
  	$req->sendRequest();
	$response = $req->getResponseBody();
    if($install_debug_savesteps) {
        $fd = fopen($install_debug_savesteps_path . "step" . $i . ".html", "w");
        fwrite($fd, $response);
        fclose($fd);
    }
    
	$package_installer_console .= "Step $i done <br/>";
  } 
}


//Utility function to add all cookies back
function do_cookie_add($cookies, $request) {
	foreach ($cookies as $current_cookie) {
		$cookiename = $current_cookie["name"];
		$cookievalue = $current_cookie["value"];
		$request->addCookie($cookiename, $cookievalue);
	}
}


/*
 * This function shall take the info required from DTC and pass it to the
 * install_joomla function
 */
function do_package_install(){
  global $package_installer_console;
  global $edit_domain;
  global $adm_login;
  global $pkg_info;
  global $dtcpkg_db_login;
  global $joomla_lang;

  $package_installer_console .= "=> Starting Joomla Install for <br>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  $cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];
  $url = $vhost_url.$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];
  $pkg_url = $vhost_url . $_REQUEST["dtcpkg_directory"] . "/";
  $rootdir = $vhost_path."/".$_REQUEST["dtcpkg_directory"] . "/";
  $installer_url = $pkg_url . "installation/index.php";

  install_joomla($pkg_url, $_REQUEST["dtcpkg_email"], $_REQUEST["dtcpkg_pass"],
      $dtcpkg_db_login, $_REQUEST["dtcpkg_db_pass"], $_REQUEST["database_name"]);

  $package_installer_console .= "<script type='text/javascript'>alert('Congratulations! Installation complete - please see the messages below for more details');</script>";
  $package_installer_console .= "<br/><b>Your new system details are</b><br/>";
  $package_installer_console .= "Site address: <a href='$pkg_url' target='_blank'>$pkg_url</a> <br/>";
  $package_installer_console .= "Administrator Address: <a href='$pkg_url/administrator/'>$pkg_url/administrator/</a><br/>";
  $package_installer_console .= "Administrator Username: admin<br/>";
  $admin_passdisplay = $_REQUEST["dtcpkg_pass"];
  $package_installer_console .= "Administrator Password: $admin_passdisplay <br/>";
  $package_installer_console .= "Thank you for using the package installer!";

  return 0;     // Ok, no problem ! :)


}

?>
