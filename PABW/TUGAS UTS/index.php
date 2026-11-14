
<?php

// Fungsi untuk menghitung diskon
function hitungDiskon($totalBelanja) {
    $diskon = 0;

    if ($totalBelanja >= 100000) {
        $diskon = 0.10 * $totalBelanja;
    } elseif ($totalBelanja >= 50000) {
        $diskon = 0.05 * $totalBelanja;
    }

    return $diskon;
}

// Inisialisasi
$totalBelanja = 0;
$diskon = 0;
$totalBayar = 0;
$persentase = 0;
$dihitung = false;

// Memproses input form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalBelanja = (int) $_POST["totalBelanja"];

    if ($totalBelanja >= 0) {
        $diskon = hitungDiskon($totalBelanja);
        $totalBayar = $totalBelanja - $diskon;

        if ($totalBelanja >= 100000) {
            $persentase = 10;
        } elseif ($totalBelanja >= 50000) {
            $persentase = 5;
        }

        $dihitung = true;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Diskon</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">

        <header>
            <div class="logo">DC</div>
            <h2>Discount Calculator</h2>
        </header>

        <main>
            <div class="card">
                <div class="heading">
                    <h1>Hitung Diskon Belanja</h1>
                    <p>Masukkan total belanja untuk menghitung
                    potongan harga secara otomatis.</p>
                </div>

                <form method="POST" action="">
                    <label for="totalBelanja">
                        Total Belanja (Rp)
                    </label>

                    <input
                        type="number"
                        id="totalBelanja"
                        name="totalBelanja"
                        placeholder="Contoh: 120000"
                        min="0"
                        step="1"
                        value="<?php
                            echo isset($_POST['totalBelanja'])
                            ? htmlspecialchars($_POST['totalBelanja'])
                            : '';
                        ?>"
                        required
                    >

                    <div class="button-group">
                        <button type="submit" name="hitung">
                            Hitung Diskon
                        </button>

                        <button type="reset" class="btn-reset"
                            onclick="window.location.href=window.location.pathname">
                            Reset
                        </button>
                    </div>
                </form>

                <?php if ($dihitung): ?>

                <div class="result">
                    <h3>Hasil Perhitungan</h3>

                    <div class="result-item">
                        <span>Total Belanja</span>
                        <strong>
                            Rp <?= number_format($totalBelanja, 0, ',', '.') ?>
                        </strong>
                    </div>

                    <div class="result-item">
                        <span>Diskon (<?= $persentase ?>%)</span>
                        <strong class="discount">
                            - Rp <?= number_format($diskon, 0, ',', '.') ?>
                        </strong>
                    </div>

                    <div class="total">
                        <span>Total yang Harus Dibayar</span>
                        <h2>
                            Rp <?= number_format($totalBayar, 0, ',', '.') ?>
                        </h2>
                    </div>
                </div>

                <?php endif; ?>

                <div class="rules">
                    <h3>Ketentuan Diskon</h3>
                    <div>
                        <span>Belanja ≥ Rp100.000</span>
                        <strong>10%</strong>
                    </div>
                    <div>
                        <span>Belanja ≥ Rp50.000</span>
                        <strong>5%</strong>
                    </div>
                    <div>
                        <span>Belanja < Rp50.000</span>
                        <strong>0%</strong>
                    </div>
                </div>

            </div>
        </main>

        <footer>
            <p>Discount Calculator &copy; 2026</p>
        </footer>

    </div>

</body>
</html>
