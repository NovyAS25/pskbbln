<?php

class tindakan_lab
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($tindakan_lab,$harga,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO tindakan_lab(tindakan_lab,harga_tindakan_lab,created_by) VALUES (:tindakan_lab, :harga, :created_by)");
			$query -> bindparam(":tindakan_lab",$tindakan_lab);
			$query -> bindparam(":harga",$harga);
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
		$query = $this->db->prepare("SELECT * FROM tindakan_lab WHERE id_tindakan_lab=:id_tindakan_lab");
		$query->execute(array(":id_tindakan_lab"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_tindakan_lab,$tindakan_lab,$harga,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE tindakan_lab SET 	tindakan_lab 		= :tindakan_lab,
																harga_tindakan_lab	= :harga,
													   			update_by 			= :updated_by
														WHERE 	id_tindakan_lab		= :id_tindakan_lab ");
			$query -> bindparam(":tindakan_lab",$tindakan_lab);
			$query -> bindparam(":harga",$harga);
			$query -> bindparam(":updated_by",$update_by);
			$query -> bindparam(":id_tindakan_lab",$id_tindakan_lab);
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
			$query = $this->db->prepare("DELETE FROM tindakan_lab WHERE id_tindakan_lab=:id_tindakan_lab");
			$query->bindparam(":id_tindakan_lab",$id);
			$query->execute();
			echo "
			<div class='alert alert-success'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Berhasil Di Hapus
			</div>
			<strong><a href='javascript:void(0)' onclick='TindakanLab()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return true;
		}catch(PDOException $e){
			echo "
			<div class='alert alert-error'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			Data Tidak Bisa di Hapus Karena Sudah Di pakai !
			</div>
			<strong><a href='javascript:void(0)' onclick='TindakanLab()'> <i class='icon-backward'></i> Kembali</a></strong>";
			return false;
		}
		
	}

	public function select($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_tindakan_lab]'>$row[nama_tindakan_lab]</option>";
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
                <td><?php print($row['tindakan_lab']); ?></td>
                <td><?php print(number_format( $row['harga_tindakan_lab'] , 2 , ',', '.' )); ?></td>
                <td><div align="center">
                <?php echo "                
                <a href='javascript:void(0)' onclick=\"editData('$row[id_tindakan_lab]')\" ><i class='icon-trash icon-pencil bigger-130'></i></i> </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_tindakan_lab]','$row[tindakan_lab]')\" ><i class='icon-trash icon-red bigger-130'></i></i> </a>
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
	                <td><?php print($row['tindakan_lab']); ?></td>
	                <td><?php print("Rp. ".number_format( $row['harga_tindakan_lab'] , 2 , ',', '.' )); ?></td>
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
