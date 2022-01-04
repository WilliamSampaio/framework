# framework

Framework em PHP baseado no Slim Framework com algumas outras bibliotecas úteis.

## Deploy com Docker e Docker-Compose

Considerando que o repositório ja tenha sido clonado, basta executar o comando:

```bash
docker-compose up -d --build
```

## Atualizar composer

Execute o comando:

```bash
docker exec -it framework-apache-php composer install
```

Onde **framework-apache-php** se refere ao container em que o PHP se encontra.

## Migrações

O framework utiliza o [Phinx](https://phinx.org/) para as migrations.

Dentro da pasta _**api**_ contém o arquivo _**phinx.php**_ que é o arquivo de configuração da biblioteca.

Para executar a migração utilize o seguinte comando:

```bash
docker exec -it framework-apache-php vendor/bin/phinx migrate -c api/phinx.php
```

Mais informações e comandos consulte a [documentação oficial](https://book.cakephp.org/phinx/0/en/index.html).
