<?php


namespace App\Communicators;


class OnDemandCommunicator implements ProductSearchCommunicator
{
    /**
     * リクエスト先APIのURL
     */
    const REQUEST_BASE_URL = 'https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706';

    /**
     * @inheritDoc
     */
    public function communicate(array $parameters): string
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->get(self::REQUEST_BASE_URL, [
            'query' => $parameters,
        ]);

        return (string) $response->getBody();
    }
}
