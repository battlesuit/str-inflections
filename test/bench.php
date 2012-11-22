<?php
namespace test_bench;

class PackageTestBench extends Base {
  function initialize() {
    $this->add_test(new \InflectorTest());
  }
}
?>