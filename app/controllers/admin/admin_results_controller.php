<?php

class AdminResultsController extends MvcAdminController {

    var $default_columns = array('id', 'name');

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

    public function admin_rankingleague_name($object) {
        return empty($object->rankingleague) ? null : $object->rankingleague->name;
    }

    public function save_results() {
        $columns = array('id', 'tournament_id', 'team_id', 'points', 'place', 'comments');
        global $wpdb;
        $prefix = $wpdb->prefix;
        for($i=0;$i<sizeof($_POST['id']);$i++):
            $row = array();
            foreach($columns as $column):
                $columnArray = $_POST[$column];
                $row[$column] = $columnArray[$i];
            endforeach;
            $row = array_filter($row);
            $sql = "UPDATE ".$prefix."results SET ";
            foreach($row as $columnName => $value) {
                $sql.= $columnName ." = ".$value . ",";
            }
            $sql = rtrim($sql, ",");
            $sql .= " WHERE id = " . $row['id'];
            $wpdb->query($sql);
        endfor;
        $results = $wpdb->get_results("select tournament_id from ". $prefix."results where id =" . $_POST['id'][0]);
        $result = $results[0];
        $tournament_id = $result->tournament_id;
        $url = MvcRouter::public_url(array('controller' => 'tournaments', 'action' => 'show', 'id' => $tournament_id));
        $this->redirect($url);
    }

    public function edit_result() {
        $id = (int) $_GET['id'];
        $results_model = mvc_model("Result");
        $tournament_model = mvc_model("Tournament");
        $tournament = $tournament_model->find_one_by_id($id);

        $results = $results_model->find(array(
            'conditions' => array(
                'tournament_id' => $id),
            'order' => 'place'));
        foreach($results as $result):
            $result->team = TeamManager::constructTeamByTeamId($result->team_id);
        endforeach;

        $form_url = get_admin_url() . "admin.php?page=mvc_results-save_results";

        $options = array('locals' =>
        array('results' => $results,
            'tournament' => $tournament,
            'form_url' => $form_url));
        $this->render_view("admin/results/tournament_results", $options);
    }

}

?>