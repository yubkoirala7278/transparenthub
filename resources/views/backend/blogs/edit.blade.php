@extends('backend.layouts.master')
@section('content')
    <!-- [ Main Content ] start -->
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-house" style="color: #2C3E50"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="" style="color: #2C3E50">Blogs</a>
                </li>
            </ul>
            <a href="{{ route('blogs.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Update Blog</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('blogs.update',$blog->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter Title" value="{{ old('title',$blog->title) }}">
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" id="description" rows="4" name="description" placeholder="Enter Description">{{ old('description',$blog->description) }}</textarea>
                            @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        </div>
                        <div class="form-group">
                            <label for="image" class="font-weight-bold">Upload Image</label>
                            <input type="file" class="form-control-file" id="image" name="image"
                                accept="image/jpeg, image/png, image/jpg, image/gif, image/webp, image/svg">
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status</label>
                            <div class="d-flex align-items-center" style="gap: 20px">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="active" {{ old('status', $blog->status) === 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                        value="inactive" {{ old('status', $blog->status) === 'inactive' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload',
                        'Indent', 'ImageUpload', 'MediaEmbed'
                    ]
                });
        });
    </script>
@endpush
