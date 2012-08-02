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
	*	\~russian Строковые утилиты.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english String utilities.
	*
	*	@author Dodonov A.A.
	*/
	class	tags_1_0_0{

		/**
		*	\~russian Функция обработки phpbb тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes phpbb tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_format_tags( $Str )
		{
			try
			{
				$Str = preg_replace( "/\[b\](.*)\[\/b\]/U" , "<b>\\1</b>" , $Str );
				$Str = preg_replace( "/\[u\](.*)\[\/u\]/U" , "<u>\\1</u>" , $Str );
				$Str = preg_replace( "/\[i\](.*)\[\/i\]/U" , "<i>\\1</i>" , $Str );
				$Str = preg_replace( "/\[s\](.*)\[\/s\]/U" , "<s>\\1</s>" , $Str );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки phpbb тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes phpbb tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_publish_tags( $Str )
		{
			try
			{
				$Str = preg_replace( "/\[img=(.*)\]/U" , "<img src=\"\\1\">" , $Str );
				$Str = preg_replace( "/\[code\](.*)\[\/code\]/U" , "<pre>\\1</pre>" , $Str );
				$Str = preg_replace( "/\[email\](\w*)\[\/email\]/U" , "<"."a href=\"mailto:\\1\">\\1</a>" , $Str );
				$Str = preg_replace( "/\[url=(.*)\](.*)\[\/url\]/U" , "<"."a href=\"\\1\">\\2</a>" , $Str );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки phpbb тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes phpbb tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_list_tags( $Str )
		{
			try
			{
				$Str = preg_replace( "/\[list\](.*)\[\/list\]/U" , "<ul>\\1</ul>" , $Str );
				$Str = preg_replace( 
					"/\[list=1\](.*)\[\/list\]/U" , "<ol style=\"list-style-type: decimal;\">\\1</ol>" , $Str
				);
				$Str = preg_replace( 
					"/\[list=a\](.*)\[\/list\]/U" , "<ol style=\"list-style-type: lower-alpha;\">\\1</ol>" , $Str
				);
				$Str = preg_replace( "/\[\*\]/U" , "<li>" , $Str );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки phpbb тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes phpbb tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_content_tags( $Str )
		{
			try
			{
				$Str = preg_replace( 
					"/\[spoiler\](.*)\[\/spoiler\]/U" , 
					"<span id=\"spoiler\"><span id=\"spoiler_header\">{lang:hidden_text}</span>\\2</span>" , $Str
				);
				$Str = preg_replace( 
					"/\[spoiler=(.*)\](.*)\[\/spoiler\]/U" , 
					"<span id=\"spoiler\"><span id=\"spoiler_header\">\\1</span>\\2</span>" , $Str
				);
				$Str = preg_replace( "/\[hr\]/U" , "<hr>" , $Str );
				$Str = preg_replace( "/\[hr=(\d+)\]/U" , "<hr width=\"\\1%\">" , $Str );
				$Str = preg_replace( "/\[name=(.+)\]/U" , "<"."a name=\"\\1\">" , $Str );
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки phpbb тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes phpbb tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_style_tags( $Str )
		{
			try
			{
				$Str = preg_replace( 
					"/\[size=(\d*)\](.*)\[\/size\]/U" , "<span style=\"font-size:\\1px;\">\\2</span>" , $Str
				);
				$Str = preg_replace( 
					"/\[color=(\d*)\](.*)\[\/color\]/U" , "<span style=\"color:\\1px;\">\\2</span>" , $Str
				);
				$Str = preg_replace( "/\[quote\](.*)\[\/qoute\]/U" , "<span class=\"quote\">\\1</span>" , $Str );
				$Str = preg_replace( 
					"/\[align=(\w*)\](.*)\[\/align\]/U" , "<span style=\"text-align:\\1px;\">\\2</span>" , $Str
				);
				
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки phpbb тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes phpbb tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_phpbb_tags( $Str )
		{
			try
			{
				$Str = $this->compile_format_tags( $Str );

				$Str = $this->compile_publish_tags( $Str );

				$Str = $this->compile_content_tags( $Str );

				$Str = $this->compile_list_tags( $Str );

				$Str = $this->compile_style_tags( $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки ultimix тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes ultimix tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_date_tags( $Str )
		{
			try
			{
				$Placeholders = array( 
					'{sysdate}' , '{D}' , '{l}' , '{F}' , '{m}' , '{M}' , '{n}' , '{Y}' , '{systime}'
				);

				$Replacers = array( 
					date( 'Y-m-d' ) , date( 'D' ) , date( 'l' ) , date( 'F' ) , date( 'm' ) , 
					date( 'M' ) , date( 'n' ) , date( 'Y' ) , date( 'H:i:s' )
				);

				return( str_replace( $Placeholders , $Replacers , $Str ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки ultimix тэгов.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes ultimix tags.
		*
		*	@param $Str - String to process.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_ultimix_tags( $Str )
		{
			try
			{
				$Placeholders = array( 
					'{lfb}' , '{rfb}' , '{eq}' , '[dot_comma]' , '[dot_dot]' , '[nbsp]' , '[eq]' , '{http_host}' , 
					'{server_name}' , '[amp]' , '[r]' , '[n]' , '[sharp]' , '[br]'
				);
				$Replacers = array( 
					'{' , '}' , '=' , ';' , ':' , '&nbsp;' , '=' , @HTTP_HOST , 
					$_SERVER[ 'SERVER_NAME' ] , '&' , "\r" , "\n" , '#' , '<br>'
				);

				$Str = str_replace( $Placeholders , $Replacers , $Str );

				$Str = $this->compile_date_tags( $Str );

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>