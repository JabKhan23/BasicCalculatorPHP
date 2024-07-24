
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, select, button {
            margin: 10px 0;
            padding: 10px;
            max-width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: #fff;
            cursor: pointer;
        }
        .calc-error {
            color: red;
        }
        .calc-result {
            color: green;
        }
    </style>
</head>
<p>Calculator</p>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="number" name="num01" placeholder="Number One" >
        <select name="operator">
            <option value="addition">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>

        </select>
        <input type="number" name="num02" placeholder="Number Two">
        <button type="submit">Calculate</button>
        <button type="reset" style="background: #dc3545;">Clear</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Grab data
        $num01 = filter_input(INPUT_POST, "num01", FILTER_VALIDATE_FLOAT);
        $num02 = filter_input(INPUT_POST, "num02", FILTER_VALIDATE_FLOAT);
        $operator = filter_input(INPUT_POST, "operator", FILTER_SANITIZE_SPECIAL_CHARS);

        // Error handlers
        $errors = false;

        if ($num01 === false || $num02 === false || empty($operator)) {
            echo "<p class='calc-error'>Fill in all fields correctly!</p>";
            $errors = true;
        }

        if (!$errors) {
            $value = 0;
            switch ($operator) {
                case "addition":
                    $value = $num01 + $num02;
                    break;
                case "subtract":
                    $value = $num01 - $num02;
                    break;
                case "multiply":
                    $value = $num01 * $num02;
                    break;
                case "divide":
                    if ($num02 == 0) {
                        echo "<p class='calc-error'>Cannot divide by zero! You will break the Universe</p>";
                        $errors = true;
                    } else {
                        $value = $num01 / $num02;
                    }
                    break;
       
                default:
                    echo "<p class='calc-error'>Something went wrong!</p>";
                    $errors = true;
            }
            if (!$errors) {
                echo "<p class='calc-result'>Result = " . $value . "</p>";
            }
        }
    }
    ?>
</body>
</html>