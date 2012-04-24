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

	// TODO replace static_content_ from configs
	// TODO replace static_content_ from data.sql
	// TODO replace static_content_ from permits

	/**
	*	\~russian Получение доступа к шаблону.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english This class provides access to the templates.
	*
	*	@author Dodonov A.A.
	*/
	class	template_content_access_1_0_0{

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
		var					$Security = false;
		var					$SecurityParser = false;

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
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->SecurityParser = get_package( 'security::security_parser' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Дополнительные условия на рабочее множество данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~russian Additional conditions of the processing data.
		*
		*	@author Dodonov A.A.
		*/
		var					$AddCondition = false;
		
		/**
		*	\~russian Установка дополнительных условия.
		*
		*	@param $theAddCondition - Дополнительные условия.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets additional conditions.
		*
		*	@param $theAddCondition - Additional conditions.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_add_condition( $theAddCondition )
		{
			try
			{
				if( $this->AddCondition === false )
				{
					$this->AddCondition = $theAddCondition;
				}
				else
				{
					throw( new Exception( '"AddCondition" was already set' ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка массива объектов.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@return Массив записей.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
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
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			select_list( $id )
		{
			try
			{
				$id = $this->Security->get( $id , 'string' );
				
				$id = explode( ',' , $id );

				$Return = array();
				
				foreach( $id as $k => $v )
				{
					$Return [] = array( 'content' => $this->Security->get( $this->get_content( $v ) , 'string' ) );
				}
				
				return( $Return );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Редактирование записи.
		*
		*	@param $id - Список идентификаторов удаляемых данных, разделённых запятыми.
		*
		*	@param $Record - Объект по чьему образцу будет создаваться запись.
		*
		*	@exception Exception - Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Updating record.
		*
		*	@param $id - Comma separated list of record's id.
		*
		*	@param $Record - Example for update.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			update( $id , $Record )
		{
			try
			{
				$id = $this->Security->get( $id , 'string' );
				$id = explode( ',' , $id );
				
				$Record = $this->SecurityParser->parse_parameters( $Record , 'content:string' , 'allow_not_set' );
				$Template = get_field( $Record , 'content' );
				$Template = $this->Security->get( $Template , 'unsafe_string' );
				
				foreach( $id as $k => $v )
				{
					$this->CachedMultyFS->file_put_contents( $this->get_content_path( $v ) , $Template );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Проверка виртуального пути.
		*
		*	@param $VirtualPath - Путь к файлу с контентом.
		*
		*	@return Путь к файлу контента.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function checks virtual path.
		*
		*	@param $VirtualPath - Path to the content's file name.
		*
		*	@return Path to the content file.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			try_virtual_path( $VirtualPath )
		{
			try
			{
				$Path = false;

				if( $this->AddCondition !== false )
				{
					$Path = $this->CachedMultyFS->get_file_path( $VirtualPath."_$this->AddCondition" , false );
				}

				if( $Path === false )
				{
					$VirtualPath = $VirtualPath;
					$Path = $this->CachedMultyFS->get_file_path( $VirtualPath , false );
				}

				return( $Path );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка пути контента.
		*
		*	@param $Template - Название файла с контентом.
		*
		*	@return Путь к файлу контента.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content.
		*
		*	@param $Template - Content's file name.
		*
		*	@return Path to the content file.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_content_path( $Template )
		{
			try
			{
				$VirtualPath = dirname( __FILE__ )."/res/templates/$Template";

				if( ( $Path = $this->try_virtual_path( $VirtualPath ) ) !== false )
				{
					return( $Path );
				}

				return( false );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка контента.
		*
		*	@param $Template - Название файла с контентом.
		*
		*	@return статический контент.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content.
		*
		*	@param $Template - Content's file name.
		*
		*	@return Static content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_content( $Template )
		{
			try
			{
				$Path = $this->get_content_path( $Template );
				
				if( $Path !== false && $this->CachedMultyFS->file_exists( $Path ) )
				{
					return( $this->CachedMultyFS->file_get_contents( $this->get_content_path( $Template ) ) );
				}
				else
				{
					throw( new Exception( "The content \"$Template\" was not found. Path : $Path" ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка контента.
		*
		*	@param $PackageName - Название пакета.
		*
		*	@param $PackageVersion - Версия пакета.
		*
		*	@param $Template - Название файла с шаблоном.
		*
		*	@return статический контент.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content.
		*
		*	@param $PackageName - Package name.
		*
		*	@param $PackageVersion - Package version.
		*
		*	@param $Template - Templates's file name.
		*
		*	@return Static content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_template( $PackageName , $PackageVersion , $Template )
		{
			try
			{
				$PackageName = $this->Security->get( $PackageName , 'string' );
				$PackageVersion = $this->Security->get( $PackageVersion , 'string' );
				$Template = $this->Security->get( $Template , 'string' );

				$Path = _get_package_relative_path_ex( $PackageName , $PackageVersion )."/res/templates/$Template";

				return( $this->CachedMultyFS->file_get_contents( $Path ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Выборка контента для пакета.
		*
		*	@param $Options - Опции отображения.
		*
		*	@return Статический контент.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content for package.
		*
		*	@param $Options - Display options.
		*
		*	@return Static content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_package_file( $Options )
		{
			try
			{
				$PackageName = $Options->get_setting( 'package_name' , false );
				$PackageVersion = $Options->get_setting( 'package_version' , 'last' );
				$FileName = $Options->get_setting( 'template' , false );

				return( $this->get_package_template( $PackageName , $PackageVersion , $FileName ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Выборка контента.
		*
		*	@param $Options - Опции отображения.
		*
		*	@return Статический контент.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns content.
		*
		*	@param $Options - Display options.
		*
		*	@return Static content.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_content_ex( $Options )
		{
			try
			{
				$PackageName = $Options->get_setting( 'package_name' , false );

				if( $PackageName === false )
				{
					return( $this->get_content( $Options->get_setting( 'content' ) ) );
				}
				else
				{
					return( $this->get_package_file( $Options ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>