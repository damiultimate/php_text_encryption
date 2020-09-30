<?php
$mydate=getdate(date("U"));

$ENCRYPTION_KEY = "$mydate[weekday]$mydate[month]$mydate[mday]$mydate[year]";
$ENCRYPTION_ALGORITHM = 'AES-256-CBC';

function EncryptThis($ClearTextData) {
   
    global $ENCRYPTION_KEY;
    global $ENCRYPTION_ALGORITHM;
    $EncryptionKey = base64_decode($ENCRYPTION_KEY);
    $InitializationVector  = openssl_random_pseudo_bytes(openssl_cipher_iv_length($ENCRYPTION_ALGORITHM));
    $EncryptedText = openssl_encrypt($ClearTextData, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
    return base64_encode($EncryptedText . '::' . $InitializationVector);
}

function DecryptThis($CipherData) {

    global $ENCRYPTION_KEY;
    global $ENCRYPTION_ALGORITHM;
    $EncryptionKey = base64_decode($ENCRYPTION_KEY);
    list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
    return openssl_decrypt($Encrypted_Data, $ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
}

echo DecryptThis('VnpQSXJCQmRjRHJXUXI1NzZBMUxHdz09Ojpiko+fdHEriTHUuCpDfaD2');


?>