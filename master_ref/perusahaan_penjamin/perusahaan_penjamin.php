<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("master_ref/perusahaan_penjamin/data_perusahaan_penjamin.php");
		$("#id-breadcrumbs").html("perusahaan_penjamin");
	});

	function perusahaan_penjamin(){
		$("#data").load("master_ref/perusahaan_penjamin/data_perusahaan_penjamin.php");
		$("#id-breadcrumbs").html("perusahaan_penjamin");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"master_ref/perusahaan_penjamin/tambah_perusahaan_penjamin.php",
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
				$("#data").load("master_ref/perusahaan_penjamin/data_perusahaan_penjamin.php");
			}
		});
		return false;
	}
	
	function deleteData(id,perusahaan_penjamin){
		var pilih = confirm('Hapus '+perusahaan_penjamin+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'master_ref/perusahaan_penjamin/hapus_perusahaan_penjamin.php',
					data:"id_perusahaan_penjamin="+id,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$('#alert').load("master_ref/perusahaan_penjamin/alert_error.php");
					},
					error:function(data){
						$('#data').html(data);
						$('#alert').load("master_ref/perusahaan_penjamin/alert_error.php");
					}
				});
		}
	}
	
	function editData(id){
		$.ajax({
			type:"GET",
			url:'master_ref/perusahaan_penjamin/edit_perusahaan_penjamin.php',
			data:"id_perusahaan_penjamin="+id,
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