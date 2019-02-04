<?php

namespace app\repositories\contracts;

use app\models\Currency;
use app\repositories\exceptions\EntityNotFoundException;
use app\repositories\exceptions\EntitySaveException;

interface CurrencyRepository
{
    public function deleteAll();

    /**
     * @param Currency[] $items
     * @return void
     * @throws EntitySaveException
     */
    public function multiInsert(array $items);

    /**
     * @return Currency[]
     */
    public function getList(int $amount, int $offset): array;

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): Currency;
}
