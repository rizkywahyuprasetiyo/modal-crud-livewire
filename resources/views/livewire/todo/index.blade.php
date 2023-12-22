<div>
    <h1 class="mt-5">Todo</h1>
    <!-- Button trigger modal -->
    <button wire:click="openModal" class="btn btn-primary">
        Tambah Tugas
    </button>

    @if(session()->has('success'))
    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title py-2 mb-0">Data Task</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul Tugas</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo)
                            <tr>
                                <td>{{ $todo->judul }}</td>
                                <td>{{ $todo->deskripsi }}</td>
                                <td><span class="badge{{ $todo->status === 'belum' ? ' bg-danger' : ' bg-success' }}">{{ $todo->status }}</span></td>
                                <td>
                                    @if($todo->status === 'belum')
                                    <form wire:submit="sudah({{ $todo->id }})" onclick="return confirm('Tugas akan ditandai sebagai selesai. Lanjutkan?')">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="formModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formModal">Tambah Tugas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="simpan">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" wire:model="judul" class="form-control" id="judul" placeholder="Tanpa Judul">
                            @error('judul')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" wire:model="deskripsi" class="form-control" rows="3" placeholder="Isi dengan deskripsi"></textarea>
                            @error('deskripsi')
                            <div class="text-danger mt-1">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', ()=> {
        var formModal = new bootstrap.Modal('#formModal');
        $wire.on('modal-opened', () => {
            formModal.show();
        });

        $wire.on('saved-data', () => {
            formModal.hide();
        });
    });
</script>
@endscript