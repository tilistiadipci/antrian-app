<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CheckSettingsFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $geinqftz999788447,Closure $whspwdrt70193212){if($geinqftz999788447->is(base64_decode('c2V0dXA='))||$geinqftz999788447->is(base64_decode('c2V0dXAvKg=='))){return $whspwdrt70193212($geinqftz999788447);}if(File::get(base_path(base64_decode('a2V5LnR4dA==')))==null||File::get(base_path(base64_decode('a2V5LnR4dA==')))==''&&File::get(base_path(base64_decode('dXVpZC50eHQ=')))==null||File::get(base_path(base64_decode('dXVpZC50eHQ=')))==''){return redirect(base64_decode('L3NldHVw'));}if(File::get(base_path(base64_decode('a2V5LnR4dA==')))!=null){$duzgcejh3490659553=$this->decryptJsonFile2(File::get(base_path(base64_decode('a2V5LnR4dA=='))));if($duzgcejh3490659553){return $whspwdrt70193212($geinqftz999788447);}}return redirect(base64_decode('L3NldHVw'));}private function decryptJsonFile(){$rbncofue553286813=base64_decode('YWVzLTI1Ni1jdHI=');$uigcnvuz2324736937=base64_decode('M2NjNDcyNDdjNjY1MDY4MDhmN2Y3M2ZkYjg2ZTQ1ZDM=');$edngsghr2094552570=File::get(base_path(base64_decode('a2V5LnR4dA==')));$krldwmeh372828486=base64_decode($edngsghr2094552570);$cgkvpyzv2452470735=openssl_cipher_iv_length($rbncofue553286813);$ozuoyykm1283462680=substr($krldwmeh372828486,0,$cgkvpyzv2452470735);$eekyrmyh2918445923=substr($krldwmeh372828486,$cgkvpyzv2452470735);$xwbgwcac3124532429=openssl_decrypt($eekyrmyh2918445923,$rbncofue553286813,$uigcnvuz2324736937,0,$ozuoyykm1283462680);return json_decode($xwbgwcac3124532429,true);}private function decryptJsonFile2($noxhehov1793051482){$uigcnvuz2324736937=base64_decode('M2NjNDcyNDdjNjY1MDY4MDhmN2Y3M2ZkYjg2ZTQ1ZDM=');$rbncofue553286813=base64_decode('YWVzLTI1Ni1jdHI=');$edngsghr2094552570=$noxhehov1793051482;$krldwmeh372828486=base64_decode($edngsghr2094552570);$cgkvpyzv2452470735=openssl_cipher_iv_length($rbncofue553286813);$ozuoyykm1283462680=substr($krldwmeh372828486,0,$cgkvpyzv2452470735);$eekyrmyh2918445923=substr($krldwmeh372828486,$cgkvpyzv2452470735);$xwbgwcac3124532429=openssl_decrypt($eekyrmyh2918445923,$rbncofue553286813,$uigcnvuz2324736937,0,$ozuoyykm1283462680);return json_decode($xwbgwcac3124532429,true);}
}
