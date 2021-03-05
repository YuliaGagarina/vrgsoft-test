1. Создала проект командой из консоли: 
    composer create-project laravel/laravel vrgsoft-test;
2. В phpmyadmin создала БД test. В файле .env меняем параметры на свои:
    DB_DATABASE = test
    DB_USERNAME = root
    DB_PASSWORD =
3. Планирую БД для двух таблиц, авторов и книг. Создаю файлы миграции с помощью команды
    php artisan make:migration create_users_table --create=books
    php artisan make:migration create_users_table --create=authors
4. Заполняю появившиеся файлы миграций с помощью конструктора Schema (указываю поля таблиц).
5. Командой php artisan migrate создаю таблицы в БД.
6. Для разработки заполняю БД рандомными данными при помощи Seeder.
7. Разрабатываю представления. Папка resources/views. Шаблон 'home' будет показываться 
при переходе на '/, 'books/show' и 'authors/show' при нажатии на кнопки. 
8. В файле 'routes/web.php' прописываю маршруты, которые вызовут те или иные методы 
контроллеров при нажатии на определенные кнопкии или ссылки. 
9. Создаю модель командой php artisan:make model Book (Author). Указываю в файлах модели заполняемые поля. 
Насколько я понимаю, логика работы с БД желательна в модели, но, за неимением опыта и 
подходящего образца, я писала свое приложение так, как писала.
10. Создаю контроллеры командами 
    php artisan make:contoller BooksController
    php artisan make:contoller AuthorsController
В контроллерах редактирую уже имеющиеся там по умолчанию методы. Здесь реализуется CRUD:
Create - создание объекта записи (автора или книги) - store()
Read - вывод всех имеющихся записей - index()
Update - обновление имеющейся записи по id - update()
Delete - удаление имеющейся записи по id - destroy()
а заодно и методы sort() - сортировка записей, find() - поиск записи по названию или 
автору (книги) или по имени/фамилии (авторы).
На курсах мы так делали, и я сделала это у себя. Создала папку Repository с 
интерфейсами и классами, которые собственно и реализовали работу с БД (запросы).
Запросы строились некоторые при помощи query-builder, а некоторые при помощи фасада DB.

По функциональности. Методы работают у меня не все. Практически со всем пришлось разбираться с 0.
Работают: destroy(), sort(), store()/books. Остальные недописаны. Юнит-тесты я тоже не писала. 
Формы я писала по старинке, на html. Фасад Form нашла только вчера вечером. 
Передача данных: сохранение картинки в папку и множественный список мне победить пока не удалось. Соответственно,
картинки не могут быть выведены, и у книги можно указать только одного автора. 
Я думала о том, чтобы реализовать связь один к многим (книга-авторы), но отказалась от этой идеи, потому что 
с подобным еще не сталкивалась и, естественно, механизм реализации этого мне не знаком. 
AJAX я не использовала, решила сначала написать работающие методы, а потом уже ajax, 
но не успела.
11. Запуск сборщика npm run watch
12. Чистка кеша: 
    php artisan view:cache
    php artisan cache:clear