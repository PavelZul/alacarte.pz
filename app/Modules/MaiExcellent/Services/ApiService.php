<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Services;

use App\Modules\MaiExcellent\Integrations\ApiAuthentication;
use App\Modules\MaiExcellent\Integrations\ApiClient;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\RequestInterface;

final readonly class ApiService
{
    private string $baseUrl;

    public function __construct(private ApiAuthentication  $authentication)
    {
        $this->baseUrl = config('services.maiExcellent.url');
    }

    public function authentication($username, $password): ApiClient
    {

        return $this->authentication->connect($this, $username, $password);
    }

    public function forgetToken(): void
    {
        $this->authentication->forgetToken();
    }

    public function send($method, $uri, $options = []): Response
    {
        $token = $this->authentication->getToken();

        $response = Http::withRequestMiddleware(function (RequestInterface $request) use ($token) {
            return $token
                ? $request->withHeader('COOKIE', $token)
                : $request;
        })->send($method, $this->baseUrl . $uri, $options);

        $response->unauthorized() && $this->authentication->refreshToken() && $response = $this->send($method, $uri, $options);

        return $response;
    }
}
