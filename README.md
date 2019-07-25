# Laravel - отслеживание запроса 

Библиотека для отслеживание запроса между сервисами

## Требуется
    - Laravel >= 5.8
    - PHP >= 7.2
    
## Использование

Генерирует для текущего запроса correlation_id и span_id, если их не было. Для следующего запроса надо подставить в 
query параметры correlation_id и span_id.

````php
$params = CorrelationId::getInstance()->getCurrentQueryParams();

$url = "https://example.com?correlation_id=$params['correlation_id']&span_id=$params['span_id']";
````
