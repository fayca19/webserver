<?php

// Envois de mail au tiers-payant
$to = "louda.yacine@gmail.com";
$subject = "Demande validee";

$message="<html><head></head><body>ton contenu avec style à l'intérieur des balises</body></html>";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

mail($to, $subject, $message, $headers);
echo "Mail envoye !";

?>