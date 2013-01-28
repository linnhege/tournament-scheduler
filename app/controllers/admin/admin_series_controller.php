<?php

class AdminSeriesController extends MvcAdminController {
	
	var $default_columns = array('name', 'rankingleague_id');

    public function add() {
        $this->set_rankingleagues();
        $this->create_or_save();
    }

    public function edit() {
        $this->verify_id_param();
        $this->set_rankingleagues();
        $this->create_or_save();
        $this->set_object();
    }

    private function set_rankingleagues() {
        $this->load_model('Rankingleague');
        $rankingleagues = $this->Rankingleague->find(array('selects' => array('id', 'name')));
        $this->set('rankingleagues', $rankingleagues);
    }
}

?>