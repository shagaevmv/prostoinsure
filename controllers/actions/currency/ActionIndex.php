<?php

namespace app\controllers\actions\currency;

use app\services\CurrencyService;
use Yii;
use yii\base\Action;
use yii\web\Controller;

class ActionIndex extends Action
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

    public function run()
    {
        $request = Yii::$app->getRequest();
        $page = $request->get('page', 1);

        return $this->currencyService->getListForApi($page);
    }
}
