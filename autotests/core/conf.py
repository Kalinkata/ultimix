#!/usr/python
# -*- coding: utf-8 -*-

import			string , config_processor , file , sys , os , os.path

console_encoding = None;

python_path = 'python.exe';

# Подстановки первого порядка. Они используются в других подстановках.
project_path = '../';

# подстановки более высокого порядка
tests_path = './tests/';
bin_modules_path = '#project_path#lib/cygwin/dll/debug/';
workspace_path = './workspace/';
core_path = './core/';

# дефолтовые настройки HTTP/HTTPS запросов
http_server_path = '/';
http_server_host = 'localhost';
http_server_login = 'admin';
http_server_password = 'root';

# email'ы, на которые рассылаются логи тестирования
email_server_host = 'localhost';
email_server_port = 25;
extra_emails = '';

# параметры соединения с ftp сервером, на который будем отправлять логи
ftp_server_host = 'localhost';
ftp_server_port = 21;
ftp_server_dir = '';
ftp_user = 'anonymous';
ftp_password = '';

if( '-project' in sys.argv ):
	if( os.access( sys.argv[ sys.argv.index( '-project' ) + 1 ] , os.F_OK ) ):
		ProjectManifest = config_processor.SAXConfigProcessor();
		ProjectManifest.LoadConfig( sys.argv[ sys.argv.index( '-project' ) + 1 ] );
		
		Tag = ProjectManifest.GetTagByName( 'project_path' );
		if( Tag != None ):
			project_path = Tag.GetAttributeValue( 'value' , '../' );
		
		Tag = ProjectManifest.GetTagByName( 'tests_path' );
		if( Tag != None ):
			tests_path = Tag.GetAttributeValue( 'value' , './tests/' );
			
		Tag = ProjectManifest.GetTagByName( 'bin_modules_path' );
		if( Tag != None ):
			bin_modules_path = Tag.GetAttributeValue( 'value' , '#project_path#lib/' );
			
		Tag = ProjectManifest.GetTagByName( 'workspace_path' );
		if( Tag != None ):
			workspace_path = Tag.GetAttributeValue( 'value' , './workspace/' );
			
		Tag = ProjectManifest.GetTagByName( 'core_path' );
		if( Tag != None ):
			core_path = Tag.GetAttributeValue( 'value' , './core/' );
			
		Tag = ProjectManifest.GetTagByName( 'extra_params' );
		if( Tag != None ):
			extra_params = Tag.GetAttributeValue( 'value' , '' );
			extra_params = extra_params.split( '#' );
			for i in range( len( extra_params ) ):
				sys.argv.append( extra_params[ i ] );
				
		Tag = ProjectManifest.GetTagByName( 'send_logs' );
		if( Tag != None ):
			email_server_host = Tag.GetAttributeValue( 'email_server_host' , 'localhost' );
			email_server_port = int( Tag.GetAttributeValue( 'email_server_port' , '25' ) );
			extra_emails = Tag.GetAttributeValue( 'extra_emails' , '' );
			
		Tag = ProjectManifest.GetTagByName( 'send_logs_ftp' );
		if( Tag != None ):
			ftp_server_host = Tag.GetAttributeValue( 'ftp_server_host' , 'localhost' );
			ftp_server_port = int( Tag.GetAttributeValue( 'ftp_server_post' , 21 ) );
			ftp_server_dir = Tag.GetAttributeValue( 'ftp_server_dir' , '' );
			ftp_user = Tag.GetAttributeValue( 'ftp_user' , 'anonymous' );
			ftp_password = Tag.GetAttributeValue( 'ftp_password' , '' );
			
		Tag = ProjectManifest.GetTagByName( 'http' );
		if( Tag != None ):
			http_server_path = Tag.GetAttributeValue( 'path' , http_server_path );
			http_server_host = Tag.GetAttributeValue( 'host' , http_server_host );
			http_server_login = Tag.GetAttributeValue( 'login' , http_server_login );
			http_server_password = Tag.GetAttributeValue( 'password' , http_server_password );
		
# Выполнение подстановок
tests_path = tests_path.replace( '#project_path#' , project_path );
bin_modules_path = bin_modules_path.replace( '#project_path#' , project_path );
workspace_path = workspace_path.replace( '#project_path#' , project_path );
core_path = core_path.replace( '#project_path#' , project_path );

if( os.access( workspace_path , os.F_OK ) == 0 ):
	os.mkdir( workspace_path );

# полные пути ко всему нашему хозяйству
tests_path = os.path.abspath( tests_path ) + '/';
bin_modules_path = os.path.abspath( bin_modules_path ) + '/';
workspace_path = os.path.abspath( workspace_path ) + '/';
core_path = os.path.abspath( core_path ) + '/';

# различные фокусы и "подпрыгивания"
sys.path.append( bin_modules_path );