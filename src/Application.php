<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Psr\Http\Message\ServerRequestInterface;

class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    public function bootstrap(): void
    {
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        // Only load plugins if they haven't been loaded already
        if (!$this->getPlugins()->has('Authentication')) {
            $this->addPlugin('Authentication');
        }

        if (Configure::read('debug') && !$this->getPlugins()->has('DebugKit')) {
            $this->addPlugin('DebugKit');
        }
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            ->add(new AssetMiddleware())
            ->add(new RoutingMiddleware($this))
            ->add(new BodyParserMiddleware())
            ->add(new AuthenticationMiddleware($this));

        return $middlewareQueue;
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService();

        // Define where users should be redirected to when they are not authenticated
        $service->setConfig([
            'unauthenticatedRedirect' => '/admins/login',
            'queryParam' => 'redirect',
        ]);

        // Load the authenticators
        $service->loadAuthenticator('Authentication.Session');
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => [
                'username' => 'username',
                'password' => 'password',
            ],
            'loginUrl' => '/admins/login',
        ]);

        // Configure password check and user source
        $service->loadIdentifier('Authentication.Password', [
            'resolver' => [
                'className' => 'Authentication.Orm',
                'userModel' => 'Admins',
            ],
            'fields' => [
                'username' => 'username',
                'password' => 'password',
            ],
        ]);

        return $service;
    }

    protected function bootstrapCli(): void
    {
        try {
            $this->addPlugin('Bake');
        } catch (\Exception $e) {
            // Do nothing if the plugin is missing
        }

        $this->addPlugin('Migrations');
    }
}