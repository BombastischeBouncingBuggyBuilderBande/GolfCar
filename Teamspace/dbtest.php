<?php
phpinfo();
$mysqli = new mysqli("5.231.1.40", "root", "ipfm6wtdxrb3zqav", "Tagebuch");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
}
echo "Connection successful";
?>