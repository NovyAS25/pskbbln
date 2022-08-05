<div id="form" class="modal" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a href="javascript:void(0)" onclick="swapContent('lab/lab')">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				</a>
				<h4 class="blue bigger">List Tindakan Lab</h4>
			</div>

			<div class="modal-body">
			<?php
			session_start();
			include_once '../config/koneksi.php';
			include_once '../config/fungsi_indotgl.php';
			include_once 'class.lab.php';
			?>
	        <table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th><div align="center">No.</div></th>						
						<th><div align="center">Tindakan</div></th>
						<th><div align="center">Hasil</div></th>
						<th><div align="center">Harga</div></th>
						<th><div align="center">Aksi</div></th>			
					</tr>
				</thead>
				<tbody>
					<?php
					$id = $_GET['reg_no'];
					$lab = new lab($pdo);
					$query = "SELECT * FROM v_lab where reg_no = $id ";
					$lab->viewLab($query);		
					?>
				</tbody>
			</table>

			<div class="modal-footer">
				
				<?php echo "
				<a href='javascript:void(0)' onclick='TambahLab($id)' class='btn btn-primary' ><i class='icon-plus icon-white'></i>Tambah</a> "; ?>
				<a href="javascript:void(0)" onclick="swapContent('lab/lab')" class="btn btn-primary"> Tutup</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

</script>