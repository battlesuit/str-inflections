bs.str-inflections
==================

Supporting plural and singular inflections.  
Basic inflections included.

###Create new inflections

    namepsace str {
      inflections(function($add) {
        
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
      
      # use via function
      pluralize('mouse'); # => returns "mice"
      singularize('bean'); # => returns "beans"
      
    }