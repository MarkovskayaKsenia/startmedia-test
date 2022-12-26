<?php

namespace Project\Models;

use Project\Services\FileReader;

abstract class BaseModel
{
    /** С помощью конструктора должно быть задано какими данными из файла заполняются свойства моделей.
     * @param $key
     * @param $data
     */
    abstract public function __construct($key, $data);


    /** Метод возвращает имя файла, из которого должны браться данные для заполнения свойств модели.
     * @return string
     */
    abstract protected static function fileName(): string;


    /** Метод читает данные из json-файла и возвращает массив моделей с заполненными из файла данными.
     * @return array
     * @throws \Project\Exceptions\FileNotFoundException
     */
    public static function findAll(): array
    {
        $collection = [];
        $data = FileReader::getDataFromJsonFile(static::fileName());
        if ($data) {
            foreach ($data as $key => $value) {
                $model = new static($key, $value);
                $collection[] = $model;
            }
        }

        return $collection;
    }
}