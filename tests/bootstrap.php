<?php

if (!@include __DIR__ . '/../vendor/.composer/autoload.php') {
    die(<<<'EOT'
You must set up the project dependencies, run the following commands:
wget http://getcomposer.org/composer.phar
php composer.phar install
EOT
    );
}

spl_autoload_register(function ($class) {
    if (0 === strpos(ltrim($class, '/'), 'Vespolina\Entity')) {
        if (file_exists($file = __DIR__.'/../lib/'.str_replace('\\', '/', $class.'.php'))) {
            require_once $file;
        }
    }
});

if (file_exists($loader = __DIR__.'/../vendor/autoload.php')) {
    require_once $loader;
}
