<?php


if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number)
    {
        $units = ['', 'ngàn', 'triệu', 'tỷ', 'nghìn tỷ', 'triệu tỷ', 'tỷ tỷ'];
        $words = [
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín'
        ];

        if ($number == 0) {
            return 'không';
        }

        $number = number_format($number, 0, '.', '');
        $length = strlen($number);
        $chunks = [];
        $unitIndex = 0;

        // Tách số thành các phần 3 chữ số
        while ($length > 0) {
            $chunks[] = substr($number, max($length - 3, 0), min(3, $length));
            $length -= 3;
        }

        $chunks = array_reverse($chunks);
        $text = '';

        foreach ($chunks as $index => $chunk) {
            $chunkText = '';
            $chunkLength = strlen($chunk);

            for ($i = 0; $i < $chunkLength; $i++) {
                $digit = (int) $chunk[$i];
                $position = $chunkLength - $i - 1;
                $isLastDigit = ($position === 0);

                if ($digit !== 0) {
                    if ($position == 1) {
                        // Xử lý hàng chục
                        if ($digit == 1) {
                            $chunkText .= 'mười ';
                        } else {
                            $chunkText .= $words[$digit] . ' mươi ';
                        }
                    } elseif ($position == 0) {
                        // Xử lý hàng đơn vị
                        if ($digit == 1 && $chunkLength > 1 && $chunk[$i - 1] != '0') {
                            $chunkText .= 'mốt ';
                        } elseif ($digit == 5 && $chunkLength > 1 && $chunk[$i - 1] != '0') {
                            $chunkText .= 'lăm ';
                        } else {
                            $chunkText .= $words[$digit] . ' ';
                        }
                    } else {
                        // Xử lý hàng trăm
                        $chunkText .= $words[$digit] . ' trăm ';
                    }
                } elseif ($position > 0 && $chunk[$i + 1] !== '0') {
                    // Xử lý chữ "lẻ"
                    $chunkText .= 'lẻ ';
                }
            }

            if (!empty($chunkText)) {
                $unitText = $units[count($chunks) - $index - 1];
                $text .= trim($chunkText) . ' ' . $unitText . ' ';
            }
        }

        return trim($text);
    }
}
