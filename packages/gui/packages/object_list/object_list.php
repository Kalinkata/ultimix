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
	*	\~russian Класс вывода списков объектов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class displays lists of objects.
	*
	*	@author Dodonov A.A.
	*/
	class	object_list_1_0_0
	{
		/**
		*	\~russian Переменная в которой будет храниться вывод.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Variable stores generated HTML.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output;
		
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
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения шаблонов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return Templates.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns templates.
		*
		*	@param $Options - Settings.
		*
		*	@return Templates.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_templates( &$Options )
		{
			try
			{
				$DirPath = dirname( __FILE__ )."/res/templates/";
				
				$FileName = $Options->get_setting( 'header' , 'header' );
				$Header = $this->CachedMultyFS->file_get_contents( "$DirPath$FileName.tpl" );
				
				$FileName = $Options->get_setting( 'item' , 'item' );
				$Item = $this->CachedMultyFS->file_get_contents( "$DirPath$FileName.tpl" );
				
				$FileName = $Options->get_setting( 'footer' , 'footer' );
				$Footer = $this->CachedMultyFS->file_get_contents( "$DirPath$FileName.tpl" );
				
				return( array( $Header , $Item , $Footer ) );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
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
		function			draw_object_list( &$Options )
		{
			try
			{
				$this->Output = '';

				$Name = $Options->get_setting( 'package_name' );
				$Version = $Options->get_setting( 'package_version' , 'last' );
				$Package = get_package( $Name , $Version , __FILE__ );
				$FunctionName = $Options->get_setting( 'select_func_name' , 'select' );

				$Records = call_user_func( array( $Object , $FunctionName ) , 0 , 1000000 , false , false )
				
				list( $Header , $Item , $Footer ) = $this->get_templates( $Options );

				foreach( $Records as $i => $Record )
				{
					$this->Output .= $this->String->print_record( $Item , $Record );
				}

				$this->Output = $Header.$this->Output.$Footer;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку макроса 'object_line'.
		*
		*	@param $Str - Обрабатывемая строка.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'object_line'.
		*
		*	@param $Str - Processing string.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_object_list( $Str , $Changed )
		{
			try
			{
				for( ; $Parameters = $this->String->get_macro_parameters( $Str , 'object_list' ) ; )
				{
					$this->BlockSettings->load_settings( $Parameters );

					$this->draw_object_list( $this->BlockSettings );

					$Str = str_replace( "{object_list:$Parameters}" , $this->Output , $Str );
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
		*	\~russian Функция обработки строки.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Str - Строка требуюшщая обработки.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes string.
		*
		*	@param $Options - Settings.
		*
		*	@param $Str - String to process.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( &$Options , $Str , &$Changed )
		{
			try
			{
				list( $Str , $Changed ) = $this->process_object_list( $Str , $Changed );
				
				return( $Str );
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
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the компонента.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_object_list' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>