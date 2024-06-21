<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP RSS reader</title>
</head>

<body>

    <form action="index.php" method="post">
        <input type="text" id="feedUrl" name="feedUrl">
        <button type="submit">get feed</button>
    </form>
    <?php
    require 'vendor/autoload.php';

    $url = isset($_POST['feedUrl']) ? $_POST['feedUrl'] : '';
    if (!$url) return;

    $rss = Feed::loadRss($url);
    ?>

    <?php
    echo "Title: ", $rss->title;
    echo 'Description: ', $rss->description;
    echo 'Link: ', $rss->url;
    ?>

    <?php
    foreach ($rss->item as $item) {
        echo 'Title: ', $item->title;
        echo 'Link: ', $item->url;
        echo 'Timestamp: ', $item->timestamp;
        echo 'Description: ', $item->description;
        echo 'HTML encoded content: ', $item->{'content:encoded'};
    }
    ?>

</body>

</html>