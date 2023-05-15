<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>test page</title>
	</head>
	<body>
		<h1>Test Page 2</h1>
		<p>This is the second test page.</p>
		<?php
			if (isset($_POST['username'])) {
				$username = $_POST['username'];
				echo "The username you entered is: " . $username . "<br>";
				}

			if (isset($_POST['password'])) {
				$passcode = $_POST['password'];
				echo "The password you entered is: " . $password . "<br>";
			}
		?>

		<?php
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://my.geotab.com/apiv1/',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"method":"Get",
			"params":{
				"credentials":{
					"database":"ayro",
					"sessionId":"CRtj2vFiuvW03te0842RKg",
					"userName":"ayro.admin@ayro.com"
				},
				"typeName":"LogRecord",
				"resultsLimit":30
			}
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Cookie: GCLB=CNKTsN6-wM6FPQ'
		),
		));

		$response = curl_exec($curl); //return string

		curl_close($curl);

		#$logRecord_json = json_encode($response, JSON_PRETTY_PRINT);
		
		$_SESSION["logRecord_json"] = $response;
		?>
		<form action="table.php">
			<button type="submit">Generate Table</button>
		</form>
	</body>
</html>