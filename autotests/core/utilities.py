#!/usr/python
# -*- coding: utf-8 -*-

import			sys , os , string_utilities , conf , config_processor , http_utilities , zipfile , log_builder , file , base64 , math , threading , time

import 			smtplib , ftplib

if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] >= 5 ) ):
	from 			email import encoders
	from 			email.mime.multipart import MIMEMultipart
	from 			email.mime.base import MIMEBase
	from 			email.mime.image import MIMEImage
	from 			email.mime.text import MIMEText
else:
	if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] >= 2 ) ):
		import			email
		from 			email import Encoders
		from 			email.MIMEMultipart import MIMEMultipart
		from 			email.MIMEBase import MIMEBase
		from 			email.MIMEImage import MIMEImage
		from 			email.MIMEText import MIMEText
	
#
#	Вывод строки в stdout
#
def			PrintLnStr( Str ):
	print( Str );

#
#	Вывод строки в stdout
#
def			PrintStr( Str ):
	if( sys.version_info[ 0 ] > 2 ):
		print( Str , '' , '' );
	else:
		print( Str );

#
#	Фунцкия форматирования лога.
#
#	@param Manifests - список манифестов
#
#	@return Отформатированный или нет (в зависимости от настроек) лог.
#
#	@author Додонов А.А. 
#
def			ApplyHTMLFormatToLog( Manifest ):
	Format = Manifest.GetTagByName( "format" );
	
	if( Format != None ):
		if( Format.GetAttributeValue( "value" , "no" ) == 'html_format' ):
			return( 1 );
		else:
			return( 0 );
	
	if( '-html_format' in sys.argv ):
		return( 1 );
		
	return( 0 );

#
#	Фунцкия выборки количества тестов в каждом манифесте.
#
#	@param Manifests - список манифестов
#
#	@return Количество тестов.
#
#	@author Додонов А.А. 
#
def			GetSubTestCount( Manifest ):
	SubTestsCount = 0;
	if( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "py" or Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "unittest" ):
		SubTestsCount = 1;
	elif( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "simple" ):
		Module = file.LoadModule( Manifest.GetTagByName( "module" ).GetAttributeValue( "value" ) );
		SubTestsCount = ctypes.c_int( Module.GetTestCount() ).value;
	elif( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "http" ):
		SubTestsCount = http_utilities.HTTPGetTestCountEx( Manifest );
	elif( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "https" ):
		SubTestsCount = http_utilities.HTTPSGetTestCountEx( Manifest );
	elif( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "cmd" ):
		SubTestsCount = 1;
	
	return( SubTestsCount );

#
#	Фунцкия выборки количества тестов.
#
#	@param Manifests - список манифестов.
#
#	@return Количество тестов.
#
#	@author Додонов А.А. 
#
def			GetTestCount( Manifests ):
	TestCounter = 0;
	
	for ManifestPath in Manifests:
		Manifest = config_processor.SAXConfigProcessor();
		Manifest.LoadConfig( ManifestPath );
		
		if( NeedToRun( str( Manifest.GetTagByName( "label" ).GetAttributeValue( "value" ) ) , str( Manifest.GetTagByName( "author" ).GetAttributeValue( "email" ) ) ) != 0 ):
			print( ManifestPath );
			print( 'GetTestCount>GetSubTestCount' );
			SubTestCount = GetSubTestCount( Manifest );
			for j in range( SubTestCount ):
				if( TestIdInList( j , Manifest ) ):
					TestCounter = TestCounter + 1;
				
	return( TestCounter );

#
#	Фунцкия выборки манифестов.
#
#	@return Список манифестов.
#
#	@author Додонов А.А. 
#
def			GetManifests():
	Scripts = GetFiles( conf.tests_path )
			
	Scripts = list( filter( lambda x : x.endswith( ".xml" ) , Scripts ) );
	
	return( Scripts );

