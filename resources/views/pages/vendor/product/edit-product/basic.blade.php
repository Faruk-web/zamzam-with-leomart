<style>
    #single-image-preview{
        display: flex;
        flex-wrap: wrap;
    }
    #previews {
        display: flex;
        flex-wrap: wrap;
    }

    #single-image-preview img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin: 10px;
        border: 1px solid #ccc;
    }
    #previews img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin: 10px;
        border: 1px solid #ccc;
    }
</style>
@php
    $submission = \App\Models\Product::where('submission', 1)->first();
    // dd($submission);
@endphp

{{-- @dd( $product); --}}
    <form action="{{ route('edit.update-1') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card-header mb-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <div class="form-check form-check-inline ">
                                            <input class="form-check-input group1" id="retail" type="checkbox" name="retail" value="1" value="1" style="height: 30px; width: 20px" {{$product->retail == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="retail">Retail</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <div  class="form-check form-check-inline my-checkbox">
                                            <input class="form-check-input group1" id="wholesale" type="checkbox" name="wholesale" value="1" value="1" style="height: 30px; width: 20px" {{$product->wholesale == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="wholesale">Wholesale</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <div class="form-check form-check-inline my-checkbox">
                                            <input class="form-check-input group1" id="noCrossCheck" type="checkbox" name="cross_border" value="1" value="1" style="height: 30px; width: 20px" {{$product->cross_border == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="noCrossCheck">Cross Border</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="row">
                                    <div class="form-group col-md-9">
                                        <div class="form-check form-check-inline my-checkbox">
                                            <input class="form-check-input group1" id="preOrderCheck" type="checkbox" name="pre_order" value="1" value="1" style="height: 30px; width: 20px" {{$product->pre_order == 1 ? 'checked' : ''}}>
                                            <label class="form-check-label" for="preOrderCheck">Pre-order</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @dd($categories); --}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="productname">Product Name</label>
                        <input id="productname" name="product_id" value="{{$product->id}}" type="hidden"/>
                        <input id="productname" name="title" value="{{$product->title}}" type="text" class="form-control" placeholder="Product Name" @error('title') is-invalid @enderror  />
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                        @enderror
                    </div>
                </div>
                {{-- @dd($product); --}}
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="control-label">Select Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option selected disabled>Select Category</option>
                            {{-- <option value="{{ $category_edit->id }}">{{ $category_edit->title }}</option> --}}
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                            {{-- @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="control-label">Sub Category</label>
                        <select id="sub_category" name="sub_category_id" class=" form-control @error('sub_category_id') is-invalid @enderror">
                            <option value="">Please Select a Sub Category</option>
                            {{-- <option value="{{$category_edit->id}}" {{$category_edit->id == $product->sub_category_id ? 'selected' : ''}}>{{$category_edit->title}}</option> --}}
                            @foreach($categories as $category)
                                @foreach($category->child as $subCategory)
                                <option value="{{$subCategory->id}}" {{$subCategory->id == $product->sub_category_id ? 'selected' : ''}}>{{$subCategory->title}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="manufacturername">Brand</label>
                        <select name="brand_id" class="form-control select2-custom">
                            <option selected disabled>Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>{{$brand->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="code">Product Code</label>
                        <input id="code" name="code" value="{{$product->code}}" readonly type="text" class="form-control" placeholder="Product Code">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="datetime">Product Weight</label>
                        <input type="number" min="1" name="weight" value="{{$product->weight}}" class="form-control" placeholder="Product Weight"/>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input group2" type="checkbox" name="unit" id="gm" value="gm" {{$product->unit == 'gm' ? 'checked' : ''}}>
                            <label class="form-check-label" for="gm">gm</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input group2" type="checkbox" name="unit" id="kg" value="kg" {{$product->unit == 'kg' ? 'checked' : ''}}>
                            <label class="form-check-label" for="kg">kg</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input group2" type="checkbox" name="unit" id="ml" value="ml" {{$product->unit == 'ml' ? 'checked' : ''}}>
                            <label class="form-check-label" for="ml">ml</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input group2" type="checkbox" name="unit" id="litter" value="litter" {{$product->unit == 'litter' ? 'checked' : ''}}>
                            <label class="form-check-label" for="litter">litter</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Product Image </h3>
                            </div>
                            <div class="card-body">
                                <input class="file" type="file" name="image" id="file">
                                @if($product->image)
                                    <img class="single-image" id="single-image-preview" src="{{asset($product->image)}}" alt="" height="80px">
                                @else
                                    <img class="single-image" id="single-image-preview" src="#" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Product Gallery Image </h3>
                            </div>
                            <div class="card-body">
                                <input type="file" name="gallery[]" id="files" multiple>
                                <div id="previews">
                                    @if($product->image)
                                        @foreach($product->product_image as $image)
                                            <img src="{{asset($image->image)}}" alt="" height="80px" width="80px">
                                        @endforeach
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-right">Save</button>
    </form>



<!-- JavaScript code -->
<script>
    // Get the file input fields and preview containers
    const fileInput = document.querySelector('.file');
    const filesInput = document.querySelector('#files');
    const singleImagePreview = document.querySelector('#single-image-preview');
    const previewsContainer = document.querySelector('#previews');

    // Listen for changes to the file input field
    fileInput.addEventListener('change', () => {
        // Get the selected file
        const file = fileInput.files[0];

        // Create a file reader object
        const reader = new FileReader();

        // Set up a function to run when the file has been loaded
        reader.onload = () => {
            // Update the single image preview
            singleImagePreview.src = reader.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
    });

    // Listen for changes to the multiple file input field
    filesInput.addEventListener('change', () => {
        // Clear the multiple preview container
        previewsContainer.innerHTML = '';

        // Loop through the selected files
        for (let i = 0; i < filesInput.files.length; i++) {
            // Get the selected file
            const file = filesInput.files[i];

            // Create a file reader object
            const reader = new FileReader();

            // Set up a function to run when the file has been loaded
            reader.onload = () => {
                // Create a new image element
                const image = document.createElement('img');
                image.src = reader.result;

                // Add the image to the multiple preview container
                previewsContainer.appendChild(image);
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        }
    });
</script>
