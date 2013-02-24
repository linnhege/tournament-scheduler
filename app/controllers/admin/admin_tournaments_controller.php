<?php

class AdminTournamentsController extends MvcAdminController {
	
	var $default_columns = array('name','date', 'serie' => array('value_method' => 'admin_serie_name'));

    public function add() {
        $this->set_series();
        $this->create_or_save();
    }

    public function edit() {
        $this->verify_id_param();
        $this->set_series();
        $this->set_object();
        $this->create_or_save();
    }


    private function set_series() {
        $this->load_model('Series');
        $series = $this->Series->find(array('selects' => array('id', 'name')));
        $this->set('series', $series);
    }

    public function admin_serie_name($object) {
        return empty($object->series) ? null : $object->series->name;
    }

    public function results()
    {
        $id = $this->params['id'];

        if(empty($id)):
            $tournaments_model = mvc_model("Tournament");
            $all_tournaments = $tournaments_model->all();
            $options = array('locals' => array('tournaments' => $all_tournaments));
            $this->render_view("admin/tournaments/choose_tournament", $options);
        else:
            $this->render_view("admin/tournaments/add_result");
        endif;
    }

}

?>