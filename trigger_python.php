<?php
$output = shell_exec("python capture.py 2>&1");
echo "<pre>$output</pre>";
?>
