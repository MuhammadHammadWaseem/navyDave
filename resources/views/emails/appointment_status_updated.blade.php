<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <h1>Appointment Confirmation</h1>
    
    <p>Hello @if($role == 'user') {{ $appointment->first_name }} {{ $appointment->last_name }} @elseif($role == 'staff') {{ $appointment->staff->user->name }} @else Admin @endif,</p>

    @if($role == 'user')
    <p>Your appointment status has been updated to: {{ $appointment->status }}</p>
    @elseif($role == 'staff' || $role == 'admin')
    <p>Appointment status has been updated to: {{ $appointment->status }}</p>
    @endif

    <p><strong>Appointment ID:</strong> {{ $appointment->id }}</p>

    @if ($role == 'admin' || $role == 'staff')
    <p><strong>Name:</strong> {{ $appointment->first_name }} {{ $appointment->last_name }}</p>
    @endif
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</p>
    
    <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
    
    <p><strong>Staff:</strong> {{ $appointment->staff->user->name }}</p> <!-- Staff name -->

    <p><strong>Slot Time:</strong> {{ \Carbon\Carbon::parse($appointment->slot->available_from)->format('h:i A') }} to {{ \Carbon\Carbon::parse($appointment->slot->available_to)->format('h:i A') }}</p> <!-- Slot time with AM/PM -->

    <p><strong>Location:</strong> {{ $appointment->location }}</p>

    <p><strong>Notes:</strong> {{ $appointment->note }}</p>

    <p>Thank you!</p>
</body>
</html>
