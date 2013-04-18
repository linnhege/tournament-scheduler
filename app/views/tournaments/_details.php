<h3>Detaljer <span class="arrows"> >> </span></h3>
<ul>
    <li id='place'>
        <span class='property'>Sted:</span>
        <span class='value'>
            <?php echo $tournament->location_name; ?>
        </span>
    </li>
    <li id='date'>
        <span class='property'>Dato:</span>
        <span class='value'><?php echo $tournament->date ?></span>
    </li>
    <li id='price'>
        <span class='property'>Pris (pr lag):</span>
        <span class='value'><?php echo $tournament->price ?> kr</span>
    </li>
    <li id='responsibility'>
        <span class='property'>Turneringsansvarlig:</span>
        <span class='value'>
            <?php echo '<a href="'. site_url() . "/tournament_responsibles/" . $tournament->tournamentResponsible->id . '/">'.$tournament->tournamentResponsible->name.'</a>'; ?>
        </span>
    </li>
    <li id='level'>
        <span class='property'>Klasse:</span>
        <span class='value'>
            <?php echo '<a href="'. site_url() . "/rankingleagues/" . $tournament->rankingleague->id . '/">'.$tournament->rankingleague->name.'</a>'; ?>
        </span>
    </li>
    <li id='comments'>
        <span class='value'>
            <?php echo $tournament->details; ?>
        </span>
    </li>
</ul>

