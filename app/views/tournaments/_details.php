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
                <span class='value'><?php echo $tournament->location ?></span>
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

                <span class='value'><?php
                    $wp_user = get_userdata($tournament->turneringsansvarlig);
                    echo  $wp_user->display_name ?></span>
            </li>
        </ul>
    </div>
</div>