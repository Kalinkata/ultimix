var		ultimix = {};

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.lang )
{
	ultimix.lang = {};
}

/**
*	Current locale.
*
*	@author Dodonov A.A.
*/
ultimix.lang.Locale = 'ru';

/**
*	List of the translations.
*
*	@author Dodonov A.A.
*/
ultimix.lang.Strings = new Object();

/**
*	List of the translated strings.
*
*	@author Dodonov A.A.
*/
ultimix.lang.Strings[ ultimix.lang.Locale ] = new Object();

/**
*	Function returns the translated literal for the StringAlias.
*
*	@param StringAlias - Literal to translate.
*
*	@param Default - Default literal.
*
*	@param Value - Literal selection value.
*
*	@return The translated literal.
*
*	@author Dodonov A.A.
*/
ultimix.get_string = function( StringAlias , Default , Value )
{
	if( !Value )
	{
		Value = 'default';
	}
	
	if( ultimix.lang.Strings[ ultimix.lang.Locale ] )
	{
		if( ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ] )
		{
			if( Value == 'default' )
			{
				return( ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ][ 'default' ] );
			}
			else
			{
				for( Condition in ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ] )
				{
					if( ( new RegExp( Condition ) ).test( String( Value ) ) )
					{
						return( ultimix.lang.Strings[ ultimix.lang.Locale ][ StringAlias ][ Condition ] );
					}
				}
			}
		}
	}
	if( Default )
	{
		return( Default );
	}
	return( StringAlias );
}
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_ru' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_ru' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_ru' ][ 'default' ] = 'рус';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_en' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_en' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_en' ][ 'default' ] = 'eng';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_jp' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_jp' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'name_jp' ][ 'default' ] = 'jap';

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'main_page' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'main_page' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'main_page' ][ 'default' ] = 'Главная[nbsp]страница';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_main_admin_page' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_main_admin_page' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_main_admin_page' ][ 'default' ] = 'Главная[nbsp]страница';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_user_management' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_user_management' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_user_management' ][ 'default' ] = 'Управление[nbsp]пользователями';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_page_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_page_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_page_manager' ][ 'default' ] = 'Управление[nbsp]страницами';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_package_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_package_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'menu_package_manager' ][ 'default' ] = 'Управление[nbsp]пакетами';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'admin_console' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'admin_console' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'admin_console' ][ 'default' ] = 'Консоль администратора';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'no_permits' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'no_permits' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'no_permits' ][ 'default' ] = 'Нет доступа';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'an_error_occured' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'an_error_occured' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'an_error_occured' ][ 'default' ] = 'Произошла ошибка';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'profile' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'profile' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'profile' ][ 'default' ] = 'Профиль';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'today_is' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'today_is' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'today_is' ][ 'default' ] = 'Системная дата';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_was_not_found' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_was_not_found' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_was_not_found' ][ 'default' ] = 'Страница не найдена';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_was_generated_in' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_was_generated_in' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_was_generated_in' ][ 'default' ] = 'Страница была сгенерирована за[nbsp]:[nbsp]';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'passes_count' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'passes_count' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'passes_count' ][ 'default' ] = 'Количество[nbsp]проходов[nbsp]:[nbsp]';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'nbsp' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'nbsp' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'nbsp' ][ 'default' ] = '[nbsp]';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'no_text' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'no_text' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'no_text' ][ 'default' ] = '';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'save' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'save' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'save' ][ 'default' ] = 'сохранить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_all_selected_records' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_all_selected_records' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_all_selected_records' ][ 'default' ] = 'Вы уверены, что хотите удалить все выбранные записи?';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'edit' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'edit' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'edit' ][ 'default' ] = 'редактировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cancel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cancel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cancel' ][ 'default' ] = 'отмена';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'create' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'create' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'create' ][ 'default' ] = 'создать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_that_you_want_to_do_it' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_that_you_want_to_do_it' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_that_you_want_to_do_it' ][ 'default' ] = 'Вы уверены, что хотите сделать это?';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Next' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Next' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Next' ][ 'default' ] = 'Далее';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Back' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Back' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Back' ][ 'default' ] = 'Назад';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Finish' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Finish' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Finish' ][ 'default' ] = 'Завершить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Cancel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Cancel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Cancel' ][ 'default' ] = 'Отмена';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'step' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'step' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'step' ][ 'default' ] = 'шаг';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'of' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'of' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'of' ][ 'default' ] = 'из';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'delete' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'delete' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'delete' ][ 'default' ] = 'удалить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Delete' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Delete' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Delete' ][ 'default' ] = 'Удалить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Help' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Help' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Help' ][ 'default' ] = 'Помощь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Ignore' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Ignore' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Ignore' ][ 'default' ] = 'Игнорировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Retry' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Retry' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Retry' ][ 'default' ] = 'Повторить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Abort' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Abort' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Abort' ][ 'default' ] = 'Прервать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Cancel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Cancel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Cancel' ][ 'default' ] = 'Отмена';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'OK' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'OK' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'OK' ][ 'default' ] = 'ОК';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'No' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'No' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'No' ][ 'default' ] = 'Нет';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Yes' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Yes' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Yes' ][ 'default' ] = 'Да';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Question' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Question' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Question' ][ 'default' ] = 'Вопрос';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Error' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Error' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Error' ][ 'default' ] = 'Ошибка';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Info' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Info' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Info' ][ 'default' ] = 'Информация';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'wait_please' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'wait_please' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'wait_please' ][ 'default' ] = 'Операция выполняется. Пожалуйста подождите...';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'print' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'print' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'print' ][ 'default' ] = 'печать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Print' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Print' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'Print' ][ 'default' ] = 'Печать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'not_set' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'not_set' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'not_set' ][ 'default' ] = 'не установлено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'admin_console_short' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'admin_console_short' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'admin_console_short' ][ 'default' ] = 'Админка';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'main' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'main' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'main' ][ 'default' ] = 'Главная<br>страница';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'not_defined' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'not_defined' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'not_defined' ][ 'default' ] = 'не определено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'details' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'details' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'details' ][ 'default' ] = 'подробнее';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'grid_waiting_message' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'grid_waiting_message' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'grid_waiting_message' ][ 'default' ] = 'Операция выполняется. Подождите пожалуйста...';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'view' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'view' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'view' ][ 'default' ] = 'просмотр';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'about_us' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'about_us' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'about_us' ][ 'default' ] = 'О нас';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'contacts' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'contacts' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'contacts' ][ 'default' ] = 'Контакты';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'info' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'info' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'info' ][ 'default' ] = 'Информация';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'forum' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'forum' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'forum' ][ 'default' ] = 'Форум';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'photogallery' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'photogallery' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'photogallery' ][ 'default' ] = 'Фотогалерея';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'video' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'video' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'video' ][ 'default' ] = 'Видео';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_1' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_1' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_1' ][ 'default' ] = 'Январь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_2' ][ 'default' ] = 'Февраль';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_3' ][ 'default' ] = 'Март';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_4' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_4' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_4' ][ 'default' ] = 'Апрель';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_5' ][ 'default' ] = 'Май';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_6' ][ 'default' ] = 'Июнь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_7' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_7' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_7' ][ 'default' ] = 'Июль';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_8' ][ 'default' ] = 'Август';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_9' ][ 'default' ] = 'Сентябрь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_10' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_10' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_10' ][ 'default' ] = 'Октябрь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_11' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_11' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_11' ][ 'default' ] = 'Ноябрь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month_12' ][ 'default' ] = 'Декабрь';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'auto_submit_protection' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'auto_submit_protection' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'auto_submit_protection' ][ 'default' ] = 'Защита&nbsp;от&nbsp;ботов';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'numbers_on_the_image' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'numbers_on_the_image' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'numbers_on_the_image' ][ 'default' ] = 'Цифры&nbsp;на&nbsp;картинке';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'send' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'send' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'send' ][ 'default' ] = 'отправить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'captcha_error' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'captcha_error' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'captcha_error' ][ 'default' ] = 'Неправильно введён код с картинки';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'navigation' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'navigation' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'navigation' ][ 'default' ] = 'Навигация';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'advertisement' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'advertisement' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'advertisement' ][ 'default' ] = 'Реклама';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'update' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'update' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'update' ][ 'default' ] = 'обновить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'download' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'download' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'download' ][ 'default' ] = 'скачать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'report' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'report' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'report' ][ 'default' ] = 'отчёт';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'generate' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'generate' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'generate' ][ 'default' ] = 'сгенерировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'copy' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'copy' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'copy' ][ 'default' ] = 'копировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'report_is_generating' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'report_is_generating' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'report_is_generating' ][ 'default' ] = 'Осуществляется генерация отчета. Пожалуйста подождите...';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'at_least_one_record_must_be_selected' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'at_least_one_record_must_be_selected' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'at_least_one_record_must_be_selected' ][ 'default' ] = 'Ни одной записи не выборано. Должна быть выбрана хотя бы одна запись.';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'total_records_count' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'total_records_count' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'total_records_count' ][ 'default' ] = 'Общее число записей';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'more_info' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'more_info' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'more_info' ][ 'default' ] = 'Подробнее';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'number_to_words' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'number_to_words' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'number_to_words' ][ '/^[0-9]{1,9}$/' ] = '{lang:digit10;value={value};default=}{lang:digit9;value={value};default=}{lang:digit8;value={value};default=}{lang:digit78;value={value};default=}{lang:digit7;value={value};default=}{lang:digit6;value={value};default=}{lang:digit5;value={value};default=}{lang:digit45;value={value};default=}{lang:digit4;value={value};default=}{lang:digit3;value={value};default=}{lang:digit2;value={value};default=}{lang:digit12;value={value};default=}';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit10' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit10' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit10' ][ '/[0-9]{10}$/' ] = 'Откуда такие деньги? ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/9[0-9]{8}$/' ] = 'девятьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/8[0-9]{8}$/' ] = 'восемьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/7[0-9]{8}$/' ] = 'семьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/6[0-9]{8}$/' ] = 'шестьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/5[0-9]{8}$/' ] = 'пятьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/4[0-9]{8}$/' ] = 'четыреста ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/3[0-9]{8}$/' ] = 'триста ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/2[0-9]{8}$/' ] = 'двести ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit9' ][ '/1[0-9]{8}$/' ] = 'сто ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/9[0-9]{7}$/' ] = 'девяносто ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/8[0-9]{7}$/' ] = 'восемьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/7[0-9]{7}$/' ] = 'семьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/6[0-9]{7}$/' ] = 'шестьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/5[0-9]{7}$/' ] = 'пятьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/4[0-9]{7}$/' ] = 'сорок ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/3[0-9]{7}$/' ] = 'тридцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit8' ][ '/2[0-9]{7}$/' ] = 'двадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/10[0-9]{6}$/' ] = 'десять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/11[0-9]{6}$/' ] = 'одинадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/12[0-9]{6}$/' ] = 'двенадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/13[0-9]{6}$/' ] = 'тринадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/14[0-9]{6}$/' ] = 'четырнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/15[0-9]{6}$/' ] = 'пятнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/16[0-9]{6}$/' ] = 'шестнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/17[0-9]{6}$/' ] = 'семнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/18[0-9]{6}$/' ] = 'восемнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/19[0-9]{6}$/' ] = 'девятнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/0[0-9]{6}$/' ] = '';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/1[0-9]{6}$/' ] = 'один ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/2[0-9]{6}$/' ] = 'два ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/3[0-9]{6}$/' ] = 'три ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/4[0-9]{6}$/' ] = 'четыре ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/5[0-9]{6}$/' ] = 'пять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/6[0-9]{6}$/' ] = 'шесть ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/7[0-9]{6}$/' ] = 'семь ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/8[0-9]{6}$/' ] = 'восемь ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit78' ][ '/9[0-9]{6}$/' ] = 'девять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ][ '/[2-9]0[0-9]{6}$/' ] = 'миллионов ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ][ '/1[0-9][0-9]{6}$/' ] = 'миллионов ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ][ '/[5-9][0-9]{6}$/' ] = 'миллионов ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ][ '/[2-4][0-9]{6}$/' ] = 'миллиона ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit7' ][ '/1[0-9]{6}$/' ] = 'миллион ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/9[0-9]{5}$/' ] = 'девятьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/8[0-9]{5}$/' ] = 'восемьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/7[0-9]{5}$/' ] = 'семьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/6[0-9]{5}$/' ] = 'шестьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/5[0-9]{5}$/' ] = 'пятьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/4[0-9]{5}$/' ] = 'четыреста ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/3[0-9]{5}$/' ] = 'триста ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/2[0-9]{5}$/' ] = 'двести ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit6' ][ '/1[0-9]{5}$/' ] = 'сто ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/9[0-9]{4}$/' ] = 'девяносто ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/8[0-9]{4}$/' ] = 'восемьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/7[0-9]{4}$/' ] = 'семьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/6[0-9]{4}$/' ] = 'шестьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/5[0-9]{4}$/' ] = 'пятьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/4[0-9]{4}$/' ] = 'сорок ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/3[0-9]{4}$/' ] = 'тридцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit5' ][ '/2[0-9]{4}$/' ] = 'двадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/19[0-9]{3}$/' ] = 'девятнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/18[0-9]{3}$/' ] = 'восемнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/17[0-9]{3}$/' ] = 'семнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/16[0-9]{3}$/' ] = 'шестнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/15[0-9]{3}$/' ] = 'пятнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/14[0-9]{3}$/' ] = 'четырнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/13[0-9]{3}$/' ] = 'тридцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/12[0-9]{3}$/' ] = 'двенадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/11[0-9]{3}$/' ] = 'одинадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/10[0-9]{3}$/' ] = 'десять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/9[0-9]{3}$/' ] = 'девять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/8[0-9]{3}$/' ] = 'восемь ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/7[0-9]{3}$/' ] = 'семь ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/6[0-9]{3}$/' ] = 'шесть ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/5[0-9]{3}$/' ] = 'пять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/4[0-9]{3}$/' ] = 'четыре ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/3[0-9]{3}$/' ] = 'три ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/2[0-9]{3}$/' ] = 'две ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit45' ][ '/1[0-9]{3}$/' ] = 'одна ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ][ '/[2-9]0[0-9]{3}$/' ] = 'тысяч ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ][ '/1[0-9][0-9]{3}$/' ] = 'тысяч ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ][ '/[5-9][0-9]{3}$/' ] = 'тысяч ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ][ '/[2-4][0-9]{3}$/' ] = 'тысячи ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit4' ][ '/1[0-9]{3}$/' ] = 'тысяча ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/9[0-9]{2}$/' ] = 'девятьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/8[0-9]{2}$/' ] = 'восемьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/7[0-9]{2}$/' ] = 'семьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/6[0-9]{2}$/' ] = 'шестьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/5[0-9]{2}$/' ] = 'пятьсот ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/4[0-9]{2}$/' ] = 'четыреста ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/3[0-9]{2}$/' ] = 'триста ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/2[0-9]{2}$/' ] = 'двести ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit3' ][ '/1[0-9]{2}$/' ] = 'сто ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/9[0-9]$/' ] = 'девяносто ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/8[0-9]$/' ] = 'восемьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/7[0-9]$/' ] = 'семьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/6[0-9]$/' ] = 'шестьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/5[0-9]$/' ] = 'пятьдесят ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/4[0-9]$/' ] = 'сорок ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/3[0-9]$/' ] = 'тридцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit2' ][ '/2[0-9]$/' ] = 'двадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/10$/' ] = 'десять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/11$/' ] = 'одинадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/12$/' ] = 'двенадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/13$/' ] = 'тринадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/14$/' ] = 'четырнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/15$/' ] = 'пятнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/16$/' ] = 'шестнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/17$/' ] = 'семнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/18$/' ] = 'восемнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/19$/' ] = 'девятнадцать ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/^0$/' ] = 'ноль ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/^f[0-9]{0,9}1$/' ] = 'одна ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/1$/' ] = 'один ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/^f[0-9]{0,9}1$/' ] = 'две ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/2$/' ] = 'два ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/3$/' ] = 'три ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/4$/' ] = 'четыре ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/5$/' ] = 'пять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/6$/' ] = 'шесть ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/7$/' ] = 'семь ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/8$/' ] = 'восемь ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'digit12' ][ '/9$/' ] = 'девять ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'are_you_shure' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'are_you_shure' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'are_you_shure' ][ 'default' ] = 'Вы уверены, что хотите выполнить это действие?';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'user_does_not_exist' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'user_does_not_exist' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'user_does_not_exist' ][ 'default' ] = 'Пользователь с указанным логином не существует';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'all_rights_reserved' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'all_rights_reserved' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'all_rights_reserved' ][ 'default' ] = 'Все права защищены';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'slide_panel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'slide_panel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'slide_panel' ][ 'default' ] = 'Выдвинуть панель';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'close_panel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'close_panel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'close_panel' ][ 'default' ] = 'Закрыть панель';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'open_panel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'open_panel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'open_panel' ][ 'default' ] = 'Открыть панель';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'resize_panel' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'resize_panel' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'resize_panel' ][ 'default' ] = 'Иземнить ширину панели';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'create_button' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'create_button' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'create_button' ][ 'default' ] = 'Создать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'delete_button' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'delete_button' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'delete_button' ][ 'default' ] = 'Удалить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'update_button' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'update_button' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'update_button' ][ 'default' ] = 'Редактировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'copy_button' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'copy_button' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'copy_button' ][ 'default' ] = 'Копировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'search_button' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'search_button' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'search_button' ][ 'default' ] = 'Искать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'contact_us' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'contact_us' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'contact_us' ][ 'default' ] = 'Свяжитесь с нами';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'from' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'from' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'from' ][ 'default' ] = 'с';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'to' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'to' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'to' ][ 'default' ] = 'по';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'week' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'week' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'week' ][ 'default' ] = 'неделя';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ '2weeks' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ '2weeks' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ '2weeks' ][ 'default' ] = '2 недели';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'month' ][ 'default' ] = 'месяц';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ '3months' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ '3months' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ '3months' ][ 'default' ] = '3 месяца';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'half_year' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'half_year' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'half_year' ][ 'default' ] = 'полгода';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'year' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'year' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'year' ][ 'default' ] = 'год';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'close_tab' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'close_tab' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'close_tab' ][ 'default' ] = 'Закрыть вкладку';

/*! jQuery v1.7.1 jquery.com | jquery.org/license */
(function(a,b){function cy(a){return f.isWindow(a)?a:a.nodeType===9?a.defaultView||a.parentWindow:!1}function cv(a){if(!ck[a]){var b=c.body,d=f("<"+a+">").appendTo(b),e=d.css("display");d.remove();if(e==="none"||e===""){cl||(cl=c.createElement("iframe"),cl.frameBorder=cl.width=cl.height=0),b.appendChild(cl);if(!cm||!cl.createElement)cm=(cl.contentWindow||cl.contentDocument).document,cm.write((c.compatMode==="CSS1Compat"?"<!doctype html>":"")+"<html><body>"),cm.close();d=cm.createElement(a),cm.body.appendChild(d),e=f.css(d,"display"),b.removeChild(cl)}ck[a]=e}return ck[a]}function cu(a,b){var c={};f.each(cq.concat.apply([],cq.slice(0,b)),function(){c[this]=a});return c}function ct(){cr=b}function cs(){setTimeout(ct,0);return cr=f.now()}function cj(){try{return new a.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}}function ci(){try{return new a.XMLHttpRequest}catch(b){}}function cc(a,c){a.dataFilter&&(c=a.dataFilter(c,a.dataType));var d=a.dataTypes,e={},g,h,i=d.length,j,k=d[0],l,m,n,o,p;for(g=1;g<i;g++){if(g===1)for(h in a.converters)typeof h=="string"&&(e[h.toLowerCase()]=a.converters[h]);l=k,k=d[g];if(k==="*")k=l;else if(l!=="*"&&l!==k){m=l+" "+k,n=e[m]||e["* "+k];if(!n){p=b;for(o in e){j=o.split(" ");if(j[0]===l||j[0]==="*"){p=e[j[1]+" "+k];if(p){o=e[o],o===!0?n=p:p===!0&&(n=o);break}}}}!n&&!p&&f.error("No conversion from "+m.replace(" "," to ")),n!==!0&&(c=n?n(c):p(o(c)))}}return c}function cb(a,c,d){var e=a.contents,f=a.dataTypes,g=a.responseFields,h,i,j,k;for(i in g)i in d&&(c[g[i]]=d[i]);while(f[0]==="*")f.shift(),h===b&&(h=a.mimeType||c.getResponseHeader("content-type"));if(h)for(i in e)if(e[i]&&e[i].test(h)){f.unshift(i);break}if(f[0]in d)j=f[0];else{for(i in d){if(!f[0]||a.converters[i+" "+f[0]]){j=i;break}k||(k=i)}j=j||k}if(j){j!==f[0]&&f.unshift(j);return d[j]}}function ca(a,b,c,d){if(f.isArray(b))f.each(b,function(b,e){c||bE.test(a)?d(a,e):ca(a+"["+(typeof e=="object"||f.isArray(e)?b:"")+"]",e,c,d)});else if(!c&&b!=null&&typeof b=="object")for(var e in b)ca(a+"["+e+"]",b[e],c,d);else d(a,b)}function b_(a,c){var d,e,g=f.ajaxSettings.flatOptions||{};for(d in c)c[d]!==b&&((g[d]?a:e||(e={}))[d]=c[d]);e&&f.extend(!0,a,e)}function b$(a,c,d,e,f,g){f=f||c.dataTypes[0],g=g||{},g[f]=!0;var h=a[f],i=0,j=h?h.length:0,k=a===bT,l;for(;i<j&&(k||!l);i++)l=h[i](c,d,e),typeof l=="string"&&(!k||g[l]?l=b:(c.dataTypes.unshift(l),l=b$(a,c,d,e,l,g)));(k||!l)&&!g["*"]&&(l=b$(a,c,d,e,"*",g));return l}function bZ(a){return function(b,c){typeof b!="string"&&(c=b,b="*");if(f.isFunction(c)){var d=b.toLowerCase().split(bP),e=0,g=d.length,h,i,j;for(;e<g;e++)h=d[e],j=/^\+/.test(h),j&&(h=h.substr(1)||"*"),i=a[h]=a[h]||[],i[j?"unshift":"push"](c)}}}function bC(a,b,c){var d=b==="width"?a.offsetWidth:a.offsetHeight,e=b==="width"?bx:by,g=0,h=e.length;if(d>0){if(c!=="border")for(;g<h;g++)c||(d-=parseFloat(f.css(a,"padding"+e[g]))||0),c==="margin"?d+=parseFloat(f.css(a,c+e[g]))||0:d-=parseFloat(f.css(a,"border"+e[g]+"Width"))||0;return d+"px"}d=bz(a,b,b);if(d<0||d==null)d=a.style[b]||0;d=parseFloat(d)||0;if(c)for(;g<h;g++)d+=parseFloat(f.css(a,"padding"+e[g]))||0,c!=="padding"&&(d+=parseFloat(f.css(a,"border"+e[g]+"Width"))||0),c==="margin"&&(d+=parseFloat(f.css(a,c+e[g]))||0);return d+"px"}function bp(a,b){b.src?f.ajax({url:b.src,async:!1,dataType:"script"}):f.globalEval((b.text||b.textContent||b.innerHTML||"").replace(bf,"/*$0*/")),b.parentNode&&b.parentNode.removeChild(b)}function bo(a){var b=c.createElement("div");bh.appendChild(b),b.innerHTML=a.outerHTML;return b.firstChild}function bn(a){var b=(a.nodeName||"").toLowerCase();b==="input"?bm(a):b!=="script"&&typeof a.getElementsByTagName!="undefined"&&f.grep(a.getElementsByTagName("input"),bm)}function bm(a){if(a.type==="checkbox"||a.type==="radio")a.defaultChecked=a.checked}function bl(a){return typeof a.getElementsByTagName!="undefined"?a.getElementsByTagName("*"):typeof a.querySelectorAll!="undefined"?a.querySelectorAll("*"):[]}function bk(a,b){var c;if(b.nodeType===1){b.clearAttributes&&b.clearAttributes(),b.mergeAttributes&&b.mergeAttributes(a),c=b.nodeName.toLowerCase();if(c==="object")b.outerHTML=a.outerHTML;else if(c!=="input"||a.type!=="checkbox"&&a.type!=="radio"){if(c==="option")b.selected=a.defaultSelected;else if(c==="input"||c==="textarea")b.defaultValue=a.defaultValue}else a.checked&&(b.defaultChecked=b.checked=a.checked),b.value!==a.value&&(b.value=a.value);b.removeAttribute(f.expando)}}function bj(a,b){if(b.nodeType===1&&!!f.hasData(a)){var c,d,e,g=f._data(a),h=f._data(b,g),i=g.events;if(i){delete h.handle,h.events={};for(c in i)for(d=0,e=i[c].length;d<e;d++)f.event.add(b,c+(i[c][d].namespace?".":"")+i[c][d].namespace,i[c][d],i[c][d].data)}h.data&&(h.data=f.extend({},h.data))}}function bi(a,b){return f.nodeName(a,"table")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function U(a){var b=V.split("|"),c=a.createDocumentFragment();if(c.createElement)while(b.length)c.createElement(b.pop());return c}function T(a,b,c){b=b||0;if(f.isFunction(b))return f.grep(a,function(a,d){var e=!!b.call(a,d,a);return e===c});if(b.nodeType)return f.grep(a,function(a,d){return a===b===c});if(typeof b=="string"){var d=f.grep(a,function(a){return a.nodeType===1});if(O.test(b))return f.filter(b,d,!c);b=f.filter(b,d)}return f.grep(a,function(a,d){return f.inArray(a,b)>=0===c})}function S(a){return!a||!a.parentNode||a.parentNode.nodeType===11}function K(){return!0}function J(){return!1}function n(a,b,c){var d=b+"defer",e=b+"queue",g=b+"mark",h=f._data(a,d);h&&(c==="queue"||!f._data(a,e))&&(c==="mark"||!f._data(a,g))&&setTimeout(function(){!f._data(a,e)&&!f._data(a,g)&&(f.removeData(a,d,!0),h.fire())},0)}function m(a){for(var b in a){if(b==="data"&&f.isEmptyObject(a[b]))continue;if(b!=="toJSON")return!1}return!0}function l(a,c,d){if(d===b&&a.nodeType===1){var e="data-"+c.replace(k,"-$1").toLowerCase();d=a.getAttribute(e);if(typeof d=="string"){try{d=d==="true"?!0:d==="false"?!1:d==="null"?null:f.isNumeric(d)?parseFloat(d):j.test(d)?f.parseJSON(d):d}catch(g){}f.data(a,c,d)}else d=b}return d}function h(a){var b=g[a]={},c,d;a=a.split(/\s+/);for(c=0,d=a.length;c<d;c++)b[a[c]]=!0;return b}var c=a.document,d=a.navigator,e=a.location,f=function(){function J(){if(!e.isReady){try{c.documentElement.doScroll("left")}catch(a){setTimeout(J,1);return}e.ready()}}var e=function(a,b){return new e.fn.init(a,b,h)},f=a.jQuery,g=a.$,h,i=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,j=/\S/,k=/^\s+/,l=/\s+$/,m=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,n=/^[\],:{}\s]*$/,o=/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,p=/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,q=/(?:^|:|,)(?:\s*\[)+/g,r=/(webkit)[ \/]([\w.]+)/,s=/(opera)(?:.*version)?[ \/]([\w.]+)/,t=/(msie) ([\w.]+)/,u=/(mozilla)(?:.*? rv:([\w.]+))?/,v=/-([a-z]|[0-9])/ig,w=/^-ms-/,x=function(a,b){return(b+"").toUpperCase()},y=d.userAgent,z,A,B,C=Object.prototype.toString,D=Object.prototype.hasOwnProperty,E=Array.prototype.push,F=Array.prototype.slice,G=String.prototype.trim,H=Array.prototype.indexOf,I={};e.fn=e.prototype={constructor:e,init:function(a,d,f){var g,h,j,k;if(!a)return this;if(a.nodeType){this.context=this[0]=a,this.length=1;return this}if(a==="body"&&!d&&c.body){this.context=c,this[0]=c.body,this.selector=a,this.length=1;return this}if(typeof a=="string"){a.charAt(0)!=="<"||a.charAt(a.length-1)!==">"||a.length<3?g=i.exec(a):g=[null,a,null];if(g&&(g[1]||!d)){if(g[1]){d=d instanceof e?d[0]:d,k=d?d.ownerDocument||d:c,j=m.exec(a),j?e.isPlainObject(d)?(a=[c.createElement(j[1])],e.fn.attr.call(a,d,!0)):a=[k.createElement(j[1])]:(j=e.buildFragment([g[1]],[k]),a=(j.cacheable?e.clone(j.fragment):j.fragment).childNodes);return e.merge(this,a)}h=c.getElementById(g[2]);if(h&&h.parentNode){if(h.id!==g[2])return f.find(a);this.length=1,this[0]=h}this.context=c,this.selector=a;return this}return!d||d.jquery?(d||f).find(a):this.constructor(d).find(a)}if(e.isFunction(a))return f.ready(a);a.selector!==b&&(this.selector=a.selector,this.context=a.context);return e.makeArray(a,this)},selector:"",jquery:"1.7.1",length:0,size:function(){return this.length},toArray:function(){return F.call(this,0)},get:function(a){return a==null?this.toArray():a<0?this[this.length+a]:this[a]},pushStack:function(a,b,c){var d=this.constructor();e.isArray(a)?E.apply(d,a):e.merge(d,a),d.prevObject=this,d.context=this.context,b==="find"?d.selector=this.selector+(this.selector?" ":"")+c:b&&(d.selector=this.selector+"."+b+"("+c+")");return d},each:function(a,b){return e.each(this,a,b)},ready:function(a){e.bindReady(),A.add(a);return this},eq:function(a){a=+a;return a===-1?this.slice(a):this.slice(a,a+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(F.apply(this,arguments),"slice",F.call(arguments).join(","))},map:function(a){return this.pushStack(e.map(this,function(b,c){return a.call(b,c,b)}))},end:function(){return this.prevObject||this.constructor(null)},push:E,sort:[].sort,splice:[].splice},e.fn.init.prototype=e.fn,e.extend=e.fn.extend=function(){var a,c,d,f,g,h,i=arguments[0]||{},j=1,k=arguments.length,l=!1;typeof i=="boolean"&&(l=i,i=arguments[1]||{},j=2),typeof i!="object"&&!e.isFunction(i)&&(i={}),k===j&&(i=this,--j);for(;j<k;j++)if((a=arguments[j])!=null)for(c in a){d=i[c],f=a[c];if(i===f)continue;l&&f&&(e.isPlainObject(f)||(g=e.isArray(f)))?(g?(g=!1,h=d&&e.isArray(d)?d:[]):h=d&&e.isPlainObject(d)?d:{},i[c]=e.extend(l,h,f)):f!==b&&(i[c]=f)}return i},e.extend({noConflict:function(b){a.$===e&&(a.$=g),b&&a.jQuery===e&&(a.jQuery=f);return e},isReady:!1,readyWait:1,holdReady:function(a){a?e.readyWait++:e.ready(!0)},ready:function(a){if(a===!0&&!--e.readyWait||a!==!0&&!e.isReady){if(!c.body)return setTimeout(e.ready,1);e.isReady=!0;if(a!==!0&&--e.readyWait>0)return;A.fireWith(c,[e]),e.fn.trigger&&e(c).trigger("ready").off("ready")}},bindReady:function(){if(!A){A=e.Callbacks("once memory");if(c.readyState==="complete")return setTimeout(e.ready,1);if(c.addEventListener)c.addEventListener("DOMContentLoaded",B,!1),a.addEventListener("load",e.ready,!1);else if(c.attachEvent){c.attachEvent("onreadystatechange",B),a.attachEvent("onload",e.ready);var b=!1;try{b=a.frameElement==null}catch(d){}c.documentElement.doScroll&&b&&J()}}},isFunction:function(a){return e.type(a)==="function"},isArray:Array.isArray||function(a){return e.type(a)==="array"},isWindow:function(a){return a&&typeof a=="object"&&"setInterval"in a},isNumeric:function(a){return!isNaN(parseFloat(a))&&isFinite(a)},type:function(a){return a==null?String(a):I[C.call(a)]||"object"},isPlainObject:function(a){if(!a||e.type(a)!=="object"||a.nodeType||e.isWindow(a))return!1;try{if(a.constructor&&!D.call(a,"constructor")&&!D.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(c){return!1}var d;for(d in a);return d===b||D.call(a,d)},isEmptyObject:function(a){for(var b in a)return!1;return!0},error:function(a){throw new Error(a)},parseJSON:function(b){if(typeof b!="string"||!b)return null;b=e.trim(b);if(a.JSON&&a.JSON.parse)return a.JSON.parse(b);if(n.test(b.replace(o,"@").replace(p,"]").replace(q,"")))return(new Function("return "+b))();e.error("Invalid JSON: "+b)},parseXML:function(c){var d,f;try{a.DOMParser?(f=new DOMParser,d=f.parseFromString(c,"text/xml")):(d=new ActiveXObject("Microsoft.XMLDOM"),d.async="false",d.loadXML(c))}catch(g){d=b}(!d||!d.documentElement||d.getElementsByTagName("parsererror").length)&&e.error("Invalid XML: "+c);return d},noop:function(){},globalEval:function(b){b&&j.test(b)&&(a.execScript||function(b){a.eval.call(a,b)})(b)},camelCase:function(a){return a.replace(w,"ms-").replace(v,x)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toUpperCase()===b.toUpperCase()},each:function(a,c,d){var f,g=0,h=a.length,i=h===b||e.isFunction(a);if(d){if(i){for(f in a)if(c.apply(a[f],d)===!1)break}else for(;g<h;)if(c.apply(a[g++],d)===!1)break}else if(i){for(f in a)if(c.call(a[f],f,a[f])===!1)break}else for(;g<h;)if(c.call(a[g],g,a[g++])===!1)break;return a},trim:G?function(a){return a==null?"":G.call(a)}:function(a){return a==null?"":(a+"").replace(k,"").replace(l,"")},makeArray:function(a,b){var c=b||[];if(a!=null){var d=e.type(a);a.length==null||d==="string"||d==="function"||d==="regexp"||e.isWindow(a)?E.call(c,a):e.merge(c,a)}return c},inArray:function(a,b,c){var d;if(b){if(H)return H.call(b,a,c);d=b.length,c=c?c<0?Math.max(0,d+c):c:0;for(;c<d;c++)if(c in b&&b[c]===a)return c}return-1},merge:function(a,c){var d=a.length,e=0;if(typeof c.length=="number")for(var f=c.length;e<f;e++)a[d++]=c[e];else while(c[e]!==b)a[d++]=c[e++];a.length=d;return a},grep:function(a,b,c){var d=[],e;c=!!c;for(var f=0,g=a.length;f<g;f++)e=!!b(a[f],f),c!==e&&d.push(a[f]);return d},map:function(a,c,d){var f,g,h=[],i=0,j=a.length,k=a instanceof e||j!==b&&typeof j=="number"&&(j>0&&a[0]&&a[j-1]||j===0||e.isArray(a));if(k)for(;i<j;i++)f=c(a[i],i,d),f!=null&&(h[h.length]=f);else for(g in a)f=c(a[g],g,d),f!=null&&(h[h.length]=f);return h.concat.apply([],h)},guid:1,proxy:function(a,c){if(typeof c=="string"){var d=a[c];c=a,a=d}if(!e.isFunction(a))return b;var f=F.call(arguments,2),g=function(){return a.apply(c,f.concat(F.call(arguments)))};g.guid=a.guid=a.guid||g.guid||e.guid++;return g},access:function(a,c,d,f,g,h){var i=a.length;if(typeof c=="object"){for(var j in c)e.access(a,j,c[j],f,g,d);return a}if(d!==b){f=!h&&f&&e.isFunction(d);for(var k=0;k<i;k++)g(a[k],c,f?d.call(a[k],k,g(a[k],c)):d,h);return a}return i?g(a[0],c):b},now:function(){return(new Date).getTime()},uaMatch:function(a){a=a.toLowerCase();var b=r.exec(a)||s.exec(a)||t.exec(a)||a.indexOf("compatible")<0&&u.exec(a)||[];return{browser:b[1]||"",version:b[2]||"0"}},sub:function(){function a(b,c){return new a.fn.init(b,c)}e.extend(!0,a,this),a.superclass=this,a.fn=a.prototype=this(),a.fn.constructor=a,a.sub=this.sub,a.fn.init=function(d,f){f&&f instanceof e&&!(f instanceof a)&&(f=a(f));return e.fn.init.call(this,d,f,b)},a.fn.init.prototype=a.fn;var b=a(c);return a},browser:{}}),e.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(a,b){I["[object "+b+"]"]=b.toLowerCase()}),z=e.uaMatch(y),z.browser&&(e.browser[z.browser]=!0,e.browser.version=z.version),e.browser.webkit&&(e.browser.safari=!0),j.test(" ")&&(k=/^[\s\xA0]+/,l=/[\s\xA0]+$/),h=e(c),c.addEventListener?B=function(){c.removeEventListener("DOMContentLoaded",B,!1),e.ready()}:c.attachEvent&&(B=function(){c.readyState==="complete"&&(c.detachEvent("onreadystatechange",B),e.ready())});return e}(),g={};f.Callbacks=function(a){a=a?g[a]||h(a):{};var c=[],d=[],e,i,j,k,l,m=function(b){var d,e,g,h,i;for(d=0,e=b.length;d<e;d++)g=b[d],h=f.type(g),h==="array"?m(g):h==="function"&&(!a.unique||!o.has(g))&&c.push(g)},n=function(b,f){f=f||[],e=!a.memory||[b,f],i=!0,l=j||0,j=0,k=c.length;for(;c&&l<k;l++)if(c[l].apply(b,f)===!1&&a.stopOnFalse){e=!0;break}i=!1,c&&(a.once?e===!0?o.disable():c=[]:d&&d.length&&(e=d.shift(),o.fireWith(e[0],e[1])))},o={add:function(){if(c){var a=c.length;m(arguments),i?k=c.length:e&&e!==!0&&(j=a,n(e[0],e[1]))}return this},remove:function(){if(c){var b=arguments,d=0,e=b.length;for(;d<e;d++)for(var f=0;f<c.length;f++)if(b[d]===c[f]){i&&f<=k&&(k--,f<=l&&l--),c.splice(f--,1);if(a.unique)break}}return this},has:function(a){if(c){var b=0,d=c.length;for(;b<d;b++)if(a===c[b])return!0}return!1},empty:function(){c=[];return this},disable:function(){c=d=e=b;return this},disabled:function(){return!c},lock:function(){d=b,(!e||e===!0)&&o.disable();return this},locked:function(){return!d},fireWith:function(b,c){d&&(i?a.once||d.push([b,c]):(!a.once||!e)&&n(b,c));return this},fire:function(){o.fireWith(this,arguments);return this},fired:function(){return!!e}};return o};var i=[].slice;f.extend({Deferred:function(a){var b=f.Callbacks("once memory"),c=f.Callbacks("once memory"),d=f.Callbacks("memory"),e="pending",g={resolve:b,reject:c,notify:d},h={done:b.add,fail:c.add,progress:d.add,state:function(){return e},isResolved:b.fired,isRejected:c.fired,then:function(a,b,c){i.done(a).fail(b).progress(c);return this},always:function(){i.done.apply(i,arguments).fail.apply(i,arguments);return this},pipe:function(a,b,c){return f.Deferred(function(d){f.each({done:[a,"resolve"],fail:[b,"reject"],progress:[c,"notify"]},function(a,b){var c=b[0],e=b[1],g;f.isFunction(c)?i[a](function(){g=c.apply(this,arguments),g&&f.isFunction(g.promise)?g.promise().then(d.resolve,d.reject,d.notify):d[e+"With"](this===i?d:this,[g])}):i[a](d[e])})}).promise()},promise:function(a){if(a==null)a=h;else for(var b in h)a[b]=h[b];return a}},i=h.promise({}),j;for(j in g)i[j]=g[j].fire,i[j+"With"]=g[j].fireWith;i.done(function(){e="resolved"},c.disable,d.lock).fail(function(){e="rejected"},b.disable,d.lock),a&&a.call(i,i);return i},when:function(a){function m(a){return function(b){e[a]=arguments.length>1?i.call(arguments,0):b,j.notifyWith(k,e)}}function l(a){return function(c){b[a]=arguments.length>1?i.call(arguments,0):c,--g||j.resolveWith(j,b)}}var b=i.call(arguments,0),c=0,d=b.length,e=Array(d),g=d,h=d,j=d<=1&&a&&f.isFunction(a.promise)?a:f.Deferred(),k=j.promise();if(d>1){for(;c<d;c++)b[c]&&b[c].promise&&f.isFunction(b[c].promise)?b[c].promise().then(l(c),j.reject,m(c)):--g;g||j.resolveWith(j,b)}else j!==a&&j.resolveWith(j,d?[a]:[]);return k}}),f.support=function(){var b,d,e,g,h,i,j,k,l,m,n,o,p,q=c.createElement("div"),r=c.documentElement;q.setAttribute("className","t"),q.innerHTML="   <link/><table></table><a href='/a' style='top:1px;float:left;opacity:.55;'>a</a><input type='checkbox'/>",d=q.getElementsByTagName("*"),e=q.getElementsByTagName("a")[0];if(!d||!d.length||!e)return{};g=c.createElement("select"),h=g.appendChild(c.createElement("option")),i=q.getElementsByTagName("input")[0],b={leadingWhitespace:q.firstChild.nodeType===3,tbody:!q.getElementsByTagName("tbody").length,htmlSerialize:!!q.getElementsByTagName("link").length,style:/top/.test(e.getAttribute("style")),hrefNormalized:e.getAttribute("href")==="/a",opacity:/^0.55/.test(e.style.opacity),cssFloat:!!e.style.cssFloat,checkOn:i.value==="on",optSelected:h.selected,getSetAttribute:q.className!=="t",enctype:!!c.createElement("form").enctype,html5Clone:c.createElement("nav").cloneNode(!0).outerHTML!=="<:nav></:nav>",submitBubbles:!0,changeBubbles:!0,focusinBubbles:!1,deleteExpando:!0,noCloneEvent:!0,inlineBlockNeedsLayout:!1,shrinkWrapBlocks:!1,reliableMarginRight:!0},i.checked=!0,b.noCloneChecked=i.cloneNode(!0).checked,g.disabled=!0,b.optDisabled=!h.disabled;try{delete q.test}catch(s){b.deleteExpando=!1}!q.addEventListener&&q.attachEvent&&q.fireEvent&&(q.attachEvent("onclick",function(){b.noCloneEvent=!1}),q.cloneNode(!0).fireEvent("onclick")),i=c.createElement("input"),i.value="t",i.setAttribute("type","radio"),b.radioValue=i.value==="t",i.setAttribute("checked","checked"),q.appendChild(i),k=c.createDocumentFragment(),k.appendChild(q.lastChild),b.checkClone=k.cloneNode(!0).cloneNode(!0).lastChild.checked,b.appendChecked=i.checked,k.removeChild(i),k.appendChild(q),q.innerHTML="",a.getComputedStyle&&(j=c.createElement("div"),j.style.width="0",j.style.marginRight="0",q.style.width="2px",q.appendChild(j),b.reliableMarginRight=(parseInt((a.getComputedStyle(j,null)||{marginRight:0}).marginRight,10)||0)===0);if(q.attachEvent)for(o in{submit:1,change:1,focusin:1})n="on"+o,p=n in q,p||(q.setAttribute(n,"return;"),p=typeof q[n]=="function"),b[o+"Bubbles"]=p;k.removeChild(q),k=g=h=j=q=i=null,f(function(){var a,d,e,g,h,i,j,k,m,n,o,r=c.getElementsByTagName("body")[0];!r||(j=1,k="position:absolute;top:0;left:0;width:1px;height:1px;margin:0;",m="visibility:hidden;border:0;",n="style='"+k+"border:5px solid #000;padding:0;'",o="<div "+n+"><div></div></div>"+"<table "+n+" cellpadding='0' cellspacing='0'>"+"<tr><td></td></tr></table>",a=c.createElement("div"),a.style.cssText=m+"width:0;height:0;position:static;top:0;margin-top:"+j+"px",r.insertBefore(a,r.firstChild),q=c.createElement("div"),a.appendChild(q),q.innerHTML="<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>",l=q.getElementsByTagName("td"),p=l[0].offsetHeight===0,l[0].style.display="",l[1].style.display="none",b.reliableHiddenOffsets=p&&l[0].offsetHeight===0,q.innerHTML="",q.style.width=q.style.paddingLeft="1px",f.boxModel=b.boxModel=q.offsetWidth===2,typeof q.style.zoom!="undefined"&&(q.style.display="inline",q.style.zoom=1,b.inlineBlockNeedsLayout=q.offsetWidth===2,q.style.display="",q.innerHTML="<div style='width:4px;'></div>",b.shrinkWrapBlocks=q.offsetWidth!==2),q.style.cssText=k+m,q.innerHTML=o,d=q.firstChild,e=d.firstChild,h=d.nextSibling.firstChild.firstChild,i={doesNotAddBorder:e.offsetTop!==5,doesAddBorderForTableAndCells:h.offsetTop===5},e.style.position="fixed",e.style.top="20px",i.fixedPosition=e.offsetTop===20||e.offsetTop===15,e.style.position=e.style.top="",d.style.overflow="hidden",d.style.position="relative",i.subtractsBorderForOverflowNotVisible=e.offsetTop===-5,i.doesNotIncludeMarginInBodyOffset=r.offsetTop!==j,r.removeChild(a),q=a=null,f.extend(b,i))});return b}();var j=/^(?:\{.*\}|\[.*\])$/,k=/([A-Z])/g;f.extend({cache:{},uuid:0,expando:"jQuery"+(f.fn.jquery+Math.random()).replace(/\D/g,""),noData:{embed:!0,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:!0},hasData:function(a){a=a.nodeType?f.cache[a[f.expando]]:a[f.expando];return!!a&&!m(a)},data:function(a,c,d,e){if(!!f.acceptData(a)){var g,h,i,j=f.expando,k=typeof c=="string",l=a.nodeType,m=l?f.cache:a,n=l?a[j]:a[j]&&j,o=c==="events";if((!n||!m[n]||!o&&!e&&!m[n].data)&&k&&d===b)return;n||(l?a[j]=n=++f.uuid:n=j),m[n]||(m[n]={},l||(m[n].toJSON=f.noop));if(typeof c=="object"||typeof c=="function")e?m[n]=f.extend(m[n],c):m[n].data=f.extend(m[n].data,c);g=h=m[n],e||(h.data||(h.data={}),h=h.data),d!==b&&(h[f.camelCase(c)]=d);if(o&&!h[c])return g.events;k?(i=h[c],i==null&&(i=h[f.camelCase(c)])):i=h;return i}},removeData:function(a,b,c){if(!!f.acceptData(a)){var d,e,g,h=f.expando,i=a.nodeType,j=i?f.cache:a,k=i?a[h]:h;if(!j[k])return;if(b){d=c?j[k]:j[k].data;if(d){f.isArray(b)||(b in d?b=[b]:(b=f.camelCase(b),b in d?b=[b]:b=b.split(" ")));for(e=0,g=b.length;e<g;e++)delete d[b[e]];if(!(c?m:f.isEmptyObject)(d))return}}if(!c){delete j[k].data;if(!m(j[k]))return}f.support.deleteExpando||!j.setInterval?delete j[k]:j[k]=null,i&&(f.support.deleteExpando?delete a[h]:a.removeAttribute?a.removeAttribute(h):a[h]=null)}},_data:function(a,b,c){return f.data(a,b,c,!0)},acceptData:function(a){if(a.nodeName){var b=f.noData[a.nodeName.toLowerCase()];if(b)return b!==!0&&a.getAttribute("classid")===b}return!0}}),f.fn.extend({data:function(a,c){var d,e,g,h=null;if(typeof a=="undefined"){if(this.length){h=f.data(this[0]);if(this[0].nodeType===1&&!f._data(this[0],"parsedAttrs")){e=this[0].attributes;for(var i=0,j=e.length;i<j;i++)g=e[i].name,g.indexOf("data-")===0&&(g=f.camelCase(g.substring(5)),l(this[0],g,h[g]));f._data(this[0],"parsedAttrs",!0)}}return h}if(typeof a=="object")return this.each(function(){f.data(this,a)});d=a.split("."),d[1]=d[1]?"."+d[1]:"";if(c===b){h=this.triggerHandler("getData"+d[1]+"!",[d[0]]),h===b&&this.length&&(h=f.data(this[0],a),h=l(this[0],a,h));return h===b&&d[1]?this.data(d[0]):h}return this.each(function(){var b=f(this),e=[d[0],c];b.triggerHandler("setData"+d[1]+"!",e),f.data(this,a,c),b.triggerHandler("changeData"+d[1]+"!",e)})},removeData:function(a){return this.each(function(){f.removeData(this,a)})}}),f.extend({_mark:function(a,b){a&&(b=(b||"fx")+"mark",f._data(a,b,(f._data(a,b)||0)+1))},_unmark:function(a,b,c){a!==!0&&(c=b,b=a,a=!1);if(b){c=c||"fx";var d=c+"mark",e=a?0:(f._data(b,d)||1)-1;e?f._data(b,d,e):(f.removeData(b,d,!0),n(b,c,"mark"))}},queue:function(a,b,c){var d;if(a){b=(b||"fx")+"queue",d=f._data(a,b),c&&(!d||f.isArray(c)?d=f._data(a,b,f.makeArray(c)):d.push(c));return d||[]}},dequeue:function(a,b){b=b||"fx";var c=f.queue(a,b),d=c.shift(),e={};d==="inprogress"&&(d=c.shift()),d&&(b==="fx"&&c.unshift("inprogress"),f._data(a,b+".run",e),d.call(a,function(){f.dequeue(a,b)},e)),c.length||(f.removeData(a,b+"queue "+b+".run",!0),n(a,b,"queue"))}}),f.fn.extend({queue:function(a,c){typeof a!="string"&&(c=a,a="fx");if(c===b)return f.queue(this[0],a);return this.each(function(){var b=f.queue(this,a,c);a==="fx"&&b[0]!=="inprogress"&&f.dequeue(this,a)})},dequeue:function(a){return this.each(function(){f.dequeue(this,a)})},delay:function(a,b){a=f.fx?f.fx.speeds[a]||a:a,b=b||"fx";return this.queue(b,function(b,c){var d=setTimeout(b,a);c.stop=function(){clearTimeout(d)}})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,c){function m(){--h||d.resolveWith(e,[e])}typeof a!="string"&&(c=a,a=b),a=a||"fx";var d=f.Deferred(),e=this,g=e.length,h=1,i=a+"defer",j=a+"queue",k=a+"mark",l;while(g--)if(l=f.data(e[g],i,b,!0)||(f.data(e[g],j,b,!0)||f.data(e[g],k,b,!0))&&f.data(e[g],i,f.Callbacks("once memory"),!0))h++,l.add(m);m();return d.promise()}});var o=/[\n\t\r]/g,p=/\s+/,q=/\r/g,r=/^(?:button|input)$/i,s=/^(?:button|input|object|select|textarea)$/i,t=/^a(?:rea)?$/i,u=/^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,v=f.support.getSetAttribute,w,x,y;f.fn.extend({attr:function(a,b){return f.access(this,a,b,!0,f.attr)},removeAttr:function(a){return this.each(function(){f.removeAttr(this,a)})},prop:function(a,b){return f.access(this,a,b,!0,f.prop)},removeProp:function(a){a=f.propFix[a]||a;return this.each(function(){try{this[a]=b,delete this[a]}catch(c){}})},addClass:function(a){var b,c,d,e,g,h,i;if(f.isFunction(a))return this.each(function(b){f(this).addClass(a.call(this,b,this.className))});if(a&&typeof a=="string"){b=a.split(p);for(c=0,d=this.length;c<d;c++){e=this[c];if(e.nodeType===1)if(!e.className&&b.length===1)e.className=a;else{g=" "+e.className+" ";for(h=0,i=b.length;h<i;h++)~g.indexOf(" "+b[h]+" ")||(g+=b[h]+" ");e.className=f.trim(g)}}}return this},removeClass:function(a){var c,d,e,g,h,i,j;if(f.isFunction(a))return this.each(function(b){f(this).removeClass(a.call(this,b,this.className))});if(a&&typeof a=="string"||a===b){c=(a||"").split(p);for(d=0,e=this.length;d<e;d++){g=this[d];if(g.nodeType===1&&g.className)if(a){h=(" "+g.className+" ").replace(o," ");for(i=0,j=c.length;i<j;i++)h=h.replace(" "+c[i]+" "," ");g.className=f.trim(h)}else g.className=""}}return this},toggleClass:function(a,b){var c=typeof a,d=typeof b=="boolean";if(f.isFunction(a))return this.each(function(c){f(this).toggleClass(a.call(this,c,this.className,b),b)});return this.each(function(){if(c==="string"){var e,g=0,h=f(this),i=b,j=a.split(p);while(e=j[g++])i=d?i:!h.hasClass(e),h[i?"addClass":"removeClass"](e)}else if(c==="undefined"||c==="boolean")this.className&&f._data(this,"__className__",this.className),this.className=this.className||a===!1?"":f._data(this,"__className__")||""})},hasClass:function(a){var b=" "+a+" ",c=0,d=this.length;for(;c<d;c++)if(this[c].nodeType===1&&(" "+this[c].className+" ").replace(o," ").indexOf(b)>-1)return!0;return!1},val:function(a){var c,d,e,g=this[0];{if(!!arguments.length){e=f.isFunction(a);return this.each(function(d){var g=f(this),h;if(this.nodeType===1){e?h=a.call(this,d,g.val()):h=a,h==null?h="":typeof h=="number"?h+="":f.isArray(h)&&(h=f.map(h,function(a){return a==null?"":a+""})),c=f.valHooks[this.nodeName.toLowerCase()]||f.valHooks[this.type];if(!c||!("set"in c)||c.set(this,h,"value")===b)this.value=h}})}if(g){c=f.valHooks[g.nodeName.toLowerCase()]||f.valHooks[g.type];if(c&&"get"in c&&(d=c.get(g,"value"))!==b)return d;d=g.value;return typeof d=="string"?d.replace(q,""):d==null?"":d}}}}),f.extend({valHooks:{option:{get:function(a){var b=a.attributes.value;return!b||b.specified?a.value:a.text}},select:{get:function(a){var b,c,d,e,g=a.selectedIndex,h=[],i=a.options,j=a.type==="select-one";if(g<0)return null;c=j?g:0,d=j?g+1:i.length;for(;c<d;c++){e=i[c];if(e.selected&&(f.support.optDisabled?!e.disabled:e.getAttribute("disabled")===null)&&(!e.parentNode.disabled||!f.nodeName(e.parentNode,"optgroup"))){b=f(e).val();if(j)return b;h.push(b)}}if(j&&!h.length&&i.length)return f(i[g]).val();return h},set:function(a,b){var c=f.makeArray(b);f(a).find("option").each(function(){this.selected=f.inArray(f(this).val(),c)>=0}),c.length||(a.selectedIndex=-1);return c}}},attrFn:{val:!0,css:!0,html:!0,text:!0,data:!0,width:!0,height:!0,offset:!0},attr:function(a,c,d,e){var g,h,i,j=a.nodeType;if(!!a&&j!==3&&j!==8&&j!==2){if(e&&c in f.attrFn)return f(a)[c](d);if(typeof a.getAttribute=="undefined")return f.prop(a,c,d);i=j!==1||!f.isXMLDoc(a),i&&(c=c.toLowerCase(),h=f.attrHooks[c]||(u.test(c)?x:w));if(d!==b){if(d===null){f.removeAttr(a,c);return}if(h&&"set"in h&&i&&(g=h.set(a,d,c))!==b)return g;a.setAttribute(c,""+d);return d}if(h&&"get"in h&&i&&(g=h.get(a,c))!==null)return g;g=a.getAttribute(c);return g===null?b:g}},removeAttr:function(a,b){var c,d,e,g,h=0;if(b&&a.nodeType===1){d=b.toLowerCase().split(p),g=d.length;for(;h<g;h++)e=d[h],e&&(c=f.propFix[e]||e,f.attr(a,e,""),a.removeAttribute(v?e:c),u.test(e)&&c in a&&(a[c]=!1))}},attrHooks:{type:{set:function(a,b){if(r.test(a.nodeName)&&a.parentNode)f.error("type property can't be changed");else if(!f.support.radioValue&&b==="radio"&&f.nodeName(a,"input")){var c=a.value;a.setAttribute("type",b),c&&(a.value=c);return b}}},value:{get:function(a,b){if(w&&f.nodeName(a,"button"))return w.get(a,b);return b in a?a.value:null},set:function(a,b,c){if(w&&f.nodeName(a,"button"))return w.set(a,b,c);a.value=b}}},propFix:{tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder",contenteditable:"contentEditable"},prop:function(a,c,d){var e,g,h,i=a.nodeType;if(!!a&&i!==3&&i!==8&&i!==2){h=i!==1||!f.isXMLDoc(a),h&&(c=f.propFix[c]||c,g=f.propHooks[c]);return d!==b?g&&"set"in g&&(e=g.set(a,d,c))!==b?e:a[c]=d:g&&"get"in g&&(e=g.get(a,c))!==null?e:a[c]}},propHooks:{tabIndex:{get:function(a){var c=a.getAttributeNode("tabindex");return c&&c.specified?parseInt(c.value,10):s.test(a.nodeName)||t.test(a.nodeName)&&a.href?0:b}}}}),f.attrHooks.tabindex=f.propHooks.tabIndex,x={get:function(a,c){var d,e=f.prop(a,c);return e===!0||typeof e!="boolean"&&(d=a.getAttributeNode(c))&&d.nodeValue!==!1?c.toLowerCase():b},set:function(a,b,c){var d;b===!1?f.removeAttr(a,c):(d=f.propFix[c]||c,d in a&&(a[d]=!0),a.setAttribute(c,c.toLowerCase()));return c}},v||(y={name:!0,id:!0},w=f.valHooks.button={get:function(a,c){var d;d=a.getAttributeNode(c);return d&&(y[c]?d.nodeValue!=="":d.specified)?d.nodeValue:b},set:function(a,b,d){var e=a.getAttributeNode(d);e||(e=c.createAttribute(d),a.setAttributeNode(e));return e.nodeValue=b+""}},f.attrHooks.tabindex.set=w.set,f.each(["width","height"],function(a,b){f.attrHooks[b]=f.extend(f.attrHooks[b],{set:function(a,c){if(c===""){a.setAttribute(b,"auto");return c}}})}),f.attrHooks.contenteditable={get:w.get,set:function(a,b,c){b===""&&(b="false"),w.set(a,b,c)}}),f.support.hrefNormalized||f.each(["href","src","width","height"],function(a,c){f.attrHooks[c]=f.extend(f.attrHooks[c],{get:function(a){var d=a.getAttribute(c,2);return d===null?b:d}})}),f.support.style||(f.attrHooks.style={get:function(a){return a.style.cssText.toLowerCase()||b},set:function(a,b){return a.style.cssText=""+b}}),f.support.optSelected||(f.propHooks.selected=f.extend(f.propHooks.selected,{get:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex);return null}})),f.support.enctype||(f.propFix.enctype="encoding"),f.support.checkOn||f.each(["radio","checkbox"],function(){f.valHooks[this]={get:function(a){return a.getAttribute("value")===null?"on":a.value}}}),f.each(["radio","checkbox"],function(){f.valHooks[this]=f.extend(f.valHooks[this],{set:function(a,b){if(f.isArray(b))return a.checked=f.inArray(f(a).val(),b)>=0}})});var z=/^(?:textarea|input|select)$/i,A=/^([^\.]*)?(?:\.(.+))?$/,B=/\bhover(\.\S+)?\b/,C=/^key/,D=/^(?:mouse|contextmenu)|click/,E=/^(?:focusinfocus|focusoutblur)$/,F=/^(\w*)(?:#([\w\-]+))?(?:\.([\w\-]+))?$/,G=function(a){var b=F.exec(a);b&&(b[1]=(b[1]||"").toLowerCase(),b[3]=b[3]&&new RegExp("(?:^|\\s)"+b[3]+"(?:\\s|$)"));return b},H=function(a,b){var c=a.attributes||{};return(!b[1]||a.nodeName.toLowerCase()===b[1])&&(!b[2]||(c.id||{}).value===b[2])&&(!b[3]||b[3].test((c["class"]||{}).value))},I=function(a){return f.event.special.hover?a:a.replace(B,"mouseenter$1 mouseleave$1")};
f.event={add:function(a,c,d,e,g){var h,i,j,k,l,m,n,o,p,q,r,s;if(!(a.nodeType===3||a.nodeType===8||!c||!d||!(h=f._data(a)))){d.handler&&(p=d,d=p.handler),d.guid||(d.guid=f.guid++),j=h.events,j||(h.events=j={}),i=h.handle,i||(h.handle=i=function(a){return typeof f!="undefined"&&(!a||f.event.triggered!==a.type)?f.event.dispatch.apply(i.elem,arguments):b},i.elem=a),c=f.trim(I(c)).split(" ");for(k=0;k<c.length;k++){l=A.exec(c[k])||[],m=l[1],n=(l[2]||"").split(".").sort(),s=f.event.special[m]||{},m=(g?s.delegateType:s.bindType)||m,s=f.event.special[m]||{},o=f.extend({type:m,origType:l[1],data:e,handler:d,guid:d.guid,selector:g,quick:G(g),namespace:n.join(".")},p),r=j[m];if(!r){r=j[m]=[],r.delegateCount=0;if(!s.setup||s.setup.call(a,e,n,i)===!1)a.addEventListener?a.addEventListener(m,i,!1):a.attachEvent&&a.attachEvent("on"+m,i)}s.add&&(s.add.call(a,o),o.handler.guid||(o.handler.guid=d.guid)),g?r.splice(r.delegateCount++,0,o):r.push(o),f.event.global[m]=!0}a=null}},global:{},remove:function(a,b,c,d,e){var g=f.hasData(a)&&f._data(a),h,i,j,k,l,m,n,o,p,q,r,s;if(!!g&&!!(o=g.events)){b=f.trim(I(b||"")).split(" ");for(h=0;h<b.length;h++){i=A.exec(b[h])||[],j=k=i[1],l=i[2];if(!j){for(j in o)f.event.remove(a,j+b[h],c,d,!0);continue}p=f.event.special[j]||{},j=(d?p.delegateType:p.bindType)||j,r=o[j]||[],m=r.length,l=l?new RegExp("(^|\\.)"+l.split(".").sort().join("\\.(?:.*\\.)?")+"(\\.|$)"):null;for(n=0;n<r.length;n++)s=r[n],(e||k===s.origType)&&(!c||c.guid===s.guid)&&(!l||l.test(s.namespace))&&(!d||d===s.selector||d==="**"&&s.selector)&&(r.splice(n--,1),s.selector&&r.delegateCount--,p.remove&&p.remove.call(a,s));r.length===0&&m!==r.length&&((!p.teardown||p.teardown.call(a,l)===!1)&&f.removeEvent(a,j,g.handle),delete o[j])}f.isEmptyObject(o)&&(q=g.handle,q&&(q.elem=null),f.removeData(a,["events","handle"],!0))}},customEvent:{getData:!0,setData:!0,changeData:!0},trigger:function(c,d,e,g){if(!e||e.nodeType!==3&&e.nodeType!==8){var h=c.type||c,i=[],j,k,l,m,n,o,p,q,r,s;if(E.test(h+f.event.triggered))return;h.indexOf("!")>=0&&(h=h.slice(0,-1),k=!0),h.indexOf(".")>=0&&(i=h.split("."),h=i.shift(),i.sort());if((!e||f.event.customEvent[h])&&!f.event.global[h])return;c=typeof c=="object"?c[f.expando]?c:new f.Event(h,c):new f.Event(h),c.type=h,c.isTrigger=!0,c.exclusive=k,c.namespace=i.join("."),c.namespace_re=c.namespace?new RegExp("(^|\\.)"+i.join("\\.(?:.*\\.)?")+"(\\.|$)"):null,o=h.indexOf(":")<0?"on"+h:"";if(!e){j=f.cache;for(l in j)j[l].events&&j[l].events[h]&&f.event.trigger(c,d,j[l].handle.elem,!0);return}c.result=b,c.target||(c.target=e),d=d!=null?f.makeArray(d):[],d.unshift(c),p=f.event.special[h]||{};if(p.trigger&&p.trigger.apply(e,d)===!1)return;r=[[e,p.bindType||h]];if(!g&&!p.noBubble&&!f.isWindow(e)){s=p.delegateType||h,m=E.test(s+h)?e:e.parentNode,n=null;for(;m;m=m.parentNode)r.push([m,s]),n=m;n&&n===e.ownerDocument&&r.push([n.defaultView||n.parentWindow||a,s])}for(l=0;l<r.length&&!c.isPropagationStopped();l++)m=r[l][0],c.type=r[l][1],q=(f._data(m,"events")||{})[c.type]&&f._data(m,"handle"),q&&q.apply(m,d),q=o&&m[o],q&&f.acceptData(m)&&q.apply(m,d)===!1&&c.preventDefault();c.type=h,!g&&!c.isDefaultPrevented()&&(!p._default||p._default.apply(e.ownerDocument,d)===!1)&&(h!=="click"||!f.nodeName(e,"a"))&&f.acceptData(e)&&o&&e[h]&&(h!=="focus"&&h!=="blur"||c.target.offsetWidth!==0)&&!f.isWindow(e)&&(n=e[o],n&&(e[o]=null),f.event.triggered=h,e[h](),f.event.triggered=b,n&&(e[o]=n));return c.result}},dispatch:function(c){c=f.event.fix(c||a.event);var d=(f._data(this,"events")||{})[c.type]||[],e=d.delegateCount,g=[].slice.call(arguments,0),h=!c.exclusive&&!c.namespace,i=[],j,k,l,m,n,o,p,q,r,s,t;g[0]=c,c.delegateTarget=this;if(e&&!c.target.disabled&&(!c.button||c.type!=="click")){m=f(this),m.context=this.ownerDocument||this;for(l=c.target;l!=this;l=l.parentNode||this){o={},q=[],m[0]=l;for(j=0;j<e;j++)r=d[j],s=r.selector,o[s]===b&&(o[s]=r.quick?H(l,r.quick):m.is(s)),o[s]&&q.push(r);q.length&&i.push({elem:l,matches:q})}}d.length>e&&i.push({elem:this,matches:d.slice(e)});for(j=0;j<i.length&&!c.isPropagationStopped();j++){p=i[j],c.currentTarget=p.elem;for(k=0;k<p.matches.length&&!c.isImmediatePropagationStopped();k++){r=p.matches[k];if(h||!c.namespace&&!r.namespace||c.namespace_re&&c.namespace_re.test(r.namespace))c.data=r.data,c.handleObj=r,n=((f.event.special[r.origType]||{}).handle||r.handler).apply(p.elem,g),n!==b&&(c.result=n,n===!1&&(c.preventDefault(),c.stopPropagation()))}}return c.result},props:"attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(a,b){a.which==null&&(a.which=b.charCode!=null?b.charCode:b.keyCode);return a}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(a,d){var e,f,g,h=d.button,i=d.fromElement;a.pageX==null&&d.clientX!=null&&(e=a.target.ownerDocument||c,f=e.documentElement,g=e.body,a.pageX=d.clientX+(f&&f.scrollLeft||g&&g.scrollLeft||0)-(f&&f.clientLeft||g&&g.clientLeft||0),a.pageY=d.clientY+(f&&f.scrollTop||g&&g.scrollTop||0)-(f&&f.clientTop||g&&g.clientTop||0)),!a.relatedTarget&&i&&(a.relatedTarget=i===a.target?d.toElement:i),!a.which&&h!==b&&(a.which=h&1?1:h&2?3:h&4?2:0);return a}},fix:function(a){if(a[f.expando])return a;var d,e,g=a,h=f.event.fixHooks[a.type]||{},i=h.props?this.props.concat(h.props):this.props;a=f.Event(g);for(d=i.length;d;)e=i[--d],a[e]=g[e];a.target||(a.target=g.srcElement||c),a.target.nodeType===3&&(a.target=a.target.parentNode),a.metaKey===b&&(a.metaKey=a.ctrlKey);return h.filter?h.filter(a,g):a},special:{ready:{setup:f.bindReady},load:{noBubble:!0},focus:{delegateType:"focusin"},blur:{delegateType:"focusout"},beforeunload:{setup:function(a,b,c){f.isWindow(this)&&(this.onbeforeunload=c)},teardown:function(a,b){this.onbeforeunload===b&&(this.onbeforeunload=null)}}},simulate:function(a,b,c,d){var e=f.extend(new f.Event,c,{type:a,isSimulated:!0,originalEvent:{}});d?f.event.trigger(e,null,b):f.event.dispatch.call(b,e),e.isDefaultPrevented()&&c.preventDefault()}},f.event.handle=f.event.dispatch,f.removeEvent=c.removeEventListener?function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c,!1)}:function(a,b,c){a.detachEvent&&a.detachEvent("on"+b,c)},f.Event=function(a,b){if(!(this instanceof f.Event))return new f.Event(a,b);a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||a.returnValue===!1||a.getPreventDefault&&a.getPreventDefault()?K:J):this.type=a,b&&f.extend(this,b),this.timeStamp=a&&a.timeStamp||f.now(),this[f.expando]=!0},f.Event.prototype={preventDefault:function(){this.isDefaultPrevented=K;var a=this.originalEvent;!a||(a.preventDefault?a.preventDefault():a.returnValue=!1)},stopPropagation:function(){this.isPropagationStopped=K;var a=this.originalEvent;!a||(a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=K,this.stopPropagation()},isDefaultPrevented:J,isPropagationStopped:J,isImmediatePropagationStopped:J},f.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){f.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c=this,d=a.relatedTarget,e=a.handleObj,g=e.selector,h;if(!d||d!==c&&!f.contains(c,d))a.type=e.origType,h=e.handler.apply(this,arguments),a.type=b;return h}}}),f.support.submitBubbles||(f.event.special.submit={setup:function(){if(f.nodeName(this,"form"))return!1;f.event.add(this,"click._submit keypress._submit",function(a){var c=a.target,d=f.nodeName(c,"input")||f.nodeName(c,"button")?c.form:b;d&&!d._submit_attached&&(f.event.add(d,"submit._submit",function(a){this.parentNode&&!a.isTrigger&&f.event.simulate("submit",this.parentNode,a,!0)}),d._submit_attached=!0)})},teardown:function(){if(f.nodeName(this,"form"))return!1;f.event.remove(this,"._submit")}}),f.support.changeBubbles||(f.event.special.change={setup:function(){if(z.test(this.nodeName)){if(this.type==="checkbox"||this.type==="radio")f.event.add(this,"propertychange._change",function(a){a.originalEvent.propertyName==="checked"&&(this._just_changed=!0)}),f.event.add(this,"click._change",function(a){this._just_changed&&!a.isTrigger&&(this._just_changed=!1,f.event.simulate("change",this,a,!0))});return!1}f.event.add(this,"beforeactivate._change",function(a){var b=a.target;z.test(b.nodeName)&&!b._change_attached&&(f.event.add(b,"change._change",function(a){this.parentNode&&!a.isSimulated&&!a.isTrigger&&f.event.simulate("change",this.parentNode,a,!0)}),b._change_attached=!0)})},handle:function(a){var b=a.target;if(this!==b||a.isSimulated||a.isTrigger||b.type!=="radio"&&b.type!=="checkbox")return a.handleObj.handler.apply(this,arguments)},teardown:function(){f.event.remove(this,"._change");return z.test(this.nodeName)}}),f.support.focusinBubbles||f.each({focus:"focusin",blur:"focusout"},function(a,b){var d=0,e=function(a){f.event.simulate(b,a.target,f.event.fix(a),!0)};f.event.special[b]={setup:function(){d++===0&&c.addEventListener(a,e,!0)},teardown:function(){--d===0&&c.removeEventListener(a,e,!0)}}}),f.fn.extend({on:function(a,c,d,e,g){var h,i;if(typeof a=="object"){typeof c!="string"&&(d=c,c=b);for(i in a)this.on(i,c,d,a[i],g);return this}d==null&&e==null?(e=c,d=c=b):e==null&&(typeof c=="string"?(e=d,d=b):(e=d,d=c,c=b));if(e===!1)e=J;else if(!e)return this;g===1&&(h=e,e=function(a){f().off(a);return h.apply(this,arguments)},e.guid=h.guid||(h.guid=f.guid++));return this.each(function(){f.event.add(this,a,e,d,c)})},one:function(a,b,c,d){return this.on.call(this,a,b,c,d,1)},off:function(a,c,d){if(a&&a.preventDefault&&a.handleObj){var e=a.handleObj;f(a.delegateTarget).off(e.namespace?e.type+"."+e.namespace:e.type,e.selector,e.handler);return this}if(typeof a=="object"){for(var g in a)this.off(g,c,a[g]);return this}if(c===!1||typeof c=="function")d=c,c=b;d===!1&&(d=J);return this.each(function(){f.event.remove(this,a,d,c)})},bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},live:function(a,b,c){f(this.context).on(a,this.selector,b,c);return this},die:function(a,b){f(this.context).off(a,this.selector||"**",b);return this},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return arguments.length==1?this.off(a,"**"):this.off(b,a,c)},trigger:function(a,b){return this.each(function(){f.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0])return f.event.trigger(a,b,this[0],!0)},toggle:function(a){var b=arguments,c=a.guid||f.guid++,d=0,e=function(c){var e=(f._data(this,"lastToggle"+a.guid)||0)%d;f._data(this,"lastToggle"+a.guid,e+1),c.preventDefault();return b[e].apply(this,arguments)||!1};e.guid=c;while(d<b.length)b[d++].guid=c;return this.click(e)},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}}),f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(a,b){f.fn[b]=function(a,c){c==null&&(c=a,a=null);return arguments.length>0?this.on(b,null,a,c):this.trigger(b)},f.attrFn&&(f.attrFn[b]=!0),C.test(b)&&(f.event.fixHooks[b]=f.event.keyHooks),D.test(b)&&(f.event.fixHooks[b]=f.event.mouseHooks)}),function(){function x(a,b,c,e,f,g){for(var h=0,i=e.length;h<i;h++){var j=e[h];if(j){var k=!1;j=j[a];while(j){if(j[d]===c){k=e[j.sizset];break}if(j.nodeType===1){g||(j[d]=c,j.sizset=h);if(typeof b!="string"){if(j===b){k=!0;break}}else if(m.filter(b,[j]).length>0){k=j;break}}j=j[a]}e[h]=k}}}function w(a,b,c,e,f,g){for(var h=0,i=e.length;h<i;h++){var j=e[h];if(j){var k=!1;j=j[a];while(j){if(j[d]===c){k=e[j.sizset];break}j.nodeType===1&&!g&&(j[d]=c,j.sizset=h);if(j.nodeName.toLowerCase()===b){k=j;break}j=j[a]}e[h]=k}}}var a=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,d="sizcache"+(Math.random()+"").replace(".",""),e=0,g=Object.prototype.toString,h=!1,i=!0,j=/\\/g,k=/\r\n/g,l=/\W/;[0,0].sort(function(){i=!1;return 0});var m=function(b,d,e,f){e=e||[],d=d||c;var h=d;if(d.nodeType!==1&&d.nodeType!==9)return[];if(!b||typeof b!="string")return e;var i,j,k,l,n,q,r,t,u=!0,v=m.isXML(d),w=[],x=b;do{a.exec(""),i=a.exec(x);if(i){x=i[3],w.push(i[1]);if(i[2]){l=i[3];break}}}while(i);if(w.length>1&&p.exec(b))if(w.length===2&&o.relative[w[0]])j=y(w[0]+w[1],d,f);else{j=o.relative[w[0]]?[d]:m(w.shift(),d);while(w.length)b=w.shift(),o.relative[b]&&(b+=w.shift()),j=y(b,j,f)}else{!f&&w.length>1&&d.nodeType===9&&!v&&o.match.ID.test(w[0])&&!o.match.ID.test(w[w.length-1])&&(n=m.find(w.shift(),d,v),d=n.expr?m.filter(n.expr,n.set)[0]:n.set[0]);if(d){n=f?{expr:w.pop(),set:s(f)}:m.find(w.pop(),w.length===1&&(w[0]==="~"||w[0]==="+")&&d.parentNode?d.parentNode:d,v),j=n.expr?m.filter(n.expr,n.set):n.set,w.length>0?k=s(j):u=!1;while(w.length)q=w.pop(),r=q,o.relative[q]?r=w.pop():q="",r==null&&(r=d),o.relative[q](k,r,v)}else k=w=[]}k||(k=j),k||m.error(q||b);if(g.call(k)==="[object Array]")if(!u)e.push.apply(e,k);else if(d&&d.nodeType===1)for(t=0;k[t]!=null;t++)k[t]&&(k[t]===!0||k[t].nodeType===1&&m.contains(d,k[t]))&&e.push(j[t]);else for(t=0;k[t]!=null;t++)k[t]&&k[t].nodeType===1&&e.push(j[t]);else s(k,e);l&&(m(l,h,e,f),m.uniqueSort(e));return e};m.uniqueSort=function(a){if(u){h=i,a.sort(u);if(h)for(var b=1;b<a.length;b++)a[b]===a[b-1]&&a.splice(b--,1)}return a},m.matches=function(a,b){return m(a,null,null,b)},m.matchesSelector=function(a,b){return m(b,null,null,[a]).length>0},m.find=function(a,b,c){var d,e,f,g,h,i;if(!a)return[];for(e=0,f=o.order.length;e<f;e++){h=o.order[e];if(g=o.leftMatch[h].exec(a)){i=g[1],g.splice(1,1);if(i.substr(i.length-1)!=="\\"){g[1]=(g[1]||"").replace(j,""),d=o.find[h](g,b,c);if(d!=null){a=a.replace(o.match[h],"");break}}}}d||(d=typeof b.getElementsByTagName!="undefined"?b.getElementsByTagName("*"):[]);return{set:d,expr:a}},m.filter=function(a,c,d,e){var f,g,h,i,j,k,l,n,p,q=a,r=[],s=c,t=c&&c[0]&&m.isXML(c[0]);while(a&&c.length){for(h in o.filter)if((f=o.leftMatch[h].exec(a))!=null&&f[2]){k=o.filter[h],l=f[1],g=!1,f.splice(1,1);if(l.substr(l.length-1)==="\\")continue;s===r&&(r=[]);if(o.preFilter[h]){f=o.preFilter[h](f,s,d,r,e,t);if(!f)g=i=!0;else if(f===!0)continue}if(f)for(n=0;(j=s[n])!=null;n++)j&&(i=k(j,f,n,s),p=e^i,d&&i!=null?p?g=!0:s[n]=!1:p&&(r.push(j),g=!0));if(i!==b){d||(s=r),a=a.replace(o.match[h],"");if(!g)return[];break}}if(a===q)if(g==null)m.error(a);else break;q=a}return s},m.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)};var n=m.getText=function(a){var b,c,d=a.nodeType,e="";if(d){if(d===1||d===9){if(typeof a.textContent=="string")return a.textContent;if(typeof a.innerText=="string")return a.innerText.replace(k,"");for(a=a.firstChild;a;a=a.nextSibling)e+=n(a)}else if(d===3||d===4)return a.nodeValue}else for(b=0;c=a[b];b++)c.nodeType!==8&&(e+=n(c));return e},o=m.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(a){return a.getAttribute("href")},type:function(a){return a.getAttribute("type")}},relative:{"+":function(a,b){var c=typeof b=="string",d=c&&!l.test(b),e=c&&!d;d&&(b=b.toLowerCase());for(var f=0,g=a.length,h;f<g;f++)if(h=a[f]){while((h=h.previousSibling)&&h.nodeType!==1);a[f]=e||h&&h.nodeName.toLowerCase()===b?h||!1:h===b}e&&m.filter(b,a,!0)},">":function(a,b){var c,d=typeof b=="string",e=0,f=a.length;if(d&&!l.test(b)){b=b.toLowerCase();for(;e<f;e++){c=a[e];if(c){var g=c.parentNode;a[e]=g.nodeName.toLowerCase()===b?g:!1}}}else{for(;e<f;e++)c=a[e],c&&(a[e]=d?c.parentNode:c.parentNode===b);d&&m.filter(b,a,!0)}},"":function(a,b,c){var d,f=e++,g=x;typeof b=="string"&&!l.test(b)&&(b=b.toLowerCase(),d=b,g=w),g("parentNode",b,f,a,d,c)},"~":function(a,b,c){var d,f=e++,g=x;typeof b=="string"&&!l.test(b)&&(b=b.toLowerCase(),d=b,g=w),g("previousSibling",b,f,a,d,c)}},find:{ID:function(a,b,c){if(typeof b.getElementById!="undefined"&&!c){var d=b.getElementById(a[1]);return d&&d.parentNode?[d]:[]}},NAME:function(a,b){if(typeof b.getElementsByName!="undefined"){var c=[],d=b.getElementsByName(a[1]);for(var e=0,f=d.length;e<f;e++)d[e].getAttribute("name")===a[1]&&c.push(d[e]);return c.length===0?null:c}},TAG:function(a,b){if(typeof b.getElementsByTagName!="undefined")return b.getElementsByTagName(a[1])}},preFilter:{CLASS:function(a,b,c,d,e,f){a=" "+a[1].replace(j,"")+" ";if(f)return a;for(var g=0,h;(h=b[g])!=null;g++)h&&(e^(h.className&&(" "+h.className+" ").replace(/[\t\n\r]/g," ").indexOf(a)>=0)?c||d.push(h):c&&(b[g]=!1));return!1},ID:function(a){return a[1].replace(j,"")},TAG:function(a,b){return a[1].replace(j,"").toLowerCase()},CHILD:function(a){if(a[1]==="nth"){a[2]||m.error(a[0]),a[2]=a[2].replace(/^\+|\s*/g,"");var b=/(-?)(\d*)(?:n([+\-]?\d*))?/.exec(a[2]==="even"&&"2n"||a[2]==="odd"&&"2n+1"||!/\D/.test(a[2])&&"0n+"+a[2]||a[2]);a[2]=b[1]+(b[2]||1)-0,a[3]=b[3]-0}else a[2]&&m.error(a[0]);a[0]=e++;return a},ATTR:function(a,b,c,d,e,f){var g=a[1]=a[1].replace(j,"");!f&&o.attrMap[g]&&(a[1]=o.attrMap[g]),a[4]=(a[4]||a[5]||"").replace(j,""),a[2]==="~="&&(a[4]=" "+a[4]+" ");return a},PSEUDO:function(b,c,d,e,f){if(b[1]==="not")if((a.exec(b[3])||"").length>1||/^\w/.test(b[3]))b[3]=m(b[3],null,null,c);else{var g=m.filter(b[3],c,d,!0^f);d||e.push.apply(e,g);return!1}else if(o.match.POS.test(b[0])||o.match.CHILD.test(b[0]))return!0;return b},POS:function(a){a.unshift(!0);return a}},filters:{enabled:function(a){return a.disabled===!1&&a.type!=="hidden"},disabled:function(a){return a.disabled===!0},checked:function(a){return a.checked===!0},selected:function(a){a.parentNode&&a.parentNode.selectedIndex;return a.selected===!0},parent:function(a){return!!a.firstChild},empty:function(a){return!a.firstChild},has:function(a,b,c){return!!m(c[3],a).length},header:function(a){return/h\d/i.test(a.nodeName)},text:function(a){var b=a.getAttribute("type"),c=a.type;return a.nodeName.toLowerCase()==="input"&&"text"===c&&(b===c||b===null)},radio:function(a){return a.nodeName.toLowerCase()==="input"&&"radio"===a.type},checkbox:function(a){return a.nodeName.toLowerCase()==="input"&&"checkbox"===a.type},file:function(a){return a.nodeName.toLowerCase()==="input"&&"file"===a.type},password:function(a){return a.nodeName.toLowerCase()==="input"&&"password"===a.type},submit:function(a){var b=a.nodeName.toLowerCase();return(b==="input"||b==="button")&&"submit"===a.type},image:function(a){return a.nodeName.toLowerCase()==="input"&&"image"===a.type},reset:function(a){var b=a.nodeName.toLowerCase();return(b==="input"||b==="button")&&"reset"===a.type},button:function(a){var b=a.nodeName.toLowerCase();return b==="input"&&"button"===a.type||b==="button"},input:function(a){return/input|select|textarea|button/i.test(a.nodeName)},focus:function(a){return a===a.ownerDocument.activeElement}},setFilters:{first:function(a,b){return b===0},last:function(a,b,c,d){return b===d.length-1},even:function(a,b){return b%2===0},odd:function(a,b){return b%2===1},lt:function(a,b,c){return b<c[3]-0},gt:function(a,b,c){return b>c[3]-0},nth:function(a,b,c){return c[3]-0===b},eq:function(a,b,c){return c[3]-0===b}},filter:{PSEUDO:function(a,b,c,d){var e=b[1],f=o.filters[e];if(f)return f(a,c,b,d);if(e==="contains")return(a.textContent||a.innerText||n([a])||"").indexOf(b[3])>=0;if(e==="not"){var g=b[3];for(var h=0,i=g.length;h<i;h++)if(g[h]===a)return!1;return!0}m.error(e)},CHILD:function(a,b){var c,e,f,g,h,i,j,k=b[1],l=a;switch(k){case"only":case"first":while(l=l.previousSibling)if(l.nodeType===1)return!1;if(k==="first")return!0;l=a;case"last":while(l=l.nextSibling)if(l.nodeType===1)return!1;return!0;case"nth":c=b[2],e=b[3];if(c===1&&e===0)return!0;f=b[0],g=a.parentNode;if(g&&(g[d]!==f||!a.nodeIndex)){i=0;for(l=g.firstChild;l;l=l.nextSibling)l.nodeType===1&&(l.nodeIndex=++i);g[d]=f}j=a.nodeIndex-e;return c===0?j===0:j%c===0&&j/c>=0}},ID:function(a,b){return a.nodeType===1&&a.getAttribute("id")===b},TAG:function(a,b){return b==="*"&&a.nodeType===1||!!a.nodeName&&a.nodeName.toLowerCase()===b},CLASS:function(a,b){return(" "+(a.className||a.getAttribute("class"))+" ").indexOf(b)>-1},ATTR:function(a,b){var c=b[1],d=m.attr?m.attr(a,c):o.attrHandle[c]?o.attrHandle[c](a):a[c]!=null?a[c]:a.getAttribute(c),e=d+"",f=b[2],g=b[4];return d==null?f==="!=":!f&&m.attr?d!=null:f==="="?e===g:f==="*="?e.indexOf(g)>=0:f==="~="?(" "+e+" ").indexOf(g)>=0:g?f==="!="?e!==g:f==="^="?e.indexOf(g)===0:f==="$="?e.substr(e.length-g.length)===g:f==="|="?e===g||e.substr(0,g.length+1)===g+"-":!1:e&&d!==!1},POS:function(a,b,c,d){var e=b[2],f=o.setFilters[e];if(f)return f(a,c,b,d)}}},p=o.match.POS,q=function(a,b){return"\\"+(b-0+1)};for(var r in o.match)o.match[r]=new RegExp(o.match[r].source+/(?![^\[]*\])(?![^\(]*\))/.source),o.leftMatch[r]=new RegExp(/(^(?:.|\r|\n)*?)/.source+o.match[r].source.replace(/\\(\d+)/g,q));var s=function(a,b){a=Array.prototype.slice.call(a,0);if(b){b.push.apply(b,a);return b}return a};try{Array.prototype.slice.call(c.documentElement.childNodes,0)[0].nodeType}catch(t){s=function(a,b){var c=0,d=b||[];if(g.call(a)==="[object Array]")Array.prototype.push.apply(d,a);else if(typeof a.length=="number")for(var e=a.length;c<e;c++)d.push(a[c]);else for(;a[c];c++)d.push(a[c]);return d}}var u,v;c.documentElement.compareDocumentPosition?u=function(a,b){if(a===b){h=!0;return 0}if(!a.compareDocumentPosition||!b.compareDocumentPosition)return a.compareDocumentPosition?-1:1;return a.compareDocumentPosition(b)&4?-1:1}:(u=function(a,b){if(a===b){h=!0;return 0}if(a.sourceIndex&&b.sourceIndex)return a.sourceIndex-b.sourceIndex;var c,d,e=[],f=[],g=a.parentNode,i=b.parentNode,j=g;if(g===i)return v(a,b);if(!g)return-1;if(!i)return 1;while(j)e.unshift(j),j=j.parentNode;j=i;while(j)f.unshift(j),j=j.parentNode;c=e.length,d=f.length;for(var k=0;k<c&&k<d;k++)if(e[k]!==f[k])return v(e[k],f[k]);return k===c?v(a,f[k],-1):v(e[k],b,1)},v=function(a,b,c){if(a===b)return c;var d=a.nextSibling;while(d){if(d===b)return-1;d=d.nextSibling}return 1}),function(){var a=c.createElement("div"),d="script"+(new Date).getTime(),e=c.documentElement;a.innerHTML="<a name='"+d+"'/>",e.insertBefore(a,e.firstChild),c.getElementById(d)&&(o.find.ID=function(a,c,d){if(typeof c.getElementById!="undefined"&&!d){var e=c.getElementById(a[1]);return e?e.id===a[1]||typeof e.getAttributeNode!="undefined"&&e.getAttributeNode("id").nodeValue===a[1]?[e]:b:[]}},o.filter.ID=function(a,b){var c=typeof a.getAttributeNode!="undefined"&&a.getAttributeNode("id");return a.nodeType===1&&c&&c.nodeValue===b}),e.removeChild(a),e=a=null}(),function(){var a=c.createElement("div");a.appendChild(c.createComment("")),a.getElementsByTagName("*").length>0&&(o.find.TAG=function(a,b){var c=b.getElementsByTagName(a[1]);if(a[1]==="*"){var d=[];for(var e=0;c[e];e++)c[e].nodeType===1&&d.push(c[e]);c=d}return c}),a.innerHTML="<a href='#'></a>",a.firstChild&&typeof a.firstChild.getAttribute!="undefined"&&a.firstChild.getAttribute("href")!=="#"&&(o.attrHandle.href=function(a){return a.getAttribute("href",2)}),a=null}(),c.querySelectorAll&&function(){var a=m,b=c.createElement("div"),d="__sizzle__";b.innerHTML="<p class='TEST'></p>";if(!b.querySelectorAll||b.querySelectorAll(".TEST").length!==0){m=function(b,e,f,g){e=e||c;if(!g&&!m.isXML(e)){var h=/^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec(b);if(h&&(e.nodeType===1||e.nodeType===9)){if(h[1])return s(e.getElementsByTagName(b),f);if(h[2]&&o.find.CLASS&&e.getElementsByClassName)return s(e.getElementsByClassName(h[2]),f)}if(e.nodeType===9){if(b==="body"&&e.body)return s([e.body],f);if(h&&h[3]){var i=e.getElementById(h[3]);if(!i||!i.parentNode)return s([],f);if(i.id===h[3])return s([i],f)}try{return s(e.querySelectorAll(b),f)}catch(j){}}else if(e.nodeType===1&&e.nodeName.toLowerCase()!=="object"){var k=e,l=e.getAttribute("id"),n=l||d,p=e.parentNode,q=/^\s*[+~]/.test(b);l?n=n.replace(/'/g,"\\$&"):e.setAttribute("id",n),q&&p&&(e=e.parentNode);try{if(!q||p)return s(e.querySelectorAll("[id='"+n+"'] "+b),f)}catch(r){}finally{l||k.removeAttribute("id")}}}return a(b,e,f,g)};for(var e in a)m[e]=a[e];b=null}}(),function(){var a=c.documentElement,b=a.matchesSelector||a.mozMatchesSelector||a.webkitMatchesSelector||a.msMatchesSelector;if(b){var d=!b.call(c.createElement("div"),"div"),e=!1;try{b.call(c.documentElement,"[test!='']:sizzle")}catch(f){e=!0}m.matchesSelector=function(a,c){c=c.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!m.isXML(a))try{if(e||!o.match.PSEUDO.test(c)&&!/!=/.test(c)){var f=b.call(a,c);if(f||!d||a.document&&a.document.nodeType!==11)return f}}catch(g){}return m(c,null,null,[a]).length>0}}}(),function(){var a=c.createElement("div");a.innerHTML="<div class='test e'></div><div class='test'></div>";if(!!a.getElementsByClassName&&a.getElementsByClassName("e").length!==0){a.lastChild.className="e";if(a.getElementsByClassName("e").length===1)return;o.order.splice(1,0,"CLASS"),o.find.CLASS=function(a,b,c){if(typeof b.getElementsByClassName!="undefined"&&!c)return b.getElementsByClassName(a[1])},a=null}}(),c.documentElement.contains?m.contains=function(a,b){return a!==b&&(a.contains?a.contains(b):!0)}:c.documentElement.compareDocumentPosition?m.contains=function(a,b){return!!(a.compareDocumentPosition(b)&16)}:m.contains=function(){return!1},m.isXML=function(a){var b=(a?a.ownerDocument||a:0).documentElement;return b?b.nodeName!=="HTML":!1};var y=function(a,b,c){var d,e=[],f="",g=b.nodeType?[b]:b;while(d=o.match.PSEUDO.exec(a))f+=d[0],a=a.replace(o.match.PSEUDO,"");a=o.relative[a]?a+"*":a;for(var h=0,i=g.length;h<i;h++)m(a,g[h],e,c);return m.filter(f,e)};m.attr=f.attr,m.selectors.attrMap={},f.find=m,f.expr=m.selectors,f.expr[":"]=f.expr.filters,f.unique=m.uniqueSort,f.text=m.getText,f.isXMLDoc=m.isXML,f.contains=m.contains}();var L=/Until$/,M=/^(?:parents|prevUntil|prevAll)/,N=/,/,O=/^.[^:#\[\.,]*$/,P=Array.prototype.slice,Q=f.expr.match.POS,R={children:!0,contents:!0,next:!0,prev:!0};f.fn.extend({find:function(a){var b=this,c,d;if(typeof a!="string")return f(a).filter(function(){for(c=0,d=b.length;c<d;c++)if(f.contains(b[c],this))return!0});var e=this.pushStack("","find",a),g,h,i;for(c=0,d=this.length;c<d;c++){g=e.length,f.find(a,this[c],e);if(c>0)for(h=g;h<e.length;h++)for(i=0;i<g;i++)if(e[i]===e[h]){e.splice(h--,1);break}}return e},has:function(a){var b=f(a);return this.filter(function(){for(var a=0,c=b.length;a<c;a++)if(f.contains(this,b[a]))return!0})},not:function(a){return this.pushStack(T(this,a,!1),"not",a)},filter:function(a){return this.pushStack(T(this,a,!0),"filter",a)},is:function(a){return!!a&&(typeof a=="string"?Q.test(a)?f(a,this.context).index(this[0])>=0:f.filter(a,this).length>0:this.filter(a).length>0)},closest:function(a,b){var c=[],d,e,g=this[0];if(f.isArray(a)){var h=1;while(g&&g.ownerDocument&&g!==b){for(d=0;d<a.length;d++)f(g).is(a[d])&&c.push({selector:a[d],elem:g,level:h});g=g.parentNode,h++}return c}var i=Q.test(a)||typeof a!="string"?f(a,b||this.context):0;for(d=0,e=this.length;d<e;d++){g=this[d];while(g){if(i?i.index(g)>-1:f.find.matchesSelector(g,a)){c.push(g);break}g=g.parentNode;if(!g||!g.ownerDocument||g===b||g.nodeType===11)break}}c=c.length>1?f.unique(c):c;return this.pushStack(c,"closest",a)},index:function(a){if(!a)return this[0]&&this[0].parentNode?this.prevAll().length:-1;if(typeof a=="string")return f.inArray(this[0],f(a));return f.inArray(a.jquery?a[0]:a,this)},add:function(a,b){var c=typeof a=="string"?f(a,b):f.makeArray(a&&a.nodeType?[a]:a),d=f.merge(this.get(),c);return this.pushStack(S(c[0])||S(d[0])?d:f.unique(d))},andSelf:function(){return this.add(this.prevObject)}}),f.each({parent:function(a){var b=a.parentNode;return b&&b.nodeType!==11?b:null},parents:function(a){return f.dir(a,"parentNode")},parentsUntil:function(a,b,c){return f.dir(a,"parentNode",c)},next:function(a){return f.nth(a,2,"nextSibling")},prev:function(a){return f.nth(a,2,"previousSibling")},nextAll:function(a){return f.dir(a,"nextSibling")},prevAll:function(a){return f.dir(a,"previousSibling")},nextUntil:function(a,b,c){return f.dir(a,"nextSibling",c)},prevUntil:function(a,b,c){return f.dir(a,"previousSibling",c)},siblings:function(a){return f.sibling(a.parentNode.firstChild,a)},children:function(a){return f.sibling(a.firstChild)},contents:function(a){return f.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:f.makeArray(a.childNodes)}},function(a,b){f.fn[a]=function(c,d){var e=f.map(this,b,c);L.test(a)||(d=c),d&&typeof d=="string"&&(e=f.filter(d,e)),e=this.length>1&&!R[a]?f.unique(e):e,(this.length>1||N.test(d))&&M.test(a)&&(e=e.reverse());return this.pushStack(e,a,P.call(arguments).join(","))}}),f.extend({filter:function(a,b,c){c&&(a=":not("+a+")");return b.length===1?f.find.matchesSelector(b[0],a)?[b[0]]:[]:f.find.matches(a,b)},dir:function(a,c,d){var e=[],g=a[c];while(g&&g.nodeType!==9&&(d===b||g.nodeType!==1||!f(g).is(d)))g.nodeType===1&&e.push(g),g=g[c];return e},nth:function(a,b,c,d){b=b||1;var e=0;for(;a;a=a[c])if(a.nodeType===1&&++e===b)break;return a},sibling:function(a,b){var c=[];for(;a;a=a.nextSibling)a.nodeType===1&&a!==b&&c.push(a);return c}});var V="abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",W=/ jQuery\d+="(?:\d+|null)"/g,X=/^\s+/,Y=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,Z=/<([\w:]+)/,$=/<tbody/i,_=/<|&#?\w+;/,ba=/<(?:script|style)/i,bb=/<(?:script|object|embed|option|style)/i,bc=new RegExp("<(?:"+V+")","i"),bd=/checked\s*(?:[^=]|=\s*.checked.)/i,be=/\/(java|ecma)script/i,bf=/^\s*<!(?:\[CDATA\[|\-\-)/,bg={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]},bh=U(c);bg.optgroup=bg.option,bg.tbody=bg.tfoot=bg.colgroup=bg.caption=bg.thead,bg.th=bg.td,f.support.htmlSerialize||(bg._default=[1,"div<div>","</div>"]),f.fn.extend({text:function(a){if(f.isFunction(a))return this.each(function(b){var c=f(this);c.text(a.call(this,b,c.text()))});if(typeof a!="object"&&a!==b)return this.empty().append((this[0]&&this[0].ownerDocument||c).createTextNode(a));return f.text(this)},wrapAll:function(a){if(f.isFunction(a))return this.each(function(b){f(this).wrapAll(a.call(this,b))});if(this[0]){var b=f(a,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstChild&&a.firstChild.nodeType===1)a=a.firstChild;return a}).append(this)}return this},wrapInner:function(a){if(f.isFunction(a))return this.each(function(b){f(this).wrapInner(a.call(this,b))});return this.each(function(){var b=f(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=f.isFunction(a);return this.each(function(c){f(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(){return this.parent().each(function(){f.nodeName(this,"body")||f(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,!0,function(a){this.nodeType===1&&this.appendChild(a)})},prepend:function(){return this.domManip(arguments,!0,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,!1,function(a){this.parentNode.insertBefore(a,this)});if(arguments.length){var a=f.clean(arguments);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,!1,function(a){this.parentNode.insertBefore(a,this.nextSibling)});if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,f.clean(arguments));return a}},remove:function(a,b){for(var c=0,d;(d=this[c])!=null;c++)if(!a||f.filter(a,[d]).length)!b&&d.nodeType===1&&(f.cleanData(d.getElementsByTagName("*")),f.cleanData([d])),d.parentNode&&d.parentNode.removeChild(d);return this},empty:function()
{for(var a=0,b;(b=this[a])!=null;a++){b.nodeType===1&&f.cleanData(b.getElementsByTagName("*"));while(b.firstChild)b.removeChild(b.firstChild)}return this},clone:function(a,b){a=a==null?!1:a,b=b==null?a:b;return this.map(function(){return f.clone(this,a,b)})},html:function(a){if(a===b)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(W,""):null;if(typeof a=="string"&&!ba.test(a)&&(f.support.leadingWhitespace||!X.test(a))&&!bg[(Z.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Y,"<$1></$2>");try{for(var c=0,d=this.length;c<d;c++)this[c].nodeType===1&&(f.cleanData(this[c].getElementsByTagName("*")),this[c].innerHTML=a)}catch(e){this.empty().append(a)}}else f.isFunction(a)?this.each(function(b){var c=f(this);c.html(a.call(this,b,c.html()))}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&this[0].parentNode){if(f.isFunction(a))return this.each(function(b){var c=f(this),d=c.html();c.replaceWith(a.call(this,b,d))});typeof a!="string"&&(a=f(a).detach());return this.each(function(){var b=this.nextSibling,c=this.parentNode;f(this).remove(),b?f(b).before(a):f(c).append(a)})}return this.length?this.pushStack(f(f.isFunction(a)?a():a),"replaceWith",a):this},detach:function(a){return this.remove(a,!0)},domManip:function(a,c,d){var e,g,h,i,j=a[0],k=[];if(!f.support.checkClone&&arguments.length===3&&typeof j=="string"&&bd.test(j))return this.each(function(){f(this).domManip(a,c,d,!0)});if(f.isFunction(j))return this.each(function(e){var g=f(this);a[0]=j.call(this,e,c?g.html():b),g.domManip(a,c,d)});if(this[0]){i=j&&j.parentNode,f.support.parentNode&&i&&i.nodeType===11&&i.childNodes.length===this.length?e={fragment:i}:e=f.buildFragment(a,this,k),h=e.fragment,h.childNodes.length===1?g=h=h.firstChild:g=h.firstChild;if(g){c=c&&f.nodeName(g,"tr");for(var l=0,m=this.length,n=m-1;l<m;l++)d.call(c?bi(this[l],g):this[l],e.cacheable||m>1&&l<n?f.clone(h,!0,!0):h)}k.length&&f.each(k,bp)}return this}}),f.buildFragment=function(a,b,d){var e,g,h,i,j=a[0];b&&b[0]&&(i=b[0].ownerDocument||b[0]),i.createDocumentFragment||(i=c),a.length===1&&typeof j=="string"&&j.length<512&&i===c&&j.charAt(0)==="<"&&!bb.test(j)&&(f.support.checkClone||!bd.test(j))&&(f.support.html5Clone||!bc.test(j))&&(g=!0,h=f.fragments[j],h&&h!==1&&(e=h)),e||(e=i.createDocumentFragment(),f.clean(a,i,e,d)),g&&(f.fragments[j]=h?e:1);return{fragment:e,cacheable:g}},f.fragments={},f.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){f.fn[a]=function(c){var d=[],e=f(c),g=this.length===1&&this[0].parentNode;if(g&&g.nodeType===11&&g.childNodes.length===1&&e.length===1){e[b](this[0]);return this}for(var h=0,i=e.length;h<i;h++){var j=(h>0?this.clone(!0):this).get();f(e[h])[b](j),d=d.concat(j)}return this.pushStack(d,a,e.selector)}}),f.extend({clone:function(a,b,c){var d,e,g,h=f.support.html5Clone||!bc.test("<"+a.nodeName)?a.cloneNode(!0):bo(a);if((!f.support.noCloneEvent||!f.support.noCloneChecked)&&(a.nodeType===1||a.nodeType===11)&&!f.isXMLDoc(a)){bk(a,h),d=bl(a),e=bl(h);for(g=0;d[g];++g)e[g]&&bk(d[g],e[g])}if(b){bj(a,h);if(c){d=bl(a),e=bl(h);for(g=0;d[g];++g)bj(d[g],e[g])}}d=e=null;return h},clean:function(a,b,d,e){var g;b=b||c,typeof b.createElement=="undefined"&&(b=b.ownerDocument||b[0]&&b[0].ownerDocument||c);var h=[],i;for(var j=0,k;(k=a[j])!=null;j++){typeof k=="number"&&(k+="");if(!k)continue;if(typeof k=="string")if(!_.test(k))k=b.createTextNode(k);else{k=k.replace(Y,"<$1></$2>");var l=(Z.exec(k)||["",""])[1].toLowerCase(),m=bg[l]||bg._default,n=m[0],o=b.createElement("div");b===c?bh.appendChild(o):U(b).appendChild(o),o.innerHTML=m[1]+k+m[2];while(n--)o=o.lastChild;if(!f.support.tbody){var p=$.test(k),q=l==="table"&&!p?o.firstChild&&o.firstChild.childNodes:m[1]==="<table>"&&!p?o.childNodes:[];for(i=q.length-1;i>=0;--i)f.nodeName(q[i],"tbody")&&!q[i].childNodes.length&&q[i].parentNode.removeChild(q[i])}!f.support.leadingWhitespace&&X.test(k)&&o.insertBefore(b.createTextNode(X.exec(k)[0]),o.firstChild),k=o.childNodes}var r;if(!f.support.appendChecked)if(k[0]&&typeof (r=k.length)=="number")for(i=0;i<r;i++)bn(k[i]);else bn(k);k.nodeType?h.push(k):h=f.merge(h,k)}if(d){g=function(a){return!a.type||be.test(a.type)};for(j=0;h[j];j++)if(e&&f.nodeName(h[j],"script")&&(!h[j].type||h[j].type.toLowerCase()==="text/javascript"))e.push(h[j].parentNode?h[j].parentNode.removeChild(h[j]):h[j]);else{if(h[j].nodeType===1){var s=f.grep(h[j].getElementsByTagName("script"),g);h.splice.apply(h,[j+1,0].concat(s))}d.appendChild(h[j])}}return h},cleanData:function(a){var b,c,d=f.cache,e=f.event.special,g=f.support.deleteExpando;for(var h=0,i;(i=a[h])!=null;h++){if(i.nodeName&&f.noData[i.nodeName.toLowerCase()])continue;c=i[f.expando];if(c){b=d[c];if(b&&b.events){for(var j in b.events)e[j]?f.event.remove(i,j):f.removeEvent(i,j,b.handle);b.handle&&(b.handle.elem=null)}g?delete i[f.expando]:i.removeAttribute&&i.removeAttribute(f.expando),delete d[c]}}}});var bq=/alpha\([^)]*\)/i,br=/opacity=([^)]*)/,bs=/([A-Z]|^ms)/g,bt=/^-?\d+(?:px)?$/i,bu=/^-?\d/,bv=/^([\-+])=([\-+.\de]+)/,bw={position:"absolute",visibility:"hidden",display:"block"},bx=["Left","Right"],by=["Top","Bottom"],bz,bA,bB;f.fn.css=function(a,c){if(arguments.length===2&&c===b)return this;return f.access(this,a,c,!0,function(a,c,d){return d!==b?f.style(a,c,d):f.css(a,c)})},f.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=bz(a,"opacity","opacity");return c===""?"1":c}return a.style.opacity}}},cssNumber:{fillOpacity:!0,fontWeight:!0,lineHeight:!0,opacity:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":f.support.cssFloat?"cssFloat":"styleFloat"},style:function(a,c,d,e){if(!!a&&a.nodeType!==3&&a.nodeType!==8&&!!a.style){var g,h,i=f.camelCase(c),j=a.style,k=f.cssHooks[i];c=f.cssProps[i]||i;if(d===b){if(k&&"get"in k&&(g=k.get(a,!1,e))!==b)return g;return j[c]}h=typeof d,h==="string"&&(g=bv.exec(d))&&(d=+(g[1]+1)*+g[2]+parseFloat(f.css(a,c)),h="number");if(d==null||h==="number"&&isNaN(d))return;h==="number"&&!f.cssNumber[i]&&(d+="px");if(!k||!("set"in k)||(d=k.set(a,d))!==b)try{j[c]=d}catch(l){}}},css:function(a,c,d){var e,g;c=f.camelCase(c),g=f.cssHooks[c],c=f.cssProps[c]||c,c==="cssFloat"&&(c="float");if(g&&"get"in g&&(e=g.get(a,!0,d))!==b)return e;if(bz)return bz(a,c)},swap:function(a,b,c){var d={};for(var e in b)d[e]=a.style[e],a.style[e]=b[e];c.call(a);for(e in b)a.style[e]=d[e]}}),f.curCSS=f.css,f.each(["height","width"],function(a,b){f.cssHooks[b]={get:function(a,c,d){var e;if(c){if(a.offsetWidth!==0)return bC(a,b,d);f.swap(a,bw,function(){e=bC(a,b,d)});return e}},set:function(a,b){if(!bt.test(b))return b;b=parseFloat(b);if(b>=0)return b+"px"}}}),f.support.opacity||(f.cssHooks.opacity={get:function(a,b){return br.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100+"":b?"1":""},set:function(a,b){var c=a.style,d=a.currentStyle,e=f.isNumeric(b)?"alpha(opacity="+b*100+")":"",g=d&&d.filter||c.filter||"";c.zoom=1;if(b>=1&&f.trim(g.replace(bq,""))===""){c.removeAttribute("filter");if(d&&!d.filter)return}c.filter=bq.test(g)?g.replace(bq,e):g+" "+e}}),f(function(){f.support.reliableMarginRight||(f.cssHooks.marginRight={get:function(a,b){var c;f.swap(a,{display:"inline-block"},function(){b?c=bz(a,"margin-right","marginRight"):c=a.style.marginRight});return c}})}),c.defaultView&&c.defaultView.getComputedStyle&&(bA=function(a,b){var c,d,e;b=b.replace(bs,"-$1").toLowerCase(),(d=a.ownerDocument.defaultView)&&(e=d.getComputedStyle(a,null))&&(c=e.getPropertyValue(b),c===""&&!f.contains(a.ownerDocument.documentElement,a)&&(c=f.style(a,b)));return c}),c.documentElement.currentStyle&&(bB=function(a,b){var c,d,e,f=a.currentStyle&&a.currentStyle[b],g=a.style;f===null&&g&&(e=g[b])&&(f=e),!bt.test(f)&&bu.test(f)&&(c=g.left,d=a.runtimeStyle&&a.runtimeStyle.left,d&&(a.runtimeStyle.left=a.currentStyle.left),g.left=b==="fontSize"?"1em":f||0,f=g.pixelLeft+"px",g.left=c,d&&(a.runtimeStyle.left=d));return f===""?"auto":f}),bz=bA||bB,f.expr&&f.expr.filters&&(f.expr.filters.hidden=function(a){var b=a.offsetWidth,c=a.offsetHeight;return b===0&&c===0||!f.support.reliableHiddenOffsets&&(a.style&&a.style.display||f.css(a,"display"))==="none"},f.expr.filters.visible=function(a){return!f.expr.filters.hidden(a)});var bD=/%20/g,bE=/\[\]$/,bF=/\r?\n/g,bG=/#.*$/,bH=/^(.*?):[ \t]*([^\r\n]*)\r?$/mg,bI=/^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,bJ=/^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,bK=/^(?:GET|HEAD)$/,bL=/^\/\//,bM=/\?/,bN=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,bO=/^(?:select|textarea)/i,bP=/\s+/,bQ=/([?&])_=[^&]*/,bR=/^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/,bS=f.fn.load,bT={},bU={},bV,bW,bX=["*/"]+["*"];try{bV=e.href}catch(bY){bV=c.createElement("a"),bV.href="",bV=bV.href}bW=bR.exec(bV.toLowerCase())||[],f.fn.extend({load:function(a,c,d){if(typeof a!="string"&&bS)return bS.apply(this,arguments);if(!this.length)return this;var e=a.indexOf(" ");if(e>=0){var g=a.slice(e,a.length);a=a.slice(0,e)}var h="GET";c&&(f.isFunction(c)?(d=c,c=b):typeof c=="object"&&(c=f.param(c,f.ajaxSettings.traditional),h="POST"));var i=this;f.ajax({url:a,type:h,dataType:"html",data:c,complete:function(a,b,c){c=a.responseText,a.isResolved()&&(a.done(function(a){c=a}),i.html(g?f("<div>").append(c.replace(bN,"")).find(g):c)),d&&i.each(d,[c,b,a])}});return this},serialize:function(){return f.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?f.makeArray(this.elements):this}).filter(function(){return this.name&&!this.disabled&&(this.checked||bO.test(this.nodeName)||bI.test(this.type))}).map(function(a,b){var c=f(this).val();return c==null?null:f.isArray(c)?f.map(c,function(a,c){return{name:b.name,value:a.replace(bF,"\r\n")}}):{name:b.name,value:c.replace(bF,"\r\n")}}).get()}}),f.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(a,b){f.fn[b]=function(a){return this.on(b,a)}}),f.each(["get","post"],function(a,c){f[c]=function(a,d,e,g){f.isFunction(d)&&(g=g||e,e=d,d=b);return f.ajax({type:c,url:a,data:d,success:e,dataType:g})}}),f.extend({getScript:function(a,c){return f.get(a,b,c,"script")},getJSON:function(a,b,c){return f.get(a,b,c,"json")},ajaxSetup:function(a,b){b?b_(a,f.ajaxSettings):(b=a,a=f.ajaxSettings),b_(a,b);return a},ajaxSettings:{url:bV,isLocal:bJ.test(bW[1]),global:!0,type:"GET",contentType:"application/x-www-form-urlencoded",processData:!0,async:!0,accepts:{xml:"application/xml, text/xml",html:"text/html",text:"text/plain",json:"application/json, text/javascript","*":bX},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText"},converters:{"* text":a.String,"text html":!0,"text json":f.parseJSON,"text xml":f.parseXML},flatOptions:{context:!0,url:!0}},ajaxPrefilter:bZ(bT),ajaxTransport:bZ(bU),ajax:function(a,c){function w(a,c,l,m){if(s!==2){s=2,q&&clearTimeout(q),p=b,n=m||"",v.readyState=a>0?4:0;var o,r,u,w=c,x=l?cb(d,v,l):b,y,z;if(a>=200&&a<300||a===304){if(d.ifModified){if(y=v.getResponseHeader("Last-Modified"))f.lastModified[k]=y;if(z=v.getResponseHeader("Etag"))f.etag[k]=z}if(a===304)w="notmodified",o=!0;else try{r=cc(d,x),w="success",o=!0}catch(A){w="parsererror",u=A}}else{u=w;if(!w||a)w="error",a<0&&(a=0)}v.status=a,v.statusText=""+(c||w),o?h.resolveWith(e,[r,w,v]):h.rejectWith(e,[v,w,u]),v.statusCode(j),j=b,t&&g.trigger("ajax"+(o?"Success":"Error"),[v,d,o?r:u]),i.fireWith(e,[v,w]),t&&(g.trigger("ajaxComplete",[v,d]),--f.active||f.event.trigger("ajaxStop"))}}typeof a=="object"&&(c=a,a=b),c=c||{};var d=f.ajaxSetup({},c),e=d.context||d,g=e!==d&&(e.nodeType||e instanceof f)?f(e):f.event,h=f.Deferred(),i=f.Callbacks("once memory"),j=d.statusCode||{},k,l={},m={},n,o,p,q,r,s=0,t,u,v={readyState:0,setRequestHeader:function(a,b){if(!s){var c=a.toLowerCase();a=m[c]=m[c]||a,l[a]=b}return this},getAllResponseHeaders:function(){return s===2?n:null},getResponseHeader:function(a){var c;if(s===2){if(!o){o={};while(c=bH.exec(n))o[c[1].toLowerCase()]=c[2]}c=o[a.toLowerCase()]}return c===b?null:c},overrideMimeType:function(a){s||(d.mimeType=a);return this},abort:function(a){a=a||"abort",p&&p.abort(a),w(0,a);return this}};h.promise(v),v.success=v.done,v.error=v.fail,v.complete=i.add,v.statusCode=function(a){if(a){var b;if(s<2)for(b in a)j[b]=[j[b],a[b]];else b=a[v.status],v.then(b,b)}return this},d.url=((a||d.url)+"").replace(bG,"").replace(bL,bW[1]+"//"),d.dataTypes=f.trim(d.dataType||"*").toLowerCase().split(bP),d.crossDomain==null&&(r=bR.exec(d.url.toLowerCase()),d.crossDomain=!(!r||r[1]==bW[1]&&r[2]==bW[2]&&(r[3]||(r[1]==="http:"?80:443))==(bW[3]||(bW[1]==="http:"?80:443)))),d.data&&d.processData&&typeof d.data!="string"&&(d.data=f.param(d.data,d.traditional)),b$(bT,d,c,v);if(s===2)return!1;t=d.global,d.type=d.type.toUpperCase(),d.hasContent=!bK.test(d.type),t&&f.active++===0&&f.event.trigger("ajaxStart");if(!d.hasContent){d.data&&(d.url+=(bM.test(d.url)?"&":"?")+d.data,delete d.data),k=d.url;if(d.cache===!1){var x=f.now(),y=d.url.replace(bQ,"$1_="+x);d.url=y+(y===d.url?(bM.test(d.url)?"&":"?")+"_="+x:"")}}(d.data&&d.hasContent&&d.contentType!==!1||c.contentType)&&v.setRequestHeader("Content-Type",d.contentType),d.ifModified&&(k=k||d.url,f.lastModified[k]&&v.setRequestHeader("If-Modified-Since",f.lastModified[k]),f.etag[k]&&v.setRequestHeader("If-None-Match",f.etag[k])),v.setRequestHeader("Accept",d.dataTypes[0]&&d.accepts[d.dataTypes[0]]?d.accepts[d.dataTypes[0]]+(d.dataTypes[0]!=="*"?", "+bX+"; q=0.01":""):d.accepts["*"]);for(u in d.headers)v.setRequestHeader(u,d.headers[u]);if(d.beforeSend&&(d.beforeSend.call(e,v,d)===!1||s===2)){v.abort();return!1}for(u in{success:1,error:1,complete:1})v[u](d[u]);p=b$(bU,d,c,v);if(!p)w(-1,"No Transport");else{v.readyState=1,t&&g.trigger("ajaxSend",[v,d]),d.async&&d.timeout>0&&(q=setTimeout(function(){v.abort("timeout")},d.timeout));try{s=1,p.send(l,w)}catch(z){if(s<2)w(-1,z);else throw z}}return v},param:function(a,c){var d=[],e=function(a,b){b=f.isFunction(b)?b():b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};c===b&&(c=f.ajaxSettings.traditional);if(f.isArray(a)||a.jquery&&!f.isPlainObject(a))f.each(a,function(){e(this.name,this.value)});else for(var g in a)ca(g,a[g],c,e);return d.join("&").replace(bD,"+")}}),f.extend({active:0,lastModified:{},etag:{}});var cd=f.now(),ce=/(\=)\?(&|$)|\?\?/i;f.ajaxSetup({jsonp:"callback",jsonpCallback:function(){return f.expando+"_"+cd++}}),f.ajaxPrefilter("json jsonp",function(b,c,d){var e=b.contentType==="application/x-www-form-urlencoded"&&typeof b.data=="string";if(b.dataTypes[0]==="jsonp"||b.jsonp!==!1&&(ce.test(b.url)||e&&ce.test(b.data))){var g,h=b.jsonpCallback=f.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,i=a[h],j=b.url,k=b.data,l="$1"+h+"$2";b.jsonp!==!1&&(j=j.replace(ce,l),b.url===j&&(e&&(k=k.replace(ce,l)),b.data===k&&(j+=(/\?/.test(j)?"&":"?")+b.jsonp+"="+h))),b.url=j,b.data=k,a[h]=function(a){g=[a]},d.always(function(){a[h]=i,g&&f.isFunction(i)&&a[h](g[0])}),b.converters["script json"]=function(){g||f.error(h+" was not called");return g[0]},b.dataTypes[0]="json";return"script"}}),f.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/javascript|ecmascript/},converters:{"text script":function(a){f.globalEval(a);return a}}}),f.ajaxPrefilter("script",function(a){a.cache===b&&(a.cache=!1),a.crossDomain&&(a.type="GET",a.global=!1)}),f.ajaxTransport("script",function(a){if(a.crossDomain){var d,e=c.head||c.getElementsByTagName("head")[0]||c.documentElement;return{send:function(f,g){d=c.createElement("script"),d.async="async",a.scriptCharset&&(d.charset=a.scriptCharset),d.src=a.url,d.onload=d.onreadystatechange=function(a,c){if(c||!d.readyState||/loaded|complete/.test(d.readyState))d.onload=d.onreadystatechange=null,e&&d.parentNode&&e.removeChild(d),d=b,c||g(200,"success")},e.insertBefore(d,e.firstChild)},abort:function(){d&&d.onload(0,1)}}}});var cf=a.ActiveXObject?function(){for(var a in ch)ch[a](0,1)}:!1,cg=0,ch;f.ajaxSettings.xhr=a.ActiveXObject?function(){return!this.isLocal&&ci()||cj()}:ci,function(a){f.extend(f.support,{ajax:!!a,cors:!!a&&"withCredentials"in a})}(f.ajaxSettings.xhr()),f.support.ajax&&f.ajaxTransport(function(c){if(!c.crossDomain||f.support.cors){var d;return{send:function(e,g){var h=c.xhr(),i,j;c.username?h.open(c.type,c.url,c.async,c.username,c.password):h.open(c.type,c.url,c.async);if(c.xhrFields)for(j in c.xhrFields)h[j]=c.xhrFields[j];c.mimeType&&h.overrideMimeType&&h.overrideMimeType(c.mimeType),!c.crossDomain&&!e["X-Requested-With"]&&(e["X-Requested-With"]="XMLHttpRequest");try{for(j in e)h.setRequestHeader(j,e[j])}catch(k){}h.send(c.hasContent&&c.data||null),d=function(a,e){var j,k,l,m,n;try{if(d&&(e||h.readyState===4)){d=b,i&&(h.onreadystatechange=f.noop,cf&&delete ch[i]);if(e)h.readyState!==4&&h.abort();else{j=h.status,l=h.getAllResponseHeaders(),m={},n=h.responseXML,n&&n.documentElement&&(m.xml=n),m.text=h.responseText;try{k=h.statusText}catch(o){k=""}!j&&c.isLocal&&!c.crossDomain?j=m.text?200:404:j===1223&&(j=204)}}}catch(p){e||g(-1,p)}m&&g(j,k,m,l)},!c.async||h.readyState===4?d():(i=++cg,cf&&(ch||(ch={},f(a).unload(cf)),ch[i]=d),h.onreadystatechange=d)},abort:function(){d&&d(0,1)}}}});var ck={},cl,cm,cn=/^(?:toggle|show|hide)$/,co=/^([+\-]=)?([\d+.\-]+)([a-z%]*)$/i,cp,cq=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]],cr;f.fn.extend({show:function(a,b,c){var d,e;if(a||a===0)return this.animate(cu("show",3),a,b,c);for(var g=0,h=this.length;g<h;g++)d=this[g],d.style&&(e=d.style.display,!f._data(d,"olddisplay")&&e==="none"&&(e=d.style.display=""),e===""&&f.css(d,"display")==="none"&&f._data(d,"olddisplay",cv(d.nodeName)));for(g=0;g<h;g++){d=this[g];if(d.style){e=d.style.display;if(e===""||e==="none")d.style.display=f._data(d,"olddisplay")||""}}return this},hide:function(a,b,c){if(a||a===0)return this.animate(cu("hide",3),a,b,c);var d,e,g=0,h=this.length;for(;g<h;g++)d=this[g],d.style&&(e=f.css(d,"display"),e!=="none"&&!f._data(d,"olddisplay")&&f._data(d,"olddisplay",e));for(g=0;g<h;g++)this[g].style&&(this[g].style.display="none");return this},_toggle:f.fn.toggle,toggle:function(a,b,c){var d=typeof a=="boolean";f.isFunction(a)&&f.isFunction(b)?this._toggle.apply(this,arguments):a==null||d?this.each(function(){var b=d?a:f(this).is(":hidden");f(this)[b?"show":"hide"]()}):this.animate(cu("toggle",3),a,b,c);return this},fadeTo:function(a,b,c,d){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){function g(){e.queue===!1&&f._mark(this);var b=f.extend({},e),c=this.nodeType===1,d=c&&f(this).is(":hidden"),g,h,i,j,k,l,m,n,o;b.animatedProperties={};for(i in a){g=f.camelCase(i),i!==g&&(a[g]=a[i],delete a[i]),h=a[g],f.isArray(h)?(b.animatedProperties[g]=h[1],h=a[g]=h[0]):b.animatedProperties[g]=b.specialEasing&&b.specialEasing[g]||b.easing||"swing";if(h==="hide"&&d||h==="show"&&!d)return b.complete.call(this);c&&(g==="height"||g==="width")&&(b.overflow=[this.style.overflow,this.style.overflowX,this.style.overflowY],f.css(this,"display")==="inline"&&f.css(this,"float")==="none"&&(!f.support.inlineBlockNeedsLayout||cv(this.nodeName)==="inline"?this.style.display="inline-block":this.style.zoom=1))}b.overflow!=null&&(this.style.overflow="hidden");for(i in a)j=new f.fx(this,b,i),h=a[i],cn.test(h)?(o=f._data(this,"toggle"+i)||(h==="toggle"?d?"show":"hide":0),o?(f._data(this,"toggle"+i,o==="show"?"hide":"show"),j[o]()):j[h]()):(k=co.exec(h),l=j.cur(),k?(m=parseFloat(k[2]),n=k[3]||(f.cssNumber[i]?"":"px"),n!=="px"&&(f.style(this,i,(m||1)+n),l=(m||1)/j.cur()*l,f.style(this,i,l+n)),k[1]&&(m=(k[1]==="-="?-1:1)*m+l),j.custom(l,m,n)):j.custom(l,h,""));return!0}var e=f.speed(b,c,d);if(f.isEmptyObject(a))return this.each(e.complete,[!1]);a=f.extend({},a);return e.queue===!1?this.each(g):this.queue(e.queue,g)},stop:function(a,c,d){typeof a!="string"&&(d=c,c=a,a=b),c&&a!==!1&&this.queue(a||"fx",[]);return this.each(function(){function h(a,b,c){var e=b[c];f.removeData(a,c,!0),e.stop(d)}var b,c=!1,e=f.timers,g=f._data(this);d||f._unmark(!0,this);if(a==null)for(b in g)g[b]&&g[b].stop&&b.indexOf(".run")===b.length-4&&h(this,g,b);else g[b=a+".run"]&&g[b].stop&&h(this,g,b);for(b=e.length;b--;)e[b].elem===this&&(a==null||e[b].queue===a)&&(d?e[b](!0):e[b].saveState(),c=!0,e.splice(b,1));(!d||!c)&&f.dequeue(this,a)})}}),f.each({slideDown:cu("show",1),slideUp:cu("hide",1),slideToggle:cu("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){f.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),f.extend({speed:function(a,b,c){var d=a&&typeof a=="object"?f.extend({},a):{complete:c||!c&&b||f.isFunction(a)&&a,duration:a,easing:c&&b||b&&!f.isFunction(b)&&b};d.duration=f.fx.off?0:typeof d.duration=="number"?d.duration:d.duration in f.fx.speeds?f.fx.speeds[d.duration]:f.fx.speeds._default;if(d.queue==null||d.queue===!0)d.queue="fx";d.old=d.complete,d.complete=function(a){f.isFunction(d.old)&&d.old.call(this),d.queue?f.dequeue(this,d.queue):a!==!1&&f._unmark(this)};return d},easing:{linear:function(a,b,c,d){return c+d*a},swing:function(a,b,c,d){return(-Math.cos(a*Math.PI)/2+.5)*d+c}},timers:[],fx:function(a,b,c){this.options=b,this.elem=a,this.prop=c,b.orig=b.orig||{}}}),f.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this),(f.fx.step[this.prop]||f.fx.step._default)(this)},cur:function(){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];var a,b=f.css(this.elem,this.prop);return isNaN(a=parseFloat(b))?!b||b==="auto"?0:b:a},custom:function(a,c,d){function h(a){return e.step(a)}var e=this,g=f.fx;this.startTime=cr||cs(),this.end=c,this.now=this.start=a,this.pos=this.state=0,this.unit=d||this.unit||(f.cssNumber[this.prop]?"":"px"),h.queue=this.options.queue,h.elem=this.elem,h.saveState=function(){e.options.hide&&f._data(e.elem,"fxshow"+e.prop)===b&&f._data(e.elem,"fxshow"+e.prop,e.start)},h()&&f.timers.push(h)&&!cp&&(cp=setInterval(g.tick,g.interval))},show:function(){var a=f._data(this.elem,"fxshow"+this.prop);this.options.orig[this.prop]=a||f.style(this.elem,this.prop),this.options.show=!0,a!==b?this.custom(this.cur(),a):this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur()),f(this.elem).show()},hide:function(){this.options.orig[this.prop]=f._data(this.elem,"fxshow"+this.prop)||f.style(this.elem,this.prop),this.options.hide=!0,this.custom(this.cur(),0)},step:function(a){var b,c,d,e=cr||cs(),g=!0,h=this.elem,i=this.options;if(a||e>=i.duration+this.startTime){this.now=this.end,this.pos=this.state=1,this.update(),i.animatedProperties[this.prop]=!0;for(b in i.animatedProperties)i.animatedProperties[b]!==!0&&(g=!1);if(g){i.overflow!=null&&!f.support.shrinkWrapBlocks&&f.each(["","X","Y"],function(a,b){h.style["overflow"+b]=i.overflow[a]}),i.hide&&f(h).hide();if(i.hide||i.show)for(b in i.animatedProperties)f.style(h,b,i.orig[b]),f.removeData(h,"fxshow"+b,!0),f.removeData(h,"toggle"+b,!0);d=i.complete,d&&(i.complete=!1,d.call(h))}return!1}i.duration==Infinity?this.now=e:(c=e-this.startTime,this.state=c/i.duration,this.pos=f.easing[i.animatedProperties[this.prop]](this.state,c,0,1,i.duration),this.now=this.start+(this.end-this.start)*this.pos),this.update();return!0}},f.extend(f.fx,{tick:function(){var a,b=f.timers,c=0;for(;c<b.length;c++)a=b[c],!a()&&b[c]===a&&b.splice(c--,1);b.length||f.fx.stop()},interval:13,stop:function(){clearInterval(cp),cp=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){f.style(a.elem,"opacity",a.now)},_default:function(a){a.elem.style&&a.elem.style[a.prop]!=null?a.elem.style[a.prop]=a.now+a.unit:a.elem[a.prop]=a.now}}}),f.each(["width","height"],function(a,b){f.fx.step[b]=function(a){f.style(a.elem,b,Math.max(0,a.now)+a.unit)}}),f.expr&&f.expr.filters&&(f.expr.filters.animated=function(a){return f.grep(f.timers,function(b){return a===b.elem}).length});var cw=/^t(?:able|d|h)$/i,cx=/^(?:body|html)$/i;"getBoundingClientRect"in c.documentElement?f.fn.offset=function(a){var b=this[0],c;if(a)return this.each(function(b){f.offset.setOffset(this,a,b)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return f.offset.bodyOffset(b);try{c=b.getBoundingClientRect()}catch(d){}var e=b.ownerDocument,g=e.documentElement;if(!c||!f.contains(g,b))return c?{top:c.top,left:c.left}:{top:0,left:0};var h=e.body,i=cy(e),j=g.clientTop||h.clientTop||0,k=g.clientLeft||h.clientLeft||0,l=i.pageYOffset||f.support.boxModel&&g.scrollTop||h.scrollTop,m=i.pageXOffset||f.support.boxModel&&g.scrollLeft||h.scrollLeft,n=c.top+l-j,o=c.left+m-k;return{top:n,left:o}}:f.fn.offset=function(a){var b=this[0];if(a)return this.each(function(b){f.offset.setOffset(this,a,b)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return f.offset.bodyOffset(b);var c,d=b.offsetParent,e=b,g=b.ownerDocument,h=g.documentElement,i=g.body,j=g.defaultView,k=j?j.getComputedStyle(b,null):b.currentStyle,l=b.offsetTop,m=b.offsetLeft;while((b=b.parentNode)&&b!==i&&b!==h){if(f.support.fixedPosition&&k.position==="fixed")break;c=j?j.getComputedStyle(b,null):b.currentStyle,l-=b.scrollTop,m-=b.scrollLeft,b===d&&(l+=b.offsetTop,m+=b.offsetLeft,f.support.doesNotAddBorder&&(!f.support.doesAddBorderForTableAndCells||!cw.test(b.nodeName))&&(l+=parseFloat(c.borderTopWidth)||0,m+=parseFloat(c.borderLeftWidth)||0),e=d,d=b.offsetParent),f.support.subtractsBorderForOverflowNotVisible&&c.overflow!=="visible"&&(l+=parseFloat(c.borderTopWidth)||0,m+=parseFloat(c.borderLeftWidth)||0),k=c}if(k.position==="relative"||k.position==="static")l+=i.offsetTop,m+=i.offsetLeft;f.support.fixedPosition&&k.position==="fixed"&&(l+=Math.max(h.scrollTop,i.scrollTop),m+=Math.max(h.scrollLeft,i.scrollLeft));return{top:l,left:m}},f.offset={bodyOffset:function(a){var b=a.offsetTop,c=a.offsetLeft;f.support.doesNotIncludeMarginInBodyOffset&&(b+=parseFloat(f.css(a,"marginTop"))||0,c+=parseFloat(f.css(a,"marginLeft"))||0);return{top:b,left:c}},setOffset:function(a,b,c){var d=f.css(a,"position");d==="static"&&(a.style.position="relative");var e=f(a),g=e.offset(),h=f.css(a,"top"),i=f.css(a,"left"),j=(d==="absolute"||d==="fixed")&&f.inArray("auto",[h,i])>-1,k={},l={},m,n;j?(l=e.position(),m=l.top,n=l.left):(m=parseFloat(h)||0,n=parseFloat(i)||0),f.isFunction(b)&&(b=b.call(a,c,g)),b.top!=null&&(k.top=b.top-g.top+m),b.left!=null&&(k.left=b.left-g.left+n),"using"in b?b.using.call(a,k):e.css(k)}},f.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),c=this.offset(),d=cx.test(b[0].nodeName)?{top:0,left:0}:b.offset();c.top-=parseFloat(f.css(a,"marginTop"))||0,c.left-=parseFloat(f.css(a,"marginLeft"))||0,d.top+=parseFloat(f.css(b[0],"borderTopWidth"))||0,d.left+=parseFloat(f.css(b[0],"borderLeftWidth"))||0;return{top:c.top-d.top,left:c.left-d.left}},offsetParent:function(){return this.map(function(){var a=this.offsetParent||c.body;while(a&&!cx.test(a.nodeName)&&f.css(a,"position")==="static")a=a.offsetParent;return a})}}),f.each(["Left","Top"],function(a,c){var d="scroll"+c;f.fn[d]=function(c){var e,g;if(c===b){e=this[0];if(!e)return null;g=cy(e);return g?"pageXOffset"in g?g[a?"pageYOffset":"pageXOffset"]:f.support.boxModel&&g.document.documentElement[d]||g.document.body[d]:e[d]}return this.each(function(){g=cy(this),g?g.scrollTo(a?f(g).scrollLeft():c,a?c:f(g).scrollTop()):this[d]=c})}}),f.each(["Height","Width"],function(a,c){var d=c.toLowerCase();f.fn["inner"+c]=function(){var a=this[0];return a?a.style?parseFloat(f.css(a,d,"padding")):this[d]():null},f.fn["outer"+c]=function(a){var b=this[0];return b?b.style?parseFloat(f.css(b,d,a?"margin":"border")):this[d]():null},f.fn[d]=function(a){var e=this[0];if(!e)return a==null?null:this;if(f.isFunction(a))return this.each(function(b){var c=f(this);c[d](a.call(this,b,c[d]()))});if(f.isWindow(e)){var g=e.document.documentElement["client"+c],h=e.document.body;return e.document.compatMode==="CSS1Compat"&&g||h&&h["client"+c]||g}if(e.nodeType===9)return Math.max(e.documentElement["client"+c],e.body["scroll"+c],e.documentElement["scroll"+c],e.body["offset"+c],e.documentElement["offset"+c]);if(a===b){var i=f.css(e,d),j=parseFloat(i);return f.isNumeric(j)?j:i}return this.css(d,typeof a=="string"?a:a+"px")}}),a.jQuery=a.$=f,typeof define=="function"&&define.amd&&define.amd.jQuery&&define("jquery",[],function(){return f})})(window);
/*!
 * jQuery UI 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI
 */(function(a,b){function d(b){return!a(b).parents().andSelf().filter(function(){return a.curCSS(this,"visibility")==="hidden"||a.expr.filters.hidden(this)}).length}function c(b,c){var e=b.nodeName.toLowerCase();if("area"===e){var f=b.parentNode,g=f.name,h;if(!b.href||!g||f.nodeName.toLowerCase()!=="map")return!1;h=a("img[usemap=#"+g+"]")[0];return!!h&&d(h)}return(/input|select|textarea|button|object/.test(e)?!b.disabled:"a"==e?b.href||c:c)&&d(b)}a.ui=a.ui||{};a.ui.version||(a.extend(a.ui,{version:"1.8.17",keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91}}),a.fn.extend({propAttr:a.fn.prop||a.fn.attr,_focus:a.fn.focus,focus:function(b,c){return typeof b=="number"?this.each(function(){var d=this;setTimeout(function(){a(d).focus(),c&&c.call(d)},b)}):this._focus.apply(this,arguments)},scrollParent:function(){var b;a.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?b=this.parents().filter(function(){return/(relative|absolute|fixed)/.test(a.curCSS(this,"position",1))&&/(auto|scroll)/.test(a.curCSS(this,"overflow",1)+a.curCSS(this,"overflow-y",1)+a.curCSS(this,"overflow-x",1))}).eq(0):b=this.parents().filter(function(){return/(auto|scroll)/.test(a.curCSS(this,"overflow",1)+a.curCSS(this,"overflow-y",1)+a.curCSS(this,"overflow-x",1))}).eq(0);return/fixed/.test(this.css("position"))||!b.length?a(document):b},zIndex:function(c){if(c!==b)return this.css("zIndex",c);if(this.length){var d=a(this[0]),e,f;while(d.length&&d[0]!==document){e=d.css("position");if(e==="absolute"||e==="relative"||e==="fixed"){f=parseInt(d.css("zIndex"),10);if(!isNaN(f)&&f!==0)return f}d=d.parent()}}return 0},disableSelection:function(){return this.bind((a.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(a){a.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}}),a.each(["Width","Height"],function(c,d){function h(b,c,d,f){a.each(e,function(){c-=parseFloat(a.curCSS(b,"padding"+this,!0))||0,d&&(c-=parseFloat(a.curCSS(b,"border"+this+"Width",!0))||0),f&&(c-=parseFloat(a.curCSS(b,"margin"+this,!0))||0)});return c}var e=d==="Width"?["Left","Right"]:["Top","Bottom"],f=d.toLowerCase(),g={innerWidth:a.fn.innerWidth,innerHeight:a.fn.innerHeight,outerWidth:a.fn.outerWidth,outerHeight:a.fn.outerHeight};a.fn["inner"+d]=function(c){if(c===b)return g["inner"+d].call(this);return this.each(function(){a(this).css(f,h(this,c)+"px")})},a.fn["outer"+d]=function(b,c){if(typeof b!="number")return g["outer"+d].call(this,b);return this.each(function(){a(this).css(f,h(this,b,!0,c)+"px")})}}),a.extend(a.expr[":"],{data:function(b,c,d){return!!a.data(b,d[3])},focusable:function(b){return c(b,!isNaN(a.attr(b,"tabindex")))},tabbable:function(b){var d=a.attr(b,"tabindex"),e=isNaN(d);return(e||d>=0)&&c(b,!e)}}),a(function(){var b=document.body,c=b.appendChild(c=document.createElement("div"));a.extend(c.style,{minHeight:"100px",height:"auto",padding:0,borderWidth:0}),a.support.minHeight=c.offsetHeight===100,a.support.selectstart="onselectstart"in c,b.removeChild(c).style.display="none"}),a.extend(a.ui,{plugin:{add:function(b,c,d){var e=a.ui[b].prototype;for(var f in d)e.plugins[f]=e.plugins[f]||[],e.plugins[f].push([c,d[f]])},call:function(a,b,c){var d=a.plugins[b];if(!!d&&!!a.element[0].parentNode)for(var e=0;e<d.length;e++)a.options[d[e][0]]&&d[e][1].apply(a.element,c)}},contains:function(a,b){return document.compareDocumentPosition?a.compareDocumentPosition(b)&16:a!==b&&a.contains(b)},hasScroll:function(b,c){if(a(b).css("overflow")==="hidden")return!1;var d=c&&c==="left"?"scrollLeft":"scrollTop",e=!1;if(b[d]>0)return!0;b[d]=1,e=b[d]>0,b[d]=0;return e},isOverAxis:function(a,b,c){return a>b&&a<b+c},isOver:function(b,c,d,e,f,g){return a.ui.isOverAxis(b,d,f)&&a.ui.isOverAxis(c,e,g)}}))})(jQuery);/*!
 * jQuery UI Widget 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Widget
 */(function(a,b){if(a.cleanData){var c=a.cleanData;a.cleanData=function(b){for(var d=0,e;(e=b[d])!=null;d++)try{a(e).triggerHandler("remove")}catch(f){}c(b)}}else{var d=a.fn.remove;a.fn.remove=function(b,c){return this.each(function(){c||(!b||a.filter(b,[this]).length)&&a("*",this).add([this]).each(function(){try{a(this).triggerHandler("remove")}catch(b){}});return d.call(a(this),b,c)})}}a.widget=function(b,c,d){var e=b.split(".")[0],f;b=b.split(".")[1],f=e+"-"+b,d||(d=c,c=a.Widget),a.expr[":"][f]=function(c){return!!a.data(c,b)},a[e]=a[e]||{},a[e][b]=function(a,b){arguments.length&&this._createWidget(a,b)};var g=new c;g.options=a.extend(!0,{},g.options),a[e][b].prototype=a.extend(!0,g,{namespace:e,widgetName:b,widgetEventPrefix:a[e][b].prototype.widgetEventPrefix||b,widgetBaseClass:f},d),a.widget.bridge(b,a[e][b])},a.widget.bridge=function(c,d){a.fn[c]=function(e){var f=typeof e=="string",g=Array.prototype.slice.call(arguments,1),h=this;e=!f&&g.length?a.extend.apply(null,[!0,e].concat(g)):e;if(f&&e.charAt(0)==="_")return h;f?this.each(function(){var d=a.data(this,c),f=d&&a.isFunction(d[e])?d[e].apply(d,g):d;if(f!==d&&f!==b){h=f;return!1}}):this.each(function(){var b=a.data(this,c);b?b.option(e||{})._init():a.data(this,c,new d(e,this))});return h}},a.Widget=function(a,b){arguments.length&&this._createWidget(a,b)},a.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:!1},_createWidget:function(b,c){a.data(c,this.widgetName,this),this.element=a(c),this.options=a.extend(!0,{},this.options,this._getCreateOptions(),b);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()}),this._create(),this._trigger("create"),this._init()},_getCreateOptions:function(){return a.metadata&&a.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName),this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled "+"ui-state-disabled")},widget:function(){return this.element},option:function(c,d){var e=c;if(arguments.length===0)return a.extend({},this.options);if(typeof c=="string"){if(d===b)return this.options[c];e={},e[c]=d}this._setOptions(e);return this},_setOptions:function(b){var c=this;a.each(b,function(a,b){c._setOption(a,b)});return this},_setOption:function(a,b){this.options[a]=b,a==="disabled"&&this.widget()[b?"addClass":"removeClass"](this.widgetBaseClass+"-disabled"+" "+"ui-state-disabled").attr("aria-disabled",b);return this},enable:function(){return this._setOption("disabled",!1)},disable:function(){return this._setOption("disabled",!0)},_trigger:function(b,c,d){var e,f,g=this.options[b];d=d||{},c=a.Event(c),c.type=(b===this.widgetEventPrefix?b:this.widgetEventPrefix+b).toLowerCase(),c.target=this.element[0],f=c.originalEvent;if(f)for(e in f)e in c||(c[e]=f[e]);this.element.trigger(c,d);return!(a.isFunction(g)&&g.call(this.element[0],c,d)===!1||c.isDefaultPrevented())}}})(jQuery);/*!
 * jQuery UI Mouse 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Mouse
 *
 * Depends:
 *	jquery.ui.widget.js
 */(function(a,b){var c=!1;a(document).mouseup(function(a){c=!1}),a.widget("ui.mouse",{options:{cancel:":input,option",distance:1,delay:0},_mouseInit:function(){var b=this;this.element.bind("mousedown."+this.widgetName,function(a){return b._mouseDown(a)}).bind("click."+this.widgetName,function(c){if(!0===a.data(c.target,b.widgetName+".preventClickEvent")){a.removeData(c.target,b.widgetName+".preventClickEvent"),c.stopImmediatePropagation();return!1}}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName)},_mouseDown:function(b){if(!c){this._mouseStarted&&this._mouseUp(b),this._mouseDownEvent=b;var d=this,e=b.which==1,f=typeof this.options.cancel=="string"&&b.target.nodeName?a(b.target).closest(this.options.cancel).length:!1;if(!e||f||!this._mouseCapture(b))return!0;this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){d.mouseDelayMet=!0},this.options.delay));if(this._mouseDistanceMet(b)&&this._mouseDelayMet(b)){this._mouseStarted=this._mouseStart(b)!==!1;if(!this._mouseStarted){b.preventDefault();return!0}}!0===a.data(b.target,this.widgetName+".preventClickEvent")&&a.removeData(b.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(a){return d._mouseMove(a)},this._mouseUpDelegate=function(a){return d._mouseUp(a)},a(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),b.preventDefault(),c=!0;return!0}},_mouseMove:function(b){if(a.browser.msie&&!(document.documentMode>=9)&&!b.button)return this._mouseUp(b);if(this._mouseStarted){this._mouseDrag(b);return b.preventDefault()}this._mouseDistanceMet(b)&&this._mouseDelayMet(b)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,b)!==!1,this._mouseStarted?this._mouseDrag(b):this._mouseUp(b));return!this._mouseStarted},_mouseUp:function(b){a(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,b.target==this._mouseDownEvent.target&&a.data(b.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(b));return!1},_mouseDistanceMet:function(a){return Math.max(Math.abs(this._mouseDownEvent.pageX-a.pageX),Math.abs(this._mouseDownEvent.pageY-a.pageY))>=this.options.distance},_mouseDelayMet:function(a){return this.mouseDelayMet},_mouseStart:function(a){},_mouseDrag:function(a){},_mouseStop:function(a){},_mouseCapture:function(a){return!0}})})(jQuery);/*
 * jQuery UI Position 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Position
 */(function(a,b){a.ui=a.ui||{};var c=/left|center|right/,d=/top|center|bottom/,e="center",f={},g=a.fn.position,h=a.fn.offset;a.fn.position=function(b){if(!b||!b.of)return g.apply(this,arguments);b=a.extend({},b);var h=a(b.of),i=h[0],j=(b.collision||"flip").split(" "),k=b.offset?b.offset.split(" "):[0,0],l,m,n;i.nodeType===9?(l=h.width(),m=h.height(),n={top:0,left:0}):i.setTimeout?(l=h.width(),m=h.height(),n={top:h.scrollTop(),left:h.scrollLeft()}):i.preventDefault?(b.at="left top",l=m=0,n={top:b.of.pageY,left:b.of.pageX}):(l=h.outerWidth(),m=h.outerHeight(),n=h.offset()),a.each(["my","at"],function(){var a=(b[this]||"").split(" ");a.length===1&&(a=c.test(a[0])?a.concat([e]):d.test(a[0])?[e].concat(a):[e,e]),a[0]=c.test(a[0])?a[0]:e,a[1]=d.test(a[1])?a[1]:e,b[this]=a}),j.length===1&&(j[1]=j[0]),k[0]=parseInt(k[0],10)||0,k.length===1&&(k[1]=k[0]),k[1]=parseInt(k[1],10)||0,b.at[0]==="right"?n.left+=l:b.at[0]===e&&(n.left+=l/2),b.at[1]==="bottom"?n.top+=m:b.at[1]===e&&(n.top+=m/2),n.left+=k[0],n.top+=k[1];return this.each(function(){var c=a(this),d=c.outerWidth(),g=c.outerHeight(),h=parseInt(a.curCSS(this,"marginLeft",!0))||0,i=parseInt(a.curCSS(this,"marginTop",!0))||0,o=d+h+(parseInt(a.curCSS(this,"marginRight",!0))||0),p=g+i+(parseInt(a.curCSS(this,"marginBottom",!0))||0),q=a.extend({},n),r;b.my[0]==="right"?q.left-=d:b.my[0]===e&&(q.left-=d/2),b.my[1]==="bottom"?q.top-=g:b.my[1]===e&&(q.top-=g/2),f.fractions||(q.left=Math.round(q.left),q.top=Math.round(q.top)),r={left:q.left-h,top:q.top-i},a.each(["left","top"],function(c,e){a.ui.position[j[c]]&&a.ui.position[j[c]][e](q,{targetWidth:l,targetHeight:m,elemWidth:d,elemHeight:g,collisionPosition:r,collisionWidth:o,collisionHeight:p,offset:k,my:b.my,at:b.at})}),a.fn.bgiframe&&c.bgiframe(),c.offset(a.extend(q,{using:b.using}))})},a.ui.position={fit:{left:function(b,c){var d=a(window),e=c.collisionPosition.left+c.collisionWidth-d.width()-d.scrollLeft();b.left=e>0?b.left-e:Math.max(b.left-c.collisionPosition.left,b.left)},top:function(b,c){var d=a(window),e=c.collisionPosition.top+c.collisionHeight-d.height()-d.scrollTop();b.top=e>0?b.top-e:Math.max(b.top-c.collisionPosition.top,b.top)}},flip:{left:function(b,c){if(c.at[0]!==e){var d=a(window),f=c.collisionPosition.left+c.collisionWidth-d.width()-d.scrollLeft(),g=c.my[0]==="left"?-c.elemWidth:c.my[0]==="right"?c.elemWidth:0,h=c.at[0]==="left"?c.targetWidth:-c.targetWidth,i=-2*c.offset[0];b.left+=c.collisionPosition.left<0?g+h+i:f>0?g+h+i:0}},top:function(b,c){if(c.at[1]!==e){var d=a(window),f=c.collisionPosition.top+c.collisionHeight-d.height()-d.scrollTop(),g=c.my[1]==="top"?-c.elemHeight:c.my[1]==="bottom"?c.elemHeight:0,h=c.at[1]==="top"?c.targetHeight:-c.targetHeight,i=-2*c.offset[1];b.top+=c.collisionPosition.top<0?g+h+i:f>0?g+h+i:0}}}},a.offset.setOffset||(a.offset.setOffset=function(b,c){/static/.test(a.curCSS(b,"position"))&&(b.style.position="relative");var d=a(b),e=d.offset(),f=parseInt(a.curCSS(b,"top",!0),10)||0,g=parseInt(a.curCSS(b,"left",!0),10)||0,h={top:c.top-e.top+f,left:c.left-e.left+g};"using"in c?c.using.call(b,h):d.css(h)},a.fn.offset=function(b){var c=this[0];if(!c||!c.ownerDocument)return null;if(b)return this.each(function(){a.offset.setOffset(this,b)});return h.call(this)}),function(){var b=document.getElementsByTagName("body")[0],c=document.createElement("div"),d,e,g,h,i;d=document.createElement(b?"div":"body"),g={visibility:"hidden",width:0,height:0,border:0,margin:0,background:"none"},b&&jQuery.extend(g,{position:"absolute",left:"-1000px",top:"-1000px"});for(var j in g)d.style[j]=g[j];d.appendChild(c),e=b||document.documentElement,e.insertBefore(d,e.firstChild),c.style.cssText="position: absolute; left: 10.7432222px; top: 10.432325px; height: 30px; width: 201px;",h=a(c).offset(function(a,b){return b}).offset(),d.innerHTML="",e.removeChild(d),i=h.top+h.left+(b?2e3:0),f.fractions=i>21&&i<22}()})(jQuery);/*
 * jQuery UI Draggable 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Draggables
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.mouse.js
 *	jquery.ui.widget.js
 */(function(a,b){a.widget("ui.draggable",a.ui.mouse,{widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1},_create:function(){this.options.helper=="original"&&!/^(?:r|a|f)/.test(this.element.css("position"))&&(this.element[0].style.position="relative"),this.options.addClasses&&this.element.addClass("ui-draggable"),this.options.disabled&&this.element.addClass("ui-draggable-disabled"),this._mouseInit()},destroy:function(){if(!!this.element.data("draggable")){this.element.removeData("draggable").unbind(".draggable").removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"),this._mouseDestroy();return this}},_mouseCapture:function(b){var c=this.options;if(this.helper||c.disabled||a(b.target).is(".ui-resizable-handle"))return!1;this.handle=this._getHandle(b);if(!this.handle)return!1;c.iframeFix&&a(c.iframeFix===!0?"iframe":c.iframeFix).each(function(){a('<div class="ui-draggable-iframeFix" style="background: #fff;"></div>').css({width:this.offsetWidth+"px",height:this.offsetHeight+"px",position:"absolute",opacity:"0.001",zIndex:1e3}).css(a(this).offset()).appendTo("body")});return!0},_mouseStart:function(b){var c=this.options;this.helper=this._createHelper(b),this._cacheHelperProportions(),a.ui.ddmanager&&(a.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(),this.offset=this.positionAbs=this.element.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},a.extend(this.offset,{click:{left:b.pageX-this.offset.left,top:b.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.originalPosition=this.position=this._generatePosition(b),this.originalPageX=b.pageX,this.originalPageY=b.pageY,c.cursorAt&&this._adjustOffsetFromHelper(c.cursorAt),c.containment&&this._setContainment();if(this._trigger("start",b)===!1){this._clear();return!1}this._cacheHelperProportions(),a.ui.ddmanager&&!c.dropBehaviour&&a.ui.ddmanager.prepareOffsets(this,b),this.helper.addClass("ui-draggable-dragging"),this._mouseDrag(b,!0),a.ui.ddmanager&&a.ui.ddmanager.dragStart(this,b);return!0},_mouseDrag:function(b,c){this.position=this._generatePosition(b),this.positionAbs=this._convertPositionTo("absolute");if(!c){var d=this._uiHash();if(this._trigger("drag",b,d)===!1){this._mouseUp({});return!1}this.position=d.position}if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";a.ui.ddmanager&&a.ui.ddmanager.drag(this,b);return!1},_mouseStop:function(b){var c=!1;a.ui.ddmanager&&!this.options.dropBehaviour&&(c=a.ui.ddmanager.drop(this,b)),this.dropped&&(c=this.dropped,this.dropped=!1);if((!this.element[0]||!this.element[0].parentNode)&&this.options.helper=="original")return!1;if(this.options.revert=="invalid"&&!c||this.options.revert=="valid"&&c||this.options.revert===!0||a.isFunction(this.options.revert)&&this.options.revert.call(this.element,c)){var d=this;a(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){d._trigger("stop",b)!==!1&&d._clear()})}else this._trigger("stop",b)!==!1&&this._clear();return!1},_mouseUp:function(b){this.options.iframeFix===!0&&a("div.ui-draggable-iframeFix").each(function(){this.parentNode.removeChild(this)}),a.ui.ddmanager&&a.ui.ddmanager.dragStop(this,b);return a.ui.mouse.prototype._mouseUp.call(this,b)},cancel:function(){this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear();return this},_getHandle:function(b){var c=!this.options.handle||!a(this.options.handle,this.element).length?!0:!1;a(this.options.handle,this.element).find("*").andSelf().each(function(){this==b.target&&(c=!0)});return c},_createHelper:function(b){var c=this.options,d=a.isFunction(c.helper)?a(c.helper.apply(this.element[0],[b])):c.helper=="clone"?this.element.clone().removeAttr("id"):this.element;d.parents("body").length||d.appendTo(c.appendTo=="parent"?this.element[0].parentNode:c.appendTo),d[0]!=this.element[0]&&!/(fixed|absolute)/.test(d.css("position"))&&d.css("position","absolute");return d},_adjustOffsetFromHelper:function(b){typeof b=="string"&&(b=b.split(" ")),a.isArray(b)&&(b={left:+b[0],top:+b[1]||0}),"left"in b&&(this.offset.click.left=b.left+this.margins.left),"right"in b&&(this.offset.click.left=this.helperProportions.width-b.right+this.margins.left),"top"in b&&(this.offset.click.top=b.top+this.margins.top),"bottom"in b&&(this.offset.click.top=this.helperProportions.height-b.bottom+this.margins.top)},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var b=this.offsetParent.offset();this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&a.ui.contains(this.scrollParent[0],this.offsetParent[0])&&(b.left+=this.scrollParent.scrollLeft(),b.top+=this.scrollParent.scrollTop());if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&a.browser.msie)b={top:0,left:0};return{top:b.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:b.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var a=this.element.position();return{top:a.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:a.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var b=this.options;b.containment=="parent"&&(b.containment=this.helper[0].parentNode);if(b.containment=="document"||b.containment=="window")this.containment=[b.containment=="document"?0:a(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,b.containment=="document"?0:a(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,(b.containment=="document"?0:a(window).scrollLeft())+a(b.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(b.containment=="document"?0:a(window).scrollTop())+(a(b.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(b.containment)&&b.containment.constructor!=Array){var c=a(b.containment),d=c[0];if(!d)return;var e=c.offset(),f=a(d).css("overflow")!="hidden";this.containment=[(parseInt(a(d).css("borderLeftWidth"),10)||0)+(parseInt(a(d).css("paddingLeft"),10)||0),(parseInt(a(d).css("borderTopWidth"),10)||0)+(parseInt(a(d).css("paddingTop"),10)||0),(f?Math.max(d.scrollWidth,d.offsetWidth):d.offsetWidth)-(parseInt(a(d).css("borderLeftWidth"),10)||0)-(parseInt(a(d).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(f?Math.max(d.scrollHeight,d.offsetHeight):d.offsetHeight)-(parseInt(a(d).css("borderTopWidth"),10)||0)-(parseInt(a(d).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relative_container=c}else b.containment.constructor==Array&&(this.containment=b.containment)},_convertPositionTo:function(b,c){c||(c=this.position);var d=b=="absolute"?1:-1,e=this.options,f=this.cssPosition=="absolute"&&(this.scrollParent[0]==document||!a.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,g=/(html|body)/i.test(f[0].tagName);return{top:c.top+this.offset.relative.top*d+this.offset.parent.top*d-(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():g?0:f.scrollTop())*d),left:c.left+this.offset.relative.left*d+this.offset.parent.left*d-(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():g?0:f.scrollLeft())*d)}},_generatePosition:function(b){var c=this.options,d=this.cssPosition=="absolute"&&(this.scrollParent[0]==document||!a.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(d[0].tagName),f=b.pageX,g=b.pageY;if(this.originalPosition){var h;if(this.containment){if(this.relative_container){var i=this.relative_container.offset();h=[this.containment[0]+i.left,this.containment[1]+i.top,this.containment[2]+i.left,this.containment[3]+i.top]}else h=this.containment;b.pageX-this.offset.click.left<h[0]&&(f=h[0]+this.offset.click.left),b.pageY-this.offset.click.top<h[1]&&(g=h[1]+this.offset.click.top),b.pageX-this.offset.click.left>h[2]&&(f=h[2]+this.offset.click.left),b.pageY-this.offset.click.top>h[3]&&(g=h[3]+this.offset.click.top)}if(c.grid){var j=c.grid[1]?this.originalPageY+Math.round((g-this.originalPageY)/c.grid[1])*c.grid[1]:this.originalPageY;g=h?j-this.offset.click.top<h[1]||j-this.offset.click.top>h[3]?j-this.offset.click.top<h[1]?j+c.grid[1]:j-c.grid[1]:j:j;var k=c.grid[0]?this.originalPageX+Math.round((f-this.originalPageX)/c.grid[0])*c.grid[0]:this.originalPageX;f=h?k-this.offset.click.left<h[0]||k-this.offset.click.left>h[2]?k-this.offset.click.left<h[0]?k+c.grid[0]:k-c.grid[0]:k:k}}return{top:g-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:d.scrollTop()),left:f-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(a.browser.safari&&a.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:d.scrollLeft())}},_clear:function(){this.helper.removeClass("ui-draggable-dragging"),this.helper[0]!=this.element[0]&&!this.cancelHelperRemoval&&this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1},_trigger:function(b,c,d){d=d||this._uiHash(),a.ui.plugin.call(this,b,[c,d]),b=="drag"&&(this.positionAbs=this._convertPositionTo("absolute"));return a.Widget.prototype._trigger.call(this,b,c,d)},plugins:{},_uiHash:function(a){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),a.extend(a.ui.draggable,{version:"1.8.17"}),a.ui.plugin.add("draggable","connectToSortable",{start:function(b,c){var d=a(this).data("draggable"),e=d.options,f=a.extend({},c,{item:d.element});d.sortables=[],a(e.connectToSortable).each(function(){var c=a.data(this,"sortable");c&&!c.options.disabled&&(d.sortables.push({instance:c,shouldRevert:c.options.revert}),c.refreshPositions(),c._trigger("activate",b,f))})},stop:function(b,c){var d=a(this).data("draggable"),e=a.extend({},c,{item:d.element});a.each(d.sortables,function(){this.instance.isOver?(this.instance.isOver=0,d.cancelHelperRemoval=!0,this.instance.cancelHelperRemoval=!1,this.shouldRevert&&(this.instance.options.revert=!0),this.instance._mouseStop(b),this.instance.options.helper=this.instance.options._helper,d.options.helper=="original"&&this.instance.currentItem.css({top:"auto",left:"auto"})):(this.instance.cancelHelperRemoval=!1,this.instance._trigger("deactivate",b,e))})},drag:function(b,c){var d=a(this).data("draggable"),e=this,f=function(b){var c=this.offset.click.top,d=this.offset.click.left,e=this.positionAbs.top,f=this.positionAbs.left,g=b.height,h=b.width,i=b.top,j=b.left;return a.ui.isOver(e+c,f+d,i,j,g,h)};a.each(d.sortables,function(f){this.instance.positionAbs=d.positionAbs,this.instance.helperProportions=d.helperProportions,this.instance.offset.click=d.offset.click,this.instance._intersectsWith(this.instance.containerCache)?(this.instance.isOver||(this.instance.isOver=1,this.instance.currentItem=a(e).clone().removeAttr("id").appendTo(this.instance.element).data("sortable-item",!0),this.instance.options._helper=this.instance.options.helper,this.instance.options.helper=function(){return c.helper[0]},b.target=this.instance.currentItem[0],this.instance._mouseCapture(b,!0),this.instance._mouseStart(b,!0,!0),this.instance.offset.click.top=d.offset.click.top,this.instance.offset.click.left=d.offset.click.left,this.instance.offset.parent.left-=d.offset.parent.left-this.instance.offset.parent.left,this.instance.offset.parent.top-=d.offset.parent.top-this.instance.offset.parent.top,d._trigger("toSortable",b),d.dropped=this.instance.element,d.currentItem=d.element,this.instance.fromOutside=d),this.instance.currentItem&&this.instance._mouseDrag(b)):this.instance.isOver&&(this.instance.isOver=0,this.instance.cancelHelperRemoval=!0,this.instance.options.revert=!1,this.instance._trigger("out",b,this.instance._uiHash(this.instance)),this.instance._mouseStop(b,!0),this.instance.options.helper=this.instance.options._helper,this.instance.currentItem.remove(),this.instance.placeholder&&this.instance.placeholder.remove(),d._trigger("fromSortable",b),d.dropped=!1)})}}),a.ui.plugin.add("draggable","cursor",{start:function(b,c){var d=a("body"),e=a(this).data("draggable").options;d.css("cursor")&&(e._cursor=d.css("cursor")),d.css("cursor",e.cursor)},stop:function(b,c){var d=a(this).data("draggable").options;d._cursor&&a("body").css("cursor",d._cursor)}}),a.ui.plugin.add("draggable","opacity",{start:function(b,c){var d=a(c.helper),e=a(this).data("draggable").options;d.css("opacity")&&(e._opacity=d.css("opacity")),d.css("opacity",e.opacity)},stop:function(b,c){var d=a(this).data("draggable").options;d._opacity&&a(c.helper).css("opacity",d._opacity)}}),a.ui.plugin.add("draggable","scroll",{start:function(b,c){var d=a(this).data("draggable");d.scrollParent[0]!=document&&d.scrollParent[0].tagName!="HTML"&&(d.overflowOffset=d.scrollParent.offset())},drag:function(b,c){var d=a(this).data("draggable"),e=d.options,f=!1;if(d.scrollParent[0]!=document&&d.scrollParent[0].tagName!="HTML"){if(!e.axis||e.axis!="x")d.overflowOffset.top+d.scrollParent[0].offsetHeight-b.pageY<e.scrollSensitivity?d.scrollParent[0].scrollTop=f=d.scrollParent[0].scrollTop+e.scrollSpeed:b.pageY-d.overflowOffset.top<e.scrollSensitivity&&(d.scrollParent[0].scrollTop=f=d.scrollParent[0].scrollTop-e.scrollSpeed);if(!e.axis||e.axis!="y")d.overflowOffset.left+d.scrollParent[0].offsetWidth-b.pageX<e.scrollSensitivity?d.scrollParent[0].scrollLeft=f=d.scrollParent[0].scrollLeft+e.scrollSpeed:b.pageX-d.overflowOffset.left<e.scrollSensitivity&&(d.scrollParent[0].scrollLeft=f=d.scrollParent[0].scrollLeft-e.scrollSpeed)}else{if(!e.axis||e.axis!="x")b.pageY-a(document).scrollTop()<e.scrollSensitivity?f=a(document).scrollTop(a(document).scrollTop()-e.scrollSpeed):a(window).height()-(b.pageY-a(document).scrollTop())<e.scrollSensitivity&&(f=a(document).scrollTop(a(document).scrollTop()+e.scrollSpeed));if(!e.axis||e.axis!="y")b.pageX-a(document).scrollLeft()<e.scrollSensitivity?f=a(document).scrollLeft(a(document).scrollLeft()-e.scrollSpeed):a(window).width()-(b.pageX-a(document).scrollLeft())<e.scrollSensitivity&&(f=a(document).scrollLeft(a(document).scrollLeft()+e.scrollSpeed))}f!==!1&&a.ui.ddmanager&&!e.dropBehaviour&&a.ui.ddmanager.prepareOffsets(d,b)}}),a.ui.plugin.add("draggable","snap",{start:function(b,c){var d=a(this).data("draggable"),e=d.options;d.snapElements=[],a(e.snap.constructor!=String?e.snap.items||":data(draggable)":e.snap).each(function(){var b=a(this),c=b.offset();this!=d.element[0]&&d.snapElements.push({item:this,width:b.outerWidth(),height:b.outerHeight(),top:c.top,left:c.left})})},drag:function(b,c){var d=a(this).data("draggable"),e=d.options,f=e.snapTolerance,g=c.offset.left,h=g+d.helperProportions.width,i=c.offset.top,j=i+d.helperProportions.height;for(var k=d.snapElements.length-1;k>=0;k--){var l=d.snapElements[k].left,m=l+d.snapElements[k].width,n=d.snapElements[k].top,o=n+d.snapElements[k].height;if(!(l-f<g&&g<m+f&&n-f<i&&i<o+f||l-f<g&&g<m+f&&n-f<j&&j<o+f||l-f<h&&h<m+f&&n-f<i&&i<o+f||l-f<h&&h<m+f&&n-f<j&&j<o+f)){d.snapElements[k].snapping&&d.options.snap.release&&d.options.snap.release.call(d.element,b,a.extend(d._uiHash(),{snapItem:d.snapElements[k].item})),d.snapElements[k].snapping=!1;continue}if(e.snapMode!="inner"){var p=Math.abs(n-j)<=f,q=Math.abs(o-i)<=f,r=Math.abs(l-h)<=f,s=Math.abs(m-g)<=f;p&&(c.position.top=d._convertPositionTo("relative",{top:n-d.helperProportions.height,left:0}).top-d.margins.top),q&&(c.position.top=d._convertPositionTo("relative",{top:o,left:0}).top-d.margins.top),r&&(c.position.left=d._convertPositionTo("relative",{top:0,left:l-d.helperProportions.width}).left-d.margins.left),s&&(c.position.left=d._convertPositionTo("relative",{top:0,left:m}).left-d.margins.left)}var t=p||q||r||s;if(e.snapMode!="outer"){var p=Math.abs(n-i)<=f,q=Math.abs(o-j)<=f,r=Math.abs(l-g)<=f,s=Math.abs(m-h)<=f;p&&(c.position.top=d._convertPositionTo("relative",{top:n,left:0}).top-d.margins.top),q&&(c.position.top=d._convertPositionTo("relative",{top:o-d.helperProportions.height,left:0}).top-d.margins.top),r&&(c.position.left=d._convertPositionTo("relative",{top:0,left:l}).left-d.margins.left),s&&(c.position.left=d._convertPositionTo("relative",{top:0,left:m-d.helperProportions.width}).left-d.margins.left)}!d.snapElements[k].snapping&&(p||q||r||s||t)&&d.options.snap.snap&&d.options.snap.snap.call(d.element,b,a.extend(d._uiHash(),{snapItem:d.snapElements[k].item})),d.snapElements[k].snapping=p||q||r||s||t}}}),a.ui.plugin.add("draggable","stack",{start:function(b,c){var d=a(this).data("draggable").options,e=a.makeArray(a(d.stack)).sort(function(b,c){return(parseInt(a(b).css("zIndex"),10)||0)-(parseInt(a(c).css("zIndex"),10)||0)});if(!!e.length){var f=parseInt(e[0].style.zIndex)||0;a(e).each(function(a){this.style.zIndex=f+a}),this[0].style.zIndex=f+e.length}}}),a.ui.plugin.add("draggable","zIndex",{start:function(b,c){var d=a(c.helper),e=a(this).data("draggable").options;d.css("zIndex")&&(e._zIndex=d.css("zIndex")),d.css("zIndex",e.zIndex)},stop:function(b,c){var d=a(this).data("draggable").options;d._zIndex&&a(c.helper).css("zIndex",d._zIndex)}})})(jQuery);/*
 * jQuery UI Droppable 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Droppables
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	jquery.ui.mouse.js
 *	jquery.ui.draggable.js
 */(function(a,b){a.widget("ui.droppable",{widgetEventPrefix:"drop",options:{accept:"*",activeClass:!1,addClasses:!0,greedy:!1,hoverClass:!1,scope:"default",tolerance:"intersect"},_create:function(){var b=this.options,c=b.accept;this.isover=0,this.isout=1,this.accept=a.isFunction(c)?c:function(a){return a.is(c)},this.proportions={width:this.element[0].offsetWidth,height:this.element[0].offsetHeight},a.ui.ddmanager.droppables[b.scope]=a.ui.ddmanager.droppables[b.scope]||[],a.ui.ddmanager.droppables[b.scope].push(this),b.addClasses&&this.element.addClass("ui-droppable")},destroy:function(){var b=a.ui.ddmanager.droppables[this.options.scope];for(var c=0;c<b.length;c++)b[c]==this&&b.splice(c,1);this.element.removeClass("ui-droppable ui-droppable-disabled").removeData("droppable").unbind(".droppable");return this},_setOption:function(b,c){b=="accept"&&(this.accept=a.isFunction(c)?c:function(a){return a.is(c)}),a.Widget.prototype._setOption.apply(this,arguments)},_activate:function(b){var c=a.ui.ddmanager.current;this.options.activeClass&&this.element.addClass(this.options.activeClass),c&&this._trigger("activate",b,this.ui(c))},_deactivate:function(b){var c=a.ui.ddmanager.current;this.options.activeClass&&this.element.removeClass(this.options.activeClass),c&&this._trigger("deactivate",b,this.ui(c))},_over:function(b){var c=a.ui.ddmanager.current;!!c&&(c.currentItem||c.element)[0]!=this.element[0]&&this.accept.call(this.element[0],c.currentItem||c.element)&&(this.options.hoverClass&&this.element.addClass(this.options.hoverClass),this._trigger("over",b,this.ui(c)))},_out:function(b){var c=a.ui.ddmanager.current;!!c&&(c.currentItem||c.element)[0]!=this.element[0]&&this.accept.call(this.element[0],c.currentItem||c.element)&&(this.options.hoverClass&&this.element.removeClass(this.options.hoverClass),this._trigger("out",b,this.ui(c)))},_drop:function(b,c){var d=c||a.ui.ddmanager.current;if(!d||(d.currentItem||d.element)[0]==this.element[0])return!1;var e=!1;this.element.find(":data(droppable)").not(".ui-draggable-dragging").each(function(){var b=a.data(this,"droppable");if(b.options.greedy&&!b.options.disabled&&b.options.scope==d.options.scope&&b.accept.call(b.element[0],d.currentItem||d.element)&&a.ui.intersect(d,a.extend(b,{offset:b.element.offset()}),b.options.tolerance)){e=!0;return!1}});if(e)return!1;if(this.accept.call(this.element[0],d.currentItem||d.element)){this.options.activeClass&&this.element.removeClass(this.options.activeClass),this.options.hoverClass&&this.element.removeClass(this.options.hoverClass),this._trigger("drop",b,this.ui(d));return this.element}return!1},ui:function(a){return{draggable:a.currentItem||a.element,helper:a.helper,position:a.position,offset:a.positionAbs}}}),a.extend(a.ui.droppable,{version:"1.8.17"}),a.ui.intersect=function(b,c,d){if(!c.offset)return!1;var e=(b.positionAbs||b.position.absolute).left,f=e+b.helperProportions.width,g=(b.positionAbs||b.position.absolute).top,h=g+b.helperProportions.height,i=c.offset.left,j=i+c.proportions.width,k=c.offset.top,l=k+c.proportions.height;switch(d){case"fit":return i<=e&&f<=j&&k<=g&&h<=l;case"intersect":return i<e+b.helperProportions.width/2&&f-b.helperProportions.width/2<j&&k<g+b.helperProportions.height/2&&h-b.helperProportions.height/2<l;case"pointer":var m=(b.positionAbs||b.position.absolute).left+(b.clickOffset||b.offset.click).left,n=(b.positionAbs||b.position.absolute).top+(b.clickOffset||b.offset.click).top,o=a.ui.isOver(n,m,k,i,c.proportions.height,c.proportions.width);return o;case"touch":return(g>=k&&g<=l||h>=k&&h<=l||g<k&&h>l)&&(e>=i&&e<=j||f>=i&&f<=j||e<i&&f>j);default:return!1}},a.ui.ddmanager={current:null,droppables:{"default":[]},prepareOffsets:function(b,c){var d=a.ui.ddmanager.droppables[b.options.scope]||[],e=c?c.type:null,f=(b.currentItem||b.element).find(":data(droppable)").andSelf();droppablesLoop:for(var g=0;g<d.length;g++){if(d[g].options.disabled||b&&!d[g].accept.call(d[g].element[0],b.currentItem||b.element))continue;for(var h=0;h<f.length;h++)if(f[h]==d[g].element[0]){d[g].proportions.height=0;continue droppablesLoop}d[g].visible=d[g].element.css("display")!="none";if(!d[g].visible)continue;e=="mousedown"&&d[g]._activate.call(d[g],c),d[g].offset=d[g].element.offset(),d[g].proportions={width:d[g].element[0].offsetWidth,height:d[g].element[0].offsetHeight}}},drop:function(b,c){var d=!1;a.each(a.ui.ddmanager.droppables[b.options.scope]||[],function(){!this.options||(!this.options.disabled&&this.visible&&a.ui.intersect(b,this,this.options.tolerance)&&(d=this._drop.call(this,c)||d),!this.options.disabled&&this.visible&&this.accept.call(this.element[0],b.currentItem||b.element)&&(this.isout=1,this.isover=0,this._deactivate.call(this,c)))});return d},dragStart:function(b,c){b.element.parents(":not(body,html)").bind("scroll.droppable",function(){b.options.refreshPositions||a.ui.ddmanager.prepareOffsets(b,c)})},drag:function(b,c){b.options.refreshPositions&&a.ui.ddmanager.prepareOffsets(b,c),a.each(a.ui.ddmanager.droppables[b.options.scope]||[],function(){if(!(this.options.disabled||this.greedyChild||!this.visible)){var d=a.ui.intersect(b,this,this.options.tolerance),e=!d&&this.isover==1?"isout":d&&this.isover==0?"isover":null;if(!e)return;var f;if(this.options.greedy){var g=this.element.parents(":data(droppable):eq(0)");g.length&&(f=a.data(g[0],"droppable"),f.greedyChild=e=="isover"?1:0)}f&&e=="isover"&&(f.isover=0,f.isout=1,f._out.call(f,c)),this[e]=1,this[e=="isout"?"isover":"isout"]=0,this[e=="isover"?"_over":"_out"].call(this,c),f&&e=="isout"&&(f.isout=0,f.isover=1,f._over.call(f,c))}})},dragStop:function(b,c){b.element.parents(":not(body,html)").unbind("scroll.droppable"),b.options.refreshPositions||a.ui.ddmanager.prepareOffsets(b,c)}}})(jQuery);/*
 * jQuery UI Resizable 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Resizables
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.mouse.js
 *	jquery.ui.widget.js
 */(function(a,b){a.widget("ui.resizable",a.ui.mouse,{widgetEventPrefix:"resize",options:{alsoResize:!1,animate:!1,animateDuration:"slow",animateEasing:"swing",aspectRatio:!1,autoHide:!1,containment:!1,ghost:!1,grid:!1,handles:"e,s,se",helper:!1,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:1e3},_create:function(){var b=this,c=this.options;this.element.addClass("ui-resizable"),a.extend(this,{_aspectRatio:!!c.aspectRatio,aspectRatio:c.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:c.helper||c.ghost||c.animate?c.helper||"ui-resizable-helper":null}),this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)&&(/relative/.test(this.element.css("position"))&&a.browser.opera&&this.element.css({position:"relative",top:"auto",left:"auto"}),this.element.wrap(a('<div class="ui-wrapper" style="overflow: hidden;"></div>').css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")})),this.element=this.element.parent().data("resizable",this.element.data("resizable")),this.elementIsWrapper=!0,this.element.css({marginLeft:this.originalElement.css("marginLeft"),marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom")}),this.originalElement.css({marginLeft:0,marginTop:0,marginRight:0,marginBottom:0}),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"})),this.originalElement.css({margin:this.originalElement.css("margin")}),this._proportionallyResize()),this.handles=c.handles||(a(".ui-resizable-handle",this.element).length?{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"}:"e,s,se");if(this.handles.constructor==String){this.handles=="all"&&(this.handles="n,e,s,w,se,sw,ne,nw");var d=this.handles.split(",");this.handles={};for(var e=0;e<d.length;e++){var f=a.trim(d[e]),g="ui-resizable-"+f,h=a('<div class="ui-resizable-handle '+g+'"></div>');/sw|se|ne|nw/.test(f)&&h.css({zIndex:++c.zIndex}),"se"==f&&h.addClass("ui-icon ui-icon-gripsmall-diagonal-se"),this.handles[f]=".ui-resizable-"+f,this.element.append(h)}}this._renderAxis=function(b){b=b||this.element;for(var c in this.handles){this.handles[c].constructor==String&&(this.handles[c]=a(this.handles[c],this.element).show());if(this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)){var d=a(this.handles[c],this.element),e=0;e=/sw|ne|nw|se|n|s/.test(c)?d.outerHeight():d.outerWidth();var f=["padding",/ne|nw|n/.test(c)?"Top":/se|sw|s/.test(c)?"Bottom":/^e$/.test(c)?"Right":"Left"].join("");b.css(f,e),this._proportionallyResize()}if(!a(this.handles[c]).length)continue}},this._renderAxis(this.element),this._handles=a(".ui-resizable-handle",this.element).disableSelection(),this._handles.mouseover(function(){if(!b.resizing){if(this.className)var a=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i);b.axis=a&&a[1]?a[1]:"se"}}),c.autoHide&&(this._handles.hide(),a(this.element).addClass("ui-resizable-autohide").hover(function(){c.disabled||(a(this).removeClass("ui-resizable-autohide"),b._handles.show())},function(){c.disabled||b.resizing||(a(this).addClass("ui-resizable-autohide"),b._handles.hide())})),this._mouseInit()},destroy:function(){this._mouseDestroy();var b=function(b){a(b).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").unbind(".resizable").find(".ui-resizable-handle").remove()};if(this.elementIsWrapper){b(this.element);var c=this.element;c.after(this.originalElement.css({position:c.css("position"),width:c.outerWidth(),height:c.outerHeight(),top:c.css("top"),left:c.css("left")})).remove()}this.originalElement.css("resize",this.originalResizeStyle),b(this.originalElement);return this},_mouseCapture:function(b){var c=!1;for(var d in this.handles)a(this.handles[d])[0]==b.target&&(c=!0);return!this.options.disabled&&c},_mouseStart:function(b){var d=this.options,e=this.element.position(),f=this.element;this.resizing=!0,this.documentScroll={top:a(document).scrollTop(),left:a(document).scrollLeft()},(f.is(".ui-draggable")||/absolute/.test(f.css("position")))&&f.css({position:"absolute",top:e.top,left:e.left}),a.browser.opera&&/relative/.test(f.css("position"))&&f.css({position:"relative",top:"auto",left:"auto"}),this._renderProxy();var g=c(this.helper.css("left")),h=c(this.helper.css("top"));d.containment&&(g+=a(d.containment).scrollLeft()||0,h+=a(d.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={left:g,top:h},this.size=this._helper?{width:f.outerWidth(),height:f.outerHeight()}:{width:f.width(),height:f.height()},this.originalSize=this._helper?{width:f.outerWidth(),height:f.outerHeight()}:{width:f.width(),height:f.height()},this.originalPosition={left:g,top:h},this.sizeDiff={width:f.outerWidth()-f.width(),height:f.outerHeight()-f.height()},this.originalMousePosition={left:b.pageX,top:b.pageY},this.aspectRatio=typeof d.aspectRatio=="number"?d.aspectRatio:this.originalSize.width/this.originalSize.height||1;var i=a(".ui-resizable-"+this.axis).css("cursor");a("body").css("cursor",i=="auto"?this.axis+"-resize":i),f.addClass("ui-resizable-resizing"),this._propagate("start",b);return!0},_mouseDrag:function(b){var c=this.helper,d=this.options,e={},f=this,g=this.originalMousePosition,h=this.axis,i=b.pageX-g.left||0,j=b.pageY-g.top||0,k=this._change[h];if(!k)return!1;var l=k.apply(this,[b,i,j]),m=a.browser.msie&&a.browser.version<7,n=this.sizeDiff;this._updateVirtualBoundaries(b.shiftKey);if(this._aspectRatio||b.shiftKey)l=this._updateRatio(l,b);l=this._respectSize(l,b),this._propagate("resize",b),c.css({top:this.position.top+"px",left:this.position.left+"px",width:this.size.width+"px",height:this.size.height+"px"}),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),this._updateCache(l),this._trigger("resize",b,this.ui());return!1},_mouseStop:function(b){this.resizing=!1;var c=this.options,d=this;if(this._helper){var e=this._proportionallyResizeElements,f=e.length&&/textarea/i.test(e[0].nodeName),g=f&&a.ui.hasScroll(e[0],"left")?0:d.sizeDiff.height,h=f?0:d.sizeDiff.width,i={width:d.helper.width()-h,height:d.helper.height()-g},j=parseInt(d.element.css("left"),10)+(d.position.left-d.originalPosition.left)||null,k=parseInt(d.element.css("top"),10)+(d.position.top-d.originalPosition.top)||null;c.animate||this.element.css(a.extend(i,{top:k,left:j})),d.helper.height(d.size.height),d.helper.width(d.size.width),this._helper&&!c.animate&&this._proportionallyResize()}a("body").css("cursor","auto"),this.element.removeClass("ui-resizable-resizing"),this._propagate("stop",b),this._helper&&this.helper.remove();return!1},_updateVirtualBoundaries:function(a){var b=this.options,c,e,f,g,h;h={minWidth:d(b.minWidth)?b.minWidth:0,maxWidth:d(b.maxWidth)?b.maxWidth:Infinity,minHeight:d(b.minHeight)?b.minHeight:0,maxHeight:d(b.maxHeight)?b.maxHeight:Infinity};if(this._aspectRatio||a)c=h.minHeight*this.aspectRatio,f=h.minWidth/this.aspectRatio,e=h.maxHeight*this.aspectRatio,g=h.maxWidth/this.aspectRatio,c>h.minWidth&&(h.minWidth=c),f>h.minHeight&&(h.minHeight=f),e<h.maxWidth&&(h.maxWidth=e),g<h.maxHeight&&(h.maxHeight=g);this._vBoundaries=h},_updateCache:function(a){var b=this.options;this.offset=this.helper.offset(),d(a.left)&&(this.position.left=a.left),d(a.top)&&(this.position.top=a.top),d(a.height)&&(this.size.height=a.height),d(a.width)&&(this.size.width=a.width)},_updateRatio:function(a,b){var c=this.options,e=this.position,f=this.size,g=this.axis;d(a.height)?a.width=a.height*this.aspectRatio:d(a.width)&&(a.height=a.width/this.aspectRatio),g=="sw"&&(a.left=e.left+(f.width-a.width),a.top=null),g=="nw"&&(a.top=e.top+(f.height-a.height),a.left=e.left+(f.width-a.width));return a},_respectSize:function(a,b){var c=this.helper,e=this._vBoundaries,f=this._aspectRatio||b.shiftKey,g=this.axis,h=d(a.width)&&e.maxWidth&&e.maxWidth<a.width,i=d(a.height)&&e.maxHeight&&e.maxHeight<a.height,j=d(a.width)&&e.minWidth&&e.minWidth>a.width,k=d(a.height)&&e.minHeight&&e.minHeight>a.height;j&&(a.width=e.minWidth),k&&(a.height=e.minHeight),h&&(a.width=e.maxWidth),i&&(a.height=e.maxHeight);var l=this.originalPosition.left+this.originalSize.width,m=this.position.top+this.size.height,n=/sw|nw|w/.test(g),o=/nw|ne|n/.test(g);j&&n&&(a.left=l-e.minWidth),h&&n&&(a.left=l-e.maxWidth),k&&o&&(a.top=m-e.minHeight),i&&o&&(a.top=m-e.maxHeight);var p=!a.width&&!a.height;p&&!a.left&&a.top?a.top=null:p&&!a.top&&a.left&&(a.left=null);return a},_proportionallyResize:function(){var b=this.options;if(!!this._proportionallyResizeElements.length){var c=this.helper||this.element;for(var d=0;d<this._proportionallyResizeElements.length;d++){var e=this._proportionallyResizeElements[d];if(!this.borderDif){var f=[e.css("borderTopWidth"),e.css("borderRightWidth"),e.css("borderBottomWidth"),e.css("borderLeftWidth")],g=[e.css("paddingTop"),e.css("paddingRight"),e.css("paddingBottom"),e.css("paddingLeft")];this.borderDif=a.map(f,function(a,b){var c=parseInt(a,10)||0,d=parseInt(g[b],10)||0;return c+d})}if(a.browser.msie&&(!!a(c).is(":hidden")||!!a(c).parents(":hidden").length))continue;e.css({height:c.height()-this.borderDif[0]-this.borderDif[2]||0,width:c.width()-this.borderDif[1]-this.borderDif[3]||0})}}},_renderProxy:function(){var b=this.element,c=this.options;this.elementOffset=b.offset();if(this._helper){this.helper=this.helper||a('<div style="overflow:hidden;"></div>');var d=a.browser.msie&&a.browser.version<7,e=d?1:0,f=d?2:-1;this.helper.addClass(this._helper).css({width:this.element.outerWidth()+f,height:this.element.outerHeight()+f,position:"absolute",left:this.elementOffset.left-e+"px",top:this.elementOffset.top-e+"px",zIndex:++c.zIndex}),this.helper.appendTo("body").disableSelection()}else this.helper=this.element},_change:{e:function(a,b,c){return{width:this.originalSize.width+b}},w:function(a,b,c){var d=this.options,e=this.originalSize,f=this.originalPosition;return{left:f.left+b,width:e.width-b}},n:function(a,b,c){var d=this.options,e=this.originalSize,f=this.originalPosition;return{top:f.top+c,height:e.height-c}},s:function(a,b,c){return{height:this.originalSize.height+c}},se:function(b,c,d){return a.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[b,c,d]))},sw:function(b,c,d){return a.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[b,c,d]))},ne:function(b,c,d){return a.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[b,c,d]))},nw:function(b,c,d){return a.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[b,c,d]))}},_propagate:function(b,c){a.ui.plugin.call(this,b,[c,this.ui()]),b!="resize"&&this._trigger(b,c,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}),a.extend(a.ui.resizable,{version:"1.8.17"}),a.ui.plugin.add("resizable","alsoResize",{start:function(b,c){var d=a(this).data("resizable"),e=d.options,f=function(b){a(b).each(function(){var b=a(this);b.data("resizable-alsoresize",{width:parseInt(b.width(),10),height:parseInt(b.height(),10),left:parseInt(b.css("left"),10),top:parseInt(b.css("top"),10),position:b.css("position")})})};typeof e.alsoResize=="object"&&!e.alsoResize.parentNode?e.alsoResize.length?(e.alsoResize=e.alsoResize[0],f(e.alsoResize)):a.each(e.alsoResize,function(a){f(a)}):f(e.alsoResize)},resize:function(b,c){var d=a(this).data("resizable"),e=d.options,f=d.originalSize,g=d.originalPosition,h={height:d.size.height-f.height||0,width:d.size.width-f.width||0,top:d.position.top-g.top||0,left:d.position.left-g.left||0},i=function(b,e){a(b).each(function(){var b=a(this),f=a(this).data("resizable-alsoresize"),g={},i=e&&e.length?e:b.parents(c.originalElement[0]).length?["width","height"]:["width","height","top","left"];a.each(i,function(a,b){var c=(f[b]||0)+(h[b]||0);c&&c>=0&&(g[b]=c||null)}),a.browser.opera&&/relative/.test(b.css("position"))&&(d._revertToRelativePosition=!0,b.css({position:"absolute",top:"auto",left:"auto"})),b.css(g)})};typeof e.alsoResize=="object"&&!e.alsoResize.nodeType?a.each(e.alsoResize,function(a,b){i(a,b)}):i(e.alsoResize)},stop:function(b,c){var d=a(this).data("resizable"),e=d.options,f=function(b){a(b).each(function(){var b=a(this);b.css({position:b.data("resizable-alsoresize").position})})};d._revertToRelativePosition&&(d._revertToRelativePosition=!1,typeof e.alsoResize=="object"&&!e.alsoResize.nodeType?a.each(e.alsoResize,function(a){f(a)}):f(e.alsoResize)),a(this).removeData("resizable-alsoresize")}}),a.ui.plugin.add("resizable","animate",{stop:function(b,c){var d=a(this).data("resizable"),e=d.options,f=d._proportionallyResizeElements,g=f.length&&/textarea/i.test(f[0].nodeName),h=g&&a.ui.hasScroll(f[0],"left")?0:d.sizeDiff.height,i=g?0:d.sizeDiff.width,j={width:d.size.width-i,height:d.size.height-h},k=parseInt(d.element.css("left"),10)+(d.position.left-d.originalPosition.left)||null,l=parseInt(d.element.css("top"),10)+(d.position.top-d.originalPosition.top)||null;d.element.animate(a.extend(j,l&&k?{top:l,left:k}:{}),{duration:e.animateDuration,easing:e.animateEasing,step:function(){var c={width:parseInt(d.element.css("width"),10),height:parseInt(d.element.css("height"),10),top:parseInt(d.element.css("top"),10),left:parseInt(d.element.css("left"),10)};f&&f.length&&a(f[0]).css({width:c.width,height:c.height}),d._updateCache(c),d._propagate("resize",b)}})}}),a.ui.plugin.add("resizable","containment",{start:function(b,d){var e=a(this).data("resizable"),f=e.options,g=e.element,h=f.containment,i=h instanceof a?h.get(0):/parent/.test(h)?g.parent().get(0):h;if(!!i){e.containerElement=a(i);if(/document/.test(h)||h==document)e.containerOffset={left:0,top:0},e.containerPosition={left:0,top:0},e.parentData={element:a(document),left:0,top:0,width:a(document).width(),height:a(document).height()||document.body.parentNode.scrollHeight};else{var j=a(i),k=[];a(["Top","Right","Left","Bottom"]).each(function(a,b){k[a]=c(j.css("padding"+b))}),e.containerOffset=j.offset(),e.containerPosition=j.position(),e.containerSize={height:j.innerHeight()-k[3],width:j.innerWidth()-k[1]};var l=e.containerOffset,m=e.containerSize.height,n=e.containerSize.width,o=a.ui.hasScroll(i,"left")?i.scrollWidth:n,p=a.ui.hasScroll(i)?i.scrollHeight:m;e.parentData={element:i,left:l.left,top:l.top,width:o,height:p}}}},resize:function(b,c){var d=a(this).data("resizable"),e=d.options,f=d.containerSize,g=d.containerOffset,h=d.size,i=d.position,j=d._aspectRatio||b.shiftKey,k={top:0,left:0},l=d.containerElement;l[0]!=document&&/static/.test(l.css("position"))&&(k=g),i.left<(d._helper?g.left:0)&&(d.size.width=d.size.width+(d._helper?d.position.left-g.left:d.position.left-k.left),j&&(d.size.height=d.size.width/e.aspectRatio),d.position.left=e.helper?g.left:0),i.top<(d._helper?g.top:0)&&(d.size.height=d.size.height+(d._helper?d.position.top-g.top:d.position.top),j&&(d.size.width=d.size.height*e.aspectRatio),d.position.top=d._helper?g.top:0),d.offset.left=d.parentData.left+d.position.left,d.offset.top=d.parentData.top+d.position.top;var m=Math.abs((d._helper?d.offset.left-k.left:d.offset.left-k.left)+d.sizeDiff.width),n=Math.abs((d._helper?d.offset.top-k.top:d.offset.top-g.top)+d.sizeDiff.height),o=d.containerElement.get(0)==d.element.parent().get(0),p=/relative|absolute/.test(d.containerElement.css("position"));o&&p&&(m-=d.parentData.left),m+d.size.width>=d.parentData.width&&(d.size.width=d.parentData.width-m,j&&(d.size.height=d.size.width/d.aspectRatio)),n+d.size.height>=d.parentData.height&&(d.size.height=d.parentData.height-n,j&&(d.size.width=d.size.height*d.aspectRatio))},stop:function(b,c){var d=a(this).data("resizable"),e=d.options,f=d.position,g=d.containerOffset,h=d.containerPosition,i=d.containerElement,j=a(d.helper),k=j.offset(),l=j.outerWidth()-d.sizeDiff.width,m=j.outerHeight()-d.sizeDiff.height;d._helper&&!e.animate&&/relative/.test(i.css("position"))&&a(this).css({left:k.left-h.left-g.left,width:l,height:m}),d._helper&&!e.animate&&/static/.test(i.css("position"))&&a(this).css({left:k.left-h.left-g.left,width:l,height:m})}}),a.ui.plugin.add("resizable","ghost",{start:function(b,c){var d=a(this).data("resizable"),e=d.options,f=d.size;d.ghost=d.originalElement.clone(),d.ghost.css({opacity:.25,display:"block",position:"relative",height:f.height,width:f.width,margin:0,left:0,top:0}).addClass("ui-resizable-ghost").addClass(typeof e.ghost=="string"?e.ghost:""),d.ghost.appendTo(d.helper)},resize:function(b,c){var d=a(this).data("resizable"),e=d.options;d.ghost&&d.ghost.css({position:"relative",height:d.size.height,width:d.size.width})},stop:function(b,c){var d=a(this).data("resizable"),e=d.options;d.ghost&&d.helper&&d.helper.get(0).removeChild(d.ghost.get(0))}}),a.ui.plugin.add("resizable","grid",{resize:function(b,c){var d=a(this).data("resizable"),e=d.options,f=d.size,g=d.originalSize,h=d.originalPosition,i=d.axis,j=e._aspectRatio||b.shiftKey;e.grid=typeof e.grid=="number"?[e.grid,e.grid]:e.grid;var k=Math.round((f.width-g.width)/(e.grid[0]||1))*(e.grid[0]||1),l=Math.round((f.height-g.height)/(e.grid[1]||1))*(e.grid[1]||1);/^(se|s|e)$/.test(i)?(d.size.width=g.width+k,d.size.height=g.height+l):/^(ne)$/.test(i)?(d.size.width=g.width+k,d.size.height=g.height+l,d.position.top=h.top-l):/^(sw)$/.test(i)?(d.size.width=g.width+k,d.size.height=g.height+l,d.position.left=h.left-k):(d.size.width=g.width+k,d.size.height=g.height+l,d.position.top=h.top-l,d.position.left=h.left-k)}});var c=function(a){return parseInt(a,10)||0},d=function(a){return!isNaN(parseInt(a,10))}})(jQuery);/*
 * jQuery UI Selectable 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Selectables
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.mouse.js
 *	jquery.ui.widget.js
 */(function(a,b){a.widget("ui.selectable",a.ui.mouse,{options:{appendTo:"body",autoRefresh:!0,distance:0,filter:"*",tolerance:"touch"},_create:function(){var b=this;this.element.addClass("ui-selectable"),this.dragged=!1;var c;this.refresh=function(){c=a(b.options.filter,b.element[0]),c.addClass("ui-selectee"),c.each(function(){var b=a(this),c=b.offset();a.data(this,"selectable-item",{element:this,$element:b,left:c.left,top:c.top,right:c.left+b.outerWidth(),bottom:c.top+b.outerHeight(),startselected:!1,selected:b.hasClass("ui-selected"),selecting:b.hasClass("ui-selecting"),unselecting:b.hasClass("ui-unselecting")})})},this.refresh(),this.selectees=c.addClass("ui-selectee"),this._mouseInit(),this.helper=a("<div class='ui-selectable-helper'></div>")},destroy:function(){this.selectees.removeClass("ui-selectee").removeData("selectable-item"),this.element.removeClass("ui-selectable ui-selectable-disabled").removeData("selectable").unbind(".selectable"),this._mouseDestroy();return this},_mouseStart:function(b){var c=this;this.opos=[b.pageX,b.pageY];if(!this.options.disabled){var d=this.options;this.selectees=a(d.filter,this.element[0]),this._trigger("start",b),a(d.appendTo).append(this.helper),this.helper.css({left:b.clientX,top:b.clientY,width:0,height:0}),d.autoRefresh&&this.refresh(),this.selectees.filter(".ui-selected").each(function(){var d=a.data(this,"selectable-item");d.startselected=!0,!b.metaKey&&!b.ctrlKey&&(d.$element.removeClass("ui-selected"),d.selected=!1,d.$element.addClass("ui-unselecting"),d.unselecting=!0,c._trigger("unselecting",b,{unselecting:d.element}))}),a(b.target).parents().andSelf().each(function(){var d=a.data(this,"selectable-item");if(d){var e=!b.metaKey&&!b.ctrlKey||!d.$element.hasClass("ui-selected");d.$element.removeClass(e?"ui-unselecting":"ui-selected").addClass(e?"ui-selecting":"ui-unselecting"),d.unselecting=!e,d.selecting=e,d.selected=e,e?c._trigger("selecting",b,{selecting:d.element}):c._trigger("unselecting",b,{unselecting:d.element});return!1}})}},_mouseDrag:function(b){var c=this;this.dragged=!0;if(!this.options.disabled){var d=this.options,e=this.opos[0],f=this.opos[1],g=b.pageX,h=b.pageY;if(e>g){var i=g;g=e,e=i}if(f>h){var i=h;h=f,f=i}this.helper.css({left:e,top:f,width:g-e,height:h-f}),this.selectees.each(function(){var i=a.data(this,"selectable-item");if(!!i&&i.element!=c.element[0]){var j=!1;d.tolerance=="touch"?j=!(i.left>g||i.right<e||i.top>h||i.bottom<f):d.tolerance=="fit"&&(j=i.left>e&&i.right<g&&i.top>f&&i.bottom<h),j?(i.selected&&(i.$element.removeClass("ui-selected"),i.selected=!1),i.unselecting&&(i.$element.removeClass("ui-unselecting"),i.unselecting=!1),i.selecting||(i.$element.addClass("ui-selecting"),i.selecting=!0,c._trigger("selecting",b,{selecting:i.element}))):(i.selecting&&((b.metaKey||b.ctrlKey)&&i.startselected?(i.$element.removeClass("ui-selecting"),i.selecting=!1,i.$element.addClass("ui-selected"),i.selected=!0):(i.$element.removeClass("ui-selecting"),i.selecting=!1,i.startselected&&(i.$element.addClass("ui-unselecting"),i.unselecting=!0),c._trigger("unselecting",b,{unselecting:i.element}))),i.selected&&!b.metaKey&&!b.ctrlKey&&!i.startselected&&(i.$element.removeClass("ui-selected"),i.selected=!1,i.$element.addClass("ui-unselecting"),i.unselecting=!0,c._trigger("unselecting",b,{unselecting:i.element})))}});return!1}},_mouseStop:function(b){var c=this;this.dragged=!1;var d=this.options;a(".ui-unselecting",this.element[0]).each(function(){var d=a.data(this,"selectable-item");d.$element.removeClass("ui-unselecting"),d.unselecting=!1,d.startselected=!1,c._trigger("unselected",b,{unselected:d.element})}),a(".ui-selecting",this.element[0]).each(function(){var d=a.data(this,"selectable-item");d.$element.removeClass("ui-selecting").addClass("ui-selected"),d.selecting=!1,d.selected=!0,d.startselected=!0,c._trigger("selected",b,{selected:d.element})}),this._trigger("stop",b),this.helper.remove();return!1}}),a.extend(a.ui.selectable,{version:"1.8.17"})})(jQuery);/*
 * jQuery UI Sortable 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Sortables
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.mouse.js
 *	jquery.ui.widget.js
 */(function(a,b){a.widget("ui.sortable",a.ui.mouse,{widgetEventPrefix:"sort",options:{appendTo:"parent",axis:!1,connectWith:!1,containment:!1,cursor:"auto",cursorAt:!1,dropOnEmpty:!0,forcePlaceholderSize:!1,forceHelperSize:!1,grid:!1,handle:!1,helper:"original",items:"> *",opacity:!1,placeholder:!1,revert:!1,scroll:!0,scrollSensitivity:20,scrollSpeed:20,scope:"default",tolerance:"intersect",zIndex:1e3},_create:function(){var a=this.options;this.containerCache={},this.element.addClass("ui-sortable"),this.refresh(),this.floating=this.items.length?a.axis==="x"||/left|right/.test(this.items[0].item.css("float"))||/inline|table-cell/.test(this.items[0].item.css("display")):!1,this.offset=this.element.offset(),this._mouseInit()},destroy:function(){this.element.removeClass("ui-sortable ui-sortable-disabled"),this._mouseDestroy();for(var a=this.items.length-1;a>=0;a--)this.items[a].item.removeData(this.widgetName+"-item");return this},_setOption:function(b,c){b==="disabled"?(this.options[b]=c,this.widget()[c?"addClass":"removeClass"]("ui-sortable-disabled")):a.Widget.prototype._setOption.apply(this,arguments)},_mouseCapture:function(b,c){var d=this;if(this.reverting)return!1;if(this.options.disabled||this.options.type=="static")return!1;this._refreshItems(b);var e=null,f=this,g=a(b.target).parents().each(function(){if(a.data(this,d.widgetName+"-item")==f){e=a(this);return!1}});a.data(b.target,d.widgetName+"-item")==f&&(e=a(b.target));if(!e)return!1;if(this.options.handle&&!c){var h=!1;a(this.options.handle,e).find("*").andSelf().each(function(){this==b.target&&(h=!0)});if(!h)return!1}this.currentItem=e,this._removeCurrentsFromItems();return!0},_mouseStart:function(b,c,d){var e=this.options,f=this;this.currentContainer=this,this.refreshPositions(),this.helper=this._createHelper(b),this._cacheHelperProportions(),this._cacheMargins(),this.scrollParent=this.helper.scrollParent(),this.offset=this.currentItem.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},this.helper.css("position","absolute"),this.cssPosition=this.helper.css("position"),a.extend(this.offset,{click:{left:b.pageX-this.offset.left,top:b.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.originalPosition=this._generatePosition(b),this.originalPageX=b.pageX,this.originalPageY=b.pageY,e.cursorAt&&this._adjustOffsetFromHelper(e.cursorAt),this.domPosition={prev:this.currentItem.prev()[0],parent:this.currentItem.parent()[0]},this.helper[0]!=this.currentItem[0]&&this.currentItem.hide(),this._createPlaceholder(),e.containment&&this._setContainment(),e.cursor&&(a("body").css("cursor")&&(this._storedCursor=a("body").css("cursor")),a("body").css("cursor",e.cursor)),e.opacity&&(this.helper.css("opacity")&&(this._storedOpacity=this.helper.css("opacity")),this.helper.css("opacity",e.opacity)),e.zIndex&&(this.helper.css("zIndex")&&(this._storedZIndex=this.helper.css("zIndex")),this.helper.css("zIndex",e.zIndex)),this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML"&&(this.overflowOffset=this.scrollParent.offset()),this._trigger("start",b,this._uiHash()),this._preserveHelperProportions||this._cacheHelperProportions();if(!d)for(var g=this.containers.length-1;g>=0;g--)this.containers[g]._trigger("activate",b,f._uiHash(this));a.ui.ddmanager&&(a.ui.ddmanager.current=this),a.ui.ddmanager&&!e.dropBehaviour&&a.ui.ddmanager.prepareOffsets(this,b),this.dragging=!0,this.helper.addClass("ui-sortable-helper"),this._mouseDrag(b);return!0},_mouseDrag:function(b){this.position=this._generatePosition(b),this.positionAbs=this._convertPositionTo("absolute"),this.lastPositionAbs||(this.lastPositionAbs=this.positionAbs);if(this.options.scroll){var c=this.options,d=!1;this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML"?(this.overflowOffset.top+this.scrollParent[0].offsetHeight-b.pageY<c.scrollSensitivity?this.scrollParent[0].scrollTop=d=this.scrollParent[0].scrollTop+c.scrollSpeed:b.pageY-this.overflowOffset.top<c.scrollSensitivity&&(this.scrollParent[0].scrollTop=d=this.scrollParent[0].scrollTop-c.scrollSpeed),this.overflowOffset.left+this.scrollParent[0].offsetWidth-b.pageX<c.scrollSensitivity?this.scrollParent[0].scrollLeft=d=this.scrollParent[0].scrollLeft+c.scrollSpeed:b.pageX-this.overflowOffset.left<c.scrollSensitivity&&(this.scrollParent[0].scrollLeft=d=this.scrollParent[0].scrollLeft-c.scrollSpeed)):(b.pageY-a(document).scrollTop()<c.scrollSensitivity?d=a(document).scrollTop(a(document).scrollTop()-c.scrollSpeed):a(window).height()-(b.pageY-a(document).scrollTop())<c.scrollSensitivity&&(d=a(document).scrollTop(a(document).scrollTop()+c.scrollSpeed)),b.pageX-a(document).scrollLeft()<c.scrollSensitivity?d=a(document).scrollLeft(a(document).scrollLeft()-c.scrollSpeed):a(window).width()-(b.pageX-a(document).scrollLeft())<c.scrollSensitivity&&(d=a(document).scrollLeft(a(document).scrollLeft()+c.scrollSpeed))),d!==!1&&a.ui.ddmanager&&!c.dropBehaviour&&a.ui.ddmanager.prepareOffsets(this,b)}this.positionAbs=this._convertPositionTo("absolute");if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";for(var e=this.items.length-1;e>=0;e--){var f=this.items[e],g=f.item[0],h=this._intersectsWithPointer(f);if(!h)continue;if(g!=this.currentItem[0]&&this.placeholder[h==1?"next":"prev"]()[0]!=g&&!a.ui.contains(this.placeholder[0],g)&&(this.options.type=="semi-dynamic"?!a.ui.contains(this.element[0],g):!0)){this.direction=h==1?"down":"up";if(this.options.tolerance=="pointer"||this._intersectsWithSides(f))this._rearrange(b,f);else break;this._trigger("change",b,this._uiHash());break}}this._contactContainers(b),a.ui.ddmanager&&a.ui.ddmanager.drag(this,b),this._trigger("sort",b,this._uiHash()),this.lastPositionAbs=this.positionAbs;return!1},_mouseStop:function(b,c){if(!!b){a.ui.ddmanager&&!this.options.dropBehaviour&&a.ui.ddmanager.drop(this,b);if(this.options.revert){var d=this,e=d.placeholder.offset();d.reverting=!0,a(this.helper).animate({left:e.left-this.offset.parent.left-d.margins.left+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollLeft),top:e.top-this.offset.parent.top-d.margins.top+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollTop)},parseInt(this.options.revert,10)||500,function(){d._clear(b)})}else this._clear(b,c);return!1}},cancel:function(){var b=this;if(this.dragging){this._mouseUp({target:null}),this.options.helper=="original"?this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper"):this.currentItem.show();for(var c=this.containers.length-1;c>=0;c--)this.containers[c]._trigger("deactivate",null,b._uiHash(this)),this.containers[c].containerCache.over&&(this.containers[c]._trigger("out",null,b._uiHash(this)),this.containers[c].containerCache.over=0)}this.placeholder&&(this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.options.helper!="original"&&this.helper&&this.helper[0].parentNode&&this.helper.remove(),a.extend(this,{helper:null,dragging:!1,reverting:!1,_noFinalSort:null}),this.domPosition.prev?a(this.domPosition.prev).after(this.currentItem):a(this.domPosition.parent).prepend(this.currentItem));return this},serialize:function(b){var c=this._getItemsAsjQuery(b&&b.connected),d=[];b=b||{},a(c).each(function(){var c=(a(b.item||this).attr(b.attribute||"id")||"").match(b.expression||/(.+)[-=_](.+)/);c&&d.push((b.key||c[1]+"[]")+"="+(b.key&&b.expression?c[1]:c[2]))}),!d.length&&b.key&&d.push(b.key+"=");return d.join("&")},toArray:function(b){var c=this._getItemsAsjQuery(b&&b.connected),d=[];b=b||{},c.each(function(){d.push(a(b.item||this).attr(b.attribute||"id")||"")});return d},_intersectsWith:function(a){var b=this.positionAbs.left,c=b+this.helperProportions.width,d=this.positionAbs.top,e=d+this.helperProportions.height,f=a.left,g=f+a.width,h=a.top,i=h+a.height,j=this.offset.click.top,k=this.offset.click.left,l=d+j>h&&d+j<i&&b+k>f&&b+k<g;return this.options.tolerance=="pointer"||this.options.forcePointerForContainers||this.options.tolerance!="pointer"&&this.helperProportions[this.floating?"width":"height"]>a[this.floating?"width":"height"]?l:f<b+this.helperProportions.width/2&&c-this.helperProportions.width/2<g&&h<d+this.helperProportions.height/2&&e-this.helperProportions.height/2<i},_intersectsWithPointer:function(b){var c=a.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,b.top,b.height),d=a.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,b.left,b.width),e=c&&d,f=this._getDragVerticalDirection(),g=this._getDragHorizontalDirection();if(!e)return!1;return this.floating?g&&g=="right"||f=="down"?2:1:f&&(f=="down"?2:1)},_intersectsWithSides:function(b){var c=a.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,b.top+b.height/2,b.height),d=a.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,b.left+b.width/2,b.width),e=this._getDragVerticalDirection(),f=this._getDragHorizontalDirection();return this.floating&&f?f=="right"&&d||f=="left"&&!d:e&&(e=="down"&&c||e=="up"&&!c)},_getDragVerticalDirection:function(){var a=this.positionAbs.top-this.lastPositionAbs.top;return a!=0&&(a>0?"down":"up")},_getDragHorizontalDirection:function(){var a=this.positionAbs.left-this.lastPositionAbs.left;return a!=0&&(a>0?"right":"left")},refresh:function(a){this._refreshItems(a),this.refreshPositions();return this},_connectWith:function(){var a=this.options;return a.connectWith.constructor==String?[a.connectWith]:a.connectWith},_getItemsAsjQuery:function(b){var c=this,d=[],e=[],f=this._connectWith();if(f&&b)for(var g=f.length-1;g>=0;g--){var h=a(f[g]);for(var i=h.length-1;i>=0;i--){var j=a.data(h[i],this.widgetName);j&&j!=this&&!j.options.disabled&&e.push([a.isFunction(j.options.items)?j.options.items.call(j.element):a(j.options.items,j.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),j])}}e.push([a.isFunction(this.options.items)?this.options.items.call(this.element,null,{options:this.options,item:this.currentItem}):a(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]);for(var g=e.length-1;g>=0;g--)e[g][0].each(function(){d.push(this)});return a(d)},_removeCurrentsFromItems:function(){var a=this.currentItem.find(":data("+this.widgetName+"-item)");for(var b=0;b<this.items.length;b++)for(var c=0;c<a.length;c++)a[c]==this.items[b].item[0]&&this.items.splice(b,1)},_refreshItems:function(b){this.items=[],this.containers=[this];var c=this.items,d=this,e=[[a.isFunction(this.options.items)?this.options.items.call(this.element[0],b,{item:this.currentItem}):a(this.options.items,this.element),this]],f=this._connectWith();if(f)for(var g=f.length-1;g>=0;g--){var h=a(f[g]);for(var i=h.length-1;i>=0;i--){var j=a.data(h[i],this.widgetName);j&&j!=this&&!j.options.disabled&&(e.push([a.isFunction(j.options.items)?j.options.items.call(j.element[0],b,{item:this.currentItem}):a(j.options.items,j.element),j]),this.containers.push(j))}}for(var g=e.length-1;g>=0;g--){var k=e[g][1],l=e[g][0];for(var i=0,m=l.length;i<m;i++){var n=a(l[i]);n.data(this.widgetName+"-item",k),c.push({item:n,instance:k,width:0,height:0,left:0,top:0})}}},refreshPositions:function(b){this.offsetParent&&this.helper&&(this.offset.parent=this._getParentOffset());for(var c=this.items.length-1;c>=0;c--){var d=this.items[c];if(d.instance!=this.currentContainer&&this.currentContainer&&d.item[0]!=this.currentItem[0])continue;var e=this.options.toleranceElement?a(this.options.toleranceElement,d.item):d.item;b||(d.width=e.outerWidth(),d.height=e.outerHeight());var f=e.offset();d.left=f.left,d.top=f.top}if(this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(var c=this.containers.length-1;c>=0;c--){var f=this.containers[c].element.offset();this.containers[c].containerCache.left=f.left,this.containers[c].containerCache.top=f.top,this.containers[c].containerCache.width=this.containers[c].element.outerWidth(),this.containers[c].containerCache.height=this.containers[c].element.outerHeight()}return this},_createPlaceholder:function(b){var c=b||this,d=c.options;if(!d.placeholder||d.placeholder.constructor==String){var e=d.placeholder;d.placeholder={element:function(){var b=a(document.createElement(c.currentItem[0].nodeName)).addClass(e||c.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper")[0];e||(b.style.visibility="hidden");return b},update:function(a,b){if(!e||!!d.forcePlaceholderSize)b.height()||b.height(c.currentItem.innerHeight()-parseInt(c.currentItem.css("paddingTop")||0,10)-parseInt(c.currentItem.css("paddingBottom")||0,10)),b.width()||b.width(c.currentItem.innerWidth()-parseInt(c.currentItem.css("paddingLeft")||0,10)-parseInt(c.currentItem.css("paddingRight")||0,10))}}}c.placeholder=a(d.placeholder.element.call(c.element,c.currentItem)),c.currentItem.after(c.placeholder),d.placeholder.update(c,c.placeholder)},_contactContainers:function(b){var c=null,d=null;for(var e=this.containers.length-1;e>=0;e--){if(a.ui.contains(this.currentItem[0],this.containers[e].element[0]))continue;if(this._intersectsWith(this.containers[e].containerCache)){if(c&&a.ui.contains(this.containers[e].element[0],c.element[0]))continue;c=this.containers[e],d=e}else this.containers[e].containerCache.over&&(this.containers[e]._trigger("out",b,this._uiHash(this)),this.containers[e].containerCache.over=0)}if(!!c)if(this.containers.length===1)this.containers[d]._trigger("over",b,this._uiHash(this)),this.containers[d].containerCache.over=1;else if(this.currentContainer!=this.containers[d]){var f=1e4,g=null,h=this.positionAbs[this.containers[d].floating?"left":"top"];for(var i=this.items.length-1;i>=0;i--){if(!a.ui.contains(this.containers[d].element[0],this.items[i].item[0]))continue;var j=this.items[i][this.containers[d].floating?"left":"top"];Math.abs(j-h)<f&&(f=Math.abs(j-h),g=this.items[i])}if(!g&&!this.options.dropOnEmpty)return;this.currentContainer=this.containers[d],g?this._rearrange(b,g,null,!0):this._rearrange(b,null,this.containers[d].element,!0),this._trigger("change",b,this._uiHash()),this.containers[d]._trigger("change",b,this._uiHash(this)),this.options.placeholder.update(this.currentContainer,this.placeholder),this.containers[d]._trigger("over",b,this._uiHash(this)),this.containers[d].containerCache.over=1}},_createHelper:function(b){var c=this.options,d=a.isFunction(c.helper)?a(c.helper.apply(this.element[0],[b,this.currentItem])):c.helper=="clone"?this.currentItem.clone():this.currentItem;d.parents("body").length||a(c.appendTo!="parent"?c.appendTo:this.currentItem[0].parentNode)[0].appendChild(d[0]),d[0]==this.currentItem[0]&&(this._storedCSS={width:this.currentItem[0].style.width,height:this.currentItem[0].style.height,position:this.currentItem.css("position"),top:this.currentItem.css("top"),left:this.currentItem.css("left")}),(d[0].style.width==""||c.forceHelperSize)&&d.width(this.currentItem.width()),(d[0].style.height==""||c.forceHelperSize)&&d.height(this.currentItem.height());return d},_adjustOffsetFromHelper:function(b){typeof b=="string"&&(b=b.split(" ")),a.isArray(b)&&(b={left:+b[0],top:+b[1]||0}),"left"in b&&(this.offset.click.left=b.left+this.margins.left),"right"in b&&(this.offset.click.left=this.helperProportions.width-b.right+this.margins.left),"top"in b&&(this.offset.click.top=b.top+this.margins.top),"bottom"in b&&(this.offset.click.top=this.helperProportions.height-b.bottom+this.margins.top)},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var b=this.offsetParent.offset();this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&a.ui.contains(this.scrollParent[0],this.offsetParent[0])&&(b.left+=this.scrollParent.scrollLeft(),b.top+=this.scrollParent.scrollTop());if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&a.browser.msie)b={top:0,left:0};return{top:b.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:b.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var a=this.currentItem.position();return{top:a.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:a.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.currentItem.css("marginLeft"),10)||0,top:parseInt(this.currentItem.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var b=this.options;b.containment=="parent"&&(b.containment=this.helper[0].parentNode);if(b.containment=="document"||b.containment=="window")this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,a(b.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(a(b.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(b.containment)){var c=a(b.containment)[0],d=a(b.containment).offset(),e=a(c).css("overflow")!="hidden";this.containment=[d.left+(parseInt(a(c).css("borderLeftWidth"),10)||0)+(parseInt(a(c).css("paddingLeft"),10)||0)-this.margins.left,d.top+(parseInt(a(c).css("borderTopWidth"),10)||0)+(parseInt(a(c).css("paddingTop"),10)||0)-this.margins.top,d.left+(e?Math.max(c.scrollWidth,c.offsetWidth):c.offsetWidth)-(parseInt(a(c).css("borderLeftWidth"),10)||0)-(parseInt(a(c).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,d.top+(e?Math.max(c.scrollHeight,c.offsetHeight):c.offsetHeight)-(parseInt(a(c).css("borderTopWidth"),10)||0)-(parseInt(a(c).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]}},_convertPositionTo:function(b,c){c||(c=this.position);var d=b=="absolute"?1:-1,e=this.options,f=this.cssPosition=="absolute"&&(this.scrollParent[0]==document||!a.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,g=/(html|body)/i.test(f[0].tagName);return{top:c.top+this.offset.relative.top*d+this.offset.parent.top*d-(a.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():g?0:f.scrollTop())*d),left:c.left+this.offset.relative.left*d+this.offset.parent.left*d-(a.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():g?0:f.scrollLeft())*d)}},_generatePosition:function(b){var c=this.options,d=this.cssPosition=="absolute"&&(this.scrollParent[0]==document||!a.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(d[0].tagName);this.cssPosition=="relative"&&(this.scrollParent[0]==document||this.scrollParent[0]==this.offsetParent[0])&&(this.offset.relative=this._getRelativeOffset());var f=b.pageX,g=b.pageY;if(this.originalPosition){this.containment&&(b.pageX-this.offset.click.left<this.containment[0]&&(f=this.containment[0]+this.offset.click.left),b.pageY-this.offset.click.top<this.containment[1]&&(g=this.containment[1]+this.offset.click.top),b.pageX-this.offset.click.left>this.containment[2]&&(f=this.containment[2]+this.offset.click.left),b.pageY-this.offset.click.top>this.containment[3]&&(g=this.containment[3]+this.offset.click.top));if(c.grid){var h=this.originalPageY+Math.round((g-this.originalPageY)/c.grid[1])*c.grid[1];g=this.containment?h-this.offset.click.top<this.containment[1]||h-this.offset.click.top>this.containment[3]?h-this.offset.click.top<this.containment[1]?h+c.grid[1]:h-c.grid[1]:h:h;var i=this.originalPageX+Math.round((f-this.originalPageX)/c.grid[0])*c.grid[0];f=this.containment?i-this.offset.click.left<this.containment[0]||i-this.offset.click.left>this.containment[2]?i-this.offset.click.left<this.containment[0]?i+c.grid[0]:i-c.grid[0]:i:i}}return{top:g-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(a.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:d.scrollTop()),left:f-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(a.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:d.scrollLeft())}},_rearrange:function(a,b,c,d){c?c[0].appendChild(this.placeholder[0]):b.item[0].parentNode.insertBefore(this.placeholder[0],this.direction=="down"?b.item[0]:b.item[0].nextSibling),this.counter=this.counter?++this.counter:1;var e=this,f=this.counter;window.setTimeout(function(){f==e.counter&&e.refreshPositions(!d)},0)},_clear:function(b,c){this.reverting=!1;var d=[],e=this;!this._noFinalSort&&this.currentItem.parent().length&&this.placeholder.before(this.currentItem),this._noFinalSort=null;if(this.helper[0]==this.currentItem[0]){for(var f in this._storedCSS)if(this._storedCSS[f]=="auto"||this._storedCSS[f]=="static")this._storedCSS[f]="";this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")}else this.currentItem.show();this.fromOutside&&!c&&d.push(function(a){this._trigger("receive",a,this._uiHash(this.fromOutside))}),(this.fromOutside||this.domPosition.prev!=this.currentItem.prev().not(".ui-sortable-helper")[0]||this.domPosition.parent!=this.currentItem.parent()[0])&&!c&&d.push(function(a){this._trigger("update",a,this._uiHash())});if(!a.ui.contains(this.element[0],this.currentItem[0])){c||d.push(function(a){this._trigger("remove",a,this._uiHash())});for(var f=this.containers.length-1;f>=0;f--)a.ui.contains(this.containers[f].element[0],this.currentItem[0])&&!c&&(d.push(function(a){return function(b){a._trigger("receive",b,this._uiHash(this))}}.call(this,this.containers[f])),d.push(function(a){return function(b){a._trigger("update",b,this._uiHash(this))}}.call(this,this.containers[f])))}for(var f=this.containers.length-1;f>=0;f--)c||d.push(function(a){return function(b){a._trigger("deactivate",b,this._uiHash(this))}}.call(this,this.containers[f])),this.containers[f].containerCache.over&&(d.push(function(a){return function(b){a._trigger("out",b,this._uiHash(this))}}.call(this,this.containers[f])),this.containers[f].containerCache.over=0);this._storedCursor&&a("body").css("cursor",this._storedCursor),this._storedOpacity&&this.helper.css("opacity",this._storedOpacity),this._storedZIndex&&this.helper.css("zIndex",this._storedZIndex=="auto"?"":this._storedZIndex),this.dragging=!1;if(this.cancelHelperRemoval){if(!c){this._trigger("beforeStop",b,this._uiHash());for(var f=0;f<d.length;f++)d[f].call(this,b);this._trigger("stop",b,this._uiHash())}return!1}c||this._trigger("beforeStop",b,this._uiHash()),this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.helper[0]!=this.currentItem[0]&&this.helper.remove(),this.helper=null;if(!c){for(var f=0;f<d.length;f++)d[f].call(this,b);this._trigger("stop",b,this._uiHash())}this.fromOutside=!1;return!0},_trigger:function(){a.Widget.prototype._trigger.apply(this,arguments)===!1&&this.cancel()},_uiHash:function(b){var c=b||this;return{helper:c.helper,placeholder:c.placeholder||a([]),position:c.position,originalPosition:c.originalPosition,offset:c.positionAbs,item:c.currentItem,sender:b?b.element:null}}}),a.extend(a.ui.sortable,{version:"1.8.17"})})(jQuery);/*
 * jQuery UI Accordion 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Accordion
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */(function(a,b){a.widget("ui.accordion",{options:{active:0,animated:"slide",autoHeight:!0,clearStyle:!1,collapsible:!1,event:"click",fillSpace:!1,header:"> li > :first-child,> :not(li):even",icons:{header:"ui-icon-triangle-1-e",headerSelected:"ui-icon-triangle-1-s"},navigation:!1,navigationFilter:function(){return this.href.toLowerCase()===location.href.toLowerCase()}},_create:function(){var b=this,c=b.options;b.running=0,b.element.addClass("ui-accordion ui-widget ui-helper-reset").children("li").addClass("ui-accordion-li-fix"),b.headers=b.element.find(c.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion",function(){c.disabled||a(this).addClass("ui-state-hover")}).bind("mouseleave.accordion",function(){c.disabled||a(this).removeClass("ui-state-hover")}).bind("focus.accordion",function(){c.disabled||a(this).addClass("ui-state-focus")}).bind("blur.accordion",function(){c.disabled||a(this).removeClass("ui-state-focus")}),b.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");if(c.navigation){var d=b.element.find("a").filter(c.navigationFilter).eq(0);if(d.length){var e=d.closest(".ui-accordion-header");e.length?b.active=e:b.active=d.closest(".ui-accordion-content").prev()}}b.active=b._findActive(b.active||c.active).addClass("ui-state-default ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top"),b.active.next().addClass("ui-accordion-content-active"),b._createIcons(),b.resize(),b.element.attr("role","tablist"),b.headers.attr("role","tab").bind("keydown.accordion",function(a){return b._keydown(a)}).next().attr("role","tabpanel"),b.headers.not(b.active||"").attr({"aria-expanded":"false","aria-selected":"false",tabIndex:-1}).next().hide(),b.active.length?b.active.attr({"aria-expanded":"true","aria-selected":"true",tabIndex:0}):b.headers.eq(0).attr("tabIndex",0),a.browser.safari||b.headers.find("a").attr("tabIndex",-1),c.event&&b.headers.bind(c.event.split(" ").join(".accordion ")+".accordion",function(a){b._clickHandler.call(b,a,this),a.preventDefault()})},_createIcons:function(){var b=this.options;b.icons&&(a("<span></span>").addClass("ui-icon "+b.icons.header).prependTo(this.headers),this.active.children(".ui-icon").toggleClass(b.icons.header).toggleClass(b.icons.headerSelected),this.element.addClass("ui-accordion-icons"))},_destroyIcons:function(){this.headers.children(".ui-icon").remove(),this.element.removeClass("ui-accordion-icons")},destroy:function(){var b=this.options;this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"),this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-accordion-disabled ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("tabIndex"),this.headers.find("a").removeAttr("tabIndex"),this._destroyIcons();var c=this.headers.next().css("display","").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-accordion-disabled ui-state-disabled");(b.autoHeight||b.fillHeight)&&c.css("height","");return a.Widget.prototype.destroy.call(this)},_setOption:function(b,c){a.Widget.prototype._setOption.apply(this,arguments),b=="active"&&this.activate(c),b=="icons"&&(this._destroyIcons(),c&&this._createIcons()),b=="disabled"&&this.headers.add(this.headers.next())[c?"addClass":"removeClass"]("ui-accordion-disabled ui-state-disabled")},_keydown:function(b){if(!(this.options.disabled||b.altKey||b.ctrlKey)){var c=a.ui.keyCode,d=this.headers.length,e=this.headers.index(b.target),f=!1;switch(b.keyCode){case c.RIGHT:case c.DOWN:f=this.headers[(e+1)%d];break;case c.LEFT:case c.UP:f=this.headers[(e-1+d)%d];break;case c.SPACE:case c.ENTER:this._clickHandler({target:b.target},b.target),b.preventDefault()}if(f){a(b.target).attr("tabIndex",-1),a(f).attr("tabIndex",0),f.focus();return!1}return!0}},resize:function(){var b=this.options,c;if(b.fillSpace){if(a.browser.msie){var d=this.element.parent().css("overflow");this.element.parent().css("overflow","hidden")}c=this.element.parent().height(),a.browser.msie&&this.element.parent().css("overflow",d),this.headers.each(function(){c-=a(this).outerHeight(!0)}),this.headers.next().each(function(){a(this).height(Math.max(0,c-a(this).innerHeight()+a(this).height()))}).css("overflow","auto")}else b.autoHeight&&(c=0,this.headers.next().each(function(){c=Math.max(c,a(this).height("").height())}).height(c));return this},activate:function(a){this.options.active=a;var b=this._findActive(a)[0];this._clickHandler({target:b},b);return this},_findActive:function(b){return b?typeof b=="number"?this.headers.filter(":eq("+b+")"):this.headers.not(this.headers.not(b)):b===!1?a([]):this.headers.filter(":eq(0)")},_clickHandler:function(b,c){var d=this.options;if(!d.disabled){if(!b.target){if(!d.collapsible)return;this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header),this.active.next().addClass("ui-accordion-content-active");var e=this.active.next(),f={options:d,newHeader:a([]),oldHeader:d.active,newContent:a([]),oldContent:e},g=this.active=a([]);this._toggle(g,e,f);return}var h=a(b.currentTarget||c),i=h[0]===this.active[0];d.active=d.collapsible&&i?!1:this.headers.index(h);if(this.running||!d.collapsible&&i)return;var j=this.active,g=h.next(),e=this.active.next(),f={options:d,newHeader:i&&d.collapsible?a([]):h,oldHeader:this.active,newContent:i&&d.collapsible?a([]):g,oldContent:e},k=this.headers.index(this.active[0])>this.headers.index(h[0]);this.active=i?a([]):h,this._toggle(g,e,f,i,k),j.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(d.icons.headerSelected).addClass(d.icons.header),i||(h.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").children(".ui-icon").removeClass(d.icons.header).addClass(d.icons.headerSelected),h.next().addClass("ui-accordion-content-active"));return}},_toggle:function(b,c,d,e,f){var g=this,h=g.options;g.toShow=b,g.toHide=c,g.data=d;var i=function(){if(!!g)return g._completed.apply(g,arguments)};g._trigger("changestart",null,g.data),g.running=c.size()===0?b.size():c.size();if(h.animated){var j={};h.collapsible&&e?j={toShow:a([]),toHide:c,complete:i,down:f,autoHeight:h.autoHeight||h.fillSpace}:j={toShow:b,toHide:c,complete:i,down:f,autoHeight:h.autoHeight||h.fillSpace},h.proxied||(h.proxied=h.animated),h.proxiedDuration||(h.proxiedDuration=h.duration),h.animated=a.isFunction(h.proxied)?h.proxied(j):h.proxied,h.duration=a.isFunction(h.proxiedDuration)?h.proxiedDuration(j):h.proxiedDuration;var k=a.ui.accordion.animations,l=h.duration,m=h.animated;m&&!k[m]&&!a.easing[m]&&(m="slide"),k[m]||(k[m]=function(a){this.slide(a,{easing:m,duration:l||700})}),k[m](j)}else h.collapsible&&e?b.toggle():(c.hide(),b.show()),i(!0);c.prev().attr({"aria-expanded":"false","aria-selected":"false",tabIndex:-1}).blur(),b.prev().attr({"aria-expanded":"true","aria-selected":"true",tabIndex:0}).focus()},_completed:function(a){this.running=a?0:--this.running;this.running||(this.options.clearStyle&&this.toShow.add(this.toHide).css({height:"",overflow:""}),this.toHide.removeClass("ui-accordion-content-active"),this.toHide.length&&(this.toHide.parent()[0].className=this.toHide.parent()[0].className),this._trigger("change",null,this.data))}}),a.extend(a.ui.accordion,{version:"1.8.17",animations:{slide:function(b,c){b=a.extend({easing:"swing",duration:300},b,c);if(!b.toHide.size())b.toShow.animate({height:"show",paddingTop:"show",paddingBottom:"show"},b);else{if(!b.toShow.size()){b.toHide.animate({height:"hide",paddingTop:"hide",paddingBottom:"hide"},b);return}var d=b.toShow.css("overflow"),e=0,f={},g={},h=["height","paddingTop","paddingBottom"],i,j=b.toShow;i=j[0].style.width,j.width(j.parent().width()-parseFloat(j.css("paddingLeft"))-parseFloat(j.css("paddingRight"))-(parseFloat(j.css("borderLeftWidth"))||0)-(parseFloat(j.css("borderRightWidth"))||0)),a.each(h,function(c,d){g[d]="hide";var e=(""+a.css(b.toShow[0],d)).match(/^([\d+-.]+)(.*)$/);f[d]={value:e[1],unit:e[2]||"px"}}),b.toShow.css({height:0,overflow:"hidden"}).show(),b.toHide.filter(":hidden").each(b.complete).end().filter(":visible").animate(g,{step:function(a,c){c.prop=="height"&&(e=c.end-c.start===0?0:(c.now-c.start)/(c.end-c.start)),b.toShow[0].style[c.prop]=e*f[c.prop].value+f[c.prop].unit},duration:b.duration,easing:b.easing,complete:function(){b.autoHeight||b.toShow.css("height",""),b.toShow.css({width:i,overflow:d}),b.complete()}})}},bounceslide:function(a){this.slide(a,{easing:a.down?"easeOutBounce":"swing",duration:a.down?1e3:200})}}})})(jQuery);/*
 * jQuery UI Autocomplete 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Autocomplete
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *	jquery.ui.position.js
 */(function(a,b){var c=0;a.widget("ui.autocomplete",{options:{appendTo:"body",autoFocus:!1,delay:300,minLength:1,position:{my:"left top",at:"left bottom",collision:"none"},source:null},pending:0,_create:function(){var b=this,c=this.element[0].ownerDocument,d;this.element.addClass("ui-autocomplete-input").attr("autocomplete","off").attr({role:"textbox","aria-autocomplete":"list","aria-haspopup":"true"}).bind("keydown.autocomplete",function(c){if(!b.options.disabled&&!b.element.propAttr("readOnly")){d=!1;var e=a.ui.keyCode;switch(c.keyCode){case e.PAGE_UP:b._move("previousPage",c);break;case e.PAGE_DOWN:b._move("nextPage",c);break;case e.UP:b._move("previous",c),c.preventDefault();break;case e.DOWN:b._move("next",c),c.preventDefault();break;case e.ENTER:case e.NUMPAD_ENTER:b.menu.active&&(d=!0,c.preventDefault());case e.TAB:if(!b.menu.active)return;b.menu.select(c);break;case e.ESCAPE:b.element.val(b.term),b.close(c);break;default:clearTimeout(b.searching),b.searching=setTimeout(function(){b.term!=b.element.val()&&(b.selectedItem=null,b.search(null,c))},b.options.delay)}}}).bind("keypress.autocomplete",function(a){d&&(d=!1,a.preventDefault())}).bind("focus.autocomplete",function(){b.options.disabled||(b.selectedItem=null,b.previous=b.element.val())}).bind("blur.autocomplete",function(a){b.options.disabled||(clearTimeout(b.searching),b.closing=setTimeout(function(){b.close(a),b._change(a)},150))}),this._initSource(),this.response=function(){return b._response.apply(b,arguments)},this.menu=a("<ul></ul>").addClass("ui-autocomplete").appendTo(a(this.options.appendTo||"body",c)[0]).mousedown(function(c){var d=b.menu.element[0];a(c.target).closest(".ui-menu-item").length||setTimeout(function(){a(document).one("mousedown",function(c){c.target!==b.element[0]&&c.target!==d&&!a.ui.contains(d,c.target)&&b.close()})},1),setTimeout(function(){clearTimeout(b.closing)},13)}).menu({focus:function(a,c){var d=c.item.data("item.autocomplete");!1!==b._trigger("focus",a,{item:d})&&/^key/.test(a.originalEvent.type)&&b.element.val(d.value)},selected:function(a,d){var e=d.item.data("item.autocomplete"),f=b.previous;b.element[0]!==c.activeElement&&(b.element.focus(),b.previous=f,setTimeout(function(){b.previous=f,b.selectedItem=e},1)),!1!==b._trigger("select",a,{item:e})&&b.element.val(e.value),b.term=b.element.val(),b.close(a),b.selectedItem=e},blur:function(a,c){b.menu.element.is(":visible")&&b.element.val()!==b.term&&b.element.val(b.term)}}).zIndex(this.element.zIndex()+1).css({top:0,left:0}).hide().data("menu"),a.fn.bgiframe&&this.menu.element.bgiframe(),b.beforeunloadHandler=function(){b.element.removeAttr("autocomplete")},a(window).bind("beforeunload",b.beforeunloadHandler)},destroy:function(){this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete").removeAttr("role").removeAttr("aria-autocomplete").removeAttr("aria-haspopup"),this.menu.element.remove(),a(window).unbind("beforeunload",this.beforeunloadHandler),a.Widget.prototype.destroy.call(this)},_setOption:function(b,c){a.Widget.prototype._setOption.apply(this,arguments),b==="source"&&this._initSource(),b==="appendTo"&&this.menu.element.appendTo(a(c||"body",this.element[0].ownerDocument)[0]),b==="disabled"&&c&&this.xhr&&this.xhr.abort()},_initSource:function(){var b=this,d,e;a.isArray(this.options.source)?(d=this.options.source,this.source=function(b,c){c(a.ui.autocomplete.filter(d,b.term))}):typeof this.options.source=="string"?(e=this.options.source,this.source=function(d,f){b.xhr&&b.xhr.abort(),b.xhr=a.ajax({url:e,data:d,dataType:"json",autocompleteRequest:++c,success:function(a,b){this.autocompleteRequest===c&&f(a)},error:function(){this.autocompleteRequest===c&&f([])}})}):this.source=this.options.source},search:function(a,b){a=a!=null?a:this.element.val(),this.term=this.element.val();if(a.length<this.options.minLength)return this.close(b);clearTimeout(this.closing);if(this._trigger("search",b)!==!1)return this._search(a)},_search:function(a){this.pending++,this.element.addClass("ui-autocomplete-loading"),this.source({term:a},this.response)},_response:function(a){!this.options.disabled&&a&&a.length?(a=this._normalize(a),this._suggest(a),this._trigger("open")):this.close(),this.pending--,this.pending||this.element.removeClass("ui-autocomplete-loading")},close:function(a){clearTimeout(this.closing),this.menu.element.is(":visible")&&(this.menu.element.hide(),this.menu.deactivate(),this._trigger("close",a))},_change:function(a){this.previous!==this.element.val()&&this._trigger("change",a,{item:this.selectedItem})},_normalize:function(b){if(b.length&&b[0].label&&b[0].value)return b;return a.map(b,function(b){if(typeof b=="string")return{label:b,value:b};return a.extend({label:b.label||b.value,value:b.value||b.label},b)})},_suggest:function(b){var c=this.menu.element.empty().zIndex(this.element.zIndex()+1);this._renderMenu(c,b),this.menu.deactivate(),this.menu.refresh(),c.show(),this._resizeMenu(),c.position(a.extend({of:this.element},this.options.position)),this.options.autoFocus&&this.menu.next(new a.Event("mouseover"))},_resizeMenu:function(){var a=this.menu.element;a.outerWidth(Math.max(a.width("").outerWidth()+1,this.element.outerWidth()))},_renderMenu:function(b,c){var d=this;a.each(c,function(a,c){d._renderItem(b,c)})},_renderItem:function(b,c){return a("<li></li>").data("item.autocomplete",c).append(a("<a></a>").text(c.label)).appendTo(b)},_move:function(a,b){if(!this.menu.element.is(":visible"))this.search(null,b);else{if(this.menu.first()&&/^previous/.test(a)||this.menu.last()&&/^next/.test(a)){this.element.val(this.term),this.menu.deactivate();return}this.menu[a](b)}},widget:function(){return this.menu.element}}),a.extend(a.ui.autocomplete,{escapeRegex:function(a){return a.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")},filter:function(b,c){var d=new RegExp(a.ui.autocomplete.escapeRegex(c),"i");return a.grep(b,function(a){return d.test(a.label||a.value||a)})}})})(jQuery),function(a){a.widget("ui.menu",{_create:function(){var b=this;this.element.addClass("ui-menu ui-widget ui-widget-content ui-corner-all").attr({role:"listbox","aria-activedescendant":"ui-active-menuitem"}).click(function(c){!a(c.target).closest(".ui-menu-item a").length||(c.preventDefault(),b.select(c))}),this.refresh()},refresh:function(){var b=this,c=this.element.children("li:not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role","menuitem");c.children("a").addClass("ui-corner-all").attr("tabindex",-1).mouseenter(function(c){b.activate(c,a(this).parent())}).mouseleave(function(){b.deactivate()})},activate:function(a,b){this.deactivate();if(this.hasScroll()){var c=b.offset().top-this.element.offset().top,d=this.element.scrollTop(),e=this.element.height();c<0?this.element.scrollTop(d+c):c>=e&&this.element.scrollTop(d+c-e+b.height())}this.active=b.eq(0).children("a").addClass("ui-state-hover").attr("id","ui-active-menuitem").end(),this._trigger("focus",a,{item:b})},deactivate:function(){!this.active||(this.active.children("a").removeClass("ui-state-hover").removeAttr("id"),this._trigger("blur"),this.active=null)},next:function(a){this.move("next",".ui-menu-item:first",a)},previous:function(a){this.move("prev",".ui-menu-item:last",a)},first:function(){return this.active&&!this.active.prevAll(".ui-menu-item").length},last:function(){return this.active&&!this.active.nextAll(".ui-menu-item").length},move:function(a,b,c){if(!this.active)this.activate(c,this.element.children(b));else{var d=this.active[a+"All"](".ui-menu-item").eq(0);d.length?this.activate(c,d):this.activate(c,this.element.children(b))}},nextPage:function(b){if(this.hasScroll()){if(!this.active||this.last()){this.activate(b,this.element.children(".ui-menu-item:first"));return}var c=this.active.offset().top,d=this.element.height(),e=this.element.children(".ui-menu-item").filter(function(){var b=a(this).offset().top-c-d+a(this).height();return b<10&&b>-10});e.length||(e=this.element.children(".ui-menu-item:last")),this.activate(b,e)}else this.activate(b,this.element.children(".ui-menu-item").filter(!this.active||this.last()?":first":":last"))},previousPage:function(b){if(this.hasScroll()){if(!this.active||this.first()){this.activate(b,this.element.children(".ui-menu-item:last"));return}var c=this.active.offset().top,d=this.element.height();result=this.element.children(".ui-menu-item").filter(function(){var b=a(this).offset().top-c+d-a(this).height();return b<10&&b>-10}),result.length||(result=this.element.children(".ui-menu-item:first")),this.activate(b,result)}else this.activate(b,this.element.children(".ui-menu-item").filter(!this.active||this.first()?":last":":first"))},hasScroll:function(){return this.element.height()<this.element[a.fn.prop?"prop":"attr"]("scrollHeight")},select:function(a){this._trigger("selected",a,{item:this.active})}})}(jQuery);/*
 * jQuery UI Button 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Button
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */(function(a,b){var c,d,e,f,g="ui-button ui-widget ui-state-default ui-corner-all",h="ui-state-hover ui-state-active ",i="ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",j=function(){var b=a(this).find(":ui-button");setTimeout(function(){b.button("refresh")},1)},k=function(b){var c=b.name,d=b.form,e=a([]);c&&(d?e=a(d).find("[name='"+c+"']"):e=a("[name='"+c+"']",b.ownerDocument).filter(function(){return!this.form}));return e};a.widget("ui.button",{options:{disabled:null,text:!0,label:null,icons:{primary:null,secondary:null}},_create:function(){this.element.closest("form").unbind("reset.button").bind("reset.button",j),typeof this.options.disabled!="boolean"&&(this.options.disabled=this.element.propAttr("disabled")),this._determineButtonType(),this.hasTitle=!!this.buttonElement.attr("title");var b=this,h=this.options,i=this.type==="checkbox"||this.type==="radio",l="ui-state-hover"+(i?"":" ui-state-active"),m="ui-state-focus";h.label===null&&(h.label=this.buttonElement.html()),this.element.is(":disabled")&&(h.disabled=!0),this.buttonElement.addClass(g).attr("role","button").bind("mouseenter.button",function(){h.disabled||(a(this).addClass("ui-state-hover"),this===c&&a(this).addClass("ui-state-active"))}).bind("mouseleave.button",function(){h.disabled||a(this).removeClass(l)}).bind("click.button",function(a){h.disabled&&(a.preventDefault(),a.stopImmediatePropagation())}),this.element.bind("focus.button",function(){b.buttonElement.addClass(m)}).bind("blur.button",function(){b.buttonElement.removeClass(m)}),i&&(this.element.bind("change.button",function(){f||b.refresh()}),this.buttonElement.bind("mousedown.button",function(a){h.disabled||(f=!1,d=a.pageX,e=a.pageY)}).bind("mouseup.button",function(a){!h.disabled&&(d!==a.pageX||e!==a.pageY)&&(f=!0)})),this.type==="checkbox"?this.buttonElement.bind("click.button",function(){if(h.disabled||f)return!1;a(this).toggleClass("ui-state-active"),b.buttonElement.attr("aria-pressed",b.element[0].checked)}):this.type==="radio"?this.buttonElement.bind("click.button",function(){if(h.disabled||f)return!1;a(this).addClass("ui-state-active"),b.buttonElement.attr("aria-pressed","true");var c=b.element[0];k(c).not(c).map(function(){return a(this).button("widget")[0]}).removeClass("ui-state-active").attr("aria-pressed","false")}):(this.buttonElement.bind("mousedown.button",function(){if(h.disabled)return!1;a(this).addClass("ui-state-active"),c=this,a(document).one("mouseup",function(){c=null})}).bind("mouseup.button",function(){if(h.disabled)return!1;a(this).removeClass("ui-state-active")}).bind("keydown.button",function(b){if(h.disabled)return!1;(b.keyCode==a.ui.keyCode.SPACE||b.keyCode==a.ui.keyCode.ENTER)&&a(this).addClass("ui-state-active")}).bind("keyup.button",function(){a(this).removeClass("ui-state-active")}),this.buttonElement.is("a")&&this.buttonElement.keyup(function(b){b.keyCode===a.ui.keyCode.SPACE&&a(this).click()})),this._setOption("disabled",h.disabled),this._resetButton()},_determineButtonType:function(){this.element.is(":checkbox")?this.type="checkbox":this.element.is(":radio")?this.type="radio":this.element.is("input")?this.type="input":this.type="button";if(this.type==="checkbox"||this.type==="radio"){var a=this.element.parents().filter(":last"),b="label[for='"+this.element.attr("id")+"']";this.buttonElement=a.find(b),this.buttonElement.length||(a=a.length?a.siblings():this.element.siblings(),this.buttonElement=a.filter(b),this.buttonElement.length||(this.buttonElement=a.find(b))),this.element.addClass("ui-helper-hidden-accessible");var c=this.element.is(":checked");c&&this.buttonElement.addClass("ui-state-active"),this.buttonElement.attr("aria-pressed",c)}else this.buttonElement=this.element},widget:function(){return this.buttonElement},destroy:function(){this.element.removeClass("ui-helper-hidden-accessible"),this.buttonElement.removeClass(g+" "+h+" "+i).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()),this.hasTitle||this.buttonElement.removeAttr("title"),a.Widget.prototype.destroy.call(this)},_setOption:function(b,c){a.Widget.prototype._setOption.apply(this,arguments);b==="disabled"?c?this.element.propAttr("disabled",!0):this.element.propAttr("disabled",!1):this._resetButton()},refresh:function(){var b=this.element.is(":disabled");b!==this.options.disabled&&this._setOption("disabled",b),this.type==="radio"?k(this.element[0]).each(function(){a(this).is(":checked")?a(this).button("widget").addClass("ui-state-active").attr("aria-pressed","true"):a(this).button("widget").removeClass("ui-state-active").attr("aria-pressed","false")}):this.type==="checkbox"&&(this.element.is(":checked")?this.buttonElement.addClass("ui-state-active").attr("aria-pressed","true"):this.buttonElement.removeClass("ui-state-active").attr("aria-pressed","false"))},_resetButton:function(){if(this.type==="input")this.options.label&&this.element.val(this.options.label);else{var b=this.buttonElement.removeClass(i),c=a("<span></span>",this.element[0].ownerDocument).addClass("ui-button-text").html(this.options.label).appendTo(b.empty()).text(),d=this.options.icons,e=d.primary&&d.secondary,f=[];d.primary||d.secondary?(this.options.text&&f.push("ui-button-text-icon"+(e?"s":d.primary?"-primary":"-secondary")),d.primary&&b.prepend("<span class='ui-button-icon-primary ui-icon "+d.primary+"'></span>"),d.secondary&&b.append("<span class='ui-button-icon-secondary ui-icon "+d.secondary+"'></span>"),this.options.text||(f.push(e?"ui-button-icons-only":"ui-button-icon-only"),this.hasTitle||b.attr("title",c))):f.push("ui-button-text-only"),b.addClass(f.join(" "))}}}),a.widget("ui.buttonset",{options:{items:":button, :submit, :reset, :checkbox, :radio, a, :data(button)"},_create:function(){this.element.addClass("ui-buttonset")},_init:function(){this.refresh()},_setOption:function(b,c){b==="disabled"&&this.buttons.button("option",b,c),a.Widget.prototype._setOption.apply(this,arguments)},refresh:function(){var b=this.element.css("direction")==="rtl";this.buttons=this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function(){return a(this).button("widget")[0]}).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(b?"ui-corner-right":"ui-corner-left").end().filter(":last").addClass(b?"ui-corner-left":"ui-corner-right").end().end()},destroy:function(){this.element.removeClass("ui-buttonset"),this.buttons.map(function(){return a(this).button("widget")[0]}).removeClass("ui-corner-left ui-corner-right").end().button("destroy"),a.Widget.prototype.destroy.call(this)}})})(jQuery);/*
 * jQuery UI Dialog 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Dialog
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *  jquery.ui.button.js
 *	jquery.ui.draggable.js
 *	jquery.ui.mouse.js
 *	jquery.ui.position.js
 *	jquery.ui.resizable.js
 */(function(a,b){var c="ui-dialog ui-widget ui-widget-content ui-corner-all ",d={buttons:!0,height:!0,maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0,width:!0},e={maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0},f=a.attrFn||{val:!0,css:!0,html:!0,text:!0,data:!0,width:!0,height:!0,offset:!0,click:!0};a.widget("ui.dialog",{options:{autoOpen:!0,buttons:{},closeOnEscape:!0,closeText:"close",dialogClass:"",draggable:!0,hide:null,height:"auto",maxHeight:!1,maxWidth:!1,minHeight:150,minWidth:150,modal:!1,position:{my:"center",at:"center",collision:"fit",using:function(b){var c=a(this).css(b).offset().top;c<0&&a(this).css("top",b.top-c)}},resizable:!0,show:null,stack:!0,title:"",width:300,zIndex:1e3},_create:function(){this.originalTitle=this.element.attr("title"),typeof this.originalTitle!="string"&&(this.originalTitle=""),this.options.title=this.options.title||this.originalTitle;var b=this,d=b.options,e=d.title||"&#160;",f=a.ui.dialog.getTitleId(b.element),g=(b.uiDialog=a("<div></div>")).appendTo(document.body).hide().addClass(c+d.dialogClass).css({zIndex:d.zIndex}).attr("tabIndex",-1).css("outline",0).keydown(function(c){d.closeOnEscape&&!c.isDefaultPrevented()&&c.keyCode&&c.keyCode===a.ui.keyCode.ESCAPE&&(b.close(c),c.preventDefault())}).attr({role:"dialog","aria-labelledby":f}).mousedown(function(a){b.moveToTop(!1,a)}),h=b.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(g),i=(b.uiDialogTitlebar=a("<div></div>")).addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(g),j=a('<a href="#"></a>').addClass("ui-dialog-titlebar-close ui-corner-all").attr("role","button").hover(function(){j.addClass("ui-state-hover")},function(){j.removeClass("ui-state-hover")}).focus(function(){j.addClass("ui-state-focus")}).blur(function(){j.removeClass("ui-state-focus")}).click(function(a){b.close(a);return!1}).appendTo(i),k=(b.uiDialogTitlebarCloseText=a("<span></span>")).addClass("ui-icon ui-icon-closethick").text(d.closeText).appendTo(j),l=a("<span></span>").addClass("ui-dialog-title").attr("id",f).html(e).prependTo(i);a.isFunction(d.beforeclose)&&!a.isFunction(d.beforeClose)&&(d.beforeClose=d.beforeclose),i.find("*").add(i).disableSelection(),d.draggable&&a.fn.draggable&&b._makeDraggable(),d.resizable&&a.fn.resizable&&b._makeResizable(),b._createButtons(d.buttons),b._isOpen=!1,a.fn.bgiframe&&g.bgiframe()},_init:function(){this.options.autoOpen&&this.open()},destroy:function(){var a=this;a.overlay&&a.overlay.destroy(),a.uiDialog.hide(),a.element.unbind(".dialog").removeData("dialog").removeClass("ui-dialog-content ui-widget-content").hide().appendTo("body"),a.uiDialog.remove(),a.originalTitle&&a.element.attr("title",a.originalTitle);return a},widget:function(){return this.uiDialog},close:function(b){var c=this,d,e;if(!1!==c._trigger("beforeClose",b)){c.overlay&&c.overlay.destroy(),c.uiDialog.unbind("keypress.ui-dialog"),c._isOpen=!1,c.options.hide?c.uiDialog.hide(c.options.hide,function(){c._trigger("close",b)}):(c.uiDialog.hide(),c._trigger("close",b)),a.ui.dialog.overlay.resize(),c.options.modal&&(d=0,a(".ui-dialog").each(function(){this!==c.uiDialog[0]&&(e=a(this).css("z-index"),isNaN(e)||(d=Math.max(d,e)))}),a.ui.dialog.maxZ=d);return c}},isOpen:function(){return this._isOpen},moveToTop:function(b,c){var d=this,e=d.options,f;if(e.modal&&!b||!e.stack&&!e.modal)return d._trigger("focus",c);e.zIndex>a.ui.dialog.maxZ&&(a.ui.dialog.maxZ=e.zIndex),d.overlay&&(a.ui.dialog.maxZ+=1,d.overlay.$el.css("z-index",a.ui.dialog.overlay.maxZ=a.ui.dialog.maxZ)),f={scrollTop:d.element.scrollTop(),scrollLeft:d.element.scrollLeft()},a.ui.dialog.maxZ+=1,d.uiDialog.css("z-index",a.ui.dialog.maxZ),d.element.attr(f),d._trigger("focus",c);return d},open:function(){if(!this._isOpen){var b=this,c=b.options,d=b.uiDialog;b.overlay=c.modal?new a.ui.dialog.overlay(b):null,b._size(),b._position(c.position),d.show(c.show),b.moveToTop(!0),c.modal&&d.bind("keydown.ui-dialog",function(b){if(b.keyCode===a.ui.keyCode.TAB){var c=a(":tabbable",this),d=c.filter(":first"),e=c.filter(":last");if(b.target===e[0]&&!b.shiftKey){d.focus(1);return!1}if(b.target===d[0]&&b.shiftKey){e.focus(1);return!1}}}),a(b.element.find(":tabbable").get().concat(d.find(".ui-dialog-buttonpane :tabbable").get().concat(d.get()))).eq(0).focus(),b._isOpen=!0,b._trigger("open");return b}},_createButtons:function(b){var c=this,d=!1,e=a("<div></div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"),g=a("<div></div>").addClass("ui-dialog-buttonset").appendTo(e);c.uiDialog.find(".ui-dialog-buttonpane").remove(),typeof b=="object"&&b!==null&&a.each(b,function(){return!(d=!0)}),d&&(a.each(b,function(b,d){d=a.isFunction(d)?{click:d,text:b}:d;var e=a('<button type="button"></button>').click(function(){d.click.apply(c.element[0],arguments)}).appendTo(g);a.each(d,function(a,b){a!=="click"&&(a in f?e[a](b):e.attr(a,b))}),a.fn.button&&e.button()}),e.appendTo(c.uiDialog))},_makeDraggable:function(){function f(a){return{position:a.position,offset:a.offset}}var b=this,c=b.options,d=a(document),e;b.uiDialog.draggable({cancel:".ui-dialog-content, .ui-dialog-titlebar-close",handle:".ui-dialog-titlebar",containment:"document",start:function(d,g){e=c.height==="auto"?"auto":a(this).height(),a(this).height(a(this).height()).addClass("ui-dialog-dragging"),b._trigger("dragStart",d,f(g))},drag:function(a,c){b._trigger("drag",a,f(c))},stop:function(g,h){c.position=[h.position.left-d.scrollLeft(),h.position.top-d.scrollTop()],a(this).removeClass("ui-dialog-dragging").height(e),b._trigger("dragStop",g,f(h)),a.ui.dialog.overlay.resize()}})},_makeResizable:function(c){function h(a){return{originalPosition:a.originalPosition,originalSize:a.originalSize,position:a.position,size:a.size}}c=c===b?this.options.resizable:c;var d=this,e=d.options,f=d.uiDialog.css("position"),g=typeof c=="string"?c:"n,e,s,w,se,sw,ne,nw";d.uiDialog.resizable({cancel:".ui-dialog-content",containment:"document",alsoResize:d.element,maxWidth:e.maxWidth,maxHeight:e.maxHeight,minWidth:e.minWidth,minHeight:d._minHeight(),handles:g,start:function(b,c){a(this).addClass("ui-dialog-resizing"),d._trigger("resizeStart",b,h(c))},resize:function(a,b){d._trigger("resize",a,h(b))},stop:function(b,c){a(this).removeClass("ui-dialog-resizing"),e.height=a(this).height(),e.width=a(this).width(),d._trigger("resizeStop",b,h(c)),a.ui.dialog.overlay.resize()}}).css("position",f).find(".ui-resizable-se").addClass("ui-icon ui-icon-grip-diagonal-se")},_minHeight:function(){var a=this.options;return a.height==="auto"?a.minHeight:Math.min(a.minHeight,a.height)},_position:function(b){var c=[],d=[0,0],e;if(b){if(typeof b=="string"||typeof b=="object"&&"0"in b)c=b.split?b.split(" "):[b[0],b[1]],c.length===1&&(c[1]=c[0]),a.each(["left","top"],function(a,b){+c[a]===c[a]&&(d[a]=c[a],c[a]=b)}),b={my:c.join(" "),at:c.join(" "),offset:d.join(" ")};b=a.extend({},a.ui.dialog.prototype.options.position,b)}else b=a.ui.dialog.prototype.options.position;e=this.uiDialog.is(":visible"),e||this.uiDialog.show(),this.uiDialog.css({top:0,left:0}).position(a.extend({of:window},b)),e||this.uiDialog.hide()},_setOptions:function(b){var c=this,f={},g=!1;a.each(b,function(a,b){c._setOption(a,b),a in d&&(g=!0),a in e&&(f[a]=b)}),g&&this._size(),this.uiDialog.is(":data(resizable)")&&this.uiDialog.resizable("option",f)},_setOption:function(b,d){var e=this,f=e.uiDialog;switch(b){case"beforeclose":b="beforeClose";break;case"buttons":e._createButtons(d);break;case"closeText":e.uiDialogTitlebarCloseText.text(""+d);break;case"dialogClass":f.removeClass(e.options.dialogClass).addClass(c+d);break;case"disabled":d?f.addClass("ui-dialog-disabled"):f.removeClass("ui-dialog-disabled");break;case"draggable":var g=f.is(":data(draggable)");g&&!d&&f.draggable("destroy"),!g&&d&&e._makeDraggable();break;case"position":e._position(d);break;case"resizable":var h=f.is(":data(resizable)");h&&!d&&f.resizable("destroy"),h&&typeof d=="string"&&f.resizable("option","handles",d),!h&&d!==!1&&e._makeResizable(d);break;case"title":a(".ui-dialog-title",e.uiDialogTitlebar).html(""+(d||"&#160;"))}a.Widget.prototype._setOption.apply(e,arguments)},_size:function(){var b=this.options,c,d,e=this.uiDialog.is(":visible");this.element.show().css({width:"auto",minHeight:0,height:0}),b.minWidth>b.width&&(b.width=b.minWidth),c=this.uiDialog.css({height:"auto",width:b.width}).height(),d=Math.max(0,b.minHeight-c);if(b.height==="auto")if(a.support.minHeight)this.element.css({minHeight:d,height:"auto"});else{this.uiDialog.show();var f=this.element.css("height","auto").height();e||this.uiDialog.hide(),this.element.height(Math.max(f,d))}else this.element.height(Math.max(b.height-c,0));this.uiDialog.is(":data(resizable)")&&this.uiDialog.resizable("option","minHeight",this._minHeight())}}),a.extend(a.ui.dialog,{version:"1.8.17",uuid:0,maxZ:0,getTitleId:function(a){var b=a.attr("id");b||(this.uuid+=1,b=this.uuid);return"ui-dialog-title-"+b},overlay:function(b){this.$el=a.ui.dialog.overlay.create(b)}}),a.extend(a.ui.dialog.overlay,{instances:[],oldInstances:[],maxZ:0,events:a.map("focus,mousedown,mouseup,keydown,keypress,click".split(","),function(a){return a+".dialog-overlay"}).join(" "),create:function(b){this.instances.length===0&&(setTimeout(function(){a.ui.dialog.overlay.instances.length&&a(document).bind(a.ui.dialog.overlay.events,function(b){if(a(b.target).zIndex()<a.ui.dialog.overlay.maxZ)return!1})},1),a(document).bind("keydown.dialog-overlay",function(c){b.options.closeOnEscape&&!c.isDefaultPrevented()&&c.keyCode&&c.keyCode===a.ui.keyCode.ESCAPE&&(b.close(c),c.preventDefault())}),a(window).bind("resize.dialog-overlay",a.ui.dialog.overlay.resize));var c=(this.oldInstances.pop()||a("<div></div>").addClass("ui-widget-overlay")).appendTo(document.body).css({width:this.width(),height:this.height()});a.fn.bgiframe&&c.bgiframe(),this.instances.push(c);return c},destroy:function(b){var c=a.inArray(b,this.instances);c!=-1&&this.oldInstances.push(this.instances.splice(c,1)[0]),this.instances.length===0&&a([document,window]).unbind(".dialog-overlay"),b.remove();var d=0;a.each(this.instances,function(){d=Math.max(d,this.css("z-index"))}),this.maxZ=d},height:function(){var b,c;if(a.browser.msie&&a.browser.version<7){b=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight),c=Math.max(document.documentElement.offsetHeight,document.body.offsetHeight);return b<c?a(window).height()+"px":b+"px"}return a(document).height()+"px"},width:function(){var b,c;if(a.browser.msie){b=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth),c=Math.max(document.documentElement.offsetWidth,document.body.offsetWidth);return b<c?a(window).width()+"px":b+"px"}return a(document).width()+"px"},resize:function(){var b=a([]);a.each(a.ui.dialog.overlay.instances,function(){b=b.add(this)}),b.css({width:0,height:0}).css({width:a.ui.dialog.overlay.width(),height:a.ui.dialog.overlay.height()})}}),a.extend(a.ui.dialog.overlay.prototype,{destroy:function(){a.ui.dialog.overlay.destroy(this.$el)}})})(jQuery);/*
 * jQuery UI Slider 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Slider
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.mouse.js
 *	jquery.ui.widget.js
 */(function(a,b){var c=5;a.widget("ui.slider",a.ui.mouse,{widgetEventPrefix:"slide",options:{animate:!1,distance:0,max:100,min:0,orientation:"horizontal",range:!1,step:1,value:0,values:null},_create:function(){var b=this,d=this.options,e=this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),f="<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>",g=d.values&&d.values.length||1,h=[];this._keySliding=!1,this._mouseSliding=!1,this._animateOff=!0,this._handleIndex=null,this._detectOrientation(),this._mouseInit(),this.element.addClass("ui-slider ui-slider-"+this.orientation+" ui-widget"+" ui-widget-content"+" ui-corner-all"+(d.disabled?" ui-slider-disabled ui-disabled":"")),this.range=a([]),d.range&&(d.range===!0&&(d.values||(d.values=[this._valueMin(),this._valueMin()]),d.values.length&&d.values.length!==2&&(d.values=[d.values[0],d.values[0]])),this.range=a("<div></div>").appendTo(this.element).addClass("ui-slider-range ui-widget-header"+(d.range==="min"||d.range==="max"?" ui-slider-range-"+d.range:"")));for(var i=e.length;i<g;i+=1)h.push(f);this.handles=e.add(a(h.join("")).appendTo(b.element)),this.handle=this.handles.eq(0),this.handles.add(this.range).filter("a").click(function(a){a.preventDefault()}).hover(function(){d.disabled||a(this).addClass("ui-state-hover")},function(){a(this).removeClass("ui-state-hover")}).focus(function(){d.disabled?a(this).blur():(a(".ui-slider .ui-state-focus").removeClass("ui-state-focus"),a(this).addClass("ui-state-focus"))}).blur(function(){a(this).removeClass("ui-state-focus")}),this.handles.each(function(b){a(this).data("index.ui-slider-handle",b)}),this.handles.keydown(function(d){var e=!0,f=a(this).data("index.ui-slider-handle"),g,h,i,j;if(!b.options.disabled){switch(d.keyCode){case a.ui.keyCode.HOME:case a.ui.keyCode.END:case a.ui.keyCode.PAGE_UP:case a.ui.keyCode.PAGE_DOWN:case a.ui.keyCode.UP:case a.ui.keyCode.RIGHT:case a.ui.keyCode.DOWN:case a.ui.keyCode.LEFT:e=!1;if(!b._keySliding){b._keySliding=!0,a(this).addClass("ui-state-active"),g=b._start(d,f);if(g===!1)return}}j=b.options.step,b.options.values&&b.options.values.length?h=i=b.values(f):h=i=b.value();switch(d.keyCode){case a.ui.keyCode.HOME:i=b._valueMin();break;case a.ui.keyCode.END:i=b._valueMax();break;case a.ui.keyCode.PAGE_UP:i=b._trimAlignValue(h+(b._valueMax()-b._valueMin())/c);break;case a.ui.keyCode.PAGE_DOWN:i=b._trimAlignValue(h-(b._valueMax()-b._valueMin())/c);break;case a.ui.keyCode.UP:case a.ui.keyCode.RIGHT:if(h===b._valueMax())return;i=b._trimAlignValue(h+j);break;case a.ui.keyCode.DOWN:case a.ui.keyCode.LEFT:if(h===b._valueMin())return;i=b._trimAlignValue(h-j)}b._slide(d,f,i);return e}}).keyup(function(c){var d=a(this).data("index.ui-slider-handle");b._keySliding&&(b._keySliding=!1,b._stop(c,d),b._change(c,d),a(this).removeClass("ui-state-active"))}),this._refreshValue(),this._animateOff=!1},destroy:function(){this.handles.remove(),this.range.remove(),this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-slider-disabled ui-widget ui-widget-content ui-corner-all").removeData("slider").unbind(".slider"),this._mouseDestroy();return this},_mouseCapture:function(b){var c=this.options,d,e,f,g,h,i,j,k,l;if(c.disabled)return!1;this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()},this.elementOffset=this.element.offset(),d={x:b.pageX,y:b.pageY},e=this._normValueFromMouse(d),f=this._valueMax()-this._valueMin()+1,h=this,this.handles.each(function(b){var c=Math.abs(e-h.values(b));f>c&&(f=c,g=a(this),i=b)}),c.range===!0&&this.values(1)===c.min&&(i+=1,g=a(this.handles[i])),j=this._start(b,i);if(j===!1)return!1;this._mouseSliding=!0,h._handleIndex=i,g.addClass("ui-state-active").focus(),k=g.offset(),l=!a(b.target).parents().andSelf().is(".ui-slider-handle"),this._clickOffset=l?{left:0,top:0}:{left:b.pageX-k.left-g.width()/2,top:b.pageY-k.top-g.height()/2-(parseInt(g.css("borderTopWidth"),10)||0)-(parseInt(g.css("borderBottomWidth"),10)||0)+(parseInt(g.css("marginTop"),10)||0)},this.handles.hasClass("ui-state-hover")||this._slide(b,i,e),this._animateOff=!0;return!0},_mouseStart:function(a){return!0},_mouseDrag:function(a){var b={x:a.pageX,y:a.pageY},c=this._normValueFromMouse(b);this._slide(a,this._handleIndex,c);return!1},_mouseStop:function(a){this.handles.removeClass("ui-state-active"),this._mouseSliding=!1,this._stop(a,this._handleIndex),this._change(a,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1;return!1},_detectOrientation:function(){this.orientation=this.options.orientation==="vertical"?"vertical":"horizontal"},_normValueFromMouse:function(a){var b,c,d,e,f;this.orientation==="horizontal"?(b=this.elementSize.width,c=a.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(b=this.elementSize.height,c=a.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),d=c/b,d>1&&(d=1),d<0&&(d=0),this.orientation==="vertical"&&(d=1-d),e=this._valueMax()-this._valueMin(),f=this._valueMin()+d*e;return this._trimAlignValue(f)},_start:function(a,b){var c={handle:this.handles[b],value:this.value()};this.options.values&&this.options.values.length&&(c.value=this.values(b),c.values=this.values());return this._trigger("start",a,c)},_slide:function(a,b,c){var d,e,f;this.options.values&&this.options.values.length?(d=this.values(b?0:1),this.options.values.length===2&&this.options.range===!0&&(b===0&&c>d||b===1&&c<d)&&(c=d),c!==this.values(b)&&(e=this.values(),e[b]=c,f=this._trigger("slide",a,{handle:this.handles[b],value:c,values:e}),d=this.values(b?0:1),f!==!1&&this.values(b,c,!0))):c!==this.value()&&(f=this._trigger("slide",a,{handle:this.handles[b],value:c}),f!==!1&&this.value(c))},_stop:function(a,b){var c={handle:this.handles[b],value:this.value()};this.options.values&&this.options.values.length&&(c.value=this.values(b),c.values=this.values()),this._trigger("stop",a,c)},_change:function(a,b){if(!this._keySliding&&!this._mouseSliding){var c={handle:this.handles[b],value:this.value()};this.options.values&&this.options.values.length&&(c.value=this.values(b),c.values=this.values()),this._trigger("change",a,c)}},value:function(a){if(arguments.length)this.options.value=this._trimAlignValue(a),this._refreshValue(),this._change(null,0);else return this._value()},values:function(b,c){var d,e,f;if(arguments.length>1)this.options.values[b]=this._trimAlignValue(c),this._refreshValue(),this._change(null,b);else{if(!arguments.length)return this._values();if(!a.isArray(arguments[0]))return this.options.values&&this.options.values.length?this._values(b):this.value();d=this.options.values,e=arguments[0];for(f=0;f<d.length;f+=1)d[f]=this._trimAlignValue(e[f]),this._change(null,f);this._refreshValue()}},_setOption:function(b,c){var d,e=0;a.isArray(this.options.values)&&(e=this.options.values.length),a.Widget.prototype._setOption.apply(this,arguments);switch(b){case"disabled":c?(this.handles.filter(".ui-state-focus").blur(),this.handles.removeClass("ui-state-hover"),this.handles.propAttr("disabled",!0),this.element.addClass("ui-disabled")):(this.handles.propAttr("disabled",!1),this.element.removeClass("ui-disabled"));break;case"orientation":this._detectOrientation(),this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation),this._refreshValue();break;case"value":this._animateOff=!0,this._refreshValue(),this._change(null,0),this._animateOff=!1;break;case"values":this._animateOff=!0,this._refreshValue();for(d=0;d<e;d+=1)this._change(null,d);this._animateOff=!1}},_value:function(){var a=this.options.value;a=this._trimAlignValue(a);return a},_values:function(a){var b,c,d;if(arguments.length){b=this.options.values[a],b=this._trimAlignValue(b);return b}c=this.options.values.slice();for(d=0;d<c.length;d+=1)c[d]=this._trimAlignValue(c[d]);return c},_trimAlignValue:function(a){if(a<=this._valueMin())return this._valueMin();if(a>=this._valueMax())return this._valueMax();var b=this.options.step>0?this.options.step:1,c=(a-this._valueMin())%b,d=a-c;Math.abs(c)*2>=b&&(d+=c>0?b:-b);return parseFloat(d.toFixed(5))},_valueMin:function(){return this.options.min},_valueMax:function(){return this.options.max},_refreshValue:function(){var b=this.options.range,c=this.options,d=this,e=this._animateOff?!1:c.animate,f,g={},h,i,j,k;this.options.values&&this.options.values.length?this.handles.each(function(b,i){f=(d.values(b)-d._valueMin())/(d._valueMax()-d._valueMin())*100,g[d.orientation==="horizontal"?"left":"bottom"]=f+"%",a(this).stop(1,1)[e?"animate":"css"](g,c.animate),d.options.range===!0&&(d.orientation==="horizontal"?(b===0&&d.range.stop(1,1)[e?"animate":"css"]({left:f+"%"},c.animate),b===1&&d.range[e?"animate":"css"]({width:f-h+"%"},{queue:!1,duration:c.animate})):(b===0&&d.range.stop(1,1)[e?"animate":"css"]({bottom:f+"%"},c.animate),b===1&&d.range[e?"animate":"css"]({height:f-h+"%"},{queue:!1,duration:c.animate}))),h=f}):(i=this.value(),j=this._valueMin(),k=this._valueMax(),f=k!==j?(i-j)/(k-j)*100:0,g[d.orientation==="horizontal"?"left":"bottom"]=f+"%",this.handle.stop(1,1)[e?"animate":"css"](g,c.animate),b==="min"&&this.orientation==="horizontal"&&this.range.stop(1,1)[e?"animate":"css"]({width:f+"%"},c.animate),b==="max"&&this.orientation==="horizontal"&&this.range[e?"animate":"css"]({width:100-f+"%"},{queue:!1,duration:c.animate}),b==="min"&&this.orientation==="vertical"&&this.range.stop(1,1)[e?"animate":"css"]({height:f+"%"},c.animate),b==="max"&&this.orientation==="vertical"&&this.range[e?"animate":"css"]({height:100-f+"%"},{queue:!1,duration:c.animate}))}}),a.extend(a.ui.slider,{version:"1.8.17"})})(jQuery);/*
 * jQuery UI Tabs 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Tabs
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */(function(a,b){function f(){return++d}function e(){return++c}var c=0,d=0;a.widget("ui.tabs",{options:{add:null,ajaxOptions:null,cache:!1,cookie:null,collapsible:!1,disable:null,disabled:[],enable:null,event:"click",fx:null,idPrefix:"ui-tabs-",load:null,panelTemplate:"<div></div>",remove:null,select:null,show:null,spinner:"<em>Loading&#8230;</em>",tabTemplate:"<li><a href='#{href}'><span>#{label}</span></a></li>"},_create:function(){this._tabify(!0)},_setOption:function(a,b){if(a=="selected"){if(this.options.collapsible&&b==this.options.selected)return;this.select(b)}else this.options[a]=b,this._tabify()},_tabId:function(a){return a.title&&a.title.replace(/\s/g,"_").replace(/[^\w\u00c0-\uFFFF-]/g,"")||this.options.idPrefix+e()},_sanitizeSelector:function(a){return a.replace(/:/g,"\\:")},_cookie:function(){var b=this.cookie||(this.cookie=this.options.cookie.name||"ui-tabs-"+f());return a.cookie.apply(null,[b].concat(a.makeArray(arguments)))},_ui:function(a,b){return{tab:a,panel:b,index:this.anchors.index(a)}},_cleanup:function(){this.lis.filter(".ui-state-processing").removeClass("ui-state-processing").find("span:data(label.tabs)").each(function(){var b=a(this);b.html(b.data("label.tabs")).removeData("label.tabs")})},_tabify:function(c){function m(b,c){b.css("display",""),!a.support.opacity&&c.opacity&&b[0].style.removeAttribute("filter")}var d=this,e=this.options,f=/^#.+/;this.list=this.element.find("ol,ul").eq(0),this.lis=a(" > li:has(a[href])",this.list),this.anchors=this.lis.map(function(){return a("a",this)[0]}),this.panels=a([]),this.anchors.each(function(b,c){var g=a(c).attr("href"),h=g.split("#")[0],i;h&&(h===location.toString().split("#")[0]||(i=a("base")[0])&&h===i.href)&&(g=c.hash,c.href=g);if(f.test(g))d.panels=d.panels.add(d.element.find(d._sanitizeSelector(g)));else if(g&&g!=="#"){a.data(c,"href.tabs",g),a.data(c,"load.tabs",g.replace(/#.*$/,""));var j=d._tabId(c);c.href="#"+j;var k=d.element.find("#"+j);k.length||(k=a(e.panelTemplate).attr("id",j).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").insertAfter(d.panels[b-1]||d.list),k.data("destroy.tabs",!0)),d.panels=d.panels.add(k)}else e.disabled.push(b)}),c?(this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all"),this.list.addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"),this.lis.addClass("ui-state-default ui-corner-top"),this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom"),e.selected===b?(location.hash&&this.anchors.each(function(a,b){if(b.hash==location.hash){e.selected=a;return!1}}),typeof e.selected!="number"&&e.cookie&&(e.selected=parseInt(d._cookie(),10)),typeof e.selected!="number"&&this.lis.filter(".ui-tabs-selected").length&&(e.selected=this.lis.index(this.lis.filter(".ui-tabs-selected"))),e.selected=e.selected||(this.lis.length?0:-1)):e.selected===null&&(e.selected=-1),e.selected=e.selected>=0&&this.anchors[e.selected]||e.selected<0?e.selected:0,e.disabled=a.unique(e.disabled.concat(a.map(this.lis.filter(".ui-state-disabled"),function(a,b){return d.lis.index(a)}))).sort(),a.inArray(e.selected,e.disabled)!=-1&&e.disabled.splice(a.inArray(e.selected,e.disabled),1),this.panels.addClass("ui-tabs-hide"),this.lis.removeClass("ui-tabs-selected ui-state-active"),e.selected>=0&&this.anchors.length&&(d.element.find(d._sanitizeSelector(d.anchors[e.selected].hash)).removeClass("ui-tabs-hide"),this.lis.eq(e.selected).addClass("ui-tabs-selected ui-state-active"),d.element.queue("tabs",function(){d._trigger("show",null,d._ui(d.anchors[e.selected],d.element.find(d._sanitizeSelector(d.anchors[e.selected].hash))[0]))}),this.load(e.selected)),a(window).bind("unload",function(){d.lis.add(d.anchors).unbind(".tabs"),d.lis=d.anchors=d.panels=null})):e.selected=this.lis.index(this.lis.filter(".ui-tabs-selected")),this.element[e.collapsible?"addClass":"removeClass"]("ui-tabs-collapsible"),e.cookie&&this._cookie(e.selected,e.cookie);for(var g=0,h;h=this.lis[g];g++)a(h)[a.inArray(g,e.disabled)!=-1&&!a(h).hasClass("ui-tabs-selected")?"addClass":"removeClass"]("ui-state-disabled");e.cache===!1&&this.anchors.removeData("cache.tabs"),this.lis.add(this.anchors).unbind(".tabs");if(e.event!=="mouseover"){var i=function(a,b){b.is(":not(.ui-state-disabled)")&&b.addClass("ui-state-"+a)},j=function(a,b){b.removeClass("ui-state-"+a)};this.lis.bind("mouseover.tabs",function(){i("hover",a(this))}),this.lis.bind("mouseout.tabs",function(){j("hover",a(this))}),this.anchors.bind("focus.tabs",function(){i("focus",a(this).closest("li"))}),this.anchors.bind("blur.tabs",function(){j("focus",a(this).closest("li"))})}var k,l;e.fx&&(a.isArray(e.fx)?(k=e.fx[0],l=e.fx[1]):k=l=e.fx);var n=l?function(b,c){a(b).closest("li").addClass("ui-tabs-selected ui-state-active"),c.hide().removeClass("ui-tabs-hide").animate(l,l.duration||"normal",function(){m(c,l),d._trigger("show",null,d._ui(b,c[0]))})}:function(b,c){a(b).closest("li").addClass("ui-tabs-selected ui-state-active"),c.removeClass("ui-tabs-hide"),d._trigger("show",null,d._ui(b,c[0]))},o=k?function(a,b){b.animate(k,k.duration||"normal",function(){d.lis.removeClass("ui-tabs-selected ui-state-active"),b.addClass("ui-tabs-hide"),m(b,k),d.element.dequeue("tabs")})}:function(a,b,c){d.lis.removeClass("ui-tabs-selected ui-state-active"),b.addClass("ui-tabs-hide"),d.element.dequeue("tabs")};this.anchors.bind(e.event+".tabs",function(){var b=this,c=a(b).closest("li"),f=d.panels.filter(":not(.ui-tabs-hide)"),g=d.element.find(d._sanitizeSelector(b.hash));if(c.hasClass("ui-tabs-selected")&&!e.collapsible||c.hasClass("ui-state-disabled")||c.hasClass("ui-state-processing")||d.panels.filter(":animated").length||d._trigger("select",null,d._ui(this,g[0]))===!1){this.blur();return!1}e.selected=d.anchors.index(this),d.abort();if(e.collapsible){if(c.hasClass("ui-tabs-selected")){e.selected=-1,e.cookie&&d._cookie(e.selected,e.cookie),d.element.queue("tabs",function(){o(b,f)}).dequeue("tabs"),this.blur();return!1}if(!f.length){e.cookie&&d._cookie(e.selected,e.cookie),d.element.queue("tabs",function(){n(b,g)}),d.load(d.anchors.index(this)),this.blur();return!1}}e.cookie&&d._cookie(e.selected,e.cookie);if(g.length)f.length&&d.element.queue("tabs",function(){o(b,f)}),d.element.queue("tabs",function(){n(b,g)}),d.load(d.anchors.index(this));else throw"jQuery UI Tabs: Mismatching fragment identifier.";a.browser.msie&&this.blur()}),this.anchors.bind("click.tabs",function(){return!1})},_getIndex:function(a){typeof a=="string"&&(a=this.anchors.index(this.anchors.filter("[href$="+a+"]")));return a},destroy:function(){var b=this.options;this.abort(),this.element.unbind(".tabs").removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible").removeData("tabs"),this.list.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all"),this.anchors.each(function(){var b=a.data(this,"href.tabs");b&&(this.href=b);var c=a(this).unbind(".tabs");a.each(["href","load","cache"],function(a,b){c.removeData(b+".tabs")})}),this.lis.unbind(".tabs").add(this.panels).each(function(){a.data(this,"destroy.tabs")?a(this).remove():a(this).removeClass(["ui-state-default","ui-corner-top","ui-tabs-selected","ui-state-active","ui-state-hover","ui-state-focus","ui-state-disabled","ui-tabs-panel","ui-widget-content","ui-corner-bottom","ui-tabs-hide"].join(" "))}),b.cookie&&this._cookie(null,b.cookie);return this},add:function(c,d,e){e===b&&(e=this.anchors.length);var f=this,g=this.options,h=a(g.tabTemplate.replace(/#\{href\}/g,c).replace(/#\{label\}/g,d)),i=c.indexOf("#")?this._tabId(a("a",h)[0]):c.replace("#","");h.addClass("ui-state-default ui-corner-top").data("destroy.tabs",!0);var j=f.element.find("#"+i);j.length||(j=a(g.panelTemplate).attr("id",i).data("destroy.tabs",!0)),j.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide"),e>=this.lis.length?(h.appendTo(this.list),j.appendTo(this.list[0].parentNode)):(h.insertBefore(this.lis[e]),j.insertBefore(this.panels[e])),g.disabled=a.map(g.disabled,function(a,b){return a>=e?++a:a}),this._tabify(),this.anchors.length==1&&(g.selected=0,h.addClass("ui-tabs-selected ui-state-active"),j.removeClass("ui-tabs-hide"),this.element.queue("tabs",function(){f._trigger("show",null,f._ui(f.anchors[0],f.panels[0]))}),this.load(0)),this._trigger("add",null,this._ui(this.anchors[e],this.panels[e]));return this},remove:function(b){b=this._getIndex(b);var c=this.options,d=this.lis.eq(b).remove(),e=this.panels.eq(b).remove();d.hasClass("ui-tabs-selected")&&this.anchors.length>1&&this.select(b+(b+1<this.anchors.length?1:-1)),c.disabled=a.map(a.grep(c.disabled,function(a,c){return a!=b}),function(a,c){return a>=b?--a:a}),this._tabify(),this._trigger("remove",null,this._ui(d.find("a")[0],e[0]));return this},enable:function(b){b=this._getIndex(b);var c=this.options;if(a.inArray(b,c.disabled)!=-1){this.lis.eq(b).removeClass("ui-state-disabled"),c.disabled=a.grep(c.disabled,function(a,c){return a!=b}),this._trigger("enable",null,this._ui(this.anchors[b],this.panels[b]));return this}},disable:function(a){a=this._getIndex(a);var b=this,c=this.options;a!=c.selected&&(this.lis.eq(a).addClass("ui-state-disabled"),c.disabled.push(a),c.disabled.sort(),this._trigger("disable",null,this._ui(this.anchors[a],this.panels[a])));return this},select:function(a){a=this._getIndex(a);if(a==-1)if(this.options.collapsible&&this.options.selected!=-1)a=this.options.selected;else return this;this.anchors.eq(a).trigger(this.options.event+".tabs");return this},load:function(b){b=this._getIndex(b);var c=this,d=this.options,e=this.anchors.eq(b)[0],f=a.data(e,"load.tabs");this.abort();if(!f||this.element.queue("tabs").length!==0&&a.data(e,"cache.tabs"))this.element.dequeue("tabs");else{this.lis.eq(b).addClass("ui-state-processing");if(d.spinner){var g=a("span",e);g.data("label.tabs",g.html()).html(d.spinner)}this.xhr=a.ajax(a.extend({},d.ajaxOptions,{url:f,success:function(f,g){c.element.find(c._sanitizeSelector(e.hash)).html(f),c._cleanup(),d.cache&&a.data(e,"cache.tabs",!0),c._trigger("load",null,c._ui(c.anchors[b],c.panels[b]));try{d.ajaxOptions.success(f,g)}catch(h){}},error:function(a,f,g){c._cleanup(),c._trigger("load",null,c._ui(c.anchors[b],c.panels[b]));try{d.ajaxOptions.error(a,f,b,e)}catch(g){}}})),c.element.dequeue("tabs");return this}},abort:function(){this.element.queue([]),this.panels.stop(!1,!0),this.element.queue("tabs",this.element.queue("tabs").splice(-2,2)),this.xhr&&(this.xhr.abort(),delete this.xhr),this._cleanup();return this},url:function(a,b){this.anchors.eq(a).removeData("cache.tabs").data("load.tabs",b);return this},length:function(){return this.anchors.length}}),a.extend(a.ui.tabs,{version:"1.8.17"}),a.extend(a.ui.tabs.prototype,{rotation:null,rotate:function(a,b){var c=this,d=this.options,e=c._rotate||(c._rotate=function(b){clearTimeout(c.rotation),c.rotation=setTimeout(function(){var a=d.selected;c.select(++a<c.anchors.length?a:0)},a),b&&b.stopPropagation()}),f=c._unrotate||(c._unrotate=b?function(a){t=d.selected,e()}:function(a){a.clientX&&c.rotate(null)});a?(this.element.bind("tabsshow",e),this.anchors.bind(d.event+".tabs",f),e()):(clearTimeout(c.rotation),this.element.unbind("tabsshow",e),this.anchors.unbind(d.event+".tabs",f),delete this._rotate,delete this._unrotate);return this}})})(jQuery);/*
 * jQuery UI Datepicker 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Datepicker
 *
 * Depends:
 *	jquery.ui.core.js
 */(function($,undefined){function isArray(a){return a&&($.browser.safari&&typeof a=="object"&&a.length||a.constructor&&a.constructor.toString().match(/\Array\(\)/))}function extendRemove(a,b){$.extend(a,b);for(var c in b)if(b[c]==null||b[c]==undefined)a[c]=b[c];return a}function bindHover(a){var b="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";return a.bind("mouseout",function(a){var c=$(a.target).closest(b);!c.length||c.removeClass("ui-state-hover ui-datepicker-prev-hover ui-datepicker-next-hover")}).bind("mouseover",function(c){var d=$(c.target).closest(b);!$.datepicker._isDisabledDatepicker(instActive.inline?a.parent()[0]:instActive.input[0])&&!!d.length&&(d.parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),d.addClass("ui-state-hover"),d.hasClass("ui-datepicker-prev")&&d.addClass("ui-datepicker-prev-hover"),d.hasClass("ui-datepicker-next")&&d.addClass("ui-datepicker-next-hover"))})}function Datepicker(){this.debug=!1,this._curInst=null,this._keyEvent=!1,this._disabledInputs=[],this._datepickerShowing=!1,this._inDialog=!1,this._mainDivId="ui-datepicker-div",this._inlineClass="ui-datepicker-inline",this._appendClass="ui-datepicker-append",this._triggerClass="ui-datepicker-trigger",this._dialogClass="ui-datepicker-dialog",this._disableClass="ui-datepicker-disabled",this._unselectableClass="ui-datepicker-unselectable",this._currentClass="ui-datepicker-current-day",this._dayOverClass="ui-datepicker-days-cell-over",this.regional=[],this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""},this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:!1,hideIfNoPrevNext:!1,navigationAsDateFormat:!1,gotoCurrent:!1,changeMonth:!1,changeYear:!1,yearRange:"c-10:c+10",showOtherMonths:!1,selectOtherMonths:!1,showWeek:!1,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:!0,showButtonPanel:!1,autoSize:!1,disabled:!1},$.extend(this._defaults,this.regional[""]),this.dpDiv=bindHover($('<div id="'+this._mainDivId+'" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>'))}$.extend($.ui,{datepicker:{version:"1.8.17"}});var PROP_NAME="datepicker",dpuuid=(new Date).getTime(),instActive;$.extend(Datepicker.prototype,{markerClassName:"hasDatepicker",maxRows:4,log:function(){this.debug&&console.log.apply("",arguments)},_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(a){extendRemove(this._defaults,a||{});return this},_attachDatepicker:function(target,settings){var inlineSettings=null;for(var attrName in this._defaults){var attrValue=target.getAttribute("date:"+attrName);if(attrValue){inlineSettings=inlineSettings||{};try{inlineSettings[attrName]=eval(attrValue)}catch(err){inlineSettings[attrName]=attrValue}}}var nodeName=target.nodeName.toLowerCase(),inline=nodeName=="div"||nodeName=="span";target.id||(this.uuid+=1,target.id="dp"+this.uuid);var inst=this._newInst($(target),inline);inst.settings=$.extend({},settings||{},inlineSettings||{}),nodeName=="input"?this._connectDatepicker(target,inst):inline&&this._inlineDatepicker(target,inst)},_newInst:function(a,b){var c=a[0].id.replace(/([^A-Za-z0-9_-])/g,"\\\\$1");return{id:c,input:a,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:b,dpDiv:b?bindHover($('<div class="'+this._inlineClass+' ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>')):this.dpDiv}},_connectDatepicker:function(a,b){var c=$(a);b.append=$([]),b.trigger=$([]);c.hasClass(this.markerClassName)||(this._attachments(c,b),c.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp).bind("setData.datepicker",function(a,c,d){b.settings[c]=d}).bind("getData.datepicker",function(a,c){return this._get(b,c)}),this._autoSize(b),$.data(a,PROP_NAME,b),b.settings.disabled&&this._disableDatepicker(a))},_attachments:function(a,b){var c=this._get(b,"appendText"),d=this._get(b,"isRTL");b.append&&b.append.remove(),c&&(b.append=$('<span class="'+this._appendClass+'">'+c+"</span>"),a[d?"before":"after"](b.append)),a.unbind("focus",this._showDatepicker),b.trigger&&b.trigger.remove();var e=this._get(b,"showOn");(e=="focus"||e=="both")&&a.focus(this._showDatepicker);if(e=="button"||e=="both"){var f=this._get(b,"buttonText"),g=this._get(b,"buttonImage");b.trigger=$(this._get(b,"buttonImageOnly")?$("<img/>").addClass(this._triggerClass).attr({src:g,alt:f,title:f}):$('<button type="button"></button>').addClass(this._triggerClass).html(g==""?f:$("<img/>").attr({src:g,alt:f,title:f}))),a[d?"before":"after"](b.trigger),b.trigger.click(function(){$.datepicker._datepickerShowing&&$.datepicker._lastInput==a[0]?$.datepicker._hideDatepicker():$.datepicker._showDatepicker(a[0]);return!1})}},_autoSize:function(a){if(this._get(a,"autoSize")&&!a.inline){var b=new Date(2009,11,20),c=this._get(a,"dateFormat");if(c.match(/[DM]/)){var d=function(a){var b=0,c=0;for(var d=0;d<a.length;d++)a[d].length>b&&(b=a[d].length,c=d);return c};b.setMonth(d(this._get(a,c.match(/MM/)?"monthNames":"monthNamesShort"))),b.setDate(d(this._get(a,c.match(/DD/)?"dayNames":"dayNamesShort"))+20-b.getDay())}a.input.attr("size",this._formatDate(a,b).length)}},_inlineDatepicker:function(a,b){var c=$(a);c.hasClass(this.markerClassName)||(c.addClass(this.markerClassName).append(b.dpDiv).bind("setData.datepicker",function(a,c,d){b.settings[c]=d}).bind("getData.datepicker",function(a,c){return this._get(b,c)}),$.data(a,PROP_NAME,b),this._setDate(b,this._getDefaultDate(b),!0),this._updateDatepicker(b),this._updateAlternate(b),b.settings.disabled&&this._disableDatepicker(a),b.dpDiv.css("display","block"))},_dialogDatepicker:function(a,b,c,d,e){var f=this._dialogInst;if(!f){this.uuid+=1;var g="dp"+this.uuid;this._dialogInput=$('<input type="text" id="'+g+'" style="position: absolute; top: -100px; width: 0px; z-index: -10;"/>'),this._dialogInput.keydown(this._doKeyDown),$("body").append(this._dialogInput),f=this._dialogInst=this._newInst(this._dialogInput,!1),f.settings={},$.data(this._dialogInput[0],PROP_NAME,f)}extendRemove(f.settings,d||{}),b=b&&b.constructor==Date?this._formatDate(f,b):b,this._dialogInput.val(b),this._pos=e?e.length?e:[e.pageX,e.pageY]:null;if(!this._pos){var h=document.documentElement.clientWidth,i=document.documentElement.clientHeight,j=document.documentElement.scrollLeft||document.body.scrollLeft,k=document.documentElement.scrollTop||document.body.scrollTop;this._pos=[h/2-100+j,i/2-150+k]}this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),f.settings.onSelect=c,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),$.blockUI&&$.blockUI(this.dpDiv),$.data(this._dialogInput[0],PROP_NAME,f);return this},_destroyDatepicker:function(a){var b=$(a),c=$.data(a,PROP_NAME);if(!!b.hasClass(this.markerClassName)){var d=a.nodeName.toLowerCase();$.removeData(a,PROP_NAME),d=="input"?(c.append.remove(),c.trigger.remove(),b.removeClass(this.markerClassName).unbind("focus",this._showDatepicker).unbind("keydown",this._doKeyDown).unbind("keypress",this._doKeyPress).unbind("keyup",this._doKeyUp)):(d=="div"||d=="span")&&b.removeClass(this.markerClassName).empty()}},_enableDatepicker:function(a){var b=$(a),c=$.data(a,PROP_NAME);if(!!b.hasClass(this.markerClassName)){var d=a.nodeName.toLowerCase();if(d=="input")a.disabled=!1,c.trigger.filter("button").each(function(){this.disabled=!1}).end().filter("img").css({opacity:"1.0",cursor:""});else if(d=="div"||d=="span"){var e=b.children("."+this._inlineClass);e.children().removeClass("ui-state-disabled"),e.find("select.ui-datepicker-month, select.ui-datepicker-year").removeAttr("disabled")}this._disabledInputs=$.map(this._disabledInputs,function(b){return b==a?null:b})}},_disableDatepicker:function(a){var b=$(a),c=$.data(a,PROP_NAME);if(!!b.hasClass(this.markerClassName)){var d=a.nodeName.toLowerCase();if(d=="input")a.disabled=!0,c.trigger.filter("button").each(function(){this.disabled=!0}).end().filter("img").css({opacity:"0.5",cursor:"default"});else if(d=="div"||d=="span"){var e=b.children("."+this._inlineClass);e.children().addClass("ui-state-disabled"),e.find("select.ui-datepicker-month, select.ui-datepicker-year").attr("disabled","disabled")}this._disabledInputs=$.map(this._disabledInputs,function(b){return b==a?null:b}),this._disabledInputs[this._disabledInputs.length]=a}},_isDisabledDatepicker:function(a){if(!a)return!1;for(var b=0;b<this._disabledInputs.length;b++)if(this._disabledInputs[b]==a)return!0;return!1},_getInst:function(a){try{return $.data(a,PROP_NAME)}catch(b){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(a,b,c){var d=this._getInst(a);if(arguments.length==2&&typeof b=="string")return b=="defaults"?$.extend({},$.datepicker._defaults):d?b=="all"?$.extend({},d.settings):this._get(d,b):null;var e=b||{};typeof b=="string"&&(e={},e[b]=c);if(d){this._curInst==d&&this._hideDatepicker();var f=this._getDateDatepicker(a,!0),g=this._getMinMaxDate(d,"min"),h=this._getMinMaxDate(d,"max");extendRemove(d.settings,e),g!==null&&e.dateFormat!==undefined&&e.minDate===undefined&&(d.settings.minDate=this._formatDate(d,g)),h!==null&&e.dateFormat!==undefined&&e.maxDate===undefined&&(d.settings.maxDate=this._formatDate(d,h)),this._attachments($(a),d),this._autoSize(d),this._setDate(d,f),this._updateAlternate(d),this._updateDatepicker(d)}},_changeDatepicker:function(a,b,c){this._optionDatepicker(a,b,c)},_refreshDatepicker:function(a){var b=this._getInst(a);b&&this._updateDatepicker(b)},_setDateDatepicker:function(a,b){var c=this._getInst(a);c&&(this._setDate(c,b),this._updateDatepicker(c),this._updateAlternate(c))},_getDateDatepicker:function(a,b){var c=this._getInst(a);c&&!c.inline&&this._setDateFromField(c,b);return c?this._getDate(c):null},_doKeyDown:function(a){var b=$.datepicker._getInst(a.target),c=!0,d=b.dpDiv.is(".ui-datepicker-rtl");b._keyEvent=!0;if($.datepicker._datepickerShowing)switch(a.keyCode){case 9:$.datepicker._hideDatepicker(),c=!1;break;case 13:var e=$("td."+$.datepicker._dayOverClass+":not(."+$.datepicker._currentClass+")",b.dpDiv);e[0]&&$.datepicker._selectDay(a.target,b.selectedMonth,b.selectedYear,e[0]);var f=$.datepicker._get(b,"onSelect");if(f){var g=$.datepicker._formatDate(b);f.apply(b.input?b.input[0]:null,[g,b])}else $.datepicker._hideDatepicker();return!1;case 27:$.datepicker._hideDatepicker();break;case 33:$.datepicker._adjustDate(a.target,a.ctrlKey?-$.datepicker._get(b,"stepBigMonths"):-$.datepicker._get(b,"stepMonths"),"M");break;case 34:$.datepicker._adjustDate(a.target,a.ctrlKey?+$.datepicker._get(b,"stepBigMonths"):+$.datepicker._get(b,"stepMonths"),"M");break;case 35:(a.ctrlKey||a.metaKey)&&$.datepicker._clearDate(a.target),c=a.ctrlKey||a.metaKey;break;case 36:(a.ctrlKey||a.metaKey)&&$.datepicker._gotoToday(a.target),c=a.ctrlKey||a.metaKey;break;case 37:(a.ctrlKey||a.metaKey)&&$.datepicker._adjustDate(a.target,d?1:-1,"D"),c=a.ctrlKey||a.metaKey,a.originalEvent.altKey&&$.datepicker._adjustDate(a.target,a.ctrlKey?-$.datepicker._get(b,"stepBigMonths"):-$.datepicker._get(b,"stepMonths"),"M");break;case 38:(a.ctrlKey||a.metaKey)&&$.datepicker._adjustDate(a.target,-7,"D"),c=a.ctrlKey||a.metaKey;break;case 39:(a.ctrlKey||a.metaKey)&&$.datepicker._adjustDate(a.target,d?-1:1,"D"),c=a.ctrlKey||a.metaKey,a.originalEvent.altKey&&$.datepicker._adjustDate(a.target,a.ctrlKey?+$.datepicker._get(b,"stepBigMonths"):+$.datepicker._get(b,"stepMonths"),"M");break;case 40:(a.ctrlKey||a.metaKey)&&$.datepicker._adjustDate(a.target,7,"D"),c=a.ctrlKey||a.metaKey;break;default:c=!1}else a.keyCode==36&&a.ctrlKey?$.datepicker._showDatepicker(this):c=!1;c&&(a.preventDefault(),a.stopPropagation())},_doKeyPress:function(a){var b=$.datepicker._getInst(a.target);if($.datepicker._get(b,"constrainInput")){var c=$.datepicker._possibleChars($.datepicker._get(b,"dateFormat")),d=String.fromCharCode(a.charCode==undefined?a.keyCode:a.charCode);return a.ctrlKey||a.metaKey||d<" "||!c||c.indexOf(d)>-1}},_doKeyUp:function(a){var b=$.datepicker._getInst(a.target);if(b.input.val()!=b.lastVal)try{var c=$.datepicker.parseDate($.datepicker._get(b,"dateFormat"),b.input?b.input.val():null,$.datepicker._getFormatConfig(b));c&&($.datepicker._setDateFromField(b),$.datepicker._updateAlternate(b),$.datepicker._updateDatepicker(b))}catch(a){$.datepicker.log(a)}return!0},_showDatepicker:function(a){a=a.target||a,a.nodeName.toLowerCase()!="input"&&(a=$("input",a.parentNode)[0]);if(!$.datepicker._isDisabledDatepicker(a)&&$.datepicker._lastInput!=a){var b=$.datepicker._getInst(a);$.datepicker._curInst&&$.datepicker._curInst!=b&&($.datepicker._curInst.dpDiv.stop(!0,!0),b&&$.datepicker._datepickerShowing&&$.datepicker._hideDatepicker($.datepicker._curInst.input[0]));var c=$.datepicker._get(b,"beforeShow"),d=c?c.apply(a,[a,b]):{};if(d===!1)return;extendRemove(b.settings,d),b.lastVal=null,$.datepicker._lastInput=a,$.datepicker._setDateFromField(b),$.datepicker._inDialog&&(a.value=""),$.datepicker._pos||($.datepicker._pos=$.datepicker._findPos(a),$.datepicker._pos[1]+=a.offsetHeight);var e=!1;$(a).parents().each(function(){e|=$(this).css("position")=="fixed";return!e}),e&&$.browser.opera&&($.datepicker._pos[0]-=document.documentElement.scrollLeft,$.datepicker._pos[1]-=document.documentElement.scrollTop);var f={left:$.datepicker._pos[0],top:$.datepicker._pos[1]};$.datepicker._pos=null,b.dpDiv.empty(),b.dpDiv.css({position:"absolute",display:"block",top:"-1000px"}),$.datepicker._updateDatepicker(b),f=$.datepicker._checkOffset(b,f,e),b.dpDiv.css({position:$.datepicker._inDialog&&$.blockUI?"static":e?"fixed":"absolute",display:"none",left:f.left+"px",top:f.top+"px"});if(!b.inline){var g=$.datepicker._get(b,"showAnim"),h=$.datepicker._get(b,"duration"),i=function(){var a=b.dpDiv.find("iframe.ui-datepicker-cover");if(!!a.length){var c=$.datepicker._getBorders(b.dpDiv);a.css({left:-c[0],top:-c[1],width:b.dpDiv.outerWidth(),height:b.dpDiv.outerHeight()})}};b.dpDiv.zIndex($(a).zIndex()+1),$.datepicker._datepickerShowing=!0,$.effects&&$.effects[g]?b.dpDiv.show(g,$.datepicker._get(b,"showOptions"),h,i):b.dpDiv[g||"show"](g?h:null,i),(!g||!h)&&i(),b.input.is(":visible")&&!b.input.is(":disabled")&&b.input.focus(),$.datepicker._curInst=b}}},_updateDatepicker:function(a){var b=this;b.maxRows=4;var c=$.datepicker._getBorders(a.dpDiv);instActive=a,a.dpDiv.empty().append(this._generateHTML(a));var d=a.dpDiv.find("iframe.ui-datepicker-cover");!d.length||d.css({left:-c[0],top:-c[1],width:a.dpDiv.outerWidth(),height:a.dpDiv.outerHeight()}),a.dpDiv.find("."+this._dayOverClass+" a").mouseover();var e=this._getNumberOfMonths(a),f=e[1],g=17;a.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),f>1&&a.dpDiv.addClass("ui-datepicker-multi-"+f).css("width",g*f+"em"),a.dpDiv[(e[0]!=1||e[1]!=1?"add":"remove")+"Class"]("ui-datepicker-multi"),a.dpDiv[(this._get(a,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl"),a==$.datepicker._curInst&&$.datepicker._datepickerShowing&&a.input&&a.input.is(":visible")&&!a.input.is(":disabled")&&a.input[0]!=document.activeElement&&a.input.focus();if(a.yearshtml){var h=a.yearshtml;setTimeout(function(){h===a.yearshtml&&a.yearshtml&&a.dpDiv.find("select.ui-datepicker-year:first").replaceWith(a.yearshtml),h=a.yearshtml=null},0)}},_getBorders:function(a){var b=function(a){return{thin:1,medium:2,thick:3}[a]||a};return[parseFloat(b(a.css("border-left-width"))),parseFloat(b(a.css("border-top-width")))]},_checkOffset:function(a,b,c){var d=a.dpDiv.outerWidth(),e=a.dpDiv.outerHeight(),f=a.input?a.input.outerWidth():0,g=a.input?a.input.outerHeight():0,h=document.documentElement.clientWidth+$(document).scrollLeft(),i=document.documentElement.clientHeight+$(document).scrollTop();b.left-=this._get(a,"isRTL")?d-f:0,b.left-=c&&b.left==a.input.offset().left?$(document).scrollLeft():0,b.top-=c&&b.top==a.input.offset().top+g?$(document).scrollTop():0,b.left-=Math.min(b.left,b.left+d>h&&h>d?Math.abs(b.left+d-h):0),b.top-=Math.min(b.top,b.top+e>i&&i>e?Math.abs(e+g):0);return b},_findPos:function(a){var b=this._getInst(a),c=this._get(b,"isRTL");while(a&&(a.type=="hidden"||a.nodeType!=1||$.expr.filters.hidden(a)))a=a[c?"previousSibling":"nextSibling"];var d=$(a).offset();return[d.left,d.top]},_hideDatepicker:function(a){var b=this._curInst;if(!(!b||a&&b!=$.data(a,PROP_NAME))&&this._datepickerShowing){var c=this._get(b,"showAnim"),d=this._get(b,"duration"),e=this,f=function(){$.datepicker._tidyDialog(b),e._curInst=null};$.effects&&$.effects[c]?b.dpDiv.hide(c,$.datepicker._get(b,"showOptions"),d,f):b.dpDiv[c=="slideDown"?"slideUp":c=="fadeIn"?"fadeOut":"hide"](c?d:null,f),c||f(),this._datepickerShowing=!1;var g=this._get(b,"onClose");g&&g.apply(b.input?b.input[0]:null,[b.input?b.input.val():"",b]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({position:"absolute",left:"0",top:"-100px"}),$.blockUI&&($.unblockUI(),$("body").append(this.dpDiv))),this._inDialog=!1}},_tidyDialog:function(a){a.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")},_checkExternalClick:function(a){if(!!$.datepicker._curInst){var b=$(a.target),c=$.datepicker._getInst(b[0]);(b[0].id!=$.datepicker._mainDivId&&b.parents("#"+$.datepicker._mainDivId).length==0&&!b.hasClass($.datepicker.markerClassName)&&!b.hasClass($.datepicker._triggerClass)&&$.datepicker._datepickerShowing&&(!$.datepicker._inDialog||!$.blockUI)||b.hasClass($.datepicker.markerClassName)&&$.datepicker._curInst!=c)&&$.datepicker._hideDatepicker()}},_adjustDate:function(a,b,c){var d=$(a),e=this._getInst(d[0]);this._isDisabledDatepicker(d[0])||(this._adjustInstDate(e,b+(c=="M"?this._get(e,"showCurrentAtPos"):0),c),this._updateDatepicker(e))},_gotoToday:function(a){var b=$(a),c=this._getInst(b[0]);if(this._get(c,"gotoCurrent")&&c.currentDay)c.selectedDay=c.currentDay,c.drawMonth=c.selectedMonth=c.currentMonth,c.drawYear=c.selectedYear=c.currentYear;else{var d=new Date;c.selectedDay=d.getDate(),c.drawMonth=c.selectedMonth=d.getMonth(),c.drawYear=c.selectedYear=d.getFullYear()}this._notifyChange(c),this._adjustDate(b)},_selectMonthYear:function(a,b,c){var d=$(a),e=this._getInst(d[0]);e["selected"+(c=="M"?"Month":"Year")]=e["draw"+(c=="M"?"Month":"Year")]=parseInt(b.options[b.selectedIndex].value,10),this._notifyChange(e),this._adjustDate(d)},_selectDay:function(a,b,c,d){var e=$(a);if(!$(d).hasClass(this._unselectableClass)&&!this._isDisabledDatepicker(e[0])){var f=this._getInst(e[0]);f.selectedDay=f.currentDay=$("a",d).html(),f.selectedMonth=f.currentMonth=b,f.selectedYear=f.currentYear=c,this._selectDate(a,this._formatDate(f,f.currentDay,f.currentMonth,f.currentYear))}},_clearDate:function(a){var b=$(a),c=this._getInst(b[0]);this._selectDate(b,"")},_selectDate:function(a,b){var c=$(a),d=this._getInst(c[0]);b=b!=null?b:this._formatDate(d),d.input&&d.input.val(b),this._updateAlternate(d);var e=this._get(d,"onSelect");e?e.apply(d.input?d.input[0]:null,[b,d]):d.input&&d.input.trigger("change"),d.inline?this._updateDatepicker(d):(this._hideDatepicker(),this._lastInput=d.input[0],typeof d.input[0]!="object"&&d.input.focus(),this._lastInput=null)},_updateAlternate:function(a){var b=this._get(a,"altField");if(b){var c=this._get(a,"altFormat")||this._get(a,"dateFormat"),d=this._getDate(a),e=this.formatDate(c,d,this._getFormatConfig(a));$(b).each(function(){$(this).val(e)})}},noWeekends:function(a){var b=a.getDay();return[b>0&&b<6,""]},iso8601Week:function(a){var b=new Date(a.getTime());b.setDate(b.getDate()+4-(b.getDay()||7));var c=b.getTime();b.setMonth(0),b.setDate(1);return Math.floor(Math.round((c-b)/864e5)/7)+1},parseDate:function(a,b,c){if(a==null||b==null)throw"Invalid arguments";b=typeof b=="object"?b.toString():b+"";if(b=="")return null;var d=(c?c.shortYearCutoff:null)||this._defaults.shortYearCutoff;d=typeof d!="string"?d:(new Date).getFullYear()%100+parseInt(d,10);var e=(c?c.dayNamesShort:null)||this._defaults.dayNamesShort,f=(c?c.dayNames:null)||this._defaults.dayNames,g=(c?c.monthNamesShort:null)||this._defaults.monthNamesShort,h=(c?c.monthNames:null)||this._defaults.monthNames,i=-1,j=-1,k=-1,l=-1,m=!1,n=function(b){var c=s+1<a.length&&a.charAt(s+1)==b;c&&s++;return c},o=function(a){var c=n(a),d=a=="@"?14:a=="!"?20:a=="y"&&c?4:a=="o"?3:2,e=new RegExp("^\\d{1,"+d+"}"),f=b.substring(r).match(e);if(!f)throw"Missing number at position "+r;r+=f[0].length;return parseInt(f[0],10)},p=function(a,c,d){var e=$.map(n(a)?d:c,function(a,b){return[[b,a]]}).sort(function(a,b){return-(a[1].length-b[1].length)}),f=-1;$.each(e,function(a,c){var d=c[1];if(b.substr(r,d.length).toLowerCase()==d.toLowerCase()){f=c[0],r+=d.length;return!1}});if(f!=-1)return f+1;throw"Unknown name at position "+r},q=function(){if(b.charAt(r)!=a.charAt(s))throw"Unexpected literal at position "+r;r++},r=0;for(var s=0;s<a.length;s++)if(m)a.charAt(s)=="'"&&!n("'")?m=!1:q();else switch(a.charAt(s)){case"d":k=o("d");break;case"D":p("D",e,f);break;case"o":l=o("o");break;case"m":j=o("m");break;case"M":j=p("M",g,h);break;case"y":i=o("y");break;case"@":var t=new Date(o("@"));i=t.getFullYear(),j=t.getMonth()+1,k=t.getDate();break;case"!":var t=new Date((o("!")-this._ticksTo1970)/1e4);i=t.getFullYear(),j=t.getMonth()+1,k=t.getDate();break;case"'":n("'")?q():m=!0;break;default:q()}if(r<b.length)throw"Extra/unparsed characters found in date: "+b.substring(r);i==-1?i=(new Date).getFullYear():i<100&&(i+=(new Date).getFullYear()-(new Date).getFullYear()%100+(i<=d?0:-100));if(l>-1){j=1,k=l;for(;;){var u=this._getDaysInMonth(i,j-1);if(k<=u)break;j++,k-=u}}var t=this._daylightSavingAdjust(new Date(i,j-1,k));if(t.getFullYear()!=i||t.getMonth()+1!=j||t.getDate()!=k)throw"Invalid date";return t},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925))*24*60*60*1e7,formatDate:function(a,b,c){if(!b)return"";var d=(c?c.dayNamesShort:null)||this._defaults.dayNamesShort,e=(c?c.dayNames:null)||this._defaults.dayNames,f=(c?c.monthNamesShort:null)||this._defaults.monthNamesShort,g=(c?c.monthNames:null)||this._defaults.monthNames,h=function(b){var c=m+1<a.length&&a.charAt(m+1)==b;c&&m++;return c},i=function(a,b,c){var d=""+b;if(h(a))while(d.length<c)d="0"+d;return d},j=function(a,b,c,d){return h(a)?d[b]:c[b]},k="",l=!1;if(b)for(var m=0;m<a.length;m++)if(l)a.charAt(m)=="'"&&!h("'")?l=!1:k+=a.charAt(m);else switch(a.charAt(m)){case"d":k+=i("d",b.getDate(),2);break;case"D":k+=j("D",b.getDay(),d,e);break;case"o":k+=i("o",Math.round(((new Date(b.getFullYear(),b.getMonth(),b.getDate())).getTime()-(new Date(b.getFullYear(),0,0)).getTime())/864e5),3);break;case"m":k+=i("m",b.getMonth()+1,2);break;case"M":k+=j("M",b.getMonth(),f,g);break;case"y":k+=h("y")?b.getFullYear():(b.getYear()%100<10?"0":"")+b.getYear()%100;break;case"@":k+=b.getTime();break;case"!":k+=b.getTime()*1e4+this._ticksTo1970;break;case"'":h("'")?k+="'":l=!0;break;default:k+=a.charAt(m)}return k},_possibleChars:function(a){var b="",c=!1,d=function(b){var c=e+1<a.length&&a.charAt(e+1)==b;c&&e++;return c};for(var e=0;e<a.length;e++)if(c)a.charAt(e)=="'"&&!d("'")?c=!1:b+=a.charAt(e);else switch(a.charAt(e)){case"d":case"m":case"y":case"@":b+="0123456789";break;case"D":case"M":return null;case"'":d("'")?b+="'":c=!0;break;default:b+=a.charAt(e)}return b},_get:function(a,b){return a.settings[b]!==undefined?a.settings[b]:this._defaults[b]},_setDateFromField:function(a,b){if(a.input.val()!=a.lastVal){var c=this._get(a,"dateFormat"),d=a.lastVal=a.input?a.input.val():null,e,f;e=f=this._getDefaultDate(a);var g=this._getFormatConfig(a);try{e=this.parseDate(c,d,g)||f}catch(h){this.log(h),d=b?"":d}a.selectedDay=e.getDate(),a.drawMonth=a.selectedMonth=e.getMonth(),a.drawYear=a.selectedYear=e.getFullYear(),a.currentDay=d?e.getDate():0,a.currentMonth=d?e.getMonth():0,a.currentYear=d?e.getFullYear():0,this._adjustInstDate(a)}},_getDefaultDate:function(a){return this._restrictMinMax(a,this._determineDate(a,this._get(a,"defaultDate"),new Date))},_determineDate:function(a,b,c){var d=function(a){var b=new Date;b.setDate(b.getDate()+a);return b},e=function(b){try{return $.datepicker.parseDate($.datepicker._get(a,"dateFormat"),b,$.datepicker._getFormatConfig(a))}catch(c){}var d=(b.toLowerCase().match(/^c/)?$.datepicker._getDate(a):null)||new Date,e=d.getFullYear(),f=d.getMonth(),g=d.getDate(),h=/([+-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,i=h.exec(b);while(i){switch(i[2]||"d"){case"d":case"D":g+=parseInt(i[1],10);break;case"w":case"W":g+=parseInt(i[1],10)*7;break;case"m":case"M":f+=parseInt(i[1],10),g=Math.min(g,$.datepicker._getDaysInMonth(e,f));break;case"y":case"Y":e+=parseInt(i[1],10),g=Math.min(g,$.datepicker._getDaysInMonth(e,f))}i=h.exec(b)}return new Date(e,f,g)},f=b==null||b===""?c:typeof b=="string"?e(b):typeof b=="number"?isNaN(b)?c:d(b):new Date(b.getTime());f=f&&f.toString()=="Invalid Date"?c:f,f&&(f.setHours(0),f.setMinutes(0),f.setSeconds(0),f.setMilliseconds(0));return this._daylightSavingAdjust(f)},_daylightSavingAdjust:function(a){if(!a)return null;a.setHours(a.getHours()>12?a.getHours()+2:0);return a},_setDate:function(a,b,c){var d=!b,e=a.selectedMonth,f=a.selectedYear,g=this._restrictMinMax(a,this._determineDate(a,b,new Date));a.selectedDay=a.currentDay=g.getDate(),a.drawMonth=a.selectedMonth=a.currentMonth=g.getMonth(),a.drawYear=a.selectedYear=a.currentYear=g.getFullYear(),(e!=a.selectedMonth||f!=a.selectedYear)&&!c&&this._notifyChange(a),this._adjustInstDate(a),a.input&&a.input.val(d?"":this._formatDate(a))},_getDate:function(a){var b=!a.currentYear||a.input&&a.input.val()==""?null:this._daylightSavingAdjust(new Date(a.currentYear,a.currentMonth,a.currentDay));return b},_generateHTML:function(a){var b=new Date;b=this._daylightSavingAdjust(new Date(b.getFullYear(),b.getMonth(),b.getDate()));var c=this._get(a,"isRTL"),d=this._get(a,"showButtonPanel"),e=this._get(a,"hideIfNoPrevNext"),f=this._get(a,"navigationAsDateFormat"),g=this._getNumberOfMonths(a),h=this._get(a,"showCurrentAtPos"),i=this._get(a,"stepMonths"),j=g[0]!=1||g[1]!=1,k=this._daylightSavingAdjust(a.currentDay?new Date(a.currentYear,a.currentMonth,a.currentDay):new Date(9999,9,9)),l=this._getMinMaxDate(a,"min"),m=this._getMinMaxDate(a,"max"),n=a.drawMonth-h,o=a.drawYear;n<0&&(n+=12,o--);if(m){var p=this._daylightSavingAdjust(new Date(m.getFullYear(),m.getMonth()-g[0]*g[1]+1,m.getDate()));p=l&&p<l?l:p;while(this._daylightSavingAdjust(new Date(o,n,1))>p)n--,n<0&&(n=11,o--)}a.drawMonth=n,a.drawYear=o;var q=this._get(a,"prevText");q=f?this.formatDate(q,this._daylightSavingAdjust(new Date(o,n-i,1)),this._getFormatConfig(a)):q;var r=this._canAdjustMonth(a,-1,o,n)?'<a class="ui-datepicker-prev ui-corner-all" onclick="DP_jQuery_'+dpuuid+".datepicker._adjustDate('#"+a.id+"', -"+i+", 'M');\""+' title="'+q+'"><span class="ui-icon ui-icon-circle-triangle-'+(c?"e":"w")+'">'+q+"</span></a>":e?"":'<a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="'+q+'"><span class="ui-icon ui-icon-circle-triangle-'+(c?"e":"w")+'">'+q+"</span></a>",s=this._get(a,"nextText");s=f?this.formatDate(s,this._daylightSavingAdjust(new Date(o,n+i,1)),this._getFormatConfig(a)):s;var t=this._canAdjustMonth(a,1,o,n)?'<a class="ui-datepicker-next ui-corner-all" onclick="DP_jQuery_'+dpuuid+".datepicker._adjustDate('#"+a.id+"', +"+i+", 'M');\""+' title="'+s+'"><span class="ui-icon ui-icon-circle-triangle-'+(c?"w":"e")+'">'+s+"</span></a>":e?"":'<a class="ui-datepicker-next ui-corner-all ui-state-disabled" title="'+s+'"><span class="ui-icon ui-icon-circle-triangle-'+(c?"w":"e")+'">'+s+"</span></a>",u=this._get(a,"currentText"),v=this._get(a,"gotoCurrent")&&a.currentDay?k:b;u=f?this.formatDate(u,v,this._getFormatConfig(a)):u;var w=a.inline?"":'<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" onclick="DP_jQuery_'+dpuuid+'.datepicker._hideDatepicker();">'+this._get(a,"closeText")+"</button>",x=d?'<div class="ui-datepicker-buttonpane ui-widget-content">'+(c?w:"")+(this._isInRange(a,v)?'<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all" onclick="DP_jQuery_'+dpuuid+".datepicker._gotoToday('#"+a.id+"');\""+">"+u+"</button>":"")+(c?"":w)+"</div>":"",y=parseInt(this._get(a,"firstDay"),10);y=isNaN(y)?0:y;var z=this._get(a,"showWeek"),A=this._get(a,"dayNames"),B=this._get(a,"dayNamesShort"),C=this._get(a,"dayNamesMin"),D=this._get(a,"monthNames"),E=this._get(a,"monthNamesShort"),F=this._get(a,"beforeShowDay"),G=this._get(a,"showOtherMonths"),H=this._get(a,"selectOtherMonths"),I=this._get(a,"calculateWeek")||this.iso8601Week,J=this._getDefaultDate(a),K="";for(var L=0;L<g[0];L++){var M="";this.maxRows=4;for(var N=0;N<g[1];N++){var O=this._daylightSavingAdjust(new Date(o,n,a.selectedDay)),P=" ui-corner-all",Q="";if(j){Q+='<div class="ui-datepicker-group';if(g[1]>1)switch(N){case 0:Q+=" ui-datepicker-group-first",P=" ui-corner-"+(c?"right":"left");break;case g[1]-1:Q+=" ui-datepicker-group-last",P=" ui-corner-"+(c?"left":"right");break;default:Q+=" ui-datepicker-group-middle",P=""}Q+='">'}Q+='<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix'+P+'">'+(/all|left/.test(P)&&L==0?c?t:r:"")+(/all|right/.test(P)&&L==0?c?r:t:"")+this._generateMonthYearHeader(a,n,o,l,m,L>0||N>0,D,E)+'</div><table class="ui-datepicker-calendar"><thead>'+"<tr>";var R=z?'<th class="ui-datepicker-week-col">'+this._get(a,"weekHeader")+"</th>":"";for(var S=0;S<7;S++){var T=(S+y)%7;R+="<th"+((S+y+6)%7>=5?' class="ui-datepicker-week-end"':"")+">"+'<span title="'+A[T]+'">'+C[T]+"</span></th>"}Q+=R+"</tr></thead><tbody>";var U=this._getDaysInMonth(o,n);o==a.selectedYear&&n==a.selectedMonth&&(a.selectedDay=Math.min(a.selectedDay,U));var V=(this._getFirstDayOfMonth(o,n)-y+7)%7,W=Math.ceil((V+U)/7),X=j?this.maxRows>W?this.maxRows:W:W;this.maxRows=X;var Y=this._daylightSavingAdjust(new Date(o,n,1-V));for(var Z=0;Z<X;Z++){Q+="<tr>";var _=z?'<td class="ui-datepicker-week-col">'+this._get(a,"calculateWeek")(Y)+"</td>":"";for(var S=0;S<7;S++){var ba=F?F.apply(a.input?a.input[0]:null,[Y]):[!0,""],bb=Y.getMonth()!=n,bc=bb&&!H||!ba[0]||l&&Y<l||m&&Y>m;_+='<td class="'+((S+y+6)%7>=5?" ui-datepicker-week-end":"")+(bb?" ui-datepicker-other-month":"")+(Y.getTime()==O.getTime()&&n==a.selectedMonth&&a._keyEvent||J.getTime()==Y.getTime()&&J.getTime()==O.getTime()?" "+this._dayOverClass:"")+(bc?" "+this._unselectableClass+" ui-state-disabled":"")+(bb&&!G?"":" "+ba[1]+(Y.getTime()==k.getTime()?" "+this._currentClass:"")+(Y.getTime()==b.getTime()?" ui-datepicker-today":""))+'"'+((!bb||G)&&ba[2]?' title="'+ba[2]+'"':"")+(bc?"":' onclick="DP_jQuery_'+dpuuid+".datepicker._selectDay('#"+a.id+"',"+Y.getMonth()+","+Y.getFullYear()+', this);return false;"')+">"+(bb&&!G?"&#xa0;":bc?'<span class="ui-state-default">'+Y.getDate()+"</span>":'<a class="ui-state-default'+(Y.getTime()==b.getTime()?" ui-state-highlight":"")+(Y.getTime()==k.getTime()?" ui-state-active":"")+(bb?" ui-priority-secondary":"")+'" href="#">'+Y.getDate()+"</a>")+"</td>",Y.setDate(Y.getDate()+1),Y=this._daylightSavingAdjust(Y)}Q+=_+"</tr>"}n++,n>11&&(n=0,o++),Q+="</tbody></table>"+(j?"</div>"+(g[0]>0&&N==g[1]-1?'<div class="ui-datepicker-row-break"></div>':""):""),M+=Q}K+=M}K+=x+($.browser.msie&&parseInt($.browser.version,10)<7&&!a.inline?'<iframe src="javascript:false;" class="ui-datepicker-cover" frameborder="0"></iframe>':""),a._keyEvent=!1;return K},_generateMonthYearHeader:function(a,b,c,d,e,f,g,h){var i=this._get(a,"changeMonth"),j=this._get(a,"changeYear"),k=this
._get(a,"showMonthAfterYear"),l='<div class="ui-datepicker-title">',m="";if(f||!i)m+='<span class="ui-datepicker-month">'+g[b]+"</span>";else{var n=d&&d.getFullYear()==c,o=e&&e.getFullYear()==c;m+='<select class="ui-datepicker-month" onchange="DP_jQuery_'+dpuuid+".datepicker._selectMonthYear('#"+a.id+"', this, 'M');\" "+">";for(var p=0;p<12;p++)(!n||p>=d.getMonth())&&(!o||p<=e.getMonth())&&(m+='<option value="'+p+'"'+(p==b?' selected="selected"':"")+">"+h[p]+"</option>");m+="</select>"}k||(l+=m+(f||!i||!j?"&#xa0;":""));if(!a.yearshtml){a.yearshtml="";if(f||!j)l+='<span class="ui-datepicker-year">'+c+"</span>";else{var q=this._get(a,"yearRange").split(":"),r=(new Date).getFullYear(),s=function(a){var b=a.match(/c[+-].*/)?c+parseInt(a.substring(1),10):a.match(/[+-].*/)?r+parseInt(a,10):parseInt(a,10);return isNaN(b)?r:b},t=s(q[0]),u=Math.max(t,s(q[1]||""));t=d?Math.max(t,d.getFullYear()):t,u=e?Math.min(u,e.getFullYear()):u,a.yearshtml+='<select class="ui-datepicker-year" onchange="DP_jQuery_'+dpuuid+".datepicker._selectMonthYear('#"+a.id+"', this, 'Y');\" "+">";for(;t<=u;t++)a.yearshtml+='<option value="'+t+'"'+(t==c?' selected="selected"':"")+">"+t+"</option>";a.yearshtml+="</select>",l+=a.yearshtml,a.yearshtml=null}}l+=this._get(a,"yearSuffix"),k&&(l+=(f||!i||!j?"&#xa0;":"")+m),l+="</div>";return l},_adjustInstDate:function(a,b,c){var d=a.drawYear+(c=="Y"?b:0),e=a.drawMonth+(c=="M"?b:0),f=Math.min(a.selectedDay,this._getDaysInMonth(d,e))+(c=="D"?b:0),g=this._restrictMinMax(a,this._daylightSavingAdjust(new Date(d,e,f)));a.selectedDay=g.getDate(),a.drawMonth=a.selectedMonth=g.getMonth(),a.drawYear=a.selectedYear=g.getFullYear(),(c=="M"||c=="Y")&&this._notifyChange(a)},_restrictMinMax:function(a,b){var c=this._getMinMaxDate(a,"min"),d=this._getMinMaxDate(a,"max"),e=c&&b<c?c:b;e=d&&e>d?d:e;return e},_notifyChange:function(a){var b=this._get(a,"onChangeMonthYear");b&&b.apply(a.input?a.input[0]:null,[a.selectedYear,a.selectedMonth+1,a])},_getNumberOfMonths:function(a){var b=this._get(a,"numberOfMonths");return b==null?[1,1]:typeof b=="number"?[1,b]:b},_getMinMaxDate:function(a,b){return this._determineDate(a,this._get(a,b+"Date"),null)},_getDaysInMonth:function(a,b){return 32-this._daylightSavingAdjust(new Date(a,b,32)).getDate()},_getFirstDayOfMonth:function(a,b){return(new Date(a,b,1)).getDay()},_canAdjustMonth:function(a,b,c,d){var e=this._getNumberOfMonths(a),f=this._daylightSavingAdjust(new Date(c,d+(b<0?b:e[0]*e[1]),1));b<0&&f.setDate(this._getDaysInMonth(f.getFullYear(),f.getMonth()));return this._isInRange(a,f)},_isInRange:function(a,b){var c=this._getMinMaxDate(a,"min"),d=this._getMinMaxDate(a,"max");return(!c||b.getTime()>=c.getTime())&&(!d||b.getTime()<=d.getTime())},_getFormatConfig:function(a){var b=this._get(a,"shortYearCutoff");b=typeof b!="string"?b:(new Date).getFullYear()%100+parseInt(b,10);return{shortYearCutoff:b,dayNamesShort:this._get(a,"dayNamesShort"),dayNames:this._get(a,"dayNames"),monthNamesShort:this._get(a,"monthNamesShort"),monthNames:this._get(a,"monthNames")}},_formatDate:function(a,b,c,d){b||(a.currentDay=a.selectedDay,a.currentMonth=a.selectedMonth,a.currentYear=a.selectedYear);var e=b?typeof b=="object"?b:this._daylightSavingAdjust(new Date(d,c,b)):this._daylightSavingAdjust(new Date(a.currentYear,a.currentMonth,a.currentDay));return this.formatDate(this._get(a,"dateFormat"),e,this._getFormatConfig(a))}}),$.fn.datepicker=function(a){if(!this.length)return this;$.datepicker.initialized||($(document).mousedown($.datepicker._checkExternalClick).find("body").append($.datepicker.dpDiv),$.datepicker.initialized=!0);var b=Array.prototype.slice.call(arguments,1);if(typeof a=="string"&&(a=="isDisabled"||a=="getDate"||a=="widget"))return $.datepicker["_"+a+"Datepicker"].apply($.datepicker,[this[0]].concat(b));if(a=="option"&&arguments.length==2&&typeof arguments[1]=="string")return $.datepicker["_"+a+"Datepicker"].apply($.datepicker,[this[0]].concat(b));return this.each(function(){typeof a=="string"?$.datepicker["_"+a+"Datepicker"].apply($.datepicker,[this].concat(b)):$.datepicker._attachDatepicker(this,a)})},$.datepicker=new Datepicker,$.datepicker.initialized=!1,$.datepicker.uuid=(new Date).getTime(),$.datepicker.version="1.8.17",window["DP_jQuery_"+dpuuid]=$})(jQuery);/*
 * jQuery UI Progressbar 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Progressbar
 *
 * Depends:
 *   jquery.ui.core.js
 *   jquery.ui.widget.js
 */(function(a,b){a.widget("ui.progressbar",{options:{value:0,max:100},min:0,_create:function(){this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({role:"progressbar","aria-valuemin":this.min,"aria-valuemax":this.options.max,"aria-valuenow":this._value()}),this.valueDiv=a("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element),this.oldValue=this._value(),this._refreshValue()},destroy:function(){this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"),this.valueDiv.remove(),a.Widget.prototype.destroy.apply(this,arguments)},value:function(a){if(a===b)return this._value();this._setOption("value",a);return this},_setOption:function(b,c){b==="value"&&(this.options.value=c,this._refreshValue(),this._value()===this.options.max&&this._trigger("complete")),a.Widget.prototype._setOption.apply(this,arguments)},_value:function(){var a=this.options.value;typeof a!="number"&&(a=0);return Math.min(this.options.max,Math.max(this.min,a))},_percentage:function(){return 100*this._value()/this.options.max},_refreshValue:function(){var a=this.value(),b=this._percentage();this.oldValue!==a&&(this.oldValue=a,this._trigger("change")),this.valueDiv.toggle(a>this.min).toggleClass("ui-corner-right",a===this.options.max).width(b.toFixed(0)+"%"),this.element.attr("aria-valuenow",a)}}),a.extend(a.ui.progressbar,{version:"1.8.17"})})(jQuery);/*
 * jQuery UI Effects 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/
 */jQuery.effects||function(a,b){function l(b){if(!b||typeof b=="number"||a.fx.speeds[b])return!0;if(typeof b=="string"&&!a.effects[b])return!0;return!1}function k(b,c,d,e){typeof b=="object"&&(e=c,d=null,c=b,b=c.effect),a.isFunction(c)&&(e=c,d=null,c={});if(typeof c=="number"||a.fx.speeds[c])e=d,d=c,c={};a.isFunction(d)&&(e=d,d=null),c=c||{},d=d||c.duration,d=a.fx.off?0:typeof d=="number"?d:d in a.fx.speeds?a.fx.speeds[d]:a.fx.speeds._default,e=e||c.complete;return[b,c,d,e]}function j(a,b){var c={_:0},d;for(d in b)a[d]!=b[d]&&(c[d]=b[d]);return c}function i(b){var c,d;for(c in b)d=b[c],(d==null||a.isFunction(d)||c in g||/scrollbar/.test(c)||!/color/i.test(c)&&isNaN(parseFloat(d)))&&delete b[c];return b}function h(){var a=document.defaultView?document.defaultView.getComputedStyle(this,null):this.currentStyle,b={},c,d;if(a&&a.length&&a[0]&&a[a[0]]){var e=a.length;while(e--)c=a[e],typeof a[c]=="string"&&(d=c.replace(/\-(\w)/g,function(a,b){return b.toUpperCase()}),b[d]=a[c])}else for(c in a)typeof a[c]=="string"&&(b[c]=a[c]);return b}function d(b,d){var e;do{e=a.curCSS(b,d);if(e!=""&&e!="transparent"||a.nodeName(b,"body"))break;d="backgroundColor"}while(b=b.parentNode);return c(e)}function c(b){var c;if(b&&b.constructor==Array&&b.length==3)return b;if(c=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(b))return[parseInt(c[1],10),parseInt(c[2],10),parseInt(c[3],10)];if(c=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(b))return[parseFloat(c[1])*2.55,parseFloat(c[2])*2.55,parseFloat(c[3])*2.55];if(c=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(b))return[parseInt(c[1],16),parseInt(c[2],16),parseInt(c[3],16)];if(c=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(b))return[parseInt(c[1]+c[1],16),parseInt(c[2]+c[2],16),parseInt(c[3]+c[3],16)];if(c=/rgba\(0, 0, 0, 0\)/.exec(b))return e.transparent;return e[a.trim(b).toLowerCase()]}a.effects={},a.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor","borderTopColor","borderColor","color","outlineColor"],function(b,e){a.fx.step[e]=function(a){a.colorInit||(a.start=d(a.elem,e),a.end=c(a.end),a.colorInit=!0),a.elem.style[e]="rgb("+Math.max(Math.min(parseInt(a.pos*(a.end[0]-a.start[0])+a.start[0],10),255),0)+","+Math.max(Math.min(parseInt(a.pos*(a.end[1]-a.start[1])+a.start[1],10),255),0)+","+Math.max(Math.min(parseInt(a.pos*(a.end[2]-a.start[2])+a.start[2],10),255),0)+")"}});var e={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]},f=["add","remove","toggle"],g={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1};a.effects.animateClass=function(b,c,d,e){a.isFunction(d)&&(e=d,d=null);return this.queue(function(){var g=a(this),k=g.attr("style")||" ",l=i(h.call(this)),m,n=g.attr("class");a.each(f,function(a,c){b[c]&&g[c+"Class"](b[c])}),m=i(h.call(this)),g.attr("class",n),g.animate(j(l,m),{queue:!1,duration:c,easing:d,complete:function(){a.each(f,function(a,c){b[c]&&g[c+"Class"](b[c])}),typeof g.attr("style")=="object"?(g.attr("style").cssText="",g.attr("style").cssText=k):g.attr("style",k),e&&e.apply(this,arguments),a.dequeue(this)}})})},a.fn.extend({_addClass:a.fn.addClass,addClass:function(b,c,d,e){return c?a.effects.animateClass.apply(this,[{add:b},c,d,e]):this._addClass(b)},_removeClass:a.fn.removeClass,removeClass:function(b,c,d,e){return c?a.effects.animateClass.apply(this,[{remove:b},c,d,e]):this._removeClass(b)},_toggleClass:a.fn.toggleClass,toggleClass:function(c,d,e,f,g){return typeof d=="boolean"||d===b?e?a.effects.animateClass.apply(this,[d?{add:c}:{remove:c},e,f,g]):this._toggleClass(c,d):a.effects.animateClass.apply(this,[{toggle:c},d,e,f])},switchClass:function(b,c,d,e,f){return a.effects.animateClass.apply(this,[{add:c,remove:b},d,e,f])}}),a.extend(a.effects,{version:"1.8.17",save:function(a,b){for(var c=0;c<b.length;c++)b[c]!==null&&a.data("ec.storage."+b[c],a[0].style[b[c]])},restore:function(a,b){for(var c=0;c<b.length;c++)b[c]!==null&&a.css(b[c],a.data("ec.storage."+b[c]))},setMode:function(a,b){b=="toggle"&&(b=a.is(":hidden")?"show":"hide");return b},getBaseline:function(a,b){var c,d;switch(a[0]){case"top":c=0;break;case"middle":c=.5;break;case"bottom":c=1;break;default:c=a[0]/b.height}switch(a[1]){case"left":d=0;break;case"center":d=.5;break;case"right":d=1;break;default:d=a[1]/b.width}return{x:d,y:c}},createWrapper:function(b){if(b.parent().is(".ui-effects-wrapper"))return b.parent();var c={width:b.outerWidth(!0),height:b.outerHeight(!0),"float":b.css("float")},d=a("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),e=document.activeElement;b.wrap(d),(b[0]===e||a.contains(b[0],e))&&a(e).focus(),d=b.parent(),b.css("position")=="static"?(d.css({position:"relative"}),b.css({position:"relative"})):(a.extend(c,{position:b.css("position"),zIndex:b.css("z-index")}),a.each(["top","left","bottom","right"],function(a,d){c[d]=b.css(d),isNaN(parseInt(c[d],10))&&(c[d]="auto")}),b.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"}));return d.css(c).show()},removeWrapper:function(b){var c,d=document.activeElement;if(b.parent().is(".ui-effects-wrapper")){c=b.parent().replaceWith(b),(b[0]===d||a.contains(b[0],d))&&a(d).focus();return c}return b},setTransition:function(b,c,d,e){e=e||{},a.each(c,function(a,c){unit=b.cssUnit(c),unit[0]>0&&(e[c]=unit[0]*d+unit[1])});return e}}),a.fn.extend({effect:function(b,c,d,e){var f=k.apply(this,arguments),g={options:f[1],duration:f[2],callback:f[3]},h=g.options.mode,i=a.effects[b];if(a.fx.off||!i)return h?this[h](g.duration,g.callback):this.each(function(){g.callback&&g.callback.call(this)});return i.call(this,g)},_show:a.fn.show,show:function(a){if(l(a))return this._show.apply(this,arguments);var b=k.apply(this,arguments);b[1].mode="show";return this.effect.apply(this,b)},_hide:a.fn.hide,hide:function(a){if(l(a))return this._hide.apply(this,arguments);var b=k.apply(this,arguments);b[1].mode="hide";return this.effect.apply(this,b)},__toggle:a.fn.toggle,toggle:function(b){if(l(b)||typeof b=="boolean"||a.isFunction(b))return this.__toggle.apply(this,arguments);var c=k.apply(this,arguments);c[1].mode="toggle";return this.effect.apply(this,c)},cssUnit:function(b){var c=this.css(b),d=[];a.each(["em","px","%","pt"],function(a,b){c.indexOf(b)>0&&(d=[parseFloat(c),b])});return d}}),a.easing.jswing=a.easing.swing,a.extend(a.easing,{def:"easeOutQuad",swing:function(b,c,d,e,f){return a.easing[a.easing.def](b,c,d,e,f)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158,g=0,h=d;if(b==0)return c;if((b/=e)==1)return c+d;g||(g=e*.3);if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158,g=0,h=d;if(b==0)return c;if((b/=e)==1)return c+d;g||(g=e*.3);if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158,g=0,h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;g||(g=e*.3*1.5);if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-0.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,c,d,e,f,g){g==b&&(g=1.70158);return e*(c/=f)*c*((g+1)*c-g)+d},easeOutBack:function(a,c,d,e,f,g){g==b&&(g=1.70158);return e*((c=c/f-1)*c*((g+1)*c+g)+1)+d},easeInOutBack:function(a,c,d,e,f,g){g==b&&(g=1.70158);if((c/=f/2)<1)return e/2*c*c*(((g*=1.525)+1)*c-g)+d;return e/2*((c-=2)*c*(((g*=1.525)+1)*c+g)+2)+d},easeInBounce:function(b,c,d,e,f){return e-a.easing.easeOutBounce(b,f-c,0,e,f)+d},easeOutBounce:function(a,b,c,d,e){return(b/=e)<1/2.75?d*7.5625*b*b+c:b<2/2.75?d*(7.5625*(b-=1.5/2.75)*b+.75)+c:b<2.5/2.75?d*(7.5625*(b-=2.25/2.75)*b+.9375)+c:d*(7.5625*(b-=2.625/2.75)*b+.984375)+c},easeInOutBounce:function(b,c,d,e,f){if(c<f/2)return a.easing.easeInBounce(b,c*2,0,e,f)*.5+d;return a.easing.easeOutBounce(b,c*2-f,0,e,f)*.5+e*.5+d}})}(jQuery);/*
 * jQuery UI Effects Blind 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Blind
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.blind=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right"],e=a.effects.setMode(c,b.options.mode||"hide"),f=b.options.direction||"vertical";a.effects.save(c,d),c.show();var g=a.effects.createWrapper(c).css({overflow:"hidden"}),h=f=="vertical"?"height":"width",i=f=="vertical"?g.height():g.width();e=="show"&&g.css(h,0);var j={};j[h]=e=="show"?i:0,g.animate(j,b.duration,b.options.easing,function(){e=="hide"&&c.hide(),a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(c[0],arguments),c.dequeue()})})}})(jQuery);/*
 * jQuery UI Effects Bounce 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Bounce
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.bounce=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right"],e=a.effects.setMode(c,b.options.mode||"effect"),f=b.options.direction||"up",g=b.options.distance||20,h=b.options.times||5,i=b.duration||250;/show|hide/.test(e)&&d.push("opacity"),a.effects.save(c,d),c.show(),a.effects.createWrapper(c);var j=f=="up"||f=="down"?"top":"left",k=f=="up"||f=="left"?"pos":"neg",g=b.options.distance||(j=="top"?c.outerHeight({margin:!0})/3:c.outerWidth({margin:!0})/3);e=="show"&&c.css("opacity",0).css(j,k=="pos"?-g:g),e=="hide"&&(g=g/(h*2)),e!="hide"&&h--;if(e=="show"){var l={opacity:1};l[j]=(k=="pos"?"+=":"-=")+g,c.animate(l,i/2,b.options.easing),g=g/2,h--}for(var m=0;m<h;m++){var n={},p={};n[j]=(k=="pos"?"-=":"+=")+g,p[j]=(k=="pos"?"+=":"-=")+g,c.animate(n,i/2,b.options.easing).animate(p,i/2,b.options.easing),g=e=="hide"?g*2:g/2}if(e=="hide"){var l={opacity:0};l[j]=(k=="pos"?"-=":"+=")+g,c.animate(l,i/2,b.options.easing,function(){c.hide(),a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(this,arguments)})}else{var n={},p={};n[j]=(k=="pos"?"-=":"+=")+g,p[j]=(k=="pos"?"+=":"-=")+g,c.animate(n,i/2,b.options.easing).animate(p,i/2,b.options.easing,function(){a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(this,arguments)})}c.queue("fx",function(){c.dequeue()}),c.dequeue()})}})(jQuery);/*
 * jQuery UI Effects Clip 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Clip
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.clip=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right","height","width"],e=a.effects.setMode(c,b.options.mode||"hide"),f=b.options.direction||"vertical";a.effects.save(c,d),c.show();var g=a.effects.createWrapper(c).css({overflow:"hidden"}),h=c[0].tagName=="IMG"?g:c,i={size:f=="vertical"?"height":"width",position:f=="vertical"?"top":"left"},j=f=="vertical"?h.height():h.width();e=="show"&&(h.css(i.size,0),h.css(i.position,j/2));var k={};k[i.size]=e=="show"?j:0,k[i.position]=e=="show"?0:j/2,h.animate(k,{queue:!1,duration:b.duration,easing:b.options.easing,complete:function(){e=="hide"&&c.hide(),a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(c[0],arguments),c.dequeue()}})})}})(jQuery);/*
 * jQuery UI Effects Drop 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Drop
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.drop=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right","opacity"],e=a.effects.setMode(c,b.options.mode||"hide"),f=b.options.direction||"left";a.effects.save(c,d),c.show(),a.effects.createWrapper(c);var g=f=="up"||f=="down"?"top":"left",h=f=="up"||f=="left"?"pos":"neg",i=b.options.distance||(g=="top"?c.outerHeight({margin:!0})/2:c.outerWidth({margin:!0})/2);e=="show"&&c.css("opacity",0).css(g,h=="pos"?-i:i);var j={opacity:e=="show"?1:0};j[g]=(e=="show"?h=="pos"?"+=":"-=":h=="pos"?"-=":"+=")+i,c.animate(j,{queue:!1,duration:b.duration,easing:b.options.easing,complete:function(){e=="hide"&&c.hide(),a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(this,arguments),c.dequeue()}})})}})(jQuery);/*
 * jQuery UI Effects Explode 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Explode
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.explode=function(b){return this.queue(function(){var c=b.options.pieces?Math.round(Math.sqrt(b.options.pieces)):3,d=b.options.pieces?Math.round(Math.sqrt(b.options.pieces)):3;b.options.mode=b.options.mode=="toggle"?a(this).is(":visible")?"hide":"show":b.options.mode;var e=a(this).show().css("visibility","hidden"),f=e.offset();f.top-=parseInt(e.css("marginTop"),10)||0,f.left-=parseInt(e.css("marginLeft"),10)||0;var g=e.outerWidth(!0),h=e.outerHeight(!0);for(var i=0;i<c;i++)for(var j=0;j<d;j++)e.clone().appendTo("body").wrap("<div></div>").css({position:"absolute",visibility:"visible",left:-j*(g/d),top:-i*(h/c)}).parent().addClass("ui-effects-explode").css({position:"absolute",overflow:"hidden",width:g/d,height:h/c,left:f.left+j*(g/d)+(b.options.mode=="show"?(j-Math.floor(d/2))*(g/d):0),top:f.top+i*(h/c)+(b.options.mode=="show"?(i-Math.floor(c/2))*(h/c):0),opacity:b.options.mode=="show"?0:1}).animate({left:f.left+j*(g/d)+(b.options.mode=="show"?0:(j-Math.floor(d/2))*(g/d)),top:f.top+i*(h/c)+(b.options.mode=="show"?0:(i-Math.floor(c/2))*(h/c)),opacity:b.options.mode=="show"?1:0},b.duration||500);setTimeout(function(){b.options.mode=="show"?e.css({visibility:"visible"}):e.css({visibility:"visible"}).hide(),b.callback&&b.callback.apply(e[0]),e.dequeue(),a("div.ui-effects-explode").remove()},b.duration||500)})}})(jQuery);/*
 * jQuery UI Effects Fade 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Fade
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.fade=function(b){return this.queue(function(){var c=a(this),d=a.effects.setMode(c,b.options.mode||"hide");c.animate({opacity:d},{queue:!1,duration:b.duration,easing:b.options.easing,complete:function(){b.callback&&b.callback.apply(this,arguments),c.dequeue()}})})}})(jQuery);/*
 * jQuery UI Effects Fold 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Fold
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.fold=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right"],e=a.effects.setMode(c,b.options.mode||"hide"),f=b.options.size||15,g=!!b.options.horizFirst,h=b.duration?b.duration/2:a.fx.speeds._default/2;a.effects.save(c,d),c.show();var i=a.effects.createWrapper(c).css({overflow:"hidden"}),j=e=="show"!=g,k=j?["width","height"]:["height","width"],l=j?[i.width(),i.height()]:[i.height(),i.width()],m=/([0-9]+)%/.exec(f);m&&(f=parseInt(m[1],10)/100*l[e=="hide"?0:1]),e=="show"&&i.css(g?{height:0,width:f}:{height:f,width:0});var n={},p={};n[k[0]]=e=="show"?l[0]:f,p[k[1]]=e=="show"?l[1]:0,i.animate(n,h,b.options.easing).animate(p,h,b.options.easing,function(){e=="hide"&&c.hide(),a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(c[0],arguments),c.dequeue()})})}})(jQuery);/*
 * jQuery UI Effects Highlight 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Highlight
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.highlight=function(b){return this.queue(function(){var c=a(this),d=["backgroundImage","backgroundColor","opacity"],e=a.effects.setMode(c,b.options.mode||"show"),f={backgroundColor:c.css("backgroundColor")};e=="hide"&&(f.opacity=0),a.effects.save(c,d),c.show().css({backgroundImage:"none",backgroundColor:b.options.color||"#ffff99"}).animate(f,{queue:!1,duration:b.duration,easing:b.options.easing,complete:function(){e=="hide"&&c.hide(),a.effects.restore(c,d),e=="show"&&!a.support.opacity&&this.style.removeAttribute("filter"),b.callback&&b.callback.apply(this,arguments),c.dequeue()}})})}})(jQuery);/*
 * jQuery UI Effects Pulsate 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Pulsate
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.pulsate=function(b){return this.queue(function(){var c=a(this),d=a.effects.setMode(c,b.options.mode||"show");times=(b.options.times||5)*2-1,duration=b.duration?b.duration/2:a.fx.speeds._default/2,isVisible=c.is(":visible"),animateTo=0,isVisible||(c.css("opacity",0).show(),animateTo=1),(d=="hide"&&isVisible||d=="show"&&!isVisible)&&times--;for(var e=0;e<times;e++)c.animate({opacity:animateTo},duration,b.options.easing),animateTo=(animateTo+1)%2;c.animate({opacity:animateTo},duration,b.options.easing,function(){animateTo==0&&c.hide(),b.callback&&b.callback.apply(this,arguments)}),c.queue("fx",function(){c.dequeue()}).dequeue()})}})(jQuery);/*
 * jQuery UI Effects Scale 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Scale
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.puff=function(b){return this.queue(function(){var c=a(this),d=a.effects.setMode(c,b.options.mode||"hide"),e=parseInt(b.options.percent,10)||150,f=e/100,g={height:c.height(),width:c.width()};a.extend(b.options,{fade:!0,mode:d,percent:d=="hide"?e:100,from:d=="hide"?g:{height:g.height*f,width:g.width*f}}),c.effect("scale",b.options,b.duration,b.callback),c.dequeue()})},a.effects.scale=function(b){return this.queue(function(){var c=a(this),d=a.extend(!0,{},b.options),e=a.effects.setMode(c,b.options.mode||"effect"),f=parseInt(b.options.percent,10)||(parseInt(b.options.percent,10)==0?0:e=="hide"?0:100),g=b.options.direction||"both",h=b.options.origin;e!="effect"&&(d.origin=h||["middle","center"],d.restore=!0);var i={height:c.height(),width:c.width()};c.from=b.options.from||(e=="show"?{height:0,width:0}:i);var j={y:g!="horizontal"?f/100:1,x:g!="vertical"?f/100:1};c.to={height:i.height*j.y,width:i.width*j.x},b.options.fade&&(e=="show"&&(c.from.opacity=0,c.to.opacity=1),e=="hide"&&(c.from.opacity=1,c.to.opacity=0)),d.from=c.from,d.to=c.to,d.mode=e,c.effect("size",d,b.duration,b.callback),c.dequeue()})},a.effects.size=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right","width","height","overflow","opacity"],e=["position","top","bottom","left","right","overflow","opacity"],f=["width","height","overflow"],g=["fontSize"],h=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"],i=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"],j=a.effects.setMode(c,b.options.mode||"effect"),k=b.options.restore||!1,l=b.options.scale||"both",m=b.options.origin,n={height:c.height(),width:c.width()};c.from=b.options.from||n,c.to=b.options.to||n;if(m){var p=a.effects.getBaseline(m,n);c.from.top=(n.height-c.from.height)*p.y,c.from.left=(n.width-c.from.width)*p.x,c.to.top=(n.height-c.to.height)*p.y,c.to.left=(n.width-c.to.width)*p.x}var q={from:{y:c.from.height/n.height,x:c.from.width/n.width},to:{y:c.to.height/n.height,x:c.to.width/n.width}};if(l=="box"||l=="both")q.from.y!=q.to.y&&(d=d.concat(h),c.from=a.effects.setTransition(c,h,q.from.y,c.from),c.to=a.effects.setTransition(c,h,q.to.y,c.to)),q.from.x!=q.to.x&&(d=d.concat(i),c.from=a.effects.setTransition(c,i,q.from.x,c.from),c.to=a.effects.setTransition(c,i,q.to.x,c.to));(l=="content"||l=="both")&&q.from.y!=q.to.y&&(d=d.concat(g),c.from=a.effects.setTransition(c,g,q.from.y,c.from),c.to=a.effects.setTransition(c,g,q.to.y,c.to)),a.effects.save(c,k?d:e),c.show(),a.effects.createWrapper(c),c.css("overflow","hidden").css(c.from);if(l=="content"||l=="both")h=h.concat(["marginTop","marginBottom"]).concat(g),i=i.concat(["marginLeft","marginRight"]),f=d.concat(h).concat(i),c.find("*[width]").each(function(){child=a(this),k&&a.effects.save(child,f);var c={height:child.height(),width:child.width()};child.from={height:c.height*q.from.y,width:c.width*q.from.x},child.to={height:c.height*q.to.y,width:c.width*q.to.x},q.from.y!=q.to.y&&(child.from=a.effects.setTransition(child,h,q.from.y,child.from),child.to=a.effects.setTransition(child,h,q.to.y,child.to)),q.from.x!=q.to.x&&(child.from=a.effects.setTransition(child,i,q.from.x,child.from),child.to=a.effects.setTransition(child,i,q.to.x,child.to)),child.css(child.from),child.animate(child.to,b.duration,b.options.easing,function(){k&&a.effects.restore(child,f)})});c.animate(c.to,{queue:!1,duration:b.duration,easing:b.options.easing,complete:function(){c.to.opacity===0&&c.css("opacity",c.from.opacity),j=="hide"&&c.hide(),a.effects.restore(c,k?d:e),a.effects.removeWrapper(c),b.callback&&b.callback.apply(this,arguments),c.dequeue()}})})}})(jQuery);/*
 * jQuery UI Effects Shake 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Shake
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.shake=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right"],e=a.effects.setMode(c,b.options.mode||"effect"),f=b.options.direction||"left",g=b.options.distance||20,h=b.options.times||3,i=b.duration||b.options.duration||140;a.effects.save(c,d),c.show(),a.effects.createWrapper(c);var j=f=="up"||f=="down"?"top":"left",k=f=="up"||f=="left"?"pos":"neg",l={},m={},n={};l[j]=(k=="pos"?"-=":"+=")+g,m[j]=(k=="pos"?"+=":"-=")+g*2,n[j]=(k=="pos"?"-=":"+=")+g*2,c.animate(l,i,b.options.easing);for(var p=1;p<h;p++)c.animate(m,i,b.options.easing).animate(n,i,b.options.easing);c.animate(m,i,b.options.easing).animate(l,i/2,b.options.easing,function(){a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(this,arguments)}),c.queue("fx",function(){c.dequeue()}),c.dequeue()})}})(jQuery);/*
 * jQuery UI Effects Slide 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Slide
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.slide=function(b){return this.queue(function(){var c=a(this),d=["position","top","bottom","left","right"],e=a.effects.setMode(c,b.options.mode||"show"),f=b.options.direction||"left";a.effects.save(c,d),c.show(),a.effects.createWrapper(c).css({overflow:"hidden"});var g=f=="up"||f=="down"?"top":"left",h=f=="up"||f=="left"?"pos":"neg",i=b.options.distance||(g=="top"?c.outerHeight({margin:!0}):c.outerWidth({margin:!0}));e=="show"&&c.css(g,h=="pos"?isNaN(i)?"-"+i:-i:i);var j={};j[g]=(e=="show"?h=="pos"?"+=":"-=":h=="pos"?"-=":"+=")+i,c.animate(j,{queue:!1,duration:b.duration,easing:b.options.easing,complete:function(){e=="hide"&&c.hide(),a.effects.restore(c,d),a.effects.removeWrapper(c),b.callback&&b.callback.apply(this,arguments),c.dequeue()}})})}})(jQuery);/*
 * jQuery UI Effects Transfer 1.8.17
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/Effects/Transfer
 *
 * Depends:
 *	jquery.effects.core.js
 */(function(a,b){a.effects.transfer=function(b){return this.queue(function(){var c=a(this),d=a(b.options.to),e=d.offset(),f={top:e.top,left:e.left,height:d.innerHeight(),width:d.innerWidth()},g=c.offset(),h=a('<div class="ui-effects-transfer"></div>').appendTo(document.body).addClass(b.options.className).css({top:g.top,left:g.left,height:c.innerHeight(),width:c.innerWidth(),position:"absolute"}).animate(f,b.duration,b.options.easing,function(){h.remove(),b.callback&&b.callback.apply(c[0],arguments),c.dequeue()})})}})(jQuery);
/* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
/* Written by Andrew Stromnov (stromnov@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: '&#x3c;Пред',
		nextText: 'След&#x3e;',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		dateFormat: 'dd.mm.yy', firstDay: 1,
		isRTL: false};
	$.datepicker.setDefaults($.datepicker.regional['ru']);
});
/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};
jQuery(
	function()
	{
		jQuery( '.accordion' ).accordion(
			{
				autoHeight : false , 
				animated : 'slide'
			}
		);
	}
);
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.select_extractor )
{
	ultimix.select_extractor = {};
}

/**
*	Function saves the data to the exact element.
*
* 	@param Items - Elements wich accept data.
*
* 	@param Value - Data to be saved.
*
* 	@return true if the data was saved, false otherwise.
*
* 	@author Dodonov A.A.
*/
ultimix.select_extractor.SetData = function( Items , Value )
{
	for( var i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).prop( 'tagName' ) == 'INPUT' || 
			jQuery( Items[ i ] ).prop( 'tagName' ) == 'TEXTAREA' )
		{
			jQuery( Items[ i ] ).val( Value );
			continue;
		}
		if( jQuery( Items[ i ] ).prop( 'tagName' ) == 'SPAN' || 
			jQuery( Items[ i ] ).prop( 'tagName' ) == 'DIV' || 
			jQuery( Items[ i ] ).prop( 'tagName' ) == 'A' )
		{
			jQuery( Items[ i ] ).html( Value );
			continue;
		}
	}
}

/**
*	Function saves the selected value.
*
* 	@param AcceptorSelector - Selector of the field for the selected data.
*
* 	@param StatusSelector - Selector of the field woch will display the selected data.
*
* 	@return true if the data was saved, false otherwise.
*
* 	@author Dodonov A.A.
*/
ultimix.select_extractor.ExtractSimpleSelectResult = function( AcceptorSelector , StatusSelector , DataSource )
{
	var	Radios = jQuery( 'input[name=' + DataSource + ']:radio' );

	for( var i = 0 ; i < Radios.length ; i++ )
	{
		if( jQuery( Radios[ i ] ).attr( 'checked' ) )
		{
			var	Items = jQuery( AcceptorSelector );
			ultimix.SetData( Items , jQuery( Radios[ i ] ).attr( 'value' ) );

			Status = jQuery( '[for=' + jQuery( Radios[ i ] ).attr( 'id' ) + ']' ).html();
			Items = jQuery( StatusSelector );
			ultimix.SetData( Items , Status );
			
			return( true );
		}
	}
	
	return( false );
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Function shows/hides any element on the page.
*
*	@param ElementId - Element's id.
*
*	@param Speed - Animation speed.
*
*	@author Dodonov A.A.
*/
ultimix.ToggleElement = function( ElementId , Speed )
{
	jQuery( '#' + ElementId ).toggle( Speed );
}
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.request_manager )
{
	ultimix.request_manager = {};
}

/**
*	Function compiles opener options.
*
*	@param Obj - Settings.
*
*	@param Type - Type of the opener.
*
*	@author Dodonov A.A.
*/
ultimix.request_manager.compile_opener_data = function( Obj , Type )
{
	var			OpenerData = {};

	OpenerData.OpenIn = Type;
	OpenerData.TabControl = jQuery( Obj ).attr( 'tab_control' );
	OpenerData.Title = jQuery( Obj ).attr( 'title' );
	OpenerData.URL = jQuery( Obj ).attr( 'url' );

	return( OpenerData );
}

/**
*	Function add iframe tab opener.
*
*	@param Obj - Settings.
*
*	@author Dodonov A.A.
*/
ultimix.request_manager.add_iframe_tab_opener = function( Obj )
{
	var			OpenerData = ultimix.request_manager.compile_opener_data( Obj , 'iframe_tab' );

	jQuery( Obj ).attr( 'href' , 'javascript:void(0);' );

	jQuery( Obj ).click(
		function( EventObject )
		{
			var			Opener = OpenerData;
			ultimix.tab_control.add_iframe_tab( 
				OpenerData.TabControl , OpenerData.Title , -1 , OpenerData.URL , true , 400
			);
		}
	);
}

/**
*	Function add ajax tab opener.
*
*	@param Obj - Settings.
*
*	@author Dodonov A.A.
*/
ultimix.request_manager.add_ajax_tab_opener = function( Obj )
{
	var			OpenerData = ultimix.request_manager.compile_opener_data( Obj , 'ajax_tab' );

	jQuery( Obj ).attr( 'href' , 'javascript:void(0);' );

	jQuery( Obj ).click(
		function()
		{
			var			Opener = OpenerData;
			ultimix.tab_control.add_simple_tab_from_content( Opener.TabControl , Opener.Title , -1 , '' );
			ultimix.tab_control.set_closable( Opener.TabControl );

			var			Selector = '#' + Opener.TabControl;
			var			Tab = jQuery( Selector ).find( 'div.ui-tabs-panel' ).last();
			ultimix.ajax_gate.DirectViewComposer( Tab , {} , Opener.URL , {} );
		}
	);
}

jQuery(
	function()
	{
		jQuery( 'a' ).each(
			function( i , Obj )
			{
				var			OpenIn = jQuery( Obj ).attr( 'open_in' );
				if( OpenIn == '' )
				{
					return; // no special action
				}

				switch( OpenIn )
				{
					case( 'iframe_tab' ):ultimix.request_manager.add_iframe_tab_opener( Obj );
					case( 'ajax_tab' ):ultimix.request_manager.add_ajax_tab_opener( Obj );
				}
			}
		);
	}
);

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.tab_control )
{
	ultimix.tab_control = {};
	ultimix.tab_control.TabCounter = 1;
	ultimix.tab_control.AddTabFlag = 0;
	ultimix.tab_control.AddContentId = '_unexisting_id';
	ultimix.tab_control.InitialTabWasDeleted = new Array();
	ultimix.tab_control.SelectCreated = false;
	ultimix.tab_control.InsertIndex = -1;
	ultimix.tab_control.AutoSelect = false;
}

/**
*	Function sets up control after it was created.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.tab_control_create_setup = function( ControlId )
{
	jQuery( '#' + ControlId ).tabs(
		{
			select : function( event , ui )
			{
				if( ultimix.tab_control.AddTabFlag == 0 )
				{
					jQuery.cookie( ControlId + '-active-tab-id' , ui.tab.hash.replace( '#' , '' ) );
					return;
				}
				ultimix.tab_control.AddTabFlag = 0;
			}
		}
	);
	
	ultimix.tab_control.set_add_tab_handler( ControlId );
}

/**
*	Function creates tab control.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.create_tab = function( ControlId )
{
	var			TabId = 'tabs' + ultimix.tab_control.TabCounter++;
	jQuery( '#' + ControlId ).html( '<ul><li><a href="#' + TabId + '"></a></li></ul><div id="' + TabId + '"></div>' );
	
	jQuery( '#' + ControlId ).tabs();
	
	ultimix.tab_control.tab_control_create_setup( ControlId );
	
	ultimix.tab_control.InitialTabWasDeleted[ ControlId ] = false;
}

/**
*	Function processes close tab event.
*
*	@param ControlId - id of the tab control.
*
*	@param Tab - Taf.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.on_close_tab = function( ControlId , Tab )
{
	var 		index = jQuery( '#' + ControlId ).children( 'ul' ).children( 'li' ).index( jQuery( Tab ).parent() );
	jQuery( '#' + ControlId ).tabs( 'remove' , index );
}

/**
*	Function adds close button to the tab.
*
*	@param ControlId - id of the tab control.
*
*	@param TabCursor - Cursor of the processing tab. If not set then last tab will be modified.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.set_closable = function( ControlId , TabCursor )
{
	if( TabCursor )
	{
		var 		Item = jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' ).eq( TabCursor );
	}
	else
	{
		var 		Item = jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' ).last();
	}

	if( jQuery( Item ).next().length )
	{
		jQuery( Item ).next().remove();
	}

	jQuery( Item ).after( 
		'<span class="ui-icon ui-icon-close" onclick="ultimix.tab_control.on_close_tab( \'' + ControlId + 
		'\' , this );" title="' + ultimix.get_string( 'close_tab' ) + '">&nbsp;</span>'
	);
}

/**
*	Function tries to activate added tab.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.try_auto_select_tab = function( ControlId )
{
	if( ultimix.tab_control.AutoSelect == false )
	{
		return;
	}
	var			ActiveTabId = jQuery.cookie( ControlId + '-active-tab-id' );
	ActiveTabId = ActiveTabId ? ActiveTabId : 'tabs1';

	if( jQuery( '#' + ControlId ).find( '#' + ActiveTabId ).length )
	{
		var			Items = jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' );
		for( var i = 0 ; i < Items.length ; i++ )
		{
			if( jQuery( Items[ i ] ).attr( 'href' ) == '#' + ActiveTabId )
			{
				jQuery( '#' + ControlId ).tabs( "select" , i );
				ultimix.tab_control.AddTabFlag = 0;
			}
		}
	}
}

/**
*	Function adds handler for the 'add tab' event.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.set_add_tab_handler = function( ControlId )
{
	jQuery( '#' + ControlId ).tabs( 
		'option' , 'add' , 
		function( event , ui )
		{
			jQuery( ui.panel ).append( jQuery( '#' + ultimix.tab_control.AddContentId ) );

			if( ultimix.tab_control.SelectCreated )
			{
				var			TabIndex = ultimix.tab_control.count_of_tabs( ControlId ) - 1;
				TabIndex = ultimix.tab_control.InsertIndex == -1 ? TabIndex : ultimix.tab_control.InsertIndex;
				jQuery( '#' + ControlId ).tabs( "select" , TabIndex );
			}
			else
			{
				ultimix.tab_control.try_auto_select_tab( ControlId );
			}
		}
	);
}

/**
*	Function adds simple tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param ContentId - id of the tab's content.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_simple_tab = function( ControlId , Title , Index , ContentId , Selected )
{
	/* Informing the script that we are additing tabs and there is no need to update cookie */
	ultimix.tab_control.AddTabFlag = 1;
	ultimix.tab_control.AddContentId = ContentId;
	ultimix.tab_control.SelectCreated = Selected;
	ultimix.tab_control.InsertIndex = Index;

	var			TabSelector = '#tabs' + ( ultimix.tab_control.TabCounter++ );

	if( Index >= 0 )
	{
		jQuery( '#' + ControlId ).tabs( 'add' , TabSelector , ultimix.get_string( Title ) , Index );
	}
	else
	{
		jQuery( '#' + ControlId ).tabs( 'add' , TabSelector , ultimix.get_string( Title ) );
	}
}

/**
*	Function adds simple tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param Content - Tab content.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_simple_tab_from_content = function( ControlId , Title , Index , Content , Selected )
{
	var			ContentId = "content_" + ultimix.core.GetCurrentMilliseconds();

	jQuery( 'body' ).append( '<div id="' + ContentId + '" style=\"height: 100%;\">' + Content + '</div>' );

	ultimix.tab_control.add_simple_tab( ControlId , Title , Index , ContentId , Selected );
}

/**
*	Function adds tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param ContentId - id of the tab's content.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_tab = function( ControlId , Title , Index , ContentId , Closable , Selected )
{
	ultimix.tab_control.add_simple_tab( ControlId , Title , Index , ContentId , Selected );

	if( ultimix.tab_control.InitialTabWasDeleted[ ControlId ] == false )
	{
		var			TabIndex = ultimix.tab_control.InsertIndex == -1 ? 0 : 1;
		jQuery( '#' + ControlId ).tabs( 'remove' , TabIndex );
		ultimix.tab_control.InitialTabWasDeleted[ ControlId ] = true;
	}

	if( Closable )
	{
		ultimix.tab_control.set_closable( ControlId );
	}
}

/**
*	Function adds tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param ContentId - id of the tab's content.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_tab_from_content = function( ControlId , Title , Index , Content , Closable , Selected )
{
	var			ContentId = "content_" + ultimix.core.GetCurrentMilliseconds();

	jQuery( 'body' ).append( '<div id="' + ContentId + '" style=\"height: 100%;\">' + Content + '</div>' );

	ultimix.tab_control.add_tab( ControlId , Title , Index , ContentId , Closable , Selected );
}

/**
*	Function adds tab to the control.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param URL - URL of the iframe source.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Height - Height of the iframe.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_iframe_tab = function( ControlId , Title , Index , URL , Closable , Height , Selected )
{
	var			TabFrameId = ultimix.tab_control.TabCounter++;

	jQuery( 'body' ).append( '<iframe style="width: 100%; border: 0px; height: ' + Height + ';" id="tab_frame_' + 
		TabFrameId + '" src="' + URL + '"></iframe>' );

	ultimix.tab_control.add_tab( ControlId , Title , Index , "tab_frame_" + TabFrameId , Closable , Selected )
}

/**
*	Function creates the control from the murkup.
*
*	@param ControlId - id of the tab control.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.create_tab_control_from_markup = function( ControlId )
{
	jQuery( '#' + ControlId ).tabs();

	ultimix.tab_control.tab_control_create_setup( ControlId );
}

/**
*	Function creates the control from the murkup.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the tab.
*
*	@param Content - Content of the tab.
*
*	@param Closable - Should be the creating tab closable.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.create_tab_control_with_tab = function( ParentSelector , ControlId , Title , Content , Closable )
{
	/* preparing markup */
	jQuery( ParentSelector ).append( 
		'<div id="' + ControlId + 
		'"><ul><li><a href="#tabs-1">' + ultimix.get_string( Title ) + '</a></li></ul><div id="tabs-1">' + 
		Content + '</div></div>'
	);

	/* creating tab */
	ultimix.tab_control.create_tab_control_from_markup( ControlId );

	if( Closable )
	{
		ultimix.tab_control.set_closable( ControlId );
	}
}

/**
*	Function adds tab to the control. If the control does not exist then it will be created.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param Content - Content of the tab.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_tab_for_existing_control = function( ParentSelector , ControlId , Title , Index , Content , 
																								Closable , Selected )
{
	if( jQuery( '#' + ControlId ).length )
	{
		/* control exists */
		ultimix.tab_control.add_tab_from_content( ControlId , Title , Index , Content , Closable , Selected );
	}
	else
	{
		/* control does not exist */
		ultimix.tab_control.create_tab_control_with_tab( ParentSelector , ControlId , Title , Content , Closable );
	}
}

/**
*	Function adds tab to the control. If the control does not exist then it will be created.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param URL - URL of the iframe source.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Height - Height of the iframe.
*
*	@param Selected - Should this tab be selected.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.add_iframe_tab_for_existing_control = function( ParentSelector , ControlId , Title , Index , URL , 
																						Closable , Height , Selected )
{
	if( jQuery( '#' + ControlId ).length )
	{
		/* control exists */
		ultimix.tab_control.add_iframe_tab( ControlId , Title , Index , URL , Closable , Height );
	}
	else
	{
		var			ContentId = "content_" + ultimix.core.GetCurrentMilliseconds();

		/* control does not exist */
		var			Content = '<iframe style="width: 100%; border: 0px; height: ' + Height + ';" id="tab_frame_' + 
							  TabFrameId + '" src="' + URL + '"></iframe>';

		ultimix.tab_control.create_tab_control_with_tab( 
			ParentSelector , ControlId , Title , Content , Closable , Selected
		);
	}
}


/**
*	Function returns count of tabs.
*
*	@param ControlId - id of the tab control.
*
*	@return Count of tabs.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.count_of_tabs = function( ControlId )
{
	return( jQuery( '#' + ControlId + '>.ui-tabs-nav>li>a' ).length );
}

/**
*	Function creates add tab from content delegate.
*
*	@param ParentSelector - Selector of the tab parent.
*
*	@param ControlId - id of the tab control.
*
*	@param Title - Title of the additing tab.
*
*	@param Index - Index of the additing tab.
*
*	@param Closable - Should be the creating tab closable.
*
*	@param Selected - Should this tab be selected.
*
*	@return Function.
*
*	@author Dodonov A.A.
*/
ultimix.tab_control.get_tab_content_acceptor = function( ControlId , Title , Index , Closable , Selected )
{
	var			CreatedTab = false;
	return(
		{
			before_request : function()
				{
					ultimix.tab_control.add_tab_from_content( 
						ControlId , Title , Index , ultimix.std_dialogs.loading_img_widget() , Closable , Selected
					);

					Index = Index == -1 ? ultimix.tab_control.count_of_tabs( ControlId ) - 1 : Index;
					CreatedTab = jQuery( '#' + ControlId ).children( 'div' ).eq( Index );
				} , 
			success : function( Content )
				{
					jQuery( CreatedTab ).html( Content );
				}
		}
	);
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.print )
{
	ultimix.print = {};
}

/**
*	Function prints page.
*
*	@author Dodonov A.A.
*/
ultimix.print.PrintPage = function()
{
	window.print();
}

jQuery(
	function()
	{
		if( jQuery( '.auto_print' ).length > 0 )
		{
			ultimix.print.PrintPage();
		}
	}
);
var		dropdown_block_class = function( element , options )
{
	this._element = jQuery( element );
	this._block_name = 'block-' + ( ++dropdown_block_class.blockId );
	this.init( options );
}

dropdown_block_class.blockId = 0;

dropdown_block_class.prototype.init = function( options )
{
	var	obj = this;
	
	var	ExtClass = '';
	if( options.ext_class )
	{
		ExtClass = ' ' + options.ext_class;
	}
	
	jQuery( this._element ).after( '<div class="popup_block_panel' + ExtClass + '" style="position:absolute; display:none;" id="' + this._block_name + '">' + options.content + '</div>' );
	
	jQuery( this._element ).mouseover(
		function( evt )
		{
			var	position = jQuery( obj._element ).position();
			var	height = jQuery( obj._element ).outerHeight( true );
			
			jQuery( '#' + obj._block_name ).css( 'left' , position.left );
			jQuery( '#' + obj._block_name ).css( 'top' , position.top + height - 1 );
			jQuery( '#' + obj._block_name ).css( 'display' , 'block' );
		}
	);
	
	jQuery( document ).mousemove(
		function( evt )
		{
			var	offset = jQuery( obj._element ).offset();
			var	height = jQuery( obj._element ).outerHeight( true );
			var	width = jQuery( obj._element ).outerWidth( true );
			
			if( offset.left <= evt.pageX && evt.pageX <= offset.left + width && offset.top <= evt.pageY && evt.pageY <= offset.top + height )
			{
				return;
			}
			
			offset = jQuery( obj._element ).next().offset();
			height = jQuery( obj._element ).next().outerHeight( true );
			width = jQuery( obj._element ).next().outerWidth( true );
			
			if( offset.left <= evt.pageX && evt.pageX <= offset.left + width && offset.top <= evt.pageY && evt.pageY <= offset.top + height )
			{
				return;
			}
			
			jQuery( obj._element ).next().css( 'display' , 'none' );
		}
	);
}

jQuery.fn.dropdown_block = function( options )
{
	options = jQuery.extend(
		{
			content : 'empty'
		} , 
		options
	);

	if( this.length == 0 )
	{
		result = false;
	}
	else if( this.length == 1 )
	{
		result = new dropdown_block_class( jQuery( this ) , options );
	}
	else
	{
		result = [];
						
		for( i = 0 ; i < this.length ; i++ )
		{
			result.push( new dropdown_block_class( jQuery( this[ i ] ) , options ) );
		}
	}

	return( result );
}
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	var 	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.timer )
{
	ultimix.timer = {};
}

jQuery.extend( 
	ultimix , 
	{
		timer_widget : function( Element , Options )
		{						
			this._element = Element;
			this.timeout = Options.timeout;
			this.timeout_callback = Options.timeout_callback;
			
			this.init();
		}
	}
);

ultimix.timer_widget.prototype._prepending_zero = function( Value )
{
	if( Value < 10 )
	{
		return( '0' + Value );
	}
	else
	{
		return( '' + Value );
	}
}

ultimix.timer_widget.prototype.init = function()
{
	obj = this;
	this.set_timer( this.timeout );
	this.timeout_callback_was_launched = false;
	
	this.start_time = Math.floor( ( new Date() ).getTime() / 1000 );
	window.setInterval( function(){ obj.on_tick( obj ) } , 1000 );
}

ultimix.timer_widget.prototype.set_timer = function( Time )
{
	Hours = Math.floor( Time / ( 60 * 60 ) );
	Minutes = Math.floor( Time / 60 - Hours * 60 );
	Seconds = Math.floor( Time - Hours * 60 * 60 - Minutes * 60 );
	jQuery( this._element ).empty();
	jQuery( this._element ).append( 
		'<span class="hours">' + this._prepending_zero( Hours ) + '</span>:<span class="minutes">' + 
		this._prepending_zero( Minutes ) + '</span>:<span class="seconds">' + this._prepending_zero( Seconds ) + 
		'</span>'
	);
}

ultimix.timer_widget.prototype.on_tick = function( obj )
{
	Diff = Math.floor( ( new Date() ).getTime() / 1000 ) - obj.start_time;
	if( obj.timeout - Diff > 0 )
	{
		obj.set_timer( obj.timeout - Diff );
	}
	else
	{
		obj.set_timer( 0 );
		if( obj.timeout_callback_was_launched == false )
		{
			if( obj.timeout_callback )
			{
				obj.timeout_callback();
			}
			obj.timeout_callback_was_launched = true;
		}
	}
}

jQuery.fn.timer_widget = function( Options )
{
	Options = jQuery.extend(
		{
			timeout				: 600 , /*in seconds*/
			timeout_callback 	: false
		} , 
		Options
	);
	
	return jQuery.each(
		function()
		{
			new ultimix.timer_widget( jQuery( this ) , Options );
		}
	);
}

/**
 * .disableTextSelect - Disable Text Select Plugin
 *
 * Version: 1.1
 * Updated: 2007-11-28
 *
 * Used to stop users from selecting text
 *
 * Copyright (c) 2007 James Dempster (letssurf@gmail.com, http://www.jdempster.com/category/jquery/disabletextselect/)
 *
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 **/

/**
 * Requirements:
 * - jQuery (John Resig, http://www.jquery.com/)
 **/
(function($) {
    if ($.browser.mozilla) {
        $.fn.disableTextSelect = function() {
            return this.each(function() {
                $(this).css({
                    'MozUserSelect' : 'none'
                });
            });
        };
        $.fn.enableTextSelect = function() {
            return this.each(function() {
                $(this).css({
                    'MozUserSelect' : ''
                });
            });
        };
    } else if ($.browser.msie) {
        $.fn.disableTextSelect = function() {
            return this.each(function() {
                $(this).bind('selectstart.disableTextSelect', function() {
                    return false;
                });
            });
        };
        $.fn.enableTextSelect = function() {
            return this.each(function() {
                $(this).unbind('selectstart.disableTextSelect');
            });
        };
    } else {
        $.fn.disableTextSelect = function() {
            return this.each(function() {
                $(this).bind('mousedown.disableTextSelect', function() {
                    return false;
                });
            });
        };
        $.fn.enableTextSelect = function() {
            return this.each(function() {
                $(this).unbind('mousedown.disableTextSelect');
            });
        };
    }
})(jQuery);
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.dialog )
{
	ultimix.dialog = {};
}

/**
*	This method inits opener for the dialog.
*
*	@param Item - Opener.
*
*	@param OpenDialogFunction - Opening method.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.init_click_handlers = function( Item , OpenDialogFunction )
{
	jQuery( Item ).unbind( 'click' );
	jQuery( Item ).click( OpenDialogFunction );

	if( jQuery( Item ).attr( 'tagName' ) == 'A' )
	{
		jQuery( Item ).attr( 'href' , '#' );
	}

	if( jQuery( Item ).attr( 'tagName' ) == 'INPUT' || jQuery( Item ).attr( 'tagName' ) == 'TEXTAREA' )
	{
		jQuery( Item ).unbind( 'focus' );
		jQuery( Item ).focus( OpenDialogFunction );
	}
}

/**
*	This method inits opener for the dialog.
*
*	@param Opener - Opener's selector.
*
*	@param Selector - Selector of the dialog.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@param Validation - Before open validation method.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.add_opener = function( Opener , Selector , DataAcceptor , StatusAcceptor , DataSource , Validation )
{
	if( Opener )
	{
		if( jQuery( Opener ).length )
		{
			var	Items = jQuery( Opener );

			for( var i = 0 ; i < Items.length ; i++ )
			{
				var			OpenDialogFunction = function()
				{
					ultimix.dialog.open_dialog( 
						Selector , DataAcceptor , StatusAcceptor , DataSource , Validation
					);
				}
				ultimix.dialog.init_click_handlers( Items[ i ] , OpenDialogFunction );
			}
		}
	}
}

/**
*	This method opens dialog.
*
*	@param Selector - Selector of the dialog.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@param BeforeOpenValidation - Before open validation method.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.open_dialog = function( Selector , DataAcceptor , StatusAcceptor , DataSource , BeforeOpenValidation )
{
	jQuery( Selector ).attr( 'data_acceptor' , DataAcceptor );
	jQuery( Selector ).attr( 'status_acceptor' , StatusAcceptor );
	jQuery( Selector ).attr( 'data_source' , DataSource );
	
	if( BeforeOpenValidation && BeforeOpenValidation() == false )
	{
		return;
	}

	scroll( 0 , 0 );
	jQuery( Selector ).dialog( 'open' );
	jQuery( Selector ).dialog( { position: [ 'center' , 'center' ] } );
}

/**
*	This shows DOM element in the dialog.
*
*	@param Selector - Selector of the dialog.
*
*	@param Title - Dialog's title.
*
*	@author Dodonov A.A.
*/
ultimix.dialog.show_dom_in_dialog = function( Selector , Title )
{
	jQuery( Selector ).dialog(
		{
			'title' : Title , 
			'width' : 'auto' , 
			'maxWidth' : '960' , 
			'height' : '500' , 
			'modal' : true , 
			'buttons' : [
				{
					text: "OK",
					click: function()
					{
						jQuery( this ).dialog( 'close' );
					}
				}
			]
		}
	);
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.wizard )
{
	ultimix.wizard = {};
}

/**
*	Wizard steps.
*
*	@author Dodonov A.A.
*/
ultimix.wizard.Steps = new Array();

/**
*	Current wizard's step.
*
*	@author Dodonov A.A.
*/
ultimix.wizard.CurrentStep = -1;

/**
*	Function creates wizard's dialog.
*
*	@param RawSteps - wizard steps.
*
*	@param SuccessFunction - this function will be executed at the end of the wizard.
*
*	@param DialogOptions - visualisation options of the wizard dialog.
*
*	@author Dodonov A.A.
*/
ultimix.wizard._CreateWizardDialogs = function( RawSteps , SuccessFunction , DialogOptions )
{
	ultimix.wizard.Steps = RawSteps;
	
	DialogOptions = jQuery.extend(
		{
			width : 640 , 
			height : 480 , 
			modal : true , 
			autoOpen : true , 
			resizable : false , 
			closeOnEscape : false , 
			title : ''
		} , 
		DialogOptions
	);
	DialogOptions.autoOpen = false;
	if( DialogOptions.title )
	{
		DialogOptions.title = ultimix.get_string( DialogOptions.title );
	}
	
	for( var i = 0 ; i < ultimix.wizard.Steps.length ; i++ )
	{
		var		Buttons = new Array();
		var		CurrentSelector = ultimix.wizard.Steps[ i ].selector;
		
		if( i + 1 < ultimix.wizard.Steps.length )
		{
			var		CreateNextButton = function( i , CurrentSelector )
			{
				return(
					function()
					{
						jQuery( CurrentSelector ).dialog( 'close' );
						jQuery( ultimix.wizard.Steps[ i + 1 ].selector ).dialog( 'open' );
						jQuery( ultimix.wizard.Steps[ i + 1 ].selector ).dialog( 
							'option' , 'title' , DialogOptions.title + ' ' + ultimix.get_string( 'step' ) + ' ' + 
							( i + 2 ) + ' ' + ultimix.get_string( 'of' ) + ' ' + ultimix.wizard.Steps.length
						);
					}
				);
			}
			Buttons[ ultimix.get_string( 'Next' ) ] = CreateNextButton( i , CurrentSelector );
		}
		
		if( i + 1 == ultimix.wizard.Steps.length )
		{
			var		CreateFinishButton = function( i , CurrentSelector )
			{
				return(
					function()
					{
						SuccessFunction();
						jQuery( CurrentSelector ).dialog( 'close' );
					}
				);
			}
			Buttons[ ultimix.get_string( 'Finish' ) ] = CreateFinishButton( i , CurrentSelector );
		}
		
		if( i > 0 )
		{
			var		CreateBackButton = function( i , CurrentSelector )
			{
				return(
					function()
					{
						jQuery( CurrentSelector ).dialog( 'close' );
						jQuery( ultimix.wizard.Steps[ i - 1 ].selector ).dialog( 'open' );
						jQuery( ultimix.wizard.Steps[ i - 1 ].selector ).dialog( 
							'option' , 'title' , DialogOptions.title + ' ' + ultimix.get_string( 'step' ) + ' ' + i + 
							' ' + ultimix.get_string( 'of' ) + ' ' + ultimix.wizard.Steps.length
						);
					}
				);
			}
			Buttons[ ultimix.get_string( 'Back' ) ] = CreateBackButton( i , CurrentSelector );
		}
		
		var		CreateCancelButton = function( CurrentSelector )
		{
			return(
				function()
				{
					jQuery( CurrentSelector ).dialog( 'close' );
				}
			);
		};
		Buttons[ ultimix.get_string( 'Cancel' ) ] = CreateCancelButton( CurrentSelector );
		
		DialogOptions.buttons = Buttons;
		
		jQuery( ultimix.wizard.Steps[ i ].selector ).dialog( DialogOptions );
	}
}

/**
*	Function runs wizard.
*
*	@param RawSteps - wizard steps.
*
*	@param SuccessFunction - this function will be executed at the end of the wizard.
*
*	@param DialogOptions - visualisation options of the wizard dialog.
*
*	@author Dodonov A.A.
*/
ultimix.wizard.Wizard = function( RawSteps , SuccessFunction , DialogOptions )
{
	ultimix.wizard.CurrentStep = -1;

	ultimix.wizard._CreateWizardDialogs( RawSteps , SuccessFunction , DialogOptions );

	jQuery( ultimix.wizard.Steps[ 0 ].selector ).dialog( 'open' );

	jQuery( ultimix.wizard.Steps[ 0 ].selector ).dialog( 
		'option' , 'title' , DialogOptions.title + ' ' + ultimix.get_string( 'step' ) + ' ' + 1 + ' ' + 
		ultimix.get_string( 'of' ) + ' ' + ultimix.wizard.Steps.length
	);
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	This function initializes iframe dialog.
*
*	@param DivSelector - id of the iframe's bounding div.
*
*	@param Url - URL of the loading resource.
*
*	@author Dodonov A.A.
*/
ultimix.IframeDialogInit = function( DivSelector , Url )
{
	jQuery( '#' + DivSelector ).html( 
		'<iframe style="border:0px; width: 100%; height: 100%;" src="' + Url + '"></iframe>'
	);
	
	return( true );
}

/**
*	This function will be called after the dialog opening.
*
*	@param DivSelector - id of the iframe's bounding div.
*
*	@author Dodonov A.A.
*/
ultimix.IframeDialogOnOpen = function( DivSelector )
{
	jQuery( '#' + DivSelector ).attr( 'style' , 'padding: 0px; ' + jQuery( '#' + DivSelector ).attr( 'style' ) );
}

// TODO ��������� ���� ���� ����-������ � ����� ���������� �����
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_settings' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_settings' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_settings' ][ 'default' ] = 'Настройки системы';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_settings_label' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_settings_label' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_settings_label' ][ 'default' ] = 'Настройки<br>системы';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_were_saved' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_were_saved' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_were_saved' ][ 'default' ] = 'Настройки были сохранены';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'form_manifest_was_not_found' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'form_manifest_was_not_found' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'form_manifest_was_not_found' ][ 'default' ] = 'Манифест не был найден';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'illegal_setting_type' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'illegal_setting_type' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'illegal_setting_type' ][ 'default' ] = 'Некорректный тип настройки';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_site_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_site_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_site_title' ][ 'default' ] = 'Название сайта';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'welcome_text_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'welcome_text_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'welcome_text_title' ][ 'default' ] = 'Заголовок приветствия';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'welcome_text_demo' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'welcome_text_demo' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'welcome_text_demo' ][ 'default' ] = 'Демо приветствия';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'company_name' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'company_name' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'company_name' ][ 'default' ] = 'Название компании';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'front_page_welcome_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'front_page_welcome_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'front_page_welcome_title' ][ 'default' ] = 'Заголовок приветствия на главной';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'front_page_welcome_text' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'front_page_welcome_text' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'front_page_welcome_text' ][ 'default' ] = 'Приветствие на главной';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'user_settings' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'user_settings' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'user_settings' ][ 'default' ] = 'Регистрация';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_settings' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_settings' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_settings' ][ 'default' ] = 'Сайт';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'template_settings' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'template_settings' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'template_settings' ][ 'default' ] = 'Шаблоны';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_template_name' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_template_name' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_template_name' ][ 'default' ] = 'Пакет шаблона сайта';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_template_version' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_template_version' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_template_version' ][ 'default' ] = 'Версия шаблона сайта';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_admin_template_name' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_admin_template_name' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_admin_template_name' ][ 'default' ] = 'Пакет шаблона админки';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_admin_template_version' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_admin_template_version' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'default_admin_template_version' ][ 'default' ] = 'Версия шаблона админки';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'email_sender' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'email_sender' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'email_sender' ][ 'default' ] = 'Отправитель';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_email' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_email' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'system_email' ][ 'default' ] = 'Системный email';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_site_session_timeout' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_site_session_timeout' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'settings_site_session_timeout' ][ 'default' ] = 'Длительность сессии';

/*
 * jQuery Media Plugin for converting elements into rich media content.
 *
 * Examples and documentation at: http://malsup.com/jquery/media/
 * Copyright (c) 2007-2010 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * @author: M. Alsup
 * @version: 0.97 (20-MAY-2011)
 * @requires jQuery v1.1.2 or later
 * $Id: jquery.media.js 2460 2007-07-23 02:53:15Z malsup $
 *
 * Supported Media Players:
 *	- Flash
 *	- Quicktime
 *	- Real Player
 *	- Silverlight
 *	- Windows Media Player
 *	- iframe
 *
 * Supported Media Formats:
 *	 Any types supported by the above players, such as:
 *	 Video: asf, avi, flv, mov, mpg, mpeg, mp4, qt, smil, swf, wmv, 3g2, 3gp
 *	 Audio: aif, aac, au, gsm, mid, midi, mov, mp3, m4a, snd, rm, wav, wma
 *	 Other: bmp, html, pdf, psd, qif, qtif, qti, tif, tiff, xaml
 *
 * Thanks to Mark Hicken and Brent Pedersen for helping me debug this on the Mac!
 * Thanks to Dan Rossi for numerous bug reports and code bits!
 * Thanks to Skye Giordano for several great suggestions!
 * Thanks to Richard Connamacher for excellent improvements to the non-IE behavior!
 */
;(function($) {

var lameIE = $.browser.msie && $.browser.version < 9;

/**
 * Chainable method for converting elements into rich media.
 *
 * @param options
 * @param callback fn invoked for each matched element before conversion
 * @param callback fn invoked for each matched element after conversion
 */
$.fn.media = function(options, f1, f2) {
	if (options == 'undo') {
		return this.each(function() {
			var $this = $(this);
			var html = $this.data('media.origHTML');
			if (html)
				$this.replaceWith(html);
		});
	}
	
	return this.each(function() {
		if (typeof options == 'function') {
			f2 = f1;
			f1 = options;
			options = {};
		}
		var o = getSettings(this, options);
		// pre-conversion callback, passes original element and fully populated options
		if (typeof f1 == 'function') f1(this, o);

		var r = getTypesRegExp();
		var m = r.exec(o.src.toLowerCase()) || [''];

		o.type ? m[0] = o.type : m.shift();
		for (var i=0; i < m.length; i++) {
			fn = m[i].toLowerCase();
			if (isDigit(fn[0])) fn = 'fn' + fn; // fns can't begin with numbers
			if (!$.fn.media[fn])
				continue;  // unrecognized media type
			// normalize autoplay settings
			var player = $.fn.media[fn+'_player'];
			if (!o.params) o.params = {};
			if (player) {
				var num = player.autoplayAttr == 'autostart';
				o.params[player.autoplayAttr || 'autoplay'] = num ? (o.autoplay ? 1 : 0) : o.autoplay ? true : false;
			}
			var $div = $.fn.media[fn](this, o);

			$div.css('backgroundColor', o.bgColor).width(o.width);
			
			if (o.canUndo) {
				var $temp = $('<div></div>').append(this);
				$div.data('media.origHTML', $temp.html()); // store original markup
			}
			
			// post-conversion callback, passes original element, new div element and fully populated options
			if (typeof f2 == 'function') f2(this, $div[0], o, player.name);
			break;
		}
	});
};

/**
 * Non-chainable method for adding or changing file format / player mapping
 * @name mapFormat
 * @param String format File format extension (ie: mov, wav, mp3)
 * @param String player Player name to use for the format (one of: flash, quicktime, realplayer, winmedia, silverlight or iframe
 */
$.fn.media.mapFormat = function(format, player) {
	if (!format || !player || !$.fn.media.defaults.players[player]) return; // invalid
	format = format.toLowerCase();
	if (isDigit(format[0])) format = 'fn' + format;
	$.fn.media[format] = $.fn.media[player];
	$.fn.media[format+'_player'] = $.fn.media.defaults.players[player];
};

// global defautls; override as needed
$.fn.media.defaults = {
	standards:  true,       // use object tags only (no embeds for non-IE browsers)
	canUndo:    true,       // tells plugin to store the original markup so it can be reverted via: $(sel).mediaUndo()
	width:		400,
	height:		400,
	autoplay:	0,		   	// normalized cross-player setting
	bgColor:	'#ffffff', 	// background color
	params:		{ wmode: 'transparent'},	// added to object element as param elements; added to embed element as attrs
	attrs:		{},			// added to object and embed elements as attrs
	flvKeyName: 'file', 	// key used for object src param (thanks to Andrea Ercolino)
	flashvars:	{},			// added to flash content as flashvars param/attr
	flashVersion:	'7',	// required flash version
	expressInstaller: null,	// src for express installer

	// default flash video and mp3 player (@see: http://jeroenwijering.com/?item=Flash_Media_Player)
	flvPlayer:	 'mediaplayer.swf',
	mp3Player:	 'mediaplayer.swf',

	// @see http://msdn2.microsoft.com/en-us/library/bb412401.aspx
	silverlight: {
		inplaceInstallPrompt: 'true', // display in-place install prompt?
		isWindowless:		  'true', // windowless mode (false for wrapping markup)
		framerate:			  '24',	  // maximum framerate
		version:			  '0.9',  // Silverlight version
		onError:			  null,	  // onError callback
		onLoad:			      null,   // onLoad callback
		initParams:			  null,	  // object init params
		userContext:		  null	  // callback arg passed to the load callback
	}
};

// Media Players; think twice before overriding
$.fn.media.defaults.players = {
	flash: {
		name:		 'flash',
		title:		 'Flash',
		types:		 'flv,mp3,swf',
		mimetype:	 'application/x-shockwave-flash',
		pluginspage: 'http://www.adobe.com/go/getflashplayer',
		ieAttrs: {
			classid:  'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000',
			type:	  'application/x-oleobject',
			codebase: 'http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=' + $.fn.media.defaults.flashVersion
		}
	},
	quicktime: {
		name:		 'quicktime',
		title:		 'QuickTime',
		mimetype:	 'video/quicktime',
		pluginspage: 'http://www.apple.com/quicktime/download/',
		types:		 'aif,aiff,aac,au,bmp,gsm,mov,mid,midi,mpg,mpeg,mp4,m4a,psd,qt,qtif,qif,qti,snd,tif,tiff,wav,3g2,3gp',
		ieAttrs: {
			classid:  'clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B',
			codebase: 'http://www.apple.com/qtactivex/qtplugin.cab'
		}
	},
	realplayer: {
		name:		  'real',
		title:		  'RealPlayer',
		types:		  'ra,ram,rm,rpm,rv,smi,smil',
		mimetype:	  'audio/x-pn-realaudio-plugin',
		pluginspage:  'http://www.real.com/player/',
		autoplayAttr: 'autostart',
		ieAttrs: {
			classid: 'clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA'
		}
	},
	winmedia: {
		name:		  'winmedia',
		title:		  'Windows Media',
		types:		  'asx,asf,avi,wma,wmv',
		mimetype:	  $.browser.mozilla && isFirefoxWMPPluginInstalled() ? 'application/x-ms-wmp' : 'application/x-mplayer2',
		pluginspage:  'http://www.microsoft.com/Windows/MediaPlayer/',
		autoplayAttr: 'autostart',
		oUrl:		  'url',
		ieAttrs: {
			classid:  'clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6',
			type:	  'application/x-oleobject'
		}
	},
	// special cases
	img: {
		name:  'img',
		title: 'Image',
		types: 'gif,png,jpg'
	},
	iframe: {
		name:  'iframe',
		types: 'html,pdf'
	},
	silverlight: {
		name:  'silverlight',
		types: 'xaml'
	}
};

//
//	everything below here is private
//


// detection script for FF WMP plugin (http://www.therossman.org/experiments/wmp_play.html)
// (hat tip to Mark Ross for this script)
function isFirefoxWMPPluginInstalled() {
	var plugs = navigator.plugins;
	for (var i = 0; i < plugs.length; i++) {
		var plugin = plugs[i];
		if (plugin['filename'] == 'np-mswmp.dll')
			return true;
	}
	return false;
}

var counter = 1;

for (var player in $.fn.media.defaults.players) {
	var types = $.fn.media.defaults.players[player].types;
	$.each(types.split(','), function(i,o) {
		if (isDigit(o[0])) o = 'fn' + o;
		$.fn.media[o] = $.fn.media[player] = getGenerator(player);
		$.fn.media[o+'_player'] = $.fn.media.defaults.players[player];
	});
};

function getTypesRegExp() {
	var types = '';
	for (var player in $.fn.media.defaults.players) {
		if (types.length) types += ',';
		types += $.fn.media.defaults.players[player].types;
	};
	return new RegExp('\\.(' + types.replace(/,/ig,'|') + ')\\b');
};

function getGenerator(player) {
	return function(el, options) {
		return generate(el, options, player);
	};
};

function isDigit(c) {
	return '0123456789'.indexOf(c) > -1;
};

// flatten all possible options: global defaults, meta, option obj
function getSettings(el, options) {
	options = options || {};
	var $el = $(el);
	var cls = el.className || '';
	// support metadata plugin (v1.0 and v2.0)
	var meta = $.metadata ? $el.metadata() : $.meta ? $el.data() : {};
	meta = meta || {};
	var w = meta.width  || parseInt(((cls.match(/\bw:(\d+)/)||[])[1]||0)) || parseInt(((cls.match(/\bwidth:(\d+)/)||[])[1]||0));
	var h = meta.height || parseInt(((cls.match(/\bh:(\d+)/)||[])[1]||0)) || parseInt(((cls.match(/\bheight:(\d+)/)||[])[1]||0))

	if (w) meta.width	= w;
	if (h) meta.height = h;
	if (cls) meta.cls = cls;
	
	// crank html5 style data attributes
	var dataName = 'data-';
    for (var i=0; i < el.attributes.length; i++) {
        var a = el.attributes[i], n = $.trim(a.name);
        var index = n.indexOf(dataName);
        if (index === 0) {
        	n = n.substring(dataName.length);
        	meta[n] = a.value;
        }
    }

	var a = $.fn.media.defaults;
	var b = options;
	var c = meta;

	var p = { params: { bgColor: options.bgColor || $.fn.media.defaults.bgColor } };
	var opts = $.extend({}, a, b, c);
	$.each(['attrs','params','flashvars','silverlight'], function(i,o) {
		opts[o] = $.extend({}, p[o] || {}, a[o] || {}, b[o] || {}, c[o] || {});
	});

	if (typeof opts.caption == 'undefined') opts.caption = $el.text();

	// make sure we have a source!
	opts.src = opts.src || $el.attr('href') || $el.attr('src') || 'unknown';
	return opts;
};

//
//	Flash Player
//

// generate flash using SWFObject library if possible
$.fn.media.swf = function(el, opts) {
	if (!window.SWFObject && !window.swfobject) {
		// roll our own
		if (opts.flashvars) {
			var a = [];
			for (var f in opts.flashvars)
				a.push(f + '=' + opts.flashvars[f]);
			if (!opts.params) opts.params = {};
			opts.params.flashvars = a.join('&');
		}
		return generate(el, opts, 'flash');
	}

	var id = el.id ? (' id="'+el.id+'"') : '';
	var cls = opts.cls ? (' class="' + opts.cls + '"') : '';
	var $div = $('<div' + id + cls + '>');

	// swfobject v2+
	if (window.swfobject) {
		$(el).after($div).appendTo($div);
		if (!el.id) el.id = 'movie_player_' + counter++;

		// replace el with swfobject content
		swfobject.embedSWF(opts.src, el.id, opts.width, opts.height, opts.flashVersion,
			opts.expressInstaller, opts.flashvars, opts.params, opts.attrs);
	}
	// swfobject < v2
	else {
		$(el).after($div).remove();
		var so = new SWFObject(opts.src, 'movie_player_' + counter++, opts.width, opts.height, opts.flashVersion, opts.bgColor);
		if (opts.expressInstaller) so.useExpressInstall(opts.expressInstaller);

		for (var p in opts.params)
			if (p != 'bgColor') so.addParam(p, opts.params[p]);
		for (var f in opts.flashvars)
			so.addVariable(f, opts.flashvars[f]);
		so.write($div[0]);
	}

	if (opts.caption) $('<div>').appendTo($div).html(opts.caption);
	return $div;
};

// map flv and mp3 files to the swf player by default
$.fn.media.flv = $.fn.media.mp3 = function(el, opts) {
	var src = opts.src;
	var player = /\.mp3\b/i.test(src) ? opts.mp3Player : opts.flvPlayer;
	var key = opts.flvKeyName;
	src = encodeURIComponent(src);
	opts.src = player;
	opts.src = opts.src + '?'+key+'=' + (src);
	var srcObj = {};
	srcObj[key] = src;
	opts.flashvars = $.extend({}, srcObj, opts.flashvars );
	return $.fn.media.swf(el, opts);
};

//
//	Silverlight
//
$.fn.media.xaml = function(el, opts) {
	if (!window.Sys || !window.Sys.Silverlight) {
		if ($.fn.media.xaml.warning) return;
		$.fn.media.xaml.warning = 1;
		alert('You must include the Silverlight.js script.');
		return;
	}

	var props = {
		width: opts.width,
		height: opts.height,
		background: opts.bgColor,
		inplaceInstallPrompt: opts.silverlight.inplaceInstallPrompt,
		isWindowless: opts.silverlight.isWindowless,
		framerate: opts.silverlight.framerate,
		version: opts.silverlight.version
	};
	var events = {
		onError: opts.silverlight.onError,
		onLoad: opts.silverlight.onLoad
	};

	var id1 = el.id ? (' id="'+el.id+'"') : '';
	var id2 = opts.id || 'AG' + counter++;
	// convert element to div
	var cls = opts.cls ? (' class="' + opts.cls + '"') : '';
	var $div = $('<div' + id1 + cls + '>');
	$(el).after($div).remove();

	Sys.Silverlight.createObjectEx({
		source: opts.src,
		initParams: opts.silverlight.initParams,
		userContext: opts.silverlight.userContext,
		id: id2,
		parentElement: $div[0],
		properties: props,
		events: events
	});

	if (opts.caption) $('<div>').appendTo($div).html(opts.caption);
	return $div;
};

//
// generate object/embed markup
//
function generate(el, opts, player) {
	var $el = $(el);
	var o = $.fn.media.defaults.players[player];

	if (player == 'iframe') {
		o = $('<iframe' + ' width="' + opts.width + '" height="' + opts.height + '" >');
		o.attr('src', opts.src);
		o.css('backgroundColor', o.bgColor);
	}
	else if (player == 'img') {
		o = $('<img>');
		o.attr('src', opts.src);
		opts.width && o.attr('width', opts.width);
		opts.height && o.attr('height', opts.height);
		o.css('backgroundColor', o.bgColor);
	}
	else if (lameIE) {
		var a = ['<object width="' + opts.width + '" height="' + opts.height + '" '];
		for (var key in opts.attrs)
			a.push(key + '="'+opts.attrs[key]+'" ');
		for (var key in o.ieAttrs || {}) {
			var v = o.ieAttrs[key];
			if (key == 'codebase' && window.location.protocol == 'https:')
				v = v.replace('http','https');
			a.push(key + '="'+v+'" ');
		}
		a.push('></ob'+'ject'+'>');
		var p = ['<param name="' + (o.oUrl || 'src') +'" value="' + opts.src + '">'];
		for (var key in opts.params)
			p.push('<param name="'+ key +'" value="' + opts.params[key] + '">');
		var o = document.createElement(a.join(''));
		for (var i=0; i < p.length; i++)
			o.appendChild(document.createElement(p[i]));
	}
	else if (opts.standards) {
		// Rewritten to be standards compliant by Richard Connamacher
		var a = ['<object type="' + o.mimetype +'" width="' + opts.width + '" height="' + opts.height +'"'];
		if (opts.src) a.push(' data="' + opts.src + '" ');
		if ($.browser.msie) {
			for (var key in o.ieAttrs || {}) {
				var v = o.ieAttrs[key];
				if (key == 'codebase' && window.location.protocol == 'https:')
					v = v.replace('http','https');
				a.push(key + '="'+v+'" ');
			}
		}
		a.push('>');
		a.push('<param name="' + (o.oUrl || 'src') +'" value="' + opts.src + '">');
		for (var key in opts.params) {
			if (key == 'wmode' && player != 'flash') // FF3/Quicktime borks on wmode
				continue;
			a.push('<param name="'+ key +'" value="' + opts.params[key] + '">');
		}
		// Alternate HTML
		a.push('<div><p><strong>'+o.title+' Required</strong></p><p>'+o.title+' is required to view this media. <a href="'+o.pluginspage+'">Download Here</a>.</p></div>');
		a.push('</ob'+'ject'+'>');
	}
	 else {
	        var a = ['<embed width="' + opts.width + '" height="' + opts.height + '" style="display:block"'];
	        if (opts.src) a.push(' src="' + opts.src + '" ');
	        for (var key in opts.attrs)
	            a.push(key + '="'+opts.attrs[key]+'" ');
	        for (var key in o.eAttrs || {})
	            a.push(key + '="'+o.eAttrs[key]+'" ');
	        for (var key in opts.params) {
	            if (key == 'wmode' && player != 'flash') // FF3/Quicktime borks on wmode
	            	continue;
	            a.push(key + '="'+opts.params[key]+'" ');
	        }
	        a.push('></em'+'bed'+'>');
	    }	
	// convert element to div
	var id = el.id ? (' id="'+el.id+'"') : '';
	var cls = opts.cls ? (' class="' + opts.cls + '"') : '';
	var $div = $('<div' + id + cls + '>');
	$el.after($div).remove();
	(lameIE || player == 'iframe' || player == 'img') ? $div.append(o) : $div.html(a.join(''));
	if (opts.caption) $('<div>').appendTo($div).html(opts.caption);
	return $div;
};

})(jQuery);
jQuery(
	function()
	{
		jQuery.fn.media.defaults.params[ 'allowfullscreen' ] = 'true';
		jQuery( '.media' ).each(
			function( i , Object )
			{
				var			Autoplay = jQuery( Object ).attr( 'rel' ) == '1';
				var			FlashVars = { autostart : Autoplay };
				jQuery( Object ).media(
					{
						flashvars: FlashVars , 
						autoplay : Autoplay , 
						width : jQuery( Object ).attr( 'width' ) , 
						height : jQuery( Object ).attr( 'height' ) , 
						mp3Player : './packages/jquery/packages/jquery_media/include/swf/mediaplayer.swf' , 
						flvPlayer : './packages/jquery/packages/jquery_media/include/swf/mediaplayer.swf'
					}
				);
			}
		);
	}
);

/*
 * SimpleModal 1.4.2 - jQuery Plugin
 * http://simplemodal.com/
 * Copyright (c) 2011 Eric Martin
 * Licensed under MIT and GPL
 * Date: Sat, Dec 17 2011 15:35:38 -0800
 */
(function(b){"function"===typeof define&&define.amd?define(["jquery"],b):b(jQuery)})(function(b){var j=[],k=b(document),l=b.browser.msie&&6===parseInt(b.browser.version)&&"object"!==typeof window.XMLHttpRequest,n=b.browser.msie&&7===parseInt(b.browser.version),m=null,h=b(window),i=[];b.modal=function(a,d){return b.modal.impl.init(a,d)};b.modal.close=function(){b.modal.impl.close()};b.modal.focus=function(a){b.modal.impl.focus(a)};b.modal.setContainerDimensions=function(){b.modal.impl.setContainerDimensions()};
b.modal.setPosition=function(){b.modal.impl.setPosition()};b.modal.update=function(a,d){b.modal.impl.update(a,d)};b.fn.modal=function(a){return b.modal.impl.init(this,a)};b.modal.defaults={appendTo:"body",focus:!0,opacity:50,overlayId:"simplemodal-overlay",overlayCss:{},containerId:"simplemodal-container",containerCss:{},dataId:"simplemodal-data",dataCss:{},minHeight:null,minWidth:null,maxHeight:null,maxWidth:null,autoResize:!1,autoPosition:!0,zIndex:1E3,close:!0,closeHTML:'<a class="modalCloseImg" title="Close"></a>',
closeClass:"simplemodal-close",escClose:!0,overlayClose:!1,fixed:!0,position:null,persist:!1,modal:!0,onOpen:null,onShow:null,onClose:null};b.modal.impl={d:{},init:function(a,d){if(this.d.data)return!1;m=b.browser.msie&&!b.boxModel;this.o=b.extend({},b.modal.defaults,d);this.zIndex=this.o.zIndex;this.occb=!1;if("object"===typeof a){if(a=a instanceof jQuery?a:b(a),this.d.placeholder=!1,0<a.parent().parent().size()&&(a.before(b("<span></span>").attr("id","simplemodal-placeholder").css({display:"none"})),
this.d.placeholder=!0,this.display=a.css("display"),!this.o.persist))this.d.orig=a.clone(!0)}else if("string"===typeof a||"number"===typeof a)a=b("<div></div>").html(a);else return alert("SimpleModal Error: Unsupported data type: "+typeof a),this;this.create(a);this.open();b.isFunction(this.o.onShow)&&this.o.onShow.apply(this,[this.d]);return this},create:function(a){this.getDimensions();if(this.o.modal&&l)this.d.iframe=b('<iframe src="javascript:false;"></iframe>').css(b.extend(this.o.iframeCss,
{display:"none",opacity:0,position:"fixed",height:i[0],width:i[1],zIndex:this.o.zIndex,top:0,left:0})).appendTo(this.o.appendTo);this.d.overlay=b("<div></div>").attr("id",this.o.overlayId).addClass("simplemodal-overlay").css(b.extend(this.o.overlayCss,{display:"none",opacity:this.o.opacity/100,height:this.o.modal?j[0]:0,width:this.o.modal?j[1]:0,position:"fixed",left:0,top:0,zIndex:this.o.zIndex+1})).appendTo(this.o.appendTo);this.d.container=b("<div></div>").attr("id",this.o.containerId).addClass("simplemodal-container").css(b.extend({position:this.o.fixed?
"fixed":"absolute"},this.o.containerCss,{display:"none",zIndex:this.o.zIndex+2})).append(this.o.close&&this.o.closeHTML?b(this.o.closeHTML).addClass(this.o.closeClass):"").appendTo(this.o.appendTo);this.d.wrap=b("<div></div>").attr("tabIndex",-1).addClass("simplemodal-wrap").css({height:"100%",outline:0,width:"100%"}).appendTo(this.d.container);this.d.data=a.attr("id",a.attr("id")||this.o.dataId).addClass("simplemodal-data").css(b.extend(this.o.dataCss,{display:"none"})).appendTo("body");this.setContainerDimensions();
this.d.data.appendTo(this.d.wrap);(l||m)&&this.fixIE()},bindEvents:function(){var a=this;b("."+a.o.closeClass).bind("click.simplemodal",function(b){b.preventDefault();a.close()});a.o.modal&&a.o.close&&a.o.overlayClose&&a.d.overlay.bind("click.simplemodal",function(b){b.preventDefault();a.close()});k.bind("keydown.simplemodal",function(b){a.o.modal&&9===b.keyCode?a.watchTab(b):a.o.close&&a.o.escClose&&27===b.keyCode&&(b.preventDefault(),a.close())});h.bind("resize.simplemodal orientationchange.simplemodal",
function(){a.getDimensions();a.o.autoResize?a.setContainerDimensions():a.o.autoPosition&&a.setPosition();l||m?a.fixIE():a.o.modal&&(a.d.iframe&&a.d.iframe.css({height:i[0],width:i[1]}),a.d.overlay.css({height:j[0],width:j[1]}))})},unbindEvents:function(){b("."+this.o.closeClass).unbind("click.simplemodal");k.unbind("keydown.simplemodal");h.unbind(".simplemodal");this.d.overlay.unbind("click.simplemodal")},fixIE:function(){var a=this.o.position;b.each([this.d.iframe||null,!this.o.modal?null:this.d.overlay,
"fixed"===this.d.container.css("position")?this.d.container:null],function(b,f){if(f){var g=f[0].style;g.position="absolute";if(2>b)g.removeExpression("height"),g.removeExpression("width"),g.setExpression("height",'document.body.scrollHeight > document.body.clientHeight ? document.body.scrollHeight : document.body.clientHeight + "px"'),g.setExpression("width",'document.body.scrollWidth > document.body.clientWidth ? document.body.scrollWidth : document.body.clientWidth + "px"');else{var c,e;a&&a.constructor===
Array?(c=a[0]?"number"===typeof a[0]?a[0].toString():a[0].replace(/px/,""):f.css("top").replace(/px/,""),c=-1===c.indexOf("%")?c+' + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"':parseInt(c.replace(/%/,""))+' * ((document.documentElement.clientHeight || document.body.clientHeight) / 100) + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"',a[1]&&(e="number"===typeof a[1]?
a[1].toString():a[1].replace(/px/,""),e=-1===e.indexOf("%")?e+' + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"':parseInt(e.replace(/%/,""))+' * ((document.documentElement.clientWidth || document.body.clientWidth) / 100) + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"')):(c='(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"',
e='(document.documentElement.clientWidth || document.body.clientWidth) / 2 - (this.offsetWidth / 2) + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"');g.removeExpression("top");g.removeExpression("left");g.setExpression("top",c);g.setExpression("left",e)}}})},focus:function(a){var d=this,a=a&&-1!==b.inArray(a,["first","last"])?a:"first",f=b(":input:enabled:visible:"+a,d.d.wrap);setTimeout(function(){0<f.length?f.focus():d.d.wrap.focus()},
10)},getDimensions:function(){var a=b.browser.opera&&"9.5"<b.browser.version&&"1.3">b.fn.jquery||b.browser.opera&&"9.5">b.browser.version&&"1.2.6"<b.fn.jquery?h[0].innerHeight:h.height();j=[k.height(),k.width()];i=[a,h.width()]},getVal:function(a,b){return a?"number"===typeof a?a:"auto"===a?0:0<a.indexOf("%")?parseInt(a.replace(/%/,""))/100*("h"===b?i[0]:i[1]):parseInt(a.replace(/px/,"")):null},update:function(a,b){if(!this.d.data)return!1;this.d.origHeight=this.getVal(a,"h");this.d.origWidth=this.getVal(b,
"w");this.d.data.hide();a&&this.d.container.css("height",a);b&&this.d.container.css("width",b);this.setContainerDimensions();this.d.data.show();this.o.focus&&this.focus();this.unbindEvents();this.bindEvents()},setContainerDimensions:function(){var a=l||n,d=this.d.origHeight?this.d.origHeight:b.browser.opera?this.d.container.height():this.getVal(a?this.d.container[0].currentStyle.height:this.d.container.css("height"),"h"),a=this.d.origWidth?this.d.origWidth:b.browser.opera?this.d.container.width():
this.getVal(a?this.d.container[0].currentStyle.width:this.d.container.css("width"),"w"),f=this.d.data.outerHeight(!0),g=this.d.data.outerWidth(!0);this.d.origHeight=this.d.origHeight||d;this.d.origWidth=this.d.origWidth||a;var c=this.o.maxHeight?this.getVal(this.o.maxHeight,"h"):null,e=this.o.maxWidth?this.getVal(this.o.maxWidth,"w"):null,c=c&&c<i[0]?c:i[0],e=e&&e<i[1]?e:i[1],h=this.o.minHeight?this.getVal(this.o.minHeight,"h"):"auto",d=d?this.o.autoResize&&d>c?c:d<h?h:d:f?f>c?c:this.o.minHeight&&
"auto"!==h&&f<h?h:f:h,c=this.o.minWidth?this.getVal(this.o.minWidth,"w"):"auto",a=a?this.o.autoResize&&a>e?e:a<c?c:a:g?g>e?e:this.o.minWidth&&"auto"!==c&&g<c?c:g:c;this.d.container.css({height:d,width:a});this.d.wrap.css({overflow:f>d||g>a?"auto":"visible"});this.o.autoPosition&&this.setPosition()},setPosition:function(){var a,b;a=i[0]/2-this.d.container.outerHeight(!0)/2;b=i[1]/2-this.d.container.outerWidth(!0)/2;var f="fixed"!==this.d.container.css("position")?h.scrollTop():0;this.o.position&&"[object Array]"===
Object.prototype.toString.call(this.o.position)?(a=f+(this.o.position[0]||a),b=this.o.position[1]||b):a=f+a;this.d.container.css({left:b,top:a})},watchTab:function(a){if(0<b(a.target).parents(".simplemodal-container").length){if(this.inputs=b(":input:enabled:visible:first, :input:enabled:visible:last",this.d.data[0]),!a.shiftKey&&a.target===this.inputs[this.inputs.length-1]||a.shiftKey&&a.target===this.inputs[0]||0===this.inputs.length)a.preventDefault(),this.focus(a.shiftKey?"last":"first")}else a.preventDefault(),
this.focus()},open:function(){this.d.iframe&&this.d.iframe.show();b.isFunction(this.o.onOpen)?this.o.onOpen.apply(this,[this.d]):(this.d.overlay.show(),this.d.container.show(),this.d.data.show());this.o.focus&&this.focus();this.bindEvents()},close:function(){if(!this.d.data)return!1;this.unbindEvents();if(b.isFunction(this.o.onClose)&&!this.occb)this.occb=!0,this.o.onClose.apply(this,[this.d]);else{if(this.d.placeholder){var a=b("#simplemodal-placeholder");this.o.persist?a.replaceWith(this.d.data.removeClass("simplemodal-data").css("display",
this.display)):(this.d.data.hide().remove(),a.replaceWith(this.d.orig))}else this.d.data.hide().remove();this.d.container.hide().remove();this.d.overlay.hide();this.d.iframe&&this.d.iframe.hide().remove();this.d.overlay.remove();this.d={}}}}});

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.data_form )
{
	ultimix.data_form = {};
}

/**
*	Function submits form.
*
*  	@param Action - Destination page.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.create_form = function( Action , Method )
{
	if( !Method )
	{
		Method = 'post';
	}
	
	if( jQuery( '#data_form' ).length )
	{
		jQuery( '#data_form' ).remove();
	}

	jQuery( 'body' ).append( '<form id="data_form" method="' + Method + '" style="display: none;"></form>' );
	
	if( Action )
	{
		jQuery( '#data_form' ).attr( 'action' , Action );
	}
}

/**
*	Function appends data to form.
*
*	@param Data - Data to append.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.append_data = function( Data )
{
	for( i in Data )
	{
		jQuery( '#data_form' ).append( '<textarea name="' + i + '">' + Data[ i ] + '</textarea>' );
	}
}

/**
*	Function clones form data to submit.
*
*	@param SourceFormSelector - Selector of the submitted data.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.MoveFormData = function( SourceFormSelector )
{
	var					Data = ultimix.forms.ExtractFormData( SourceFormSelector );

	ultimix.data_form.append_data( Data );
}

/**
*	Submit form method.
*
*	@param SourceFormSelector - Selector of the submitted data.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SuccessFunction = function( SourceFormSelector , Waiting )
{
	return(
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				ultimix.data_form.MoveFormData( SourceFormSelector );
			
				document.getElementById( 'data_form' ).submit();
				
				if( Waiting )
				{
					ultimix.std_dialogs.SimpleWaitingMessageBox();
				}
			}
		}
	);
}

/**
*	Function submits data on the server.
*
*	@param SourceFormSelector - Selector of the submitting data.
*
*	@param ConfirmString - Confirmation string.
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm = function( SourceFormSelector , ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	
	Success = ultimix.data_form.SuccessFunction( SourceFormSelector , Waiting );

	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString , Success );
		return;
	}
	
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits data on the server.
*
*	@param Data - Data to submit.
*
*	@param ConfirmString - Confirmation string.
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should be progress window be displayed.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataFormN = function( Data , ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			ultimix.data_form.append_data( Data );
			ultimix.data_form.wait_for_submit( Waiting );
		}
	}
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString , Success );
		return;
	}
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits form.
*
*	@param Waiting - Should user be warned.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.wait_for_submit = function( Waiting )
{
	document.getElementById( 'data_form' ).submit();

	if( Waiting )
	{
		ultimix.std_dialogs.WaitingMessageBox( 'wait_please' , 'Info' );
	}
}

/**
*	Function submits form.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm0 = function( ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			ultimix.data_form.wait_for_submit( Waiting );
		}
	}
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString );
		return;
	}
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits form.
*
*	@param Data - Data to append.
*
*	@param Waiting - Should user be warned.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.append_data_and_wait_for_submit = function( Data , Waiting )
{
	ultimix.data_form.append_data( Data );
	ultimix.data_form.wait_for_submit( Waiting );
}

/**
*	Function submits form.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm1 = function( Param1 , Value1 , ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			var			Data = {};
			Data[ Param1 ] = Value1;
			ultimix.data_form.append_data_and_wait_for_submit( Data , Waiting );
		}
	}
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString );
		return;
	}
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits form.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm2 = function( Param1 , Value1 , Param2, Value2 , 
																			ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			var			Data = {};
			Data[ Param1 ] = Value1;
			Data[ Param2 ] = Value2;
			ultimix.data_form.append_data_and_wait_for_submit( Data , Waiting );
		}
	}
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString );
		return;
	}
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Function submits form.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param Param3 - Third parameter.
*
*	@param Value3 - Third parameter's value.
*
*	@param ConfirmString - Confirmation string
*
*  	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.data_form.SubmitDataForm3 = function( Param1 , Value1 , Param2 , Value2 , Param3 , Value3 , 
																			ConfirmString , Action , Waiting , Method )
{
	ultimix.data_form.create_form( Action , Method );
	Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			var			Data = {};
			Data[ Param1 ] = Value1;
			Data[ Param2 ] = Value2;
			Data[ Param3 ] = Value3;
			ultimix.data_form.append_data_and_wait_for_submit( Data , Waiting );
		}
	}
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString );
		return;
	}
	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Another local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.multiple_line )
{
	ultimix.multiple_line = {};
}

/**
* 	Function creates multyple line control.
*
* 	@param Object - DOM element of the template.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.CreateMultypleLineControl = function( Object )
{
	jQuery( Object ).wrap( '<div></div>' );
	jQuery( Object ).css( 'display' , 'none' );
}

/**
* 	Function creates control's line.
*
* 	@param Control - DOM element of the control.
*
* 	@param Object - DOM element of the line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.GetElementCode = function( Control , Object )
{
	var		Template = Control.html();
	
	if( Object )
	{
		eval( 'var Data = ' + jQuery( Object ).html() );
		Template = ultimix.string_utilities.PrintRecord( Template , Data );
	}
	
	return( Template );
}

/**
* 	Function revises delete buttons for some special cases.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.ReviseDeleteButtons = function( Selector )
{
	var		Container = jQuery( Selector ).parent();

	var		Lines = jQuery( Container ).find( 'table.multiple_line_single_line' );
	
	if( Lines.length == 1 )
	{
		Lines.find( 'span.multiple_line_delete_button' ).html( '&nbsp;' );
	}
	else
	{
		Lines.find( 'span.multiple_line_delete_button' ).html( ultimix.multiple_line.CreateDelButton( Selector ) );
	}
}

/**
* 	Function adds a new line to the grid.
*
*	@param Button - Add button wich was clicked.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.OnAddElement = function( Button , Selector )
{
	ultimix.multiple_line.AddLineForSelector( 
		Selector , false , jQuery( Button ).parents( 'table.multiple_line_single_line' )
	);
	
	ultimix.multiple_line.ReviseDeleteButtons( Selector );
}

/**
* 	Function adds a new line to the grid.
*
*	@param Button - Add button wich was clicked.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.OnDelElement = function( Button , Selector )
{
	jQuery( Button ).parents( 'table.multiple_line_single_line' ).remove();
	
	var		Control = jQuery( Selector );
	
	/* calling event handler */
	if( jQuery( Control ).attr( 'ondeleteline' ) )
	{
		eval( jQuery( Control ).attr( 'ondeleteline' ) );
	}
	
	ultimix.multiple_line.ReviseDeleteButtons( Selector );
}

/**
* 	Function creates add button template.
*
* 	@param Selector - Selector of the control.
*
*	@return Add button template.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.GetAddButtonTemplate = function( Selector )
{
	var			CustomTemplate = jQuery( Selector ).find( '.add_button_template' ).first();
	
	if( CustomTemplate.length == 0 )
	{
		/* custom template was not found */
		return(
			"<span class=\"multiple_line_add_button\"><a class=\"pointer\" style=\"text-decoration: none; " + 
			"font-weight: bold;\" onclick=\"ultimix.multiple_line.OnAddElement( this , '" + Selector + 
			"' );\">+</a></span>"
		);
	}
	else
	{
		CustomTemplate = CustomTemplate.html();
		
		CustomTemplate = ultimix.string_utilities.StrReplace( '[selector]' , Selector , CustomTemplate );
		
		return( CustomTemplate );
	}
}

/**
* 	Function creates add button for the line.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.CreateAddButton = function( Selector )
{
	return( 
		ultimix.multiple_line.GetAddButtonTemplate( Selector )
	);
}

/**
* 	Function creates delete button template.
*
* 	@param Selector - Selector of the control.
*
*	@return Delete button template.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.GetDeleteButtonTemplate = function( Selector )
{
	var			CustomTemplate = jQuery( Selector ).find( '.delete_button_template' ).first();
	
	if( CustomTemplate.length == 0 )
	{
		/* custom template was not found */
		return(
			"<span class=\"multiple_line_delete_button\"><a class=\"pointer\" style=\"text-decoration: none; " + 
			"font-weight: bold;\" onclick=\"ultimix.multiple_line.OnDelElement( this , '" + 
			Selector + "' );\">-</a></span>"
		);
	}
	else
	{
		CustomTemplate = CustomTemplate.html();
		
		CustomTemplate = ultimix.string_utilities.StrReplace( '[selector]' , Selector , CustomTemplate );
		
		return( CustomTemplate );
	}
}

/**
* 	Function creates add button for the line.
*
* 	@param Selector - Selector of the control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.CreateDelButton = function( Selector )
{
	return( 
		ultimix.multiple_line.GetDeleteButtonTemplate( Selector )
	);
}

/**
* 	Function creates control's line.
*
* 	@param Selector - Selector of the control.
*
* 	@param Line - HTML code of the new line.
*
* 	@param AfterLine - New line will be added after this element.
*
*	@return Function returns the added line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AppendLine = function( Selector , Line , AfterLine )
{
	var			Container = jQuery( Selector ).parent();
	var			Code = '<table class="multiple_line_single_line"><tr><td style="width: 10px; font-family:' + 
		'Courier New;">' + ultimix.multiple_line.CreateAddButton( Selector ) + '</td><td style="width: 10px; ' + 
		'font-family: Courier New;">' + ultimix.multiple_line.CreateDelButton( Selector ) + '</td><td style="width: ' +
		'100%;">' + Line + '</td></tr></table>';
	var			AddedLine = false;
	if( AfterLine )
	{
		jQuery( AfterLine ).after( Code );
		AddedLine = jQuery( AfterLine ).next();
	}
	else
	{
		jQuery( Container ).append( Code );
		AddedLine = jQuery( Container ).find( 'table.multiple_line_single_line' ).last();
	}
	jQuery( AddedLine ).find( '.add_button_template,.delete_button_template' ).remove();
	ultimix.multiple_line.ReviseDeleteButtons( Selector );
	return( AddedLine );
}

/**
* 	Function changes DOM.
*
* 	@param Selector - Selector of the control.
*
* 	@param Object - Line's object.
*
* 	@param AfterLine - New line will be added after this element.
*
*	@return Function returns the added line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLineInDOM = function( Selector , Object , AfterLine )
{
	var			Control = jQuery( Selector );
	if( Control.length )
	{
		var			Line = ultimix.multiple_line.GetElementCode( Control , Object );
		var			AddedLine = ultimix.multiple_line.AppendLine( Selector , Line , AfterLine );
		if( Object )
		{
			jQuery( Object ).remove();
		}
		return( AddedLine );
	}
	else
	{
		if( !Object )return;
		
		jQuery( Object ).replaceWith( 
			ultimix.get_string( 'dom_element' ) + ' "' + jQuery( Object ).attr( 'control' ) + '" ' + 
			ultimix.get_string( 'was_not_found' )
		);
	}
}

/**
*	OnAddLine event handler.
*
*	@param AddedLine - Added line.
*
*	@param Data - Data.
*
*	@author Dodonov A.A.
*/
ultimix.multiple_line.OnAddLine = function( AddedLine , Data )
{
	for( FieldName in Data )
	{
		var			Element = jQuery( AddedLine ).find( '[name^=' + FieldName + ']' );
		if( Element.prop( 'tagName' ) == 'TEXTAREA' )
		{
			Element.html( Data[ FieldName ] );
		}
		else
		{
			Element.val( Data[ FieldName ] );
		}
	}
}

/**
* 	Function triggers event.
*
* 	@param Selector - Selector of the control.
*
* 	@param AddedLine - Added line.
*
* 	@param Data - Data to add.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.TriggerOnAddEvent = function( Selector , AddedLine , Data )
{
	var			Control = jQuery( Selector );
	
	/* calling event handler */
	if( jQuery( Control ).attr( 'onaddline' ) )
	{
		eval( jQuery( Control ).attr( 'onaddline' ) + '( AddedLine , Data );' );
	}
	else
	{
		eval( 'ultimix.multiple_line.OnAddLine( AddedLine , Data );' );
	}
}

/**
* 	Function adds line to the control.
*
* 	@param Selector - Selector of the control.
*
* 	@param Object - Line's object.
*
* 	@param AfterLine - New line will be added after this element.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLineForSelector = function( Selector , Object , AfterLine )
{
	if( Object && jQuery( Object ).html() )
	{
		eval( 'var Data = ' + jQuery( Object ).html() );
	}
	else
	{
		eval( 'var Data = {}' );
	}
	
	var			AddedLine = ultimix.multiple_line.AddLineInDOM( Selector , Object , AfterLine );
	
	ultimix.multiple_line.TriggerOnAddEvent( Selector , AddedLine , Data );
}

/**
* 	Function adds line to the control.
*
* 	@param Object - DOM element of the line.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLine = function( Object )
{
	ultimix.multiple_line.AddLineForSelector( jQuery( Object ).attr( 'control' ) , Object );
}

/**
* 	Function adds empty line to the control.
*
* 	@param Control - Multy line control.
*
* 	@author Dodonov A.A.
*/
ultimix.multiple_line.AddLineInEmptyControl = function( Control )
{
	if( jQuery( Control ).find( 'table.multiple_line_single_line' ).length == 0 )
	{
		ultimix.multiple_line.AddLineForSelector( jQuery( Control ).children().first().attr( 'control' ) );
	}
}

/**
* 	Auto creation of the controls.
*
* 	@author Dodonov A.A.
*/
jQuery( 
	function()
	{
		jQuery( '.multiple_line_template' ).each(
			function( Index , Object )
			{
				ultimix.multiple_line.CreateMultypleLineControl( Object );
			}
		);
		jQuery( '.multiple_line_element' ).each(
			function( Index , Object )
			{
				ultimix.multiple_line.AddLine( Object );
			}
		);
		jQuery( '.multiple_line_template' ).each(
			function( Index , Object )
			{
				ultimix.multiple_line.AddLineInEmptyControl( jQuery( Object ).parent() );
			}
		);
	}
);
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.report )
{
	ultimix.report = {};
}

/**
*	Function creates report generating frame.
*
*	@param PackageName - Package name.
*
*	@param PackageVersion - Package version.
*
*	@param ReportName - Name of the report.
*
*	@param Data - Data wich will be trasferred to server.
*
*	@author Dodonov A.A.
*/
ultimix.report.create_frame = function( PackageName , PackageVersion , ReportName , Data )
{
	if( jQuery( '#report_generation_id' ).length )
	{
		jQuery( '#report_generation_id' ).remove();
	}

	var		ReportGenerationParameters = '';
	if( !Data )
	{
		Data = {};
	}
	for( i in Data )
	{
		ReportGenerationParameters = '&' + i + "=" + new String( Data[ i ] ) + ReportGenerationParameters;
	}
	
	IFrameCode = '<iframe id="report_generation_id" style="display: none;" src="./report.html?report_package_name=';
	IFrameCode = IFrameCode + PackageName + '&report_package_version=' + PackageVersion;
	IFrameCode = IFrameCode + '&report_name=' + ReportName + '&' + ( new Date() ).getTime();
	IFrameCode = IFrameCode + ReportGenerationParameters + '"></iframe>';
	jQuery( 'body' ).append( IFrameCode );
}

/**
*	Function displays report generation process gui.
*
*	@param OnGenerate - this function will be called when report generation process will be finished.
*
*	@param ShowProgress - Shold the progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.report.report_generation_process = function( OnGenerate , ShowProgress )
{
	if( ShowProgress )
	{
		var			LoadingId = ultimix.std_dialogs.WaitingMessageBox( 'report_is_generating' , 'report' );
	}

	jQuery( '#report_generation_id' ).load(
		function()
		{
			if( ShowProgress )
			{
				ultimix.std_dialogs.close_message_box( LoadingId );
			}
			if( OnGenerate )
			{
				OnGenerate();
			}
		}
	);
}

/**
*	Function runs report generation process.
*
*	@param PackageName - Package name.
*
*	@param PackageVersion - Package version.
*
*	@param ReportName - Name of the report.
*
*	@param Data - Data wich will be trasferred to server.
*
*	@param OnGenerate - this function will be called when report generation process will be finished.
*
*	@param ShowProgress - Shold the progress window be displayed.
*
*	@author Dodonov A.A.
*/
ultimix.report.GenerateReport = function( PackageName , PackageVersion , ReportName , Data , OnGenerate , ShowProgress )
{
	ultimix.report.create_frame( PackageName , PackageVersion , ReportName , Data );
	
	ultimix.report.report_generation_process( OnGenerate , ShowProgress );
}

/**
*	Function runs report generation process with dialog promt.
*
*	@param DataAcceptor - Data acceptor field's selector.
*
*	@param StatusAcceptor - Status acceptor field's selector.
*
*	@param DataSource - Data source selector.
*
*	@author Dodonov A.A.
*/
ultimix.report.OnRunReportGeneration = function( DataAcceptor , StatusAcceptor , DataSource )
{
	var			PackageName = jQuery( DataSource ).find( 'span.package_name' ).html();
	var			PackageVersion = jQuery( DataSource ).find( 'span.package_version' ).html();
	var			ReportName = jQuery( DataSource ).find( 'span.report_name' ).html();
	var			Data = ultimix.forms.ExtractFormData( DataSource );
	
	ultimix.report.GenerateReport( PackageName , PackageVersion , ReportName , Data , false , true );
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.std_dialogs )
{
	ultimix.std_dialogs = {};
}

/**
*	Constants for buttons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.MB_ABORT = 1;
ultimix.std_dialogs.MB_RETRY = 2;
ultimix.std_dialogs.MB_IGNORE = 4;
ultimix.std_dialogs.MB_ABORTRETRYIGNORE = 7;
ultimix.std_dialogs.MB_CANCEL = 8;
ultimix.std_dialogs.MB_TRY = 16;
ultimix.std_dialogs.MB_CONTINUE = 32;
ultimix.std_dialogs.MB_CANCELTRYCONTINUE = 56;
ultimix.std_dialogs.MB_HELP = 64;
ultimix.std_dialogs.MB_OK = 128;
ultimix.std_dialogs.MB_OKCANCEL = 136;
ultimix.std_dialogs.MB_RETRYCANCEL = 10;
ultimix.std_dialogs.MB_YES = 256;
ultimix.std_dialogs.MB_NO = 512;
ultimix.std_dialogs.MB_YESNO = 768;
ultimix.std_dialogs.MB_YESNOCANCEL = 776;

/**
*	Constants for icons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.MB_ICONEXCLAMATION = 2048;
ultimix.std_dialogs.MB_ICONWARNING = 4096;
ultimix.std_dialogs.MB_ICONINFORMATION = 8192;
ultimix.std_dialogs.MB_ICONASTERISK = 16384;
ultimix.std_dialogs.MB_ICONQUESTION = 32768;
ultimix.std_dialogs.MB_ICONSTOP = 65536;
ultimix.std_dialogs.MB_ICONERROR = 131072;
ultimix.std_dialogs.MB_ICONHAND = 262144;
ultimix.std_dialogs.MB_ICONLOADING = 524288;
ultimix.std_dialogs.MB_ICONWAIT = 524288;
ultimix.std_dialogs.MB_MODAL = 1048576;

ultimix.std_dialogs.MessageBoxCounter = 0;

/**
*	This method will close message box.
*
*	@param Selector - Dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.close_message_box = function( Selector )
{
	jQuery( Selector ).dialog( "close" );
	jQuery( Selector ).remove();
}

/**
*	Function fetches class name from style.
*
*	@param Style - Dialog style.
*
*	@return Class name.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_class_name = function( Style )
{
	var			Class = 'jsdialogs-default';
	if( Style & ultimix.std_dialogs.MB_ICONEXCLAMATION )	Class = 'jsdialogs-exclamation';
	if( Style & ultimix.std_dialogs.MB_ICONWARNING )		Class = 'jsdialogs-warning';
	if( Style & ultimix.std_dialogs.MB_ICONINFORMATION )	Class = 'jsdialogs-information';
	if( Style & ultimix.std_dialogs.MB_ICONASTERISK )		Class = 'jsdialogs-asterisk';
	if( Style & ultimix.std_dialogs.MB_ICONQUESTION )		Class = 'jsdialogs-question';
	if( Style & ultimix.std_dialogs.MB_ICONSTOP )			Class = 'jsdialogs-stop';
	if( Style & ultimix.std_dialogs.MB_ICONERROR )			Class = 'jsdialogs-error';
	if( Style & ultimix.std_dialogs.MB_ICONHAND )			Class = 'jsdialogs-hand';
	if( Style & ultimix.std_dialogs.MB_ICONLOADING )		Class = 'jsdialogs-loading';
	return( Class );
}

/**
*	Function compiles message box buttons handlers.
*
*	@param ButtonCode - Button code.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@param id - Control's id.
*
*	@return Handler.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_handler = function( ButtonCode , AcceptResult , id )
{
	return(
		function()
		{
			if( AcceptResult )
			{
				AcceptResult( ButtonCode );
			}
			ultimix.std_dialogs.close_message_box( "#" + id );
		}
	);
}

/**
*	Function compiles message box buttons handlers.
*
*	@param Style - Dialog style.
*
*	@param Buttons - Buttons.
*
*	@param Name - Button name.
*
*	@param ButtonCode - Button code.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@param id - Control's id.
*
*	@return Handler.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.add_button = function( Style , Buttons , Name , ButtonCode , AcceptResult , id )
{
	if( Style & ButtonCode )
	{
		Buttons[ ultimix.get_string( Name ) ] = ultimix.std_dialogs.get_handler( ButtonCode, AcceptResult , id );
	}
	
	return( Buttons );
}

/**
*	Function compiles message box buttons.
*
*	@param Style - Dialog style.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@param id - Control's id.
*
*	@return Buttons.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.get_buttons = function( Style , AcceptResult , id )
{
	var			Buttons = {};
	var			Titles = [ 
		'Abort' , 'Retry' , 'Ignore' , 'No' , 'Try' , 'Yes' , 'Cancel' , 'OK' , 'Help' , 'Continue'
	];
	var			Codes = [ 
		ultimix.std_dialogs.MB_ABORT , ultimix.std_dialogs.MB_RETRY , ultimix.std_dialogs.MB_IGNORE , 
		ultimix.std_dialogs.MB_NO , ultimix.std_dialogs.MB_TRY , ultimix.std_dialogs.MB_YES , 
		ultimix.std_dialogs.MB_CANCEL , ultimix.std_dialogs.MB_OK , ultimix.std_dialogs.MB_HELP , 
		ultimix.std_dialogs.MB_CONTINUE
	];
	
	for( var i = 0 ; i < Titles.length ; i++ )
	{
		Buttons = ultimix.std_dialogs.add_button( Style , Buttons , Titles[ i ] , Codes[ i ] , AcceptResult , id );
	}

	return( Buttons );
}

/**
*	Function cerates message box.
*
*	@param id - Dialog id.
*
*	@param DialogData - Dialog data.
*
*	@param Class - Dialog class.
*
*	@param Text - Dialog message.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.message_box_create = function( id , DialogData , Class , Text )
{
	jQuery( "#" + id ).dialog( DialogData );
	jQuery( "#" + id ).html( 
		'<div class="ultimix-MessageBox-content"><div class="' + Class + '"></div>' + 
		ultimix.get_string( Text ) + '</div>'
	);
	jQuery( "#" + id ).parent().find( '.ui-dialog-titlebar-close' ).remove();
}

/**
*	Function cerates message box.
*
*	@param Text - Dialog message.
*
*	@param Caption - Dialog caption.
*
*	@param Style - Dialog style.
*
*	@param AcceptResult - This method will be called when the dialog will be closed.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.MessageBox = function( Text , Caption , Style , AcceptResult )
{
	if( !Caption )
	{
		Caption = 'MessageBox';
	}
	if( !Style )
	{
		Style = ultimix.std_dialogs.MB_OK;
	}

	var			Class = ultimix.std_dialogs.get_class_name( Style );

	var 		id = "ultimix-MessageBox-span-" + ultimix.std_dialogs.MessageBoxCounter++;

	var			Modal = false;
	if( Style & ultimix.std_dialogs.MB_MODAL )				Modal = true;

	if( !jQuery( "#" + id ).length )
	{
		jQuery( "body" ).append( '<span id="' + id + '" style="display:none"></span>' );
	}

	var			ExitOnEscape = true;
	if( Style & ultimix.std_dialogs.MB_ICONLOADING ) ExitOnEscape = false;

	var			Buttons = ultimix.std_dialogs.get_buttons( Style , AcceptResult , id );
	var			DialogData = {
		width: 480 , modal : Modal , title : ultimix.get_string( Caption ) , buttons : Buttons , 
		resizable : false , closeOnEscape : ExitOnEscape
	}
	
	ultimix.std_dialogs.message_box_create( id , DialogData , Class , Text );

	return( "#" + id );
}

/**
*	Function shows 'waiting' dialog.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.SimpleWaitingMessageBox = function()
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'wait_please' ) , ultimix.get_string( 'Info' ) , 
			ultimix.std_dialogs.MB_ICONLOADING | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function shows 'waiting' dialog.
*
*	@param Text - Message box text.
*
*	@param Caption - Message box caption.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.WaitingMessageBox = function( Text , Caption )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( Caption ) , 
			ultimix.std_dialogs.MB_ICONLOADING | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function shows 'error' dialog.
*
*	@param Text - Message box text.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.ErrorMessageBox = function( Text )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL
		)
	);
}

/**
*	Function shows 'question' dialog.
*
*	@param Text - Message box text.
*
*	@param Success - Success method.
*
*	@return Created dialog's selector.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.QuestionMessageBox = function( Text , Success )
{
	return( 
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( Text ) , ultimix.get_string( 'Question' ) , 
			ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , Success
		)
	);
}

/**
*	Function returns 'loading' image control.
*
*	@return HTML code of the control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.loading_block = function()
{
	return(
		'<div class="jsdialogs-loading" style="float: none; margin-right : 0px;"></div>'
	);
}

/**
*	Function returns 'loading' image widget.
*
*	@return HTML code of the control.
*
*	@author Dodonov A.A.
*/
ultimix.std_dialogs.loading_img_widget = function()
{
	var			LoadingBlock = ultimix.std_dialogs.loading_block();

	var			VAlginBlock = ultimix.string_utilities.valign_block( LoadingBlock );

	return( ultimix.string_utilities.halign_block( VAlginBlock , 32 ) );
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.ajax_gate )
{
	ultimix.ajax_gate = {};
}

/**
*	Function validates data.
*
*	@param Data - Transfering data.
*
*	@return true/false
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.validate_direct_data = function( Data )
{
	if( !Data.package_name )
	{
		ultimix.std_dialogs.ErrorMessageBox( ultimix.get_string( 'the_setting_package_name_was_not_found' ) );
		return( false );
	}

	return( true );
}

/**
*	Function executes controller action.
*
*	@param Data - Transfering data.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Options - Request settings.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.direct_controller = function( Data , Functions , Options )
{
	if( ultimix.ajax_gate.validate_direct_data( Data ) == false )
	{
		return;
	}
	if( !Options )
	{
		Options = {};
	}

	jQuery.extend( Options , { 'async' : true , 'dataType' : 'text' } );
	jQuery.extend( Data , { 'auto_redirect' : 0 , 'template' : 'ajax_result_template' } );

	if( Functions.before_request )
	{
		Functions.before_request();
	}

	var			Request = {
		async : Options.async , type : 'POST' , url : 'direct_controller.html?' + ( new Date() ).getTime() , 
		data : Data , success : Functions.success , error : Functions.error , dataType : Options.data_type
	};

	jQuery.ajax( Request );
}

/**
*	Function gets view.
*
*	@param Data - Transfering data.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Options - Request settings.
*
*	@author Dodonov A.A.
*/
ultimix.ajax_gate.direct_view = function( Data , Functions , Options )
{
	if( ultimix.ajax_gate.validate_direct_data( Data ) == false )
	{
		return;
	}

	Options = !Options ? {} : Options;
	jQuery.extend( { 'async' : true , 'data_type' : 'html' } , Options );
	jQuery.extend( { 'auto_redirect' : 0 , 'template' : 'ajax_result_template' } , Data );

	if( Functions.before_request )
	{
		Functions.before_request();
	}
	var			Request = {
		async : Options.async , type : 'POST' , url : 'direct_view.html?' + ( new Date() ).getTime() , 
		data : Data , success : Functions.success , error : Functions.error , dataType : Options.data_type
	};
	jQuery.ajax( Request );
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.core )
{
	ultimix.core = {};
}


/**
*	Does element exists in the array
*
*	@author Dodonov A.A.
*/
function 	in_array( Element , Arr )
{
    for( var i = 0 ; i < Arr.length ; i++ )
	{
        if( Element == Arr[ i ] )
		{
            return( true );
        }
    }
    return( false );
}

/**
*	Function does nothing.
*
*	@author Dodonov A.A.
*/
function	nop()
{
}

/**
*	Function deletes parent of the element Selector.
*
*	@author Dodonov A.A.
*/
ultimix.DeleteParentItem = function( Selector )
{
	jQuery( Selector ).parent().remove();
}

/**
* 	Function returns random integer number.
*
* 	@param Min - Minimum value.
*
* 	@param Max - Maximum value.
*
* 	@return Random integer number.
*
* 	@author Dodonov A.A.
*/
ultimix.GetRandomInt = function( Min , Max )
{
	if( !Min )Min = 0;
	if( !Max )Max = 1000000000;
	
	return( Math.floor( Math.random() * ( Max - Min + 1 ) ) + Min );
}

/**
* 	Function returns the numeric value of the specified date as the number of 
*	milliseconds since January 1, 1970, 00:00:00 UTC.
*
* 	@return The numeric value of the specified date as the number of milliseconds since 
*	January 1, 1970, 00:00:00 UTC.
*
* 	@author Dodonov A.A.
*/
ultimix.core.GetCurrentMilliseconds = function()
{
	var 		d = new Date();
	return( d.getTime() );
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.double_panel )
{
	ultimix.double_panel = {};
}

/**
*	Function adds element to the second panel.
*/
function	FirstToSecond( FirstPanel , SecondPanel , EntityName )
{
	if( EntityName != '' )
	{
		document.getElementById( FirstPanel ).removeChild( document.getElementById( EntityName + '_hidden_id' ) );
		document.getElementById( FirstPanel ).removeChild( document.getElementById( EntityName + '_div_id_first' ) );
		document.getElementById( SecondPanel ).innerHTML += "<div onclick=\"javascript:SecondToFirst( '" + FirstPanel + 
			"' , '" + SecondPanel + "' , '" + EntityName + "' );\" class='double_panel_row no_selection_text' id='" + 
			EntityName + "_div_id_second'>" + EntityName + "</div>";
		
		jQuery( '.no_selection_text' ).disableTextSelect();
	}
}

/**
*	Function adds element to the second panel.
*/
function	SecondToFirst( FirstPanel , SecondPanel , EntityName )
{
	if( EntityName != '' )
	{
		document.getElementById( FirstPanel ).innerHTML += "<input type='hidden' name='entities[]' id='" + 
			EntityName + "_hidden_id' value='" + EntityName + "'>";
		document.getElementById( SecondPanel ).removeChild( document.getElementById( EntityName + '_div_id_second' ) );
		document.getElementById( FirstPanel ).innerHTML += "<div onclick=\"javascript:FirstToSecond( '" + FirstPanel + 
			"' , '" + SecondPanel + "' , '" + EntityName + "' );\" class='double_panel_row no_selection_text' id='" + 
			EntityName + "_div_id_first'>" + EntityName + "</div>";
		
		jQuery( '.no_selection_text' ).disableTextSelect();
	}
}

/**
*	Function initializes panel.
*/
ultimix.double_panel.init_first_panel = function( FirstPanel , SecondPanel , FirstPanelEntities )
{
	if( FirstPanelEntities != '' )
	{
		FirstPanelEntities = FirstPanelEntities.split( ',' );

		for( i = 0 ; i < FirstPanelEntities.length ; i++ )
		{
			document.getElementById( FirstPanel ).innerHTML += "<div onclick=\"javascript:FirstToSecond( '" + 
				FirstPanel + "' , '" + SecondPanel + "' , '" + FirstPanelEntities[ i ] + 
				"' );\" class='double_panel_row no_selection_text' id='" + FirstPanelEntities[ i ] + 
				"_div_id_first'>" + FirstPanelEntities[ i ] + "</div>";
			document.getElementById( FirstPanel ).innerHTML += "<input type='hidden' name='entities[]' id='" + 
				FirstPanelEntities[ i ] + "_hidden_id' value='" + FirstPanelEntities[ i ] + "'>";
		}
	}
	else
	{
		FirstPanelEntities = new Array;
	}

	return( FirstPanelEntities );
}

/**
*	Function initializes panel.
*/
ultimix.double_panel.init_second_panel = function( FirstPanel , SecondPanel , FirstPanelEntities , SecondPanelEntities )
{
	if( SecondPanelEntities != '' )
	{
		SecondPanelEntities = SecondPanelEntities.split( ',' );

		for( i = 0 ; i < SecondPanelEntities.length ; i++ )
		{
			if( in_array( SecondPanelEntities[ i ] , FirstPanelEntities ) == false )
			{
				document.getElementById( SecondPanel ).innerHTML += "<div onclick=\"javascript:SecondToFirst( '" + 
					FirstPanel + "' , '" + SecondPanel + "' , '" + SecondPanelEntities[ i ] + 
					"' );\" class='double_panel_row no_selection_text' id='" + SecondPanelEntities[ i ] + 
					"_div_id_second'>" + SecondPanelEntities[ i ] + "</div>";
			}
		}
	}
}

/**
*	Function initializes panel.
*/
function			InitPanels( FirstPanel , SecondPanel , FirstPanelEntities , SecondPanelEntities )
{
	FirstPanelEntities = ultimix.double_panel.init_first_panel( FirstPanel , SecondPanel , FirstPanelEntities );

	ultimix.double_panel.init_second_panel( FirstPanel , SecondPanel , FirstPanelEntities , SecondPanelEntities );

	jQuery( function()
		{
			jQuery( '.no_selection_text' ).disableTextSelect();
		}
	);
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

// TODO: move to gui::href_markup
// TODO: convert to lower case

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.forms )
{
	ultimix.forms = {};
}

/**
*	Function processes Enter key press.
*
*	@param e - Event object.
*
*	@param Id - Form's id.
*
*	@author Dodonov A.A.
*/
ultimix.forms.EnterProcessor = function( e , Id )
{
	if( e.keyCode == 13 )
	{
		document.getElementById( Id ).submit();
	}
}

// TODO convert to lower case notation

/**
*	Function processes triple state checkbox.
*
*	@param Name - Checkbox'es name.
*
*	@param Id - Id of the checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.forms.TripleSetCheckboxClick = function( Id , Name )
{
	var			Checkbox = document.getElementById( '_checkbox_' + Id );
	var			Value = document.getElementById( Id );
	
	if( Value.value == 0 )
	{
		jQuery( Checkbox ).prop( 'checked' , true );
		Checkbox.disabled = false;
		Value.value = 1;
		return;
	}
	
	if( Value.value == 1 )
	{
		jQuery( Checkbox ).prop( 'checked' , true );
		Checkbox.disabled = true;
		Value.value = 2;
		return;
	}
	
	if( Value.value == 2 )
	{
		jQuery( Checkbox ).prop( 'checked' , false );
		Checkbox.disabled = false;
		Value.value = 0;
		return;
	}
}

/**
*	Function processes double state checkbox.
*
*	@param Name - Checkbox'es name.
*
*	@param Id - Checkbox'es id.
*
*	@author Dodonov A.A.
*/
ultimix.forms.DoubleSetCheckboxClick = function( Id , Name )
{
	var			Checkbox = document.getElementById( '_checkbox_' + Id );
	var			Value = document.getElementById( Id );

	if( Value.value == 0 )
	{
		jQuery( Checkbox ).prop( 'checked' , true );
		Value.value = 1;
		return;
	}
	
	if( Value.value == 1 )
	{
		jQuery( Checkbox ).prop( 'checked' , false );
		Value.value = 0;
		return;
	}
}

/**
*	Function sets action and method fields.
*
*	@param FormId - Form to be submitted.
*
*	@param Action - Destination page.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.set_action_and_method = function( FormId , Action , Method )
{
	if( Action )
	{
		document.getElementById( FormId ).setAttribute( 'action' , Action );
	}
	if( Method )
	{
		document.getElementById( FormId ).setAttribute( 'method' , Method );
	}
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.submit_form_and_wait = function( FormId , Action , Waiting , Method )
{
	ultimix.forms.set_action_and_method( FormId , Action , Method );

	document.getElementById( FormId ).submit();

	if( Waiting )
	{
		ultimix.std_dialogs.SimpleWaitingMessageBox();
	}
}

/**
*	Function submits form.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Success - Success method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.confirm_submit = function( ConfirmString , Success )
{
	if( ConfirmString )
	{
		ultimix.std_dialogs.QuestionMessageBox( ConfirmString , Success );
		return;
	}

	Success( ultimix.std_dialogs.MB_YES );
}

/**
*	Form exists.
*
*	@param FormId - Form to be submitted.
*
*	@return true/false.
*
*	@author Dodonov A.A.
*/
ultimix.forms.form_exists = function( FormId )
{
	if( document.getElementById( FormId ) == null )
	{
		ultimix.std_dialogs.ErrorMessageBox( 'Form ' + FormId + ' was not found' );
		return( false );
	}
	return( true );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.SubmitForm0 = function( FormId , ConfirmString , Action , Waiting , Method )
{
	if( !ultimix.forms.form_exists( FormId ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Item exists.
*
*	@param FormId - Form to be submitted.
*
*	@return true/false.
*
*	@author Dodonov A.A.
*/
ultimix.forms.item_exists = function( Name )
{
	if( document.getElementById( Name ) == null )
	{
		ultimix.std_dialogs.ErrorMessageBox( 'Field ' + Name + ' was not found' );
		return( false );
	}
	return( true );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.SubmitForm1 = function( FormId , Param1 , Value1 , ConfirmString , Action , Waiting , Method )
{
	if( !ultimix.forms.form_exists( FormId ) || !ultimix.forms.item_exists( Param1 ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			document.getElementById( Param1 ).setAttribute( 'value' , Value1 );
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.SubmitForm2 = function( FormId , Param1 , Value1 , Param2 , Value2 , 
																			ConfirmString , Action , Waiting , Method )
{	
	if( !ultimix.forms.form_exists( FormId ) || !ultimix.forms.item_exists( Param1 ) || 
		!ultimix.forms.item_exists( Param2 ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			document.getElementById( Param1 ).setAttribute( 'value' , Value1 );
			document.getElementById( Param2 ).setAttribute( 'value' , Value2 );
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Function submits form.
*
*	@param FormId - Form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param Param3 - Third parameter.
*
*	@param Value3 - Third parameter's value.
*
*	@param ConfirmString - Confirmation question.
*
*	@param Action - Destination page.
*
*	@param Waiting - Should user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.SubmitForm3 = function( FormId , Param1 , Value1 , Param2 , Value2 , Param3 , Value3 , 
																			ConfirmString , Action , Waiting , Method )
{
	if( !ultimix.forms.form_exists( FormId ) || !ultimix.forms.item_exists( Param1 ) || 
		!ultimix.forms.item_exists( Param2 ) || !ultimix.forms.item_exists( Param3 ) )
	{
		return;
	}
	var			Success = function( Result )
	{
		if( Result == ultimix.std_dialogs.MB_YES )
		{
			document.getElementById( Param1 ).setAttribute( 'value' , Value1 );
			document.getElementById( Param2 ).setAttribute( 'value' , Value2 );
			document.getElementById( Param3 ).setAttribute( 'value' , Value3 );
			ultimix.forms.submit_form_and_wait( FormId , Action , Waiting , Method );
		}
	}
	ultimix.forms.confirm_submit( ConfirmString , Success );
}

/**
*	Function extracts value from item.
*
*	@param Item - Form item.
*
*	@return Item value.
*
*	@author Dodonov A.A.
*/
ultimix.forms.get_item_value = function( Item )
{
	var			TagName = jQuery( Item ).prop( 'tagName' ).toLowerCase();
	switch( TagName )
	{
		case( 'textarea' ):
		case( 'select' ):
			return( jQuery( Item ).val() );
		case( 'input' ):
			var			Type = jQuery( Item ).prop( 'type' ).toLowerCase();
			if( Type == 'checkbox' )
			{
				return( jQuery( Item ).prop( 'checked' ) ? 1 : 0 );
			}
			if( ( Type == 'radio' && jQuery( Item ).prop( 'checked' ) ) || Type == 'text' || 
					Type == 'hidden' || Type == 'password' )
			{
				return( jQuery( Item ).val() );
			}
	}
}

/**
*	Function extracts data from form.
*
*	@param Selector - Selector of the form.
*
*	@return Form data.
*
*	@author Dodonov A.A.
*/
ultimix.forms.ExtractFormData = function( Selector )
{
	var			Items = jQuery( Selector ).find( '*' ).andSelf();
	var			Data = new Object();

	for( var i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).attr( 'name' ) )
		{
			Data[ jQuery( Items[ i ] ).attr( 'name' ) ] = ultimix.forms.get_item_value( Items[ i ] );
		}
	}

	return( Data );
}

/**
*	Function opens edit record form.
*
*	@param id - Id of the editing record.
*
*	@param Prefix - Prefix of the form.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.forms.EditRecord = function( id , Prefix , Method )
{
	ultimix.forms.SubmitForm2( 
		Prefix + '_form' , Prefix + '_context_action' , 'update_record_form' , Prefix + '_record_id' , 
		id , '' , '' , false , Method
	);
}

/**
*	Function cancels searching.
*
*	@param ElementId - Element id.
*
*	@param Speed - Toggle speed.
*
*	@author Dodonov A.A.
*/
ultimix.forms.CancelSearch = function( ElementId , Speed )
{
	if( document.getElementById( 'search_string' ).value == '' )
	{
		ultimix.ToggleElement( ElementId , Speed );
	}
	else
	{
		document.getElementById( 'search_string' ).value = '';
		window.location.href = window.location.href;
	}
}

/**
*	Function moves value to the other object.
*
*	@param Obj - Source object.
*
*	@param DestinationObjectId - Id of the destination object.
*
*	@author Dodonov A.A.
*/
ultimix.forms.MoveValueTo = function( Obj , DestinationObjectId )
{
	document.getElementById( DestinationObjectId ).value = Obj.value;
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

// TODO: move to gui::href_markup

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.grids )
{
	ultimix.grids = {};
}

/**
*	Function checks that at least one checkbox was selected.
*
*	@param Name - Suffix of the checkboxes group.
*
*	@param ErrorMessage - Error message.
*
*	@return true if at least one checkbox was selected.
*
*	@author Dodonov A.A.
*/
ultimix.grids.RecordSelected = function( Name , ErrorMessage )
{
	return( ultimix.grids.RecordSelectedEx( '._' + Name + '_item_checkbox' , ErrorMessage ) );
}

/**
*	Function checks that at least one checkbox was selected.
*
*	@param Selector - Selector of the checkboxes.
*
*	@param ErrorMessage - Error message.
*
*	@return true if at least one checkbox was selected.
*
*	@author Dodonov A.A.
*/
ultimix.grids.RecordSelectedEx = function( Selector , ErrorMessage )
{
	var		Items = jQuery( Selector );
	
	for( i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).prop( 'checked' ) )
		{
			return( true );
		}
	}

	if( ErrorMessage )
	{
		ultimix.std_dialogs.ErrorMessageBox( ErrorMessage );
	}

	return( false );
}

/**
*	Function returns a list of the ids of the selected checkboxes.
*
*	@param Name - Suffix of the checkboxes group.
*
*	@return Array with the ids array.
*
*	@author Dodonov A.A.
*/
ultimix.grids.GetIdentificators = function( Name )
{
	return( ultimix.grids.GetIdentificatorsEx( '._' + Name + '_item_checkbox' ) );
}

/**
*	Function returns a list of the ids of the selected checkboxes.
*
*	@param Selector - Selector of the checkboxes.
*
*	@return Array with the ids array.
*
*	@author Dodonov A.A.
*/
ultimix.grids.GetIdentificatorsEx = function( Selector )
{
	var		Identificators = new Array();
	
	var		Items = jQuery( Selector );
	
	for( var i = 0 ; i < Items.length ; i++ )
	{
		if( jQuery( Items[ i ] ).prop( 'checked' ) )
		{
			Identificators.push( ( new String( jQuery( Items[ i ] ).attr( 'id' ) ) ).replace( '_id_' , '' ) );
		}
	}
	
	return( Identificators );
}

/**
*	Function processes clicks on the children checkboxes.
*
*	@param Checkbox - Object of the clicked checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.grids.ToggleChildrenCheckboxes = function( Checkbox )
{
	var			ChildrenSelector = jQuery( Checkbox ).attr( 'children_selector' );
	
	var			Checked = jQuery( Checkbox ).prop( 'checked' );
	
	jQuery( ChildrenSelector ).each(
		function()
		{
			jQuery( this ).prop( 'checked' , Checked );
			
			/* if has children */
			if( jQuery( this ).attr( 'children_selector' ) )
			{
				/* ... then toggle children */
				ultimix.grids.ToggleChildrenCheckboxes( this );
			}
		}
	);
}

// TODO convert to lowercase

/**
*	Function processes clicks on the parent checkboxes.
*
*	@param ParentSelector - Selector of the parent.
*
*	@param Checked - Check flag, true/false.
*
*	@author Dodonov A.A.
*/
ultimix.grids.toggle_parent = function( ParentSelector , Checked )
{
	jQuery( ParentSelector ).each(
		function()
		{
			jQuery( this ).prop( 'checked' , Checked );
			ultimix.grids.TryToggleParentCheckbox( this );
		}
	);
}

/**
*	Function processes clicks on the parent checkboxes.
*
*	@param Checkbox - Object of the clicked checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.grids.TryToggleParentCheckbox = function( Checkbox )
{
	var			ParentSelector = jQuery( Checkbox ).attr( 'parent_selector' );
	if( ParentSelector )
	{
		/* try to toggle it */
		var			Checked = jQuery( Checkbox ).prop( 'checked' );
		if( Checked )
		{
			var			SiblingsSelector = jQuery( Checkbox ).attr( 'siblings_selector' );
			if( jQuery( SiblingsSelector ).length == jQuery( SiblingsSelector ).filter( ':checked' ).length )
			{
				ultimix.grids.toggle_parent( ParentSelector , Checked );
			}
		}
		else
		{
			ultimix.grids.toggle_parent( ParentSelector , Checked );
		}
	}
}

/**
*	OnClick event handler.
*
*	@param Checkbox - Object of the clicked checkbox.
*
*	@author Dodonov A.A.
*/
ultimix.grids.ProcessLinkedCheckboxes = function( Checkbox )
{
	ultimix.grids.ToggleChildrenCheckboxes( Checkbox );
	ultimix.grids.TryToggleParentCheckbox( Checkbox );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm0Mass = function( FormId , ConfirmString , Action , Name , NotSelectedErrorMessage , 
																									Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	ultimix.forms.SubmitForm0( FormId , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm1Mass = function( FormId , Param1, Value1 , ConfirmString , Action , Name , 
																			NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}

	ultimix.forms.SubmitForm1( FormId , Param1, Value1 , ConfirmString , Action , Waiting , Method );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm2Mass = function( FormId , Param1, Value1 , Param2, Value2 , ConfirmString , Action , Name , 
																			NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}
	
	ultimix.forms.SubmitForm2( FormId , Param1, Value1 , Param2, Value2 , ConfirmString , Action , Waiting );
}

/**
*	Function submits form.
*
*	@param FormId - id of the form to be submitted.
*
*	@param Param1 - First parameter.
*
*	@param Value1 - First parameter's value.
*
*	@param Param2 - Second parameter.
*
*	@param Value2 - Second parameter's value.
*
*	@param Param3 - Third parameter.
*
*	@param Value3 - Third parameter's value.
*
*	@param Action - Destination page.
*
*	@param ConfirmString - Confirmation string.
*
*	@param Name - Name of the checkbox group.
*
*	@param NotSelectedErrorMessage - Error message.
*
*	@param Waiting - Showd user be warned.
*
*	@param Method - Submit method.
*
*	@author Dodonov A.A.
*/
ultimix.grids.SubmitForm3Mass = function( FormId , Param1, Value1 , Param2, Value2 , Param3, Value3 , ConfirmString , 
															Action , Name , NotSelectedErrorMessage , Waiting , Method )
{
	if( ultimix.grids.RecordSelected( Name ) == false )
	{
		ultimix.std_dialogs.ErrorMessageBox( NotSelectedErrorMessage );
		return;
	}
	
	ultimix.forms.SubmitForm3( 
		FormId , Param1, Value1 , Param2, Value2 , Param3, Value3 , ConfirmString , Action , Waiting
	);
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.inplace )
{
	ultimix.inplace = {};
}

/**
*	Function replaces DOM element with textarea.
*
*	@param Event - Event object.
*
*	@author Dodonov A.A.
*/
ultimix.inplace.ReplaceWithTextarea = function( Event )
{
	var			Width = jQuery( Event.target ).outerWidth();
	var			Height = jQuery( Event.target ).outerHeight();
	var			Name = jQuery( Event.target ).attr( 'field_name' );
	var			Class = jQuery( Event.target ).attr( 'field_class' );
	var			Value = jQuery( Event.target ).html();

	jQuery( Event.target ).hide();
	jQuery( Event.target ).after( 
		'<textarea style="margin: 0px; width: ' + ( Width - 5 ) + 'px; height: ' + ( Height - 3 ) + 
		'px" class="' + Class + '" name="' + Name + '">' + Value + '</textarea>'
	);
	jQuery( Event.target ).next().focus();
}

/**
*	Function replaces DOM element with input.
*
*	@param Event - Event object.
*
*	@author Dodonov A.A.
*/
ultimix.inplace.ReplaceWithInput = function( Event )
{
	var			Width = jQuery( Event.target ).outerWidth();
	var			Name = jQuery( Event.target ).attr( 'field_name' );
	var			Class = jQuery( Event.target ).attr( 'field_class' );
	var			Value = jQuery( Event.target ).html();

	jQuery( Event.target ).hide();
	jQuery( Event.target ).after( 
		'<input style="margin: 0px; width: ' + ( Width - 5 ) + 'px;' + 
		'" class="' + Class + '" name="' + Name + '" value="' + Value + '">'
	);
	jQuery( Event.target ).next().focus();
}

/**
*	Automatic setting event handlers.
*
*	@author Dodonov A.A.
*/
jQuery(
	function()
	{
		jQuery( '.inplace_textarea' ).each(
			function( i , Element )
			{
				jQuery( Element ).dblclick( ultimix.inplace.ReplaceWithTextarea );
			}
		);
		jQuery( '.inplace_input' ).each(
			function( i , Element )
			{
				jQuery( Element ).dblclick( ultimix.inplace.ReplaceWithInput );
			}
		);
	}
);
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.iterator )
{
	ultimix.iterator = {};
}

/**
*	Function creates iterator.
*
*	@param IteratingElements - Elements to iterate.
*
*	@param BeforeNext - This function will be called before iterator shift.
*
*	@return Iterator.
*
*	@author Dodonov A.A.
*/
ultimix.iterator = function( IteratingElements , BeforeNext , EndIteration )
{
	this.current_position = 0;
	this.elements = IteratingElements;
	this.before_next = BeforeNext;
	this.end_iteration = EndIteration;

	return( this );
}

// TODO persistent che�kbox
// TODO persistent input
// TODO persistent radiobutton

/**
*	Function moves to next element.
*
*	@author Dodonov A.A.
*/
ultimix.iterator.prototype.next = function()
{
	if( jQuery( this.elements ).eq( this.current_position ).length )
	{
		this.before_next();
		this.current_position++;
	}
	else
	{
		this.end_iteration();
	}
}

/**
*	Function returns current element.
*
*	@return Current element
*
*	@author Dodonov A.A.
*/
ultimix.iterator.prototype.current_element = function()
{
	if( jQuery( this.elements ).eq( this.current_position ).length )
	{
		return( jQuery( this.elements ).eq( this.current_position ) );
	}
	
	return( false );
}

/**
*	Function returns previous element.
*
*	@return Previous element
*
*	@author Dodonov A.A.
*/
ultimix.iterator.prototype.prev_element = function()
{
	if( this.current_position - 1 >= 0 && jQuery( this.elements ).eq( this.current_position - 1 ).length )
	{
		return( jQuery( this.elements ).eq( this.current_position - 1 ) );
	}
	
	return( false );
}
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.string_utilities )
{
	ultimix.string_utilities = {};
}

/**
* 	Function replaces all occuances of the Search with Search.
*
* 	@param Search - Search substring.
*
* 	@param Replace - Replacing substring.
*
* 	@param Subject - Transforming string.
*
* 	@return String with the replaces.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.str_replace = function( Search , Replace , Subject )
{
	return( Subject.split( Search ).join( Replace ) );
}

// TODO add API wich creates grids from div - was used in seo_tools

/**
* 	Function formats Record according to the Format.
*
* 	@param Format - Format.
*
* 	@param Record - Record to format.
*
* 	@return Formatted record.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.PrintRecord = function( Format , Record )
{
	for( i in Record )
	{
		Format = ultimix.string_utilities.str_replace( '[' + i + ']' , Record[ i ] , Format );
	}
	
	return( Format );
}

/**
* 	Function trails data.
*
* 	@param Data - Data.
*
* 	@param EncodedData - Encoded data.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.trail_data = function( Data , EncodedData )
{
	switch( Data.length % 3 )
	{
        case( 1 ):
            EncodedData = EncodedData.slice( 0 , -2 ) + '==';
        break;
        case( 2 ):
            EncodedData = EncodedData.slice( 0 , -1 ) + '=';
        break;
    }
 
    return( EncodedData );
}

/**
* 	Function encodes string into base64.
*
* 	@param Data - Data to convert.
*
* 	@return Encoded string.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.base64_encode = function( Data )
{   
    var 		b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var 		o1 , o2 , o3 , h1 , h2 , h3 , h4 , bits , i = 0 , EncodedData = '';
    do
	{ 
        o1 = Data.charCodeAt( i++ );
        o2 = Data.charCodeAt( i++ );
        o3 = Data.charCodeAt( i++ );
        bits = o1 << 16 | o2 << 8 | o3;
        h1 = bits >> 18 & 0x3f;
        h2 = bits >> 12 & 0x3f;
        h3 = bits >> 6 & 0x3f;
        h4 = bits & 0x3f;
        EncodedData += b64.charAt( h1 ) + b64.charAt( h2 ) + b64.charAt( h3 ) + b64.charAt( h4 );
    }
	while ( i < Data.length );
 
    return( ultimix.string_utilities.trail_data( Data , EncodedData ) );
}

/**
* 	Function decodes string from base64.
*
* 	@param o1 - Decode parameters.
*
* 	@param o2 - Decode parameters.
*
* 	@param o3 - Decode parameters.
*
* 	@param h3 - Decode parameters.
*
* 	@param h4 - Decode parameters.
*
* 	@return Decoded char.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.decoded_char = function( o1 , o2 , o3 , h3 , h4 )
{
	if( h3 == 64 )
	{
		return( String.fromCharCode( o1 ) );
	}
	else if ( h4 == 64 )
	{
		return( String.fromCharCode( o1 , o2 ) );
	}
	else
	{
		return( String.fromCharCode( o1 , o2 , o3 ) );
	}
}

/**
* 	Function decodes string from base64.
*
* 	@param Data - Data to convert.
*
* 	@return Decoded string.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.base64_decode = function( Data )
{
	var 	b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var 	o1 , o2 , o3 , h1 , h2 , h3 , h4 , bits , i = 0 , DecodedData = '';
	do
	{
		h1 = b64.indexOf( Data.charAt( i++ ) );
		h2 = b64.indexOf( Data.charAt( i++ ) );
		h3 = b64.indexOf( Data.charAt( i++ ) );
		h4 = b64.indexOf( Data.charAt( i++ ) );
		bits = h1<<18 | h2<<12 | h3<<6 | h4;
		o1 = bits>>16 & 0xff;
		o2 = bits>>8 & 0xff;
		o3 = bits & 0xff;

		DecodedData += ultimix.string_utilities.decoded_char( o1 , o2 , o3 , h3 , h4 );
	}
	while( i < Data.length );

	return( DecodedData );
}

/**
* 	Function creates vertical aligned block.
*
* 	@param Content - Content for block.
*
* 	@return Block.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.valign_block = function( Content )
{
	return( "<div class=\"valign_child\">" + Content + "</div><div class=\"valign_helper\"></div>" );
}

/**
* 	Function creates horisontal aligned block.
*
* 	@param Content - Content for block.
*
* 	@param Width - Width for the block.
*
* 	@return Block.
*
* 	@author Dodonov A.A.
*/
ultimix.string_utilities.halign_block = function( Content , Width )
{
	return( 
		"<div class=\"margin_0_auto\" style=\"display: block; width: " + Width + "px; height: 100%;\">" + 
		Content + "</div>"
	);
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Function shows popup window.
*
*	@param URL - URL of the opening page.
*
*	@param Width - Width of the opening page.
*
*	@param Height - Height of the opening page.
*
*	@author Dodonov A.A.
*/
ultimix.PopupHref = function( URL , Width , Height )
{
	window.open( URL , "" , "width=" + Width + ", height=" + Height );
}

/**
*	Function reloads page.
*
*	@author Dodonov A.A.
*/
ultimix.ReloadPage = function()
{
	window.location.reload( true );
}

/**
 * SWFUpload: http://www.swfupload.org, http://swfupload.googlecode.com
 *
 * mmSWFUpload 1.0: Flash upload dialog - http://profandesign.se/swfupload/,  http://www.vinterwebb.se/
 *
 * SWFUpload is (c) 2006-2007 Lars Huring, Olov Nilz�n and Mammon Media and is released under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * SWFUpload 2 is (c) 2007-2008 Jake Roberts and is released under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 */


/* ******************* */
/* Constructor & Init  */
/* ******************* */
var SWFUpload;

if (SWFUpload == undefined) {
	SWFUpload = function (settings) {
		this.initSWFUpload(settings);
	};
}

SWFUpload.prototype.initSWFUpload = function (settings) {
	try {
		this.customSettings = {};	// A container where developers can place their own settings associated with this instance.
		this.settings = settings;
		this.eventQueue = [];
		this.movieName = "SWFUpload_" + SWFUpload.movieCount++;
		this.movieElement = null;


		// Setup global control tracking
		SWFUpload.instances[this.movieName] = this;

		// Load the settings.  Load the Flash movie.
		this.initSettings();
		this.loadFlash();
		this.displayDebugInfo();
	} catch (ex) {
		delete SWFUpload.instances[this.movieName];
		throw ex;
	}
};

/* *************** */
/* Static Members  */
/* *************** */
SWFUpload.instances = {};
SWFUpload.movieCount = 0;
SWFUpload.version = "2.2.0 2009-03-25";
SWFUpload.QUEUE_ERROR = {
	QUEUE_LIMIT_EXCEEDED	  		: -100,
	FILE_EXCEEDS_SIZE_LIMIT  		: -110,
	ZERO_BYTE_FILE			  		: -120,
	INVALID_FILETYPE		  		: -130
};
SWFUpload.UPLOAD_ERROR = {
	HTTP_ERROR				  		: -200,
	MISSING_UPLOAD_URL	      		: -210,
	IO_ERROR				  		: -220,
	SECURITY_ERROR			  		: -230,
	UPLOAD_LIMIT_EXCEEDED	  		: -240,
	UPLOAD_FAILED			  		: -250,
	SPECIFIED_FILE_ID_NOT_FOUND		: -260,
	FILE_VALIDATION_FAILED	  		: -270,
	FILE_CANCELLED			  		: -280,
	UPLOAD_STOPPED					: -290
};
SWFUpload.FILE_STATUS = {
	QUEUED		 : -1,
	IN_PROGRESS	 : -2,
	ERROR		 : -3,
	COMPLETE	 : -4,
	CANCELLED	 : -5
};
SWFUpload.BUTTON_ACTION = {
	SELECT_FILE  : -100,
	SELECT_FILES : -110,
	START_UPLOAD : -120
};
SWFUpload.CURSOR = {
	ARROW : -1,
	HAND : -2
};
SWFUpload.WINDOW_MODE = {
	WINDOW : "window",
	TRANSPARENT : "transparent",
	OPAQUE : "opaque"
};

// Private: takes a URL, determines if it is relative and converts to an absolute URL
// using the current site. Only processes the URL if it can, otherwise returns the URL untouched
SWFUpload.completeURL = function(url) {
	if (typeof(url) !== "string" || url.match(/^https?:\/\//i) || url.match(/^\//)) {
		return url;
	}
	
	var currentURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ":" + window.location.port : "");
	
	var indexSlash = window.location.pathname.lastIndexOf("/");
	if (indexSlash <= 0) {
		path = "/";
	} else {
		path = window.location.pathname.substr(0, indexSlash) + "/";
	}
	
	return /*currentURL +*/ path + url;
	
};


/* ******************** */
/* Instance Members  */
/* ******************** */

// Private: initSettings ensures that all the
// settings are set, getting a default value if one was not assigned.
SWFUpload.prototype.initSettings = function () {
	this.ensureDefault = function (settingName, defaultValue) {
		this.settings[settingName] = (this.settings[settingName] == undefined) ? defaultValue : this.settings[settingName];
	};
	
	// Upload backend settings
	this.ensureDefault("upload_url", "");
	this.ensureDefault("preserve_relative_urls", false);
	this.ensureDefault("file_post_name", "Filedata");
	this.ensureDefault("post_params", {});
	this.ensureDefault("use_query_string", false);
	this.ensureDefault("requeue_on_error", false);
	this.ensureDefault("http_success", []);
	this.ensureDefault("assume_success_timeout", 0);
	
	// File Settings
	this.ensureDefault("file_types", "*.*");
	this.ensureDefault("file_types_description", "All Files");
	this.ensureDefault("file_size_limit", 0);	// Default zero means "unlimited"
	this.ensureDefault("file_upload_limit", 0);
	this.ensureDefault("file_queue_limit", 0);

	// Flash Settings
	this.ensureDefault("flash_url", "swfupload.swf");
	this.ensureDefault("prevent_swf_caching", true);
	
	// Button Settings
	this.ensureDefault("button_image_url", "");
	this.ensureDefault("button_width", 1);
	this.ensureDefault("button_height", 1);
	this.ensureDefault("button_text", "");
	this.ensureDefault("button_text_style", "color: #000000; font-size: 16pt;");
	this.ensureDefault("button_text_top_padding", 0);
	this.ensureDefault("button_text_left_padding", 0);
	this.ensureDefault("button_action", SWFUpload.BUTTON_ACTION.SELECT_FILES);
	this.ensureDefault("button_disabled", false);
	this.ensureDefault("button_placeholder_id", "");
	this.ensureDefault("button_placeholder", null);
	this.ensureDefault("button_cursor", SWFUpload.CURSOR.ARROW);
	this.ensureDefault("button_window_mode", SWFUpload.WINDOW_MODE.WINDOW);
	
	// Debug Settings
	this.ensureDefault("debug", false);
	this.settings.debug_enabled = this.settings.debug;	// Here to maintain v2 API
	
	// Event Handlers
	this.settings.return_upload_start_handler = this.returnUploadStart;
	this.ensureDefault("swfupload_loaded_handler", null);
	this.ensureDefault("file_dialog_start_handler", null);
	this.ensureDefault("file_queued_handler", null);
	this.ensureDefault("file_queue_error_handler", null);
	this.ensureDefault("file_dialog_complete_handler", null);
	
	this.ensureDefault("upload_start_handler", null);
	this.ensureDefault("upload_progress_handler", null);
	this.ensureDefault("upload_error_handler", null);
	this.ensureDefault("upload_success_handler", null);
	this.ensureDefault("upload_complete_handler", null);
	
	this.ensureDefault("debug_handler", this.debugMessage);

	this.ensureDefault("custom_settings", {});

	// Other settings
	this.customSettings = this.settings.custom_settings;
	
	// Update the flash url if needed
	if (!!this.settings.prevent_swf_caching) {
		this.settings.flash_url = this.settings.flash_url + (this.settings.flash_url.indexOf("?") < 0 ? "?" : "&") + "preventswfcaching=" + new Date().getTime();
	}
	
	if (!this.settings.preserve_relative_urls) {
		//this.settings.flash_url = SWFUpload.completeURL(this.settings.flash_url);	// Don't need to do this one since flash doesn't look at it
		this.settings.upload_url = SWFUpload.completeURL(this.settings.upload_url);
		this.settings.button_image_url = SWFUpload.completeURL(this.settings.button_image_url);
	}
	
	delete this.ensureDefault;
};

// Private: loadFlash replaces the button_placeholder element with the flash movie.
SWFUpload.prototype.loadFlash = function () {
	var targetElement, tempParent;

	// Make sure an element with the ID we are going to use doesn't already exist
	if (document.getElementById(this.movieName) !== null) {
		throw "ID " + this.movieName + " is already in use. The Flash Object could not be added";
	}

	// Get the element where we will be placing the flash movie
	targetElement = document.getElementById(this.settings.button_placeholder_id) || this.settings.button_placeholder;

	if (targetElement == undefined) {
		throw "Could not find the placeholder element: " + this.settings.button_placeholder_id;
	}

	// Append the container and load the flash
	tempParent = document.createElement("div");
	tempParent.innerHTML = this.getFlashHTML();	// Using innerHTML is non-standard but the only sensible way to dynamically add Flash in IE (and maybe other browsers)
	targetElement.parentNode.replaceChild(tempParent.firstChild, targetElement);

	// Fix IE Flash/Form bug
	if (window[this.movieName] == undefined) {
		window[this.movieName] = this.getMovieElement();
	}
	
};

// Private: getFlashHTML generates the object tag needed to embed the flash in to the document
SWFUpload.prototype.getFlashHTML = function () {
	// Flash Satay object syntax: http://www.alistapart.com/articles/flashsatay
	return ['<object id="', this.movieName, '" type="application/x-shockwave-flash" data="', this.settings.flash_url, '" width="', this.settings.button_width, '" height="', this.settings.button_height, '" class="swfupload">',
				'<param name="wmode" value="', this.settings.button_window_mode, '" />',
				'<param name="movie" value="', this.settings.flash_url, '" />',
				'<param name="quality" value="high" />',
				'<param name="menu" value="false" />',
				'<param name="allowScriptAccess" value="always" />',
				'<param name="flashvars" value="' + this.getFlashVars() + '" />',
				'</object>'].join("");
};

// Private: getFlashVars builds the parameter string that will be passed
// to flash in the flashvars param.
SWFUpload.prototype.getFlashVars = function () {
	// Build a string from the post param object
	var paramString = this.buildParamString();
	var httpSuccessString = this.settings.http_success.join(",");
	
	// Build the parameter string
	return ["movieName=", encodeURIComponent(this.movieName),
			"&amp;uploadURL=", encodeURIComponent(this.settings.upload_url),
			"&amp;useQueryString=", encodeURIComponent(this.settings.use_query_string),
			"&amp;requeueOnError=", encodeURIComponent(this.settings.requeue_on_error),
			"&amp;httpSuccess=", encodeURIComponent(httpSuccessString),
			"&amp;assumeSuccessTimeout=", encodeURIComponent(this.settings.assume_success_timeout),
			"&amp;params=", encodeURIComponent(paramString),
			"&amp;filePostName=", encodeURIComponent(this.settings.file_post_name),
			"&amp;fileTypes=", encodeURIComponent(this.settings.file_types),
			"&amp;fileTypesDescription=", encodeURIComponent(this.settings.file_types_description),
			"&amp;fileSizeLimit=", encodeURIComponent(this.settings.file_size_limit),
			"&amp;fileUploadLimit=", encodeURIComponent(this.settings.file_upload_limit),
			"&amp;fileQueueLimit=", encodeURIComponent(this.settings.file_queue_limit),
			"&amp;debugEnabled=", encodeURIComponent(this.settings.debug_enabled),
			"&amp;buttonImageURL=", encodeURIComponent(this.settings.button_image_url),
			"&amp;buttonWidth=", encodeURIComponent(this.settings.button_width),
			"&amp;buttonHeight=", encodeURIComponent(this.settings.button_height),
			"&amp;buttonText=", encodeURIComponent(this.settings.button_text),
			"&amp;buttonTextTopPadding=", encodeURIComponent(this.settings.button_text_top_padding),
			"&amp;buttonTextLeftPadding=", encodeURIComponent(this.settings.button_text_left_padding),
			"&amp;buttonTextStyle=", encodeURIComponent(this.settings.button_text_style),
			"&amp;buttonAction=", encodeURIComponent(this.settings.button_action),
			"&amp;buttonDisabled=", encodeURIComponent(this.settings.button_disabled),
			"&amp;buttonCursor=", encodeURIComponent(this.settings.button_cursor)
		].join("");
};

// Public: getMovieElement retrieves the DOM reference to the Flash element added by SWFUpload
// The element is cached after the first lookup
SWFUpload.prototype.getMovieElement = function () {
	if (this.movieElement == undefined) {
		this.movieElement = document.getElementById(this.movieName);
	}

	if (this.movieElement === null) {
		throw "Could not find Flash element";
	}
	
	return this.movieElement;
};

// Private: buildParamString takes the name/value pairs in the post_params setting object
// and joins them up in to a string formatted "name=value&amp;name=value"
SWFUpload.prototype.buildParamString = function () {
	var postParams = this.settings.post_params; 
	var paramStringPairs = [];

	if (typeof(postParams) === "object") {
		for (var name in postParams) {
			if (postParams.hasOwnProperty(name)) {
				paramStringPairs.push(encodeURIComponent(name.toString()) + "=" + encodeURIComponent(postParams[name].toString()));
			}
		}
	}

	return paramStringPairs.join("&amp;");
};

// Public: Used to remove a SWFUpload instance from the page. This method strives to remove
// all references to the SWF, and other objects so memory is properly freed.
// Returns true if everything was destroyed. Returns a false if a failure occurs leaving SWFUpload in an inconsistant state.
// Credits: Major improvements provided by steffen
SWFUpload.prototype.destroy = function () {
	try {
		// Make sure Flash is done before we try to remove it
		this.cancelUpload(null, false);
		

		// Remove the SWFUpload DOM nodes
		var movieElement = null;
		movieElement = this.getMovieElement();
		
		if (movieElement && typeof(movieElement.CallFunction) === "unknown") { // We only want to do this in IE
			// Loop through all the movie's properties and remove all function references (DOM/JS IE 6/7 memory leak workaround)
			for (var i in movieElement) {
				try {
					if (typeof(movieElement[i]) === "function") {
						movieElement[i] = null;
					}
				} catch (ex1) {}
			}

			// Remove the Movie Element from the page
			try {
				movieElement.parentNode.removeChild(movieElement);
			} catch (ex) {}
		}
		
		// Remove IE form fix reference
		window[this.movieName] = null;

		// Destroy other references
		SWFUpload.instances[this.movieName] = null;
		delete SWFUpload.instances[this.movieName];

		this.movieElement = null;
		this.settings = null;
		this.customSettings = null;
		this.eventQueue = null;
		this.movieName = null;
		
		
		return true;
	} catch (ex2) {
		return false;
	}
};


// Public: displayDebugInfo prints out settings and configuration
// information about this SWFUpload instance.
// This function (and any references to it) can be deleted when placing
// SWFUpload in production.
SWFUpload.prototype.displayDebugInfo = function () {
	this.debug(
		[
			"---SWFUpload Instance Info---\n",
			"Version: ", SWFUpload.version, "\n",
			"Movie Name: ", this.movieName, "\n",
			"Settings:\n",
			"\t", "upload_url:               ", this.settings.upload_url, "\n",
			"\t", "flash_url:                ", this.settings.flash_url, "\n",
			"\t", "use_query_string:         ", this.settings.use_query_string.toString(), "\n",
			"\t", "requeue_on_error:         ", this.settings.requeue_on_error.toString(), "\n",
			"\t", "http_success:             ", this.settings.http_success.join(", "), "\n",
			"\t", "assume_success_timeout:   ", this.settings.assume_success_timeout, "\n",
			"\t", "file_post_name:           ", this.settings.file_post_name, "\n",
			"\t", "post_params:              ", this.settings.post_params.toString(), "\n",
			"\t", "file_types:               ", this.settings.file_types, "\n",
			"\t", "file_types_description:   ", this.settings.file_types_description, "\n",
			"\t", "file_size_limit:          ", this.settings.file_size_limit, "\n",
			"\t", "file_upload_limit:        ", this.settings.file_upload_limit, "\n",
			"\t", "file_queue_limit:         ", this.settings.file_queue_limit, "\n",
			"\t", "debug:                    ", this.settings.debug.toString(), "\n",

			"\t", "prevent_swf_caching:      ", this.settings.prevent_swf_caching.toString(), "\n",

			"\t", "button_placeholder_id:    ", this.settings.button_placeholder_id.toString(), "\n",
			"\t", "button_placeholder:       ", (this.settings.button_placeholder ? "Set" : "Not Set"), "\n",
			"\t", "button_image_url:         ", this.settings.button_image_url.toString(), "\n",
			"\t", "button_width:             ", this.settings.button_width.toString(), "\n",
			"\t", "button_height:            ", this.settings.button_height.toString(), "\n",
			"\t", "button_text:              ", this.settings.button_text.toString(), "\n",
			"\t", "button_text_style:        ", this.settings.button_text_style.toString(), "\n",
			"\t", "button_text_top_padding:  ", this.settings.button_text_top_padding.toString(), "\n",
			"\t", "button_text_left_padding: ", this.settings.button_text_left_padding.toString(), "\n",
			"\t", "button_action:            ", this.settings.button_action.toString(), "\n",
			"\t", "button_disabled:          ", this.settings.button_disabled.toString(), "\n",

			"\t", "custom_settings:          ", this.settings.custom_settings.toString(), "\n",
			"Event Handlers:\n",
			"\t", "swfupload_loaded_handler assigned:  ", (typeof this.settings.swfupload_loaded_handler === "function").toString(), "\n",
			"\t", "file_dialog_start_handler assigned: ", (typeof this.settings.file_dialog_start_handler === "function").toString(), "\n",
			"\t", "file_queued_handler assigned:       ", (typeof this.settings.file_queued_handler === "function").toString(), "\n",
			"\t", "file_queue_error_handler assigned:  ", (typeof this.settings.file_queue_error_handler === "function").toString(), "\n",
			"\t", "upload_start_handler assigned:      ", (typeof this.settings.upload_start_handler === "function").toString(), "\n",
			"\t", "upload_progress_handler assigned:   ", (typeof this.settings.upload_progress_handler === "function").toString(), "\n",
			"\t", "upload_error_handler assigned:      ", (typeof this.settings.upload_error_handler === "function").toString(), "\n",
			"\t", "upload_success_handler assigned:    ", (typeof this.settings.upload_success_handler === "function").toString(), "\n",
			"\t", "upload_complete_handler assigned:   ", (typeof this.settings.upload_complete_handler === "function").toString(), "\n",
			"\t", "debug_handler assigned:             ", (typeof this.settings.debug_handler === "function").toString(), "\n"
		].join("")
	);
};

/* Note: addSetting and getSetting are no longer used by SWFUpload but are included
	the maintain v2 API compatibility
*/
// Public: (Deprecated) addSetting adds a setting value. If the value given is undefined or null then the default_value is used.
SWFUpload.prototype.addSetting = function (name, value, default_value) {
    if (value == undefined) {
        return (this.settings[name] = default_value);
    } else {
        return (this.settings[name] = value);
	}
};

// Public: (Deprecated) getSetting gets a setting. Returns an empty string if the setting was not found.
SWFUpload.prototype.getSetting = function (name) {
    if (this.settings[name] != undefined) {
        return this.settings[name];
	}

    return "";
};



// Private: callFlash handles function calls made to the Flash element.
// Calls are made with a setTimeout for some functions to work around
// bugs in the ExternalInterface library.
SWFUpload.prototype.callFlash = function (functionName, argumentArray) {
	argumentArray = argumentArray || [];
	
	var movieElement = this.getMovieElement();
	var returnValue, returnString;

	// Flash's method if calling ExternalInterface methods (code adapted from MooTools).
	try {
		returnString = movieElement.CallFunction('<invoke name="' + functionName + '" returntype="javascript">' + __flash__argumentsToXML(argumentArray, 0) + '</invoke>');
		returnValue = eval(returnString);
	} catch (ex) {
		throw "Call to " + functionName + " failed";
	}
	
	// Unescape file post param values
	if (returnValue != undefined && typeof returnValue.post === "object") {
		returnValue = this.unescapeFilePostParams(returnValue);
	}

	return returnValue;
};

/* *****************************
	-- Flash control methods --
	Your UI should use these
	to operate SWFUpload
   ***************************** */

// WARNING: this function does not work in Flash Player 10
// Public: selectFile causes a File Selection Dialog window to appear.  This
// dialog only allows 1 file to be selected.
SWFUpload.prototype.selectFile = function () {
	this.callFlash("SelectFile");
};

// WARNING: this function does not work in Flash Player 10
// Public: selectFiles causes a File Selection Dialog window to appear/ This
// dialog allows the user to select any number of files
// Flash Bug Warning: Flash limits the number of selectable files based on the combined length of the file names.
// If the selection name length is too long the dialog will fail in an unpredictable manner.  There is no work-around
// for this bug.
SWFUpload.prototype.selectFiles = function () {
	this.callFlash("SelectFiles");
};


// Public: startUpload starts uploading the first file in the queue unless
// the optional parameter 'fileID' specifies the ID 
SWFUpload.prototype.startUpload = function (fileID) {
	this.callFlash("StartUpload", [fileID]);
};

// Public: cancelUpload cancels any queued file.  The fileID parameter may be the file ID or index.
// If you do not specify a fileID the current uploading file or first file in the queue is cancelled.
// If you do not want the uploadError event to trigger you can specify false for the triggerErrorEvent parameter.
SWFUpload.prototype.cancelUpload = function (fileID, triggerErrorEvent) {
	if (triggerErrorEvent !== false) {
		triggerErrorEvent = true;
	}
	this.callFlash("CancelUpload", [fileID, triggerErrorEvent]);
};

// Public: stopUpload stops the current upload and requeues the file at the beginning of the queue.
// If nothing is currently uploading then nothing happens.
SWFUpload.prototype.stopUpload = function () {
	this.callFlash("StopUpload");
};

/* ************************
 * Settings methods
 *   These methods change the SWFUpload settings.
 *   SWFUpload settings should not be changed directly on the settings object
 *   since many of the settings need to be passed to Flash in order to take
 *   effect.
 * *********************** */

// Public: getStats gets the file statistics object.
SWFUpload.prototype.getStats = function () {
	return this.callFlash("GetStats");
};

// Public: setStats changes the SWFUpload statistics.  You shouldn't need to 
// change the statistics but you can.  Changing the statistics does not
// affect SWFUpload accept for the successful_uploads count which is used
// by the upload_limit setting to determine how many files the user may upload.
SWFUpload.prototype.setStats = function (statsObject) {
	this.callFlash("SetStats", [statsObject]);
};

// Public: getFile retrieves a File object by ID or Index.  If the file is
// not found then 'null' is returned.
SWFUpload.prototype.getFile = function (fileID) {
	if (typeof(fileID) === "number") {
		return this.callFlash("GetFileByIndex", [fileID]);
	} else {
		return this.callFlash("GetFile", [fileID]);
	}
};

// Public: addFileParam sets a name/value pair that will be posted with the
// file specified by the Files ID.  If the name already exists then the
// exiting value will be overwritten.
SWFUpload.prototype.addFileParam = function (fileID, name, value) {
	return this.callFlash("AddFileParam", [fileID, name, value]);
};

// Public: removeFileParam removes a previously set (by addFileParam) name/value
// pair from the specified file.
SWFUpload.prototype.removeFileParam = function (fileID, name) {
	this.callFlash("RemoveFileParam", [fileID, name]);
};

// Public: setUploadUrl changes the upload_url setting.
SWFUpload.prototype.setUploadURL = function (url) {
	this.settings.upload_url = url.toString();
	this.callFlash("SetUploadURL", [url]);
};

// Public: setPostParams changes the post_params setting
SWFUpload.prototype.setPostParams = function (paramsObject) {
	this.settings.post_params = paramsObject;
	this.callFlash("SetPostParams", [paramsObject]);
};

// Public: addPostParam adds post name/value pair.  Each name can have only one value.
SWFUpload.prototype.addPostParam = function (name, value) {
	this.settings.post_params[name] = value;
	this.callFlash("SetPostParams", [this.settings.post_params]);
};

// Public: removePostParam deletes post name/value pair.
SWFUpload.prototype.removePostParam = function (name) {
	delete this.settings.post_params[name];
	this.callFlash("SetPostParams", [this.settings.post_params]);
};

// Public: setFileTypes changes the file_types setting and the file_types_description setting
SWFUpload.prototype.setFileTypes = function (types, description) {
	this.settings.file_types = types;
	this.settings.file_types_description = description;
	this.callFlash("SetFileTypes", [types, description]);
};

// Public: setFileSizeLimit changes the file_size_limit setting
SWFUpload.prototype.setFileSizeLimit = function (fileSizeLimit) {
	this.settings.file_size_limit = fileSizeLimit;
	this.callFlash("SetFileSizeLimit", [fileSizeLimit]);
};

// Public: setFileUploadLimit changes the file_upload_limit setting
SWFUpload.prototype.setFileUploadLimit = function (fileUploadLimit) {
	this.settings.file_upload_limit = fileUploadLimit;
	this.callFlash("SetFileUploadLimit", [fileUploadLimit]);
};

// Public: setFileQueueLimit changes the file_queue_limit setting
SWFUpload.prototype.setFileQueueLimit = function (fileQueueLimit) {
	this.settings.file_queue_limit = fileQueueLimit;
	this.callFlash("SetFileQueueLimit", [fileQueueLimit]);
};

// Public: setFilePostName changes the file_post_name setting
SWFUpload.prototype.setFilePostName = function (filePostName) {
	this.settings.file_post_name = filePostName;
	this.callFlash("SetFilePostName", [filePostName]);
};

// Public: setUseQueryString changes the use_query_string setting
SWFUpload.prototype.setUseQueryString = function (useQueryString) {
	this.settings.use_query_string = useQueryString;
	this.callFlash("SetUseQueryString", [useQueryString]);
};

// Public: setRequeueOnError changes the requeue_on_error setting
SWFUpload.prototype.setRequeueOnError = function (requeueOnError) {
	this.settings.requeue_on_error = requeueOnError;
	this.callFlash("SetRequeueOnError", [requeueOnError]);
};

// Public: setHTTPSuccess changes the http_success setting
SWFUpload.prototype.setHTTPSuccess = function (http_status_codes) {
	if (typeof http_status_codes === "string") {
		http_status_codes = http_status_codes.replace(" ", "").split(",");
	}
	
	this.settings.http_success = http_status_codes;
	this.callFlash("SetHTTPSuccess", [http_status_codes]);
};

// Public: setHTTPSuccess changes the http_success setting
SWFUpload.prototype.setAssumeSuccessTimeout = function (timeout_seconds) {
	this.settings.assume_success_timeout = timeout_seconds;
	this.callFlash("SetAssumeSuccessTimeout", [timeout_seconds]);
};

// Public: setDebugEnabled changes the debug_enabled setting
SWFUpload.prototype.setDebugEnabled = function (debugEnabled) {
	this.settings.debug_enabled = debugEnabled;
	this.callFlash("SetDebugEnabled", [debugEnabled]);
};

// Public: setButtonImageURL loads a button image sprite
SWFUpload.prototype.setButtonImageURL = function (buttonImageURL) {
	if (buttonImageURL == undefined) {
		buttonImageURL = "";
	}
	
	this.settings.button_image_url = buttonImageURL;
	this.callFlash("SetButtonImageURL", [buttonImageURL]);
};

// Public: setButtonDimensions resizes the Flash Movie and button
SWFUpload.prototype.setButtonDimensions = function (width, height) {
	this.settings.button_width = width;
	this.settings.button_height = height;
	
	var movie = this.getMovieElement();
	if (movie != undefined) {
		movie.style.width = width + "px";
		movie.style.height = height + "px";
	}
	
	this.callFlash("SetButtonDimensions", [width, height]);
};
// Public: setButtonText Changes the text overlaid on the button
SWFUpload.prototype.setButtonText = function (html) {
	this.settings.button_text = html;
	this.callFlash("SetButtonText", [html]);
};
// Public: setButtonTextPadding changes the top and left padding of the text overlay
SWFUpload.prototype.setButtonTextPadding = function (left, top) {
	this.settings.button_text_top_padding = top;
	this.settings.button_text_left_padding = left;
	this.callFlash("SetButtonTextPadding", [left, top]);
};

// Public: setButtonTextStyle changes the CSS used to style the HTML/Text overlaid on the button
SWFUpload.prototype.setButtonTextStyle = function (css) {
	this.settings.button_text_style = css;
	this.callFlash("SetButtonTextStyle", [css]);
};
// Public: setButtonDisabled disables/enables the button
SWFUpload.prototype.setButtonDisabled = function (isDisabled) {
	this.settings.button_disabled = isDisabled;
	this.callFlash("SetButtonDisabled", [isDisabled]);
};
// Public: setButtonAction sets the action that occurs when the button is clicked
SWFUpload.prototype.setButtonAction = function (buttonAction) {
	this.settings.button_action = buttonAction;
	this.callFlash("SetButtonAction", [buttonAction]);
};

// Public: setButtonCursor changes the mouse cursor displayed when hovering over the button
SWFUpload.prototype.setButtonCursor = function (cursor) {
	this.settings.button_cursor = cursor;
	this.callFlash("SetButtonCursor", [cursor]);
};

/* *******************************
	Flash Event Interfaces
	These functions are used by Flash to trigger the various
	events.
	
	All these functions a Private.
	
	Because the ExternalInterface library is buggy the event calls
	are added to a queue and the queue then executed by a setTimeout.
	This ensures that events are executed in a determinate order and that
	the ExternalInterface bugs are avoided.
******************************* */

SWFUpload.prototype.queueEvent = function (handlerName, argumentArray) {
	// Warning: Don't call this.debug inside here or you'll create an infinite loop
	
	if (argumentArray == undefined) {
		argumentArray = [];
	} else if (!(argumentArray instanceof Array)) {
		argumentArray = [argumentArray];
	}
	
	var self = this;
	if (typeof this.settings[handlerName] === "function") {
		// Queue the event
		this.eventQueue.push(function () {
			this.settings[handlerName].apply(this, argumentArray);
		});
		
		// Execute the next queued event
		setTimeout(function () {
			self.executeNextEvent();
		}, 0);
		
	} else if (this.settings[handlerName] !== null) {
		throw "Event handler " + handlerName + " is unknown or is not a function";
	}
};

// Private: Causes the next event in the queue to be executed.  Since events are queued using a setTimeout
// we must queue them in order to garentee that they are executed in order.
SWFUpload.prototype.executeNextEvent = function () {
	// Warning: Don't call this.debug inside here or you'll create an infinite loop

	var  f = this.eventQueue ? this.eventQueue.shift() : null;
	if (typeof(f) === "function") {
		f.apply(this);
	}
};

// Private: unescapeFileParams is part of a workaround for a flash bug where objects passed through ExternalInterface cannot have
// properties that contain characters that are not valid for JavaScript identifiers. To work around this
// the Flash Component escapes the parameter names and we must unescape again before passing them along.
SWFUpload.prototype.unescapeFilePostParams = function (file) {
	var reg = /[$]([0-9a-f]{4})/i;
	var unescapedPost = {};
	var uk;

	if (file != undefined) {
		for (var k in file.post) {
			if (file.post.hasOwnProperty(k)) {
				uk = k;
				var match;
				while ((match = reg.exec(uk)) !== null) {
					uk = uk.replace(match[0], String.fromCharCode(parseInt("0x" + match[1], 16)));
				}
				unescapedPost[uk] = file.post[k];
			}
		}

		file.post = unescapedPost;
	}

	return file;
};

// Private: Called by Flash to see if JS can call in to Flash (test if External Interface is working)
SWFUpload.prototype.testExternalInterface = function () {
	try {
		return this.callFlash("TestExternalInterface");
	} catch (ex) {
		return false;
	}
};

// Private: This event is called by Flash when it has finished loading. Don't modify this.
// Use the swfupload_loaded_handler event setting to execute custom code when SWFUpload has loaded.
SWFUpload.prototype.flashReady = function () {
	// Check that the movie element is loaded correctly with its ExternalInterface methods defined
	var movieElement = this.getMovieElement();

	if (!movieElement) {
		this.debug("Flash called back ready but the flash movie can't be found.");
		return;
	}

	this.cleanUp(movieElement);
	
	this.queueEvent("swfupload_loaded_handler");
};

// Private: removes Flash added fuctions to the DOM node to prevent memory leaks in IE.
// This function is called by Flash each time the ExternalInterface functions are created.
SWFUpload.prototype.cleanUp = function (movieElement) {
	// Pro-actively unhook all the Flash functions
	try {
		if (this.movieElement && typeof(movieElement.CallFunction) === "unknown") { // We only want to do this in IE
			this.debug("Removing Flash functions hooks (this should only run in IE and should prevent memory leaks)");
			for (var key in movieElement) {
				try {
					if (typeof(movieElement[key]) === "function") {
						movieElement[key] = null;
					}
				} catch (ex) {
				}
			}
		}
	} catch (ex1) {
	
	}

	// Fix Flashes own cleanup code so if the SWFMovie was removed from the page
	// it doesn't display errors.
	window["__flash__removeCallback"] = function (instance, name) {
		try {
			if (instance) {
				instance[name] = null;
			}
		} catch (flashEx) {
		
		}
	};

};


/* This is a chance to do something before the browse window opens */
SWFUpload.prototype.fileDialogStart = function () {
	this.queueEvent("file_dialog_start_handler");
};


/* Called when a file is successfully added to the queue. */
SWFUpload.prototype.fileQueued = function (file) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("file_queued_handler", file);
};


/* Handle errors that occur when an attempt to queue a file fails. */
SWFUpload.prototype.fileQueueError = function (file, errorCode, message) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("file_queue_error_handler", [file, errorCode, message]);
};

/* Called after the file dialog has closed and the selected files have been queued.
	You could call startUpload here if you want the queued files to begin uploading immediately. */
SWFUpload.prototype.fileDialogComplete = function (numFilesSelected, numFilesQueued, numFilesInQueue) {
	this.queueEvent("file_dialog_complete_handler", [numFilesSelected, numFilesQueued, numFilesInQueue]);
};

SWFUpload.prototype.uploadStart = function (file) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("return_upload_start_handler", file);
};

SWFUpload.prototype.returnUploadStart = function (file) {
	var returnValue;
	if (typeof this.settings.upload_start_handler === "function") {
		file = this.unescapeFilePostParams(file);
		returnValue = this.settings.upload_start_handler.call(this, file);
	} else if (this.settings.upload_start_handler != undefined) {
		throw "upload_start_handler must be a function";
	}

	// Convert undefined to true so if nothing is returned from the upload_start_handler it is
	// interpretted as 'true'.
	if (returnValue === undefined) {
		returnValue = true;
	}
	
	returnValue = !!returnValue;
	
	this.callFlash("ReturnUploadStart", [returnValue]);
};



SWFUpload.prototype.uploadProgress = function (file, bytesComplete, bytesTotal) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("upload_progress_handler", [file, bytesComplete, bytesTotal]);
};

SWFUpload.prototype.uploadError = function (file, errorCode, message) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("upload_error_handler", [file, errorCode, message]);
};

SWFUpload.prototype.uploadSuccess = function (file, serverData, responseReceived) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("upload_success_handler", [file, serverData, responseReceived]);
};

SWFUpload.prototype.uploadComplete = function (file) {
	file = this.unescapeFilePostParams(file);
	this.queueEvent("upload_complete_handler", file);
};

/* Called by SWFUpload JavaScript and Flash functions when debug is enabled. By default it writes messages to the
   internal debug console.  You can override this event and have messages written where you want. */
SWFUpload.prototype.debug = function (message) {
	this.queueEvent("debug_handler", message);
};


/* **********************************
	Debug Console
	The debug console is a self contained, in page location
	for debug message to be sent.  The Debug Console adds
	itself to the body if necessary.

	The console is automatically scrolled as messages appear.
	
	If you are using your own debug handler or when you deploy to production and
	have debug disabled you can remove these functions to reduce the file size
	and complexity.
********************************** */
   
// Private: debugMessage is the default debug_handler.  If you want to print debug messages
// call the debug() function.  When overriding the function your own function should
// check to see if the debug setting is true before outputting debug information.
SWFUpload.prototype.debugMessage = function (message) {
	if (this.settings.debug) {
		var exceptionMessage, exceptionValues = [];

		// Check for an exception object and print it nicely
		if (typeof message === "object" && typeof message.name === "string" && typeof message.message === "string") {
			for (var key in message) {
				if (message.hasOwnProperty(key)) {
					exceptionValues.push(key + ": " + message[key]);
				}
			}
			exceptionMessage = exceptionValues.join("\n") || "";
			exceptionValues = exceptionMessage.split("\n");
			exceptionMessage = "EXCEPTION: " + exceptionValues.join("\nEXCEPTION: ");
			SWFUpload.Console.writeLine(exceptionMessage);
		} else {
			SWFUpload.Console.writeLine(message);
		}
	}
};

SWFUpload.Console = {};
SWFUpload.Console.writeLine = function (message) {
	var console, documentForm;

	try {
		console = document.getElementById("SWFUpload_Console");

		if (!console) {
			documentForm = document.createElement("form");
			document.getElementsByTagName("body")[0].appendChild(documentForm);

			console = document.createElement("textarea");
			console.id = "SWFUpload_Console";
			console.style.fontFamily = "monospace";
			console.setAttribute("wrap", "off");
			console.wrap = "off";
			console.style.overflow = "auto";
			console.style.width = "700px";
			console.style.height = "350px";
			console.style.margin = "5px";
			documentForm.appendChild(console);
		}

		console.value += message + "\n";

		console.scrollTop = console.scrollHeight - console.clientHeight;
	} catch (ex) {
		alert("Exception: " + ex.name + " Message: " + ex.message);
	}
};

/*
	Cookie Plug-in
	
	This plug in automatically gets all the cookies for this site and adds them to the post_params.
	Cookies are loaded only on initialization.  The refreshCookies function can be called to update the post_params.
	The cookies will override any other post params with the same name.
*/

var SWFUpload;
if (typeof(SWFUpload) === "function") {
	SWFUpload.prototype.initSettings = function (oldInitSettings) {
		return function () {
			if (typeof(oldInitSettings) === "function") {
				oldInitSettings.call(this);
			}
			
			this.refreshCookies(false);	// The false parameter must be sent since SWFUpload has not initialzed at this point
		};
	}(SWFUpload.prototype.initSettings);
	
	// refreshes the post_params and updates SWFUpload.  The sendToFlash parameters is optional and defaults to True
	SWFUpload.prototype.refreshCookies = function (sendToFlash) {
		if (sendToFlash === undefined) {
			sendToFlash = true;
		}
		sendToFlash = !!sendToFlash;
		
		// Get the post_params object
		var postParams = this.settings.post_params;
		
		// Get the cookies
		var i, cookieArray = document.cookie.split(';'), caLength = cookieArray.length, c, eqIndex, name, value;
		for (i = 0; i < caLength; i++) {
			c = cookieArray[i];
			
			// Left Trim spaces
			while (c.charAt(0) === " ") {
				c = c.substring(1, c.length);
			}
			eqIndex = c.indexOf("=");
			if (eqIndex > 0) {
				name = c.substring(0, eqIndex);
				value = c.substring(eqIndex + 1);
				postParams[name] = value;
			}
		}
		
		if (sendToFlash) {
			this.setPostParams(postParams);
		}
	};

}

/*
	Queue Plug-in
	
	Features:
		*Adds a cancelQueue() method for cancelling the entire queue.
		*All queued files are uploaded when startUpload() is called.
		*If false is returned from uploadComplete then the queue upload is stopped.
		 If false is not returned (strict comparison) then the queue upload is continued.
		*Adds a QueueComplete event that is fired when all the queued files have finished uploading.
		 Set the event handler with the queue_complete_handler setting.
		
	*/

var SWFUpload;
if (typeof(SWFUpload) === "function") {
	SWFUpload.queue = {};
	
	SWFUpload.prototype.initSettings = (function (oldInitSettings) {
		return function () {
			if (typeof(oldInitSettings) === "function") {
				oldInitSettings.call(this);
			}
			
			this.queueSettings = {};
			
			this.queueSettings.queue_cancelled_flag = false;
			this.queueSettings.queue_upload_count = 0;
			
			this.queueSettings.user_upload_complete_handler = this.settings.upload_complete_handler;
			this.queueSettings.user_upload_start_handler = this.settings.upload_start_handler;
			this.settings.upload_complete_handler = SWFUpload.queue.uploadCompleteHandler;
			this.settings.upload_start_handler = SWFUpload.queue.uploadStartHandler;
			
			this.settings.queue_complete_handler = this.settings.queue_complete_handler || null;
		};
	})(SWFUpload.prototype.initSettings);

	SWFUpload.prototype.startUpload = function (fileID) {
		this.queueSettings.queue_cancelled_flag = false;
		this.callFlash("StartUpload", [fileID]);
	};

	SWFUpload.prototype.cancelQueue = function () {
		this.queueSettings.queue_cancelled_flag = true;
		this.stopUpload();
		
		var stats = this.getStats();
		while (stats.files_queued > 0) {
			this.cancelUpload();
			stats = this.getStats();
		}
	};
	
	SWFUpload.queue.uploadStartHandler = function (file) {
		var returnValue;
		if (typeof(this.queueSettings.user_upload_start_handler) === "function") {
			returnValue = this.queueSettings.user_upload_start_handler.call(this, file);
		}
		
		// To prevent upload a real "FALSE" value must be returned, otherwise default to a real "TRUE" value.
		returnValue = (returnValue === false) ? false : true;
		
		this.queueSettings.queue_cancelled_flag = !returnValue;

		return returnValue;
	};
	
	SWFUpload.queue.uploadCompleteHandler = function (file) {
		var user_upload_complete_handler = this.queueSettings.user_upload_complete_handler;
		var continueUpload;
		
		if (file.filestatus === SWFUpload.FILE_STATUS.COMPLETE) {
			this.queueSettings.queue_upload_count++;
		}

		if (typeof(user_upload_complete_handler) === "function") {
			continueUpload = (user_upload_complete_handler.call(this, file) === false) ? false : true;
		} else if (file.filestatus === SWFUpload.FILE_STATUS.QUEUED) {
			// If the file was stopped and re-queued don't restart the upload
			continueUpload = false;
		} else {
			continueUpload = true;
		}
		
		if (continueUpload) {
			var stats = this.getStats();
			if (stats.files_queued > 0 && this.queueSettings.queue_cancelled_flag === false) {
				this.startUpload();
			} else if (this.queueSettings.queue_cancelled_flag === false) {
				this.queueEvent("queue_complete_handler", [this.queueSettings.queue_upload_count]);
				this.queueSettings.queue_upload_count = 0;
			} else {
				this.queueSettings.queue_cancelled_flag = false;
				this.queueSettings.queue_upload_count = 0;
			}
		}
	};
}
/*
	Speed Plug-in
	
	Features:
		*Adds several properties to the 'file' object indicated upload speed, time left, upload time, etc.
			- currentSpeed -- String indicating the upload speed, bytes per second
			- averageSpeed -- Overall average upload speed, bytes per second
			- movingAverageSpeed -- Speed over averaged over the last several measurements, bytes per second
			- timeRemaining -- Estimated remaining upload time in seconds
			- timeElapsed -- Number of seconds passed for this upload
			- percentUploaded -- Percentage of the file uploaded (0 to 100)
			- sizeUploaded -- Formatted size uploaded so far, bytes
		
		*Adds setting 'moving_average_history_size' for defining the window size used to calculate the moving average speed.
		
		*Adds several Formatting functions for formatting that values provided on the file object.
			- SWFUpload.speed.formatBPS(bps) -- outputs string formatted in the best units (Gbps, Mbps, Kbps, bps)
			- SWFUpload.speed.formatTime(seconds) -- outputs string formatted in the best units (x Hr y M z S)
			- SWFUpload.speed.formatSize(bytes) -- outputs string formatted in the best units (w GB x MB y KB z B )
			- SWFUpload.speed.formatPercent(percent) -- outputs string formatted with a percent sign (x.xx %)
			- SWFUpload.speed.formatUnits(baseNumber, divisionArray, unitLabelArray, fractionalBoolean)
				- Formats a number using the division array to determine how to apply the labels in the Label Array
				- factionalBoolean indicates whether the number should be returned as a single fractional number with a unit (speed)
				    or as several numbers labeled with units (time)
	*/

var SWFUpload;
if (typeof(SWFUpload) === "function") {
	SWFUpload.speed = {};
	
	SWFUpload.prototype.initSettings = (function (oldInitSettings) {
		return function () {
			if (typeof(oldInitSettings) === "function") {
				oldInitSettings.call(this);
			}
			
			this.ensureDefault = function (settingName, defaultValue) {
				this.settings[settingName] = (this.settings[settingName] == undefined) ? defaultValue : this.settings[settingName];
			};

			// List used to keep the speed stats for the files we are tracking
			this.fileSpeedStats = {};
			this.speedSettings = {};

			this.ensureDefault("moving_average_history_size", "10");
			
			this.speedSettings.user_file_queued_handler = this.settings.file_queued_handler;
			this.speedSettings.user_file_queue_error_handler = this.settings.file_queue_error_handler;
			this.speedSettings.user_upload_start_handler = this.settings.upload_start_handler;
			this.speedSettings.user_upload_error_handler = this.settings.upload_error_handler;
			this.speedSettings.user_upload_progress_handler = this.settings.upload_progress_handler;
			this.speedSettings.user_upload_success_handler = this.settings.upload_success_handler;
			this.speedSettings.user_upload_complete_handler = this.settings.upload_complete_handler;
			
			this.settings.file_queued_handler = SWFUpload.speed.fileQueuedHandler;
			this.settings.file_queue_error_handler = SWFUpload.speed.fileQueueErrorHandler;
			this.settings.upload_start_handler = SWFUpload.speed.uploadStartHandler;
			this.settings.upload_error_handler = SWFUpload.speed.uploadErrorHandler;
			this.settings.upload_progress_handler = SWFUpload.speed.uploadProgressHandler;
			this.settings.upload_success_handler = SWFUpload.speed.uploadSuccessHandler;
			this.settings.upload_complete_handler = SWFUpload.speed.uploadCompleteHandler;
			
			delete this.ensureDefault;
		};
	})(SWFUpload.prototype.initSettings);

	
	SWFUpload.speed.fileQueuedHandler = function (file) {
		if (typeof this.speedSettings.user_file_queued_handler === "function") {
			file = SWFUpload.speed.extendFile(file);
			
			return this.speedSettings.user_file_queued_handler.call(this, file);
		}
	};
	
	SWFUpload.speed.fileQueueErrorHandler = function (file, errorCode, message) {
		if (typeof this.speedSettings.user_file_queue_error_handler === "function") {
			file = SWFUpload.speed.extendFile(file);
			
			return this.speedSettings.user_file_queue_error_handler.call(this, file, errorCode, message);
		}
	};

	SWFUpload.speed.uploadStartHandler = function (file) {
		if (typeof this.speedSettings.user_upload_start_handler === "function") {
			file = SWFUpload.speed.extendFile(file, this.fileSpeedStats);
			return this.speedSettings.user_upload_start_handler.call(this, file);
		}
	};
	
	SWFUpload.speed.uploadErrorHandler = function (file, errorCode, message) {
		file = SWFUpload.speed.extendFile(file, this.fileSpeedStats);
		SWFUpload.speed.removeTracking(file, this.fileSpeedStats);

		if (typeof this.speedSettings.user_upload_error_handler === "function") {
			return this.speedSettings.user_upload_error_handler.call(this, file, errorCode, message);
		}
	};
	SWFUpload.speed.uploadProgressHandler = function (file, bytesComplete, bytesTotal) {
		this.updateTracking(file, bytesComplete);
		file = SWFUpload.speed.extendFile(file, this.fileSpeedStats);

		if (typeof this.speedSettings.user_upload_progress_handler === "function") {
			return this.speedSettings.user_upload_progress_handler.call(this, file, bytesComplete, bytesTotal);
		}
	};
	
	SWFUpload.speed.uploadSuccessHandler = function (file, serverData) {
		if (typeof this.speedSettings.user_upload_success_handler === "function") {
			file = SWFUpload.speed.extendFile(file, this.fileSpeedStats);
			return this.speedSettings.user_upload_success_handler.call(this, file, serverData);
		}
	};
	SWFUpload.speed.uploadCompleteHandler = function (file) {
		file = SWFUpload.speed.extendFile(file, this.fileSpeedStats);
		SWFUpload.speed.removeTracking(file, this.fileSpeedStats);

		if (typeof this.speedSettings.user_upload_complete_handler === "function") {
			return this.speedSettings.user_upload_complete_handler.call(this, file);
		}
	};
	
	// Private: extends the file object with the speed plugin values
	SWFUpload.speed.extendFile = function (file, trackingList) {
		var tracking;
		
		if (trackingList) {
			tracking = trackingList[file.id];
		}
		
		if (tracking) {
			file.currentSpeed = tracking.currentSpeed;
			file.averageSpeed = tracking.averageSpeed;
			file.movingAverageSpeed = tracking.movingAverageSpeed;
			file.timeRemaining = tracking.timeRemaining;
			file.timeElapsed = tracking.timeElapsed;
			file.percentUploaded = tracking.percentUploaded;
			file.sizeUploaded = tracking.bytesUploaded;

		} else {
			file.currentSpeed = 0;
			file.averageSpeed = 0;
			file.movingAverageSpeed = 0;
			file.timeRemaining = 0;
			file.timeElapsed = 0;
			file.percentUploaded = 0;
			file.sizeUploaded = 0;
		}
		
		return file;
	};
	
	// Private: Updates the speed tracking object, or creates it if necessary
	SWFUpload.prototype.updateTracking = function (file, bytesUploaded) {
		var tracking = this.fileSpeedStats[file.id];
		if (!tracking) {
			this.fileSpeedStats[file.id] = tracking = {};
		}
		
		// Sanity check inputs
		bytesUploaded = bytesUploaded || tracking.bytesUploaded || 0;
		if (bytesUploaded < 0) {
			bytesUploaded = 0;
		}
		if (bytesUploaded > file.size) {
			bytesUploaded = file.size;
		}
		
		var tickTime = (new Date()).getTime();
		if (!tracking.startTime) {
			tracking.startTime = (new Date()).getTime();
			tracking.lastTime = tracking.startTime;
			tracking.currentSpeed = 0;
			tracking.averageSpeed = 0;
			tracking.movingAverageSpeed = 0;
			tracking.movingAverageHistory = [];
			tracking.timeRemaining = 0;
			tracking.timeElapsed = 0;
			tracking.percentUploaded = bytesUploaded / file.size;
			tracking.bytesUploaded = bytesUploaded;
		} else if (tracking.startTime > tickTime) {
			this.debug("When backwards in time");
		} else {
			// Get time and deltas
			var now = (new Date()).getTime();
			var lastTime = tracking.lastTime;
			var deltaTime = now - lastTime;
			var deltaBytes = bytesUploaded - tracking.bytesUploaded;
			
			if (deltaBytes === 0 || deltaTime === 0) {
				return tracking;
			}
			
			// Update tracking object
			tracking.lastTime = now;
			tracking.bytesUploaded = bytesUploaded;
			
			// Calculate speeds
			tracking.currentSpeed = (deltaBytes * 8 ) / (deltaTime / 1000);
			tracking.averageSpeed = (tracking.bytesUploaded * 8) / ((now - tracking.startTime) / 1000);

			// Calculate moving average
			tracking.movingAverageHistory.push(tracking.currentSpeed);
			if (tracking.movingAverageHistory.length > this.settings.moving_average_history_size) {
				tracking.movingAverageHistory.shift();
			}
			
			tracking.movingAverageSpeed = SWFUpload.speed.calculateMovingAverage(tracking.movingAverageHistory);
			
			// Update times
			tracking.timeRemaining = (file.size - tracking.bytesUploaded) * 8 / tracking.movingAverageSpeed;
			tracking.timeElapsed = (now - tracking.startTime) / 1000;
			
			// Update percent
			tracking.percentUploaded = (tracking.bytesUploaded / file.size * 100);
		}
		
		return tracking;
	};
	SWFUpload.speed.removeTracking = function (file, trackingList) {
		try {
			trackingList[file.id] = null;
			delete trackingList[file.id];
		} catch (ex) {
		}
	};
	
	SWFUpload.speed.formatUnits = function (baseNumber, unitDivisors, unitLabels, singleFractional) {
		var i, unit, unitDivisor, unitLabel;

		if (baseNumber === 0) {
			return "0 " + unitLabels[unitLabels.length - 1];
		}
		
		if (singleFractional) {
			unit = baseNumber;
			unitLabel = unitLabels.length >= unitDivisors.length ? unitLabels[unitDivisors.length - 1] : "";
			for (i = 0; i < unitDivisors.length; i++) {
				if (baseNumber >= unitDivisors[i]) {
					unit = (baseNumber / unitDivisors[i]).toFixed(2);
					unitLabel = unitLabels.length >= i ? " " + unitLabels[i] : "";
					break;
				}
			}
			
			return unit + unitLabel;
		} else {
			var formattedStrings = [];
			var remainder = baseNumber;
			
			for (i = 0; i < unitDivisors.length; i++) {
				unitDivisor = unitDivisors[i];
				unitLabel = unitLabels.length > i ? " " + unitLabels[i] : "";
				
				unit = remainder / unitDivisor;
				if (i < unitDivisors.length -1) {
					unit = Math.floor(unit);
				} else {
					unit = unit.toFixed(2);
				}
				if (unit > 0) {
					remainder = remainder % unitDivisor;
					
					formattedStrings.push(unit + unitLabel);
				}
			}
			
			return formattedStrings.join(" ");
		}
	};
	
	SWFUpload.speed.formatBPS = function (baseNumber) {
		var bpsUnits = [1073741824, 1048576, 1024, 1], bpsUnitLabels = ["Gbps", "Mbps", "Kbps", "bps"];
		return SWFUpload.speed.formatUnits(baseNumber, bpsUnits, bpsUnitLabels, true);
	
	};
	SWFUpload.speed.formatTime = function (baseNumber) {
		var timeUnits = [86400, 3600, 60, 1], timeUnitLabels = ["d", "h", "m", "s"];
		return SWFUpload.speed.formatUnits(baseNumber, timeUnits, timeUnitLabels, false);
	
	};
	SWFUpload.speed.formatBytes = function (baseNumber) {
		var sizeUnits = [1073741824, 1048576, 1024, 1], sizeUnitLabels = ["GB", "MB", "KB", "bytes"];
		return SWFUpload.speed.formatUnits(baseNumber, sizeUnits, sizeUnitLabels, true);
	
	};
	SWFUpload.speed.formatPercent = function (baseNumber) {
		return baseNumber.toFixed(2) + " %";
	};
	
	SWFUpload.speed.calculateMovingAverage = function (history) {
		var vals = [], size, sum = 0.0, mean = 0.0, varianceTemp = 0.0, variance = 0.0, standardDev = 0.0;
		var i;
		var mSum = 0, mCount = 0;
		
		size = history.length;
		
		// Check for sufficient data
		if (size >= 8) {
			// Clone the array and Calculate sum of the values 
			for (i = 0; i < size; i++) {
				vals[i] = history[i];
				sum += vals[i];
			}

			mean = sum / size;

			// Calculate variance for the set
			for (i = 0; i < size; i++) {
				varianceTemp += Math.pow((vals[i] - mean), 2);
			}

			variance = varianceTemp / size;
			standardDev = Math.sqrt(variance);
			
			//Standardize the Data
			for (i = 0; i < size; i++) {
				vals[i] = (vals[i] - mean) / standardDev;
			}

			// Calculate the average excluding outliers
			var deviationRange = 2.0;
			for (i = 0; i < size; i++) {
				
				if (vals[i] <= deviationRange && vals[i] >= -deviationRange) {
					mCount++;
					mSum += history[i];
				}
			}
			
		} else {
			// Calculate the average (not enough data points to remove outliers)
			mCount = size;
			for (i = 0; i < size; i++) {
				mSum += history[i];
			}
		}

		return mSum / mCount;
	};
	
}
/*
	A simple class for displaying file information and progress
	Note: This is a demonstration only and not part of SWFUpload.
	Note: Some have had problems adapting this class in IE7. It may not be suitable for your application.
*/

// Constructor
// file is a SWFUpload file object
// targetID is the HTML element id attribute that the FileProgress HTML structure will be added to.
// Instantiating a new FileProgress object with an existing file will reuse/update the existing DOM elements
function FileProgress(file, targetID) {
	this.fileProgressID = file.id;

	this.opacity = 100;
	this.height = 0;
	

	this.fileProgressWrapper = document.getElementById(this.fileProgressID);
	if (!this.fileProgressWrapper) {
		this.fileProgressWrapper = document.createElement("div");
		this.fileProgressWrapper.className = "progressWrapper";
		this.fileProgressWrapper.id = this.fileProgressID;

		this.fileProgressElement = document.createElement("div");
		this.fileProgressElement.className = "progressContainer";

		var progressCancel = document.createElement("a");
		progressCancel.className = "progressCancel";
		progressCancel.href = "#";
		progressCancel.style.visibility = "hidden";
		progressCancel.appendChild(document.createTextNode(" "));

		var progressText = document.createElement("div");
		progressText.className = "progressName";
		progressText.appendChild(document.createTextNode(file.name));

		var progressBar = document.createElement("div");
		progressBar.className = "progressBarInProgress";

		var progressStatus = document.createElement("div");
		progressStatus.className = "progressBarStatus";
		progressStatus.innerHTML = "&nbsp;";

		this.fileProgressElement.appendChild(progressCancel);
		this.fileProgressElement.appendChild(progressText);
		this.fileProgressElement.appendChild(progressStatus);
		this.fileProgressElement.appendChild(progressBar);

		this.fileProgressWrapper.appendChild(this.fileProgressElement);

		document.getElementById(targetID).appendChild(this.fileProgressWrapper);
	} else {
		this.fileProgressElement = this.fileProgressWrapper.firstChild;
		this.reset();
	}

	this.height = this.fileProgressWrapper.offsetHeight;
	this.setTimer(null);


}

FileProgress.prototype.setTimer = function (timer) {
	this.fileProgressElement["FP_TIMER"] = timer;
};
FileProgress.prototype.getTimer = function (timer) {
	return this.fileProgressElement["FP_TIMER"] || null;
};

FileProgress.prototype.reset = function () {
	this.fileProgressElement.className = "progressContainer";

	this.fileProgressElement.childNodes[2].innerHTML = "&nbsp;";
	this.fileProgressElement.childNodes[2].className = "progressBarStatus";
	
	this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	this.fileProgressElement.childNodes[3].style.width = "0%";
	
	this.appear();	
};

FileProgress.prototype.setProgress = function (percentage) {
	this.fileProgressElement.className = "progressContainer green";
	this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
	this.fileProgressElement.childNodes[3].style.width = percentage + "%";

	this.appear();	
};
FileProgress.prototype.setComplete = function () {
	this.fileProgressElement.className = "progressContainer blue";
	this.fileProgressElement.childNodes[3].className = "progressBarComplete";
	this.fileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 10000));
};
FileProgress.prototype.setError = function () {
	this.fileProgressElement.className = "progressContainer red";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 5000));
};
FileProgress.prototype.setCancelled = function () {
	this.fileProgressElement.className = "progressContainer";
	this.fileProgressElement.childNodes[3].className = "progressBarError";
	this.fileProgressElement.childNodes[3].style.width = "";

	var oSelf = this;
	this.setTimer(setTimeout(function () {
		oSelf.disappear();
	}, 2000));
};
FileProgress.prototype.setStatus = function (status) {
	this.fileProgressElement.childNodes[2].innerHTML = status;
};

// Show/Hide the cancel button
FileProgress.prototype.toggleCancel = function (show, swfUploadInstance) {
	this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
	if (swfUploadInstance) {
		var fileID = this.fileProgressID;
		this.fileProgressElement.childNodes[0].onclick = function () {
			swfUploadInstance.cancelUpload(fileID);
			return false;
		};
	}
};

FileProgress.prototype.appear = function () {
	if (this.getTimer() !== null) {
		clearTimeout(this.getTimer());
		this.setTimer(null);
	}
	
	if (this.fileProgressWrapper.filters) {
		try {
			this.fileProgressWrapper.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 100;
		} catch (e) {
			// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
			this.fileProgressWrapper.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=100)";
		}
	} else {
		this.fileProgressWrapper.style.opacity = 1;
	}
		
	this.fileProgressWrapper.style.height = "";
	
	this.height = this.fileProgressWrapper.offsetHeight;
	this.opacity = 100;
	this.fileProgressWrapper.style.display = "";
	
};

// Fades out and clips away the FileProgress box.
FileProgress.prototype.disappear = function () {

	var reduceOpacityBy = 15;
	var reduceHeightBy = 4;
	var rate = 30;	// 15 fps

	if (this.opacity > 0) {
		this.opacity -= reduceOpacityBy;
		if (this.opacity < 0) {
			this.opacity = 0;
		}

		if (this.fileProgressWrapper.filters) {
			try {
				this.fileProgressWrapper.filters.item("DXImageTransform.Microsoft.Alpha").opacity = this.opacity;
			} catch (e) {
				// If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
				this.fileProgressWrapper.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=" + this.opacity + ")";
			}
		} else {
			this.fileProgressWrapper.style.opacity = this.opacity / 100;
		}
	}

	if (this.height > 0) {
		this.height -= reduceHeightBy;
		if (this.height < 0) {
			this.height = 0;
		}

		this.fileProgressWrapper.style.height = this.height + "px";
	}

	if (this.height > 0 || this.opacity > 0) {
		var oSelf = this;
		this.setTimer(setTimeout(function () {
			oSelf.disappear();
		}, rate));
	} else {
		this.fileProgressWrapper.style.display = "none";
		this.setTimer(null);
	}
};
/* Demo Note:  This demo uses a FileProgress class that handles the UI for displaying the file name and percent complete.
The FileProgress class is not part of SWFUpload.
*/


/* **********************
   Event Handlers
   These are my custom event handlers to make my
   web application behave the way I went when SWFUpload
   completes different tasks.  These aren't part of the SWFUpload
   package.  They are part of my application.  Without these none
   of the actions SWFUpload makes will show up in my application.
   ********************** */
function fileQueued(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus( ultimix.get_string( "pending" ) );
		progress.toggleCancel(true, this);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
			return;
		}

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			progress.setStatus( ultimix.get_string( "file_is_too_big" ));
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			progress.setStatus( ultimix.get_string( "cannot_upload_zero_bytes" ) );
			this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			progress.setStatus( ultimix.get_string( "invalid_file_type" ) );
			this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		default:
			if (file !== null) {
				progress.setStatus( ultimix.get_string( "unhandled_error" ) );
			}
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesSelected > 0) {
			document.getElementById(this.customSettings.cancelButtonId).disabled = false;
		}
		
		/* I want auto start the upload and I can do that here */
		this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		/* I don't want to do any file validation or anything,  I'll just update the UI and
		return true to indicate that the upload should start.
		It's important to update the UI here because in Linux no uploadProgress events are called. The best
		we can do is say we are uploading.
		 */
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus( ultimix.get_string( 'uploading' ) );
		progress.toggleCancel(true, this);
	}
	catch (ex) {}
	
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setProgress(percent);
		progress.setStatus( ultimix.get_string( 'uploading' ) );
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setComplete();
		progress.setStatus( ultimix.get_string( 'complete' ) );
		progress.toggleCancel(false);

	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			progress.setStatus( ultimix.get_string( "upload_error" ) + message );
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			progress.setStatus( ultimix.get_string( "upload_failed" ) );
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus( ultimix.get_string( "server_io_error" ) ) ;
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus( ultimix.get_string( "security_error" ) );
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			progress.setStatus( ultimix.get_string( "upload_limit" ) );
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			progress.setStatus( ultimix.get_string( "failed_validation" ) );
			this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			/* If there aren't any files left (they were all cancelled) disable the cancel button */
			if (this.getStats().files_queued === 0) {
				document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			progress.setStatus( ultimix.get_string( "cancelled" ) );
			progress.setCancelled();
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus( ultimix.get_string( "stopped" ) );
			break;
		default:
			progress.setStatus( ultimix.get_string( "unhandled_error" ) + ": " + errorCode);
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
	if (this.getStats().files_queued === 0) {
		document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

/* This event comes from the Queue Plugin */
function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	status.innerHTML = numFilesUploaded + " file" + (numFilesUploaded === 1 ? "" : "s") + " uploaded.";
}

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.file_input )
{
	ultimix.file_input = {};
}

/**
*	Function updates control after upload.
*
*	@param ServerDataObject - Uploaded file description object.
*
*	@param ControlSettings - Upload file control settings.
*
*	@author Dodonov A.A.
*/
ultimix.file_input.SetSingleUploadedFileInfo = function( ServerDataObject , ControlSettings )
{
	jQuery( '#' + ControlSettings.statusAcceptor ).html(
		ServerDataObject.original_file_name
	);
	
	jQuery( '#' + ControlSettings.dataAcceptor ).html( 
		"<input type=\"hidden\" name=\"" + ControlSettings.name + "\" value=\"" + ServerDataObject.id + "\">" +
		"<input type=\"hidden\" name=\"visible_" + ControlSettings.name + "\" value=\"" + 
		ServerDataObject.original_file_name+ "\">"
	);
}

/**
*	Upload success event handler.
*
*	@param File - File description object.
*
*	@param ServerData - Data received from the server.
*
*	@param ReceivedResponse - Was the response received.
*
*	@author Dodonov A.A.
*/
ultimix_file_input_view_AfterImageUploadProcessor = function( File , ServerData , ReceivedResponse )
{
	try
	{
		var Progress = new FileProgress( File , this.customSettings.progressTarget );
		Progress.setComplete();
		Progress.setStatus( ultimix.get_string( 'complete' ) );
		Progress.toggleCancel( false );
		
		var ServerDataObject = {};
		eval( "ServerDataObject=" + ServerData );
		
		ultimix.file_input.SetSingleUploadedFileInfo( ServerDataObject , this.customSettings );
	}
	catch( ex )
	{
		this.debug( ex );
	}
}
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'pending' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'pending' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'pending' ][ 'default' ] = 'Отправка...';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'file_is_too_big' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'file_is_too_big' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'file_is_too_big' ][ 'default' ] = 'Файл слишком большой.';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cannot_upload_zero_bytes' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cannot_upload_zero_bytes' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cannot_upload_zero_bytes' ][ 'default' ] = 'Невозможно отправить файл нулевого размера.';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'invalid_file_type' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'invalid_file_type' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'invalid_file_type' ][ 'default' ] = 'Некорректный тип файла.';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'unhandled_error' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'unhandled_error' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'unhandled_error' ][ 'default' ] = 'Неизвестная ошибка';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_error' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_error' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_error' ][ 'default' ] = 'Ошибка загрузки: ';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_failed' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_failed' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_failed' ][ 'default' ] = 'Загрузка сорвана';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'server_io_error' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'server_io_error' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'server_io_error' ][ 'default' ] = 'Ошибка сервера';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'security_error' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'security_error' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'security_error' ][ 'default' ] = 'Ошибка безопасности';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_limit' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_limit' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'upload_limit' ][ 'default' ] = 'Предел загрузки исчерпан';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'failed_validation' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'failed_validation' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'failed_validation' ][ 'default' ] = 'Проверка не пройдена. Загрузка пропущена.';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cancelled' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cancelled' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cancelled' ][ 'default' ] = 'Отменена';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'stopped' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'stopped' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'stopped' ][ 'default' ] = 'Остановлена';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'uploading' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'uploading' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'uploading' ][ 'default' ] = 'Загрузка...';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'complete' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'complete' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'complete' ][ 'default' ] = 'Завершено';

/*
 * jsTree 1.0-rc3
 * http://jstree.com/
 *
 * Copyright (c) 2010 Ivan Bozhanov (vakata.com)
 *
 * Licensed same as jquery - under the terms of either the MIT License or the GPL Version 2 License
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * $Date: 2011-02-09 01:17:14 +0200 (ср, 09 февр 2011) $
 * $Revision: 236 $
 */

/*jslint browser: true, onevar: true, undef: true, bitwise: true, strict: true */
/*global window : false, clearInterval: false, clearTimeout: false, document: false, setInterval: false, setTimeout: false, jQuery: false, navigator: false, XSLTProcessor: false, DOMParser: false, XMLSerializer: false*/

"use strict";

// top wrapper to prevent multiple inclusion (is this OK?)
(function () { if(jQuery && jQuery.jstree) { return; }
	var is_ie6 = false, is_ie7 = false, is_ff2 = false;

/* 
 * jsTree core
 */
(function ($) {
	// Common functions not related to jsTree 
	// decided to move them to a `vakata` "namespace"
	$.vakata = {};
	// CSS related functions
	$.vakata.css = {
		get_css : function(rule_name, delete_flag, sheet) {
			rule_name = rule_name.toLowerCase();
			var css_rules = sheet.cssRules || sheet.rules,
				j = 0;
			do {
				if(css_rules.length && j > css_rules.length + 5) { return false; }
				if(css_rules[j].selectorText && css_rules[j].selectorText.toLowerCase() == rule_name) {
					if(delete_flag === true) {
						if(sheet.removeRule) { sheet.removeRule(j); }
						if(sheet.deleteRule) { sheet.deleteRule(j); }
						return true;
					}
					else { return css_rules[j]; }
				}
			}
			while (css_rules[++j]);
			return false;
		},
		add_css : function(rule_name, sheet) {
			if($.jstree.css.get_css(rule_name, false, sheet)) { return false; }
			if(sheet.insertRule) { sheet.insertRule(rule_name + ' { }', 0); } else { sheet.addRule(rule_name, null, 0); }
			return $.vakata.css.get_css(rule_name);
		},
		remove_css : function(rule_name, sheet) { 
			return $.vakata.css.get_css(rule_name, true, sheet); 
		},
		add_sheet : function(opts) {
			var tmp = false, is_new = true;
			if(opts.str) {
				if(opts.title) { tmp = $("style[id='" + opts.title + "-stylesheet']")[0]; }
				if(tmp) { is_new = false; }
				else {
					tmp = document.createElement("style");
					tmp.setAttribute('type',"text/css");
					if(opts.title) { tmp.setAttribute("id", opts.title + "-stylesheet"); }
				}
				if(tmp.styleSheet) {
					if(is_new) { 
						document.getElementsByTagName("head")[0].appendChild(tmp); 
						tmp.styleSheet.cssText = opts.str; 
					}
					else {
						tmp.styleSheet.cssText = tmp.styleSheet.cssText + " " + opts.str; 
					}
				}
				else {
					tmp.appendChild(document.createTextNode(opts.str));
					document.getElementsByTagName("head")[0].appendChild(tmp);
				}
				return tmp.sheet || tmp.styleSheet;
			}
			if(opts.url) {
				if(document.createStyleSheet) {
					try { tmp = document.createStyleSheet(opts.url); } catch (e) { }
				}
				else {
					tmp			= document.createElement('link');
					tmp.rel		= 'stylesheet';
					tmp.type	= 'text/css';
					tmp.media	= "all";
					tmp.href	= opts.url;
					document.getElementsByTagName("head")[0].appendChild(tmp);
					return tmp.styleSheet;
				}
			}
		}
	};

	// private variables 
	var instances = [],			// instance array (used by $.jstree.reference/create/focused)
		focused_instance = -1,	// the index in the instance array of the currently focused instance
		plugins = {},			// list of included plugins
		prepared_move = {};		// for the move_node function

	// jQuery plugin wrapper (thanks to jquery UI widget function)
	$.fn.jstree = function (settings) {
		var isMethodCall = (typeof settings == 'string'), // is this a method call like $().jstree("open_node")
			args = Array.prototype.slice.call(arguments, 1), 
			returnValue = this;

		// if a method call execute the method on all selected instances
		if(isMethodCall) {
			if(settings.substring(0, 1) == '_') { return returnValue; }
			this.each(function() {
				var instance = instances[$.data(this, "jstree_instance_id")],
					methodValue = (instance && $.isFunction(instance[settings])) ? instance[settings].apply(instance, args) : instance;
					if(typeof methodValue !== "undefined" && (settings.indexOf("is_") === 0 || (methodValue !== true && methodValue !== false))) { returnValue = methodValue; return false; }
			});
		}
		else {
			this.each(function() {
				// extend settings and allow for multiple hashes and $.data
				var instance_id = $.data(this, "jstree_instance_id"),
					a = [],
					b = settings ? $.extend({}, true, settings) : {},
					c = $(this), 
					s = false, 
					t = [];
				a = a.concat(args);
				if(c.data("jstree")) { a.push(c.data("jstree")); }
				b = a.length ? $.extend.apply(null, [true, b].concat(a)) : b;

				// if an instance already exists, destroy it first
				if(typeof instance_id !== "undefined" && instances[instance_id]) { instances[instance_id].destroy(); }
				// push a new empty object to the instances array
				instance_id = parseInt(instances.push({}),10) - 1;
				// store the jstree instance id to the container element
				$.data(this, "jstree_instance_id", instance_id);
				// clean up all plugins
				b.plugins = $.isArray(b.plugins) ? b.plugins : $.jstree.defaults.plugins.slice();
				b.plugins.unshift("core");
				// only unique plugins
				b.plugins = b.plugins.sort().join(",,").replace(/(,|^)([^,]+)(,,\2)+(,|$)/g,"$1$2$4").replace(/,,+/g,",").replace(/,$/,"").split(",");

				// extend defaults with passed data
				s = $.extend(true, {}, $.jstree.defaults, b);
				s.plugins = b.plugins;
				$.each(plugins, function (i, val) { 
					if($.inArray(i, s.plugins) === -1) { s[i] = null; delete s[i]; } 
					else { t.push(i); }
				});
				s.plugins = t;

				// push the new object to the instances array (at the same time set the default classes to the container) and init
				instances[instance_id] = new $.jstree._instance(instance_id, $(this).addClass("jstree jstree-" + instance_id), s); 
				// init all activated plugins for this instance
				$.each(instances[instance_id]._get_settings().plugins, function (i, val) { instances[instance_id].data[val] = {}; });
				$.each(instances[instance_id]._get_settings().plugins, function (i, val) { if(plugins[val]) { plugins[val].__init.apply(instances[instance_id]); } });
				// initialize the instance
				setTimeout(function() { if(instances[instance_id]) { instances[instance_id].init(); } }, 0);
			});
		}
		// return the jquery selection (or if it was a method call that returned a value - the returned value)
		return returnValue;
	};
	// object to store exposed functions and objects
	$.jstree = {
		defaults : {
			plugins : []
		},
		_focused : function () { return instances[focused_instance] || null; },
		_reference : function (needle) { 
			// get by instance id
			if(instances[needle]) { return instances[needle]; }
			// get by DOM (if still no luck - return null
			var o = $(needle); 
			if(!o.length && typeof needle === "string") { o = $("#" + needle); }
			if(!o.length) { return null; }
			return instances[o.closest(".jstree").data("jstree_instance_id")] || null; 
		},
		_instance : function (index, container, settings) { 
			// for plugins to store data in
			this.data = { core : {} };
			this.get_settings	= function () { return $.extend(true, {}, settings); };
			this._get_settings	= function () { return settings; };
			this.get_index		= function () { return index; };
			this.get_container	= function () { return container; };
			this.get_container_ul = function () { return container.children("ul:eq(0)"); };
			this._set_settings	= function (s) { 
				settings = $.extend(true, {}, settings, s);
			};
		},
		_fn : { },
		plugin : function (pname, pdata) {
			pdata = $.extend({}, {
				__init		: $.noop, 
				__destroy	: $.noop,
				_fn			: {},
				defaults	: false
			}, pdata);
			plugins[pname] = pdata;

			$.jstree.defaults[pname] = pdata.defaults;
			$.each(pdata._fn, function (i, val) {
				val.plugin		= pname;
				val.old			= $.jstree._fn[i];
				$.jstree._fn[i] = function () {
					var rslt,
						func = val,
						args = Array.prototype.slice.call(arguments),
						evnt = new $.Event("before.jstree"),
						rlbk = false;

					if(this.data.core.locked === true && i !== "unlock" && i !== "is_locked") { return; }

					// Check if function belongs to the included plugins of this instance
					do {
						if(func && func.plugin && $.inArray(func.plugin, this._get_settings().plugins) !== -1) { break; }
						func = func.old;
					} while(func);
					if(!func) { return; }

					// context and function to trigger events, then finally call the function
					if(i.indexOf("_") === 0) {
						rslt = func.apply(this, args);
					}
					else {
						rslt = this.get_container().triggerHandler(evnt, { "func" : i, "inst" : this, "args" : args, "plugin" : func.plugin });
						if(rslt === false) { return; }
						if(typeof rslt !== "undefined") { args = rslt; }

						rslt = func.apply(
							$.extend({}, this, { 
								__callback : function (data) { 
									this.get_container().triggerHandler( i + '.jstree', { "inst" : this, "args" : args, "rslt" : data, "rlbk" : rlbk });
								},
								__rollback : function () { 
									rlbk = this.get_rollback();
									return rlbk;
								},
								__call_old : function (replace_arguments) {
									return func.old.apply(this, (replace_arguments ? Array.prototype.slice.call(arguments, 1) : args ) );
								}
							}), args);
					}

					// return the result
					return rslt;
				};
				$.jstree._fn[i].old = val.old;
				$.jstree._fn[i].plugin = pname;
			});
		},
		rollback : function (rb) {
			if(rb) {
				if(!$.isArray(rb)) { rb = [ rb ]; }
				$.each(rb, function (i, val) {
					instances[val.i].set_rollback(val.h, val.d);
				});
			}
		}
	};
	// set the prototype for all instances
	$.jstree._fn = $.jstree._instance.prototype = {};

	// load the css when DOM is ready
	$(function() {
		// code is copied from jQuery ($.browser is deprecated + there is a bug in IE)
		var u = navigator.userAgent.toLowerCase(),
			v = (u.match( /.+?(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [0,'0'])[1],
			css_string = '' + 
				'.jstree ul, .jstree li { display:block; margin:0 0 0 0; padding:0 0 0 0; list-style-type:none; } ' + 
				'.jstree li { display:block; min-height:18px; line-height:18px; white-space:nowrap; margin-left:18px; min-width:18px; } ' + 
				'.jstree-rtl li { margin-left:0; margin-right:18px; } ' + 
				'.jstree > ul > li { margin-left:0px; } ' + 
				'.jstree-rtl > ul > li { margin-right:0px; } ' + 
				'.jstree ins { display:inline-block; text-decoration:none; width:18px; height:18px; margin:0 0 0 0; padding:0; } ' + 
				'.jstree a { display:inline-block; line-height:16px; height:16px; color:black; white-space:nowrap; text-decoration:none; padding:1px 2px; margin:0; } ' + 
				'.jstree a:focus { outline: none; } ' + 
				'.jstree a > ins { height:16px; width:16px; } ' + 
				'.jstree a > .jstree-icon { margin-right:3px; } ' + 
				'.jstree-rtl a > .jstree-icon { margin-left:3px; margin-right:0; } ' + 
				'li.jstree-open > ul { display:block; } ' + 
				'li.jstree-closed > ul { display:none; } ';
		// Correct IE 6 (does not support the > CSS selector)
		if(/msie/.test(u) && parseInt(v, 10) == 6) { 
			is_ie6 = true;

			// fix image flicker and lack of caching
			try {
				document.execCommand("BackgroundImageCache", false, true);
			} catch (err) { }

			css_string += '' + 
				'.jstree li { height:18px; margin-left:0; margin-right:0; } ' + 
				'.jstree li li { margin-left:18px; } ' + 
				'.jstree-rtl li li { margin-left:0px; margin-right:18px; } ' + 
				'li.jstree-open ul { display:block; } ' + 
				'li.jstree-closed ul { display:none !important; } ' + 
				'.jstree li a { display:inline; border-width:0 !important; padding:0px 2px !important; } ' + 
				'.jstree li a ins { height:16px; width:16px; margin-right:3px; } ' + 
				'.jstree-rtl li a ins { margin-right:0px; margin-left:3px; } ';
		}
		// Correct IE 7 (shifts anchor nodes onhover)
		if(/msie/.test(u) && parseInt(v, 10) == 7) { 
			is_ie7 = true;
			css_string += '.jstree li a { border-width:0 !important; padding:0px 2px !important; } ';
		}
		// correct ff2 lack of display:inline-block
		if(!/compatible/.test(u) && /mozilla/.test(u) && parseFloat(v, 10) < 1.9) {
			is_ff2 = true;
			css_string += '' + 
				'.jstree ins { display:-moz-inline-box; } ' + 
				'.jstree li { line-height:12px; } ' + // WHY??
				'.jstree a { display:-moz-inline-box; } ' + 
				'.jstree .jstree-no-icons .jstree-checkbox { display:-moz-inline-stack !important; } ';
				/* this shouldn't be here as it is theme specific */
		}
		// the default stylesheet
		$.vakata.css.add_sheet({ str : css_string, title : "jstree" });
	});

	// core functions (open, close, create, update, delete)
	$.jstree.plugin("core", {
		__init : function () {
			this.data.core.locked = false;
			this.data.core.to_open = this.get_settings().core.initially_open;
			this.data.core.to_load = this.get_settings().core.initially_load;
		},
		defaults : { 
			html_titles	: false,
			animation	: 500,
			initially_open : [],
			initially_load : [],
			open_parents : true,
			notify_plugins : true,
			rtl			: false,
			load_open	: false,
			strings		: {
				loading		: "Loading ...",
				new_node	: "New node",
				multiple_selection : "Multiple selection"
			}
		},
		_fn : { 
			init	: function () { 
				this.set_focus(); 
				if(this._get_settings().core.rtl) {
					this.get_container().addClass("jstree-rtl").css("direction", "rtl");
				}
				this.get_container().html("<ul><li class='jstree-last jstree-leaf'><ins>&#160;</ins><a class='jstree-loading' href='#'><ins class='jstree-icon'>&#160;</ins>" + this._get_string("loading") + "</a></li></ul>");
				this.data.core.li_height = this.get_container_ul().find("li.jstree-closed, li.jstree-leaf").eq(0).height() || 18;

				this.get_container()
					.delegate("li > ins", "click.jstree", $.proxy(function (event) {
							var trgt = $(event.target);
							// if(trgt.is("ins") && event.pageY - trgt.offset().top < this.data.core.li_height) { this.toggle_node(trgt); }
							this.toggle_node(trgt);
						}, this))
					.bind("mousedown.jstree", $.proxy(function () { 
							this.set_focus(); // This used to be setTimeout(set_focus,0) - why?
						}, this))
					.bind("dblclick.jstree", function (event) { 
						var sel;
						if(document.selection && document.selection.empty) { document.selection.empty(); }
						else {
							if(window.getSelection) {
								sel = window.getSelection();
								try { 
									sel.removeAllRanges();
									sel.collapse();
								} catch (err) { }
							}
						}
					});
				if(this._get_settings().core.notify_plugins) {
					this.get_container()
						.bind("load_node.jstree", $.proxy(function (e, data) { 
								var o = this._get_node(data.rslt.obj),
									t = this;
								if(o === -1) { o = this.get_container_ul(); }
								if(!o.length) { return; }
								o.find("li").each(function () {
									var th = $(this);
									if(th.data("jstree")) {
										$.each(th.data("jstree"), function (plugin, values) {
											if(t.data[plugin] && $.isFunction(t["_" + plugin + "_notify"])) {
												t["_" + plugin + "_notify"].call(t, th, values);
											}
										});
									}
								});
							}, this));
				}
				if(this._get_settings().core.load_open) {
					this.get_container()
						.bind("load_node.jstree", $.proxy(function (e, data) { 
								var o = this._get_node(data.rslt.obj),
									t = this;
								if(o === -1) { o = this.get_container_ul(); }
								if(!o.length) { return; }
								o.find("li.jstree-open:not(:has(ul))").each(function () {
									t.load_node(this, $.noop, $.noop);
								});
							}, this));
				}
				this.__callback();
				this.load_node(-1, function () { this.loaded(); this.reload_nodes(); });
			},
			destroy	: function () { 
				var i,
					n = this.get_index(),
					s = this._get_settings(),
					_this = this;

				$.each(s.plugins, function (i, val) {
					try { plugins[val].__destroy.apply(_this); } catch(err) { }
				});
				this.__callback();
				// set focus to another instance if this one is focused
				if(this.is_focused()) { 
					for(i in instances) { 
						if(instances.hasOwnProperty(i) && i != n) { 
							instances[i].set_focus(); 
							break; 
						} 
					}
				}
				// if no other instance found
				if(n === focused_instance) { focused_instance = -1; }
				// remove all traces of jstree in the DOM (only the ones set using jstree*) and cleans all events
				this.get_container()
					.unbind(".jstree")
					.undelegate(".jstree")
					.removeData("jstree_instance_id")
					.find("[class^='jstree']")
						.andSelf()
						.attr("class", function () { return this.className.replace(/jstree[^ ]*|$/ig,''); });
				$(document)
					.unbind(".jstree-" + n)
					.undelegate(".jstree-" + n);
				// remove the actual data
				instances[n] = null;
				delete instances[n];
			},

			_core_notify : function (n, data) {
				if(data.opened) {
					this.open_node(n, false, true);
				}
			},

			lock : function () {
				this.data.core.locked = true;
				this.get_container().children("ul").addClass("jstree-locked").css("opacity","0.7");
				this.__callback({});
			},
			unlock : function () {
				this.data.core.locked = false;
				this.get_container().children("ul").removeClass("jstree-locked").css("opacity","1");
				this.__callback({});
			},
			is_locked : function () { return this.data.core.locked; },
			save_opened : function () {
				var _this = this;
				this.data.core.to_open = [];
				this.get_container_ul().find("li.jstree-open").each(function () { 
					if(this.id) { _this.data.core.to_open.push("#" + this.id.toString().replace(/^#/,"").replace(/\\\//g,"/").replace(/\//g,"\\\/").replace(/\\\./g,".").replace(/\./g,"\\.").replace(/\:/g,"\\:")); }
				});
				this.__callback(_this.data.core.to_open);
			},
			save_loaded : function () { },
			reload_nodes : function (is_callback) {
				var _this = this,
					done = true,
					current = [],
					remaining = [];
				if(!is_callback) { 
					this.data.core.reopen = false; 
					this.data.core.refreshing = true; 
					this.data.core.to_open = $.map($.makeArray(this.data.core.to_open), function (n) { return "#" + n.toString().replace(/^#/,"").replace(/\\\//g,"/").replace(/\//g,"\\\/").replace(/\\\./g,".").replace(/\./g,"\\.").replace(/\:/g,"\\:"); });
					this.data.core.to_load = $.map($.makeArray(this.data.core.to_load), function (n) { return "#" + n.toString().replace(/^#/,"").replace(/\\\//g,"/").replace(/\//g,"\\\/").replace(/\\\./g,".").replace(/\./g,"\\.").replace(/\:/g,"\\:"); });
					if(this.data.core.to_open.length) {
						this.data.core.to_load = this.data.core.to_load.concat(this.data.core.to_open);
					}
				}
				if(this.data.core.to_load.length) {
					$.each(this.data.core.to_load, function (i, val) {
						if(val == "#") { return true; }
						if($(val).length) { current.push(val); }
						else { remaining.push(val); }
					});
					if(current.length) {
						this.data.core.to_load = remaining;
						$.each(current, function (i, val) { 
							if(!_this._is_loaded(val)) {
								_this.load_node(val, function () { _this.reload_nodes(true); }, function () { _this.reload_nodes(true); });
								done = false;
							}
						});
					}
				}
				if(this.data.core.to_open.length) {
					$.each(this.data.core.to_open, function (i, val) {
						_this.open_node(val, false, true); 
					});
				}
				if(done) { 
					// TODO: find a more elegant approach to syncronizing returning requests
					if(this.data.core.reopen) { clearTimeout(this.data.core.reopen); }
					this.data.core.reopen = setTimeout(function () { _this.__callback({}, _this); }, 50);
					this.data.core.refreshing = false;
					this.reopen();
				}
			},
			reopen : function () {
				var _this = this;
				if(this.data.core.to_open.length) {
					$.each(this.data.core.to_open, function (i, val) {
						_this.open_node(val, false, true); 
					});
				}
				this.__callback({});
			},
			refresh : function (obj) {
				var _this = this;
				this.save_opened();
				if(!obj) { obj = -1; }
				obj = this._get_node(obj);
				if(!obj) { obj = -1; }
				if(obj !== -1) { obj.children("UL").remove(); }
				else { this.get_container_ul().empty(); }
				this.load_node(obj, function () { _this.__callback({ "obj" : obj}); _this.reload_nodes(); });
			},
			// Dummy function to fire after the first load (so that there is a jstree.loaded event)
			loaded	: function () { 
				this.__callback(); 
			},
			// deal with focus
			set_focus	: function () { 
				if(this.is_focused()) { return; }
				var f = $.jstree._focused();
				if(f) { f.unset_focus(); }

				this.get_container().addClass("jstree-focused"); 
				focused_instance = this.get_index(); 
				this.__callback();
			},
			is_focused	: function () { 
				return focused_instance == this.get_index(); 
			},
			unset_focus	: function () {
				if(this.is_focused()) {
					this.get_container().removeClass("jstree-focused"); 
					focused_instance = -1; 
				}
				this.__callback();
			},

			// traverse
			_get_node		: function (obj) { 
				var $obj = $(obj, this.get_container()); 
				if($obj.is(".jstree") || obj == -1) { return -1; } 
				$obj = $obj.closest("li", this.get_container()); 
				return $obj.length ? $obj : false; 
			},
			_get_next		: function (obj, strict) {
				obj = this._get_node(obj);
				if(obj === -1) { return this.get_container().find("> ul > li:first-child"); }
				if(!obj.length) { return false; }
				if(strict) { return (obj.nextAll("li").size() > 0) ? obj.nextAll("li:eq(0)") : false; }

				if(obj.hasClass("jstree-open")) { return obj.find("li:eq(0)"); }
				else if(obj.nextAll("li").size() > 0) { return obj.nextAll("li:eq(0)"); }
				else { return obj.parentsUntil(".jstree","li").next("li").eq(0); }
			},
			_get_prev		: function (obj, strict) {
				obj = this._get_node(obj);
				if(obj === -1) { return this.get_container().find("> ul > li:last-child"); }
				if(!obj.length) { return false; }
				if(strict) { return (obj.prevAll("li").length > 0) ? obj.prevAll("li:eq(0)") : false; }

				if(obj.prev("li").length) {
					obj = obj.prev("li").eq(0);
					while(obj.hasClass("jstree-open")) { obj = obj.children("ul:eq(0)").children("li:last"); }
					return obj;
				}
				else { var o = obj.parentsUntil(".jstree","li:eq(0)"); return o.length ? o : false; }
			},
			_get_parent		: function (obj) {
				obj = this._get_node(obj);
				if(obj == -1 || !obj.length) { return false; }
				var o = obj.parentsUntil(".jstree", "li:eq(0)");
				return o.length ? o : -1;
			},
			_get_children	: function (obj) {
				obj = this._get_node(obj);
				if(obj === -1) { return this.get_container().children("ul:eq(0)").children("li"); }
				if(!obj.length) { return false; }
				return obj.children("ul:eq(0)").children("li");
			},
			get_path		: function (obj, id_mode) {
				var p = [],
					_this = this;
				obj = this._get_node(obj);
				if(obj === -1 || !obj || !obj.length) { return false; }
				obj.parentsUntil(".jstree", "li").each(function () {
					p.push( id_mode ? this.id : _this.get_text(this) );
				});
				p.reverse();
				p.push( id_mode ? obj.attr("id") : this.get_text(obj) );
				return p;
			},

			// string functions
			_get_string : function (key) {
				return this._get_settings().core.strings[key] || key;
			},

			is_open		: function (obj) { obj = this._get_node(obj); return obj && obj !== -1 && obj.hasClass("jstree-open"); },
			is_closed	: function (obj) { obj = this._get_node(obj); return obj && obj !== -1 && obj.hasClass("jstree-closed"); },
			is_leaf		: function (obj) { obj = this._get_node(obj); return obj && obj !== -1 && obj.hasClass("jstree-leaf"); },
			correct_state	: function (obj) {
				obj = this._get_node(obj);
				if(!obj || obj === -1) { return false; }
				obj.removeClass("jstree-closed jstree-open").addClass("jstree-leaf").children("ul").remove();
				this.__callback({ "obj" : obj });
			},
			// open/close
			open_node	: function (obj, callback, skip_animation) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				if(!obj.hasClass("jstree-closed")) { if(callback) { callback.call(); } return false; }
				var s = skip_animation || is_ie6 ? 0 : this._get_settings().core.animation,
					t = this;
				if(!this._is_loaded(obj)) {
					obj.children("a").addClass("jstree-loading");
					this.load_node(obj, function () { t.open_node(obj, callback, skip_animation); }, callback);
				}
				else {
					if(this._get_settings().core.open_parents) {
						obj.parentsUntil(".jstree",".jstree-closed").each(function () {
							t.open_node(this, false, true);
						});
					}
					if(s) { obj.children("ul").css("display","none"); }
					obj.removeClass("jstree-closed").addClass("jstree-open").children("a").removeClass("jstree-loading");
					if(s) { obj.children("ul").stop(true, true).slideDown(s, function () { this.style.display = ""; t.after_open(obj); }); }
					else { t.after_open(obj); }
					this.__callback({ "obj" : obj });
					if(callback) { callback.call(); }
				}
			},
			after_open	: function (obj) { this.__callback({ "obj" : obj }); },
			close_node	: function (obj, skip_animation) {
				obj = this._get_node(obj);
				var s = skip_animation || is_ie6 ? 0 : this._get_settings().core.animation,
					t = this;
				if(!obj.length || !obj.hasClass("jstree-open")) { return false; }
				if(s) { obj.children("ul").attr("style","display:block !important"); }
				obj.removeClass("jstree-open").addClass("jstree-closed");
				if(s) { obj.children("ul").stop(true, true).slideUp(s, function () { this.style.display = ""; t.after_close(obj); }); }
				else { t.after_close(obj); }
				this.__callback({ "obj" : obj });
			},
			after_close	: function (obj) { this.__callback({ "obj" : obj }); },
			toggle_node	: function (obj) {
				obj = this._get_node(obj);
				if(obj.hasClass("jstree-closed")) { return this.open_node(obj); }
				if(obj.hasClass("jstree-open")) { return this.close_node(obj); }
			},
			open_all	: function (obj, do_animation, original_obj) {
				obj = obj ? this._get_node(obj) : -1;
				if(!obj || obj === -1) { obj = this.get_container_ul(); }
				if(original_obj) { 
					obj = obj.find("li.jstree-closed");
				}
				else {
					original_obj = obj;
					if(obj.is(".jstree-closed")) { obj = obj.find("li.jstree-closed").andSelf(); }
					else { obj = obj.find("li.jstree-closed"); }
				}
				var _this = this;
				obj.each(function () { 
					var __this = this; 
					if(!_this._is_loaded(this)) { _this.open_node(this, function() { _this.open_all(__this, do_animation, original_obj); }, !do_animation); }
					else { _this.open_node(this, false, !do_animation); }
				});
				// so that callback is fired AFTER all nodes are open
				if(original_obj.find('li.jstree-closed').length === 0) { this.__callback({ "obj" : original_obj }); }
			},
			close_all	: function (obj, do_animation) {
				var _this = this;
				obj = obj ? this._get_node(obj) : this.get_container();
				if(!obj || obj === -1) { obj = this.get_container_ul(); }
				obj.find("li.jstree-open").andSelf().each(function () { _this.close_node(this, !do_animation); });
				this.__callback({ "obj" : obj });
			},
			clean_node	: function (obj) {
				obj = obj && obj != -1 ? $(obj) : this.get_container_ul();
				obj = obj.is("li") ? obj.find("li").andSelf() : obj.find("li");
				obj.removeClass("jstree-last")
					.filter("li:last-child").addClass("jstree-last").end()
					.filter(":has(li)")
						.not(".jstree-open").removeClass("jstree-leaf").addClass("jstree-closed");
				obj.not(".jstree-open, .jstree-closed").addClass("jstree-leaf").children("ul").remove();
				this.__callback({ "obj" : obj });
			},
			// rollback
			get_rollback : function () { 
				this.__callback();
				return { i : this.get_index(), h : this.get_container().children("ul").clone(true), d : this.data }; 
			},
			set_rollback : function (html, data) {
				this.get_container().empty().append(html);
				this.data = data;
				this.__callback();
			},
			// Dummy functions to be overwritten by any datastore plugin included
			load_node	: function (obj, s_call, e_call) { this.__callback({ "obj" : obj }); },
			_is_loaded	: function (obj) { return true; },

			// Basic operations: create
			create_node	: function (obj, position, js, callback, is_loaded) {
				obj = this._get_node(obj);
				position = typeof position === "undefined" ? "last" : position;
				var d = $("<li />"),
					s = this._get_settings().core,
					tmp;

				if(obj !== -1 && !obj.length) { return false; }
				if(!is_loaded && !this._is_loaded(obj)) { this.load_node(obj, function () { this.create_node(obj, position, js, callback, true); }); return false; }

				this.__rollback();

				if(typeof js === "string") { js = { "data" : js }; }
				if(!js) { js = {}; }
				if(js.attr) { d.attr(js.attr); }
				if(js.metadata) { d.data(js.metadata); }
				if(js.state) { d.addClass("jstree-" + js.state); }
				if(!js.data) { js.data = this._get_string("new_node"); }
				if(!$.isArray(js.data)) { tmp = js.data; js.data = []; js.data.push(tmp); }
				$.each(js.data, function (i, m) {
					tmp = $("<a />");
					if($.isFunction(m)) { m = m.call(this, js); }
					if(typeof m == "string") { tmp.attr('href','#')[ s.html_titles ? "html" : "text" ](m); }
					else {
						if(!m.attr) { m.attr = {}; }
						if(!m.attr.href) { m.attr.href = '#'; }
						tmp.attr(m.attr)[ s.html_titles ? "html" : "text" ](m.title);
						if(m.language) { tmp.addClass(m.language); }
					}
					tmp.prepend("<ins class='jstree-icon'>&#160;</ins>");
					if(!m.icon && js.icon) { m.icon = js.icon; }
					if(m.icon) { 
						if(m.icon.indexOf("/") === -1) { tmp.children("ins").addClass(m.icon); }
						else { tmp.children("ins").css("background","url('" + m.icon + "') center center no-repeat"); }
					}
					d.append(tmp);
				});
				d.prepend("<ins class='jstree-icon'>&#160;</ins>");
				if(obj === -1) {
					obj = this.get_container();
					if(position === "before") { position = "first"; }
					if(position === "after") { position = "last"; }
				}
				switch(position) {
					case "before": obj.before(d); tmp = this._get_parent(obj); break;
					case "after" : obj.after(d);  tmp = this._get_parent(obj); break;
					case "inside":
					case "first" :
						if(!obj.children("ul").length) { obj.append("<ul />"); }
						obj.children("ul").prepend(d);
						tmp = obj;
						break;
					case "last":
						if(!obj.children("ul").length) { obj.append("<ul />"); }
						obj.children("ul").append(d);
						tmp = obj;
						break;
					default:
						if(!obj.children("ul").length) { obj.append("<ul />"); }
						if(!position) { position = 0; }
						tmp = obj.children("ul").children("li").eq(position);
						if(tmp.length) { tmp.before(d); }
						else { obj.children("ul").append(d); }
						tmp = obj;
						break;
				}
				if(tmp === -1 || tmp.get(0) === this.get_container().get(0)) { tmp = -1; }
				this.clean_node(tmp);
				this.__callback({ "obj" : d, "parent" : tmp });
				if(callback) { callback.call(this, d); }
				return d;
			},
			// Basic operations: rename (deal with text)
			get_text	: function (obj) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				var s = this._get_settings().core.html_titles;
				obj = obj.children("a:eq(0)");
				if(s) {
					obj = obj.clone();
					obj.children("INS").remove();
					return obj.html();
				}
				else {
					obj = obj.contents().filter(function() { return this.nodeType == 3; })[0];
					return obj.nodeValue;
				}
			},
			set_text	: function (obj, val) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				obj = obj.children("a:eq(0)");
				if(this._get_settings().core.html_titles) {
					var tmp = obj.children("INS").clone();
					obj.html(val).prepend(tmp);
					this.__callback({ "obj" : obj, "name" : val });
					return true;
				}
				else {
					obj = obj.contents().filter(function() { return this.nodeType == 3; })[0];
					this.__callback({ "obj" : obj, "name" : val });
					return (obj.nodeValue = val);
				}
			},
			rename_node : function (obj, val) {
				obj = this._get_node(obj);
				this.__rollback();
				if(obj && obj.length && this.set_text.apply(this, Array.prototype.slice.call(arguments))) { this.__callback({ "obj" : obj, "name" : val }); }
			},
			// Basic operations: deleting nodes
			delete_node : function (obj) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				this.__rollback();
				var p = this._get_parent(obj), prev = $([]), t = this;
				obj.each(function () {
					prev = prev.add(t._get_prev(this));
				});
				obj = obj.detach();
				if(p !== -1 && p.find("> ul > li").length === 0) {
					p.removeClass("jstree-open jstree-closed").addClass("jstree-leaf");
				}
				this.clean_node(p);
				this.__callback({ "obj" : obj, "prev" : prev, "parent" : p });
				return obj;
			},
			prepare_move : function (o, r, pos, cb, is_cb) {
				var p = {};

				p.ot = $.jstree._reference(o) || this;
				p.o = p.ot._get_node(o);
				p.r = r === - 1 ? -1 : this._get_node(r);
				p.p = (typeof pos === "undefined" || pos === false) ? "last" : pos; // TODO: move to a setting
				if(!is_cb && prepared_move.o && prepared_move.o[0] === p.o[0] && prepared_move.r[0] === p.r[0] && prepared_move.p === p.p) {
					this.__callback(prepared_move);
					if(cb) { cb.call(this, prepared_move); }
					return;
				}
				p.ot = $.jstree._reference(p.o) || this;
				p.rt = $.jstree._reference(p.r) || this; // r === -1 ? p.ot : $.jstree._reference(p.r) || this
				if(p.r === -1 || !p.r) {
					p.cr = -1;
					switch(p.p) {
						case "first":
						case "before":
						case "inside":
							p.cp = 0; 
							break;
						case "after":
						case "last":
							p.cp = p.rt.get_container().find(" > ul > li").length; 
							break;
						default:
							p.cp = p.p;
							break;
					}
				}
				else {
					if(!/^(before|after)$/.test(p.p) && !this._is_loaded(p.r)) {
						return this.load_node(p.r, function () { this.prepare_move(o, r, pos, cb, true); });
					}
					switch(p.p) {
						case "before":
							p.cp = p.r.index();
							p.cr = p.rt._get_parent(p.r);
							break;
						case "after":
							p.cp = p.r.index() + 1;
							p.cr = p.rt._get_parent(p.r);
							break;
						case "inside":
						case "first":
							p.cp = 0;
							p.cr = p.r;
							break;
						case "last":
							p.cp = p.r.find(" > ul > li").length; 
							p.cr = p.r;
							break;
						default: 
							p.cp = p.p;
							p.cr = p.r;
							break;
					}
				}
				p.np = p.cr == -1 ? p.rt.get_container() : p.cr;
				p.op = p.ot._get_parent(p.o);
				p.cop = p.o.index();
				if(p.op === -1) { p.op = p.ot ? p.ot.get_container() : this.get_container(); }
				if(!/^(before|after)$/.test(p.p) && p.op && p.np && p.op[0] === p.np[0] && p.o.index() < p.cp) { p.cp++; }
				//if(p.p === "before" && p.op && p.np && p.op[0] === p.np[0] && p.o.index() < p.cp) { p.cp--; }
				p.or = p.np.find(" > ul > li:nth-child(" + (p.cp + 1) + ")");
				prepared_move = p;
				this.__callback(prepared_move);
				if(cb) { cb.call(this, prepared_move); }
			},
			check_move : function () {
				var obj = prepared_move, ret = true, r = obj.r === -1 ? this.get_container() : obj.r;
				if(!obj || !obj.o || obj.or[0] === obj.o[0]) { return false; }
				if(obj.op && obj.np && obj.op[0] === obj.np[0] && obj.cp - 1 === obj.o.index()) { return false; }
				obj.o.each(function () { 
					if(r.parentsUntil(".jstree", "li").andSelf().index(this) !== -1) { ret = false; return false; }
				});
				return ret;
			},
			move_node : function (obj, ref, position, is_copy, is_prepared, skip_check) {
				if(!is_prepared) { 
					return this.prepare_move(obj, ref, position, function (p) {
						this.move_node(p, false, false, is_copy, true, skip_check);
					});
				}
				if(is_copy) { 
					prepared_move.cy = true;
				}
				if(!skip_check && !this.check_move()) { return false; }

				this.__rollback();
				var o = false;
				if(is_copy) {
					o = obj.o.clone(true);
					o.find("*[id]").andSelf().each(function () {
						if(this.id) { this.id = "copy_" + this.id; }
					});
				}
				else { o = obj.o; }

				if(obj.or.length) { obj.or.before(o); }
				else { 
					if(!obj.np.children("ul").length) { $("<ul />").appendTo(obj.np); }
					obj.np.children("ul:eq(0)").append(o); 
				}

				try { 
					obj.ot.clean_node(obj.op);
					obj.rt.clean_node(obj.np);
					if(!obj.op.find("> ul > li").length) {
						obj.op.removeClass("jstree-open jstree-closed").addClass("jstree-leaf").children("ul").remove();
					}
				} catch (e) { }

				if(is_copy) { 
					prepared_move.cy = true;
					prepared_move.oc = o; 
				}
				this.__callback(prepared_move);
				return prepared_move;
			},
			_get_move : function () { return prepared_move; }
		}
	});
})(jQuery);
//*/

/* 
 * jsTree ui plugin
 * This plugins handles selecting/deselecting/hovering/dehovering nodes
 */
(function ($) {
	var scrollbar_width, e1, e2;
	$(function() {
		if (/msie/.test(navigator.userAgent.toLowerCase())) {
			e1 = $('<textarea cols="10" rows="2"></textarea>').css({ position: 'absolute', top: -1000, left: 0 }).appendTo('body');
			e2 = $('<textarea cols="10" rows="2" style="overflow: hidden;"></textarea>').css({ position: 'absolute', top: -1000, left: 0 }).appendTo('body');
			scrollbar_width = e1.width() - e2.width();
			e1.add(e2).remove();
		} 
		else {
			e1 = $('<div />').css({ width: 100, height: 100, overflow: 'auto', position: 'absolute', top: -1000, left: 0 })
					.prependTo('body').append('<div />').find('div').css({ width: '100%', height: 200 });
			scrollbar_width = 100 - e1.width();
			e1.parent().remove();
		}
	});
	$.jstree.plugin("ui", {
		__init : function () { 
			this.data.ui.selected = $(); 
			this.data.ui.last_selected = false; 
			this.data.ui.hovered = null;
			this.data.ui.to_select = this.get_settings().ui.initially_select;

			this.get_container()
				.delegate("a", "click.jstree", $.proxy(function (event) {
						event.preventDefault();
						event.currentTarget.blur();
						if(!$(event.currentTarget).hasClass("jstree-loading")) {
							this.select_node(event.currentTarget, true, event);
						}
					}, this))
				.delegate("a", "mouseenter.jstree", $.proxy(function (event) {
						if(!$(event.currentTarget).hasClass("jstree-loading")) {
							this.hover_node(event.target);
						}
					}, this))
				.delegate("a", "mouseleave.jstree", $.proxy(function (event) {
						if(!$(event.currentTarget).hasClass("jstree-loading")) {
							this.dehover_node(event.target);
						}
					}, this))
				.bind("reopen.jstree", $.proxy(function () { 
						this.reselect();
					}, this))
				.bind("get_rollback.jstree", $.proxy(function () { 
						this.dehover_node();
						this.save_selected();
					}, this))
				.bind("set_rollback.jstree", $.proxy(function () { 
						this.reselect();
					}, this))
				.bind("close_node.jstree", $.proxy(function (event, data) { 
						var s = this._get_settings().ui,
							obj = this._get_node(data.rslt.obj),
							clk = (obj && obj.length) ? obj.children("ul").find("a.jstree-clicked") : $(),
							_this = this;
						if(s.selected_parent_close === false || !clk.length) { return; }
						clk.each(function () { 
							_this.deselect_node(this);
							if(s.selected_parent_close === "select_parent") { _this.select_node(obj); }
						});
					}, this))
				.bind("delete_node.jstree", $.proxy(function (event, data) { 
						var s = this._get_settings().ui.select_prev_on_delete,
							obj = this._get_node(data.rslt.obj),
							clk = (obj && obj.length) ? obj.find("a.jstree-clicked") : [],
							_this = this;
						clk.each(function () { _this.deselect_node(this); });
						if(s && clk.length) { 
							data.rslt.prev.each(function () { 
								if(this.parentNode) { _this.select_node(this); return false; /* if return false is removed all prev nodes will be selected */}
							});
						}
					}, this))
				.bind("move_node.jstree", $.proxy(function (event, data) { 
						if(data.rslt.cy) { 
							data.rslt.oc.find("a.jstree-clicked").removeClass("jstree-clicked");
						}
					}, this));
		},
		defaults : {
			select_limit : -1, // 0, 1, 2 ... or -1 for unlimited
			select_multiple_modifier : "ctrl", // on, or ctrl, shift, alt
			select_range_modifier : "shift",
			selected_parent_close : "select_parent", // false, "deselect", "select_parent"
			selected_parent_open : true,
			select_prev_on_delete : true,
			disable_selecting_children : false,
			initially_select : []
		},
		_fn : { 
			_get_node : function (obj, allow_multiple) {
				if(typeof obj === "undefined" || obj === null) { return allow_multiple ? this.data.ui.selected : this.data.ui.last_selected; }
				var $obj = $(obj, this.get_container()); 
				if($obj.is(".jstree") || obj == -1) { return -1; } 
				$obj = $obj.closest("li", this.get_container()); 
				return $obj.length ? $obj : false; 
			},
			_ui_notify : function (n, data) {
				if(data.selected) {
					this.select_node(n, false);
				}
			},
			save_selected : function () {
				var _this = this;
				this.data.ui.to_select = [];
				this.data.ui.selected.each(function () { if(this.id) { _this.data.ui.to_select.push("#" + this.id.toString().replace(/^#/,"").replace(/\\\//g,"/").replace(/\//g,"\\\/").replace(/\\\./g,".").replace(/\./g,"\\.").replace(/\:/g,"\\:")); } });
				this.__callback(this.data.ui.to_select);
			},
			reselect : function () {
				var _this = this,
					s = this.data.ui.to_select;
				s = $.map($.makeArray(s), function (n) { return "#" + n.toString().replace(/^#/,"").replace(/\\\//g,"/").replace(/\//g,"\\\/").replace(/\\\./g,".").replace(/\./g,"\\.").replace(/\:/g,"\\:"); });
				// this.deselect_all(); WHY deselect, breaks plugin state notifier?
				$.each(s, function (i, val) { if(val && val !== "#") { _this.select_node(val); } });
				this.data.ui.selected = this.data.ui.selected.filter(function () { return this.parentNode; });
				this.__callback();
			},
			refresh : function (obj) {
				this.save_selected();
				return this.__call_old();
			},
			hover_node : function (obj) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				//if(this.data.ui.hovered && obj.get(0) === this.data.ui.hovered.get(0)) { return; }
				if(!obj.hasClass("jstree-hovered")) { this.dehover_node(); }
				this.data.ui.hovered = obj.children("a").addClass("jstree-hovered").parent();
				this._fix_scroll(obj);
				this.__callback({ "obj" : obj });
			},
			dehover_node : function () {
				var obj = this.data.ui.hovered, p;
				if(!obj || !obj.length) { return false; }
				p = obj.children("a").removeClass("jstree-hovered").parent();
				if(this.data.ui.hovered[0] === p[0]) { this.data.ui.hovered = null; }
				this.__callback({ "obj" : obj });
			},
			select_node : function (obj, check, e) {
				obj = this._get_node(obj);
				if(obj == -1 || !obj || !obj.length) { return false; }
				var s = this._get_settings().ui,
					is_multiple = (s.select_multiple_modifier == "on" || (s.select_multiple_modifier !== false && e && e[s.select_multiple_modifier + "Key"])),
					is_range = (s.select_range_modifier !== false && e && e[s.select_range_modifier + "Key"] && this.data.ui.last_selected && this.data.ui.last_selected[0] !== obj[0] && this.data.ui.last_selected.parent()[0] === obj.parent()[0]),
					is_selected = this.is_selected(obj),
					proceed = true,
					t = this;
				if(check) {
					if(s.disable_selecting_children && is_multiple && 
						(
							(obj.parentsUntil(".jstree","li").children("a.jstree-clicked").length) ||
							(obj.children("ul").find("a.jstree-clicked:eq(0)").length)
						)
					) {
						return false;
					}
					proceed = false;
					switch(!0) {
						case (is_range):
							this.data.ui.last_selected.addClass("jstree-last-selected");
							obj = obj[ obj.index() < this.data.ui.last_selected.index() ? "nextUntil" : "prevUntil" ](".jstree-last-selected").andSelf();
							if(s.select_limit == -1 || obj.length < s.select_limit) {
								this.data.ui.last_selected.removeClass("jstree-last-selected");
								this.data.ui.selected.each(function () {
									if(this !== t.data.ui.last_selected[0]) { t.deselect_node(this); }
								});
								is_selected = false;
								proceed = true;
							}
							else {
								proceed = false;
							}
							break;
						case (is_selected && !is_multiple): 
							this.deselect_all();
							is_selected = false;
							proceed = true;
							break;
						case (!is_selected && !is_multiple): 
							if(s.select_limit == -1 || s.select_limit > 0) {
								this.deselect_all();
								proceed = true;
							}
							break;
						case (is_selected && is_multiple): 
							this.deselect_node(obj);
							break;
						case (!is_selected && is_multiple): 
							if(s.select_limit == -1 || this.data.ui.selected.length + 1 <= s.select_limit) { 
								proceed = true;
							}
							break;
					}
				}
				if(proceed && !is_selected) {
					if(!is_range) { this.data.ui.last_selected = obj; }
					obj.children("a").addClass("jstree-clicked");
					if(s.selected_parent_open) {
						obj.parents(".jstree-closed").each(function () { t.open_node(this, false, true); });
					}
					this.data.ui.selected = this.data.ui.selected.add(obj);
					this._fix_scroll(obj.eq(0));
					this.__callback({ "obj" : obj, "e" : e });
				}
			},
			_fix_scroll : function (obj) {
				var c = this.get_container()[0], t;
				if(c.scrollHeight > c.offsetHeight) {
					obj = this._get_node(obj);
					if(!obj || obj === -1 || !obj.length || !obj.is(":visible")) { return; }
					t = obj.offset().top - this.get_container().offset().top;
					if(t < 0) { 
						c.scrollTop = c.scrollTop + t - 1; 
					}
					if(t + this.data.core.li_height + (c.scrollWidth > c.offsetWidth ? scrollbar_width : 0) > c.offsetHeight) { 
						c.scrollTop = c.scrollTop + (t - c.offsetHeight + this.data.core.li_height + 1 + (c.scrollWidth > c.offsetWidth ? scrollbar_width : 0)); 
					}
				}
			},
			deselect_node : function (obj) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				if(this.is_selected(obj)) {
					obj.children("a").removeClass("jstree-clicked");
					this.data.ui.selected = this.data.ui.selected.not(obj);
					if(this.data.ui.last_selected.get(0) === obj.get(0)) { this.data.ui.last_selected = this.data.ui.selected.eq(0); }
					this.__callback({ "obj" : obj });
				}
			},
			toggle_select : function (obj) {
				obj = this._get_node(obj);
				if(!obj.length) { return false; }
				if(this.is_selected(obj)) { this.deselect_node(obj); }
				else { this.select_node(obj); }
			},
			is_selected : function (obj) { return this.data.ui.selected.index(this._get_node(obj)) >= 0; },
			get_selected : function (context) { 
				return context ? $(context).find("a.jstree-clicked").parent() : this.data.ui.selected; 
			},
			deselect_all : function (context) {
				var ret = context ? $(context).find("a.jstree-clicked").parent() : this.get_container().find("a.jstree-clicked").parent();
				ret.children("a.jstree-clicked").removeClass("jstree-clicked");
				this.data.ui.selected = $([]);
				this.data.ui.last_selected = false;
				this.__callback({ "obj" : ret });
			}
		}
	});
	// include the selection plugin by default
	$.jstree.defaults.plugins.push("ui");
})(jQuery);
//*/

/* 
 * jsTree CRRM plugin
 * Handles creating/renaming/removing/moving nodes by user interaction.
 */
(function ($) {
	$.jstree.plugin("crrm", { 
		__init : function () {
			this.get_container()
				.bind("move_node.jstree", $.proxy(function (e, data) {
					if(this._get_settings().crrm.move.open_onmove) {
						var t = this;
						data.rslt.np.parentsUntil(".jstree").andSelf().filter(".jstree-closed").each(function () {
							t.open_node(this, false, true);
						});
					}
				}, this));
		},
		defaults : {
			input_width_limit : 200,
			move : {
				always_copy			: false, // false, true or "multitree"
				open_onmove			: true,
				default_position	: "last",
				check_move			: function (m) { return true; }
			}
		},
		_fn : {
			_show_input : function (obj, callback) {
				obj = this._get_node(obj);
				var rtl = this._get_settings().core.rtl,
					w = this._get_settings().crrm.input_width_limit,
					w1 = obj.children("ins").width(),
					w2 = obj.find("> a:visible > ins").width() * obj.find("> a:visible > ins").length,
					t = this.get_text(obj),
					h1 = $("<div />", { css : { "position" : "absolute", "top" : "-200px", "left" : (rtl ? "0px" : "-1000px"), "visibility" : "hidden" } }).appendTo("body"),
					h2 = obj.css("position","relative").append(
					$("<input />", { 
						"value" : t,
						"class" : "jstree-rename-input",
						// "size" : t.length,
						"css" : {
							"padding" : "0",
							"border" : "1px solid silver",
							"position" : "absolute",
							"left"  : (rtl ? "auto" : (w1 + w2 + 4) + "px"),
							"right" : (rtl ? (w1 + w2 + 4) + "px" : "auto"),
							"top" : "0px",
							"height" : (this.data.core.li_height - 2) + "px",
							"lineHeight" : (this.data.core.li_height - 2) + "px",
							"width" : "150px" // will be set a bit further down
						},
						"blur" : $.proxy(function () {
							var i = obj.children(".jstree-rename-input"),
								v = i.val();
							if(v === "") { v = t; }
							h1.remove();
							i.remove(); // rollback purposes
							this.set_text(obj,t); // rollback purposes
							this.rename_node(obj, v);
							callback.call(this, obj, v, t);
							obj.css("position","");
						}, this),
						"keyup" : function (event) {
							var key = event.keyCode || event.which;
							if(key == 27) { this.value = t; this.blur(); return; }
							else if(key == 13) { this.blur(); return; }
							else {
								h2.width(Math.min(h1.text("pW" + this.value).width(),w));
							}
						},
						"keypress" : function(event) {
							var key = event.keyCode || event.which;
							if(key == 13) { return false; }
						}
					})
				).children(".jstree-rename-input"); 
				this.set_text(obj, "");
				h1.css({
						fontFamily		: h2.css('fontFamily')		|| '',
						fontSize		: h2.css('fontSize')		|| '',
						fontWeight		: h2.css('fontWeight')		|| '',
						fontStyle		: h2.css('fontStyle')		|| '',
						fontStretch		: h2.css('fontStretch')		|| '',
						fontVariant		: h2.css('fontVariant')		|| '',
						letterSpacing	: h2.css('letterSpacing')	|| '',
						wordSpacing		: h2.css('wordSpacing')		|| ''
				});
				h2.width(Math.min(h1.text("pW" + h2[0].value).width(),w))[0].select();
			},
			rename : function (obj) {
				obj = this._get_node(obj);
				this.__rollback();
				var f = this.__callback;
				this._show_input(obj, function (obj, new_name, old_name) { 
					f.call(this, { "obj" : obj, "new_name" : new_name, "old_name" : old_name });
				});
			},
			create : function (obj, position, js, callback, skip_rename) {
				var t, _this = this;
				obj = this._get_node(obj);
				if(!obj) { obj = -1; }
				this.__rollback();
				t = this.create_node(obj, position, js, function (t) {
					var p = this._get_parent(t),
						pos = $(t).index();
					if(callback) { callback.call(this, t); }
					if(p.length && p.hasClass("jstree-closed")) { this.open_node(p, false, true); }
					if(!skip_rename) { 
						this._show_input(t, function (obj, new_name, old_name) { 
							_this.__callback({ "obj" : obj, "name" : new_name, "parent" : p, "position" : pos });
						});
					}
					else { _this.__callback({ "obj" : t, "name" : this.get_text(t), "parent" : p, "position" : pos }); }
				});
				return t;
			},
			remove : function (obj) {
				obj = this._get_node(obj, true);
				var p = this._get_parent(obj), prev = this._get_prev(obj);
				this.__rollback();
				obj = this.delete_node(obj);
				if(obj !== false) { this.__callback({ "obj" : obj, "prev" : prev, "parent" : p }); }
			},
			check_move : function () {
				if(!this.__call_old()) { return false; }
				var s = this._get_settings().crrm.move;
				if(!s.check_move.call(this, this._get_move())) { return false; }
				return true;
			},
			move_node : function (obj, ref, position, is_copy, is_prepared, skip_check) {
				var s = this._get_settings().crrm.move;
				if(!is_prepared) { 
					if(typeof position === "undefined") { position = s.default_position; }
					if(position === "inside" && !s.default_position.match(/^(before|after)$/)) { position = s.default_position; }
					return this.__call_old(true, obj, ref, position, is_copy, false, skip_check);
				}
				// if the move is already prepared
				if(s.always_copy === true || (s.always_copy === "multitree" && obj.rt.get_index() !== obj.ot.get_index() )) {
					is_copy = true;
				}
				this.__call_old(true, obj, ref, position, is_copy, true, skip_check);
			},

			cut : function (obj) {
				obj = this._get_node(obj, true);
				if(!obj || !obj.length) { return false; }
				this.data.crrm.cp_nodes = false;
				this.data.crrm.ct_nodes = obj;
				this.__callback({ "obj" : obj });
			},
			copy : function (obj) {
				obj = this._get_node(obj, true);
				if(!obj || !obj.length) { return false; }
				this.data.crrm.ct_nodes = false;
				this.data.crrm.cp_nodes = obj;
				this.__callback({ "obj" : obj });
			},
			paste : function (obj) { 
				obj = this._get_node(obj);
				if(!obj || !obj.length) { return false; }
				var nodes = this.data.crrm.ct_nodes ? this.data.crrm.ct_nodes : this.data.crrm.cp_nodes;
				if(!this.data.crrm.ct_nodes && !this.data.crrm.cp_nodes) { return false; }
				if(this.data.crrm.ct_nodes) { this.move_node(this.data.crrm.ct_nodes, obj); this.data.crrm.ct_nodes = false; }
				if(this.data.crrm.cp_nodes) { this.move_node(this.data.crrm.cp_nodes, obj, false, true); }
				this.__callback({ "obj" : obj, "nodes" : nodes });
			}
		}
	});
	// include the crr plugin by default
	// $.jstree.defaults.plugins.push("crrm");
})(jQuery);
//*/

/* 
 * jsTree themes plugin
 * Handles loading and setting themes, as well as detecting path to themes, etc.
 */
(function ($) {
	var themes_loaded = [];
	// this variable stores the path to the themes folder - if left as false - it will be autodetected
	$.jstree._themes = false;
	$.jstree.plugin("themes", {
		__init : function () { 
			this.get_container()
				.bind("init.jstree", $.proxy(function () {
						var s = this._get_settings().themes;
						this.data.themes.dots = s.dots; 
						this.data.themes.icons = s.icons; 
						this.set_theme(s.theme, s.url);
					}, this))
				.bind("loaded.jstree", $.proxy(function () {
						// bound here too, as simple HTML tree's won't honor dots & icons otherwise
						if(!this.data.themes.dots) { this.hide_dots(); }
						else { this.show_dots(); }
						if(!this.data.themes.icons) { this.hide_icons(); }
						else { this.show_icons(); }
					}, this));
		},
		defaults : { 
			theme : "default", 
			url : false,
			dots : true,
			icons : true
		},
		_fn : {
			set_theme : function (theme_name, theme_url) {
				if(!theme_name) { return false; }
				if(!theme_url) { theme_url = $.jstree._themes + theme_name + '/style.css'; }
				if($.inArray(theme_url, themes_loaded) == -1) {
					$.vakata.css.add_sheet({ "url" : theme_url });
					themes_loaded.push(theme_url);
				}
				if(this.data.themes.theme != theme_name) {
					this.get_container().removeClass('jstree-' + this.data.themes.theme);
					this.data.themes.theme = theme_name;
				}
				this.get_container().addClass('jstree-' + theme_name);
				if(!this.data.themes.dots) { this.hide_dots(); }
				else { this.show_dots(); }
				if(!this.data.themes.icons) { this.hide_icons(); }
				else { this.show_icons(); }
				this.__callback();
			},
			get_theme	: function () { return this.data.themes.theme; },

			show_dots	: function () { this.data.themes.dots = true; this.get_container().children("ul").removeClass("jstree-no-dots"); },
			hide_dots	: function () { this.data.themes.dots = false; this.get_container().children("ul").addClass("jstree-no-dots"); },
			toggle_dots	: function () { if(this.data.themes.dots) { this.hide_dots(); } else { this.show_dots(); } },

			show_icons	: function () { this.data.themes.icons = true; this.get_container().children("ul").removeClass("jstree-no-icons"); },
			hide_icons	: function () { this.data.themes.icons = false; this.get_container().children("ul").addClass("jstree-no-icons"); },
			toggle_icons: function () { if(this.data.themes.icons) { this.hide_icons(); } else { this.show_icons(); } }
		}
	});
	// autodetect themes path
	$(function () {
		if($.jstree._themes === false) {
			$("script").each(function () { 
				if(this.src.toString().match(/jquery\.jstree[^\/]*?\.js(\?.*)?$/)) { 
					$.jstree._themes = this.src.toString().replace(/jquery\.jstree[^\/]*?\.js(\?.*)?$/, "") + 'themes/'; 
					return false; 
				}
			});
		}
		if($.jstree._themes === false) { $.jstree._themes = "themes/"; }
	});
	// include the themes plugin by default
	$.jstree.defaults.plugins.push("themes");
})(jQuery);
//*/

/*
 * jsTree hotkeys plugin
 * Enables keyboard navigation for all tree instances
 * Depends on the jstree ui & jquery hotkeys plugins
 */
(function ($) {
	var bound = [];
	function exec(i, event) {
		var f = $.jstree._focused(), tmp;
		if(f && f.data && f.data.hotkeys && f.data.hotkeys.enabled) { 
			tmp = f._get_settings().hotkeys[i];
			if(tmp) { return tmp.call(f, event); }
		}
	}
	$.jstree.plugin("hotkeys", {
		__init : function () {
			if(typeof $.hotkeys === "undefined") { throw "jsTree hotkeys: jQuery hotkeys plugin not included."; }
			if(!this.data.ui) { throw "jsTree hotkeys: jsTree UI plugin not included."; }
			$.each(this._get_settings().hotkeys, function (i, v) {
				if(v !== false && $.inArray(i, bound) == -1) {
					$(document).bind("keydown", i, function (event) { return exec(i, event); });
					bound.push(i);
				}
			});
			this.get_container()
				.bind("lock.jstree", $.proxy(function () {
						if(this.data.hotkeys.enabled) { this.data.hotkeys.enabled = false; this.data.hotkeys.revert = true; }
					}, this))
				.bind("unlock.jstree", $.proxy(function () {
						if(this.data.hotkeys.revert) { this.data.hotkeys.enabled = true; }
					}, this));
			this.enable_hotkeys();
		},
		defaults : {
			"up" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected || -1;
				this.hover_node(this._get_prev(o));
				return false; 
			},
			"ctrl+up" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected || -1;
				this.hover_node(this._get_prev(o));
				return false; 
			},
			"shift+up" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected || -1;
				this.hover_node(this._get_prev(o));
				return false; 
			},
			"down" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected || -1;
				this.hover_node(this._get_next(o));
				return false;
			},
			"ctrl+down" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected || -1;
				this.hover_node(this._get_next(o));
				return false;
			},
			"shift+down" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected || -1;
				this.hover_node(this._get_next(o));
				return false;
			},
			"left" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected;
				if(o) {
					if(o.hasClass("jstree-open")) { this.close_node(o); }
					else { this.hover_node(this._get_prev(o)); }
				}
				return false;
			},
			"ctrl+left" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected;
				if(o) {
					if(o.hasClass("jstree-open")) { this.close_node(o); }
					else { this.hover_node(this._get_prev(o)); }
				}
				return false;
			},
			"shift+left" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected;
				if(o) {
					if(o.hasClass("jstree-open")) { this.close_node(o); }
					else { this.hover_node(this._get_prev(o)); }
				}
				return false;
			},
			"right" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected;
				if(o && o.length) {
					if(o.hasClass("jstree-closed")) { this.open_node(o); }
					else { this.hover_node(this._get_next(o)); }
				}
				return false;
			},
			"ctrl+right" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected;
				if(o && o.length) {
					if(o.hasClass("jstree-closed")) { this.open_node(o); }
					else { this.hover_node(this._get_next(o)); }
				}
				return false;
			},
			"shift+right" : function () { 
				var o = this.data.ui.hovered || this.data.ui.last_selected;
				if(o && o.length) {
					if(o.hasClass("jstree-closed")) { this.open_node(o); }
					else { this.hover_node(this._get_next(o)); }
				}
				return false;
			},
			"space" : function () { 
				if(this.data.ui.hovered) { this.data.ui.hovered.children("a:eq(0)").click(); } 
				return false; 
			},
			"ctrl+space" : function (event) { 
				event.type = "click";
				if(this.data.ui.hovered) { this.data.ui.hovered.children("a:eq(0)").trigger(event); } 
				return false; 
			},
			"shift+space" : function (event) { 
				event.type = "click";
				if(this.data.ui.hovered) { this.data.ui.hovered.children("a:eq(0)").trigger(event); } 
				return false; 
			},
			"f2" : function () { this.rename(this.data.ui.hovered || this.data.ui.last_selected); },
			"del" : function () { this.remove(this.data.ui.hovered || this._get_node(null)); }
		},
		_fn : {
			enable_hotkeys : function () {
				this.data.hotkeys.enabled = true;
			},
			disable_hotkeys : function () {
				this.data.hotkeys.enabled = false;
			}
		}
	});
})(jQuery);
//*/

/* 
 * jsTree JSON plugin
 * The JSON data store. Datastores are build by overriding the `load_node` and `_is_loaded` functions.
 */
(function ($) {
	$.jstree.plugin("json_data", {
		__init : function() {
			var s = this._get_settings().json_data;
			if(s.progressive_unload) {
				this.get_container().bind("after_close.jstree", function (e, data) {
					data.rslt.obj.children("ul").remove();
				});
			}
		},
		defaults : { 
			// `data` can be a function:
			//  * accepts two arguments - node being loaded and a callback to pass the result to
			//  * will be executed in the current tree's scope & ajax won't be supported
			data : false, 
			ajax : false,
			correct_state : true,
			progressive_render : false,
			progressive_unload : false
		},
		_fn : {
			load_node : function (obj, s_call, e_call) { var _this = this; this.load_node_json(obj, function () { _this.__callback({ "obj" : _this._get_node(obj) }); s_call.call(this); }, e_call); },
			_is_loaded : function (obj) { 
				var s = this._get_settings().json_data;
				obj = this._get_node(obj); 
				return obj == -1 || !obj || (!s.ajax && !s.progressive_render && !$.isFunction(s.data)) || obj.is(".jstree-open, .jstree-leaf") || obj.children("ul").children("li").length > 0;
			},
			refresh : function (obj) {
				obj = this._get_node(obj);
				var s = this._get_settings().json_data;
				if(obj && obj !== -1 && s.progressive_unload && ($.isFunction(s.data) || !!s.ajax)) {
					obj.removeData("jstree_children");
				}
				return this.__call_old();
			},
			load_node_json : function (obj, s_call, e_call) {
				var s = this.get_settings().json_data, d,
					error_func = function () {},
					success_func = function () {};
				obj = this._get_node(obj);

				if(obj && obj !== -1 && (s.progressive_render || s.progressive_unload) && !obj.is(".jstree-open, .jstree-leaf") && obj.children("ul").children("li").length === 0 && obj.data("jstree_children")) {
					d = this._parse_json(obj.data("jstree_children"), obj);
					if(d) {
						obj.append(d);
						if(!s.progressive_unload) { obj.removeData("jstree_children"); }
					}
					this.clean_node(obj);
					if(s_call) { s_call.call(this); }
					return;
				}

				if(obj && obj !== -1) {
					if(obj.data("jstree_is_loading")) { return; }
					else { obj.data("jstree_is_loading",true); }
				}
				switch(!0) {
					case (!s.data && !s.ajax): throw "Neither data nor ajax settings supplied.";
					// function option added here for easier model integration (also supporting async - see callback)
					case ($.isFunction(s.data)):
						s.data.call(this, obj, $.proxy(function (d) {
							d = this._parse_json(d, obj);
							if(!d) { 
								if(obj === -1 || !obj) {
									if(s.correct_state) { this.get_container().children("ul").empty(); }
								}
								else {
									obj.children("a.jstree-loading").removeClass("jstree-loading");
									obj.removeData("jstree_is_loading");
									if(s.correct_state) { this.correct_state(obj); }
								}
								if(e_call) { e_call.call(this); }
							}
							else {
								if(obj === -1 || !obj) { this.get_container().children("ul").empty().append(d.children()); }
								else { obj.append(d).children("a.jstree-loading").removeClass("jstree-loading"); obj.removeData("jstree_is_loading"); }
								this.clean_node(obj);
								if(s_call) { s_call.call(this); }
							}
						}, this));
						break;
					case (!!s.data && !s.ajax) || (!!s.data && !!s.ajax && (!obj || obj === -1)):
						if(!obj || obj == -1) {
							d = this._parse_json(s.data, obj);
							if(d) {
								this.get_container().children("ul").empty().append(d.children());
								this.clean_node();
							}
							else { 
								if(s.correct_state) { this.get_container().children("ul").empty(); }
							}
						}
						if(s_call) { s_call.call(this); }
						break;
					case (!s.data && !!s.ajax) || (!!s.data && !!s.ajax && obj && obj !== -1):
						error_func = function (x, t, e) {
							var ef = this.get_settings().json_data.ajax.error; 
							if(ef) { ef.call(this, x, t, e); }
							if(obj != -1 && obj.length) {
								obj.children("a.jstree-loading").removeClass("jstree-loading");
								obj.removeData("jstree_is_loading");
								if(t === "success" && s.correct_state) { this.correct_state(obj); }
							}
							else {
								if(t === "success" && s.correct_state) { this.get_container().children("ul").empty(); }
							}
							if(e_call) { e_call.call(this); }
						};
						success_func = function (d, t, x) {
							var sf = this.get_settings().json_data.ajax.success; 
							if(sf) { d = sf.call(this,d,t,x) || d; }
							if(d === "" || (d && d.toString && d.toString().replace(/^[\s\n]+$/,"") === "") || (!$.isArray(d) && !$.isPlainObject(d))) {
								return error_func.call(this, x, t, "");
							}
							d = this._parse_json(d, obj);
							if(d) {
								if(obj === -1 || !obj) { this.get_container().children("ul").empty().append(d.children()); }
								else { obj.append(d).children("a.jstree-loading").removeClass("jstree-loading"); obj.removeData("jstree_is_loading"); }
								this.clean_node(obj);
								if(s_call) { s_call.call(this); }
							}
							else {
								if(obj === -1 || !obj) {
									if(s.correct_state) { 
										this.get_container().children("ul").empty(); 
										if(s_call) { s_call.call(this); }
									}
								}
								else {
									obj.children("a.jstree-loading").removeClass("jstree-loading");
									obj.removeData("jstree_is_loading");
									if(s.correct_state) { 
										this.correct_state(obj);
										if(s_call) { s_call.call(this); } 
									}
								}
							}
						};
						s.ajax.context = this;
						s.ajax.error = error_func;
						s.ajax.success = success_func;
						if(!s.ajax.dataType) { s.ajax.dataType = "json"; }
						if($.isFunction(s.ajax.url)) { s.ajax.url = s.ajax.url.call(this, obj); }
						if($.isFunction(s.ajax.data)) { s.ajax.data = s.ajax.data.call(this, obj); }
						$.ajax(s.ajax);
						break;
				}
			},
			_parse_json : function (js, obj, is_callback) {
				var d = false, 
					p = this._get_settings(),
					s = p.json_data,
					t = p.core.html_titles,
					tmp, i, j, ul1, ul2;

				if(!js) { return d; }
				if(s.progressive_unload && obj && obj !== -1) { 
					obj.data("jstree_children", d);
				}
				if($.isArray(js)) {
					d = $();
					if(!js.length) { return false; }
					for(i = 0, j = js.length; i < j; i++) {
						tmp = this._parse_json(js[i], obj, true);
						if(tmp.length) { d = d.add(tmp); }
					}
				}
				else {
					if(typeof js == "string") { js = { data : js }; }
					if(!js.data && js.data !== "") { return d; }
					d = $("<li />");
					if(js.attr) { d.attr(js.attr); }
					if(js.metadata) { d.data(js.metadata); }
					if(js.state) { d.addClass("jstree-" + js.state); }
					if(!$.isArray(js.data)) { tmp = js.data; js.data = []; js.data.push(tmp); }
					$.each(js.data, function (i, m) {
						tmp = $("<a />");
						if($.isFunction(m)) { m = m.call(this, js); }
						if(typeof m == "string") { tmp.attr('href','#')[ t ? "html" : "text" ](m); }
						else {
							if(!m.attr) { m.attr = {}; }
							if(!m.attr.href) { m.attr.href = '#'; }
							tmp.attr(m.attr)[ t ? "html" : "text" ](m.title);
							if(m.language) { tmp.addClass(m.language); }
						}
						tmp.prepend("<ins class='jstree-icon'>&#160;</ins>");
						if(!m.icon && js.icon) { m.icon = js.icon; }
						if(m.icon) { 
							if(m.icon.indexOf("/") === -1) { tmp.children("ins").addClass(m.icon); }
							else { tmp.children("ins").css("background","url('" + m.icon + "') center center no-repeat"); }
						}
						d.append(tmp);
					});
					d.prepend("<ins class='jstree-icon'>&#160;</ins>");
					if(js.children) { 
						if(s.progressive_render && js.state !== "open") {
							d.addClass("jstree-closed").data("jstree_children", js.children);
						}
						else {
							if(s.progressive_unload) { d.data("jstree_children", js.children); }
							if($.isArray(js.children) && js.children.length) {
								tmp = this._parse_json(js.children, obj, true);
								if(tmp.length) {
									ul2 = $("<ul />");
									ul2.append(tmp);
									d.append(ul2);
								}
							}
						}
					}
				}
				if(!is_callback) {
					ul1 = $("<ul />");
					ul1.append(d);
					d = ul1;
				}
				return d;
			},
			get_json : function (obj, li_attr, a_attr, is_callback) {
				var result = [], 
					s = this._get_settings(), 
					_this = this,
					tmp1, tmp2, li, a, t, lang;
				obj = this._get_node(obj);
				if(!obj || obj === -1) { obj = this.get_container().find("> ul > li"); }
				li_attr = $.isArray(li_attr) ? li_attr : [ "id", "class" ];
				if(!is_callback && this.data.types) { li_attr.push(s.types.type_attr); }
				a_attr = $.isArray(a_attr) ? a_attr : [ ];

				obj.each(function () {
					li = $(this);
					tmp1 = { data : [] };
					if(li_attr.length) { tmp1.attr = { }; }
					$.each(li_attr, function (i, v) { 
						tmp2 = li.attr(v); 
						if(tmp2 && tmp2.length && tmp2.replace(/jstree[^ ]*/ig,'').length) {
							tmp1.attr[v] = (" " + tmp2).replace(/ jstree[^ ]*/ig,'').replace(/\s+$/ig," ").replace(/^ /,"").replace(/ $/,""); 
						}
					});
					if(li.hasClass("jstree-open")) { tmp1.state = "open"; }
					if(li.hasClass("jstree-closed")) { tmp1.state = "closed"; }
					if(li.data()) { tmp1.metadata = li.data(); }
					a = li.children("a");
					a.each(function () {
						t = $(this);
						if(
							a_attr.length || 
							$.inArray("languages", s.plugins) !== -1 || 
							t.children("ins").get(0).style.backgroundImage.length || 
							(t.children("ins").get(0).className && t.children("ins").get(0).className.replace(/jstree[^ ]*|$/ig,'').length)
						) { 
							lang = false;
							if($.inArray("languages", s.plugins) !== -1 && $.isArray(s.languages) && s.languages.length) {
								$.each(s.languages, function (l, lv) {
									if(t.hasClass(lv)) {
										lang = lv;
										return false;
									}
								});
							}
							tmp2 = { attr : { }, title : _this.get_text(t, lang) }; 
							$.each(a_attr, function (k, z) {
								tmp2.attr[z] = (" " + (t.attr(z) || "")).replace(/ jstree[^ ]*/ig,'').replace(/\s+$/ig," ").replace(/^ /,"").replace(/ $/,"");
							});
							if($.inArray("languages", s.plugins) !== -1 && $.isArray(s.languages) && s.languages.length) {
								$.each(s.languages, function (k, z) {
									if(t.hasClass(z)) { tmp2.language = z; return true; }
								});
							}
							if(t.children("ins").get(0).className.replace(/jstree[^ ]*|$/ig,'').replace(/^\s+$/ig,"").length) {
								tmp2.icon = t.children("ins").get(0).className.replace(/jstree[^ ]*|$/ig,'').replace(/\s+$/ig," ").replace(/^ /,"").replace(/ $/,"");
							}
							if(t.children("ins").get(0).style.backgroundImage.length) {
								tmp2.icon = t.children("ins").get(0).style.backgroundImage.replace("url(","").replace(")","");
							}
						}
						else {
							tmp2 = _this.get_text(t);
						}
						if(a.length > 1) { tmp1.data.push(tmp2); }
						else { tmp1.data = tmp2; }
					});
					li = li.find("> ul > li");
					if(li.length) { tmp1.children = _this.get_json(li, li_attr, a_attr, true); }
					result.push(tmp1);
				});
				return result;
			}
		}
	});
})(jQuery);
//*/

/* 
 * jsTree languages plugin
 * Adds support for multiple language versions in one tree
 * This basically allows for many titles coexisting in one node, but only one of them being visible at any given time
 * This is useful for maintaining the same structure in many languages (hence the name of the plugin)
 */
(function ($) {
	$.jstree.plugin("languages", {
		__init : function () { this._load_css();  },
		defaults : [],
		_fn : {
			set_lang : function (i) { 
				var langs = this._get_settings().languages,
					st = false,
					selector = ".jstree-" + this.get_index() + ' a';
				if(!$.isArray(langs) || langs.length === 0) { return false; }
				if($.inArray(i,langs) == -1) {
					if(!!langs[i]) { i = langs[i]; }
					else { return false; }
				}
				if(i == this.data.languages.current_language) { return true; }
				st = $.vakata.css.get_css(selector + "." + this.data.languages.current_language, false, this.data.languages.language_css);
				if(st !== false) { st.style.display = "none"; }
				st = $.vakata.css.get_css(selector + "." + i, false, this.data.languages.language_css);
				if(st !== false) { st.style.display = ""; }
				this.data.languages.current_language = i;
				this.__callback(i);
				return true;
			},
			get_lang : function () {
				return this.data.languages.current_language;
			},
			_get_string : function (key, lang) {
				var langs = this._get_settings().languages,
					s = this._get_settings().core.strings;
				if($.isArray(langs) && langs.length) {
					lang = (lang && $.inArray(lang,langs) != -1) ? lang : this.data.languages.current_language;
				}
				if(s[lang] && s[lang][key]) { return s[lang][key]; }
				if(s[key]) { return s[key]; }
				return key;
			},
			get_text : function (obj, lang) {
				obj = this._get_node(obj) || this.data.ui.last_selected;
				if(!obj.size()) { return false; }
				var langs = this._get_settings().languages,
					s = this._get_settings().core.html_titles;
				if($.isArray(langs) && langs.length) {
					lang = (lang && $.inArray(lang,langs) != -1) ? lang : this.data.languages.current_language;
					obj = obj.children("a." + lang);
				}
				else { obj = obj.children("a:eq(0)"); }
				if(s) {
					obj = obj.clone();
					obj.children("INS").remove();
					return obj.html();
				}
				else {
					obj = obj.contents().filter(function() { return this.nodeType == 3; })[0];
					return obj.nodeValue;
				}
			},
			set_text : function (obj, val, lang) {
				obj = this._get_node(obj) || this.data.ui.last_selected;
				if(!obj.size()) { return false; }
				var langs = this._get_settings().languages,
					s = this._get_settings().core.html_titles,
					tmp;
				if($.isArray(langs) && langs.length) {
					lang = (lang && $.inArray(lang,langs) != -1) ? lang : this.data.languages.current_language;
					obj = obj.children("a." + lang);
				}
				else { obj = obj.children("a:eq(0)"); }
				if(s) {
					tmp = obj.children("INS").clone();
					obj.html(val).prepend(tmp);
					this.__callback({ "obj" : obj, "name" : val, "lang" : lang });
					return true;
				}
				else {
					obj = obj.contents().filter(function() { return this.nodeType == 3; })[0];
					this.__callback({ "obj" : obj, "name" : val, "lang" : lang });
					return (obj.nodeValue = val);
				}
			},
			_load_css : function () {
				var langs = this._get_settings().languages,
					str = "/* languages css */",
					selector = ".jstree-" + this.get_index() + ' a',
					ln;
				if($.isArray(langs) && langs.length) {
					this.data.languages.current_language = langs[0];
					for(ln = 0; ln < langs.length; ln++) {
						str += selector + "." + langs[ln] + " {";
						if(langs[ln] != this.data.languages.current_language) { str += " display:none; "; }
						str += " } ";
					}
					this.data.languages.language_css = $.vakata.css.add_sheet({ 'str' : str, 'title' : "jstree-languages" });
				}
			},
			create_node : function (obj, position, js, callback) {
				var t = this.__call_old(true, obj, position, js, function (t) {
					var langs = this._get_settings().languages,
						a = t.children("a"),
						ln;
					if($.isArray(langs) && langs.length) {
						for(ln = 0; ln < langs.length; ln++) {
							if(!a.is("." + langs[ln])) {
								t.append(a.eq(0).clone().removeClass(langs.join(" ")).addClass(langs[ln]));
							}
						}
						a.not("." + langs.join(", .")).remove();
					}
					if(callback) { callback.call(this, t); }
				});
				return t;
			}
		}
	});
})(jQuery);
//*/

/*
 * jsTree cookies plugin
 * Stores the currently opened/selected nodes in a cookie and then restores them
 * Depends on the jquery.cookie plugin
 */
(function ($) {
	$.jstree.plugin("cookies", {
		__init : function () {
			if(typeof $.cookie === "undefined") { throw "jsTree cookie: jQuery cookie plugin not included."; }

			var s = this._get_settings().cookies,
				tmp;
			if(!!s.save_loaded) {
				tmp = $.cookie(s.save_loaded);
				if(tmp && tmp.length) { this.data.core.to_load = tmp.split(","); }
			}
			if(!!s.save_opened) {
				tmp = $.cookie(s.save_opened);
				if(tmp && tmp.length) { this.data.core.to_open = tmp.split(","); }
			}
			if(!!s.save_selected) {
				tmp = $.cookie(s.save_selected);
				if(tmp && tmp.length && this.data.ui) { this.data.ui.to_select = tmp.split(","); }
			}
			this.get_container()
				.one( ( this.data.ui ? "reselect" : "reopen" ) + ".jstree", $.proxy(function () {
					this.get_container()
						.bind("open_node.jstree close_node.jstree select_node.jstree deselect_node.jstree", $.proxy(function (e) { 
								if(this._get_settings().cookies.auto_save) { this.save_cookie((e.handleObj.namespace + e.handleObj.type).replace("jstree","")); }
							}, this));
				}, this));
		},
		defaults : {
			save_loaded		: "jstree_load",
			save_opened		: "jstree_open",
			save_selected	: "jstree_select",
			auto_save		: true,
			cookie_options	: {}
		},
		_fn : {
			save_cookie : function (c) {
				if(this.data.core.refreshing) { return; }
				var s = this._get_settings().cookies;
				if(!c) { // if called manually and not by event
					if(s.save_loaded) {
						this.save_loaded();
						$.cookie(s.save_loaded, this.data.core.to_load.join(","), s.cookie_options);
					}
					if(s.save_opened) {
						this.save_opened();
						$.cookie(s.save_opened, this.data.core.to_open.join(","), s.cookie_options);
					}
					if(s.save_selected && this.data.ui) {
						this.save_selected();
						$.cookie(s.save_selected, this.data.ui.to_select.join(","), s.cookie_options);
					}
					return;
				}
				switch(c) {
					case "open_node":
					case "close_node":
						if(!!s.save_opened) { 
							this.save_opened(); 
							$.cookie(s.save_opened, this.data.core.to_open.join(","), s.cookie_options); 
						}
						if(!!s.save_loaded) { 
							this.save_loaded(); 
							$.cookie(s.save_loaded, this.data.core.to_load.join(","), s.cookie_options); 
						}
						break;
					case "select_node":
					case "deselect_node":
						if(!!s.save_selected && this.data.ui) { 
							this.save_selected(); 
							$.cookie(s.save_selected, this.data.ui.to_select.join(","), s.cookie_options); 
						}
						break;
				}
			}
		}
	});
	// include cookies by default
	// $.jstree.defaults.plugins.push("cookies");
})(jQuery);
//*/

/*
 * jsTree sort plugin
 * Sorts items alphabetically (or using any other function)
 */
(function ($) {
	$.jstree.plugin("sort", {
		__init : function () {
			this.get_container()
				.bind("load_node.jstree", $.proxy(function (e, data) {
						var obj = this._get_node(data.rslt.obj);
						obj = obj === -1 ? this.get_container().children("ul") : obj.children("ul");
						this.sort(obj);
					}, this))
				.bind("rename_node.jstree create_node.jstree create.jstree", $.proxy(function (e, data) {
						this.sort(data.rslt.obj.parent());
					}, this))
				.bind("move_node.jstree", $.proxy(function (e, data) {
						var m = data.rslt.np == -1 ? this.get_container() : data.rslt.np;
						this.sort(m.children("ul"));
					}, this));
		},
		defaults : function (a, b) { return this.get_text(a) > this.get_text(b) ? 1 : -1; },
		_fn : {
			sort : function (obj) {
				var s = this._get_settings().sort,
					t = this;
				obj.append($.makeArray(obj.children("li")).sort($.proxy(s, t)));
				obj.find("> li > ul").each(function() { t.sort($(this)); });
				this.clean_node(obj);
			}
		}
	});
})(jQuery);
//*/

/*
 * jsTree DND plugin
 * Drag and drop plugin for moving/copying nodes
 */
(function ($) {
	var o = false,
		r = false,
		m = false,
		ml = false,
		sli = false,
		sti = false,
		dir1 = false,
		dir2 = false,
		last_pos = false;
	$.vakata.dnd = {
		is_down : false,
		is_drag : false,
		helper : false,
		scroll_spd : 10,
		init_x : 0,
		init_y : 0,
		threshold : 5,
		helper_left : 5,
		helper_top : 10,
		user_data : {},

		drag_start : function (e, data, html) { 
			if($.vakata.dnd.is_drag) { $.vakata.drag_stop({}); }
			try {
				e.currentTarget.unselectable = "on";
				e.currentTarget.onselectstart = function() { return false; };
				if(e.currentTarget.style) { e.currentTarget.style.MozUserSelect = "none"; }
			} catch(err) { }
			$.vakata.dnd.init_x = e.pageX;
			$.vakata.dnd.init_y = e.pageY;
			$.vakata.dnd.user_data = data;
			$.vakata.dnd.is_down = true;
			$.vakata.dnd.helper = $("<div id='vakata-dragged' />").html(html); //.fadeTo(10,0.25);
			$(document).bind("mousemove", $.vakata.dnd.drag);
			$(document).bind("mouseup", $.vakata.dnd.drag_stop);
			return false;
		},
		drag : function (e) { 
			if(!$.vakata.dnd.is_down) { return; }
			if(!$.vakata.dnd.is_drag) {
				if(Math.abs(e.pageX - $.vakata.dnd.init_x) > 5 || Math.abs(e.pageY - $.vakata.dnd.init_y) > 5) { 
					$.vakata.dnd.helper.appendTo("body");
					$.vakata.dnd.is_drag = true;
					$(document).triggerHandler("drag_start.vakata", { "event" : e, "data" : $.vakata.dnd.user_data });
				}
				else { return; }
			}

			// maybe use a scrolling parent element instead of document?
			if(e.type === "mousemove") { // thought of adding scroll in order to move the helper, but mouse poisition is n/a
				var d = $(document), t = d.scrollTop(), l = d.scrollLeft();
				if(e.pageY - t < 20) { 
					if(sti && dir1 === "down") { clearInterval(sti); sti = false; }
					if(!sti) { dir1 = "up"; sti = setInterval(function () { $(document).scrollTop($(document).scrollTop() - $.vakata.dnd.scroll_spd); }, 150); }
				}
				else { 
					if(sti && dir1 === "up") { clearInterval(sti); sti = false; }
				}
				if($(window).height() - (e.pageY - t) < 20) {
					if(sti && dir1 === "up") { clearInterval(sti); sti = false; }
					if(!sti) { dir1 = "down"; sti = setInterval(function () { $(document).scrollTop($(document).scrollTop() + $.vakata.dnd.scroll_spd); }, 150); }
				}
				else { 
					if(sti && dir1 === "down") { clearInterval(sti); sti = false; }
				}

				if(e.pageX - l < 20) {
					if(sli && dir2 === "right") { clearInterval(sli); sli = false; }
					if(!sli) { dir2 = "left"; sli = setInterval(function () { $(document).scrollLeft($(document).scrollLeft() - $.vakata.dnd.scroll_spd); }, 150); }
				}
				else { 
					if(sli && dir2 === "left") { clearInterval(sli); sli = false; }
				}
				if($(window).width() - (e.pageX - l) < 20) {
					if(sli && dir2 === "left") { clearInterval(sli); sli = false; }
					if(!sli) { dir2 = "right"; sli = setInterval(function () { $(document).scrollLeft($(document).scrollLeft() + $.vakata.dnd.scroll_spd); }, 150); }
				}
				else { 
					if(sli && dir2 === "right") { clearInterval(sli); sli = false; }
				}
			}

			$.vakata.dnd.helper.css({ left : (e.pageX + $.vakata.dnd.helper_left) + "px", top : (e.pageY + $.vakata.dnd.helper_top) + "px" });
			$(document).triggerHandler("drag.vakata", { "event" : e, "data" : $.vakata.dnd.user_data });
		},
		drag_stop : function (e) {
			if(sli) { clearInterval(sli); }
			if(sti) { clearInterval(sti); }
			$(document).unbind("mousemove", $.vakata.dnd.drag);
			$(document).unbind("mouseup", $.vakata.dnd.drag_stop);
			$(document).triggerHandler("drag_stop.vakata", { "event" : e, "data" : $.vakata.dnd.user_data });
			$.vakata.dnd.helper.remove();
			$.vakata.dnd.init_x = 0;
			$.vakata.dnd.init_y = 0;
			$.vakata.dnd.user_data = {};
			$.vakata.dnd.is_down = false;
			$.vakata.dnd.is_drag = false;
		}
	};
	$(function() {
		var css_string = '#vakata-dragged { display:block; margin:0 0 0 0; padding:4px 4px 4px 24px; position:absolute; top:-2000px; line-height:16px; z-index:10000; } ';
		$.vakata.css.add_sheet({ str : css_string, title : "vakata" });
	});

	$.jstree.plugin("dnd", {
		__init : function () {
			this.data.dnd = {
				active : false,
				after : false,
				inside : false,
				before : false,
				off : false,
				prepared : false,
				w : 0,
				to1 : false,
				to2 : false,
				cof : false,
				cw : false,
				ch : false,
				i1 : false,
				i2 : false,
				mto : false
			};
			this.get_container()
				.bind("mouseenter.jstree", $.proxy(function (e) {
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							if(this.data.themes) {
								m.attr("class", "jstree-" + this.data.themes.theme); 
								if(ml) { ml.attr("class", "jstree-" + this.data.themes.theme); }
								$.vakata.dnd.helper.attr("class", "jstree-dnd-helper jstree-" + this.data.themes.theme);
							}
							//if($(e.currentTarget).find("> ul > li").length === 0) {
							if(e.currentTarget === e.target && $.vakata.dnd.user_data.obj && $($.vakata.dnd.user_data.obj).length && $($.vakata.dnd.user_data.obj).parents(".jstree:eq(0)")[0] !== e.target) { // node should not be from the same tree
								var tr = $.jstree._reference(e.target), dc;
								if(tr.data.dnd.foreign) {
									dc = tr._get_settings().dnd.drag_check.call(this, { "o" : o, "r" : tr.get_container(), is_root : true });
									if(dc === true || dc.inside === true || dc.before === true || dc.after === true) {
										$.vakata.dnd.helper.children("ins").attr("class","jstree-ok");
									}
								}
								else {
									tr.prepare_move(o, tr.get_container(), "last");
									if(tr.check_move()) {
										$.vakata.dnd.helper.children("ins").attr("class","jstree-ok");
									}
								}
							}
						}
					}, this))
				.bind("mouseup.jstree", $.proxy(function (e) {
						//if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree && $(e.currentTarget).find("> ul > li").length === 0) {
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree && e.currentTarget === e.target && $.vakata.dnd.user_data.obj && $($.vakata.dnd.user_data.obj).length && $($.vakata.dnd.user_data.obj).parents(".jstree:eq(0)")[0] !== e.target) { // node should not be from the same tree
							var tr = $.jstree._reference(e.currentTarget), dc;
							if(tr.data.dnd.foreign) {
								dc = tr._get_settings().dnd.drag_check.call(this, { "o" : o, "r" : tr.get_container(), is_root : true });
								if(dc === true || dc.inside === true || dc.before === true || dc.after === true) {
									tr._get_settings().dnd.drag_finish.call(this, { "o" : o, "r" : tr.get_container(), is_root : true });
								}
							}
							else {
								tr.move_node(o, tr.get_container(), "last", e[tr._get_settings().dnd.copy_modifier + "Key"]);
							}
						}
					}, this))
				.bind("mouseleave.jstree", $.proxy(function (e) {
						if(e.relatedTarget && e.relatedTarget.id && e.relatedTarget.id === "jstree-marker-line") {
							return false; 
						}
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							if(this.data.dnd.i1) { clearInterval(this.data.dnd.i1); }
							if(this.data.dnd.i2) { clearInterval(this.data.dnd.i2); }
							if(this.data.dnd.to1) { clearTimeout(this.data.dnd.to1); }
							if(this.data.dnd.to2) { clearTimeout(this.data.dnd.to2); }
							if($.vakata.dnd.helper.children("ins").hasClass("jstree-ok")) {
								$.vakata.dnd.helper.children("ins").attr("class","jstree-invalid");
							}
						}
					}, this))
				.bind("mousemove.jstree", $.proxy(function (e) {
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							var cnt = this.get_container()[0];

							// Horizontal scroll
							if(e.pageX + 24 > this.data.dnd.cof.left + this.data.dnd.cw) {
								if(this.data.dnd.i1) { clearInterval(this.data.dnd.i1); }
								this.data.dnd.i1 = setInterval($.proxy(function () { this.scrollLeft += $.vakata.dnd.scroll_spd; }, cnt), 100);
							}
							else if(e.pageX - 24 < this.data.dnd.cof.left) {
								if(this.data.dnd.i1) { clearInterval(this.data.dnd.i1); }
								this.data.dnd.i1 = setInterval($.proxy(function () { this.scrollLeft -= $.vakata.dnd.scroll_spd; }, cnt), 100);
							}
							else {
								if(this.data.dnd.i1) { clearInterval(this.data.dnd.i1); }
							}

							// Vertical scroll
							if(e.pageY + 24 > this.data.dnd.cof.top + this.data.dnd.ch) {
								if(this.data.dnd.i2) { clearInterval(this.data.dnd.i2); }
								this.data.dnd.i2 = setInterval($.proxy(function () { this.scrollTop += $.vakata.dnd.scroll_spd; }, cnt), 100);
							}
							else if(e.pageY - 24 < this.data.dnd.cof.top) {
								if(this.data.dnd.i2) { clearInterval(this.data.dnd.i2); }
								this.data.dnd.i2 = setInterval($.proxy(function () { this.scrollTop -= $.vakata.dnd.scroll_spd; }, cnt), 100);
							}
							else {
								if(this.data.dnd.i2) { clearInterval(this.data.dnd.i2); }
							}

						}
					}, this))
				.bind("scroll.jstree", $.proxy(function (e) { 
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree && m && ml) {
							m.hide();
							ml.hide();
						}
					}, this))
				.delegate("a", "mousedown.jstree", $.proxy(function (e) { 
						if(e.which === 1) {
							this.start_drag(e.currentTarget, e);
							return false;
						}
					}, this))
				.delegate("a", "mouseenter.jstree", $.proxy(function (e) { 
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							this.dnd_enter(e.currentTarget);
						}
					}, this))
				.delegate("a", "mousemove.jstree", $.proxy(function (e) { 
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							if(!r || !r.length || r.children("a")[0] !== e.currentTarget) {
								this.dnd_enter(e.currentTarget);
							}
							if(typeof this.data.dnd.off.top === "undefined") { this.data.dnd.off = $(e.target).offset(); }
							this.data.dnd.w = (e.pageY - (this.data.dnd.off.top || 0)) % this.data.core.li_height;
							if(this.data.dnd.w < 0) { this.data.dnd.w += this.data.core.li_height; }
							this.dnd_show();
						}
					}, this))
				.delegate("a", "mouseleave.jstree", $.proxy(function (e) { 
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							if(e.relatedTarget && e.relatedTarget.id && e.relatedTarget.id === "jstree-marker-line") {
								return false; 
							}
								if(m) { m.hide(); }
								if(ml) { ml.hide(); }
							/*
							var ec = $(e.currentTarget).closest("li"), 
								er = $(e.relatedTarget).closest("li");
							if(er[0] !== ec.prev()[0] && er[0] !== ec.next()[0]) {
								if(m) { m.hide(); }
								if(ml) { ml.hide(); }
							}
							*/
							this.data.dnd.mto = setTimeout( 
								(function (t) { return function () { t.dnd_leave(e); }; })(this),
							0);
						}
					}, this))
				.delegate("a", "mouseup.jstree", $.proxy(function (e) { 
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree) {
							this.dnd_finish(e);
						}
					}, this));

			$(document)
				.bind("drag_stop.vakata", $.proxy(function () {
						if(this.data.dnd.to1) { clearTimeout(this.data.dnd.to1); }
						if(this.data.dnd.to2) { clearTimeout(this.data.dnd.to2); }
						if(this.data.dnd.i1) { clearInterval(this.data.dnd.i1); }
						if(this.data.dnd.i2) { clearInterval(this.data.dnd.i2); }
						this.data.dnd.after		= false;
						this.data.dnd.before	= false;
						this.data.dnd.inside	= false;
						this.data.dnd.off		= false;
						this.data.dnd.prepared	= false;
						this.data.dnd.w			= false;
						this.data.dnd.to1		= false;
						this.data.dnd.to2		= false;
						this.data.dnd.i1		= false;
						this.data.dnd.i2		= false;
						this.data.dnd.active	= false;
						this.data.dnd.foreign	= false;
						if(m) { m.css({ "top" : "-2000px" }); }
						if(ml) { ml.css({ "top" : "-2000px" }); }
					}, this))
				.bind("drag_start.vakata", $.proxy(function (e, data) {
						if(data.data.jstree) { 
							var et = $(data.event.target);
							if(et.closest(".jstree").hasClass("jstree-" + this.get_index())) {
								this.dnd_enter(et);
							}
						}
					}, this));
				/*
				.bind("keydown.jstree-" + this.get_index() + " keyup.jstree-" + this.get_index(), $.proxy(function(e) {
						if($.vakata.dnd.is_drag && $.vakata.dnd.user_data.jstree && !this.data.dnd.foreign) {
							var h = $.vakata.dnd.helper.children("ins");
							if(e[this._get_settings().dnd.copy_modifier + "Key"] && h.hasClass("jstree-ok")) {
								h.parent().html(h.parent().html().replace(/ \(Copy\)$/, "") + " (Copy)");
							} 
							else {
								h.parent().html(h.parent().html().replace(/ \(Copy\)$/, ""));
							}
						}
					}, this)); */



			var s = this._get_settings().dnd;
			if(s.drag_target) {
				$(document)
					.delegate(s.drag_target, "mousedown.jstree-" + this.get_index(), $.proxy(function (e) {
						o = e.target;
						$.vakata.dnd.drag_start(e, { jstree : true, obj : e.target }, "<ins class='jstree-icon'></ins>" + $(e.target).text() );
						if(this.data.themes) { 
							if(m) { m.attr("class", "jstree-" + this.data.themes.theme); }
							if(ml) { ml.attr("class", "jstree-" + this.data.themes.theme); }
							$.vakata.dnd.helper.attr("class", "jstree-dnd-helper jstree-" + this.data.themes.theme); 
						}
						$.vakata.dnd.helper.children("ins").attr("class","jstree-invalid");
						var cnt = this.get_container();
						this.data.dnd.cof = cnt.offset();
						this.data.dnd.cw = parseInt(cnt.width(),10);
						this.data.dnd.ch = parseInt(cnt.height(),10);
						this.data.dnd.foreign = true;
						e.preventDefault();
					}, this));
			}
			if(s.drop_target) {
				$(document)
					.delegate(s.drop_target, "mouseenter.jstree-" + this.get_index(), $.proxy(function (e) {
							if(this.data.dnd.active && this._get_settings().dnd.drop_check.call(this, { "o" : o, "r" : $(e.target), "e" : e })) {
								$.vakata.dnd.helper.children("ins").attr("class","jstree-ok");
							}
						}, this))
					.delegate(s.drop_target, "mouseleave.jstree-" + this.get_index(), $.proxy(function (e) {
							if(this.data.dnd.active) {
								$.vakata.dnd.helper.children("ins").attr("class","jstree-invalid");
							}
						}, this))
					.delegate(s.drop_target, "mouseup.jstree-" + this.get_index(), $.proxy(function (e) {
							if(this.data.dnd.active && $.vakata.dnd.helper.children("ins").hasClass("jstree-ok")) {
								this._get_settings().dnd.drop_finish.call(this, { "o" : o, "r" : $(e.target), "e" : e });
							}
						}, this));
			}
		},
		defaults : {
			copy_modifier	: "ctrl",
			check_timeout	: 100,
			open_timeout	: 500,
			drop_target		: ".jstree-drop",
			drop_check		: function (data) { return true; },
			drop_finish		: $.noop,
			drag_target		: ".jstree-draggable",
			drag_finish		: $.noop,
			drag_check		: function (data) { return { after : false, before : false, inside : true }; }
		},
		_fn : {
			dnd_prepare : function () {
				if(!r || !r.length) { return; }
				this.data.dnd.off = r.offset();
				if(this._get_settings().core.rtl) {
					this.data.dnd.off.right = this.data.dnd.off.left + r.width();
				}
				if(this.data.dnd.foreign) {
					var a = this._get_settings().dnd.drag_check.call(this, { "o" : o, "r" : r });
					this.data.dnd.after = a.after;
					this.data.dnd.before = a.before;
					this.data.dnd.inside = a.inside;
					this.data.dnd.prepared = true;
					return this.dnd_show();
				}
				this.prepare_move(o, r, "before");
				this.data.dnd.before = this.check_move();
				this.prepare_move(o, r, "after");
				this.data.dnd.after = this.check_move();
				if(this._is_loaded(r)) {
					this.prepare_move(o, r, "inside");
					this.data.dnd.inside = this.check_move();
				}
				else {
					this.data.dnd.inside = false;
				}
				this.data.dnd.prepared = true;
				return this.dnd_show();
			},
			dnd_show : function () {
				if(!this.data.dnd.prepared) { return; }
				var o = ["before","inside","after"],
					r = false,
					rtl = this._get_settings().core.rtl,
					pos;
				if(this.data.dnd.w < this.data.core.li_height/3) { o = ["before","inside","after"]; }
				else if(this.data.dnd.w <= this.data.core.li_height*2/3) {
					o = this.data.dnd.w < this.data.core.li_height/2 ? ["inside","before","after"] : ["inside","after","before"];
				}
				else { o = ["after","inside","before"]; }
				$.each(o, $.proxy(function (i, val) { 
					if(this.data.dnd[val]) {
						$.vakata.dnd.helper.children("ins").attr("class","jstree-ok");
						r = val;
						return false;
					}
				}, this));
				if(r === false) { $.vakata.dnd.helper.children("ins").attr("class","jstree-invalid"); }
				
				pos = rtl ? (this.data.dnd.off.right - 18) : (this.data.dnd.off.left + 10);
				switch(r) {
					case "before":
						m.css({ "left" : pos + "px", "top" : (this.data.dnd.off.top - 6) + "px" }).show();
						if(ml) { ml.css({ "left" : (pos + 8) + "px", "top" : (this.data.dnd.off.top - 1) + "px" }).show(); }
						break;
					case "after":
						m.css({ "left" : pos + "px", "top" : (this.data.dnd.off.top + this.data.core.li_height - 6) + "px" }).show();
						if(ml) { ml.css({ "left" : (pos + 8) + "px", "top" : (this.data.dnd.off.top + this.data.core.li_height - 1) + "px" }).show(); }
						break;
					case "inside":
						m.css({ "left" : pos + ( rtl ? -4 : 4) + "px", "top" : (this.data.dnd.off.top + this.data.core.li_height/2 - 5) + "px" }).show();
						if(ml) { ml.hide(); }
						break;
					default:
						m.hide();
						if(ml) { ml.hide(); }
						break;
				}
				last_pos = r;
				return r;
			},
			dnd_open : function () {
				this.data.dnd.to2 = false;
				this.open_node(r, $.proxy(this.dnd_prepare,this), true);
			},
			dnd_finish : function (e) {
				if(this.data.dnd.foreign) {
					if(this.data.dnd.after || this.data.dnd.before || this.data.dnd.inside) {
						this._get_settings().dnd.drag_finish.call(this, { "o" : o, "r" : r, "p" : last_pos });
					}
				}
				else {
					this.dnd_prepare();
					this.move_node(o, r, last_pos, e[this._get_settings().dnd.copy_modifier + "Key"]);
				}
				o = false;
				r = false;
				m.hide();
				if(ml) { ml.hide(); }
			},
			dnd_enter : function (obj) {
				if(this.data.dnd.mto) { 
					clearTimeout(this.data.dnd.mto);
					this.data.dnd.mto = false;
				}
				var s = this._get_settings().dnd;
				this.data.dnd.prepared = false;
				r = this._get_node(obj);
				if(s.check_timeout) { 
					// do the calculations after a minimal timeout (users tend to drag quickly to the desired location)
					if(this.data.dnd.to1) { clearTimeout(this.data.dnd.to1); }
					this.data.dnd.to1 = setTimeout($.proxy(this.dnd_prepare, this), s.check_timeout); 
				}
				else { 
					this.dnd_prepare(); 
				}
				if(s.open_timeout) { 
					if(this.data.dnd.to2) { clearTimeout(this.data.dnd.to2); }
					if(r && r.length && r.hasClass("jstree-closed")) { 
						// if the node is closed - open it, then recalculate
						this.data.dnd.to2 = setTimeout($.proxy(this.dnd_open, this), s.open_timeout);
					}
				}
				else {
					if(r && r.length && r.hasClass("jstree-closed")) { 
						this.dnd_open();
					}
				}
			},
			dnd_leave : function (e) {
				this.data.dnd.after		= false;
				this.data.dnd.before	= false;
				this.data.dnd.inside	= false;
				$.vakata.dnd.helper.children("ins").attr("class","jstree-invalid");
				m.hide();
				if(ml) { ml.hide(); }
				if(r && r[0] === e.target.parentNode) {
					if(this.data.dnd.to1) {
						clearTimeout(this.data.dnd.to1);
						this.data.dnd.to1 = false;
					}
					if(this.data.dnd.to2) {
						clearTimeout(this.data.dnd.to2);
						this.data.dnd.to2 = false;
					}
				}
			},
			start_drag : function (obj, e) {
				o = this._get_node(obj);
				if(this.data.ui && this.is_selected(o)) { o = this._get_node(null, true); }
				var dt = o.length > 1 ? this._get_string("multiple_selection") : this.get_text(o),
					cnt = this.get_container();
				if(!this._get_settings().core.html_titles) { dt = dt.replace(/</ig,"&lt;").replace(/>/ig,"&gt;"); }
				$.vakata.dnd.drag_start(e, { jstree : true, obj : o }, "<ins class='jstree-icon'></ins>" + dt );
				if(this.data.themes) { 
					if(m) { m.attr("class", "jstree-" + this.data.themes.theme); }
					if(ml) { ml.attr("class", "jstree-" + this.data.themes.theme); }
					$.vakata.dnd.helper.attr("class", "jstree-dnd-helper jstree-" + this.data.themes.theme); 
				}
				this.data.dnd.cof = cnt.offset();
				this.data.dnd.cw = parseInt(cnt.width(),10);
				this.data.dnd.ch = parseInt(cnt.height(),10);
				this.data.dnd.active = true;
			}
		}
	});
	$(function() {
		var css_string = '' + 
			'#vakata-dragged ins { display:block; text-decoration:none; width:16px; height:16px; margin:0 0 0 0; padding:0; position:absolute; top:4px; left:4px; ' + 
			' -moz-border-radius:4px; border-radius:4px; -webkit-border-radius:4px; ' +
			'} ' + 
			'#vakata-dragged .jstree-ok { background:green; } ' + 
			'#vakata-dragged .jstree-invalid { background:red; } ' + 
			'#jstree-marker { padding:0; margin:0; font-size:12px; overflow:hidden; height:12px; width:8px; position:absolute; top:-30px; z-index:10001; background-repeat:no-repeat; display:none; background-color:transparent; text-shadow:1px 1px 1px white; color:black; line-height:10px; } ' + 
			'#jstree-marker-line { padding:0; margin:0; line-height:0%; font-size:1px; overflow:hidden; height:1px; width:100px; position:absolute; top:-30px; z-index:10000; background-repeat:no-repeat; display:none; background-color:#456c43; ' + 
			' cursor:pointer; border:1px solid #eeeeee; border-left:0; -moz-box-shadow: 0px 0px 2px #666; -webkit-box-shadow: 0px 0px 2px #666; box-shadow: 0px 0px 2px #666; ' + 
			' -moz-border-radius:1px; border-radius:1px; -webkit-border-radius:1px; ' +
			'}' + 
			'';
		$.vakata.css.add_sheet({ str : css_string, title : "jstree" });
		m = $("<div />").attr({ id : "jstree-marker" }).hide().html("&raquo;")
			.bind("mouseleave mouseenter", function (e) { 
				m.hide();
				ml.hide();
				e.preventDefault(); 
				e.stopImmediatePropagation(); 
				return false; 
			})
			.appendTo("body");
		ml = $("<div />").attr({ id : "jstree-marker-line" }).hide()
			.bind("mouseup", function (e) { 
				if(r && r.length) { 
					r.children("a").trigger(e); 
					e.preventDefault(); 
					e.stopImmediatePropagation(); 
					return false; 
				} 
			})
			.bind("mouseleave", function (e) { 
				var rt = $(e.relatedTarget);
				if(rt.is(".jstree") || rt.closest(".jstree").length === 0) {
					if(r && r.length) { 
						r.children("a").trigger(e); 
						m.hide();
						ml.hide();
						e.preventDefault(); 
						e.stopImmediatePropagation(); 
						return false; 
					}
				}
			})
			.appendTo("body");
		$(document).bind("drag_start.vakata", function (e, data) {
			if(data.data.jstree) { m.show(); if(ml) { ml.show(); } }
		});
		$(document).bind("drag_stop.vakata", function (e, data) {
			if(data.data.jstree) { m.hide(); if(ml) { ml.hide(); } }
		});
	});
})(jQuery);
//*/

/*
 * jsTree checkbox plugin
 * Inserts checkboxes in front of every node
 * Depends on the ui plugin
 * DOES NOT WORK NICELY WITH MULTITREE DRAG'N'DROP
 */
(function ($) {
	$.jstree.plugin("checkbox", {
		__init : function () {
			this.data.checkbox.noui = this._get_settings().checkbox.override_ui;
			if(this.data.ui && this.data.checkbox.noui) {
				this.select_node = this.deselect_node = this.deselect_all = $.noop;
				this.get_selected = this.get_checked;
			}

			this.get_container()
				.bind("open_node.jstree create_node.jstree clean_node.jstree refresh.jstree", $.proxy(function (e, data) { 
						this._prepare_checkboxes(data.rslt.obj);
					}, this))
				.bind("loaded.jstree", $.proxy(function (e) {
						this._prepare_checkboxes();
					}, this))
				.delegate( (this.data.ui && this.data.checkbox.noui ? "a" : "ins.jstree-checkbox") , "click.jstree", $.proxy(function (e) {
						e.preventDefault();
						if(this._get_node(e.target).hasClass("jstree-checked")) { this.uncheck_node(e.target); }
						else { this.check_node(e.target); }
						if(this.data.ui && this.data.checkbox.noui) {
							this.save_selected();
							if(this.data.cookies) { this.save_cookie("select_node"); }
						}
						else {
							e.stopImmediatePropagation();
							return false;
						}
					}, this));
		},
		defaults : {
			override_ui : false,
			two_state : false,
			real_checkboxes : false,
			checked_parent_open : true,
			real_checkboxes_names : function (n) { return [ ("check_" + (n[0].id || Math.ceil(Math.random() * 10000))) , 1]; }
		},
		__destroy : function () {
			this.get_container()
				.find("input.jstree-real-checkbox").removeClass("jstree-real-checkbox").end()
				.find("ins.jstree-checkbox").remove();
		},
		_fn : {
			_checkbox_notify : function (n, data) {
				if(data.checked) {
					this.check_node(n, false);
				}
			},
			_prepare_checkboxes : function (obj) {
				obj = !obj || obj == -1 ? this.get_container().find("> ul > li") : this._get_node(obj);
				if(obj === false) { return; } // added for removing root nodes
				var c, _this = this, t, ts = this._get_settings().checkbox.two_state, rc = this._get_settings().checkbox.real_checkboxes, rcn = this._get_settings().checkbox.real_checkboxes_names;
				obj.each(function () {
					t = $(this);
					c = t.is("li") && (t.hasClass("jstree-checked") || (rc && t.children(":checked").length)) ? "jstree-checked" : "jstree-unchecked";
					t.find("li").andSelf().each(function () {
						var $t = $(this), nm;
						$t.children("a" + (_this.data.languages ? "" : ":eq(0)") ).not(":has(.jstree-checkbox)").prepend("<ins class='jstree-checkbox'>&#160;</ins>").parent().not(".jstree-checked, .jstree-unchecked").addClass( ts ? "jstree-unchecked" : c );
						if(rc) {
							if(!$t.children(":checkbox").length) {
								nm = rcn.call(_this, $t);
								$t.prepend("<input type='checkbox' class='jstree-real-checkbox' id='" + nm[0] + "' name='" + nm[0] + "' value='" + nm[1] + "' />");
							}
							else {
								$t.children(":checkbox").addClass("jstree-real-checkbox");
							}
						}
						if(!ts) {
							if(c === "jstree-checked" || $t.hasClass("jstree-checked") || $t.children(':checked').length) {
								$t.find("li").andSelf().addClass("jstree-checked").children(":checkbox").prop("checked", true);
							}
						}
						else {
							if($t.hasClass("jstree-checked") || $t.children(':checked').length) {
								$t.addClass("jstree-checked").children(":checkbox").prop("checked", true);
							}
						}
					});
				});
				if(!ts) {
					obj.find(".jstree-checked").parent().parent().each(function () { _this._repair_state(this); }); 
				}
			},
			change_state : function (obj, state) {
				obj = this._get_node(obj);
				var coll = false, rc = this._get_settings().checkbox.real_checkboxes;
				if(!obj || obj === -1) { return false; }
				state = (state === false || state === true) ? state : obj.hasClass("jstree-checked");
				if(this._get_settings().checkbox.two_state) {
					if(state) { 
						obj.removeClass("jstree-checked").addClass("jstree-unchecked"); 
						if(rc) { obj.children(":checkbox").prop("checked", false); }
					}
					else { 
						obj.removeClass("jstree-unchecked").addClass("jstree-checked"); 
						if(rc) { obj.children(":checkbox").prop("checked", true); }
					}
				}
				else {
					if(state) { 
						coll = obj.find("li").andSelf();
						if(!coll.filter(".jstree-checked, .jstree-undetermined").length) { return false; }
						coll.removeClass("jstree-checked jstree-undetermined").addClass("jstree-unchecked"); 
						if(rc) { coll.children(":checkbox").prop("checked", false); }
					}
					else { 
						coll = obj.find("li").andSelf();
						if(!coll.filter(".jstree-unchecked, .jstree-undetermined").length) { return false; }
						coll.removeClass("jstree-unchecked jstree-undetermined").addClass("jstree-checked"); 
						if(rc) { coll.children(":checkbox").prop("checked", true); }
						if(this.data.ui) { this.data.ui.last_selected = obj; }
						this.data.checkbox.last_selected = obj;
					}
					obj.parentsUntil(".jstree", "li").each(function () {
						var $this = $(this);
						if(state) {
							if($this.children("ul").children("li.jstree-checked, li.jstree-undetermined").length) {
								$this.parentsUntil(".jstree", "li").andSelf().removeClass("jstree-checked jstree-unchecked").addClass("jstree-undetermined");
								if(rc) { $this.parentsUntil(".jstree", "li").andSelf().children(":checkbox").prop("checked", false); }
								return false;
							}
							else {
								$this.removeClass("jstree-checked jstree-undetermined").addClass("jstree-unchecked");
								if(rc) { $this.children(":checkbox").prop("checked", false); }
							}
						}
						else {
							if($this.children("ul").children("li.jstree-unchecked, li.jstree-undetermined").length) {
								$this.parentsUntil(".jstree", "li").andSelf().removeClass("jstree-checked jstree-unchecked").addClass("jstree-undetermined");
								if(rc) { $this.parentsUntil(".jstree", "li").andSelf().children(":checkbox").prop("checked", false); }
								return false;
							}
							else {
								$this.removeClass("jstree-unchecked jstree-undetermined").addClass("jstree-checked");
								if(rc) { $this.children(":checkbox").prop("checked", true); }
							}
						}
					});
				}
				if(this.data.ui && this.data.checkbox.noui) { this.data.ui.selected = this.get_checked(); }
				this.__callback(obj);
				return true;
			},
			check_node : function (obj) {
				if(this.change_state(obj, false)) { 
					obj = this._get_node(obj);
					if(this._get_settings().checkbox.checked_parent_open) {
						var t = this;
						obj.parents(".jstree-closed").each(function () { t.open_node(this, false, true); });
					}
					this.__callback({ "obj" : obj }); 
				}
			},
			uncheck_node : function (obj) {
				if(this.change_state(obj, true)) { this.__callback({ "obj" : this._get_node(obj) }); }
			},
			check_all : function () {
				var _this = this, 
					coll = this._get_settings().checkbox.two_state ? this.get_container_ul().find("li") : this.get_container_ul().children("li");
				coll.each(function () {
					_this.change_state(this, false);
				});
				this.__callback();
			},
			uncheck_all : function () {
				var _this = this,
					coll = this._get_settings().checkbox.two_state ? this.get_container_ul().find("li") : this.get_container_ul().children("li");
				coll.each(function () {
					_this.change_state(this, true);
				});
				this.__callback();
			},

			is_checked : function(obj) {
				obj = this._get_node(obj);
				return obj.length ? obj.is(".jstree-checked") : false;
			},
			get_checked : function (obj, get_all) {
				obj = !obj || obj === -1 ? this.get_container() : this._get_node(obj);
				return get_all || this._get_settings().checkbox.two_state ? obj.find(".jstree-checked") : obj.find("> ul > .jstree-checked, .jstree-undetermined > ul > .jstree-checked");
			},
			get_unchecked : function (obj, get_all) { 
				obj = !obj || obj === -1 ? this.get_container() : this._get_node(obj);
				return get_all || this._get_settings().checkbox.two_state ? obj.find(".jstree-unchecked") : obj.find("> ul > .jstree-unchecked, .jstree-undetermined > ul > .jstree-unchecked");
			},

			show_checkboxes : function () { this.get_container().children("ul").removeClass("jstree-no-checkboxes"); },
			hide_checkboxes : function () { this.get_container().children("ul").addClass("jstree-no-checkboxes"); },

			_repair_state : function (obj) {
				obj = this._get_node(obj);
				if(!obj.length) { return; }
				if(this._get_settings().checkbox.two_state) {
					obj.find('li').andSelf().not('.jstree-checked').removeClass('jstree-undetermined').addClass('jstree-unchecked').children(':checkbox').prop('checked', true);
					return;
				}
				var rc = this._get_settings().checkbox.real_checkboxes,
					a = obj.find("> ul > .jstree-checked").length,
					b = obj.find("> ul > .jstree-undetermined").length,
					c = obj.find("> ul > li").length;
				if(c === 0) { if(obj.hasClass("jstree-undetermined")) { this.change_state(obj, false); } }
				else if(a === 0 && b === 0) { this.change_state(obj, true); }
				else if(a === c) { this.change_state(obj, false); }
				else { 
					obj.parentsUntil(".jstree","li").andSelf().removeClass("jstree-checked jstree-unchecked").addClass("jstree-undetermined");
					if(rc) { obj.parentsUntil(".jstree", "li").andSelf().children(":checkbox").prop("checked", false); }
				}
			},
			reselect : function () {
				if(this.data.ui && this.data.checkbox.noui) { 
					var _this = this,
						s = this.data.ui.to_select;
					s = $.map($.makeArray(s), function (n) { return "#" + n.toString().replace(/^#/,"").replace(/\\\//g,"/").replace(/\//g,"\\\/").replace(/\\\./g,".").replace(/\./g,"\\.").replace(/\:/g,"\\:"); });
					this.deselect_all();
					$.each(s, function (i, val) { _this.check_node(val); });
					this.__callback();
				}
				else { 
					this.__call_old(); 
				}
			},
			save_loaded : function () {
				var _this = this;
				this.data.core.to_load = [];
				this.get_container_ul().find("li.jstree-closed.jstree-undetermined").each(function () {
					if(this.id) { _this.data.core.to_load.push("#" + this.id); }
				});
			}
		}
	});
	$(function() {
		var css_string = '.jstree .jstree-real-checkbox { display:none; } ';
		$.vakata.css.add_sheet({ str : css_string, title : "jstree" });
	});
})(jQuery);
//*/

/* 
 * jsTree XML plugin
 * The XML data store. Datastores are build by overriding the `load_node` and `_is_loaded` functions.
 */
(function ($) {
	$.vakata.xslt = function (xml, xsl, callback) {
		var rs = "", xm, xs, processor, support;
		// TODO: IE9 no XSLTProcessor, no document.recalc
		if(document.recalc) {
			xm = document.createElement('xml');
			xs = document.createElement('xml');
			xm.innerHTML = xml;
			xs.innerHTML = xsl;
			$("body").append(xm).append(xs);
			setTimeout( (function (xm, xs, callback) {
				return function () {
					callback.call(null, xm.transformNode(xs.XMLDocument));
					setTimeout( (function (xm, xs) { return function () { $(xm).remove(); $(xs).remove(); }; })(xm, xs), 200);
				};
			})(xm, xs, callback), 100);
			return true;
		}
		if(typeof window.DOMParser !== "undefined" && typeof window.XMLHttpRequest !== "undefined" && typeof window.XSLTProcessor === "undefined") {
			xml = new DOMParser().parseFromString(xml, "text/xml");
			xsl = new DOMParser().parseFromString(xsl, "text/xml");
			// alert(xml.transformNode());
			// callback.call(null, new XMLSerializer().serializeToString(rs));
			
		}
		if(typeof window.DOMParser !== "undefined" && typeof window.XMLHttpRequest !== "undefined" && typeof window.XSLTProcessor !== "undefined") {
			processor = new XSLTProcessor();
			support = $.isFunction(processor.transformDocument) ? (typeof window.XMLSerializer !== "undefined") : true;
			if(!support) { return false; }
			xml = new DOMParser().parseFromString(xml, "text/xml");
			xsl = new DOMParser().parseFromString(xsl, "text/xml");
			if($.isFunction(processor.transformDocument)) {
				rs = document.implementation.createDocument("", "", null);
				processor.transformDocument(xml, xsl, rs, null);
				callback.call(null, new XMLSerializer().serializeToString(rs));
				return true;
			}
			else {
				processor.importStylesheet(xsl);
				rs = processor.transformToFragment(xml, document);
				callback.call(null, $("<div />").append(rs).html());
				return true;
			}
		}
		return false;
	};
	var xsl = {
		'nest' : '<' + '?xml version="1.0" encoding="utf-8" ?>' + 
			'<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >' + 
			'<xsl:output method="html" encoding="utf-8" omit-xml-declaration="yes" standalone="no" indent="no" media-type="text/html" />' + 
			'<xsl:template match="/">' + 
			'	<xsl:call-template name="nodes">' + 
			'		<xsl:with-param name="node" select="/root" />' + 
			'	</xsl:call-template>' + 
			'</xsl:template>' + 
			'<xsl:template name="nodes">' + 
			'	<xsl:param name="node" />' + 
			'	<ul>' + 
			'	<xsl:for-each select="$node/item">' + 
			'		<xsl:variable name="children" select="count(./item) &gt; 0" />' + 
			'		<li>' + 
			'			<xsl:attribute name="class">' + 
			'				<xsl:if test="position() = last()">jstree-last </xsl:if>' + 
			'				<xsl:choose>' + 
			'					<xsl:when test="@state = \'open\'">jstree-open </xsl:when>' + 
			'					<xsl:when test="$children or @hasChildren or @state = \'closed\'">jstree-closed </xsl:when>' + 
			'					<xsl:otherwise>jstree-leaf </xsl:otherwise>' + 
			'				</xsl:choose>' + 
			'				<xsl:value-of select="@class" />' + 
			'			</xsl:attribute>' + 
			'			<xsl:for-each select="@*">' + 
			'				<xsl:if test="name() != \'class\' and name() != \'state\' and name() != \'hasChildren\'">' + 
			'					<xsl:attribute name="{name()}"><xsl:value-of select="." /></xsl:attribute>' + 
			'				</xsl:if>' + 
			'			</xsl:for-each>' + 
			'	<ins class="jstree-icon"><xsl:text>&#xa0;</xsl:text></ins>' + 
			'			<xsl:for-each select="content/name">' + 
			'				<a>' + 
			'				<xsl:attribute name="href">' + 
			'					<xsl:choose>' + 
			'					<xsl:when test="@href"><xsl:value-of select="@href" /></xsl:when>' + 
			'					<xsl:otherwise>#</xsl:otherwise>' + 
			'					</xsl:choose>' + 
			'				</xsl:attribute>' + 
			'				<xsl:attribute name="class"><xsl:value-of select="@lang" /> <xsl:value-of select="@class" /></xsl:attribute>' + 
			'				<xsl:attribute name="style"><xsl:value-of select="@style" /></xsl:attribute>' + 
			'				<xsl:for-each select="@*">' + 
			'					<xsl:if test="name() != \'style\' and name() != \'class\' and name() != \'href\'">' + 
			'						<xsl:attribute name="{name()}"><xsl:value-of select="." /></xsl:attribute>' + 
			'					</xsl:if>' + 
			'				</xsl:for-each>' + 
			'					<ins>' + 
			'						<xsl:attribute name="class">jstree-icon ' + 
			'							<xsl:if test="string-length(attribute::icon) > 0 and not(contains(@icon,\'/\'))"><xsl:value-of select="@icon" /></xsl:if>' + 
			'						</xsl:attribute>' + 
			'						<xsl:if test="string-length(attribute::icon) > 0 and contains(@icon,\'/\')"><xsl:attribute name="style">background:url(<xsl:value-of select="@icon" />) center center no-repeat;</xsl:attribute></xsl:if>' + 
			'						<xsl:text>&#xa0;</xsl:text>' + 
			'					</ins>' + 
			'					<xsl:copy-of select="./child::node()" />' + 
			'				</a>' + 
			'			</xsl:for-each>' + 
			'			<xsl:if test="$children or @hasChildren"><xsl:call-template name="nodes"><xsl:with-param name="node" select="current()" /></xsl:call-template></xsl:if>' + 
			'		</li>' + 
			'	</xsl:for-each>' + 
			'	</ul>' + 
			'</xsl:template>' + 
			'</xsl:stylesheet>',

		'flat' : '<' + '?xml version="1.0" encoding="utf-8" ?>' + 
			'<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >' + 
			'<xsl:output method="html" encoding="utf-8" omit-xml-declaration="yes" standalone="no" indent="no" media-type="text/xml" />' + 
			'<xsl:template match="/">' + 
			'	<ul>' + 
			'	<xsl:for-each select="//item[not(@parent_id) or @parent_id=0 or not(@parent_id = //item/@id)]">' + /* the last `or` may be removed */
			'		<xsl:call-template name="nodes">' + 
			'			<xsl:with-param name="node" select="." />' + 
			'			<xsl:with-param name="is_last" select="number(position() = last())" />' + 
			'		</xsl:call-template>' + 
			'	</xsl:for-each>' + 
			'	</ul>' + 
			'</xsl:template>' + 
			'<xsl:template name="nodes">' + 
			'	<xsl:param name="node" />' + 
			'	<xsl:param name="is_last" />' + 
			'	<xsl:variable name="children" select="count(//item[@parent_id=$node/attribute::id]) &gt; 0" />' + 
			'	<li>' + 
			'	<xsl:attribute name="class">' + 
			'		<xsl:if test="$is_last = true()">jstree-last </xsl:if>' + 
			'		<xsl:choose>' + 
			'			<xsl:when test="@state = \'open\'">jstree-open </xsl:when>' + 
			'			<xsl:when test="$children or @hasChildren or @state = \'closed\'">jstree-closed </xsl:when>' + 
			'			<xsl:otherwise>jstree-leaf </xsl:otherwise>' + 
			'		</xsl:choose>' + 
			'		<xsl:value-of select="@class" />' + 
			'	</xsl:attribute>' + 
			'	<xsl:for-each select="@*">' + 
			'		<xsl:if test="name() != \'parent_id\' and name() != \'hasChildren\' and name() != \'class\' and name() != \'state\'">' + 
			'		<xsl:attribute name="{name()}"><xsl:value-of select="." /></xsl:attribute>' + 
			'		</xsl:if>' + 
			'	</xsl:for-each>' + 
			'	<ins class="jstree-icon"><xsl:text>&#xa0;</xsl:text></ins>' + 
			'	<xsl:for-each select="content/name">' + 
			'		<a>' + 
			'		<xsl:attribute name="href">' + 
			'			<xsl:choose>' + 
			'			<xsl:when test="@href"><xsl:value-of select="@href" /></xsl:when>' + 
			'			<xsl:otherwise>#</xsl:otherwise>' + 
			'			</xsl:choose>' + 
			'		</xsl:attribute>' + 
			'		<xsl:attribute name="class"><xsl:value-of select="@lang" /> <xsl:value-of select="@class" /></xsl:attribute>' + 
			'		<xsl:attribute name="style"><xsl:value-of select="@style" /></xsl:attribute>' + 
			'		<xsl:for-each select="@*">' + 
			'			<xsl:if test="name() != \'style\' and name() != \'class\' and name() != \'href\'">' + 
			'				<xsl:attribute name="{name()}"><xsl:value-of select="." /></xsl:attribute>' + 
			'			</xsl:if>' + 
			'		</xsl:for-each>' + 
			'			<ins>' + 
			'				<xsl:attribute name="class">jstree-icon ' + 
			'					<xsl:if test="string-length(attribute::icon) > 0 and not(contains(@icon,\'/\'))"><xsl:value-of select="@icon" /></xsl:if>' + 
			'				</xsl:attribute>' + 
			'				<xsl:if test="string-length(attribute::icon) > 0 and contains(@icon,\'/\')"><xsl:attribute name="style">background:url(<xsl:value-of select="@icon" />) center center no-repeat;</xsl:attribute></xsl:if>' + 
			'				<xsl:text>&#xa0;</xsl:text>' + 
			'			</ins>' + 
			'			<xsl:copy-of select="./child::node()" />' + 
			'		</a>' + 
			'	</xsl:for-each>' + 
			'	<xsl:if test="$children">' + 
			'		<ul>' + 
			'		<xsl:for-each select="//item[@parent_id=$node/attribute::id]">' + 
			'			<xsl:call-template name="nodes">' + 
			'				<xsl:with-param name="node" select="." />' + 
			'				<xsl:with-param name="is_last" select="number(position() = last())" />' + 
			'			</xsl:call-template>' + 
			'		</xsl:for-each>' + 
			'		</ul>' + 
			'	</xsl:if>' + 
			'	</li>' + 
			'</xsl:template>' + 
			'</xsl:stylesheet>'
	},
	escape_xml = function(string) {
		return string
			.toString()
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&apos;');
	};
	$.jstree.plugin("xml_data", {
		defaults : { 
			data : false,
			ajax : false,
			xsl : "flat",
			clean_node : false,
			correct_state : true,
			get_skip_empty : false,
			get_include_preamble : true
		},
		_fn : {
			load_node : function (obj, s_call, e_call) { var _this = this; this.load_node_xml(obj, function () { _this.__callback({ "obj" : _this._get_node(obj) }); s_call.call(this); }, e_call); },
			_is_loaded : function (obj) { 
				var s = this._get_settings().xml_data;
				obj = this._get_node(obj);
				return obj == -1 || !obj || (!s.ajax && !$.isFunction(s.data)) || obj.is(".jstree-open, .jstree-leaf") || obj.children("ul").children("li").size() > 0;
			},
			load_node_xml : function (obj, s_call, e_call) {
				var s = this.get_settings().xml_data,
					error_func = function () {},
					success_func = function () {};

				obj = this._get_node(obj);
				if(obj && obj !== -1) {
					if(obj.data("jstree_is_loading")) { return; }
					else { obj.data("jstree_is_loading",true); }
				}
				switch(!0) {
					case (!s.data && !s.ajax): throw "Neither data nor ajax settings supplied.";
					case ($.isFunction(s.data)):
						s.data.call(this, obj, $.proxy(function (d) {
							this.parse_xml(d, $.proxy(function (d) {
								if(d) {
									d = d.replace(/ ?xmlns="[^"]*"/ig, "");
									if(d.length > 10) {
										d = $(d);
										if(obj === -1 || !obj) { this.get_container().children("ul").empty().append(d.children()); }
										else { obj.children("a.jstree-loading").removeClass("jstree-loading"); obj.append(d); obj.removeData("jstree_is_loading"); }
										if(s.clean_node) { this.clean_node(obj); }
										if(s_call) { s_call.call(this); }
									}
									else {
										if(obj && obj !== -1) { 
											obj.children("a.jstree-loading").removeClass("jstree-loading");
											obj.removeData("jstree_is_loading");
											if(s.correct_state) { 
												this.correct_state(obj);
												if(s_call) { s_call.call(this); } 
											}
										}
										else {
											if(s.correct_state) { 
												this.get_container().children("ul").empty();
												if(s_call) { s_call.call(this); } 
											}
										}
									}
								}
							}, this));
						}, this));
						break;
					case (!!s.data && !s.ajax) || (!!s.data && !!s.ajax && (!obj || obj === -1)):
						if(!obj || obj == -1) {
							this.parse_xml(s.data, $.proxy(function (d) {
								if(d) {
									d = d.replace(/ ?xmlns="[^"]*"/ig, "");
									if(d.length > 10) {
										d = $(d);
										this.get_container().children("ul").empty().append(d.children());
										if(s.clean_node) { this.clean_node(obj); }
										if(s_call) { s_call.call(this); }
									}
								}
								else { 
									if(s.correct_state) { 
										this.get_container().children("ul").empty(); 
										if(s_call) { s_call.call(this); }
									}
								}
							}, this));
						}
						break;
					case (!s.data && !!s.ajax) || (!!s.data && !!s.ajax && obj && obj !== -1):
						error_func = function (x, t, e) {
							var ef = this.get_settings().xml_data.ajax.error; 
							if(ef) { ef.call(this, x, t, e); }
							if(obj !== -1 && obj.length) {
								obj.children("a.jstree-loading").removeClass("jstree-loading");
								obj.removeData("jstree_is_loading");
								if(t === "success" && s.correct_state) { this.correct_state(obj); }
							}
							else {
								if(t === "success" && s.correct_state) { this.get_container().children("ul").empty(); }
							}
							if(e_call) { e_call.call(this); }
						};
						success_func = function (d, t, x) {
							d = x.responseText;
							var sf = this.get_settings().xml_data.ajax.success; 
							if(sf) { d = sf.call(this,d,t,x) || d; }
							if(d === "" || (d && d.toString && d.toString().replace(/^[\s\n]+$/,"") === "")) {
								return error_func.call(this, x, t, "");
							}
							this.parse_xml(d, $.proxy(function (d) {
								if(d) {
									d = d.replace(/ ?xmlns="[^"]*"/ig, "");
									if(d.length > 10) {
										d = $(d);
										if(obj === -1 || !obj) { this.get_container().children("ul").empty().append(d.children()); }
										else { obj.children("a.jstree-loading").removeClass("jstree-loading"); obj.append(d); obj.removeData("jstree_is_loading"); }
										if(s.clean_node) { this.clean_node(obj); }
										if(s_call) { s_call.call(this); }
									}
									else {
										if(obj && obj !== -1) { 
											obj.children("a.jstree-loading").removeClass("jstree-loading");
											obj.removeData("jstree_is_loading");
											if(s.correct_state) { 
												this.correct_state(obj);
												if(s_call) { s_call.call(this); } 
											}
										}
										else {
											if(s.correct_state) { 
												this.get_container().children("ul").empty();
												if(s_call) { s_call.call(this); } 
											}
										}
									}
								}
							}, this));
						};
						s.ajax.context = this;
						s.ajax.error = error_func;
						s.ajax.success = success_func;
						if(!s.ajax.dataType) { s.ajax.dataType = "xml"; }
						if($.isFunction(s.ajax.url)) { s.ajax.url = s.ajax.url.call(this, obj); }
						if($.isFunction(s.ajax.data)) { s.ajax.data = s.ajax.data.call(this, obj); }
						$.ajax(s.ajax);
						break;
				}
			},
			parse_xml : function (xml, callback) {
				var s = this._get_settings().xml_data;
				$.vakata.xslt(xml, xsl[s.xsl], callback);
			},
			get_xml : function (tp, obj, li_attr, a_attr, is_callback) {
				var result = "", 
					s = this._get_settings(), 
					_this = this,
					tmp1, tmp2, li, a, lang;
				if(!tp) { tp = "flat"; }
				if(!is_callback) { is_callback = 0; }
				obj = this._get_node(obj);
				if(!obj || obj === -1) { obj = this.get_container().find("> ul > li"); }
				li_attr = $.isArray(li_attr) ? li_attr : [ "id", "class" ];
				if(!is_callback && this.data.types && $.inArray(s.types.type_attr, li_attr) === -1) { li_attr.push(s.types.type_attr); }

				a_attr = $.isArray(a_attr) ? a_attr : [ ];

				if(!is_callback) { 
					if(s.xml_data.get_include_preamble) { 
						result += '<' + '?xml version="1.0" encoding="UTF-8"?' + '>'; 
					}
					result += "<root>"; 
				}
				obj.each(function () {
					result += "<item";
					li = $(this);
					$.each(li_attr, function (i, v) { 
						var t = li.attr(v);
						if(!s.xml_data.get_skip_empty || typeof t !== "undefined") {
							result += " " + v + "=\"" + escape_xml((" " + (t || "")).replace(/ jstree[^ ]*/ig,'').replace(/\s+$/ig," ").replace(/^ /,"").replace(/ $/,"")) + "\""; 
						}
					});
					if(li.hasClass("jstree-open")) { result += " state=\"open\""; }
					if(li.hasClass("jstree-closed")) { result += " state=\"closed\""; }
					if(tp === "flat") { result += " parent_id=\"" + escape_xml(is_callback) + "\""; }
					result += ">";
					result += "<content>";
					a = li.children("a");
					a.each(function () {
						tmp1 = $(this);
						lang = false;
						result += "<name";
						if($.inArray("languages", s.plugins) !== -1) {
							$.each(s.languages, function (k, z) {
								if(tmp1.hasClass(z)) { result += " lang=\"" + escape_xml(z) + "\""; lang = z; return false; }
							});
						}
						if(a_attr.length) { 
							$.each(a_attr, function (k, z) {
								var t = tmp1.attr(z);
								if(!s.xml_data.get_skip_empty || typeof t !== "undefined") {
									result += " " + z + "=\"" + escape_xml((" " + t || "").replace(/ jstree[^ ]*/ig,'').replace(/\s+$/ig," ").replace(/^ /,"").replace(/ $/,"")) + "\"";
								}
							});
						}
						if(tmp1.children("ins").get(0).className.replace(/jstree[^ ]*|$/ig,'').replace(/^\s+$/ig,"").length) {
							result += ' icon="' + escape_xml(tmp1.children("ins").get(0).className.replace(/jstree[^ ]*|$/ig,'').replace(/\s+$/ig," ").replace(/^ /,"").replace(/ $/,"")) + '"';
						}
						if(tmp1.children("ins").get(0).style.backgroundImage.length) {
							result += ' icon="' + escape_xml(tmp1.children("ins").get(0).style.backgroundImage.replace("url(","").replace(")","").replace(/'/ig,"").replace(/"/ig,"")) + '"';
						}
						result += ">";
						result += "<![CDATA[" + _this.get_text(tmp1, lang) + "]]>";
						result += "</name>";
					});
					result += "</content>";
					tmp2 = li[0].id || true;
					li = li.find("> ul > li");
					if(li.length) { tmp2 = _this.get_xml(tp, li, li_attr, a_attr, tmp2); }
					else { tmp2 = ""; }
					if(tp == "nest") { result += tmp2; }
					result += "</item>";
					if(tp == "flat") { result += tmp2; }
				});
				if(!is_callback) { result += "</root>"; }
				return result;
			}
		}
	});
})(jQuery);
//*/

/*
 * jsTree search plugin
 * Enables both sync and async search on the tree
 * DOES NOT WORK WITH JSON PROGRESSIVE RENDER
 */
(function ($) {
	$.expr[':'].jstree_contains = function(a,i,m){
		return (a.textContent || a.innerText || "").toLowerCase().indexOf(m[3].toLowerCase())>=0;
	};
	$.expr[':'].jstree_title_contains = function(a,i,m) {
		return (a.getAttribute("title") || "").toLowerCase().indexOf(m[3].toLowerCase())>=0;
	};
	$.jstree.plugin("search", {
		__init : function () {
			this.data.search.str = "";
			this.data.search.result = $();
			if(this._get_settings().search.show_only_matches) {
				this.get_container()
					.bind("search.jstree", function (e, data) {
						$(this).children("ul").find("li").hide().removeClass("jstree-last");
						data.rslt.nodes.parentsUntil(".jstree").andSelf().show()
							.filter("ul").each(function () { $(this).children("li:visible").eq(-1).addClass("jstree-last"); });
					})
					.bind("clear_search.jstree", function () {
						$(this).children("ul").find("li").css("display","").end().end().jstree("clean_node", -1);
					});
			}
		},
		defaults : {
			ajax : false,
			search_method : "jstree_contains", // for case insensitive - jstree_contains
			show_only_matches : false
		},
		_fn : {
			search : function (str, skip_async) {
				if($.trim(str) === "") { this.clear_search(); return; }
				var s = this.get_settings().search, 
					t = this,
					error_func = function () { },
					success_func = function () { };
				this.data.search.str = str;

				if(!skip_async && s.ajax !== false && this.get_container_ul().find("li.jstree-closed:not(:has(ul)):eq(0)").length > 0) {
					this.search.supress_callback = true;
					error_func = function () { };
					success_func = function (d, t, x) {
						var sf = this.get_settings().search.ajax.success; 
						if(sf) { d = sf.call(this,d,t,x) || d; }
						this.data.search.to_open = d;
						this._search_open();
					};
					s.ajax.context = this;
					s.ajax.error = error_func;
					s.ajax.success = success_func;
					if($.isFunction(s.ajax.url)) { s.ajax.url = s.ajax.url.call(this, str); }
					if($.isFunction(s.ajax.data)) { s.ajax.data = s.ajax.data.call(this, str); }
					if(!s.ajax.data) { s.ajax.data = { "search_string" : str }; }
					if(!s.ajax.dataType || /^json/.exec(s.ajax.dataType)) { s.ajax.dataType = "json"; }
					$.ajax(s.ajax);
					return;
				}
				if(this.data.search.result.length) { this.clear_search(); }
				this.data.search.result = this.get_container().find("a" + (this.data.languages ? "." + this.get_lang() : "" ) + ":" + (s.search_method) + "(" + this.data.search.str + ")");
				this.data.search.result.addClass("jstree-search").parent().parents(".jstree-closed").each(function () {
					t.open_node(this, false, true);
				});
				this.__callback({ nodes : this.data.search.result, str : str });
			},
			clear_search : function (str) {
				this.data.search.result.removeClass("jstree-search");
				this.__callback(this.data.search.result);
				this.data.search.result = $();
			},
			_search_open : function (is_callback) {
				var _this = this,
					done = true,
					current = [],
					remaining = [];
				if(this.data.search.to_open.length) {
					$.each(this.data.search.to_open, function (i, val) {
						if(val == "#") { return true; }
						if($(val).length && $(val).is(".jstree-closed")) { current.push(val); }
						else { remaining.push(val); }
					});
					if(current.length) {
						this.data.search.to_open = remaining;
						$.each(current, function (i, val) { 
							_this.open_node(val, function () { _this._search_open(true); }); 
						});
						done = false;
					}
				}
				if(done) { this.search(this.data.search.str, true); }
			}
		}
	});
})(jQuery);
//*/

/* 
 * jsTree contextmenu plugin
 */
(function ($) {
	$.vakata.context = {
		hide_on_mouseleave : false,

		cnt		: $("<div id='vakata-contextmenu' />"),
		vis		: false,
		tgt		: false,
		par		: false,
		func	: false,
		data	: false,
		rtl		: false,
		show	: function (s, t, x, y, d, p, rtl) {
			$.vakata.context.rtl = !!rtl;
			var html = $.vakata.context.parse(s), h, w;
			if(!html) { return; }
			$.vakata.context.vis = true;
			$.vakata.context.tgt = t;
			$.vakata.context.par = p || t || null;
			$.vakata.context.data = d || null;
			$.vakata.context.cnt
				.html(html)
				.css({ "visibility" : "hidden", "display" : "block", "left" : 0, "top" : 0 });

			if($.vakata.context.hide_on_mouseleave) {
				$.vakata.context.cnt
					.one("mouseleave", function(e) { $.vakata.context.hide(); });
			}

			h = $.vakata.context.cnt.height();
			w = $.vakata.context.cnt.width();
			if(x + w > $(document).width()) { 
				x = $(document).width() - (w + 5); 
				$.vakata.context.cnt.find("li > ul").addClass("right"); 
			}
			if(y + h > $(document).height()) { 
				y = y - (h + t[0].offsetHeight); 
				$.vakata.context.cnt.find("li > ul").addClass("bottom"); 
			}

			$.vakata.context.cnt
				.css({ "left" : x, "top" : y })
				.find("li:has(ul)")
					.bind("mouseenter", function (e) { 
						var w = $(document).width(),
							h = $(document).height(),
							ul = $(this).children("ul").show(); 
						if(w !== $(document).width()) { ul.toggleClass("right"); }
						if(h !== $(document).height()) { ul.toggleClass("bottom"); }
					})
					.bind("mouseleave", function (e) { 
						$(this).children("ul").hide(); 
					})
					.end()
				.css({ "visibility" : "visible" })
				.show();
			$(document).triggerHandler("context_show.vakata");
		},
		hide	: function () {
			$.vakata.context.vis = false;
			$.vakata.context.cnt.attr("class","").css({ "visibility" : "hidden" });
			$(document).triggerHandler("context_hide.vakata");
		},
		parse	: function (s, is_callback) {
			if(!s) { return false; }
			var str = "",
				tmp = false,
				was_sep = true;
			if(!is_callback) { $.vakata.context.func = {}; }
			str += "<ul>";
			$.each(s, function (i, val) {
				if(!val) { return true; }
				$.vakata.context.func[i] = val.action;
				if(!was_sep && val.separator_before) {
					str += "<li class='vakata-separator vakata-separator-before'></li>";
				}
				was_sep = false;
				str += "<li class='" + (val._class || "") + (val._disabled ? " jstree-contextmenu-disabled " : "") + "'><ins ";
				if(val.icon && val.icon.indexOf("/") === -1) { str += " class='" + val.icon + "' "; }
				if(val.icon && val.icon.indexOf("/") !== -1) { str += " style='background:url(" + val.icon + ") center center no-repeat;' "; }
				str += ">&#160;</ins><a href='#' rel='" + i + "'>";
				if(val.submenu) {
					str += "<span style='float:" + ($.vakata.context.rtl ? "left" : "right") + ";'>&raquo;</span>";
				}
				str += val.label + "</a>";
				if(val.submenu) {
					tmp = $.vakata.context.parse(val.submenu, true);
					if(tmp) { str += tmp; }
				}
				str += "</li>";
				if(val.separator_after) {
					str += "<li class='vakata-separator vakata-separator-after'></li>";
					was_sep = true;
				}
			});
			str = str.replace(/<li class\='vakata-separator vakata-separator-after'\><\/li\>$/,"");
			str += "</ul>";
			$(document).triggerHandler("context_parse.vakata");
			return str.length > 10 ? str : false;
		},
		exec	: function (i) {
			if($.isFunction($.vakata.context.func[i])) {
				// if is string - eval and call it!
				$.vakata.context.func[i].call($.vakata.context.data, $.vakata.context.par);
				return true;
			}
			else { return false; }
		}
	};
	$(function () {
		var css_string = '' + 
			'#vakata-contextmenu { display:block; visibility:hidden; left:0; top:-200px; position:absolute; margin:0; padding:0; min-width:180px; background:#ebebeb; border:1px solid silver; z-index:10000; *width:180px; } ' + 
			'#vakata-contextmenu ul { min-width:180px; *width:180px; } ' + 
			'#vakata-contextmenu ul, #vakata-contextmenu li { margin:0; padding:0; list-style-type:none; display:block; } ' + 
			'#vakata-contextmenu li { line-height:20px; min-height:20px; position:relative; padding:0px; } ' + 
			'#vakata-contextmenu li a { padding:1px 6px; line-height:17px; display:block; text-decoration:none; margin:1px 1px 0 1px; } ' + 
			'#vakata-contextmenu li ins { float:left; width:16px; height:16px; text-decoration:none; margin-right:2px; } ' + 
			'#vakata-contextmenu li a:hover, #vakata-contextmenu li.vakata-hover > a { background:gray; color:white; } ' + 
			'#vakata-contextmenu li ul { display:none; position:absolute; top:-2px; left:100%; background:#ebebeb; border:1px solid gray; } ' + 
			'#vakata-contextmenu .right { right:100%; left:auto; } ' + 
			'#vakata-contextmenu .bottom { bottom:-1px; top:auto; } ' + 
			'#vakata-contextmenu li.vakata-separator { min-height:0; height:1px; line-height:1px; font-size:1px; overflow:hidden; margin:0 2px; background:silver; /* border-top:1px solid #fefefe; */ padding:0; } ';
		$.vakata.css.add_sheet({ str : css_string, title : "vakata" });
		$.vakata.context.cnt
			.delegate("a","click", function (e) { e.preventDefault(); })
			.delegate("a","mouseup", function (e) {
				if(!$(this).parent().hasClass("jstree-contextmenu-disabled") && $.vakata.context.exec($(this).attr("rel"))) {
					$.vakata.context.hide();
				}
				else { $(this).blur(); }
			})
			.delegate("a","mouseover", function () {
				$.vakata.context.cnt.find(".vakata-hover").removeClass("vakata-hover");
			})
			.appendTo("body");
		$(document).bind("mousedown", function (e) { if($.vakata.context.vis && !$.contains($.vakata.context.cnt[0], e.target)) { $.vakata.context.hide(); } });
		if(typeof $.hotkeys !== "undefined") {
			$(document)
				.bind("keydown", "up", function (e) { 
					if($.vakata.context.vis) { 
						var o = $.vakata.context.cnt.find("ul:visible").last().children(".vakata-hover").removeClass("vakata-hover").prevAll("li:not(.vakata-separator)").first();
						if(!o.length) { o = $.vakata.context.cnt.find("ul:visible").last().children("li:not(.vakata-separator)").last(); }
						o.addClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "down", function (e) { 
					if($.vakata.context.vis) { 
						var o = $.vakata.context.cnt.find("ul:visible").last().children(".vakata-hover").removeClass("vakata-hover").nextAll("li:not(.vakata-separator)").first();
						if(!o.length) { o = $.vakata.context.cnt.find("ul:visible").last().children("li:not(.vakata-separator)").first(); }
						o.addClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "right", function (e) { 
					if($.vakata.context.vis) { 
						$.vakata.context.cnt.find(".vakata-hover").children("ul").show().children("li:not(.vakata-separator)").removeClass("vakata-hover").first().addClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "left", function (e) { 
					if($.vakata.context.vis) { 
						$.vakata.context.cnt.find(".vakata-hover").children("ul").hide().children(".vakata-separator").removeClass("vakata-hover");
						e.stopImmediatePropagation(); 
						e.preventDefault();
					} 
				})
				.bind("keydown", "esc", function (e) { 
					$.vakata.context.hide(); 
					e.preventDefault();
				})
				.bind("keydown", "space", function (e) { 
					$.vakata.context.cnt.find(".vakata-hover").last().children("a").click();
					e.preventDefault();
				});
		}
	});

	$.jstree.plugin("contextmenu", {
		__init : function () {
			this.get_container()
				.delegate("a", "contextmenu.jstree", $.proxy(function (e) {
						e.preventDefault();
						if(!$(e.currentTarget).hasClass("jstree-loading")) {
							this.show_contextmenu(e.currentTarget, e.pageX, e.pageY);
						}
					}, this))
				.delegate("a", "click.jstree", $.proxy(function (e) {
						if(this.data.contextmenu) {
							$.vakata.context.hide();
						}
					}, this))
				.bind("destroy.jstree", $.proxy(function () {
						// TODO: move this to descruct method
						if(this.data.contextmenu) {
							$.vakata.context.hide();
						}
					}, this));
			$(document).bind("context_hide.vakata", $.proxy(function () { this.data.contextmenu = false; }, this));
		},
		defaults : { 
			select_node : false, // requires UI plugin
			show_at_node : true,
			items : { // Could be a function that should return an object like this one
				"create" : {
					"separator_before"	: false,
					"separator_after"	: true,
					"label"				: "Create",
					"action"			: function (obj) { this.create(obj); }
				},
				"rename" : {
					"separator_before"	: false,
					"separator_after"	: false,
					"label"				: "Rename",
					"action"			: function (obj) { this.rename(obj); }
				},
				"remove" : {
					"separator_before"	: false,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Delete",
					"action"			: function (obj) { if(this.is_selected(obj)) { this.remove(); } else { this.remove(obj); } }
				},
				"ccp" : {
					"separator_before"	: true,
					"icon"				: false,
					"separator_after"	: false,
					"label"				: "Edit",
					"action"			: false,
					"submenu" : { 
						"cut" : {
							"separator_before"	: false,
							"separator_after"	: false,
							"label"				: "Cut",
							"action"			: function (obj) { this.cut(obj); }
						},
						"copy" : {
							"separator_before"	: false,
							"icon"				: false,
							"separator_after"	: false,
							"label"				: "Copy",
							"action"			: function (obj) { this.copy(obj); }
						},
						"paste" : {
							"separator_before"	: false,
							"icon"				: false,
							"separator_after"	: false,
							"label"				: "Paste",
							"action"			: function (obj) { this.paste(obj); }
						}
					}
				}
			}
		},
		_fn : {
			show_contextmenu : function (obj, x, y) {
				obj = this._get_node(obj);
				var s = this.get_settings().contextmenu,
					a = obj.children("a:visible:eq(0)"),
					o = false,
					i = false;
				if(s.select_node && this.data.ui && !this.is_selected(obj)) {
					this.deselect_all();
					this.select_node(obj, true);
				}
				if(s.show_at_node || typeof x === "undefined" || typeof y === "undefined") {
					o = a.offset();
					x = o.left;
					y = o.top + this.data.core.li_height;
				}
				i = obj.data("jstree") && obj.data("jstree").contextmenu ? obj.data("jstree").contextmenu : s.items;
				if($.isFunction(i)) { i = i.call(this, obj); }
				this.data.contextmenu = true;
				$.vakata.context.show(i, a, x, y, this, obj, this._get_settings().core.rtl);
				if(this.data.themes) { $.vakata.context.cnt.attr("class", "jstree-" + this.data.themes.theme + "-context"); }
			}
		}
	});
})(jQuery);
//*/

/* 
 * jsTree types plugin
 * Adds support types of nodes
 * You can set an attribute on each li node, that represents its type.
 * According to the type setting the node may get custom icon/validation rules
 */
(function ($) {
	$.jstree.plugin("types", {
		__init : function () {
			var s = this._get_settings().types;
			this.data.types.attach_to = [];
			this.get_container()
				.bind("init.jstree", $.proxy(function () { 
						var types = s.types, 
							attr  = s.type_attr, 
							icons_css = "", 
							_this = this;

						$.each(types, function (i, tp) {
							$.each(tp, function (k, v) { 
								if(!/^(max_depth|max_children|icon|valid_children)$/.test(k)) { _this.data.types.attach_to.push(k); }
							});
							if(!tp.icon) { return true; }
							if( tp.icon.image || tp.icon.position) {
								if(i == "default")	{ icons_css += '.jstree-' + _this.get_index() + ' a > .jstree-icon { '; }
								else				{ icons_css += '.jstree-' + _this.get_index() + ' li[' + attr + '="' + i + '"] > a > .jstree-icon { '; }
								if(tp.icon.image)	{ icons_css += ' background-image:url(' + tp.icon.image + '); '; }
								if(tp.icon.position){ icons_css += ' background-position:' + tp.icon.position + '; '; }
								else				{ icons_css += ' background-position:0 0; '; }
								icons_css += '} ';
							}
						});
						if(icons_css !== "") { $.vakata.css.add_sheet({ 'str' : icons_css, title : "jstree-types" }); }
					}, this))
				.bind("before.jstree", $.proxy(function (e, data) { 
						var s, t, 
							o = this._get_settings().types.use_data ? this._get_node(data.args[0]) : false, 
							d = o && o !== -1 && o.length ? o.data("jstree") : false;
						if(d && d.types && d.types[data.func] === false) { e.stopImmediatePropagation(); return false; }
						if($.inArray(data.func, this.data.types.attach_to) !== -1) {
							if(!data.args[0] || (!data.args[0].tagName && !data.args[0].jquery)) { return; }
							s = this._get_settings().types.types;
							t = this._get_type(data.args[0]);
							if(
								( 
									(s[t] && typeof s[t][data.func] !== "undefined") || 
									(s["default"] && typeof s["default"][data.func] !== "undefined") 
								) && this._check(data.func, data.args[0]) === false
							) {
								e.stopImmediatePropagation();
								return false;
							}
						}
					}, this));
			if(is_ie6) {
				this.get_container()
					.bind("load_node.jstree set_type.jstree", $.proxy(function (e, data) {
							var r = data && data.rslt && data.rslt.obj && data.rslt.obj !== -1 ? this._get_node(data.rslt.obj).parent() : this.get_container_ul(),
								c = false,
								s = this._get_settings().types;
							$.each(s.types, function (i, tp) {
								if(tp.icon && (tp.icon.image || tp.icon.position)) {
									c = i === "default" ? r.find("li > a > .jstree-icon") : r.find("li[" + s.type_attr + "='" + i + "'] > a > .jstree-icon");
									if(tp.icon.image) { c.css("backgroundImage","url(" + tp.icon.image + ")"); }
									c.css("backgroundPosition", tp.icon.position || "0 0");
								}
							});
						}, this));
			}
		},
		defaults : {
			// defines maximum number of root nodes (-1 means unlimited, -2 means disable max_children checking)
			max_children		: -1,
			// defines the maximum depth of the tree (-1 means unlimited, -2 means disable max_depth checking)
			max_depth			: -1,
			// defines valid node types for the root nodes
			valid_children		: "all",

			// whether to use $.data
			use_data : false, 
			// where is the type stores (the rel attribute of the LI element)
			type_attr : "rel",
			// a list of types
			types : {
				// the default type
				"default" : {
					"max_children"	: -1,
					"max_depth"		: -1,
					"valid_children": "all"

					// Bound functions - you can bind any other function here (using boolean or function)
					//"select_node"	: true
				}
			}
		},
		_fn : {
			_types_notify : function (n, data) {
				if(data.type && this._get_settings().types.use_data) {
					this.set_type(data.type, n);
				}
			},
			_get_type : function (obj) {
				obj = this._get_node(obj);
				return (!obj || !obj.length) ? false : obj.attr(this._get_settings().types.type_attr) || "default";
			},
			set_type : function (str, obj) {
				obj = this._get_node(obj);
				var ret = (!obj.length || !str) ? false : obj.attr(this._get_settings().types.type_attr, str);
				if(ret) { this.__callback({ obj : obj, type : str}); }
				return ret;
			},
			_check : function (rule, obj, opts) {
				obj = this._get_node(obj);
				var v = false, t = this._get_type(obj), d = 0, _this = this, s = this._get_settings().types, data = false;
				if(obj === -1) { 
					if(!!s[rule]) { v = s[rule]; }
					else { return; }
				}
				else {
					if(t === false) { return; }
					data = s.use_data ? obj.data("jstree") : false;
					if(data && data.types && typeof data.types[rule] !== "undefined") { v = data.types[rule]; }
					else if(!!s.types[t] && typeof s.types[t][rule] !== "undefined") { v = s.types[t][rule]; }
					else if(!!s.types["default"] && typeof s.types["default"][rule] !== "undefined") { v = s.types["default"][rule]; }
				}
				if($.isFunction(v)) { v = v.call(this, obj); }
				if(rule === "max_depth" && obj !== -1 && opts !== false && s.max_depth !== -2 && v !== 0) {
					// also include the node itself - otherwise if root node it is not checked
					obj.children("a:eq(0)").parentsUntil(".jstree","li").each(function (i) {
						// check if current depth already exceeds global tree depth
						if(s.max_depth !== -1 && s.max_depth - (i + 1) <= 0) { v = 0; return false; }
						d = (i === 0) ? v : _this._check(rule, this, false);
						// check if current node max depth is already matched or exceeded
						if(d !== -1 && d - (i + 1) <= 0) { v = 0; return false; }
						// otherwise - set the max depth to the current value minus current depth
						if(d >= 0 && (d - (i + 1) < v || v < 0) ) { v = d - (i + 1); }
						// if the global tree depth exists and it minus the nodes calculated so far is less than `v` or `v` is unlimited
						if(s.max_depth >= 0 && (s.max_depth - (i + 1) < v || v < 0) ) { v = s.max_depth - (i + 1); }
					});
				}
				return v;
			},
			check_move : function () {
				if(!this.__call_old()) { return false; }
				var m  = this._get_move(),
					s  = m.rt._get_settings().types,
					mc = m.rt._check("max_children", m.cr),
					md = m.rt._check("max_depth", m.cr),
					vc = m.rt._check("valid_children", m.cr),
					ch = 0, d = 1, t;

				if(vc === "none") { return false; } 
				if($.isArray(vc) && m.ot && m.ot._get_type) {
					m.o.each(function () {
						if($.inArray(m.ot._get_type(this), vc) === -1) { d = false; return false; }
					});
					if(d === false) { return false; }
				}
				if(s.max_children !== -2 && mc !== -1) {
					ch = m.cr === -1 ? this.get_container().find("> ul > li").not(m.o).length : m.cr.find("> ul > li").not(m.o).length;
					if(ch + m.o.length > mc) { return false; }
				}
				if(s.max_depth !== -2 && md !== -1) {
					d = 0;
					if(md === 0) { return false; }
					if(typeof m.o.d === "undefined") {
						// TODO: deal with progressive rendering and async when checking max_depth (how to know the depth of the moved node)
						t = m.o;
						while(t.length > 0) {
							t = t.find("> ul > li");
							d ++;
						}
						m.o.d = d;
					}
					if(md - m.o.d < 0) { return false; }
				}
				return true;
			},
			create_node : function (obj, position, js, callback, is_loaded, skip_check) {
				if(!skip_check && (is_loaded || this._is_loaded(obj))) {
					var p  = (typeof position == "string" && position.match(/^before|after$/i) && obj !== -1) ? this._get_parent(obj) : this._get_node(obj),
						s  = this._get_settings().types,
						mc = this._check("max_children", p),
						md = this._check("max_depth", p),
						vc = this._check("valid_children", p),
						ch;
					if(typeof js === "string") { js = { data : js }; }
					if(!js) { js = {}; }
					if(vc === "none") { return false; } 
					if($.isArray(vc)) {
						if(!js.attr || !js.attr[s.type_attr]) { 
							if(!js.attr) { js.attr = {}; }
							js.attr[s.type_attr] = vc[0]; 
						}
						else {
							if($.inArray(js.attr[s.type_attr], vc) === -1) { return false; }
						}
					}
					if(s.max_children !== -2 && mc !== -1) {
						ch = p === -1 ? this.get_container().find("> ul > li").length : p.find("> ul > li").length;
						if(ch + 1 > mc) { return false; }
					}
					if(s.max_depth !== -2 && md !== -1 && (md - 1) < 0) { return false; }
				}
				return this.__call_old(true, obj, position, js, callback, is_loaded, skip_check);
			}
		}
	});
})(jQuery);
//*/

/* 
 * jsTree HTML plugin
 * The HTML data store. Datastores are build by replacing the `load_node` and `_is_loaded` functions.
 */
(function ($) {
	$.jstree.plugin("html_data", {
		__init : function () { 
			// this used to use html() and clean the whitespace, but this way any attached data was lost
			this.data.html_data.original_container_html = this.get_container().find(" > ul > li").clone(true);
			// remove white space from LI node - otherwise nodes appear a bit to the right
			this.data.html_data.original_container_html.find("li").andSelf().contents().filter(function() { return this.nodeType == 3; }).remove();
		},
		defaults : { 
			data : false,
			ajax : false,
			correct_state : true
		},
		_fn : {
			load_node : function (obj, s_call, e_call) { var _this = this; this.load_node_html(obj, function () { _this.__callback({ "obj" : _this._get_node(obj) }); s_call.call(this); }, e_call); },
			_is_loaded : function (obj) { 
				obj = this._get_node(obj); 
				return obj == -1 || !obj || (!this._get_settings().html_data.ajax && !$.isFunction(this._get_settings().html_data.data)) || obj.is(".jstree-open, .jstree-leaf") || obj.children("ul").children("li").size() > 0;
			},
			load_node_html : function (obj, s_call, e_call) {
				var d,
					s = this.get_settings().html_data,
					error_func = function () {},
					success_func = function () {};
				obj = this._get_node(obj);
				if(obj && obj !== -1) {
					if(obj.data("jstree_is_loading")) { return; }
					else { obj.data("jstree_is_loading",true); }
				}
				switch(!0) {
					case ($.isFunction(s.data)):
						s.data.call(this, obj, $.proxy(function (d) {
							if(d && d !== "" && d.toString && d.toString().replace(/^[\s\n]+$/,"") !== "") {
								d = $(d);
								if(!d.is("ul")) { d = $("<ul />").append(d); }
								if(obj == -1 || !obj) { this.get_container().children("ul").empty().append(d.children()).find("li, a").filter(function () { return !this.firstChild || !this.firstChild.tagName || this.firstChild.tagName !== "INS"; }).prepend("<ins class='jstree-icon'>&#160;</ins>").end().filter("a").children("ins:first-child").not(".jstree-icon").addClass("jstree-icon"); }
								else { obj.children("a.jstree-loading").removeClass("jstree-loading"); obj.append(d).children("ul").find("li, a").filter(function () { return !this.firstChild || !this.firstChild.tagName || this.firstChild.tagName !== "INS"; }).prepend("<ins class='jstree-icon'>&#160;</ins>").end().filter("a").children("ins:first-child").not(".jstree-icon").addClass("jstree-icon"); obj.removeData("jstree_is_loading"); }
								this.clean_node(obj);
								if(s_call) { s_call.call(this); }
							}
							else {
								if(obj && obj !== -1) {
									obj.children("a.jstree-loading").removeClass("jstree-loading");
									obj.removeData("jstree_is_loading");
									if(s.correct_state) { 
										this.correct_state(obj);
										if(s_call) { s_call.call(this); } 
									}
								}
								else {
									if(s.correct_state) { 
										this.get_container().children("ul").empty();
										if(s_call) { s_call.call(this); } 
									}
								}
							}
						}, this));
						break;
					case (!s.data && !s.ajax):
						if(!obj || obj == -1) {
							this.get_container()
								.children("ul").empty()
								.append(this.data.html_data.original_container_html)
								.find("li, a").filter(function () { return !this.firstChild || !this.firstChild.tagName || this.firstChild.tagName !== "INS"; }).prepend("<ins class='jstree-icon'>&#160;</ins>").end()
								.filter("a").children("ins:first-child").not(".jstree-icon").addClass("jstree-icon");
							this.clean_node();
						}
						if(s_call) { s_call.call(this); }
						break;
					case (!!s.data && !s.ajax) || (!!s.data && !!s.ajax && (!obj || obj === -1)):
						if(!obj || obj == -1) {
							d = $(s.data);
							if(!d.is("ul")) { d = $("<ul />").append(d); }
							this.get_container()
								.children("ul").empty().append(d.children())
								.find("li, a").filter(function () { return !this.firstChild || !this.firstChild.tagName || this.firstChild.tagName !== "INS"; }).prepend("<ins class='jstree-icon'>&#160;</ins>").end()
								.filter("a").children("ins:first-child").not(".jstree-icon").addClass("jstree-icon");
							this.clean_node();
						}
						if(s_call) { s_call.call(this); }
						break;
					case (!s.data && !!s.ajax) || (!!s.data && !!s.ajax && obj && obj !== -1):
						obj = this._get_node(obj);
						error_func = function (x, t, e) {
							var ef = this.get_settings().html_data.ajax.error; 
							if(ef) { ef.call(this, x, t, e); }
							if(obj != -1 && obj.length) {
								obj.children("a.jstree-loading").removeClass("jstree-loading");
								obj.removeData("jstree_is_loading");
								if(t === "success" && s.correct_state) { this.correct_state(obj); }
							}
							else {
								if(t === "success" && s.correct_state) { this.get_container().children("ul").empty(); }
							}
							if(e_call) { e_call.call(this); }
						};
						success_func = function (d, t, x) {
							var sf = this.get_settings().html_data.ajax.success; 
							if(sf) { d = sf.call(this,d,t,x) || d; }
							if(d === "" || (d && d.toString && d.toString().replace(/^[\s\n]+$/,"") === "")) {
								return error_func.call(this, x, t, "");
							}
							if(d) {
								d = $(d);
								if(!d.is("ul")) { d = $("<ul />").append(d); }
								if(obj == -1 || !obj) { this.get_container().children("ul").empty().append(d.children()).find("li, a").filter(function () { return !this.firstChild || !this.firstChild.tagName || this.firstChild.tagName !== "INS"; }).prepend("<ins class='jstree-icon'>&#160;</ins>").end().filter("a").children("ins:first-child").not(".jstree-icon").addClass("jstree-icon"); }
								else { obj.children("a.jstree-loading").removeClass("jstree-loading"); obj.append(d).children("ul").find("li, a").filter(function () { return !this.firstChild || !this.firstChild.tagName || this.firstChild.tagName !== "INS"; }).prepend("<ins class='jstree-icon'>&#160;</ins>").end().filter("a").children("ins:first-child").not(".jstree-icon").addClass("jstree-icon"); obj.removeData("jstree_is_loading"); }
								this.clean_node(obj);
								if(s_call) { s_call.call(this); }
							}
							else {
								if(obj && obj !== -1) {
									obj.children("a.jstree-loading").removeClass("jstree-loading");
									obj.removeData("jstree_is_loading");
									if(s.correct_state) { 
										this.correct_state(obj);
										if(s_call) { s_call.call(this); } 
									}
								}
								else {
									if(s.correct_state) { 
										this.get_container().children("ul").empty();
										if(s_call) { s_call.call(this); } 
									}
								}
							}
						};
						s.ajax.context = this;
						s.ajax.error = error_func;
						s.ajax.success = success_func;
						if(!s.ajax.dataType) { s.ajax.dataType = "html"; }
						if($.isFunction(s.ajax.url)) { s.ajax.url = s.ajax.url.call(this, obj); }
						if($.isFunction(s.ajax.data)) { s.ajax.data = s.ajax.data.call(this, obj); }
						$.ajax(s.ajax);
						break;
				}
			}
		}
	});
	// include the HTML data plugin by default
	$.jstree.defaults.plugins.push("html_data");
})(jQuery);
//*/

/* 
 * jsTree themeroller plugin
 * Adds support for jQuery UI themes. Include this at the end of your plugins list, also make sure "themes" is not included.
 */
(function ($) {
	$.jstree.plugin("themeroller", {
		__init : function () {
			var s = this._get_settings().themeroller;
			this.get_container()
				.addClass("ui-widget-content")
				.addClass("jstree-themeroller")
				.delegate("a","mouseenter.jstree", function (e) {
					if(!$(e.currentTarget).hasClass("jstree-loading")) {
						$(this).addClass(s.item_h);
					}
				})
				.delegate("a","mouseleave.jstree", function () {
					$(this).removeClass(s.item_h);
				})
				.bind("init.jstree", $.proxy(function (e, data) { 
						data.inst.get_container().find("> ul > li > .jstree-loading > ins").addClass("ui-icon-refresh");
						this._themeroller(data.inst.get_container().find("> ul > li"));
					}, this))
				.bind("open_node.jstree create_node.jstree", $.proxy(function (e, data) { 
						this._themeroller(data.rslt.obj);
					}, this))
				.bind("loaded.jstree refresh.jstree", $.proxy(function (e) {
						this._themeroller();
					}, this))
				.bind("close_node.jstree", $.proxy(function (e, data) {
						this._themeroller(data.rslt.obj);
					}, this))
				.bind("delete_node.jstree", $.proxy(function (e, data) {
						this._themeroller(data.rslt.parent);
					}, this))
				.bind("correct_state.jstree", $.proxy(function (e, data) {
						data.rslt.obj
							.children("ins.jstree-icon").removeClass(s.opened + " " + s.closed + " ui-icon").end()
							.find("> a > ins.ui-icon")
								.filter(function() { 
									return this.className.toString()
										.replace(s.item_clsd,"").replace(s.item_open,"").replace(s.item_leaf,"")
										.indexOf("ui-icon-") === -1; 
								}).removeClass(s.item_open + " " + s.item_clsd).addClass(s.item_leaf || "jstree-no-icon");
					}, this))
				.bind("select_node.jstree", $.proxy(function (e, data) {
						data.rslt.obj.children("a").addClass(s.item_a);
					}, this))
				.bind("deselect_node.jstree deselect_all.jstree", $.proxy(function (e, data) {
						this.get_container()
							.find("a." + s.item_a).removeClass(s.item_a).end()
							.find("a.jstree-clicked").addClass(s.item_a);
					}, this))
				.bind("dehover_node.jstree", $.proxy(function (e, data) {
						data.rslt.obj.children("a").removeClass(s.item_h);
					}, this))
				.bind("hover_node.jstree", $.proxy(function (e, data) {
						this.get_container()
							.find("a." + s.item_h).not(data.rslt.obj).removeClass(s.item_h);
						data.rslt.obj.children("a").addClass(s.item_h);
					}, this))
				.bind("move_node.jstree", $.proxy(function (e, data) {
						this._themeroller(data.rslt.o);
						this._themeroller(data.rslt.op);
					}, this));
		},
		__destroy : function () {
			var s = this._get_settings().themeroller,
				c = [ "ui-icon" ];
			$.each(s, function (i, v) {
				v = v.split(" ");
				if(v.length) { c = c.concat(v); }
			});
			this.get_container()
				.removeClass("ui-widget-content")
				.find("." + c.join(", .")).removeClass(c.join(" "));
		},
		_fn : {
			_themeroller : function (obj) {
				var s = this._get_settings().themeroller;
				obj = !obj || obj == -1 ? this.get_container_ul() : this._get_node(obj).parent();
				obj
					.find("li.jstree-closed")
						.children("ins.jstree-icon").removeClass(s.opened).addClass("ui-icon " + s.closed).end()
						.children("a").addClass(s.item)
							.children("ins.jstree-icon").addClass("ui-icon")
								.filter(function() { 
									return this.className.toString()
										.replace(s.item_clsd,"").replace(s.item_open,"").replace(s.item_leaf,"")
										.indexOf("ui-icon-") === -1; 
								}).removeClass(s.item_leaf + " " + s.item_open).addClass(s.item_clsd || "jstree-no-icon")
								.end()
							.end()
						.end()
					.end()
					.find("li.jstree-open")
						.children("ins.jstree-icon").removeClass(s.closed).addClass("ui-icon " + s.opened).end()
						.children("a").addClass(s.item)
							.children("ins.jstree-icon").addClass("ui-icon")
								.filter(function() { 
									return this.className.toString()
										.replace(s.item_clsd,"").replace(s.item_open,"").replace(s.item_leaf,"")
										.indexOf("ui-icon-") === -1; 
								}).removeClass(s.item_leaf + " " + s.item_clsd).addClass(s.item_open || "jstree-no-icon")
								.end()
							.end()
						.end()
					.end()
					.find("li.jstree-leaf")
						.children("ins.jstree-icon").removeClass(s.closed + " ui-icon " + s.opened).end()
						.children("a").addClass(s.item)
							.children("ins.jstree-icon").addClass("ui-icon")
								.filter(function() { 
									return this.className.toString()
										.replace(s.item_clsd,"").replace(s.item_open,"").replace(s.item_leaf,"")
										.indexOf("ui-icon-") === -1; 
								}).removeClass(s.item_clsd + " " + s.item_open).addClass(s.item_leaf || "jstree-no-icon");
			}
		},
		defaults : {
			"opened"	: "ui-icon-triangle-1-se",
			"closed"	: "ui-icon-triangle-1-e",
			"item"		: "ui-state-default",
			"item_h"	: "ui-state-hover",
			"item_a"	: "ui-state-active",
			"item_open"	: "ui-icon-folder-open",
			"item_clsd"	: "ui-icon-folder-collapsed",
			"item_leaf"	: "ui-icon-document"
		}
	});
	$(function() {
		var css_string = '' + 
			'.jstree-themeroller .ui-icon { overflow:visible; } ' + 
			'.jstree-themeroller a { padding:0 2px; } ' + 
			'.jstree-themeroller .jstree-no-icon { display:none; }';
		$.vakata.css.add_sheet({ str : css_string, title : "jstree" });
	});
})(jQuery);
//*/

/* 
 * jsTree unique plugin
 * Forces different names amongst siblings (still a bit experimental)
 * NOTE: does not check language versions (it will not be possible to have nodes with the same title, even in different languages)
 */
(function ($) {
	$.jstree.plugin("unique", {
		__init : function () {
			this.get_container()
				.bind("before.jstree", $.proxy(function (e, data) { 
						var nms = [], res = true, p, t;
						if(data.func == "move_node") {
							// obj, ref, position, is_copy, is_prepared, skip_check
							if(data.args[4] === true) {
								if(data.args[0].o && data.args[0].o.length) {
									data.args[0].o.children("a").each(function () { nms.push($(this).text().replace(/^\s+/g,"")); });
									res = this._check_unique(nms, data.args[0].np.find("> ul > li").not(data.args[0].o), "move_node");
								}
							}
						}
						if(data.func == "create_node") {
							// obj, position, js, callback, is_loaded
							if(data.args[4] || this._is_loaded(data.args[0])) {
								p = this._get_node(data.args[0]);
								if(data.args[1] && (data.args[1] === "before" || data.args[1] === "after")) {
									p = this._get_parent(data.args[0]);
									if(!p || p === -1) { p = this.get_container(); }
								}
								if(typeof data.args[2] === "string") { nms.push(data.args[2]); }
								else if(!data.args[2] || !data.args[2].data) { nms.push(this._get_string("new_node")); }
								else { nms.push(data.args[2].data); }
								res = this._check_unique(nms, p.find("> ul > li"), "create_node");
							}
						}
						if(data.func == "rename_node") {
							// obj, val
							nms.push(data.args[1]);
							t = this._get_node(data.args[0]);
							p = this._get_parent(t);
							if(!p || p === -1) { p = this.get_container(); }
							res = this._check_unique(nms, p.find("> ul > li").not(t), "rename_node");
						}
						if(!res) {
							e.stopPropagation();
							return false;
						}
					}, this));
		},
		defaults : { 
			error_callback : $.noop
		},
		_fn : { 
			_check_unique : function (nms, p, func) {
				var cnms = [];
				p.children("a").each(function () { cnms.push($(this).text().replace(/^\s+/g,"")); });
				if(!cnms.length || !nms.length) { return true; }
				cnms = cnms.sort().join(",,").replace(/(,|^)([^,]+)(,,\2)+(,|$)/g,"$1$2$4").replace(/,,+/g,",").replace(/,$/,"").split(",");
				if((cnms.length + nms.length) != cnms.concat(nms).sort().join(",,").replace(/(,|^)([^,]+)(,,\2)+(,|$)/g,"$1$2$4").replace(/,,+/g,",").replace(/,$/,"").split(",").length) {
					this._get_settings().unique.error_callback.call(null, nms, p, func);
					return false;
				}
				return true;
			},
			check_move : function () {
				if(!this.__call_old()) { return false; }
				var p = this._get_move(), nms = [];
				if(p.o && p.o.length) {
					p.o.children("a").each(function () { nms.push($(this).text().replace(/^\s+/g,"")); });
					return this._check_unique(nms, p.np.find("> ul > li").not(p.o), "check_move");
				}
				return true;
			}
		}
	});
})(jQuery);
//*/

/*
 * jsTree wholerow plugin
 * Makes select and hover work on the entire width of the node
 * MAY BE HEAVY IN LARGE DOM
 */
(function ($) {
	$.jstree.plugin("wholerow", {
		__init : function () {
			if(!this.data.ui) { throw "jsTree wholerow: jsTree UI plugin not included."; }
			this.data.wholerow.html = false;
			this.data.wholerow.to = false;
			this.get_container()
				.bind("init.jstree", $.proxy(function (e, data) { 
						this._get_settings().core.animation = 0;
					}, this))
				.bind("open_node.jstree create_node.jstree clean_node.jstree loaded.jstree", $.proxy(function (e, data) { 
						this._prepare_wholerow_span( data && data.rslt && data.rslt.obj ? data.rslt.obj : -1 );
					}, this))
				.bind("search.jstree clear_search.jstree reopen.jstree after_open.jstree after_close.jstree create_node.jstree delete_node.jstree clean_node.jstree", $.proxy(function (e, data) { 
						if(this.data.to) { clearTimeout(this.data.to); }
						this.data.to = setTimeout( (function (t, o) { return function() { t._prepare_wholerow_ul(o); }; })(this,  data && data.rslt && data.rslt.obj ? data.rslt.obj : -1), 0);
					}, this))
				.bind("deselect_all.jstree", $.proxy(function (e, data) { 
						this.get_container().find(" > .jstree-wholerow .jstree-clicked").removeClass("jstree-clicked " + (this.data.themeroller ? this._get_settings().themeroller.item_a : "" ));
					}, this))
				.bind("select_node.jstree deselect_node.jstree ", $.proxy(function (e, data) { 
						data.rslt.obj.each(function () { 
							var ref = data.inst.get_container().find(" > .jstree-wholerow li:visible:eq(" + ( parseInt((($(this).offset().top - data.inst.get_container().offset().top + data.inst.get_container()[0].scrollTop) / data.inst.data.core.li_height),10)) + ")");
							// ref.children("a")[e.type === "select_node" ? "addClass" : "removeClass"]("jstree-clicked");
							ref.children("a").attr("class",data.rslt.obj.children("a").attr("class"));
						});
					}, this))
				.bind("hover_node.jstree dehover_node.jstree", $.proxy(function (e, data) { 
						this.get_container().find(" > .jstree-wholerow .jstree-hovered").removeClass("jstree-hovered " + (this.data.themeroller ? this._get_settings().themeroller.item_h : "" ));
						if(e.type === "hover_node") {
							var ref = this.get_container().find(" > .jstree-wholerow li:visible:eq(" + ( parseInt(((data.rslt.obj.offset().top - this.get_container().offset().top + this.get_container()[0].scrollTop) / this.data.core.li_height),10)) + ")");
							// ref.children("a").addClass("jstree-hovered");
							ref.children("a").attr("class",data.rslt.obj.children(".jstree-hovered").attr("class"));
						}
					}, this))
				.delegate(".jstree-wholerow-span, ins.jstree-icon, li", "click.jstree", function (e) {
						var n = $(e.currentTarget);
						if(e.target.tagName === "A" || (e.target.tagName === "INS" && n.closest("li").is(".jstree-open, .jstree-closed"))) { return; }
						n.closest("li").children("a:visible:eq(0)").click();
						e.stopImmediatePropagation();
					})
				.delegate("li", "mouseover.jstree", $.proxy(function (e) {
						e.stopImmediatePropagation();
						if($(e.currentTarget).children(".jstree-hovered, .jstree-clicked").length) { return false; }
						this.hover_node(e.currentTarget);
						return false;
					}, this))
				.delegate("li", "mouseleave.jstree", $.proxy(function (e) {
						if($(e.currentTarget).children("a").hasClass("jstree-hovered").length) { return; }
						this.dehover_node(e.currentTarget);
					}, this));
			if(is_ie7 || is_ie6) {
				$.vakata.css.add_sheet({ str : ".jstree-" + this.get_index() + " { position:relative; } ", title : "jstree" });
			}
		},
		defaults : {
		},
		__destroy : function () {
			this.get_container().children(".jstree-wholerow").remove();
			this.get_container().find(".jstree-wholerow-span").remove();
		},
		_fn : {
			_prepare_wholerow_span : function (obj) {
				obj = !obj || obj == -1 ? this.get_container().find("> ul > li") : this._get_node(obj);
				if(obj === false) { return; } // added for removing root nodes
				obj.each(function () {
					$(this).find("li").andSelf().each(function () {
						var $t = $(this);
						if($t.children(".jstree-wholerow-span").length) { return true; }
						$t.prepend("<span class='jstree-wholerow-span' style='width:" + ($t.parentsUntil(".jstree","li").length * 18) + "px;'>&#160;</span>");
					});
				});
			},
			_prepare_wholerow_ul : function () {
				var o = this.get_container().children("ul").eq(0), h = o.html();
				o.addClass("jstree-wholerow-real");
				if(this.data.wholerow.last_html !== h) {
					this.data.wholerow.last_html = h;
					this.get_container().children(".jstree-wholerow").remove();
					this.get_container().append(
						o.clone().removeClass("jstree-wholerow-real")
							.wrapAll("<div class='jstree-wholerow' />").parent()
							.width(o.parent()[0].scrollWidth)
							.css("top", (o.height() + ( is_ie7 ? 5 : 0)) * -1 )
							.find("li[id]").each(function () { this.removeAttribute("id"); }).end()
					);
				}
			}
		}
	});
	$(function() {
		var css_string = '' + 
			'.jstree .jstree-wholerow-real { position:relative; z-index:1; } ' + 
			'.jstree .jstree-wholerow-real li { cursor:pointer; } ' + 
			'.jstree .jstree-wholerow-real a { border-left-color:transparent !important; border-right-color:transparent !important; } ' + 
			'.jstree .jstree-wholerow { position:relative; z-index:0; height:0; } ' + 
			'.jstree .jstree-wholerow ul, .jstree .jstree-wholerow li { width:100%; } ' + 
			'.jstree .jstree-wholerow, .jstree .jstree-wholerow ul, .jstree .jstree-wholerow li, .jstree .jstree-wholerow a { margin:0 !important; padding:0 !important; } ' + 
			'.jstree .jstree-wholerow, .jstree .jstree-wholerow ul, .jstree .jstree-wholerow li { background:transparent !important; }' + 
			'.jstree .jstree-wholerow ins, .jstree .jstree-wholerow span, .jstree .jstree-wholerow input { display:none !important; }' + 
			'.jstree .jstree-wholerow a, .jstree .jstree-wholerow a:hover { text-indent:-9999px; !important; width:100%; padding:0 !important; border-right-width:0px !important; border-left-width:0px !important; } ' + 
			'.jstree .jstree-wholerow-span { position:absolute; left:0; margin:0px; padding:0; height:18px; border-width:0; padding:0; z-index:0; }';
		if(is_ff2) {
			css_string += '' + 
				'.jstree .jstree-wholerow a { display:block; height:18px; margin:0; padding:0; border:0; } ' + 
				'.jstree .jstree-wholerow-real a { border-color:transparent !important; } ';
		}
		if(is_ie7 || is_ie6) {
			css_string += '' + 
				'.jstree .jstree-wholerow, .jstree .jstree-wholerow li, .jstree .jstree-wholerow ul, .jstree .jstree-wholerow a { margin:0; padding:0; line-height:18px; } ' + 
				'.jstree .jstree-wholerow a { display:block; height:18px; line-height:18px; overflow:hidden; } ';
		}
		$.vakata.css.add_sheet({ str : css_string, title : "jstree" });
	});
})(jQuery);
//*/

/*
* jsTree model plugin
* This plugin gets jstree to use a class model to retrieve data, creating great dynamism
*/
(function ($) {
	var nodeInterface = ["getChildren","getChildrenCount","getAttr","getName","getProps"],
		validateInterface = function(obj, inter) {
			var valid = true;
			obj = obj || {};
			inter = [].concat(inter);
			$.each(inter, function (i, v) {
				if(!$.isFunction(obj[v])) { valid = false; return false; }
			});
			return valid;
		};
	$.jstree.plugin("model", {
		__init : function () {
			if(!this.data.json_data) { throw "jsTree model: jsTree json_data plugin not included."; }
			this._get_settings().json_data.data = function (n, b) {
				var obj = (n == -1) ? this._get_settings().model.object : n.data("jstree_model");
				if(!validateInterface(obj, nodeInterface)) { return b.call(null, false); }
				if(this._get_settings().model.async) {
					obj.getChildren($.proxy(function (data) {
						this.model_done(data, b);
					}, this));
				}
				else {
					this.model_done(obj.getChildren(), b);
				}
			};
		},
		defaults : {
			object : false,
			id_prefix : false,
			async : false
		},
		_fn : {
			model_done : function (data, callback) {
				var ret = [], 
					s = this._get_settings(),
					_this = this;

				if(!$.isArray(data)) { data = [data]; }
				$.each(data, function (i, nd) {
					var r = nd.getProps() || {};
					r.attr = nd.getAttr() || {};
					if(nd.getChildrenCount()) { r.state = "closed"; }
					r.data = nd.getName();
					if(!$.isArray(r.data)) { r.data = [r.data]; }
					if(_this.data.types && $.isFunction(nd.getType)) {
						r.attr[s.types.type_attr] = nd.getType();
					}
					if(r.attr.id && s.model.id_prefix) { r.attr.id = s.model.id_prefix + r.attr.id; }
					if(!r.metadata) { r.metadata = { }; }
					r.metadata.jstree_model = nd;
					ret.push(r);
				});
				callback.call(null, ret);
			}
		}
	});
})(jQuery);
//*/

})();
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.jstree )
{
	ultimix.jstree = {};
}

/**
*	Create node event handler.
*
*	@param e - Event object.
*
*	@param Data - Data object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.CreateNodeEventHandler = function( e , Data )
{
	var			RootId = jQuery( Data.rslt.parent ).attr( 'id' ).replace( 'phtml_' , '' );
	
	ultimix.ajax_gate.DirectController(
		{
			'package_name' : 'category::category_controller' , 
			'create_category' : 1 , 
			'category_action' : 'create_record' , 
			'root_id' : RootId , 
			'title' : Data.rslt.name , 
			'category_name' : 'category_name'
		} , 
		function( Result )
		{
			/* parsing result */
			eval( "Result = " + Result + ";" );
			jQuery( Data.rslt.obj ).attr( 'id' , 'phtml_' + Result.id );
		}
	);
}

/**
*	Rename node event handler.
*
*	@param e - Event object.
*
*	@param Data - Data object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.RenameNodeEventHandler = function( e , Data )
{
	var			NodeId = jQuery( Data.rslt.obj ).attr( 'id' ).replace( 'phtml_' , '' );
	
	ultimix.ajax_gate.DirectController(
		{
			'package_name' : 'category::category_controller' , 
			'update_category' : 1 , 
			'category_action' : 'update_category_title' , 
			'category_id' : NodeId , 
			'title' : Data.rslt.new_name
		}
	);
}

/**
*	Remove node event handler.
*
*	@param e - Event object.
*
*	@param Data - Data object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.RemoveNodeEventHandler = function( e , Data )
{
	for( var i = 0 ; i < Data.rslt.obj.length ; i++ )
	{
		var			NodeId = jQuery( Data.rslt.obj[ i ] ).attr( 'id' ).replace( 'phtml_' , '' );
		
		ultimix.ajax_gate.DirectController(
			{
				'package_name' : 'category::category_controller' , 
				'delete_category' : 1 , 
				'category_action' : 'delete_record' , 
				'category_record_id' : NodeId
			}
		);
	}
}

/**
*	Function processes item creation.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.CreateItem = function()
{
	var 		Tree = jQuery.jstree._focused();
	var			Node = Tree.get_selected();
	
	if( Node.length )
	{
		Tree.create( Node , 'last' , ultimix.get_string( 'tree_new_item' ) );
	}
	else
	{
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'select_tree_node_first' ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL 
		);
	}
}

/**
*	Function processes item editing.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.RenameItem = function()
{
	var 		Tree = jQuery.jstree._focused();
	var			Node = Tree.get_selected();

	if( Node.length )
	{
		Tree.rename();
	}
	else
	{
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'select_tree_node_first' ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL 
		);
	}
}

/**
*	Function moves up all children nodes fo the selected nodes.
*
*	@param Tree - Tree object.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.MoveUpForSelected = function( Tree )
{
	/* move children elements upper */
	var			SelectedNodes = Tree.get_selected();
	
	for( var i = 0 ; i < SelectedNodes.length ; i++ )
	{
		var			Children = Tree._get_children( SelectedNodes[ i ] );
		
		if( Children.length )
		{
			Tree.move_node( Children , SelectedNodes[ i ] , 'after' );
		}
	}
}

/**
*	Function shows removal confirmation dialog.
*
*	@param ConfirmString - Confirmation string.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.ShowRemoveItemDialog = function( ConfirmString )
{
	if( ConfirmString == '' )
	{
		ConfirmString = 'shure_to_delete_tree_item';
	}
	
	ultimix.std_dialogs.MessageBox( 
		ultimix.get_string( ConfirmString ) , 
		ultimix.get_string( 'Question' ) , 
		ultimix.std_dialogs.MB_YESNO | ultimix.std_dialogs.MB_ICONQUESTION | ultimix.std_dialogs.MB_MODAL , 
		function( Result )
		{
			if( Result == ultimix.std_dialogs.MB_YES )
			{
				var 		Tree = jQuery.jstree._focused();
				
				ultimix.jstree.MoveUpForSelected( Tree );
				
				Tree.remove();
			}
		}
	);
}

/**
*	Function processes item removal.
*
*	@param ConfirmString - Confirmation string.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.RemoveItem = function( ConfirmString )
{
	var 		Tree = jQuery.jstree._focused();
	var			Node = Tree.get_selected();
	var			ErrMsg = '';
	if( jQuery( Node ).attr( 'rel' ) == 'root' )
	{
		ErrMsg = ultimix.get_string( 'cant_delete_root_node' );
	}
	if( Node.length == 0 )
	{
		ErrMsg = ultimix.get_string( 'select_tree_node_first' );
	}
	if( ErrMsg != '' )
	{
		ultimix.std_dialogs.MessageBox( 
			ErrMsg , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR | ultimix.std_dialogs.MB_MODAL 
		);
		return;
	}
	
	ultimix.jstree.ShowRemoveItemDialog( ConfirmString );
}

jQuery(
	function()
	{
		jQuery( ".tree_control" ).jstree(
			{
				"plugins" : [ "themes" , "html_data" , "types" , "ui" , "crrm" , "cookies" , "types" ] , 
				"themes" : {
					"theme" : "classic" , 
					"url" : './packages/jstree/res/themes/classic/style.css'
				} , 
				"types" : 
				{
					"default" : 
					{
						draggable  : false , 
					}
				} , 
				"lang" : {
					new_node : "New item"
				} , 
				"core" : { 
					"initially_open" : [ "thtml_1" ] , 
					"strings" : { new_node : "New item" }
				} , 
				"types" : 
				{
					"valid_children" : [ "not_selectable" ],
					"types" :
					{
						"not_selectable" :
						{
							"valid_children" : [ "default" ] , 
							"hover_node" : false , 
							"select_node" : function(){ return( false ); }
						} , 
						"default" :
						{
							"valid_children" : [ "default" ]
						}
					}
				}
			}
		);
		
		jQuery( '.tree_control' ).bind( "create.jstree" , ultimix.jstree.CreateNodeEventHandler );
		jQuery( '.tree_control' ).bind( "rename.jstree" , ultimix.jstree.RenameNodeEventHandler );
		jQuery( '.tree_control' ).bind( "remove.jstree" , ultimix.jstree.RemoveNodeEventHandler );
	}
);
/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.jstree )
{
	ultimix.jstree = {};
}

/**
*	Function saves the selected value.
*
*	@param AcceptorSelector - Selector of the destination data field.
*
*	@param StatusSelector - Selector of the destination status field.
*
*	@return true if the data was saved, otherwise false.
*
*	@author Dodonov A.A.
*/
ultimix.jstree.ExtractJSTreeNode = function( AcceptorSelector , StatusSelector )
{
	var 	Tree = jQuery.jstree._focused();
	var		Node = Tree.get_selected();

	if( Node.length )
	{
		var	id = jQuery( Node ).attr( 'id' );
		id = id.replace( 'phtml_' , '' );
		
		jQuery( AcceptorSelector ).attr( 'value' , id );
		jQuery( StatusSelector ).attr( 'value' , Tree.get_text( Node ) );

		return( true );
	}
	else
	{
		ultimix.std_dialogs.MessageBox( 
			ultimix.get_string( 'nothing_was_selected' ) , ultimix.get_string( 'Error' ) , 
			ultimix.std_dialogs.MB_OK | ultimix.std_dialogs.MB_ICONERROR
		);
	}
	return( false );
}

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_tree_item' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_tree_item' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_tree_item' ][ 'default' ] = 'Вы уверены что хотите удалить выбранный элемент?';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'nothing_was_selected' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'nothing_was_selected' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'nothing_was_selected' ][ 'default' ] = 'Не выбрано ни одного элемента.';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'select_tree_node_first' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'select_tree_node_first' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'select_tree_node_first' ][ 'default' ] = 'Сначала выберите какой-нибудь элемент';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_delete_this_item' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_delete_this_item' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_delete_this_item' ][ 'default' ] = 'Этот элемент нельзя удалить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_edit_this_item' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_edit_this_item' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_edit_this_item' ][ 'default' ] = 'Этот элемент нельзя изменить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'tree_new_item' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'tree_new_item' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'tree_new_item' ][ 'default' ] = 'Новый элемент';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_delete_root_node' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_delete_root_node' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'cant_delete_root_node' ][ 'default' ] = 'Невозможно удалить корневой элемент';

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'root_category' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'root_category' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'root_category' ][ 'default' ] = 'Корневая[nbsp]категория';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_title' ][ 'default' ] = 'Название[nbsp]категории';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_root_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_root_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_root_title' ][ 'default' ] = 'Название[nbsp]корневой[nbsp]категории';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_mask' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_mask' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_mask' ][ 'default' ] = 'Маска';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_actions' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_actions' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_actions' ][ 'default' ] = 'Действия';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_delete' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_delete' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_delete' ][ 'default' ] = 'удалить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_edit' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_edit' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_edit' ][ 'default' ] = 'редактировать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_save' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_save' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_save' ][ 'default' ] = 'сохранить';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_create' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_create' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_create' ][ 'default' ] = 'создать';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_category' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_category' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'shure_to_delete_category' ][ 'default' ] = 'Вы[nbsp]уверены,[nbsp]что[nbsp]хотите[nbsp]удалить[nbsp]категорию?';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_direct_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_direct_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_direct_title' ][ 'default' ] = 'Сквозная[nbsp]категория';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category' ][ 'default' ] = 'Категория';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'catalogue_is_empty' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'catalogue_is_empty' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'catalogue_is_empty' ][ 'default' ] = 'Каталог пуст';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'catalogue' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'catalogue' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'catalogue' ][ 'default' ] = 'Каталог';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_label' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_label' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_label' ][ 'default' ] = 'Категории';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_manager' ][ 'default' ] = 'Управление категориями';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'mask_must_be_filled' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'mask_must_be_filled' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'mask_must_be_filled' ][ 'default' ] = 'Поле "{lang:category_mask}" должно быть заполнено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'title_must_be_filled' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'title_must_be_filled' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'title_must_be_filled' ][ 'default' ] = 'Поле "{lang:category_title}" должно быть заполнено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_delete_was_completed' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_delete_was_completed' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_delete_was_completed' ][ 'default' ] = 'Удаление выбранных записей было завершено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_create_was_completed' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_create_was_completed' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_create_was_completed' ][ 'default' ] = 'Запись была создана';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_update_was_completed' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_update_was_completed' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_update_was_completed' ][ 'default' ] = 'Редактирование было успешно завершено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_selection' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_selection' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_selection' ][ 'default' ] = 'Выбор категории';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_name' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_name' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'category_name' ][ 'default' ] = 'Локатор';

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.site )
{
	ultimix.site = {};
}

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.site.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}
	
	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_site_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'site::site_view';
	ViewOptions.paging_require_form = ViewOptions.paging_require_form ? ViewOptions.paging_require_form : '0';
	ViewOptions.add_hidden_fields = ViewOptions.add_hidden_fields ? ViewOptions.add_hidden_fields : '0';

	return( ViewOptions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.site.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.site.set_default_options( ViewOptions );

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Header - List header template file name.
*
*	@param Item - List item template file name.
*
*	@param Footer - List footer template file name.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.site.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.site.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'site_header.tpl';
	ViewOptions.item = Item ? Item : 'site_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'site_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_manager' ][ 'default' ] = 'Сайты';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'domain' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'domain' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'domain' ][ 'default' ] = 'Домен';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'comment' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'comment' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'comment' ][ 'default' ] = 'Комментарий';

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.task )
{
	ultimix.task = {};
}

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.task.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}
	
	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_task_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'task::task_view';
	ViewOptions.paging_require_form = ViewOptions.paging_require_form ? ViewOptions.paging_require_form : '0';
	ViewOptions.add_hidden_fields = ViewOptions.add_hidden_fields ? ViewOptions.add_hidden_fields : '0';

	return( ViewOptions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.task.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.task.set_default_options( ViewOptions );

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Header - List header template file name.
*
*	@param Item - List item template file name.
*
*	@param Footer - List footer template file name.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.task.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.task.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'task_header.tpl';
	ViewOptions.item = Item ? Item : 'task_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'task_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_manager' ][ 'default' ] = 'Задачи';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'tasks' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'tasks' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'tasks' ][ 'default' ] = 'Задачи';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_title' ][ 'default' ] = 'Задача';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_author' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_author' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_author' ][ 'default' ] = 'Постановщик';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'creation_date' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'creation_date' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'creation_date' ][ 'default' ] = 'Начало';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'end_date' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'end_date' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'end_date' ][ 'default' ] = 'Окончание';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'state_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'state_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'state_title' ][ 'default' ] = 'Статус';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'action_title' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'action_title' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'action_title' ][ 'default' ] = 'Действие';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_description' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_description' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_description' ][ 'default' ] = 'Описание';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_title_must_be_filled' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_title_must_be_filled' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_title_must_be_filled' ][ 'default' ] = 'Поле "{lang:task_title}" должно быть заполнено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_description_must_be_filled' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_description_must_be_filled' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_description_must_be_filled' ][ 'default' ] = 'Поле "{lang:task_description}" должно быть заполнено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_create_was_completed' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_create_was_completed' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_create_was_completed' ][ 'default' ] = 'Задача была создана';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_update_was_completed' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_update_was_completed' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_update_was_completed' ][ 'default' ] = 'Редактирование было завершено';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_comment' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_comment' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'task_comment' ][ 'default' ] = 'Комментарий';

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.site_page )
{
	ultimix.site_page = {};
}

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.site_page.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}
	
	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_site_page_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'seo_tools::site_page_view';
	ViewOptions.paging_require_form = ViewOptions.paging_require_form ? ViewOptions.paging_require_form : '0';
	ViewOptions.add_hidden_fields = ViewOptions.add_hidden_fields ? ViewOptions.add_hidden_fields : '0';

	return( ViewOptions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.site_page.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.site_page.set_default_options( ViewOptions );

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Header - List header template file name.
*
*	@param Item - List item template file name.
*
*	@param Footer - List footer template file name.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.site_page.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.site_page.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'site_page_header.tpl';
	ViewOptions.item = Item ? Item : 'site_page_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'site_page_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_page_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_page_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'site_page_manager' ][ 'default' ] = 'Менеджер страниц сайтов';

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.page_text )
{
	ultimix.page_text = {};
}

/**
*	Function sets list view options.
*
*	@param ViewOptions - Extra view generation options.
*
*	@return View options.
*
*	@author Dodonov A.A.
*/
ultimix.page_text.set_default_options = function( ViewOptions )
{
	if( !ViewOptions )
	{
		ViewOptions = {};
	}
	
	ViewOptions.meta = ViewOptions.meta ? ViewOptions.meta : 'meta_page_text_list';
	ViewOptions.package_name = ViewOptions.package_name ? ViewOptions.package_name : 'seo_tools::page_text_view';
	ViewOptions.paging_require_form = ViewOptions.paging_require_form ? ViewOptions.paging_require_form : '0';
	ViewOptions.add_hidden_fields = ViewOptions.add_hidden_fields ? ViewOptions.add_hidden_fields : '0';

	return( ViewOptions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.page_text.get_list_form = function( Fuctions , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.page_text.set_default_options( ViewOptions );

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

/**
*	Function returns list view.
*
*	@param Functions - Functions to process success and error events.
*
*	@param Header - List header template file name.
*
*	@param Item - List item template file name.
*
*	@param Footer - List footer template file name.
*
*	@param ViewOptions - Extra view generation options.
*
*	@author Dodonov A.A.
*/
ultimix.page_text.get_custom_list_form = function( Fuctions , Header , Item , Footer , ViewOptions )
{
	if( !Fuctions )
	{
		Fuctions = {};
	}

	ViewOptions = ultimix.page_text.set_default_options( ViewOptions );

	ViewOptions.header = Header ? Header : 'page_text_header.tpl';
	ViewOptions.item = Item ? Item : 'page_text_item.tpl';
	ViewOptions.footer = Footer ? Footer : 'page_text_footer.tpl';

	ultimix.ajax_gate.direct_view( ViewOptions , Fuctions );
}

if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_text_manager' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_text_manager' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_text_manager' ][ 'default' ] = 'Менеджер анкеров';
if( !ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_texts' ] ) ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_texts' ] = {};
ultimix.lang.Strings[ ultimix.lang.Locale ][ 'page_texts' ][ 'default' ] = 'Анкеры страницы';

/**
*	Global namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix )
{
	ultimix = {};
}

/**
*	Local namespace.
*
*	@author Dodonov A.A.
*/
if( !ultimix.context_set )
{
	ultimix.context_set = {};
}

