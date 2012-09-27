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
	*	\~russian Класс вида.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english View class.
	*
	*	@author Dodonov A.A.
	*/
	class	review_view_1_0_0{

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
		var					$Security = false;
		var					$UserAlgorithms = false;

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - настройки работы модуля.
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
				$PageJS = get_package( 'page::page_js' , 'last' , __FILE__ );
				$PackagePath = _get_package_relative_path_ex( 'review::review_view' , '1.0.0::1.0.0' );
				$PageJS->add_javascript( "{http_host}/$PackagePath/include/js/review_view.js" );

				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				$Lang->include_strings_js( 'review::review_view' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки списка отзывов с формой ввода нового отзыва.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws a list of reviews.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			public_review_list( $Options )
		{
			try
			{
				$MasterId = $this->Security->get_gp( 'master_id' , 'integer' , $this->UserAlgorithms->get_id() );
				$MasterType = $Options->get_setting( 'master_type' , 'command' , 'user' );

				$this->Output  = '';
				$this->Output .= "{review_line:master_id=$MasterId;master_type=$MasterType}";
				$this->Output .= "{permit:registered}{review_form:master_id=$MasterId;".
									"master_type=$MasterType}{~permit}";
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

				$ContextSet->add_context( dirname( __FILE__ ).'/conf/cfcx_public_review_list' );

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