### CLICKLOGIQ TEST TASK

## Installation

### Declare Docker network
```bash
docker network create -d bridge --subnet 192.168.81.0/24 --gateway 192.168.81.1 clicklogiq_backend
```

### Docker Up
```bash
docker-compose up -d
```

### Composer install
```bash
./composer.sh install
```

## Development

### Web address
[http://localhost:8810/](http://localhost:8810/)

### Console commands
```bash
./console.sh --help
```

### Doctrine migrations
```bash
./console.sh do:mi:mi --no-interaction
```

### Doctrine schema diff
```bash
./console.sh do:mi:di --no-interaction
```

### PostgreSQL
```yaml
Host: 127.0.0.1
Port: 5810
User: developer
Pass: password
```


### X-Debug configuration
1. Configure server with name docker and setup a path-mapping to /usr/src/app
2. Listen to port 9810

## Tests

### Generate JWT keys
```bash
openssl req -newkey rsa:2048 -new -nodes -x509 -days 3650 -keyout "var/test-jwt-private.key" -out "var/test-jwt-certificate.pem"
```
```bash
sudo chown www-data:www-data var/jwt-private.key
```

### Behat
```bash
./behat.sh features
```

### PHPUnit
```bash
./phpunit.sh tests/
```
