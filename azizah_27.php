<!DOCTYPE html>
<html>
<head>
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
            <input type="text" name="address" value="<?php echo $d['address']; ?>" required>
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
            <input type="text" name="address" required>
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
                <td><?php echo $d['address']; ?></td>
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
