<?php 
	session_start();
	include_once '../../config/koneksi.php';
	require_once 'class.tindakan_lab.php';
	$tindakan_lab1 = new tindakan_lab($pdo);
	if(!empty($_POST['id_tindakan_lab'])){
		$id_tindakan_lab 	= $_POST['id_tindakan_lab'];	
		$tindakan_lab		= $_POST['tindakan_lab'];
		$harga 			= str_replace(['Rp. ',',','.'],'', $_POST['harga']);
		$update_by		= $_SESSION['s_user'];
		if($tindakan_lab1->update($id_tindakan_lab,$tindakan_lab,$harga,$update_by)){
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
		<legend>Edit Tindakan Laboratorium</legend>
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
		if(isset($_GET['id_tindakan_lab']))
		{
			$id = $_GET['id_tindakan_lab'];
			extract($tindakan_lab1->getID($id));	
		} 
		?>
		</span>
		<div class="row-fluid">
			<div class="span5">
				<div class="control-group">
				<label class="control-label" for="id_tindakan_lab" >ID</label>
					<div class="controls">
					<input type="text" id="id_tindakan_lab" name="id_tindakan_lab" value="<?php echo $id_tindakan_lab; ?>" readonly="readonly">
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="tindakan_lab" >Tindakan Lab</label>
					<div class="controls">
					<input type="text" id="tindakan_lab" name="tindakan_lab" value="<?php echo $tindakan_lab; ?>" required>
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="harga" >Harga</label>
					<div class="controls">
					<input type="text" id="harga" name="harga" value="<?php echo $harga_tindakan_lab; ?>">
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