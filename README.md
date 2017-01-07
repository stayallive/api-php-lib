### PHP library for communicating with the Plesk XML-RPC API

## Install Via Composer

[Composer](https://getcomposer.org/) is a preferred way to install.

Run: `composer require stayallive/plesk-php-api:0.1.*` in your project.

## Usage Examples

Here is an example on how to use the library and create a customer with desired properties:

```php
$client = new \PleskX\Api\Client($host);
$client->setCredentials($login, $password);

$client->customer()->create([
    'cname'  => 'Plesk',
    'pname'  => 'John Smith',
    'login'  => 'john',
    'passwd' => 'secret',
    'email'  => 'john@smith.com',
]);
```

It is possible to use a secret key instead of password for authentication.

```diff
$client = new \PleskX\Api\Client($host);
-$client->setCredentials($login, $password);
+$client->setSecretKey($secretKey);
```

In case of Plesk extension creation one can use an internal mechanism to access XML-RPC API.
It does not require to pass authentication because the extension works in the context of Plesk.

```php
$client = new \PleskX\Api\InternalClient();
$protocols = $client->server()->getProtos();
```

For additional examples see `tests` directory.

## How to Run Unit Tests

One of the possible ways to become familiar with the library is to check the unit tests.

To run the unit tests use the following command:

```bash
REMOTE_HOST=your-plesk-host.dom REMOTE_PASSWORD=password ./vendor/bin/phpunit
```

To use custom port one can provide a URL (e.g. for Docker container):

```bash
REMOTE_URL=https://your-plesk-host.dom:port REMOTE_PASSWORD=password ./vendor/bin/phpunit`
```

You can start a Docker container for testing using:

```bash
docker run -d -it -p 8443:8443 plesk/plesk
```

After which the container is available on `http://localhost:8443` assuming you run Docker local and you can run:

```bash
REMOTE_URL=https://127.0.0.1:8443 REMOTE_PASSWORD=changeme ./vendor/bin/phpunit`
```

## Using Grunt for Continuous Testing

* Install Node.js
* Install dependencies via `npm install` command
* Run `REMOTE_HOST=your-plesk-host.dom REMOTE_PASSWORD=password grunt watch:test`
