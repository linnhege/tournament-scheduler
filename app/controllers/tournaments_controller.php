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

        $this->setLocationNameOnTournamentObject($object, $tournament);
        $this->setTournamentResponsibleOnTournamentObject($object, $tournament);

        $tournamentManager = new TournamentManager($tournament, get_current_user_id(), get_users());

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
        $this->set('canUserSignup', $tournamentManager->canUserSignup());
        $this->set('results', $tournamentManager->getResultList());

    }

    public function setLocationNameOnTournamentObject($object, $tournament)
    {
        $this->load_model('Location');
        $location = $this->Location->find_by_id($object->location_id);
        $tournament->location_name = $location->name;
    }


    public function setTournamentResponsibleOnTournamentObject($object, $tournament)
    {
        $this->load_model('TournamentResponsible');
        $tournamentResponsible = $this->TournamentResponsible->find_by_id($object->tournament_responsible_id);
        $tournament->tournamentResponsible = $tournamentResponsible;
    }
}

?>