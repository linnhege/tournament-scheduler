<div class='details'>
    <h3>Details</h3>
    <div>
        <ul class='admin'>
            <li id='name'>
                <span class='property'>Name:</span>
                <span class='value'><?php echo $tournament->name ?></span>
            </li>
            <li id='place'>
                <span class='property'>Location:</span>
                <span class='value'>
                    <?php echo $tournament->location_name; ?>
                </span>
            </li>
            <li id='date'>
                <span class='property'>date:</span>
                <span class='value'><?php echo $tournament->date ?></span>
            </li>
            <li id='price'>
                <span class='property'>pris:</span>
                <span class='value'><?php echo $tournament->price ?></span>
            </li>
            <li id='responsibility'>
                <span class='property'>tuneringsansvarlig:</span>
                <span class='value'>
                    <?php echo '<a href="'. site_url() . "/tournament_responsibles/" . $tournament->tournamentResponsible->id . '/">'.$tournament->tournamentResponsible->name.'</a>'; ?>
                </span>
            </li>
        </ul>
        Merknader: <span class='coments'> <?php echo $tournament->details; ?> </span>
    </div>
</div>