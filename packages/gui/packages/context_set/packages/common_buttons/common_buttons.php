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
		var					$String = false;

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
		*	\~russian Функция отвечающая за обработку кнопки поиска.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $ControlCode - Обрабатывемая строка.
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
		*	@param $ControlCode - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_search_button_creation( &$ContextSetConfig , &$Options , $ControlCode )
		{
			try
			{
				$Config = $this->ContextSetConfigs->load_common_state_config( 
					$ContextSetConfig , 
					'common_state_config_search_form' , 
					'cfcxs_search_form' , $Options->get_setting( 'file_path' )
				);

				$ExtOptions = false;

				$ControlCode = str_replace( 
					'{search_button}' , 
					$this->get_common_button_content( $Config , $ExtOptions , 'search' ) , $ControlCode 
				);

				return( $ControlCode );
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
		*	\~russian Функция отвечающая за обработку кнопки создания.
		*
		*	@param $ContextSetConfig - Настройки набора контекстов.
		*
		*	@param $Options - Параметры отображения.
		*
		*	@param $ControlCode - Обрабатывемая строка.
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
		*	@param $ControlCode - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_create_button_creation( &$ContextSetConfig , &$Options , $ControlCode )
		{
			try
			{
				$Config = $this->get_config( $ContextSetConfig , $Options , 'create_form' );

				if( strpos( $ControlCode , '{create_button}' ) !== false )
				{
					$ControlCode = str_replace( '{create_button}' , '{create_button:p=1}' , $ControlCode );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $ControlCode , 'create_button' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$ButtonCode = $this->get_common_button_content( $Config , $this->Settings , 'create' );

					$ControlCode = str_replace( "{create_button:$Parameters}" , $ButtonCode , $ControlCode );
				}

				return( $ControlCode );
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
		*	@param $ControlCode - Обрабатывемая строка.
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
		*	@param $ControlCode - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_update_button_creation( &$ContextSetConfig , &$Options , $ControlCode )
		{
			try
			{
				$Config = $this->get_config( $ContextSetConfig , $Options , 'update_form' );

				if( strpos( $ControlCode , '{update_button}' ) !== false )
				{
					$ControlCode = str_replace( '{update_button}' , '{update_button:p=1}' , $ControlCode );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $ControlCode , 'update_button' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$ButtonCode = $this->get_common_button_content( $Config , $this->Settings , 'update' );

					$ControlCode = str_replace( "{update_button:$Parameters}" , $ButtonCode , $ControlCode );
				}

				return( $ControlCode );
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
		*	@param $ControlCode - Обрабатывемая строка.
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
		*	@param $ControlCode - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_copy_button_creation( &$ContextSetConfig , &$Options , $ControlCode )
		{
			try
			{
				$Config = $this->get_config( $ContextSetConfig , $Options , 'copy_form' );

				if( strpos( $ControlCode , '{copy_button}' ) !== false )
				{
					$ControlCode = str_replace( '{copy_button}' , '{copy_button:p=1}' , $ControlCode );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $ControlCode , 'copy_button' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					
					$ButtonCode = $this->get_common_button_content( $Config , $this->Settings , 'copy' );
					
					$ControlCode = str_replace( "{copy_button:$Parameters}" , $ButtonCode , $ControlCode );
				}

				return( $ControlCode );
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
		*	@param $ControlCode - Обрабатывемая строка.
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
		*	@param $ControlCode - Processing string.
		*
		*	@return HTML code to display.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_delete_button_creation( &$ContextSetConfig , &$Options , $ControlCode )
		{
			try
			{
				$Config = $this->get_config( $ContextSetConfig , $Options , 'delete_button' );

				if( strpos( $ControlCode , '{delete_button}' ) !== false )
				{
					$ControlCode = str_replace( '{delete_button}' , '{delete_button:p=1}' , $ControlCode );
				}

				for( ; $Parameters = $this->String->get_macro_parameters( $ControlCode , 'delete_button' ) ; )
				{
					$this->Settings->load_settings( $Parameters );

					$ButtonCode = $this->get_common_button_content( $Config , $this->Settings , 'delete' );

					$ControlCode = str_replace( "{delete_button:$Parameters}" , $ButtonCode , $ControlCode );
				}

				return( $ControlCode );
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
		function			process_buttons( &$ContextSetConfig , &$Options , $Str )
		{
			try
			{
				$Str = $this->process_search_button_creation( $ContextSetConfig , $Options , $Str );

				$Str = $this->process_create_button_creation( $ContextSetConfig , $Options , $Str );

				$Str = $this->process_update_button_creation( $ContextSetConfig , $Options , $Str );

				$Str = $this->process_copy_button_creation( $ContextSetConfig , $Options , $Str );

				$Str = $this->process_delete_button_creation( $ContextSetConfig , $Options , $Str );

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