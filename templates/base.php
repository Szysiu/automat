<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<div class="container mt-3">
    <a href="/?action=main" class="logo">
        <h1 class="text-center">AUTOMAT Z PRZEKĄSKAMI</h1>
    </a>
    <?php
    require_once __DIR__.'/alerts.php';
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="box shadow-lg border border-5 border-black overflow-hidden bg-custom">
                <div class="row row-custom">
                    <div class="col-8 border-end border-5 border-black ps-5 pt-3">
                        <div class="row gy-3 d-flex justify-content-center text-white">
                            <?php
                            /** @var $template */
                            require_once __DIR__ .'/'. $template. '.php';
                            ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <form class="text-center" method="post" action="/?action=buy">
                            <div class="row mt-4">
                                <h2 class="text-center text-white">Wrzuć monetę</h2>
                                <div class="text-center">
                                    <label for="amount"></label><input type="number" name="money" value="0" readonly
                                                                       id="amount"><br>
                                </div>
                                <div class="d-inline-block mt-3">
                                    <label class="money">
                                        <input type="radio" name="radio" value="1">
                                        <div class="coin d-flex align-items-center rounded-circle justify-content-center">
                                            1Zł
                                        </div>
                                    </label>
                                    <label class="money">
                                        <input type="radio" name="radio" value="2">
                                        <div class="coin d-flex align-items-center rounded-circle justify-content-center">
                                            2Zł
                                        </div>
                                    </label>
                                    <label class="money">
                                        <input type="radio" name="radio" value="5">
                                        <div class="coin d-flex align-items-center rounded-circle justify-content-center">
                                            5Zł
                                        </div>
                                    </label><br>
                                    <button type="button" class="btn btn-outline-info mt-3" id="btn">Wrzuć</button>
                                    <button type="reset" class="btn btn-outline-info mt-3">Reset</button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <h2 class="text-center text-white">Wybierz Produkt</h2>
                                <div class="text-center">
                                    <label for="orderNumber"></label><input type="text" name="code" readonly value=""
                                                                            maxlength="3" id="orderNumber"><br>
                                </div>
                                <div class="d-inline-block mt-3">
                                    <button type="button" class="btn-custom" value="9">9</button>
                                    <button type="button" class="btn-custom" value="8">8</button>
                                    <button type="button" class="btn-custom" value="7">7</button>
                                </div>
                                <div class="d-inline-block mt-2">
                                    <button type="button" class="btn-custom" value="6">6</button>
                                    <button type="button" class="btn-custom" value="5">5</button>
                                    <button type="button" class="btn-custom" value="4">4</button>
                                </div>
                                <div class="d-inline-block mt-2">
                                    <button type="button" class="btn-custom" value="3">3</button>
                                    <button type="button" class="btn-custom" value="2">2</button>
                                    <button type="button" class="btn-custom" value="1">1</button>
                                </div>
                                <br>
                                <div class="d-inline-block mt-2">
                                    <button type="button" class="btn-custom" value="0">0</button>
                                    <button type="reset" class="btn btn-outline-info">Reset</button>
                                </div>
                                <br>
                                <div class="text-center">
                                    <input type="submit" value="Kup" class="btn btn-outline-info btn-lg mt-5 w-75"</input>
                                </div>
                            </div>
                        </form>
                        <a href="/?action=fill" class="btn btn-outline-info mt-5">Uzupełnij automat</a>
                        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true): ?>
                            <a class="btn btn-outline-warning mt-5 ms-2" href="/?action=logout">Wyloguj</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/script.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>



