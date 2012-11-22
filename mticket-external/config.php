<?php

// get latest ticket from buy request
$ticket = json_decode(file_get_contents('buy_request.json'));
if($ticket && isset($ticket->{"estimation-end"}) && $ticket->{"estimation-end"} > time()){
  $price = $ticket->{"estimation-price"};
  $startZone = getStartZone($ticket);
  $start = $ticket->{"estimation-start"};
  $end = $ticket->{"estimation-end"};

  $product_list = $ticket->{"id-list"};
  $products = explode("|", $product_list);
  $adults = count($products);
  $product_id = $products[0];

  // the number of zones is the total zones divided by the number of adults
  $zones = $ticket->{"estimation-price"}/$adults;

}else{
  $zones = 9;
  $startZone = 1;

  $price = $zones;
  $ticketInfo = getTicketInfo($zones);
  $duration = $ticketInfo["duration"];
  $product_id = $ticketInfo["product_id"];

  $start = time() - 10 * 60;
  $end = $start + 3600 * $duration;

  $adults = 0;
}

$bicycles = 0;

// get startzone from silly string
function getStartZone($ticket){
  $properties = explode("|", $ticket->properties);
  $zoneArr = explode(":", $properties[0]);
  $startZone = $zoneArr[1];
  return $startZone;
}

function getTicketInfo($zones){
  switch ($zones) {
    case 2:
      $duration = 1;
      $product_id = 2002;
      break;
    case 3:
      $duration = 1;
      $product_id = 2003;
      break;
    case 4:
      $duration = 1.5;
      $product_id = 2004;
      break;
    case 5:
      $duration = 1.5;
      $product_id = 2005;
      break;
    case 6:
      $duration = 1.5;
      $product_id = 2006;
      break;
    case 7:
      $duration = 2;
      $product_id = 2007;
      break;
    case 8:
      $duration = 2;
      $product_id = 2008;
      break;
    case 9:
      $duration = 2;
      $product_id = 2009;
      break;
  }

  return array(
    "duration" => $duration,
    "product_id" => $product_id
  );
}

function getTicket($price, $zones, $start, $end, $product_id, $startZone, $adults, $bicycles){
  $ticket = array(
    "ticket" => array(
        "controlCode" => "CX6ZFK9K19008K1126",
        "price" => (int)$price,
        "lastTransaction" => 0,
        "error" => 0,
        "start" => (int)$start,
        "isexpired" => false,
        "properties" => array(
            "platform" => "android",
            "save_creditcard" => "false",
            "platform_model" => "Samsung-Nexus S-soju",
            "payment_api_version" => "2",
            "notify.external" => "https://public.mticket.unwire.com/mticket-external/server/notify.json",
            "ADDED_TO_MAXUSAGE" => "true",
            "TOTAL_VOUCHER_BALANCE" => "38",
            "product.id" => "$product_id",
            "app_version" => "1.3.0",
            "product.count" => "",
            "zones" => "$zones",
            "certificate" => "+'764253622'+\n+'095462376'+\n+'925224049'+\n+'622493933'+",
            "product.type" => "",
            "SKIP_VERIFICATION" => "true",
            "TICKET_DELIVERY_MODE" => "1",
            "internal_order_id" => "14",
            "POOL_ID" => "1",
            "startzone" => "$startZone",
            "multiple.ticket.parameter" => "&adults=" . $adults . "&children=0&bicycles=" . $bicycles . "&youths=0&seniors=0",
            "platform_api" => "16"
        ),
        "variant" => 18,
        "serial" => "CX6ZFK9",
        "lastStatus" => 32,
        "end" => (int)$end
    )
  );

  return json_encode($ticket);
}
?>