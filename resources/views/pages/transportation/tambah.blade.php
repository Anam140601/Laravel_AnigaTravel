@extends('layouts.main')
@section('content')

<h1>Transportasi</h1>
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
	<div class="card-header bg-info text-white">Tambah Transportasi</div>
	<div class="card-body">
		<form method="post" action="{{ route('transportation.simpan') }}">
		{{ csrf_field()}}	

			<div class="form-group">
				<label>Tipe Transportasi</label>
				<div class="row">
					<div class="col-sm-4">
						<select class="form-control {{$errors->has('tipe')?'is-invalid':''}}" name="tipe" required autofocus>
							<option value="">Pilih : </option>
							<?php 
								$val = Request::old('tipe');
								$res = App\TransportationType::orderBy('description','asc')->get();
							 ?>
							 @foreach($res as $opt)
							 	<option value="{{$opt->id}}" {{$val==$opt->id?'selected':''}}>{{$opt->description}}</option>
							 @endforeach
						</select>

						@if( $errors->has('tipe') )
							<div class="invalid-feedback">
								{{ $errors->first('tipe') }}
							</div>
						@endif
					</div>
				</div>
			</div>

			<div class="form-group">
				<label>Kode / Nama Transportasi</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="kode" class="form-control {{ $errors->has('kode')?'is-invalid':'' }}" value="{{ Request::old('kode') }}" require>

						@if( $errors->has('kode') )
							<div class="invalid-feedback">
								{{ $errors->first('kode') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 2-50, contoh :  Hiraisin
				</small>
			</div>


			<div class="form-group">
				<label>Deskripsi</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="deskripsi" class="form-control {{ $errors->has('deskripsi')?'is-invalid':'' }}" value="{{ Request::old('deskripsi') }}" require autofocus>

						@if( $errors->has('deskripsi') )
							<div class="invalid-feedback">
								{{ $errors->first('deskripsi') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 2-50, contoh :  PT.Wkwkwk Land
				</small>
			</div>

			<div class="form-group">
				<label>Kapasitas Tenpat Duduk</label>
				<div class="row">
					<div class="col-sm-2">
						<input type="number" name="kapasitas" class="form-control {{ $errors->has('kapasitas')?'is-invalid':'' }}" value="{{ Request::old('kapasitas') }}" require autofocus>

						@if( $errors->has('kapasitas') )
							<div class="invalid-feedback">
								{{ $errors->first('kapasitas') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 1-5, contoh :  1000
				</small>
			</div>






			<hr>
			<div class="form-group text-right">
				<p>
					Pilih "Save" jika ingin menimpan data diatas.
				</p>
				<a href="{{ route('transportation.data') }}" class="btn btn-secondary">Cancel</a>
				<button type="submit" class="btn btn-info">Save</button>
			</div>

		</form>
	</div>
	<div class="card-footer bg-info"></div>
</div>

@endsection