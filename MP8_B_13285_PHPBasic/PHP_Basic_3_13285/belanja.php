<h2>Belanja</h2>
<h3>Daftar Kategori:</h3>

<form method="POST" action="?menu=B">
    <p>Makanan dan Minuman :<br />
    <select name="makanan">
        <option value="">-- Pilih Produk --</option>
        <option value="pop mie">Pop Mie</option>
        <option value="air mineral">Air Mineral</option>
    </select></p>

    <p>Alat Tulis :<br />
    <select name="alatTulis">
        <option value="">-- Pilih Produk --</option>
        <option value="pulpen">Pulpen</option>
        <option value="tipe-x">Tipe-X</option>
    </select></p>

    <button type="submit">Beli</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $makanan = $_POST["makanan"] ?? "";
    $alatTulis = $_POST["alatTulis"] ?? "";

    $error = [];

    if ($makanan == "" || $alatTulis == "") {
        $error[] = "Harap pilih semua produk terlebih dahulu.";
    }

    if ($makanan == "pop mie") {
        $hargaMakanan = 5000;
    } elseif ($makanan == "air mineral") {
        $hargaMakanan = 4000;
    } else {
        $hargaMakanan = 0;
        $error[] = "Pilihan makanan dan minuman tidak valid.";
    }

    if ($alatTulis == "pulpen") {
        $hargaAlatTulis = 2000;
    } elseif ($alatTulis == "tipe-x") {
        $hargaAlatTulis = 8000;
    } else {
        $hargaAlatTulis = 0;
        $error[] = "Pilihan alat tulis tidak valid.";
    }

    if (!empty($error)) {
        foreach ($error as $pesan) {
            echo "<p style='color:red;'>" . htmlspecialchars($pesan) . "</p>";
        }
    } else {
        $totalBayar = $hargaMakanan + $hargaAlatTulis;

        function dapatDiskon($totalBayar) {
            if ($totalBayar >= 10000) {
                return 0.05;
            } else {
                return 0;
            }
        }

        function totalHarga($diskon, $totalBayar) {
            return $totalBayar - ($totalBayar * $diskon);
        }

        $diskon = dapatDiskon($totalBayar);
        $hargaAkhir = totalHarga($diskon, $totalBayar);

        echo "<h2>Informasi Belanja</h2>";
        echo "<p>Makanan dan Minuman : " . htmlspecialchars($makanan) . "</p>";
        echo "<p>Alat Tulis : " . htmlspecialchars($alatTulis) . "</p>";
        echo "<p>Total Harga : Rp" . htmlspecialchars($hargaAkhir) . "</p>";
        echo "<p>Diskon : " . htmlspecialchars($diskon * 100) . "%</p>";

        if ($diskon == 0) {
            echo "<p>Maaf tidak ada diskon yang diberikan.</p>";
        } else {
            echo "<p>Selamat! Anda mendapatkan diskon " .
                 htmlspecialchars($diskon * 100) . "%.</p>";
        }
    }
} else {
    echo "<p>Silahkan pilih produk yang ingin dibeli.</p>";
}
?>