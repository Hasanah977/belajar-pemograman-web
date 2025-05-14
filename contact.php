<?php
// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "contact_form";

// Buat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama    = htmlspecialchars($_POST['nama']);
$email   = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

// Siapkan query dengan prepared statement untuk keamanan
$stmt = $conn->prepare("INSERT INTO messages (nama, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $message);

// Eksekusi query
if ($stmt->execute()) {
    // Redirect ke halaman terima kasih
    header("Location: thankyou.html");
    exit();
} else {
    echo "Gagal mengirim pesan: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>