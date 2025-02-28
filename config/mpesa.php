<?php

return [
    //This is the mpesa environment.Can be sanbox or production
    'environment' => env('MPESA_ENVIRONMENT', 'sandbox'),

    /*-----------------------------------------
        |The Mpesa Consumer Key
        |------------------------------------------
        */
    'mpesa_consumer_key' => env('MPESA_CONSUMER_KEY', '4YslkAfktliGbYqNTxS0Kxo0G7r9MAoHiunLBzWsfOGRr5Dw'),

    /*-----------------------------------------
        |The Mpesa Consumer Secret
        |------------------------------------------
        */
    'mpesa_consumer_secret' => env('MPESA_CONSUMER_SECRET', 'TQ27nRnQrR0WYSDsfBQ8oJUVKBxTBfbC1w0nIdMhehAihQ2Db39WJSkI0s0rVebW'),

    /*-----------------------------------------
        |The Lipa na Mpesa Online Passkey
        |------------------------------------------
        */
    'passkey' => env('SAFARICOM_PASSKEY', '003ecce2211760ce700f7fbd8837e172d8e99c4602b0c0e218079f8738ff707b'),

    /*-----------------------------------------
        |The Lipa na Mpesa Online ShortCode
        |------------------------------------------
        */
    'shortcode' => env('MPESA_BUSINESS_SHORTCODE', '4976702'),

    /*-----------------------------------------
        |The Mpesa Initator Name
        |------------------------------------------
        */
    'initiator_name' => env('MPESA_INITIATOR_NAME', 'reagan'),

    /*-----------------------------------------
        |The Mpesa Initator Password
        |------------------------------------------
        */
    'initiator_password' => env('MPESA_INITIATOR_PASSWORD'),

    /*-----------------------------------------
        |Mpesa B2C ShortCode
        |------------------------------------------
        */
    'b2c_shortcode' => env('MPESA_B2C_SHORTCODE'),

    /*-----------------------------------------
        |Mpesa C2B Validation url
        |------------------------------------------
        */
    'c2b_validation_url' => env('MPESA_C2B_VALIDATION_URL', 'https://webhook.site/f5766134-dcd3-4dd5-8061-4004fd544a81'),

    /*-----------------------------------------
        |Mpesa C2B Confirmation url
        |------------------------------------------
        */
    'c2b_confirmation_url' => env('MPESA_C2B_CONFIRMATION_URL', 'https://webhook.site/f5766134-dcd3-4dd5-8061-4004fd544a81'),

    /*-----------------------------------------
        |Mpesa B2C Result url
        |------------------------------------------
        */
    'b2c_result_url' => env('MPESA_B2C_RESULT_URL'),

    /*-----------------------------------------
        |Mpesa B2C Timeout url
        |------------------------------------------
        */
    'b2c_timeout_url' => env('MPESA_B2C_TIMEOUT_URL'),

    /*-----------------------------------------
        |Mpesa Lipa Na Mpesa callback url
        |------------------------------------------
        */
    'callback_url' => env('MPESA_CALLBACK_URL', 'https://webhook.site/f5766134-dcd3-4dd5-8061-4004fd544a81'),

    /*-----------------------------------------
        |Mpesa Transaction Status Result url
        |------------------------------------------
        */
    'status_result_url' => env('MPESA_STATUS_RESULT_URL'),

    /*-----------------------------------------
        |Mpesa Transaction Status Timeout url
        |------------------------------------------
        */
    'status_timeout_url' => env('MPESA_STATUS_TIMEOUT_URL'),

    /*-----------------------------------------
        |Mpesa Account Balance Result url
        |------------------------------------------
        */
    'balance_result_url' => env('MPESA_BALANCE_RESULT_URL'),

    /*-----------------------------------------
        |Mpesa Account Balance Timeout url
        |------------------------------------------
        */
    'balance_timeout_url' => env('MPESA_BALANCE_TIMEOUT_URL'),

    /*-----------------------------------------
        |Mpesa Reversal Result url
        |------------------------------------------
        */
    'reversal_result_url' => env('MPESA_REVERSAL_RESULT_URL'),

    /*-----------------------------------------
        |Mpesa Reversal Timeout url
        |------------------------------------------
        */
    'reversal_timeout_url' => env('MPESA_REVERSAL_TIMEOUT_URL'),

    /*-----------------------------------------
        |Mpesa B2B urls
        |------------------------------------------
    */
    'b2b_result_url' => env('MPESA_B2B_RESULT_URL'),

    'b2b_timeout_url' => env('MPESA_B2B_TIMEOUT_URL'),
];
