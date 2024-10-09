<?php
// Koneksi ke database
$host = "localhost"; // Ubah jika perlu
$user = "root"; // Ganti dengan username database Anda
$pass = ""; // Ganti dengan password database Anda
$db_name = "azizah_27"; // Ganti dengan nama database Anda

$koneksi = mysqli_connect($host, $user, $pass, $db_name);

// Check connection
if (mysqli_connect_errno()){
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Tambah data siswa
if (isset($_POST['tambah'])) {
    $nisn = $_POST['nisn'];
    $nomor = $_POST['nomor'];
    $nama = $_POST['nama'];
    $addres = $_POST['addres'];
    
    // Insert data ke database
    $query = "INSERT INTO siswa (nisn, nomor, nama, addres) VALUES ('$nisn', '$nomor', '$nama', '$addres')";
    mysqli_query($koneksi, $query);
    
    // Redirect ulang ke halaman utama
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Update data siswa
if (isset($_POST['update'])) {
    $nisn = $_POST['nisn'];
    $nomor = $_POST['nomor'];
    $nama = $_POST['nama'];
    $addres = $_POST['addres'];
    
    // Update data di database
    $query = "UPDATE siswa SET nomor='$nomor', nama='$nama', addres='$addres' WHERE nisn='$nisn'";
    mysqli_query($koneksi, $query);
    
    // Redirect ulang ke halaman utama
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Hapus data siswa
if (isset($_GET['hapus'])) {
    $nisn = $_GET['hapus'];
    
    // Hapus data dari database
    $query = "DELETE FROM siswa WHERE nisn='$nisn'";
    mysqli_query($koneksi, $query);
    
    // Redirect ulang ke halaman utama
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP dan MySQLi - db azizah_27</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .edit, .hapus {
            text-decoration: none;
            padding: 5px 10px;
            color: white;
            border-radius: 3px;
        }
        .edit {
            background-color: #4CAF50;
        }
        .hapus {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h2>CRUD DATA SISWA</h2>

    <?php
    // Jika form edit, tampilkan data sesuai nisn
    if (isset($_GET['edit'])) {
        $nisn = $_GET['edit'];
        $result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
        $d = mysqli_fetch_array($result);
    ?>
        <h3>EDIT DATA SISWA</h3>
        <form method="post" action="">
            <input type="hidden" name="nisn" value="<?php echo $d['nisn']; ?>">
            <label>NISN</label>
            <input type="text" name="nisn" value="<?php echo $d['nisn']; ?>" readonly>
            <label>Nomor</label>
            <input type="text" name="nomor" value="<?php echo $d['nomor']; ?>" required>
            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo $d['nama']; ?>" required>
            <label>Address</label>
            <input type="text" name="addres" value="<?php echo $d['addres']; ?>" required>
            <input type="submit" name="update" value="UPDATE">
        </form>
    <?php
    } else {
    ?>
        <h3>TAMBAH DATA SISWA</h3>
        <form method="post" action="">
            <label>NISN</label>
            <input type="text" name="nisn" required>
            <label>Nomor</label>
            <input type="text" name="nomor" required>
            <label>Nama</label>
            <input type="text" name="nama" required>
            <label>Address</label>
            <input type="text" name="addres" required>
            <input type="submit" name="tambah" value="TAMBAH">
        </form>
    <?php
    }
    ?>

    <table>
        <tr>
            <th>NO</th>
            <th>NISN</th>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Address</th>
            <th>Opsi</th>
        </tr>
        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM siswa");
        while($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nisn']; ?></td>
                <td><?php echo $d['nomor']; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['addres']; ?></td>
                <td>
                    <a class="edit" href="?edit=<?php echo $d['nisn']; ?>">EDIT</a>
                    <a class="hapus" href="?hapus=<?php echo $d['nisn']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">HAPUS</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
