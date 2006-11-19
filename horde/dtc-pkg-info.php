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


$pkg_info = array(
  "name" => "Horde",
  "version" => "3.0.4",
  "short_desc" => "The horde web application framework",
  "long_desc" => "The Horde Framework is the glue that all
  Horde applications have in common. It is many things,
  including some coding standards, common code, and
  inter-application communication. The shared code provides
  common ways of handling things like preferences, permissions,
  browser detection, user help, and more.",
  "unpack_disk_usage" => "13554978",

  "need_database" => "yes",
  "sql_script" => "yes",

  "onthefly_post_script" => "yes",
  "post_script_url" => "",

  "remove_folder" => "no",
  "remove_folder_path" => array(),

  "need_admin_email" => "no",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "no",
  "directory" => "horde",

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "horde-3.0.4.tar.gz",
  "resulting_dir" => "horde-3.0.4",
  "renamedir_to" => "horde");

?>
