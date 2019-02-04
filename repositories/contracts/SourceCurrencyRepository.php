<?php

namespace app\repositories\contracts;

use app\dto\CurrencyDTO;
use app\repositories\exceptions\EntityNotFoundException;

interface SourceCurrencyRepository
{
    /**
     * @return CurrencyDTO[]
     * @throws EntityNotFoundException
     */
    public function getAll(): array;
}
