<?php
    $config = file_get_contents('./configs/config.json');
    $config = json_decode($config, true);

    $host = $config['host'];
    $port = $config['port'];
    $db_name = $config['db_name'];
    $user = $config['user'];
    $password = $config['password'];

    $connection = new PDO('mysql:host='.$host.";port=". $port .';dbname='. $db_name . ""
    , $user , $password);