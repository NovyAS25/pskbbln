<?php
session_start();
require_once '../../config/koneksi.php';
require_once 'class.perusahaan_penjamin.php';
$perusahaan_penjamin = new perusahaan_penjamin($pdo);
if(!empty($_POST['nama_perusahaan_penjamin'])){
	$nama_perusahaan_penjamin	= $_POST['nama_perusahaan_penjamin'];
	$alamat_perusahaan_penjamin	= $_POST['alamat_perusahaan_penjamin'];
	$telp_perusahaan_penjamin	= $_POST['telp_perusahaan_penjamin'];
	$aktif						= $_POST['aktif'];
	$created_by 				= $_SESSION['s_user'];
	if($perusahaan_penjamin->create($nama_perusahaan_penjamin,$alamat_perusahaan_penjamin,$telp_perusahaan_penjamin,$aktif,$created_by)){
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
		<legend>Tambah Perusahaan Penjamin</legend>
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
				<label class="control-label" for="nama_perusahaan_penjamin" >Nama</label>
					<div class="controls">
					<input type="text" id="nama_perusahaan_penjamin" name="nama_perusahaan_penjamin" required>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="alamat_perusahaan_penjamin" >Alamat</label>
					<div class="controls">
					<textarea class="span12" id="alamat_perusahaan_penjamin" name="alamat_perusahaan_penjamin" ></textarea>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="telp_perusahaan_penjamin" >Telp</label>
					<div class="controls">
					<input class="form-control input-mask-phone" name="telp_perusahaan_penjamin" type="text" id="form-field-mask-2" />
					</div>
				</div>
				<div class="control-group">
				<label class="control-label">Aktif</label>
					<div class="controls">
						<label>
							<input name="aktif" type="radio" value="Y" checked />
							<span class="lbl"> Y</span>
						</label>
						<label>
							<input name="aktif" type="radio" value="N" />
							<span class="lbl"> N</span>
						</label>
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
		$.mask.definitions['~']='[+-]';
		$('.input-mask-phone').mask('9999-9999-9999');
		$('.input-mask-nip').mask('999999999999999999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
	});
</script>