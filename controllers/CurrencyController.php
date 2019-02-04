<?php

namespace app\controllers;

use app\controllers\actions\currency\ActionIndex;
use app\controllers\actions\currency\ActionView;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;

class CurrencyController extends Controller
{
    /**
     * @return array[][]
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBearerAuth::class;

        return $behaviors;
    }

    /**
     * @return array[][]
     */
    public function actions(): array
    {
        return array(
            'index' => ActionIndex::class,
            'view' => ActionView::class,
        );
    }
}
