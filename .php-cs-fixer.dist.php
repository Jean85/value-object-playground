<?php

/*
 * Additional rules or rules to override.
 * These rules will be added to default rules or will override them if the same key already exists.
 */

$additionalRules = [
    'class_attributes_separation' => false,
    'declare_strict_types' => true,
    'indentation_type' => true,
    'phpdoc_to_comment' => false,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'no_superfluous_phpdoc_tags' => [
        'allow_mixed' => true,
    ],
];

$rulesProvider = new Facile\CodingStandards\Rules\CompositeRulesProvider([
    new Facile\CodingStandards\Rules\DefaultRulesProvider(),
    new Facile\CodingStandards\Rules\ArrayRulesProvider($additionalRules),
]);

$config = new PhpCsFixer\Config();
$config->setRiskyAllowed(true);
$config->setRules($rulesProvider->getRules());

$finder = new PhpCsFixer\Finder();

/*
 * You can set manually these paths:
 */
$autoloadPathProvider = new Facile\CodingStandards\AutoloadPathProvider();
$finder->in($autoloadPathProvider->getPaths());
$finder->name(__FILE__);

$config->setFinder($finder);

return $config;
