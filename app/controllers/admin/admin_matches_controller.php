<?php

class AdminMatchesController extends MvcAdminController {
	
	var $default_columns = array('id', 'name');

    public function add() {
        $this->set_tournaments();
        $this->set_teams();
        $this->create_or_save();
    }

    public function edit() {
        $this->verify_id_param();
        $this->set_tournaments();
        $this->set_teams();
        $this->create_or_save();
        $this->set_object();
    }


    private function set_tournaments() {
        $this->load_model('Tournament');
        $tournaments = $this->Tournament->find(array('selects' => array('id', 'name')));
        $this->set('tournaments', $tournaments);
    }

    private function set_teams() {
        $this->load_model('Team');
        $teams = $this->Team->find(array('selects' => array('id', 'name')));
        $this->set('teams', $teams);
    }
}

?>