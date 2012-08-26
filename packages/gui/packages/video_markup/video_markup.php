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
	*	\~russian Класс обработки видео макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes video macro.
	*
	*	@author Dodonov A.A.
	*/
	class	video_markup_1_0_0
	{
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
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция макроса.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@param $TemplateName - Название шаблона.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compile macro.
		**
		*	@param $Settings - Fetch settings.
		*
		*	@param $TemplateName - Template name.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_template( &$Settings , $TemplateName )
		{
			try
			{
				$Hash = $Settings->get_setting( 'hash' );
				$Width = $Settings->get_setting( 'width' , '640' );
				$Height = $Settings->get_setting( 'height' , '480' );
				$Autoplay = $Settings->get_setting( 'autoplay' , '0' );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , $TemplateName );

				$Code = str_replace( 
					array( '{hash}' , '{width}' , '{height}' , '{autoplay}' ) , 
					array( $Hash , $Width , $Height , $Autoplay ) , $Code
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция макроса 'rutube'.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compile macro 'rutube'.
		**
		*	@param $Settings - Fetch settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_rutube( &$Settings )
		{
			try
			{
				return( $this->compile_template( &$Settings , 'rutube.tpl' ) );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}

		/**
		*	\~russian Компиляция макроса 'youtube'.
		*
		*	@param $Settings - Параметры выборки.
		*
		*	@return HTML код.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compile macro 'youtube'.
		**
		*	@param $Settings - Fetch settings.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_youtube( &$Settings )
		{
			try
			{
				return( $this->compile_template( &$Settings , 'youtube.tpl' ) );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();_throw_exception_object( __METHOD__ , $Args , $e );
			}
		}
	}

?>