<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
                           ->in([
                               __DIR__ . '/app',
                               __DIR__ . '/config',
                               __DIR__ . '/database/factories',
                               __DIR__ . '/database/seeders',
                               __DIR__ . '/routes',
                               __DIR__ . '/tests',
                           ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer:risky'                             => true,
        'blank_line_after_opening_tag'                  => true,
        'linebreak_after_opening_tag'                   => true,
        'declare_strict_types'                          => true,
        'no_superfluous_phpdoc_tags'                    => false,
        'global_namespace_import'                       => [
            'import_classes'   => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'ordered_imports'                               => [
            'sort_algorithm' => 'alpha',
            'imports_order'  => [
                'class',
                'function',
                'const',
            ],
        ],
        'no_unused_imports'                             => true,
        'phpdoc_types_order'                            => [
            'null_adjustment' => 'always_last',
            'sort_algorithm'  => 'none',
        ],
        'php_unit_test_case_static_method_calls'        => [
            'call_type' => 'this'
        ],
        'phpdoc_align'                                  => [
            'align' => 'left',
        ],
        'array_indentation'                             => true,
        'not_operator_with_successor_space'             => true,
        'blank_line_after_namespace'                    => true,
        //        'final_class'                                   => true,
        'date_time_immutable'                           => true,
        'declare_parentheses'                           => true,
        //        'final_public_method_for_abstract_class'        => true,
        'mb_str_functions'                              => true,
        'simplified_if_return'                          => true,
        'simplified_null_return'                        => true,
        'blank_line_before_statement'                   => true,
        'compact_nullable_typehint'                     => true,
        'concat_space'                                  => [
            'spacing' => 'one'
        ],
        'function_typehint_space'                       => true,
        'lowercase_cast'                                => true,
        'constant_case'                                 => true,
        'lowercase_keywords'                            => true,
        'method_argument_space'                         => [
            'after_heredoc'                    => false,
            'keep_multiple_spaces_after_comma' => false,
        ],
        'phpdoc_separation'                             => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'new_with_braces'                               => true,
        'no_empty_comment'                              => true,
        'no_empty_phpdoc'                               => true,
        'no_empty_statement'                            => true,
        'no_extra_blank_lines'                          => [
            'tokens' => ['extra']
        ],
        'no_leading_import_slash'                       => true,
        'no_leading_namespace_whitespace'               => true,
        'no_mixed_echo_print'                           => [
            'use' => 'echo'
        ],
        'no_multiline_whitespace_around_double_arrow'   => true,
        'no_spaces_after_function_name'                 => true,
        'no_spaces_inside_parenthesis'                  => true,
        'no_superfluous_elseif'                         => true,
        'no_useless_else'                               => true,
        'no_trailing_comma_in_list_call'                => true,
        'no_trailing_comma_in_singleline_array'         => true,
        'no_trailing_whitespace'                        => true,
        'no_unneeded_control_parentheses'               => [
            'statements' => ['break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield']
        ],
        'no_unneeded_curly_braces'                      => true,
        //        'no_unneeded_final_method'                      => true,
        'no_whitespace_before_comma_in_array'           => true,
        'no_whitespace_in_blank_line'                   => true,
        'trim_array_spaces'                             => true,
        'unary_operator_spaces'                         => true,
        'visibility_required'                           => true,
        'whitespace_after_comma_in_array'               => true,
        'binary_operator_spaces'                        => [
            'default' => 'align',
        ],
    ])
    ->setFinder($finder);
