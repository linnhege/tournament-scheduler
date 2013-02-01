<?php

echo "<h3>Resultatliste</h3>";
if (!$result):
    echo "Ingen plasseringer er utdelt";
else:
    echo $result;
endif;

