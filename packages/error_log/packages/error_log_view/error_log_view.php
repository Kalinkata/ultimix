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
	*	\~russian Подключение error log'а.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Error log' implementation.
	*
	*	@author Dodonov A.A.
	*/
	class	error_log_view_1_0_0{
	
		/**
		*	\~russian Загрузка шаблонов.
		*
		*	@param $Paging - Грид.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets grid's templates.
		*
		*	@param $Paging - Grid.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	set_templates( &$Paging , &$Options )
		{
			try
			{
				$Paging->set( 'Header' , $CachedFS->get_template( __FILE__ , 'header.tpl' ) );
				$Paging->set( 'Footer' , $CachedFS->get_template( __FILE__ , 'footer.tpl' ) );
				$Paging->set( 'ItemTemplate' , $CachedFS->get_template( __FILE__ , 'item_template.tpl' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция ввывода списка загруженных файлов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs list of the uploaded files.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_list_of_messages( &$Options )
		{
			try
			{
				$CachedFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$Paging = get_package( 'gui::paging' , 'last' , __FILE__ );
				$Paging->set( 'FormId' , 'error_log_form' );
				$Paging->set( 'Prefix' , 'error_log' );
				$this->set_templates( $Paging , $Options );
				$Paging->set( 
					'DataAccessor' , 
					create_function( 
						'$s , $l , $f , $o' , 
						"\$ErrorLogAlgorithms = get_package( 'error_log::error_log_algorithms' , 'last' , __FILE__ ".
						");return( \$ErrorLogAlgorithms->select_messages( \$s , \$l , \$f , \$o ) );"
					)
				);
				$this->Output = $Paging->draw();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция отрисовки копонента.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@return HTML формы.
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws component.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the form.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( &$Options )
		{
			try
			{
				$Context = get_package( 'gui::context' , 'last' , __FILE__ );

				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_list_of_messages' );
				if( $Context->execute( $Options , $this ) )return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>