<?php

// include "fungsi.php";
// include "koneksi.php";
$koneksi = new mysqli("localhost", "root", "", "oplbaru");

session_start();
// $id_pelanggan = $_SESSION['id_pelanggan'];

// $queryFormKucing = mysqli_query($koneksi, "SELECT * FROM datakucing WHERE id_pelanggan = '$id_pelanggan'");



// if (mysqli_num_rows($queryFormKucing) === 0) {
//     header("location: form-datakucing.php");
// }
function build_calendar($month, $year)
{
    global $koneksi;

    $daysOfWeek = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'><</a> ";
    $calendar .= " <a class='btn btn-xs btn-primary' href= ../home.php >Home</a> ";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>></a></center><br>";
    $calendar .= "<tr>";

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }

    $currentDay = 1;
    $calendar .= "</tr><tr>";

    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td  class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";

        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";

        if ($dayname == 'sunday') {
            $calendar .= "<td><h4>$currentDay</h4><button class='btn btn-danger btn-xs'>Libur</button>";
        } else if ($date < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Slot Tidak Tersedia</button>";
        } else {
            $totalbookings = checkSlots($koneksi, $date);
            if ($totalbookings == 11) {
                $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>Penuh</a>";
            } else {

                $availableslots = 11 - $totalbookings;
                $calendar .= "<td class='$today'><small><i>$availableslots : slots yang tersedia </i></small><h4>$currentDay</h4> <a href='pesan.php?date=" . $date . "' class='btn btn-success btn-xs'>Pesan</a>";
            }
        }
        $calendar .= "</td>";
        $currentDay++;
        $dayOfWeek++;
    }
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }
    $calendar .= "</tr>";
    $calendar .= "</table>";
    echo $calendar;
}
function checkSlots($koneksi, $date)
{
    $stmt = $koneksi->prepare("select * from transaksi where tanggal = ?");
    $stmt->bind_param('s', $date);
    $totalbookings = 0;
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $totalbookings++;
            }

            $stmt->close();
        }
    }
    return $totalbookings;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Pesan</title>
    <!-- <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
    <!-- <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="page_type" content="np-template-header-footer-from-plugin"> -->
    <!-- <title>Pesan Tanggal</title>
    <link rel="stylesheet" href="np.css" media="screen">
    <link rel="stylesheet" href="vaksin.css" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="np.js" defer=""></script>
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Abhaya+Libre:400,500,600,700,800|Alegreya:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

    <!-- boxed bg -->
    <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
    <!-- template skin -->
    <link id="t-colors" href="color/default.css" rel="stylesheet">

    <style>
        .fivesolidblue {
            border: 2px solid rgb(245, 244, 247);
            color: "white";
        }


        @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;

            }

            .empty {
                display: none;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
                color: white;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                color: white;
            }

            td:nth-of-type(1):before {
                content: "Minggu";
                color: red;
            }

            td:nth-of-type(2):before {
                content: "Senin";
                color: white;
            }

            td:nth-of-type(3):before {
                content: "Selasa";
            }

            td:nth-of-type(4):before {
                content: "Rabu";
            }

            td:nth-of-type(5):before {
                content: "Kamis";
            }

            td:nth-of-type(6):before {
                content: "Jumat";
            }

            td:nth-of-type(7):before {
                content: "Sabtu";
            }
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
                background: "media/tod.png";
                color: white;
            }

            td {
                width: 33%;
            }
        }

        .row {
            margin-top: 20px;
        }

        .today {
            /* background: green; */
        }

        body {
            background-image: url(kucing.jpg);
            background-size: cover
        }

        #test {
            padding: 20px
        }

        h2 {
            text-align: center;
            color: white;
        }

        p {
            margin-bottom: 10px;
            color: white;
        }
    </style>
</head>

<body style="background-image: url('/Oplbarunew/media/tod.png');">

    <!-- Top Background Image Wrapper -->

    <!-- <div class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../home.php">HOME</a>
			</div> -->
    <!-- <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
			<li class="active"><a href="/" target="blank">Who Am I</a></li>
			<li class="active"><a href="https://github.com/ganbarli/PHP-SBCS" target="blank">GitHub Project Page</a></li>
          </ul>
        </div>/.nav-collapse -->
    </div><!-- /.container -->
    </div>
    <!-- /.navbar -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if (isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }
                echo build_calendar($month, $year);
                ?>
            </div>
        </div>
    </div>
    <!-- Core JavaScript Files -->
    <!-- <script src="js/jquery.min.js"></script>	 
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/jquery.scrollTo.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/stellar.js"></script>
	<script src="plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/nivo-lightbox.min.js"></script>
    <script src="js/custom.js"></script> -->
    <script src="layout/scripts/jquery.min.js"></script>
    <script src="layout/scripts/jquery.backtotop.js"></script>
    <script src="layout/scripts/jquery.mobilemenu.js"></script>


    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> -->
</body>

</html>