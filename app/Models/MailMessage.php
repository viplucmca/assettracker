<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MailMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gmail_id',
        'message_id',
        'subject',
        'sender_name',
        'sender_email',
        'recipients',
        'sent_date',
        'html_content',
        'text_content',
        'status',
    ];

    protected $casts = [
        'sent_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(MailAttachment::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(MailLabel::class, 'mail_label_mail_message');
    }
}


