@extends('layouts.main')
@section('content')
<h1>Pengguna</h1>
<hr>
<!-- Allert -->


@if(session('status-alert') == 'sukses')
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Yess!!</strong> Data berhasil diupdate bro.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hiddem="true">&times;</span>
	</button>
</div>
@endif

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

<div class="card border-info mb-3">
	<div class="card-header bg-info text-white">Setting Pengguna</div>
	<div class="card-body">
		<form method="post" action="{{ route('pengguna.setting.update') }}">
		{{ csrf_field()}}	
		<input type="hidden" name="id" value="{{ $field->id }}">
			<div class="form-group">
				<label>Nama</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="nama" class="form-control {{ $errors->has('nama')?'is-invalid':'' }}" value="{{ Request::old('nama',$field->fullname) }}" required autofocus>

						@if( $errors->has('nama') )
							<div class="invalid-feedback">
								{{ $errors->first('nama') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 5-50, contoh : wkwkwk
				</small>
			</div>

			<div class="form-group">
				<label>Username</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="username" class="form-control {{ $errors->has('username')?'is-invalid':'' }}" value="{{ Request::old('username',$field->username) }}" require autofocus>

						@if( $errors->has('username') )
							<div class="invalid-feedback">
								{{ $errors->first('username') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 5-50, dan tidak boleh ada spasi, <br> 
					Contoh : wkwkwkland, wkwkwk_land, wkwkwk-land
				</small>
			</div>

			<div class="form-group">
				<label>Email</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" value="{{ Request::old('email', $field->email) }}" required>

						@if( $errors->has('email') )
							<div class="invalid-feedback">
								{{ $errors->first('email') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Panjang karakter 15-50, contoh : wkwkwk@gmail.com
				</small>
			</div>

			<div class="form-group">
				<label>Password</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" >
						@if( $errors->has('password') )
							<div class="invalid-feedback">
								{{ $errors->first('password') }}
							</div>
						@endif
					</div>
				</div>
				<small>
					Kosongkan Password jika tidak mau diganti!
				</small>
			</div>

			<div class="form-group">
				<label>Konfirmasi Password</label>
				<div class="row">
					<div class="col-sm-6">
						<input type="password" name="repassword" class="form-control {{ $errors->has('repassword')?'is-invalid':'' }}" >
						@if( $errors->has('repassword') )
							<div class="invalid-feedback">
								{{ $errors->first('repassword') }}
							</div>
						@endif
					</div>
				</div> 
			</div>

			<hr>
			<div class="form-group text-right">
				<p>
					Pilih "Save" jika ingin menimpan data diatas.
				</p>
				
				<button type="submit" class="btn btn-info">Save</button>
			</div>

		</form>
	</div>
	<div class="card-footer bg-info"></div>
</div>

@endsection