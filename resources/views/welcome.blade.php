<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laravel ECS CI/CD Working</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 40px auto; padding: 0 20px; color: #1a1a1a; }
        h1 { font-size: 1.4rem; }
        form { display: flex; flex-direction: column; gap: 8px; margin: 20px 0; }
        input, textarea { padding: 8px; font: inherit; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 16px; border: none; border-radius: 4px; background: #ff2d20; color: #fff; cursor: pointer; width: fit-content; }
        .error { color: #b00020; font-size: 0.9rem; }
        ul { list-style: none; padding: 0; }
        li { border-bottom: 1px solid #eee; padding: 10px 0; }
        .meta { color: #777; font-size: 0.85rem; }
    </style>
</head>
<body>
    <h1>Laravel ECS CI/CD Working</h1>

    <p>Submit a message below to confirm it's being saved to the database.</p>

    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/messages">
        @csrf
        <input type="text" name="name" placeholder="Your name" value="{{ old('name') }}">
        <textarea name="body" placeholder="Your message" rows="3">{{ old('body') }}</textarea>
        <button type="submit">Save to database</button>
    </form>

    <h2>Saved messages ({{ $messages->count() }})</h2>
    <ul>
        @forelse ($messages as $message)
            <li>
                <strong>{{ $message->name }}</strong>: {{ $message->body }}
                <div class="meta">{{ $message->created_at->diffForHumans() }}</div>
            </li>
        @empty
            <li>No messages yet.</li>
        @endforelse
    </ul>
</body>
</html>
