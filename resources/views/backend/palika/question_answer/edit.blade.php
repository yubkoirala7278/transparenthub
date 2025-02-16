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
                    <a href="{{ route('palika_qna.index') }}" style="color: #2C3E50">Municipality Q&A</a>
                </li>
            </ul>
            <a href="{{ route('palika_qna.index') }}" class="btn text-white btn-sm rounded-pill px-3 py-2"
                style="background-color: #2C3E50">Back</a>
        </div>
        <div>
            <div class="card shadow" style="border-top:none;">
                <div class="card-header" style="background-color: #2C3E50">
                    <h5 class="mb-0 text-white">Update Municipality Q&A</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('palika_qna.update', $palika_qna->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="question" class="font-weight-bold">Question</label>
                            <input type="text" class="form-control" id="question" name="question"
                                placeholder="Enter Question" value="{{ old('question', $palika_qna->question) }}">
                            @if ($errors->has('question'))
                                <span class="text-danger">{{ $errors->first('question') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="answer" class="font-weight-bold">Answer</label>
                            <textarea  class="form-control" id="answer" name="answer"
                                placeholder="Enter Answer">{{ old('answer', $palika_qna->answer) }}</textarea>
                            @if ($errors->has('answer'))
                                <span class="text-danger">{{ $errors->first('answer') }}</span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="palika_id" class="font-weight-bold">Municipality</label>
                            <select class="custom-select" name="palika_id" id="palika_id">
                                @if ($palikas->count() > 0)
                                    @foreach ($palikas as $palika)
                                        <option value="{{ $palika->id }}"
                                            {{ old('palika_id', $palika_qna->palika_id ?? '') == $palika->id ? 'selected' : '' }}>
                                            {{ $palika->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('palika_id'))
                                <span class="text-danger">{{ $errors->first('palika_id') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status" class="font-weight-bold">Status</label>
                            <div class="d-flex align-items-center" style="gap: 20px">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="active"
                                        value="active"
                                        {{ old('status', $palika_qna->status) === 'active' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                        value="inactive"
                                        {{ old('status', $palika_qna->status) === 'inactive' ? 'checked' : '' }}>
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
        $(document).ready(function() {
            ClassicEditor
                .create(document.querySelector('#answer'), {
                    removePlugins: ['Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload',
                        'Indent', 'ImageUpload', 'MediaEmbed'
                    ],
                })
                .catch(error => {
                    console.error(error.stack);
                });
        });
    </script>
@endpush
