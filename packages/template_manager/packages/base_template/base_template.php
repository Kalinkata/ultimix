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
	*	\~russian Класс шаблона.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class of the template.
	*
	*	@author Dodonov A.A.
	*/
	class		base_template_1_0_0{

		/**
		*	\~russian Содержимое шаблона.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Template content.
		*
		*	@author Dodonov A.A.
		*/
		var					$Template = false;

		/**
		*	\~russian Закэшированные объекты.
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
		var					$Lang = false;
		var					$Security = false;
		var					$Settings = false;
		var					$String = false;
		var					$Tags = false;

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
				$this->Lang = get_package( 'lang' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );

				$this->StylesheetParsed = false;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция добавляет стили шаблона.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function adds teplate's stylesheets.
		*
		*	@param $File - Real path to the template script.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			add_stylesheets( $File )
		{
			try
			{
				if( $this->CachedMultyFS->file_exists( dirname( $File ).'/res/css/css_list' ) )
				{
					$List = $this->CachedMultyFS->file_get_contents( 
						dirname( $File ).'/res/css/css_list' , 'exploded'
					);

					$PageCSS = get_package( 'page::page_css' , 'last' , __FILE__ );

					foreach( $List as $k => $v )
					{
						$PageCSS->add_stylesheet( 
							str_replace( './' , '{http_host}/' , _get_package_relative_path( $File )."/res/css/$v" )
						);
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция парсит в шаблоне переменную $Variable.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $Variable - Название переменной, которую нужно парсить.
		*
		*	@param $Value - значение, которое будет вставлено на место переменной $Variable.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function parse variable with name $Variable.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $Variable - name of the template variable.
		*
		*	@param $Value - value to place in the template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse( $File , $Variable , $Value )
		{
			try
			{
				if( $this->Template === false )
				{
					$this->Template = $this->get_template( $File );
				}

				if( strpos( $this->Template , '{'.$Variable.'}' ) !== false )
				{
					$Variable = $this->Security->get( $Variable , 'string' );
					$this->Template = str_replace( '{'.$Variable.'}' , $Value.'{'.$Variable.'}' , $this->Template );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция пытается подменить шаблон.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tries override template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			extract_template_name()
		{
			try
			{
				if( $this->Security->get_gp( 'template' , 'set' ) )
				{
					$TemplateName = $this->Security->get_gp( 'template' , 'command' );

					if( $TemplateName == 'ajax_result_template' || 
						$TemplateName == 'primitive' || 
						$TemplateName == 'print' || 
						$TemplateName == 'standalone_view' )
					{
						return( $TemplateName );
					}
					else
					{
						throw( new Exception( "Template \"$TemplateName\" was not found" ) );
					}
				}
				
				return( 'template' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция осуществляет обработку блока 'template'.
		*
		*	@param $PageName - Название страницы для которой осуществляется предкомпиляция.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes 'template' block.
		*
		*	@param $PageName - Page name for precompilation.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_template_block( $PageName , &$Changed )
		{
			try
			{
				if( $this->String->block_exists( $this->Template , 'template:'.$PageName , 'template:~'.$PageName ) )
				{
					$Changed = true;
					$this->Template = $this->String->show_block( 
						$this->Template , 'template:'.$PageName , 'template:~'.$PageName , $Changed
					);
				}
				else
				{
					if( $this->String->block_exists( $this->Template , 'template:_default_page' , 
																						'template:~_default_page' ) )
					{
						$Changed = true;
						$this->Template = $this->String->show_block( 
							$this->Template , 'template:_default_page' , 'template:~_default_page' , $Changed
						);
					}
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция осуществляет предкомпиляцию шаблона.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function precompiles template.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	process_includes( $File , &$Changed )
		{
			try
			{
				for( ; $BlockName = $this->String->get_macro_parameters( $this->Template , 'include' ) ; )
				{
					$IncludedTemplate = $this->CachedMultyFS->get_template( $File , "$BlockName.tpl" );

					$this->Template = str_replace( "{include:$BlockName}" , $IncludedTemplate , $this->Template );
					$Changed = true;
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция осуществляет предкомпиляцию шаблона.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $PageName - Название страницы для которой осуществляется предкомпиляция.
		*
		*	@param $Changed - true если какой-то из элементов страницы был скомпилирован.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function precompiles template.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $PageName - Page name for precompilation.
		*
		*	@param $Changed - true if any of the page's elements was compiled.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process( $File , $PageName , &$Changed )
		{
			try
			{
				if( $this->Template === false )
				{
					$this->Template = $this->get_template( $File );
				}
				$this->Template = $this->get_template();

				$this->process_template_block( $PageName , $Changed );

				$this->Template = $this->String->hide_unprocessed_blocks( $this->Template , 'template' , $Changed );

				$this->process_includes( $File , $Changed );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция возвращает реальное имя плэйсхолдера вместе с параметрами.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $PurePlaceHolderName - имя плэйсхолдера без параметров.
		*
		*	@return HTML код скомпонованной страницы.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns Real placeholder's name.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $PurePlaceHolderName - Name of the placeholder.
		*
		*	@return HTML code of the composed page.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_placeholder_parameters( $File , $PurePlaceHolderName )
		{
			try
			{
				if( $this->Template === false )
				{
					$this->Template = $this->get_template( $File );
				}

				if( $this->String->block_exists( $this->Template , $PurePlaceHolderName ) )
				{
					$Params = $this->String->get_macro_parameters( $this->Template , $PurePlaceHolderName );
					return( $Params );
				}
				else
				{
					return( false );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция макрос 'color_scheme'.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $Str - Обрабатываемая строка.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'color_scheme'.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $Str - Processing string.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_color_scheme( $File , $Str )
		{
			try
			{
				for( ; $Params = $this->String->get_macro_parameters( $Str , 'color_scheme' ) ; )
				{
					$this->BlockSettings->load_settings( $Params );
					$Available = explode( ',' , $this->BlockSettings->get_setting( 'available' , 'default' ) );

					$ColorScheme = $this->Settings->get_setting( 'color_scheme' , 'default' );

					if( array_search( $ColorScheme , $Available ) !== false )
					{
						$Str = str_replace( "{color_scheme:$Params}" , $ColorScheme , $Str );
					}
					else
					{
						$Str = str_replace( "{color_scheme:$Params}" , 'default' , $Str );
					}
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция зачищает HTML код шаблона от плэйсхолдеров.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $Str - Обрабатываемая строка.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function clears all placeholder in the HTML code of the template.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $Str - Processing string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_string( $File , $Str )
		{
			try
			{
				if( $this->Settings === false )
				{
					$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
					if( $this->CachedMultyFS->file_exists( dirname( $File ).'/conf/cf_template_settings' ) )
					{
						$this->Settings->load_file( dirname( $File ).'/conf/cf_template_settings' );
					}
				}

				$Str = str_replace( 
					array( '{color_scheme}' , '{locale}' ) , 
					array( '{color_scheme:available=default}' , $this->Lang->get_locale() ) , 
					$Str
				);

				$Str = $this->process_color_scheme( $File , $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Подстановки капчи.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $PageName - Название страницы, для которой осуществляется предкомпиляция.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Captcha substitutions.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $PageName - Page name for precompilation.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	captcha_substitutions( $File , $PageName )
		{
			try
			{
				$PlaceHolders = array( '{captcha_image}' , '{captcha_field}' );
				
				$Subs = array( 
					'<img src="./captcha.html" align="top">' , 
					'<input type="text" class="flat width_100" size="25" name="captcha" value="" '.
						'style="text-align: center;">'
				);
				
				$this->Template = str_replace( $PlaceHolders , $Subs , $this->Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Стандартные подстановки.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $PageName - Название страницы, для которой осуществляется предкомпиляция.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Standart substitutions.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $PageName - Page name for precompilation.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	standart_substitutions( $File , $PageName )
		{
			try
			{
				global 		$StartGenerationTime;

				$PlaceHolders = array( 
					'{template_path}' , '{gen_time}' , '{captcha}' , 
					'[page_name]' , '/./' , '[random]' , '{request_uri}'
				);

				$Subs = array( 
					_get_package_relative_path( $File ) , microtime( true ) - $StartGenerationTime , 
					'{captcha_image}&nbsp;{captcha_field}' , $PageName , '/' , rand() , 
					$this->Security->get_srv( 'REQUEST_URI' , 'string' )
				);
				$this->Template = str_replace( $PlaceHolders , $Subs , $this->Template );

				$this->captcha_substitutions( $File , $PageName );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Зачистка плэйсхолдеров.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function clears placeholders.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			cleanup_placeholders()
		{
			try
			{
				$PlaceHolders = array( 
					'{header}' , '{footer}' , '{title}' , '{some_menu}' , '{pathway}' , '{menu}' , '{error_message}' , 
					'{success_message}' , '{main}' , '{bottom}' , '{banner}' , '{banners}'
				);
				$this->Template = str_replace( $PlaceHolders , '' , $this->Template );

				$c = 0;
				$PlaceHolders = array();

				do
				{
					preg_match( '/\{([a-zA-Z0-9_]+)\}/' , $this->Template , $PlaceHolders );

					$c = count( $PlaceHolders );

					if( $c > 1 )
					{
						$this->Template = str_replace( '{'.$PlaceHolders[ 1 ].'}' , '' , $this->Template );
					}
				}
				while( $c > 1 );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция зачищает HTML код шаблона от плэйсхолдеров.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@param $PageName - Название страницы, для которой осуществляется предкомпиляция.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function clears all placeholder in the HTML code of the template.
		*
		*	@param $File - Real path to the template script.
		*
		*	@param $PageName - Page name for precompilation.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			cleanup( $File , $PageName )
		{
			try
			{
				if( $this->Template === false )
				{
					$this->Template = $this->get_template( $File );
				}

				$this->Template = $this->Tags->compile_ultimix_tags( $this->Template );

				$this->standart_substitutions( $File , $PageName );

				$this->cleanup_placeholders();

				$this->Template = $this->process_string( $File , $this->Template );

				$this->Template = str_replace( array( '[lfb]' , '[rfb]' ) , array( '{' , '}' ) , $this->Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает HTML код шаблона.
		*
		*	@param $File - Реальный путь к скрипту шаблона.
		*
		*	@return HTML код шаблона.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns HTML code of the template.
		*
		*	@param $File - Real path to the template script.
		*
		*	@return HTML code of the template.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template( $File = '' )
		{
			try
			{
				if( $this->Template === false )
				{
					/* чтение шаблона в переменную */
					$TemplateName = $this->extract_template_name();
					$this->Template = $this->CachedMultyFS->get_template( $File , "$TemplateName.tpl" );
				}

				/* pre-обработка шаблона завершена, поэтому можно отдавать его клиентским пакетам */
				return( $this->Template );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция устанавливает HTML код шаблона.
		*
		*	@param $theTemplate - HTML код шаблона.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets HTML code of the template.
		*
		*	@param $theTemplate - template's HTML code.
		*
		*	@author Dodonov A.A.
		*/
		function			set_template( $theTemplate )
		{
			$this->Template = $theTemplate;
		}
	};

?>