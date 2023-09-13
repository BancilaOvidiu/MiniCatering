<!DOCTYPE html>
<?php
session_start();

$pid = $_SESSION['id'];

?>

<html>

<head>
    <title></title>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel="stylesheet" href="./css/home.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            min-height: 98vh;
            min-width: 98vw;
            background: url("./img/download3.jpg");
            /* background-size: cover;
    background-repeat: no-repeat; */
        }

        .parent {
            height: 100vh;
        }

        .parent>.row {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .col img {
            height: 100px;
            width: 100%;
            cursor: pointer;
            transition: transform 1s;
            object-fit: cover;
        }

        .col label {
            overflow: hidden;
            position: relative;
        }

        .imgbgchk:checked+label>.tick_container {
            opacity: 1;
        }

        /*         aNIMATION */
        .imgbgchk:checked+label>img {
            transform: scale(1.25);
            opacity: 0.3;
        }

        .tick_container {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            cursor: pointer;
            text-align: center;
        }

        .tick {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 6px 12px;
            height: 40px;
            width: 40px;
            border-radius: 100%;
        }

        .container {
            background-color: white;
            border: 1px solid black;
            border-radius: 10px;
        }

        a {
            text-decoration: none !important;
            background-color: lightblue;
            color: white !important;
            padding: 7px 10px !important;
            border-radius: 5px;
            margin-right: 3px;
        }

        a:hover {
            color: black !important;
        }
    </style>
</head>

<body>

    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup" style="margin-left:44%;">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="home.php">Home</a>
                <a class="nav-item nav-link" href="contact.html">Contact</a>
                <a class="nav-item nav-link" href="index.html">Log out</a>
            </div>
        </div>
    </nav>


    <?php
    if (isset($_POST['create'])) {
        $a = 0;

        if (empty($_POST['imgbackground']))
            $a = 1;
        if (empty($_POST['date']))
            $a = 1;
        if (empty($_POST['time']))
            $a = 1;
        if (empty($_POST['number']))
            $a = 1;
        if (empty($_POST['tlf']))
            $a = 1;

        if ($a == 1) {
            echo '<script type="text/javascript">
        window.onload = function () {
        alert("Complete every space to make an order!");
        }</script>';
        } else {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "catering";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Eroare la conectare: " . mysqli_connect_error());
            }

            $meniu = $_POST['imgbackground'];
            $data = $_POST['date'];
            $ora = $_POST['time'];
            $nrPers = $_POST['number'];
            $telefon = $_POST['tlf'];

            $pret = 0;
            if ($meniu == 'dejun') {
                $pret = $nrPers * 10;
            } else if ($meniu == 'meniulzilei') {
                $pret = $nrPers * 25;
            } else if ($meniu == 'cina') {
                $pret = $nrPers * 18;
            }

            $sql = "INSERT INTO comenzi(NumeMeniu,NumarPersoane,DataRezervare,Ora,Telefon,ID_user,Pret) 
            VALUES ('$meniu',$nrPers,'$data','$ora','$telefon',$pid,$pret)";

            if (mysqli_query($conn, $sql))
                echo '
        <script type="text/javascript">
            window.onload = function () {
                alert("The order is confirmed!");
            }</script>';
            else
                echo '
        <script type="text/javascript">
            window.onload = function () {
                alert("There was an error, please try again!");
            }</script>';
        }
    }
    ?>


    <div class="container" style="margin-top:70px;" id="adaugareP">
        <h2 style="text-align:center;">Order your favorite menu</h2><br>
        <form method="POST">
            <div class="row">
                <label>Select the menu</label>
                <div class='col text-center'>
                    <input type="radio" name="imgbackground" id="img1" class="d-none imgbgchk" value="dejun">
                    <label for="img1">
                        <img src="https://www.eatingwell.com/thmb/ZIsM-f-uVmqWx7JlJNsBFMCVOaY=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/HashBrown-5-e1941c86066346e8a592e4c589d4933d.jpg" alt="Image 1" style="width:350px; height:300px;">
                        <div class="tick_container">
                            <div class="tick"><i class="fa fa-check"></i></div>

                        </div>
                    </label>
                    <h5><b>Breakfast: <br> 14 RON</b></h5>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "catering";

                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    $sql2 = "SELECT * from meniuri WHERE Meniu like 'dejun'";
                    $result = $conn->query($sql2);
                    $i = 0;
                    if ($result->num_rows > 0) {
                        echo "Contain: ";
                        while ($row = $result->fetch_assoc()) {
                            echo $row['Ingredient'] . " ";
                            if ($i != $result->num_rows - 1) {
                                echo "/ ";
                            }
                            $i++;
                        }
                    }
                    ?>
                </div>
                <div class='col text-center'>
                    <input type="radio" name="imgbackground" id="img2" class="d-none imgbgchk" value="meniulzilei">
                    <label for="img2">
                        <img src="https://moaradefoc.ro/livrari-domiciliu/wp-content/uploads/2020/12/poza-meniu-de-post.jpg" alt="Image 2" style="width:350px; height:300px;">
                        <div class="tick_container">
                            <div class="tick"><i class="fa fa-check"></i></div>
                        </div>
                    </label>
                    <h5><b>Daily menu: <br> 35 RON</b></h5>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "catering";
                    $i = 0;
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    $sql2 = "SELECT * from meniuri WHERE Meniu like 'meniulzilei'";
                    $result = $conn->query($sql2);
                    if ($result->num_rows > 0) {
                        echo "Contain: ";
                        while ($row = $result->fetch_assoc()) {
                            echo $row['Ingredient'] . " ";
                            if ($i != $result->num_rows - 1) {
                                echo "/ ";
                            }
                            $i++;
                        }
                    }
                    ?>
                </div>
                <div class='col text-center'>
                    <input type="radio" name="imgbackground" id="img3" class="d-none imgbgchk" value="cina">
                    <label for="img3">
                        <img src="https://static.playtech.ro/unsafe/840x500/smart/filters:contrast(5):format(webp):quality(80)/https://playtech.ro/stiri/wp-content/uploads/2022/08/Top-3-alimente-sanatoase-pentru-cina.-Sunt-cele-mai-indicate-pentru-masa-de-seara-1024x714.jpg" alt="Image 3" style="width:350px; height:300px;">
                        <div class="tick_container">
                            <div class="tick"><i class="fa fa-check"></i></div>
                        </div>
                    </label>
                    <h5><b>Dinner: <br> 18 RON</b></h5>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "catering";
                    $i = 0;

                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    $sql2 = "SELECT * from meniuri WHERE Meniu like 'cina'";
                    $result = $conn->query($sql2);
                    if ($result->num_rows > 0) {
                        echo "Contain: ";
                        while ($row = $result->fetch_assoc()) {
                            echo $row['Ingredient'] . " ";
                            if ($i != $result->num_rows - 1) {
                                echo "/ ";
                            }
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Delivery Date:</label>
                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="date" />
            </div>
            <div class="form-group">
                <label for="name">Delivery time:</label>
                <input class="form-control" id="date" name="time" placeholder="time" type="time" />
            </div>
            <div class="form-group">
                <label for="name">Number of menus:</label>
                <input class="form-control" id="number" name="number" placeholder="No. of menus" type="number" />
            </div>
            <div class="form-group">
                <label for="name">Phone number:</label>
                <input class="form-control" id="tlf" name="tlf" placeholder="Phone number for confirmation" />
            </div>
            </br>
            <div>
                <button type="submit" class="btn btn-primary" name="create" style="margin-left:45%; margin-bottom:10px;">Order</button>

            </div>
        </form>
    </div>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="./javascript/jquery-3.6.0.min.js"></script>
    <script src="./javascript/home.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>