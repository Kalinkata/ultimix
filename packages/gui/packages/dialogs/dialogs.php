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
		var					$MacroParameters = false;
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
				$this->MacroParameters = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
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
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - processing string.
		*
		*	@param $Changed - was the processing completed.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( &$Options , $Str , &$Changed )
		{
			try
			{
				/* TODO: move it to auto_markup */
				/* TODO: AJAX request for record creation */
				/* TODO: implement ultimix.user.ActivateUsers */
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'create_record' ) ; )
				{
					$this->MacroParameters->load_settings( $Parameters );

					$id = md5( microtime( true ) );
					$PackageName = $this->MacroParameters->get_setting( 'package_name' );
					$PackageVersion = $this->MacroParameters->get_setting( 'package_version' , 'last' );
					$Prefix = $this->ContextSetConfigs->get_context_set_prefix( $PackageName , $PackageVersion );
					$Permits = $this->ContextSetConfigs->get_context_permits( 
						'create' , $PackageName , $PackageVersion
					);

					$this->MacroParameters->set_setting( 'id' , $id );
					$this->MacroParameters->set_setting( 'prefix' , $Prefix );

					$Code = $this->CachedMultyFS->get_template( __FILE__ , 'create_record.tpl' );
					$Code = $this->String->print_record( $Code , $this->MacroParameters->get_raw_settings() );

					$Str = str_replace( "{create_record:$Parameters}" , $Code , $Str );
					$Changed = true;
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>