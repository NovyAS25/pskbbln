<?php

class lab
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	//====================================================================================================================================================
	//====================================================================================================================================================
	public function TambahLab($reg_no,$id_tindakan_lab,$harga_lab,$hasil)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO lab(id_tindakan_lab,reg_no,harga_lab,hasil) VALUES (:id_tindakan_lab, :reg_no, :harga_lab, :hasil)");
			$query->bindparam(":id_tindakan_lab",$id_tindakan_lab);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":harga_lab",$harga_lab);
			$query->bindparam(":hasil",$hasil);
			$query->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function create($tindakan_lab,$satuan,$harga,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO tindakan_lab(tindakan_lab,satuan,harga,created_by) VALUES (:tindakan_lab, :satuan, :harga, :created_by)");
			$query->bindparam(":tindakan_lab",$tindakan_lab);
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

	public function selectLab($query){
		$query = $this->db->prepare($query);
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_tindakan_lab]'>$row[tindakan_lab]</option>";
		}
		
	} 
	
	public function getID($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_reg WHERE reg_no=:reg_no");
		$query->execute(array(":reg_no"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function getLab($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_lab WHERE id_lab=:id_lab");
		$query->execute(array(":id_lab"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function updateLab($id_lab,$reg_no,$id_tindakan_lab,$harga_lab,$hasil)
	{
		try
		{
			$query=$this->db->prepare("UPDATE lab SET 	reg_no 			= :reg_no,
														id_tindakan_lab = :id_tindakan_lab,
														harga_lab 		= :harga_lab,
														hasil 			= :hasil
												WHERE 	id_lab			= :id_lab ");
			$query->bindparam(":id_lab",$id_lab);
			$query->bindparam(":id_tindakan_lab",$id_tindakan_lab);
			$query->bindparam(":reg_no",$reg_no);
			$query->bindparam(":harga_lab",$harga_lab);
			$query->bindparam(":hasil",$hasil);
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
		$query = $this->db->prepare("DELETE FROM lab WHERE id_lab=:id_lab");
		$query->bindparam(":id_lab",$id);
		$query->execute();
		return true; }
		catch(PDOException $e){
			echo 'Gagal'.$e->getMessage();
			return false;
		}
	}

	public function getDokter($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_edit_dokter WHERE reg_no=:reg_no");
		$query->execute(array(":reg_no"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
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
                	<td><div align="center"><?php print($no); ?></div></td>
	                <td><div align="center"><?php print($row['reg_no']); ?></div></td>
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"window.open('../simpus/lab/print_hasil.php?reg_no=$row[reg_no]','name','width=900,height=600')\" class='icon-print' > Print</a>";?>
	                </div></td>
	                
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"Lab('$row[reg_no]')\" >Detail</a>";?>
	                </div></td>
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
	
	public function viewhasil($query)
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
	                <td><div align="center"><?php print($no); ?></div></td>                
	                <td><?php print($row['tindakan_lab']); ?></td>
	                <td><div align="center"><?php print($row['hasil']); ?></div></td>	                
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

	public function viewkwitansi($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$harga = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
	                <td><div align="center"><?php print($no); ?></div></td>                
	                <td><?php print($row['tindakan_lab']); ?></td>
	                <td><div align="center"><?php print($row['harga_tindakan_lab']); ?></div></td>	                
                </tr>
                <?php
                $no++;
                $harga +=$row['harga_lab']; 
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

	public function total($query)
	{
		$query = $this->db->prepare($query);
		$query->execute();
		$no = 1;
		$harga = 0;
		if($query->rowCount()>0)
		{
			while($row=$query->fetch(PDO::FETCH_ASSOC))
			{
				$harga +=$row['harga_lab'];          
                
			} 
		}
		 echo "Rp. ".(number_format( $harga, 2 , ',', '.' ));
		
		 		
	}

	//=====================================================================================================================
	//============================================= View Laboratorium =====================================================

	public function viewLab($query)
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
                	<td><div align="center"><?php print($no); ?></div></td>                
	                <td><?php print($row['tindakan_lab']); ?></td>	                
	                <td><div align="center"><?php print($row['hasil']); ?></div></td>	
	                <td><?php print($row['harga_lab']); ?></td>
	                <td><div align="center">
	                <?php echo "          
	                <a href='javascript:void(0)' onclick=\"editLab('$row[id_lab]')\" ><i class='icon-pencil bigger-130'></i> Edit
	                <a href='javascript:void(0)' onclick=\"deleteLab('$row[id_lab]','$row[reg_no]')\" ><i class='icon-trash'></i> Hapus</a>
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
	
}
