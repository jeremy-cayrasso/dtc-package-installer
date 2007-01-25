<?php
/**
 * @package DTC
 * @version  $Id: dtc-pkg-info.php,v 1.2 2007/01/25 00:39:10 indivision Exp $
 * 
 */
$pkg_info = array(
  "name" => "Joomla",
  "version" => "1.0.11",
  "short_desc" => "Ca³kiem prosty w obs³udze lecz rozbuowany CMS. 
  Polskie centrum joomla znajduje siê pod adresem http://www.joomla.pl/",
  "unpack_disk_usage" => "8922910",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "INSTALL.php",

  "remove_folder" => "no",

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "cms",

  "has_install_script" => "no",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.bz2",
  "file" => "joomla_1011+Admin-pl.tar.bz2",
  "resulting_dir" => "",
  "renamedir_to" => "");

?>
