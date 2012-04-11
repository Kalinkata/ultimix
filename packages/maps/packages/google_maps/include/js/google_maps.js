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
if( !ultimix.google_maps )
{
	ultimix.google_maps = {};
}

/**
*	Function automatically initializes all google maps on the page.
*
*	@author Dodonov A.A.
*/
ultimix.google_maps.AutoInitialize = function()
{
	jQuery( ".google_map" ).each(
		function( index , Element )
		{
			ultimix.google_maps.InitializeMap( Element );
		}
	);
}

/**
*	Function gets coordinates of the requesting address.
*
*	@param Address - Requesting address.
*
*	@param PointAcceptor - Callback function wich accepts result.
*
*	@author Dodonov A.A.
*/
ultimix.google_maps.GetAddress = function( Address , PointAcceptor )
{
	var 	Geocoder = new GClientGeocoder();
	
	Geocoder.getLatLng(
		Address , 
		function( LatLng )
		{
			if( !LatLng )
			{
				/* setting default values */
				LatLng = new GLatLng( 55.7519 , 37.6229 );
			}
			
			if( PointAcceptor )
			{
				PointAcceptor( LatLng );
			}
		}
	);
}

/**
*	Function initializes google map for the single element.
*
*	@param Element - DOM element.
*
*	@author Dodonov A.A.
*/
ultimix.google_maps.InitializeMap = function( Element )
{
	if( GBrowserIsCompatible() )
	{
		var Map = new GMap2( Element );
		if( jQuery( Element ).attr( 'lat' ) )
		{
			var	Point = new GLatLng( jQuery( Element ).attr( 'lat' ) , jQuery( Element ).attr( 'lng' ) );
		}
		else
		{
			var Point = new GLatLng( 55.7519 , 37.6229 );
		}
		
		Map.setCenter( Point , 12 );
		Map.addOverlay( new GMarker( Point ) );
		Map.setUIToDefault();
	}
}

jQuery(
	function()
	{
		ultimix.google_maps.AutoInitialize();
	}
);