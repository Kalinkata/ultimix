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
if( !ultimix.std_dialogs )
{
	ultimix.std_dialogs = {};
}

/**
*	Constants for buttons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.MB_ABORT = 1;
ultimix.std_dialogs.MB_RETRY = 2;
ultimix.std_dialogs.MB_IGNORE = 4;
ultimix.std_dialogs.MB_ABORTRETRYIGNORE = 7;
ultimix.std_dialogs.MB_CANCEL = 8;
ultimix.std_dialogs.MB_TRY = 16;
ultimix.std_dialogs.MB_CONTINUE = 32;
ultimix.std_dialogs.MB_CANCELTRYCONTINUE = 56;
ultimix.std_dialogs.MB_HELP = 64;
ultimix.std_dialogs.MB_OK = 128;
ultimix.std_dialogs.MB_OKCANCEL = 136;
ultimix.std_dialogs.MB_RETRYCANCEL = 10;
ultimix.std_dialogs.MB_YES = 256;
ultimix.std_dialogs.MB_NO = 512;
ultimix.std_dialogs.MB_YESNO = 768;
ultimix.std_dialogs.MB_YESNOCANCEL = 776;

/**
*	Constants for icons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.MB_ICONEXCLAMATION = 2048;
ultimix.std_dialogs.MB_ICONWARNING = 4096;
ultimix.std_dialogs.MB_ICONINFORMATION = 8192;
ultimix.std_dialogs.MB_ICONASTERISK = 16384;
ultimix.std_dialogs.MB_ICONQUESTION = 32768;
ultimix.std_dialogs.MB_ICONSTOP = 65536;
ultimix.std_dialogs.MB_ICONERROR = 131072;
ultimix.std_dialogs.MB_ICONHAND = 262144;
ultimix.std_dialogs.MB_ICONLOADING = 524288;
ultimix.std_dialogs.MB_ICONWAIT = 524288;
ultimix.std_dialogs.MB_MODAL = 1048576;

ultimix.std_dialogs.MessageBoxCounter = 0;

/**
*	This method will close message box.
*
*	@param Selector - Dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.close_message_box = function( Selector )
{
	jQuery( Selector ).dialog( "close" );
	jQuery( Selector ).remove();
}

/**
*	Function fetches class name from style.
*
*	@param Style - Dialog style.
*
*	@return Class name.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_class_name = function( Style )
{
	var			Class = 'jsdialogs-default';
	if( Style & ultimix.std_dialogs.MB_ICONEXCLAMATION )	Class = 'jsdialogs-exclamation';
	if( Style & ultimix.std_dialogs.MB_ICONWARNING )		Class = 'jsdialogs-warning';
	if( Style & ultimix.std_dialogs.MB_ICONINFORMATION )	Class = 'jsdialogs-information';
	if( Style & ultimix.std_dialogs.MB_ICONASTERISK )		Class = 'jsdialogs-asterisk';
	if( Style & ultimix.std_dialogs.MB_ICONQUESTION )		Class = 'jsdialogs-question';
	if( Style & ultimix.std_dialogs.MB_ICONSTOP )			Class = 'jsdialogs-stop';
	if( Style & ultimix.std_dialogs.MB_ICONERROR )			Class = 'jsdialogs-error';
	if( Style & ultimix.std_dialogs.MB_ICONHAND )			Class = 'jsdialogs-hand';
	if( Style & ultimix.std_dialogs.MB_ICONLOADING )		Class = 'jsdialogs-loading';
	return( Class );
}

/**
*	Function compiles message box buttons handlers.
*
*	@param ButtonCode - Button code.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@param id - Control's id.
*
*	@return Handler.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_handler = function( ButtonCode , AcceptResult , id )
{
	return(
		function()
		{
			if( AcceptResult )
			{
				AcceptResult( ButtonCode );
			}
			ultimix.std_dialogs.close_message_box( "#" + id );
		}
	);
}

/**
*	Function compiles message box buttons handlers.
*
*	@param Style - Dialog style.
*
*	@param Buttons - Buttons.
*
*	@param Name - Button name.
*
*	@param ButtonCode - Button code.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@param id - Control's id.
*
*	@return Handler.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.add_button = function( Style , Buttons , Name , ButtonCode , AcceptResult , id )
{
	if( Style & ButtonCode )
	{
		Buttons[ ultimix.get_string( Name ) ] = ultimix.std_dialogs.get_handler( ButtonCode, AcceptResult , id );
	}
	
	return( Buttons );
}

/**
*	Function compiles message box buttons.
*
*	@param Style - Dialog style.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@param id - Control's id.
*
*	@return Buttons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_buttons = function( Style , AcceptResult , id )
{
	var			Buttons = {};
	var			Titles = [ 
		'Abort' , 'Retry' , 'Ignore' , 'No' , 'Try' , 'Yes' , 'Cancel' , 'OK' , 'Help' , 'Continue'
	];
	var			Codes = [ 
		ultimix.std_dialogs.MB_ABORT , ultimix.std_dialogs.MB_RETRY , ultimix.std_dialogs.MB_IGNORE , 
		ultimix.std_dialogs.MB_NO , ultimix.std_dialogs.MB_TRY , ultimix.std_dialogs.MB_YES , 
		ultimix.std_dialogs.MB_CANCEL , ultimix.std_dialogs.MB_OK , ultimix.std_dialogs.MB_HELP , 
		ultimix.std_dialogs.MB_CONTINUE
	];
	
	for( var i = 0 ; i < Titles.length ; i++ )
	{
		Buttons = ultimix.std_dialogs.add_button( Style , Buttons , Titles[ i ] , Codes[ i ] , AcceptResult , id );
	}

	return( Buttons );
}

/**
*	Function cerates message box.
*
*	@param id - Dialog id.
*
*	@param DialogData - Dialog data.
*
*	@param Class - Dialog class.
*
*	@param Text - Dialog message.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.message_box_create = function( id , DialogData , Class , Text )
{
	jQuery( "#" + id ).dialog( DialogData );
	jQuery( "#" + id ).html( 
		'<div class="ultimix-MessageBox-content"><div class="' + Class + '"></div>' + 
		ultimix.get_string( Text ) + '</div>'
	);
	jQuery( "#" + id ).parent().find( '.ui-dialog-titlebar-close' ).remove();
}

/**
*	Function returns caption.
*
*	@param Caption - Caption.
*
*	@return Caption.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_caption = function( Caption )
{
	if( !Caption )
	{
		Caption = 'MessageBox';
	}
	
	return( Caption );
}

/**
*	Function returns style.
*
*	@param Style - Style.
*
*	@return Style.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_style = function( Style )
{
	if( !Style )
	{
		Style = ultimix.std_dialogs.MB_OK;
	}
	
	return( Style );
}

/**
*	Function returns modal.
*
*	@param Style - Style.
*
*	@return Style.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_modal = function( Style )
{
	var			Modal = false;

	if( Style & ultimix.std_dialogs.MB_MODAL )
	{
		Modal = true;
	}
	
	return( Modal );
}

/**
*	Function adds dialog span.
*
*	@param id - Id of the creating control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.add_span_div_if_necessary = function( id )
{
	if( !jQuery( "#" + id ).length )
	{
		jQuery( "body" ).append( '<span id="' + id + '" style="display:none"></span>' );
	}
}

/**
*	Function cerates message box.
*
*	@param Text - Dialog message.
*
*	@param Caption - Dialog caption.
*
*	@param Style - Dialog style.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.MessageBox = function( Text , Caption , Style , AcceptResult )
{
	Caption = ultimix.std_dialogs.get_caption( Caption );
	Style = ultimix.std_dialogs.get_style( Style );
	var			Class = ultimix.std_dialogs.get_class_name( Style );
	var 		id = "ultimix-MessageBox-span-" + ultimix.std_dialogs.MessageBoxCounter++;
	var			Modal = ultimix.std_dialogs.get_modal( Style )
	ultimix.std_dialogs.add_span_div_if_necessary( id );

	var			ExitOnEscape = true;
	if( Style & ultimix.std_dialogs.MB_ICONLOADING )
	{
		ExitOnEscape = false;
	}

	var			Buttons = ultimix.std_dialogs.get_buttons( Style , AcceptResult , id );
	var			DialogData = {
		width: 480 , modal : Modal , title : ultimix.get_string( Caption ) , buttons : Buttons , 
		resizable : false , closeOnEscape : ExitOnEscape
	}

	ultimix.std_dialogs.message_box_create( id , DialogData , Class , Text );

	return( "#" + id );
}

/**
*	Function shows 'waiting' dialog.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.SimpleWaitingMessageBox = function()
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'wait_please' ) , ultimix.get_string( 'Info' ) , 
			ultimix.std_dialogs.MB_ICONLOADING | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function shows 'waiting' dialog.
*
*	@param Text - Message box text.
*
*	@param Caption - Message box caption.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.WaitingMessageBox = function( Text , Caption )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( Caption ) , 
			ultimix.std_dialogs.MB_ICONLOADING | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function shows 'error' dialog.
*
*	@param Text - Message box text.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.ErrorMessageBox = function( Text )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function shows 'question' dialog.
*
*	@param Text - Message box text.
*
*	@param Success - Success method.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.QuestionMessageBox = function( Text , Success )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( 'Question' ) , 
			ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , Success
		)
	);
}

/**
*	Function shows 'info' dialog.
*
*	@param Text - Message box text.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.InfoMessageBox = function( Text )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( 'Info' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONINFORMATION | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function returns 'loading' image control.
*
*	@return HTML code of the control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.loading_block = function()
{
	return(
		'<div class="jsdialogs-loading" style="float: none; margin-right : 0px;"></div>'
	);
}

/**
*	Function returns 'loading' image widget.
*
*	@return HTML code of the control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.loading_img_widget = function()
{
	var			LoadingBlock = ultimix.std_dialogs.loading_block();

	var			VAlginBlock = ultimix.string_utilities.valign_block( LoadingBlock );

	return( ultimix.string_utilities.halign_block( VAlginBlock , 32 ) );
}

/**
*	Function creates dialog.
*
*	@param id - id of the dialog.
*
*	@param Caption - Caption of the dialog.
*
*	@param Buttons - Buttons of the dialog.
*
*	@return Selector of the dialog.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.construct_common_dialog = function( id , Caption , Buttons )
{
	var			DialogData = {
		width: 'auto' , modal : true , title : ultimix.get_string( Caption ) , buttons : Buttons , 
		resizable : false , closeOnEscape : true
	}

	jQuery( "#" + id ).dialog( DialogData );

	return( "#" + id );
}

/**
*	Function creates OK button.
*
*	@param id - Dialog id.
*
*	@param OkProcessor - Processor of the OK button.
*
*	@param AfterOkProcessor - Processor of the closing dialog after OK button.
*
*	@return OK button handler.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.common_ok_button = function( id , OkProcessor , AfterOkProcessor )
{
	return(
		function()
		{
			if( OkProcessor == false || OkProcessor( "#" + id ) )
			{
				var			Data = jQuery( "#" + id ).find( 'textarea' ).val();

				jQuery( "#" + id ).dialog( "close" );
				jQuery( "#" + id ).remove();

				if( AfterOkProcessor )
				{
					AfterOkProcessor( Data );
				}
			}
		}
	);
}

/**
*	Function creates buttons.
*
*	@param id - Dialog id.
*
*	@param OkProcessor - Processor of the OK button.
*
*	@param AfterOkProcessor - Processor of the closing dialog after OK button.
*
*	@param CancelProcessor - Processor of the Cancel button.
*
*	@return Buttons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.dialog_buttons = function( id , OkProcessor , AfterOkProcessor , CancelProcessor )
{
	var			Buttons = {};

	if( CancelProcessor == 'no button' )
	{
		/* no button*/
	}
	else
	{
		Buttons[ ultimix.get_string( 'Cancel' ) ] = function()
		{
			jQuery( "#" + id ).dialog( "close" );
			jQuery( "#" + id ).remove();
		}
	}

	Buttons[ ultimix.get_string( 'OK' ) ] = ultimix.std_dialogs.common_ok_button( id , OkProcessor , AfterOkProcessor );

	return( Buttons );
}

