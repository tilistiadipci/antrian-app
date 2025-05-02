<?php

use Illuminate\Support\Facades\File;


function uuidv4()
{
    $kpwekvgz2918445923 = random_bytes(16);
    $kpwekvgz2918445923[6] = chr(ord($kpwekvgz2918445923[6]) & 0x0f | 0x40);
    $kpwekvgz2918445923[8] = chr(ord($kpwekvgz2918445923[8]) & 0x3f | 0x80);
    return vsprintf(base64_decode('JXMlcy0lcy0lcy0lcy0lcyVzJXM='), str_split(bin2hex($kpwekvgz2918445923), 4));
}
function decryptJsonFile2($jhtziquv1793051482)
{
    $asdzfofx2324736937 = base64_decode('M2NjNDcyNDdjNjY1MDY4MDhmN2Y3M2ZkYjg2ZTQ1ZDM=');
    $yvyldxrh553286813 = base64_decode('YWVzLTI1Ni1jdHI=');
    $tqzobqtq2094552570 = $jhtziquv1793051482;
    $cucixapw372828486 = base64_decode($tqzobqtq2094552570);
    $ufurmywg2452470735 = openssl_cipher_iv_length($yvyldxrh553286813);
    $iqnqswpr1283462680 = substr($cucixapw372828486, 0, $ufurmywg2452470735);
    $kpwekvgz2918445923 = substr($cucixapw372828486, $ufurmywg2452470735);
    $lknsqias3124532429 = openssl_decrypt($kpwekvgz2918445923, $yvyldxrh553286813, $asdzfofx2324736937, 0, $iqnqswpr1283462680);
    return json_decode($lknsqias3124532429, true);
}
function decryptJsonFile()
{
    $asdzfofx2324736937 = base64_decode('M2NjNDcyNDdjNjY1MDY4MDhmN2Y3M2ZkYjg2ZTQ1ZDM=');
    $yvyldxrh553286813 = base64_decode('YWVzLTI1Ni1jdHI=');
    $tqzobqtq2094552570 = File::get(base64_decode('dGVtcG9yYXJ5X2ZpbGVfZW5rcmlwc2kudHh0'));
    $cucixapw372828486 = base64_decode($tqzobqtq2094552570);
    $ufurmywg2452470735 = openssl_cipher_iv_length($yvyldxrh553286813);
    $iqnqswpr1283462680 = substr($cucixapw372828486, 0, $ufurmywg2452470735);
    $kpwekvgz2918445923 = substr($cucixapw372828486, $ufurmywg2452470735);
    $lknsqias3124532429 = openssl_decrypt($kpwekvgz2918445923, $yvyldxrh553286813, $asdzfofx2324736937, 0, $iqnqswpr1283462680);
    return json_decode($lknsqias3124532429, true);
}
function encryptJsonFile()
{
    $asdzfofx2324736937 = base64_decode('M2NjNDcyNDdjNjY1MDY4MDhmN2Y3M2ZkYjg2ZTQ1ZDM=');
    $yvyldxrh553286813 = base64_decode('YWVzLTI1Ni1jdHI=');
    $kpwekvgz2918445923 = File::get(base64_decode('dGVtcG9yYXJ5X2ZpbGVfZW5rcmlwc2kuanNvbg=='));
    $ufurmywg2452470735 = openssl_cipher_iv_length($yvyldxrh553286813);
    $iqnqswpr1283462680 = openssl_random_pseudo_bytes($ufurmywg2452470735);
    $cucixapw372828486 = openssl_encrypt($kpwekvgz2918445923, $yvyldxrh553286813, $asdzfofx2324736937, 0, $iqnqswpr1283462680);
    $tqzobqtq2094552570 = base64_encode($iqnqswpr1283462680 . $cucixapw372828486);
    File::put(base64_decode('dGVtcG9yYXJ5X2ZpbGVfZW5rcmlwc2kudHh0'), $tqzobqtq2094552570);
}