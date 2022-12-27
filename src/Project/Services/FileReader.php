<?php

namespace Project\Services;

use Project\Exceptions\DataNotFoundException;

class FileReader
{
    public static $dataFilesPath = __DIR__ . '/../../DataFiles/';

    /** Получение данных из файла JSON и декодирование данных
     * @param $fileName
     * @return mixed
     * @throws DataNotFoundException
     */
    public static function getDataFromJsonFile($fileName)
    {
        $fullPath = self::$dataFilesPath . $fileName;

        if (!file_exists($fullPath)) {
            throw new DataNotFoundException( "Файл {$fileName} не найден!");
        }

        $file = file_get_contents($fullPath);

        return json_decode($file);
    }


}