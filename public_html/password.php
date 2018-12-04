<?php

echo password_hash('password', PASSWORD_DEFAULT);
echo '<br>';
echo password_hash('password', PASSWORD_BCRYPT);
echo '<br>';
echo md5('password');