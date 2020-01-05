<?php

    // Password hash is a new method to secure your PHP webpage
    echo password_hash('secret', PASSWORD_BCRYPT, array('cost' => 12)); // bigger the no of 'cost' => n, the more time it'll take to perfome this function
    

?>