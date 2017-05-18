<?php
namespace jakobDunning\calculator;

class calculator {
  
  function updateDisplay() {
    $display = $_POST['anzeige'];
    $input = $_POST['button'];
    $operatorsRegex = '/([\+\-\/\*])/';
    
    // translate constants to numbers (pi, etc.)
    $input = $this->translateConstants($input);
    
    // evaluate input by numbers, special buttons, etc.
    $display = $this->evaluateInput($display, $input, $operatorsRegex);
    
    // aesthetics matter...
    $display = preg_replace('/\./', ',', $display);
    
    // return output to be displayed
    $query = '?display=' . urlencode($display);
    header('Location:../index.php' . $query);
  }
  
  function translateConstants($input) {
    if(!is_numeric($input)) {
      switch($input) {
        case 'pi':
          $input = pi();
        break;
      }
    }
    return $input;
  }
  
  function evaluateInput($display, $input, $operatorsRegex) {
    
    if($_SESSION['clearResultOnLoad']) {
      // clearing the display after hitting the "result" button if next input is number
      $_SESSION['clearResultOnLoad'] = false;
      if(is_numeric($input)) $display = 0;
    }
    
    switch($input) {
      case 'C':
        $display = '0';
      break;
      case 'load':
      break;
      case 'save':
      break;
      case ',':
        // check if there's a comma within the last number and whether the last char is an operator
        $offset = strrpos($display, ',');
        if(!$offset || (!is_numeric(substr($display, $offset+1)) && is_numeric(substr($display, -1)))) $display .= ',';
      break;
      case '=':
        $display = $this->getResult($display, $operatorsRegex);
        $_SESSION['clearResultOnLoad'] = true;
      break;
      default:
        // if a second operator is added, get intermediate result
        if(preg_match_all($operatorsRegex, $display) && preg_match($operatorsRegex, $input)) {
          $display = $this->getResult($display, $operatorsRegex);
        }
        
        // if display is 0, erase before adding new input
        $display = ($display == 0) ? $input : $display.$input;
      break;
    }
    return $display;
  }
  
  
  function getResult($display, $operatorsRegex) {
    
    // replace commas with dots to facilitate calculation
    $display = preg_replace('/,/', '.', $display); 
    
    $factors = preg_split($operatorsRegex,  $display, -1,  PREG_SPLIT_DELIM_CAPTURE);
    switch($factors[1]) {
      case '*':
        $display = $factors[0] * $factors[2];
      break;
      case '/':
        $display = $factors[0] / $factors[2];
      break;
      case '%':
        $display = $factors[0] % $factors[2];
      break;
      case '-':
        $display = $factors[0] - $factors[2];
      break;
      case '+':
        $display = $factors[0] + $factors[2];
      break;
    }
    
    return $display;
  }
}
