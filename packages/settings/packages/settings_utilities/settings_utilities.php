<?php

	/*
	*	This source code is a part of the Ultimix Project. 
	*	It is distributed under BSD license. All other third side source code (like tinyMCE) is distributed under 
	*	it's own license wich could be found from the corresponding files or sources. 
	*	This source code is provided "as is" without any warranties or garanties.
	*
	*	Have a nice day!
	*
	*	@url http://ultimix.sorceforge.net
	*
	*	@author Alexey "gdever" Dodonov
	*/

	/**
	*	\~russian Работа с настройками.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with settings.
	*
	*	@author Dodonov A.A.
	*/
	class	settings_utilities_1_0_0{

		/**
		*	\~russian Преобразование строку настроек.
		*
		*	@param $Settings - Настройки.
		*
		*	@param $Separator - Разделитель.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function transforms settings string.
		*
		*	@param $Settings - Settings.
		*
		*	@param $Separator - Separator.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			transform_settings( $Settings , $Separator )
		{
			try
			{
				$Settings = str_replace( 
					array( "\r" , "\n" , $Separator.$Separator ) , 
					array( $Separator , $Separator , $Separator ) , 
					$Settings
				);

				return( explode( $Separator , $Settings ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Загрузка настроек.
		*
		*	@param $Settings - Настройки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function loads settings.
		*
		*	@param $Settings - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_settings( $Settings )
		{
			try
			{
				$SettingsList = array();
				foreach( $Settings as $s )
				{
					$Tmp = explode( '=' , $s );
					if( isset( $Tmp[ 1 ] ) === true )
					{
						$SettingsList[ $Tmp[ 0 ] ] = $Tmp[ 1 ];
					}
					elseif( isset( $Tmp[ 0 ] ) === true && isset( $Tmp[ 1 ] ) === false )
					{
						$SettingsList[ $Tmp[ 0 ] ] = true;
					}
					elseif( isset( $Tmp[ 0 ] ) === false )
					{
						$Settings = serialize( $Settings );
						$s = serialize( $s );
						$Tmp = serialize( $Tmp );
						throw_exception( "Settings : $Settings s : $s Tmp : $Tmp Illegal settings string" );
					}
				}
				return( $SettingsList );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>