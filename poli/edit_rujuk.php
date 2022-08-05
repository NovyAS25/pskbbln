<?php
	session_start();
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	if(isset($_GET['rujuk_id']))
	    {
	      $id = $_GET['rujuk_id'];
	      extract($dok->getrujuk($id));  
	    }else{
	      $id = $_POST['rujuk_id'];
	      extract($dok->getrujuk($id));
	    }
	if(!empty($_POST['rujuk_id'])){
		$rujuk_id 		= $_POST['rujuk_id'];
		$reg_no 		= $_POST['reg_no'];
		$rujuk  		= $_POST['rujuk'];
		$alamat	 		= $_POST['alamat'];
		$keterangan		= $_POST['keterangan'];
 		if($dok->EditRujuk($rujuk_id,$reg_no,$rujuk,$alamat,$keterangan)){
			$sg   = "ok";
			$msg1 = "Data telah di Edit";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data tidak bisa di Edit";
			$alert='alert-error';
		}
	}
?><div id="form" class="modal" tabindex="-1" >
<div class="modal-dialog">

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<div class="modal-header">
        	<h4 class="blue bigger">Tambah Rujuk</h4>
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
			<label class="control-label" for="reg_no" >Reg No</label>
				<div class="controls">
				<input type="hidden" id="rujuk_id" name="rujuk_id" value="<?php echo $rujuk_id; ?>">
				<input type="text" id="reg_no" name="reg_no" value="<?php echo $reg_no; ?>" readonly="readonly">
				</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="rujuk" >Rujuk Ke</label>
				<div class="controls">
				<input type="text" id="rujuk" name="rujuk" value="<?php echo $rujuk; ?>">
				</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="alamat" >Alamat</label>
				<div class="controls">
				<input type="text" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
				</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="keterangan" >Keterangan</label>
				<div class="controls">
				<input type="text" id="keterangan" name="keterangan" value="<?php echo $keterangan; ?>">
				</div>
			</div>
													
		</div>
		<div class="modal-footer">
	      <button type="submit" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Edit</button>
	      <?php echo "
	        <a href='javascript:void(0)' onclick='Rujuk($reg_no)' class='btn btn-primary' ><i class='icon-close icon-white'></i>Tutup</a> "; ?>
    	</div>		
	</fieldset>
</form>
</div>
</div>
<script type="text/javascript">   
    
</script> 