<?php
// WARNING: No blank line or spaces before the "< ? p h p" above this.

// IMPORTANT: This file should be made in UTF-8 (without BOM) only.
// CB will automatically convert to site's local character set.

/**
* Joomla/Mambo Community Builder
* @version $Id: admin_language.php$
* @package Community Builder
* @subpackage Russian Core CB Admin Language file
* @since 1.2.2 
* @author Beat
* @copyright (C) www.joomlapolis.com
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
* Translated into Russian by Alex (aka Alexander) Smirnov, twitter.com/joomladka
*/




// ensure this file is being included by a parent file:
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }


// Important:
// Please check on Joomlapolis.com forum in CB Language translations subforum first before translating:
// 1) if there is a translation already done or on the way where you can cooperate
// 2) if a newer version of this reference file exists and for translation instructions
// 3) consider joining CB translations workgroup (again see forum for instructions)
// THIS IS ONLY A REFERENCE FILE FOR TRANSLATORS, NOT USED IN CB. THE FILE admin_language.php IS USED (but not needed in default language, so empty).


// 1.2.2 Stable: (new method: UTF8 encoding here):
CBTxt::addStrings( array(

// XML files:

// cb.authortab.xml
'Provides an User Tab that shows all articles written by the user.' => 'Обеспечивает вкладку пользователя, которая показывает все написанные пользователем статьи.',

// cb.connections.xml
// some also used in other files (php and xml)
'Provides CB Core Connections functionality' => 'Обеспечивает функциональность основных связей CB',
'Display Settings' => 'Показать настройки',
'User Profile Status :' => 'Статус профиля пользователя:',
'see Field: Connections: Parameters' => 'смотрите Field: Connections: Parameters',
'Connections Status Settings :' => 'Настройки статуса связи:',
'Show Title' => 'Показать заголовок',
'Show a title' => 'Показать какой-либо заголовок',
'Show Summary' => 'Показать сводку',
'Shows a small number of connections with a link to see them all in paginated form.' => 'Показывает небольшое число связей со ссылкой, чтобы увидеть их все в формате нескольких страниц.',
'Entries shown in Summary' => 'Записи, показанные в сводке',
'If Show Summary is enabled, this is the number of connections displayed. Otherwise, this is ignored. Default is 4.' => 'Если "Показать сводку" включено, то это - число показанных связей. Иначе это игнорируется. Число по умолчанию - 4.',
'Enable Paging' => 'Включить нумерацию страниц',
'Allow entries to automatically page when they exceed the number per page limit.' => 'Позволить записям создавать страницы в случае, когда их число превысит лимит записей, отведенный для одной страницы.',
'Max entries shown or per Page' => 'Максимальное количество записей, показываемых на одной странице.',
'If paging is enabled, this is the number of connections per page. Otherwise, this is the number of connections to show. Default is 10.' => 'Если нумерация страниц включена, то это постраничное число связей. В противном случае, это число связей для показа. По умолчанию оно имеет значение 10.',

// cb.core.xml
// some also used in other files (php and xml)
'Core CB Tabs and Events.' => 'Системные вкладки и события СВ.',
'Display description' => 'Показать описание',
'To display &quot;[edit photo]&quot;, type following into description: [menu style=&quot;color:green;&quot; caption=&quot;&amp;91;edit your photo&amp;93;&quot; img=&quot;&quot;] _UE_MENU_EDIT : _UE_UPDATEAVATAR [/menu]' => 'Чтобы показать &quot;[edit photo]&quot;, впишите в описание следующее: [menu style=&quot;color:green;&quot; caption=&quot;&amp;91;edit your photo&amp;93;&quot; img=&quot;&quot;] _UE_MENU_EDIT : _UE_UPDATEAVATAR [/menu]',
'User Profile Title text' => 'Текст заголовка профиля пользователя',
'Page title text. Enter text to be displayed as profile page title. %s will be replaced by user-name depending on global settings. Or use language-dependant _UE_PROFILE_TITLE_TEXT (default)' => 'Текст заголовка страницы. Введите текст, который Вы хотите показывать как заголовок страницы профиля. В зависимости от общих настроек, %s будет заменено пользовательским именем. Или используйте работающий в зависимости от языка _UE_PROFILE_TITLE_TEXT (default)',
'Check Box (Single)' => 'Чек бокс (одиночный)',
'Check Box (Multiple)' => 'Чек бокс (многократный)',
'Display on profiles as' => 'Показать на профиле как',
'How to display the values of this multi-valued field' => 'Как показывать значения этого поля с многократными значениями',
'Comma ","-separated line' => 'Запятая ","-отделенная строчка',
'Unnumbered list "ul"' => 'Непронумерованный список "ul"',
'Ordered list "ol"' => 'Пронумерованный список "ol"',
'CSS class of the list' => 'Стилевой класс CSS списка',
'Enter the name of the list class (optional) for OL or UL tag' => 'Введите название класса списка (необязательное) для тег OL или UL',
'Integer Number' => 'Число по типу данных "integer"',
'Field entry validation' => 'Проверка ввода поля',
'Minimum value allowed' => 'Минимально разрешенное значение',
'Enter the minimum integer value allowed. Default is 0.' => 'Введите минимально разрешенное значение по типу данных "integer". По умолчанию оно равно 0.',
'Maximum value allowed' => 'Максимально разрешенное число',
'Enter the maximum value allowed. Default is 1000000.' => 'Введите максимально разрешенное значение. По умолчанию оно равно 1000000.',
'Forbidden values at registration' => 'Запрещенные при регистрации значения',
'You can set a list of values (separated by comma ,) which are not allowed in this field for registration.' => 'Вы можете включить список значений (отделенных запятой), которые запрещены к вводу во время регистрации в это поле.',
'Forbidden values in user profile edits' => 'Значения, запрещенные в редактировании профиля пользователя',
'You can set a list of values (separated by comma ,) which are not allowed in this field when user updates his profile in profile edits.' => 'Вы можете включить список значений (разделенных запятой), которые не разрешены в этом поле когда пользователь обновляет/редактирует свой профиль.',
'Authorized input' => 'Разрешенный ввод',
'Type of input authorized.' => 'Тип разрешенного ввода.',
'Any string ( /.*/ )' => 'Любая строчка ( /.*/ )',
'Custom PERL regular expression' => 'Произвольные регулярные выражения языка PERL',
'Perl Regular Expression' => 'Регулярные выражения Perl',
'Any string: /^.*$/ , only digits: /^[0-9]*$/, only a-z + A-Z + digits: /^[0-9a-z]*$/i' => 'Любая строчка: /^.*$/ , только цифры: /^[0-9]*$/, только a-z + A-Z + цифры: /^[0-9a-z]*$/i',
'Error in case of invalid input' => 'Ошибка в случае недействительного ввода данных',
'Enter a clear and helpful error message in case of validation pattern mismatch.' => 'Введите ясное и полезное сообщение об ошибке на случай несоответствия сверяемой схеме.',
'Date' => 'Дата',
'Minimum Year shown' => 'Минимальный показываемый год',
'Type +0 for this year, type-in 4-digits year, for example 1923, or just a number prefixed with + or - sign, for example +25 or -110, to set a value relative to current year, e.g. -99 for maximum age of 99 years (or 190' => 'Введите +0 для текущего года, введите 4-х цифровой год, например 1923, или просто число с приставленным знаком + или знаком -, например +25 или -110 чтобы включить значение, относительно текущего года, как например -99 для максимального возраста в 99 лет (или 190',
'Maximum Year shown' => 'Максимально показываемый год',
'Type +0 for this year, type-in 4-digits year, for example 1923, or just a number prefixed with + or - sign, for example +25 or -110, to set a value relative to current year, e.g. -12 for minimum age of 12 years' => 'Введите +0 для текущего года, введите 4-х цифровой год, как например 1923, или просто число с приставленным знаком + или -, как например +25 или -110, чтобы включить число относительно текущего года, как например -12 для минимального возраста в 12 лет',
'Whether you want users to see this date on profile as a date or as an age' => 'Хотите ли Вы чтобы пользователи видели эту дату в профиле как дату или как возраст',
'Full date' => 'Полная дата',
'Age in years' => 'Возраст в годах',
'time ago' => 'время назад',
'birthday only without year' => 'день рождения только без лет',
'Display N years text' => 'Показывать текст N лет',
'Whether you want to display just number N of years (e.g. Age: 20), or add \' years\' behind the age N (e.g. Age: 20 years). Uses language-string _UE_AGE_YEARS.' => 'Хотите ли бы показывать только число N лет (как например: Возраст: 20), или добавить слово "лет" после числа N лет (как например: Возраст: 20 лет). Используется языковая строчка _UE_AGE_YEARS.',
'Display just \'N\'' => 'Показывать просто \'N\'',
'Display \'N years\'' => 'Показывать \'N лет\'',
'Display T ago text' => 'Показывать "Т назад" текст',
'Whether you want to display just the time T ago (e.g. 3 months), or add \' ago\' behind the time T (e.g. 3 months ago). Uses language-string _UE_ANYTHING_AGO.' => 'Хотите ли Вы показывать просто как число отчета времени назад (например 3 месяца), или добавить "назад" после численного значения времени (например, 3 месяца назад). Используется языковая строчка  _UE_ANYTHING_AGO.',
'Display just \'T\'' => 'Показывать только \'T\', т.е. только численное значение времени',
'Display \'T ago\'' => 'Показывать \'T назад\'',
'If searchable, then search by' => 'Если возможен поиск, то искать по',
'Whether you want users to search by date or by age' => 'Хотите ли Вы чтобы пользователи искали по дате или по возрасту',
'Age' => 'Возраст',
'Alternate field title for age/time ago/birthday only display' => 'Альтернативное поле показа заголовка для возраст/время назад/день рождения',
'Leave blank for using same title as in normal date display mode, or enter alternate text, e.g. \'Age\' (multilinguale: type just: _UE_AGE) or \'Birthday\' (_UE_Birthday) instead of normal birthdate title. CB translation strings, as well as fields-substitutions, e.g. \'[name]\'s age\' can be used.' => 'Оставьте незаполненным для использования того же заголовка, что и в обычном виде показа даты, или введите альтернативный текст, например "Возраст" (для многоязычных сайтов: введите просто _UE_AGE) или "День рождения" (_UE_Birthday) вместо обычного заголовка дня рождения. Могут быть использованы строчки перевода CB, также как и замены полей, как например "[name] - возраст".',
'Display Date and time' => 'Показывать дату и время',
'Whether you want to display date and time' => 'Хотите ли Вы показывать дату и время',
'Yes date and also time if available' => 'Да дате и времени если они присутствуют',
'Date only' => 'Только дату',
'Date and time' => 'Дату и время',
'Yes date and also time' => 'Да дату и также время',
'Drop Down (Single Select)' => 'Выскакивающий (одиночный)',
'Drop Down (Multi-select)' => 'Выскакивающий (многократный)',
'Email Address' => 'Адрес эл.почты',
'Enable Email checker' => 'Включить проверку эл.почты',
'Whether you want to feedback to user if email is valid or not.' => 'Хотите ли Вы дать знать пользователю о том, действителен ли адрес эл.почты или нет.',
'No: no ajax email checking' => 'Нет: не проводить ajax-овскую проверку эл.почты',
'Yes: Check email address and server' => 'Да: Проверять адрес эл.почты и сервер',
'Forbidden words at registration' => 'Запрещенные при регистрации слова',
'You can set a list of bad words (separated by comma ,) which are not allowed in this field for registration. Use comma twice (,,) to add comma as bad character.' => 'Вы можете настроить список плохих слов (отделенных запятой), которые запрещены во время регистрации в этом поле. Используйте запятую дважды (,,) чтобы добавить саму запятую как плохой знак.',
'Forbidden words in user profile edits' => 'Слова, запрещенные при редактировании профиля пользователя',
'You can set a list of bad words (separated by comma ,) which are not allowed in this field when user updates his profile in profile edits. Use comma twice (,,) to add comma as bad character.' => 'Вы можете настроить список плохих слов отделенных запятой, которые запрещены в этом поле во время редактирования пользователем своего профиля. Используйте запятую дважды (,,) чтобы добавить саму запятую как плохой знак.',
'Email address (main)' => 'Адрес эл.почты (главный)',
'Editor Text Area' => 'Текстовое поле редактора',
'Minimum length' => 'Минимальная длинна',
'Minimum length of content (0 = no minimum)' => 'Минимальная длинна содержания (0 = минимум отсутствует)',
'Text Area' => 'Текстовая часть',
'Text Field' => 'Текстовое поле',
'Single word ( /^[a-z]*$/ )' => 'Отдельное слово ( /^[a-z]*$/ )',
'Multiple words with spaces ( /^([a-z]+ *)*$/ )' => 'Более чем одно слово с разделами ( /^([a-z]+ *)*$/ )',
'Single a-z,A-Z,0-9,_ word ( /^[a-z]+[a-z0-9_]*$/i )' => 'Отдельное a-z,A-Z,0-9,_ слово ( /^[a-z]+[a-z0-9_]*$/i )',
'At least 6 chars, 1 a-z, 1 A-Z, 1 0-9, 1 special' => 'Как минимум 6 знаков, 1 a-z, 1 A-Z, 1 0-9, 1 специальный',
'Radio Buttons' => 'Радио кнопки',
'Web Address' => 'Веб сайт',
'Predefined name and username fields' => 'Предварительно определенные поля имени и имени пользователя',
'Minimum length of content (0 = no minimum, empty = default system minimum length)' => 'Минимальная длинна содержания (0 = без минимума, пусто = минимальная длина, заданная в системе по умолчанию)',
'Password' => 'Пароль',
'Minimum length of password (0 = no minimum, empty = default system minimum length)' => 'Минимальная длинна пароля (0 = без минимума, пусто = минимальная длина, заданная в системе по умолчанию)',
'Image' => 'Изображение',
'Image limits' => 'Ограничения изображения',
'If left empty, the default settings from global Community Builder configuration will be taken. Other settings, like images-library, systematic resampling and so on is done in the CB global configuration.' => 'Если оставлена пустой, то включается конфигурация по умолчанию в общих настройках Community Builder. Другие настройки, как, например, библиотека изображений, постоянный ресамплинг и т.д., задаются  в общей конфигурации CB.',
'Maximum height in pixels to which the image on the profile will be resized' => 'Максимальная высота в пикселах, до которой будет изменен размер изображения в профиле',
'Maximum width in pixels to which the image on the profile will be resized' => 'Максимальная ширина в пикселах, до которой будет изменен размер изображения в профиле',
'Maximum size of file upload in kilobytes: recommended: 4000 for modern cameras (if your server supports that)' => 'Максимальный размер загрузки в килобайтах. Рекомендуется: 4000 для современных фотокамер (если это поддерживается Вашим сервером)',
'Maximum height in pixels to which the image on a users-list be resized' => 'Максимальная высота в пикселах, до которой будет изменен размер изображения в списке пользователей',
'Maximum width in pixels to which the image on a users-list be resized' => 'Максимальная ширина в пикселах, до которой будет изменен размер изображения в списке пользователей',
'&lt;strong&gt;WARNING&lt;/strong&gt;' => '&lt;strong&gt;ПРЕДУПРЕЖДЕНИЕ&lt;/strong&gt;',
'Only the main avatar is moderated for now, other image field types are not moderated in this release.' => 'Пока что модерируется только главный аватар. Другие типы полей изображений в этой версии не модерируются.',
'Online Status' => 'Статус на сайте',
'Connections' => 'Связи',
'Counter' => 'Счетчик',
'Formatted name' => 'Отформатированное имя',
'User parameters' => 'Параметры пользователя',
'Fields delimiter' => 'Разделитель полей',

// cb.lists.xml
'Multi-Criteria Searches' => 'Поиски по более чем одному критериям',
'Users-lists can be searchable by multiple criterias, according to settings below, and the \'searchable\' attribute of the listed fields.' => 'Списки пользователей могут быть исследованы с помощью поиска с использованием нескольких поисковых критериев, в соответствии с нижеприведенными настройками, и при условии включенной настройки "открыто для поиска" для перечисленных полей.',
'Searchable fields' => 'Открытые для поиска поля',
'Whether this list has user-searchable fields' => 'Содержит ли это этот список поля, открытые для поиска пользователями',
'Searchable fields, displayed ones only' => 'Открытые для поиска поля, только показанные',
'All searchable fields' => 'Все поля, открытые для поиска',
'Search crieteria' => 'Критерий поиска',
'If users should be able to choose the type of comparison to be made (only standard \'is\' and ranges can be optimized in mysql with proper indexes).' => 'Смогут ли пользователи выбирать тип сравнения (только стандартное "является" и диапазоны могут быть оптимизированы в mysql с надлежащими индексами).',
'Simple Exact match: Only \'is\' and ranges' => 'Простое точное соответствие: Только "Является" и диапазоны',
'Simple Any word match: Only \'any of\' and ranges (WARNING: can be slow)' => 'Просто любое соответствующее слово: Только "Любое из" и диапазоны (ПРЕДУПРЕЖДЕНИЕ: может быть очень медленным)',
'Advanced: all possibilities (WARNING: can be slow)' => 'Усложненное: любые возможности (ПРЕДУПРЕЖДЕНИЕ: может быть медленным)',
'General list settings' => 'Общие настройки списка',
'Number of entries per page' => 'Число записей на странице',
'Number of users appearing per page. Leave empty to use the default CB setting.' => 'Число пользователей, появляющихся на странице. Оставьте пустой для использования настройки СВ по умолчанию.',
'Show pagination' => 'Показывать нумерацию страниц',
'Whether this list shows links for paging or just displays entries from first page. Default is yes.' => 'Показывает ли этот список ссылки на страницы или только показывает записи с первой страницы. Настройка по умолчанию - "Да".',
'Hot-linking protection for this users-list' => 'Защита от сторонних ссылок на этот список пользователей',
'Whether you want the links to the pages and searches in this list to not be permanent (we add a parameter which is valid for a few hours to all urls except first page and check it), so that except first page it\'s not hotlinkable and there are no permanent links on paging and on search criterias. Default is NO.' => 'Хотите ли Вы чтобы ссылки на страницы и результаты поиска в этом списке были необратимыми (мы добавляем параметр, который в течении нескольких часов будет иметь эффект на все URL-ы, за исключением первой страницы и проверяем это), так что за исключением первой страницы, на них нельзя будет ссылаться из сторонних сайтов и ни на нумерацию страниц, ни на критерии поиска не существует постоянных ссылок. Настройка по умолчанию - "Нет".',
'Setting hot-linking protection to \'Yes\' will prevent all pages from this list (if everybody has allowed access to it), except first page of list, to be bookmarkable and indexable by slow-pace search bots and search engines such as google, making the user profiles not indexed in search engines (if they are publicly accessible). This may be desirable in some cases, but removes all users-pages from the search-engines indexing, except for the users of the first page.' => 'Настройка защиты против ссылок извне на "Да" предотвратит возможность внесения всех страниц из этого списка (если к нему разрешен доступ всем), за исключением первой страницы списка, в список отмеченных и проиндексированных медленно работающими поисковыми ботами и поисковыми системами типа Google, таким образом защищая профили пользователей от индексирования (если они открыто доступны публике). Это будет очень желательно в некоторых случаях, но удаляет все страницы пользователей, за исключением пользователей на первой странице, из индексации поисковых двигателей.',

// cb.mamblogtab.xml
'Provides a User Tab that shows all Mamblog entries written by the user.' => 'Предоставляет вкладку пользователя, которая показывает все созданные пользователем записи блога.',
'List Settings' => 'Настройки списка',
'Blog Entries:' => 'Записи блога:',
'Number of blog entries to display' => 'Число записей блога к показу',
'If showing all posts, this is the number of posts per page. If showing only last ones, this is the number of blog entries to show. Default is 10' => 'Если все сообщения показываются, то это постраничное число сообщений. Если показываются только последние сообщения, то это число записей блога к показу. Число по умолчанию 10',
'Show all blogs with paging' => 'Показывать все записи блога с нумерацией страниц',
'If set to -show all- all blog entries will become visible in the user profile. Otherwise, only the last entries will be visible.' => 'Если включено на "Показывать все", то все записи блога станут видимы в профиле пользователя. В противном случае, видимыми будут только последние записи.',
'Only last ones' => 'Только последние',
'Show all' => 'Показывать все',
'Allow search function' => 'Позволить функцию поиска',
'IMPORTANT: Show all blog entries must also be set. Allows a search on user blog entries.' => 'ВАЖНО: Должно быть также включено "Показывать все" записи блога. Позволяет проводить поиск на блоговских записях пользователя.',
'Disabled' => 'Отключено',

// cb.menu.xml
'Core CB Menu and User Status tabs.' => 'Системное меню CB и вкладки статуса пользователя.',
'User Profile Menu :' => 'Меню профиля пользователя:',
'Menu display type' => 'Тип показа меню',
'Menu can be displayed as a menubar, a list of menu links, or not displayed in this tab.' => 'Меню может быть показано как планка меню, список ссылок пунктов меню или на этой вкладке не показано.',
'Menu Bar' => 'Планка меню',
'Menu List table 2 columns' => 'Список пунктов меню - двухколоночная таблица',
'Menu List table 1 column' => 'Список пунктов меню - одноколоночная таблица',
'Menu List ul-li-spans' => 'Список пунктов меню с тегами ul-li-spans',
'No Display' => 'Не показывать',
'Status display type' => 'Тип статуса показа',
'Status can be displayed as a list or not displayed in this tab.' => 'Статус может быть показан как список или не показан на этой вкладке.',
'Status List ul-li-spans' => 'Список статуса с тегами ul-li-spans',
'see Plugins: Menu: Parameters' => 'смотрите Плагины: Меню: Параметры',
'Menu Settings :' => 'Настройки меню:',
'Settings' => 'Настройки',
'Heading Menu :' => 'Верхняя часть меню:',
'First Menu Name' => 'Название первого меню',
'First menu name before &quot;Edit&quot;. Default is &quot;Community&quot; = _UE_MENU_CB. Leave empty to not appear.' => 'Название первого меню перед &quot;Редактировать&quot;. По умолчанию это &quot;Сообщество&quot; = _UE_MENU_CB. Оставьте пустой если не хотите чтобы оно появлялось.',
'First Sub-Menu Name' => 'Название первого подменю',
'First sub-menu name. Default is &quot;About Community Builder...&quot; = _UE_MENU_ABOUT_CB. Leave empty to not appear.' => 'Название первого подменю. По умолчанию это &quot;Об Community Builder...&quot; = _UE_MENU_ABOUT_CB. Оставьте пустой если не хотите чтобы оно появлялось.',
'First Sub-Menu URL' => 'URL первого подменю',
'First sub-menu URL. Default is index.php?option=com_comprofiler&amp;task=teamCredits' => 'URL первого подменю. По умолчанию это index.php?option=com_comprofiler&amp;task=teamCredits',
'Second Sub-Menu Name' => 'Название второго подменю',
'Second sub-menu name. Leave empty to not appear.' => 'Название второго подменю. Оставьте пустой если не хотите чтобы оно появлялось.',
'Second Sub-Menu URL' => 'URL второго подменю',
'Second sub-menu URL.' => 'URL второго подменю.',
'Display Settings: Hits, Online, Member since, last online, last updated on have moved to core Community Builder fields, see fields management.' => 'Настройки показа: Просмотров, На линии, Член с, Последний визит, Последнее обновление были перенесены в системные поля Community Builder, смотрите управление полями.',
'see Plugin: Connections: Parameters' => 'смотрите Plugin: Connections: Parameters',
'Connections Settings :' => 'Настройки связей:',

// cb.simpleboardtab.xml
'Provides a User Tab that shows top Fireboard/Joomlaboard/Simpleboard posts as well as forum statistics for the user.' => 'Обеспечивает вкладку пользователя, которая показывает верхние сообщения форумов Fireboard/Joomlaboard/Simpleboard, так же как и форумские статистики пользователя.',
'Forum component' => 'Компонент форума',
'Choose the type of forum for integration. &lt;strong&gt;IMPORTANT: Fireboard/Joomlaboard/Simpleboard configuration integration with CB must be enabled and fields created from that same forum configuration integration tab.&lt;/strong&gt;' => 'Выберите тип форума для интеграции. &lt;strong&gt;ВАЖНО: должна быть включена конфигурация интеграции форумов Fireboard/Joomlaboard/Simpleboard с CB и созданы поля с той же вкладки конфигурации интеграции форума.&lt;/strong&gt;',
'Auto-detect' => 'Автоматическое определение',
'Kunena from www.kunena.com' => 'Kunena от www.kunena.com',
'Fireboard from www.bestofjoomla.com' => 'Fireboard от www.bestofjoomla.com',
'Joomlaboard from www.tsmf.net' => 'Joomlaboard от www.tsmf.net',
'Simpleboard' => 'Simpleboard',
'Detected Forums' => 'Найденные форумы',
'Sidebar:' => 'Боковая планка:',
'Sidebar Mode' => 'Вид боковой планки',
'Kunena sidebar is displayed on the right of every post. This sidebar can be customized to display any information so desired using the various supported modes.' => 'Боковая планка форума Kunena показывается справа от каждого сообщения. Используя различные поддерживаемые схемы, эта боковая планка может быть подстроена для отображения любой необходимой информации.',
'Basic (default kunena)' => 'Основная (Kunena по умолчанию)',
'Beginner (field selection)' => 'Начинающий (выбор поля)',
'Advanced (subsitution textarea)' => 'Продвинутый (текстовое поле замены)',
'Expert (PHP file)' => 'Эксперт (файл PHP)',
'Name Field' => 'Название поля',
'Field displayed in position of Username in sidebar.' => 'Поле отображенное в позиции Имя пользователя на боковой планке.',
'Avatar Field' => 'Поле аватара',
'Field displayed in position of Avatar in sidebar.' => 'Поле отображаемое в позиции Аватар на боковой планке.',
'Personal Text Field' => 'Личное текстовое поле',
'Field displayed in position of Personal Text in sidebar.' => 'Поле отображаемое в позиции Личное текстовое поле на боковой планке.',
'Birthday Field' => 'Поле День рождения',
'Field displayed in position of Birthday icon in sidebar.' => 'Поле отображаемое в позиции День рождения на боковой планке.',
'Location Field' => 'Поле Местность',
'Field displayed in position of Location icon in sidebar.' => 'Поле отображаемое в позиции Местность на боковой планке.',
'Gender Field' => 'Поле Пол',
'Field displayed in position of Gender icon in sidebar.' => 'Поле отображаемое в позиции Пол на боковой планке.',
'ICQ Field' => 'Поле ICQ',
'Field displayed in position of ICQ icon in sidebar.' => 'Поле отображаемое в позиции ICQ на боковой планке.',
'AIM Field' => 'Поле AIM',
'Field displayed in position of AIM icon in sidebar.' => 'Поле отображаемое в позиции AIM на боковой планке.',
'YIM Field' => 'Поле YIM',
'Field displayed in position of YIM icon in sidebar.' => 'Поле отображаемое в позиции YIM на боковой планке.',
'MSN Field' => 'Поле MSN',
'Field displayed in position of MSN icon in sidebar.' => 'Поле отображаемое в позиции MSN на боковой планке.',
'SKYPE Field' => 'Поле SKYPE',
'Field displayed in position of SKYPE icon in sidebar.' => 'Поле отображаемое в позиции SKYPE на боковой планке.',
'GTALK Field' => 'Поле GTALK',
'Field displayed in position of GTALK icon in sidebar.' => 'Поле отображаемое в позиции GTALK на боковой планке.',
'Website Field' => 'Поле Вебсайт',
'Field displayed in position of Website icon in sidebar.' => 'Поле отображаемое в позиции Вебсайт на боковой планке.',
'Example' => 'Пример',
'Existing Users Sidebar' => 'Боковая планка Существующие пользователи',
'Advanced sidebar supports html and substitutions to fully design display of sidebar. Will display the sidebar of existing users.' => 'Продвинутая боковая планка поддерживает html и замены на показ полностью нового дизайна. Будет показывать боковую планку существующих пользователей.',
'Deleted Users Sidebar' => 'Боковая планка Удаленные пользователи',
'Advanced sidebar supports html and substitutions to fully design display of sidebar. Will display the sidebar of deleted users.' => 'Продвинутая боковая планка поддерживает html и замены на показ полностью нового дизайна. Будет показывать боковую планку удаленных пользователей.',
'Public Users Sidebar' => 'Боковая планка Публика',
'Advanced sidebar supports html and substitutions to fully design display of sidebar. Will display the sidebar of public users.' => 'Продвинутая боковая планка поддерживает html и замены на показ полностью нового дизайна. Будет показывать боковую планку публики.',
'Expert PHP file can be located at the following location: components/com_comprofiler/plugin/user/plug_cbsimpleboardtab/view/ within the file cb.simpleboardtab.sidebar.php as the function ShowExpert.' => 'Файл Эксперт PHP может быть найден по следующему пути: components/com_comprofiler/plug_cbsimpleboardtab/view/ внутри файла cb.simpleboardtab.sidebar.php как функция ShowExpert.',
'Expert Sidebar' => 'Боковая планка Эксперт',
'Forum Status:' => 'Статус Форума:',
'Display forum statistics' => 'Показывать статистику форума',
'Display the forum statistics. &lt;strong&gt;IMPORTANT: Kunena/Fireboard/Joomlaboard/Simpleboard configuration must also allow to show this!&lt;/strong&gt;' => 'Показывать статистику форума. &lt;strong&gt;ВАЖНО: конфигурация форума Kunena/Fireboard/Joomlaboard/Simpleboard также должна позволять показывать это!&lt;/strong&gt;',
'In User Profile Status' => 'Статус в профиле пользователя',
'In Forum Tab' => 'Вкладка в форуме',
'Path Template rank' => 'Ранг пути шаблона',
'Ranking' => 'Ранг',
'Display the forum ranking text. &lt;strong&gt;IMPORTANT: Kunena/Fireboard/Joomlaboard/Simpleboard configuration must also allow to show this!&lt;/strong&gt;' => 'Показывать текст форумского ранга. &lt;strong&gt;ВАЖНО: конфигурация форума Kunena/Fireboard/Joomlaboard/Simpleboard также должна позволять показывать это!&lt;/strong&gt;',
'Ranking Slider' => 'Скользящая настройка ранга',
'Display the forum ranking graphic' => 'Показывать форумскую графику ранга',
'Show Slider' => 'Показывать скользящую настройку',
'Total Posts' => 'Всего сообщений',
'Display the forum total posts. &lt;strong&gt;IMPORTANT: Kunena/Fireboard/Joomlaboard/Simpleboard configuration must also allow to show this!&lt;/strong&gt;' => 'Показывать суммарное количество сообщений форума. &lt;strong&gt;ВАЖНО: конфигурация форума Kunena/Fireboard/Joomlaboard/Simpleboard также должна позволять показывать это!&lt;/strong&gt;',
'Show if not 0' => 'Показывать если не 0',
'Karma' => 'Карма',
'Display the forum karma. &lt;strong&gt;IMPORTANT: Kunena/Fireboard/Joomlaboard/Simpleboard configuration must also allow to show this!&lt;/strong&gt;' => 'Показывать карму форума. &lt;strong&gt;ВАЖНО: конфигурация форума Kunena/Fireboard/Joomlaboard/Simpleboard также должна позволять показывать это!&lt;/strong&gt;',
'List Settings: see tab configuration: parameters' => 'Настройки списка: смотрите Конфигурация: Вкладки: Параметры',
'Forum Posts:' => 'Сообщения форума:',
'Number of posts to display' => 'Число сообщений к показу',
'If showing all posts, this is the number of posts per page. If showing only last ones, this is the number of posts to show. Default is 10' => 'Если все сообщения показываются, то это число сообщений на странице. Если показываются только последние сообщения форума, это число является числом сообщений для показа. По умолчанию - 10',
'Show all forum posts with paging' => 'Показывать все сообщения форума с постраничной нумерацией',
'If set to -show all- all forum posts will become visible in the user profile. Otherwise, only the last posts will be visible.' => 'Если включено на Показывать все, то все сообщения форума станут видимы в профиле пользователя. В противном случае, будут видимы только последние сообщения.',
'IMPORTANT: Show all posts must also be set. Allows a search on posts from the user.' => 'ВАЖНО: Показывать все сообщения также должно быть включено. Позволяет поиск в сообщениях пользователя.',
'see plugin configuration: Forum: parameters' => 'смотрите Конфигурация плагина: Форум: Параметры',
'More settings:' => 'Больше настроек:',
'Forum Status' => 'Статус форума',
'Forum Settings' => 'Настройки форума',

// pms.mypmspro.xml
'Provides the myPMS, PMS Pro, PMS Enhanced, JIM and uddeIM 0.4/1.0 integration for Community Builder.' => 'Обеспечивает интеграцию СВ с myPMS, PMS Pro, PMS Enhanced, JIM и uddeIM 0.4/1.0.',
'PMS Component type' => 'Тип компонента PMS',
'Choose type of component installed. &lt;strong&gt;IMPORTANT: Component configuration must also be done!&lt;/strong&gt;' => 'Выберите тип установленного компонента. &lt;strong&gt;ВАЖНО: Также должна быть завершена конфигурация компонента!&lt;/strong&gt;',
'MyPMS Open Source' => 'MyPMS Open Source',
'uddeIM 0.4' => 'uddeIM 0.4',
'uddeIM 1.0' => 'uddeIM 1.0',
'JIM 1.0.1' => 'JIM 1.0.1',
'PMS Send Menu/Link text' => 'Текст Отослать меню/ссылки PMS',
'Default is _UE_PM_USER, the local translation of &quot;Send Private Message&quot;' => 'По умолчанию это _UE_PM_USER, местный перевод &quot;Отправить личное сообщение&quot;',
'PMS Send Menu/Link Description' => 'Описание Отослать меню/ссылка PMS',
'Default is _UE_MENU_PM_USER_DESC, the local translation of &quot;Send a Private Message to this user&quot;' => 'По умолчанию это _UE_MENU_PM_USER_DESC, местный перевод &quot;Отправить личное сообщение этому пользователю&quot;',
'PMS Inbox Menu/Link text' => 'Текст меню/ссылки папки входящих сообщений PMS',
'Default is _UE_PM_INBOX, the local translation of &quot;Show Private Inbox&quot;' => 'По умолчанию этот _UE_PM_INBOX, местный перевод &quot;Show Private Inbox&quot;',
'PMS Menu/Link Description' => 'Описание меню/ссылки PMS',
'Default is _UE_MENU_PM_INBOX_DESC, the local translation of &quot;Show Received Private Messages&quot;' => 'По умолчанию это _UE_MENU_PM_INBOX_DESC, местный перевод &quot;Show Received Private Messages&quot;',
'only for PMS Pro/uddeIM' => 'только для PMS Pro/uddeIM',
'Following parameters:' => 'Следующие параметры:',
'PMS Outbox Menu/Link text' => 'Текст меню/ссылки папки исходящих сообщений PMS',
'Default is _UE_PM_OUTBOX, the local translation of &quot;Show Private Outbox&quot;' => 'По умолчанию это _UE_PM_OUTBOX, что есть местный перевод &quot;Show Private Outbox&quot;',
'PMS Outbox Menu/Link Description' => 'Описание меню/ссылки папки исходящих сообщений PMS',
'Default is _UE_MENU_PM_OUTBOX_DESC, the local translation of &quot;Show Sent Private Messages&quot;' => 'По умолчанию это _UE_MENU_PM_OUTBOX_DESC, что есть местный перевод фразы &quot;Show Sent Private Messages&quot;',
'PMS Trash Menu/Link text' => 'Текст меню/ссылки папки мусора PMS',
'Default is _UE_PM_TRASHBOX, the local translation of &quot;Show Trash&quot;' => 'По умолчанию это _UE_PM_TRASHBOX, что есть местный перевод фразы &quot;Show Trash&quot;',
'PMS Trash Menu/Link Description' => 'Описание меню/ссылки папки мусора PMS',
'Default is _UE_MENU_PM_TRASHBOX_DESC, the local translation of &quot;Show Trashed Private Messages&quot;' => 'По умолчанию это _UE_MENU_PM_TRASHBOX_DESC, что есть местный перевод фразы &quot;Show Trashed Private Messages&quot;',
'only for PMS Pro/uddeIM 0.5' => 'только для PMS Pro/uddeIM 0.5',
'PMS Options Menu/Link text' => 'Текст меню/ссылки опций PMS',
'Default is _UE_PM_OPTIONS, the local translation of &quot;Show PMS Options&quot;' => 'По умолчанию это _UE_PM_OPTIONS, что есть местный перевод фразы &quot;Show PMS Options&quot;',
'PMS Options Menu/Link Description' => 'Описание меню/ссылки опций PMS',
'Default is _UE_MENU_PM_OPTIONS_DESC, the local translation of &quot;Show PMS Options&quot;' => 'По умолчанию это _UE_MENU_PM_OPTIONS_DESC, что есть местный перевод фразы &quot;Show PMS Options&quot;',
'PMS User Deletion' => 'Удаление пользователей PMS',
'Choose how you want PMS messages to be handled when a user is removed' => 'Выберите как Вы желаете работать с личными сообщениями в PMS после удаления пользователя',
'Keep all messages' => 'Оставлять все сообщения',
'Remove all messages (received and sent)' => 'Удалять все сообщения (полученные и отправленные)',
'Remove received messages only' => 'Удалять только полученные сообщения',
'Remove sent message only' => 'Удалять только отправленные сообщения',
'PMS Deletion Function to use' => 'Функция удаления PMS к использованию',
'Choose which function to be called when user is deleted (PMS component specific cleanup functions must be stored in cb_extra.php file in component root).' => 'Выберите какая функция вызывается по удалению пользователя (конкретные функции чистки компонента PMS должны храниться в файле cb_extra.php, обитающем в корне компонента).',
'Use CB Plugin Function' => 'Использовать функцию плагина CB',
'Use PMS Component Function' => 'Использовать функцию компонента CB',
'see tab manager: MyPMSPro: parameters' => 'смотрите менеджер вкладок: MyPMSPro: Параметры',
'Quick Message Settings' => 'Настройки быстрого сообщения',
'Show Tab title' => 'Показать заголовок вкладки',
'Show the title of the tab inside this tab. The description is also shown, if present. &lt;strong&gt;IMPORTANT: The title is the tab title here.&lt;/strong&gt;' => 'Показать заголовок вкладки внутри этой вкладки. Если описание дано, оно также показывается. &lt;strong&gt;ВАЖНО: Заголовок это заголовок вкладки здесь.&lt;/strong&gt;',
'Show Subject Field' => 'Показывать поле названия темы',
'Show the subject field. If hidden, subject will be &quot;Message from your profile view&quot; = _UE_PM_PROFILEMSG' => 'Показывать поле названия темы. Если скрыто, заголовком будет &quot;Сообщение из Вашего просмотра профиля&quot; = _UE_PM_PROFILEMSG',
'Width (chars)' => 'Ширина (в знаках)',
'Height (lines)' => 'Высота (в строчках)',
'see plugin manager: MyPMSPro: parameters' => 'смотрите менеджер плагинов: MyPMSPro: Параметры',

// yanc.xml
'Provides integration between CB and Yanc.' => 'Обеспечивает интеграцию между CB и Yanc.',
'This tab only appears in User profile EDIT mode.' => 'Эта вкладка появляется только в режиме редакции профиля пользователя.',
'Important:' => 'Важно:',

// PHP files (without duplicates):

// Menus: file administrator/components/com_comprofiler/toolbar.comprofiler.html.php :
'New'		=>	'Новый',
'Publish'	=>	'Публиковать',
'Default'	=>	'По умолчанию',
'Assign'	=>	'Назначить',
'Unpublish'	=>	'Не публик.',
'Archive'	=>	'Архив',
'Unarchive'	=>	'Разархивировать',
'Edit'		=>	'Редакция',
'Edit HTML'	=>	'Редактировать HTML',
'Edit CSS'	=>	'Редактировать CSS',
'Delete'	=>	'Удалить',
'Trash'		=>	'В корзину',
'Preview'	=>	'Просмотреть',
'Help'		=>	'Помощь',
'Apply'		=>	'Применить',
'Save'		=>	'Сохранить',
'Cancel'	=>	'Отменить',
'Back'		=>	'Назад',
'Upload'	=>	'Загрузить',
'New Tab'	=>	'Новая',
'New Field'	=>	'Новое',
'New List'	=>	'Новый',
'Close'		=>	'Закрыть',
'Mass Mail'	=>	'Рассылка',
'Send Mails'	=>	'Отправить письма',
'Resend Confirmations'	=>	'Отправить подтверждения повторно',
'Please make a selection from the list to %s'	=>	'???Пожалуйста, выберите из списка в %s???',
'Please make a selection from the list to publish'	=>	'Пожалуйста, для публикации, выберите из списка',
'Please select an item to make default'	=>	'Выберите из списка объект для назначения его по умолчанию',
'Please select an item to assign'	=>	'Пожалуйста, выберите объект для назначения',
'Upload Image' => 'Загрузить изображение',
'Please make a selection from the list to unpublish'	=>	'Пожалуйста, выберите из списка объект для снятия его с публикации',
'Please make a selection from the list to archive'	=>	'Пожалуйста, выберите из списка объект для его архивирования',
'Please select a news story to unarchive'	=>	'Пожалуйста, выберите новость для извлечения ее из архива',
'Please select an item from the list to edit'	=>	'Пожалуйста, выберите объект из списка для редактирования',
'Please make a selection from the list to delete'	=>	'Пожалуйста, выберите из списка объект для удаления',
'Are you sure you want to delete the selected items ?'	=>	'Вы действительно желаете удалить выбранные объекты?',
'The tab will be deleted and this cannot be undone!'	=>	'Эта вкладка будет безвозвратно удалена!',
'The Field and all user data associated to this field will be lost and this cannot be undone!'	=>	'Это поле и все относящиеся к нему данные пользователя будут безвозвратно потеряны!',
'The selected List(s) will be deleted and this cannot be undone!'	=>	'Выбранный(ые) список(ки) будет(ут) безвозвратно удален(ы)!',
'Note: Permissions for Community Builder User Manager are set in the Community Builder User Management Options.'	=>	'Примечание: права на управления пользователями Community Builder настраиваются в параметрах Менеджера пользователей СВ.',
'Community Builder Permissions for Settings: Fields, Tabs, Lists and CB Plugins'	=>	'Разрешения на настройки Community Builder: поля, вкладки, списки и плагины СВ',
'These are the Joomla Users Manager Options: Some of these Preferences and all of the Permissions also apply to the Community Builder User Manager:'	=>	'Это - опции управления пользователями в системе Joomla. Некоторые из этих настроек и все разрешения также применимы к менеджеру пользователей СВ.',

// .../administrator/components/com_comprofiler/admin.comprofiler.controller.php (344 in CBTxt format) //

'Warning: file %s still exists. This is probably due to the fact that first installation step did not complete, or second installation step did not take place. If you are sure that first step has been performed, you need to execute second installation step before using CB. You can do this now by clicking here:' => 'Предупреждение: файл %s все еще существует. Это вероятнее всего ввиду того факта, что не завершен первый шаг установки, или не имел место второй шаг установки. Если вы уверены в том, что первый шаг установки был предпринят, прежде чем работать с СВ, Вам нужно осуществить второй шаг установки. Вы можете проделать это щелкнув здесь:',
'please click here to continue next and last installation step' => 'пожалуйста щелкните здесь чтобы перейти к следующему и последнему шагу установки',
'Successfully Saved List: %s' => 'Успешно сохраненный список: %s',
'User Groups' => 'Группы пользователей',
'Everybody' => 'Все',
'All Registered Users' => 'Все зарегистрированные пользователи',
'List parameters' => 'Параметры списка',
'Field-specific Parameters' => 'Параметры относящиеся к полю',
'Select an item to delete' => 'Выберите строчку для удаления',
'Parameters' => 'Параметры',
'To see Parameters, first save new field' => 'Чтобы увидеть параметры, сначала сохраните новое поле',
'Unauthorized Access' => 'Не разрешенный вход',
'Tab' => 'Вкладка',
'URL only' => 'Только UR',
'Hypertext and URL' => 'Гипертекст и URL',
'No' => 'Нет',
'Yes: on 1 Line' => 'Да: на 1 строке',
'Yes: on 2 Lines' => 'Да: на 2 строчках',
'Innexistant field' => 'Не существующее поле',
'Successfully Saved changes to Field' => 'Изменения в поле успешно сохранены',
'Successfully Saved Field' => 'Поле успешно сохранено',
'%s cannot be deleted because it is on a List.' => '%s не может быть удалено поскольку оно в списке.',
'%s cannot be deleted because it is a system field.' => '%s не может быть удалено поскольку это системное поле.',
'Successfully Deleted Fields' => 'Успешно удаленные поля',
'first' => 'первое',
'last' => 'последнее',
'Line' => 'Строчка',
'Column' => 'Колонка',
'Not displayed on profile' => 'Не показывается в профиле',
'This plugin cannot be reordered' => 'Порядок для этого плагина не может изменяться',
'New items default to the last place. Ordering can be changed after this item is saved.' => 'По умолчанию новые записи занимают последнее место. Порядок может быть изменен после сохранения записи.',
'Missing post values' => 'Значения сообщения отсутствуют',
'Successfully Saved Tab' => 'Вкладка успешно сохранена',
'%s cannot be deleted because it is a system tab.' => '%s не может быть удален поскольку это системная вкладка.',
'%s cannot be deleted because it is a tab belonging to an installed plugin.' => '%s не может быть удален поскольку это вкладка принадлежит установленному плагину.',
'%s is being referenced by an existing field and cannot be deleted!' => '%s находится в ссылке из существующего поля и не может быть удалено!',
'Blocked' => 'Заблокирован',
'Enabled' => 'Включен',
'Unconfirmed' => 'Не подтвержден',
'Confirmed' => 'Подтвержден',
'Unapproved' => 'Не одобрен',
'Disapproved' => 'Отклонен',
'Approved' => 'Одобрен',
'Banned' => 'Запрещен',
'Avatar not approved' => 'Аватар не одобрен',
'- Select Login State -' => '- Выбрать состояние входа на сайт -',
'Logged In' => 'Вошел',
'- Select Group -' => '- Выбрать группу -',
'- Select User Status -' => '- Выбрать статус пользователя -',
'email not send: simulation mode' => 'письмо не отправлено: испытательный режим',
'Error sending email!' => 'Ошибка при отправке письма!',
'Test email sent to %s' => 'Испытательное письмо отправлено %s',
'Waiting delay for next batch...' => 'Ожидаемая задержка для следующей партии...',
'Executing' => 'Обрабатывается',
'Done' => 'Сделано',
'Pause' => 'Пауза',
'Resume' => 'Возобновить',
'ERROR!' => 'ОШИБКА!',
'Not Authorized' => 'Не разрешено',
'Successfully Saved User: %s' => 'Успешно сохранен пользователь: %s',
'You cannot delete this Super Administrator as it is the only active Super Administrator for your site' => 'Вы не можете удалить этого Супер Администратора, поскольку он является единственным активным Супер Администратором Вашего сайта.',
'User not found' => 'Пользователь не найден',
'Select an item to %s' => 'Выберите запись для %s',
'unknown action %s' => 'неизвестное действие %s',
'Email' => 'Эл.почта',
'PMS' => 'PMS',
'PMS+Email' => 'PMS+Эл.почта',
'yyyy/mm/dd' => 'yyyy/mm/dd',
'dd/mm/yy' => 'dd/mm/yy',
'yy/mm/dd' => 'yy/mm/dd',
'dd/mm/yyyy' => 'dd/mm/yyyy',
'mm/dd/yy' => 'mm/dd/yy',
'mm/dd/yyyy' => 'mm/dd/yyyy',
'yyyy-mm-dd' => 'yyyy-mm-dd',
'dd-mm-yy' => 'dd-mm-yy',
'yy-mm-dd' => 'yy-mm-dd',
'dd-mm-yyyy' => 'dd-mm-yyyy',
'mm-dd-yy' => 'mm-dd-yy',
'mm-dd-yyyy' => 'mm-dd-yyyy',
'yyyy.mm.dd' => 'yyyy.mm.dd',
'dd.mm.yy' => 'dd.mm.yy',
'yy.mm.dd' => 'yy.mm.dd',
'dd.mm.yyyy' => 'dd.mm.yyyy',
'mm.dd.yy' => 'mm.dd.yy',
'mm.dd.yyyy' => 'mm.dd.yyyy',
'ImageMagick' => 'ImageMagick',
'NetPBM' => 'NetPBM',
'GD1 library' => 'Библиотека GD1',
'GD2 library' => 'Библиотека GD2',
'Display text markers' => 'Показывать текстовые маркеры',
'Display html and text markers' => 'Показывать html и текстовые маркеры',
'Display markers and list untranslated strings' => 'Показывать маркеры и список непереведенных строк',
'Display markers and list all strings' => 'Показывать маркеры и список всех строк',
'Use tables' => 'Используйте таблицы',
'Use divs (table-less output)' => 'Используйте divs (безтабличная выдача)',
'FATAL ERROR: Config File Not writeable' => 'СЕРЬЕЗНАЯ ОШИБКА: Не открыт на запись конфигурационный файл!',
'Configuration file saved' => 'Конфигурационный файл сохранен',
'Failed to change the permissions of the config file %s' => 'Не удалось изменить права на конфигурационный файл %s',
'Failed to create and write config file in %s' => 'Не удалось создать конфигурационный файл и вписать в %s',
'ERROR: Configuration file administrator/components/com_comprofiler/ue_config.php could not be written by webserver. Please change file permissions in your web-pannel.' => 'ОШИБКА: Сервер не может писать в конфигурационный файл administrator/components/com_comprofiler/ue_config.php. Пожалуйста измените права на файл в Вашей хостинговой панели.',
'Make Required' => 'Сделать обязательным',
'Make Non-required' => 'Сделать не обязательным',
'Publish' => 'Публиковать',
'UnPublish' => 'Не публиковать',
'Add to Registration' => 'Добавить к регистрации',
'Remove from Registration' => 'Удалить из регистрации',
'field searchable in users-lists' => 'поля, разрешенные к поиску в списках пользователей',
'field not searchable in users-lists' => 'поле не разрешенное к поиску в списках пользователей',
'Select an item to make %s' => 'Выбрать запись чтобы %s',
'Make Default' => 'Сделать по умолчанию',
'Reset Default' => 'Переключить на режим по умолчанию',
'Add to Profile' => 'Добавить к профилю',
'Remove from Profile' => 'Удалить из профиля',
'Tab Added Successfully!' => 'Вкладка добавлена успешно!',
'Schema Changes Added Successfully!' => 'Изменения схемы добавлено успешно!',
'Fields Added Successfully!' => 'Файлы добавлены успешно!',
'List Added Successfully!' => 'Список добавлен успешно!',
'SQL error %s' => 'Ошибка SQL: %s',
'Sample Data is already loaded!' => 'Демо данные уже загружены!',
'Deleted %s not allowed user id 0 entry.' => '???Удаление %s не разрешено нулевая запись пользователя???.',
'Added %s new entries to Community Builder from users Table.' => 'Из таблицы пользователей добавлено %s новых записей в Community Builder.',
'Fixed %s existing entries in Community Builder: fixed wrong user_id.' => 'Отлажено %s существующих записей в Community Builder: отлажен неправильный ID номер пользователя.',
'Removing %s entries from Community Builder missing in users Table.' => 'Удаляется %s записей из Community Builder, отсутствующих в таблице пользователей.',
'Joomla/Mambo User Table and Joomla/Mambo Community Builder User Table now in sync!' => 'Таблица пользователей Joomla/Mambo и таблица пользователей Joomla/Mambo Community Builder теперь синхронизированы!',
'CB Tools: Check database: Results' => 'Инструменты CB: Проверить базу данных: Результаты',
'Checking Community Builder Datbase' => 'Проверяется база данных Community Builder',
'ERROR: sql query: %s : returned error: %s' => 'ОШИБКА: запрос sql: %s : ответная ошибка: %s',
'Warning: %s entries in Community Builder comprofiler_field_values have bad fieldid values.' => 'Предупреждение: %s записи(ей) в таблице Community Builder comprofiler_field_values содержат ошибочные значения полей.',
'ZERO fieldvalueid illegal: fieldvalueid=%s fieldid=0' => 'НУЛЕВОЕ значение id поля незаконно: fieldvalueid=%s fieldid=0',
'This one can be fixed by <strong>first backing up database</strong>' => 'Это может быть отлажено посредством <strong>сначала сохранения резервной базы данных</strong>',
'then by clicking here' => 'затем щелчком здесь',
'All Community Builder comprofiler_field_values table fieldid rows all match existing fields.' => 'Вся поля fieldid таблицы comprofiler_field_values компонента Community Builder соответствуют существующим полям.',
'Warning: %s entries in Community Builder comprofiler_field_values link back to fields of wrong fieldtype.' => 'Предупреждение: %s записей в таблице СВ comprofiler_field_values ссылаются на поля с неправильным типом поля.',
'This one can be fixed in SQL using a tool like phpMyAdmin.' => 'Это может быть отлажено в SQL с использованием инструмента, подобного phpMyAdmin.',
'All Community Builder comprofiler_field_values table rows link to correct fieldtype fields in comprofiler_field table.' => 'Все табличные записи comprofiler_field_values в Community Builder ссылаются на поля с правильным типом поля.',
' - Field %s - Column %s is missing from comprofiler table.' => ' - Поле %s - Колонка %s отсутствуют в таблице comprofiler.',
' - Column %s is missing from comprofiler table.' => ' - Колонка %s отсутствует в таблице comprofiler.',
'There are %s column(s) missing in the comprofiler table, which are defined as fields (rows in comprofiler_fields):' => '%s колонка(ок) отсутствует(ют) в таблице comprofiler, которые определен как колонки (ряды в comprofiler_fields):',
'This one can be fixed by deleting and recreating the field(s) using components / Community Builder / Field Management.' => 'Это может быть отлажено удалением поля(ей) и его(их) созданием по новой с использованием компонента Community Builder: Менеджер полей.',
'Please additionally make sure that columns in comprofiler table <strong>are not also duplicated in users table</strong>.' => 'Пожалуйста дополнительно удостоверьтесь, чтобы колонки в таблице comprofiler <strong>не дублируются в таблице пользователей</strong>.',
'All Community Builder fields from comprofiler_fields are present as columns in the comprofiler table, but comprofiler_fields table is not yet upgraded to CB 1.2 table structure. Just going to Community Builder Fields Management will fix this automatically.' => 'Все поля из таблицы Community Builder comprofiler_fields присутствуют как колонки в таблице comprofiler, но таблица comprofiler_fields еще не обновлена до табличной структуры CB 1.2. Просто открытие Менеджера полей в Community Builder автоматически отладит это.',
'All Community Builder fields from comprofiler_fields are present as columns in the comprofiler table.' => 'Все поля из таблицы comprofiler_fields в Community Builder присутствуют как колонки в таблице.',
'Avatars and thumbnails folder: %s/%s is NOT writeable by the webserver.' => 'Папка аватров и миниатюр: %s/%s НЕ открыта на запись сервера.',
'Avatars and thumbnails folder is Writeable.' => 'Папка аватаров и миниатюр открыта на запись.',
'Core CB mandatory basics' => 'Обязательные основы ядра CB',
'Core CB' => 'Ядро CB',
'CB plugin' => 'Плагин CB',
'%s "%s": no database or no database description.' => '%s "%s": нет базы данных или нет описания базы данных.',
'CB plugins' => 'Плагины CB',
'Checking Users Datbase' => 'Проверяется база данных пользователей',
'Warning: %s entries in Community Builder comprofiler table without corresponding user table rows.' => 'Предупреждение: %s записей в таблице comprofiler в Community Builder не имеют соответствующих записей в таблице пользователя.',
'Following comprofiler id: %s are missing in user table' => 'Следующее id таблицы comprofiler: %s отсутствует в таблице пользователя',
'This comprofiler entry with id 0 should be removed, as it\'s not allowed.' => 'Эта запись в таблице comprofiler с id 0 должна быть удалена, поскольку это не допускается.',
'This one can be fixed using menu Components-&gt; Community Builder-&gt; tools and then click `Synchronize users`.' => 'Это может быть отлажено использованием меню Компоненты: Community Builder: Инструменты и затем щелчком по "Синхронизировать пользователей".',
'All Community Builder comprofiler table rows have links to user table.' => 'Все записи таблицы Community Builder comprofiler имеют ссылки на таблицу пользователя.',
'Warning: %s entries in users table without corresponding comprofiler table rows.' => 'Предупреждение: %s записей в таблице пользователей не имеют соответствующих записей в таблице comprofiler.',
'users id: %s are missing in comprofiler table' => 'пользовательские id: %s отсутствуют в таблице comprofiler',
'All users table rows have links to comprofiler table.' => 'Все записи таблицы пользователя были привязаны к таблице comprofiler.',
'Warning: %s entries in users table with id=0.' => 'Предупреждение: в таблице пользователей находятся %s записей с id=0.',
'users id=%s is not allowed.' => 'пользовательское id=%s не разрешено.',
'users table has no zero id row.' => 'таблица пользователей не содержит записей с id=0.',
'Warning: %s entries in comprofiler table with id=0.' => 'Предупреждение: таблица comprofiler содержит %s записей с id=0.',
'comprofiler id=%s is not allowed.' => 'id=%s в таблице comprofiler не разрешено.',
'This one can be fixed using menu Components / Community Builder / Tools and then click "Synchronize users".' => 'Это может быть отлажено используя меню Компоненты:Community Builder: Инструменты и затем щелчком по ссылке "Синхронизировать пользователей".',
'comprofiler table has no zero id row.' => 'таблица comprofiler не содержит записей с нулевым id.',
'Warning: %s entries in comprofiler table with user_id <> id.' => 'Предупреждение: таблица comprofiler содержит %s записей с user_id <> id.',
'comprofiler id=%s is different from user_id=%s.' => 'id=%s в таблице comprofiler отличается от user_id=%s.',
'All rows in comprofiler table have user_id columns identical to id columns.' => 'Все записи в таблице comprofiler содержат колонки user_id идентичные колонкам id.',
'Warning: %s entries in the users table without corresponding core_acl_aro table rows.' => 'Предупреждение: в таблице пользователей содержится %s записей, которые не имеют соответствующих рядов в таблице core_acl_aro.',
'Warning: %s entries in the users table without corresponding user_usergroup_map table rows.' => 'Предупреждение: число записей в таблице пользователей без соответствующих рядов в таблице user_usergroup_map - %s.',
'user id: %s are missing in core_acl_aro table' => 'пользовательское id: %s отсутствует в таблице core_acl_aro',
'user id: %s are missing in user_usergroup_map table' => 'пользовательское id: %s отсутствует в таблице user_usergroup_map',
'This user entry with id 0 should be removed, as it\'s not allowed.' => 'Эта пользовательская запись с id 0 должна быть удалена, поскольку это не допускается.',
'All users table rows have ACL entries in core_acl_aro table.' => 'Все ряды таблицы пользователей обладают ACL записями в таблице core_acl_aro.',
'All users table rows have ACL entries in user_usergroup_map table.' => 'Все ряды таблицы пользователей имеют ACL записи в таблице user_usergroup_map.',
'Warning: %s entries in the core_acl_aro table without corresponding users table rows.' => 'Предупреждение:  в таблице core_acl_aro находятся %s записей, которые не имеют соответствующих рядов в таблице пользователей.',
'Following entries of [tablename1] table are missing in [tablename2] table: [badids].' => 'Нижеследующие записи таблицы [tablename1] отсутствуют в таблице [tablename2]: [badids].',
'This core_acl_aro entry with (user) value 0 should be removed, as it\'s not allowed.' => 'Эта запись таблицы core_acl_aro с нулевым значением пользователя должна быть удалена, поскольку это не допускается.',
'This core_acl_aro entry with aro_id 0 should be removed, as it\'s not allowed.' => 'Эта запись таблицы core_acl_aro с aro_id 0 должна быть удалена, т.к. это не допускается.',
'All [tablename1] table rows have corresponding entries in [tablename2] table.' => 'Все ряды таблицы [tablename1] имеют соответствующие записи в таблице [tablename2].',
'Warning: %s entries in the core_acl_aro table without corresponding core_acl_groups_aro_map table rows.' => 'Предупреждение: таблица core_acl_aro содержит %s записей, которые не имеют соответствующих записей в таблице core_acl_aro.',
'Following entries of core_acl_aro table are missing in core_acl_groups_aro_map table: %s.' => 'Следующие записи из таблицы core_acl_aro отсутствуют в таблице core_acl_groups_aro_map: %s.',
'All core_acl_aro table rows have ACL entries in core_acl_groups_aro_map table.' => 'Все записи таблицы core_acl_aro table имеют записи ACL в таблице core_acl_groups_aro_map.',
'Warning: %s entries in the core_acl_groups_aro_map without corresponding core_acl_aro table table rows.' => 'Предупреждение: %s записей в таблице core_acl_groups_aro_map не имеют соответствующих записей в таблице core_acl_aro.',
'aro_id = %s are missing in core_acl_aro table table.' => 'aro_id = %s отсутствует в таблице core_acl_aro.',
'This entry with aro_id 0 should be removed, as it\'s not allowed.' => 'Эта запись с aro_id должна быть удалена, поскольку это не допустимо.',
'by clicking here' => 'щелкнув здесь',
'Users' => 'Пользователи',
'CB fields data storage' => 'Хранение данных полей CB',
'CB Tools: Check %s database: Results' => 'Инструменты: Проверить базу данных %s : Результаты',
'Added %s new entries to core_acl_aro table from users Table.' => 'Добавлено %s новых записей в таблицу core_acl_aro из таблицы пользователей.',
'Deleted %s core_acl_aro entries which didn\'t correspond to users table.' => 'Удалено %s записей из таблицы core_acl_aro, которые не соответствуют записям таблицы пользователей.',
'Added %s new entries to core_acl_groups_aro_map table from core_acl_aro Table.' => 'Добавлено %s новых записей в таблицу core_acl_groups_aro_map из таблицы core_acl_aro.',
'Deleted %s core_acl_groups_aro_map entries which didn\'t correspond to core_acl_aro table.' => 'Удалено %s записей таблицы core_acl_groups_aro_map, которые не соответствуют таблице core_acl_aro.',
'Joomla/Mambo User Table and Joomla/Mambo ACL Table should now be in sync!' => 'Таблица пользователей Joomla/Mambo и таблица Joomla/Mambo ACL теперь должны быть синхронизированы!',
'CB Tools: Fix %s database: ' => 'Инструменты: отладить базу данных %s: ',
'Dry-run:' => 'Черновая проверка:',
'Fixed:' => 'Отлажено:',
'Results' => 'Результаты:',
'Deleted %s comprofiler_field_values entries which didn\'t match any field.' => 'Удалено %s записей таблицы comprofiler_field_values которые не соответствуют ни одному полю.',
'saveOrder:%s' => 'saveOrder:%s',
'New ordering saved' => 'Новый порядок сохранен',
'Select Type' => 'Выбрать тип',
'Successfully Saved changes to Plugin: %s' => 'Изменения в плагине %s успешно сохранены',
'Successfully Saved Plugin: %s' => 'Успешно сохранен плагин: %s',
'The plugin %s is currently being edited by another administrator' => 'Плагин %s в настоящее время редактируется другим администратором',
'Administrator' => 'Администратор',
'Plugin id not found.' => 'id плагина не найдено.',
'No plugin XML found.' => 'XML файл плагина не найден.',
'No admin handler defined in XML' => 'В файле XML не определен администратор обработки',
'Admin handler class %s does not exist.' => 'Административный класс обработки %s не существует.',
'No plugin selected' => 'Не выбран плагин',
'The plugin %s has no administrator file %s' => 'Плагин %s не имеет административного файла %s',
'Select a plugin to delete' => 'Выберите плагин для удаления',
'Uninstall Plugin' => 'Удалить плагин',
'Get Plugins' => 'Получить плагины',
'Success' => 'Успех',
'Failed' => 'Провал',
'publish' => 'публиковать',
'unpublish' => 'не публиковать',
'Select a plugin to %s' => 'Выберите плагин для %s',
'Language plugins cannot be unpublished, only uninstalled' => 'Языковые плагины нельзя закрыть к публикации, их можно только удалить из установки.',
'Core plugin cannot be unpublished' => 'Плагины ядра системы нельзя закрыть к публикации',
'Plugin can not be found' => 'Плагин не найден',
'The installer cannot continue before file uploads are enabled. Please use the install from directory method.' => 'Установщик не может продолжать, пока не включена загрузка файлов. Пожалуйста, используйте метод установки из директории.',
'Installer - Error' => 'Установщик - Ошибка',
'The installer cannot continue before zlib is installed' => 'Установщик не сможет продолжать до тех пор, пока не будет установлена библиотека zlib.',
'No file selected' => 'Не выбран файл',
'Upload new plugin - error' => 'Загрузить новый плагин - Ошибка',
'Upload %s - Upload Failed' => 'Загрузка %s - Загрузка провалилась',
'Upload %s - ' => 'Загрузить %s - ',
'Upload %s - Upload Error' => 'Загрузить %s - Ошибка загрузки',
'Failed to move uploaded file to %s directory.' => 'Не удалось переместить загруженный файл в папку %s.',
'Upload failed as %s directory is not writable.' => 'Загрузка провалилась поскольку папка %s не открыта на запись.',
'Upload failed as %s directory does not exist.' => 'Загрузка провалилась поскольку папка %s не существует.',
'Install new plugin from directory - error' => 'Установить новый плагин из папки - Ошибка',
'Install new plugin from directory %s' => 'Установить новый плагин из папки %s',
'No URL selected' => 'Не выбран URL',
'Download %s - Upload Failed' => 'Скачать %s - Загрузка провалилась',
'Download %s' => 'Скачать %s',
'Download %s - Download Error' => 'Скачать %s - Ошибка при скачивании',
'Failed to change the permissions of the uploaded file %s' => 'Не удалось изменить права на загружаемый файл %s',
'Failed to create and write uploaded file in %s' => 'Не удалось создать и записать загруженный файл в %s',
'Failed to download package file from <code>%s</code> to webserver due to following error: %s' => 'Не удалось скачать файл пакета с <code>%s</code> на сервер  ввиду следующей ошибки: %s',
'Failed to download package file from <code>%s</code> to webserver due to following status: %s' => 'Не удалось скачать файл пакета с <code>%s</code> на сервер ввиду следующего статуса: %s',
'Connection to update server failed' => 'Соединение с сервером обновления не удалось',
'ERROR' => 'ОШИБКА',
'Timeout' => 'Истечение отведенного времени',
'no field' => 'нет поля',
'Uncompressing %s failed.' => 'Распаковка %s не удалась.',
'Failed to create directory "%s"' => 'Создание директории "%s" не удалось',
'Copying plugin files failed with error: %s' => 'Файлы плагина копирайта выдали ошибку: %s',
'Deleting expanded tgz file directory failed with an error.' => 'Удаление расширенной директории файлов tgz не удалось ввиду ошибки.',
'Deleting file %s failed with an error.' => 'Удаление файла %s не получилось ввиду ошибки.',
'Second and last installation step of Community Builder Component (comprofiler) done successfully.' => 'Второй и последний шаг установки компонента Community Builder (comprofiler) успешно осуществлен.',
'Installation finished. Important: Please read README.TXT and installation manual for further settings.' => 'Установка завершена. Важно: Пожалуйста прочитайте файл README.TXT и руководство по установке для дальнейшей настройки.',
'We also have a PDF installation guide as well as a complete documentation available on' => 'У нас имеется как руководство по установке в формате PDF как и полная документация, доступная на',
'Operation not allowed by the Permissions of your group(s).' => 'Эта операция не разрешена ввиду настройки разрешений Вашей группы/Ваших групп.Operation not allowed by the Permissions of your group(s).',

// .../administrator/components/com_comprofiler/admin.comprofiler.html.php (357 in CBTxt format) //
'In order for CB to function properly a Joomla/Mambo menu item must be present. This menu item must also be published for PUBLIC access. It appears that this environment is missing this mandatory menu item. Please refer to the section titled "Adding the CB Profile" of the PDF installation guide included in your CB distribution package for additional information regarding this matter.'	=>	'Для правильного функционирования CB обязательно должно быть создан пункт меню Joomla/Mambo, открытый для общего доступа. Похоже, что данный обязательный пункт меню отсутствует в данной среде. Для дальнейших инструкций пожалуйста обратитесь к разделу озаглавленному "Создание профиля CB" в PDF-руководстве по установке, включенном в Ваш установочный пакет CB.',
'PHP Version %s is not compatible with %s: Please upgrade to PHP %s or greater.'	=>	'Версия PHP %s несовместима с %s: Пожалуйста обновитесь до версии PHP %s или выше.',
'at least version %s, recommended version %s'	=>	'как минимум версия %s, рекомендуемая версия %s',
'CB List Manager' => 'Менеджер списков CB',
'Search' => 'Поиск',
'#' => '#',
'Title' => 'Название',
'Description' => 'Описание',
'Published' => 'Опубликовано',
'Access' => 'Доступ',
'Re-Order' => 'Изменить порядок',
'Save Order' => 'Сохранить порядок',
'listid' => 'ID',
'Move Up' => 'Наверх',
'Move Down' => 'Вниз',
'Community Builder List' => 'Список Community Builder',
'List is not published' => 'Список не опубликован',
'Sort Randomly' => 'Упорядочить произвольно',
'Non-existing field' => 'Несуществующее поле',
'Following fields are in list but not visible in here for following reason(s)' => 'Следующие поля находятся в списке но здесь не видимы по следующей(им) причине(ам):',
'Field "%s (%s)" is not published !' => 'Поле "%s (%s)" не опубликовано!',
'Field "%s (%s)" is not displayed on profile !' => 'Поле "%s (%s)" не показывается в профиле!',
'Field "%s (%s)" is from plugin "%s" but this plugin is not published !' => 'Поле "%s (%s)" принадлежит плагину "%s", но этот плагин не опубликован!',
'If you save this users list now, the fields listed above will be removed from this users list. If you want to keep these fields in this list, cancel now and go to Components / Community Builder / Field Manager.' => 'Если Вы сейчас сохраните этот список пользователей, поля, перечисленные выше, будут из него удалены. Если Вы хотите сохранить эти поля в этом списке, отмените операцию сейчас и зайдите в Компоненты: Community Builder: Менеджер полей.',
'Commas are not allowed in size values' => 'В значениях размеров запятые не разрешены',
'You must define a condition text!' => 'Вы должны определить текст условия!',
'URL for menu link to this list' => 'URL пункта меню ссылки на этот список',
'You need to save this new list first to see the direct menu link url.' => 'Чтобы увидеть URL непосредственной ссылки меню, Вы должны сначала сохранить этот новый список.',
'URL for search link to this list' => 'URL ссылки поиска к этому списку',
'Only fields appearing in list columns and on profiles and which are have the searchable attribute ON will appear in search criterias of the list.' => 'Только поля, появляющиеся в колонках списка и в профилях и у которых параметра поиска включен на Да, появятся в критериях поиска списка.',
'Title appears in frontend on top of the list.' => 'Заголовок появляется на передних страницах вверху списка.',
'Description appears in frontend under the title of the list.' => 'Описание появляется на передних страницах под заголовком списка.',
'User Group to allow access to' => 'Группа пользователей, к которой разрешается доступ',
'All groups above that level will also have access to the list.' => 'Все группы выше этого уровня также будут обладать доступом к списку.',
'All groups above that level will also have access to this tab.' => 'Все группы выше этого уровня также будут обладать доступом к этой вкладке.',
'User Groups to Include in List' => 'Группы пользователей для включения в список',
'Multiple choices' => 'Многократные выбор',
'CTRL/CMD-click to add/remove single choices.' => 'Воспользуйтесь комбинацей кнопок CTRL/CMD-щелчок, чтобы добавить/удалить объекты, выбранные по одному.',
'WARNING' => 'ПРЕДУПРЕЖДЕНИЕ',
'The default list should be the one with the lowest user groups access rights !' => '  Списком по умолчанию должен быть список с самым низким уровнем доступа!',
'Sort By' => 'Упорядочить по',
'ASC' => 'ВОСХ',
'DESC' => 'НИЗХ',
'Add' => 'Добавить',
'+' => '+',
'-' => '-',
'Remove' => 'Удалить',
'Filter' => 'Фильтр',
'Simple' => 'Простой',
'Advanced' => 'Усложненный',
'Greater Than' => 'Более чем',
'Greater Than or Equal To' => 'Более чем или равен с',
'Less Than' => 'Меньше чем',
'Less Than or Equal To' => 'Меньше чем или равен с',
'Equal To' => 'Равен с',
'Not Equal To' => 'Не равен',
'Is Empty' => 'Пустая',
'Is Not Empty' => 'Не пустая',
'Is NULL' => 'Имеет значение NULL',
'Is Not NULL' => 'Не имеет значение NULL',
'Like' => 'Как',
'Filter By' => 'Фильтрация по',
'<strong>Note:</strong> fields must be on profile to appear in this list and be visible on the users-list.' => '<strong>Заметка:</strong> чтобы появиться в этом списке и быть видимым в списке пользователей, поля должны быть в профиле.',
'Enable Column 1' => 'Включить колонку 1',
'Column 1 Title' => 'Заголовок колонки 1',
'Column 1 Captions' => 'Подпись колонки 1',
'Field List' => 'Список поля',
'<- Add' => '<- Добавить',
'Add ->' => 'Добавить ->',
'Enable Column 2' => 'Включить колонку 2',
'Column 2 Title' => 'Заголовок колонки 2',
'Column 2 Captions' => 'Подпись колонки 2',
'Enable Column 3' => 'Включить колонку 3',
'Column 3 Title' => 'Заголовок колонки 3',
'Column 3 Captions' => 'Подпись колонки 3',
'Enable Column 4' => 'Включить колонку 4',
'Column 4 Title' => 'Заголовок колонки 4',
'Column 4 Captions' => 'Подпись колонки 4',
'CB Field Manager' => 'Менеджер полей CB',
'Name' => 'Имя',
'Type' => 'Тип',
'Required' => 'Обязательное',
'Profile' => 'Профиль',
'Registration' => 'Регистрация',
'Searchable' => 'Исследуемо',
'(1 Line)' => '(1 строчка)',
'(2 Lines)' => '(2 строчки)',
'field will not be visible as field plugin "%s" is not published.' => 'поле не будет видимо, поскольку плагин "%s" не опубликован.',
'field will not be visible as connections are not enabled in CB configuration.' => 'поле не будет видимо, поскольку в конфигурации СВ не включены связи.',
'field will not be visible as tab is not enabled.' => 'поле не будет видимо, поскольку не включена вкладка.',
'field will not be visible as tab\'s plugin "%s" is not published.' => 'поле не будет видимо, поскольку плагин "%s" вкладки не опубликован.',
'System-fields cannot be published/unpublished here.' => 'Системные поля не могут быть опубликованы/закрыты к публикации здесь.',
'Name-fields publishing depends on your setting in global CB config.' => 'Публикация имен полей зависит от общей настройки в конфигурации CB.',
'Community Builder Field' => 'Поле Community Builder',
'Field is not published' => 'Поле не опубликовано',
'Plugin is not installed' => 'Плагин не установлен',
'Plugin is not published' => 'Плагин не опубликован',
'Warning: SQL name of field has been changed to fit SQL constraints' => 'Предупреждение: SQL имени поля был изменен для соответствия ограничениям SQL.',
'Description/"i" field-tip: text or HTML' => 'Описание/"i" поле-подсказка: текст или HTML',
'Pre-filled default value at registration only' => 'Предварительно заполненное значение по умолчанию только при регистрации',
'Default value' => 'Значение по умолчанию',
'Show on Profile' => 'Показывать в профиле',
'Display field title in Profile' => 'Показывать заголовок поля в профиле',
'Searchable in users-lists' => 'Исследуем в списке пользователей',
'User Read Only' => 'Только для чтения пользователем',
'Show at Registration' => 'Показывать при регистрации',
'Size' => 'Размер',
'Max Length' => 'Максимальная длинна',
'Cols' => 'Колонки',
'Rows' => 'Ряды',
'Use the table below to add new values.' => 'Использовать таблицу ниже для добавления новых значений.',
'Add a Value' => 'Добавить значение',
'Value' => 'Значение',
'CB Tab Manager' => 'Менеджер вкладок CB',
'Display' => 'Показывать',
'Plugin' => 'Плагин',
'Position' => 'Позиция',
'Tabid' => 'ID',
'tab will not be visible as plugin is not published.' => 'вкладка не будет видима поскольку плагин не опубликован.',
'Community Builder Tab' => 'Вкладка Community Builder',
'Tab is not published' => 'Вкладка не опубликована',
'You must provide a title.' => 'Вы должны предоставить заголовок.',
'Tab Details' => 'Подробности вкладки',
'Title as will appear on tab.' => 'Заголовок, каким он появится на вкладке.',
'Description: This description appears only on user edit, not on profile (For profile text, use delimiter fields)' => 'Описание: Это описание появляется только при редактировании пользователя, не в профиле (для текста профиля используйте разделительные поля)',
'Publish' => 'Публиковать',
'Profile ordering' => 'Порядок профиля',
'Tabs and fields on profile are ordered as follows:' => 'Вкладки и поля в профиле упорядочены следующим образом:',
'position of tab on user profile (top-down, left-right)' => 'позиция вкладки в профиле пользователя (сверху-вниз, слева-направо)',
'This ordering of tab on position of user profile' => 'Этот порядок вкладки в позиции профиля пользователя',
'ordering of field within tab position of user profile.' => 'порядок поля в позиции вкладки профиля пользователя.',
'Registration ordering' => 'Порядок регистрации',
'(default value: 10)' => '(значение по умолчанию: 10)',
'Tabs and fields on registration are ordered as follows:' => 'Вкладки и поля для регистрации упорядочены следующим образом:',
'This registration ordering of tab' => 'Это регистрационный порядок вкладки',
'ordering of tab on position of user profile' => 'порядок вкладки на позиции профиля пользователя',
'Position on profile and ordering on registration.' => 'Позиция в профиле и порядок на регистрации.',
'Display type' => 'Показывать тип',
'In which way the content of this tab will be displayed on the profile.' => 'Каким образом содержимое этой вкладки будет показано в профиле.',
'No Parameters' => 'Нет параметров',
'Advanced Search' => 'Усложненный поиск',
'CB Email Users' => 'Пользователи почты CB',
'Send Email to %s users' => 'Отправить письмо %s пользователям',
'and %s more users.' => 'и  %s больше пользователей.',
'Simulation mode' => 'Испытательный режим',
'Do not send emails, just show me how it works' => 'Не отправлять письма, только показать мне как это работает.',
'Email Subject' => 'Тема письма',
'Send me a test email' => 'Отправить мне тестовое письмо',
'Email Message' => 'Сообщение эл.почты',
'CB substitutions for subject and message' => 'Замены от CB для темы и сообщения',
'You can use all CB substitutions as in most parts: e.g.: [cb:if team="winners"] Congratulations [cb:userfield field="name" /], you are in the winning team! [/cb:if]' => 'Вы можете использовать все замены CB как в большинстве частей: например: [cb:if team="winners"] Поздравления [cb:userfield field="name" /], Вы в команде победителей! [/cb:if]',
'Emails per batch' => 'Эл.писем в одной партии',
'Seconds of pause between batches' => 'Секунды паузы между партиями',
'CB Sending emails to users...please wait and do not interrupt!' => 'CB отсылает письма пользователям...пожалуйста ожидайте и не прерывайте!',
'Sending a batch of maximum %s emails...' => 'Отправляется партия с максимумом в %s письма/писем...',
'Sending now %s emails...' => 'Сейчас отправляются %s письма/писем...',
'Sent your email.' => 'Ваше письмо отправлено.',
'Sent all %s emails.' => 'Отправлены все %s письма/писем.',
'CB Sending emails to users' => 'CB отправляет письма пользователям',
'Sending Email to %s users' => 'Отправляется почта %s пользователям',
'Initiating...' => 'Инициализация...',
'Sent email to %s of %s users' => 'Отправлена почта %s из %s пользователей',
'Just sent %s emails to following users:' => 'Только что отправлено %s письма/писем следующим пользователям:',
'Could not send email to %s of %s users out of %s emails to send' => 'Не удалось отправить электронное письмо %s из %s пользователей при отправке %s электронных писем',
'Just sent %s emails to following users:' => 'Только что отправлены %s электронных писем/электронных письма следующим пользователям:',
'Still %s emails remaining to send.' => 'Число оставшихся к отправке электронных писем: %s.',
'%s emails could not be sent due to a sending error.' => 'Ввиду ошибки при отправке, не удалось отправить следующее число электронных писем: %s.',
'Your email has been sent.' => 'Ваше электронное письмо было успешно отправлено.',
'All %s emails have been sent.' => 'All %s emails have been sent.',
'Email Sent' => 'Электронное писмо отправлено',
'Click here to go back to users management' => 'Щелкните здесь, чтобы вернуться к управлению пользователями',
'CB User Manager' => 'Управление пользователями CB',
'UserName' => 'Имя пользователя',
'Group' => 'Группа',
'E-Mail' => 'Адрес эл.почты',
'Registered' => 'Зарегистрировался',
'Last Visit' => 'Последний визит на сайт',
'ID' => 'ID',
'Pending Approval' => 'Ожидает одобрения',
'Rejected' => 'Отказано',
'confirmed' => 'Подтвержден',
'unconfirmed' => 'Не подтвержден',
'Community Builder User' => 'Пользователь Community Builder',
'You must assign user to a group.' => 'Вы должны предписать пользователю какую-либо группу.',
'Use new div or old table based views' => 'Используйте новые контуры, основанные на тегах div или старые, основанные на table',
'Choose table for compatibility with old templates and div for table-less output.' => 'Используйте таблицы для совместимости с устаревшими шаблонами и теги div - для безтабличного кода.',
'WARNING: different from the CMS setting !' => 'ПРЕДУПРЕЖДЕНИЕ: отличается от настроек CMS!',
'This may be ok, but this warning is just to make you aware of the difference.' => 'Возможно, все в порядке, но это предупреждение, - просто дать Вам знать о различии.',
'Translations highlighting' => 'Выделение переводов',
'Here you can highlight and debug your translations in various ways.' => 'Здесь Вы можете выделить и по-разному отладить Ваш перевод.',
'CB Tools Manager' => 'Менеджер инструментов CB',
'Load Sample Data' => 'Загрузить демо данные',
'This will load sample data into the Joomla/Mambo Community Builder component. Precisely, an additional information tab (that you can change, unpublish or delete in CB Tabs manager) will be created containing fields for: location, occupation, interests, company, address, city, state, zipcode, country, phone and fax (you can then change, unpublish or delete those fields which you don\'t need in CB Fields Manager). Also a users-list will be created, that you can edit from the CB Lists manager. This will help you get started quicker with CB.' => 'Щелчок по этой ссылке загружает демо данные в компонент Joomla/Mambo Community Builder. Точнее, дополнительная информационная вкладка (которую Вы можете изменять, закрывать для публикации или удалять в менеджере вкладок CB) будет создана с полями для: местность, профессия, интересы, компания, адрес, город, область, индекс, страна, телефон и факс (Вы затем можете редактировать название полей, закрывать их публикацию или удалять в менеджере полей ненужные Вам поля). Также, будет создан список пользователей, который Вы сможете редактировать в менеджере списков пользователей CB. Это поможет Вам быстрее начать работать в CB.',
'Synchronize Users' => 'Синхронизировать пользователей',
'This will synchronize the Joomla/Mambo User table with the Joomla/Mambo Community Builder User Table.' => 'Щелчок по этой ссылке синхронизирует таблицу пользователей Joomla/Mambo с таблицей пользователей компонента Community Builder.',
'Please make sure before synchronizing that the user name type (first/lastname mode choice) is set correctly in Components / Community Builder / Configuration / General, so that the user-synchronization imports the names in the appropriate format.' => 'Чтобы синхронизация импортировала имена в надлежащем формате, пожалуйста, перед синхронизацией удостоверьтесь в том, что стиль имени пользователя (выбор типа имя/фамилия) правильно настроен в Компоненты -> Community Builder -> Configuration -> Общая.',
'Check Community Builder Database' => 'Проверить базу данных Community Builder',
'This will perform a series of tests on the Community Builder database and report back potential inconsistencies without changing or correcting the database.' => 'Щелчок по этой ссылке проведет серию проверок базы данных компонента Community Builder и вернет доклад с потенциальными нарушениями без изменений и исправлений базы данных.',
'Check Community Builder User Fields Database' => 'Проверить поля пользователей базы данных Community Builder ',
'This will perform a series of tests on the Community Builder User fields database and report back potential inconsistencies without changing or correcting the database.' => 'Щелчок по этой ссылке проведет серию тестов полей таблицы пользователей Community Builder и вернет доклад с потенциальными нарушениями без изменений и исправлений базы данных.',
'Check CB plugins database' => 'Проверить плагины базы данных CB',
'This will check the database of installed CB plugins and report back potential inconsistencies without changing or correcting the database.' => 'Щелчок по этой ссылке проверит в базе данных установленные плагины и вернет доклад с потенциальными нарушениями без изменений и исправлений базы данных.',
'Check Users Database' => 'Проверить базу данных пользователей',
'This will perform a series of tests on the Users database of the CMS, the Community Builder users database and ACL and report back potential inconsistencies without changing or correcting the database.' => 'Щелчок по этой ссылке проведет серию проверок базы данных пользователей CMS, базы данных пользователей компонента Community Builder и ACL, и вернет доклад с потенциальными нарушениями без изменений и исправлений базы данных.',
'Database adjustments dryrun is successful, see results below' => 'Черновая проверка подстройки базы данных выполнена успешна. Смотрите результаты ниже',
'Database adjustments have been performed successfully.' => 'Подстройка базы данных была успешно завершена.',
'All' => 'Все',
'Database is up to date.' => 'База данных соответствует наипоследней версии.',
'Database adjustments errors:' => 'Ошибка подстройки базы данных:',
'Database structure differences:' => 'Различия в структуре базы данных:',
'The %s database structure differences can be fixed (adjusted) by clicking here' => 'Нарушения структуры базы данных %s могут быть отлажены (подстроены) щелчком здесь',
'Click here to Fix (adjust) all %s database differences listed above' => 'Щелкните здесь для отладки (подстройки) всех нарушений базы данных %s перечисленных выше',
'(you can also <a href="#">Click here to preview fixing (adjusting) queries in a dry-run</a>), but <strong>in all cases you need to backup database first</strong> as this adjustment is changing the database structure to match the needed structure for the installed version.' => '(Вы также можете <a href="#">Щелкнуть здесь для предварительного просмотра запросов отладки (подстройки) в черновом режиме</a>), но <strong>во всех случаях Вам прежде всего необходимо будет сделать запасную копию Вашей базы данных</strong> поскольку эта подстройка вносит изменения в структуру базы для соответствия необходимой структуре установленной версии.',
'Click here to Show details' => 'Щелкните здесь чтобы показать подробности',
'Click here to Hide details' => 'Щелкните здесь чтобы скрыть подробности',
'Dry-run of %s database adjustments done. None of the queries listed in details have been performed.' => 'Черновая подстройка базы данных %s завершена. Ни один из запросов, перечисленных в подробностях, не был осуществлен.',
'The database adjustments listed above can be applied by clicking here' => 'Подстройки базы данных, перечисленные выше, могут быть осуществлены щелчком здесь',
'Click here to Fix (adjust) all database differences listed above.' => 'Щелкните здесь чтобы отладить (подстроить) все нарушения базы данных, перечисленные выше.',
'<strong>You need to backup database first</strong> as this fixing/adjusting is changing the database structure to match the needed structure for the installed version.' => '<strong>Сначала Вам необходимо создать запасную копию базы данных </strong> поскольку эта отладка/подстройка изменяет ее структуру для соответствия установленной версии.',
'The %s database adjustments have been done. If all lines above are in green, database adjustments completed successfully. Otherwise, if some lines are red, please report exact errors and queries to authors forum, and try checking database again.' => 'Подстройки базы данных %s были осуществлены. Если все строчки выше имеют зеленый цвет, подстройки базы завершились успешно. В противном случае, если некоторые строчки красные, пожалуйста доложите точные ошибки и запросы на форум автора и попробуйте еще раз провести проверку.',
'The database structure can be checked again by clicking here' => 'Структура базы данных может быть снова проверена щелчком здесь',
'Click here to Check %s database' => 'Щелкните здесь для проверки базы данных %s',
'database checks done. If all lines above are in green, test completed successfully. Otherwise, please take corrective measures proposed in red.' => 'проверка базы данных завершена. Если все строчки, перечисленные выше, имеют зеленый цвет, то проверка завершена успешно. В противном случае, пожалуйста последуйте рекомендациям по отладке, указанным красным цветом.',
'CB Plugin Manager' => 'Менеджер плагинов CB',
'Install Plugin' => 'Установить плагин',
'Please select a directory' => 'Пожалуйста выберите папку',
'Plugin Name' => 'Название плагина',
'Installed' => 'Установлено',
'Reorder' => 'Изменить порядок',
'Order' => 'Порядок',
'Directory' => 'Папка',
'Plugin Files missing' => 'Не хватает файлов плагина',
'Unpublished' => 'Закрыт(ые) к публикации',
'Unpublish Item' => 'Закрыть к публикации',
'Publish item' => 'Публиковать',
'language plugins cannot be unpublished, only uninstalled' => 'плагин языка не может быть закрыт к публикации, он может быть только удален',
'CB core plugin cannot be unpublished' => 'Плагин системы CB не может быть закрыт к публикации',
'Click here to see more CB Plugins (Languages, Fields, Tabs, Signup-Connect, Paid Memberships and over 30 more) by CB Team at joomlapolis.com' => 'Щелкните здесь, чтобы просмотреть еще больше плагинов СВ (языков, полей, вкладок, связей, регистрации, платного членства и еще более чем 30 других) от команды CB на joomlapolis.com',
'Click here to see CB Directory listing hundreds of CB extensions at joomlapolis.com' => 'Щелкните здесь, чтобы просмотреть сотни расширений в каталоге CB Directory на jomlapolis.com',
'Click here to Check our CB listing on JED and find more third-party free add-ons for your website' => 'Щелкните здесь для просмотра нашего списка на официальном каталоге расширений JED и найдите еще больше бесплатных сторонних расширений для своего вебсайта',
'Install New Plugin' => 'Установить новый плагин',
'Upload Package File' => 'Загрузить файл пакета',
'Maximum upload size: <strong>[filesize]</strong> <em>(upload_max_filesize setting in file [php.ini] )</em>' => 'Максимальный размера файла к загрузке: <strong>[filesize]</strong> <em>(параметр upload_max_filesize в файле [php.ini] )</em>',
'Package File:' => 'Файл пакета:',
'Upload File & Install' => 'Загрузить файл и установить',
'Install from directory' => 'Установить из папки',
'Install directory' => 'Папка установки',
'Install' => 'Установить',
'Install package from web (http/https)' => 'Установить пакет через интернет (http/https)',
'Installation package URL' => 'URL ссылка пакета установки',
'Download Package & Install' => 'Загрузить и установить пакет',
'Community Builder Plugin' => 'Плагин Community Builder',
'Plugin Common Settings' => 'Плагин Common Settings',
'Plugin Order' => 'Плагин Order',
'Access Level' => 'Уровень доступа',
'Folder / File' => 'Папка/Файл',
'Specific Plugin Settings' => 'Конкретные настройки плагина',
'Plugin not installed' => 'Плагин не установлен',
'Continue ...' => 'Продолжить ...',
'Writeable' => 'Открыт для записи',
'Unwriteable' => 'Не открыт для записи',
'Update check' => 'Проверка обновления',
'Checking for updates...' => 'Проверяется обновление...',
'check now' => 'проверить сейчас',
'Checking latest version now...' => 'Сейчас проверяется наличие наипоследней версии...',
'There was a problem with the request.' => 'С этим запросом проблема.',
'View Access Level' => 'Уровень доступа к просмотру',
'User Group to allow access to' => 'Группа пользователей, к которой необходимо разрешить доступ',
'Old deprecated method of Joomla 1.5, do not use here' => 'Устаревший метод системы Joomla 1.5. Не используйте его здесь!',
'Keep setting "-- Everybody --" and Use View Access Level above instead' => 'Оставьте параметр "-- Все --" и "Использовать уровень доступа к просмотру" выше вместо этого',
'New method working in all Joomla and Mambo versions' => 'Новый метод действует во всех версиях Joomla и Mambo',
'Old Joomla [VERSION] method' => 'Старый метод Joomla [VERSION] method',
'Only users which are in groups assigned to this View Access Level will see this tab.' => 'Эту вкладку увидят только пользователи тех групп, которым назначен этот уровень доступа.',
'Only users which are in groups assigned to this View Access Level will see this list.' => 'Этот список увидят только пользователи тех групп, которым назначен этот уровень доступа.',
'This method is kept for backwards compatibility but will be removed at next major Community Builder version.' => 'Этот метод сохранен для совместимости с ранними версиями, но он будет удален в следующей главной версии Community Builder.',
'Use View Access Level above instead and set this Group setting to - "Everybody" -.' => 'Воспользуйтесь вышеприведенной настройкой "Использовать уровень доступа к просмотру" и настройте эту группу на "Все" -.',

// .../administrator/components/com_comprofiler/imgToolbox.class.php (31 in CBTxt format) //
'Error: your ImageMagick path is not correct! Please (re)specify it in the Admin-system under "Settings"' => 'Ошибка: Ваш путь к ImageMagick неверен! Пожалуйста укажите его еще раз в "Настройках" в административной панели.',
'Error: your NetPBM path is not correct! Please (re)specify it in the Admin-system under "Settings"' => 'Ошибка: Ваш путь к NetPBM неверен! Пожалуйста укажите его еще раз в "Настройках" в административной панели.',
'PHP running on your server does not support the GD image library, check with your webhost if ImageMagick is installed' => 'PHP Вашего сервера не поддерживает библиотеку GD. Проверьте с Вашим хостером установлен ли на сервере ImageMagick.',
'Error: PHP running on your server does not support the GD image library, check with your webhost if ImageMagick is installed' => 'Ошибка: PHP Вашего сервера не поддерживает библиотеку GD. Проверьте с Вашим хостером установлен ли на сервере ImageMagick.',
'Error: PHP running on your server does not support GD graphics library version 2.x, please install GD version 2.x or switch to another images library in Community Builder Configuration.' => 'Ошибка: PHP Вашего сервера не поддерживает версию 2.х библиотеки GD. Пожалуйста установите GD версию 2.x или переключитесь на другую библиотеку изображений в конфигурации Community Builder.',
'The file exceeds the maximum size of %s kilobytes' => 'Этот файл превосходит максимально допустимый размер %s килобайт.',
'Error occurred during the moving of the uploaded file. Method: %s' => 'Во время переноса загруженного файла произошла ошибка. Метод: %s',
'Move' => 'Переместить',
'Rename' => 'Переименовать',
'Copy' => 'Копировать',
'In Memory' => 'В память',
'Error rotating image' => 'Ошибка при смене изображения',
'Error: resizing image failed.' => 'Ошибка: не удалось изменить размер изображения.',
'Error: resizing thumbnail image failed.' => 'Ошибка: не удалось изменить размер миниатюры изображения.',
'Error: image format is not supported.' => 'Ошибка: этот формат изображений не поддерживается.',
'Error: %s is not a supported image format.' => 'Ошибка: %s не является поддерживаемым форматом изображений.',
'Error: Unable to execute getimagesize function' => 'Ошибка: не удалось осуществить функцию getimagesize',
'Error: NetPBM does not support this file type.' => 'Ошибка: NetPBM не поддерживает этот формат файлов.',
'Error: GD1 does not support this file type.' => 'Ошибка: GD1 не поддерживает этот формат файлов.',
'Error: GD1 Unable to create image from imagetype function' => 'Ошибка: GD1 не удалось создать изображение с помощью функции imagetype.',
'Error: GD2 Unable to create image from imagetype function' => 'Ошибка: GD2 не удалось создать изображение с помощью функции imagetype.',
'Error: GIF Uploads are not supported by this version of GD' => 'Ошибка: загрузка файлов в формате GIF в этой версии библиотеки GD не поддерживается',
'Image Name' => 'Название изображения',
'Error type' => 'Тип ошибки',

// .../administrator/components/com_comprofiler/library/cb/cb.pagination.php (13 in CBTxt format) //
'Display #' => 'Показать #',
'Yes' => 'Да',
'Disable Item' => 'Отключить',
'Enable item' => 'Включить',

// .../administrator/components/com_comprofiler/plugin.class.php (2 in CBTxt format) //
'is now' => 'сейчас',
'%s is now %s' => '%s сейчас %s',

// .../components/com_comprofiler/plugin/user/plug_cbcore/cb.core.php (22 in CBTxt format) //
'Not a valid input' => 'Неправильный ввод данных',
'Unknown field %s' => 'Неизвестное поле %s',
'********' => '********',
'Unknown Output Format' => 'Неизвестный формат выдачи данных',
'Min setting > Max setting !' => 'Настройка Мин > Настройка Макс!',
'Not an integer' => 'Не integer',
'Unexpected cbCheckMail result: %s' => 'Неожиданный результат cbCheckMail: %s',
'Block User' => 'Заблокировать пользователя',
'Approve User' => 'Одобрить пользователя',
'Confirm User' => 'Подтвердить пользователя',
'Receive Moderator Emails' => 'Получать эл.письма модератора',
'No (User\'s group-level doesn\'t allow this)' => 'Нет (Уровень группы пользователя этого не допускает)',
'Register Date' => 'Дата регистрации',
'Last Visit Date' => 'Последний визит на сайт',

// .../components/com_comprofiler/plugin/user/plug_cbsimpleboardtab/cb.simpleboardtab.model.php (27 in CBTxt format) //
'Moderator' => 'Модератор',
'ONLINE' => 'НА САЙТЕ',
'OFFLINE' => 'НЕ НА САЙТЕ',
'Online Status: ' => 'Статус на сайте: ',
'View Profile: ' => 'Смотреть профиль: ',
'Send Private Message: ' => 'Отправить личное сообщение: ',
'Subject' => 'Тема',
'Category' => 'Категория',
'Hits' => 'Просмотры',
'Joomlaboard' => 'Joomlaboard',
'Simpleboard' => 'Simpleboard',
'Fireboard' => 'Fireboard',
'Kunena (It is advised to select Kunena manually as Kunena has additional options)' => 'Kunena (Рекомендуется вручную выбрать форум Kunena, в силу его дополнительных настроек)',
'Kunena' => 'Kunena',

// .../components/com_comprofiler/plugin/user/plug_cbsimpleboardtab/cb.simpleboardtab.php (4 in CBTxt format) //
'The forum component is not installed.  Please contact your site administrator.' => 'Не установлен компонент форума. Пожалуйста свяжитесь с администратором Вашего веб сайта.',
'Found %s Forum Posts' => 'Найдено %s сообщение(ия/ий) форума',
'Forum Posts' => 'Сообщения форума',
'Last %s Forum Posts' => 'Последние %s сообщения(ий) форума',

// .../components/com_comprofiler/plugin/user/plug_cbsimpleboardtab/view/cb.simpleboardtab.sidebar.php (2 in CBTxt format) //
'Karma: ' => 'Карма: ',
'Posts: ' => 'Сообщения: ',

// .../components/com_comprofiler/plugin/user/plug_cbsimpleboardtab/view/cb.simpleboardtab.tab.php (20 in CBTxt format) //
'Forum Statistics' => 'Статистика форума',
'Forum Ranking' => 'Ранг форума',
'No matching forum posts found.' => 'Соответствующих сообщений форума не найдено.',
'This user has no forum posts.' => 'Этот пользователь не имеет сообщений на форуме.',
'Your Subscriptions' => 'Ваши подписки',
'Action' => 'Действие',
'Are you sure you want to unsubscribe from this forum subscription?' => 'Вы уверены в том, что Вы хотите аннулировать данную подписку форума?',
'Unsubscribe' => 'Аннулировать подписку',
'Are you sure you want to unsubscribe from all your forum subscriptions?' => 'Вы уверены в том, что Вы хотите аннулировать все Ваши подписки форума?',
'Unsubscribe All' => 'Аннулировать все подписки',
'No subscriptions found for you.' => 'Ваших подписок не найдено.',
'Your Favorites' => 'Ваши избранные темы',
'Are you sure you want to remove this favorite thread?' => 'Вы действительно хотите удалить эту избранную тему?',
'Are you sure you want to remove all your favorite threads?' => 'Вы действительно хотите удалить все Ваши избранные темы?',
'Remove All' => 'Удалить все',
'No favorites found for you.' => 'Ваших избранных тем не найдено.',

));

// IMPORTANT WARNING: The closing tag, "?" and ">" has been intentionally omitted - CB works fine without it.
// This was done to avoid errors caused by custom strings being added after the closing tag. ]
// With such tags, always watchout to NOT add any line or space or anything after the "?" and the ">".
