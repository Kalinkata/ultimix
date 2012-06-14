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
	*	\~russian Обработчик макросов.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Processing macroes.
	*
	*	@author Dodonov A.A.
	*/
	class	category_markup_1_0_0{

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
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$CategoryAccess = false;
		var					$CategoryAlgorithms = false;
		var					$CategoryView = false;
		var					$String = false;

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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CategoryAccess = get_package( 'category::category_access' , 'last' , __FILE__ );
				$this->CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$this->CategoryView = get_package( 'category::category_view' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения пустой категории.
		*
		*	@param $Settings - Параметры.
		*
		*	@return SQL запрос для получения нулевой категории.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns null category.
		*
		*	@param $Settings - Settings.
		*
		*	@return SQL query for the null category.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_null_category( &$Settings )
		{
			try
			{
				$NullCategory = '';

				if( $Settings->get_setting( 'null_category' , false ) !== false )
				{
					$Id = $Settings->get_setting( 'null_category' );

					$Title = $Settings->get_setting( 'null_category_title' , '' );

					$NullCategory = "SELECT $Id AS id , '{lang:$Title}' AS value UNION ";
				}

				return( $NullCategory );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения кода селекта.
		*
		*	@param $BlockSettings - Параметры генерации.
		*
		*	@return Код селекта.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns select code.
		*
		*	@param $BlockSettings - Parameters.
		*
		*	@return Code of the select.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_category( &$BlockSettings )
		{
			try
			{
				list( $Name , $Default , $Class ) = $BlockSettings->get_settings( 
					'name,default,class' , 'category,0,width_160 flat'
				);

				$Default = $Default == 0 ? '' : "default=$Default;";
				$NullCategory = $this->get_null_category( $BlockSettings );
				$Id = $this->CategoryView->get_category_id( $BlockSettings );
				$Value = $BlockSettings->get_setting( 'value' , false );

				$Code = "{select:$Default"."class=$Class;name=$Name;query=$NullCategory SELECT id , title as ".
						"`value` FROM umx_category WHERE direct_category![eq]id AND direct_category IN ( $Id )".
						( $Value ? ";value=$Value" : '' )."}";

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'category_id'.
		*
		*	@param $BlockSettings - Параметры обработки.
		*
		*	@return Список идентификаторов.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_id'.
		*
		*	@param $BlockSettings - Options of processing.
		*
		*	@return List of ids.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_category_id( &$BlockSettings )
		{
			try
			{
				$Names = $BlockSettings->get_setting( 'names' , '' );

				$Names = $BlockSettings->get_setting( 'name' , $Names );

				$Ids = implode( ',' , $this->CategoryAlgorithms->get_category_ids( $Names ) );

				return( $Ids );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	
		/**
		*	\~russian Функция обработки макроса 'category_siblings_ids'.
		*
		*	@param $BlockSettings - Параметры обработки.
		*
		*	@return Идентификаторы.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_siblings_ids'.
		*
		*	@param $BlockSettings - Options of processing.
		*
		*	@return Ids.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_category_siblings_ids( &$BlockSettings )
		{
			try
			{
				$CategoryId = $BlockSettings->get_setting( 'id' );

				$SiblingsIds = implode( ',' , $this->CategoryAccess->get_siblings_ids( $CategoryId ) );

				return( $SiblingsIds );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция обработки макроса 'category_name'.
		*
		*	@param $BlockSettings - Параметры обработки.
		*
		*	@return Название категории.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_name'.
		*
		*	@param $BlockSettings - Options of processing.
		*
		*	@return Category name.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_category_name( &$BlockSettings )
		{
			try
			{
				$Category = $this->CategoryAlgorithms->get_by_id( $BlockSettings->get_setting( 'id' ) );

				$Title = get_field( $Category , 'title' );

				return( $Title );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>