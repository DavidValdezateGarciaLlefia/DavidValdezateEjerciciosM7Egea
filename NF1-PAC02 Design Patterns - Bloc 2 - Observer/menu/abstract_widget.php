<?php

interface Observer {
  public function update(Observable $subject);
}


abstract class Widget implements Observer {

  protected $internalData = array();

  abstract public function draw();

  public function update(Observable $subject) {
         $this->internalData = $subject->getData();
  }
}


class BasicWidget extends Widget {

  function __construct() {
  }

  public function draw() {
         $html =  "<link rel=\"stylesheet\" type=\"text/css\" href=\"css.css\">";
         $html .= "<script src=\"https://kit.fontawesome.com/6db6b260dd.js\" crossorigin=\"anonymous\"></script>";
         $html .= "<script src=\"js.js\"></script>";
         $html .= "<h1>Smooth Accordion Dropdown Menu Demo</h1>";
         $html .= "<ul id=\"accordion\" class=\"accordion\">";
         $html .= "<li>";
         $html .= "<div class=\"link\"><i class=\"fa fa-database\"></i>Web Design<i class=\"fa fa-chevron-down\"></i></div>";
         $html .= "<ul class=\"submenu\">";

         $numRecords = count($this->internalData[0]);
         for($i = 0; $i < $numRecords; $i++) {
                $design = $this->internalData[0];
                
                $html .=  " <li><a href=\"#\">$design[$i]</a></li>";
                }
         $html .= "</ul>";
         $html .= "</li>";
         $html .= "<li>";
         $html .= "<div class=\"link\"><i class=\"fa fa-code\"></i>Coding<i class=\"fa fa-chevron-down\"></i></div>";
         $html .= "<li>";
         $html .= "<ul class=\"submenu\">";

         $numRecords = count($this->internalData[1]);
         for($i = 0; $i < $numRecords; $i++) {
                $coding = $this->internalData[1];
                
                $html .=  " <li><a href=\"#\">$coding[$i]</a></li>";
                }
         $html .= "</ul>";
         $html .= "</li>";
         $html .= "<li>";
         $html .= "<div class=\"link\"><i class=\"fa fa-mobile\"></i>Devices<i class=\"fa fa-chevron-down\"></i></div>";
         $html .= "<li>";
         $html .= "<ul class=\"submenu\">";

         $numRecords = count($this->internalData[2]);
         for($i = 0; $i < $numRecords; $i++) {
                $devices = $this->internalData[2];
                
                $html .=  " <li><a href=\"#\">$devices[$i]</a></li>";
                }
         $html .= "</ul>";
         $html .= "</li>";
         $html .= "<li>";
         $html .= "<div class=\"link\"><i class=\"fa fa-globe\"></i>Global<i class=\"fa fa-chevron-down\"></i></div>";
         $html .= "<li>";
         $html .= "<ul class=\"submenu\">";

         $numRecords = count($this->internalData[3]);
         for($i = 0; $i < $numRecords; $i++) {
                $global = $this->internalData[3];
                
                $html .=  " <li><a href=\"#\">$global[$i]</a></li>";
                }
         $html .= "</ul>";
         $html .= "</li>";
         $html .= "</ul>"; 
            

         echo $html;
  }
  
}
?>
