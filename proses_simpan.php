<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama_guru      = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $mata_pelajaran = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']);
    $jam_mengajar   = intval($_POST['jam_mengajar']);
    $tanggal        = $_POST['tanggal'];

    // Proses Folder Upload Berkas Komponen Multiple
    $uploaded_files = [];
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    if (!empty($_FILES['files']['name'][0])) {
        $total_files = count($_FILES['files']['name']);
        
        for ($i = 0; $i < $total_files; $i++) {
            $file_tmp  = $_FILES['files']['tmp_name'][$i];
            $file_name = $_FILES['files']['name'][$i];
            
            // Berikan penamaan unik unik menggunakan fungsi waktu microtime
            $unique_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.\-_]/", "", $file_name);
            $target_path = "uploads/" . $unique_name;

            if (move_uploaded_file($file_tmp, $target_path)) {
                $uploaded_files[] = $unique_name;
            }
        }
    }

    // Mengubah array daftar nama berkas file menjadi bentuk string JSON terstruktur
    $files_json = !empty($uploaded_files) ? json_encode($uploaded_files) : null;

    $query = "INSERT INTO absensi (nama_guru, mata_pelajaran, jam_mengajar, tanggal, files) VALUES ('$nama_guru', '$mata_pelajaran', $jam_mengajar, '$tanggal', " . ($files_json ? "'$files_json'" : "NULL") . ")";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Log data absensi berhasil disimpan!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data ke database!'); window.location.href='dashboard.php';</script>";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>