<?

    require_once "config.php";

    $input_params = array('date', 'time', 'trv', 'wtop', 'sbop', 'bcl', 'lat', 'lon');

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
                INSERT INTO indications (TS, TRV, WTOP, SBOP, BCL, lat, lon)
                VALUES (:ts, :trv, :wtop, :sbop, :bcl, :lat, :lon)";

            $stmt = $pdo->prepare($query);
            //$stmt->bindValue(':sid', $sid);
            //$datetime = DateTime::createFromFormat('YmdHis', $data['date'] . $data['time']);

            $response_token = $data['time'];
            list($y, $m, $d, $H, $i, $s) = sscanf($data['date'] . $data['time'], "%2s%2s%2s%2s%2s%2s");
            unset($data['date'], $data['time']);
            //$data['ts'] = $datetime->getTimestamp();
            //$data['ts'] = $datetime->format('Y-m-d H:i:s');

            $data['ts'] = sprintf("20%2s-%2s-%2s %2s:%2s:%2s", $y, $m, $d, $H, $i, $s);

            $params = array_keys($data);
            foreach ( $params as $p )
                $stmt->bindValue(':' . $p, $data[$p]);

            $query = "SET time_zone = '+00:00'";
            $pdo->exec($query);

            $stmt->execute();

            if ( $stmt->errorCode() !== '00000' )
            {
                $error = $stmt->errorInfo();
                $res = 'Error ' . $error[0] . ': ' . $error[1] . ' (' . $error[2] . ')';
            }
            else $res = 'ok' . $response_token;
        }
	}
	else $res = "error";
	echo $res;