<?php

if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number) {
        $units = ['', 'ngàn', 'triệu', 'tỷ', 'nghìn tỷ', 'triệu tỷ', 'tỷ tỷ'];
        $words = [
            0 => 'không', 1 => 'một', 2 => 'hai', 3 => 'ba', 4 => 'bốn',
            5 => 'năm', 6 => 'sáu', 7 => 'bảy', 8 => 'tám', 9 => 'chín'
        ];

        if ($number == 0) {
            return 'không';
        }

        $parts = explode('.', number_format($number, 0, '.', ''));
        $text = '';

        foreach ($parts as $index => $part) {
            $partText = '';
            $length = strlen($part);
            for ($i = 0; $i < $length; $i++) {
                $digit = (int) $part[$i];
                $position = $length - $i - 1;
                $isLastDigit = $position === 0;

                if ($digit !== 0) {
                    if ($digit == 1 && $position == 1 && $length > 1) {
                        $partText .= 'mười ';
                    } elseif ($digit == 5 && $isLastDigit) {
                        $partText .= 'lăm ';
                    } else {
                        $partText .= $words[$digit] . ' ';
                    }

                    if ($position > 0) {
                        $partText .= ($position == 1) ? 'mươi ' : 'trăm ';
                    }
                } elseif (!$isLastDigit && $part[$i + 1] !== '0') {
                    $partText .= 'lẻ ';
                }
            }
            $unitIndex = count($parts) - $index - 1;
            $text .= trim($partText) . ' ' . $units[$unitIndex] . ' ';
        }

        return trim($text);
    }
}
