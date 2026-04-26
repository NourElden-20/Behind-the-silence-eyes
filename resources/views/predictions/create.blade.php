@extends('layouts.app')

@section('main-content')
<div class="container-fluid py-4">

    {{-- Back Button --}}
    <a href="{{ route('patients.show', $patient->id) }}"
        class="text-decoration-none text-secondary d-inline-flex align-items-center gap-1 mb-3">
        <i class="fas fa-arrow-left"></i> Back to Patient Profile
    </a>

    {{-- Title --}}
    <h4 class="fw-bold mb-1">AI Eye Disease Diagnosis</h4>
    <p class="text-muted mb-4">Patient: {{ $patient->name }}</p>

    <form action="{{ route('predictions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

        <div class="row">

            {{-- Left Column --}}
            <div class="col-md-7">

                {{-- Select Disease --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Select Disease Type</h6>

                        {{-- Diabetes --}}
                        <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                            style="cursor:pointer;">
                            <div class="d-flex align-items-center gap-3">
                                <input type="radio" name="disease_type" value="diabetes"
                                    class="form-check-input mt-0" checked>
                                <div>
                                    <p class="fw-bold mb-0">Diabetic Retinopathy</p>
                                    <small class="text-muted">5 severity levels • 83% accuracy</small>
                                </div>
                            </div>
                            <span class="badge bg-success">Ready</span>
                        </div>

                        {{-- Anemia --}}
                        <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                            style="cursor:pointer;">
                            <div class="d-flex align-items-center gap-3">
                                <input type="radio" name="disease_type" value="anemia"
                                    class="form-check-input mt-0">
                                <div>
                                    <p class="fw-bold mb-0">Anemia Detection</p>
                                    <small class="text-muted">Binary classification</small>
                                </div>
                            </div>
                            <span class="badge bg-warning text-dark">Beta</span>
                        </div>

                        {{-- Hypertension --}}
                        <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center"
                            style="cursor:pointer;">
                            <div class="d-flex align-items-center gap-3">
                                <input type="radio" name="disease_type" value="hypertension"
                                    class="form-check-input mt-0">
                                <div>
                                    <p class="fw-bold mb-0">Hypertensive Retinopathy</p>
                                    <small class="text-muted">Binary classification</small>
                                </div>
                            </div>
                            <span class="badge bg-warning text-dark">Beta</span>
                        </div>

                    </div>
                </div>

                {{-- Upload Image --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Upload Retinal Image</h6>

                        <div class="border rounded p-5 text-center"
                            style="border-style:dashed !important; cursor:pointer;"
                            onclick="document.getElementById('imageInput').click()">
                            <i class="fas fa-upload fa-2x text-muted mb-2"></i>
                            <p class="mb-1 text-muted">Click to upload or drag and drop</p>
                            <small class="text-muted">PNG, JPG up to 10MB</small>
                            <input type="file" id="imageInput" name="image"
                                accept="image/*" class="d-none"
                                onchange="previewImage(this)">
                        </div>

                        {{-- Image Preview --}}
                        <div id="imagePreview" class="mt-3 d-none text-center">
                            <img id="previewImg" src="" class="img-fluid rounded" style="max-height:200px;">
                        </div>

                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                {{-- Notes --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Notes (Optional)</h6>
                        <textarea name="notes" class="form-control" rows="3"
                            placeholder="Add any additional notes..."></textarea>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                    <i class="fas fa-brain me-2"></i> Analyze
                </button>

            </div>

            {{-- Right Column - Result --}}
            <div class="col-md-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 d-flex flex-column align-items-center justify-content-center text-center">
                        <i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Upload an image and click "Analyze" to get AI diagnosis</p>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection