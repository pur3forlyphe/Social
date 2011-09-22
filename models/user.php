<?php
class User extends AppModel {
	public $name = 'User';
	public $displayField = 'username';
        
        public $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'require' => true,
				'message' => 'Please enter a username'
                        ),
			'maxLength' => array(
				'rule' => array('maxLength', 15),
				'Username should be no longer than 15 characters' 
                        )
                ),
                'email' => array(
                    'rule' => 'email',
                    'require' => true,
                    'message' => 'Please enter a valid email'
                ),
                'password' => array(
                        'rule' => array('minLength', 5),
                        'message' => 'Password must be at least 5 characters long',
                        'require' => true,
                        'allowEmpty' => false
                ),
                'view' => array(
                )
              
            );
	
	public $actsAs = array('Containable', 'Acl' => array('type' => 'requester'));
	
	public $hasMany = array(
		'Topic' => array(
			'className' => 'Topic',
			'order' => array(
				'Topic.created' => 'DESC',
			)
		),
		'Post' => array(
			'className' => 'Post',
			'order' => array(
				'Post.created' => 'DESC',
                        )
                 ),
		'Comment' => array (
			'className' => 'Comment',
			'order' => array(
				'Comment.created' => 'DESC',
			)
		),
		'Vote' => array (
			'className' => 'Vote',
                        'foreignKey' => 'user_id'
		)
	);
	
	public $belongsTo = array(
		'Group' => array(
                    'className' => 'Group',
                    'foreignKey' => 'group_id'
                )
	);
         
    public static function get($field = null) {
        $user = Configure::read('User');
        if (empty($user) || (!empty($field) && !array_key_exists($field, $user))) {
            return false;
        }
    }

    function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }	
    
    function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id'] );
    }
}

