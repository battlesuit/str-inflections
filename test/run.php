<?php
namespace test_bench {
  require __DIR__.'/../init/test.php';
  error_reporting(-1);
  
  use str;
  
  class PackageTestBench extends Base {
    function initialize() {
      $this->add_test(new str\InflectionsTest());
    }
  }
  
  autoload_in('str', __DIR__."/str");
  
  $bench = new PackageTestBench();
  $bench->run_and_present_as_text();
}
?>