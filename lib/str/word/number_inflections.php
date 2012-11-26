<?php
namespace str\word;

class NumberInflections {
  private $words_to = array();
  private $rules_to = array();
  private $cached_rules_for = array();
  
  function word($singular, $plural = null) {
    if(empty($plural)) $plural = $singular;
    
    $this->words_to['singular'][$plural] = $singular;
    $this->words_to['plural'][$singular] = $plural;
  }
  
  function many_words() {
    foreach(func_get_args() as $arg) call_user_func_array(array($this, 'word'), (array)$arg);
  }
  
  function rules_for($form) {
    if(isset($this->cached_rules_for[$form])) return $this->cached_rules_for[$form];
    
    if(isset($this->rules_to[$form])) {
      $rules = $this->rules_to[$form];
      $matchable_segments = array_keys($rules);
    }
    
    $expr_inflections = join('|', $matchable_segments);
    $regex = "/($expr_inflections)$/i";
    
    return $this->cached_rules_for[$form] = array($regex, $rules);
  }
  
  function rule($singular, $plural) {
    $this->singular($singular, $plural);
    $this->plural($plural, $singular);
  }
  
  function plural($plural, $singular) {
    $this->rules_to['plural'][$singular] = $plural;
  }
  
  function singular($singular, $plural) {
    $this->rules_to['singular'][$plural] = $singular;
  }
  
  function inflect_to($form, $word) {
    if(empty($word)) return '';
    
    if(isset($this->words_to[$form][$word])) {
      return $this->words_to[$form][$word];
    }
    
    list($expr, $rules) = $this->rules_for($form);
    $inflected_word = $word;

    $inflected_word = preg_replace_callback($expr, function($m) use($rules) {
      return $rules[$m[1]];
    }, $inflected_word, 1);
    
    return $this->words_to[$form][$word] = $inflected_word;
  }
}
?>