

 	

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



## Esquema Global Bases De Datos

![img](https://i.imgur.com/SUtazk5.png)

## Tabla Users (Usuarios)

|                    |                                  |
| ------------------ | -------------------------------- |
| **id**             | int(10) unsigned **PK**          |
|                    |                                  |
| **name**           | varchar(255)                     |
| **lastname**       | varchar(255)                     |
| **username**       | varchar(255)                     |
| **slugname**       | varchar(255)                     |
| **email**          | varchar(255)                     |
| **telephone**      | varchar(255)                     |
| **website**        | varchar(255)                     |
| **about**          | varchar(255)                     |
| **avatar**         | varchar(255)                     |
| **sex**            | enum (male , female , other)     |
| **city**           | varchar(255)                     |
| **zip_code**       | varchar(255)                     |
| **password**       | varchar(255)                     |
| **status**         | enum (active , inactive , other) |
| **remember_token** | varchar(100)                     |
| **created_at**     | Timestamp                        |
| **updated_at**     | Timestamp                        |

- 1 Usuario tiene N Comentarios **1-N**

- 1 Usuario tiene N Casas **1-N**

- 1 Usuario tiene N Reservas **1-N**

- 1 Usuario tiene 1 foto **1-1**

- 1 Usuario tiene N logins **1-N**

  ​

  ​

## Tabla User_images

|               |                                               |
| ------------- | --------------------------------------------- |
| **id**        | int(10) unsigned **PK**                       |
|               |                                               |
| **user_id**   | int(10) unsigned  **FK** references **Users** |
| **image_id**  | varchar(255)                                  |
| **image_url** | varchar(255)                                  |

- 1 Foto pertenece a 1 Usuario **1-1**

## Tabla Features (Caracteristicas)

|                |                         |
| -------------- | ----------------------- |
| **id**         | int(10) unsigned **PK** |
|                |                         |
| **slugname**   | varchar(256)            |
| **created_at** | Timestamp               |
| **updated_at** | Timestamp               |

- N Caracteristicas pertenecen a N Casas **N-N**

## Tabla Feature_house (Por la relación **N-N**)

|                         |                                                  |
| ----------------------- | ------------------------------------------------ |
| **house_id_feature_id** | **PK**                                           |
|                         |                                                  |
| **house_id**            | int(10) unsigned  **FK** references **Houses**   |
| **features_id**         | int(10) unsigned  **FK** references **Features** |

## Tabla Houses (Casas)

|                      |                                               |
| -------------------- | --------------------------------------------- |
| **id**               | int(10) unsigned **PK**                       |
|                      |                                               |
| **user_id**          | int(10) unsigned  **FK** references **Users** |
| **location**         | varchar(255)                                  |
| **direction**        | varchar(255)                                  |
| **images**           | varchar(255)                                  |
| **name**             | varchar(255)                                  |
| **slugname**         | varchar(255)                                  |
| **price_user_night** | double                                        |
| **rating**           | tinyInt(4)                                    |
| **max_users_house**  | tinyInt(4)                                    |
| **description**      | Text                                          |

- N Casas pertenecen a 1 Usuario **N-1**

- N Casas tienen N Caracteristicas **N-N**

- 1 Casa tiene N Reservas **1-N**

- 1 Casa tiene N Fotos **1-N**

- 1 Casa tiene N Comentarios **1-N**

  ​

## Tabla House_images

|               |                                                |
| ------------- | ---------------------------------------------- |
| **id**        | int(10) unsigned **PK**                        |
|               |                                                |
| **house_id**  | int(10) unsigned  **FK** references **Houses** |
| **image_id**  | varchar(255)                                   |
| **image_url** | varchar(255)                                   |

- 1 Foto pertenece a 1 Casa **1-1**

## Tabla Reserves(Reservas)

|                |                                                |
| -------------- | ---------------------------------------------- |
| **id**         | int(10) unsigned **PK**                        |
|                |                                                |
| **house_id**   | int(10) unsigned  **FK** references **Houses** |
| **user_id**    | int(10) unsigned  **FK** references **Users**  |
| **created_at** | Timestamp                                      |
| **updated_at** | Timestamp                                      |

- N Reservas pertenecen a 1 Usuario  **N-1**
- 1 Reserva pertenece a 1 Casa **1-1**

## Tabla Comments(Comentarios)

|                |                                                |
| -------------- | ---------------------------------------------- |
| **id**         | int(10) unsigned **PK**                        |
|                |                                                |
| **house_id**   | int(10) unsigned  **FK** references **Houses** |
| **user_id**    | int(10) unsigned  **FK** references **Users**  |
| **comment**    | text                                           |
| **created_at** | Timestamp                                      |
| **updated_at** | Timestamp                                      |

- N Comentarios pertenecen a 1 Usuario **N-1**
- 1 Comentario pertenece a 1 Casa **1-1**

## Tabla Logins

|                |                                               |
| -------------- | --------------------------------------------- |
| **id**         | int(10) unsigned **PK**                       |
|                |                                               |
| **agent**      | varchar(255)                                  |
| **ip**         | bigInt(20)                                    |
| **user_id**    | int(10) unsigned  **FK** references **Users** |
| **created_at** | Timestamp                                     |
| **updated_at** | Timestamp                                     |

- N Logins pertenecen a 1 usuario **N-1**