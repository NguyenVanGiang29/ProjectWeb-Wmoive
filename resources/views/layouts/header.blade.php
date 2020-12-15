<nav class="fixed-top navbar navbar-expand navbar-light bg-white border-bottom border-light" >
    <div class="container">
            
        <ul class="navbar-nav font-weight-normal text-uppercase">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="image/logo.svg" style="width: 2rem">
            </a>

            <div style="width: 0; border-right: 1px solid rgb(8, 24, 11)"></div>
            
            <form action="" class="form-inline mx-3" method="GET">
                <div class="input-group">
                    <input type="search" name="keyword" class="form-control rounded-pill border-0 bg-light"
                     placeholder="Tìm kiếm..." aria-describedby="button-search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary d-none" type="submit" id="button-search">Tìm</button>
                    </div>
                </div>
            </form>

            
            <li class="nav-item">
                <a class="d-none d-sm-block nav-link" href="{{ route('all-movies') }}" style="color: rgb(8, 6, 6)"  role="button">Phim</a> 
            </li>
            <li class="nav-item">
                <a class="d-none d-sm-block nav-link" href="" style="color: rgb(8, 8, 8)">Cộng đồng</a>
            </li>
            <li class="nav-item">
                <a class="d-none d-sm-block nav-link" href="" style="color: rgb(8, 7, 7)">Hợp tác</a>
            </li>    
        </ul>

        <ul class="navbar-nav font-weight-normal text-capitalize ml-sm-auto ml-auto">
           {{-- mm --}}
        </ul>
        
    </div>
</nav>
