<script type="text/javascript">
			$(document).ready(function()
			{
				$('.user-mainmenu').mouseover(function(){
					$('.user-submenu').show();
				});
				
				$('.user-mainmenu').mouseleave(function(){
					$('.user-submenu').hide();
				});
				
				$('.user-submenu').mouseover(function(){
					$('.user-submenu').show();
				});
				
				$('.user-submenu').mouseleave(function(){
					$('.user-submenu').hide();
				});
			});
		</script>