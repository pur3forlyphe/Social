<?php
class Topic extends AppModel {
	var $name = 'Topic';
	var $displayField = 'title';
        
        var $validate = array(
            'title' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'), 
                'required' => true
                )
        );
        
        var $belongsTo = array (
            'User' => array (
                'className' => 'User',
                'foreignKey' => 'user_id'
            )
        );
        
        var $hasMany = array (
            'Post' => array (
                'className' => 'Post',
                'foreignKey' => 'topic_id',
                'order' => array(
                    'Post.created' => 'DESC',
                )
            )
        );
       // var $actsAs = array('Containable');
}
