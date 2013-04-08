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
	*	\~russian Класс для создания диалогов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class creates common dialogs.
	*
	*	@author Dodonov A.A.
	*/
	class	dialogs_1_0_0{

		/**
		*	\~russian Закэшированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$ContextSetConfigs = false;
		var					$String = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author  Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->ContextSetConfigs = get_package( 'gui::context_set::context_set_configs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения данных пакета.
		*
		*	@param $Settings - Параметры отображения.
		*
		*	@return array( $Prefix , $Permits ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns data for package.
		*
		*	@param $Settings - Options of drawing.
		*
		*	@return array( $Prefix , $Permits ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_package_data( &$Settings )
		{
			try
			{
				$PackageName = $Settings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );
				$Prefix = $this->ContextSetConfigs->get_context_set_prefix( $PackageName , $PackageVersion );
				$Permits = $this->ContextSetConfigs->get_context_permits( 
					'create_'.$Prefix , $PackageName , $PackageVersion
				);

				return( array( $Prefix , $Permits ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Settings - Параметры отображения.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Settings - Options of drawing.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_create_record( &$Settings )
		{
			try
			{
				$Settings->set_setting( 'id' , md5( microtime( true ) ) );

				list( $Prefix , $Permits ) = $this->get_package_data( $Settings );
				$Settings->set_setting( 'prefix' , $Prefix );
				$Settings->set_setting( 'permits' , $Permits );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'create_record.tpl' );
				$Code = $this->String->print_record( $Code , $Settings->get_raw_settings() );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>