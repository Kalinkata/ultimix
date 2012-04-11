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
	*	\~russian Класс обработки макросов страницы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class processes page's macro.
	*
	*	@author Dodonov A.A.
	*/
	class	page_parser_1_0_0
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
		var					$String = false;
		
		/**
		*	\~russian Позиция открывающего блока.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Opening block's position.
		*
		*	@author Dodonov A.A.
		*/
		var					$StartPosition = false;
		
		/**
		*	\~russian Позиция закрывающего блока.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Ending block's position.
		*
		*	@author Dodonov A.A.
		*/
		var					$EndPosition = false;
		
		/**
		*	\~russian Параметры макроса.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Macro parameters.
		*
		*	@author Dodonov A.A.
		*/
		var					$RawMacroParameters = false;
		
		/**
		*	\~russian Параметры макроса.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Macro parameters.
		*
		*	@author Dodonov A.A.
		*/
		var					$MacroParameters = false;
		
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
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция валидации параметров найденного макроса.
		*
		*	@param $Parameters - Проверяемые параметры.
		*
		*	@param $Conditions - Условия обработки макроса.
		*
		*	@return true если параметры корректны.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tries to validate macro parameters.
		*
		*	@param $Parameters - Parameters to validate.
		*
		*	@param $Conditions - Conditions of the processing.
		*
		*	@return true if macro parameters are valid.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			validate_parameters( $Parameters , $Conditions )
		{
			try
			{
				foreach( $Parameters as $key1 => $p )
				{
					$p = explode( '=' , $p );
					foreach( $Conditions as $key2 => $rev )
					{
						if( $key2 == $p[ 0 ] )
						{
							$Matches = array();
							$Result = preg_match( $rev , $p[ 1 ] , $Matches );
							if( count( $Matches ) == 0 )
							{
								return( false );
							}
						}
					}
				}
				
				return( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция парсинга параметров найденного макроса.
		*
		*	@param $Parameters - Параметры для обработки.
		*
		*	@param $Conditions - Условия обработки макроса.
		*
		*	@return true если параметры были распарсены.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tries to parse macro parameters.
		*
		*	@param $Parameters - Parameters to parse.
		*
		*	@param $Conditions - Conditions of the processing.
		*
		*	@return true if macro parameters were parsed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse_parameters( $Parameters , $Conditions )
		{
			try
			{
				$Parameters = explode( ';' , $Parameters );
				
				if( $this->validate_parameters( $Parameters , $Conditions ) )
				{
					$this->RawMacroParameters = $Parameters;
					return( true );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрабатывает если вложенный макрос был найден.
		*
		*	@param $TmpStartPos
		*
		*	@param $TmpEndPos
		*
		*	@param $Counter
		*
		*	@param $ParserCursor
		*
		*	@return array( $Counter , $ParserCursor ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function iterates if nested macro was found.
		*
		*	@param $TmpStartPos
		*
		*	@param $TmpEndPos
		*
		*	@param $Counter
		*
		*	@param $ParserCursor
		*
		*	@return array( $Counter , $ParserCursor ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			other_macro_was_found( $TmpStartPos , $TmpEndPos , $Counter , $ParserCursor )
		{
			try
			{
				if( $TmpStartPos !== false && $TmpEndPos !== false )
				{
					if( $TmpStartPos < $TmpEndPos )
					{
						$ParserCursor = $TmpEndPos;
					}
					if( $TmpEndPos < $TmpStartPos )
					{
						$Counter--;
						if( $Counter )$Counter++;
						$ParserCursor = $TmpStartPos;
					}
				}
				
				return( array( $Counter , $ParserCursor ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка специфических случаев парсинга.
		*
		*	@param $TmpStartPos
		*
		*	@param $TmpEndPos
		*
		*	@param $Counter
		*
		*	@param $ParserCursor
		*
		*	@return array( $Counter , $ParserCursor ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes extra cases.
		*
		*	@param $TmpStartPos
		*
		*	@param $TmpEndPos
		*
		*	@param $Counter
		*
		*	@param $ParserCursor
		*
		*	@return array( $Counter , $ParserCursor ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_extra_cases( $TmpStartPos , $TmpEndPos , $Counter , $ParserCursor )
		{
			try
			{
				if( $TmpStartPos !== false && $TmpEndPos === false )
				{
					$Counter++;
					$ParserCursor = $TmpStartPos;
				}
				
				if( $TmpStartPos === false && $TmpEndPos !== false )
				{
					$Counter--;
					$ParserCursor = $TmpEndPos;
				}
				
				if( $TmpStartPos === false && $TmpEndPos === false )
				{
					throw( new Exception( "Closing { was not found" ) );
				}
				
				return( array( $Counter , $ParserCursor ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Поиск окончания параметров.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@param $ParserCursor - Позиция с которой надо нафинать обрабатывать.
		*
		*	@return Курсор конца параметров.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function searches paremeters end.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@param $ParserCursor - Position to start from.
		*
		*	@return end of the parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			find_parameters_end( $StringData , $MacroName , $ParserCursor )
		{
			try
			{
				$Counter = 1;
				
				do
				{
					$TmpStartPos = strpos( $StringData , '{' , $ParserCursor + 1 );
					$TmpEndPos = strpos( $StringData , '}' , $ParserCursor + 1 );
					
					list( $Counter , $ParserCursor ) = $this->other_macro_was_found( 
						$TmpStartPos , $TmpEndPos , $Counter , $ParserCursor 
					);
					
					list( $Counter , $ParserCursor ) = $this->process_extra_cases( 
						$TmpStartPos , $TmpEndPos , $Counter , $ParserCursor 
					);
				}
				while( $TmpStartPos && $Counter != 0 );

				return( $Counter == 0 ? $TmpEndPos : false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция парсинга найденного макроса.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@param $Conditions - Условия обработки макроса.
		*
		*	@param $StartPos - Позиция с которой надо нафинать обрабатывать.
		*
		*	@return true если макрос был распарсен.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tries to parse macro.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@param $Conditions - Conditions of the processing.
		*
		*	@param $StartPos - Position to start from.
		*
		*	@return true if macro was parsed.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			parse_macro( $StringData , $MacroName , $Conditions , $StartPos )
		{
			try
			{
				$EndPos = $this->find_parameters_end( $StringData , $MacroName , $StartPos );
				
				if( $EndPos !== false )
				{
					/* extracting parameters */
					$Parameters = substr( $StringData , $StartPos , $EndPos - $StartPos );
					
					return( $this->parse_parameters( $Parameters , $Conditions ) );
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция поиска необходимого макроса.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@param $Conditions - Условия обработки макроса.
		*
		*	@return true если макрос был найден.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function finds macro in the text.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@param $Conditions - Conditions of the processing.
		*
		*	@return true if the macro was found.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			find_next_macro( $StringData , $MacroName , $Conditions )
		{
			try
			{
				$this->RawMacroParameters = array();
				$this->MacroParameters = false;
				$StartPos = -1;
				
				$MacroStart = '{'.$MacroName.':';
				$MacroLength = strlen( $MacroStart );
				
				for( ; ( $StartPos = strpos( $StringData , $MacroStart , $StartPos + 1 ) ) !== false ; )
				{
					$StartPos += $MacroLength;
					
					$Result = $this->parse_macro( $StringData , $MacroName , $Conditions , $StartPos );

					if( $Result )
					{
						$this->StartPosition = $StartPos - $MacroLength;
						return( true );
					}
				}
				
				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение доступа к параметрам макроса.
		*
		*	@return Параметры макроса.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function provides access to the macro parameters.
		*
		*	@return Macro parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_macro_parameters()
		{
			try
			{
				if( $this->MacroParameters === false )
				{
					$this->MacroParameters = get_package_object( 'settings::settings' , 'last' , __FILE__ );
					$this->MacroParameters->load_settings( $this->RawMacroParameters );
				}
				
				return( $this->MacroParameters );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Поиск кандидатов на роль возможного конца блока.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@return Массив позиций.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function finds all candidates to be the macro's end.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@return Array of positions.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_positions( $StringData , $MacroName )
		{
			try
			{
				$Positions = array();

				$StartPos = $this->StartPosition;
				$EndPos = -1;

				for( ; $StartPos = strpos( $StringData , '{'.$MacroName.':' , $StartPos + 1 ) ; )
				{
					$Positions [ $StartPos ] = 's';
				}

				for( ; $EndPos = strpos( $StringData , '{~'.$MacroName.'}' , $EndPos + 1 ) ; )
				{
					$Positions [ $EndPos ] = 'e';
				}

				ksort( $Positions );

				return( $Positions );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка позиции.
		*
		*	@param $Value - 
		*
		*	@param $Key - 
		*
		*	@param $StartPos - 
		*
		*	@param $EndPos - 
		*
		*	@param $c - 
		*
		*	@return array( $StartPos , $EndPos , $c ).
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes position.
		*
		*	@param $Value - 
		*
		*	@param $Key - 
		*
		*	@param $StartPos - 
		*
		*	@param $EndPos - 
		*
		*	@param $c - 
		*
		*	@return array( $StartPos , $EndPos , $c ).
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_position( $Value , $Key , $StartPos , $EndPos , $c )
		{
			try
			{
				if( $StartPos === false && $Value === 's' )
				{
					$c++;
					$StartPos = $Key;
				}
				elseif( $EndPos === false && $Value === 'e' && $c === 1 )
				{
					$EndPos = $Key;
				}
				elseif( $Value === 's' )
				{
					$c++;
				}
				elseif( $Value === 'e' )
				{
					$c--;
				}
				
				return( array( $StartPos , $EndPos , $c ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция поиска конца необходимого макроса.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function finds macro end in the text.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_macro_end_position( $StringData , $MacroName )
		{
			try
			{
				$Positions = $this->get_positions( $StringData , $MacroName );
				$StartPos = $this->StartPosition;
				$EndPos = false;
				$c = 1;
				
				foreach( $Positions as $Key => $Value )
				{
					if( $Value == 'e' && $Key > $this->StartPosition )
					{
						list( $StartPos , $EndPos , $c ) = $this->process_position( 
							$Value , $Key , $StartPos , $EndPos , $c 
						);
					}
				}
				
				if( $EndPos === false )
				{
					throw_exception( 'Block end was not found' );
				}
				
				$this->EndPosition = $EndPos;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция сокрытия макроса.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function hides macro.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			hide_macro( $StringData , $MacroName )
		{
			try
			{
				$this->get_macro_end_position( $StringData , $MacroName );
				
				$StringData = substr_replace( $StringData , 
					'' , 
					$this->StartPosition , 
					$this->EndPosition - $this->StartPosition + strlen( '{~'.$MacroName.'}' ) 
				);
				
				return( $StringData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция раскрытия макроса.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function shows macro.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_macro( $StringData , $MacroName )
		{
			try
			{
				$this->get_macro_end_position( $StringData , $MacroName );
				
				$this->RawMacroParameters = implode( ';' , $this->RawMacroParameters );
				$MacroLength = strlen( '{'."$MacroName:$this->RawMacroParameters}" );

				$Position = $this->EndPosition - $this->StartPosition - $MacroLength;
				$MacroData = substr( $StringData , $this->StartPosition + $MacroLength , $Position );

				$Position = $this->EndPosition - $this->StartPosition + strlen( '{~'.$MacroName.'}' );
				$StringData = substr_replace( $StringData , $MacroData , $this->StartPosition , $Position );
				
				return( $StringData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса.
		*
		*	@param $Mode - Режим show/hide.
		*
		*	@param $StringData - Обрабатываемая строка.
		*
		*	@param $MacroName - Название обрабатываемого макроса.
		*
		*	@return Обработанная строка.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro.
		*
		*	@param $Mode - show/hide mode.
		*
		*	@param $StringData - Processing string.
		*
		*	@param $MacroName - Macro's name.
		*
		*	@return Processed string.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_macro( $Mode , $StringData , $MacroName )
		{
			try
			{
				if( $Mode == 'show' )
				{
					return( $this->show_macro( $StringData , $MacroName ) );
				}
				elseif( $Mode == 'hide' )
				{
					return( $this->hide_macro( $StringData , $MacroName ) );
				}
				else
				{
					throw( new Exception( "Macro processing mode '$Mode' is not defined" ) );
				}
				
				return( $StringData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>