<?php

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

        public function __construct($locale = null, $style = null, $pattern = null) {}
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

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
