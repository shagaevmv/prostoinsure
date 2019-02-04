<?php

namespace app\controllers\actions\currency;

use app\services\CurrencyService;
use yii\base\Action;
use yii\web\Controller;

class ActionView extends Action
{
    /** @var CurrencyService */
    private $currencyService;

    public function __construct(
        string $id,
        Controller $controller,
        CurrencyService $currencyService,
        array $config = []
    ) {
        $this->currencyService = $currencyService;

        parent::__construct($id, $controller, $config);
    }

    public function run(int $id)
    {
        return $this->currencyService->getForApi($id);
    }
}
