// Main validation function
function validateForm() {
    let isValid = true; // Assume validation is OK by default
    const validationResults = [];

    // Validating name fields for empty or invalid values
    validationResults[0] = validateInput(document.getElementById('firstName'), document.getElementById("firstName_validation"));
    validationResults[1] = validateInput(document.getElementById('secondName'), document.getElementById("secondName_validation"));
    validationResults[2] = validateInput(document.getElementById('middleName'), document.getElementById("middleName_validation"));
    validationResults[4] = validateInput(document.querySelector('input[type="checkbox"]'), document.getElementById("preferences_validation"));

    for (let i = 0; i < validationResults.length; i++) {
        isValid = isValid && validationResults[i];
    }

    if (!isValid) {
        return false; // Validation did not pass
    }
}

// Function to validate input elements
function validateInput(element, element_validation) {
    let isValid = true; // Assume validation is OK by default
    const textfieldRegex = /^([a-zA-Zа-яА-я]{1,})/; // Regular expression for text fields

    switch (element.type) {
        case 'text': // Text field handler
            if (!textfieldRegex.test(element.value)) { // Validate using regular expression
                if (element.value === "") {
                    element_validation.innerHTML = "Field required / Поле не заполнено"; // Empty text field
                } else {
                    element_validation.innerHTML = "Invalid value / Некорректное значение"; // Invalid values in text field
                }
                isValid = false; // Validation did not pass
            }
            break;
        case 'checkbox':
            const preferencesArray = document.querySelectorAll('input[type="checkbox"]'); // Array of checkboxes
            let count = 0; // Count of checked checkboxes

            for (let i = 0; i < preferencesArray.length; i++) {
                if (preferencesArray[i].checked) {
                    count++;
                }
            }
            // If count is greater than 3, validation did not pass
            if (count > 3) {
                element_validation.innerHTML = "Maximum 3 checked points / Можно выбрать максимум 3 варианта";
                isValid = false; // Validation did not pass
            }
            break;
    }

    // Handle the element's appearance based on validation result
    if (!isValid) {
        element_validation.style.display = "block";
        element_validation.parentNode.style.backgroundColor = "#660000";
        return false;
    } else {
        element_validation.style.display = "none";
        element_validation.parentNode.style.backgroundColor = "#006600";
        return true;
    }
}
