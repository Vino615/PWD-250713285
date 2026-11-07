<h2>Pendaftaran Staff</h2>

<form method="POST" action="?menu=L">
    <p>Nama :<br />
    <input type="text" name="nama" /></p>

    <p>NPM :<br />
    <input type="text" name="npm" /></p>

    <p>Pilihan Staff :<br />
    <select name="loker">
        <option value="">-- Pilih Staff --</option>
        <option value="kasir">Kasir</option>
        <option value="merchandiser">Merchandiser</option>
    </select></p>

    <button type="submit">Daftar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $npm = trim($_POST["npm"] ?? "");
    $loker = $_POST["loker"] ?? "";

    $error = [];

    if ($nama == "" || $npm == "" || $loker == "") {
        $error[] = "Harap lengkapi semua data.";
    }

    if ($nama != "" && !preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $error[] = "Nama hanya boleh mengandung huruf dan spasi.";
    }

    if ($npm != "" && !preg_match("/^[0-9]+$/", $npm)) {
        $error[] = "NPM hanya boleh mengandung angka.";
    }

    if ($loker != "" && $loker != "kasir" && $loker != "merchandiser") {
        $error[] = "Pilihan staff tidak valid.";
    }

    if (!empty($error)) {
        foreach ($error as $pesan) {
            echo "<p style='color:red;'>" . htmlspecialchars($pesan) . "</p>";
        }
    } else {
        if ($loker == "kasir") {
            $jadwalWawancara = "besok pukul 10.00 WIB di market";
        } else {
            $jadwalWawancara = "lusa pukul 12.00 WIB di market";
        }

        echo "<h2>Informasi Pendaftaran</h2>";
        echo "<p>Nama : " . htmlspecialchars($nama) . "</p>";
        echo "<p>NPM : " . htmlspecialchars($npm) . "</p>";
        echo "<p>Pilihan Staff : " . htmlspecialchars($loker) . "</p>";
        echo "<p>Jadwal Wawancara : " . htmlspecialchars($jadwalWawancara) . "</p>";

        echo "<p>Anda mendaftar sebagai " . htmlspecialchars($loker) .
             ". Selanjutnya, Anda dapat hadir " .
             htmlspecialchars($jadwalWawancara) .
             " untuk wawancara.</p>";
    }
} else {
    echo "<p>Silahkan lengkapi formulir di atas.</p>";
}
?>