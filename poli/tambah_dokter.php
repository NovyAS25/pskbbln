<?php
	session_start();
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	if(isset($_GET['reg_no']))
	    {
	      $id = $_GET['reg_no'];
	      extract($dok->getID($id));  
	    }else{
	      $id = $_POST['reg_no'];
	      extract($dok->getID($id));
	    }
	if(!empty($_POST['reg_no'])){
		$reg_no 		= $_POST['reg_no'];
		$id_dokter		= $_POST['id_dokter'];
		$diagnosa_dokter= $_POST['diagnosa_dokter'];
 		if($dok->TambahDokter($reg_no,$id_dokter,$diagnosa_dokter)){
			$sg   = "ok";
			$msg1 = "Data telah ditambahkan";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data tidak bisa dimasukan";
			$alert='alert-error';
		}
	}
?>
<div id="form" class="modal" tabindex="-1" >
<div class="modal-dialog">

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<div class="modal-header">
        	<button type="button" class="close" id="close1" data-dismiss="modal">&times;</button>
        	<h4 class="blue bigger">Tambah Dokter & Diagnosa</h4>
     	 </div>
		<span>
     <?php
    if(isset($sg) and $sg=='ok'){
      echo "
      <div class='alert $alert'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      $msg1
      </div>";
    }elseif(isset($sg) and $sg=='err'){
      echo "
      <div class='alert $alert'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      $msg2
      </div>";}
    ?>
    </span>
		 <div class="modal-content">
			<div class="control-group">
			<label class="control-label" for="obat" >Reg No</label>
				<div class="controls">
				<input type="text" id="reg_no" name="reg_no" value="<?php echo $reg_no; ?>" readonly="readonly">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Dokter</label>
				<div class="controls">
					<select name="id_dokter" id="id_dokter">
						<option value=""></option>	
						<?php 
							$query = "SELECT * FROM dokter";
							$dok->selectDokter($query);
						?>							
					</select>
				</div>
			</div>	
			<div class="control-group">
			<label class="control-label" for="diagnosa" > Diagnosa</label>
				<div class="controls">
				<input type="text" id="diagnosa_dokter" name="diagnosa_dokter">
				</div>
			</div>											
		</div>
		<div class="modal-footer">
	      <button type="submit" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</button>
	      <?php echo "
	        <a href='javascript:void(0)' onclick='Dokter($id)' class='btn btn-primary' ><i class='icon-close icon-white'></i>Tutup</a> "; ?>
    	</div>		
	</fieldset>
</form>
</div>
</div>