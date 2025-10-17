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
use Cake\Routing\Router;
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

        $this->addPlugin('CakePdf');
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
    $authenticationService = new AuthenticationService([
        'unauthenticatedRedirect' => Router::url('/login'),
        'queryParam' => 'redirect',
    ]);

    // Load identifiers with detailed configuration
    $authenticationService->loadIdentifier('Authentication.Password', [
        'fields' => [
            'username' => 'username',
            'password' => 'password',
        ],
        'resolver' => [
            'className' => 'Authentication.Orm',
            'userModel' => 'Admins',
            'finder' => 'all'  // add this line
        ],
        'passwordHasher' => [
            'className' => 'Authentication.Default'
        ]
    ]);

    // Load Session authenticator first
    $authenticationService->loadAuthenticator('Authentication.Session', [
        'fields' => [
            'username' => 'username',
        ],
        'identify' => true
    ]);

    // Load Form authenticator
    $authenticationService->loadAuthenticator('Authentication.Form', [
        'fields' => [
            'username' => 'username',
            'password' => 'password',
        ],
        'loginUrl' => Router::url('/login'),
    ]);

    return $authenticationService;
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