<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculator in PHP</title>
</head>
<body>
  <?php

  class Operation {
    const ADD = 'add';
    const SUBTRACT = 'subtract';
    const MULTIPLY = 'multiply';
    const DIVIDE = 'divide';
  }

  $BASE_URL = "calculator";
  $result = null;
  $error_message = null;

  if ($_SERVER["REQUEST_METHOD"] === "POST" 
      && isset($_POST["number1"]) 
      && isset($_POST["number2"])
      && isset($_POST["operation"])
  ) {
    $x = htmlspecialchars($_POST["number1"]);
    $y = htmlspecialchars($_POST["number2"]);
    $operation = htmlspecialchars($_POST["operation"]);

    if (!is_numeric($x) || !is_numeric($y) || empty($x) || empty($y)) {
      $error_message = "You must provide numbers";
    } else {
      switch ($operation) {
        case Operation::ADD:
          $result = add($x, $y);
          break;
        case Operation::SUBTRACT:
          $result = subtract($x, $y);
          break;
        case Operation::MULTIPLY:
          $result = multiply($x, $y);
          break;
        case Operation::DIVIDE:
          $result = divide($x, $y);
          break;
        default:
          $error_message = "Invalid operation selected.";
      }
    }
  }

  function add($x, $y) {
    return $x + $y;
  }

  function subtract($x, $y) {
    return $x - $y;
  }

  function multiply($x, $y) {
    return $x * $y;
  }

  function divide($x, $y) {
    return $y != 0 ? $x / $y : "Cannot divide by zero";
  }
  ?>
  
  <form method="POST">
    <div class="input_container">
      <label for="Enter the numbers">Enter the numbers</label>
      <input class="input" type="number" name="number1" placeholder="Number 1" required>
      <input class="input" type="number" name="number2" placeholder="Number 2" required>
    </div>

    <label for="Select Operation">Select Operation</label>
    <select class="operation" name="operation" id="operation" required>
      <option value="<?php echo Operation::ADD; ?>" name="add">+</option>
      <option value="<?php echo Operation::SUBTRACT; ?>" name="subtract">-</option>
      <option value="<?php echo Operation::MULTIPLY; ?>" name="multiply">*</option>
      <option value="<?php echo Operation::DIVIDE; ?>" name="divide">/</option>
    </select>

    <button type="submit">Calculate</button>
  </form>

  <?php if ($result) {?>
    <p>Result is <?php echo $result; ?></p>
  <?php } ?>

  <?php if ($error_message) {?>
    <p class="error_message"><?php echo $error_message; ?></p>
  <?php } ?>

  <style>
    .input_container {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .input {
      width: 200px;
    }

    .operation {
      margin-top: 5px;
    }

    .error_message {
      color: red;
      font-size: 16;
      font-weight: 700;
    }
  </style>
</body>
</html>