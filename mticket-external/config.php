<?php

  // set variables
  $zones = 9;
  $adults = 0;
  $bicycles = 0;

  /********** Calculation ***************/
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

  // start 10 minutes before now
  $start = time() - 10*60;

  // end
  $end = $start + 3600 * $duration;
?>