<?php
	session_start();
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	if(isset($_GET['rujuklab_id']))
	    {
	      $id = $_GET['rujuklab_id'];
	      extract($dok->getrujuklab($id));  
	    }else{
	      $id = $_POST['rujuklab_id'];
	      extract($dok->getrujuklab($id));
	    }
	if(!empty($_POST['rujuklab_id'])){
		$rujuklab_id 	= $_POST['rujuklab_id'];
		$reg_no 		= $_POST['reg_no'];
		$id_tindakan_lab= $_POST['id_tindakan_lab'];
		$harga 			= $_POST['harga'];
 		if($dok->EditRujuklab($rujuklab_id,$reg_no,$id_tindakan_lab,$harga)){
			$sg   = "ok";
			$msg1 = "Data telah di Edit";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data tidak bisa di Edit";
			$alert='alert-error';
		}
	}
?>
<div id="form" class="modal" tabindex="-1" >
<div class="modal-dialog">

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<div class="modal-header">
        	<h4 class="blue bigger">Edit Rujuk LAB</h4>
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
			<label class="control-label" for="reg_no" >ID</label>
				<div class="controls">
				<input type="text" id="rujuklab_id" name="rujuklab_id" value="<?php echo $rujuklab_id; ?>" readonly='readonly'>
				<input type="hidden" id="reg_no" name="reg_no" value="<?php echo $reg_no; ?>" readonly="readonly">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Tindakan LAB</label>
				<div class="controls">
					<select name="id_tindakan_lab" id="id_tindakan_lab" onchange="pilih2(this.value)">
						<option value="<?php echo $id_tindakan_lab; ?>"><?php echo $tindakan_lab; ?></option>	
						<?php
							// ============== menggunakan Mysqli karena PDO belum bisa pakai JsArray ini ====================== //
							$jsArray2 	= "var dpa = new Array();\n";
							$link 		=  mysqli_connect('localhost','root','','simpus');
							$query 		= "SELECT id_tindakan_lab,tindakan_lab,harga_tindakan_lab FROM tindakan_lab";
							$data		=  mysqli_query($link, $query) ;
							while($row=mysqli_fetch_array($data)){
								echo "<option value='$row[id_tindakan_lab]'>$row[tindakan_lab]</option>";
								$jsArray2 .= "dpa['" . $row['id_tindakan_lab'] . "'] = {name:'" . addslashes($row['harga_tindakan_lab'])."'};\n";
							}
						?>							
					</select>
				</div>
			</div>	
					<input type="hidden" id="harga" name="harga" value="<?php echo $harga; ?>" readonly="readonly">
															
		</div>
		<div class="modal-footer">
	      <button type="submit" id="submit" class="btn btn-primary"><i class="icon-pencil icon-white"></i>Edit</button>
	      <?php echo "
	        <a href='javascript:void(0)' onclick='RujukLAB($reg_no)' class='btn btn-primary' ><i class='icon-close icon-white'></i>Tutup</a> ";  ?>
    	</div>		
	</fieldset>
</form>
</div>
</div>
<script type="text/javascript">   
    <?php echo $jsArray2; ?> 
    function pilih2(id){
		document.getElementById('harga').value=dpa[id].name;
	};
</script> 