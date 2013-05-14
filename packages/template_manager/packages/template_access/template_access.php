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
	*	\~russian Класс для работы с записями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides records access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	template_access_1_0_0{

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
		var					$PackageAccess = false;
		var					$Security = false;

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
				$this->PackageAccess = get_package( 'core::package_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список шаблонов.
		*
		*	@return Список шаблонов в формате array( 'name' => 'template_name' , 'version' => 'template_version' ).
		*
		*	@exception Exception - кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of templates.
		*
		*	@return List of templates.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template_list()
		{
			try
			{
				$RawTemplateList = $this->CachedMultyFS->file_get_contents( 
					dirname( __FILE__ ).'/data/template_list' , 'exploded'
				);

				$Templates = array();

				foreach( $RawTemplateList as $rtl )
				{
					$rtl = str_replace( "\r" , '' , $rtl );
					$rtl = str_replace( "\n" , '' , $rtl );

					$Trinity = explode( '#' , $rtl );

					$Templates [] = array( 
						'name' => $Trinity[ 0 ] , 'version' => $Trinity[ 1 ] , 'default' => $Trinity[ 2 ]
					);
				}

				return( $Templates );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция возвращает список записей.
		*
		*	@param $Start - Номер первой записи.
		*
		*	@param $Limit - Ограничение на количество записей
		*
		*	@param $Field - Поле, по которому будет осуществляться сортировка.
		*
		*	@param $Order - Порядок сортировки.
		*
		*	@param $Condition - Дополнительные условия отбора записей.
		*
		*	@return Список записей.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns list of records.
		*
		*	@param $Start - Number of the first record.
		*
		*	@param $Limit - Count of records limitation.
		*
		*	@param $Field - Field to sort by.
		*
		*	@param $Order - Sorting order.
		*
		*	@param $Condition - Additional conditions.
		*
		*	@return List of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select( $Start = false , $Limit = false , $Field = false , 
																				$Order = false , $Condition = '1 = 1' )
		{
			try
			{
				$SearchString = $this->Security->get_gp( 'search_string' , 'string' , '' );
				$Templates = $this->get_template_list();
				$Return = array();

				if( $SearchString == '' )
				{
					$Return = $Templates;
				}
				else
				{
					foreach( $Templates as $i => $Template )
					{
						if( strpos( get_field( $Template , 'name' ) , $SearchString ) !== false ||
							strpos( get_field( $Template , 'version' ) , $SearchString ) !== false )
						{
							$Return [] = $Template;
						}
					}
				}

				return( $Return );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Получение информации о пакете по идентификатору.
		*
		*	@param $id - id пакета.
		*
		*	@return Информация о пакете.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method returns package info.
		*
		*	@param $id - Package's id.
		*
		*	@return Package info.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_template_info_by_id( $id )
		{
			try
			{
				$id = str_replace( '[sharp]' , '_' , $id );
				$id = str_replace( '.' , '_' , $id );

				$Templates = $this->get_template_list();

				foreach( $Templates as $i => $Template )
				{
					$Signature = get_field( $Template , 'name' ).'_'.
									str_replace( '.' , '_' , get_field( $Template , 'version' ) );

					if( $Signature == $id )
					{
						return( $Template );
					}
				}

				throw( new Exception( "The package '$id' was not found" ) );
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}

		/**
		*	\~russian Выборка массива объектов.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function selects list of objects.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@return Array of records.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'string' );

				return( array( $this->get_template_info_by_id( $id ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Создание пакета.
		*
		*	@param $Record - Информация о создаваемом пакете.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates package.
		*
		*	@param $Record - Creating package's description.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( &$Record )
		{
			try
			{
				set_field( $Record , 'package_name' , get_field( $Record , 'template_package_name' ) );
				set_field( $Record , 'package_version' , get_field( $Record , 'template_package_version' ) );

				$id = $this->PackageAccess->create( $Record );
				$id = implode( '.' , $id );

				$Info = $this->PackageAccess->get_package_info_by_id( $id );

				$List = $this->CachedMultyFS->get_data( __FILE__ , 'template_list' );

				$List .= "\r\n".$Info[ 'full_package_name' ].'#'.$Info[ 'full_package_version' ]."#";

				$this->CachedMultyFS->file_put_contents( dirname( __FILE__ ).'/data/template_list' , $List );

				return( $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление пакета из списка.
		*
		*	@param $id - id пакета.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Delete package from list.
		*
		*	@param $id - Package's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	remove_template_from_list( $id )
		{
			try
			{
				$Info = $this->PackageAccess->get_package_info_by_id( $id );
				$List = $this->CachedMultyFS->get_data( __FILE__ , 'template_list' );

				$List = str_replace( 
					"\r\n".$Info[ 'full_package_name' ].'#'.$Info[ 'full_package_version' ]."#" , '' , $List
				);

				$List = str_replace( 
					$Info[ 'full_package_name' ].'#'.$Info[ 'full_package_version' ]."#" , '' , $List 
				);

				$this->CachedMultyFS->file_put_contents( dirname( __FILE__ ).'/data/template_list' , $List );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Удаление пакета по имени и версии.
		*
		*	@param $Ids - id пакета.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Delete package by given name and version.
		*
		*	@param $Ids - Package's id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			delete( $Ids )
		{
			try
			{
				$Ids = explode( ',' , $Ids );

				foreach( $Ids as $k => $id )
				{
					$id = explode( '[sharp]' , $id );
					$PackageName = array_pop( explode( '::' , $id[ 0 ] ) );
					$PackageVersion = str_replace( '_' , '.' , array_pop( explode( '::' , $id[ 1 ] ) ) );

					$this->remove_template_from_list( "$PackageName.$PackageVersion" );

					$this->PackageAccess->delete( "$PackageName.$PackageVersion" );
				}
			}
			catch( Exception $e )
			{
				$Args = func_get_args();throw( _get_exception_object( __FUNCTION__ , $Args , $e ) );
			}
		}
	}

?>