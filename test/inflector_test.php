<?php
class InflectorTest extends test_case\Unit {
  function test_simple_inflecton_to_singular() {
    $this->assert_equal(Inflector::singularize('people'), 'person');
  }
}
?>