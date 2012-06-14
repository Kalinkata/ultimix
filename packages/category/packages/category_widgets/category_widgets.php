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
	class	category_widgets_1_0_0{

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
		*	\~russian Функция обработки макроса 'category_tree'.
		*
		*	@param $BlockSettings - Параметры отображения.
		*
		*	@return Код писка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_tree'.
		*
		*	@param $BlockSettings - Options of drawing.
		*
		*	@return HTML code of the list.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_category_tree( &$BlockSettings )
		{
			try
			{
				$this->CategoryView->draw_categories_tree( $BlockSettings );

				return( $this->CategoryVie->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция отрисовки списка категорий.
		*
		*	@param $Categories - Категории объекта.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of categories.
		*
		*	@param $Categories - Object's categories.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_categories_list_type_list( &$Categories )
		{
			try
			{
				$Titles = get_field_ex( $Categories , 'title' );

				$Template = $this->CachedMultyFS->get_template( __FILE__ , 'categories_list_type_list.tpl' );

				$TitleTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'title_item.tpl' );

				return( str_replace( '{titles}' , implode( $TitleTemplate , $Titles ) , $Template ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция компиляция кода списка.
		*
		*	@param $AllCategories - Все возможные категории.
		*
		*	@param $Categories - Категории объекта.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function compiles list code.
		*
		*	@param $AllCategories - All possible categories.
		*
		*	@param $Categories - Object's categories.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_active_list_code( &$AllCategories , &$Categories )
		{
			try
			{
				$ids = get_field_ex( $Categories , 'id' );

				$Code = '';
				foreach( $AllCategories as $i => $Category )
				{
					$id = get_field( $Category , 'id' );
					$Title = get_field( $Category , 'title' );

					$Checked = in_array( $id , $ids ) ? 'on' : 'off';

					$Code .= $this->CachedMultyFS->get_template( __FILE__ , 'category_active_list.tpl' );
					$PlaceHolders = array( '{id}' , '{checked}' , '{title}' );

					$Code = str_replace( $PlaceHolders , array( $id , $Checked , $Title ) , $Code );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки списка категорий.
		*
		*	@param $AllCategories - Все возможные категории.
		*
		*	@param $Categories - Категории объекта.
		*
		*	@param $MasterId - Идентификатор мастер-объекта.
		*
		*	@param $MasterType - Тип мастер-объекта.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws list of categories.
		*
		*	@param $AllCategories - All possible categories.
		*
		*	@param $Categories - Object's categories.
		*
		*	@param $MasterId - Master-object's id.
		*
		*	@param $MasterType - Master-object's type.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_categories_list_type_active_list( &$AllCategories , &$Categories , 
																							$MasterId , $MasterType )
		{
			try
			{
				$Code = $this->compile_active_list_code( $AllCategories , $Categories );

				$ActiveListTemplate = $this->CachedMultyFS->get_template( __FILE__ , 'active_list.tpl' );

				$PlaceHolders = array( '{code}' , '{master_id}' , '{master_type}' );

				return( str_replace( $PlaceHolders , array( $Code , $MasterId , $MasterType ) , $ActiveListTemplate ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Переопределение типа.
		*
		*	@param $MasterId - Идентификатор мастер-объекта.
		*
		*	@param $MasterType - Тип мастер-объекта.
		*
		*	@param $Type - Тип.
		*
		*	@return Тип.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function redefines type.
		*
		*	@param $MasterId - Master-object's id.
		*
		*	@param $MasterType - Master-object's type.
		*
		*	@param $Type - Type.
		*
		*	@return Type.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	redefine_type( $MasterId , $MasterType , $Type )
		{
			try
			{
				if( $this->OwnershipAccess->owner_was_registered( $MasterId , $MasterType ) === false )
				{
					$Type = 'list';
				}
				
				return( $Type );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $AllCategories - Все возможные категории.
		*
		*	@param $Type - Тип списка.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws categories.
		*
		*	@param $AllCategories - All possible categories.
		*
		*	@param $Type - List type.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	categories_list( &$AllCategories , $Type )
		{
			try
			{
				list( $MasterId , $MasterType ) = $this->BlockSettings->get_settings( 'master_id,master_type' );

				$Type = $this->redefine_type( $MasterId , $MasterType , $Type );

				$Categories = $this->CategoryAlgorithms->get_object_categories( $MasterId , $MasterType );

				switch( $Type )
				{
					case( 'list' ):return( $this->compile_categories_list_type_list( $Categories ) );
					case( 'active_list' ):
						$Code = $this->compile_categories_list_type_active_list( 
								$AllCategories , $Categories , $MasterId , $MasterType );
						return( $Code );
					default:return( '{lang:illegal_list_type}' );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'category_list' (список категорий связанных с объектом).
		*
		*	@param $BlockSettings - Параметры отображения.
		*
		*	@return Код писка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'category_list' (list of categories binded with the object).
		*
		*	@param $BlockSettings - Options of drawing.
		*
		*	@return HTML code of the list.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	compile_category_list( &$BlockSettings )
		{
			try
			{
				$Type = $BlockSettings->get_setting( 'type' , 'list' );
				$CategoryName = $BlockSettings->get_setting( 'category_name' );

				if( $Type == 'checkbox_list' )
				{
					$ids = implode( ' , ' , $this->CategoryAlgorithms->get_category_ids( $CategoryName ) );
					$Code = "{checkboxset:cols=1;query=SELECT id , title FROM umx_category WHERE ".
							"direct_category IN ( $ids ) AND id <> direct_category;checked_all=1}";
				}
				else
				{
					$AllCategories = $this->CategoryAccess->get_children_by_name( $CategoryName );
					$Code = $this->categories_list( $AllCategories , $Type );
				}
				
				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения параметров макроса.
		*
		*	@param $BlockSettings - Параметры макроса.
		*
		*	@param $CategoryName - Название категории.
		*
		*	@return Параметры макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns macro parameters.
		*
		*	@param $BlockSettings - Macro parameters.
		*
		*	@param $CategoryName - Category name.
		*
		*	@return Macro parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	get_dialog_parameters( &$BlockSettings , $CategoryName )
		{
			try
			{
				$CategoryId = $this->CategoryAccess->get_category_id( $CategoryName );
				
				$id = $BlockSettings->get_setting( 'id' , "select_category_from_tree_$CategoryId" );
				
				$Value = $BlockSettings->get_setting( 'value' , $CategoryId );
				
				$VisibleValue = $BlockSettings->get_setting( 
					'visible_value' , 
					"{record_field:access_package_name=category::category_algorithms;field=title;id=$Value}"
				);
				
				return( array( $id , $Value , $VisibleValue ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения параметров макроса.
		*
		*	@param $BlockSettings - Параметры макроса.
		*
		*	@return Параметры макроса.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns macro parameters.
		*
		*	@param $BlockSettings - Macro parameters.
		*
		*	@return Macro parameters.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_select_category_from_tree_data( &$BlockSettings )
		{
			try
			{
				$CategoryName = $BlockSettings->get_setting( 'category_name' );
				$Name = $BlockSettings->get_setting( 'name' , 'category' );
				$Title = $BlockSettings->get_setting( 'title' , 'category_selection' );
				$Class = $BlockSettings->get_setting( 'class' , 'width_160 flat' );
				
				list( $id , $Value , $VisibleValue ) = $this->get_dialog_parameters( $BlockSettings , $CategoryName );

				return(
					array(
						'category_name' => $CategoryName , 'name' => $Name , 'title' => $Title , 
						'class' => $Class , 'value' => $Value , 'visible_value' => $VisibleValue , 'id' => $id
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция обработки макроса 'select_category_from_tree'.
		*
		*	@param $BlockSettings - Параметры отображения.
		*
		*	@return Код писка.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes macro 'select_category_from_tree'.
		*
		*	@param $BlockSettings - Options of drawing.
		*
		*	@return HTML code of the list.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			compile_select_category_from_tree( &$BlockSettings )
		{
			try
			{
				$Data = $this->get_select_category_from_tree_data( $BlockSettings );

				$Code = $this->CachedMultyFS->get_template( __FILE__ , 'select_category_from_tree.tpl' );

				$Code = $this->String->print_record( $Code , $Data );

				return( $Code );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>