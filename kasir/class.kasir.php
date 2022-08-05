<?php

class kasir
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function createpay($reg_no,$total,$jumlah_bayar,$kembalian)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO pay(reg_no,total,jumlah_bayar,kembalian) VALUES (:1, :2, :3, :4)");
			$query->bindparam(":1",$reg_no);
			$query->bindparam(":2",$total);
			$query->bindparam(":3",$jumlah_bayar);
			$query->bindparam(":4",$kembalian);
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

	

	public function jumlah($id)
	{
		$query	= "SELECT sum(harga_tindakan) AS harga FROM poli WHERE reg_no = $id ";
		$query 	= $this->db->prepare($query);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		$r=$result->harga;

		$query1	= "SELECT sum(harga_obat) AS harga_obat FROM resep WHERE reg_no = $id ";
		$query1	= $this->db->prepare($query1);
		$query1->execute();
		$result1 = $query1->fetch(PDO::FETCH_OBJ);
		$r1=$result1->harga_obat;

		$query2	= "SELECT sum(qty_resep) AS qty FROM resep WHERE reg_no = $id ";
		$query2	= $this->db->prepare($query2);
		$query2->execute();
		$result2 = $query2->fetch(PDO::FETCH_OBJ);
		$r2=$result2->qty;
		$r3= $r1 * $r2;
		$tot = $r3 + $r;
		echo 'Rp. '. number_format($tot , 2 , ',', '.' );
	}

	public function jumlah2($id)
	{
		$query	= "SELECT sum(harga_lab) AS harga FROM lab WHERE reg_no = $id ";
		$query 	= $this->db->prepare($query);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		$r=$result->harga;
		echo 'Rp. '. number_format($r, 2 , ',', '.' );
	}

	public function jumlah3($id)
	{
		$query	= "SELECT sum(harga_lab) AS harga FROM lab WHERE reg_no = $id ";
		$query 	= $this->db->prepare($query);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		$r=$result->harga;
		echo $r;
	}

	public function jumlah1($id)
	{
		$query	= "SELECT sum(harga_tindakan) AS harga FROM poli WHERE reg_no = $id ";
		$query 	= $this->db->prepare($query);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		$r=$result->harga;

		$query1	= "SELECT sum(harga_obat) AS harga_obat FROM resep WHERE reg_no = $id ";
		$query1	= $this->db->prepare($query1);
		$query1->execute();
		$result1 = $query1->fetch(PDO::FETCH_OBJ);
		$r1=$result1->harga_obat;

		$query2	= "SELECT sum(qty_resep) AS qty FROM resep WHERE reg_no = $id ";
		$query2	= $this->db->prepare($query2);
		$query2->execute();
		$result2 = $query2->fetch(PDO::FETCH_OBJ);
		$r2=$result2->qty;
		$r3= $r1 * $r2;
		echo $tot = $r3 + $r;
	}

	public function ff($id)
	{
		$query = "SELECT kembalian FROM pay WHERE reg_no = $id ";
		$query = $this->db->prepare($query);
		$query->execute();
		if($query->rowCount()>0){
			return true;
		}	

	}
	
	public function viewkasir($query)
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
	                <td><div align="center">
	                <?php echo " 
	                <a href='javascript:void(0)' onclick=\"pay('$row[reg_no]')\" class='btn btn-small'>PAY</a></div></td> "; ?>
	                <td><div align="center"><?php print($row['reg_no']); ?></div></td>
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
	
	public function viewpay($query)
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
	                <td><?php print("Rp. ".number_format( $row['total'] , 2 , ',', '.' )); ?></td>		                
	                <td><?php print("Rp. ".number_format( $row['jumlah_bayar'] , 2 , ',', '.' )); ?></td>		                
	                <td><?php $r=$row['jumlah_bayar']-$row['total']; print("Rp. ".number_format( $r , 2 , ',', '.' )); ?></td>	                
                	
                </tr>
                <?php
                $no++;
			} 
		}
		else
		{
			?>
            <tr>
           		<td colspan="4"><strong>Tidak ada data...!!</strong></td>
            </tr>
            <?php
		}		
	}
	
}
