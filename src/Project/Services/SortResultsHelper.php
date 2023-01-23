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
    public static function sortResults(array $cars, int $maxAttempts, string $sort = 'total_sum'): array
    {
        if ($sort === 'total_sum') {
            return static::sortByBestSum($cars);
        }

        $attemptNumber = AttemptsService::checkAttemptSortRequest($sort, $maxAttempts);

        if (!$attemptNumber) {
            return $cars;
        }

        return static::sortByAttemptNumber($cars, $attemptNumber - 1);
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

            return static::compare($c, $d);

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

            $c = isset($a->getAttempts()[$attemptNumber]) ? $a->getAttempts()[$attemptNumber]->getResult() : 0;
            $d = isset($b->getAttempts()[$attemptNumber]) ? $b->getAttempts()[$attemptNumber]->getResult() : 0;

            return static::compare($c, $d);

        });

        return $cars;
    }

    /** Сортировка результатов и расстановка мест.
     * @param array $cars
     * @return array
     */
    public static function sortAndSetPlaces(array $cars,)
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
        return $d <=> $c;
    }
}