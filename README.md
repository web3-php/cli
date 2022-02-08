<p align="center">
    <img src="https://raw.githubusercontent.com/web3-php/art/master/cli-without-bg.png" width="600" alt="Web3 PHP">
    <p align="center">
        <a href="https://github.com/web3-php/cli/actions"><img alt="GitHub Workflow Status (master)" src="https://img.shields.io/github/workflow/status/web3-php/cli/tests/master"></a>
        <a href="https://packagist.org/packages/web3-php/cli"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/web3-php/cli"></a>
        <a href="https://packagist.org/packages/web3-php/cli"><img alt="Latest Version" src="https://img.shields.io/packagist/v/web3-php/cli"></a>
        <a href="https://packagist.org/packages/web3-php/cli"><img alt="License" src="https://img.shields.io/packagist/l/web3-php/cli"></a>
    </p>
</p>

------
**Web3 PHP CLI** is a blazing fast blockchain server for local development.

> This project is a work-in-progress. Code and documentation are currently under development and are subject to change.

## Get Started

> **Requires [PHP 8.0+](https://php.net/releases/)**

First, install Web3 via the [Composer](https://getcomposer.org/) package manager:

```bash
composer global config prefer-stable true
composer global config minimum-stability dev
composer global require web3-php/cli
```

Then, start the local blockchain server:

```
web3
```

## Options

### `accounts`

The `accounts` option allows to specify the number of accounts.

```bash
web3 --accounts=5 # Default: 5
```

### `host`

The `host` option allows to specify the hostname to listen on.

```bash
web3 --host=127.0.0.2 # Default: 127.0.0.1
```

### `port`

The `port` option allows to specify the port number to listen on.

```bash
web3 --port=8550 # Default: 8545
```

---

Web3 PHP CLI is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
