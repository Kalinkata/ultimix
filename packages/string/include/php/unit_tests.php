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
		*	\~russian Вообще нет макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english No macro at all.
		*
		*	@author Dodonov A.A.
		*/
		function			test_no_macro()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix some postfix';
			$Result = $String->get_macro_parameters( $Script , 'macro' );
			
			if( $Result == false )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Простейший случай.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english The most simple case.
		*
		*	@author Dodonov A.A.
		*/
		function			test_simple()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a=1;b=2} some postfix';
			$Result = $String->get_macro_parameters( $Script , 'macro' );
			
			if( $Result == "a=1;b=2" )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Более сложный тест, когда более одного макроса.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english More compilcated test - 2 macro with the same names.
		*
		*	@author Dodonov A.A.
		*/
		function			test_simple_2()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a=1;b=2} middle {macro:a=3;b=4} some postfix';
			$Result = $String->get_macro_parameters( $Script , 'macro' );
			
			if( $Result == "a=1;b=2" )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Обработка вложенных макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing with nested macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_nested()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a={lang:space};b=2} some postfix';
			$Result = $String->get_macro_parameters( $Script , 'macro' );
			
			if( $Result == "a={lang:space};b=2" )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Обработка макросов с терминальными значениями.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing with terminal values.
		*
		*	@author Dodonov A.A.
		*/
		function			test_regexp_terminal()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a=1;b=2} some postfix';
			$Result = $String->get_macro_parameters( 
				$Script , 'macro' , array( 'a' => TERMINAL_VALUE , 'b' => TERMINAL_VALUE )
			);
			
			if( $Result == "a=1;b=2" )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Обработка макросов с терминальными значениями (случай, когда макрос не найден).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing with terminal values (case when no macro was found).
		*
		*	@author Dodonov A.A.
		*/
		function			test_regexp_terminal_not_found()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a={lang:space};b=2} some postfix';
			$Result = $String->get_macro_parameters( 
				$Script , 'macro' , array( 'a' => TERMINAL_VALUE , 'b' => TERMINAL_VALUE )
			);
			
			if( $Result == false )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Обработка макросов с терминальными значениями (случай, когда 
		*	найден второй макрос а первый пропущен).
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing with terminal values (case when the first macro was not found, 
		*	but the second one was).
		*
		*	@author Dodonov A.A.
		*/
		function			test_regexp_second_found()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a={lang:space};b=2} middle {macro:a=3;b=4} some postfix';
			$Result = $String->get_macro_parameters( 
				$Script , 'macro' , array( 'a' => TERMINAL_VALUE , 'b' => TERMINAL_VALUE )
			);
			
			if( $Result == 'a=3;b=4' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Обработка рекурсивных макросов.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Processing recursive macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_recursive()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a={macro:a=3;b=4};b=2} some postfix';
			$Result = $String->get_macro_parameters( 
				$Script , 'macro' , array( 'a' => TERMINAL_VALUE , 'b' => TERMINAL_VALUE )
			);
			
			if( $Result == 'a=3;b=4' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
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
		function			test_invalid_macro()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a={lang:space};b=2 middle {macro:a=3;b=4} some postfix';
			$Result = $String->get_macro_parameters( 
				$Script , 'macro' , array( 'a' => TERMINAL_VALUE , 'b' => TERMINAL_VALUE )
			);
			
			if( $Result == 'a=3;b=4' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
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
		function			test_top_complexity()
		{
			$String = get_package_object( 'string' , 'last' , __FILE__ );
			$Script = 'some prefix {macro:a={{}}{}{{}}:space};b=2 middle {{}}}{}{ '.
					'{macro:a=3;b=4} some {{}}{}}{}{}{}{} postfix';
			$Result = $String->get_macro_parameters( 
				$Script , 'macro' , array( 'a' => TERMINAL_VALUE , 'b' => TERMINAL_VALUE )
			);
			
			if( $Result == 'a=3;b=4' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
	}
	
?>