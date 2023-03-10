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
                    <?php for($i = 0; $i < $maxAttempts; $i++): ?>
                        <input class="hidden" type="radio" name="sort" value="attempt_<?= $i+1; ?>" id="attempt_<?= $i+1; ?>"
                            <?= HtmlHelper::isRadioButtonChecked($_GET, 'attempt_' . $i+1); ?>
                        >
                        <label for="attempt_<?= $i+1; ?>" class="sort-label">
                            Попытка №<?= $i+1; ?>
                        </label>
                    <?php endfor;?>

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
                <?php for($i = 0; $i < $maxAttempts; $i++): ?>
                <th class="column-1 attempt_<?= $i+1; ?>">Попытка №<?= $i+1; ?></th>
                <?php endfor;?>
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
                        <?php for($i = 0; $i < $maxAttempts; $i++): ?>
                            <td><?= $car->getPoints()[$i] ?? null; ?></td>
                        <?php endfor;?>

                        <td><?= $car->getTotalSum(); ?></td>
                        <td><?= $car->getPlace(); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__ . '/../footer.php'; ?>