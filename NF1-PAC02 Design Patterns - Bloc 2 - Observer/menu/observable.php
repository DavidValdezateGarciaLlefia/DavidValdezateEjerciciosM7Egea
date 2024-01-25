<?php
abstract class Observable {

  private $observers = array();

  public function addObserver(Observer $observer) {
         array_push($this->observers, $observer);
  }

  public function notifyObservers() {
         for ($i = 0; $i < count($this->observers); $i++) {
                 $widget = $this->observers[$i];
                 $widget->update($this);
         }
     }
}


class DataSource extends Observable {

  private $design;
  private $coding;
  private $devices;
  private $global;

  function __construct() {
         $this->design = array();
         $this->coding = array();
         $this->devices = array();
         $this->global = array();
  }
   
  public function addRecord($design, $coding, $devices,$global) {
         array_push($this->design, $design);
         array_push($this->coding, $coding);
         array_push($this->devices, $devices);
         array_push($this->global, $global);
         $this->notifyObservers();
  }

  public function getData() {
         return array($this->design, $this->coding, $this->devices, $this->global);
  }
}
?>
