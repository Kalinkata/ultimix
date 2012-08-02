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
	*	\~russian ����� ��� ��������� ��������.
	*
	*	@author ������� �.�.
	*/
	/**
	*	\~english Class processes macro.
	*
	*	@author Dodonov A.A.
	*/
	class	rating_markup_1_0_0{
	
		/**
		*	\~russian �������������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Cached packages.
		*
		*	@author Dodonov A.A.
		*/
		var					$RatingAlgorithms = false;

		/**
		*	\~russian �����������.
		*
		*	@exception Exception �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author  ������� �.�.
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
				$this->RatingAlgorithms = get_package( 'rating::rating_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian ������� ���������� ������� 'rating'.
		*
		*	@param $Settings - ���������.
		*
		*	@return ��� �������.
		*
		*	@exception Exception - �������� ��������� ����� ���� � ��������� ������.
		*
		*	@author ������� �.�.
		*/
		/**
		*	\~english Function compiles macro 'rating'.
		*
		*	@param $Settings - Parameters.
		*
		*	@return HTML code.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function	compile_rating( &Settings )
		{
			try
			{
				$MasterId = $Settings->get_setting( 'master_id' );
				$MasterType = $Settings->get_setting( 'master_type' , 'user' );

				$Rating = $this->RatingAlgorithms->get_rating( $MasterId , $MasterType );

				$ShowPrefix = intval( $Settings->get_setting( 'show_prefix' , 0 ) );

				return( $ShowPrefix == 1 ? "{lang:rating}: $Rating" : $Rating );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}
?>