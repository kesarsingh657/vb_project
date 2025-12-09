<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
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
        
        // Load Authentication plugin
        $this->addPlugin('Authentication');
    }

    public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
    {
        $service = new AuthenticationService();
        
        // Configure authentication service
        $service->setConfig([
            'unauthenticatedRedirect' => '/users/login',
            'queryParam' => 'redirect',
        ]);

        // Define login fields
        $fields = [
            'username' => 'username',
            'password' => 'password'
        ];

        // Load Password identifier (checks username/password)
        $service->loadIdentifier('Authentication.Password', [
            'fields' => $fields,
            'resolver' => [
                'className' => 'Authentication.Orm',
                'userModel' => 'Users',
            ],
        ]);

        // Load Session authenticator (keeps user logged in)
        $service->loadAuthenticator('Authentication.Session');
        
        // Load Form authenticator (handles login form)
        $service->loadAuthenticator('Authentication.Form', [
            'fields' => $fields,
            'loginUrl' => '/users/login',
        ]);

        return $service;
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Handle errors
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))
            
            // Serve static files (CSS, JS, images)
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))
            
            // Route URLs to controllers
            ->add(new RoutingMiddleware($this))
            
            // Parse request body (POST data)
            ->add(new BodyParserMiddleware())
            
            // Handle authentication
            ->add(new AuthenticationMiddleware($this))
            
            // CSRF protection
            ->add(new CsrfProtectionMiddleware([
                'httponly' => true,
            ]));

        return $middlewareQueue;
    }
}