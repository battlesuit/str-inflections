<?php
namespace str\word;

class Object {
  protected $origin;
  protected $modified;
  
  function __construct($word) {
    $this->origin = $this->modified = $word;  
  }
  
  function __toString() {
    return $this->read();
  }
  
  static function number_inflections($block = null) {
    static $instance;
    if(!isset($instance)) $instance = new NumberInflections();
    
    if(is_callable($block)) {
      call_user_func($block, $instance);
    }
    
    return $instance;
  }
  
  static function create($word) {
    return new self($word);
  }
  
  function read() {
    return $this->modified;
  }
  
  function origin() {
    return $this->origin;
  }
  
  function singularize() {
    $this->modified = static::number_inflections()->inflect_to('singular', $this->modified);
    return $this;
  }
  
  function pluralize() {
    $this->modified = static::number_inflections()->inflect_to('plural', $this->modified);
    return $this;
  }
}
?>