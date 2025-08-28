<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\MailAttachment;
use App\Models\MailLabel;
use App\Models\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MailMessageController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $query = MailMessage::query()->where('user_id', $userId);

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                    ->orWhere('sender_email', 'like', "%$search%")
                    ->orWhere('sender_name', 'like', "%$search%")
                    ->orWhere('text_content', 'like', "%$search%")
                    ->orWhere('recipients', 'like', "%$search%");
            });
        }

        if ($labelId = $request->integer('label_id')) {
            $query->whereHas('labels', function ($q) use ($labelId) {
                $q->where('mail_labels.id', $labelId);
            });
        }

        if ($sender = $request->string('sender')->toString()) {
            $query->where('sender_email', 'like', "%$sender%");
        }

        if ($request->filled('date_from')) {
            $query->whereDate('sent_date', '>=', $request->date('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('sent_date', '<=', $request->date('date_to'));
        }

        $messages = $query->latest('sent_date')->paginate(20)->withQueryString();

        $labels = MailLabel::where('user_id', $userId)->orderBy('type')->orderBy('name')->get();

        return view('emails.index', [
            'messages' => $messages,
            'labels' => $labels,
            'filters' => $request->only(['search', 'label_id', 'sender', 'date_from', 'date_to']),
        ]);
    }

    public function show(int $id)
    {
        $userId = Auth::id();
        $message = MailMessage::with(['attachments', 'labels'])
            ->where('user_id', $userId)
            ->findOrFail($id);

        return view('emails.show', [
            'message' => $message,
        ]);
    }
}