/**
*	Function adds dialog div.
*
*	@param id - Id of the creating control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.add_textarea_div_if_necessary = function( id )
{
	if( !jQuery( "#" + id ).length )
	{
		jQuery( "body" ).append( 
			'<span id="' + id + '" style="display:none">' + 
			'<textarea style="width: 480px; height: 360px; margin: 10px;" class="flat"></textarea></span>'
		);
	}
}

/**
*	Function adds dialog div.
*
*	@param id - Id of the creating control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.add_input_div_if_necessary = function( id )
{
	if( !jQuery( "#" + id ).length )
	{
		jQuery( "body" ).append( 
			'<span id="' + id + '" style="display:none"><input class="width_480 flat" style="margin: 10px;"></span>'
		);
	}
}

/**
*	Function creates dialog with the 'textarea' control.
*
*	@param Caption - Dialog caption.
*
*	@param OkProcessor - Processor of the OK button.
*
*	@param AfterOkProcessor - Processor of the closing dialog after OK button.
*
*	@param CancelProcessor - Processor of the Cancel button.
*
*	@return id of the created dialog.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.textarea_dialog = function( Caption , OkProcessor , AfterOkProcessor , CancelProcessor )
{
	var 		id = "ultimix-MessageBox-span-" + ultimix.std_dialogs.MessageBoxCounter++;

	var			Buttons = ultimix.std_dialogs.dialog_buttons(
		id , OkProcessor , AfterOkProcessor , CancelProcessor
	);

	ultimix.std_dialogs.add_textarea_div_if_necessary( id );

	return( ultimix.std_dialogs.construct_common_dialog( id , Caption , Buttons ) );
}

/**
*	Function creates dialog with the 'textarea' control.
*
*	@param Caption - Dialog caption.
*
*	@param OkProcessor - Processor of the OK button.
*
*	@param AfterOkProcessor - Processor of the closing dialog after OK button.
*
*	@param CancelProcessor - Processor of the Cancel button.
*
*	@return id of the created dialog.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.input_dialog = function( Caption , OkProcessor , AfterOkProcessor , CancelProcessor )
{
	var 		id = "ultimix-MessageBox-span-" + ultimix.std_dialogs.MessageBoxCounter++;

	var			Buttons = ultimix.std_dialogs.dialog_buttons(
		id , OkProcessor , AfterOkProcessor , CancelProcessor
	);

	ultimix.std_dialogs.add_input_div_if_necessary( id );

	return( ultimix.std_dialogs.construct_common_dialog( id , Caption , Buttons ) );
}
