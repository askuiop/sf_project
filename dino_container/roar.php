<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/28
 * Time: 15:52
 */

namespace Dino\Play;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
#use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
#use Symfony\Component\DependencyInjection\Reference;

require __DIR__.'/../vendor/autoload.php';

$start = microtime(true);

$cachedContainer = __DIR__.'/cached_container.php';
if (!file_exists($cachedContainer)) {


  $container = new ContainerBuilder();

  $container->setParameter('root_dir', __DIR__);

  $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
  $loader->load('service.yml');

  /*
  $loggerDefinition = new Definition('Monolog\Logger');
  $loggerDefinition->setArguments(array(
    'main',
    array(new Reference('logger.stream_handler')),
  ));
  $loggerDefinition->addMethodCall('debug',array(
    'debugxxxx'
  ));
  $container->setDefinition('logger', $loggerDefinition);
  */

  /*
  $handlerDefinition = new Definition('Monolog\Handler\StreamHandler');
  $handlerDefinition->setArguments(array(
    __DIR__.'/dino.log',
  ));
  $container->setDefinition('logger.stream_handler', $handlerDefinition);
  */

  /*
  $handlerDefinition2 = new Definition('Monolog\Handler\StreamHandler');
  $handlerDefinition2->setArguments(array(
    'php://stdout',
  ));
  $container->setDefinition('logger.std_out_handler', $handlerDefinition2);*/

  $container->compile();

  $dumper = new PhpDumper($container);
  file_put_contents(__DIR__ . '/cached_container.php', $dumper->dump());
} else {
  require $cachedContainer;
  $container = new \ProjectServiceContainer();
}



$elapsed = round((microtime(true) - $start) * 1000);
$container->get('logger')->debug('Elapsed Time: '.$elapsed.'ms');
