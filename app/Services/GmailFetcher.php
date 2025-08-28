<?php

namespace App\Services;

use App\Models\MailLabel;
use App\Models\MailMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GmailFetcher
{
    public function fetchAndStoreLatest(int $userId, int $limit = 10): int
    {
        $this->ensureSystemLabels($userId);

        $fetched = 0;
        for ($i = 0; $i < $limit; $i++) {
            $subject = 'Dummy Gmail Message #' . ($i + 1);
            $gmailId = 'dummy_' . $userId . '_' . ($i + 1);

            if (MailMessage::where('user_id', $userId)->where('gmail_id', $gmailId)->exists()) {
                continue;
            }

            $message = MailMessage::create([
                'user_id' => $userId,
                'gmail_id' => $gmailId,
                'message_id' => '<message.' . $gmailId . '@example.com>',
                'subject' => $subject,
                'sender_name' => 'Example Sender',
                'sender_email' => 'sender@example.com',
                'recipients' => json_encode(['to' => ['you@example.com']]),
                'sent_date' => Carbon::now()->subDays($i),
                'html_content' => '<p>This is a dummy email body for ' . e($subject) . '.</p>',
                'text_content' => 'This is a dummy email body for ' . $subject . '.',
                'status' => 'synced',
            ]);

            $labelName = str_contains($message->sender_email, '@yourdomain.com') ? 'Sent' : 'Inbox';
            $label = MailLabel::where('user_id', $userId)->where('name', $labelName)->first();
            if ($label) {
                $message->labels()->attach($label->id);
            }

            $fetched++;
        }

        return $fetched;
    }

    protected function ensureSystemLabels(int $userId): void
    {
        foreach (['Inbox', 'Sent'] as $name) {
            MailLabel::firstOrCreate([
                'user_id' => $userId,
                'name' => $name,
            ], [
                'color' => $name === 'Inbox' ? '#2563eb' : '#10b981',
                'type' => 'system',
            ]);
        }
    }
}


