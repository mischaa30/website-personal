# website-personal
Web
<!DOCTYPE html>
<html>
<head>
    <title>CRUD PHP dan MySQLi - db azizah_27</title>
</head>
<body>
    <h2>CRUD DATA SISWA</h2>

    <!-- Form Tambah/Edit Data -->
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
        <table>
            <tr>
                <td>NISN</td>
                <td><input type="text" name="nisn" value="<?php echo $d['nisn']; ?>"></td>
            </tr>
            <tr>
                <td>Nomor</td>
                <td><input type="text" name="nomor" value="<?php echo $d['nomor']; ?>"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $d['nama']; ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" name="addres" value="<?php echo $d['addres']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="update" value="UPDATE"></td>
            </tr>
        </table>
    </form>
    <?php
    } else {
    ?>
    <h3>TAMBAH DATA SISWA</h3>
    <form method="post" action="">
        <table>
            <tr>
                <td>NISN</td>
                <td><input type="text" name="nisn" required></td>
            </tr>
            <tr>
                <td>Nomor</td>
                <td><input type="text" name="nomor" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" name="addres" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="tambah" value="TAMBAH"></td>
            </tr>
        </table>
    </form>
    <?php
    }
    ?>

    <br/>

    <!-- Tabel Tampil Data -->
    <table border="1">
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
                <a href="?edit=<?php echo $d['nisn']; ?>">EDIT</a>
                <a href="?hapus=<?php echo $d['nisn']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">HAPUS</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
