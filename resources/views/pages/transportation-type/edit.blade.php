@extends('layouts.main')
@section('content')

<h1>Tipe Transportasi</h1>
<hr>

<!-- Allert -->

@if(session('status-alert') == 'peringatan')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
	<strong>Upps Salah!!</strong> Ada kesalahan bro, data gagal disimpan.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hiddem="true">&times;</span>
	</button>
</div>
@endif


@if(session('status-alert') == 'gagal')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Sorry bro!!</strong> Data gagal dihapus dari database.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hiddem="true">&times;</span>
	</button>
</div>
@endif

<!-- formulir -->

<div class="card border-info mb-3">
	<div class="card-header bg-info text-white">Edit Tipe Kendaraan</div>
	<div class="card-body">
		<form method="post" action="{{ route('transportation-type.update') }}">
		{{ csrf_field()}}
		<input type="hidden" name="id" value="{{$field->id}}"/>	
			<div class="form-group">
				<label>Deskripsi</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="deskripsi" class="form-control {{ $errors->has('deskripsi')?'is-invalid':'' }}" value="{{ Request::old('deskripsi',$field->description) }}" require autofocus>

						@if( $errors->has('deskripsi') )
							<div class="invalid-feedback">
								{{ $errors->first('deskripsi') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 2-50, contoh :  Pesawat
				</small>
			</div>




			<hr>
			<div class="form-group text-right">
				<p>
					Pilih "Save" jika ingin menimpan data diatas.
				</p>
				<a href="{{ route('transportation-type.data') }}" class="btn btn-secondary">Cancel</a>
				<button type="submit" class="btn btn-info">Save</button>
			</div>

		</form>
	</div>
	<div class="card-footer bg-info"></div>
</div>

@endsection