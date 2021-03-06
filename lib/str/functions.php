<?php
namespace str {
  
  /**
   * Returns a single inflections instance or wraps it into a callable
   *
   * @param callable $block
   * @return Inflections
   */
  function inflections($block = null) {
    static $instance;
    if(!isset($instance)) $instance = new Inflections();
    if(is_callable($block)) call_user_func($block, $instance);
    return $instance;
  }
  
  /**
   * Pluralizes a given word
   *
   * Example
   *  str\pluralize('mouse'); # => mice
   *
   * @param string $word
   * @return string
   */  
  function pluralize($word) {
    return inflections()->inflect_to('plural', $word);
  }
  
  /**
   * Singularizes a given word
   *
   * Example
   *  str\singularize('products'); # => product
   *
   * @param string $word
   * @return string
   */
  function singularize($word) {
    return inflections()->inflect_to('singular', $word);
  }
  
  # setting up inflections
  inflections(function($add) {
    $add->many_words(
      'fish',
      'equipment',
      'grass',
      'information',
      'milk',
      'money',
      'rain',
      'rice',
      'sheep',
      'species',
      'status',
      'series',
      'news',
      'moose',
      array('person', 'people'),
      array('employer', 'employees'),
      array('wife', 'wives'),
      array('alias', 'aliases'),
      array('child', 'children'),
      array('move', 'moves'),
      array('cow', 'kine'),
      array('axis', 'axes'),
      array('mouse', 'mice'),
      array('life', 'lives'),
      array('goose', 'geese'),
      array('quiz', 'quizzes'),
      array('ox', 'oxen'),
      array('louse', 'lice'),
      array('thief', 'thieves'),
      array('price', 'prices'),
      array('testis', 'testes')
    );
    
    
    $add->rule('ox', 'oxes');
    $add->rule('us', 'uses');
    $add->rule('ero', 'eroes');
    $add->rule('rf', 'rves');
    $add->rule('man', 'men');
    $add->rule('ch', 'ches');
    $add->rule('sh', 'shes');
    $add->rule('ss', 'sses');
    $add->rule('tum', 'ta');
    $add->rule('ia', 'ium');
    $add->rule('ra', 'rum');
    $add->rule('ay', 'ays');
    $add->rule('ey', 'eys');
    $add->rule('oy', 'oys');
    $add->rule('uy', 'uys');
    $add->rule('y', 'ies');  
    $add->rule('x', 'xes');
    $add->rule('lf', 'lves');
    $add->rule('ffe', 'ffes');
    $add->rule('afe', 'aves');
    $add->rule('ouse', 'ouses');
    $add->rule('ive', 'ives');
    $add->rule('sis', 'ses');
    $add->rule('ose', 'oses');
    $add->rule('de', 'des');
    $add->rule('tus', 'ti');
    $add->rule('rus', 'ri');
    $add->rule('rix', 'rices');
    $add->rule('tex', 'tices');
    $add->rule('dex', 'dices');
    $add->rule('rion', 'ria');
    $add->rule('pus', 'pi');
    $add->rule('non', 'na');
    $add->rule('o', 'oes');
    $add->rule('po', 'pos');
    $add->rule('ete', 'etes'); # athlete
    $add->rule('vie', 'vies'); # movie
    $add->rule('', 's');
  });
}
?>