@if (count($professionals) > 0)
    @foreach ($professionals as $professional)
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
            <div class="box shadow">
                <img src="{{ asset($professional->professional->profile_image) }}" class="w-100"
                     alt="{{ $professional->name }}" loading="lazy">
                <div class="box-body">
                    <p class="m-0"><strong>{{ $professional->name }}</strong></p>
                    <small>
                        {{ $professional->professional->category->name }}
                        ({{ $professional->professional->subCategory->name }})
                    </small>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                        <a href="{{ route('professional.detail', $professional->slug) }}"
                           class="btn btn-primary p-2" style="font-size: 13px;">View</a>
                           <a href="{{ route('professional.detail', $professional->slug) }}"
                            class="btn btn-danger p-2" style="font-size: 13px;">Appoinment</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center">Nothing to display</div>
@endif
