<?php

$pkg_info = array(
  "name" => "osCommerce",
  "version" => "2.2ms2-060817",
  "short_desc" => "Open Source E-Commerce Solutions",
  "long_desc" => "osCommerce is the leading Open Source online
  shop e-commerce solution that is available for free under the
  GNU General Public License. It features a rich set of
  out-of-the-box online shopping cart functionality that allows
  store owners to setup, run, and maintain their online stores
  with minimum effort and with no costs, license fees, or limitations involved.
  This package already includes the register globals and register long patch.
",
  "unpack_disk_usage" => "3510288",

  "need_database" => "yes",
  "sql_script" => "no",

  "onthefly_post_script" => "no",
  "post_script_url" => "",

  "remove_folder" => "no",
  "remove_folder_path" => array("CHANGELOG","FAQ","INSTALL","LICENSE","README","STANDARD","TODO",
    "extras","tep_database-pr2.2-CVS.pdf","catalog"),

  "need_admin_email" => "yes",
  "need_admin_login" => "yes",
  "need_admin_pass" => "yes",

  "can_select_directory" => "yes",
  "directory" => "oscommerce",

  "has_install_script" => "yes",
  "install_script_url" => "install.php",

  "unpack_type" => "tar.gz",
  "file" => "oscommerce-2.2ms2.tar.gz",
  "resulting_dir" => "oscommerce-2.2ms2",
  "renamedir_to" => "oscommerce");

?>
