<?php

class dokter
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($nama_dokter,$alamat_dokter,$telp_dokter,$bidang_keahlian,$aktif,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO dokter(nama_dokter,alamat_dokter,telp_dokter,bidang_keahlian,aktif,created_by) VALUES (:nama_dokter, :alamat_dokter, :telp_dokter, :bidang_keahlian, :aktif, :created_by)");
			$query -> bindparam(":nama_dokter",$nama_dokter);
			$query -> bindparam(":alamat_dokter",$alamat_dokter);
			$query -> bindparam(":telp_dokter",$telp_dokter);
			$query -> bindparam(":bidang_keahlian",$bidang_keahlian);
			$query -> bindparam(":aktif",$aktif);
			$query -> bindparam(":created_by",$created_by);
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
		$query = $this->db->prepare("SELECT * FROM dokter WHERE id_dokter=:id_dokter");
		$query->execute(array(":id_dokter"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_dokter,$nama_dokter,$alamat_dokter,$telp_dokter,$bidang_keahlian,$aktif,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE dokter SET 	nama_dokter 	= :nama_dokter,
															alamat_dokter	= :alamat_dokter,
															telp_dokter		= :telp_dokter,
															bidang_keahlian	= :bidang_keahlian,
															aktif 			= :aktif,
													   		update_by 		= :updated_by
													WHERE 	id_dokter		= :id_dokter ");
			$query -> bindparam(":nama_dokter",$nama_dokter);
			$query -> bindparam(":alamat_dokter",$alamat_dokter);
			$query -> bindparam(":telp_dokter",$telp_dokter);
			$query -> bindparam(":bidang_keahlian",$bidang_keahlian);
			$query -> bindparam(":aktif",$aktif);
			$query -> bindparam(":updated_by",$update_by);
			$query -> bindparam(":id_dokter",$id_dokter);
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
			$query = $this->db->prepare("DELETE FROM dokter WHERE id_dokter=:id_dokter");
			$query->bindparam(":id_dokter",$id);
			$query->execute();
			echo "
			<div class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Berhasil Di Hapus
			</div>
			<strong><a href='javascript:void(0)' onclick='dokter()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return true;
		}catch(PDOException $e){
			echo "
			<div class='alert alert-error'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Tidak Bisa di Hapus Karena Sudah Di pakai !
			</div>
			<strong><a href='javascript:void(0)' onclick='dokter()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return false;
		}
	}

	public function select($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_dokter]'>$row[nama_dokter]</option>";
		}
		
	}
	
	public function view($query)
	{
		$query1 = $this->db->prepare("SELECT * FROM v_tindakan_poli"); 
		$query1->execute();
		if($query1->rowCount()>0)
		{
			while($row1=$query1->fetch(PDO::FETCH_ASSOC))
			{
				$dok=$row1['id_dokter'];
			}
		}
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td><?php print($row['nama_dokter']); ?></td>
                <td><?php print($row['alamat_dokter']); ?></td>
                <td><?php print($row['telp_dokter']); ?></td>
                <td><?php print($row['bidang_keahlian']); ?></td>
                <td><?php print($row['aktif']); ?></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_dokter]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
                
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_dokter]','$row[nama_dokter]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
                "; ?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable( {
						
					} );
				} );
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
	
	public function Prin($query)
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
	                <td><?php print($row['nama_dokter']); ?></td>
	                <td><?php print($row['alamat_dokter']); ?></td>
	                <td><?php print($row['telp_dokter']); ?></td>
	                <td><?php print($row['bidang_keahlian']); ?></td>
	                <td><div align="center" width="5px"><?php print($row['aktif']); ?></div></td>
                </tr>
                <?php
                $no++;
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
	
}
