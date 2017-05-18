<?php
  namespace jakobDunning\calculator;

  // session options
  session_start();

  require 'class.calc.php';

  $calc = new calculator();
  $calc->updateDisplay();


