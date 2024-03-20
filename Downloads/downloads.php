<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads</title>
    <link rel="stylesheet" href="Downloads/style_downloads.css">
</head>
<body>
    <div class="download_container">
        <h1>Downloads</h1>
        <ul class="downloads-list">
            <?php
            // Directory where your files are stored
            $directory = 'Downloads/files/';

            // File type icons mapping
            $fileIcons = array(
                'pdf' => 'pdf_icon.png',
                'doc' => 'doc_icon.png',
                'docx' => 'doc_icon.png',
                'jpg' => 'jpg_icon.png',
                // Add more file types and their respective icons here
                'default' => 'default_icon.png' // Default icon for unknown file types
            );

            // Open the directory
            if ($handle = opendir($directory)) {
                // Loop through the directory
                while (false !== ($entry = readdir($handle))) {
                    // Exclude current directory and parent directory
                    if ($entry != "." && $entry != "..") {
                        // Get file extension
                        $extension = strtolower(pathinfo($entry, PATHINFO_EXTENSION));

                        // Check if the file extension exists in the fileIcons array
                        $icon = isset($fileIcons[$extension]) ? $fileIcons[$extension] : $fileIcons['default'];

                        // Display download link for each file
                        echo '<li><a class="download-link" href="' . $directory . $entry . '" download><img class="download-icon" src="Downloads/icons/' . $icon . '" alt="Download">' . $entry . '</a></li>';
                    }
                }
                // Close directory handle
                closedir($handle);
            }
            ?>
        </ul>
    </div>
</body>
