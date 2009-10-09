<?php

$pkg_info = array(
  "name" => "Nuked-Klan-Sp",
  "version" => "4.4",
  "short_desc" => "Normal version",
  "long_desc" => " Nuked-Klan est un CMS open source. Il permet d'installer et d'administrer un site web de maniere simple et interactive.",
  "unpack_disk_usage" => "4590790",
  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "yes",
  "post_script_url" => "install.php",

  "remove_folder" => "no",
  "remove_folder_path" => array( "/install"),

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "nk",

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.bz2",
  "file" => "nuked-klan-sp.tar.bz2",
  "resulting_dir" => "nk",
  "renamedir_to" => "nk");

?>
