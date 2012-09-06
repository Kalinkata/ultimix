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
	*	\~russian Класс для быстрого создания кнопок.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for rapid buttons creation.
	*
	*	@author Dodonov A.A.
	*/
	class	common_buttons_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Dodonov A.A.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;
		var					$ContextSetConfigs = false;
		var					$PermitAlgorithms = false;
		var					$Settings = false;
		var					$Trace = false;

		/**
		*	\~russian Версия.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Version.
		*
		*	@author Dodonov A.A.
		*/
		var					$Version = 1;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$PackageName = 'gui::context_set::context_set_configs';
				$this->ContextSetConfigs = get_package( $PackageName , 'last' , __FILE__ );
				$this->PermitAlgorithms = get_package( 'permit::permit_algorithms' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Trace = get_package( 'trace' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает код кнопки создания записи.
		*
		*	@param $CommonStateConfig - Конфиг стейта.
		*
		*	@param $ExtOptions - Дополнительные настройки компиляции.
		*
		*	@param $Name - Название кнопки.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns code of the create button.
		*
		*	@param $CommonStateConfig - State's config.
		*
		*	@param $ExtOptions - Additional settings.
		*
		*	@param $Name - Button name.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_common_button_content( &$CommonStateConfig , &$ExtOptions ,  $Name )
		{
			try
			{
				$PermitsFilter = $CommonStateConfig->get_setting( 'permits_filter' , 'admin' );
				$ValidatingPermits = $CommonStateConfig->get_setting( 'permits_validation' , $PermitsFilter );

				$PermitValidationResult = $this->PermitAlgorithms->object_has_all_permits( 
					false , 'user' , $ValidatingPermits 
				);

				if( $PermitValidationResult )
				{
					$Path = _get_package_relative_path_ex( 'gui::context_set::common_buttons' , 'last' );

					$ButtonCode = $this->CachedMultyFS->get_template( __FILE__ , 'toolbar_'.$Name.'_button.tpl' );

					return( $ButtonCode );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение конфига.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Name - Название стейта.
		*
		*	@return Конфиг.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Fetching config.
		*
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Name - State name.
		*
		*	@return Config content.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_config( &$ContextSetConfig , &$Options , $Name )
		{
			try
			{
				$Config = $this->ContextSetConfigs->load_common_state_config( 
					$ContextSetConfig , 'common_state_config_'.$Name , 'cfcxs_'.$Name , 
					$Options->get_setting( 'file_path' )
				);

				return( $Config );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку кнопки поиска.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Code - Обрабатывемая строка.
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
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Code - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_search_button( &$ContextSetConfig , &$Options , $Code )
		{
			try
			{
				if( strpos( $Code , chr( 123 ).'search_button' ) === false )
				{
					return( $Code );
				}

				$Config = $this->get_config( $ContextSetConfig , $Options , 'search_form' );

				$ExtOptions = false;

				$Code = str_replace( 
					'{search_button}' , 
					$this->get_common_button_content( $Config , $ExtOptions , 'search' ) , $Code 
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку кнопки создания.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Code - Обрабатывемая строка.
		*
		*	@param $ButtonName - Название кнопки.
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
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Code - Processing string.
		*
		*	@param $ButtonName - Button name.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_button( &$Config , $Code , $ButtonName )
		{
			try
			{
				if( strpos( $Code , '{'.$ButtonName.'_button}' ) !== false )
				{
					$Code = str_replace( '{'.$ButtonName.'_button}' , '{'.$ButtonName.'_button:p=1}' , $Code );
				}

				for( ; $Params = $this->String->get_macro_parameters( $Code , $ButtonName.'_button' ) ; )
				{
					$this->Settings->load_settings( $Params );

					$ButtonCode = $this->get_common_button_content( $Config , $this->Settings , $ButtonName );

					$Code = str_replace( '{'.$ButtonName."_button:$Params}" , $ButtonCode , $Code );
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку кнопки создания.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Code - Обрабатывемая строка.
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
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Code - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_create_button( &$ContextSetConfig , &$Options , $Code )
		{
			try
			{
				if( strpos( $Code , chr( 123 ).'create_button' ) === false )
				{
					return( $Code );
				}

				$Config = $this->get_config( $ContextSetConfig , $Options , 'create_form' );

				return( $this->compile_button( $Config , $Code , 'create' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку кнопки редактирования.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Code - Обрабатывемая строка.
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
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Code - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_update_button( &$ContextSetConfig , &$Options , $Code )
		{
			try
			{
				if( strpos( $Code , chr( 123 ).'update_button' ) === false )
				{
					return( $Code );
				}

				$Config = $this->get_config( $ContextSetConfig , $Options , 'update_form' );

				return( $this->compile_button( $Config , $Code , 'update' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку кнопки копирования записи.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Code - Обрабатывемая строка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'copy_button' in a string.
		*
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Code - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_copy_button( &$ContextSetConfig , &$Options , $Code )
		{
			try
			{
				if( strpos( $Code , chr( 123 ).'copy_button' ) === false )
				{
					return( $Code );
				}

				$Config = $this->get_config( $ContextSetConfig , $Options , 'copy_form' );

				return( $this->compile_button( $Config , $Code , 'copy' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отвечающая за обработку кнопки удаления.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Code - Обрабатывемая строка.
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
		*	@param $ContextSetConfig - Set of contexts settings.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Code - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_delete_button( &$ContextSetConfig , &$Options , $Code )
		{
			try
			{
				if( strpos( $Code , chr( 123 ).'delete_button' ) === false )
				{
					return( $Code );
				}

				$Config = $this->get_config( $ContextSetConfig , $Options , 'delete_button' );

				return( $this->compile_button( $Config , $Code , 'delete' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция создания кнопок.
		*
		*	@param $ContextSetConfig - Опции набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@return HTML код для отображения.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method creates buttons.
		*
		*	@param $ContextSetConfig - Options of context_set.
		*
		*	@param $Options - Options of drawing.
		*
		*	@param $Str - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_buttons( &$ContextSetConfig , &$Options , $Str )
		{
			try
			{
				$this->Trace->start_group( 'compile_buttons' );

				$Str = $this->compile_search_button( $ContextSetConfig , $Options , $Str );

				$Str = $this->compile_create_button( $ContextSetConfig , $Options , $Str );

				$Str = $this->compile_update_button( $ContextSetConfig , $Options , $Str );

				$Str = $this->compile_copy_button( $ContextSetConfig , $Options , $Str );

				$Str = $this->compile_delete_button( $ContextSetConfig , $Options , $Str );

				$this->Trace->end_group();

				$Str = str_replace( '{prefix}' , $ContextSetConfig->get_setting( 'prefix' , '' ) , $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>