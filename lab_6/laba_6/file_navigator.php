<?php
// Get the current directory relative to the script location
$baseDir = __DIR__;
$currentDir = isset($_GET['dir']) ? $_GET['dir'] : '';

$requestedDir = realpath($baseDir . '\\' . $currentDir);

if (empty($requestedDir)) {
    $requestedDir = $currentDir;
}

// Function to format file size
function formatSize($size)
{
    $units = array('B', 'KB', 'MB', 'GB');
    $i = 0;
    while ($size >= 1024 && $i < count($units) - 1) {
        $size /= 1024;
        $i++;
    }
    return round($size, 2) . ' ' . $units[$i];
}

// Function to list files and directories
function listFiles($path)
{
    if (is_dir($path)) {
        $dir = $path;
        echo "This is a dir: '" . $dir . "'";
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $path = $dir . '\\' . $file;
                $type = is_dir($path) ? 'Directory' : 'File';
                $size = is_file($path) ? formatSize(filesize($path)) : '-';
                $created = date('Y-m-d H:i:s', filectime($path));
                echo "<tr><td>$file</td><td>$type</td><td>$size</td><td>$created</td><td><a href=\"file_navigator.php?dir=" . urlencode($dir . '\\' . $file) . "\">Open</a></td></tr>";
            }
        }
    }
    else {
        $file = $path;
        echo "This is a file: '" . $file . "'";
        // Here generate the code to print the content of text files with line numbers

        echo "<pre>";
        $lines = file($file);
        foreach ($lines as $lineNumber => $lineContent) {
            echo "<code>" . ($lineNumber + 1) . ": " . htmlspecialchars($lineContent) . "</code><br>";
        }
        echo "</pre>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Navigator</title>
</head>
<body>
    <h1>File Navigator</h1>
    <table border="1">
        <tr>
            <th>File Name</th>
            <th>Type</th>
            <th>File Size</th>
            <th>File Creation Date</th>
            <th>Action</th>
        </tr>
        <?php
        listFiles($requestedDir);
        ?>
    </table>
    <br>
    <h1>File Search</h1>
    <form method="post" action="">
        <label for="filename">Enter a part of the file name:</label>
        <input type="text" name="filename" id="filename" required>
        <input type="submit" value="Search">
    </form>
    <?php
        if (!isset($_POST['filename'])){
            return;
        }
        $searchTerm = $_POST['filename'];
        echo "<h2>Search results for '$searchTerm':</h2>";
        echo "<table border='1'>";
        echo "<tr><th>File</th><th>Type</th><th>Size</th><th>Created</th><th>Action</th></tr>";
        // Check if the form has been submitted
        if (isset($_POST['filename'])) {
            $baseDir = __DIR__; // Replace with the actual base directory path

            function searchFiles($dir, $searchTerm) {
                $files = scandir($dir);
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..') {
                        continue;
                    }
                    $filePath = $dir . '\\' . $file;
                    if (is_dir($filePath)) {
                        // Recursively search subdirectories
                        searchFiles($filePath, $searchTerm);
                    } elseif (stripos($file, $searchTerm) !== false) {
                        // File name contains the search term
                        $type = is_dir($filePath) ? 'Directory' : 'File';
                        $size = is_file($filePath) ? formatSize(filesize($filePath)) : '-';
                        $created = date('Y-m-d H:i:s', filectime($filePath));

                        echo "<tr><td>$file</td><td>$type</td><td>$size</td><td>$created</td>";
                        echo "<td><a href='file_navigator.php?dir=" . urlencode($filePath) . "'>Open</a></td></tr>";
                    }
                }
            }

            searchFiles($baseDir, $searchTerm);
        }
        echo "</table>";
    ?>
</body>
</html>
