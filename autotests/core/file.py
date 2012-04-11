#!/usr/python
# -*- coding: utf-8 -*-

import		os , conf , random , sys , utilities , codecs

if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] > 4 ) ):
	import		ctypes
	
#
#	Функция генерации случайного имени файла.
#
#	@param Length - длина имени файла.
#
#	@return Буффер с прочитанным файлом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			GetRandomFileName( Length = 32 ):
	Alphabet = "0123456789abcdefghijklmnopqrstuvwxyz";
	Name = "";
	
	random.seed();
	
	for i in range( Length ):
		Name = Name + Alphabet[ random.randint( 0 , len( Alphabet ) - 1 ) ];

	return( Name );
	
#
#	Функция записи в файл
#
#	@param FilePath - путь к записываемому файлу.
#
#	@param FileContent - создержимое файле.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			WriteFile( FilePath , FileContent ):		
	FStream = open( FilePath , "at+" );
	Data = FStream.write( FileContent );
	FStream.close();
	
#
#	Функция записи в файл
#
#	@param FilePath - путь к записываемому файлу.
#
#	@param FileContent - создержимое файле.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			WriteBinaryFile( FilePath , FileContent ):		
	FStream = open( FilePath , "ab+" );
	Data = FStream.write( FileContent );
	FStream.close();
	
#
#	Функция создания файла
#
#	@param FilePath - путь к создаваемому файлу.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			CreateFile( FilePath ):
	FStream = open( FilePath , "ab+" );
	FStream.close();

#
#	Проверка существует ли папка или файл.
#
#	@param FilePath - Путь к проверяемому файлу.
#
#	@return true если файл существует, иначе false
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			FileExists( FilePath ):
	return( os.access( FilePath , os.F_OK ) );

#
#	Функция чтения всего файла в строку.
#
#	@param FilePath - путь к читаемому файлу.
#
#	@return Буффер с прочитанным файлом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			LoadFile( FilePath ):
	if( FileExists( FilePath ) ):
		FStream = open( FilePath , "rt" );
			
		Data = FStream.read();
		FStream.close();
		return( Data );
	else:
		return( "File does not exists" );
		
#
#	Функция чтения всего файла в буффер
#
#	@param FilePath - путь к читаемому файлу.
#
#	@return Буффер с прочитанным файлом.
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#
def			LoadBinaryFile( FilePath ):
	if( FileExists( FilePath ) ):
		FStream = open( FilePath , "rb" );
			
		Data = FStream.read();
		FStream.close();
		return( Data );
	else:
		return( "File does not exists" );

#
#	Функция для загрузки бинарного модуля.
#
#	@param ModuleName - имя бинарного модуля, 
#	для винды это имя dllшки без расширения dll, 
#	для никсов soшка без расширения so
#
#	@return Загруженный CDLL объект
#
#	@exception Может и кидануть.
#
#	@author Додонов А.А.
#	
def			LoadModule( ModuleName ):
	if( sys.version_info[ 0 ] > 2 or ( sys.version_info[ 0 ] == 2 and sys.version_info[ 1 ] > 4 ) ):	
		"""if( FileExists( conf.bin_modules_path + ModuleName + ".dll" ) ):
			return( ctypes.CDLL( conf.bin_modules_path + ModuleName + ".dll" ) );
		else:"""
		
		if( FileExists( conf.bin_modules_path + ModuleName + ".dll" ) ):
			return( ctypes.CDLL( ModuleName ) );
		
		if( FileExists( conf.bin_modules_path + ModuleName + ".so" ) ):
			return( ctypes.CDLL( conf.bin_modules_path + ModuleName + ".so" ) );
		else:
			return( ctypes.CDLL( ModuleName ) );
	else:
		return( None );
	
#
#	Функция очистки директории.
#
#	@param ClearDirectory - директория, которую будем очищать
#
#	@exception Может кидануть.
#
#	@author Додонов А.А.
#
def			ClearDirectory( DirectoryPath ):
	for Root , Dirs , Files in utilities.DirectoryWalker( DirectoryPath ):
		try:
			for name in Files:
				os.remove( os.path.join( Root , name ) )
			for name in Dirs:
				os.rmdir( os.path.join( Root , name ) )
		except:
			pass;
			
#
#	Выборка путей.
#
#	@param DirectoryPath - путь к сканируемой директориию
#
#	@param CollectFunc - функция коллекционирования путей.
#
#	@author Додонов А.А.	
#
def			SelectAllFiles( DirectoryPath , CollectFunc ):
	for Root , Dirs , Files in utilities.DirectoryWalker( DirectoryPath ):
		for name in Files:
			CollectFunc( os.path.join( Root , name ) );
		for name in Dirs:
			SelectAllFiles( os.path.join( Root , name ) , CollectFunc );