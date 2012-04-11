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
	*	\~russian Шаблоны.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Templates.
	*
	*	@author Dodonov A.A.
	*/
	class	category_view_templates_1_0_0{

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
		var					$BlockSettings = false;
		var					$CachedMultyFS = false;
		var					$CategoryAccess = false;
		var					$CategoryAlgorithms = false;
		var					$OwnershipAccess = false;
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
				$this->BlockSettings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedMultyFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->CategoryAccess = get_package( 'category::category_access' , 'last' , __FILE__ );
				$this->CategoryAlgorithms = get_package( 'category::category_algorithms' , 'last' , __FILE__ );
				$this->OwnershipAccess = get_package( 'permit::ownership::ownership_access' , 'last' , __FILE__ );
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
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция загрузки шаблонов.
		*
		*	@param $LoadedTemplates - Загруженные шаблоны.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $TemplateName - Название шаблона.
		*
		*	@return Шаблоны.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Method loads templates.
		*
		*	@param $LoadedTemplates - Loaded templates.
		*
		*	@param $Options - Settings.
		*
		*	@param $TemplateName - Template name.
		*
		*	@return Templates.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			load_template( $LoadedTemplates , &$Options , $TemplateName )
		{
			try
			{
				$Item = $Options->get_setting( $TemplateName.'_template' , $TemplateName.'_template.tpl' );
				
				$LoadedTemplates[ $TemplateName ] = $this->CachedMultyFS->get_template( __FILE__ , $Item );
			
				return( $LoadedTemplates );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения шаблонов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Templates - Возможные шаблоны.
		*
		*	@return Шаблоны.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns templates.
		*
		*	@param $Options - Settings.
		*
		*	@param $Templates - Possible templates.
		*
		*	@return Templates.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_default_category_structure_templates( $Options , $Templates = array() )
		{
			try
			{
				$DisplayTemplates = array();
				
				$DisplayTemplates = $this->load_template( $DisplayTemplates , $Options , 'start_tag' );
				
				$DisplayTemplates = $this->load_template( $DisplayTemplates , $Options , 'end_tag' );
				
				$DisplayTemplates = $this->load_template( $DisplayTemplates , $Options , 'start_item_tag' );
				
				$DisplayTemplates = $this->load_template( $DisplayTemplates , $Options , 'start_leaf_tag' );
				
				$DisplayTemplates = $this->load_template( $DisplayTemplates , $Options , 'end_item_tag' );
				
				extend( $DisplayTemplates , $Templates );
				
				return( $DisplayTemplates );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения шаблонов.
		*
		*	@param $Templates - Шаблоны.
		*
		*	@return Шаблоны.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns templates.
		*
		*	@param $Templates - Templates.
		*
		*	@return Templates.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_categories_catalogue_templates( $Templates = false )
		{
			try
			{
				$DisplayTemplates = array(
					'start_tag' => 
						$this->CachedMultyFS->get_template( __FILE__ , 'catalogue_start_tag_template.tpl' ) , 
					'end_tag' => 
						$this->CachedMultyFS->get_template( __FILE__ , 'catalogue_end_tag_template.tpl' ) , 
					'start_item_tag' => 
						$this->CachedMultyFS->get_template( __FILE__ , 'catalogue_start_item_tag_template.tpl' ) , 
					'end_item_tag' => 
						$this->CachedMultyFS->get_template( __FILE__ , 'catalogue_end_item_tag_template.tpl' )
				);
				
				if( $Templates !== false )
				{
					extend( $DisplayTemplates , $Templates );
				}
				
				return( $DisplayTemplates );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Функция получения шаблонов.
		*
		*	@param $Options - Настройки работы модуля.
		*
		*	@param $Templates - Шаблоны.
		*
		*	@return Шаблоны.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns templates.
		*
		*	@param $Options - Settings.
		*
		*	@param $Templates - Templates.
		*
		*	@return Templates.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_categories_catalogue_part_templates( $Options , $Templates = false )
		{
			try
			{
				$DisplayTemplates = array();
				
				$Item = $Options->get_setting( 'item_template' , 'item_template.tpl' );
				$DisplayTemplates[ 'item' ] = $this->CachedMultyFS->get_template( __FILE__ , $Item );
				
				$Item = $Options->get_setting( 'leaf_template' , 'leaf_template.tpl' );
				$DisplayTemplates[ 'leaf' ] = $this->CachedMultyFS->get_template( __FILE__ , $Item );
				
				if( $Templates !== false )
				{
					extend( $DisplayTemplates , $Templates );
				}
				
				return( $DisplayTemplates );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>