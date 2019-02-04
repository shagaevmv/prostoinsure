<?php

namespace app\bootstrap;


use app\repositories\ARCurrencyRepository;
use app\repositories\CbrXMLSourceCurrencyRepository;
use app\repositories\contracts\CurrencyRepository;
use app\repositories\contracts\SourceCurrencyRepository;
use Yii;
use yii\base\BootstrapInterface;

class DIContainer implements BootstrapInterface
{
    public function bootstrap($app)
    {
        Yii::$container->setSingletons([
            SourceCurrencyRepository::class => CbrXMLSourceCurrencyRepository::class,
            CurrencyRepository::class => ARCurrencyRepository::class,
        ]);
    }
}
