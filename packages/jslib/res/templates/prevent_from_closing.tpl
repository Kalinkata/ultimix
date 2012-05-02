<script>
	jQuery( window ).bind( 'beforeunload' , 
		function()
		{
			if( "{redirect_page}" )
			{
				location = "{redirect_page}";
			}

			return( '{lang:shure_to_leave_page}' );
		}
	);
</script>