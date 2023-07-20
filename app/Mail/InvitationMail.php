<?php

namespace App\Mail;

use App\Models\SceneInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Message;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $sceneInvitation;
    public $canvasImage;

    public function __construct(SceneInvitation $sceneInvitation, $canvasImage = null)
    {
        $this->sceneInvitation = $sceneInvitation;

        $this->canvasImage = $canvasImage;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Scene Invitation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'user.emails.invitation',
            with: [
                'url' => route('accept', $this->sceneInvitation->token),
                'inviterName' => $this->sceneInvitation->scene->user->first_name  . ' ' . $this->sceneInvitation->scene->user->last_name,
                'sceneTitle' => $this->sceneInvitation->scene->title,
                'inviterMessage' => $this->sceneInvitation->invitation_message,
                'canvasImageUrl' => $this->sceneInvitation->scene->sceneCanvasImage->url ?? 'https://placehold.co/437x249/8e96c8/white?text=Scene%20Snapshot',
            ]
        );
    }

    // TODO: remove function attachement if client does not want to attachments
    // public function attachments(): array
    // {
    //     if ($this->canvasImage) {
    //         return [
    //             Attachment::fromPath($this->canvasImage),
    //         ];
    //     }
    //     return [];
    // }
}
