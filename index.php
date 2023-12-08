<?php $thisPage = "Artikel"; ?>

<?php include'header.php';?>

	<section id="content" class="container">
		
		<!---Input -->
		<h3 class="judul">Form Input Artikel</h3>
		<article id="artikel">
			<div id="form-contact">
			<form method="post">
				<div class="form-row">
					<label for="judul">Judul</label>
					<input type="text" name="judul">	
				</div>
				<div class="form-row">
					<label for="isi">Isi Artikel</label>
					<textarea name="isi"></textarea>
				</div>
				<button type="submit" name="submit">Kirim</button>
			</form>
			<?php
				if (isset($_POST['submit']))
				{
					try {
					
					$judul = $_POST['judul'];
				
					$isi = $_POST['isi'];

					$sql_insert = "INSERT INTO `artikel` (`judul`,`isi`) VALUES (?,?)";
					$query = $pdo->prepare($sql_insert);
					$query->bindParam(1, $judul);
					$query->bindParam(2, $isi);
					$query->execute();

					echo "<h3>Anda Berhasil Membuat Artikel</h3>";

					} catch(PDOException $e){
					echo "<h3>Anda Gagal Membuat Artikel Karena: ".$e->getMessage()."</h3>";
					}
				}
			?>
			
		</div>
		</article>

		<!---View -->
	<?php
		$sql_select = "SELECT * FROM artikel ORDER BY id ASC";
		$no = 1 ;
		$no_ket ='#Artikel';		
		$query = $pdo->prepare($sql_select);
		$query->execute();
		$row = $query->fetchAll();
		if ($row==false){
		echo 'Belum ada artikel';
		} else {
	?>
		<table>
		  <thead>
		    <tr>
		      <th>No</th>
		      <th>Judul</th>
		      <th>Isi Artikel</th>
		      <th>Aksi</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($row as $data) { ?>
				<tr>
				    <td><?php echo $no_ket;?> <?php echo $no++; ?></td>
				    <td><?php echo $data['judul']; ?></td>
				    <td><?php echo $data['isi']; ?></td>
				    <td><a href="#openModal?id=<?php echo $data['id']; ?>" class="btn btn-default"><i class="fa fa-pencil"></a></i> <a href="hapus_artikel.php?id=<?php echo $data['id']; ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>


						<!---Edit -->
						<div id="openModal?id=<?php echo $data['id']; ?>" class="modalDialog">
						    <div><a href="#close" title="Close" class="close">X</a>
						        <h3 class="judul">Form Edit Artikel</h3>
								<article id="artikel">
									<div id="form-edit">
									<form method="post" action="edit_artikel.php?id=<?php echo $data['id']; ?>">
										<div class="form-row">
											<label for="judul">Judul</label>
											<input type="text" name="judul" value="<?php echo $data['judul']; ?>">	
										</div>
										<div class="form-row">
											<label for="isi">Isi Artikel</label>
											<textarea name="isi"><?php echo $data['isi']; ?></textarea>
										</div>
										<button type="submit" name="submit">Ubah</button>
										<a href="#close"><button type="button" class="cancel">Batal</button></a>
									</form>
									
								</div>
								</article>
						    </div>
						</div>
					</td>
				</tr>
				<?php } ?>
		  </tbody>
		</table>
		<?php 
			}
		?>
	</section>

