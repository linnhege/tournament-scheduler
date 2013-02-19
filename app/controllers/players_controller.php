<?php

class PlayersController extends MvcPublicController {
    public function index() {
        $users = get_users();
        $this->render_view('players/index',
            array('locals' =>
                array('users' => $users)));
    }

    public function show() {
        $id = (int) $this->params['id'];
        $player = new PlayerManager($id);
        $this->render_view('players/show',
            array('locals' =>
            array('player' => $player)));
    }
}

?>