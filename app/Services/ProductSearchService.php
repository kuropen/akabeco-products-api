<?php
namespace App\Services;

use App\Communicators\ProductSearchCommunicatorFactory;

/**
 * Class ProductSearchService
 * @package App\Services
 */
class ProductSearchService
{
    /**
     * 検索する商品の名前
     */
    const REQUEST_PROD_NAME = '赤べこ';

    /**
     * 検索する商品のジャンル
     */
    const REQUEST_PROD_GENRE = '100863';

    /**
     * 商品検索を実行する.
     * @param bool $useAffiliate アフィリエイト広告を使用する（STGはfalse 本番はtrue)
     * @return string JSON
     */
    public static function searchProduct(bool $useAffiliate) : string
    {
        $query = [
            'applicationId' => env('RAKUTEN_APP_ID'),
            'formatVersion' => 2,
            'keyword' => self::REQUEST_PROD_NAME,
            'genreId' => self::REQUEST_PROD_GENRE,
        ];
        if ($useAffiliate) {
            $affiliateId = env('RAKUTEN_AFL_ID');
            if (empty($affiliateId)) {
                abort('500', 'Affiliate ID not set.');
            }
            $query['affiliateId'] = env('RAKUTEN_AFL_ID');
        }

        $communicator = ProductSearchCommunicatorFactory::getCommunicator();

        return $communicator->communicate($query);
    }
}
