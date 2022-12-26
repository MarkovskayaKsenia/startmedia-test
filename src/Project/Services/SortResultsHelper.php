<?php

namespace Project\Services;

use Project\Models\Car;

class SortResultsHelper
{
    /** Вспомогательный метод, выполняющий сортировку результатов участников заезда
     * @param array $cars
     * @param $sort
     * @return array
     */
    public static function sortResults(array $cars, string $sort = 'total_sum'): array
    {
        if ($sort === 'total_sum') {
            return static::sortByBestSum($cars);
        }

        if ($sort === 'attempt_1') {
            return static::sortByAttemptNumber($cars, 0);
        }

        if ($sort === 'attempt_2') {
            return static::sortByAttemptNumber($cars, 1);
        }

        if ($sort === 'attempt_3') {
            return static::sortByAttemptNumber($cars, 2);
        }

        if ($sort === 'attempt_4') {
            return static::sortByAttemptNumber($cars, 3);
        }

        return $cars;
    }

    /** Сортировка по наилучшей сумме результатов
     * @param array $cars
     * @return array
     */
    public static function sortByBestSum(array $cars)
    {
        usort($cars, function (Car $a, Car $b) {
            $c = $a->getTotalSum();
            $d = $b->getTotalSum();

            return  static::compare($c, $d);

        });

        return $cars;
    }

    /** Сортировка результатов по каждой попытке
     * @param array $cars
     * @param int $attemptNumber
     * @return array
     */
    public static function sortByAttemptNumber(array $cars, int $attemptNumber)
    {
        usort($cars, function (Car $a, Car $b) use ($attemptNumber) {

            $c = $a->getAttempts()[$attemptNumber]->getResult();
            $d = $b->getAttempts()[$attemptNumber]->getResult();

           return  static::compare($c, $d);

        });

        return $cars;
    }

    /** Сортировка результатов и расстановка мест.
     * @param array $cars
     * @return array
     */
    public static function sortAndSetPlaces(array $cars)
    {
        $place = 0;
        $cars = static::sortByBestSum($cars);
        foreach ($cars as $car) {
            $car->setPlace(++$place);
        }

        return $cars;
    }

    /**
     * Метод сравнения двух значений
     */
    private static function compare($c, $d): int
    {
        if ( $c == $d) {
            return 0;
        }
        return ($c > $d) ? -1 : 1;
    }
}