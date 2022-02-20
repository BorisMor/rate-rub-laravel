# Курсы валют
По умолчанию работает на localhost:8080 \
Основаная реализация `app/Service`

### Собрать под Docker
- make build
- make start
- make composer-install
- cp .env.dev .env
- make key-generate

### Сохранить курсы валют
Зайти в контейнер `make ssh`\
Выполнить команды:
- php artisan migrate
- php artisan rate:period 60

Последняя команда заберет курсы за  последние 60 дней.

### Запрос данных
Запустить контейнер `make start`\
Выполнить get запрос \
`http://localhost:8080/getRate/eur/2022-02-07`
