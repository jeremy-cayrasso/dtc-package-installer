<?php
/**
 * Enter description here...
 * @package DTC 
 * @name 
 * @version $Id: dtc-pkg-install.php,v 1.1 2006/11/19 14:09:51 thomas Exp $
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

  $package_installer_console .= "=> Startujemy z instalacja Joomla 1.0.10 PL<br/>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  $cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];

  $data = array();
  $data["lang"] = "polish";
  $data["dbms"] = "mysql4";
  $data["upgrade"] = "0";
  $data["dbhost"] = "localhost";
  $data["dbname"] = $_REQUEST["database_name"];
  $data["dbuser"] = $dtcpkg_db_login;
  $data["dbpasswd"] = $_REQUEST["dtcpkg_db_pass"];
  $data["prefix"] = "cms_";
  $data["board_email"] = $_REQUEST["dtcpkg_email"];
  $data["server_name"] = $hostname;
  $data["server_port"] = "80";
  $data["admin_name"] = $_REQUEST["dtcpkg_login"];
  $data["admin_pass1"] = $_REQUEST["dtcpkg_pass"];
  $data["admin_pass2"] = $_REQUEST["dtcpkg_pass"];
  $data["install_step"] = "1";
  $data["cur_lang"] = "polish";

  $url = $vhost_url.$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];

//  print_r($data);
  $package_installer_console .= "=> Wywo³ujê $url<br>";
  $ret = HTTP_Post($url,$data, $url);
  $weblines = explode("\n",$ret);
// HTTP/1.1 200 OK
  $package_installer_console .= "=> Skrypt zwróci³: ".$weblines[0];
  return 0;     // Ok, no problem ! :)
}

?>
