					<input type="text" name="{name}" id="{name}" class="width_80 flat" value="{http_param:name={name};type=string;post=1;default={value}}" onkeypress="return( false );" onfocus="jQuery( '#{name}' ).datepicker( 'show' );" onclick="jQuery( '#{name}' ).datepicker( 'show' );">
					<script type="text/javascript">
						jQuery( function()
							{
								jQuery( '#{name}' ).datepicker(
									jQuery.extend(
										{
											showOn: 'button' , 
											buttonImage : 'packages/page/packages/page_composer/res/images/calendar.gif' , 
											buttonImageOnly : true , 
											showButtonPanel : true ,
											dateFormat : '{set_format}' , 
											changeMonth : true , 
											changeYear : true , 
											yearRange : '1900:2100'
										} , 
										jQuery.extend(
											jQuery.datepicker.regional[ '{if:condition={eq:value1=en;value2={locale}};then=;else={locale}}' ] ,
											{ dateFormat : '{set_format}' }
										)
									)
								);
							}
						);
					</script>