#
#	Фунцкия выборки всех файлов из директории.
#
#	@param DirPath - путь к сканируемой директории.
#
#	@return Список файлов.
#
#	@author Додонов А.А. 
#
def			GetFiles( DirPath ):
	RetFiles = [];
	
	for Root , Dirs , Files in DirectoryWalker( DirPath ):
		for f in Files:
			RetFiles.append( string_utilities.StripSlashes( Root ) + "/" + f );
			
	return( RetFiles );

#
#	Фунцкия отправки логов на FTP сервер.
#
#	@author Додонов А.А. 
#
def			SendLogsByFtp( LogObject ):
	if( '-send_logs_ftp' in sys.argv ):
		# создаем архив с логами
		Logs = GetFiles( conf.workspace_path + '../logs/' );
		
		Archive = zipfile.ZipFile( conf.workspace_path + LogObject.GetLogFileName( 1 ) + '.zip' , 'w' );

		for Log in Logs:
			LogsFileName = os.path.split( Log )[ 1 ];
			
			Archive.write( Log , 'logs/' + LogsFileName );
			
		Archive.write( conf.workspace_path + '../' + LogObject.GetLogFileName() , LogObject.GetLogFileName() );
		
		Archive.close();
		
		# отправляем логи
		ftp = ftplib.FTP();
		
		ftp.connect( conf.ftp_server_host , conf.ftp_server_port );
		ftp.login( conf.ftp_user , conf.ftp_password );
		
		# удаляем файл если он есть
		try:
			ftp.delete( conf.ftp_server_dir + LogObject.GetLogFileName( 1 ) + '.zip' );
		except:
			pass;
		
		fd = open( conf.workspace_path + LogObject.GetLogFileName( 1 ) + '.zip' , 'rb' );
		try:
			ftp.storbinary( "STOR " + conf.ftp_server_dir + LogObject.GetLogFileName( 1 ) + '.zip' , fd );
		except:
			pass;
		
		fd.close();
		ftp.quit();

#
#	Фунцкия рассылки логов.
#
#	@author Додонов А.А. 
#	
def			SendLogsByEmail( LogObject , TestersEmails ):
	import	lang
	try:
		if( '-send_logs' in sys.argv ):
			if( sys.version_info[ 0 ] < 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] <= 1 ) ):
				print( 'Sending logs via email is not provided for Python v 2.1 and lower' );
				return;
			
			# создаем архив с логами
			Logs = GetFiles( conf.workspace_path + '../logs/' );
			
			Archive = zipfile.ZipFile( conf.workspace_path + LogObject.GetLogFileName( 1 ) + '.zip' , 'w' );

			for Log in Logs:
				LogsFileName = os.path.split( Log )[ 1 ];
				
				Archive.write( Log , 'logs/' + LogsFileName );
			
			Archive.write( conf.workspace_path + '../' + LogObject.GetLogFileName() , LogObject.GetLogFileName() );
				
			Archive.close();
			
			# отправляем логи
			From = 'run.py@localhost';
			
			# архив с логами готов, теперь можно запускать письмо
			RawMessage = file.LoadFile( conf.core_path + 'templates/autotest_log.eml' );
			RawMessage = RawMessage.replace( '#from#' , From );
			RawMessage = RawMessage.replace( '#subject#' , lang.GetString( 'testing_mail_subject' ) );
			RawMessage = RawMessage.replace( '#autotest_log_file_name#' , LogObject.GetLogFileName( 1 ) + '.zip' );
			
			LogArchiveContent = base64.b64encode( file.LoadBinaryFile( conf.workspace_path + LogObject.GetLogFileName( 1 ) + '.zip' ) );
			LogArchiveContent = string_utilities.BytesToStr( LogArchiveContent , 'utf-8' );
			
			for i in range( 0 , math.ceil( len( LogArchiveContent ) / 80 ) - 1 ):
				SubString = LogArchiveContent[ i * 80 : ( i + 1 ) * 80 ];
				RawMessage = RawMessage.replace( '#autotest_log_content#' , SubString + "\r\n#autotest_log_content#" );
				
			RawMessage = RawMessage.replace( '#autotest_log_content#' , '' );
			
			MailServer = smtplib.SMTP();
			MailServer.connect( conf.email_server_host , conf.email_server_port );
			
			for To in TestersEmails:
				Message = RawMessage.replace( '#to#' , To );
				MailServer.sendmail( From , To , Message );
				
			if( conf.extra_emails != '' ):
				for To in conf.extra_emails.split( ',' ):
					Message = RawMessage.replace( '#to#' , To );
					MailServer.sendmail( From , To , Message );
				
			MailServer.quit();
			
			os.unlink( conf.workspace_path + LogObject.GetLogFileName( 1 ) + '.zip' );
	except:
		print( 'An error occured while sending logs via email' );

