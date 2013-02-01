<?php

class TournamentsController extends MvcPublicController
{

    public function add_team() {
        $tournament_id = (int) $_POST['tournament_id'];
        if(get_current_user_id() != (int) $_POST['player_id1']) {
            throw new UnexpectedValueException("player_id1 is not equal to the current user logged in");
        }
        $this->flash('notice', 'Du er meld på turneringen!');
        $this->refresh();
    }

    public function show()
    {
        $this->set_object();
        $this->load_model('Tournament');
        $object = $this->view_vars['object'];
        $tournament = $this->Tournament->find_by_id($object->id, array(
            'includes' => array('Resgult')
        ));
        $tournamentManager = new TournamentManager($tournament, get_current_user_id(), get_users());
        //print_r($tournamentManager);

        //TODO.... fix Result/Users
        $current_user = wp_get_current_user();
        $adminUrl = get_admin_url();
        $this->set('tournament', $tournament);
        $this->set('current_user', $current_user);
        $this->set('adminUrl', $adminUrl);
        $this->set('availablePlayers', $tournamentManager->availablePlayers());
        $this->set('signupPlayers', $tournamentManager->signupPlayers());
        $this->set('isUserSignedup', $tournamentManager->isCurrentUserSignedUp());

    }

    private function set_serie()
    {
        $this->load_model('Series');
        $series = $this->Series->find(array('selects' => array('id', 'name')));
        $this->set('series', $series);
    }

}

?>