<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("poli/data_poli.php");
		$("#id-breadcrumbs").html("Poli");
	});
//============================================================ DOKTER ====================================================================
	function Dokter(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poli/dokter.php",
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

	function TambahDokter(reg_no){
		$.ajax({
			type:"GET",
			url:'poli/tambah_dokter.php',
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

	function editDokter(reg_no){
		$.ajax({
			type:"GET",
			url:'poli/edit_dokter.php',
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

	function deleteDokter(id_tindakan_poli,reg_no){
		var pilih = confirm('Hapus ID '+id_tindakan_poli+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poli/hapus_dokter.php',
					data:"id_tindakan_poli="+id_tindakan_poli,
					success:function(){
						$.ajax({
							type:"GET",
							url:'poli/dokter.php',
							data:"reg_no="+reg_no,			
							success:function(data){
							  	$('#form').html(data);	
							}
						});					
					}
			});
		}
	}

//========================================================= Rujuk LAB ============================================================
	function RujukLAB(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poli/rujuklab.php",
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

	function TambahRujukLAB(reg_no){
		$.ajax({
			type:"GET",
			url:'poli/tambah_rujuklab.php',
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

	function editRujukLAB(rujuklab_id){
		$.ajax({
			type:"GET",
			url:'poli/editRujukLAB.php',
			data:"rujuklab_id="+rujuklab_id,
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

	function deleteRujukLAB(rujuklab_id,reg_no){
		var pilih = confirm('Hapus ID '+rujuklab_id+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poli/hapus_rujuklab.php',
					data:"rujuklab_id="+rujuklab_id,
					success:function(){
						$.ajax({
							type:"GET",
							url:'poli/rujuklab.php',
							data:"reg_no="+reg_no,			
							success:function(data){
							  	$('#form').html(data);	
							}
						});					
					}
			});
		}
	}
//========================================================= TINDAKAN =====================================================================
	function Tindakan(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poli/tindakan.php",
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

	function Tambahtindakan(reg_no){
		$.ajax({
			type:"GET",
			url:'poli/tambah_tindakan.php',
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

	function editTindakan(poli_id){
		$.ajax({
			type:"GET",
			url:'poli/edit_tindakan.php',
			data:"poli_id="+poli_id,
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

	function deleteTindakan(poli_id,reg_no){
		var pilih = confirm('Hapus ID '+poli_id+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poli/hapus_tindakan.php',
					data:"poli_id="+poli_id,
					success:function(){
						$.ajax({
							type:"GET",
							url:'poli/tindakan.php',
							data:"reg_no="+reg_no,			
							success:function(data){
							  	$('#form').html(data);	
							}
						});					
					}
			});
		}
	}

	//======================================================= Rujuk =================================================================
	function Rujuk(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poli/rujuk.php",
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

	function TambahRujuk(reg_no){
		$.ajax({
			type:"GET",
			url:'poli/tambah_rujuk.php',
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

	//======================================================= RESEP =================================================================
	function Resep(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poli/resep.php",
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

	function TambahResep(reg_no){
		$.ajax({
			type:"GET",
			url:'poli/tambah_resep.php',
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

	function editRujuk(rujuk_id){
		$.ajax({
			type:"GET",
			url:'poli/edit_rujuk.php',
			data:"rujuk_id="+rujuk_id,
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

	function deleteRujuk(rujuk_id,reg_no){
		var pilih = confirm('Hapus ID '+rujuk_id+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poli/hapus_rujuk.php',
					data:"rujuk_id="+rujuk_id,
					success:function(){
						$.ajax({
							type:"GET",
							url:'poli/rujuk.php',
							data:"reg_no="+reg_no,			
							success:function(data){
							  	$('#form').html(data);	
							}
						});					
					}
			});
		}
	}

	function editResep(resep_id){
		$.ajax({
			type:"GET",
			url:'poli/edit_resep.php',
			data:"resep_id="+resep_id,
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

	function deleteResep(resep_id,reg_no){
		var pilih = confirm('Hapus ID '+resep_id+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poli/hapus_resep.php',
					data:"resep_id="+resep_id,
					success:function(){
						$.ajax({
							type:"GET",
							url:'poli/resep.php',
							data:"reg_no="+reg_no,			
							success:function(data){
							  	$('#form').html(data);	
							}
						});					
					}
			});
		}
	}
	//===========================================================================================================================
	
	function tambahForm(){
		$("#form-nest").css({display:"block"});
		$.ajax({
			type:"GET",
			url:"poli/tambah_poli.php",
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
				$("#data").load("poli/data_poli.php");
			}
		});
		return false;
	}

	function deleteData(id_obat,obat){
		var pilih = confirm('Hapus '+obat+' dari daftar ??');
		if(pilih==true){
				$.ajax({
					type:"GET",
					url:'poli/hapus_poli.php',
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
			url:'poli/edit_poli.php',
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
			url:'poli/tambah_stok.php',
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