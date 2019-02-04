<?php

namespace app\repositories;

use app\models\Currency;
use app\repositories\contracts\CurrencyRepository;
use app\repositories\exceptions\EntityNotFoundException;
use app\repositories\exceptions\EntitySaveException;
use Yii;

class ARCurrencyRepository implements CurrencyRepository
{
    public function deleteAll()
    {
        Currency::deleteAll();
    }

    /**
     * @param Currency[] $items
     * @return void
     * @throws EntitySaveException
     */
    public function multiInsert(array $items)
    {
        $rows = [];

        foreach ($items as $item) {
            if (! $item->validate()) {
                throw new EntitySaveException('ARCurrencyRepository::multiInsert - not valid model');
            }

            $rows[] = $item->attributes;
        }

        $currencyModel = new Currency();

        Yii::$app->db->createCommand()
            ->batchInsert(Currency::tableName(), $currencyModel->attributes(), $rows)->execute();
    }

    /**
     * @return Currency[]
     */
    public function getList(int $limit, int $offset): array
    {
        return Currency::find()
                ->orderBy('name')
                ->offset($offset)
                ->limit($limit)
                ->all();
    }

    /**
     * @throws EntityNotFoundException
     */
    public function get(int $id): Currency
    {
        $currency = Currency::findOne(['id' => $id]);

        if ($currency === null) {
            throw new EntityNotFoundException('Currency with id: ' . $id . ' not found');
        }

        return $currency;
    }
}
