<!DOCTYPE html>
<html>
<head>
    <title>File Search</title>
</head>
<body>
    <h1>File Search</h1>
    <form method="post" action="">
        <label for="filename">Enter a part of the file name:</label>
        <input type="text" name="filename" id="filename" required>
        <input type="submit" value="Search">
    </form>
    <?php
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
