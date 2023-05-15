<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP/HTML Test</title>
	</head>
	<link rel="stylesheet" href="table.css">
	<body>
		<style> 
			h1 {
				text-align: center;
				font-family: Arial, sans-serif;
				margin: 0.2em 0;
			}
			h5 {
				text-align: center;
				font-family: Arial, sans-serif;
				font-weight: normal;
  				margin: 0.2em 0;
			}
		</style>
		<h1>Vehicle Log Records</h1>
		<br>
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
			
			$_SESSION["logRecord_json"] = $response;
			$tabledata = json_decode($_SESSION["logRecord_json"], true);
		?>
		<?php
			$username = $_POST['username'];
			$password = $_POST['password'];
			#echo "<h5>Username: " . $username . "Password: " . $password . "</h5>";
		?>
		<table>
			<thead>
				<tr>
					<?php

					$keys = array_keys($tabledata["result"][0]);
					foreach ($keys as $key) {
						echo "<th>".$key."</th>";
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($tabledata["result"] as $row) {
					echo "<tr>";
					foreach ($row as $value) {
						if (gettype($value) == "array") {
							foreach ($value as $k => $val) {
								echo "<td>".$k."=".$val."</td>";
							}
						} else {
							echo "<td>$value</td>";
						}
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
	</body>
</html>