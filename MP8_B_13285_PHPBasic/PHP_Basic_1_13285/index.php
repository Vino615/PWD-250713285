<?php
echo "<h1>Data Jurusan</h1>";
echo '<form method="POST" action="">
        <p>Nama : <input type="text" name="nama" /></p>
        <p>NPM : <input type="text" name="npm" /></p>
        <p>Jurusan : <input type="text" name="jurusan" /></p>
        <button type="submit">Kirim</button>
      </form>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $npm = $_POST["npm"];
    $jurusan = $_POST["jurusan"];

    if ($nama != "" && $npm != "" && $jurusan != "") {
        echo "Jurusan " . htmlspecialchars($nama) . " - " .
             htmlspecialchars($npm) . " - adalah " .
             htmlspecialchars($jurusan);
    } else {
        echo "Silakan isi formulir di atas untuk mengirimkan data jurusan Anda.";
    }
}
?>