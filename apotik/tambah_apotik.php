<?php
session_start();
require_once '../config/koneksi.php';
require_once 'class.apotik.php';
$obat1 = new apotik($pdo);
if(!empty($_POST['obat'])){
	$obat		= $_POST['obat'];
	$satuan		= $_POST['satuan'];
	$harga 		= str_replace(['Rp. ',',','.'],'', $_POST['harga']);
	$created_by = $_SESSION['s_user'];
	if($obat1->create($obat,$satuan,$harga,$created_by)){
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

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Tambah obat</legend>
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
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
				<label class="control-label" for="obat" >Obat</label>
					<div class="controls">
					<input type="text" id="obat" name="obat" required>
					</div>
				</div>				
				<div class="control-group">
					<label class="control-label">Satuan</label>
					<div class="controls">
						<select name="satuan" id="satuan"  required class="chzn-select" data-placeholder="Pilih Satuan.............">
							<option ></option>
							<option value="Tablet">Tablet</option>
							<option value="Kapsul">Kapsul</option>	
							<option value="cc">mm</option>	
							<option value="cc">cc</option>
							<option value="Box">Box</option>
							<option value="Botol">Botol</option>
							<option value="Pcs">Pcs</option>								
						</select>
					</div>
				</div>	
				<div class="control-group">
				<label class="control-label" for="harga" > Harga Satuan Rp</label>
					<div class="controls">
					<input type="text" id="harga" name="harga" required>
					</div>
				</div>			
			</div>						
		</div>
		<div class="form-actions">
			<div class="controls">
			<button type="submit" class="btn btn-primary">Tambah</button>
			<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		
	</fieldset>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$("#close").click(function(){
			$("#form-nest").hide("slow");
		});
		$(".chzn-select").chosen();
		$('#spinner').ace_spinner({value:0,min:0,max:200,step:1, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
		.closest('.ace-spinner')
		.on('changed.fu.spinbox', function(){
			//alert($('#spinner').val())
		});
		$('#harga').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
	});
</script>