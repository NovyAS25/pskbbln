<?php
	session_start();
	require_once '../config/koneksi.php';
	require_once 'class.kasir.php';
	$kasir = new kasir($pdo);
	if(isset($_GET['reg_no']))
	    {
	      $id = $_GET['reg_no'];
	      extract($kasir->getID($id));  
	    }else{
	      $id = $_POST['reg_no'];
	      extract($kasir->getID($id));
	    }

	if(!empty($_POST['reg_no'])){
		$reg_no 		= $_POST['reg_no'];
		$total 			= $_POST['total'];
		$jumlah_bayar	= str_replace(['Rp. ',',','.'],'', $_POST['harga']); 
		$kembalian 		= $total - $jumlah_bayar;
 		if($kasir->createpay($reg_no,$total,$jumlah_bayar,$kembalian)){
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
        	<h4 class="blue bigger">Tambah PAY</h4>
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
				<label class="control-label" for="total" >Total Harga</label>
				<div class="controls">
					<input type="text" id="total1" name="total1" value="<?php if($poli=='LAB'){$kasir->jumlah2($id);}else{$kasir->jumlah($id);} ?>" readonly="readonly">
					<input type="hidden" id="total" name="total" value="<?php if($poli=='LAB'){$kasir->jumlah3($id);}else{$kasir->jumlah1($id);} ?>" readonly="readonly">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="bayar" >Bayar</label>
				<div class="controls">
					<input type="text" id="harga" name="harga" required>
				</div>
			</div>	
															
		</div>
		<div class="modal-footer">
	      <?php if(!isset($_POST['harga'])) { echo " <button type='submit' class='btn btn-primary' ></i>Pay</button>"; }?>
	      <?php echo "
	        <a href='javascript:void(0)' onclick='pay($id)' class='btn btn-primary' ><i class='icon-close icon-white'></i>Tutup</a> "; ?>
    	</div>		
	</fieldset>
</form>
</div>
</div>
<script type="text/javascript">   
	$(document).ready(function(){
		$('#harga').maskMoney({prefix:'Rp. ', thousands:'.', decimal:',', precision:0});
	});
</script> 