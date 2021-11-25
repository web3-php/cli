<?php

use Web3\Cli\Support\DB;

beforeEach(fn () => DB::boot());

afterEach(fn () => DB::flush());

it('gets nullable values', function () {
    expect(DB::get('foo'))->toBeNull();
});

it('sets values', function () {
    DB::set('foo', 'bar');

    expect(DB::get('foo'))->toBe('bar');
});
