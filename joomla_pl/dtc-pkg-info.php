<?php
/**
 * @package DTC
 * @version  $Id: dtc-pkg-info.php,v 1.1.1.1 2006/11/19 14:09:51 thomas Exp $
 * 
 */
$pkg_info = array(
  "name" => "Joomla",
  "version" => "1.0.10",
  "short_desc" => "Ca³kiem prosty w obs³udze lecz rozbuowany CMS. 
  Polskie centrum joomla znajduje siê pod adresem http://www.joomla.pl/",
  "unpack_disk_usage" => "18900",

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
  "file" => "Joomla_1.0.10_rev2.tar.bz2",
  "resulting_dir" => "",
  "renamedir_to" => "");

?>
