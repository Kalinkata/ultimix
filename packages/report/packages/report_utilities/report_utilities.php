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
	*	\~russian Работа с отчетами.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Working with reports.
	*
	*	@author Dodonov A.A.
	*/
	class	report_utilities_1_0_0{

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
		var					$Utilities = false;

		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->Utilities = get_package( 'utilities' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Функция получения списка отчётов.
		*
		*	@param $Settings - Параметры компиляции.
		*
		*	@return Список отчётов.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns array of reports.
		*
		*	@param $Settings - Compilation parameters.
		*
		*	@return Array of reports.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_reports_list( &$Settings )
		{
			try
			{
				$PackageName = $tSettings->get_setting( 'package_name' );
				$PackageVersion = $Settings->get_setting( 'package_version' , 'last' );
				$Subfolder = $Settings->get_setting( 'subfolder' , '' );
				$ReportsPath = _get_package_path_ex( $PackageName , $PackageVersion )."/res/reports/";
				if( $Subfolder != '' )
				{
					$ReportsPath .= $Subfolder.'/';
				}
				$Settings->set_setting( 
					'name' , $Settings->get_setting( 'name' , 'report_template' )
				);
				
				return( $this->Utilities->get_files_from_directory( $ReportsPath , '/\.rep/' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>