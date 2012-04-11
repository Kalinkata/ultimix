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
	*	\~russian Кэш ядра.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Core cache.
	*
	*	@author Dodonov A.A.
	*/
	class	core_cache{
	
		function			_load_root_dir_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/root_dir_cache' );
			if( $Data !== false )
			{
				global	$RootDirCache;
				$RootDirCache = unserialize( $Data );
			}
		}
		
		function			_load_package_real_version_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/package_real_version_cache' );
			if( $Data !== false )
			{
				global	$PackageRealVersionCache;
				$PackageRealVersionCache = unserialize( $Data );
			}
		}
		
		function			_load_rewrited_package_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/rewrited_package_cache' );
			if( $Data !== false )
			{
				global	$RewritedPackageCache;
				$RewritedPackageCache = unserialize( $Data );
			}
		}
		
		function			_load_rewrites_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/rewrites_cache' );
			if( $Data !== false )
			{
				global	$RewritesCache;
				$RewritesCache = unserialize( $Data );
			}
		}
		
		function			_load_package_path_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/package_path_cache' );
			if( $Data !== false )
			{
				global	$PackagePathCache;
				$PackagePathCache = unserialize( $Data );
			}
		}
	
		function			_load_package_relative_path_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/package_relative_path_cache' );
			if( $Data !== false )
			{
				global	$PackageRelativePathCache;
				$PackageRelativePathCache = unserialize( $Data );
			}
		}
		
		function			_load_top_package_name_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/top_package_name_cache' );
			if( $Data !== false )
			{
				global	$TopPackageNameCache;
				$TopPackageNameCache = unserialize( $Data );
			}
		}
		
		function			_load_make_full_version_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/make_full_version_cache' );
			if( $Data !== false )
			{
				global	$MakeFullVersionCache;
				$MakeFullVersionCache = unserialize( $Data );
			}
		}
		
		function			_load_full_class_name_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/full_class_name_cache' );
			if( $Data !== false )
			{
				global	$FullClassNameCache;
				$FullClassNameCache = unserialize( $Data );
			}
		}
	
		function			_load_get_package_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/get_package_cache' );
			if( $Data !== false )
			{
				global	$GetPackageCache;
				$GetPackageCache = unserialize( $Data );
			}
		}
		
		function			_load_package_script_paths_cache( $Dirname )
		{
			$Data = @file_get_contents( $Dirname.'/../../data/package_script_paths_cache' );
			if( $Data !== false )
			{
				global	$PackagePathsCache;
				$PackagePathsCache = unserialize( $Data );
			}
		}
	
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
			$Dirname = dirname( __FILE__ );
			
			$this->_load_root_dir_cache( $Dirname );
			$this->_load_package_real_version_cache( $Dirname );
			$this->_load_rewrited_package_cache( $Dirname );
			$this->_load_rewrites_cache( $Dirname );
			$this->_load_package_path_cache( $Dirname );
			$this->_load_package_relative_path_cache( $Dirname );
			$this->_load_top_package_name_cache( $Dirname );
			$this->_load_make_full_version_cache( $Dirname );
			$this->_load_full_class_name_cache( $Dirname );
			$this->_load_get_package_cache( $Dirname );
			$this->_load_package_script_paths_cache( $Dirname );
		}
		
		/**
		*	\~russian Функция удаления кэша ядра.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Function drops core's cache.
		*
		*	@author Dodonov A.A.
		*/
		function			drop_core_cache()
		{
			$Dirname = dirname( __FILE__ );
			@unlink( $Dirname.'/../../data/root_dir_cache' );
			@unlink( $Dirname.'/../../data/package_real_version_cache' );
			@unlink( $Dirname.'/../../data/rewrited_package_cache' );
			@unlink( $Dirname.'/../../data/rewrites_cache' );
			@unlink( $Dirname.'/../../data/package_path_cache' );
			@unlink( $Dirname.'/../../data/package_relative_path_cache' );
			@unlink( $Dirname.'/../../data/top_package_name_cache' );
			@unlink( $Dirname.'/../../data/make_full_version_cache' );
			@unlink( $Dirname.'/../../data/full_class_name_cache' );
			@unlink( $Dirname.'/../../data/get_package_cache' );
			@unlink( $Dirname.'/../../data/package_script_paths_cache' );
		}
		
		function			_save_root_dir_cache( $Dirname )
		{
			global $RootDirCacheChanged;
			if( $RootDirCacheChanged )
			{
				global	$RootDirCache;
				file_put_contents( $Dirname.'/../../data/root_dir_cache' , serialize( $RootDirCache ) );
			}
		}
		
		function			_save_package_real_version_cache( $Dirname )
		{
			global	$PackageRealVersionCacheChanged;
			if( $PackageRealVersionCacheChanged )
			{
				global	$PackageRealVersionCache;
				file_put_contents( 
					$Dirname.'/../../data/package_real_version_cache' , serialize( $PackageRealVersionCache ) 
				);
			}
		}
		
		function			_save_rewrited_package_cache( $Dirname )
		{
			global	$RewritedPackageCacheChanged;
			if( $RewritedPackageCacheChanged )
			{
				global	$RewritedPackageCache;
				file_put_contents( $Dirname.'/../../data/rewrited_package_cache' , serialize( $RewritedPackageCache ) );
			}
		}
		
		function			_save_rewrites_cache( $Dirname )
		{
			global	$RewritesCacheChanged;
			if( $RewritesCacheChanged )
			{
				global	$RewritesCache;
				file_put_contents( $Dirname.'/../../data/rewrites_cache' , serialize( $RewritesCache ) );
			}
		}
		
		function			_save_package_path_cache( $Dirname )
		{
			global	$PackagePathCacheChanged;
			if( $PackagePathCacheChanged )
			{
				global	$PackagePathCache;
				file_put_contents( $Dirname.'/../../data/package_path_cache' , serialize( $PackagePathCache ) );
			}
		}
	
		function			_save_package_relative_path_cache( $Dirname )
		{
			global	$PackageRelativePathCacheChanged;
			if( $PackageRelativePathCacheChanged )
			{
				global	$PackageRelativePathCache;
				file_put_contents( 
					$Dirname.'/../../data/package_relative_path_cache' , serialize( $PackageRelativePathCache )
				);
			}
		}
		
		function			_save_top_package_name_cache( $Dirname )
		{
			global	$TopPackageNameCacheChanged;
			if( $TopPackageNameCacheChanged )
			{
				global	$TopPackageNameCache;
				file_put_contents( $Dirname.'/../../data/top_package_name_cache' , serialize( $TopPackageNameCache ) );
			}
		}
		
		function			_save_make_full_version_cache( $Dirname )
		{
			global	$MakeFullVersionCacheChanged;
			if( $MakeFullVersionCacheChanged )
			{
				global	$MakeFullVersionCache;
				file_put_contents( 
					$Dirname.'/../../data/make_full_version_cache' , serialize( $MakeFullVersionCache )
				);
			}
		}
		
		function			_save_full_class_name_cache( $Dirname )
		{
			global	$FullClassNameCacheChanged;
			if( $FullClassNameCacheChanged )
			{
				global	$FullClassNameCache;
				file_put_contents( $Dirname.'/../../data/full_class_name_cache' , serialize( $FullClassNameCache ) );
			}
		}
	
		function			_save_get_package_cache( $Dirname )
		{
			global	$GetPackageCacheChanged;
			if( $GetPackageCacheChanged )
			{
				global	$GetPackageCache;
				file_put_contents( $Dirname.'/../../data/get_package_cache' , serialize( $GetPackageCache ) );
			}
		}
		
		function			_save_package_script_paths_cache( $Dirname )
		{
			global	$PackagePathsCacheChanged;
			if( $PackagePathsCacheChanged )
			{
				global	$PackagePathsCache;
				file_put_contents( 
					$Dirname.'/../../data/package_script_paths_cache' , serialize( $PackagePathsCache )
				);
			}
		}
		
		/**
		*	\~russian Деструктор.
		*
		*	@author Додонов А.А.
		*/
		/**
		*	\~english Destructor.
		*
		*	@author Dodonov A.A.
		*/
		function			__destruct()
		{
			$Dirname = dirname( __FILE__ );
			
			$this->_save_root_dir_cache( $Dirname );
			$this->_save_package_real_version_cache( $Dirname );
			$this->_save_rewrited_package_cache( $Dirname );
			$this->_save_rewrites_cache( $Dirname );
			$this->_save_package_path_cache( $Dirname );
			$this->_save_package_relative_path_cache( $Dirname );
			$this->_save_top_package_name_cache( $Dirname );
			$this->_save_make_full_version_cache( $Dirname );
			$this->_save_full_class_name_cache( $Dirname );
			$this->_save_get_package_cache( $Dirname );
			$this->_save_package_script_paths_cache( $Dirname );
		}
	}
	
	global	$CoreCache;
	$CoreCache = new core_cache();
	
	/**
	*	\~russian Функция удаления кэша ядра.
	*
	*	@author Додонов А.А.
	*/
	/**
	*	\~english Function drops core's cache.
	*
	*	@author Dodonov A.A.
	*/
	function				_drop_core_cache()
	{
		global	$CoreCache;
		$CoreCache->drop_cache();
	}
?>