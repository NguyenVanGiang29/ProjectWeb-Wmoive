@if($errors->any())
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<ul class="list-unstyled">
		@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
@if(session('thongbao'))
<div class="alert alert-{{ session('type') }} py-2">
	<strong>{{ session('thongbao') }}</strong>
</div>
@endif