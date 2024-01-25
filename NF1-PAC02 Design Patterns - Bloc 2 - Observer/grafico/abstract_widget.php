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
       $html = "<html lang=\"es\">
            <head>
              <title>Chart.js grafico widget valdezate</title>
              <script src=\"https://cdn.jsdelivr.net/npm/@kurkle/color\"></script>
              <script src=\"https://cdn.jsdelivr.net/npm/luxon\"></script>
              <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>       
              <script src=\"utils.js\"></script>
            </head>
            <body>
              <div style=\"width: 800px;\"><canvas id=\"linea\"></canvas></div>";
   
       // Extract data from internalData
       $labels = $this->internalData['meses'];
       $barData = $this->internalData['numeros'];
       $lineData = $this->internalData['numeros2'];
       $barColor = $this->internalData['colores'][0]; // Assuming only one color for bar
       $lineColor = $this->internalData['colores2'][0]; // Assuming only one color for line
   
       // Start the JavaScript code block
       $html .= "<script>
                 const linea = document.getElementById('linea');
                 const labels = [";
       // Loop through labels
       $numRecords = count($labels);
       for ($i = 0; $i < $numRecords; $i++) {
           $html .= "'" . $labels[$i] . "'";
           if ($i !== $numRecords - 1) {
               $html .= ",";
           }
       }
       $html .= "];
                 const barData = [";
       // Loop through barData
       for ($i = 0; $i < $numRecords; $i++) {
           $html .= $barData[$i];
           if ($i !== $numRecords - 1) {
               $html .= ",";
           }
       }
       $html .= "];
                 const lineData = [";
       // Loop through lineData
       for ($i = 0; $i < $numRecords; $i++) {
           $html .= $lineData[$i];
           if ($i !== $numRecords - 1) {
               $html .= ",";
           }
       }
       $html .= "];
   
                 const barColor = '" . $barColor . "';
                 const lineColor = '" . $lineColor . "';
   
                 const data = {
                   labels: labels,
                   datasets: [
                     {
                       type: 'bar',
                       label: 'Bar Dataset',
                       data: barData,
                       borderColor: barColor,
                       backgroundColor: 'rgba' + barColor
                     },
                     {
                       type: 'line',
                       label: 'Line Dataset',
                       data: lineData,
                       fill: false,
                       borderColor: lineColor
                     }
                   ]
                 };
   
                 const config = {
                   type: 'scatter',
                   data: data,
                   options: {
                     scales: {
                       y: {
                         beginAtZero: true
                       }
                     }
                   }
                 };
   
                 new Chart(linea, config);
                 </script>";
       
       // Close HTML body and document
       $html .= "</body></html>";
   
       echo $html;
   }
   
   }
  

?>
