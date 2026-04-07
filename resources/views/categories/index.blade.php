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
    <li style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

        {{-- KIRI: NAMA --}}
        <div>
            <strong>{{ $cat->name }}</strong>
        </div>

        {{-- KANAN: TOMBOL --}}
        <div>
            <button id="btn-cat-{{ $cat->id }}" onclick="toggleEditCat({{ $cat->id }})">
                Edit
            </button>

            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button>Hapus</button>
            </form>
        </div>

    </li>

    {{-- FORM EDIT DI BAWAH --}}
    <div id="edit-cat-{{ $cat->id }}" style="display:none; margin-bottom:15px;">
        <form action="{{ route('categories.update', $cat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $cat->name }}" required>

            <button type="submit">Update</button>
        </form>
    </div>

@endforeach
</ul>

<script>
function toggleEditCat(id) {
    let form = document.getElementById('edit-cat-' + id);
    let btn = document.getElementById('btn-cat-' + id);

    if (form.style.display === 'none') {
        form.style.display = 'block';
        btn.innerText = 'Batal';
    } else {
        form.style.display = 'none';
        btn.innerText = 'Edit';
    }
}
</script>