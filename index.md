![Image of social preview](https://repository-images.githubusercontent.com/268621114/57358980-a465-11ea-957a-95de816a149e)

### 🔥 Use template functionality and start to coding easly ⚡

 * Use this template to create your new public or private repository from [HERE](https://github.com/samirmh-dev/phalcon4-template/generate) or green button on top right side above. It will ready in a few seconds: ⚡

 ![image](https://user-images.githubusercontent.com/54883542/83452381-a5e52280-a469-11ea-9acb-967dd64eb483.png)

### 🔥 Super Fast start guide ⚡
 * clone `.env.example` to `.env`
 * set DB name, DB user and DB password on `.env`
 * clone `config.example.yml` to `config.yml` 
 * configure `config.yml` with your credentials
 * run `docker-compose up -d`
 * wait docker to complete build process ... it will take 10 or 15 minutes max
 * run `docker-compose exec app php composer.phar install` to install vendors
 * run `docker-compose exec app php composer.phar dump` to restart autoloader
 * go to `http://localhost:34423/` and enjoy the life :D 
 * feel free to Contribute, open Pull requests and add your bugs on [Issues](https://github.com/samirmh-dev/phalcon4-template/issues)

### 🔥 Important Rules ⚡
 * **Don't** use the real DB for Testing, instead use SqLite adapter for Unit Testing
 * **Don't** expose secrets on source code, instead use `config.yml`.
 * **Don't** forget to clone the new config variables to `example.config.yml` variable.
 * **Don't** forget to create migrations for the new tables.
 * **Don't** directly create Models, Controllers, Modules for application, instead use CLI commands to generate from stubs.

### 🔥 TODO ⚡

 * APCU
 * Redis 
 * ElasticSearch Client
 * Models
 * Middleware
 * Migrations
 * Storage
 * fatal error catching to sentry
 * Stubs for CLI creation
 * Add some common tasks (clear cache, clear session and etc.)

### 🔥 System Requirements ⚡
 * Docker installed on your machine (Docker desktop or / Docker for linux)
 * Min: 1GB ram

### 🔥 Helper definitions ⚡

 * ````app()```` returns current application instance.
 * ````app()->getRootPath()```` returns the full base path of root directory (for ex: `/home/api/www/`).
 * ````app()->getRootPath('routes')```` returns the full base path of given directory (for ex: `/home/api/www/routes`).
 * ````app()->environment()```` returns current application environment (defined in `config.yml`).
 * ````app()->environment('test-env'')```` returns **TRUE** if given environment (`test-env`) is equals to application environment. 
 * ````di()```` returns default DI instance
 * ````logger()```` writes given log to daily log file located at `logs` folder
    * `logger()->error('...')` 
    * `logger()->debug('...')`
    * ... 
 * ````config()```` returns all configurations defined on `config.yml`
 * ````config('env')```` returns specified key from a config. Another nested usage:  
    * `config('dirs.tmp)` returns `tmp` directory for application 
 * ````encrypt()```` returns safe encrypted version of given text with the key specified on `config.yml`. This will work only used key. You can lose access to raw data if you change app key in the config.yml. Usage: 
    * `encrypt('test')` returns `1A49a9cig2tYX+949MKe0RECF2JyI0AHoBKnRvyleIQ=`
 * ````decrypt()```` returns safe decrypted version of given text with the key specified on `config.yml`. This will work only used key. You can lose access to raw data if you change app key in the config.yml. Usage: 
    * `decrypt('1A49a9cig2tYX+949MKe0RECF2JyI0AHoBKnRvyleIQ=')` returns `test`
 * ````session()```` returns session instance. Usage: 
    * `session()->set('test-key','test-value)` void method. Don't wait something.
    * `session()->get('test-key')` returns `test`
    * `session()->has('test-key')` returns **TRUE**|**FALSE** related to existence of key `test-key`


### 🔥 Tricks ⚡

 * How to disable **exception reporting** to **Sentry**? 
    * Open specific exception class and override `public bool $sentry = FALSE;` property 
 * How to regenerate loaded class (sometimes it happens that some classes not getting recognized)?
    * `php composer.phar dump`
 * How to update composer packages? (recommended doing it weakly)?
    * `php composer.phar update`
 * How to install only production required packages? (don't recommended installing development packages on production)?
    * `php composer.phar update --no-dev`
 * How to run all PHPUnit tests?
    * `vendor/bin/phpunit ./tests`
 * How to run specific PHPUnit test?
     * `vendor/bin/phpunit ./tests/ExampleTest --filter=test_example_action_response`    
 * How to run task with specific action?
     *  `php task \\App\\Example\\Task\\Example example`   

### 🔥 Example responses ⚡ 

 * Example 404 response JSON:
 ````json
{
    "status": "exception",
    "code": 404,
    "message": "This request isn't handled by our resources.",
    "data": {},
    "rat": "2020-06-01T19:10:38+00:00",
    "trace": null
}
````

 * Example 200 response JSON:
````json
{
    "status": "success",
    "code": 200,
    "message": "Everything working!",
    "data": {},
    "rat": "2020-06-01T19:43:53+00:00",
    "trace": null
}
````
