<?php
  namespace jakobDunning\calculator;
  
  // session options
  session_start();
  
  //debugging
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  require 'class.calc.php';

  $calc = new calculator($_POST['anzeige'], $_POST['button']);
  $calc->updateDisplay();


