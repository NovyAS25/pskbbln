<?php

class perusahaan_penjamin
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($nama_perusahaan_penjamin,$alamat_perusahaan_penjamin,$telp_perusahaan_penjamin,$aktif,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO perusahaan_penjamin(nama_perusahaan_penjamin,alamat_perusahaan_penjamin,telp_perusahaan_penjamin,aktif,created_by) VALUES (:nama_perusahaan_penjamin, :alamat_perusahaan_penjamin, :telp_perusahaan_penjamin, :aktif, :created_by)");
			$query -> bindparam(":nama_perusahaan_penjamin",$nama_perusahaan_penjamin);
			$query -> bindparam(":alamat_perusahaan_penjamin",$alamat_perusahaan_penjamin);
			$query -> bindparam(":telp_perusahaan_penjamin",$telp_perusahaan_penjamin);
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
		$query = $this->db->prepare("SELECT * FROM perusahaan_penjamin WHERE id_perusahaan_penjamin=:id_perusahaan_penjamin");
		$query->execute(array(":id_perusahaan_penjamin"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_perusahaan_penjamin,$nama_perusahaan_penjamin,$alamat_perusahaan_penjamin,$telp_perusahaan_penjamin,$aktif,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE perusahaan_penjamin SET 	nama_perusahaan_penjamin 	= :nama_perusahaan_penjamin,
																		alamat_perusahaan_penjamin	= :alamat_perusahaan_penjamin,
																		telp_perusahaan_penjamin	= :telp_perusahaan_penjamin,
																		aktif 						= :aktif,
													   					update_by 					= :updated_by
																WHERE 	id_perusahaan_penjamin		= :id_perusahaan_penjamin ");
			$query -> bindparam(":nama_perusahaan_penjamin",$nama_perusahaan_penjamin);
			$query -> bindparam(":alamat_perusahaan_penjamin",$alamat_perusahaan_penjamin);
			$query -> bindparam(":telp_perusahaan_penjamin",$telp_perusahaan_penjamin);
			$query -> bindparam(":aktif",$aktif);
			$query -> bindparam(":updated_by",$update_by);
			$query -> bindparam(":id_perusahaan_penjamin",$id_perusahaan_penjamin);
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
			$query = $this->db->prepare("DELETE FROM perusahaan_penjamin WHERE id_perusahaan_penjamin=:id_perusahaan_penjamin");
			$query->bindparam(":id_perusahaan_penjamin",$id);
			$query->execute();
			echo "
			<div class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Berhasil Di Hapus
			</div>
			<strong><a href='javascript:void(0)' onclick='perusahaan_penjamin()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return true;
		}catch(PDOException $e){
			echo "
			<div class='alert alert-error'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Tidak Bisa di Hapus Karena Sudah Di pakai !
			</div>
			<strong><a href='javascript:void(0)' onclick='perusahaan_penjamin()'> <i class='icon-backward'></i> Kembali</a></strong>";
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
                <td><?php print($row['nama_perusahaan_penjamin']); ?></td>
                <td><?php print($row['alamat_perusahaan_penjamin']); ?></td>
                <td><?php print($row['telp_perusahaan_penjamin']); ?></td>
                <td><div align="center"><?php print($row['aktif']); ?></div></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_perusahaan_penjamin]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_perusahaan_penjamin]','$row[nama_perusahaan_penjamin]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
                ";?>
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
	                <td><?php print($row['nama_perusahaan_penjamin']); ?></td>
	                <td><?php print($row['alamat_perusahaan_penjamin']); ?></td>
	                <td><?php print($row['telp_perusahaan_penjamin']); ?></td>
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
