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
	*	\~russian Класс с описанием, поддерживаемых данных.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class with all supported data description.
	*
	*	@author Dodonov A.A.
	*/
	class	data_filtration_1_0_0{

		/**
		*	\~russian Закешированные объекты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$String = false;

		/**
		*	\~russian Конструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция фильтрации http данных.
		*
		*	@param $FiltrationScript - Скрипт фильтрации.
		*
		*	@return - Отфильтрованные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english The method filtrates http data.
		*
		*	@param $FiltrationScript - Data filtration script.
		*
		*	@return - Filtered data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_http_data( $FiltrationScript )
		{
			try
			{
				return( $this->filter_data( array_merge( $_GET , $_POST ) , $FiltrationScript ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция пропуска элемента.
		*
		*	@param $Settings - Настройки.
		*
		*	@param $k - Ключ.
		*
		*	@return true/false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english The method skips element.
		*
		*	@param $Settings - Settings.
		*
		*	@param $k - Key.
		*
		*	@return true/false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	skip_element( &$Settings , $k )
		{
			try
			{
				if( $Settings->get_setting( 'keys' ) && is_integer( $k ) === false )
				{
					if( array_search( $k ,  $Settings->get_setting( 'keys' ) ) === false )
					{
						return( true )
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция фильтрации данных.
		*
		*	@param $Data - Фильтруемые данные.
		*
		*	@param $FiltrationScript - Скрипт фильтрации.
		*
		*	@param $Settings - Настройки.
		*
		*	@return Отфильтрованные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english The method filtrates data.
		*
		*	@param $Data - Data to filter.
		*
		*	@param $FiltrationScript - Data filtration script.
		*
		*	@param $Settings - Settings.
		*
		*	@return Filtered data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_filtering_data( $Data , $FiltrationScript , &$Settings )
		{
			try
			{
				$Ret = array();
				foreach( $Data as $k => $v )
				{
					if( $this->skip_element( $Settings , $k ) )
					{
						continue;
					}					
					if( is_array( $v ) || is_object( $v ) )
					{
						if( ( $Tmp = $this->filter_data( $v , $FiltrationScript ) ) !== false )
						{
							$Ret[ $k ] = $Tmp;
						}
					}
					elseif( !( $Settings->get_setting( 'filled' , false ) && strlen( $v ) == 0 ) )
					{
						$Ret[ $k ] = $v;
					}
				}
				return( $Ret );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция фильтрации данных.
		*
		*	@param $Data - Фильтруемые данные.
		*
		*	@param $FiltrationScript - Скрипт фильтрации.
		*
		*	@return Отфильтрованные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english The method filtrates data.
		*
		*	@param $Data - Data to filter.
		*
		*	@param $FiltrationScript - Data filtration script.
		*
		*	@return Filtered data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			filter_data( $Data , $FiltrationScript )
		{
			try
			{
				$Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$Settings->load_settings( $FiltrationScript );

				if( $Settings->get_setting( 'keys' , false ) )
				{
					$Settings->set_setting( 'keys' , explode( ',' , $Settings->get_setting( 'keys' ) ) );
				}

				$Ret = process_filtering_data( $Data , $FiltrationScript , $Settings );
				
				return( count( $Ret ) ? $Ret : false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>