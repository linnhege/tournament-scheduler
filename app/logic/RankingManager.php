<?php

class RankingManager
{
    public function __construct() {
        $this->teamsModel = mvc_model("Result");
    }

    public function getRanking($serie_id) {
        //TODO: Can we expect that all entries in a tournament get points?
        $resultList = $this->resultModel->find(array(
            'conditions' => array(

                'points >' => 0
            ),
            'order' => 'place DESC' ));
    }
}
