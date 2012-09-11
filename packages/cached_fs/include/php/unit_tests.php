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

		var				$CacheSwitch;

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
		function	set_up()
		{
			$Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
			$this->CacheSwitch = $Settings->get_package_setting( 
				'cache' , 'last' , 'cf_cache' , 'cache_switch' , 'off'
			);
			$Settings->set_package_setting( 'cache' , 'last' , 'cf_cache' , 'cache_switch' , 'on' );
			
			$Cache = get_package( 'cache' , 'last' , __FILE__ );
			$Cache->flush();
			$Cache->reset();
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
		function	tear_down()
		{
			$Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
			$Settings->set_package_setting( 'cache' , 'last' , 'cf_cache' , 'cache_switch' , $this->CacheSwitch );

			$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
			$Cache->drop_cache();
		}

		/**
		*	\~russian Файл существует но в кэше его нет.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english File exists but it is not in the cache.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_exists_put_in_cache()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );
			$CachedFS->Cache->delete_data( './packages/index.html' );

			if( $CachedFS->file_exists( './packages/index.html' ) === true && 
				$CachedFS->Cache->data_exists( './packages/index.html' ) === false )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Файл не существует, в кэше этой информации нет.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english File does not exist but this information is not in the cache.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_not_exists_put_in_cache()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );
			$CachedFS->Cache->delete_data( './unexisting' );

			if( $CachedFS->file_exists( './unexisting' ) === false && 
				$CachedFS->Cache->data_exists( './unexisting' ) === false )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Файл не существует и в кэше эта информация есть.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english File does not exist and this information is in the cache.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_not_exists_data_in_cache()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );
			$CachedFS->file_exists( './unexisting' );

			if( $CachedFS->Cache->data_exists( './unexisting' ) === true && 
				$CachedFS->Cache->get_data( './unexisting' ) == '_file_was_not_found' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Файл существует и в кэше эта информация есть.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english File does exist and this information is in the cache.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_exists_data_in_cache()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );
			$CachedFS->file_exists( './packages/index.html' );

			if( $CachedFS->Cache->data_exists( './packages/index.html' ) === true && 
				$CachedFS->Cache->get_data( './packages/index.html' ) == '<html><head></head><body></body></html>' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Получение файла с диска.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting file from disk.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_get_contents_from_disk()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );
			$CachedFS->Cache->delete_data( './packages/index.html' );
			$Result = $CachedFS->file_get_contents( './packages/index.html' );

			if( $Result == '<html><head></head><body></body></html>' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Получение файла из кэша.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Getting file from cache.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_get_contents_from_cache()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );

			$CachedFS->file_get_contents( './packages/index.html' );

			file_put_contents( './packages/index.html' , '' );

			$Result = $CachedFS->file_get_contents( './packages/index.html' );

			file_put_contents( './packages/index.html' , '<html><head></head><body></body></html>' );

			if( $Result == '<html><head><head><body></body></html>' )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}

		/**
		*	\~russian Обновление несуществующих данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating unexisting data.
		*
		*	@author Dodonov A.A.
		*/
		function	test_set_un_existing_data()
		{
			try
			{
				$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );
				$CachedFS->Cache->delete_data( './unexisting' );
				$CachedFS->file_get_contents( './unexisting' );

				return( 'ERROR' );
			}
			catch( Exception $e )
			{
				return( 'TEST PASSED' );
			}
		}

		/**
		*	\~russian Запись в файл.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Writing in file.
		*
		*	@author Dodonov A.A.
		*/
		function	test_file_put_contents()
		{
			$CachedFS = get_package_object( 'cached_fs' , 'last' , __FILE__ );

			$CachedFS->file_put_contents( './exception.log' , '' );

			// проверим что информация сохранилась в кэше
			if( $CachedFS->file_exists( './exception.log' ) === false )
			{
				return( 'ERROR' );
			}

			// проверим что информация сохранилась на диске
			$CachedFS->Cache->delete_data( './packages/index.html' );
			if( $CachedFS->file_exists( './exception.log' ) === false )
			{
				return( 'ERROR' );
			}

			return( 'TEST PASSED' );
		}
	}

?>