<?php
namespace test_bench {
  require __DIR__.'/../init/test.php';
  error_reporting(-1);
  
  use str\word;
  
  class PackageTestBench extends Base {
    function initialize() {
      $this->add_test(new word\ObjectTest());
      $this->add_test(new word\NumberInflectionsTest());
    }
  }
  
  autoload_in('str\word', __DIR__."/str/word");
  
  $bench = new PackageTestBench();
  $bench->run_and_present_as_text();
}
?>