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
	class	text_1_0_0{

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
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );

				$this->init_patterns();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Форматирование строки с длиной слова не более $MaxWordLength.
		*
		*	@param $String - Обрабатываемая строка.
		*
		*	@param $MaxWordLength - Максимальное количество символов в строке.
		*
		*	@return Форматированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function formats $String so the word's length won't be bigger than $MaxWordLength symbols.
		*
		*	@param $String - Processing string.
		*
		*	@param $MaxWordLength - Maximum count of the letters in the word.
		*
		*	@return Formatted data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			explode_into_words( $String , $MaxWordLength = 80 )
		{
			try
			{
				$RawWords = strip_tags( $this->Tags->compile_phpbb_tags( $String ) );
				$RawWords = str_replace( "\r" , ' ' , $RawWords );
				$RawWords = str_replace( "\n" , ' ' , $RawWords );
				$RawWords = explode( ' ' , $RawWords );

				foreach( $RawWords as $Key => $Value )
				{
					if( strlen( $Value ) > $MaxWordLength )
					{
						$Parts = chunk_split( $Value , $MaxWordLength , '[br]' );
						$String = str_replace( $Value , $Parts , $String );
					}
				}

				return( $String );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаления BOM.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function removes BOM .
		*
		*	@param $Str - String to process.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			remove_bom( $Str )
		{
			try
			{
				if( $Str !== false && strlen( $Str ) )
				{
					if( ord( @$Str[ 0 ] ) === 239 && ord( @$Str[ 1 ] ) === 187 && ord( @$Str[ 2 ] ) === 191 )
					{
						$Str = substr( $Str , 3 );
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
		*	\~russian Получение общего префикса строк.
		*
		*	@param $Strings - Строки для обработки.
		*
		*	@return Общий префикс.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function removes BOM .
		*
		*	@param $Strings - Strings to process.
		*
		*	@return Common prefix.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			common_prefix( &$Strings )
		{
			try
			{
				if( isset( $Strings[ 0 ] ) === false )
				{
					return( '' );
				}

				$CommonPrefix = '';
				$MaxLength = strlen( $Strings[ 0 ] );
				for( $i = 0 ; $i < $MaxLength ; $i++ )
				{
					foreach( $Strings as $j => $String )
					{
						if( $Strings[ 0 ][ $i ] != $String[ $i ] )
						{
							return( $CommonPrefix );
						}
					}
					$CommonPrefix .= $Strings[ 0 ][ $i ];
				}

				return( $CommonPrefix );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Отламывание общего префикса строк.
		*
		*	@param $Strings - Строки для обработки.
		*
		*	@param CommonPrefix - Префикс строк.
		*
		*	@return Обработанные строки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Trimming common prefix.
		*
		*	@param $Strings - Strings to process.
		*
		*	@param CommonPrefix - Trimming prefix.
		*
		*	@return Processed string.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			trim_common_prefix( &$Strings , $CommonPrefix = false )
		{
			try
			{
				if( $CommonPrefix === false )
				{
					$CommonPrefix = $this->common_prefix( $Strings );
				}

				if( $CommonPrefix !== '' )
				{
					foreach( $Strings as $i => $String )
					{
						$Strings[ $i ] = str_replace( $CommonPrefix , '' , $String );
					}
				}
				
				return( $Strings );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Паттерн кодировки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Charset patterns
		*
		*	@author Dodonov A.A.
		*/
		var					$WINPatternL = '~([\270])|([\340-\347])|([\350-\357])|([\360-\367])|([\370-\377])~s';

		/**
		*	\~russian Паттерн кодировки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Charset patterns
		*
		*	@author Dodonov A.A.
		*/
		var					$WINPatternU = '~([\250])|([\300-\307])|([\310-\317])|([\320-\327])|([\330-\337])~s';

		/**
		*	\~russian Паттерн кодировки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Charset patterns
		*
		*	@author Dodonov A.A.
		*/
		var					$KOIPatternL = '~([\243])|([\300-\307])|([\310-\317])|([\320-\327])|([\330-\337])~s';

		/**
		*	\~russian Паттерн кодировки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Charset patterns
		*
		*	@author Dodonov A.A.
		*/
		var					$KOIPatternU = '~([\263])|([\340-\347])|([\350-\357])|([\360-\367])|([\370-\377])~s';

		/**
		*	\~russian Паттерны кодировки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Charset patterns.
		*
		*	@author Dodonov A.A.
		*/
		var					$Patterns = array();

		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_basic_patterns()
		{
			try
			{
				$this->Patterns[ 'search_l_k' ] = $this->KOIPatternL;
				$this->Patterns[ 'search_U_k' ] = $this->KOIPatternU;
				$this->Patterns[ 'search_l_w' ] = $this->WINPatternL;
				$this->Patterns[ 'search_U_w' ] = $this->WINPatternU;
				$this->Patterns[ 'search_l_u' ] = "~([\xD1\x91])|([\xD1\x80-\x8F])|([\xD0\xB0-\xBF])~s";
				$this->Patterns[ 'search_U_u' ] = "~([\xD0\x81])|([\xD0\x90-\x9F])|([\xD0\xA0-\xAF])~s";
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_iso()
		{
			try
			{
				$this->Patterns[ 'search_l_i' ] = '~([\361])|([\320-\327])|([\330-\337])|([\340-\347])|([\350-\357])~s';
				$this->Patterns[ 'search_U_i' ] = '~([\241])|([\260-\267])|([\270-\277])|([\300-\307])|([\310-\317])~s';
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_mac()
		{
			try
			{
				$this->Patterns[ 'search_l_m' ] = '~([\336])|([\340-\347])|([\350-\357])|'.
												  '([\360-\367])|([\370-\370])|([\337])~s';
				$this->Patterns[ 'search_U_m' ] = '~([\335])|([\200-\207])|([\210-\217])|([\220-\227])|([\230-\237])~s';
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_ibm_1()
		{
			try
			{
				$this->Patterns[ 'search_l_c' ] = '~([\204])|([\234])|([\236])|([\240])|([\242])|([\244])|([\246])|'.
												  '([\250])|([\252])|([\254])|([\265])|([\267])|([\275])|([\306])|'.
												  '([\320])|([\322])|([\324])|([\326])|([\330])|([\340])|([\341])|'.
												  '([\343])|([\345])|([\347])|([\351])|([\353])|([\355])|([\361])|'.
												  '([\363])|([\365])|([\367])|([\371])|([\373])~s';
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_ibm_2()
		{
			try
			{
				$this->Patterns[ 'search_U_c' ] = '~([\205])|([\235])|([\237])|([\241])|([\243])|([\245])|([\247])|'.
												  '([\251])|([\253])|([\255])|([\266])|([\270])|([\276])|([\307])|'.
												  '([\321])|([\323])|([\325])|([\327])|([\335])|([\336])|([\342])|'.
												  '([\344])|([\346])|([\350])|([\352])|([\354])|([\356])|([\362])|'.
												  '([\364])|([\366])|([\370])|([\372])|([\374])~s';
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_ibm_3()
		{
			try
			{
				$this->Patterns[ 'search_l_a' ] = '~([\361])|([\240-\247])|([\250-\257])|([\340-\347])|([\350-\357])~s';
				$this->Patterns[ 'search_U_a' ] = '~([\360])|([\200-\207])|([\210-\217])|([\220-\227])|([\230-\237])~s';
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Инициализация паттернов.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function inits patterns.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	init_patterns()
		{
			try
			{
				$this->init_basic_patterns();

				$this->init_iso();
				$this->init_mac();
				$this->init_ibm_1();
				$this->init_ibm_2();
				$this->init_ibm_3();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Определение кодировки.
		*
		*	@param $Name - Название паттерна.
		*
		*	@return Паттерн.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function detects encoding.
		*
		*	@param $Name - Pattern name.
		*
		*	@return Pattern.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_enc_regexp( $Name )
		{
			try
			{
				if( isset( $this->Patterns[ $Name ] ) )
				{
					return( $this->Patterns[ $Name ] );
				}

				var_dump( $this->Patterns );
				
				throw( new Exception( 'Illegal pattern name' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Анализ результатов анализа.
		*
		*	@param $Charsets - Строки для обработки.
		*
		*	@return cp1251, koi8-r, iso-8859-5, x-mac-cyrillic, ibm866, ibm855, utf8 или false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function detects encoding.
		*
		*	@param $Charsets - Strings to process.
		*
		*	@return cp1251, koi8-r, iso-8859-5, x-mac-cyrillic, ibm866, ibm855, utf8 or false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	analize_detection_results( $Charsets )
		{
			try
			{
				arsort( $Charsets );
				$key = key( $Charsets );

				if( max( $Charsets ) == 0 )
				{
					return( 'utf-8' );
				}

				switch( $key )
				{
					case( 'w' ):return( 'cp1251' );
					case( 'k' ):return( 'koi8-r' );
					case( 'i' ):return( 'iso-8859-5' );
					case( 'm' ):return( 'x-mac-cyrillic' );
					case( 'a' ):return( 'ibm866' );
					case( 'c' ):return( 'ibm855' );
					case( 'u' ):return( 'utf-8' );
				}

				return( 'utf-8' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Определение кодировки.
		*
		*	@param $Charsets - Параметры обработки.
		*
		*	@param $Content - Контент.
		*
		*	@param $TryCharset - Кодировка.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function detects encoding.
		*
		*	@param $Charsets - Processing parameters.
		*
		*	@param $Content - Content.
		*
		*	@param $TryCharset - Charset.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	try_encoding( &$Charsets , $Content , $TryCharset )
		{
			try
			{
				$Result = preg_match_all( 
					$this->get_enc_regexp( "search_l_$TryCharset" ) , $Content , $Arr , PREG_PATTERN_ORDER
				);

				if( $Result )
				{
					$Charsets[ $TryCharset ] += count( $Arr[ 0 ] ) * 3;
				}

				$Result = preg_match_all(
					$this->get_enc_regexp( "search_U_$TryCharset" ) , $Content , $Arr , PREG_PATTERN_ORDER
				);

				if( $Result )
				{
					$Charsets[ $TryCharset ] += count( $Arr[ 0 ] );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Определение кодировки.
		*
		*	@param $Strings - Строки для обработки.
		*
		*	@return cp1251, koi8-r, iso-8859-5, x-mac-cyrillic, ibm866, ibm855, utf8 или false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function detects encoding.
		*
		*	@param $Strings - Strings to process.
		*
		*	@return cp1251, koi8-r, iso-8859-5, x-mac-cyrillic, ibm866, ibm855, utf8 or false.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			detect_encoding( $Content )
		{
			try
			{
				$Charsets = array ( 'w' => 0, 'k' => 0, 'i' => 0, 'm' => 0, 'a' => 0, 'c' => 0, 'u' => 0 );

				$this->try_encoding( $Charsets , $Content , 'w' );

				$this->try_encoding( $Charsets , $Content , 'k' );

				$this->try_encoding( $Charsets , $Content , 'i' );

				$this->try_encoding( $Charsets , $Content , 'm' );

				$this->try_encoding( $Charsets , $Content , 'a' );

				$this->try_encoding( $Charsets , $Content , 'c' );

				$this->try_encoding( $Charsets , $Content , 'u' );

				return( $this->analize_detection_results( $Charsets ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция перекодирования строк.
		*
		*	@param $InCharset - входная кодировка.
		*
		*	@param $OutCharset - целевая кодировка.
		*
		*	@param $Data - перекодируемые данные.
		*
		*	@return Перекодированные данные.
		*
		*	@note Для массивов и объектов работает рекрсивно.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function decodes string data.
		*
		*	@param $InCharset - The input charset.
		*
		*	@param $OutCharset - The output charset.
		*
		*	@param $Data - Data to decode.
		*
		*	@return Decoded data.
		*
		*	@note This function works recursively for objects and arrays.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			iconv( $InCharset , $OutCharset , $Data )
		{
			try
			{
				if( is_array( $Data ) || is_object( $Data ) )
				{
					foreach( $Data as $Key => $Value )
					{
						set_field( $Data , $Key , $this->iconv( $InCharset , $OutCharset , $Value ) );
					}
					return( $Data );
				}
				else
				{
					if( $InCharset === false )
					{
						$InCharset = $this->detect_encoding( $Data );
					}
					return( @iconv( $InCharset , $OutCharset , $Data ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>