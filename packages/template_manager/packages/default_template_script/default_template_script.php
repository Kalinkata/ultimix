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
	*	\~russian Класс манипулирования пакетами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for manipulating objects.
	*
	*	@author Dodonov A.A.
	*/
	class	default_template_script_1_0_0{
	
		/**
		*	\~russian Путь к пакету шаблона.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Path to the template's package.
		*
		*	@author Dodonov A.A.
		*/
		var				$TemplatePackagePath = false;
	
		/**
		*	\~russian Функция установки пути к шаблону.
		*
		*	@param $theTemplatePackagePath - путь к пакету шаблона.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets path to template.
		*
		*	@param $theTemplatePackagePath - path to the emplate's package.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_template_path( $theTemplatePackagePath )
		{
			try
			{
				$this->TemplatePackagePath = $theTemplatePackagePath;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция осуществляет предкомпиляцию шаблона.
		*
		*	@param $PageName - название страницы для которой осуществляется предкомпиляция.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function precompiles template.
		*
		*	@param $PageName - page name for precompilation.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process( $PageName )
		{
			try
			{
				$Changed = false;
				$this->TemplateParser->process( $this->TemplatePackagePath , $PageName , $Changed );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает реальное имя плэйсхолдера вместе с параметрами.
		*
		*	@param $PurePlaceHolderName - имя плэйсхолдера без параметров.
		*
		*	@return HTML код скомпонованной страницы.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns real placeholder's name.
		*
		*	@param $PurePlaceHolderName - Name of the placeholder.
		*
		*	@return HTML code of the composed page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_placeholder_parameters( $PurePlaceHolderName )
		{
			try
			{
				return( 
					$this->TemplateParser->get_placeholder_parameters( 
						$this->TemplatePackagePath , $PurePlaceHolderName 
					) 
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Парсер шаблонов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Template parser.
		*
		*	@author Dodonov A.A.
		*/
		var					$TemplateParser = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Додонов А.А.
		*/
		function			__construct()
		{
			try
			{
				$this->TemplateParser = get_package( 'template_manager::base_template' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция парсит в шаблоне переменную $Variable.
		*
		*	@param $Variable - Название переменной, которую нужно парсить.
		*
		*	@param $Value - Значение, которое будет вставлено на место переменной $Variable.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parse variable with name $Variable.
		*
		*	@param $Variable - Name of the template variable.
		*
		*	@param $Value - Value to place in the template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse( $Variable , $Value )
		{
			try
			{
				$this->TemplateParser->parse( $this->TemplatePackagePath , $Variable , $Value );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция добавляет стили шаблона.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds teplate's stylesheets.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_stylesheets()
		{
			try
			{
				$this->TemplateParser->add_stylesheets( $this->TemplatePackagePath );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки строки.
		*
		*	@param $String - Обрабатываемая строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process string.
		*
		*	@param $String - Processing string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_string( $String )
		{
			try
			{
				return( $this->TemplateParser->compile_string( $this->TemplatePackagePath , $String ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция зачищает HTML код шаблона от плэйсхолдеров.
		*
		*	@param $PageName - Название страницы для которой осуществляется предкомпиляция.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function clears all placeholder in the HTML code of the template.
		*
		*	@param $PageName - Page name for precompilation.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			cleanup( $PageName )
		{
			try
			{
				$this->TemplateParser->cleanup( $this->TemplatePackagePath , $PageName );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция возвращает HTML код шаблона.
		*
		*	@return HTML код шаблона.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns HTML code of the template.
		*
		*	@return HTML code of the template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template()
		{
			try
			{
				return( $this->TemplateParser->get_template( $this->TemplatePackagePath ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция устанавливает HTML код шаблона.
		*
		*	@param $Template - HTML код шаблона.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets HTML code of the template.
		*
		*	@param $Template - Еemplate's HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_template( $Template )
		{
			try
			{
				return( $this->TemplateParser->set_template( $Template ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>