@if($errors->any())
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<ul class="list-unstyled">
		@foreach($errors->all() as $error)
		<li class="py-0">{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
@if(session('thongbao'))
<div class="alert alert-{{ session('type') }} alert-dismissible">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong style="font-size: 1rem">{{ session('thongbao') }}</strong>
</div>
@endif