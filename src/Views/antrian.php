<?php
require_once 'src/Views/header.php';

date_default_timezone_set('Asia/Jakarta');
setlocale(LC_TIME, 'id_ID');
$time = strtotime('%H:%M:%S %p');
$date = strtotime('%A, %d %B %Y');
?>

<div id="app">
    <div id="main" class="layout-horizontal">

        <header class="mb-5">
            <div class="header-top">
                <div class="container">
                    <div class="logo">
                        <a href="/"><img src="public/assets/compiled/png/logo.png" alt="Logo"></a>
                    </div>
                    <div class="row">
                        <h4 id="time"><?= $time; ?></h4>
                        <h6 id="date"><?= $date; ?></h6>
                    </div>
                </div>
            </div>
        </header>

        <div class="content-wrapper container">

            <div class="page-heading">
                <marquee direction="left">
                    <h2><span class="badge bg-primary">SELAMAT DATANG DI APIK - SILAHKAN TUNGGU NOMOR ANTRIAN ANDA UNTUK
                            DIPANGGIL</span></h2>
                </marquee>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 bg">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title mx-0 my-0" align="center">NOMOR ANTRIAN PENDAFTARAN</h4>
                                    <hr>
                                    <h2 class="card-text mx-0 my-0 py-5" align="center"><?= !$current_daftar ? '---' : $current_daftar ?></h2>
                                    <hr>
                                    <h4 class="card-title mx-0 my-0" align="center">SISA ANTRIAN HARI INI</h4>
                                    <hr>
                                    <h2 class="card-text mx-0 my-0 py-4" align="center"><?= $daftar ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title mx-0 my-0" align="center">NOMOR ANTRIAN PENGAMBILAN OBAT</h4>
                                    <hr>
                                    <h2 class="card-text mx-0 my-0 py-5" align="center"><?= !$current_rsp ? '---' : $current_rsp ?></h2>
                                    <hr>
                                    <h4 class="card-title mx-0 my-0" align="center">SISA ANTRIAN HARI INI</h4>
                                    <hr>
                                    <h2 class="card-text mx-0 my-0 py-4" align="center"><?= $rsp ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include_once 'utils/footer.php'; ?>
        </div>

    </div>
</div>

<script>
    function updateTimeAndDate() {
        let timeElement = document.getElementById('time');
        let dateElement = document.getElementById('date');

        let currentTime = new Date();

        let hours = currentTime.getHours().toString().padStart(2, '0');
        let minutes = currentTime.getMinutes().toString().padStart(2, '0');
        let seconds = currentTime.getSeconds().toString().padStart(2, '0');
        let ampm = hours >= 12 ? 'PM' : 'AM';

        let dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        let monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        let day = dayNames[currentTime.getDay()];
        let date = currentTime.getDate().toString().padStart(2, '0');
        let month = monthNames[currentTime.getMonth()];
        let year = currentTime.getFullYear();

        let timeString = `${hours}:${minutes}:${seconds} ${ampm}`;
        let dateString = `${day}, ${date} ${month} ${year}`;

        timeElement.textContent = timeString;
        dateElement.textContent = dateString;
    }

    setInterval(updateTimeAndDate, 1000);
    updateTimeAndDate();
</script>
<?php require_once 'src/Views/tutup.php' ?>