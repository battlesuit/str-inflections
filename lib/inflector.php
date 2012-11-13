<?php
/**
 * Handling word inflections
 *
 * PHP Version 5.3+
 * @author Thomas Monzel <tm@apparat-hamburg.de>
 * @version $Revision$
 * @package Suitcase
 * @subpackage Inflector
 */
class Inflector {

  /**
   * Inflections into plural form
   *
   * @static
   * @access public
   * @var array
   */
  static $plurals = array(
    '/(quiz)$/i' => '\1zes',
    '/^(ox)$/i' => '\1en',
    '/([m|l])ouse$/i' => '\1ice',
    '/(matr|vert|ind)ix|ex$/i' => '\1ices',
    '/(x|ch|ss|sh)$/i' => '\1es',
    '/([^aeiouy]|qu)ies$/i' => '\1y',
    '/([^aeiouy]|qu)y$/i' => '\1ies',
    '/(hive)$/i' => '\1s',
    '/(?:([^f])fe|([lr])f)$/i' => '\1\2ves',
    '/sis$/i' => 'ses',
    '/([ti])um$/i' => '\1a',
    '/(buffal|tomat)o$/i' => '\1oes',
    '/(bu)s$/i' => '\1ses',
    '/(alias|status)/i'=> '\1es',
    '/(octop|vir)us$/i'=> '\1i',
    '/(ax|test)is$/i'=> '\1es',
    '/s$/i'=> 's',
    '/$/'=> 's'
  );

  /**
   * Inflections into singular form
   *
   * @static
   * @access public
   * @var array
   */
  static $singulars = array (
    '/(quiz)zes$/i' => '\1',
    '/(matr)ices$/i' => '\1ix',
    '/(vert|ind)ices$/i' => '\1ex',
    '/^(ox)en/i' => '\1',
    '/(alias|status)es$/i' => '\1',
    '/([octop|vir])i$/i' => '\1us',
    '/(cris|ax|test)es$/i' => '\1is',
    '/(shoe)s$/i' => '\1',
    '/(o)es$/i' => '\1',
    '/(bus)es$/i' => '\1',
    '/([m|l])ice$/i' => '\1ouse',
    '/(x|ch|ss|sh)es$/i' => '\1',
    '/(m)ovies$/i' => '\1ovie',
    '/(s)eries$/i' => '\1eries',
    '/([^aeiouy]|qu)ies$/i' => '\1y',
    '/([lr])ves$/i' => '\1f',
    '/(tive)s$/i' => '\1',
    '/(hive)s$/i' => '\1',
    '/([^f])ves$/i' => '\1fe',
    '/(^analy)ses$/i' => '\1sis',
    '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
    '/([ti])a$/i' => '\1um',
    '/(n)ews$/i' => '\1ews',
    '/s$/i' => '',
  );

  /**
   * Words which are not inflectable
   *
   * @static
   * @access public
   * @var array
   */
  static $uncountables = array(
    'equipment',
    'information',
    'rice',
    'money',
    'species',
    'series',
    'fish', 
    'sheep',
    'jeans'
  );

  /**
   * Words which are inflected specially
   *
   * @static
   * @access public
   * @var array
   */
  static $irregulars = array(
    'person' => 'people',
    'man' => 'men',
    'child' => 'children',
    'sex' => 'sexes',
    'move' => 'moves',
    'cow' => 'kine',
    'episode' => 'episodes'
  );
  
  /**
   * Inflects a word into pascalized form
   * => foo_bar = FooBar
   *
   * @static
   * @access public
   * @param string $word
   * @return string
   */
  static function pascalize($word) {
    $word = ucwords(preg_replace('/_+/', ' ', $word));
    $word = preg_replace('#[\s]+#', '', $word);
    return $word;
  }
  
  /**
   * Inflects the word to a human readable form
   * => foo_bar = Foo bar
   *
   * @static
   * @access public
   * @param string $word
   * @return string
   */
  static function humanize($word) {
    $underscored_word = self::underscore($word);
    return str_replace('_', ' ', ucfirst($underscored_word));
  }

  /**
   * Remove underscores, capitalize words and clear all whitespaces
   * => foo_bar = fooBar
   *
   * @static
   * @access public
   * @param string $word
   * @return string
   */
  static function camelize($word) {
    return str_replace(' ', '', lcfirst(ucwords(str_replace('_', ' ', self::underscore($word)))));
  }
  
  /**
   * Convert camelcased word into system readable underscored string
   * All whitespaces and backslashses of namespaces will be replaced by one _
   *
   * @static
   * @param string $string
   * @return string
   */
  static function underscore($string) {
    $string = preg_replace('/([A-Z]+)([A-Z][a-z])/', '$1_$2', $string);
    $string = preg_replace('/([a-z\d])([A-Z])/', '$1_$2', $string);
    $string = preg_replace('/\s+/', '_', $string);
    return strtolower($string);
  }
  
  /**
   * Strips the namespace and returns an the unqualified class name
   *
   * @static
   * @access public
   * @param string $qualified_name
   * @return string
   */
  static function unqualify($qualified_name, $underscore = false) {
    if(strpos($qualified_name, '\\') !== false) $qualified_name = substr(strrchr($qualified_name, '\\'), 1);
    return $underscore ? self::underscore($qualified_name) : $qualified_name;
  }
  
  /**
   * Inflect word into plural form
   *
   * @static
   * @access public
   * @param string $word
   * @return string
   */
  static function pluralize($word) {
    if(empty($word)) return '';
    $word = strtolower($word);

    if(isset(self::$irregulars[$word])) return self::$irregulars[$word];
    if(array_search($word, self::$uncountables) !== false) return $word;
    
    foreach(self::$plurals as $rule => $replacement) {
      if(preg_match($rule, $word)) {
        return preg_replace($rule, $replacement, $word);
      }
    }
    
    
    return $word;
  }

  /**
   * Inflect word into singular form
   *
   * @static
   * @access public
   * @param string $word
   * @return string
   */
  static function singularize($word) {
    if(empty($word)) return '';
    $word = strtolower($word);
    if(isset(self::$irregulars[$word])) return $word;
    
    if(($singularized_word = array_search($word, self::$irregulars))) return $singularized_word;
    
    if(array_search($word, self::$uncountables) !== false) return $word;
    
    foreach(self::$singulars as $rule => $replacement) {
      if(preg_match($rule, $word)) {
        return preg_replace($rule, $replacement, $word);
      }
    }

    return $word;
  }
}
?>