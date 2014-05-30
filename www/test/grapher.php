<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.05.14
 * Time: 23:56
 */
    header("Content-type: text/json");
    require_once "../config.php";

    try {
        $pdo = new PDO($dsn, $dbuser, $dbpass);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }

/*
    if ( empty($_GET['sid']) )
    {
        echo 'No session identifier specified';
        exit();
    }
*/
    if ( empty($_GET['param']) )
    {
        echo 'No param specified';
        exit();
    }

    $query = "
        SELECT UNIX_TIMESTAMP(TS) AS TS, " . $_GET['param'] . "
        FROM indications";


    $stmt = $pdo->query($query);

    foreach ( $stmt as $item )
    {
        $data[] = array($item['TS'] * 1000, (float)$item[$_GET['param']]);
    }

    echo json_encode($data);