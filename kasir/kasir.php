<script type="text/javascript">
	$(document).ready(function(){
		$("#data").load("kasir/data_kasir.php");
		$("#id-breadcrumbs").html("kasir");
	});

	function pay(reg_no){
		$('#form-nest').css({display:"block"});
		$.ajax({
			type:"GET",
			url:"kasir/pay.php",
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
	
	function Tambahpay(reg_no){
		$.ajax({
			type:"GET",
			url:'kasir/tambah_pay.php',
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
				$("#data").load("kasir/data_kasir.php");
			}
		});
		return false;
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