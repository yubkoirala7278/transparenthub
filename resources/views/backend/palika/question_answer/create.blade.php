@extends('backend.layouts.master')
@section('header-links')
<style>
    .ck-editor__editable {
    min-height: 80px !important;
    /* Set the minimum height */
}
</style>
@endsection
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
                    <h5 class="mb-0 text-white">Create New Q&A For Municipality</h5>
                </div>
                <div class="card-body">
                    <form id="qna-form" action="{{ route('palika_qna.store') }}" method="POST">
                        @csrf

                        <!-- Palika Select -->
                        <div class="form-group">
                            <label for="palika_id" class="font-weight-bold">Municipality</label>
                            <select class="custom-select" name="palika_id" id="palika_id">
                                <option selected disabled>Select Palika</option>
                                @if (count($palikas) > 0)
                                    @foreach ($palikas as $palika)
                                        <option value="{{ $palika->id }}" {{ old('palika_id') == $palika->id ? 'selected' : '' }}>
                                            {{ $palika->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <!-- Error container for palika select field -->
                            <div class="error-message"></div>
                        </div>
                        

                        <!-- Dynamic Q&A Section -->
                        <div id="qna-wrapper">
                            <!-- Initial Q&A Row -->
                            <div class="qna-row form-row align-items-end mb-3">
                                <div class="col-12">
                                    <label class="font-weight-bold">Question</label>
                                    <input type="text" class="form-control" name="questions[]"
                                        placeholder="Enter Question" value="{{ old('questions.0') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="font-weight-bold">Answer</label>
                                    <textarea class="form-control ckeditor" name="answers[]" placeholder="Enter Answer">{{ old('answers.0') }}</textarea>
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-auto qna-actions mt-2">
                                    <button type="button" class="btn btn-success add-row"><i
                                            class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger remove-row"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Template for New Q&A Rows -->
                        <template id="qna-template">
                            <div class="qna-row form-row align-items-end mb-3">
                                <div class="col-12">
                                    <label class="font-weight-bold">Question</label>
                                    <input type="text" class="form-control" name="questions[]"
                                        placeholder="Enter Question" value="">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="font-weight-bold">Answer</label>
                                    <textarea class="form-control ckeditor" name="answers[]" placeholder="Enter Answer"></textarea>
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-auto qna-actions mt-2">
                                    <button type="button" class="btn btn-success add-row"><i
                                            class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger remove-row"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </template>


                        <!-- Hidden Template for New Q&A Rows -->
                        <template id="qna-template">
                            <div class="qna-row form-row align-items-end mb-3">
                                <div class="col-12">
                                    <label class="font-weight-bold">Question</label>
                                    <input type="text" class="form-control" name="questions[]"
                                        placeholder="Enter Question" value="">
                                </div>
                                <div class="col-12 mt-2">
                                    <label class="font-weight-bold">Answer</label>
                                    <textarea class="form-control ckeditor" name="answers[]" placeholder="Enter Answer"></textarea>
                                </div>
                                <div class="col-auto qna-actions mt-2">
                                    <button type="button" class="btn btn-success add-row"><i
                                            class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-danger remove-row"><i
                                            class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </template>

                        <!-- Global Status Selection -->
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

                        <!-- Submit and Reset Buttons -->
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
        document.addEventListener("DOMContentLoaded", function() {
            // Global array to hold CKEditor instances
            window.ckeditors = [];

            // Helper function to initialize CKEditor on a given textarea
            function initCKEditor(textarea) {
                ClassicEditor
                    .create(textarea, {
                        removePlugins: [
                            'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar',
                            'ImageUpload', 'Indent', 'MediaEmbed'
                        ]
                    })
                    .then(editor => {
                        // Store a reference to the editor instance on the textarea element
                        textarea.dataset.editorId = window.ckeditors.length;
                        window.ckeditors.push(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }

            // Initialize CKEditor for all existing textareas with class "ckeditor"
            document.querySelectorAll('textarea.ckeditor').forEach(textarea => {
                initCKEditor(textarea);
            });

            // Update the visibility of action buttons: show only on the last row
            function updateActionButtons() {
                const rows = document.querySelectorAll('#qna-wrapper .qna-row');
                rows.forEach((row, index) => {
                    let actions = row.querySelector('.qna-actions');
                    if (index === rows.length - 1) {
                        actions.style.display = 'block';
                    } else {
                        actions.style.display = 'none';
                    }
                });
            }
            updateActionButtons();

            // Add a new Q&A row using the template
            function addRow() {
                const templateHTML = document.getElementById('qna-template').innerHTML.trim();
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = templateHTML;
                const newRow = tempDiv.firstElementChild;
                document.getElementById('qna-wrapper').appendChild(newRow);

                // Initialize CKEditor on the new row's textarea(s)
                newRow.querySelectorAll('textarea.ckeditor').forEach(textarea => {
                    initCKEditor(textarea);
                });

                updateActionButtons();
            }

            // Remove a row (ensuring at least one row remains)
            function removeRow(rowElement) {
                const wrapper = document.getElementById('qna-wrapper');
                if (wrapper.querySelectorAll('.qna-row').length > 1) {
                    rowElement.remove();
                } else {
                    // Optionally, display a small inline message instead of an alert.
                    // (Alternatively, do nothing.)
                    $(rowElement).find('.qna-actions').append(
                        '<span class="text-danger d-block">At least one Q&A pair is required.</span>');
                    setTimeout(() => {
                        $(rowElement).find('.qna-actions .text-danger').fadeOut();
                    }, 2000);
                }
                updateActionButtons();
            }

            // Event delegation for add and remove buttons
            document.getElementById('qna-wrapper').addEventListener('click', function(e) {
                if (e.target.closest('.add-row')) {
                    addRow();
                }
                if (e.target.closest('.remove-row')) {
                    const row = e.target.closest('.qna-row');
                    removeRow(row);
                }
            });

            // AJAX form submission using jQuery
            $('#qna-form').on('submit', function(e) {
                e.preventDefault();

                // Clear any previous error messages
                $('#qna-form .error-message').html('');

                // Ensure each CKEditor instance updates its underlying textarea
                window.ckeditors.forEach(editor => editor.updateSourceElement());

                // Serialize form data (jQuery handles array fields automatically)
                let formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        // Optionally disable the submit button or show a spinner
                    },
                    success: function(response) {
                        // On success, display a success message below the form or redirect as needed.
                        $('#qna-form').prepend('<div class="alert alert-success">' + response
                            .message + '</div>');
                        // Optionally, you can redirect:
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, messages) {
                                if (key.indexOf('.') !== -1) {
                                    let parts = key.split('.');
                                    let fieldName = parts[
                                    0]; // e.g., "questions" or "answers"
                                    let index = parseInt(parts[1]);
                                    // Find the corresponding row (based on order)
                                    let row = $('#qna-wrapper .qna-row').eq(index);
                                    // Find the input/textarea field
                                    let field = row.find('[name="' + fieldName +
                                    '[]"]');
                                    // Instead of inserting the error message immediately after the field,
                                    // insert it into the dedicated error container below the field.
                                    let errorContainer = field.closest('.col-12').find(
                                        '.error-message');
                                    $.each(messages, function(i, message) {
                                        errorContainer.append(
                                            '<span class="text-danger d-block">' +
                                            message + '</span>');
                                    });
                                } else {
                                    // Global field errors like "palika_id" or "status"
                                    let field = $('[name="' + key + '"]');
                                    let errorContainer = field.closest('.form-group')
                                        .find('.error-message');
                                    $.each(messages, function(i, message) {
                                        errorContainer.append(
                                            '<span class="text-danger d-block">' +
                                            message + '</span>');
                                    });
                                }
                            });
                        } else {
                            // Optionally handle non-validation errors
                            $('#qna-form').prepend(
                                '<div class="alert alert-danger">An error occurred. Please try again.</div>'
                                );
                        }
                    },
                    complete: function() {
                        // Optionally re-enable the submit button or hide the spinner
                    }
                });
            });
        });
    </script>
@endpush
