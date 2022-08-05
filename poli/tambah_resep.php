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
		$id_obat 		= $_POST['id_obat'];
		$qty 	 		= $_POST['qty'];
		$satuan 		= $_POST['satuan'];
		$harga 			= $_POST['harga'] * $_POST['qty'];
 		if($dok->TambahResep($reg_no,$id_obat,$qty,$satuan,$harga)){
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
        	<h4 class="blue bigger">Tambah Resep</h4>
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
				<label class="control-label">Obat</label>
				<div class="controls">
					<select name="id_obat" id="id_obat" onchange="pilih2(this.value)" required>
						<option value=""></option>	
						<?php
							// ============== menggunakan Mysqli karena PDO belum bisa pakai JsArray ini ====================== //
							$jsArray2 	= "var dpa = new Array();\n";
							$link 		=  mysqli_connect('localhost','root','','simpus');
							$query 		= "SELECT * FROM obat";
							$data		=  mysqli_query($link, $query) ;
							while($row=mysqli_fetch_array($data)){
								echo "<option value='$row[id_obat]'>$row[obat]</option>";
								$jsArray2 .= "dpa['" . $row['id_obat'] . "'] = {name:'" . addslashes($row['harga'])."',name1:'" . addslashes($row['satuan'])."'};\n";
							}
						?>							
					</select>
				</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="qty">Qty</label>
				<div class="controls">
					<input type="text" id="spinner" class="spinner" name="qty" required>
				</div>
			</div>
			<div class="control-group">
			<label class="control-label" for="satuan">Satuan</label>
				<div class="controls">
					<input type="text" id="satuan" name="satuan" readonly="readonly">
				</div>
			</div>	
					<input type="hidden" id="harga" name="harga">
				
														
		</div>
		<div class="modal-footer">
	      <button type="submit" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</button>
	      <?php echo "
	        <a href='javascript:void(0)' onclick='Resep($id)' class='btn btn-primary' ><i class='icon-close icon-white'></i>Tutup</a> "; ?>
    	</div>		
	</fieldset>
</form>
</div>
</div>
<script type="text/javascript">   
    <?php echo $jsArray2; ?> 
    function pilih2(id){
		document.getElementById('harga').value=dpa[id].name;
		document.getElementById('satuan').value=dpa[id].name1;
	};
	$(document).ready(function(){
		$('#spinner').ace_spinner({value:0,min:0,max:200,step:1, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner').val())
		});
	});	
</script> 