<?php

$pkg_info = array(
  "name" => "Nuked-Klan",
  "version" => "1.7.7",
  "short_desc" => "Gamer version",
  "long_desc" => " Nuked-Klan est un CMS open source. Il permet d'installer et d'administrer un site web de maniere simple et interactive. Nuked-Klan est specialise dans les jeux en reseaux et la gestion des clans avec sa version Gamer.
",
  "unpack_disk_usage" => "4594075",
  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "yes",
  "post_script_url" => "install.php",

  "remove_folder" => "no",
  "remove_folder_path" => array(),

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "nk",

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.bz2",
  "file" => "nuked-klan-1-7-7.tar.bz2",
  "resulting_dir" => "nk",
  "renamedir_to" => "nk");

?>
