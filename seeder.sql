-- ===== DUMMY DATA SEEDER =====
-- Default Password: password123 (encrypted dengan bcrypt)
-- Semua akun menggunakan password yang sama untuk testing

-- Insert Admin
INSERT INTO Admin (nama_admin, email, username, password, contact) VALUES
('Budi Santoso', 'budi@admin.com', 'budi_admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36', '082123456789'),
('Siti Nurhaliza', 'siti@admin.com', 'siti_admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36', '081987654321'),
('Ahmad Hidayat', 'ahmad@admin.com', 'ahmad_admin', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36', '085123456789');

-- Insert Peminjam
INSERT INTO Peminjam (nama_peminjam, username, email, contact, password) VALUES
('Rudi Hermawan', 'rudi_herm', 'rudi@student.com', '081234567890', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36'),
('Ani Wijaya', 'ani_wijaya', 'ani@student.com', '082345678901', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36'),
('Dani Pratama', 'dani_pratama', 'dani@student.com', '083456789012', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36'),
('Eka Putri', 'eka_putri', 'eka@student.com', '084567890123', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36'),
('Fajar Ramadhan', 'fajar_rama', 'fajar@student.com', '085678901234', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36CHqV36');

-- Insert Fasilitas Kampus
INSERT INTO Fasilitas_Kampus (nama_fasilitas, lokasi_fasilitas, kapasitas, status_fasilitas, deskripsi) VALUES
('Ruang Seminar A', 'Gedung Akademik Lt. 2', 50, 'Tersedia', 'Ruang seminar dilengkapi AC, proyektor, dan sound system'),
('Ruang Seminar B', 'Gedung Akademik Lt. 2', 30, 'Tersedia', 'Ruang seminar ukuran sedang untuk meeting'),
('Laboratorium Komputer', 'Gedung IT Lt. 1', 40, 'Tersedia', 'Laboratorium dengan 40 unit komputer dan jaringan internet'),
('Perpustakaan Digital', 'Gedung Pusat Lt. 3', 100, 'Tersedia', 'Ruang perpustakaan dengan fasilitas digital dan reading room'),
('Lapangan Olahraga', 'Area Terbuka', 200, 'Tersedia', 'Lapangan untuk berbagai aktivitas olahraga'),
('Ruang Meeting VIP', 'Gedung Akademik Lt. 3', 20, 'Tersedia', 'Ruang meeting premium dengan fasilitas lengkap'),
('Studio Rekaman', 'Gedung Seni Lt. 2', 15, 'Tersedia', 'Studio rekaman profesional untuk mahasiswa');

-- Insert Perlengkapan Fasilitas
INSERT INTO Perlengkapan_Fasilitas_Kampus (id_fasilitas, nama_perlengkapan, jumlah, kondisi) VALUES
(1, 'Kursi', 50, 'Baik'),
(1, 'Meja', 10, 'Baik'),
(1, 'Proyektor', 1, 'Baik'),
(1, 'Screen Proyektor', 1, 'Baik'),
(1, 'Sound System', 1, 'Baik'),
(2, 'Kursi', 30, 'Baik'),
(2, 'Meja', 8, 'Baik'),
(2, 'Whiteboard', 2, 'Baik'),
(3, 'Komputer', 40, 'Baik'),
(3, 'Meja Kerja', 40, 'Baik'),
(3, 'Kursi', 40, 'Baik'),
(3, 'Printer', 2, 'Baik'),
(4, 'Rak Buku', 30, 'Baik'),
(4, 'Kursi Baca', 50, 'Baik'),
(4, 'Meja Baca', 20, 'Baik'),
(5, 'Tiang Volley', 2, 'Baik'),
(5, 'Net Volley', 2, 'Baik'),
(5, 'Basket Hoop', 2, 'Baik'),
(6, 'Kursi Executive', 20, 'Baik'),
(6, 'Meja Konferensi', 1, 'Baik'),
(6, 'Proyektor Premium', 1, 'Baik'),
(7, 'Microphone', 3, 'Baik'),
(7, 'Speaker Monitor', 4, 'Baik'),
(7, 'Recording Equipment', 1, 'Baik');

-- Insert Peminjaman
INSERT INTO Peminjaman (id_fasilitas, id_peminjam, id_admin, tanggal_pengajuan, tanggal_peminjaman, jam_mulai, jam_selesai, status_peminjaman, administrasi_peminjaman, keterangan, keperluan) VALUES
(1, 1, 1, '2026-04-20', '2026-04-27', '08:00:00', '12:00:00', 'Selesai', 'Pembayaran Rp 500.000', 'Acara berjalan lancar', 'Workshop Web Development'),
(2, 2, 1, '2026-04-21', '2026-04-28', '13:00:00', '16:00:00', 'Disetujui', 'Pembayaran Rp 300.000', '', 'Meeting ORMAWA'),
(3, 3, 2, '2026-04-22', '2026-04-29', '09:00:00', '11:00:00', 'Disetujui', 'Pembayaran Rp 250.000', '', 'Praktikum Semester'),
(1, 4, 2, '2026-04-19', '2026-04-26', '14:00:00', '17:00:00', 'Selesai', 'Pembayaran Rp 500.000', 'Jumlah peserta: 35 orang', 'Seminar Teknik Informatika'),
(4, 5, 3, '2026-04-23', '2026-04-30', '10:00:00', '14:00:00', 'Pending', '', '', 'Diskusi Literasi Digital'),
(5, 1, 1, '2026-04-24', '2026-05-01', '16:00:00', '18:00:00', 'Disetujui', '', '', 'Turnamen Olahraga Antar Prodi'),
(6, 2, 2, '2026-04-25', '2026-05-02', '11:00:00', '13:00:00', 'Pending', '', '', 'Meeting dengan Dekan'),
(3, 3, 3, '2026-04-18', '2026-04-25', '13:00:00', '15:00:00', 'Selesai', 'Pembayaran Rp 250.000', 'Lancar tanpa kendala', 'Penelitian Data Mining'),
(7, 4, 1, '2026-04-26', '2026-05-03', '15:00:00', '17:00:00', 'Disetujui', 'Pembayaran Rp 400.000', '', 'Rekaman Podcast Mahasiswa'),
(2, 5, 2, '2026-04-27', '2026-05-04', '08:30:00', '10:30:00', 'Pending', '', '', 'Rapat Koordinasi Departemen');
