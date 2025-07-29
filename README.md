Сервис для двусторонней синхронизации данных между БД MySQL и Google Таблицами с возможностью CRUD операций и сохранением пользовательских комментариев.

## Основные возможности

- **CRUD интерфейс** для модели Item
- **Генерация тестовых данных** (1000 записей)
- **Автоматическая синхронизация** с Google Sheets (каждую минуту)
- **Сохранение комментариев** пользователей в таблице
- **Консольные команды** для управления синхронизацией
- **API endpoint** для запуска синхронизации

## Технологический стек

- **Backend**: Laravel 12
- **Database**: MySQL
- **Google API**: Google Sheets API v4
- **Frontend**: Blade templates, Bootstrap 5

  ## Настройте Google API:

  - Создайте проект в Google Cloud Console
  - Включите Google Sheets API
  - Создайте OAuth 2.0 Client ID
  - Скачайте credentials.json в storage/app/google-credentials.json
