<h2><?php echo $object->__name; ?></h2>
<br/>
<div id="reponsible_contact_info">
<p class="reponsible_contact_info_header">Kontaktinfo:</p>
<p>
    Telefon: <?php echo '<span class="responsible_phone">' . $object->phone . '</span>'; ?>
</p>
<p>
    Mail: <?php echo '<span class="responsible_mail">' . $object->mail . '</span>'; ?>
</p>
</div>
<div id="reponsible_image">
    <?php echo '<span class="responsible_image"><img width="200px"src="' . $object->url_to_picture . '"/></span>'; ?>
</div>