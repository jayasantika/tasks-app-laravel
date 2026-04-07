{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<h1>Daftar Tugas</h1>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Judul">
    
    <input type="date" name="deadline">
    <button type="submit">Tambah Tugas</button>
</form>
<select name="category_id">
    <option value="">Pilih Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
</select>
<a href="{{ route('categories.index') }}">
    <button>Tambah Kategori</button>
</a>
<ul>
<hr>
@foreach ($tasks as $task)
    <li>
        <strong>{{ $task->title }}</strong>
        <br>
        Kategori: {{ $task->category->name ?? '-' }}
        <br>
        @if($task->deadline)
            Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
        @endif

        {{-- STATUS --}}
        @if($task->status == 'done')
    
        @if($task->deadline && $task->completed_at > $task->deadline)
            <span style="color:red;">
                SELESAI (TELAT ❌)
            </span>
        @else
            <span style="color:green;">
                SELESAI (TEPAT WAKTU ✅)
            </span>
        @endif

    @else

        @if($task->deadline && $task->deadline < now())
            <span style="color:red;">
                ( TELAT ❌ )
            </span>
        @else
            <span style="color:orange;">
                ( BELUM SELESAI ⏳ )
            </span>
        @endif

    @endif
    
        

        @if($task->completed_at)
            <br>Selesai pada: {{ \Carbon\Carbon::parse($task->completed_at)->format('d M Y H:i') }}
        @endif

        <br>

        {{-- TOMBOL --}}
        <a href="/tasks/toggle/{{ $task->id }}">
            @if($task->status == 'pending')
                <button>Tandai Sudah Selesai</button>
            @else
                <button>Tandai Belum Selesai</button>
            @endif
        </a>
        <button id="btn-{{ $task->id }}" onclick="toggleEdit({{ $task->id }})">
            Edit
        </button>

        {{-- FORM EDIT (HIDDEN) --}}
        <div id="edit-{{ $task->id }}" style="display:none; margin-top:10px;">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="text" name="title" value="{{ $task->title }}" required>

                <select name="category_id">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $task->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="deadline" value="{{ $task->deadline }}">

                <button type="submit">Update</button>
            </form>
        </div>

        {{-- DELETE --}}
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Hapus</button>
        </form>
        <hr>
    </li>
@endforeach
</ul>

<script>
function toggleEdit(id) {
    let form = document.getElementById('edit-' + id);
    let btn = document.getElementById('btn-' + id);

    if (form.style.display === 'none') {
        form.style.display = 'block';
        btn.innerText = 'Batal';
    } else {
        form.style.display = 'none';
        btn.innerText = 'Edit';
    }
}
</script>