<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Services\GmailFetcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class GmailController extends Controller
{
    public function sync(GmailFetcher $fetcher): RedirectResponse
    {
        $userId = Auth::id();
        $count = $fetcher->fetchAndStoreLatest($userId, 10);
        return redirect()->route('emails.index')->with('status', "$count emails synced from Gmail (dummy)");
    }
}


