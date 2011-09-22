<?php

class Vote extends AppModel {
	var $name = 'Vote';
	var $displayField = 'vote';
        
        var $actsAs = array(
          'Voteable' => array(
              'foreignKey' => 'parent_id'
          )  
        );
        
        var $belongsTo = array (
            'User' => array(
                'className' => 'user',
                'foreign_key' => 'user_id'
            )
        );
        
}
