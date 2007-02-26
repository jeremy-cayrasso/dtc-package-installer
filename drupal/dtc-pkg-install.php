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

  $package_installer_console .= "=> Starting Drupal Installer for Drupal 5.1<br>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  $cmd = "mv ".$vhost_path."/".$pkg_info["directory"]." ".$vhost_path."/".$_REQUEST["dtcpkg_directory"];

  //inserting the database dump
  $mysql_ver = mysql_get_server_info(); //i must add different db schemas for different mysql version
  $package_installer_console .= "=> Inserting the Drupal 5.1 database schemas for you MySQL: ".$mysql_ver."<br>";
  if (ereg('^4.0', $mysql_ver)) {
  $db_name = 'database.4.0.mysql';
  }else{
  $db_name = 'database.4.1.mysql';
  }
  $database = "mysql -u ".$dtcpkg_db_login." -p".$_REQUEST["dtcpkg_db_pass"]." ".$_REQUEST["database_name"]." < ".$vhost_path."/".$_REQUEST["dtcpkg_directory"]."/database/".$db_name;
  exec($database);
  
  //update the drupal config file
  $package_installer_console .= "=> Changing Drupal Drupal 5.1 configuration file...<br>";
  if($_REQUEST["dtcpkg_directory"] == ""){
    $dest_dir = $vhost_path;
  }else{
    $dest_dir = $vhost_path."/".$_REQUEST["dtcpkg_directory"];
  }
  
  $fname= $dest_dir."/sites/default/settings.php";
  $ar=file($fname);
  for ($k=0;$k<count($ar);$k++){
    if (ereg('^\$db_url.+', $ar[$k])) {
    $ar[$k] = '$db_url = \'mysql://'.$dtcpkg_db_login.':'.$_REQUEST["dtcpkg_db_pass"].'@localhost/'.$_REQUEST["database_name"].'\';';
    }
  }
  
  $fp=fopen($fname,"w");
  if($fp == FALSE){
    $package_installer_console .= "<font color=\"red\">Cannot open Drupal config file!</font><br>";
    return 1;
  }
  fwrite($fp,join("",$ar));
  fclose($fp);
  
  if($_REQUEST["dtcpkg_directory"] == ""){
    $dest_dir = $vhost_url;
  }else{
    $dest_dir = $vhost_url.$_REQUEST["dtcpkg_directory"];
  }
  $package_installer_console .= "=> Installation OK!! Remember to go in <a href=\"".$dest_dir."\" target=\"blank\">your new Drupal site and create the first account!</a><br>";
  
  return 0;     // Ok, no problem ! :)
}

?>
