<?php
	include 'koneksi.php';	
	$id = $_GET['id'];
	$judul = $_POST['judul'];
	$isi = $_POST['isi'];
	$sql_update = "UPDATE `artikel` SET `judul` = '$judul', `isi` = '$isi' WHERE `id` = '$id'";
	$query = $pdo->prepare($sql_update);
	$query->bindParam(1, $_POST['judul']);
	$query->bindParam(2, $_POST['isi']);
	$query->bindParam(3, $row['id']);
	$query->execute();

		if($query){
			echo 'Data berhasil di ubah! ';
			header("location:index.php");		
		}else{	
			echo 'Gagal mengubah data! ';	
						
		}

?>