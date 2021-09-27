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
        'kepsek' => 'alpha_numeric_space',
        'logo' => 'max_size[logo,2048]|max_dims[logo,1000,1000]|mime_in[logo,image/png,image/jpg,image/jpeg]|is_image[logo]'
        ];
        
      public $sekolah_errors = [
        'nama' => [
          'alpha_numeric_space' => 'Nama sekolah tidak valid',
          ],
        'kepsek' => [
          'alpha_numeric_space' => 'nama kepala sekolah tidak valid'
          ],
        'logo' => [
          'max_size' => 'Ukuran logo maksimal 2MB',
          'max_dims' => 'Dimensi logo maksimal 1000px x 1000px',
          'mime_in' => 'Ekstensi Gambar tidak valid',
          'is_image' => 'Yang anda upload bukan gambar'
          ]
        ];
        
    public $tipe_ujian = [
      'nama' => 'required|alpha_numeric_space|is_unique[tipe_ujian.nama]'
      ];
      
    public $tipe_ujian_errors = [
      'nama' => [
        'required' => 'Tipe ujian wajib diisi',
        'alpha_numeric_space' => 'Tipe ujian tidak valid',
        'is_unique' => 'Tipe ujian sudah ada'
        ]
      ];
      
    public $siswa = [
      'nama' => 'required|alpha_numeric_space',
      'kelas' => 'required',
      'nis' => 'required|is_unique[siswa.nis]'
      ];
      
    public $siswa_errors = [
      'nama' => [
        'required' => 'Nama siswa wajib diisi',
        'alpha_numeric_space' => 'Nama siswa tidak valid'
        ],
      'kelas' => [
        'required' => 'Kelas wajib diisi'
        ],
      'nis' => [
        'required' => 'NIS wajib diisi',
        'is_unique' => 'NIS sudah dipakai'
        ]
      ];
      
    public $update_siswa = [
      'nama' => 'required|alpha_numeric_space',
      'kelas' => 'required',
      'nis' => 'required'
      ];
      
    public $update_siswa_errors = [
      'nama' => [
        'required' => 'Nama siswa wajib diisi',
        'alpha_numeric_space' => 'Nama siswa tidak valid'
        ],
      'kelas' => [
        'required' => 'Kelas wajib diisi'
        ],
      'nis' => [
        'required' => 'NIS wajib diisi',
        ]
      ];
      
    public $raport = [
      'thn_pelajaran' => 'required|alpha_numeric_punct',
      'sakit' => 'integer',
      'izin' => 'integer',
      'alfa' => 'integer'
      ];
      
    public $raport_errors = [
      'thn_pelajaran' => [
        'required' => 'tahun pelajaran wajib diisi',
        'alpha_numeric_punct' => 'tahun pelajaran tidak valid'
        ],
      'sakit' => [
        'integer' => 'jumlah sakit harus angka',
        ],
      'izin' => [
        'integer' => 'jumlah izin harus angka'
        ],
      'alfa' => [
        'integer' => 'jumlah alfa harus angka'
        ]
      ];
      
    public $login = [
      'username' => 'required',
      'password' => 'required',
      ];
      
    public $login_errors = [
      'username' => [
        'required' => 'username wajib'
        ],
      'password' => [
        'required' => 'password wajib diisi'
        ],
      ];
      
    public $register = [
      'username' => 'required|alpha|is_unique[user.username]|max_length[10]|min_length[3]',
      'password' => 'required|min_length[8]',
      'confirmPassword' => 'required|matches[password]',
      'email' => 'required|valid_emails|is_unique[user.email]'
      ];
      
    public $register_errors = [
      'username' => [
        'required' => 'username wajib diisi',
        'alpha' => 'username hanya boleh huruf tanpa spasi',
        'is_unique' => 'username sudah dipakai',
        'max_length' => 'username maksimal 10 huruf',
        'min_length' => 'username minimal 3 huruf'
        ],
      'password' => [
        'required' => 'password wajib diisi',
        'min_length' => 'password minimal 8 karakter'
        ],
      'confirmPassword' => [
        'required' => 'konfirmasi password wajib diisi',
        'matches' => 'konfirmasi password tidak sama'
        ],
      'email' => [
        'required' => 'email wajib diisi',
        'valid_emails' => 'email tidak valid',
        'is_unique' => 'email sudah dipakai'
        ]
      ];
    //--------------------------------------------------------------------
}
