<?php

	class	SecurityTests{
	
		var			$PackageVersion;
	
		/**
		*	\~russian Конструктор.
		*
		*	@param $thePackageVersion - Версия пакета.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@param $thePackageVersion - Package version.
		*
		*	@author Dodonov A.A.
		*/
		function	__construct( $thePackageVersion )
		{
			$this->PackageVersion = $thePackageVersion;
		}
		
		/**
		*	\~russian Проверка ввода целочисленных данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating integer data conversion.
		*
		*	@author Dodonov A.A.
		*/
		function	testInt()
		{
			$Security = & get_package( 'security' , $this->PackageVersion );
			
			if( $Security->get( 'id123_a4567' , 'integer' ) !== 1234567 )
			{
				$this->setStatus( PUnit_Result_Run::StatusFail );
			}
		}
		
		/**
		*	\~russian Проверка ввода вещественных данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating floating point data conversion.
		*
		*	@author Dodonov A.A.
		*/
		function	testFloat1()
		{
			$Security = & get_package( 'security' , $this->PackageVersion );
			
			if( $Security->get( '1.2f34' , float ) !== 1.234 )
			{
				$this->setStatus( PUnit_Result_Run::StatusFail );
			}
		}
		
		/**
		*	\~russian Проверка ввода вещественных данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating floating point data conversion.
		*
		*	@author Dodonov A.A.
		*/
		function	testFloat2()
		{
			$Security = & get_package( 'security' , $this->PackageVersion );
			
			if( $Security->get( '1.234e+1' , float ) !== 1.234e+1 )
			{
				$this->setStatus( PUnit_Result_Run::StatusFail );
			}
		}
		
		/**
		*	\~russian Проверка ввода вещественных данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating floating point data conversion.
		*
		*	@author Dodonov A.A.
		*/
		function	testFloat3()
		{
			$Security = & get_package( 'security' , $this->PackageVersion );
			
			if( $Security->get( '1.23f4e+1' , float ) !== 1.234e+1 )
			{
				$this->setStatus( PUnit_Result_Run::StatusFail );
			}
		}
		
		/**
		*	\~russian Проверка ввода команд.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating command data conversion.
		*
		*	@author Dodonov A.A.
		*/
		function	testCommand()
		{
			$Security = & get_package( 'security' , $this->PackageVersion );
			
			if( $Security->get( 'asdf_:-фыва<>ASDF' , 'command' ) !== 'asdf_:-ASDF' )
			{
				$this->setStatus( PUnit_Result_Run::StatusFail );
			}
		}
		
		/**
		*	\~russian Проверка ввода строковых данных.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Validating string data conversion.
		*
		*	@author Dodonov A.A.
		*/
		function	testCommand()
		{
			$Security = & get_package( 'security' , $this->PackageVersion );
			
			if( $Security->get( '<hr>something&' , 'command' ) !== '&lt;hr&gt;something&amp;' )
			{
				$this->setStatus( PUnit_Result_Run::StatusFail );
			}
		}
	}

?>