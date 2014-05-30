<?

    require_once "config.php";

    $input_params = array('ts', 'trv', 'top', 'sbop', 'bcl', 'lat', 'lon');

    function get_message(array $in_params)
    {
        $data = array();
        foreach ( $in_params as $param ) {
            if ( !isset($_GET[$param]) )
                return FALSE;
            $value = $_GET[$param];
            $data[$param] = $value;
        }
        return $data;
    }

/*
    function get_last_session_id($pdo)
    {
        $query = "
            SELECT id
            FROM sessions
            ORDER BY id DESC
            LIMIT 1";

        $stmt = $pdo->query($query);
        $id = $stmt->fetch(PDO::FETCH_NUM);
        return $id[0];
    }
*/

    try {
        $pdo = new PDO($dsn, $dbuser, $dbpass);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }

	if ( count($_GET) > 0 )
	{
        $res = "Invalid params format";
        /*
		if ( isset($_GET['session']) && !empty($_GET['lat']) && !empty($_GET['lon']) )
        {
            $query = "
                INSERT INTO sessions (lat, lon)
                VALUES (" . $_GET['lat'] . ',' . $_GET['lon'] . ")";

            $pdo->exec($query);
            $res = implode(' ', $pdo->errorInfo());
        }
        */
        if ( $data = get_message($input_params) )
        {
            //$sid = get_last_session_id($pdo);

            $query = "
                INSERT INTO indications (TS, TRV, TOP, SBOP, BCL, lat, lon)
                VALUES (:ts, :trv, :top, :sbop, :bcl, :lat, :lon)";

            $stmt = $pdo->prepare($query);
            //$stmt->bindValue(':sid', $sid);
            //$stmt->bindValue(':ts', date('Y-m-d H:i:s', $data['ts']) );
            //unset($data['ts']);
            $data['ts'] = date('Y-m-d H:i:s', $data['ts']);
            $params = array_keys($data);
            foreach ( $params as $p )
                $stmt->bindValue(':' . $p, $data[$p]);

            $stmt->execute();

            $res = implode(' ', $stmt->errorInfo());
        }
	}
	else $res = "No params";
	echo $res;