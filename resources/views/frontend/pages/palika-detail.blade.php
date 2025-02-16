@extends('frontend.layouts.master')
@section('custom-css')
    <style>
        footer {
            margin-top: 0px !important;
        }

        .palika-detail-title {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .palika-detail-title.active {
            background-color: #f00;
            /* Highlight color */
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    <div class="container-fluid palika-detail">
        <div class="row">
            <!-- Sidebar with Questions -->
            <div class="col-md-3 d-none d-md-block title-section h-100">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <img src="{{ asset('frontend/img/palika-logo.png') }}" alt="">
                </div>
                <div id="question-list">
                    @foreach ($questions as $index => $question)
                        <h3 class="palika-detail-title fs-6 fw-semibold question" data-index="{{ $index }}">
                            {{ $question }}
                        </h3>
                    @endforeach
                </div>
            </div>

            <!-- Main Content with Q&A -->
            <div class="col-md-9 h-100" id="answer-section">
                @foreach ($palika->palikaQnAs as $index => $qna)
                    <div class="content-section" id="answer-{{ $index }}">
                        <h3>{{ $qna->question }}</h3>
                        <p>{!! $qna->answer !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionElems = document.querySelectorAll('.question');
            const answerElems = document.querySelectorAll('.content-section');

            // Function to highlight a question by index
            function highlightQuestion(index) {
                questionElems.forEach((qElem, idx) => {
                    qElem.classList.toggle('active', idx === index);
                });
            }

            // When a question in the sidebar is clicked, scroll to its answer smoothly
            questionElems.forEach((questionElem) => {
                questionElem.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    const targetAnswer = document.getElementById(`answer-${index}`);
                    if (targetAnswer) {
                        targetAnswer.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Immediately highlight the clicked question
                        highlightQuestion(index);
                    }
                });
            });

            // IntersectionObserver options:
            //  - threshold: 0.5 means the observer callback triggers when 50% of the answer is visible.
            const observerOptions = {
                root: null,
                threshold: 0.5
            };

            // Callback function for IntersectionObserver
            const observerCallback = (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Extract the index from the element's id (e.g., "answer-2")
                        const index = parseInt(entry.target.id.split('-')[1]);
                        highlightQuestion(index);
                    }
                });
            };

            // Create and attach the IntersectionObserver to each answer section
            const observer = new IntersectionObserver(observerCallback, observerOptions);
            answerElems.forEach(answer => observer.observe(answer));
        });
    </script>
@endpush
