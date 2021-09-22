<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
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
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    public $kelas = [
      'nama' => 'required|alpha_numeric_punct|is_unique[kelas.nama]'
      ];
      
    public $kelas_errors = [
      'nama' => [
        'required' => '{field} wajib diisi',
        'alpha_numeric_punct' => '{field} tidak valid',
        'is_unique' => 'nama kelas sudah ada'
        ]
      ];
      
    public $mapel = [
      'nama' => 'required|alpha_numeric_punct|is_unique[mapel.nama]',
      'tipe' => 'required|alpha_numeric_space',
      'kkm' => 'required|integer'
      ];
      
    public $mapel_errors = [
      'nama' => [
        'required' => 'nama mapel wajib diisi',
        'alpha_numeric_punct' => 'nama mapel tidak valid',
        'is_unique' => 'nama mapel sudah ada'
        ],
      'tipe' => [
        'required' => 'tipe mapel wajib diisi',
        'alpha_numeric_space' => 'nama mapel tidak valid'
        ],
      'kkm' => [
        'required' => 'KKM wajib diisi',
        'integer' => 'KKM harus angka'
        ]
      ];
    //--------------------------------------------------------------------
}
