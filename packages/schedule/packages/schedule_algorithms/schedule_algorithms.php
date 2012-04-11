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
	*	\~russian Класс для работы с рекламными сообщениями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class provides routine for ad banners.
	*
	*	@author Dodonov A.A.
	*/
	class	schedule_algorithms_1_0_0{
		
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
		var					$ScheduleAccess = false;
		var					$Security = false;
		
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
				$this->ScheduleAccess = get_package( 'schedule::schedule_access' , 'last' , __FILE__ );
				$this->Security = get_package( 'security' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Получение списка заданий для обработки.
		*
		*	@param $Count - максимальное количество заявок.
		*
		*	@return Список заданий для обработки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function returns a list of tasks to process.
		*
		*	@param $Count - maximum count of tasks to process.
		*
		*	@return A list of tasks to process.
		*
		*	@author Dodonov A.A.
		*/
		function			get_tasks( $Count )
		{
			try
			{
				$Count = $this->Security->get( $Count , 'integer' );
				
				return( 
					$this->ScheduleAccess->unsafe_select( 
						"processing = 0 AND archived = 0 AND next_processing_time < NOW() ".
						"ORDER BY next_processing_time ASC LIMIT 0 , $Count"
					)
				);
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>