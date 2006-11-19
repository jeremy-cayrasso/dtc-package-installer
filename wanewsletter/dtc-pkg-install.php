<?php

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

  global $conf_mysql_db;

  $package_installer_console .= "=> Starting phpBB Installer for wanewsletter 2.3.0<br>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";
  $vhost_url2 = "http://$hostname";

  if($_REQUEST["dtcpkg_directory"] == ""){
    $dest_dir = $vhost_path;
  }else{
    $dest_dir = $vhost_path."/".$_REQUEST["dtcpkg_directory"];
  }

  $url = $vhost_url2.$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];
/*Todo: uncomment and make the following work:
  $data = array();
  $data["admin_email"] = $_REQUEST["dtcpkg_email"];
  $data["admin_login"] = $_REQUEST["dtcpkg_login"];
  $data["admin_pass"] = $_REQUEST["dtcpkg_pass"];
  $data["confirm_pass"] = $_REQUEST["dtcpkg_pass"];

  $data["dbname"] = $_REQUEST["database_name"];
  $data["driver"] = "mysql";
  $data["host"] = "localhost";

  $data["language"] = "francais";
  $data["pass"] = $_REQUEST["dtcpkg_db_pass"];
  $data["prefix"] = "wa_";

  $data["prev_language"] = "francais";
  $data["start"] = "Démarrer l'installation";
  $data["urlscript"] = $_REQUEST["dtcpkg_directory"]."/";
  $data["urlsite"] = $vhost_url;
  $data["user"] = $dtcpkg_db_login;
  $data[""] = "";

  echo "<pre>"; print_r($data); echo "</pre>";

  $package_installer_console .= "=> Calling $url<br>";
  $ret = HTTP_Post($url,$data, $url);
  $weblines = explode("\n",$ret);
  $package_installer_console .= "=> Script returns: ".$weblines[0];
*/
  $package_installer_console .= "Please finish the installation here:<br><a href=\"$url\">$url</a><br>";
  return 0;     // Ok, no problem ! :)
}

?>