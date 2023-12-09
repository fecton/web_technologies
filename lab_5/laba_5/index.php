<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Casino</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="js/animation.js"></script>
    <script src="js/onload.js"></script>
</head>
<body>
    <div id="case">
        <?php include('header.php'); // Include a common header ?>
        <div id="content">

            <div class="menu-block">
                <div class="left-menu">
                    <p id="menu">MENU</p>
                    <div class="left-names">
                        <?php
                        $menu_items = array(
                            "HOME",
                            "DOWNLOAD",
                            "PREVIEW",
                            "ABOUT US",
                            "SUPPORT",
                            "CASHIER",
                            "SECURITY",
                            "FAIR GAMING",
                            "NEWS"
                        );
                        foreach ($menu_items as $item) {
                            echo '<a href="">' . $item . '</a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="left-banners">
                    <?php
                        $payments = array(
                            "Visa",
                            "Firepay",
                            "Bossmedia",
                            "Webdollar"
                        );
                        foreach ($payments as $item) {
                            echo '<img alt="' . $item . '" src="img/payments/' . strtolower($item) . '.png">';
                        }
                    ?>
                </div>
            </div>


            <?php include('center_block_text.php'); // Include a center part ?>

            <div class="right-menu">
                <p id="games">GAMES</p>
                <div class="right-names">
                    <?php
                    // Generate the game links
                    $games = array(
                        "Blackjack",
                        "Slots",
                        "Craps",
                        "Video poker",
                        "Roulette"
                    );
                    foreach ($games as $game) {
                        echo '<a href="">' . $game . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>