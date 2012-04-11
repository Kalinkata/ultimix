#!/usr/python
# -*- coding: utf-8 -*-

#
#	Начальная инициализация
#
import			sys , locale , codecs
locale.setlocale( locale.LC_ALL , '' );
sys.path.append( "./core/" );
sys.path.append( sys.path[ 0 ] + "\\core" );
sys.path.append( sys.path[ 0 ] + "\\core\\lang" );

import			lang , file , conf , string , cmd , os , config_processor , time , log_builder , utilities , string_utilities , http_utilities

def				RunTests():
	# чистим директорию с логами
	file.ClearDirectory( conf.tests_path + "../logs" );

	# Начинаем искать все манифесты	
	Manifests = utilities.GetManifests();
	TestCounter = utilities.GetTestCount( Manifests );

	ReportBuilder = log_builder.LogBuilder();
	ReportBuilder.Set( "table_header" , { "#test_count#" : str( TestCounter ) , "#file#" : string_utilities._unicode( lang.GetString( "file" ) , 'utf-8' ) , "#avg_execution_time#" : string_utilities._unicode( lang.GetString( "avg_execution_time" ) , 'utf-8' ) , "#execution_time#" : string_utilities._unicode( lang.GetString( "execution_time" ) , 'utf-8' ) , "#result#" : string_utilities._unicode( lang.GetString( "result" ) , 'utf-8' ) , "#tester#" : string_utilities._unicode( lang.GetString( "tester" ) , 'utf-8' ) , "#testers_email#" : string_utilities._unicode( lang.GetString( "testers_email" ) , 'utf-8' ) , "#description#" : string_utilities._unicode( lang.GetString( "description" ) , 'utf-8' ) } );
	StartTime = time.time();
	ReportBuilder.Set( "time_stat" , { "#autotesting_start_time_label#" : string_utilities._unicode( lang.GetString( "autotesting_start_time_label" ) ) , "#autotesting_start_time#" : time.strftime( "%Y-%m-%d %H:%M:%S" , time.gmtime( time.time() ) ) } );

	i = 0;Success = 0;Error = 0;
	TesterSuccess = {};TesterError = {};Testers = [];TestersEmails = [];		

	# Пробегаем по всем найденным тестам и запускаем их
	for ManifestPath in Manifests:
		# загружаем манифест
		Manifest = config_processor.SAXConfigProcessor();
		Manifest.LoadConfig( ManifestPath );
		
		if( utilities.NeedToRun( str( Manifest.GetTagByName( "label" ).GetAttributeValue( "value" ) ) , str( Manifest.GetTagByName( "author" ).GetAttributeValue( "email" ) ) ) == 0 ):
			continue;
		
		# чистим рабочую директорию
		file.ClearDirectory( conf.workspace_path );
		
		# тут просто подсвечиваем выполняемый автотест, чтобы не казалось что все зависло
		utilities.PrintStr( ManifestPath );
		
		SubTestsCount = 0;
		SubTestsCount = utilities.GetSubTestCount( Manifest );

		for j in range( SubTestsCount ):
			# запускаем каждый подтест
			if( utilities.TestIdInList( j , Manifest ) == 0 ):
				continue;
			Log = utilities.RunTest( j , Manifest , ManifestPath );
			LogFile = Log[ 0 ];
			TestName = Log[ 1 ];

			if( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == 'unittest' ):
				if( str( LogFile ).lower().find( "failed" ) == -1 ):
					ErrorFlag = 1;
				else:
					ErrorFlag = 0;
			else:
				if( str( LogFile ).lower().find( "test passed" ) == -1 ):
					ErrorFlag = 1;
				else:
					ErrorFlag = 0;
			RowColor = log_builder.GetRowColor( i , ErrorFlag );

			# формируем необходимые данные
			if( not str( Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ) in TesterError.keys() ):
				TesterError[ Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ] = 0;
				TesterSuccess[ Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ] = 0;
				Testers.append( Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) );
				TestersEmails.append( Manifest.GetTagByName( "author" ).GetAttributeValue( "email" ) );
				
			if( ErrorFlag ):
				Error = Error + 1;
				TesterError[ Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ] = TesterError[ Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ] + 1;
			else:
				Success = Success + 1;
				TesterSuccess[ Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ] = TesterSuccess[ Manifest.GetTagByName( "author" ).GetAttributeValue( "name" ) ] + 1;
			
			Data = { "#row_id#" : str( i ) , "#row_color#" : RowColor , "#test_id#" : "%(#)05d" % { "#" : i } , "#script_path#" : os.path.basename( ManifestPath ) + TestName };
			
			LogFileName = file.GetRandomFileName();
			LogFilePath = "./logs/" + LogFileName + ".html";
			
			LogOpenProtocol = '';
			if( LogFilePath.find( ':' ) != -1 ):
				LogOpenProtocol = 'file://';
			
			Data[ "#test_log_file_name#" ] = ReportBuilder.GetLogFileName();
			
			if( "-blank" in sys.argv ):
				LogTarget = 'target="_blank"';
			else:
				LogTarget = '';
			
			LogFile = string_utilities.ProcessLog( LogFile );
			
			if( utilities.ApplyHTMLFormatToLog( Manifest ) ):
				LogFile = LogFile.replace( "\n" , "<br>" ).replace( " " , "&nbsp;" );
			
			if( "-external" in sys.argv ):
				if( ErrorFlag == 1 ):
					Data[ "#log#" ] = 'ERROR&nbsp;[<a href="' + LogOpenProtocol + LogFilePath + '" ' + LogTarget + '>log</a>]';
				else:
					Data[ "#log#" ] = 'TEST&nbsp;PASSED&nbsp;[<a href="' + LogOpenProtocol + LogFilePath + '" ' + LogTarget + '>log</a>]';
			else:
				Data[ "#log#" ] = LogFile;
			
			Data[ "#tester#" ] = Manifest.GetTagByName( "author" ).GetAttributeValue( "name" );
			Data[ "#email#" ] = Manifest.GetTagByName( "author" ).GetAttributeValue( "email" );
			Data[ "#dsc#" ] = Manifest.GetTagByName( "description" ).GetAttributeValue( "value" );
			Data[ "#total_execution_time#" ] = str( Log[ 2 ] );
			Data[ "#avg_execution_time#" ] = str( Log[ 3 ] );
			
			if( "-external" in sys.argv ):
				file.WriteFile( LogFilePath , string_utilities.MassiveReplace( file.LoadFile( conf.core_path + "templates/separate_log_1." + ReportBuilder.GetType() ) , Data ) );
				file.WriteFile( LogFilePath , LogFile );
				file.WriteBinaryFile( LogFilePath , string_utilities.StrToBytes( string_utilities.MassiveReplace( file.LoadFile( conf.core_path + "templates/separate_log_2." + ReportBuilder.GetType() ) , Data ) ) );
			
			ReportBuilder.Set( "report_row" , Data );
			i = i + 1;

	Data = { "#total_statistics#" : string_utilities._unicode( lang.GetString( "total_statistics" ) , 'utf-8' ) , "#total_tests#" : string_utilities._unicode( lang.GetString( "total_tests" ) , 'utf-8' ) , "#total_error_tests#" : string_utilities._unicode( lang.GetString( "total_error_tests" ) , 'utf-8' ) , "#total_success_tests#" : string_utilities._unicode( lang.GetString( "total_success_tests" ) , 'utf-8' ) , "#per_tester_statistics#" : string_utilities._unicode( lang.GetString( "per_tester_statistics" ) , 'utf-8' ) , "#total_tests_count#" : str( i ) , "#total_error_tests_count#" : str( Error ) , "#total_success_tests_count#" : str( Success ) };

	if( i == 0 ):
		# тестов нет
		Data[ "#prs_error#" ] = str( 0.0 / 1.0 );
		Data[ "#prs_success#" ] = str( 100.0 / 1.0 );
	else:
		Data[ "#prs_error#" ] = str( Error / ( i * 1.0 ) * 100.0 );
		Data[ "#prs_success#" ] = str( Success / ( i * 1.0 ) * 100.0 );

	ReportBuilder.Set( "total_errors" , Data );

	for TesterName in Testers:
		ReportBuilder.Set( "individual_errors" , { "#tester_name#" : TesterName , "#tester_error_count#" : str( TesterError[ TesterName ] ) , "#tester_success_count#" : str( TesterSuccess[ TesterName ] ) , "#tester_error#" : string_utilities._unicode( lang.GetString( "tester_error" ) , 'utf-8' ) , "#tester_success#" : string_utilities._unicode( lang.GetString( "tester_success" ) , 'utf-8' ) } );

	ReportBuilder.Set( "time_stat" , { "#autotesting_end_time_label#" : string_utilities._unicode( lang.GetString( "autotesting_end_time_label" ) , 'utf-8' ) , "#autotesting_end_time#" : time.strftime( "%Y-%m-%d %H:%M:%S" , time.gmtime( time.time() ) ) , "#autotesting_time_label#" : string_utilities._unicode( lang.GetString( "autotesting_time_label" ) , 'utf-8' ) , "#autotesting_time#" : time.strftime( "%H:%M:%S" , time.gmtime( time.time() - StartTime ) ) } );

	# осуществляем финальную чистку рабочей директории
	file.ClearDirectory( conf.workspace_path );

	ReportBuilder.Compile();

	utilities.ProcessShowLogCommand( ReportBuilder );
			
	utilities.SendLogsByEmail( ReportBuilder , TestersEmails );

	utilities.SendLogsByFtp( ReportBuilder );

	print( "done" );
	
utilities.ProcessClsCommand();

utilities.ProcessHelpCommand();

RunTests();