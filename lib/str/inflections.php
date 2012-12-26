<?php
namespace str;
if(defined('loader\available')) require __DIR__."/autoload.php";
require __DIR__."/functions.php";

/**
 * Inflections for pluralize() and singularize() functions
 *
 * PHP Version 5.3+
 * @author Thomas Monzel <tm@apparat-hamburg.de>
 * @version $Revision$
 * @package Battlesuit
 * @subpackage str
 */
class Inflections {
  
  /**
   * Full words for singular and plural inflections
   *
   * @access private
   * @var array
   */
  private $words = array();
  
  /**
   * Replacement rules
   *
   * @access private
   * @var array
   */
  private $rules = array();
  
  /**
   * Finalized rules by rules_for()
   * This array serves as a cache for singular and plural inflections
   *
   * @access private
   * @var array
   */
  private $finalized_rules = array();
  
  /**
   * Creates a new word inflection. Leaving out the plural form means that
   * singular and plural is the same.
   *
   * @access public
   * @param string $singular
   * @param string $plural Optional
   */
  function word($singular, $plural = null) {
    if(empty($plural)) $plural = $singular;
    
    $this->words['singular'][$plural] = $singular;
    $this->words['plural'][$singular] = $plural;
  }
  
  /**
   * Creates many new word inflections by every given argument.
   * Uses the word() method within a foreach loop
   *
   * Example
   *  $inflections->many_words('equipment', 'sheep', array('basis', 'bases'), 'status');
   *
   * @access public
   */
  function many_words() {
    foreach(func_get_args() as $arg) call_user_func_array(array($this, 'word'), (array)$arg);
  }
  
  /**
   * Returns the finalized rules array and regex for the given inflection form (singular or plural)
   * 
   * @access public
   * @param string $form 'singular' or 'plural'
   * @return array [Regex, Rules]
   */
  function rules_for($form) {
    if(isset($this->finalized_rules[$form])) return $this->finalized_rules[$form];
    
    if(isset($this->rules[$form])) {
      $rules = $this->rules[$form];
      $matchable_segments = array_keys($rules);
    }
    
    $regex = "/(".join('|', $matchable_segments).")$/i";
    return $this->finalized_rules[$form] = array($regex, $rules);
  }
  
  /**
   * Adds a new rule for singular and plural inflections
   *
   * @access public
   * @param string $singular
   * @param string $plural
   */
  function rule($singular, $plural) {
    $this->singular($singular, $plural);
    $this->plural($plural, $singular);
  }
  
  /**
   * Adds a new plural inflection rule
   *
   * @access public
   * @param string $singular
   * @param string $plural
   */
  function plural($plural, $singular) {
    $this->rules['plural'][$singular] = $plural;
  }
  
  /**
   * Adds a new singular inflection rule
   *
   * @access public
   * @param string $singular
   * @param string $plural
   */  
  function singular($singular, $plural) {
    $this->rules['singular'][$plural] = $singular;
  }
  
  /**
   * Inflects a word into a given inflection form (singular or plural)
   *
   * @access public
   * @param string $form
   * @param string $word
   * @return string Inflected word
   */
  function inflect_to($form, $word) {
    if(empty($word)) return '';
    
    if(isset($this->words[$form][$word])) {
      return $this->words[$form][$word];
    }
    
    list($expr, $rules) = $this->rules_for($form);
    $inflected_word = $word;

    $inflected_word = preg_replace_callback($expr, function($m) use($rules) {
      return $rules[$m[1]];
    }, $inflected_word, 1);
    
    return $this->words[$form][$word] = $inflected_word;
  }
}
?>