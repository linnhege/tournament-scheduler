<?php

class TournamentResultManager
{
    private $validator;
    private $resultModel;

    public function __construct($tournamentId) {
        $this->validator = new SignupValidator($tournamentId);
        $this->resultModel = mvc_model("Result");
    }

    public function signup($player_id1, $players) {

        $this->validator->isValid($player_id1, $players);
        $teamModel = mvc_model("Team");
        $players[] = $player_id1;
        $team_id = TeamManager::createTeam($players, $teamModel);
        return $this->createResult($team_id);
    }

    private function createResult($team_id)
    {
        $signedUpById = wp_get_current_user()->ID;
        $signedUpDate = date("Y-m-d H:i:s");

        $result = array(
            'team_id' => $team_id,
            'tournament_id' => $this->validator->tournament_id,
            'signedUpDate'  => $signedUpDate,
            'signedUpBy' => $signedUpById
        );
        return  $this->resultModel->create($result);
    }

    public function getResultList() {
        $resultList = $this->resultModel->find(array(
            'conditions' => array(
                'tournament_id' => $this->validator->tournament_id,
                'points >' => 0
            ),
            'order' => 'place ASC'
        ));
        return $resultList;
    }
}
