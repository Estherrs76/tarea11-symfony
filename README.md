# Tarea11-Symfony


## Crear Poyecto

```console
cd /var/www/html
symfony new tarea11-symfony --version="7.1.*" --webapp
cd tarea11-symfony/
```


## Dependencias

```console
composer require --dev symfony/maker-bundle
composer require twig
composer require symfony/orm-pack
composer require symfony/form
```


## BBDD
```console

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate

- drop -> Eliminas la bbdd
- create -> Creas la bbdd
- migrate -> Introduces tablas
```

## Controladores
```console
php bin/console make:controller Coches
php bin/console make:controller Tipos
```

## Endpoints(Enrutamiento)
http://localhost:8000/tipos/insertar/electrico
http://localhost:8000/tipos/insertar/hibrido-enchufable
http://localhost:8000/tipos/insertar/hibrido
http://localhost:8000/coches/insertar-coches
http://localhost:8000/coches/ver-cochesJSON
http://localhost:8000/coches/ver-coches
http://localhost:8000/coches/cambia-coche/1/2024/48000.50
http://localhost:8000/coches/elimina-coche/3


```