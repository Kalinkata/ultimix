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

	DEFINE( 'TERMINAL_VALUE' , "/^[\{\}]{0}[^\{\}]*$/" );
	
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
	class	string_1_0_0{
	
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
		var					$Settings = false;
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
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->Tags = get_package( 'string::tags' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаления блока.
		*
		*	@param $StringData - строковые данные, подвергаемые обработке.
		*
		*	@param $BlockStart - маркер начал блока.
		*
		*	@param $BlockEnd - маркер конца блока.
		*
		*	@param $Changed - Была ли обработана строка.
		*
		*	@return Обработанный блок.
		*
		*	@note Будут удалены _все_ блоки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes text block.
		*
		*	@param $StringData - Processing data.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@param $Changed - Was the sring processed.
		*
		*	@return Processed block.
		*
		*	@note _All_ blocks will be deleted.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			hide_block( $StringData , $BlockStart , $BlockEnd , &$Changed )
		{
			try
			{
				do
				{
					list( $StartPos , $EndPos ) = $this->get_block_positions( $StringData , $BlockStart , $BlockEnd );
					
					if( $StartPos !== false )
					{
						$StringData = substr_replace( $StringData , 
							'' , 
							$StartPos , 
							$EndPos - $StartPos + strlen( '{'.$BlockEnd.'}' ) 
						);
						
						$Changed = true;
					}
					else
					{
						return( $StringData );
					}
				}
				while( true );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция удаляет границы блока.
		*
		*	@param $StringData - Строковые данные, подвергаемые обработке.
		*
		*	@param $BlockStart - Маркер начал блока.
		*
		*	@param $BlockEnd - Маркер конца блока.
		*
		*	@param $Changed - Былали обработана строка.
		*
		*	@return Обработанный блок.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes block's bounds.
		*
		*	@param $StringData - Processing data.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@param $Changed - Was the sring processed.
		*
		*	@return - Processed block.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			show_block( $StringData , $BlockStart , $BlockEnd , &$Changed )
		{
			try
			{
				list( $StartPos , $EndPos ) = $this->get_block_positions( $StringData , $BlockStart , $BlockEnd );
				if( $StartPos !== false )
				{
					$BlockData = $this->get_block_data( $StringData , $BlockStart , $BlockEnd );

					$StringData = substr_replace( $StringData , 
						$BlockData , 
						$StartPos , 
						$EndPos - $StartPos + strlen( '{'.$BlockEnd.'}' ) 
					);
					
					$Changed = true;
				}

				return( $StringData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'foreach'.
		*
		*	@param $Str - Шаблон по которому будет форматироваться запись.
		*
		*	@param $Parameters - Парметры макроса.
		*
		*	@param $Data - Выводимая запись.
		*
		*	@return Форматированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process macro 'foreach'.
		*
		*	@param $Str - Format template.
		*
		*	@param $Parameters - Macro parameters.
		*
		*	@param $Data - Outputting record.
		*
		*	@return Formatted data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	apply_foreach_data( $Str , $Parameters , $Data )
		{
			try
			{
				$SubTemplate = $this->get_block_data( $Str , "foreach:$Parameters" , '~foreach' );

				foreach( $Data as $k => $v )
				{
					$Str = str_replace( 
						"{foreach:$Parameters}" , 
						$this->print_record( $SubTemplate , $v )."{foreach:$Parameters}" , $Str
					);
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'foreach'.
		*
		*	@param $Str - Шаблон по которому будет форматироваться запись.
		*
		*	@param $Record - Выводимая запись.
		*
		*	@return Форматированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function process macro 'foreach'.
		*
		*	@param $Str - Format template.
		*
		*	@param $Record - Outputting record.
		*
		*	@return Formatted data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			process_foreach( $Str , &$Record )
		{
			try
			{
				for( ; $Parameters = $this->get_macro_parameters( $Str , 'foreach' ) ; )
				{
					$this->Settings->load_settings( $Parameters );
					$Var = $this->Settings->get_setting( 'var' );
					$Data = get_field( $Record , $Var );

					$Str = $this->apply_foreach_data( $Str , $Parameters , $Data );

					$Str = $this->hide_block( $Str , "foreach:$Parameters" , '~foreach' , $Changed );
					$Changed = false;
				}

				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция осуществляет форматированный вывод объекта $Record.
		*
		*	@param $Str - Шаблон по которому будет форматироваться запись.
		*
		*	@param $Record - Выводимая запись.
		*
		*	@return Форматированные данные.
		*
		*	@exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function	makes a formatted output for record $Record and template.
		*
		*	@param $Str - Format template.
		*
		*	@param $Record - Outputting record.
		*
		*	@return Formatted data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			print_record( $Str , &$Record )
		{
			try
			{
				if( is_array( $Record ) === false && is_object( $Record ) === false )
				{
					throw( new Exception( 'Invalid record was passed' ) );
				}

				$Str = $this->process_foreach( $Str , $Record );

				foreach( $Record as $Field => $Value )
				{
					if( is_array( $Value ) || is_object( $Value ) )
					{
						$Str = $this->print_record( $Str , $Value );
					}
					else
					{
						$Str = str_replace( '{'.$Field.'}' , $Value , $Str );
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
		*	\~russian Функция проверки существования блока.
		*
		*	@param $StringData - строковые данные, подвергаемые обработке.
		*
		*	@param $BlockStart - маркер начал блока.
		*
		*	@param $BlockEnd - маркер конца блока.
		*
		*	@return true если блок существует, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates block's existance.
		*
		*	@param $StringData Processing data.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@return - true if the block exists, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			block_exists( $StringData , $BlockStart , $BlockEnd = false )
		{
			try
			{
				$StartPos = strpos( $StringData , '{'.$BlockStart.'}' );
				if( $StartPos == false )
				{
					return( false );
				}
				
				if( $BlockEnd !== false )
				{
					$EndPos = strpos( $StringData , '{'.$BlockEnd.'}' );
					if( $EndPos == false )
					{
						return( false );
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
		*	\~russian Функция выборки параметров макроса.
		*
		*	@param $StringData - строковые данные, подвергаемые обработке.
		*
		*	@param $MacroName - параметры макроса.
		*
		*	@param $RegExValidators - регулярные выражения для проверки выбираемых параметров.
		*
		*	@return Название блока. Если макрос не найден то будет возвращено false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns macro's parameters.
		*
		*	@param $StringData - Data to be parsed.
		*
		*	@param $MacroName - Macro's parameters.
		*
		*	@param $RegExValidators - Regular expressions for parameters validation.
		*
		*	@return Macro's name. If the macro was not found then false will be returned.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_macro_parameters( &$StringData , $MacroName , $RegExValidators = array() )
		{
			try
			{
				$Matches = array();

				$StartPos = -1;

				for( ; ( $TmpStartPos = strpos( $StringData , '{'.$MacroName.':' , $StartPos + 1 ) ) !== false ; )
				{
					$Counter = 1;
					$StartPos = $TmpStartPos;
					
					$MacroStartPos = $StartPos;
					$ParamStartPos = $MacroStartPos + strlen( '{'.$MacroName.':' );
					
					do
					{
						$TmpStartPos = strpos( $StringData , '{' , $StartPos + 1 );
						$TmpEndPos = strpos( $StringData , '}' , $StartPos + 1 );
						
						if( $TmpStartPos !== false && $TmpEndPos !== false )
						{
							if( $TmpStartPos < $TmpEndPos )
							{
								$StartPos = $TmpEndPos;
							}
							if( $TmpEndPos < $TmpStartPos )
							{
								$Counter--;
								if( $Counter )$Counter++;
								$StartPos = $TmpStartPos;
							}
						}

						if( $TmpStartPos !== false && $TmpEndPos === false )
						{
							$Counter++;
							$StartPos = $TmpStartPos;
						}

						if( $TmpStartPos === false && $TmpEndPos !== false )
						{
							$Counter--;
							$StartPos = $TmpEndPos;
						}

						if( $TmpStartPos === false && $TmpEndPos === false )
						{
							/* ничего не найдено, поэтому внешний цикл закончен, да и внутренний тоже
							   $StartPos = strlen( $StringData ); */
							$StartPos = $MacroStartPos;
						}

						if( $Counter == 0 )
						{
							/* нашли закрывающую скобку для макроса... */
							$Params = substr( $StringData , $ParamStartPos , $TmpEndPos - $ParamStartPos );

							$Valid = true;

							/* проверяем валидность параметров... */
							/* ... если надо */
							if( count( $RegExValidators ) )
							{
								$ParamsList = explode( ';' , $Params );

								foreach( $ParamsList as $key1 => $p )
								{
									$p = explode( '=' , $p );
									foreach( $RegExValidators as $key2 => $rev )
									{
										if( $key2 == $p[ 0 ] )
										{
											$Matches = array();
											$Result = preg_match( $rev , $p[ 1 ] , $Matches );
											$Valid = count( $Matches ) == 0 ? false : $Valid;
											break;
										}
									}
								}
							}

							if( $Valid )
							{
								/* валидные параметры */
								return( $Params );
							}

							/* поэтому вываливаемся из внутреннего цикла */
							$TmpStartPos = false;
							$StartPos = $MacroStartPos;
						}
					}
					while( $TmpStartPos );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция проверки существования.
		*
		*	@param $StringData - строковые данные, подвергаемые обработке.
		*
		*	@param $BlockStart - маркер начал блока.
		*
		*	@param $BlockEnd - маркер конца блока.
		*
		*	@return true если блок существует, иначе false.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function validates block's existance.
		*
		*	@param $StringData - Processing data.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@return - true if the block exists, false otherwise.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_block_data( $StringData , $BlockStart , $BlockEnd )
		{
			try
			{
				list( $StartPos , $EndPos ) = $this->get_block_positions( $StringData , $BlockStart , $BlockEnd );

				if( $StartPos !== false )
				{
					$BlockData = substr( 
						$StringData , 
						$StartPos + strlen( '{'.$BlockStart.'}' ) , 
						$EndPos - $StartPos - strlen( '{'.$BlockStart.'}' )
					);

					return( $BlockData );
				}
				else
				{
					throw( new Exception( 'An error occured while getting block data' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция удаления блока.
		*
		*	@param $StringData - строковые данные, подвергаемые обработке.
		*
		*	@param $BlockType - тип блока.
		*
		*	@param $Changed - Была ли обработана строка.
		*
		*	@return Обработанный блок.
		*
		*	@note Будут удалены _все_ блоки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function deletes text block.
		*
		*	@param $StringData - Processing data.
		*
		*	@param $BlockType - Block's type.
		*
		*	@param $Changed - Was the sring processed.
		*
		*	@return Processed block.
		*
		*	@note _All_ blocks will be deleted.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			hide_unprocessed_blocks( $StringData , $BlockType , &$Changed )
		{
			try
			{
				$PlaceHolders = array();
				do
				{
					$PlaceHolders = array();

					preg_match( "/\{$BlockType:([a-zA-Z0-9_]+)\}/" , $StringData , $PlaceHolders );

					if( count( $PlaceHolders ) > 1 )
					{
						$StringData = $this->hide_block( $StringData , "$BlockType:".$PlaceHolders[ 1 ] , 
														 "$BlockType:~".$PlaceHolders[ 1 ] , $Changed );
					}
				}
				while( count( $PlaceHolders ) > 1 );
				
				return( $StringData );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция выборки позиций начала и конца всех блоков.
		*
		*	@param $StringData - Строковые данные, подвергаемые обработке.
		*
		*	@param $BlockStart - Маркер начал блока.
		*
		*	@param $BlockEnd - Маркер конца блока.
		*
		*	@return Курсоры начала и конца блоков.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns positions of all blocks'es ends and beginnings.
		*
		*	@param $StringData - Processing data.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@return Beginnings and ends of the block.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_all_block_positions( $StringData , $BlockStart , $BlockEnd )
		{
			try
			{
				$Positions = array();

				$StartPos = -1;
				$EndPos = -1;

				for( ; $StartPos = strpos( $StringData , '{'.$BlockStart.'}' , $StartPos + 1 ) ; )
				{
					$Positions [ $StartPos ] = 's';
				}
				for( ; $EndPos = strpos( $StringData , '{'.$BlockEnd.'}' , $EndPos + 1 ) ; )
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
		*	\~russian Функция выборки возможных позиций начала и конца блока.
		*
		*	@param $Positions - Позиции всех блоков.
		*
		*	@return Курсоры начала и конца блока.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns possible positions of the block's end and beginning.
		*
		*	@param $Positions - Positions of all blocks.
		*
		*	@return The beginning and the end of the block.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_possible_block_positions( &$Positions )
		{
			try
			{
				$StartPos = $EndPos = false;
				$c = 0;
				foreach( $Positions as $Key => $Value )
				{
					if( $StartPos === false && $Value === 's' )
					{
						$c++;
						$StartPos = $Key;
					}
					elseif( $EndPos === false && $Value === 'e' && $c === 1 )
					{
						$EndPos = $Key;
						break;
					}
					elseif( $Value === 's' || $Value === 'e' && $c > 0 )
					{
						$c += $Value === 's' ? 1 : -1;
					}
				}
				
				return( array( $StartPos , $EndPos ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция выборки позиций начала и конца блока.
		*
		*	@param $StringData - Строковые данные, подвергаемые обработке.
		*
		*	@param $BlockStart - Маркер начал блока.
		*
		*	@param $BlockEnd - Маркер конца блока.
		*
		*	@return Курсоры начала и конца блока.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns positions of the block's end and beginning.
		*
		*	@param $StringData - Processing data.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@return Begin and end of the block.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_block_positions( $StringData , $BlockStart , $BlockEnd )
		{
			try
			{
				$Positions = $this->get_all_block_positions( $StringData , $BlockStart , $BlockEnd );

				list( $StartPos , $EndPos ) = $this->get_possible_block_positions( $Positions );

				if( $StartPos === false )
				{
					return( array( false , false ) );
				}
				if( $EndPos === false )
				{
					throw( new Exception( 'Block end was not found' ) );
				}

				return( array( $StartPos , $EndPos ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция замены блока.
		*
		*	@param $Str - Строка для обработки.
		*
		*	@param $BlockStart - Маркер начал блока.
		*
		*	@param $BlockEnd - Маркер конца блока.
		*
		*	@param $Data - Данные для замены.
		*
		*	@return Перекодированные данные.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function replaces block.
		*
		*	@param $Str - String to process.
		*
		*	@param $BlockStart - Marker of the block's begin.
		*
		*	@param $BlockEnd - Marker of the block's end.
		*
		*	@param $Data - Replacement data.
		*
		*	@return - Decoded data.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			replace_block( $Str , $BlockStart , $BlockEnd , $Data )
		{
			try
			{
				$Str = str_replace( '{'.$BlockStart.'}' , $Text.'{'.$BlockStart.'}' , $Str );
				
				$Str = $this->hide_block( $Str , $BlockStart , $BlockEnd , $Changed );
			
				return( $Str );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Очистка специальных тэгов.
		*
		*	@param $Data - Данные для обработки.
		*
		*	@return Данные после обработки.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function removes special tags.
		*
		*	@param $Data - Data to process.
		*
		*	@return Data after processing.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			clear_ultimix_tags( $Data )
		{
			try
			{
				if( strpos( $Data[ 'path' ] , '{http_host}/' ) === 0 )
				{
					$Data[ 'path' ] = str_replace( '{http_host}/' , './' , $Data[ 'path' ] );
				}

				$Data[ 'path' ] = $this->Tags->compile_ultimix_tags( $Data[ 'path' ] );

				return( $Data );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>