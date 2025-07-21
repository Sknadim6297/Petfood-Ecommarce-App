@extends('admin.layouts.app')

@section('title', 'Upload Files')
@section('page-title', 'Upload Files')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dark fw-bold mb-1">📁 Upload Files</h2>
            <p class="text-muted mb-0">Add new files to your image library</p>
        </div>
        <a href="{{ route('admin.content.image-library.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Library
        </a>
    </div>

    <div class="row">
        <!-- Upload Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">🔄 File Upload</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.content.image-library.store') }}" method="POST" 
                          enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        
                        <!-- Drag & Drop Zone -->
                        <div class="upload-zone border-2 border-dashed rounded p-5 text-center mb-4" 
                             id="uploadZone">
                            <div class="upload-placeholder">
                                <div class="mb-3">
                                    <i class="fas fa-cloud-upload-alt fa-4x text-muted"></i>
                                </div>
                                <h5 class="text-dark mb-2">Drag & Drop Files Here</h5>
                                <p class="text-muted mb-3">or click to browse files</p>
                                <input type="file" class="form-control d-none" id="files" name="files[]" 
                                       multiple accept="image/*,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                <button type="button" class="btn btn-primary" id="browseBtn">
                                    <i class="fas fa-folder-open"></i> Browse Files
                                </button>
                            </div>
                            
                            <!-- Upload Progress -->
                            <div class="upload-progress d-none">
                                <div class="mb-3">
                                    <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                                </div>
                                <h6 class="text-primary">Uploading files...</h6>
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- File Preview Area -->
                        <div class="file-preview-area d-none">
                            <h6 class="fw-semibold text-dark mb-3">📋 Selected Files</h6>
                            <div class="row g-3" id="filePreviewContainer">
                                <!-- File previews will be added here -->
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions mt-4 d-none">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-outline-secondary" id="clearFiles">
                                    <i class="fas fa-times"></i> Clear All
                                </button>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary" id="addMoreFiles">
                                        <i class="fas fa-plus"></i> Add More Files
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="uploadSubmitBtn">
                                        <i class="fas fa-upload"></i> Upload Files
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Upload Results -->
            <div class="upload-results d-none mt-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-semibold text-dark">📊 Upload Results</h5>
                    </div>
                    <div class="card-body">
                        <div id="uploadResultsContainer">
                            <!-- Results will be added here -->
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.content.image-library.index') }}" class="btn btn-primary">
                                <i class="fas fa-images"></i> View Library
                            </a>
                            <button type="button" class="btn btn-outline-primary" onclick="location.reload()">
                                <i class="fas fa-plus"></i> Upload More
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Tips -->
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">💡 Upload Tips</h5>
                </div>
                <div class="card-body">
                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-file-image text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Supported Formats</h6>
                                <small class="text-muted">JPG, PNG, GIF, WebP, PDF, DOC, XLS, PPT</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-weight-hanging text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">File Size Limit</h6>
                                <small class="text-muted">Maximum 10MB per file</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-images text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Multiple Upload</h6>
                                <small class="text-muted">Select multiple files at once</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item mb-3">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-hand-paper text-info"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Drag & Drop</h6>
                                <small class="text-muted">Simply drag files from your computer</small>
                            </div>
                        </div>
                    </div>

                    <div class="tip-item">
                        <div class="d-flex">
                            <div class="icon-circle bg-light me-3">
                                <i class="fas fa-compress-alt text-danger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Auto Optimization</h6>
                                <small class="text-muted">Images are automatically optimized</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Uploads -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-semibold text-dark">🕒 Recent Uploads</h5>
                </div>
                <div class="card-body">
                    @php
                        $recentUploads = \App\Models\ImageLibrary::orderBy('created_at', 'desc')->take(5)->get();
                    @endphp
                    
                    @if($recentUploads->count() > 0)
                        @foreach($recentUploads as $recent)
                            <div class="d-flex align-items-center mb-3">
                                <div class="file-icon me-3">
                                    @if(str_starts_with($recent->mime_type, 'image/'))
                                        <img src="{{ asset($recent->path) }}" alt="" 
                                             class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="icon-circle bg-light">
                                            <i class="fas fa-file text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 text-truncate">{{ $recent->title }}</h6>
                                    <small class="text-muted">{{ $recent->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center mb-0">No recent uploads</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.upload-zone {
    border-color: #dee2e6;
    background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%), 
                linear-gradient(-45deg, #f8f9fa 25%, transparent 25%), 
                linear-gradient(45deg, transparent 75%, #f8f9fa 75%), 
                linear-gradient(-45deg, transparent 75%, #f8f9fa 75%);
    background-size: 20px 20px;
    background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
    transition: all 0.3s ease;
    cursor: pointer;
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-zone:hover,
.upload-zone.dragover {
    border-color: var(--pet-orange);
    background-color: rgba(250, 68, 29, 0.05);
}

.upload-zone.dragover {
    transform: scale(1.02);
}

.icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-preview-card {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.file-preview-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.progress {
    height: 8px;
    border-radius: 4px;
}

.progress-bar {
    border-radius: 4px;
    transition: width 0.3s ease;
}

.tip-item {
    padding: 12px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.tip-item:hover {
    background-color: rgba(250, 68, 29, 0.05);
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadZone = document.getElementById('uploadZone');
    const fileInput = document.getElementById('files');
    const browseBtn = document.getElementById('browseBtn');
    const uploadForm = document.getElementById('uploadForm');
    const filePreviewArea = document.querySelector('.file-preview-area');
    const filePreviewContainer = document.getElementById('filePreviewContainer');
    const formActions = document.querySelector('.form-actions');
    const clearFilesBtn = document.getElementById('clearFiles');
    const addMoreFilesBtn = document.getElementById('addMoreFiles');
    const uploadSubmitBtn = document.getElementById('uploadSubmitBtn');
    const uploadPlaceholder = document.querySelector('.upload-placeholder');
    const uploadProgress = document.querySelector('.upload-progress');
    const uploadResults = document.querySelector('.upload-results');
    const uploadResultsContainer = document.getElementById('uploadResultsContainer');

    let selectedFiles = [];

    // Browse button click
    browseBtn.addEventListener('click', () => fileInput.click());
    uploadZone.addEventListener('click', () => fileInput.click());

    // File input change
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.remove('dragover'), false);
    });

    uploadZone.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    });

    // Handle selected files
    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (validateFile(file)) {
                selectedFiles.push(file);
                createFilePreview(file);
            }
        });
        
        if (selectedFiles.length > 0) {
            showFilePreview();
        }
    }

    // Validate file
    function validateFile(file) {
        const maxSize = 10 * 1024 * 1024; // 10MB
        const allowedTypes = [
            'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ];

        if (file.size > maxSize) {
            showToast(`File "${file.name}" is too large. Maximum size is 10MB.`, 'error');
            return false;
        }

        if (!allowedTypes.includes(file.type)) {
            showToast(`File "${file.name}" is not a supported format.`, 'error');
            return false;
        }

        return true;
    }

    // Create file preview
    function createFilePreview(file) {
        const fileId = Date.now() + Math.random();
        const fileSize = formatFileSize(file.size);
        
        const previewHtml = `
            <div class="col-md-6 file-preview-item" data-file-id="${fileId}">
                <div class="card file-preview-card border-0 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="file-icon me-3">
                                ${file.type.startsWith('image/') ? 
                                    `<img src="${URL.createObjectURL(file)}" alt="" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">` :
                                    `<div class="icon-circle bg-light"><i class="fas fa-file text-muted"></i></div>`
                                }
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-truncate">${file.name}</h6>
                                <small class="text-muted">${fileSize}</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-file" data-file-id="${fileId}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        filePreviewContainer.insertAdjacentHTML('beforeend', previewHtml);
        
        // Attach file to preview element for later retrieval
        const previewElement = document.querySelector(`[data-file-id="${fileId}"]`);
        previewElement.fileObject = file;
    }

    // Show file preview area
    function showFilePreview() {
        filePreviewArea.classList.remove('d-none');
        formActions.classList.remove('d-none');
    }

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Remove file
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-file')) {
            const fileId = e.target.closest('.remove-file').dataset.fileId;
            const previewElement = document.querySelector(`[data-file-id="${fileId}"]`);
            
            // Remove from selectedFiles array
            const fileIndex = selectedFiles.findIndex(f => f === previewElement.fileObject);
            if (fileIndex > -1) {
                selectedFiles.splice(fileIndex, 1);
            }
            
            // Remove preview element
            previewElement.remove();
            
            // Hide preview area if no files
            if (selectedFiles.length === 0) {
                filePreviewArea.classList.add('d-none');
                formActions.classList.add('d-none');
            }
        }
    });

    // Clear all files
    clearFilesBtn.addEventListener('click', function() {
        selectedFiles = [];
        filePreviewContainer.innerHTML = '';
        filePreviewArea.classList.add('d-none');
        formActions.classList.add('d-none');
        fileInput.value = '';
    });

    // Add more files
    addMoreFilesBtn.addEventListener('click', () => fileInput.click());

    // Form submission
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (selectedFiles.length === 0) {
            showToast('Please select files to upload', 'warning');
            return;
        }
        
        uploadFiles();
    });

    // Upload files
    function uploadFiles() {
        const formData = new FormData();
        
        selectedFiles.forEach((file, index) => {
            formData.append('files[]', file);
            formData.append(`title[${index}]`, file.name.split('.')[0]); // Use filename as title
            formData.append(`alt_text[${index}]`, '');
            formData.append(`description[${index}]`, '');
            formData.append(`tags[${index}]`, '');
            formData.append(`status[${index}]`, '1');
        });
        
        // Add CSRF token
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        
        // Show progress
        uploadPlaceholder.classList.add('d-none');
        uploadProgress.classList.remove('d-none');
        formActions.classList.add('d-none');
        
        const xhr = new XMLHttpRequest();
        
        // Upload progress
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                document.querySelector('.progress-bar').style.width = percentComplete + '%';
            }
        });
        
        // Upload complete
        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    showUploadResults(response);
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    console.log('Response:', xhr.responseText);
                    showToast('Upload completed but response was invalid', 'warning');
                    resetUploadForm();
                }
            } else {
                console.error('Upload failed with status:', xhr.status);
                console.log('Response:', xhr.responseText);
                showToast('Upload failed with status: ' + xhr.status, 'error');
                resetUploadForm();
            }
        });
        
        // Upload error
        xhr.addEventListener('error', function() {
            showToast('Upload failed', 'error');
            resetUploadForm();
        });
        
        xhr.open('POST', '{{ route("admin.content.image-library.store") }}');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send(formData);
    }

    // Show upload results
    function showUploadResults(response) {
        uploadProgress.classList.add('d-none');
        uploadResults.classList.remove('d-none');
        
        let resultsHtml = '';
        
        if (response.success && response.uploaded) {
            response.uploaded.forEach(file => {
                resultsHtml += `
                    <div class="alert alert-success d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>${file.title}</strong> uploaded successfully
                    </div>
                `;
            });
        }
        
        if (response.failed && response.failed.length > 0) {
            response.failed.forEach(file => {
                resultsHtml += `
                    <div class="alert alert-danger d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>${file.name}</strong> failed: ${file.error}
                    </div>
                `;
            });
        }
        
        uploadResultsContainer.innerHTML = resultsHtml;
        
        if (response.success) {
            showToast(`Successfully uploaded ${response.uploaded.length} file(s)`, 'success');
        }
    }

    // Reset upload form
    function resetUploadForm() {
        uploadProgress.classList.add('d-none');
        uploadPlaceholder.classList.remove('d-none');
        formActions.classList.remove('d-none');
        document.querySelector('.progress-bar').style.width = '0%';
    }
});
</script>
@endpush
