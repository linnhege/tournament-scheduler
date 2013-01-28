<?php

class AdminTournamentsController extends MvcAdminController {
	
	var $default_columns = array('name', 'date', 'serie_id');

    public function add() {
        $this->set_series();
        $this->create_or_save();
    }

    public function edit() {
        $this->verify_id_param();
        $this->set_series();
        $this->create_or_save();
        $this->set_object();
    }

    private function set_series() {
        $this->load_model('Series');
        $series = $this->Series->find(array('selects' => array('id', 'name')));
        $this->set('series', $series);
    }

    public function save() {

    }
}

?>