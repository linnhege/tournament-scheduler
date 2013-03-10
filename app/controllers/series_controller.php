<?php

class SeriesController extends MvcPublicController {

    public function show() {
        $this->set_object();
        $seedingManager = new SeedingManager($this->object->rankingleague_id);
        $this->set('seedingList', $seedingManager->getSeedingList());

    }
}

?>