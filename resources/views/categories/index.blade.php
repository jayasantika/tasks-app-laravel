<h1>Kategori</h1>

{{-- FORM TAMBAH --}}
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama kategori" required>
    <button type="submit">Tambah</button>
</form>
<a href="{{ route('tasks.index') }}">
    <button>Kembali ke Tugas</button>
</a>

<hr>

{{-- LIST DATA --}}
<ul>
@foreach($categories as $cat)
    <li>
        {{ $cat->name }}

        <form action="{{ route('categories.destroy', $cat->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>Hapus</button>
        </form>
    </li>
@endforeach
</ul>