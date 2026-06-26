New contact form submission from 24 Frames website

Name: {{ $submission->name }}
Email: {{ $submission->email }}

Message:
{{ $submission->message }}

Submitted at: {{ $submission->created_at->toDateTimeString() }}
