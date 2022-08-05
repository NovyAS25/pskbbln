<?php
session_start();
require_once '../config/koneksi.php';
require_once 'class.apotik.php';
$obat1 = new apotik($pdo);
if(!empty($_POST['id_obat'])){
	$id_obat 	= $_POST['id_obat'];
	$qty		= $_POST['qty'];
	if($obat1->createstok($id_obat,$qty)){
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
		<legend>Tambah Stok Obat</legend>
		<span>
		<?php
		if(isset($sg) and $sg=='ok'){
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg1
			</div>";
        	?>
        <div class="form-actions">
			<div class="controls">
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
			</div>
		</div>
		<?php }elseif(isset($sg) and $sg=='err')
		{
			echo "
			<div class='alert $alert'>
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			$msg2
			</div>"; 
		}
		else
		{
		if(isset($_GET['id_obat']))
		{
			$id = $_GET['id_obat'];
			extract($obat1->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
				<label class="control-label" for="obat" >Obat</label>
					<div class="controls">
					<input type="hidden" id="id_obat" name="id_obat" value="<?php echo $id_obat; ?>" required>
					<input type="text" id="obat" name="obat" value="<?php echo $obat; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Satuan</label>
					<div class="controls">
						<input type="text" id="satuan" name="satuan" value="<?php echo $satuan; ?>" readonly="readonly">
					</div>	
				</div>
				<div class="control-group">
				<label class="control-label" for="harga" > Harga Satuan Rp</label>
					<div class="controls">
					<input type="text" id="harga" name="harga" value="<?php echo $harga; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="harga">Qty</label>
					<div class="controls">
					<input type="text" id="spinner" class="spinner" name="qty" required>
					</div>
				</div>			
			</div>								
		</div>
		<div class="form-actions">
				<div class="controls-group">
				<button type="submit" class="btn btn-primary">Tambah</button>
				<button type="button" id="close" class="btn btn-primary" >Tutup</button>
				</div>
		</div>
		<?php 
		}
		?>		
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
	});	
</script>