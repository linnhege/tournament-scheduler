
<?php //TODO: fix adminUrl ?>
<form method='post' action='/wordpress/tournaments/add_team/<?php echo $tournament->id ?>'>
    <input type="hidden" name="tournament_id" value="<?php echo $tournament->id ?>" />
    <input type="hidden" name="player_id1" value="<?php echo $current_user->ID ?>" />
    <?php echo $current_user->display_name ?> -
    <select name="player_id2">
        <?php
        foreach ($availablePlayers as $availablePlayer):
            echo "<option value=\"{$availablePlayer->ID}\">{$availablePlayer->display_name}</option>";
        endforeach;
        ?>
        <input type='submit' name='Signup'/>
</form>


