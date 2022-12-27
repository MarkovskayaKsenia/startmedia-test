<?php

namespace Project\Models;

use Project\Exceptions\DataNotFoundException;
use Project\Services\FileReader;

class Car extends BaseModel
{
    protected $regNumber;
    protected $id;
    protected $name;
    protected $city;
    protected $car;
    protected $attempts = [];
    protected $place;

    public function __construct($key, $data)
    {
        $this->regNumber = $key ?? null;
        $this->id = $data->id ?? null;
        $this->name = $data->name ?? null;
        $this->city = $data->city ?? null;
        $this->car = $data->car ?? null;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCar()
    {
        return $this->car;
    }

    public function getRegNumber()
    {
        return $this->regNumber;
    }

    public function getAttempts()
    {
        return $this->attempts;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public static function findAllWithAttempts()
    {
        $attempts = Attempt::findAll();
        $cars = static::findAll();

        if (!$cars) {
            throw new DataNotFoundException("Нет данных в файле " . static::filename());
        }

        if (!$attempts) {
            throw new DataNotFoundException("Нет данных в файле " . Attempt::filename());
        }

        foreach ($attempts as $attempt) {
            foreach ($cars as $car) {
                if ($attempt->getCarId() === $car->id) {
                    $car->attempts[] = $attempt;
                }
            }
        }
        return $cars;
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        $results = [];
        foreach ($this->attempts as $attempt) {
            $results[] = $attempt->getResult();
        }
        return $results;
    }

    public function getTotalSum()
    {
        return array_sum($this->getPoints());
    }

    public function setPlace(int $place)
    {
        $this->place = $place;
    }

    /** Метод возвращает имя файла, из которого берутся данные для заполнения модели "Машин"
     * @return string
     */
    protected static function fileName(): string
    {
        return 'data_cars.json';
    }

}