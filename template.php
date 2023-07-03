<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header('location:index.php');
	}
	include('includes/config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inventory and Billing System</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>Manage Template</h1>
			</div>
			<div class="wrap-content">
				
				<div class="clear"></div>
				<div id="compView">
					
					<?php
						$query = "SELECT * FROM tbl_template";
						$stmt = $db->prepare($query);
						$stmt->execute();
						while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
							echo '<div class="col-md-6 wrap-template">';
							echo '<h3>'.$row['tempName'].'</h3>';
							echo '<div class="wrapTemp';
							if($row['tempStatus'] == 1){
								echo ' activeTemp';
							}
							echo '">';
							echo '<a class="selTemp" id="'.$row['tempid'].'/'.$row['fileName'].'">';
							echo '<img class="wrap-temp" src="'.$row['imgPath'].'" width="100%">';
							echo '</a>';
							echo '</div>';
							echo '</div>';
						}
					?>
				
				</div>
			</div>
		</div>
	
  
  
		<?php
			include('footer.php');
		?>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		
		<?php
			include('headerright.php');
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				
				gettemplate();
				
				function gettemplate(){
					var flag = 7;
					var data = {flag:flag};
					var content = "";
					$.ajax({
						url:'controller/controller.company.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data)
						{
							$.each(data,function(index,element)
							{
								content +='<div class="col-md-6 wrap-template">';
								content +='<h3>'+element.tempName+'</h3>';
								content +='<div class="wrapTemp';
								if(element.tempStatus == 1){
									content += ' activeTemp';
								}
								content +='">';
								content +='<a class="selTemp" id="'+element.tempid+'/'+element.fileName+'">';
								content +='<img class="wrap-temp" src="'+element.imgPath+'" width="100%">';
								content +='</a>';
								content +='</div>';
								content +='</div>';
							});
							
							$('#compView').html(content);
						}
					});
				}
				
				$(document).on('click','.selTemp',function(e){
				e.preventDefault();
				var id = this.id;
				var flag = 6;
				var data ={flag:flag,id:id};
				$.ajax({
					url:'controller/controller.company.php',
					type:'POST',
					data:data,
					success:function(html){
						if(html==1){
							swal("Invoice Template Changed","","success");
							gettemplate();
						}
						else
							alert(html);
					}
				});
			});
			});
		
			
		</script>
	</body>
</html>