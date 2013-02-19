<?php

class TournamentResultManager
{
    private $validator;
    private $resultModel;

    public function __construct($tournamentId) {
        $this->validator = new SignupValidator($tournamentId);
        $this->resultModel = mvc_model("Result");
    }

    public function signup($player_id1, $player_id2) {
        $this->validator->isValid($player_id1, $player_id2);
        $teamModel = mvc_model("Team");
        $team_id = TeamManager::createTeam($player_id1, $player_id2, $teamModel);
        return $this->createResult($team_id);
    }

    private function createResult($team_id)
    {
        $result = array(
            'team_id' => $team_id,
            'tournament_id' => $this->validator->tournament_id
        );
        $this->resultModel->create($result);
        return $this->teamsModel->insert_id;
    }

    public function getResultList() {
        $resultList = $this->resultModel->find(array(
            'conditions' => array(
                'tournament_id' => $this->validator->tournament_id,
                'points >' => 0
            ),
            'order' => 'place DESC'

        ));
        return $resultList;
    }
}
