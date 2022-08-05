<?php

class apotik
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function createstok($id_obat,$qty)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO beli(id_obat,qty) VALUES (:id_obat, :qty)");
			$query->bindparam(":id_obat",$id_obat);
			$query->bindparam(":qty",$qty);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

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
		$query = $this->db->prepare("SELECT * FROM obat WHERE id_obat=:id_obat");
		$query->execute(array(":id_obat"=>$id));
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
                <td><div align="center" width="5px"><?php print($row['id_obat']); ?></div></td>                
                <td><?php print($row['obat']); ?></td>
                <td><?php print($row['qty_stok']); ?></td>
                <td><?php print($row['satuan']); ?></td>
                <td><?php print(number_format( $row['harga'] , 2 , ',', '.' )); ?></td>
                <td><div align="center">
                <?php echo "      
                 <a href='javascript:void(0)' onclick=\"TambahStok('$row[id_obat]')\" ><i class='icon-plus bigger-130'></i>Stok </a>          
                <a href='javascript:void(0)' onclick=\"editData('$row[id_obat]')\" ><i class='icon-pencil bigger-130'></i> Edit
                <a href='javascript:void(0)' onclick=\"deleteData('$row[id_obat]','$row[obat]')\" ><i class='icon-trash'></i> Hapus</a>
                ";?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata').dataTable({				
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
	                <td><div align="center" width="5px"><?php print($row['id_obat']); ?></div></td>                
	                <td><?php print($row['obat']); ?></td>
	                <td><?php print($row['qty_stok']); ?></td>
	                <td><?php print($row['satuan']); ?></td>
	                <td><?php print("Rp. ".number_format( $row['harga'] , 2 , ',', '.' )); ?></td>	                
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
