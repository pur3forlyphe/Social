<?php
class Post extends AppModel {
	var $name = 'Post';
        var $displayField = 'title';
        
        var $validate = array(
            'post' => array(
                'rule' => array('custom', '/^[a-z0-9 ]*$/i'), 
                'maxLength' => 610,
                'require' => true,
                'message' => 'Your post is too long'
             )
        );
        
        var $belongsTo = array(
            'Topic' => array(
                'className' => 'Topic',
                'foreignKey' => 'topic_id'
            ),
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )
        );
        
        var $hasMany = array(
            'Comment' => array (
                'className' => 'Comment',
                'order' => array (
                    'Comment.created' => 'DESC',
                    )
            )
        );

}
