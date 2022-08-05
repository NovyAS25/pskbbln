<?php

class pasien
{
	private $db;
	
	function __construct($pdo)
	{
		$this->db = $pdo;
	}
	
	public function create($nama,$tempat_lahir,$tgl_lahir,$alamat,$id_prov,$id_kab,$id_kec,$id_kel,$jenis_kelamin,$tlp,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO pasien(nama,tempat_lahir,tgl_lahir,alamat,id_prov,id_kab,id_kec,id_kel,jenis_kelamin,tlp,created_by) VALUES (:nama, :tempat_lahir, :tgl_lahir, :alamat, :id_prov, :id_kab, :id_kec, :id_kel, :jenis_kelamin, :tlp, :created_by)");
			$query -> bindparam(":nama",$nama);
			$query -> bindparam(":tempat_lahir",$tempat_lahir);
			$query -> bindparam(":tgl_lahir",$tgl_lahir);
			$query -> bindparam(":alamat",$alamat);
			$query -> bindparam(":id_prov",$id_prov);
			$query -> bindparam(":id_kab",$id_kab);
			$query -> bindparam(":id_kec",$id_kec);
			$query -> bindparam(":id_kel",$id_kel);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":tlp",$tlp);
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

	public function createreg($mr,$poli,$tgl_reg,$penjamin,$diagnosa,$created_by)
	{
		try
		{
			$query = $this->db->prepare("INSERT INTO reg(mr,poli,tgl_reg,id_perusahaan_penjamin,diagnosa,created_by) VALUES (:mr, :poli, :tgl_reg, :penjamin, :diagnosa, :created_by)");
			$query -> bindparam(":mr",$mr);
			$query -> bindparam(":poli",$poli);
			$query -> bindparam(":tgl_reg",$tgl_reg);
			$query -> bindparam(":penjamin",$penjamin);
			$query -> bindparam(":diagnosa",$diagnosa);
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
	
	public function update($mr,$nama,$tempat_lahir,$tgl_lahir,$alamat,$id_prov,$id_kab,$id_kec,$id_kel,$jenis_kelamin,$tlp,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE pasien SET 	nama 			= :nama,
															tempat_lahir 	= :tempat_lahir,
															tgl_lahir 		= :tgl_lahir,
 															alamat 			= :alamat,
 															id_prov 		= :id_prov,
 															id_kab 			= :id_kab,
 															id_kec 			= :id_kec,
 															id_kel 			= :id_kel,
 															jenis_kelamin 	= :jenis_kelamin,
															tlp 			= :tlp,
													   		update_by 		= :update_by
													WHERE 	mr				= :mr ");
			$query -> bindparam(":mr",$mr);
			$query -> bindparam(":nama",$nama);
			$query -> bindparam(":tempat_lahir",$tempat_lahir);
			$query -> bindparam(":tgl_lahir",$tgl_lahir);
			$query -> bindparam(":alamat",$alamat);
			$query -> bindparam(":id_prov",$id_prov);
			$query -> bindparam(":id_kab",$id_kab);
			$query -> bindparam(":id_kec",$id_kec);
			$query -> bindparam(":id_kel",$id_kel);
			$query -> bindparam(":jenis_kelamin",$jenis_kelamin);
			$query -> bindparam(":tlp",$tlp);
			$query -> bindparam(":update_by",$update_by);
			$query -> execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}

	public function updatereg($reg_no,$mr,$poli,$tgl_reg,$penjamin,$diagnosa,$update_by)
	{
		try
		{
			$query=$this->db->prepare("UPDATE reg  SET 	mr 						= :mr,
															poli 		 			= :poli,
															tgl_reg 				= :tgl_reg,
 															id_perusahaan_penjamin 	= :id_perusahaan_penjamin,
 															diagnosa 				= :diagnosa,
 															update_by 				= :update_by
													WHERE 	reg_no					= :reg_no ");
			$query -> bindparam(":reg_no",$reg_no);
			$query -> bindparam(":mr",$mr);
			$query -> bindparam(":poli",$poli);
			$query -> bindparam(":tgl_reg",$tgl_reg);
			$query -> bindparam(":id_perusahaan_penjamin",$penjamin);
			$query -> bindparam(":diagnosa",$diagnosa);
			$query -> bindparam(":update_by",$update_by);
			$query -> execute();
			
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
		$query = $this->db->prepare("SELECT * FROM v_pasien WHERE mr=:mr");
		$query->execute(array(":mr"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function getEditReg($id)
	{
		$query = $this->db->prepare("SELECT * FROM v_reg WHERE mr=:mr");
		$query->execute(array(":mr"=>$id));
		$editRow=$query->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}

	public function delete($id)
	{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM pasien WHERE mr=:mr");
		$query->bindparam(":mr",$id);
		$query->execute();
		return true;
	}

	public function deleteRegistrasi($id)
	{
		// code untuk hapus
		$query = $this->db->prepare("DELETE FROM reg WHERE reg_no=:reg_no");
		$query->bindparam(":reg_no",$id);
		$query->execute();
		return true;
	}

	public function prov(){
		$query = $this->db->prepare(" SELECT * FROM wilayah_provinsi ORDER BY nama_prov ");
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_prov]'>$row[nama_prov]</option>";
		}
		
	}

	public function kabupaten($query){
		$query = $this->db->prepare($query);
		$query->execute();
		echo "<option>-- Pilih Kabupaten --</option>";
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_kab]'>$row[nama_kab]</option>";
		}
		
	}

	public function kecamatan($query){
		$query = $this->db->prepare($query);
		$query->execute();
		echo "<option>-- Pilih Kecamatan --</option>";
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_kec]'>$row[nama_kec]</option>";
		}
		
	}

	public function kelurahan($query){
		$query = $this->db->prepare($query);
		$query->execute();
		echo "<option>-- Pilih Kelurahan --</option>";
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_kel]'>$row[nama_kel]</option>";
		}
		
	}

	public function penjamin(){
		$query = $this->db->prepare("SELECT * FROM perusahaan_penjamin WHERE aktif = 'Y' ORDER BY nama_perusahaan_penjamin");
		$query->execute();
		while($row=$query->fetch(PDO::FETCH_ASSOC)){
			echo "<option value='$row[id_perusahaan_penjamin]'>$row[nama_perusahaan_penjamin]</option>";
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
                <td><div align="center"><?php print($row['mr']); ?></div></td>
                <td><?php print($row['nama']); ?></td>
                <td><?php print($row['tempat_lahir'].", " .tgl_indo($row['tgl_lahir'])); ?></td>            
                <td><?php print($row['alamat'].", Kel. ". $row['nama_kel']. ", kec. " . $row['nama_kec']. ", ". $row['nama_kab']. " - " . $row['nama_prov']); ?></td>
                <td><?php print($row['jenis_kelamin']); ?></td>
                <td><?php print($row['tlp']); ?></td>
                <td><?php echo " 
                <a href='javascript:void(0)' onclick=\"registrasi('$row[mr]')\" ><i class='icon-inbox bigger-130'></i> Registrasi</a> </td> "; ?>
                <td><div align="center">
                <?php echo "               
                <a href='javascript:void(0)' onclick=\"editData('$row[mr]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
                <a href='javascript:void(0)' onclick=\"deleteData('$row[mr]','$row[nama]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
                ";?>
                </div>
                </td>
                </tr>
                <?php
                $no++;
			} ?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#tabeldata1').dataTable( {
						"iDisplayLength": 5,
	                    "aLengthMenu": [5, 10, 25, 50, 100 ],						
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
	
	public function viewreg($query)
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
	                <td><div align="center"><?php print($row['mr']); ?></div></td>
	                <td><?php print($row['poli']); ?></td>
	                <td><?php print($row['diagnosa']); ?></td>
	                <td><?php print($row['nama']); ?></td>
	                <td><?php print($row['tempat_lahir'].", " .tgl_indo($row['tgl_lahir'])); ?></td>            
	                <td><?php print($row['alamat'].", Kel. ". $row['nama_kel']. ", kec. " . $row['nama_kec']. ", ". $row['nama_kab']. " - " . $row['nama_prov']); ?></td>
	                <td><?php print($row['jenis_kelamin']); ?></td>
	            
	                <td><div align="center">
	                <?php echo "               
	                <a href='javascript:void(0)' onclick=\"editRegistrasi('$row[mr]')\" ><i class='icon-trash icon-pencil bigger-130'></i> </a>
	                <a href='javascript:void(0)' onclick=\"deleteRegistrasi('$row[reg_no]','$row[nama]')\" ><i class='icon-trash icon-red bigger-130'></i> </a>
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
						"iDisplayLength": 5,
	                    "aLengthMenu": [5, 10, 25, 50, 100 ],
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
	                <td><div align="center"><?php print($row['mr']); ?></div></td>
	                <td><?php print($row['nama']); ?></td>
	                <td><?php print($row['tempat_lahir'].", " .tgl_indo($row['tgl_lahir'])); ?></td>            
	                <td><?php print($row['alamat'].", Kel. ". $row['nama_kel']. ", kec. " . $row['nama_kec']. ", ". $row['nama_kab']. " - " . $row['nama_prov']); ?></td>
	                <td><?php print($row['jenis_kelamin']); ?></td>
	                <td><?php print($row['tlp']); ?></td>
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

	public function PrinReg($query)
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
	                <td><div align="center"><?php print($row['mr']); ?></div></td>
	                <td><?php print($row['poli']); ?></td>
	                <td><?php print($row['diagnosa']); ?></td>
	                <td><?php print($row['nama']); ?></td>
	                <td><?php print($row['tempat_lahir'].", " .tgl_indo($row['tgl_lahir'])); ?></td>            
	                <td><?php print($row['alamat'].", Kel. ". $row['nama_kel']. ", kec. " . $row['nama_kec']. ", ". $row['nama_kab']. " - " . $row['nama_prov']); ?></td>
	                <td><?php print($row['jenis_kelamin']); ?></td>
	                <td><?php print(tgl_indo($row['tgl_reg'])); ?></td>
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
