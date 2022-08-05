<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("master_ref/tindakan_lab/data_tindakan_lab.php");
		$("#id-breadcrumbs").html("tindakan_lab");
	});

	function TindakanLab() {
		$("#data").load("master_ref/tindakan_lab/data_tindakan_lab.php");
		$("#id-breadcrumbs").html("tindakan_lab");
	}
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"master_ref/tindakan_lab/tambah_tindakan_lab.php",
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
				$("#data").load("master_ref/tindakan_lab/data_tindakan_lab.php");
			}
		});
		return false;
	}
	
	function deleteData(id,tindakan_lab){
		var pilih = confirm('Hapus '+tindakan_lab+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'master_ref/tindakan_lab/hapus_tindakan_lab.php',
					data:"id_tindakan_lab="+id,
					beforeSend:function(){
						$("#data").html("<img src='assets/images/ajax-loader.gif' />");
					},
					success:function(data){
						$('#data').html(data);
						$('#alert').load("master_ref/tindakan_lab/alert_error.php");
					},
					error:function(data){
						$('#data').html(data);
						$('#alert').load("master_ref/tindakan_lab/alert_error.php");
					}
				});
		}
	}
	
	function editData(id){
		$.ajax({
			type:"GET",
			url:'master_ref/tindakan_lab/edit_tindakan_lab.php',
			data:"id_tindakan_lab="+id,
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