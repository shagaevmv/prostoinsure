<?php

namespace app\commands;

use app\services\CurrencyService;
use Throwable;
use yii\base\Module;
use yii\console\Controller;
use yii\console\ExitCode;

class CurrencyController extends Controller
{
    /** @var CurrencyService */
    private $currencyService;

    public function __construct(
        string $id,
        Module $module,
        CurrencyService $currencyService,
        array $config = []
    ) {
        $this->currencyService = $currencyService;

        parent::__construct($id, $module, $config);
    }

    public function actionUpdate(): int
    {
        try {
            $this->currencyService->update();
            echo "Success: currency was updated\n";

            return ExitCode::OK;
        } catch (Throwable $e) {
            echo sprintf('Error: %s', $e->getMessage()) . "\n";
        }

        return ExitCode::UNSPECIFIED_ERROR;
    }
}
