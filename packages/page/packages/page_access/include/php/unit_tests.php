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
			get_package( 'page::page_access' , 'last' , __FILE__ );

			return( 'TEST PASSED' );
		}

		/**
		*	\~russian Обработка генерации главной страницы консоли администратора.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function tests admin.html page.
		*
		*	@author Dodonov A.A.
		*/
		function			test_gen_pages()
		{
			//TODO: add select_list method unit-test to all *_access packages
			$PageAccess = get_package( 'page::page_access' , 'last' , __FILE__ );

			$Pages = $PageAccess->get_list_of_pages();

			foreach( $Pages as $i => $Page )
			{
				$PageContent = file_get_contents( HTTP_HOST.'/'.get_field( $Page , 'alias' ).'.html' );

				if( stripos( $PageContent , 'error' ) !== false )
				{
					return( 'ERROR' );
				}

				if( stripos( $PageContent , 'warning' ) !== false )
				{
					return( 'ERROR' );
				}
			}

			return( 'TEST PASSED' );
		}
	}

?>