<?php 
	session_start();
	include_once '../../config/koneksi.php';
	require_once 'class.tindakan.php';
	$tindakan1 = new tindakan($pdo);
	if(!empty($_POST['id_tindakan'])){
		$id_tindakan 	= $_POST['id_tindakan'];	
		$tindakan		= $_POST['tindakan'];
		$harga 			= str_replace(['Rp. ',',','.'],'', $_POST['harga']);
		echo $harga;
		$update_by		= $_SESSION['s_user'];
		if($tindakan1->update($id_tindakan,$tindakan,$harga,$update_by)){
			$sg   = "ok";
			$msg1 = "Data Berhasil Di Update";
			$alert='alert-success';
		}else{
			$g = "err";
			$msg2 = "Data Gagal Di Update";
			$alert='alert-error';
		}
	}
?>

<form id="forms" method="post" onSubmit="return submitForm('<?php echo $_SERVER['PHP_SELF']; ?>')" class="form-horizontal">
	<fieldset>
		<legend>Edit Tindakan</legend>
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
		if(isset($_GET['id_tindakan']))
		{
			$id = $_GET['id_tindakan'];
			extract($tindakan1->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
				<label class="control-label" for="id_tindakan" >ID</label>
					<div class="controls">
					<input type="text" id="id_tindakan" name="id_tindakan" value="<?php echo $id_tindakan; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="tindakan" >Tindakan</label>
					<div class="controls">
					<input type="text" id="tindakan" name="tindakan" value="<?php echo $tindakan; ?>" required>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="harga" >harga</label>
					<div class="controls">
					<input type="text" id="harga" name="harga" value="<?php echo $harga; ?>" >
					</div>
				</div>
			</div>
		</div>
			<div class="form-actions">
				<div class="span5">
					<div class="controls-group">
					<button type="submit" class="btn btn-primary">Edit</button>
					<button type="button" id="close" class="btn btn-primary" >Tutup</button>
					</div>
				</div>
				<div class="span6">
					<div class="control-group">
						<label class="control">Data Input :<?php echo "$created_by"; echo " - "; echo "$created_at"; ?> </label>
						<label class="control">Data Update :<?php echo "$update_by"; echo " - "; echo "$update_at"; ?> </label>
					</div>
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
		$('#harga').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
	});	
</script>