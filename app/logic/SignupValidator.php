<?php

class SignupValidator
{

    private $resultModel;
    public  $tournament_id;

    public function __construct($tournament_id) {
        $this->resultModel = mvc_model("Result");
        $this->tournament_id = $tournament_id;
    }

    public function isValid($player_id1, $player_ids) {
        $current_user = wp_get_current_user();
        //Todo: fix hack to let editor and greater add team. Should create our own capabilties.
        if((int) $current_user->ID != (int) $player_id1 &&   !current_user_can( 'delete_others_pages' )) {
            throw new UnexpectedValueException("player is not equal to the current user logged in");
        }

        if(in_array($player_id1, $player_ids)) {
            throw new UnexpectedValueException("Same person");
        }

        $this->ifUserIsSignedUpThrowError($player_id1);
        foreach($player_ids as $player_id):
            $this->ifUserIsSignedUpThrowError($player_id);
        endforeach;
    }

    public function ifUserIsSignedUpThrowError($player_id)
    {
        global $wpdb;
        $player_count = $this->resultModel->count(
            array( 'joins' => array('team' =>
                                        array('table' => $wpdb->prefix . 'teams',
                                               'alias' => "Team",
                                               'on' => "Result.team_id = Team.id"),
                                    'playersinteam' =>
                                        array('table' => $wpdb->prefix . 'playersinteam',
                                              'alias' => "pt",
                                               'on' => "pt.team_id = Team.id")),
                   'conditions' => array(
                        'AND' => array('Result.tournament_id' => $this->tournament_id),
                                      'pt.player_id' => $player_id
        )));

        if ($player_count > 0) {
            $user = get_user_by('id', $player_id);
            throw new UnexpectedValueException($user->display_name . " is already signed up for this tournament");
        }
    }
}
