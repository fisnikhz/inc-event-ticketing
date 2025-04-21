<h1>Hello {{ $user->name }},</h1>

<p>Your ticket for the event <strong>{{ $event->name }}</strong> has been successfully booked.</p>
<ul>
    <li>Date: {{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}</li>
    <li>Venue: {{ $event->venue->name }}</li>
    <li>Seat Number: {{ $ticket->seat_number }}</li>
    <li>Price: €{{ number_format($ticket->price, 2) }}</li>
</ul>

<p>Thank you for booking with us!</p>
