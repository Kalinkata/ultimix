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
	*	\~russian Класс для работы с основными сущностями компонента.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides data access routine.
	*
	*	@author Dodonov A.A.
	*/
	class	rating_algorithms_1_0_0{

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
		var					$Database = false;
		var					$DatabaseAlgorithms = false;
		var					$LinkUtilities = false;
		var					$RatingAccess = false;
		
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
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->DatabaseAlgorithms = get_package( 'database::database_algorithms' , 'last' , __FILE__ );
				$this->LinkUtilities = get_package( 'link::link_utilities' , 'last' , __FILE__ );
				$this->RatingAccess = get_package( 'rating::rating_access' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}

		/**
		*	\~russian Увеличение рейтинга.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплен рейтинг.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплен рейтинг.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function increases rating for the specified object.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			increase_rating( $MasterId , $MasterType , $Value )
		{
			try
			{
				$Rating = $this->LinkUtilities->get_dependent_objects( 
					$MasterId , $MasterType , $this->RatingAccess
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение рейтинга объекта.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@return Объект рейтинга.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches object's rating.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@return Rating object.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_rating_object( $MasterId = false , $MasterType = 'user' )
		{
			try
			{
				list( $MasterId , $MasterType ) = $this->LinkUtilities->trasform_master_parameters( 
					$MasterId , $MasterType
				);
				
				if( $this->LinkUtilities->dependent_objects_exist( $MasterId , $MasterType , 'rating' ) )
				{
					$Records = $this->LinkUtilities->get_dependent_objects( 
						$MasterId , $MasterType , 'rating' , $this->RatingAccess
					);
				}
				else
				{
					$id = $this->RatingAccess->create( 
						array( 'master_id' => $MasterId , 'master_type' => $MasterType )
					);
					$Records = $this->RatingAccess->select_list( $id );
				}
				
				return( $Records[ 0 ] );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение рейтинга объекта.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@return Рейтинг.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function fetches object's rating.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@return Rating.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			get_rating( $MasterId = false , $MasterType = 'user' )
		{
			try
			{
				$Record = $this->get_rating_object( $MasterId , $MasterType );
				
				return( get_field( $Record , 'value' ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Установка рейтинга.
		*
		*	@param $Value - Новое значение рейтинга.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function sets rating.
		*
		*	@param $Value - New value of the rating.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			set_rating( $Value , $MasterId = false , $MasterType = 'user' )
		{
			try
			{
				$Value = $this->Security->get( $Value , 'float' );
				
				/* just create rating record in the DB in case is does not exist */
				$Record = $this->get_rating_object( $MasterId , $MasterType );
				
				$this->RatingAcces->update( get_field( $Rating , 'id' ) , array( 'value' => $Value ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Изменение рейтинга.
		*
		*	@param $Delta - Изменнеия значения рейтинга.
		*
		*	@param $MasterId - Идентификатор объекта, к которому прикреплена запись.
		*
		*	@param $MasterType - Тип объекта, к которому прикреплена запись.
		*
		*	@exception Exception Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function changes rating.
		*
		*	@param $Delta - Rating value delta.
		*
		*	@param $MasterId - Master object's id.
		*
		*	@param $MasterType - Master object's type.
		*
		*	@exception Exception An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			change_rating( $Delta , $MasterId = false , $MasterType = 'user' )
		{
			try
			{
				$this->Database->lock( array( 'umx_rating' ) , array( 'WRITE' ) );
				
				$Delta = $this->Security->get( $Delta , 'float' );
				
				/* just create rating record in the DB in case is does not exist */
				$Record = $this->get_rating_object( $MasterId , $MasterType );
				
				$Value = get_field( $Record , 'value' );
				
				$this->RatingAcces->update( get_field( $Rating , 'id' ) , array( 'value' => $Value + $Delta ) );
				
				$this->Database->unlock();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>