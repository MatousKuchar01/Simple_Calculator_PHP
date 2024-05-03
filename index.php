<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8" />
    <title>Hello, world!</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="description" content="" />
    <link rel="stylesheet" href="style.css">
    <title>Calculator</title>
</head>

<body>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="number" name="num1" placeholder="Number one">
    <select name="operator">
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
    </select>
    <input type="number" name="num2" placeholder="Number two">
    <button>Calculate</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
    $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
    $operator = htmlspecialchars($_POST["operator"]);

    $errors = false;

    if (empty($num1) || empty($num2) || empty($operator)) {
        echo '<p class="calc-error">Please fill in all fields!</p>';
        $errors = true;
    }

    if (!is_numeric($num1) || !is_numeric($num2)) {
        echo '<p class="calc-error">Only write numbers!</p>';
        $errors = true;

    }

    if (!$errors) {
        $value = 0;
        switch ($operator) {
            case 'add':
                $value = $num1 + $num2;
                break;
            case 'subtract':
                $value = $num1 - $num2;
                break;
            case 'multiply':
                $value = $num1 * $num2;
                break;
            case 'divide':
                $value = $num1 / $num2;
                break;
            default:
                echo '<p class="calc-error">Unknown operator!</p>';
        }

        echo "<p class='calc-result'>Result = " . $value . "</p>";
    }
}
?>

</body>
</html>