<?php

namespace app\services;

use app\dto\CurrencyDTO;
use app\models\Currency;
use app\repositories\contracts\CurrencyRepository;
use app\repositories\contracts\SourceCurrencyRepository;
use app\services\exceptions\ServiceException;
use Throwable;
use Yii;

class CurrencyService
{
    const SIZE_PAGE = 5;

    /** @var SourceCurrencyRepository */
    private $sourceCurrencies;

    /** @var CurrencyRepository */
    private $currencies;

    public function __construct(
        SourceCurrencyRepository $sourceCurrencyRepository,
        CurrencyRepository $currencyRepository
    ) {
        $this->sourceCurrencies = $sourceCurrencyRepository;
        $this->currencies = $currencyRepository;
    }

    public function update()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            /** @var CurrencyDTO[] $currencyDTOs */
            $currencyDTOs = $this->sourceCurrencies->getAll();
            $newCurrencies = [];

            foreach ($currencyDTOs as $currencyDTO) {
                $newCurrencies[] = new Currency([
                    'id' => $currencyDTO->id,
                    'name' => $currencyDTO->name,
                    'rate' => $currencyDTO->rate,
                ]);
            }

            $this->currencies->deleteAll();
            $this->currencies->multiInsert($newCurrencies);

            $transaction->commit();

        } catch (Throwable $e) {
            $transaction->rollBack();
            Yii::error(
                sprintf(
                    "{%s}({{%s}): {{%s}\n\n{{%s}",
                    $e->getFile(), $e->getLine(), $e->getMessage(), $e->getTraceAsString()
                )
            );

            throw new ServiceException('Update currency fail');
        }
    }

    public function getListForApi(int $page = 1): array
    {
        return $this->currencies->getList(self::SIZE_PAGE, ($page - 1) * self::SIZE_PAGE);
    }

    public function getForApi(int $id): Currency
    {
        return $this->currencies->get($id);
    }
}
