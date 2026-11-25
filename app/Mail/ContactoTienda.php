<?php

namespace App\Mail;

use App\Models\Tienda;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoTienda extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Tienda $tienda,
        public string $nombre,
        public string $correo,
        public string $mensaje,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->correo, $this->nombre)],
            subject: 'Nuevo mensaje de ' . $this->nombre . ' - CrikoStore',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contacto-tienda');
    }
}