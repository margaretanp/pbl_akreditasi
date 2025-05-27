<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan kesalahan bawaan yang digunakan oleh
    | kelas validator. Beberapa aturan memiliki beberapa versi seperti aturan
    | ukuran. Jangan ragu untuk menyesuaikan setiap pesan di sini.
    |
    */

    'accepted'             => ':attribute harus diterima.',
    'accepted_if'          => ':attribute harus diterima ketika :other bernilai :value.',
    'active_url'           => ':attribute bukan URL yang valid.',
    'after'                => ':attribute harus tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'            => ':attribute hanya boleh berisi huruf dan angka.',
    'array'                => ':attribute harus berupa larik.',
    'ascii'                => ':attribute hanya boleh berisi karakter dan simbol alfanumerik satu byte.',
    'before'               => ':attribute harus tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'array'   => ':attribute harus memiliki :min sampai :max item.',
        'file'    => ':attribute harus berukuran antara :min dan :max kilobita.',
        'numeric' => ':attribute harus antara :min dan :max.',
        'string'  => ':attribute harus antara :min dan :max karakter.',
    ],
    'boolean'              => ':attribute harus bernilai true atau false.',
    'can'                  => ':attribute berisi nilai yang tidak diizinkan.',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'current_password'     => 'Kata sandi salah.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_equals'          => ':attribute harus tanggal yang sama dengan :date.',
    'date_format'          => ':attribute tidak cocok dengan format :format.',
    'decimal'              => ':attribute harus memiliki :decimal angka desimal.',
    'declined'             => ':attribute harus ditolak.',
    'declined_if'          => ':attribute harus ditolak ketika :other bernilai :value.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus :digits digit.',
    'digits_between'       => ':attribute harus antara :min dan :max digit.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => ':attribute memiliki nilai duplikat.',
    'doesnt_end_with'      => ':attribute tidak boleh diakhiri dengan salah satu dari: :values.',
    'doesnt_start_with'    => ':attribute tidak boleh dimulai dengan salah satu dari: :values.',
    'email'                => ':attribute harus alamat email yang valid.',
    'ends_with'            => ':attribute harus diakhiri dengan salah satu dari: :values.',
    'enum'                 => ':attribute yang dipilih tidak valid.',
    'exists'               => ':attribute yang dipilih tidak valid.',
    'extensions'           => ':attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file'                 => ':attribute harus berkas.',
    'filled'               => ':attribute harus memiliki nilai.',
    'gt'                   => [
        'array'   => ':attribute harus memiliki lebih dari :value item.',
        'file'    => ':attribute harus lebih besar dari :value kilobita.',
        'numeric' => ':attribute harus lebih besar dari :value.',
        'string'  => ':attribute harus lebih besar dari :value karakter.',
    ],
    'gte'                  => [
        'array'   => ':attribute harus memiliki :value item atau lebih.',
        'file'    => ':attribute harus lebih besar atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus lebih besar atau sama dengan :value.',
        'string'  => ':attribute harus lebih besar atau sama dengan :value karakter.',
    ],
    'hex_color'            => ':attribute harus warna heksadesimal yang valid.',
    'image'                => ':attribute harus gambar.',
    'in'                   => ':attribute yang dipilih tidak valid.',
    'in_array'             => ':attribute tidak terdapat pada :other.',
    'integer'              => ':attribute harus bilangan bulat.',
    'ip'                   => ':attribute harus alamat IP yang valid.',
    'ipv4'                 => ':attribute harus alamat IPv4 yang valid.',
    'ipv6'                 => ':attribute harus alamat IPv6 yang valid.',
    'json'                 => ':attribute harus string JSON yang valid.',
    'lowercase'            => ':attribute harus huruf kecil.',
    'lt'                   => [
        'array'   => ':attribute harus memiliki kurang dari :value item.',
        'file'    => ':attribute harus kurang dari :value kilobita.',
        'numeric' => ':attribute harus kurang dari :value.',
        'string'  => ':attribute harus kurang dari :value karakter.',
    ],
    'lte'                  => [
        'array'   => ':attribute tidak boleh lebih dari :value item.',
        'file'    => ':attribute harus kurang atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus kurang atau sama dengan :value.',
        'string'  => ':attribute harus kurang atau sama dengan :value karakter.',
    ],
    'mac_address'          => ':attribute harus alamat MAC yang valid.',
    'max'                  => [
        'array'   => ':attribute tidak boleh lebih dari :max item.',
        'file'    => ':attribute tidak boleh lebih dari :max kilobita.',
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'string'  => ':attribute tidak boleh lebih dari :max karakter.',
    ],
    'max_digits'           => ':attribute tidak boleh lebih dari :max digit.',
    'mimes'                => ':attribute harus berkas bertipe: :values.',
    'mimetypes'            => ':attribute harus berkas bertipe: :values.',
    'min'                  => [
        'array'   => ':attribute setidaknya harus memiliki :min item.',
        'file'    => ':attribute setidaknya harus :min kilobita.',
        'numeric' => ':attribute setidaknya harus :min.',
        'string'  => ':attribute setidaknya harus :min karakter.',
    ],
    'min_digits'           => ':attribute setidaknya harus memiliki :min digit.',
    'missing'              => ':attribute harus tidak ada.',
    'missing_if'           => ':attribute harus tidak ada ketika :other bernilai :value.',
    'missing_unless'       => ':attribute harus tidak ada kecuali :other bernilai :value.',
    'missing_with'         => ':attribute harus tidak ada ketika :values ada.',
    'missing_with_all'     => ':attribute harus tidak ada ketika :values ada.',
    'multiple_of'          => ':attribute harus kelipatan :value.',
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format :attribute tidak valid.',
    'numeric'              => ':attribute harus angka.',
    'password'             => [
        'letters'       => ':attribute harus mengandung setidaknya satu huruf.',
        'mixed'         => ':attribute harus mengandung huruf besar dan huruf kecil.',
        'numbers'       => ':attribute harus mengandung setidaknya satu angka.',
        'symbols'       => ':attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => ':attribute telah muncul dalam kebocoran data. Silakan pilih :attribute yang berbeda.',
    ],
    'present'              => ':attribute harus ada.',
    'present_if'           => ':attribute harus ada ketika :other bernilai :value.',
    'present_unless'       => ':attribute harus ada kecuali :other bernilai :value.',
    'present_with'         => ':attribute harus ada ketika :values ada.',
    'present_with_all'     => ':attribute harus ada ketika :values ada.',
    'prohibited'           => ':attribute dilarang.',
    'prohibited_if'        => ':attribute dilarang ketika :other bernilai :value.',
    'prohibited_unless'    => ':attribute dilarang kecuali :other berada di :values.',
    'prohibits'            => ':attribute melarang :other untuk ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => ':attribute wajib diisi.',
    'required_array_keys'  => ':attribute harus berisi entri untuk: :values.',
    'required_if'          => ':attribute wajib diisi ketika :other bernilai :value.',
    'required_if_accepted' => ':attribute wajib diisi ketika :other diterima.',
    'required_unless'      => ':attribute wajib diisi kecuali :other berada di :values.',
    'required_with'        => ':attribute wajib diisi ketika :values ada.',
    'required_with_all'    => ':attribute wajib diisi ketika :values ada.',
    'required_without'     => ':attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => ':attribute wajib diisi ketika tak satupun dari :values ada.',
    'same'                 => ':attribute dan :other harus sama.',
    'size'                 => [
        'array'   => ':attribute harus mengandung :size item.',
        'file'    => ':attribute harus berukuran :size kilobita.',
        'numeric' => ':attribute harus bernilai :size.',
        'string'  => ':attribute harus berjumlah :size karakter.',
    ],
    'starts_with'          => ':attribute harus dimulai dengan salah satu dari: :values.',
    'string'               => ':attribute harus berupa string.',
    'timezone'             => ':attribute harus zona waktu yang valid.',
    'unique'               => ':attribute sudah digunakan.',
    'uploaded'             => ':attribute gagal diunggah.',
    'uppercase'            => ':attribute harus huruf besar.',
    'url'                  => ':attribute harus URL yang valid.',
    'ulid'                 => ':attribute harus ULID yang valid.',
    'uuid'                 => ':attribute harus UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan
    | menggunakan konvensi "attribute.rule" untuk menamai baris. Ini memudahkan
    | penentuan pesan bahasa kustom untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan-kustom',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk mengganti placeholder atribut kami
    | dengan sesuatu yang lebih mudah dibaca, seperti "Alamat Email" daripada
    | "email". Ini hanya membantu membuat pesan kami lebih ekspresif.
    |
    */

    'attributes' => [],
];
