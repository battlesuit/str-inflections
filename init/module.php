<?php
namespace bs {
  $LIB_DIR = dirname(__DIR__)."/lib";
  
  autoload('str\word\Object', $LIB_DIR."/str/word/object.php");
  autoload('str\word\NumberInflections', $LIB_DIR."/str/word/number_inflections.php");
  
  require $LIB_DIR."/str/word/functions.php";
  require $LIB_DIR."/str/word/inflections.php";
  
  class_alias('str\word\Object', 'str\Word');
}
?>