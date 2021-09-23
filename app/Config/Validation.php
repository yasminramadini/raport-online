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
      
      public $sekolah = [
        'nama' => 'alpha_numeric_space',
        'logo' => 'max_size[logo,2048]|max_dims[logo,1000,1000]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]'
        ];
        
      public $sekolah_errors = [
        'nama' => [
          'alpha_numeric_space' => 'Nama sekolah tidak valid',
          ],
        'logo' => [
          'max_size' => 'Ukuran logo maksimal 2MB',
          'max_dims' => 'Dimensi logo maksimal 1000px x 1000px',
          'mime_in' => 'Ekstensi Gambar tidak valid',
          'is_image' => 'Yang anda upload bukan gambar'
          ]
        ];
    //--------------------------------------------------------------------
}
