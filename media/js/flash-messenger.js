$(function()
{
	$(".close").bind("click", function() {
		$(this).parent().slideUp("fast", function(){ $(this).remove(); });
	});

	$("#main li").hover(
		function(){
			$(this).children("ul").slideDown("fast");
		},
		function(){
			$(this).children("ul").slideUp("fast");
		}
	);
});