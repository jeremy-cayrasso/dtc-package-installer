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

  $package_installer_console .= "=> Starting phpBB Installer for PHPBB 2.0.17<br>";
  $admin_path = getAdminPath($adm_login);
  $vhost_path = $admin_path."/".$edit_domain."/subdomains/".$_REQUEST["subdomain"]."/html";
  $hostname = $_REQUEST["subdomain"].".".$edit_domain;
  $vhost_url = "http://$hostname/";

  if($_REQUEST["dtcpkg_directory"] == ""){
    $dest_dir = $vhost_path;
  }else{
    $dest_dir = $vhost_path."/".$_REQUEST["dtcpkg_directory"];
  }

  $config_php_file = '<?php
$dbhost = "localhost";
$dbuname = "'.$dtcpkg_db_login.'";
$dbpass = "'.$_REQUEST["dtcpkg_db_pass"].'";
$dbname = "'.$_REQUEST["database_name"].'";
$prefix = "nuke";
$user_prefix = "nuke";
$dbtype = "MySQL";
$sitekey = "S·kQSd5%W@Y62-dm29-.-39.3a8sUf+W9";
$gfx_chk = 0;
$subscription_url = "";
$admin_file = "admin";
$advanced_editor = 0;
$reasons = array("As Is","Offtopic","Flamebait","Troll","Redundant","Insighful","Interesting","Informative","Funny","Overrated","Underrated");
$badreasons = 4;
$AllowableHTML = array("b"=>1,"i"=>1,"u"=>1,"div"=>2,"a"=>2,"em"=>1,"br"=>1,"strong"=>1,"blockquote"=>1,"tt"=>1,"li"=>1,"ol"=>1,"ul"=>1);
$CensorList = array("fuck","cunt","fucker","fucking","pussy","cock","c0ck","cum","twat","clit","bitch","fuk","fuking","motherfucker");
$tipath = "images/topics/";
$commercial_license = 0;
if (eregi("config.php",$_SERVER[\'PHP_SELF\'])) {
Header("Location: index.php");
die();
}
?>';
  $fp = fopen($dest_dir."/config.php","w+");
  if($fp == FALSE){
    $package_installer_console .= "<font color=\"red\">Cannot open config file!</font><br>";
    return 1;
  }
  fwrite($fp,$config_php_file);
  fclose($fp);

  $file = $dest_dir."/nuke.sql";
  $cmd = "mysql -u$dtcpkg_db_login -D".$_REQUEST["database_name"]." -p".$_REQUEST["dtcpkg_db_pass"]." <$file";
  exec($cmd,$exec_out2,$return_val);
  $n = sizeof($exec_out2);
  $exec_out = "";
  for($i=0;$i<$n;$i++){
    $exec_out .= $exec_out2[$i]."\n";
  }
  $package_installer_console .= "<pre>$exec_out</pre>";
/*
  echo $file;
  $fp = fopen($file,"r");
  $sql_init_script = fread($fp,filesize ( $file ));
  fclose($fp);

  mysql_select_db($_REQUEST["database_name"])or die ("Cannot select db: ".$_REQUEST["database_name"]." line ".__LINE__." file ".__FILE__);
  $r = mysql_query($sql_init_script)or die("Cannot query $sql_init_script line ".__LINE__." file ".__FILE__." sql said ".mysql_error());
  mysql_select_db($conf_mysql_db)or die ("Cannot select db: $conf_mysql_db line ".__LINE__." file ".__FILE__);
*/

/*
  $data["board_email"] = $_REQUEST["dtcpkg_email"];
  $data["admin_name"] = $_REQUEST["dtcpkg_login"];
  $data["admin_pass1"] = $_REQUEST["dtcpkg_pass"];
  $data["admin_pass2"] = $_REQUEST["dtcpkg_pass"];
  $url = $vhost_url.$_REQUEST["dtcpkg_directory"]."/".$pkg_info["post_script_url"];*/
  return 0;     // Ok, no problem ! :)
}

?>