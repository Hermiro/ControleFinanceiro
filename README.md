## Instação XAMP no Linux.

Para utilizar a aplicação no ambiente Linux, recomendamos a utilização do pacote XAMPP.
Siga as instruções desta página(https://www.edivaldobrito.com.br/como-instalar-o-xampp-no-linux/) criada por Edivaldo Brito para maiores informações.

Em seguida, acesse o PHPMYADMIN dentro do XAMP e faça a importação do banco de dados, utilizando um dos arquivos disponíveis: teste_item.csv ou teste_item.sql

Por último, faça um clone ou baixe/descompacte esta aplicação dentro da pasta httdocs no XAMPP.

#Modo de utilização.

Acesse o endereço htttp:localhost/ControleFinanceiro-mains para visualizar a página de boas vindas padrão do cakephp.
Abaixo estão os endereços da API.

Visualizar o saldo de uma pessoa:
* htttp:localhost/ControleFinanceiro-mains/Pessoas/GetSaldoPessoa/1 (onde o numero indica o ID de uma pessoa).

Visualizar o histórico de uma pessoa:
* htttp:localhost/ControleFinanceiro-mains/Saldos/GetHistoric/1 (onde o numero indica o ID de uma pessoa).

Efetuar um débito na conta de uma pessoa:
* htttp:localhost/ControleFinanceiro-mains/Saldos/DoDebit/1/25 (onde o primeiro numero indica o ID de uma pessoa e o segundo numero indica o valor a ser debitado).

Efetuar um crédito na conta de uma pessoa:
* htttp:localhost/ControleFinanceiro-mains/Saldos/DoCredit/1/25 (onde o primeiro numero indica o ID de uma pessoa e o segundo numero indica o valor a ser creditado).

Efetuar uma transferência na conta de uma pessoa:
* htttp:localhost/ControleFinanceiro-mains/Saldos/DoTransfer/1/25/2 (onde o primeiro numero indica o ID de uma pessoa e o segundo numero indica o valor a ser creditado e o 
terceiro parâmetro é o receptor da transferência).

# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/github/workflow/status/cakephp/app/CakePHP%20App%20CI/master?style=flat-square)](https://github.com/cakephp/app/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 4.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit the environment specific `config/app_local.php` and setup the 
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.
