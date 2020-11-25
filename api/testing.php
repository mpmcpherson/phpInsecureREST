
curl -X GET 'http://couchAdmin:Adein1Dva2!@localhost:5984/_users/'

<?php

$ch = curl_init("http://couchAdmin:Adein1Dva2!@localhost:5984/_users/");
$fp = fopen("example_homepage.txt", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
if(curl_error($ch)) {
    fwrite($fp, curl_error($ch));
}
curl_close($ch);
fclose($fp);
?>
