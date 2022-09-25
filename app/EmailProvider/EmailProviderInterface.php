<?php

namespace App\EmailProvider;
use \Illuminate\Http\Request;
use SendinBlue\Client\Configuration;

interface EmailProviderInterface
{
    function apiConnection() : Configuration;
    function getLists();
    function send( int $list_id, Request $request) : string|bool;
}

