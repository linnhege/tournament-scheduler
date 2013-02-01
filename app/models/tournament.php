<?php

class Tournament extends MvcModel {

	var $display_field = 'name';
    var $belongs_to = array('Series' => array(
        'foreign_key' => 'serie_id'
    ));
    var $has_many = array('Result', 'Match');
}

?>