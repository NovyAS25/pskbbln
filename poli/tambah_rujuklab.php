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
		$id_tindakan_lab= $_POST['id_tindakan_lab'];
		$harga 			= $_POST['harga'];
 		if($dok->TambahTindakanLab($reg_no,$id_tindakan_lab,$harga)){
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
        	<h4 class="blue bigger">Tambah Tindakan LAB</h4>
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
				<input type="text" id="reg_no" name="reg_no" value="<?php echo $reg_no; ?>" readonly="readonly">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Tindakan</label>
				<div class="controls">
					<select name="id_tindakan_lab" id="id_tindakan_lab" onchange="pilih2(this.value)">
						<option value=""></option>	
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
					<input type="hidden" id="harga" name="harga">										
		</div>
		<div class="modal-footer">
	      <button type="submit" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</button>
	      <?php echo "
	        <a href='javascript:void(0)' onclick='RujukLAB($id)' class='btn btn-primary' ><i class='icon-close icon-white'></i>Tutup</a> "; ?>
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