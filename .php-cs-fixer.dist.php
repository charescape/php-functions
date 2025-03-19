<?php

declare(strict_types=1);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP84Migration' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'yoda_style' => false,
        'concat_space' => ['spacing' => 'one'],
        'nullable_type_declaration' => ['syntax' => 'union'],
        'single_quote' => false,
        'fopen_flags' => ['b_mode' => true],
        'ordered_class_elements' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->files()
            ->name('*.php')
            ->in(__DIR__ . '/app/Http/Controllers')
    );
