<?php

class Series extends MvcModel {

	var $display_field = 'name';
    var $belongs_to = array('Rankingleague');
    var $has_many = array('Tournament');

}

?>