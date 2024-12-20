<?php

declare(strict_types=1);

namespace App\Modules\MaiExcellent\Integrations;

use App\Modules\MaiExcellent\Services\ApiService;
use Exception;

final class ApiAuthentication
{
    private const string URI_AUTHENTICATION = 'Integratiion/AgencyLogin';
    private const string TOKEN_NAME = 'token_maiExcellent';

    private static ApiService $apiService;
    private static string $username;
    private static string $password;


    public function connect(ApiService $apiService, $username, $password): ApiClient
    {
        $response = null;

        if (!$this->checkToken()) {
            $response = $apiService->send('GET', self::URI_AUTHENTICATION, ['query' => ['username' => $username, 'password' => $password]]);
            throw_if($response->unauthorized(), Exception::class, 'MAI Excellent: authorization error');
        }

        if ($response && $response->ok() && !$response->json()['ErrorType']) {
            $token = $response->cookies()->getCookieByName('.ASPXAUTH')->getValue();
            !empty($token) && $this->setToken('.ASPXAUTH=' . $token);
        }

        self::$apiService = $apiService;
        self::$username = $username;
        self::$password = $password;

        return new ApiClient($apiService);
    }

    static function getToken(): string
    {
        return session(self::TOKEN_NAME) ?: '';
    }

    private function setToken($token): void
    {
        session()->put('token_maiExcellent', $token);
    }

    private function checkToken(): bool
    {
        return (bool)session(self::TOKEN_NAME);
    }

    public function forgetToken(): void
    {
        session()->forget(self::TOKEN_NAME);
    }

    public function refreshToken(): bool
    {
        $this->forgetToken();
        $this->connect(self::$apiService, self::$username, self::$password);
        return $this->checkToken();
    }
}
