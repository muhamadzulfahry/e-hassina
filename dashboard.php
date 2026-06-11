<?php
session_start();
include 'koneksi.php'; 

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Fitur Pencarian Data
$search = '';
$query_string = "SELECT * FROM absensi ORDER BY id DESC";

if (isset($_GET['cari'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    if (!empty($search)) {
        $query_string = "SELECT * FROM absening WHERE nama_guru LIKE '%$search%' OR mata_pelajaran LIKE '%$search%' ORDER BY id DESC";
    }
}

$result = mysqli_query($koneksi, $query_string);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard E-Hassina</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold">E-Hassina Monitoring</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm font-medium">Hai, <?= htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded text-sm font-semibold transition shadow">Keluar</a>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Data Log Mengajar Guru</h2>
                    <p class="text-gray-500 text-sm">Kelola jam mengajar harian dan verifikasi dokumen pengajaran.</p>
                </div>
                <button onclick="toggleModal(true)" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow transition duration-200 cursor-pointer">
                    + Tambah Log Absensi
                </button>
            </div>

            <form method="GET" action="" class="mb-6 flex gap-2 max-w-md">
                <input type="text" name="keyword" value="<?= htmlspecialchars($search); ?>" placeholder="Cari nama guru atau mapel..." class="w-full p-2 border rounded-lg border-gray-300 text-sm text-black focus:outline-blue-500">
                <button type="submit" name="cari" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Cari</button>
                <?php if (!empty($search)): ?>
                    <a href="dashboard.php" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition flex items-center">Reset</a>
                <?php endif; ?>
            </form>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-left border-collapse bg-white text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-700 font-semibold uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="p-4">No</th>
                            <th class="p-4">Nama Guru</th>
                            <th class="p-4">Mata Pelajaran</th>
                            <th class="p-4">Jam Kerja</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">File Bukti</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                        <?php 
                        $no = 1;
                        if (mysqli_num_rows($result) > 0):
                            while($row = mysqli_fetch_assoc($result)): 
                        ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-gray-900"><?= $no++; ?></td>
                                <td class="p-4 font-medium text-gray-900"><?= htmlspecialchars($row['nama_guru']); ?></td>
                                <td class="p-4"><?= htmlspecialchars($row['mata_pelajaran']); ?></td>
                                <td class="p-4"><span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-semibold"><?= htmlspecialchars($row['jam_mengajar']); ?> Jam</span></td>
                                <td class="p-4"><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                                <td class="p-4">
                                    <?php 
                                    if(!empty($row['files'])): 
                                        $file_list = json_decode($row['files'], true);
                                        foreach($file_list as $file):
                                    ?>
                                        <a href="uploads/<?= $file; ?>" target="_blank" class="block text-xs text-blue-600 hover:underline mb-0.5 truncate max-w-[150px]">📄 <?= $file; ?></a>
                                    <?php 
                                        endforeach;
                                    else: 
                                        echo '<span class="text-gray-400 text-xs">Tidak ada file</span>';
                                    endif; 
                                    ?>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        else:
                        ?>
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-400">Belum ada data log absensi yang ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <?php include 'modal_tambah.php'; ?>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modalTambah');
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            } else {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>