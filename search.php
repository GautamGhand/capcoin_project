<!DOCTYPE html>
<html>

<head>
    <title>SEARCH PAGE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <nav>
        <div>
            <img src="https://coincap.io/static/logos/black.svg">
            <a href="add_money.php" class='addmoney'>ADD MONEY</a>
            <a href="user_details.php" class='addmoney'>USER DETAILS</a>
        </div>

        <section class="search_icon">
            <form action="" method="POST">
                <input type="text" name="search">
                <label for="search">
                    <i class='bi bi-search'></i>
                </label>
            </form>
            <a href="" class="refresh">Refresh</a>
            <?php
            if (isset($_POST['search'])) {
                header('location:search.php?id=' . $_POST['search']);
            }
            ?>
            <?php
            session_start();
                if(isset($_SESSION['login']))
                {
            ?>
                <a href="logout.php" class="logout">LOGOUT</a>
            <?php
                }
            ?>
        </section>
    </nav>
    <main>
        <section class="exchange_bar_search">

            <?php
            include('database/controller.php');
            include('controller.php');
            $id = $_GET['id'];
            $obj = new Api();
            $response = $obj->search($id);
            $val = new Validation();
            if (!empty($id)) {
                    if ($response) {
                        $_SESSION['coin']=$response['data'];
                        echo "<div class='main-container'>";
                        echo "<div class='rank-inside'></div>";
                        echo "<div class='rank-inside1'> <h3>" . $response['data']['rank'] . "<span>RANK</span></h3> </div>";
                        echo "</div>";
                        echo "<div class='name-symbol'><h1>" . $response['data']['name'] . "(" . $response['data']['symbol'] . ")";
                        echo "<h1>" . sprintf('$%0.2f', $response['data']['priceUsd']) . "";
                        if ($response['data']['changePercent24Hr'] < 0) {
                            echo "<span class='red' id='pricespan'>";
                        } else {
                            echo "<span class='green' id='pricespan'>";
                        }
                        echo sprintf('%0.2f', $response['data']['changePercent24Hr']) . "%</span></h1></div>";
                        echo "<div class='name-symbol'>Market Cap<span>$" . $val->convert($response['data']['marketCapUsd']) . "</span></div>";
                        echo "<div class='name-symbol'>Volume(24Hr)<span>$" . $val->convert($response['data']['volumeUsd24Hr']) . "</span></div>";
                        echo "<div class='name-symbol'>Supply<span>" . $val->convert($response['data']['supply']) . " " . $response['data']['symbol'] . "</span></div>";
                    }
            }
            ?>
        </section>
        <?php
        $obj = new DateTime("now", new DateTimeZone('Asia/Calcutta'));
        $date = $obj->format("j F Y");
        $img=$response['data']['symbol'];
        echo "<div class='main_div'>";
        echo "<div class='first_div'>";
        echo "<img src=\"https://assets.coincap.io/assets/icons/" . strtolower($img) . "@2x.png\" class='lg'>";
        echo "<h3 class='date'>" . $response['data']['name']."($img)";
        echo "<span>" . $date . "</span></h3>";
        echo "</div>";
        echo "<div class='change'>";
        echo "<div>";
        echo "<h3>HIGH $1.00</h3>";
        echo "<h3>LOW $0.99896999</h3>";
        echo "</div>";
        echo "<div>";
        echo "<h3>AVERAGE $1.00</h3>";
        echo "<h3>CHANGE 0.05%</h3>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        ?>
        <section class="form">
            <?php
            require 'buysell_form.php';
            ?>
        </section>
        <section>
            <img src="graph.png" class="graph">
        </section>
</body>

</html>