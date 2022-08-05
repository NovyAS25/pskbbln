<div id="form" class="modal" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="javascript:void(0)" onclick="swapContent('apotik/trans_apotik/trans_apotik')">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</a>
				<h4 class="blue bigger">Resep</h4>
			</div>

			<div class="modal-body">
			<?php
			session_start();
			include_once '../../config/koneksi.php';
			include_once '../../config/fungsi_indotgl.php';
			include_once '../../poli/class.poli.php';
			?>
	        <table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th><div align="center">Obat</div></th>
						<th><div align="center">Qty</div></th>
						<th><div align="center">Satuan</div></th>
						<th><div align="center">Aksi</div></th>			
					</tr>
				</thead>
				<tbody>
					<?php
					$id = $_GET['reg_no'];
					$poli = new poli($pdo);
					$query = "SELECT * FROM v_resep where reg_no = '$id' ";
					$poli->viewResep($query);		
					?>
				</tbody>
			</table>

			<div class="modal-footer">
				
				<?php echo "
				<a href='javascript:void(0)' onclick=\"window.open('../simpus/poli/print_resep.php?reg_no=$id')\"  class='btn btn-primary'><i class='icon-print icon-white'></i> Print</a>
				<a href='javascript:void(0)' onclick='TambahResep($id)' class='btn btn-primary' ><i class='icon-plus icon-white'></i>Tambah</a> "; ?>
				<a href="javascript:void(0)" onclick="swapContent('apotik/trans_apotik/trans_apotik')" class="btn btn-primary"> Tutup</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

</script>