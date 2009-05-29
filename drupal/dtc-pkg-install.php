<?php

//i need to update this to new drupal version and fix all the code!!

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

  $package_installer_console .= "=> Starting Drupal Installer for Drupal 5.1<br />";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  $cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];

  //inserting the database dump
  $mysql_ver = mysql_get_server_info(); //i must add different db schemas for different mysql version
  $package_installer_console .= "=> Inserting the Drupal 5.1 database schemas for you MySQL: ".$mysql_ver."<br />";
  if (ereg('^4.0', $mysql_ver)) {
    $db_driver='mysql';
  }else{
    $db_driver='mysqli';
  }
  
  //update the drupal config file
  $package_installer_console .= "=> Changing Drupal Drupal 5.1 configuration file...<br />";
  if($_REQUEST["dtcpkg_directory"] == ""){
    $dest_dir = $vhost_path;
  }else{
    $dest_dir = $vhost_path."/".$_REQUEST["dtcpkg_directory"];
  }
  
  $fname= $dest_dir."/sites/default/settings.php";
  $ar=file($fname);
  for ($k=0;$k<count($ar);$k++){
    if (ereg('^\$db_url.+', $ar[$k])) {
    $ar[$k] = '$db_url = \''.$db_driver.'://'.$dtcpkg_db_login.':'.$_REQUEST["dtcpkg_db_pass"].'@localhost/'.$_REQUEST["database_name"]."';\n";
    }
  }
  
  $fp=fopen($fname,"w");
  if($fp == FALSE){
    $package_installer_console .= "<font color=\"red\">Cannot open Drupal config file!</font><br />";
    return 1;
  }
  fwrite($fp,join("",$ar));
  fclose($fp);
  
  if($_REQUEST["dtcpkg_directory"] == "") {
    $dest_dir = $vhost_url;
  }else{
    $dest_dir = $vhost_url.$_REQUEST["dtcpkg_directory"];
  }

  $data=array();
  $data['profile']='default';
  $url = $dest_dir."/".$pkg_info["install_script_url"];
  $package_installer_console .= "=> Calling $url<br />";
  $ret = HTTP_Get($url, $data, $url);

  if ( is_numeric(strpos($ret,"Drupal already installed")) ) {
    $package_installer_console .= "=> Warning: Drupal database tables already exist!<br />";
    $package_installer_console .= "=> (You must manually drop the tables if desired.)<br />";
  }
    elseif ( ! is_numeric(strpos($ret,'Congratulations, Drupal has been successfully installed.')) )
  {
    $package_installer_console .= "=> Installation Failed! Check your parameters.<br />";
    $package_installer_console .= $ret;
    return 1;
  }

  $package_installer_console .= "=> Installation Success.<br />";
  $package_installer_console .= "=> You need to go to <a href=\"".$dest_dir."\" target=\"blank\">your new Drupal site</a> to create the first account and complete the setup!<br />";

  return 0;     // Ok, no problem ! :)
}

?>
