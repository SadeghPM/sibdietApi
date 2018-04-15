<?php

namespace SadeghPM\Sibdiet;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use SadeghPM\Sibdiet\Exception\SibdietException;
use Tightenco\Collect\Support\Collection;

class SibdietApi
{
    const BASE_URI = "http://sibdiet.net/webservice/";
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->client = new Client(
            [
                'base_uri'                      => self::BASE_URI,
                RequestOptions::ALLOW_REDIRECTS => true,
                RequestOptions::TIMEOUT         => 5,
            ]
        );
        $this->apiKey = $apiKey;
    }

    /**
     * get user profile
     *
     * @param null $siteId
     * @param null $mobile
     *
     * @return Collection
     *
     * @throws RequestException
     * @throws SibdietException
     */
    public function getUserProfile($siteId, $mobile)
    {
        $profile = $this->client->get(
            $this->prepareGet(
                'profile', ['p' => $siteId, 'm' => $mobile]
            )
        );

        return $this->makeResult($profile);
    }

    private function prepareGet($function, $data)
    {
        return sprintf('get/sibdiet3/%s?api_key=%s&%s', $function, $this->apiKey, http_build_query($data));
    }

    /**
     * @param $response
     *
     * @return Collection
     * @throws SibdietException
     */
    public function makeResult(ResponseInterface $response)
    {
        $result = Collection::make(json_decode((string)$response->getBody(), true));
        $isOk = $result->get('status', 'ko') != 'ko';

        if ($isOk) {
            return $result;
        } else {
            throw new SibdietException(
                $result->get('error_description', 'NO_DESCRIPTION').".[".$result->get(
                    'error_code', 'NO_CODE'
                )."]"
            );
        }
    }

    /**
     * get user diet list
     *
     * @param  $siteId
     * @param  $mobile
     *
     * @return Collection
     *
     * @throws RequestException if connection error
     * @throws SibdietException any sibdiet error
     */
    public function getUserDiets($siteId, $mobile)
    {
        $diets = $this->client->request('get', $this->prepareGet('diets', ['p' => $siteId, 'm' => $mobile]));

        return $this->makeResult($diets);
    }

    /**
     * get user last diet
     *
     * @param null $siteId
     * @param null $mobile
     * @param null $dietId
     *
     * @return Collection
     *
     * @throws SibdietException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserLastDiet($siteId, $mobile, $dietId = null)
    {
        $diet = $this->client->request(
            'get', $this->prepareGet('diet', ['p' => $siteId, 'm' => $mobile, 'd' => $dietId])
        );

        return $this->makeResult($diet);
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}