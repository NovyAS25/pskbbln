<div id="form" class="modal" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="javascript:void(0)" onclick="swapContent('kasir/kasir')">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</a>
				<h4 class="blue bigger">Payment</h4>
			</div>

			<div class="modal-body">
			<?php
			session_start();

			include_once '../config/koneksi.php';
			include_once '../config/fungsi_indotgl.php';
			include_once 'class.kasir.php';
			$kasir = new kasir($pdo);
			if(isset($_GET['reg_no']))
		    {
		      $id = $_GET['reg_no'];
		      extract($kasir->getID($id));  
		    }else{
		      $id = $_POST['reg_no'];
		      extract($kasir->getID($id));
		    }
			?>
	        <table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th><div align="center">No Reg</div></th>
						<th><div align="center">Total Harga</div></th>
						<th><div align="center">Jumlah Bayar</div></th>			
						<th><div align="center">Kambalian</div></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "SELECT * FROM pay where reg_no = '$id' ";
						$kasir->viewpay($query);		
					?>
				</tbody>
			</table>
			<?php if($id_perusahaan_penjamin==1){ ?>
			<div class="modal-footer">
			 <div align="center"><strong>Pasien Menggunakan BPJS</strong></div>
			</div>
			<?php }else{ ?>
			<div class="modal-footer">				
				<?php if($poli=='LAB'){ echo "
				<a href='javascript:void(0)' onclick=\"window.open('../simpus/lab/kwitansi_lab.php?reg_no=$id')\"  class='btn btn-primary'><i class='icon-print icon-white'></i> Print</a>"; }else{
				 echo "<a href='javascript:void(0)' onclick=\"window.open('../simpus/poli/print_pay.php?reg_no=$id')\"  class='btn btn-primary'><i class='icon-print icon-white'></i> Print</a>
				" ; } ?> <?php if($kasir->ff($id)){echo ""; }else{echo "<a href='javascript:void(0)' onclick='Tambahpay($id)' class='btn btn-primary' >Pay</a>";}?>
				<a href="javascript:void(0)" onclick="swapContent('kasir/kasir')" class="btn btn-primary"> Tutup</a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">

</script>