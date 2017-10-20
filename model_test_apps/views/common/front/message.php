<script type="text/javascript">
	$(document).ready(function() {
		$.prompt("<span class='{message_class}'>{message}</span>",{
			buttons: { "Close": false },
			show: 'slideDown',
		});
		setTimeout(function(){ jQuery(".jqidefaultbutton").click(); },5000);
	});
</script>
