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
	
	require_once( dirname( __FILE__ ).'/unit_tests_utilities.php' );
	
	/**
	*	\~russian Класс, отвечающий за тестирование компонентов системы.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for unit testing.
	*
	*	@author Dodonov A.A.
	*/
	class	unit_tests{
		
		/**
		*	\~russian Закэшированный объект.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Cached object.
		*
		*	@author Dodonov A.A.
		*/
		var					$Utilities = false;
		
		/**
		*	\~russian Настройка тестового стенда.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Setting up testing mashine.
		*
		*	@author Dodonov A.A.
		*/
		function			set_up()
		{
			$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
		}
		
		/**
		*	\~russian Возвращаем тестовый стенд в исходное положение.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function restores default settings.
		*
		*	@author Dodonov A.A.
		*/
		function			tear_down()
		{
		}
		
		/**
		*	\~russian Обработка некорректных макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing illegal macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_load_package()
		{
			get_package( 'page::page_composer' , 'last' , __FILE__ );
			
			return( 'TEST PASSED' );
		}
		
		/**
		*	\~russian Проверка длины строк в php файлах.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing line length for php files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_line_length_php()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$FileContent = file( $Files[ $i ] );
				if( skip_file( $Files[ $i ] ) === false )
				{
					for( $j = 0 ; $j < count( $FileContent ) ; $j++ )
					{
						$Line = str_replace( 
							array( "\t" , "\r" , "\n" ) , array( '    ' , '' , '' ) , $FileContent[ $j ]
						);
						if( mb_strlen( $Line , 'UTF-8' ) > 120 )
						{
							$Errors++;
							$Line = htmlspecialchars( $Line , ENT_QUOTES );
							print( "<nobr>".$Files[ $i ]."(".( $j + 1 ).")</nobr><br>" );
						}
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка php файлов в строках.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing count of lines in all php files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_line_count_php()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 100 ; $i++ )
			{
				$FileContent = file( $Files[ $i ] );
				
				if( count( $FileContent ) > 1000 && strpos( $Files[ $i ] , 'excel' ) === false && 
					strpos( $Files[ $i ] , 'nusoap' ) === false )
				{
					$Errors++;
					print( "<nobr>{$Files[ $i ]}</nobr><br>" );
				}
			}
			
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка размера php файлов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing size of all php files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_file_size_php()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 100 ; $i++ )
			{
				$FileContent = file_get_contents( $Files[ $i ] );
				
				if( strlen( $FileContent ) > 25 * 1024 && skip_file( $Files[ $i ] ) === false )
				{
					$Errors++;
					print( "<nobr>{$Files[ $i ]}</nobr><br>" );
				}
			}
			
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка наличия html кода в php файлах.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing html code presense in php files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_file_html_code_php()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) === false && strpos( $Files[ $i ] , 'tags.php' ) === false && 
					strpos( $Files[ $i ] , 'page_composer/include/php/unit_tests_utilities.php' ) === false && 
					strpos( $Files[ $i ] , 'page_composer/include/php/unit_tests.php' ) === false )
				{
					$Errors += find_html_content_in_file( $Files[ $i ] );
				}
			}
			
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка наличия в файлах шаблонов тэгов с аттрибутом style.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing attribute "style" presence in the template files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_tpl_files()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.tpl/' , true );
			
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				$FileContent = file_get_contents( $Files[ $i ] );
				
				if( strpos( $FileContent , 'style=' ) !== false )
				{
					$Errors++;
					print( "<nobr>{$Files[ $i ]}</nobr><br>" );
				}
			}
			
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка размеров функций (строки кода).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing functions sizes (lines of code).
		*
		*	@author Dodonov A.A.
		*/
		function			test_function_lines_php()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) )
				{
					continue;
				}
				$FileContent = file_get_contents( $Files[ $i ] );
				$Bodies = get_function_bodies( $FileContent );
				foreach( $Bodies as $FunctionName => $Body )
				{
					if( ( $LinesCount = count_lines( $Body ) ) > 30 && $FunctionName != 'get_positions' && 
						$FunctionName != 'test_invalid_macro' )
					{
						$Errors++;
						print( "<nobr>{$Files[ $i ]}($FunctionName:$LinesCount)</nobr><br>" );
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка размеров функций (размер в байтах).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing functions sizes (count of bytes).
		*
		*	@author Dodonov A.A.
		*/
		function			test_function_size_php()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) )
				{
					continue;
				}
				$FileContent = file_get_contents( $Files[ $i ] );
				$Bodies = get_function_bodies( $FileContent );
				foreach( $Bodies as $FunctionName => $Body )
				{
					/* 800 bytes max */
					if( ( $BytesCount = strlen( $Body ) ) > 800 && $FunctionName != 'get_positions' &&
						$FunctionName != 'test_invalid_macro' )
					{
						$Errors++;
						print( "<nobr>{$Files[ $i ]}($FunctionName:$BytesCount)</nobr><br>" );
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка наличия вызовов get_package для пакета 'settings'.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing for calls get_package for the 'settings' package .
		*
		*	@author Dodonov A.A.
		*/
		function			test_get_package_object_for_settings()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) || 
					strpos( $Files[ $i ] , '/page_composer/include/php/unit_tests.php' ) !== false )
				{
					continue;
				}

				$FileContent = file_get_contents( $Files[ $i ] );
				if( strpos( $FileContent , "get_package( 'settings::settings'" ) !== false )
				{
					$Errors++;
					print( "<nobr>{$Files[ $i ]}</nobr><br>" );
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		// JS
		
		/**
		*	\~russian Проверка длины строк в js файлах.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing line length for js files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_line_length_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.js/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				$FileContent = file( $Files[ $i ] );
				if( skip_file( $Files[ $i ] ) === false )
				{
					for( $j = 0 ; $j < count( $FileContent ) ; $j++ )
					{
						$Line = str_replace( 
							array( "\t" , "\r" , "\n" ) , array( '    ' , '' , '' ) , $FileContent[ $j ]
						);
						if( mb_strlen( $Line , 'UTF-8' ) > 120 )
						{
							$Errors++;
							$Line = htmlspecialchars( $Line , ENT_QUOTES );
							print( "<nobr>".$Files[ $i ]."(".( $j + 1 ).")</nobr><br>" );
						}
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка js файлов в строках.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing count of lines in all js files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_line_count_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.js/' , true );
			
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 100 ; $i++ )
			{
				$FileContent = file( $Files[ $i ] );
				
				if( count( $FileContent ) > 1000 && skip_file( $Files[ $i ] ) === false )
				{
					$Errors++;
					print( "<nobr>{$Files[ $i ]}</nobr><br>" );
				}
			}
			
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка размера js файлов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing size of all js files.
		*
		*	@author Dodonov A.A.
		*/
		function			test_file_size_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.js/' , true );
			
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 100 ; $i++ )
			{
				$FileContent = file_get_contents( $Files[ $i ] );
				
				if( strlen( $FileContent ) > 25 * 1024 && skip_file( $Files[ $i ] ) === false )
				{
					$Errors++;
					print( "<nobr>{$Files[ $i ]}</nobr><br>" );
				}
			}
			
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка размеров функций (строки кода).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing functions sizes (lines of code).
		*
		*	@author Dodonov A.A.
		*/
		function			test_function_lines_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.js/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) )
				{
					continue;
				}
				$FileContent = file_get_contents( $Files[ $i ] );
				$Bodies = get_function_bodies( $FileContent );
				foreach( $Bodies as $FunctionName => $Body )
				{
					if( ( $LinesCount = count_lines( $Body ) ) > 20 && $FunctionName != 'get_positions' && 
						$FunctionName != 'test_invalid_macro' )
					{
						$Errors++;
						print( "<nobr>{$Files[ $i ]}($FunctionName:$LinesCount)</nobr><br>" );
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка размеров функций (размер в байтах).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing functions sizes (count of bytes).
		*
		*	@author Dodonov A.A.
		*/
		function			test_function_size_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.js/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) && $Errors < 1000 ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) )
				{
					continue;
				}
				$FileContent = file_get_contents( $Files[ $i ] );
				$Bodies = get_function_bodies( $FileContent );
				foreach( $Bodies as $FunctionName => $Body )
				{
					/* 800 bytes max */
					if( ( $BytesCount = strlen( $Body ) ) > 680 && $FunctionName != 'get_positions' &&
						$FunctionName != 'test_invalid_macro' )
					{
						$Errors++;
						print( "<nobr>{$Files[ $i ]}($FunctionName:$BytesCount)</nobr><br>" );
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка наличия тэгов TODO.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing functions searches TODO tags in the source code.
		*
		*	@author Dodonov A.A.
		*/
		function			test_todo_tag()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.(php|js)/' , true );

			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				if( skip_file( $Files[ $i ] ) === false )
				{
					$FileContent = file( $Files[ $i ] );
					for( $j = 0 ; $j < count( $FileContent ) ; $j++ )
					{
						$Line = $FileContent[ $j ];
						if( ( $Start = strpos( $Line , 'TO'.'DO' ) ) !== false )
						{
							$Errors++;
							$Message = trim( mb_substr( $Line , $Start + 5 ) );
							print( "<nobr>".$Files[ $i ]." : $Message</nobr><br>" );
						}
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}

		/**
		*	\~russian Проверка наличия файла скрипта.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing script files existence.
		*
		*	@author Dodonov A.A.
		*/
		function			test_smth_view_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				if( strpos( $Files[ $i ] , '_view.php' ) !== false )
				{
					$Path = dirname( $Files[ $i ] ).'/include/js/'.basename( $Files[ $i ] ).'.js';
					if( file_exists( $Path ) === false )
					{
						$Errors++;
						print( "<nobr>".$Files[ $i ]."</nobr><br>" );
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка наличия функции.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing searches for function.
		*
		*	@author Dodonov A.A.
		*/
		function			test_get_list_form_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				if( strpos( $Files[ $i ] , '_view.php' ) !== false )
				{
					$Path = dirname( $Files[ $i ] ).'/include/js/'.basename( $Files[ $i ] ).'.js';
					if( file_exists( $Path ) )
					{
						$FileContent = file( $Path );
						if( strpos( $FileContent , '.get_list_form = function(' ) === false )
						{
							$Errors++;
							print( "<nobr>".$Path." : no get_list_form found</nobr><br>" );
						}
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
		
		/**
		*	\~russian Проверка наличия функции.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing searches for function.
		*
		*	@author Dodonov A.A.
		*/
		function			test_get_custom_list_form_js()
		{
			$Files = $this->Utilities->get_files_from_directory( '.' , '/.+\.php/' , true );
			for( $i = 0 , $Errors = 0 ; $i < count( $Files ) ; $i++ )
			{
				if( strpos( $Files[ $i ] , '_view.php' ) !== false )
				{
					$Path = dirname( $Files[ $i ] ).'/include/js/'.basename( $Files[ $i ] ).'.js';
					if( file_exists( $Path ) )
					{
						$FileContent = file( $Path );
						if( strpos( $FileContent , '.get_custom_list_form = function(' ) === false )
						{
							$Errors++;
							print( "<nobr>".$Path." : no get_custom_list_form found</nobr><br>" );
						}
					}
				}
			}
			return( $Errors == 0 ? 'TEST PASSED' : "ERROR( $Errors )" );
		}
	}

?>