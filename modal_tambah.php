<div id="modalTambah" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in-95 duration-150">
        
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Tambah Log Absensi Guru</h3>
            <button onclick="toggleModal(false)" class="text-gray-400 hover:text-gray-600 text-xl font-bold cursor-pointer">&times;</button>
        </div>

        <form method="POST" action="proses_simpan.php" enctype="multipart/form-data" class="p-6 space-y-4">
            
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Nama Lengkap Guru</label>
                <input type="text" name="nama_guru" class="w-full p-2 border border-gray-300 rounded-lg text-sm text-black focus:outline-blue-500" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" class="w-full p-2 border border-gray-300 rounded-lg text-sm text-black focus:outline-blue-500" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Durasi Kerja (Jam)</label>
                    <input type="number" name="jam_mengajar" min="1" max="12" class="w-full p-2 border border-gray-300 rounded-lg text-sm text-black focus:outline-blue-500" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" class="w-full p-2 border border-gray-300 rounded-lg text-sm text-black focus:outline-blue-500" required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Upload File Bukti (Bisa pilih banyak file sekaligus)</label>
                <input type="file" name="files[]" multiple class="w-full p-1.5 border border-dashed border-gray-300 rounded-lg text-sm text-gray-500 bg-gray-50 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <span class="text-[10px] text-gray-400 mt-1 block">*Pilih beberapa berkas JPG/PNG/PDF secara bersamaan jika lebih dari 1 file.</span>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                <button type="button" onclick="toggleModal(false)" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition cursor-pointer">Batal</button>
                <button type="submit" name="simpan" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow transition cursor-pointer">Simpan Data</button>
            </div>

        </form>
    </div>
</div>