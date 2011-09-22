<?php
class VotesController extends AppController {

	var $name = 'Votes';

	function index() {
		$this->Vote->recursive = 0;
		$this->set('votes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid vote', true), array('action' => 'index'));
		}
		$this->set('vote', $this->Vote->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Vote->create();
			if ($this->Vote->save($this->data)) {
				$this->flash(__('Vote saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid vote', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Vote->save($this->data)) {
				$this->flash(__('The vote has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Vote->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid vote', true)), array('action' => 'index'));
		}
		if ($this->Vote->delete($id)) {
			$this->flash(__('Vote deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Vote was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
