<?php

use Web3\Cli\Kernel;

beforeEach(function () {
    $this->app = Kernel::boot();
});

afterEach(function () {
    Kernel::terminate();
});

it('has a name', function () {
    $name = $this->app->getName();

    expect($name)->toBe('Web3');
});
