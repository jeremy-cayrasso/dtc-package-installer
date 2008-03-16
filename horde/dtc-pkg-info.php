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
  "version" => "3.1.3",
  "short_desc" => "The horde web application framework",
  "long_desc" => "The Horde Framework is the glue that all
  Horde applications have in common. It is many things,
  including some coding standards, common code, and
  inter-application communication. The shared code provides
  common ways of handling things like preferences, permissions,
  browser detection, user help, and more.<br>
  Note that the following package MUST be installed in your
  system in order to be able to install this package:<br>
  php-log php-mail-mime php-xml-serializer php-http-request
  php-date php-db php-mail php5-ldap php-net-ldap php-net-imap
  php5-imap php-file php-http php-net-smtp php-auth-sasl php-pear
  php-services-weather php-cache php5-memcache php5-mcrypt",
  "unpack_disk_usage" => "19250814",

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
  "file" => "horde-3.1.3.tar.gz",
  "resulting_dir" => "horde-3.1.3",
  "renamedir_to" => "horde");

?>
