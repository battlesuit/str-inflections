<?php
namespace str\word;

class ObjectTest extends \test_case\Unit {
  function test_construction() {
    $w = new Object('mouse');
  }
  
  function test_to_string() {
    $w = new Object('mouse');
    $this->assert_equal("$w", 'mouse');
  }
  
  function test_pluralize() {
    $w = new Object('mouse');
    $w->pluralize();
    $this->assert_equal("$w", 'mice');
  }
  
  function test_singularize() {
    $w = new Object('hackers');
    $w->singularize();
    $this->assert_equal("$w", 'hacker');
  }
}
?>