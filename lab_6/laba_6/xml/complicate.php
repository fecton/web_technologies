<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
</head>
<body>
    <h1>Product Catalog (Complicate and Incomplete)</h1>
    <p>The realization looks really funny 😄</p>

    <?php
    // Create an XML parser
    $xmlParser = xml_parser_create();

    // Initialize variables to hold data
    $currentElement = "";
    $products = [];
    $product = [];
    $currentPictures = [];
    $currentParameters = [];

    // Set element handlers
    xml_set_element_handler($xmlParser, function ($parser, $name, $attrs) use (&$currentElement, &$product) {
        $currentElement = $name;
        if ($name === 'PRODUCT') {
            $product = [];
        }
        if ($name === 'PICTURES') {
            $currentPictures = [];
        }
        if ($name === 'PARAMETERS') {
            $currentParameters = [];
        }
    }, function ($parser, $name) use (&$currentElement, &$product, &$products, &$currentPictures, &$currentParameters) {
        if ($name === 'PRODUCT') {
            $product['PICTURES'] = $currentPictures;
            $products[] = $product;
            $currentPictures = [];
        }
    });

    // Set character data handler
    xml_set_character_data_handler($xmlParser, function ($parser, $data) use (&$currentElement, &$product, &$currentPictures, &$currentParameters) {
        // echo $currentElement;
        // echo $data;
        // echo "<br>";
        if (!empty(trim($data))) {
            if ($currentElement === 'PICTURE') {
                $currentPictures[] = trim($data);
            } elseif ($currentElement === "PARAMNAME" || $currentElement === 'PARAMVALUE') {
                $currentParameters[] = trim($data);
            } else {
                $product[strtolower($currentElement)] = $data;
            }
        }
    });

    // Parse the XML file
    $xmlFile = 'products.xml';
    $xmlData = file_get_contents($xmlFile);

    if (xml_parse($xmlParser, $xmlData)) {
        // Display the product information
        echo '<ul>';
        $i = -4;
        foreach ($products as $product) {
            echo '<li>';
            echo '<h2>' . $product['productname'] . '</h2>';
            echo '<p><strong>Product Group:</strong> ' . $product['productgroup'] . '</p>';
            echo '<p><strong>Price:</strong> $' . $product['price'] . '</p>';
            echo '<p><strong>Serial Number:</strong> ' . $product['serialnumber'] . '</p>';
            echo '<p><strong>Year:</strong> ' . $product['year'] . '</p>';

            echo '<h3>Pictures:</h3>';
            if (!empty($product['PICTURES'])) {
                echo '<ul>';
                echo '<table>';
                echo '<tr>';
                    foreach ($product['PICTURES'] as $picture) {
                        echo '<td><img src="' . $picture . '" alt="Product Image"></td>';
                    }
                echo '</tr>';
                echo '</table>';
                echo '</ul>';
            }

            echo '<h3>Parameters:</h3>';
            echo '<p><strong>' . $currentParameters[$i+4] . '</strong> ' . $currentParameters[$i+5] . '</p>';
            echo '<p><strong>' . $currentParameters[$i+6] . '</strong> ' . $currentParameters[$i+7] . '</p>';

            // foreach ($currentParameters as $param) {
            //     echo $param;
            //     echo "<br>";
            // }

            echo '<hr>';
            $i += 4;
        }
        echo '</ul>';
    } else {
        echo 'Error parsing XML file.';
    }

    // Free the XML parser
    xml_parser_free($xmlParser);
    ?>
</body>
</html>
