<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cellphone-Like PHP Calculator</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin:0;
    background-color: #f5f5f5;
}

.calculator {
    width: 260px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

.display {
    background-color: #222;
    color: rgb(124, 66, 115);
    text-align: right;
    padding: 20px;
    font-size: 2em;
    min-height: 60px;
}

.buttons {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background-color: #222;
}

.buttons button {
    background-color: #333;
    color: white;
    font-size: 1.5em;
    padding: 20px;
    border: none;
    cursor: pointer;
}

.buttons button:hover {
    background-color: #444;
}

.buttons .operator {
    background-color: #ff9500;
}

.buttons .operator:hover {
    background-color: #e58b00;
}

.buttons .equals {
    background-color: #ff9500;
    grid-column: span 4;
}

.buttons .equals:hover {
    background-color: #e58b00;
}

.buttons .zero {
    grid-column: span 2;
}
    </style>
</head>
<body>
    <div class="calculator">
        <div class="display">
            <?php
            session_start();

            // Initialize variables
            $display = $_SESSION['display'] ?? '0';
            $num1 = $_SESSION['num1'] ?? '';
            $operator = $_SESSION['operator'] ?? '';
            $num2 = $_SESSION['num2'] ?? '';
            $show_operator = $_SESSION['show_operator'] ?? false;

            // Check if form has been submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['clear'])) {
                    // Clear the calculator
                    $display = '0';
                    $num1 = '';
                    $operator = '';
                    $num2 = '';
                    $show_operator = false;
                } elseif (isset($_POST['equals'])) {
                    // Perform the calculation
                    if ($operator && $num2 !== '') {
                        switch ($operator) {
                            case '+':
                                $display = $num1 + $num2;
                                break;
                            case '-':
                                $display = $num1 - $num2;
                                break;
                            case '*':
                                $display = $num1 * $num2;
                                break;
                            case '/':
                                $display = $num2 != 0 ? $num1 / $num2 : "Error";
                                break;
                        }
                        // Reset for next calculation
                        $num1 = $display;
                        $operator = '';
                        $num2 = '';
                        $show_operator = false;
                    }
                } elseif (isset($_POST['operator'])) {
                    // Store the first number and operator
                    $num1 = $display;
                    $operator = $_POST['operator'];
                    $show_operator = true;
                } else {
                    // Handle number button presses
                    $num = $_POST['num'];
                    if ($operator) {
                        // If operator is set, build num2
                        $num2 .= $num;
                        $display = $num2;
                        $show_operator = false;
                    } else {
                        // If operator is not set, build num1
                        $num1 .= $num;
                        $display = ltrim($num1, '0'); // Remove leading zeros
                    }
                }

                // Save the state in session
                $_SESSION['display'] = $display;
                $_SESSION['num1'] = $num1;
                $_SESSION['operator'] = $operator;
                $_SESSION['num2'] = $num2;
                $_SESSION['show_operator'] = $show_operator;
            }

            // Show the operator briefly when it's clicked
            if ($show_operator) {
                echo $operator;
            } else {
                echo $display;
            }
            ?>
        </div>
        <form method="POST">
            <div class="buttons">
                <button type="submit" name="clear">C</button>
                <button type="submit" name="operator" value="/">/</button>
                <button type="submit" name="operator" value="*">*</button>
                <button type="submit" name="operator" value="-">-</button>

                <button type="submit" name="num" value="7">7</button>
                <button type="submit" name="num" value="8">8</button>
                <button type="submit" name="num" value="9">9</button>
                <button type="submit" name="operator" value="+">+</button>

                <button type="submit" name="num" value="4">4</button>
                <button type="submit" name="num" value="5">5</button>
                <button type="submit" name="num" value="6">6</button>

                <button type="submit" name="num" value="1">1</button>
                <button type="submit" name="num" value="2">2</button>
                <button type="submit" name="num" value="3">3</button>

                <button type="submit" name="num" value="0" class="zero">0</button>
                <button type="submit" name="equals" class="equals">=</butt



