<div id="upload-sec" class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-solid fa-file-arrow-up me-1"></i>
                Upload Image
            </div>
            <div class="card-body text-center">
                <button id="upload" class="btn btn-secondary">Upload Image</button>
                <!-- Hidden file input -->
                <input type="file" id="fileInput" style="display: none;" accept="image/*">
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fa-regular fa-image me-1"></i>
                Image Result
            </div>
            <div class="card-body text-center">
                <div class="fs-6 no-img">
                    No image found
                </div>
            </div>
        </div>
    </div>
</div>
<div id="image-sec" class="card mb-4" style="display: none;">
    <div class="card-header">
        <i class="fa-regular fa-image me-1"></i>
        Image Result
    </div>
    <div class="card-body text-center">
        <div id="image-display">
            <img height="" src="" alt="" class="rounded img-fluid d-block d-xl-none">
            <img height="300px" src="" alt="" class="rounded d-none d-xl-inline-block">
            <div id="btn-img" class="mt-4 text-center">
                <button class="btn btn-primary me-4 predict-img">Predict</button>
                <button class="btn btn-danger del-img">Delete</button>
            </div>
        </div>
    </div>
</div>