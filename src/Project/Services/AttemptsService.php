<?php

namespace Project\Services;

use Project\Models\Car;

class AttemptsService
{
    /**
     * Подсчет максимального количества попыток среди всех машин
     * @param array $cars
     * @return int|mixed
     */
    public static function getMaxAttempts(array $cars)
    {
        $maxAttempts = 0;
        foreach ($cars as $car) {
            if ($car instanceof Car) {
                $countAttemts = count($car->getAttempts());
                $maxAttempts = ($maxAttempts > $countAttemts) ? $maxAttempts : $countAttemts;
            }
        }

        return $maxAttempts;
    }

    /** Проверка, идет ли сортировка данных по количеству попыток и существует ли попытка с таким номером.
     * @param string $sort
     * @param int $maxAttempts
     * @return false|int
     */
    public static function checkAttemptSortRequest(string $sort, int $maxAttempts) :int
    {
        $attemptArray = static::getDataFromRequest($sort);
        $attemptNumber = (int) (($attemptArray[1]) ?? 0);

        if (
            $attemptArray[0] === 'attempt'
            && $attemptNumber
            && $attemptNumber > 0
            && $attemptNumber <= $maxAttempts
        ) {
            return $attemptNumber;
        }

        return 0;
    }

    /** Разделение данных в параметре запроса для удобства манипулирвоания
     * @param string $sort
     * @return string[]
     */
    protected static function getDataFromRequest(string $sort) :array
    {
        return explode('_', $sort);
    }
}