<?php
include("config.php");
// $ticket = json_decode(file_get_contents('buy_request.json'));

echo getTicket($zones, $start, $end, $product_id, $startZone, $adults, $bicycles);
?>