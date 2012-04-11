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
	*	\~russian Вид компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Component's view.
	*
	*	@author Dodonov A.A.
	*/
	class	category_view_1_0_0{

		/**
		*	\~russian HTML код компонента.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english HTML code of the component.
		*
		*	@author Dodonov A.A.
		*/
		var					$Output;

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
		var					$CategoryAccess = false;
		var					$CategoryAlgorithms = false;
		var					$CategoryViewTemplates = false;
		var					$Security = false;
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
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CategoryAccess = get_package( 'category::category_access' , 'last' , __FILE__ );
				$this->CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$this->CategoryViewTemplates = get_package( 
					'category::category_view::category_view_templates' , 'last' , __FILE__
				);
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция предгенерационных действий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается исключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function executes before any page generating actions took place.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			pre_generation( $Options )
		{
			try
			{
				$Lang = get_package( 'lang' , 'last' , __FILE__ );
				
				$Lang->include_strings_js( 'category::category_view' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция выборки идентфикаторы категории из настроек.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return Идентификатор категории.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns category id from the settings.
		*
		*	@param $Options - Settings.
		*
		*	@return Category id.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_category_id( $Options )
		{
			try
			{
				$DirectCategoryName = false;

				if( $Options->get_setting( 'direct_category_name' , false ) !== false )
				{
					$DirectCategoryName = $Options->get_setting( 'direct_category_name' );
				}
				elseif( $Options->get_setting( 'category_name' , false ) !== false )
				{
					$DirectCategoryName = $Options->get_setting( 'category_name' );
				}
				
				if( $DirectCategoryName === false )
				{
					return( $Options->get_setting( 'direct_category' , 0 ) );
				}
				else
				{
					return( $this->CategoryAccess->get_category_id( $DirectCategoryName ) );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция формирования кода дерева.
		*
		*	@param $RetCode - Код дерева.
		*
		*	@param $Record - Запись.
		*
		*	@param $DisplayTemplates - Параметры отображения.
		*
		*	@return HTML код дерева.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates tree.
		*
		*	@param $RetCode - Tree code.
		*
		*	@param $Record - Record.
		*
		*	@param $DisplayTemplates - Display templates.
		*
		*	@return HTML code of the tree.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_categories_catalogue_subtree( $RetCode , $Record , $DisplayTemplates )
		{
			try
			{
				$RetCode .= get_field( $DisplayTemplates , 'start_item_tag' );
				$RetCode  = $this->String->print_record( $RetCode , $Record );
				$RetCode .= $this->draw_categories_catalogue_rec( 
					$Records , get_field( $Record , 'id' ) , $Templates
				);
				$RetCode .= get_field( $DisplayTemplates , 'end_item_tag' );
				$RetCode  = $this->String->print_record( $RetCode , $Record );
				
				return( $RetCode );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение списка категорий.
		*
		*	@param $Records - Записи.
		*
		*	@param $RootId - id корневого элемента.
		*
		*	@param $Templates - Шаблоны.
		*
		*	@return HTML код каталога.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Records - Records.
		*
		*	@param $RootId - Root id.
		*
		*	@param $Templates - Templates.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_catalogue_rec( $Records , $RootId , $Templates = false )
		{
			try
			{
				$DisplayTemplates = $this->CategoryViewTemplates->get_categories_catalogue_templates( $Templates );
				$Children = $this->CategoryAlgorithms->get_children( $RootId , $Records );

				if( isset( $Children[ 0 ] ) )
				{
					$RetCode = get_field( $DisplayTemplates , 'start_tag' );

					foreach( $Children as $k => $v )
					{
						$RetCode = $this->draw_categories_catalogue_subtree( $RetCode , $v , $DisplayTemplates );
					}

					$RetCode .= get_field( $DisplayTemplates , 'end_tag' );
					return( $RetCode );
				}

				return( '' );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение списка категорий.
		*
		*	@param $Name - Название категории.
		*
		*	@param $Templates - Шаблоны.
		*
		*	@return HTML код каталога.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Name - Name of the category.
		*
		*	@param $Templates - Templates.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_catalogue( $Name , $Templates = false )
		{
			try
			{
				$id = $this->CategoryAccess->get_category_id( $Name );
					
				$Items = $this->CategoryAccess->select_categories_list( $id );
				
				return( $this->draw_categories_catalogue_rec( $Items , $id , $Templates ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение списка категорий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_catalogue_view( $Options )
		{
			try
			{
				$id = $this->get_category_id( $Options );
				
				$Items = $this->CategoryAccess->select_categories_list( $id );
				
				$this->Output = $this->draw_categories_catalogue_rec( $Items , $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение списка категорий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Records - Записи.
		*
		*	@param $Templates - Шаблоны.
		*
		*	@return HTML код каталога.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@param $Records - Records.
		*
		*	@param $Templates - Templates.
		*
		*	@return HTML code.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_catalogue_part( $Options , $Records , $Templates = false )
		{
			try
			{
				$DisplayTemplates = $this->CategoryViewTemplates->get_categories_catalogue_part_templates(
					$Options , $Templates
				);

				$RetCode = '';
				
				foreach( $Records as $k => $v )
				{
					$SubcategoriesCount = $this->CategoryAccess->get_children_count( get_field( $v , 'id' ) );
					if( $SubcategoriesCount )
					{
						$RetCode .= get_field( $DisplayTemplates , 'item' );
					}
					else
					{
						$RetCode .= get_field( $DisplayTemplates , 'leaf' );
					}
					$RetCode  = $this->String->print_record( $RetCode , $v );
				}
				
				return( $RetCode );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение части каталога.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function draws part of the catalogue.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_catalogue_part_view( $Options )
		{
			try
			{
				if( $this->Security->get_gp( 'cid' , 'set' ) )
				{
					$id = $this->Security->get_gp( 'cid' , 'integer' );
				}
				else
				{
					$id = $this->get_category_id( $Options );
				}

				$Items = $this->CategoryAccess->get_children( $id );
				
				$this->Output = $this->draw_categories_catalogue_part( $Options , $Items );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение пути в дереве категорий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_path( $Options )
		{
			try
			{
				$Items = $this->CategoryAccess->select_categories_list( $id = $this->get_category_id( $Options ) );
				$cid = $this->Security->get_gp( 'cid' , 'integer' , $id );
				$Path = $this->CategoryAlgorithms->get_previous_items( $Items , $cid );

				$RetCode = array();

				foreach( $Path as $i => $Item )
				{
					$Template = $this->CachedMultyFS->get_template( __FILE__ , 'categories_path.tpl' );
					$PlaceHolders = array( '{id}' , '{title}' );
					$Template = str_replace( $PlaceHolders , array( $Item->id , $Item->title ) , $Template );
				}

				$RetCode = implode( '&nbsp;&gt;&nbsp;' , $RetCode );

				$this->Output = $RetCode;
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция формирования кода дерева.
		*
		*	@param $RetCode - Код дерева.
		*
		*	@param $Record - Запись.
		*
		*	@param $DisplayTemplates - Параметры отображения.
		*
		*	@return HTML код дерева.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates tree.
		*
		*	@param $RetCode - Tree code.
		*
		*	@param $Record - Record.
		*
		*	@param $DisplayTemplates - Display templates.
		*
		*	@return HTML code of the tree.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	draw_categories_structure_subtree( $RetCode , $Record , $DisplayTemplates )
		{
			try
			{
				$SubTree = $this->draw_categories_structure_rec( get_field( $Record , 'id' ) , $DisplayTemplates );

				$RetCode .= $SubTree === '' ? 	get_field( $DisplayTemplates , 'start_leaf_tag' ) : 
												get_field( $DisplayTemplates , 'start_item_tag' );
				$RetCode  = $this->String->print_record( $RetCode , $Record );
				$RetCode .= $SubTree;
				$RetCode .= get_field( $DisplayTemplates , 'end_item_tag' );
				
				return( $RetCode );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция формирования кода дерева.
		*
		*	@param $RootId - Идентифкатор корня поддерева.
		*
		*	@param $DisplayTemplates - Параметры отображения.
		*
		*	@return HTML код дерева.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function creates tree.
		*
		*	@param $RootId - Id of the tree's root.
		*
		*	@param $DisplayTemplates - Display templates.
		*
		*	@return HTML code of the tree.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_structure_rec( $RootId , $DisplayTemplates = false )
		{
			try
			{
				$Children = $this->CategoryAccess->get_children( $RootId );

				$RetCode = '';

				if( isset( $Children[ 0 ] ) )
				{
					$RetCode .= get_field( $DisplayTemplates , 'start_tag' );

					foreach( $Children as $k => $v )
					{
						$RetCode = $this->draw_categories_structure_subtree( $RetCode , $v , $DisplayTemplates );
					}

					$RetCode .= get_field( $DisplayTemplates , 'end_tag' );
				}

				return( $RetCode );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция вывода корня.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $id - Идентификатор корня.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function outputs root.
		*
		*	@param $Options - Settings.
		*
		*	@param $id - id of the root.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	output_root( &$Options , $id )
		{
			try
			{
				if( $Options->get_setting( 'output_root' , 1 ) )
				{
					$TreeRoot = $this->CachedMultyFS->get_template( __FILE__ , 'tree_root.tpl' );
					
					$PlaceHolders = array( '{id}' , '{output}' );
					
					$this->Output = str_replace( $PlaceHolders , array( $id , $this->Output ) , $TreeRoot );
				}
				else
				{
					$NoTreeRoot = $this->CachedMultyFS->get_template( __FILE__ , 'no_tree_root.tpl' );
					
					$this->Output = str_replace( '{output}' , $this->Output , $NoTreeRoot );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отображение списка категорий.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			draw_categories_tree( &$Options )
		{
			try
			{
				$id = $this->get_category_id( $Options );

				$DisplayTemplates = $this->CategoryViewTemplates->get_default_category_structure_templates( $Options );

				$this->Output = $this->draw_categories_structure_rec( $id , $DisplayTemplates );

				$this->output_root( $Options , $id );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция отрисовки компонента.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@return HTML код компонента.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Component's view.
		*
		*	@param $Options - Settings.
		*
		*	@return HTML code of the component.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			view( $Options )
		{
			try
			{
				$ContextSet = get_package( 'gui::context_set' , 'last' , __FILE__ );
				
				$PackagePath = dirname( __FILE__ );
				
				$ContextSet->add_context( $PackagePath.'/conf/cfcx_categories_tree' );
				
				$ContextSet->add_context( $PackagePath.'/conf/cfcx_categories_catalogue' );
				
				$ContextSet->add_context( $PackagePath.'/conf/cfcx_categories_catalogue_part' );
				
				$ContextSet->add_context( $PackagePath.'/conf/cfcx_categories_path' );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
				
				return( $this->Output );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>