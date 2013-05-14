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
	*	\~russian Класс поиска по сайту.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides site search routine.
	*
	*	@author Dodonov A.A.
	*/
	class	search_markup_1_0_0{

		/**
		*	\~russian Закешированные пакеты.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$CachedMultyFS = false;

		/**
		*	\~russian Результат работы функций отображения.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Display function's result.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output = false;

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
		*	\~russian Компиляция формы.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код формы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles search form.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code of the widget.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_search_fields( &$Settings )
		{
			try
			{
				if( $Settings->get_setting( 'fields' , false ) === false )
				{
					return( '' );
				}

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'search_fields.tpl' );
				$Fields = explode( ',' , $Settings->get_setting( 'fields' ) );
				$Labels = explode( ',' , $Settings->get_setting( 'labels' ) );

				foreach( $Fields as $i => $Field )
				{
					$Tmp = $this->CachedMultyFS->get_template( __FILE__ , 'search_field.tpl' );
					$Field = str_replace( '.' , '_dot_' , $Field );
					$Tmp = str_replace( array( '{name}' , '{label}' ) , array( $Field , $Labels[ $i ] ) , $Tmp );
					$Code .= $Tmp;
				}

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Компиляция формы.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return HTML код формы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles search form.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return HTML code of the widget.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_search_form( &$Settings )
		{
			try
			{
				list( $Speed , $Prefix , $FormId , $Action ) = $Settings->get_settings( 
					'speed,prefix,form_id,action' , '500,common,search_form,'
				);

				$TemplateFileName = $Prefix == 'common' ? 'common_search_form.tpl' : 'custom_search_form.tpl';

				$Code = $this->CachedMultyFS->get_template( __FILE__ , $TemplateFileName );

				$Fields = $this->compile_search_fields( $Settings );

				$Code = str_replace( 
					array( '{speed}' , '{prefix}' , '{form_id}' , '{action}' , '{fields}' ) , 
					array( $Speed , $Prefix , $FormId , $Action , $Fields ) , 
					$Code
				);

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>