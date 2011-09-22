<?php
class CommentsController extends AppController {

	var $name = 'Comments';

	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid comment', true), array('action' => 'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Comment->create();
			if ($this->Comment->save($this->data)) {
				$this->flash(__('Comment saved.', true), array('action' => 'index'));
			} else {
			}
		}
		$users = $this->Comment->User->find('list');
		$posts = $this->Comment->Post->find('list');
		$this->set(compact('users', 'posts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid comment', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->flash(__('The comment has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
		$users = $this->Comment->User->find('list');
		$posts = $this->Comment->Post->find('list');
		$this->set(compact('users', 'posts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid comment', true)), array('action' => 'index'));
		}
		if ($this->Comment->delete($id)) {
			$this->flash(__('Comment deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Comment was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
