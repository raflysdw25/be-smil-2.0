<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute harus disetujui.',
    'active_url' => ':attribute bukanlah URL valid',
    'after' => ':attribute haruslah tanggal setelah :date',
    'after_or_equal' => ':attribute haruslah setelah atau sama dengan tanggal :date.',
    'alpha' => ':attribute hanya boleh mengandung alphabet',
    'alpha_dash' => ':attribute hanya boleh mengandung alphabet, angka,dash, dan underscore.',
    'alpha_num' => ':attribute hanya boleh mengandung alphabet dan angka.',
    'array' => ':attribute hanya boleh tipe array.',
    'before' => ':attribute haruslah tanggal sebelum :date',
    'before_or_equal' => ':attribute haruslah sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => 'Nilai :attribute haruslah berada diantara :min dan :max',
        'file' => 'Ukuran file :attribute haruslah berada diantara :min dan :max kilobytes',
        'string' => 'Jumlah kata :attribute haruslah diantara :min dan :max kata',
        'array' => 'Jumlah :attribute haruslah diantara :min dan :max item',
    ],
    'boolean' => 'Nilai :attribute haruslah true atau false',
    'confirmed' => 'Konfirmasi untuk :attribute tidaklah cocok',
    'date' => 'Format :attribute bukanlah format tanggal yang benar.',
    'date_equals' => 'Nilai :attribute harus sama dengan tanggal :date',
    'date_format' => 'Format pada :attribute tidak sesuai dengan format :format',
    'different' => 'Nilai :attribute dan nilai :other haruslah berbeda',
    'digits' => 'Nilai :attribute haruslah memiliki :digits digit',
    'digits_between' => 'Nilai :attribute haruslah berada diantara :min dan :max digit.',
    'dimensions' => 'Dimensi objek dari :attribute tidak sesuai',
    'distinct' => 'Terdapat nilai :attribute yang serupa',
    'email' => 'Nilai :attribute haruslah format email yang sesuai',
    'ends_with' => 'Nilai dari :attribute harus diakhiri dengan salah satu :values',
    'exists' => 'Nilai dari :attribute sudah tersimpan',
    'file' => 'Tipe :attribute haruslah sebuah file',
    'filled' => ':attribute harus diisi sebuah nilai',
    'gt' => [
        'numeric' => 'Nilai dari :attribute haruslah lebih besar dari :value',
        'file' => 'Ukuran dari file :attribute haruslah lebih besar dari :value kilobytes',
        'string' => ':attribute harus memiliki jumlah huruf lebih banyak dari :value huruf',
        'array' => ':attribute haruslah memiliki jumlah item lebih dari :value item',
    ],
    'gte' => [
        'numeric' => 'Nilai dari :attribute haruslah lebih besar atau sama dengan dari :value',
        'file' => 'Ukuran dari file :attribute haruslah lebih besar atau sama dengan dari :value kilobytes',
        'string' => ':attribute harus memiliki jumlah huruf lebih banyak dari atau sama dengan :value huruf',
        'array' => ':attribute haruslah memiliki jumlah item lebih dari atau sama dengan dari :value item.',
    ],
    'image' => ':attribute haruslah sebuah gambar',
    'in' => ':attribute tidak sesuai dengan pilihan yang tersedia',
    'in_array' => 'Nilai :attribute tidak tersedia pada :other',
    'integer' => 'Tipe dari :attribute haruslah sebuah integer',
    'ip' => 'Nilai :attribute haruslah IP Address yang sesuai',
    'ipv4' => 'Nilai :attribute haruslah IPv4 yang sesuai',
    'ipv6' => 'Nilai :attribute haruslah IPv6 yang sesuai',
    'json' => 'Nilai :attribute haruslah format JSON',
    'lt' => [
        'numeric' => 'Nilai dari :attribute haruslah lebih besar dari :value',
        'file' => 'Ukuran dari file :attribute haruslah lebih besar dari :value kilobytes',
        'string' => ':attribute harus memiliki jumlah huruf lebih banyak dari :value huruf',
        'array' => ':attribute haruslah memiliki jumlah item lebih dari :value item',
    ],
    'lte' => [
        'numeric' => 'Nilai dari :attribute haruslah lebih kecil atau sama dengan dari :value',
        'file' => 'Ukuran dari file :attribute haruslah lebih kecil atau sama dengan dari :value kilobytes',
        'string' => ':attribute harus memiliki jumlah huruf lebih sedikit dari atau sama dengan :value huruf',
        'array' => ':attribute haruslah memiliki jumlah item kurang dari atau sama dengan dari :value item.',
    ],
    'max' => [
        'numeric' => 'Nilai :attribute tidak lebih dari :max',
        'file' => 'Ukuran file :attribute tidak boleh lebih dari :max kilobytes',
        'string' => 'Jumlah huruf dari :attribute tidak boleh lebih dari :max kata',
        'array' => 'Jumlah item dari :attribute tidak boleh lebih dari :max item',
    ],
    'mimes' => 'Tipe file dari :attribute haruslah :values',
    'mimetypes' => 'Tipe file dari :attribute haruslah :values',
    'min' => [
        'numeric' => 'Nilai :attribute minimal :min',
        'file' => 'Ukuran file :attribute tidak boleh kurang dari :min kilobytes',
        'string' => 'Jumlah huruf dari :attribute minimal mengandung :min kata',
        'array' => 'Jumlah item dari :attribute minimal terdiri dari :min item',
    ],
    'multiple_of' => 'Nilai dari :attribute haruslah kelipatan dari :value',
    'not_in' => 'Nilai :attribute tidak terdaftar',
    'not_regex' => 'Format dari :attribute tidak lah sesuai dengan format yang ditentukan',
    'numeric' => 'Nilai :attribute haruslah sebuah angka',
    'password' => 'Kata sandi tidak sesuai',
    'present' => 'Nilai dari :attribute haruslah tersedia',
    'regex' => 'Format dari :attribute tidak sesuai',
    'required' => 'Nilai :attribute dibutuhkan',
    'required_if' => 'Nilai :attribute dibutuhkan jika nilai :other adalah :value',
    'required_unless' => 'Nilai :attribute dibutuhkan kecuali nilai :other adalah :values',
    'required_with' => ':attribute dibutuhkan ketika :values sesuai',
    'required_with_all' => ':attribute dibutuhkan ketika seluruh :values sesuai',
    'required_without' => ':attribute dibutuhkan ketika :values tidak sesuai',
    'required_without_all' => ':attribute dibutuhkan ketika seluruh :values sesuai',
    'prohibited' => ':attribute tidak diijinkan',
    'prohibited_if' => ':attribute tidak diijinkan jika :other bernilai :value',
    'prohibited_unless' => ':attribute tidak diijinkan kecuali :other bernilai :value',
    'same' => 'The :attribute and :other must match. Nilai :attribute dan :other haruslah sama',
    'size' => [
        'numeric' => 'Nilai :attribute haruslah :size',
        'file' => 'Ukuran file :attribute haruslah :size kilobytes',
        'string' => ':attribute haruslah memiliki :size huruf',
        'array' => ':attribute harus terdiri dari :size item',
    ],
    'starts_with' => ':attribute harus dimulai dengan salah satu dari :values',
    'string' => 'Nilai :attribute haruslah sebuah string',
    'timezone' => 'T:attribute haruslah sebuah zona yang valid',
    'unique' => 'Nilai dari :attribute sudah digunakan',
    'uploaded' => 'File dari :attribute gagal diunggah',
    'url' => 'Format URL dari :attribute tidaklah sesuai',
    'uuid' => 'Nilai :attribute haruslah UUID yang valid',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