#
#	Функция ограницивает запуск составных тестов (тех тестов, которые содержат подтесты)
#
#	@param TestId - идентификатор подтеста
#
#	@param Manifest - манифест теста, в котором может быть список подтестов для запуска
#
#	@return 1 если подтест с идентифкатором 1 надо запускать, иначе не надо
#
#	@author Додонов А.А. 
#
def			TestIdInList( TestId , Manifest ):
	if( '-test_id' in sys.argv ):
		TestLabelList = GetTokenList( sys.argv , '-test_id' );
		if( str( TestId ) in TestLabelList ):
			return( 1 );
		else:
			return( 0 );
	
	TestIdTag = Manifest.GetTagByName( 'test_id' );
	if( TestIdTag != None ):
		TestLabelList = TestIdTag.GetAttributeValue( 'value' ).split( "," );
		if( str( TestId ) in TestLabelList ):
			return( 1 );
		else:
			return( 0 );
			
	return( 1 );

#
#	Функция получения списка меток.
#
#	@param Argv - список параметров командной строки
#
#	@return Список меток командной строки, если в командной строке ни одной метки не указано, то возвращается [ 'all' ]
#
#	@author Додонов А.А.
#
def			GetTokenList( Argv , Mark = '-l' ):
	LabelList = [];

	if( Mark not in Argv ):
		LabelList.append( 'all' );
	else:
		for i in range( len( Argv ) - 1 ):
			if( Argv[ i ] == Mark ):
				LabelList.extend( Argv[ i + 1 ].split( ',' ) );

	if( LabelList == [] ):
		return( [ 'all' ] );
	else:
		return( LabelList );
		
#
#	Проверяем нужно ли запускать тест в соотв. с установленными метками.
#
#	@param LabelString - Строка с метками (метки разделены запятыми).
#
#	@return 1 если тест надо запускать, 0 если не надо.
#
#	@author Додонов А.А.
#
def			NeedToRun( LabelString , Email ):
	LabelList = GetTokenList( sys.argv , '-l' );
	EmailList = GetTokenList( sys.argv , '-email' );

	TestLabelList = LabelString.split( "," );
	
	for a in LabelList:
		for b in TestLabelList:
			if( a == b.strip() or a == "all" ):
				if( Email in EmailList or 'all' in EmailList ):
					return( 1 );

	return( 0 );

#
#	Создаем функцию рекурсивного обхода директорий.
#
#	@param x - путь к директории, которую будем обходить.
#
#	@return См os.walk.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] > 2 ) ):
	DirectoryWalker = lambda x : os.walk( x , topdown = False );
else:
	WalkerResult = [];
	
	def			_FileCollector( arg , Dirname , Names ):
		global WalkerResult;
		WalkerResult.append( 
			[ 
				Dirname , 
				list( 
					filter( 
						lambda x , y = Dirname : os.path.isdir( 
							string_utilities.StripSlashes( y ) + "/" + x 
						) , 
						Names 
					) 
				) , 
				list( 
					filter( 
						lambda x , y = Dirname : os.path.isfile( 
							string_utilities.StripSlashes( y ) + "/" + x 
						) , 
						Names 
					) 
				) 
			] 
		);
		
	def DirectoryWalker( x ):
		global WalkerResult;
		WalkerResult = [];
		os.path.walk( x , _FileCollector , None );
		return( WalkerResult );

#
#	Импорт необходимых модулей.
#
if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] > 2 ) ):
	import		platform

