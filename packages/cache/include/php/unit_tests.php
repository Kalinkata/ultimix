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
		function			set_up()
		{
			$Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
			$this->CacheSwitch = $Settings->get_package_setting( 
				'cache' , 'last' , 'cf_cache' , 'cache_switch' , 'off'
			);
			$Settings->set_package_setting( 'cache' , 'last' , 'cf_cache' , 'cache_switch' , 'on' );
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
			$Settings = get_package_object( 'settings::package_settings' , 'last' , __FILE__ );
			$Settings->set_package_setting( 'cache' , 'last' , 'cf_cache' , 'cache_switch' , $this->CacheSwitch );
			
			$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
			$Cache->drop_cache();
		}
		
		/**
		*	\~russian Выборка несуществующих данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Selecting unexisting data.
		*
		*	@author Dodonov A.A.
		*/
		function			test_get_unexisting_data()
		{
			$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
			$Data = $Cache->get_data( 'unexisting_data' );
			
			if( $Data === false )
			{
				return( 'TEST PASSED' );
			}
			else
			{
				return( 'ERROR' );
			}
		}
		
		/**
		*	\~russian Обновление даных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating data.
		*
		*	@author Dodonov A.A.
		*/
		function			test_set_existing_data()
		{
			$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
			$Data = $Cache->add_data( 'existing_data' , '5678' );
			$Data = $Cache->set_data( 'existing_data' , '1234' );
			$Data = $Cache->get_data( 'existing_data' );
			
			if( $Data === '1234' )
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
		function			test_set_unexisting_data()
		{
			try
			{
				$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
				$Cache->delete_data( 'existing_data' );
				$Data = $Cache->set_data( 'existing_data' , '1234' );
				
				return( 'ERROR' );
			}
			catch( Exception $e )
			{
				return( 'TEST PASSED' );
			}
		}
		
		/**
		*	\~russian Удаление данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting data.
		*
		*	@author Dodonov A.A.
		*/
		function			test_deleting_data()
		{
			try
			{
				$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
				if( $Cache->data_exists( 'existing_data' ) )
				{
					return( 'ERROR (1)' );
				}
				
				$Data = $Cache->add_data( 'existing_data' , '1234' );
				if( $Cache->data_exists( 'existing_data' ) === false )
				{
					return( 'ERROR (2)' );
				}
				
				$Cache->delete_data( 'existing_data' );
				if( $Cache->data_exists( 'existing_data' ) === false )
				{
					return( 'TEST PASSED' );
				}
				else
				{
					return( 'ERROR (3)' );
				}
			}
			catch( Exception $e )
			{
				return( 'TEST PASSED' );
			}
		}
		
		/**
		*	\~russian Удаление данных по тэгу.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Deleting data by tag.
		*
		*	@author Dodonov A.A.
		*/
		function			test_deleting_data_by_tag()
		{
			try
			{
				$Cache = get_package_object( 'cache' , 'last' , __FILE__ );
				$Cache->delete_data( 'existing_data' );
				if( $Cache->data_exists( 'existing_data' ) )
				{
					return( 'ERROR (1)' );
				}
				$Data = $Cache->add_data( 'existing_data' , '1234' , array( 'one' , 'two' , 'three' ) );
				if( $Cache->data_exists( 'existing_data' ) === false )
				{
					return( 'ERROR (2)' );
				}
				$Cache->delete_data_by_tag( 'two' );
				if( $Cache->data_exists( 'existing_data' ) === false )
				{
					return( 'TEST PASSED' );
				}
				else
				{
					return( 'ERROR (3)' );
				}
			}
			catch( Exception $e )
			{
				return( 'TEST PASSED' );
			}
		}
	}
	
?>