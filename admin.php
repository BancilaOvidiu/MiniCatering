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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        html,
        body {
            min-height: 98vh;
            min-width: 98vw;
            background: url("./img/download1.jpg");
            /* background-size: cover;
    background-repeat: no-repeat; */
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

        .container {
            background-color: white;
            border: 1px solid black;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar  navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup" style="margin-left:45%;">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="admin.php">Home</a>
                <a class="nav-item nav-link" href="index.html">Log out</a>
            </div>
        </div>
    </nav>




    <div class="container">
        <br><br>
        <div class="panel-info" style="max-width:50%; margin-left:20%;">
            <form method="POST">
                <div class="form-group">
                    <label>Ziua:</label>
                    <input class="form-control" type="date" name="datafiltru" />
                </div>



                <div class="form-group">
                    <label>Meniu:</label>
                    <select class="form-control" name="traseufiltru">
                        <option value="dejun">Mic dejun</option>
                        <option value="meniulzilei">Meniul zilei</option>
                        <option value="cina">Cina</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Filtreaza" name="filtruBtn" />
            </form>
            <br><br>

            <?php
            if (isset($_POST['filtruBtn'])) {
                $a = 1;

                if (!empty($_POST['datafiltru']) && !empty($_POST['traseufiltru'])) {
                    $a = 0;
                    $data = $_POST['datafiltru'];
                    $meniu = $_POST['traseufiltru'];
                }

                if ($a == 1) {
                    echo '<script type="text/javascript">
            window.onload = function () {
            alert("Complete at least 1 data to filtrate the results!");
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

                    $sql = "Select C.ID,C.NumeMeniu, C.NumarPersoane, C.DataRezervare, C.Ora,C.Telefon, U.Username, C.Pret from comenzi C
            inner join utilizatori U
            on U.ID=C.ID_user 
            Where C.NumeMeniu like '$meniu' and C.DataRezervare like '$data'";

                    $result = $conn->query($sql);




                    if ($result->num_rows > 0) {

                        if ($meniu == "dejun") {
                            echo '<img src="https://www.eatingwell.com/thmb/ZIsM-f-uVmqWx7JlJNsBFMCVOaY=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/HashBrown-5-e1941c86066346e8a592e4c589d4933d.jpg" width="600px" height="400px" style="margin-left:10%;">';
                        } else if ($meniu == "meniulzilei") {
                            echo '<img src="https://moaradefoc.ro/livrari-domiciliu/wp-content/uploads/2020/12/poza-meniu-de-post.jpg" width="600px" height="400px" style="margin-left:10%;">';
                        } else if ($meniu == "cina") {
                            echo '<img src="https://static.playtech.ro/unsafe/840x500/smart/filters:contrast(5):format(webp):quality(80)/https://playtech.ro/stiri/wp-content/uploads/2022/08/Top-3-alimente-sanatoase-pentru-cina.-Sunt-cele-mai-indicate-pentru-masa-de-seara-1024x714.jpg" width="600px" height="400px" style="margin-left:10%;">';
                        }

                        echo '<table class="table">
                <thead>
                    <tr>
                    <th scope="col">Numar comanda</th>
                    <th scope="col">Meniul ales</th>
                    <th scope="col">Data rezervare</th>
                    <th scope="col">Numarul de meniuri</th>
                    <th scope="col">Ora rezervarii</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Utilizatorul care a rezervat</th>
                    <th scope="col">Pret comanda</th>
                    </tr>
                </thead>
                <tbody>';
                        while ($row = $result->fetch_assoc()) {

                            echo "<tr>";
                            echo '<th scope="row">' . $row['ID'] . '</th>';
                            echo "<td>" . $row["NumeMeniu"] . "</td>";
                            echo "<td>" . $row["DataRezervare"] . "</td>";
                            echo "<td>" . $row["NumarPersoane"] . "</td>";
                            echo "<td>" . $row["Ora"] . "</td>";
                            echo "<td>" . $row["Telefon"] . "</td>";
                            echo "<td>" . $row["Username"] . "</td>";
                            echo "<td>" . $row["Pret"] . "</td>";
                            echo "</tr>";
                        }

                        echo '</tbody>
                </table>';
                    } else {
                        echo '
                <script type="text/javascript">
                    window.onload = function () {
                        alert("There is no order with the selected filters");
                    }</script>';
                    }
                }
            }

            ?>
        </div>




        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <script src="./javascript/jquery-3.6.0.min.js"></script>
        <script src="./javascript/home.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>