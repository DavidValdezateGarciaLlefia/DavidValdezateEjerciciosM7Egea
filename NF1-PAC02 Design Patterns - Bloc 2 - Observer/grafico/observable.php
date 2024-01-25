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

       private $meses = [];
       private $numeros = [];
       private $numeros2 = [];
       private $numeros3 = [];
       private $colores = [];
       private $colores2 = [];
     
       function __construct() {
              
       }
     
       public function addRecord($meses,$numeros,$numeros2,$numeros3,$colores,$colores2) {
     
      
             array_push($this->meses, $values);
          
       
             array_push($this->numeros, $values);
    
    
             array_push($this->numeros2, $values);
          
             array_push($this->numeros3, $values);
          
        
             array_push($this->colores, $values);
       
             array_push($this->colores2, $values);
          
             $this->notifyObservers();  
         
       }
         

     
       public function getData() {
         return [
           'meses' => $this->meses,
           'numeros' => $this->numeros,
           'numeros2' => $this->numeros2,
           'numeros3' => $this->numeros3,
           'colores' => $this->colores,
           'colores2' => $this->colores2
         ];
       }
}
?>
