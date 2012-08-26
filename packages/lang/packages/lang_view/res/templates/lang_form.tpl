<script>
	function	set_lang( Lang )
	{
		jQuery.cookie( 'client_lang' , Lang );
		ultimix.data_form.submit_data( {} );
	}
</script>
{lang_list}