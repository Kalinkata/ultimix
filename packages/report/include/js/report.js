/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.report )
{
	ultimix.report = {};
}

/**
*	Function creates report generating frame.
*
*	@param PackageName - Package name.
*
*	@param PackageVersion - Package version.
*
*	@param ReportName - Name of the report.
*
*	@param ReportGenerationParameters - Data wich will be trasferred to server.
*
*	@author Dodonov A.A.
*/
ultimix.report.compile_iframe_code = function( PackageName , PackageVersion , ReportName , ReportGenerationParameters )
{
	var			IFrameCode = '<iframe id="report_generation_id" style="display: none;" ' + 
								'src="./report.html?report_package_name=';

	IFrameCode = IFrameCode + PackageName + '&report_package_version=' + PackageVersion;

	IFrameCode = IFrameCode + '&report_name=' + ReportName + '&' + ( new Date() ).getTime();

	return( IFrameCode + ReportGenerationParameters + '"></iframe>' );
}

/**
*	Function creates report generating frame.
*
*	@param PackageName - Package name.
*
*	@param PackageVersion - Package version.
*
*	@param ReportName - Name of the report.
*
*	@param Data - Data wich will be trasferred to server.
*
*	@author Dodonov A.A.
*/
ultimix.report.create_frame = function( PackageName , PackageVersion , ReportName , Data )
{
	if( jQuery( '#report_generation_id' ).length )
	{
		jQuery( '#report_generation_id' ).remove();
	}

	var			ReportGenerationParameters = '';
	if( !Data )
	{
		Data = {};
	}
	for( i in Data )
	{
		ReportGenerationParameters = '&' + i + "=" + new String( Data[ i ] ) + ReportGenerationParameters;
	}

	jQuery( 'body' ).append( 
		ultimix.report.compile_iframe_code( PackageName , PackageVersion , ReportName , ReportGenerationParameters )
	);
}

/**
*	Function displays report generation process gui.
*
*	@param OnGenerate - this function will be called when report generation process will be finished.
*
*	@param ShowProgress - Shold the progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.report.report_generation_process = function( OnGenerate , ShowProgress )
{
	if( ShowProgress )
	{
		var			LoadingId = ultimix.std_dialogs.WaitingMessageBox( 'report_is_generating' , 'report_dialog' );
	}

	jQuery( '#report_generation_id' ).load(
		function()
		{
			if( ShowProgress )
			{
				ultimix.std_dialogs.close_message_box( LoadingId );
			}
			if( OnGenerate )
			{
				OnGenerate();
			}
		}
	);
}

/**
*	Function runs report generation process.
*
*	@param Name - Package name.
*
*	@param Version - Package version.
*
*	@param ReportName - Name of the report.
*
*	@param Data - Data wich will be trasferred to server.
*
*	@param OnGenerate - this function will be called when report generation process will be finished.
*
*	@param ShowProgress - Shold the progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.report.generate_report = function( Name , Version , ReportName , Data , OnGenerate , ShowProgress )
{
	ultimix.report.create_frame( Name , Version , ReportName , Data );
	
	ultimix.report.report_generation_process( OnGenerate , ShowProgress );
}

/**
*	Function runs report generation process with dialog promt.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@author Dodonov A.A.
*/
ultimix.report.on_run_report_generation = function( DataAcceptor , StatusAcceptor , DataSource )
{
	var			PackageName = jQuery( DataSource ).find( 'span.package_name' ).html();
	var			PackageVersion = jQuery( DataSource ).find( 'span.package_version' ).html();
	var			ReportName = jQuery( DataSource ).find( 'span.report_name' ).html();
	var			Data = ultimix.forms.extract_form_data( DataSource );
	
	ultimix.report.generate_report( PackageName , PackageVersion , ReportName , Data , false , true );
}
