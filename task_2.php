<?php

/**
 * Имеется строка: https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3
 * Напишите функцию, которая:
 * 1. удалит параметры со значением “3”;
 * 2. отсортирует параметры по значению;
 * 3. добавит параметр url со значением из переданной ссылки без параметров (в примере: /test/index.html);
 * 4. сформирует и вернёт валидный URL на корень указанного в ссылке хоста.
 * В указанном примере функцией должно быть возвращено: https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html
 *
 * @param string $url
 * @return string
 */
function handle_url(string $url): string
{
    $dataUrl = parse_url($url);

    // поместим GET-параметры в массив
    parse_str($dataUrl['query'], $params);

    // удаляем параметры со значение 3
    $params = array_filter($params, function ($value) {
        return $value != 3;
    });

    // отсортируем массив, сохраняя ключи (в нашем случае - параметры запроса)
    asort($params);

    $params['url'] = $dataUrl['path'];

    return "{$dataUrl['scheme']}://{$dataUrl['host']}/?" . http_build_query($params);
}
