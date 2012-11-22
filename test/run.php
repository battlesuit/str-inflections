<?php
namespace test_bench {
  require '../init/test.php';
  require 'bench.php';
  require 'inflector_test.php';
  
  $bench = new PackageTestBench();
  $bench->run_and_present_as_text();
}
?>