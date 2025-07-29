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

## Запуск

**Разработческий сервер:**
```bash
php artisan serve
```

**Очередь для синхронизации (в отдельном терминале):**
```bash
php artisan queue:work
```

**Консольные команды:**
```bash
# Синхронизация с Google Sheets
php artisan google:sync
```
```bash
# Получение комментариев из таблицы
php artisan google:fetch {count?}
```

## Конфигурация

**Добавьте в .env:**
```bash
GOOGLE_SHEETS_CREDENTIALS_PATH=storage/app/google-credentials.json
GOOGLE_SHEETS_TOKEN_PATH=storage/app/google-token.json
GOOGLE_SHEET_ID=your_sheet_id_here
```
