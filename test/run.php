<?php
namespace test_bench {
  require "loader.php";
  error_reporting(-1);
  
  class PackageTestBench extends Base {
    function initialize() {
      $this->add_test(new \str\InflectionsTest());
    }
  }
  
  $bench = new PackageTestBench();
  $bench->run_and_present_as_text();
}
?>