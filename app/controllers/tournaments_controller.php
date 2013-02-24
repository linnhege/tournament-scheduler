<?php

class TournamentsController extends MvcPublicController
{

    public function add_team() {
        $player_id1 = (int) $_POST['player_id1'];
        $player_ids = (array) $_POST['player_id2'];
        $tournament_id = (int) $_POST['tournament_id'];
        $signupVaildator = new TournamentResultManager($tournament_id);
        $id = $signupVaildator->signup($player_id1, $player_ids);
        if($id > 0) {
            $this->set_flash('notice', 'Du er meld på turneringen!');
        } else {
            $this->set_flash('error', 'Noe gikk galt, prøv igjen senere eller kontakt oss hvis du har sett denne meldingen flere ganger!');
        }
        $url = MvcRouter::public_url(array('controller' => $this->name, 'action' => 'show', 'id' => $tournament_id));
        $this->redirect($url);
    }

    public function show()
    {
        $this->set_object();
        $this->load_model('Tournament');
        $object = $this->view_vars['object'];
        $tournament = $this->Tournament->find_by_id($object->id, array(
            'includes' => array('Result')
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
        $this->set('seedingList', $tournamentManager->seedingList());
        $this->set('isUserSignedup', $tournamentManager->isCurrentUserSignedUp());
        $this->set('results', $tournamentManager->getResultList());

    }

    private function set_serie()
    {
        $this->load_model('Series');
        $series = $this->Series->find(array('selects' => array('id', 'name')));
        $this->set('series', $series);
    }


}

?>