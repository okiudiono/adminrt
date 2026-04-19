<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('asset')) {
    function asset($path = NULL)
    {
        return base_url("themes/$path");
    }
}

function tanggal_indo($tanggal)
{
    $hari = [
        'Sunday'    => 'Minggu',
        'Monday'    => 'Senin',
        'Tuesday'   => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday'  => 'Kamis',
        'Friday'    => 'Jumat',
        'Saturday'  => 'Sabtu'
    ];

    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $time = strtotime($tanggal);

    return
        $hari[date('l', $time)] . ', ' .
        date('d', $time) . ' ' .
        $bulan[(int)date('m', $time)] . ' ' .
        date('Y', $time);
}
