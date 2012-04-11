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
	*	\~russian ����� ��� ���������� �����������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Controller.
	*
	*	@author Dodonov A.A.
	*/
	class	system_structure_controller_1_0_0{
		
		/**
		*	\~russian �������������� �������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached objects.
		*
		*	@author Dodonov A.A.
		*/
		var					$UserAlgorithms = false;
		var					$PageComposer = false;
		var					$Security = false;
		var					$Settings = false;
		var					$CachedFS = false;
		var					$String = false;
		
		/**
		*	\~russian �����������.
		*
		*	@author ������� �.�.
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
				$this->UserAlgorithms = get_package( 'user::user_algorithms' , 'last' , __FILE__ );
				$this->PageComposer = get_package( 'page::page_composer' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->CachedFS = get_package( 'cached_multy_fs' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� �������������� ������.
		*
		*	@param $id - ������������� ������������� ������.
		*
		*	@param $Params - ��������� ������������� ������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ���������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function edits record.
		*
		*	@param $id - id of the editing record.
		*
		*	@param $Params - record creation parameters.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			edit( $id , $Params , $Options )
		{
			try
			{
				$Access = get_package( 'system_structure::system_structure_access' , 'last' , __FILE__ );
				$Access->update( 
					$id , $Params->system_structure_page , $Params->system_structure_root_page , 
					$Params->system_structure_navigation
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� �������� ������.
		*
		*	@param $Params - ��������� �������� ������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ���������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function creates record.
		*
		*	@param $Params - record creation parameters.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			create( $Params , $Options )
		{
			try
			{
				$Access = get_package( 'system_structure::system_structure_access' , 'last' , __FILE__ );
				$Access->create_system_structure( 
					$Params->system_structure_page , $Params->system_structure_root_page , 
					$Params->system_structure_navigation
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian ������� ���������� �����������.
		*
		*	@param $Options - ��������� ������ ������.
		*
		*	@exception Exception - �������� ���������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function controls component.
		*
		*	@param $Options - Settings.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			controller( $Options )
		{
			try
			{
				$ContextSet = get_package_object( 'gui::context_set' , 'last' , __FILE__ );
				
				$ContextSet->execute( $Options , $this , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>