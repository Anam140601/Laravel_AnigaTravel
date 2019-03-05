@extends('layouts.main')

@section('content')

<h1>Pelanggan</h1>
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
		<a href="{{ route('customer.tambah') }}" class="btn btn-primary">Tambah</a>
	</div>

</div>

<!-- data tabel -->

<?php 
	$type = App\TransportationType::orderBy('description','asc')->get();
 ?>


<table class="table table-striped table-sm">
	<thead>
		<tr>
			<th>Nama</th><th>Gender</th><th>No.Telp</th><th>Alamat</th><th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	@foreach($data as $field)
		<tr>
			<td>
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
						Pesan Tiket
					</button>
					<div class="dropdown-menu">
						@foreach($type as $row)
						<a href="{{route('reservation.pesan',['id_customer'=>$field->id,'id_type'=>$row->id])}}" class="dropdown-item">
							{{$row->description}}
						</a>
						@endforeach
					</div>
				</div>

				{{ $field->name }}
			</td>
			<td>
				{{ $field->gender }}
			</td>
			<td>
				{{ $field->phone }}
			</td>
			<td>
				{{ $field->address }}
			</td>

			<td class="text-right">
				<a href="{{ route('customer.edit',['id'=>$field->id]) }}" class="btn btn-sm btn-primary">
					<span class="fas fa-aw fa-edit"></span>
				</a>

				<button type="button" class="btn btn-sm btn-danger tombol-hapus" data-toggle="modal" data-target="#deleteModal"  data-kodeid="{{ $field->id }}">
					<span class="fas fa-aw fa-trash-alt"></span>
				</button>
				
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
			var urlhapus = "{{ route('customer.hapus',['id'=>':dataid']) }}";
			urlhapus = urlhapus.replace(':dataid',kd_id);
			$('.tombol-send-hapus').attr('href',urlhapus);
		});
	});
</script>

@endpush