<?php
//функция получения коллекции машин
function getCars(): array
{
    //массив всех машин
    $cars = [
        [
            'name' => 'Seed',
            'image' => '/assets/pictures/car_ceed.png',
            'price' => $price = 1394900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Cerato',
            'image' => '/assets/pictures/car_cerato.png',
            'price' => $price = 1221900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'K5',
            'image' => '/assets/pictures/car_K5-half.png',
            'price' => $price = 1577900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'K900',
            'image' => '/assets/pictures/car_k900.png',
            'price' => $price = 4064900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Mohave',
            'image' => '/assets/pictures/car_mohave_new.png',
            'price' => $price = 3549900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Stinger',
            'image' => '/assets/pictures/car_new_stinger.png',
            'price' => $price = 2409900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Rio',
            'image' => '/assets/pictures/car_rio-x.png',
            'price' => $price = 969900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Rio',
            'image' => '/assets/pictures/car_rio_new.png',
            'price' => $price = 849900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Seltos',
            'image' => '/assets/pictures/car_seltos.png',
            'price' => $price = 1224900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Sorento',
            'image' => '/assets/pictures/car_sorento_new.png',
            'price' => $price = 2219900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Soul',
            'image' => '/assets/pictures/car_soul.png',
            'price' => $price = 1094900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'Sportage',
            'image' => '/assets/pictures/car_sportage.png',
            'price' => $price = 1644900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
        [
            'name' => 'XSeed',
            'image' => '/assets/pictures/car_xceed.png',
            'price' => $price = 1714900,
            'oldPrice' => rand(0, 3) > 2 ? $price + rand(1, 10000) : null,
        ],
    ];
    //перемешивание машин
    shuffle($cars);
    //получение размерности массива
    $carsCount = count($cars);
    //возвращаем массив с 0 до случаного значения
    return array_splice($cars, 0, rand(min(5, $carsCount), $carsCount));
}
