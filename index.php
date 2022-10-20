<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COIN CAP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <nav>
        <div>
            <img src="https://coincap.io/static/logos/black.svg">
        </div>

        <section class="search_icon">
            <form action="" method="POST">
                <input type="text" name="search">
                <label for="search">
                    <i class='bi bi-search'></i>
                </label>
            </form>
            <a href="index.php" class="refresh">Refresh</a>
        </section>
    </nav>
    <main>

        <section class="exchange_bar">

            <ul class="first">
                <li>MARKET CAP</li>
                <li>EXCHANGE VOL</li>
                <li>ASSETS</li>
                <li>EXCHANGES</li>
                <li>MARKETS</li>
                <li>BTC DOM INDEX</li>
            </ul>

            <ul>
                <li>$1.12T</li>
                <li>$27.38B</li>
                <li>2,295</li>
                <li>73</li>
                <li>13,866</li>
                <LI>33.4%</li>
            </ul>

        </section>
        <?php
        include('database/controller.php');
        include('validation/validation.php');
        if (isset($_POST['search'])) {
            header('location:search.php?id=' . $_POST['search']);
        }
        $obj = new Api();
        $val = new Validation();
        $response = $obj->refresh();
        echo "<div class=\"table\">";
        echo "<table cellspacing=0>";
        echo "<th>Rank</th>";
        echo "<th>Name</th>";
        echo "<th>Price</th>";
        echo "<th>Market Cap</th>";
        echo "<th>VWAP(24Hr)</th>";
        echo "<th>Supply</th>";
        echo "<th>Volume(24Hr)</th>";
        echo "<th>Change(24Hr)</th>";

        foreach ($response['data'] as $k => $v) {
            echo "<tr>";
            echo "<td>" . $v['rank'] . "</td>";
            echo "<td><div class='name'><div><img class=\"symbol\" src=\"https://assets.coincap.io/assets/icons/" . strtolower($v['symbol']) . "@2x.png\"></div><div><a href='search.php?id=" . $v['id'] . "'>" . $v['name'] . " <span>" . $v['symbol'] . "</span></a></div></div></td>";
            echo "<td>" . sprintf('$%0.2f', $v['priceUsd']) . "</td>";
            echo "<td>$" . $val->convert($v['marketCapUsd']) . "</td>";
            echo "<td>" . sprintf('$%0.2f', $v['vwap24Hr']) . "</td>";
            echo "<td>$" . $val->convert($v['supply']) . "</td>";
            echo "<td>$" . $val->convert($v['volumeUsd24Hr']) . "</td>";
            if ($v['changePercent24Hr'] < 0) {
                echo "<td class=\"red\">";
            } else {
                echo "<td class=\"green\">";
            }
            echo sprintf('%0.2f', $v['changePercent24Hr']) . "%</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
        ?>

        <footer class="footer">
            <img src="footer.png" class='footerimage'>
        </footer>
    </main>

</body>

</html>