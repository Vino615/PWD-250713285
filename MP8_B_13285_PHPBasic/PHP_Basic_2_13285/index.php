<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bayaran = $_POST["bayaran"] ?? "";
    $jenis = $_POST["jenis"] ?? "";
    $harga = 600000;
    $message = [];

    if (empty($bayaran) || empty($jenis)) {
        $message[] = "Harap lengkapi semua data.";
    }

    if (!preg_match("/^[0-9]*$/", $bayaran)) {
        $message[] = "Jumlah bayaran hanya boleh mengandung angka.";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $jenis)) {
        $message[] = "Jenis pembayaran hanya boleh mengandung huruf.";
    }

    if (!empty($message)) {
        foreach ($message as $msg) {
            echo "<p style='color:red;'>!! " . htmlspecialchars($msg) . " !!</p>";
        }
    } else {
        function jenisPembayaran($jenis) {
            switch (strtolower($jenis)) {
                case 'a':
                    return 0.75;
                case 'b':
                    return 0.50;
                case 'c':
                    return 0.25;
                case 'd':
                    return 0;
                default:
                    return 0;
            }
        }

        function infoJenisPembayaran($jenis) {
            switch (strtolower($jenis)) {
                case 'a':
                    return "Cicilan 25%";
                case 'b':
                    return "Cicilan 50%";
                case 'c':
                    return "Cicilan 75%";
                case 'd':
                    return "Lunas";
                default:
                    return "Jenis pembayaran tidak valid.";
            }
        }

        function totalBayar($harga, $potongan) {
            return $harga * $potongan;
        }

        function pembayaran($bayaran, $totalBayar) {
            if ($bayaran < $totalBayar) {
                return null;
            } else {
                return $bayaran - $totalBayar;
            }
        }

        $potongan = jenisPembayaran($jenis);
        $infoJenis = infoJenisPembayaran($jenis);
        $totalBayar = totalBayar($harga, $potongan);
        $bayaranKembali = pembayaran($bayaran, $totalBayar);

        if ($bayaranKembali === null) {
            echo "<p style='color:red;'>!! Jumlah yang dibayar kurang dari total pembayaran. Silakan bayar sesuai jumlah yang ditentukan. !!</p>";
        } else {
            echo "<h2>Informasi Pembayaran</h2>";
            echo "<p><b>Jumlah yang dibayar:</b> Rp" . htmlspecialchars($bayaran) . "</p>";
            echo "<p><b>Jenis Pembayaran:</b> " . htmlspecialchars($infoJenis) . "</p>";

            if (strtolower($jenis) == 'd') {
                echo "<p>Pembayaran lunas.</p>";
            } elseif ($potongan == 0) {
                echo "<p>Maaf jenis pembayaran tidak valid. Tidak ada potongan yang diberikan.</p>";
            } else {
                echo "<p>Anda mendapatkan potongan " . ($potongan * 100) . "% untuk pembayaran SPP Anda.</p>";
            }

            echo "<p><b>Total Pembayaran : Rp" . htmlspecialchars($totalBayar) . "</b></p>";
            echo "<p><b>Kembalian : Rp" . htmlspecialchars($bayaranKembali) . "</b></p>";
        }
    }
} else {
    echo "Silakan isi formulir untuk melakukan pembayaran.";
}
?>