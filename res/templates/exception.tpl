<html>
	<head>
		<style>
			.exception *
			{
				font-family		: courier new;
			}
			a.func_link, a.func_link:visited
			{
				color			: blue;
				text-decoration	: none;
			}
			a.func_link:hover
			{
				color			: blue;
				text-decoration	: underline;
			}
		</style>
		
		<script>
			function 		base64_decode( data )
			{
				if( data.length == 0 )
				{
					return( '' );
				}
				// Decodes data encoded with MIME base64
				// 
				// +   original by: Tyler Akins (http://rumkin.com)

				var 	b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
				var 	o1 , o2 , o3 , h1 , h2 , h3 , h4 , bits , i = 0 , enc = '';

				do
				{
					// unpack four hexets into three octets using index points in b64
					h1 = b64.indexOf( data.charAt( i++ ) );
					h2 = b64.indexOf( data.charAt( i++ ) );
					h3 = b64.indexOf( data.charAt( i++ ) );
					h4 = b64.indexOf( data.charAt( i++ ) );

					bits = h1<<18 | h2<<12 | h3<<6 | h4;

					o1 = bits>>16 & 0xff;
					o2 = bits>>8 & 0xff;
					o3 = bits & 0xff;

					if( h3 == 64 )       enc += String.fromCharCode( o1 );
					else if ( h4 == 64 ) enc += String.fromCharCode( o1 , o2 );
					else                 enc += String.fromCharCode( o1 , o2 , o3 );
				}
				while( i < data.length );

				return( enc );
			}

			function		hide( data , id , add_show_link )
			{
				if( add_show_link )
				{
					document.getElementById( id ).innerHTML = "<" + "a href=\"javascript:show( '" + data + "' , " + id + " , 1 );\">show</a>";
				}
				else
				{
					document.getElementById( id ).innerHTML = "";
					document.getElementById( "link" + id ).href="javascript:show( '" + data + "' , " + id + " );";
				}
			}
			
			function		show( data , id , add_hide_link )
			{
				if( add_hide_link )
				{
					document.getElementById( id ).innerHTML = base64_decode( data ) + " <" + "a href=\"javascript:hide( '" + data + "' , " + id + " , 1 );\">hide</a>";
				}
				else
				{
					document.getElementById( id ).innerHTML = " => " + base64_decode( data );
					document.getElementById( "link" + id ).href="javascript:hide( '" + data + "' , " + id + " );";
				}
			}
			
			var				Expand = 1;
			
			function		toggle_all( element )
			{
				if( element )
				{
					for( var i = 0 ; i < element.childNodes.length ; i++ )
					{
						var		Obj = element.childNodes[ i ];
						if( Obj.tagName == 'A' )
						{
							if( Expand == 1 && Obj.href.search( 'show' ) != -1 )
							{
								var		href = Obj.href.replace( /javascript:/g , '' ).replace( /%20/g , ' ' );
								eval( href );
							}
							if( Expand == 0 && Obj.href.search( 'hide' ) != -1 )
							{
								var		href = Obj.href.replace( /javascript:/g , '' ).replace( /%20/g , ' ' );
								eval( href );
							}
						}
						
						if( Obj.tagName == 'SPAN' )
						{
							toggle_all( Obj );
						}
					}
				}
				else
				{
					toggle_all( document.getElementById( 'exception_text_area' ) );
					Expand = Expand == 1 ? 0 : 1;
					if( Expand )
					{
						document.getElementById( 'toggle_button' ).innerHTML = 'expand all';
					}
					else
					{
						document.getElementById( 'toggle_button' ).innerHTML = 'collapse all';
					}
				}
			}
		</script>
	</head>
	
	<body>
		<table width="100%" height="100%" class="exception">
			<tr>
				<td align="center">
					<table>
						<tr bgcolor="#FF9E9E">
							<td align="center">
								An error occured while generating page
							</td>
						</tr>
						<tr bgcolor="#FFDDDD">
							<td align="left" id="exception_text_area">
								{exception_message}
								<p align="right"><a id="toggle_button" href="javascript:toggle_all();">expand all</a>{download}</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>