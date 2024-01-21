<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedTraitsFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths(
        [
            __DIR__ . '/src',
             __DIR__ . '/tests'
        ],
    )
    ->withRules(
        [
            NoUnusedImportsFixer::class,
            OrderedClassElementsFixer::class,
            OrderedTraitsFixer::class,
        ]
    )
    ->withPreparedSets(
        arrays: true,
        comments:true,
        docblocks: true,
        namespaces: true,
        psr12: true
    )
    ->withConfiguredRule(
        ClassDefinitionFixer::class,
        [
            'space_before_parenthesis' => true,
        ],
    );
