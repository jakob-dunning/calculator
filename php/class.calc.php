<?php
namespace jakobDunning\calculator;

class calculator {
  
  function updateDisplay() {
    $display = $_SESSION['display'];
    $input = $_POST['button'];
    global $debug;
    //$debug = '';
    
    // translate constants to numbers (pi, etc.)
    $input = $this->translateConstants($input);
    
    // evaluate input by numbers, special buttons, etc.
    $_SESSION['display'] = $this->evaluateInput($display, $input);
    
    // get intermediate results to be displayed
    $_SESSION['displayIntermediate'] = $this->getIntermediateResults($_SESSION['display']);
    
    // return output to be displayed
    header('Location:../index.php');
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
  
  function evaluateInput($display, $input) {
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
        $display = $this->getResult($display);
      break;
      default:
        // no 2 operators after each other, only numbers
        if(!is_numeric(substr($display, -1)) && !is_numeric($input)) break;
        
        // if display is 0, erase before adding new input
        $display = ($display == 0) ? $input : $display.$input;
      break;
    }
    return $display;
  }
  
  function getIntermediateResults($display) {
    // get all multiplications
    $displayIntermediate = preg_replace_callback('/\d+\*\d+(?!\(\d+\))/', function($matches) {
      $matchesUpdated = [];
      /*
      foreach($matches as $match) { 
        $factors = explode('*', $match);
        $matchesUpdated[] = $match . '(' . ($factors[0] * $factors[1]) . ')';
      }
      */
      $factors = explode('*', $matches[0]);
      $match = $matches[0] . '(' . ($factors[0] * $factors[1]) . ') ';
      return $match;
    }, $display);
    return ($displayIntermediate) ? $displayIntermediate : $display;
  }
  
  function getResult($display) {
    return 666;
  }
}
