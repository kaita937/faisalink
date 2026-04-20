CREATE DATABASE IF NOT EXISTS db_peminjaman_fasilitas;
USE db_peminjaman_fasilitas;

-- Table Admin
CREATE TABLE Admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    contact VARCHAR(20)
);

-- Table Peminjam
CREATE TABLE Peminjam (
    id_peminjam INT AUTO_INCREMENT PRIMARY KEY,
    nama_peminjam VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    contact VARCHAR(20),
    password VARCHAR(255) NOT NULL
);

-- Table Fasilitas Kampus
CREATE TABLE Fasilitas_Kampus (
    id_fasilitas INT AUTO_INCREMENT PRIMARY KEY,
    nama_fasilitas VARCHAR(100) NOT NULL,
    lokasi_fasilitas VARCHAR(100) NOT NULL,
    kapasitas INT,
    status_fasilitas VARCHAR(50),
    deskripsi TEXT
);

-- Table Perlengkapan Fasilitas Kampus
CREATE TABLE Perlengkapan_Fasilitas_Kampus (
    id_perlengkapan_fasilitas INT AUTO_INCREMENT PRIMARY KEY,
    id_fasilitas INT NOT NULL,
    nama_perlengkapan VARCHAR(100) NOT NULL,
    jumlah INT NOT NULL,
    kondisi VARCHAR(50),
    FOREIGN KEY (id_fasilitas) REFERENCES Fasilitas_Kampus(id_fasilitas) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table Peminjaman
CREATE TABLE Peminjaman (
    id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
    id_fasilitas INT NOT NULL,
    id_peminjam INT NOT NULL,
    id_admin INT,
    tanggal_pengajuan DATE NOT NULL,
    tanggal_peminjaman DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    status_peminjaman VARCHAR(50) NOT NULL,
    administrasi_peminjaman VARCHAR(255),
    keterangan TEXT,
    keperluan TEXT NOT NULL,
    FOREIGN KEY (id_fasilitas) REFERENCES Fasilitas_Kampus(id_fasilitas) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_peminjam) REFERENCES Peminjam(id_peminjam) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_admin) REFERENCES Admin(id_admin) ON DELETE SET NULL ON UPDATE CASCADE
);
