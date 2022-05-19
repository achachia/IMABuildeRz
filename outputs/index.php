<?php

echo '<html>';
echo '<head>';
echo '<title>Outputs</title>';
echo '</head>';
echo '<body>';
echo '<h4 style="padding: 12px;font-size: 36px;">Cordova</h4>';
echo '<ol>';
foreach (glob("*/platforms/android/app/build/outputs/apk/debug/app-debug.apk") as $filename) {
	$name = explode("/",$filename);
	echo '<li style="padding: 12px;font-size: 24px;"><a href="'.$filename.'">'. $name[0].'</a></li>';
}
echo '</ol>';
echo '<h4 style="padding: 12px;font-size: 36px;">Capasitor</h4>';
echo '<ol>';
foreach (glob("*/android/app/build/outputs/apk/debug/app-debug.apk") as $filename) {
	$name = explode("/",$filename);
	echo '<li style="padding: 12px;font-size: 24px;"><a href="'.$filename.'">'. $name[0].'</a></li>';
}
echo '</ol>';
echo '</body>';
echo '</html>';
