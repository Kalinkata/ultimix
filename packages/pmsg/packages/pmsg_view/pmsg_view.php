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
	*	\~russian Работа с личными сообщениями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with private messages.
	*
	*	@author Dodonov A.A.
	*/
	class	pmsg_view_1_0_0{
	
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
		var					$PageCSS = false;
		var					$PmsgAlgorithms = false;

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
				$this->PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );
				$this->PmsgAlgorithms = get_package( 'pmsg::pmsg_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
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
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$Path = _get_package_relative_path_ex( 'pmsg::pmsg_view' , '1.0.0' );
				
				$this->PageCSS->add_stylesheet( "{http_host}/$Path/res/css/pmsg.css" , true );
				
				$this->PageCSS->add_javascript( "{http_host}/$Path/include/js/pmsg.js" );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция ввывода формы обратной связи.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs feedback form.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_feedback_form()
		{
			try
			{
				$CachedFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$String = get_package( 'string' , 'last' , __FILE__ );
				$SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
				
				$Form = $CachedFS->get_template( __FILE__ , 'feedback.tpl' );
				
				$Record = $SecurityParser->parse_http_parameters( 'message:string,allow_not_set' );
				
				$Form = $String->print_record( $Form , $Record );
				
				$this->Output = $Form;
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
		function			view( $Options )
		{
			try
			{			
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_list_outgoing' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_list_deleted' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_feedback' );
				
				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_solid_control' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отвечающая за обработку строки.
		*
		*	@param $Settings - Gараметры отображения.
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
		function			compile_not_read_messages_count( &$Settings )
		{
			try
			{
				return( $this->PmsgAlgorithms->get_not_read_messages_count() );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>