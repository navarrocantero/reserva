

 	

# Reserving

### Tecnologias Utilizadas

- Laravel 5.5
- Bootstrap 4.0
- PHP 7.0
- JavaScript 1.6
- Html-5
- Eloquent

### Manual de instalacion



- Instalar Homestead siguiendo el siguiente [tutorial](https://laravel.com/docs/5.6/homestead) :

- Instala Composer siguiendo el siguiente  [tutorial](https://getcomposer.org/download/) : 

- Una vez tengas la maquina virtual funcionando localiza el archivo **Homestead.yaml**

- Clona  o descarga el proyecto en tu directorio y editas el archivo **Homestead.yaml** así :

  - keys:

    - La ruta de la key genera previamente 

        - /Users/MI-USUARIO/.ssh/id_rsa.pub

  -  folders:

    - map : El la ruta del directorio del archivo
    - to: Por defecto. no se modifica

        - map: /MI-DIRECTORIO
          to: /home/vagrant/code

  - sites:

    - map: Elige un dominio y agregalo al hosts del [sistema](https://support.rackspace.com/how-to/modify-your-hosts-file/) 
    - to: Por defecto. no se modifica

        - map: MI-DOMINIO.WEB
          to: /home/vagrant/code/public
        

- Dentro del directorio del proyecto localiza el archivo **.env.example** y renombralo a **.env**, es el archivo de configuracion de variables de entorno. Configurado para homestead, quedaria asi :

  - **.env**

    ```

    cd APP_NAME=Reserva
    APP_ENV=local
    APP_KEY=base64:UvVUOggrY/Xxk8dbHmJKmJHIEXhaSWRa3nZ1Vbh3cRU=
    APP_DEBUG=true
    APP_LOG_LEVEL=debug
    APP_URL=http://localhost

    DB_CONNECTION=mysql
    DB_HOST=192.168.10.10 MISMA IP QUE EN Homestead.yaml
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    QUEUE_DRIVER=sync

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null

    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=

    PUSHER_APP_CLUSTER=mt1



    ```

- En la carpeta Homestead arranca la maquina virtual con el comando

      vagrant -up --provision

- En la carpeta del proyecto instala las dependencias de composer con el comando 

  ```
  composer install
  ```

- Ya esta lista la aplicación para funcionar 

  - Ejecuta el comando **phpunit** para comprobar que este funcionando: 
    - ![Screenshot 2018-03-11 21.15.36](https://i.imgur.com/8C3lYUr.png)
  - Ejecuta el comando **php artisan migrate:refresh —seed** para cargar los datos de prueba
    - **Nota** Si se ejecuta sin la opcion **—seed** no cargara datos de prueba.
    - **Nota** Si el comando falla reintentarlo hasta que no de fallos
      - ![Screenshot 2018-03-11 21.17.29](https://i.imgur.com/RJxQOUj.png)	.