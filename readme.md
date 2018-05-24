Тестовое задание
1) Скачиваем исходники выполненого задания из репозитория: git clone [git@gitlab.1n9.ru:blackcat/test_task.git](git@gitlab.1n9.ru:blackcat/test_task.git)
2) Запускаем сборку докера: cd test_task && docker-compose up -d
3) Устанавливаем необходимые пакеты: cd www && composer install
4) Формируем файл конфигурации: cp .env.example .env
В нем всего один параметр JWT_KEY="ООО «Торбор-Агро»" - его будем использовать как "секретный" ключ для токена авторизации
5) Для формирования тестового токена идем на https://jwt.io/ и вместо "your-256-bit-secret" записываем наш "секретный" ключ
получаем значение : eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.ZVPJFWdvf72Hj6MX7tEPbDDF0pPKXZ8qgZ5JcMy6oBU

6) Проверяем работу задания:
curl -v http://localhost:8080?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.ZVPJFWdvf72Hj6MX7tEPbDDF0pPKXZ8qgZ5JcMy6oBU&points=%7B%22a%22%3A%22%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0+%2C+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F%22%2C%22b%22%3A%22%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D0%B4%D0%B0%D1%80%2C+%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D0%B4%D0%B0%D1%80%D1%81%D0%BA%D0%B8%D0%B9+%D0%BA%D1%80%D0%B0%D0%B9%2C+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F%22%7D&price=234

где:

    token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.ZVPJFWdvf72Hj6MX7tEPbDDF0pPKXZ8qgZ5JcMy6oBU&points=%7B%22a%22%3A%22%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0+%2C+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F%22%2C%22b%22%3A%22%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D0%B4%D0%B0%D1%80%2C+%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D0%B4%D0%B0%D1%80%D1%81%D0%BA%D0%B8%D0%B9+%D0%BA%D1%80%D0%B0%D0%B9%2C+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F%22%7D&price=234
    
    
строка  

        token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.ZVPJFWdvf72Hj6MX7tEPbDDF0pPKXZ8qgZ5JcMy6oBU&points={"a":"Москва , Россия","b":"Краснодар, Краснодарский край, Россия"}&price=234
        
преобразованная функцией urlencode

на выходе получаем:

````

{
    "destination_addresses": [
        "Краснодар, Краснодарский край, Россия"
    ],
    "origin_addresses": [
        "Москва, Россия"
    ],
    "rows": [
        {
            "elements": [
                {
                    "distance": {
                        "text": "1 346 км",
                        "value": 1346356
                    },
                    "duration": {
                        "text": "15 ч. 49 мин.",
                        "value": 56965
                    },
                    "status": "OK",
                    "price": {
                        "text": "Стоимость",
                        "value": "315047304 руб."
                    }
                }
            ]
        }
    ],
    "status": "OK"
}




