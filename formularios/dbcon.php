<?php

require __DIR__.'/vendor/autoload.php';


use Kreait\Firebase\Factory;

$factory = (new Factory)
->withServiceAccount('parkiate-ki-firebase-adminsdk-7f08q-e527eb9701.json')
->withDatabaseUri('https://parkiate-ki-default-rtdb.firebaseio.com/');


$database = $factory->createDatabase();

//echo "my love is waitinn for you";





?>

