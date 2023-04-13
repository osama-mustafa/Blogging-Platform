{{-- Footer --}}
<footer class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 ml-5 mr-5 mb-3">
                <h4 class="lead text-white">Categories</h4>
                <hr class="dashed" style="color:white;background-color:white">

                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class=" d-flex justify-content-between align-items-center">
                        <a href="{{ route('category.page', ['category_name' => $category->name]) }}" class="text-white">{{ $category->name }}</a>
                        <span class="badge badge-primary badge-pill">{{ $category->posts->count() }}</span>
                        </li>
                    @endforeach
                  </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <p class="m-0 text-center text-white">Copyright &copy; Blogging-System 2021</p>
                <p class="m-0 text-center text-white">
                    Made with  <i class="fas fa-heart"></i> and alot of  <i class="fas fa-coffee"></i>  by
                    Osama Mustafa 
                </p>
            </div>
        </div>
    </div>
    {{-- End of Container --}}
</footer>