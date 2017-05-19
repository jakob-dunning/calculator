<?php
namespace jakobDunning\calculator;

class calculator {
  
  private $operatorsRegex = '/([\+\-\/\*])/';
  private $display;
  private $input;
  
  function __construct($display, $input) {
    $this->display = $display;
    $this->input = $input;
  }
  
  public function updateDisplay() {
    
    // translate constants to numbers (pi, etc.)
    $this->translateConstants();
    
    // evaluate input by numbers, special buttons, etc.
    $this->evaluateInput();
    
    // aesthetics matter...
    $this->display = preg_replace('/\./', ',', $this->display);
    
    // return output to be displayed (Could've used the session for storing infos, but keeping the BACK button funtionality is kind of nice)
    $query = '?display=' . urlencode($this->display);
    header('Location:../index.php' . $query);
  }
  
  private function translateConstants() {
    
    if(!is_numeric($this->input)) {
      switch($this->input) {
        case 'pi':
          $this->input = pi();
        break;
      }
      $_SESSION['clearResultOnLoad'] = true;
    }
  }
  
  private function evaluateInput() {
    
    if($_SESSION['clearResultOnLoad']) {
      // clearing the display after hitting the "result" button if next input is number
      $_SESSION['clearResultOnLoad'] = false;
      if(is_numeric($this->input)) $this->display = 0;
    }
    
    switch($this->input) {
      case 'C':
        $this->display = '0';
      break;
      case 'load':
        $this->display = (isset($_SESSION['resultStorage'])) ? $_SESSION['resultStorage'] : $this->display;
      break;
      case 'save':
        $_SESSION['resultStorage'] = $this->display;
        $_SESSION['clearResultOnLoad'] = true;
      break;
      case ',':
        // check if there's a comma within the last number and whether the last char is an operator
        $offset = strrpos($this->display, ',');
        if(!$offset || (!is_numeric(substr($this->display, $offset+1)) && is_numeric(substr($this->display, -1)))) $this->display .= ',';
      break;
      case '=':
        $this->getResult();
        $_SESSION['clearResultOnLoad'] = true;
      break;
      default:
        
        // if trying to use operator without numbers, do nothing
        if(preg_match($this->operatorsRegex, $this->input) && preg_match('/0(?!,)/', $this->display)) break;

        // if any operator is pushed after pushing another operator, do nothing
        if(preg_match($this->operatorsRegex, $this->input) && preg_match($this->operatorsRegex, substr($this->display, -1))) break;

        // if a second operator is added, get intermediate result
        if(preg_match_all($this->operatorsRegex, $this->display) && preg_match($this->operatorsRegex, $this->input)) $this->getResult();

        // if display is 0, erase before adding new input
        $this->display = (preg_match('/0(?!,)/', $this->display)) ? $this->input : $this->display.$this->input;
        
      break;
    }
  }
  
  
  private function getResult() {
    
    // replace commas with dots to facilitate calculation
    $this->display = preg_replace('/,/', '.', $this->display); 
    $factors = preg_split($this->operatorsRegex,  $this->display, -1,  PREG_SPLIT_DELIM_CAPTURE);
    switch($factors[1]) {
      case '*':
        $this->display = $factors[0] * $factors[2];
      break;
      case '/':
        $this->display = $factors[0] / $factors[2];
      break;
      case '%':
        $this->display = $factors[0] % $factors[2];
      break;
      case '-':
        $this->display = $factors[0] - $factors[2];
      break;
      case '+':
        $this->display = $factors[0] + $factors[2];
      break;
    }
  }
  
}
