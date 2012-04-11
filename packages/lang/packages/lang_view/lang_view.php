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
	*	\~russian Класс для обработки строк с учетом языка.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides language dependent substitutions for strings.
	*
	*	@author Dodonov A.A.
	*/
	class	lang_view_1_0_0{

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
		var					$CachedMultyFS = false;
		var					$Lang = false;
		var					$LangMarkup = false;
	
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->Lang = get_package( 'lang' , 'last' , __FILE__ );
				$this->LangMarkup = get_package( 'lang::lang_markup' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian HTML код компонента.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english HTML code of the component.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output;
		
		/**
		*	\~russian Функция отрисовки формы смены языка.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws change language fom.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_locale_form( $Options )
		{
			try
			{
				$LangList = $this->Lang->get_list_of_languages();
				
				$Form = $this->CachedMultyFS->get_template( __FILE__ , 'lang_form.tpl' );
				$this->Output = $Form;
				
				foreach( $LangList as $Lang )
				{
					$LangFlag = $Lang === $this->Lang->get_locale() ? 'active' : 'inactive';
					
					$Template = $this->CachedMultyFS->get_template( __FILE__ , $LangFlag.'_lang.tpl' );
					
					$Template = str_replace( '{client_lang}' , $Lang , $Template );
					$this->Output = str_replace( '{lang_list}' , "$Template{lang_list}" , $this->Output );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция управления компонентом.
		*
		*	@param $Options - настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				if( $Options->get_setting( 'lang_file' , false ) )
				{
					$ComponentHTML = '{lang_file:'.$Options->get_all_settings().'}';
					$Changed = false;
					$ComponentHTML = $this->LangMarkup->process_string( $Options , $ComponentHTML , $Changed );
					return( '' );
				}
			
				$Context = get_package( 'gui::context' , 'last' , __FILE__ );

				$Context->load_config( dirname( __FILE__ ).'/conf/cfcx_set_locale_form' );
				if( $Context->execute( $Options , $this ) )return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>