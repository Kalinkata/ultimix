<style>
	.trace_block
	{
		margin				: 10px;
	}
	
	.trace
	{
		padding				: 10px 10px 0px;
		border				: 1px dotted red;
		font-family			: Courier New;
	}
	
	.trace_start
	{
		margin-bottom		: 10px;
	}
	
	.trace_end
	{
		margin-bottom		: 10px;
	}
	
	.trace_line_error
	{
		margin				: 5px 0 5px 0;
		background-color	: #FFDDDE;
	}
	
	.trace_line_common
	{
		margin				: 5px 0 5px 0;
		background-color	: #CCFFDB;
	}
	
	.trace_line_notification
	{
		margin				: 5px 0 5px 0;
		background-color	: #FFFCD6;
	}
	
	.trace_line_query
	{
		margin				: 5px 0 5px 0;
		background-color	: #ECCCFF;
	}
	
	.trace_start_group
	{
		margin-bottom		: 5px;
		margin-top			: 5px;
		background-color	: #F7F7F7;
		border				: 1px dotted black;
	}
	
	.trace_group_name
	{
		text-decoration		: none;
	}
	
	.trace_group
	{
		display				: none;
		padding				: 5px 10px 5px 10px;
	}
</style>
<script>
	function			ToggleGroup( Id )
	{
		// don't replace with jQuery code because this function may be called when jQuery was not loaded
		if( document.getElementById( Id ).style.display == 'block' )
		{
			document.getElementById( Id ).style.display = 'none';
		}
		else
		{
			document.getElementById( Id ).style.display = 'block';
		}
	}
</script>
<div class="trace">{output}</div>