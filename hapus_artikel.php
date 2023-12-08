<?php
	include 'koneksi.php';	
	$id = $_GET['id'];
	$sql_delete = "DELETE FROM `artikel` WHERE `id` = '$id'";
	$query = $pdo->prepare($sql_delete);
	$query->execute(array($row['id']));

		if($query){
			echo 'Data berhasil di hapus! ';
			header("location:index.php");		
		}else{	
			echo 'Gagal menghapus data! ';	
						
		}

?>