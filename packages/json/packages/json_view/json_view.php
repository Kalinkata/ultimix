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
	*	\~russian Вид, отдающий данные в json формате.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english View provides access for json encoded data.
	*
	*	@author Dodonov A.A.
	*/
	class	json_view_1_0_0{

		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;

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
		var					$Security = false;
		var					$Settings = false;
		var					$Utilities = false;

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Utilities = get_package_object( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция выборки данных.
		*
		*	@param $Provider - Объект пакета.
		*
		*	@param $FunctionName - Название функции.
		*
		*	@return Данные.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches data.
		*
		*	@param $Provider - Package object.
		*
		*	@param $FunctionName - Function name.
		*
		*	@return Data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	fetch_records( $Provider , $FunctionName )
		{
			try
			{
				return(
					call_user_func( 
						array( $Provider , $FunctionName ) , 
						$this->Security->get_gp( 'start' , 'integer' , false ) , 
						$this->Security->get_gp( 'limit' , 'integer' , 21 ) , 
						$this->Security->get_gp( 'field' , 'command' , false ) , 
						$this->Security->get_gp( 'order' , 'command' , false )
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			fetch_data( $Options )
		{
			try
			{
				$FileName = $this->Security->get_gp( 'data' , 'command' , false );
				
				if( $FileName === false )
				{
					return;
				}

				$this->Settings->load_file( dirname( __FILE__ )."/conf/cf_$FileName" );

				$Provider = $this->Utilities->get_package( $this->Settings , __FILE__ , 'access_' );

				$FunctionName = $this->Settings->get_setting( 'select_func' , 'select' );

				$Records = $this->fetch_records( $Provider , $FunctionName );

				$JSON = get_package( 'json' , 'last' , __FILE__ );

				$this->Output = $JSON->encode( $Records );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$this->fetch_data( $Options );

				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>