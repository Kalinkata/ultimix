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
if( !ultimix.wizard )
{
	ultimix.wizard = {};
}

/**
*	Wizard steps.
*
*	@author Dodonov A.A.
*/
ultimix.wizard.Steps = new Array();

/**
*	Current wizard's step.
*
*	@author Dodonov A.A.
*/
ultimix.wizard.CurrentStep = -1;

/**
*	Function creates wizard's dialog.
*
*	@param RawSteps - wizard steps.
*
*	@param SuccessFunction - this function will be executed at the end of the wizard.
*
*	@param DialogOptions - visualisation options of the wizard dialog.
*
*	@author Dodonov A.A.
*/
ultimix.wizard._CreateWizardDialogs = function( RawSteps , SuccessFunction , DialogOptions )
{
	ultimix.wizard.Steps = RawSteps;
	
	DialogOptions = jQuery.extend(
		{
			width : 640 , 
			height : 480 , 
			modal : true , 
			autoOpen : true , 
			resizable : false , 
			closeOnEscape : false , 
			title : ''
		} , 
		DialogOptions
	);
	DialogOptions.autoOpen = false;
	if( DialogOptions.title )
	{
		DialogOptions.title = ultimix.get_string( DialogOptions.title );
	}
	
	for( var i = 0 ; i < ultimix.wizard.Steps.length ; i++ )
	{
		var		Buttons = new Array();
		var		CurrentSelector = ultimix.wizard.Steps[ i ].selector;
		
		if( i + 1 < ultimix.wizard.Steps.length )
		{
			var		CreateNextButton = function( i , CurrentSelector )
			{
				return(
					function()
					{
						jQuery( CurrentSelector ).dialog( 'close' );
						jQuery( ultimix.wizard.Steps[ i + 1 ].selector ).dialog( 'open' );
						jQuery( ultimix.wizard.Steps[ i + 1 ].selector ).dialog( 
							'option' , 'title' , DialogOptions.title + ' ' + ultimix.get_string( 'step' ) + ' ' + 
							( i + 2 ) + ' ' + ultimix.get_string( 'of' ) + ' ' + ultimix.wizard.Steps.length
						);
					}
				);
			}
			Buttons[ ultimix.get_string( 'Next' ) ] = CreateNextButton( i , CurrentSelector );
		}
		
		if( i + 1 == ultimix.wizard.Steps.length )
		{
			var		CreateFinishButton = function( i , CurrentSelector )
			{
				return(
					function()
					{
						SuccessFunction();
						jQuery( CurrentSelector ).dialog( 'close' );
					}
				);
			}
			Buttons[ ultimix.get_string( 'Finish' ) ] = CreateFinishButton( i , CurrentSelector );
		}
		
		if( i > 0 )
		{
			var		CreateBackButton = function( i , CurrentSelector )
			{
				return(
					function()
					{
						jQuery( CurrentSelector ).dialog( 'close' );
						jQuery( ultimix.wizard.Steps[ i - 1 ].selector ).dialog( 'open' );
						jQuery( ultimix.wizard.Steps[ i - 1 ].selector ).dialog( 
							'option' , 'title' , DialogOptions.title + ' ' + ultimix.get_string( 'step' ) + ' ' + i + 
							' ' + ultimix.get_string( 'of' ) + ' ' + ultimix.wizard.Steps.length
						);
					}
				);
			}
			Buttons[ ultimix.get_string( 'Back' ) ] = CreateBackButton( i , CurrentSelector );
		}
		
		var		CreateCancelButton = function( CurrentSelector )
		{
			return(
				function()
				{
					jQuery( CurrentSelector ).dialog( 'close' );
				}
			);
		};
		Buttons[ ultimix.get_string( 'Cancel' ) ] = CreateCancelButton( CurrentSelector );
		
		DialogOptions.buttons = Buttons;
		
		jQuery( ultimix.wizard.Steps[ i ].selector ).dialog( DialogOptions );
	}
}

/**
*	Function runs wizard.
*
*	@param RawSteps - wizard steps.
*
*	@param SuccessFunction - this function will be executed at the end of the wizard.
*
*	@param DialogOptions - visualisation options of the wizard dialog.
*
*	@author Dodonov A.A.
*/
ultimix.wizard.Wizard = function( RawSteps , SuccessFunction , DialogOptions )
{
	ultimix.wizard.CurrentStep = -1;

	ultimix.wizard._CreateWizardDialogs( RawSteps , SuccessFunction , DialogOptions );

	jQuery( ultimix.wizard.Steps[ 0 ].selector ).dialog( 'open' );

	jQuery( ultimix.wizard.Steps[ 0 ].selector ).dialog( 
		'option' , 'title' , DialogOptions.title + ' ' + ultimix.get_string( 'step' ) + ' ' + 1 + ' ' + 
		ultimix.get_string( 'of' ) + ' ' + ultimix.wizard.Steps.length
	);
}
