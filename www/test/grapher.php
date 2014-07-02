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

    if ( !empty($_GET['tsLast']) )
    {

        //exit();
        if ( rand(0, 1) )
        {
            echo json_encode(null);
            exit();
        }
        $ts = $_GET['tsLast'] + 1;

        $query = "
        SELECT UNIX_TIMESTAMP( TS ) AS TS, WTOP + SBOP AS TOP, WTOP, SBOP, TRV, BCL
        FROM indications
        WHERE UNIX_TIMESTAMP( TS ) BETWEEN " . $ts  . " AND UNIX_TIMESTAMP(NOW())
        ORDER BY TS";


        /*
        $query = "
            SELECT UNIX_TIMESTAMP( TS ) AS TS, WTOP + SBOP AS TOP, WTOP, SBOP, TRV, BCL
            FROM indications
            ORDER BY id DESC
            LIMIT 1";
        */
        /*

        $stmt = $pdo->query($query);

        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        $data['ts']     = $item['TS'] * 1000;
        $data['top']    = (float)$item['TOP'];
        $data['wtop']   = (float)$item['WTOP'];
        $data['sbop']   = (float)$item['SBOP'];
        $data['trv']    = (float)$item['TRV'];
        $data['bcl']    = (float)$item['BCL'];

        */
    }
    else
    {
        $query = "
            SELECT UNIX_TIMESTAMP(TS) AS TS, WTOP + SBOP AS TOP, WTOP, SBOP, TRV, BCL
            FROM indications
            WHERE TS BETWEEN NOW() - INTERVAL 1 HOUR AND NOW()
            ORDER BY TS";
    }

    $stmt = $pdo->query($query);

    foreach ( $stmt as $item )
    {
        $data['ts'][]   = $item['TS'] * 1000;
        $data['top'][]  = (float)$item['TOP'];
        $data['wtop'][] = (float)$item['WTOP'];
        $data['sbop'][] = (float)$item['SBOP'];
        $data['trv'][]  = (float)$item['TRV'];
        $data['bcl'][]  = (float)$item['BCL'];
    }

    echo json_encode($data);