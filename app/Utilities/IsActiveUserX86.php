<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class IsActiveUserX86
{
  public static function check($idSubs)
  {
    try {
      $response = Http::withOptions(['verify' => false])->withBasicAuth(env('X86_USERNAME'), env('X86_USERNAME'))->get(env('X86_HOST') . "/rest/ppp/active?name=" . $idSubs)->throw()->json();

      return $response;
    } catch (\Throwable $th) {
      Log::channel('slack_error_log')->error('Error checking pppoe status on X86', ['error' => $th->getMessage()]);
    }
  }
}
