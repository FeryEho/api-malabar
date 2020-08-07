<html>
<head>
	<title>CRUD PHP dan MySQLi </title>
</head>
<body>
 
	<h2>CRUD</h2>
	<br/>
	<a href="tambah_pengajuan.php">KEMBALI</a>
	<br/>
	<br/>
	<h3>TAMBAH DATA MAHASISWA</h3>
	<form method="post" action="insert_pengajuankredit.php">
		<table>
			
            <tr>			
				<td>kodepengajuan</td>
				<td><input type="text" name="kodepengajuan"></td>
			</tr>
            <tr>			
				<td>nama</td>
				<td><input type="text" name="nama"></td>
			</tr>
            <tr>			
				<td>alamat</td>
				<td><input type="text" name="alamat"></td>
			</tr>
            <tr>			
				<td>tgl_pengajuan</td>
				<td><input type="text" name="tgl_pengajuan"></td>
			</tr>
            <tr>			
				<td>sifatkredit</td>
				<td><input type="text" name="sifatkredit"></td>
			</tr>
            <tr>			
				<td>jenispenggunaan</td>
				<td><input type="text" name="jenispenggunaan"></td>
			</tr>
            <tr>			
				<td>golongandebitur</td>
				<td><input type="text" name="golongandebitur"></td>
			</tr>
            <tr>			
				<td>sektorekonomi</td>
				<td><input type="text" name="sektorekonomi"></td>
			</tr>
            <tr>			
				<td>instansi</td>
				<td><input type="text" name="instansi"></td>
			</tr>
            <tr>			
				<td>wilayah</td>
				<td><input type="text" name="wilayah"></td>
			</tr>
			<tr>
				<td>ao</td>
				<td><input type="text" name="ao"></td>
			</tr>
			<tr>
				<td>golonganpenjamin</td>
				<td><input type="text" name="golonganpenjamin"></td>
			</tr>
            <tr>
				<td>plafond</td>
				<td><input type="text" name="plafond"></td>
			</tr>
            <tr>
				<td>jangkawaktur</td>
				<td><input type="text" name="jangkawaktur"></td>
			</tr>
            <tr>
				<td>jaminan</td>
				<td><input type="text" name="jaminan"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>