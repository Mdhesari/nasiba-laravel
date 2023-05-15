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
        $response = $this->client->post($this->url('payment/get-token/'), [
            'body'    => json_encode($data = $this->getParams([
                'Amount'               => $data['quantity'],
                'InvoiceNumber'        => $data['invoiceNumber'],
                'Action'               => $data['action'] ?? 1003,
                'ProductUID'           => $data['productId'] ?? "111f410c-4f59-437a-9b3d-1d7e725125e9",
                'InstallmentsCount'    => $data['installmentsCount'],
                'MaxCreditShare'       => $data['maxCreditShare'],
                'Mobile'               => $data['mobile'],
                'ManualCreditPurchase' => false,
            ])),
            'headers' => [
                'Sign'         => $this->getSignature($data),
                'Content-Type' => 'application/json',
            ]
        ]);

        return $this->getResponse($response);
    }

    private function getParams(array $data)
    {
        $data = [
            'TerminalCode'    => $this->config['terminalCode'],
            'MerchantCode'    => $this->config['merchantCode'],
            'RedirectAddress' => $this->config['callbackUrl'],
            'Timestamp'       => today()->format('Y-m-d').'T'.now()->format('h:i:s'),
            'InvoiceDate'     => today()->format('Y-m-d'),
            ...$data,
        ];

        return $data;
    }

    public function getGatewayUrl(string $token)
    {
        return $this->url('payment/?n='.$token);
    }

    private function getSignature(array $data): string
    {
        openssl_sign(json_encode($data), $sign, $this->config['signature'], OPENSSL_ALGO_SHA1);

        return base64_encode($sign);
    }
}
