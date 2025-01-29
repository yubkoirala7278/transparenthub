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
                    <a href="{{ route('news.index') }}" style="color: #2C3E50">News</a>
                </li>
            </ul>
            <a href="{{ route('news.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Create News</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- title --}}
                        <div class="form-group">
                            <label for="title" class="font-weight-bold">News Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter News Title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        {{-- description --}}
                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea class="form-control" id="description" column="7" name="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>


                        {{-- category --}}
                        <div class="form-group">
                            <label for="category" class="font-weight-bold">Category</label>
                            <select class="form-control" name="category">
                                <option selected disabled>Select Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('category'))
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            @endif
                        </div>
                        {{-- rss --}}
                        <div class="form-group">
                            <label for="rss" class="font-weight-bold">साभार(Optional)</label>
                            <input type="text" class="form-control" id="rss" name="rss" placeholder="Enter RSS"
                                value="{{ old('rss') }}">
                            @if ($errors->has('rss'))
                                <span class="text-danger">{{ $errors->first('rss') }}</span>
                            @endif
                        </div>
                        {{-- source --}}
                        <div class="form-group">
                            <label for="source" class="font-weight-bold">News Source(Optional)</label>
                            <select class="form-control" name="source">
                                <option selected disabled>Select Source</option>
                                @if (count($sources) > 0)
                                    @foreach ($sources as $source)
                                        <option value="{{ $source->id }}"
                                            {{ old('source') == $source->id ? 'selected' : '' }}>
                                            {{ $source->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('source'))
                                <span class="text-danger">{{ $errors->first('source') }}</span>
                            @endif
                        </div>

                        {{-- status --}}
                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status</label>
                            <div class="d-flex align-items-center" style="gap: 20px">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="active" {{ old('status', 'active') === 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                        value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inactive">Inactive</label>
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            @endif
                        </div>
                        {{-- trending news --}}
                        <div class="form-group">
                            <label for="trending_news" class="font-weight-bold">Trending News</label>
                            <div class="d-flex align-items-center" style="gap: 20px">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trending_news" value="1"
                                        {{ old('trending_news', '1') === '1' ? 'checked' : '' }} id="trending_news">
                                    <label class="form-check-label" for="trending_news">Trending</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="trending_news" value="0"
                                        {{ old('trending_news', '0') === '0' ? 'checked' : '' }} id="not_trending_news" checked>
                                    <label class="form-check-label" for="not_trending_news">Not Trending</label>
                                </div>
                            </div>
                            @if ($errors->has('trending_news'))
                                <span class="text-danger">{{ $errors->first('trending_news') }}</span>
                            @endif
                        </div>
                        

                        {{-- image --}}
                        <div class="form-group">
                            <label for="image" class="font-weight-bold">Upload Feature Image</label>
                            <input type="file" class="form-control-file" id="image" name="image"
                                accept="image/jpeg, image/png, image/jpg, image/gif, image/webp, image/svg">
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
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
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',
                },
            })
            .then(editor => {
                let previousImages = [];

                // Detect content changes in CKEditor
                editor.model.document.on('change:data', () => {
                    const content = editor.getData();
                    const currentImages = extractImageSources(content);

                    // Compare previous and current images to find deleted ones
                    const deletedImages = previousImages.filter(img => !currentImages.includes(img));
                    if (deletedImages.length > 0) {
                        deleteImagesFromServer(deletedImages);
                    }

                    previousImages = currentImages; // Update the image list
                });

                // Extract image URLs from content
                function extractImageSources(content) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = content;
                    const images = Array.from(tempDiv.querySelectorAll('img')).map(img => img.getAttribute('src'));
                    return images;
                }

                // Send a request to delete images from the server
                function deleteImagesFromServer(images) {
                    fetch('{{ route('ckeditor.delete') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                images
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                console.error('Failed to delete images:', data.message);
                            }
                        })
                        .catch(error => console.error('Error deleting images:', error));
                }
            })
            .catch(error => console.error('Error initializing CKEditor:', error));
    </script>
@endpush
