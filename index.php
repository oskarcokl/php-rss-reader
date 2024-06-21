<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP RSS reader</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div>
            <form class="row g-3 d-flex justify-content-center align-items-end" action="index.php" method="post">
                <div class="col-4">
                    <label for="feedUrl" class="form-label">Input RSS feed url</label>
                    <input type="text" id="feedUrl" name="feedUrl" class="form-control">
                </div>
                <div class="col-2">
                    <button class="btn btn-primary text-uppercase" type="submit">get feed</button>
                </div>
            </form>
        </div>
        <div>
            <?php
            require 'vendor/autoload.php';

            $url = isset($_POST['feedUrl']) ? $_POST['feedUrl'] : '';
            if (!$url) return;

            $rss = Feed::loadRss($url);
            ?>
        </div>
        <div>
            <?php
            echo 'Title: ', $rss->title;
            echo 'Description: ', $rss->description;
            echo 'Link: ', $rss->url;
            ?>
        </div>
        <div>
            <?php
            foreach ($rss->item as $item) {
                echo 'Title: ', $item->title;
                echo 'Link: ', $item->url;
                echo 'Timestamp: ', $item->timestamp;
                echo 'Description: ', $item->description;
                echo 'HTML encoded content: ', $item->{'content:encoded'};
            }
            ?>
        </div>
    </div>
</body>

</html>