<?php

$pkg_info = array(
  "name" => "SPIP",
  "version" => "1.9.1-29092006",
  "short_desc" => "Open Source Content Management System (CMS)",
  "long_desc" => "SPIP is a publishing system developed by the minir&eacute;zo to manage the site uZine. We provide it to anyone as a free software under GPL license. Therefore, you can use it freely for your own site, be it personnal, co-operative, institutional or commercial.
",
  "unpack_disk_usage" => "9659059",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "",

  "remove_folder" => "no",
  "remove_folder_path" => array("COPYING.txt","svn.revision","INSTALL.txt","UPGRADE.txt"),

  "need_admin_email" => "no",
  "need_admin_login" => "no",
  "need_admin_pass" => "no",

  "can_select_directory" => "yes",
  "directory" => "spip",

  "has_install_script" => "no",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "spip-1.9.1.tar.gz",
  "resulting_dir" => "spip-1.9.1",
  "renamedir_to" => "spip");

?>
