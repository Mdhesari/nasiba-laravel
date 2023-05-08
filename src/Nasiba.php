<?php

namespace Mdhesari\Nasiba;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mdhesari\Nasiba\Traits\HttpClientTools;

class Nasiba
{
    use HttpClientTools;

    public function __construct(
        public string  $base_url,
        public array   $config,
        private Client $client,
    )
    {
        //
    }

    /**
     * @param array $data
     * @return mixed
     * @throws GuzzleException
     */
    public function getPaymentToken(array $data): mixed
    {
        $response = $this->client->post($this->url('payment/get-token'), [
            'form_params' => $this->getParams([
                'Amount'               => $data['quantity'],
                'Action'               => $data['action'],
                'ProductUID'           => $data['productId'],
                'InstallmentsCount'    => $data['installmentsCount'],
                'MaxCreditShare'       => $data['maxCreditShare'],
                'CreditScore'          => $data['creditScore'],
                'Mobile'               => $data['mobile'],
                'ManualCreditPurchase' => $data['manualCreditPurchase'] ?? null,
            ])
        ]);

        return $this->getResponse($response);
    }

    private function getParams(array $data)
    {
        $data = [
            'Content-Type'    => 'application/json',
            'TerminalCode'    => $this->config['terminalCode'],
            'MerchantCode'    => $this->config['merchantCode'],
            'RedirectAddress' => $this->config['callbackUrl'],
            'Timestamp'       => now()->timestamp,
            'InvoiceData'     => today()->format('Y-m-d'),
            ...$data,
        ];

        $data['sign'] = $this->getSignature($data);

        return $data;
    }

    private function getSignature(array $data): string
    {
        openssl_sign(json_encode($data), $sign, $this->config['signature'], OPENSSL_ALGO_SHA1);

        return base64_encode($sign);
    }
}
