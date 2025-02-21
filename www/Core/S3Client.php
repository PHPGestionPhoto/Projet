<?php
namespace App\Core;

class S3Client
{
    private $endpoint;
    private $region;
    private $accessKey;
    private $secretKey;

    public function __construct()
    {
        $this->endpoint = $_ENV['CURRENT_URL'].':4566';
        $this->region = $_ENV['S3_REGION'];
        $this->accessKey = $_ENV['S3_KEY'];
        $this->secretKey = $_ENV['S3_SECRET'];
    }

    private function request($method, $bucket, $key, $body = null)
    {
        $url = "{$this->endpoint}/{$bucket}/{$key}";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($body) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        $headers = [
            'Content-Type: application/octet-stream',
            'Authorization: AWS ' . $this->accessKey . ':' . $this->secretKey,
            'x-amz-date: ' . gmdate('Ymd\THis\Z'),
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);
        return $response;
    }

    public function upload($key, $body)
    {
        return $this->request('PUT', 'website-data', $key, $body);
    }

    public function delete($bucket, $key)
    {
        return $this->request('DELETE', $bucket, $key);
    }

    public function getObject($bucket, $key)
    {
        return $this->request('GET', $bucket, $key);
    }

    public function getObjectUrl($bucket, $key)
    {
        return "{$this->endpoint}/{$bucket}/{$key}";
    }
}