<?php

namespace App\Http\Controllers;

use App\EmailProvider\EmailProviderInterface;
use App\Http\Requests\ValidEmailSendRequest;
use \Illuminate\Http\Request;

class DashboardController
{
    protected $provider = null;

    public function __construct(EmailProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function index()
    {
        $lists = $this->provider->getLists();

        return view('dashboard', compact('lists'));
    }

    public function send(ValidEmailSendRequest $request)
    {

        $this->provider->send($request->get('list_id'), $request);
    }
}
