<?php
class UsersController extends AppController {

	var $name = 'Users';
        var $components = array('Auth');
        
        
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
        
        function login(){
            if(
                !empty($this->data) &&
                !empty($this->Auth->data['User']['username']) &&
                !empty($this->Auth->data['User']['password'])
            ){
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email' => $this->Auth->data['User']['username'],
                        'User.password' => $this->Auth->data['User']['password']
                    ),
                    'recursive' => -1
                ));
                
                if(!empty($user) && $this->Auth->login($user)){
                    if($this->Auth->autoRedirect){
                        $this->redirect($this->Auth->redirect());

                    }
                } else {
                    $this->Session->setFlash($this->Auth->loginError, $this->Auth->flashElement, array(), 'auth');
                }
            }
        }
        
        function logout(){
            $this->redirect($this->Auth->logout());
        }

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid user', true), array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->flash(__('User saved.', true), array('action' => 'index'));
			} else {
			}
		}
                $groups = $this->User->Group->find('list', array('fields' => array('Group.group')));
                $this->set(compact('groups'));
	}
        
        function register() {
		if (!empty($this->data)) {
                        $this->data['User']['group_id'] = 3;
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->flash(__('User saved.', true), array('action' => 'index'));
			} else {
			}
		}
                $groups = $this->User->Group->find('list', array('fields' => array('Group.group')));
                $this->set(compact('groups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid user', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->flash(__('The user has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid user', true)), array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			$this->flash(__('User deleted', true), array('action' => 'index'));
		}
		$this->flash(__('User was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function admin_initDB(){
            
            $aro = new Aro();
            $users = $this->User->find('all');
            
            foreach($users as $u){
                $data = array(
                    'alias' => $u['User']['username'],
                    'parent_id' => $u['User']['group_id'],
                    'model' => 'User',
                    'foreignKey' => $u['User']['id']
                );
                $aro->create();
                $aro->save($data);
            }
            
            //superadmin group
            
            $group =& $this->User->Group;
            
            $group->id = 1;
            $this->Acl->allow($group, 'controllers');
            $this->Acl->allow($group, 'controllers/Documents/delete');
            $this->Acl->allow($group, 'controllers/Documents/edit');
            
            $this->Acl->allow($group, 'controllers/Groups/add');
            $this->Acl->allow($group, 'controllers/Groups/edit');
            $this->Acl->allow($group, 'controllers/Groups/delete');
            
            $this->Acl->allow($group, 'controllers/Topics/edit');

            
            //admin group
            
            
            //user group
            $group->id = 3;
            $this->Acl->allow($group, 'controllers/Documents/index');
            $this->Acl->allow($group, 'controllers/Documents/add');
            
            $this->Acl->allow($group, 'controllers/Topics/index');
            $this->Acl->allow($group, 'controllers/Topics/add');
            
            $this->Acl->allow($group, 'controllers/Users/account');
            
            $this->Acl->allow($group, 'controllers/Comments/index');
            $this->Acl->allow($group, 'controllers/Comments/add');
            
            $this->Acl->allow($group, 'controllers/Votes/add');
            
        }
}
