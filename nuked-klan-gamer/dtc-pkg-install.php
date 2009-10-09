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

  $package_installer_console .= "=> Starting nuked-klan Installer for nuked-klan 1.7.7<br>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  $cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];
  
  $data= array();
  $data['board_email'] = $_REQUEST['dtcpkg_email'];
  $data['install_pseudo'] = $_REQUEST['dtcpkg_login'];
  $data['install_pass'] = $_REQUEST['dtcpkg_pass'];
  $data['db_name'] = $_REQUEST['database_name'];
  $data['db_user'] = $dtcpkg_db_login;
  $data['db_passwd'] = $_REQUEST['dtcpkg_db_pass'];


  $url = $vhost_url.$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];

//  print_r($data);
  $package_installer_console .= "=> Calling $url<br>";
  $ret = HTTP_Post($url,$data, $url);
  $weblines = explode("\n",$ret);
// HTTP/1.1 200 OK
  $package_installer_console .= "=> Script returns: ".$weblines[0];
  return 0;     // Ok, no problem ! :)
}
?>
