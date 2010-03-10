			$(function(){
				$("ul.nav").superfish({
					animation:{
					height: "show",
					width: "show"
					}, speed : 500
				});

				//tooltip
				$(".tooltip").easyTooltip();
		
				// Check all the checkboxes when the head one is selected:
				$('.checkall').click(
					function(){
						$(this).parent().parent().parent().parent().find("input[type='checkbox']").attr('checked', $(this).is(':checked'));   
					}
				);

				$(".close").click(
					function () {
						$(this).fadeTo(400, 0, function () { // Links with the class "close" will close parent
							$(this).slideUp(400);
						});
					return false;
					}
				);

				
				//sortable, portlets
				$(".column").sortable({
					connectWith: '.column'
				});
				
				$(".sort").sortable({
					connectWith: '.sort'
				});
				

				$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
				.find(".portlet-header")
				.addClass("ui-widget-header ui-corner-all")
				.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
				.end()
				.find(".portlet-content");

				$(".portlet-header .ui-icon").click(function() {
					$(this).toggleClass("ui-icon-minusthick");
					$(this).parents(".portlet:first").find(".portlet-content").toggle();
				});

				$(".column").disableSelection();
			
				// Accordion
				$("#accordion").accordion({ header: "h3" });
	
				// Tabs
				$('#tabs').tabs();
	
				// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					width: 500,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});
				
				// Slider
				$('#slider').slider({
					range: true,
					values: [20, 70]
				});
				
				// Progressbar
				$("#progressbar").progressbar({
					value: 40 
				});
				
				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); }, 
					function() { $(this).removeClass('ui-state-hover'); }
				);
			});