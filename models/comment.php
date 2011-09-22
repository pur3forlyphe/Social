<?php
class Comment extends AppModel {
	var $name = 'Comment';
        
        var $validate = array(
            'comment' => array(
                'rule' => array ('maxLength' => 255),
                'require' => true
            )
        );
        
        var $belongsTo = array(
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            ),
            'Post' => array (
                'className' => 'Post',
                'foreignKey' => 'post_id'
            )
            
        );
        
        var $hasMany = array(
            'Vote' => array(
                'className' => 'Vote',
                'foreignKey' => 'parent_id',
                
            )
        );
}
