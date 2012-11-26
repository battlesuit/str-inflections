<?php
namespace str\word {
  function pluralize($word) {
    return Object::create($word)->pluralize()->read();
  }
  
  function singularize($word) {
    return Object::create($word)->singularize()->read();
  }
}
?>