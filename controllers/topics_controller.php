<?php
class TopicsController extends AppController {

	var $name = 'Topics';
        
	function index() {
		$this->Topic->recursive = 0;
		$this->set('topics', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid topic', true), array('action' => 'index'));
		}
		$this->set('topic', $this->Topic->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Topic->create();
			if ($this->Topic->save($this->data)) {
				$this->flash(__('Topic saved.', true), array('action' => 'index'));
			} else {
			}
		}
		$users = $this->Topic->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid topic', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->flash(__('The topic has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Topic->read(null, $id);
		}
		$users = $this->Topic->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid topic', true)), array('action' => 'index'));
		}
		if ($this->Topic->delete($id)) {
			$this->flash(__('Topic deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Topic was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}

}