#
#	Функция возвращает название платформы, на которой запущен скрипт.
#
#	@return Строковое название платформы.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			GetPlatform():
	if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] > 2 ) ):
		return( platform.uname()[ 0 ] );
	else:
		if( sys.platform == "win32" ):
			return( "Windows" );
		else:
			return( sys.platform );

#
#	Класс для запуска тестов в потоке.
#
class		ThreadedScriptExecution( threading.Thread ):
	def	__init__( self , theScriptPath , theParams = '' , theLogFileName = "tmp.txt" , theExecutionCount = 1 ):
		threading.Thread.__init__( self );
		self.ScriptPath = theScriptPath;
		self.Params = theParams;
		self.LogFileName = theLogFileName;
		self.ExecutionCount = int( theExecutionCount );
		self.TotalTime = 0;
		
	def run( self ):
		if( self.ExecutionCount > 1 ):
			print( '' );
			
		# компилируем параметры командной строки
		CommandLine = '';
		Counter = 0;
		for i in sys.argv:
			if( Counter > 0 ):
				CommandLine = CommandLine + "\"" + i + "\" ";
			Counter = Counter + 1;
		
		TestStartTime = time.time();
		for i in range( 0 , self.ExecutionCount ):
			if( self.ExecutionCount > 1 ):
				PrintStr( self.ScriptPath + "[" + str( i ) + "]" );
				if( i < self.ExecutionCount - 1 ):
					print( '' );
			os.system( conf.python_path + " \"" + self.ScriptPath + "\" " + CommandLine + " >> " + conf.workspace_path  + self.LogFileName + " 2>&1" );
		self.TotalTime = time.time() - TestStartTime;
		
#
#	Класс для запуска тестов в потоке.
#
class		ThreadedCmdExecution( threading.Thread ):
	def	__init__( self , theCmd , theLogFileName = "tmp.txt" , theExecutionCount = 1 ):
		threading.Thread.__init__( self );
		self.Cmd = theCmd;
		self.LogFileName = theLogFileName;
		self.ExecutionCount = int( theExecutionCount );
		self.TotalTime = 0;
		
	def run( self ):
		file.CreateFile( conf.workspace_path + self.LogFileName );
		if( self.ExecutionCount > 1 ):
			print( '' );
			
		# компилируем параметры командной строки
		CommandLine = '';
		Counter = 0;
		for i in sys.argv:
			if( Counter > 0 ):
				CommandLine = CommandLine + "\"" + i + "\" ";
			Counter = Counter + 1;
		
		TestStartTime = time.time();
		for i in range( 0 , self.ExecutionCount ):
			if( self.ExecutionCount > 1 ):
				print( self.Cmd + "[" + str( i ) + "]" );
			os.system( "\"" + self.Cmd + "\" " + CommandLine + " >> " + conf.workspace_path + self.LogFileName + " 2>&1" );
		self.TotalTime = time.time() - TestStartTime;

#
#	Необходимые функции
#

