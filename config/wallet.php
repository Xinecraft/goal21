<?php

return [
    'package' => [
        'coefficient' => 100.,
    ],
    'services' => [
        'common' => \Bavix\Wallet\Services\CommonService::class,
        'proxy' => \Bavix\Wallet\Services\ProxyService::class,
        'wallet' => \Bavix\Wallet\Services\WalletService::class,
    ],
    'transaction' => [
        'table' => 'transactions',
        'model' => \Bavix\Wallet\Models\Transaction::class,
    ],
    'transfer' => [
        'table' => 'transfers',
        'model' => \Bavix\Wallet\Models\Transfer::class,
    ],
    'wallet' => [
        'table' => 'wallets',
        'model' => \Bavix\Wallet\Models\Wallet::class,
        'default' => [
            'name' => 'Default Wallet',
            'slug' => 'default',
        ],
    ],
];
