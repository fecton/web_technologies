<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog Simple Version</title>
</head>
<body>
    <h1>Product Catalog</h1>

    <?php
    // Load and parse the XML file
    $xml = simplexml_load_file('products.xml');

    if ($xml) {
        echo '<ul>';
        foreach ($xml->Product as $product) {
            echo '<li>';
            echo '<h2>' . $product->ProductName . '</h2>';
            echo '<p><strong>Product Group:</strong> ' . $product->ProductGroup . '</p>';
            echo '<p><strong>Price:</strong> $' . $product->Price . '</p>';
            echo '<p><strong>Serial Number:</strong> ' . $product->SerialNumber . '</p>';
            echo '<p><strong>Year:</strong> ' . $product->Year . '</p>';

            echo '<h3>Pictures:</h3>';
            echo '<ul>';
            echo '<table>';
            echo '<tr>';
                foreach ($product->Pictures->Picture as $picture) {
                    echo '<td><img src="' . $picture . '" alt="Product Image"></td>';
                }
            echo '</tr>';
            echo '</table>';
            echo '</ul>';

            echo '<h3>Parameters:</h3>';
            echo '<ul>';
            foreach ($product->Parameters->Parameter as $parameter) {
                echo '<li><strong>' . $parameter->ParamName . ':</strong> ' . $parameter->ParamValue . '</li>';
            }
            echo '</ul>';

            echo '</li>';
            echo '<hr>';
        }
        echo '</ul>';
    } else {
        echo 'Error loading XML file.';
    }
    ?>
</body>
</html>
