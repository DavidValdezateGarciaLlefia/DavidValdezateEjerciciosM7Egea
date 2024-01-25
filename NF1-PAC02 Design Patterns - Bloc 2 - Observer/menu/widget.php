<?php
require_once("observable.php");
require_once("abstract_widget.php");

$dat = new DataSource();
$widgetA = new BasicWidget();

$dat->addObserver($widgetA);

$dat->addRecord("Photoshop","Javascript","Tablet","Google");
$dat->addRecord("HTML","JQuery","Mobile","Bing");
$dat->addRecord("CSS","Ruby","Desktop","Yahoo");


$widgetA->draw();

?>
