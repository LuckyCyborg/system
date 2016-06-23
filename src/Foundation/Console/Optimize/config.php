<?php

$basePath = $app['path.base'];

return array_map('realpath', array(
    $basePath .'/vendor/nova-framework/system/src/Container/Container.php',
    $basePath .'/vendor/symfony/http-kernel/Symfony/Component/HttpKernel/HttpKernelInterface.php',
    $basePath .'/vendor/symfony/http-kernel/Symfony/Component/HttpKernel/TerminableInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Contracts/ResponsePreparerInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Foundation/Application.php',
    $basePath .'/vendor/nova-framework/system/src/Foundation/EnvironmentDetector.php',
    $basePath .'/vendor/nova-framework/system/src/Http/Request.php',
    $basePath .'/vendor/nova-framework/system/src/Http/FrameGuard.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Request.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/ParameterBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/FileBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/ServerBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/HeaderBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Session/SessionInterface.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Session/SessionBagInterface.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Session/Attribute/AttributeBagInterface.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Session/Attribute/AttributeBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Session/Storage/MetadataBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/AcceptHeaderItem.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/AcceptHeader.php',
    $basePath .'/vendor/symfony/debug/Symfony/Component/Debug/ExceptionHandler.php',
    $basePath .'/vendor/nova-framework/system/src/Support/ServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Exception/ExceptionServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Routing/RoutingServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Events/EventServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Facades/Facade.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Str.php',
    $basePath .'/vendor/symfony/debug/Symfony/Component/Debug/ErrorHandler.php',
    $basePath .'/vendor/symfony/http-kernel/Symfony/Component/HttpKernel/Debug/ErrorHandler.php',
    $basePath .'/vendor/nova-framework/system/src/Config/Repository.php',
    $basePath .'/vendor/nova-framework/system/src/Support/NamespacedItemResolver.php',
    $basePath .'/vendor/nova-framework/system/src/Config/FileLoader.php',
    $basePath .'/vendor/nova-framework/system/src/Config/LoaderInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Config/EnvironmentVariablesLoaderInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Config/FileEnvironmentVariablesLoader.php',
    $basePath .'/vendor/nova-framework/system/src/Config/EnvironmentVariables.php',
    $basePath .'/vendor/nova-framework/system/src/Filesystem/Filesystem.php',
    $basePath .'/vendor/nova-framework/system/src/Foundation/AliasLoader.php',
    $basePath .'/vendor/nova-framework/system/src/Foundation/ProviderRepository.php',
    $basePath .'/vendor/nova-framework/system/src/Cookie/CookieServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Database/DatabaseServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Encryption/EncryptionServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Filesystem/FilesystemServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Session/SessionServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/View/ViewServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Routing/Router.php',
    $basePath .'/vendor/nova-framework/system/src/Routing/Route.php',
    $basePath .'/vendor/nova-framework/system/src/Routing/Matching/UriValidator.php',
    $basePath .'/vendor/nova-framework/system/src/Workbench/WorkbenchServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Events/Dispatcher.php',
    $basePath .'/vendor/nova-framework/system/src/Database/ORM/Model.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Contracts/ArrayableInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Contracts/JsonableInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Database/DatabaseManager.php',
    $basePath .'/vendor/nova-framework/system/src/Database/ConnectionResolverInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Database/Connectors/ConnectionFactory.php',
    $basePath .'/vendor/nova-framework/system/src/Session/Middleware.php',
    $basePath .'/vendor/nova-framework/system/src/Session/Store.php',
    $basePath .'/vendor/nova-framework/system/src/Session/SessionManager.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Manager.php',
    $basePath .'/vendor/nova-framework/system/src/Cookie/CookieJar.php',
    $basePath .'/vendor/nova-framework/system/src/Cookie/Guard.php',
    $basePath .'/vendor/nova-framework/system/src/Cookie/Queue.php',
    $basePath .'/vendor/nova-framework/system/src/Encryption/Encrypter.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Facades/Log.php',
    $basePath .'/vendor/nova-framework/system/src/Log/LogServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/Log/Writer.php',
    $basePath .'/vendor/monolog/monolog/src/Monolog/Logger.php',
    $basePath .'/vendor/psr/log/Psr/Log/LoggerInterface.php',
    $basePath .'/vendor/monolog/monolog/src/Monolog/Handler/AbstractHandler.php',
    $basePath .'/vendor/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php',
    $basePath .'/vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php',
    $basePath .'/vendor/monolog/monolog/src/Monolog/Handler/RotatingFileHandler.php',
    $basePath .'/vendor/monolog/monolog/src/Monolog/Handler/HandlerInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Facades/App.php',
    $basePath .'/vendor/nova-framework/system/src/Exception/ExceptionDisplayerInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Exception/WhoopsDisplayer.php',
    $basePath .'/vendor/nova-framework/system/src/Exception/Handler.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Facades/Route.php',
    $basePath .'/vendor/nova-framework/system/src/Template/Factory.php',
    $basePath .'/vendor/nova-framework/system/src/View/Factory.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Contracts/MessageProviderInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Support/MessageBag.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Facades/View.php',
    $basePath .'/vendor/nova-framework/system/src/Support/Contracts/RenderableInterface.php',
    $basePath .'/vendor/nova-framework/system/src/Template/TemplateServiceProvider.php',
    $basePath .'/vendor/nova-framework/system/src/View/View.php',
    $basePath .'/vendor/nova-framework/system/src/View/Factory.php',
    $basePath .'/vendor/nova-framework/system/src/View/View.php',
    $basePath .'/vendor/nova-framework/system/src/View/ViewServiceProvider.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Response.php',
    $basePath .'/vendor/nova-framework/system/src/Http/Response.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/ResponseHeaderBag.php',
    $basePath .'/vendor/symfony/http-foundation/Symfony/Component/HttpFoundation/Cookie.php',
    $basePath .'/vendor/filp/whoops/src/Whoops/Run.php',
    $basePath .'/vendor/filp/whoops/src/Whoops/Handler/HandlerInterface.php',
    $basePath .'/vendor/filp/whoops/src/Whoops/Handler/Handler.php',
    $basePath .'/vendor/filp/whoops/src/Whoops/Handler/PrettyPageHandler.php',
    $basePath .'/vendor/filp/whoops/src/Whoops/Handler/JsonResponseHandler.php',
    $basePath .'/vendor/stack/builder/src/Stack/Builder.php',
    $basePath .'/vendor/stack/builder/src/Stack/StackedHttpKernel.php',
));
