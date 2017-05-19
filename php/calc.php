<?php
  namespace jakobDunning\calculator;
  
  // session options
  session_start();

  require 'class.calc.php';

  $calc = new calculator($_POST['anzeige'], $_POST['button']);
  $calc->updateDisplay();


