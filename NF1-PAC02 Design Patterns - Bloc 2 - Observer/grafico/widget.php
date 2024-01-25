<?php
require_once("observable.php");
require_once("abstract_widget.php");

$dat = new DataSource();
$widgetA = new BasicWidget();

$dat->addObserver($widgetA);

$dat->addRecord("January", "February", "March", "April");
$dat->addRecord(10, 20, 30, 40);
$dat->addRecord(10, 20, 30, 40);
$dat->addRecord(50, 50, 50, 50);
$dat->addRecord("rgb(255, 99, 132)","rgb(54, 162, 235)");
$dat->addRecord("rgba(255, 99, 132, 0.2)");


$widgetA->draw();

?>
