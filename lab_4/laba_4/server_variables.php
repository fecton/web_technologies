<!DOCTYPE html>
<html>
<body>
    <h1>Server Variables</h1>
    <ul>
        <?php
        foreach ($_SERVER as $key => $value) {
            echo "<li>{$key}: {$value}</li>";
        }
        ?>
    </ul>

    <h1>GET Variables</h1>
    <ul>
        <?php
        foreach ($_GET as $key => $value) {
            echo "<li>{$key}: {$value}</li>";
        }
        ?>
    </ul>

    <h1>POST Variables</h1>
    <ul>
        <?php
        function displayArray($array, $indent = '') {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    echo "<li>$indent$key:</li><ul>";
                    displayArray($value, $indent . '&nbsp;&nbsp;');
                    echo "</ul>";
                } else {
                    echo "<li>$indent$key: $value</li>";
                }
            }
        }

        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                echo "<li>$key:</li><ul>";
                displayArray($value, '&nbsp;&nbsp;');
                echo "</ul>";
            } else {
                echo "<li>{$key}: {$value}</li>";
            }
        }
        ?>
    </ul>
</body>
</html>
