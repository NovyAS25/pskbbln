<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("apotik/data_apotik.php");
		$("#id-breadcrumbs").html("Obat");
	});
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"apotik/tambah_apotik.php",
			data:null,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').show("slow");
	}
	
	function submitForm(url){
		var thisPost = $("#forms").serialize();
		$.ajax({
			type:"POST",
			url:url,
			data:thisPost,
			beforeSend:function(){
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
				$("#data").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
				$("#data").load("apotik/data_apotik.php");
			}
		});
		return false;
	}
	
	function deleteData(id_obat,obat){
		var pilih = confirm('Hapus '+obat+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'apotik/hapus_apotik.php',
					data:"id_obat="+id_obat,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
					},
					error:function(data){
						$('#data').html(data);
					}
				});
		}
	}
	
	function editData(id_obat){
		$.ajax({
			type:"GET",
			url:'apotik/edit_apotik.php',
			data:"id_obat="+id_obat,
			beforeSend:function(){
				$("#form-nest").css({display:"block"});
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').fadeIn(3000);
	}

	function TambahStok(id_obat){
		$.ajax({
			type:"GET",
			url:'apotik/tambah_stok.php',
			data:"id_obat="+id_obat,
			beforeSend:function(){
				$("#form-nest").css({display:"block"});
				$("#form").html("<img src='assets/images/ajax-loader.gif' />");
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').fadeIn(3000);
	}
	
	
</script>


<div id="form-nest" class="row-fluid" style="display:none">
	<div id="form" class="span12 well">
		
	</div>
</div>

<div class="row-fluid">
	<div id="data" class="span12 well">
		<img src='assets/images/ajax-loader.gif' />
	</div>
</div>