<?php
  namespace jakobDunning\calculator;

  session_start();

  // debug mode
  ini_set('display_errors', '1');

  require 'class.calc.php';

  $calc = new calculator();
  $calc->updateDisplay();

