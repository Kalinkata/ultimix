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
	*	\~russian Класс для обработки страниц с учетом доступов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides permits dependent visualisation.
	*
	*	@author Dodonov A.A.
	*/
	class		group_buttons_1_0_0{
		
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
		var					$CachedMultyFS = false;
		var					$Settings = false;
		var					$String = false;
		
		/**
		*	\~russian Добавлен ли контроллер.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Was the controller added.
		*
		*	@author Dodonov A.A.
		*/
		var					$ControllerWasAdded = false;
		
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание вызова контроллера.
		*
		*	@return Скрипт вызова контроллера.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates controller call.
		*
		*	@return Script with the controller call.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_controller()
		{
			try
			{
				$Code = '';
				
				if( $this->ControllerWasAdded === false )
				{
					$Code = '{direct_controller:set_group=1;delete_group=1;toggle_group=1;'.
							'package_name=permit::permit_controller}';
					
					$this->ControllerWasAdded = true;
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция копиляции макроса 'set_group_button'.
		*
		*	@param $Parameters - Параметры обработки.
		*
		*	@return Виджет.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles macro 'set_group_button'.
		*
		*	@param $Parameters - Processing options.
		*
		*	@return Widget.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_set_group_button( $Parameters )
		{
			try
			{
				$this->Settings->load_settings( $Params );
					
				list( $Text , $Group , $MasterId ) = $this->Settings->get_settings( 'text,group,master_id' );
				$MasterType = $this->Settings->get_setting( 'master_type' , 'user' );
				$CheckBoxes = $this->Settings->get_setting( 'checkboxes' , 'user' );
				
				$Code = $this->get_controller();
				$Code .= "{href:text=$Text;page=javascript:ultimix.permit.SetGroupButton".
					"( '$Group' , $MasterId , '$MasterType' , '$CheckBoxes' )}";
					
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'set_group_button'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'set_group_button'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_set_group_button( $Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 
					'group' => TERMINAL_VALUE , 'master_id' => TERMINAL_VALUE , 'master_type' => TERMINAL_VALUE
				);

				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'toggle_group_button' , $Rules ) ; )
				{
					$Code = $this->compile_set_group_button( $Parameters );

					$Str = str_replace( "{set_group_button:$Parameters}" , $Code , $Str );
					$Changed = true;
				}

				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Компиляция кнопки.
		*
		*	@param $Settings - Параметры обработки.
		*
		*	@return Кнопка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles button.
		*
		*	@param $Settings - Processing options.
		*
		*	@return Button.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_group_button( &$Settings , $Name )
		{
			try
			{
				list( $Text , $Group , $MasterId ) = $Settings->get_settings( 'text,group,master_id' );
				$MasterType = $Settings->get_setting( 'master_type' , 'user' );
				$CheckBoxes = $Settings->get_setting( 'checkboxes' , 'user' );
				
				$Code = $this->get_controller();
				$Code .= "{href:text=$Text;page=javascript:ultimix.permit.".$Name."GroupButton".
					"( '$Group' , $MasterId , '$MasterType' , '$CheckBoxes' )}";
					
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'delete_group_button'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'delete_group_button'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_delete_group_button( $Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 
					'group' => TERMINAL_VALUE , 'master_id' => TERMINAL_VALUE , 'master_type' => TERMINAL_VALUE
				);
				
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'toggle_group_button' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Params );
					
					$Code = $this->compile_group_button( $this->Settings , 'Delete' );
					
					$Str = str_replace( "{delete_group_button:$Params}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'toggle_group_button'.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - Была ли осуществлена обработка.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'toggle_group_button'.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - Was the processing completed.
		*
		*	@return array( $Str , $Changed ).
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_toggle_group_button( $Options , $Str , $Changed )
		{
			try
			{
				$Rules = array( 
					'group' => TERMINAL_VALUE , 'master_id' => TERMINAL_VALUE , 'master_type' => TERMINAL_VALUE
				);
				
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'toggle_group_button' , $Rules ) ; )
				{
					$this->Settings->load_settings( $Params );
					
					compile_group_button( $this->Settings , 'Toggle' );
					
					$Str = str_replace( "{toggle_permit_button:$Params}" , $Code , $Str );
					$Changed = true;
				}
				
				return( array( $Str , $Changed ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки страницы.
		*
		*	@param $Options - Параметры обработки.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes page.
		*
		*	@param $Options - Processing options.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_set_group_button( $Options , $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_delete_group_button( $Options , $Str , $Changed );
				
				list( $Str , $Changed ) = $this->process_toggle_group_button( $Options , $Str , $Changed );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>