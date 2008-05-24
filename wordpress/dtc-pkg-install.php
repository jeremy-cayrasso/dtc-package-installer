<?php

// Before calling this function, it is granted that the following parameters are valid
// (look into $_REQUEST[""] for each of them):
  // database_name=wordpress&
  // dtcpkg_db_pass=xxxx&
  // dtcpkg_login=yourDTClogin&
  // dtcpkg_pass=yourDTCpassword&
  // action=do_install&
  // dtcpkg_directory=wordpress
  // pkg=wordpress&
  // subdomain=www
// On top of that the following parameters are set as global:
  // $adm_login
  // $edit_domain
  // $dtcpkg_db_login

function do_package_install(){
  global $package_installer_console;
  global $edit_domain;
  global $adm_login;
  global $pkg_info;
  global $dtcpkg_db_login;

  $package_installer_console .= "=> Installer Preparing Configuration for WordPress 2.5.1<br>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  $cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];

  $data = array();
  $data["lang"] = "english";
  $data["dbms"] = "mysql4";
  $data["upgrade"] = "0";
  $data["dbhost"] = "localhost";
  $data["dbname"] = $_REQUEST["database_name"];
  $data["dbuser"] = $dtcpkg_db_login;
  $data["dbpasswd"] = $_REQUEST["dtcpkg_db_pass"];
  $data["prefix"] = "wordpress_";
  $data["server_name"] = $hostname;
  $data["server_port"] = "80";
  $data["admin_name"] = $_REQUEST["dtcpkg_login"];
  $data["admin_pass1"] = $_REQUEST["dtcpkg_pass"];
  $data["admin_pass2"] = $_REQUEST["dtcpkg_pass"];
  $data["install_step"] = "1";
  $data["cur_lang"] = "english";

//Prepare WordPress Configuration
  function keygen ($length) {
    $key = '';
    for($i = 0; $i < $length; $i++)
        $key .= chr(rand(40,127));
    return $key;
  }

  $wpconfig = array();
  $wpconfig["gophp"] = "<?php";
  $wpconfig["dbname"] = "define('DB_NAME','".$data["dbname"]."');";
  $wpconfig["dbuser"] = "define('DB_USER','".$data["dbuser"]."');";
  $wpconfig["dbpasswd"] = "define('DB_PASSWORD','".$data["dbpasswd"]."');";
  $wpconfig["dbhost"] = "define('DB_HOST','localhost');";
  $wpconfig["dbcharset"] = "define('DB_CHARSET','utf8');";
  $wpconfig["dbcollate"] = "define('DB_COLLATE','');";
  $wpconfig["seckey"] = "define('SECRET_KEY','".keygen(25)."');";
  $wpconfig["tblpfx"] = "$"."table_prefix = 'wp_';";
  $wpconfig["wplang"] = "define('WPLANG','');";
  $wpconfig["abspath"] = "define('ABSPATH',dirname(__FILE__).'/');";
  $wpconfig["req_once"] = "require_once(ABSPATH.'wp-settings.php');";
  $wpconfig["nophp"] = "?>";
  
  $wpconf_str = implode("\n",$wpconfig);
  
//Write WordPress Config File
  if (!file_put_contents($vhost_path."/".$_REQUEST["dtcpkg_directory"]."/wp-config.php",$wpconf_str))
    $package_installer_console .= "=> Error Writing WordPress Configuration 'wp-config.php'<br>";
  else
    $package_installer_console .= "=> WordPress Configuration 'wp-config.php' written<br>";

//Set url for post install script, currently not used,
//but returns HTTP/1.1 200 OK on WordPress install success.
  $url = $vhost_url.$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];

//  print_r($data);
  $package_installer_console .= "=> Calling $url<br>";
  $ret = HTTP_Post($url,$data, $url);
  $weblines = explode("\n",$ret);
// HTTP/1.1 200 OK
  $package_installer_console .= "=> Script returns: ".$weblines[0]."\n\n";
  $package_installer_console .= "WordPress will ask for a blog name and admin email address the first time you run it.\n
  WordPress will then show your admin login and password.  Write it down to avoid trouble!\n\n";
  return 0;     // Ok, no problem ! :)
}

?>
