<?php 
$filename = "proposal.pdf";
header("Content-type: application/pdf");
header("Content-Length: " . filesize($filename));
readfile($filename);
 ?>