bs.str-word
===========

This package holds the `str\Word` class. Every instance should represent one word.  
At this point there are only plural and singular inflections supported.

The basic inflections are already included.

###Create new inflections

    namepsace str {
      Word::number_inflections(function($add) {
        
        # Adds a uncountable word
        $add->word('equipment');
        
        # Adds a word with singular and plural form 
        $add->word('stair', 'stairs');
        
        # Adding a rule which matches the end of the word by regex
        $add->rule('o', 'oes'); # hero => heroes
        
        # Adding many new words
        $add->many_words('rice', 'grass', array('mouse', 'mice'), 'information');
      });
    }
    
##Usage

    namespace str {
      
      # use via object
      $word = new Word('mouse');
      $word->pluralize();
      echo "$word"; # => displays "mice"
      
      # use via function
      word\pluralize('product'); # => returns "products"
      word\singularize('bean'); # => returns "beans"
      
      # builder
      echo Word::create('mouse')->pluralize(); # => displays "mice"
      
      # use read() method if you want the value
      Word::create('mouse')->pluralize()->read(); # => retruns "mice"
      
    }