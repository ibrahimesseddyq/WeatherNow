<?php
    require_once "class/WeatherNow.php";
    $weather = new WeatherNow("5eaa70fbeb55e00cf64807c53fd00557");
    $weather->setCity("casablanca");
    $weather->getData("certif.cer");
    echo "<pre>";
    print_r($weather->data);
    echo "<pre>";
?>