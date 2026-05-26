<?php

namespace {
    if (! class_exists('NumberFormatter')) {
        class NumberFormatter
        {
            const CURRENCY = 1;
            const DECIMAL = 2;
            const PERCENT = 3;
            const SCIENTIFIC = 4;
            const SPELLOUT = 5;
            const ORDINAL = 6;
            const DURATION = 7;
            const PATTERN_RULEBASED = 8;
            const IGNORE = 9;
            const DEFAULT_STYLE = 10;

            const GROUPING_USED = 1;
            const DECIMAL_ALWAYS_SHOWN = 2;
            const MAX_INTEGER_DIGITS = 3;
            const MIN_INTEGER_DIGITS = 4;
            const INTEGER_DIGITS = 5;
            const MAX_FRACTION_DIGITS = 6;
            const MIN_FRACTION_DIGITS = 7;
            const FRACTION_DIGITS = 8;
            const MULTIPLIER = 9;
            const GROUPING_SIZE = 10;
            const ROUNDING_MODE = 11;
            const ROUNDING_INCREMENT = 12;
            const FORMAT_WIDTH = 13;
            const PADDING_POSITION = 14;
            const SECONDARY_GROUPING_SIZE = 15;
            const SIGNIFICANT_DIGITS_USED = 16;
            const MIN_SIGNIFICANT_DIGITS = 17;
            const MAX_SIGNIFICANT_DIGITS = 18;
            const LENIENT_PARSE = 19;

            const POSITIVE_PREFIX = 1;
            const POSITIVE_SUFFIX = 2;
            const NEGATIVE_PREFIX = 3;
            const NEGATIVE_SUFFIX = 4;
            const PADDING_CHARACTER = 5;
            const CURRENCY_CODE = 6;
            const DEFAULT_RULESET = 7;
            const PUBLIC_RULESETS = 8;

            public function __construct($locale, $style, $pattern = null) {}
            public function setAttribute($attr, $value) {}
            public function getAttribute($attr) { return 0; }
            public function setTextAttribute($attr, $value) {}
            public function getTextAttribute($attr) { return ''; }
            public function setSymbol($attr, $value) {}
            public function getSymbol($attr) { return ''; }
            public function format($value, $type = null) { return number_format($value, 2); }
            public function formatCurrency($value, $currency) { return $currency . ' ' . number_format($value, 0, ',', '.'); }
            public function parse($value, $type = null, &$position = null) { return $value; }
            public function parseCurrency($value, &$currency, &$position = null) { return $value; }
        }
    }
}

namespace Filament\Support {
    if (! function_exists('Filament\Support\format_money')) {
        function format_money(float | int $money, string $currency, int $divideBy = 0): string
        {
            if ($divideBy) {
                $money /= $divideBy;
            }

            return $currency . ' ' . number_format($money, 0, ',', '.');
        }
    }

    if (! function_exists('Filament\Support\format_number')) {
        function format_number(float | int $number): string
        {
            return number_format($number, 0, ',', '.');
        }
    }
}
