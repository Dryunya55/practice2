<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $apiKey = 'AIzaSyDCnbyX-ZlT95B-rmvB8Bpb3wTcGQGviz0';
    $cx = 'e08bbbdd1d17c49c9';

    $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$search}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resultJson = curl_exec($ch);
    curl_close($ch);
    $resultArray = json_decode($resultJson, true);

    if (isset($resultArray['items'])) {
        $items = $resultArray['items'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="/index.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit">
</form>

<?php

if (isset($items)) {
    foreach ($items as $item) {
        echo '<h3>' . $item['title'] . '</h3>';
        echo '<p>' . $item['snippet'] . '</p>';
        echo '<a href="' . $item['link'] . '">Детальніше</a>';
    }
}
?>
</body>
</html>
