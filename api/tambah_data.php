<html>
<head>
	<title>CRUD PHP dan MySQLi </title>
</head>
<body>
 
	<h2>CRUD DATA MAHASISWA</h2>
	<br/>
	<a href="tambah_data.php">KEMBALI</a>
	<br/>
	<br/>
	<h3>TAMBAH DATA MAHASISWA</h3>
	<form method="post" action="insert_registrasi.php">
		<table>
			
            <tr>			
				<td>nama</td>
				<td><input type="text" name="nama"></td>
			</tr>
            <tr>			
				<td>kelamin</td>
				<td><input type="text" name="kelamin"></td>
			</tr>
            <tr>			
				<td>ktp</td>
				<td><input type="text" name="ktp"></td>
			</tr>
            <tr>			
				<td>tgllahir</td>
				<td><input type="text" name="tgllahir"></td>
			</tr>
            <tr>			
				<td>agama</td>
				<td><input type="text" name="agama"></td>
			</tr>
            <tr>			
				<td>pekerjaan</td>
				<td><input type="text" name="pekerjaan"></td>
			</tr>
            <tr>			
				<td>alamat</td>
				<td><input type="text" name="alamat"></td>
			</tr>
            <tr>			
				<td>kodya</td>
				<td><input type="text" name="kodya"></td>
			</tr>
            <tr>			
				<td>kecamatan</td>
				<td><input type="text" name="kecamatan"></td>
			</tr>
            <tr>			
				<td>kelurahan</td>
				<td><input type="text" name="kelurahan"></td>
			</tr>
			<tr>
				<td>statusperkawinan</td>
				<td><input type="text" name="statusperkawinan"></td>
			</tr>
			<tr>
				<td>telepon</td>
				<td><input type="number" name="telepon"></td>
			</tr>
            <tr>
				<td>statuskewarganegaraan</td>
				<td><input type="text" name="statuskewarganegaraan"></td>
			</tr>
            <tr>
				<td>plafond</td>
				<td><input type="text" name="plafond"></td>
			</tr>
            <tr>
				<td>penghasilankotor</td>
				<td><input type="text" name="penghasilankotor"></td>
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