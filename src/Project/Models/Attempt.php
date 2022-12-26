<?php
namespace Project\Models;

use Project\Services\FileReader;

class Attempt extends BaseModel
{
    protected $carId;
    protected $result;

    public function __construct($key, $data)
    {
        $this->carId = $data->id ?? null;
        $this->result = $data->result ?? null;
    }

    public function getCarId()
    {
        return $this->carId;
    }

    public function getResult()
    {
        return $this->result;
    }


    /** Метод возвращает имя файла, из которого берутся данные для заполнения модели "Попыток"
     * @return string
     */
    protected static function fileName(): string
    {
        return 'data_attempts.json';
    }
}