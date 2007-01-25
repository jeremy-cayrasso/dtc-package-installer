<?php

// To be able to use this package, your box should have the
// support for php-mcrypt, php-ldap, php-mime-magic
// You should also upgrade your pear installation. Issue
// the folowing commands:
// pear install Log Mail_Mime
// pear install DB
// pear install File
// pear install Date
// pear -d preferred_state=beta install -a Services_Weather

function do_package_install(){
  global $package_installer_console;
  global $edit_domain;
  global $adm_login;
  global $pkg_info;
  global $dtcpkg_db_login;

  $package_installer_console .= "=> Starting phpBB Installer for Horde 3.1.3<br>";

  return 0;     // Ok, no problem ! :)
}

?>
