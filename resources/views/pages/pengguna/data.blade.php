@extends('layouts.main')

@section('content')

<h1>Pengguna</h1>
<hr>

<!-- Allert -->

@if(session('status-alert') == 'sukses')
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Selamat bro!!</strong> data berhasil disimpan ke database!!.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif


@if(session('status-alert') == 'sukses-hapus')
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Yeaa!!</strong> data berhasil dihapus dari database!!.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif


@if(session('status-alert') == 'gagal')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Sorry bro!!</strong> Data gagal dihapus dari database.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif

<!-- Pencarian dan tambah -->

<div class="row">
	<div class="col-sm-6 mb-3">
		<form method="get" action="?">
			<div class="input-group">
				<input type="text" name="cari" placeholder="Search!!!!!!!" class="form-control" value="{{ $cari }}" />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary">Go!</button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-sm-6 text-right mb-3">
		<a href="{{ route('pengguna.tambah') }}" class="btn btn-primary">Tambah</a>
	</div>

</div>

<!-- data tabel -->
<table class="table table-striped table-sm">
	<thead>
		<tr>
			<th>Nama</th><th>Username</th><th>Email</th><th>Level</th><th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $field)
		<tr>
			<td>
				{{ $field->fullname }}
			</td>
			<td>
				{{ $field->username }}
			</td>
			<td>
				{{ $field->email }}
			</td>
			<td>
				{{ $field->level }}
			</td>
			
			<td class="text-right">
				<a href="{{ route('pengguna.edit',['id'=>$field->id]) }}" class="btn btn-sm btn-primary">
					<span class="fas fa-aw fa-edit"></span>
				</a>

				@if(Auth::user()->id != $field->id)
				<button type="button" class="btn btn-sm btn-danger tombol-hapus" data-toggle="modal" data-target="#deleteModal"  data-kodeid="{{ $field->id }}">
					<span class="fas fa-aw fa-trash-alt"></span>
				</button>
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<!-- halaman / pagging -->
{{ $data->appends(['cari'=>$cari])->links('vendor.pagination.bootstrap-4') }}

@endsection

@push('modal')
<!-- modal hapus -->

<div class="modal false" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModallabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModallabel">Yakin mau dihapus??</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				Pilih "Hapus" jika yakin untuk menghapusnya permanent!.
			</div>
			<div class="modal-footer">
				<button class="btn btn-btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a href="#" class="btn btn-primary tombol-send-hapus">Hapus</a>
			</div>

		</div>
	</div>
</div>

@endpush

@push('js')

<script>
	$(function(){
		$('.tombol-hapus').click(function(){
			var kd_id = $(this).attr('data-kodeid');
			var urlhapus = "{{ route('pengguna.hapus',['id'=>':dataid']) }}";
			urlhapus = urlhapus.replace(':dataid',kd_id);
			$('.tombol-send-hapus').attr('href',urlhapus);
		});
	});
</script>

@endpush
