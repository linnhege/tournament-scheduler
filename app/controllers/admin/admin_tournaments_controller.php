<?php

class AdminTournamentsController extends MvcAdminController {
	
	var $default_columns = array('name','date', 'serie' => array('value_method' => 'admin_serie_name'));

    public function add() {
        $this->set_series();
        $this->set_location();
        $this->set_responsible();
        $this->create_or_save();
    }

    public function edit() {
        $this->verify_id_param();
        $this->set_series();
        $this->set_responsible();
        $this->set_location();
        $this->set_object();
        $this->create_or_save();
    }


    private function set_series() {
        $this->load_model('Series');
        $series = $this->Series->find(array('selects' => array('id', 'name')));
        $this->set('series', $series);
    }

    private function set_location() {
        $this->load_model('Location');
        $locations = $this->Location->find(array('selects' => array('id', 'name')));
        $this->set('locations', $locations);
    }

    private function set_responsible() {
        $this->load_model('TournamentResponsible');
        $tournamentResponsibles = $this->TournamentResponsible->find(array('selects' => array('id', 'name')));
        $this->set('tournamentResponsible', $tournamentResponsibles);
    }

    public function admin_serie_name($object) {
        return empty($object->series) ? null : $object->series->name;
    }

    public function results()
    {
        $tournaments_model = mvc_model("Tournament");
        $all_tournaments = $tournaments_model->find();
        $options = array('locals' => array('tournaments' => $all_tournaments));
        $this->render_view("admin/tournaments/choose_tournament", $options);
    }

}

?>