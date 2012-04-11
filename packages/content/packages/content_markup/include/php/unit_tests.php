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
		
		var					$ContentMarkup = false;
		
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
			$this->ContentMarkup = get_package( 'content::content_markup' , 'last' , __FILE__ );
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
		*	\~russian Тестирование макроса content_links.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Testing 'content_links' macro.
		*
		*	@author Dodonov A.A.
		*/
		function			test_function_size()
		{
			try
			{
				$Changed = false;
				$Str = '{content_links:category=news}';
				
				list( $Str , $Changed ) = this->ContentMarkup->process_content_links( $Str , $Changed );
				
				if( strpos( $Str , 'Welcome' ) === false )
				{
					print( 'ERROR' );
				}
				else
				{
					print( 'TEST PASSED' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
	
?>