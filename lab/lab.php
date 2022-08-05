<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("lab/data_lab.php");
		$("#id-breadcrumbs").html("Laboratorium");
	});
	//==========================================================================================================================
	//====================================================== Tambah Tindakan ============================================================
	//==========================================================================================================================
	function Lab(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"lab/laboratorium.php",
			data:"reg_no="+reg_no,
			beforeSend:function(){
				$("#form").html();
			},
			success:function(data){
				$('#form').html(data);
			}
		});
		$('#form').show("slow");
	}

	function TambahLab(reg_no){
		$.ajax({
			type:"GET",
			url:'lab/tambah_laboratorium.php',
			data:"reg_no="+reg_no,
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

	function editLab(id_lab){
		$.ajax({
			type:"GET",
			url:'lab/edit_lab.php',
			data:"id_lab="+id_lab,
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

	function deleteLab(id_lab,reg_no){
		var pilih = confirm('Hapus ID '+id_lab+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'lab/hapus_lab.php',
					data:"id_lab="+id_lab,
					success:function(){
						$.ajax({
							type:"GET",
							url:'lab/laboratorium.php',
							data:"reg_no="+reg_no,			
							success:function(data){
							  	$('#form').html(data);	
							}
						});					
					}
			});
		}
	}

//================================================================================================================
//================================================================================================================
//================================================================================================================
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"lab/tambah_lab.php",
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
				$("#data").load("lab/data_lab.php");
			}
		});
		return false;
	}
	
	function deleteData(id_tindakan_lab,tindakan_lab){
		var pilih = confirm('Hapus '+tindakan_lab+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'lab/hapus_lab.php',
					data:"id_tindakan_lab="+id_tindakan_lab,
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
	
	function editData(id_tindakan_lab){
		$.ajax({
			type:"GET",
			url:'lab/edit_lab.php',
			data:"id_tindakan_lab="+id_tindakan_lab,
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

	function TambahStok(id_tindakan_lab){
		$.ajax({
			type:"GET",
			url:'lab/tambah_stok.php',
			data:"id_tindakan_lab="+id_tindakan_lab,
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