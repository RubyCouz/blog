<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $content = [
        'content_title' => [
            'rules' => 'required|regex_match[/^[\s\w\d\?\!\.\,\@\#\$\%\&\(\)\-\_\=\+\^\*\;\:\'\"\~\`\/]+$/]',
            'errors' => [
                'required' => 'Vous devez remplir ce champs',
                'regex_match' => 'Des caractères ne sont pas pris en charge'
            ],
        ],
        'content_text' => [
            'rules' => 'required|regex_match[/^[\s\w\d\?\!\.\,\@\#\$\%\&\(\)\-\_\=\+\^\*\;\:\'\"\~\`\/]+$/]',
            'errors' => [
                'required' => 'Vous devez remplir ce champs',
                'regex_match' => 'Des caractères ne sont pas pris en charge'
            ]
        ],

    ];
   
}
