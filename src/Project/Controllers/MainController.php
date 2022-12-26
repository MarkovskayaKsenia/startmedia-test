<?php

namespace Project\Controllers;

use Project\Models\Attempt;
use Project\Models\Car;
use Project\Services\SortResultsHelper;

class MainController extends AbstractController
{
    public function main()
    {
        $cars = SortResultsHelper::sortAndSetPlaces(Car::findAllWithAttempts());

        if (array_key_exists('sort', $_GET)) {
            $cars = SortResultsHelper::sortResults($cars, $_GET['sort']);
        }

        $this->view->renderHtml('main/main.php', [
            'cars' => $cars,
        ]);
    }
}