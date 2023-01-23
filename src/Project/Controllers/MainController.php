<?php

namespace Project\Controllers;

use Project\Models\Attempt;
use Project\Models\Car;
use Project\Services\AttemptsService;
use Project\Services\SortResultsHelper;

class MainController extends AbstractController
{
    public function main()
    {
        $cars = SortResultsHelper::sortAndSetPlaces(Car::findAllWithAttempts());
        $maxAttempts = AttemptsService::getMaxAttempts($cars);

        if (array_key_exists('sort', $_GET)) {
            $cars = SortResultsHelper::sortResults($cars, $maxAttempts, $_GET['sort']);
        }

        $this->view->renderHtml('main/main.php', [
            'cars' => $cars,
            'maxAttempts' => $maxAttempts,
        ]);
    }
}