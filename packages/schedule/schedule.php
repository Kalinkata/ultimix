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

	/*
	*	type - 2
	*	time_step - Time step in seconds.
	*	archived - 0
	*	processing - 0
	*	count - 1
	*	next_iteration - 0
	*	iteration_step - 1
	*
	*	This parameters means that this task will be run once in time_step seconds
	*/

	/**
	*	\~russian Класс для работы с заданиями.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Class for processing schedule tasks.
	*
	*	@author Dodonov A.A.
	*/
	class	schedule_1_0_0{
		
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
		var					$String = false;
		var					$Settings = false;
		var					$ScheduleAccess = false;
		var					$ScheduleAlgorithms = false;
		
		/**
		*	\~russian Конструктор.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Constructor.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			__construct()
		{
			try
			{
				$this->Database = get_package( 'database' , 'last' , __FILE__ );
				$this->String = get_package( 'string' , 'last' , __FILE__ );
				$this->Settings = get_package_object( 'settings::settings' , 'last' , __FILE__ );
				$this->ScheduleAccess = get_package( 'schedule::schedule_access' , 'last' , __FILE__ );
				$this->ScheduleAlgorithms = get_package( 'schedule::schedule_algorithms' , 'last' , __FILE__ );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка задания.
		*
		*	@param $Parameters - параметры работы задания.
		*
		*	@param $CurrentIteration - следующая итерация задания.
		*
		*	@return Следующая итерация.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes task.
		*
		*	@param $Parameters - parameters of the task processing.
		*
		*	@param $CurrentIteration - current interation.
		*
		*	@return Next iteration.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_task( $Parameters , $CurrentIteration )
		{
			try
			{
				$this->Settings->load_settings( $Parameters );
				if( $this->Settings->get_setting( 'cron_ping' , '0' ) == 1 )
				{
					print( 'Cron ping' );
					
					return( $CurrentIteration + 1 );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка задания.
		*
		*	@param $Task - Задание.
		*
		*	@return Следующая итерация.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes task.
		*
		*	@param $Task - Task.
		*
		*	@return Next iteration.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	call_run_task_function( $Task )
		{
			try
			{
				$Package = get_package( $Task->package_name , $Task->package_version , __FILE__ );

				if( $Package === false )
				{
					throw( new Exception( 'The package "'.$Task->package_name.'" has no script' ) );
				}

				$Delegate = array( $Package , 'schedule_task' );

				return( intval( call_user_func( $Delegate , $Task->parameters , $Task->next_iteration ) ) );
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка задания.
		*
		*	@param $Task - Задание.
		*
		*	@param $NextIteration - Следующая итерация.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes task.
		*
		*	@param $Task - Task.
		*
		*	@param $NextIteration - Next iteration.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		private function	finish_task_processing( $Task , $NextIteration )
		{
			try
			{
				$IntervalField = $NextIteration == 0 ? 'time_step' : 'iteration_step';

				$Fields = array( 'processing' , 'next_processing_time' , '`count`' , 'archived' , 'next_iteration' );
				$Values = array( 
					0 , "DATE_ADD( NOW() , INTERVAL $IntervalField SECOND )" , 'IF( `count` > 1 , `count` - 1 , 1 )' , 
					'IF( type = 1 AND `count` = 1 , 1 , 0 )' , $NextIteration 
				);

				$this->Database->update( 'umx_schedule' , $Fields , $Values , 'id = '.$Task->id );

				$this->Database->commit();
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка задания.
		*
		*	@param $Task - Задание.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes task.
		*
		*	@param $Task - Task.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_single_task( $Task )
		{
			try
			{
				$NextIteration = $this->call_run_task_function( $Task );

				$this->finish_task_processing( $Task , $NextIteration );
			}
			catch( Exception $e )
			{
				$this->Database->unlock();/* clear all locks if the exception was caught */
				$this->ScheduleAccess->update( $Task->id , array( 'processing' => 0 ) );
				$this->Database->commit();
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка заданий в очереди.
		*
		*	@param $Tasks - Все задания.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes tasks in the queue.
		*
		*	@param $Tasks - All tasks.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_all_tasks( $Tasks )
		{
			try
			{
				$Ids = implode_ex( ',' , $Tasks , 'id' );
				$this->ScheduleAccess->update( $Ids , array( 'processing' => 1 ) );
				$this->Database->unlock();

				foreach( $Tasks as $k => $Task )
				{
					$this->run_single_task( $Task );
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
		
		/**
		*	\~russian Обработка заданий в очереди.
		*
		*	@exception Exception - Кидается иключение этого типа с описанием ошибки.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function processes tasks in the queue.
		*
		*	@exception Exception - An exception of this type is thrown.
		*
		*	@author Dodonov A.A.
		*/
		function			run_tasks()
		{
			try
			{
				$this->Database->lock( array( 'umx_schedule' ) , array( 'WRITE' ) );

				$this->Settings->load_file( dirname( __FILE__ ).'/conf/cf_schedule_settings' );
				$Tasks = $this->ScheduleAlgorithms->get_tasks( 
					$this->Settings->get_setting( 'processing_tasks_count' , 10 )
				);

				if( isset( $Tasks[ 0 ] ) )
				{
					$this->run_all_tasks( $Tasks );
				}
				else
				{
					$this->Database->unlock();
				}
			}
			catch( Exception $e )
			{
				$a = func_get_args();_throw_exception_object( __METHOD__ , $a , $e );
			}
		}
	}

?>