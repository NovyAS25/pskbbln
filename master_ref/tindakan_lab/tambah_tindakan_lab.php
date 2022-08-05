<?php
session_start();
require_once '../../config/koneksi.php';
require_once 'class.tindakan_lab.php';
$tindakan_lab1 = new tindakan_lab($pdo);
if(!empty($_POST['tindakan_lab'])){
	$tindakan_lab				= $_POST['tindakan_lab'];
	$harga 					= str_replace(['Rp. ',',','.'],'', $_POST['harga']);
	$created_by 			= $_SESSION['s_user'];
	if($tindakan_lab1->create($tindakan_lab,$harga,$created_by)){
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
		<legend>Tambah Tindakan Laboratorium</legend>
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
			<div class="span6">
				<div class="control-group">
				<label class="control-label" for="tindakan_lab" >Tindakan Lab</label>
					<div class="controls">
					<input type="text" id="tindakan_lab" name="tindakan_lab" required>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="harga" >Harga</label>
					<div class="controls">
					<input type="text" id="harga" name="harga" >
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
		$('#harga').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
	});
</script>