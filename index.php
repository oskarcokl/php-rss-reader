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
    <div class="container mt-4">
        <div class="row">
            <h1 class="text-center">RSS feed reader</h1>
        </div>
        <form class="row d-flex justify-content-center align-items-end" action="index.php" method="post">
            <div class="col-4">
                <label for="feedUrl" class="form-label">Input RSS feed url</label>
                <input type="text" id="feedUrl" name="feedUrl" class="form-control">
            </div>
            <div class="col-2">
                <button class="btn btn-primary text-uppercase" type="submit">get feed</button>
            </div>
        </form>
        <!-- Load rss feed -->
        <?php
        require 'vendor/autoload.php';

        $url = isset($_POST['feedUrl']) ? $_POST['feedUrl'] : '';
        if (!$url) return;

        $rss = Feed::loadRss($url);
        ?>
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-7">
                <h4><?php echo 'Title: ', $rss->title; ?></h4>
                <h6><?php echo 'Link: ', $rss->link; ?></h6>
                <p><?php echo 'Description: ', $rss->description; ?></p>
            </div>

        </div>
        <div class="row d-flex justify-content-center">
            <?php
            foreach ($rss->item as $item) {
                echo '<div class="card d-flex justify-content-center mb-3" style="width: 50rem">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title "><a class="link-underline link-underline-opacity-0 text-primary" href="' . $item->link .'">' . $item->title . '</a></h4>';
                echo '<h6 class="card-subtitle text-body-secondary">Date: ', date('d. M. Y', (int)$item->timestamp) . '</h6>';
                echo '<p class="fs-6">Description: ', $item->description . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>