#
#	Фунцкия запуска конкретного подтеста.
#
#	@param TestID - идентификатор теста.
#
#	@param Manifest - манифест теста.
#
#	@param ManifestPath - путь к манифесту.
#
#	@return Количество тестов.
#
#	@author Додонов А.А. 
#
def			RunTest( TestID , Manifest , ManifestPath ):
	CountManifest = Manifest.GetTagByName( "execution_count" );
	
	if( CountManifest == None ):
		ExecutionCount = 1;
	else:
		ExecutionCount = CountManifest.GetAttributeValue( "value" , 1 );
	
	if( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "http" ):
		LogFile = string_utilities.StrToBytes( '' , 'utf-8' );
		TestName = ":" + http_utilities.HTTPGetTestNameEx( TestID , Manifest );
		TestStartTime = time.time();
		for i in range( 0 , ExecutionCount ):				
			LogFile = LogFile + http_utilities.HTTPRunTestEx( TestID , Manifest );
			
			if( str( LogFile ).lower().find( "test passed" ) == -1 ):
				Suffix = ' ERROR';
			else:
				Suffix = ' OK';
				
			if( ExecutionCount > 1 ):
				PrintStr( ManifestPath + TestName + "[" + str( i ) + "]" + Suffix );
			else:
				PrintStr( ManifestPath + TestName + Suffix );
				
		TotalTime = time.time() - TestStartTime;
	elif( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "https" ):
		LogFile = string_utilities.StrToBytes( '' , 'utf-8' );
		TestName = ":" + http_utilities.HTTPSGetTestNameEx( TestID , Manifest );
		TestStartTime = time.time();
		for i in range( 0 , ExecutionCount ):				
			LogFile = LogFile + http_utilities.HTTPSRunTestEx( TestID , Manifest );
			
			if( str( LogFile ).lower().find( "test passed" ) == -1 ):
				Suffix = ' ERROR';
			else:
				Suffix = ' OK';
				
			if( ExecutionCount > 1 ):
				PrintStr( ManifestPath + TestName + "[" + str( i ) + "]" + Suffix );
			else:
				PrintStr( ManifestPath + TestName + Suffix );
				
		TotalTime = time.time() - TestStartTime;
	else:
		TestName = '';
		LogFileName = file.GetRandomFileName();
		
		if( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == "cmd" ):					
			# запускаем в отдельном потоке автотест
			ThreadedAutotest = ThreadedCmdExecution( Manifest.GetTagByName( "cmd" ).GetAttributeValue( "value" ) , LogFileName );
		else:			
			# запускаем в отдельном потоке автотест
			ThreadedAutotest = ThreadedScriptExecution( ManifestPath.replace( ".xml" , ".py" ) , theLogFileName = LogFileName , theExecutionCount = ExecutionCount );
			
		# стартуем поток
		ThreadedAutotest.start();
		
		# засыпаем на величину таумаута
		ThreadedAutotest.join( int( Manifest.GetTagByName( "timeout" ).GetAttributeValue( "value" ) ) );
		
		if( ThreadedAutotest.isAlive() ):
			LogFile = string_utilities._unicode( "Timeout expires.&nbsp;ERROR" , 'utf-8' );
		else:
			# продолжаем формировать файл отчета
			LogFile = file.LoadBinaryFile( conf.workspace_path + LogFileName );
		
		if( Manifest.GetTagByName( "type" ).GetAttributeValue( "value" , "py" ) == 'unittest' ):
			if( str( LogFile ).lower().find( "failed" ) == -1 ):
				print( 'ERROR' );
			else:
				print( 'OK' );
		else:
			if( str( LogFile ).lower().find( "test passed" ) == -1 ):
				print( 'ERROR' );
			else:
				print( 'OK' );
			
		TotalTime = ThreadedAutotest.TotalTime;
			
	return( [ LogFile , TestName , TotalTime , TotalTime / float( ExecutionCount ) ] );

#
#	Фунцкия обработки команды очистки экрана.
#
#	@author Додонов А.А. 
#
def			ProcessClsCommand():
	if( "-cls" in sys.argv ):
		if( GetPlatform() == "Windows" ):
			os.system( 'cls' );
		elif( GetPlatform().find( 'CYGWIN' ) != -1 ):
			pass;
		else:
			os.system( 'clear' );

#
#	Фунцкия открытия лога.
#
#	@param ReportBuilder - объект работы с логом
#
#	@author Додонов А.А. 
#
def			ProcessShowLogCommand( ReportBuilder ):
	if( "-show_log" in sys.argv ):
		if( GetPlatform().find( 'CYGWIN' ) != -1 ):
			pass;
		else:
			os.system( os.path.abspath( conf.workspace_path + "../" + ReportBuilder.GetLogFileName() ) );

#
#	Фунцкия обработки команды вывода краткого хелпа.
#
#	@author Додонов А.А. 
#
def			ProcessHelpCommand():
	# Понеслась отработка скрипта
	if( "-help" in sys.argv ):
		# Выводим мануал
		print( file.LoadFile( conf.core_path + "templates/man" ) );
		sys.exit( 0 );