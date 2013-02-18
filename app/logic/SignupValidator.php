<?php

class SignupValidator
{

    private $resultModel;
    public  $tournament_id;

    public function __construct($tournament_id) {
        $this->resultModel = mvc_model("Result");
        $this->tournament_id = $tournament_id;
    }

    public function isValid($player_id1, $player_id2) {
        $current_user = wp_get_current_user();
        if((int) $current_user->ID != (int) $player_id1) {
            throw new UnexpectedValueException("player is not equal to the current user logged in");
        }

        if($player_id2 == $player_id1) {
            throw new UnexpectedValueException("Same person");
        }

        $this->ifUserIsSignedUpThrowError($player_id1);
        $this->ifUserIsSignedUpThrowError($player_id2);
    }

    public function ifUserIsSignedUpThrowError($player_id)
    {
        $player_count = $this->resultModel->count(
            array( 'joins' => array('table' => '{prefix}teams',
                   'conditions' => array(
                        'AND' => array('Result.tournament_id' => $this->tournament_id),
                        'OR' => array
                                ('Team.player1_id' => $player_id,
                                'Team.player2_id' => $player_id)
        ))));

        if ($player_count > 0) {
            $user = get_user_by('id', $player_id);
            throw new UnexpectedValueException($user->display_name . " is already signed up for this tournament");
        }
    }
}
