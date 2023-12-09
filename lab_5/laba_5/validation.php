<?php
// Main validation function
function validateForm() {
    $isValid = true; // Assume validation is OK by default
    $validationResults = [];

    // Validating name fields for empty or invalid values
    $validationResults[0] = validateInput($_POST['firstName'], $_POST['firstName_validation'], "First Name");
    $validationResults[1] = validateInput($_POST['secondName'], $_POST['secondName_validation'], "Second Name");
    $validationResults[2] = validateInput($_POST['middleName'], $_POST['middleName_validation'], "Middle Name");
    $validationResults[4] = validateInput(isset($_POST['preferences']) ? $_POST['preferences'] : [], $_POST['preferences_validation'], "Preferences");

    foreach ($validationResults as $result) {
        $isValid = $isValid && $result;
    }

    return $isValid;
}

// Function to validate input elements
function validateInput($element, &$element_validation, $fieldName) {
    $isValid = true; // Assume validation is OK by default
    $textfieldRegex = '/^([a-zA-Zа-яА-я]{1,})/'; // Regular expression for text fields

    switch (gettype($element)) {
        case 'string': // Text field handler
            if (!preg_match($textfieldRegex, $element)) { // Validate using regular expression
                if (empty($element)) {
                    $element_validation = $fieldName . " is required / " . $fieldName . " обязательно для заполнения"; // Empty text field
                } else {
                    $element_validation = "Invalid value in " . $fieldName . " / Некорректное значение в поле " . $fieldName; // Invalid values in text field
                }
                $isValid = false; // Validation did not pass
            }
            break;
        case 'array':
            $count = count($element); // Count of checked checkboxes

            // If count is greater than 3, validation did not pass
            if ($count > 3) {
                $element_validation = "Maximum 3 checked points allowed in " . $fieldName . " / Можно выбрать максимум 3 варианта в поле " . $fieldName;
                $isValid = false; // Validation did not pass
            }
            break;
    }

    // Handle the element's appearance based on validation result
    if (!$isValid) {
        echo '<div style="display:block; background-color:#660000;">' . $element_validation . '</div>';
        return false;
    } else {
        if (empty($element_validation)) {
            echo '<div style="display:block; background-color:#006600;">' . $fieldName . ' is fine!</div>';
        }
        else {
            echo '<div style="display:block; background-color:#006600;">' . $element_validation . '</div>';
        }
        return true;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isFormCorrect = validateForm();
    // Call the validateForm function
    for ($i = 0; $i < 3; $i++) {
        echo "<br>";
    }
    if ($isFormCorrect) {
        echo '<div style="display:block; background-color:#99FF99;">' .
        '<h1>Your data is ok!</h1>'  .
        '</div>';
    } else {
        echo '<div style="display:block; background-color:#FF9999;">' .
        '<h1>Error, something happend, please check the logs above</h1>' .
        '</div>';
    }

    echo '<a href="form.php">Go back</a>';
}
?>


<?php include('server_variables.php'); // Include a common header ?>
