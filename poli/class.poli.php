<?php

class poli
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}

	//============================================================== DOKTER =============================================================
	
	public function TambahDokter($reg_no,$id_dokter,$diagnosa_dokter)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO tindakan_poli(reg_no,id_dokter,diagnosa_dokter) VALUES (:reg_no, :id_dokter, :diagnosa_dokter)");
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_dokter",$id_dokter);
			$query->bindparam(":diagnosa_dokter",$diagnosa_dokter);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function TambahRujuk($reg_no,$rujuk,$alamat,$keterangan)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO rujuk(reg_no,rujuk,alamat,keterangan) VALUES (:reg_no, :rujuk, :alamat, :keterangan)");
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":rujuk",$rujuk);
			$query->bindparam(":alamat",$alamat);
			$query->bindparam(":keterangan",$keterangan);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function EditDokter($id_tindakan_poli,$reg_no,$id_dokter,$diagnosa_dokter)
	{
		try
		{
			$query=$this->db->prepare("UPDATE tindakan_poli SET	reg_no 				= :reg_no,
																id_dokter 			= :id_dokter,
																diagnosa_dokter		= :diagnosa_dokter
															WHERE id_tindakan_poli	= :id_tindakan_poli ");
			$query->bindparam(":id_tindakan_poli",$id_tindakan_poli);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_dokter",$id_dokter);
			$query->bindparam(":diagnosa_dokter",$diagnosa_dokter);
			$query->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function EditRujuk($rujuk_id,$reg_no,$rujuk,$alamat,$keterangan)
	{
		try
		{
			$query=$this->db->prepare("UPDATE rujuk SET	reg_no 			= :reg_no,
														rujuk			= :rujuk,
														alamat			= :alamat,
														keterangan 		= :keterangan
														WHERE rujuk_id	= :rujuk_id ");
			$query->bindparam(":rujuk_id",$rujuk_id);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":rujuk",$rujuk);
			$query->bindparam(":alamat",$alamat);
			$query->bindparam(":keterangan",$keterangan);
			$query->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}


	public function selectDokter($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_dokter]'>$row[nama_dokter]</option>";
		}
		
	} 

	public function getDokter($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_edit_dokter WHERE reg_no=:reg_no");
		$query->execute(array(":reg_no"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function getRujuk1($id)
	{
		$query = $this->db->prepare("SELECT * FROM rujuk WHERE reg_no=:reg_no");
		$query->execute(array(":reg_no"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function deleteDokter($id)
	{
		try{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM tindakan_poli WHERE id_tindakan_poli=:id_tindakan_poli");
		$query->bindparam(":id_tindakan_poli",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}

	public function viewDokter($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center"><?php print($row['reg_no']); ?></div></td>
	                <td><?php print($row['nama_dokter']); ?></td>
	                <td><?php print($row['diagnosa_dokter']); ?></td>  
	             	<td><div align="center"><?php echo "               
		                <a href='javascript:void(0)' onclick=\"editDokter('$row[reg_no]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
		                <a href='javascript:void(0)' onclick=\"deleteDokter('$row[id_tindakan_poli]','$row[reg_no]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
		                ";?></div></td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({
						"sSorting":[[2, "desc"]],
	                    "iDisplayLength": 4,
	                    "aLengthMenu": [4, 10, 25, 50, 100 ],				
					});
				});
			</script><?php 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}

	public function TambahTindakanLab($reg_no,$id_tindakan_lab,$harga)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO rujuklab(reg_no,id_tindakan_lab,harga) VALUES (:reg_no, :id_tindakan_lab, :harga)");
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_tindakan_lab",$id_tindakan_lab);
			$query->bindparam(":harga",$harga);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	//============================================================ TINDAKAN ===========================================================

	public function TambahTindakan($reg_no,$id_tindakan,$harga)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO poli(reg_no,id_tindakan,harga_tindakan) VALUES (:reg_no, :id_tindakan, :harga_tindakan)");
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_tindakan",$id_tindakan);
			$query->bindparam(":harga_tindakan",$harga);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function EditRujuklab($rujuklab_id,$reg_no,$id_tindakan_lab,$harga)
	{
		try
		{
			$query=$this->db->prepare("UPDATE rujuklab SET	reg_no		= :reg_no,
														id_tindakan_lab	= :id_tindakan_lab,
														harga 			= :harga
												WHERE 	rujuklab_id		= :rujuklab_id ");
			$query->bindparam(":rujuklab_id",$rujuklab_id);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_tindakan_lab",$id_tindakan_lab);
			$query->bindparam(":harga",$harga);
			$query->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function EditTindakan($poli_id,$reg_no,$id_tindakan,$harga)
	{
		try
		{
			$query=$this->db->prepare("UPDATE poli SET	reg_no			= :reg_no,
														id_tindakan  	= :id_tindakan,
														harga_tindakan	= :harga_tindakan
												WHERE 	poli_id			= :poli_id ");
			$query->bindparam(":poli_id",$poli_id);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_tindakan",$id_tindakan);
			$query->bindparam(":harga_tindakan",$harga);
			$query->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function deleteRujukLAB($id)
	{
		try{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM rujuklab WHERE rujuklab_id=:rujuklab_id");
		$query->bindparam(":rujuklab_id",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}

	public function deleteTindakan($id)
	{
		try{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM poli WHERE poli_id=:poli_id");
		$query->bindparam(":poli_id",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}

	public function getTindakan($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_poli WHERE poli_id=:poli_id");
		$query->execute(array(":poli_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	public function getrujuklab($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_rujuklab WHERE rujuklab_id=:rujuklab_id");
		$query->execute(array(":rujuklab_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function selectTindakan($query){
		$query = $this->db->prepare($query);
		$query->execute();
		$jsArray2 = "var dpa = new Array();\n";
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_tindakan]'>$row[tindakan]</option>";
			$jsArray2 .= "dpa['" . $row['id_tindakan'] . "'] = {name:'" . addslashes($row['harga'])."'};\n"; 
			
		}		
	}
	
	public function viewPoli($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['tindakan']); ?></td> 
	             	<td><div align="center"><?php echo "               
		                <a href='javascript:void(0)' onclick=\"editTindakan('$row[poli_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
		                <a href='javascript:void(0)' onclick=\"deleteTindakan('$row[poli_id]','$row[reg_no]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
		                ";?></div></td>
                </tr>
               
                <?php
                $no++;
                $jumlah +=$row['harga_tindakan'];
			} ?>
			 	
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({
						"sSorting":[[2, "desc"]],
	                    "iDisplayLength": 4,
	                    "aLengthMenu": [4, 10, 25, 50, 100 ],				
					});
				});
			</script>
			<?php 
		}
		else
		{
			?>
            <tr>
           		<td><strong>Tidak ada data...!!</strong></td>
           		<td></td>
            </tr>
            <?php
		}		
	}

	public function viewKwitansiPoli($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center"><?php print($no); ?></div></td>
	                <td><?php print($row['tindakan']); ?></td>
	                <td><?php print "Rp. ".(number_format( $row['harga_tindakan'] , 2 , ',', '.' )); ?></td> 	    
                </tr>               
                <?php
                $no++;
                $jumlah +=$row['harga_tindakan'];
			} 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}

	public function totalTindakan($query,$query1)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				                  
                $jumlah +=$row['harga_tindakan'];
                
			} 
			
		}

		$query1 = $this->db->prepare($query1);
		$query1->execute();
		$no1 = 1;
		$jumlah1 = 0;
		if($query1->rowCount()>0)
		{
			while($row=$query1->fetch(PDO::FETCH_ASSOC))
			{
				                  
                $jumlah1 +=$row['harga_obat'];
                
			} 
			
		}
		$total = $jumlah1+$jumlah;
		echo "Rp. ".(number_format( $total, 2 , ',', '.' ));	
		
	}
//=================================================================== RESEP ==============================================================
	public function total($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			print $row['Sum(resep.harga_obat)'];
		}
	}

	public function TambahResep($reg_no,$id_obat,$qty,$satuan,$harga)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO resep(id_obat,reg_no,harga_obat,satuan,qty_resep) VALUES (:id_obat, :reg_no, :harga_obat, :satuan, :qty_resep)");
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_obat",$id_obat);
			$query->bindparam(":harga_obat",$harga);
			$query->bindparam(":satuan",$satuan);
			$query->bindparam(":qty_resep",$qty);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function EditResep($resep_id,$reg_no,$id_obat,$qty,$satuan,$harga)
	{
		try
		{
			$query=$this->db->prepare("UPDATE resep SET	reg_no			= :reg_no,
														id_obat  		= :id_obat,
														harga_obat		= :harga_obat,
														satuan 			= :satuan,
														qty_resep 		= :qty_resep
												WHERE 	resep_id		= :resep_id ");
			$query->bindparam(":resep_id",$resep_id);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":id_obat",$id_obat);
			$query->bindparam(":harga_obat",$harga);
			$query->bindparam(":satuan",$satuan);
			$query->bindparam(":qty_resep",$qty);
			$query->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function getResep($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_resep WHERE resep_id=:resep_id");
		$query->execute(array(":resep_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function getrujuk($id)
	{
		$query = $this->db->prepare("SELECT * FROM rujuk WHERE rujuk_id=:rujuk_id");
		$query->execute(array(":rujuk_id"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function deleteResep($id)
	{
		try{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM resep WHERE resep_id=:resep_id");
		$query->bindparam(":resep_id",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}

	public function deleteRujuk($id)
	{
		try{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM rujuk WHERE rujuk_id=:rujuk_id");
		$query->bindparam(":rujuk_id",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}

	public function viewResep($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['obat']); ?></td>
	                <td><?php print($row['qty_resep']); ?></td>
	                <td><?php print($row['satuan']); ?></td> 
	             	<td><div align="center"><?php echo "               
		                <a href='javascript:void(0)' onclick=\"editResep('$row[resep_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
		                <a href='javascript:void(0)' onclick=\"deleteResep('$row[resep_id]','$row[reg_no]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
		                ";?></div></td>
                </tr>
               
                <?php
                $no++;
                $jumlah +=$row['harga_obat'];
			} ?>
			 	
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({
						"sSorting":[[2, "desc"]],
	                    "iDisplayLength": 4,
	                    "aLengthMenu": [4, 10, 25, 50, 100 ],				
					});
				});
			</script>
			<?php 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}

	public function viewRujuk($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['rujuk']); ?></td>
	                <td><?php print($row['alamat']); ?></td>
	                <td><?php print($row['keterangan']); ?></td> 
	             	<td><div align="center"><?php echo "               
		                <a href='javascript:void(0)' onclick=\"editRujuk('$row[rujuk_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
		                <a href='javascript:void(0)' onclick=\"deleteRujuk('$row[rujuk_id]','$row[reg_no]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
		                ";?></div></td>
                </tr>
               
                <?php } ?>

			 	
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({
						"sSorting":[[2, "desc"]],
	                    "iDisplayLength": 4,
	                    "aLengthMenu": [4, 10, 25, 50, 100 ],				
					});
				});
			</script>
		<?php	
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}

	public function viewRujukLAB($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['tindakan_lab']); ?></td>
	             	<td><div align="center"><?php echo "               
		                <a href='javascript:void(0)' onclick=\"editRujukLAB('$row[rujuklab_id]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
		                <a href='javascript:void(0)' onclick=\"deleteRujukLAB('$row[rujuklab_id]','$row[reg_no]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
		                ";?></div></td>
                </tr>
               
                <?php } ?>

			 	
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({
						"sSorting":[[2, "desc"]],
	                    "iDisplayLength": 4,
	                    "aLengthMenu": [4, 10, 25, 50, 100 ],				
					});
				});
			</script>
		<?php	
		}
		else
		{
			?>
            <tr>
           		<td><strong>Tidak ada data...!!</strong></td>
           		<td></td>
            </tr>
            <?php
		}		
	}

	public function viewKwitansiResep($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah1 = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center"><?php print($no); ?></div></td>
	                <td><?php print($row['obat']); ?></td>
	                <td><div align="center"><?php print($row['qty_resep']); ?></div></td>
	                <td><div align="center"><?php print($row['satuan']); ?></div></td>
	                <td><?php print "Rp. ".(number_format( $row['harga'] , 2 , ',', '.' )); ?></td>
	                <td><?php print "Rp. ".(number_format( $row['harga_obat'] , 2 , ',', '.' )); ?></td> 
                </tr>
               
                <?php
                $no++;
                $jumlah1 +=$row['harga_obat'];
			}  
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}

	public function viewRujuklabo($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah1 = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['tindakan_lab']); ?></td>
                </tr>
               
                <?php
			}  
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}

	public function viewResepDokter($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$jumlah1 = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><?php print($row['obat']); ?></td>
	                <td><div align="center"><?php print($row['qty_resep']); ?></div></td>
	                <td><div align="center"><?php print($row['satuan']); ?></div></td>
                </tr>
               
                <?php
   
			}  
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}
//========================================================================================================================================

	
	public function create($obat,$satuan,$harga,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO obat(obat,satuan,harga,created_by) VALUES (:obat, :satuan, :harga, :created_by)");
			$query->bindparam(":obat",$obat);
			$query->bindparam(":satuan",$satuan);
			$query->bindparam(":harga",$harga);
			$query->bindparam(":created_by",$created_by);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function getID($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_reg WHERE reg_no=:reg_no");
		$query->execute(array(":reg_no"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function update($id_obat,$obat,$satuan,$harga,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE obat SET 		obat 		= :obat,
															satuan 		= :satuan,
															harga 		= :harga,
															update_by 	= :update_by
													WHERE 	id_obat		= :id_obat ");
			$query->bindparam(":id_obat",$id_obat);
			$query->bindparam(":obat",$obat);
			$query->bindparam(":satuan",$satuan);
			$query->bindparam(":harga",$harga);
			$query->bindparam(":update_by",$update_by);
			$query -> execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		try{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM obat WHERE id_obat=:id_obat");
		$query->bindparam(":id_obat",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}	
	
	public function view($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center"><?php print($row['reg_no']); ?></div></td>	               
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"Dokter('$row[reg_no]')\" >Detail</a>";?>
	                </div></td>
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"Tindakan('$row[reg_no]')\" >Detail</a></div></td> "; ?>
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"Resep('$row[reg_no]')\">Detail</a></div></td> "; ?>
	                 <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"RujukLAB('$row[reg_no]')\" >Detail</a>";?>
	                </div></td>
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"Rujuk('$row[reg_no]')\">Detail</a></div></td> "; ?>
	                <td><?php print($row['diagnosa']); ?></div>
	                <td><?php print($row['nama']); ?></td>
	                <td><?php print($row['tempat_lahir'].", " .tgl_indo($row['tgl_lahir'])); ?></td>            
	                <td><?php print($row['alamat'].", Kel. ". $row['nama_kel']. ", kec. " . $row['nama_kec']. ", ". $row['nama_kab']. " - " . $row['nama_prov']); ?></td>
	                <td><?php print($row['jenis_kelamin']); ?></td> 
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({
						 "sSorting":[[2, "desc"]],
	                    "iDisplayLength": 5,
	                    "aLengthMenu": [5, 10, 25, 50, 100 ],				
					});
				});
			</script><?php 
		}
		else
		{
			?>
            <tr>
           		<td></td>
           		<td><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}
	
}
