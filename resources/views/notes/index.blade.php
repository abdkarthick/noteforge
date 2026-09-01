<!DOCTYPE html>
<html>
<head>
    <title>NoteForge</title>
</head>
<body>
    <h1>NoteForge 🔥</h1>

    <form method="POST" action="{{ route('notes.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Note title" required>
        <textarea name="body" placeholder="Write something..."></textarea>
        <button type="submit">Add Note</button>
    </form>

    <ul>
        @foreach ($notes as $note)
            <li>
                <strong>{{ $note->title }}</strong> - {{ $note->body }}
                <form method="POST" action="{{ route('notes.destroy', $note) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
