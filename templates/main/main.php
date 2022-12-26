<?php

use Project\Services\HtmlHelper;

?>
<?php include __DIR__ . '/../header.php'; ?>

    <div class="container flex">
    <h1>Турнирная таблица участников заезда</h1>
    <div class="sort-form">
        <form action="/" method="GET">
            <fieldset>
                <legend>Сортировка результатов</legend>
                <div class="sort-buttons">
                    <input class="hidden" type="radio" name="sort" value="attempt_1" id="attempt_1"
                        <?= HtmlHelper::isRadioButtonChecked($_GET, 'attempt_1'); ?>
                    >
                    <label for="attempt_1" class="sort-label">
                        Попытка №1
                    </label>

                    <input class="hidden" type="radio" name="sort" value="attempt_2" id="attempt_2"
                        <?= HtmlHelper::isRadioButtonChecked($_GET, 'attempt_2'); ?>
                    >
                    <label for="attempt_2" class="sort-label">
                        Попытка №2
                    </label>


                    <input class="hidden" type="radio" name="sort" value="attempt_3" id="attempt_3"
                        <?= HtmlHelper::isRadioButtonChecked($_GET, 'attempt_3'); ?>
                    >
                    <label for="attempt_3" class="sort-label">
                        Попытка №3
                    </label>


                    <input class="hidden" type="radio" name="sort" value="attempt_4" id="attempt_4"
                        <?= HtmlHelper::isRadioButtonChecked($_GET, 'attempt_4'); ?>
                    >
                    <label for="attempt_4" class="sort-label">
                        Попытка №4
                    </label>


                    <input class="hidden" type="radio" name="sort" value="total_sum" id="total_sum"
                        <?= HtmlHelper::isRadioButtonChecked($_GET, 'total_sum'); ?>
                    >
                    <label for="total_sum" class="sort-label">
                        Общая сумма
                    </label>

                </div>
                <button class=" btn-submit" type="submit"><span>Сортировать</span></button>
            </fieldset>
        </form>
    </div>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th class="column-1">Id</th>
                <th class="column-1">Рег. номер</th>
                <th class="column-3">Имя водителя</th>
                <th class="column-3">Город</th>
                <th class="column-5">Машина</th>
                <th class="column-1 attempt_1">Попытка №1</th>
                <th class="column-1 attempt_2">Попытка №2</th>
                <th class="column-1 attempt_3">Попытка №3</th>
                <th class="column-1 attempt_4">Попытка №4</th>
                <th class="column-1 total_sum">Общая сумма</th>
                <th class="column-1">Итоговое место</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($cars): ?>
                <?php foreach ($cars as $key => $car): ?>
                    <tr>
                        <td><?= $car->getId(); ?></td>
                        <td><?= $car->getRegNumber(); ?></td>
                        <td><?= $car->getName(); ?></td>
                        <td><?= $car->getCity(); ?></td>
                        <td><?= $car->getCar(); ?></td>
                        <td><?= $car->getPoints()[0] ?? null; ?></td>
                        <td><?= $car->getPoints()[1] ?? null; ?></td>
                        <td><?= $car->getPoints()[2] ?? null; ?></td>
                        <td><?= $car->getPoints()[3] ?? null; ?></td>
                        <td><?= $car->getTotalSum(); ?></td>
                        <td><?= $car->getPlace(); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../footer.php'; ?>