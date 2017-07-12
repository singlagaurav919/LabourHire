// JavaScript Document
	$(document).ready(function(e) 
	{
		$(document).ajaxStart(function() 
		{		
			$(".dark").show();
			$(".loading").show();
					
		}).ajaxStop(function() 
		{
			$(".loading").hide();
			$(".dark").hide();
		
		});
		
		$(window).scroll(function(){
			
			
			if($(this).scrollTop()>0)
			{
				$('.top').fadeIn();
			}
			else{
				$('.top').fadeOut();
			}
			
			
			});
			
			
	});