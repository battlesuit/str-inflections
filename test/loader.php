<?php
/**
 * Loads testing environment
 *
 * PHP Version 5.3+
 * @author Thomas Monzel <tm@apparat-hamburg.de>
 * @version $Revision$
 * @package Battlesuit
 * @subpackage str-inflections
 */
namespace loader {
  require "../loader.php";
  import('test', 'str-inflections');
  scope('str', __DIR__);
}
?>