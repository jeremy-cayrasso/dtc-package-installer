<?php
/**
 * Enter description here...
 * @package DTC 
 * @name 
 * @version $Id: dtc-pkg-install.php,v 1.3 2007/05/07 19:03:12 indivision Exp $
 * @return unzip alerts
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

function do_package_install(){
  global $package_installer_console;
  global $edit_domain;
  global $adm_login;
  global $pkg_info;
  global $dtcpkg_db_login;

  $package_installer_console .= "=> Starting Joomla Installer for Joomla 1.0.12<br/>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname";

  //$cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];

  $data = array();
  $data["lang"] = "english";
  $data["dbms"] = "mysql4";
  $data["upgrade"] = "0";
  $data["DBhostname"] = "localhost";
  $data["DBname"] = $_REQUEST["database_name"];
  $data["DBuserName"] = $dtcpkg_db_login;
  $data["DBpassword"] = $_REQUEST["dtcpkg_db_pass"];
  $data["DBPrefix"] = "cms_";
  $data["sitename"] = "DTC Joomla site";
  $data["adminEmail"] = $_REQUEST["dtcpkg_email"];
  $data["adminPassword"] = $_REQUEST["dtcpkg_pass"];
  $data["absolutePath"] = $vhost_path;
  $data["siteUrl"] = $vhost_url;
  $data["DBSample"] = '1';
  $data["DBDel"] = '1';
  $data["DBBackup"] = '0';
  $data["board_email"] = $_REQUEST["dtcpkg_email"];
  $data["server_name"] = $hostname;
  $data["server_port"] = "80";
  $data["admin_name"] = $_REQUEST["dtcpkg_login"];
  $data["admin_pass1"] = $_REQUEST["dtcpkg_pass"];
  $data["admin_pass2"] = $_REQUEST["dtcpkg_pass"];
  $data["install_step"] = "1";
  $data["cur_lang"] = "english";

  #$url = $vhost_url."/".$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];

  // For some reason, Joomla has to be done in 2 steps.
  // install2.php does the database import.
  // install4.php does the rest of the configuration.

  $url = $vhost_url."/".$pkg_info["post_script_url"];
  $package_installer_console .= "=> Calling $url<br/>";
  $ret = str_replace("document","url",HTTP_Post($url,$data, $url));

  // Do the database import.
  if ( is_numeric(strpos($ret,"SUCCESS!")) )
    $package_installer_console .= "=> Database has been populated.<br/>";
  else
  {
    $package_installer_console .= "=> Database has failed import, check credentials.<br/>";
    return 1;
  }

  // Do the rest of the configuration, this writes the "configuration.php" file
  $url = $vhost_url."/".$pkg_info["install_script_url"];
  $package_installer_console .= "=> Calling $url<br/>";
  $ret = str_replace("document","url",HTTP_Post($url,$data, $url));

// Congrates message is a good sign ;)
  if ( is_numeric(strpos($ret,"Congratulations! Joomla! is installed")) )
  {
    $package_installer_console .= "=> URL return with good results.<br/>";
  }
  else
  {
    // Otherwise, Ouch!.
    $package_installer_console .= "=> Installation Failed! Check your parameters.<br/>";
    $package_installer_console .= $ret;
    return 1;
  }

  return 0;     // Ok, no problem ! :)
}
?>

