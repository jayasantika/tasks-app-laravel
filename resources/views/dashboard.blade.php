<h1>Dashboard</h1>

<p>Total Task: {{ $total }}</p>
<p>Selesai: {{ $done }}</p>

<a href="{{ route('tasks.index') }}">
    <button>Lihat Tugas</button>
</a>