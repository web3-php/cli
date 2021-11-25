<?php

use Symfony\Component\Console\Output\BufferedOutput;
use function Termwind\renderUsing;
use Web3\Cli\Support\View;

beforeEach(function () {
    $this->output = new BufferedOutput();

    renderUsing($this->output);
});

afterEach(function () {
    $this->output->fetch();

    renderUsing(null);
});

it('renders views', function () {
    View::render('alert', [
        'bg'          => 'blue',
        'title'       => 'My title',
        'description' => 'My description',
    ]);

    expect($this->output->fetch())->toContain("MY TITLE  \e[1mMy description\e[0m");
});

it('renders info labels', function () {
    View::info('My title', 'My description');

    expect($this->output->fetch())->toContain("MY TITLE  \e[1mMy description\e[0m");
});

it('renders error labels', function () {
    View::error('My title', 'My description');

    expect($this->output->fetch())->toContain("MY TITLE  \e[1mMy description\e[0m");
});
