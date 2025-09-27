<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $title = htmlspecialchars($_POST['title']);
    $summary = htmlspecialchars($_POST['summary']);
    $content = htmlspecialchars($_POST['content']);
    $dateTime = date('Y-m-d H:i:s');

    $filename = 'blog-posts.json';

    // Check if file exists and is writable
    if (!is_writable($filename)) {
        echo json_encode(['status' => 'error', 'message' => 'File is not writable']);
        exit;
    }

    // Load existing posts
    $posts = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

    // Add the new post
    $posts[] = [
        'name' => $name ? $name : 'Anonymous',
        'title' => $title,
        'summary' => $summary,
        'content' => $content,
        'dateTime' => $dateTime
    ];

    // Save updated posts
    if (file_put_contents($filename, json_encode($posts, JSON_PRETTY_PRINT)) === false) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to write to file']);
        exit;
    }

    // Return a JSON response
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
