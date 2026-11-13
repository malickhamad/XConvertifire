@extends('components.app')

@section('canonical', 'https://xconvertifire.com/image-to-jpg')

@section('meta')

<title>Image to JPG Converter Online | XConvertifire</title>

<meta name="description"
    content="Convert JPG, PNG, WebP, GIF and SVG images to JPG online. JPG is selected by default; adjust quality, convert multiple files and download the results." />

<meta property="og:type" content="website">
<meta property="og:title" content="Image to JPG Converter Online | XConvertifire">
<meta property="og:description"
    content="Convert JPG, PNG, WebP, GIF and SVG images to JPG online. JPG is selected by default; adjust quality and convert multiple files.">
<meta property="og:url" content="https://xconvertifire.com/image-to-jpg">
<meta property="og:site_name" content="XConvertifire">

<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Image to JPG Converter Online | XConvertifire">
<meta name="twitter:description"
    content="Convert JPG, PNG, WebP, GIF and SVG images to JPG online. JPG is selected by default; adjust quality and convert multiple files.">

@endsection

@section('content')

<main class="crop-page">

<section class="crop-breadcrumb-section">
    <div class="container">

        <div class="crop-breadcrumb">

            <a href="{{ route('home') }}">
                <i class="fas fa-home"></i>
                Home
            </a>

            <span>
                <i class="fas fa-chevron-right"></i>
            </span>

            <span>Image to JPG</span>

        </div>

    </div>
</section>


<section class="crop-hero-section" id="imageUploadSection">

    <div class="container">

        <div class="crop-heading">

            <span class="crop-small-badge">
                <i class="fas fa-file-image"></i>
                Image to JPG Converter
            </span>

            <h1>
                Convert Images<br>
                <span>To JPG Online.</span>
            </h1>

            <p>
                Convert supported images to JPG in your browser. JPG is selected by default; adjust the quality or choose another available output format.
            </p>

        </div>


        <div class="crop-upload-box" id="imageUploadBox">

            <div class="crop-upload-icon">
                <i class="fas fa-cloud-upload-alt"></i>
            </div>

            <h3>
                Choose images to convert to JPG
            </h3>

            <p class="crop-upload-text">
                Drag & drop your images here or
            </p>

            <label
                for="imageInput"
                class="crop-upload-btn"
            >
                <i class="fas fa-upload"></i>
                Choose Images
            </label>

            <input
                type="file"
                id="imageInput"
                accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml"
                multiple
                hidden
            >

            <p class="crop-upload-info">
                Supports JPG, JPEG, PNG, WebP, GIF, SVG
                <span>|</span>
                Max size: 50MB per image
            </p>

        </div>

    </div>

</section>



<section
    class="multi-converter-section"
    id="converterSection"
    style="display:none;"
>

    <div class="container">


        <div class="modern-converter-header">

            <div class="modern-header-content">

                <span class="modern-section-label">
                    <i class="fas fa-wand-magic-sparkles"></i>
                    Image Converter
                </span>

                <h2>
                    Ready to
                    <span>Convert?</span>
                </h2>

                <p>
                    Review your images, choose an output format,
                    and convert everything in seconds.
                </p>

            </div>


            <div class="modern-image-counter">

                <div class="counter-icon">
                    <i class="fas fa-images"></i>
                </div>

                <div class="counter-content">
                    <strong id="imageCount">0</strong>
                    <span>Images selected</span>
                </div>

            </div>

        </div>



        <div class="modern-converter-workspace">


            <div class="modern-workspace-header">

                <div class="workspace-title">

                    <div class="workspace-title-icon">
                        <i class="fas fa-photo-film"></i>
                    </div>

                    <div>
                        <h3>Your Images</h3>

                        <p>
                            Review and manage your selected files
                        </p>
                    </div>

                </div>


                <button
                    type="button"
                    id="addImagesButton"
                    class="modern-add-button"
                >
                    <span class="add-button-icon">
                        <i class="fas fa-plus"></i>
                    </span>

                    <span>Add More Images</span>
                </button>

            </div>



            <div
                class="modern-image-grid"
                id="imageGrid"
            >
            </div>



            <div
                id="emptyImagesMessage"
                class="modern-empty-state"
                style="display:none;"
            >

                <div class="empty-state-icon">
                    <i class="fas fa-images"></i>
                </div>

                <h4>No images selected</h4>

                <p>
                    Add images to begin your conversion.
                </p>

                <button
                    type="button"
                    id="emptyAddButton"
                    class="modern-add-button"
                >
                    <span class="add-button-icon">
                        <i class="fas fa-plus"></i>
                    </span>

                    <span>Add Images</span>
                </button>

            </div>



            <div class="modern-settings-section">


                <div class="modern-settings-header">

                    <div class="settings-heading-icon">
                        <i class="fas fa-sliders"></i>
                    </div>

                    <div>

                        <h3>Conversion Settings</h3>

                        <p>
                            Choose how your images should be converted
                        </p>

                    </div>

                </div>



                <div class="modern-setting-group">

                    <div class="modern-setting-label">

                        <div>

                            <span class="setting-title">
                                Output Format
                            </span>

                            <span class="setting-description">
                                Select the format for your converted images
                            </span>

                        </div>

                        <span class="selected-format-badge">
                            <i class="fas fa-check"></i>
                            <span id="selectedFormatText">JPG</span>
                        </span>

                    </div>


                    <div class="format-selector-grid">

                        <button
                            type="button"
                            class="format-card active"
                            data-format="jpg"
                        >
                            <span class="format-icon jpg-icon">
                                <i class="fas fa-image"></i>
                            </span>

                            <span class="format-card-content">
                                <strong>JPG</strong>
                                <small>Best for photos</small>
                            </span>

                            <span class="format-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>


                        <button
                            type="button"
                            class="format-card"
                            data-format="jpeg"
                        >
                            <span class="format-icon jpeg-icon">
                                <i class="fas fa-image"></i>
                            </span>

                            <span class="format-card-content">
                                <strong>JPEG</strong>
                                <small>Photo format</small>
                            </span>

                            <span class="format-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>


                        <button
                            type="button"
                            class="format-card"
                            data-format="png"
                        >
                            <span class="format-icon png-icon">
                                <i class="fas fa-file-image"></i>
                            </span>

                            <span class="format-card-content">
                                <strong>PNG</strong>
                                <small>Transparent images</small>
                            </span>

                            <span class="format-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>


                        <button
                            type="button"
                            class="format-card"
                            data-format="webp"
                        >
                            <span class="format-icon webp-icon">
                                <i class="fas fa-bolt"></i>
                            </span>

                            <span class="format-card-content">
                                <strong>WebP</strong>
                                <small>Smaller file size</small>
                            </span>

                            <span class="format-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>


                        <button
                            type="button"
                            class="format-card"
                            data-format="pdf"
                        >
                            <span class="format-icon pdf-icon">
                                <i class="fas fa-file-pdf"></i>
                            </span>

                            <span class="format-card-content">
                                <strong>PDF</strong>
                                <small>One PDF per image</small>
                            </span>

                            <span class="format-check">
                                <i class="fas fa-check"></i>
                            </span>
                        </button>

                    </div>


                    <select
                        id="outputFormat"
                        class="modern-hidden-select"
                    >
                        <option value="jpg" selected>JPG</option>
                        <option value="jpeg">JPEG</option>
                        <option value="png">PNG</option>
                        <option value="webp">WebP</option>
                        <option value="pdf">PDF</option>
                    </select>

                </div>



                <div
                    class="modern-setting-group quality-setting"
                    id="qualityWrapper"
                >

                    <div class="modern-setting-label">

                        <div>

                            <span class="setting-title">
                                Image Quality
                            </span>

                            <span class="setting-description">
                                Higher quality produces larger files
                            </span>

                        </div>

                    </div>


                    <div class="quality-selector">

                        <label class="quality-option">

                            <input
                                type="radio"
                                name="qualityOption"
                                value="1"
                            >

                            <span class="quality-option-content">
                                <strong>High</strong>
                                <small>Maximum quality</small>
                            </span>

                        </label>


                        <label class="quality-option active">

                            <input
                                type="radio"
                                name="qualityOption"
                                value="0.9"
                                checked
                            >

                            <span class="quality-option-content">
                                <strong>Very Good</strong>
                                <small>Recommended</small>
                            </span>

                            <span class="recommended-label">
                                Recommended
                            </span>

                        </label>


                        <label class="quality-option">

                            <input
                                type="radio"
                                name="qualityOption"
                                value="0.8"
                            >

                            <span class="quality-option-content">
                                <strong>Good</strong>
                                <small>Balanced</small>
                            </span>

                        </label>


                        <label class="quality-option">

                            <input
                                type="radio"
                                name="qualityOption"
                                value="0.7"
                            >

                            <span class="quality-option-content">
                                <strong>Medium</strong>
                                <small>Smaller files</small>
                            </span>

                        </label>

                    </div>


                    <select
                        id="imageQuality"
                        class="modern-hidden-select"
                    >
                        <option value="1">
                            High Quality
                        </option>

                        <option
                            value="0.9"
                            selected
                        >
                            Very Good
                        </option>

                        <option value="0.8">
                            Good
                        </option>

                        <option value="0.7">
                            Medium
                        </option>
                    </select>

                </div>



                <div
                    id="pdfOptions"
                    class="modern-pdf-options"
                    style="display:none;"
                >

                    <div class="pdf-options-heading">

                        <div class="pdf-heading-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>

                        <div>
                            <strong>PDF Settings</strong>
                            <span>
                                Each image will be saved as a separate PDF
                            </span>
                        </div>

                    </div>


                    <div class="row g-3">

                        <div class="col-lg-6 col-md-6 col-12">

                            <label
                                for="pdfPageSize"
                                class="modern-form-label"
                            >
                                <i class="fas fa-file"></i>
                                Page Size
                            </label>

                            <select
                                id="pdfPageSize"
                                class="modern-form-select"
                            >

                                <option
                                    value="a4"
                                    selected
                                >
                                    A4
                                </option>

                                <option value="letter">
                                    Letter
                                </option>

                                <option value="image">
                                    Image Size
                                </option>

                            </select>

                        </div>


                        <div class="col-lg-6 col-md-6 col-12">

                            <label
                                for="pdfOrientation"
                                class="modern-form-label"
                            >
                                <i class="fas fa-arrows-left-right"></i>
                                Orientation
                            </label>

                            <select
                                id="pdfOrientation"
                                class="modern-form-select"
                            >

                                <option
                                    value="auto"
                                    selected
                                >
                                    Auto
                                </option>

                                <option value="portrait">
                                    Portrait
                                </option>

                                <option value="landscape">
                                    Landscape
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>



            <div
                id="conversionProgress"
                class="modern-progress"
                style="display:none;"
            >

                <div class="modern-progress-header">

                    <div class="progress-status">

                        <div class="progress-status-icon">
                            <i class="fas fa-spinner fa-spin"></i>
                        </div>

                        <div>

                            <strong id="progressTitle">
                                Preparing conversion...
                            </strong>

                            <span id="progressText">
                                0 / 0
                            </span>

                        </div>

                    </div>

                    <strong class="progress-percent">
                        <span id="progressPercentage">
                            0
                        </span>%
                    </strong>

                </div>


                <div class="modern-progress-track">

                    <div
                        id="progressBar"
                        class="modern-progress-bar"
                        style="width:0%;"
                    ></div>

                </div>

            </div>



            <div
                id="conversionResult"
                class="modern-success-box"
                style="display:none;"
            >

                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>

                <div class="success-content">

                    <strong>
                        Conversion Complete
                    </strong>

                    <p id="resultMessage">
                        Your images have been converted successfully.
                    </p>

                </div>

                <div class="success-badge">
                    <i class="fas fa-circle-check"></i>
                    Ready
                </div>

            </div>



            <div class="modern-action-area">

                <button
                    type="button"
                    id="convertButton"
                    class="modern-primary-action main-convert-btn"
                >

                    <span class="action-icon">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </span>

                    <span class="action-text">
                        <strong>Convert Images</strong>
                        <small>Start conversion</small>
                    </span>

                    <i class="fas fa-arrow-right action-arrow"></i>

                </button>


                <button
                    type="button"
                    id="downloadButton"
                    class="modern-download-action"
                    style="display:none;"
                >

                    <span class="action-icon">
                        <i class="fas fa-download"></i>
                    </span>

                    <span class="action-text">
                        <strong>Download All</strong>
                        <small>Save converted files</small>
                    </span>

                    <i class="fas fa-arrow-down action-arrow"></i>

                </button>


                <button
                    type="button"
                    id="newConversionButton"
                    class="modern-new-action"
                >

                    <i class="fas fa-plus"></i>

                    New Conversion

                </button>

            </div>



            <div class="modern-security-note">

                <div class="security-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>

                <div>

                    <strong>
                        Your files stay private
                    </strong>

                    <span>
                        Images are processed directly in your browser
                        and are never uploaded to our server.
                    </span>

                </div>

                <i class="fas fa-check-circle security-check"></i>

            </div>

        </div>

    </div>

</section>



<section class="container py-5" aria-labelledby="image-to-jpg-guide">
    <div class="row g-4">
        <div class="col-lg-8">
            <h2 id="image-to-jpg-guide" class="text-white fw-bold mb-3">How to convert an image to JPG</h2>
            <ol class="text-secondary ps-3">
                <li class="mb-2">Choose one or more supported image files. The upload area lists JPG, JPEG, PNG, WebP, GIF and SVG, with a displayed limit of 50 MB per image.</li>
                <li class="mb-2">JPG is selected as the starting output. You can adjust image quality or select another format in Conversion Settings.</li>
                <li class="mb-2">Select Convert Images and wait for your browser to process the files.</li>
                <li>Download the converted image. When converting several images together, download the ZIP containing the results.</li>
            </ol>

            <h2 class="text-white fw-bold h4 mt-4 mb-3">JPG conversion details</h2>
            <p class="text-secondary">JPG and JPEG use the same image encoding. JPG is widely supported and works well for many photographs, but it does not retain transparency. Transparent areas are filled with white, and JPEG quality settings can affect fine detail and file size. Start with the original image when converting again.</p>
            <p class="text-secondary mb-0">GIF and SVG files rely on your browser's image decoding and canvas support. Animated GIFs do not keep their animation in a standard JPG image. Check the downloaded file if the source uses animation, transparency or browser-specific SVG features.</p>
        </div>
        <div class="col-lg-4">
            <div class="p-4 rounded border border-secondary h-100">
                <h2 class="text-white fw-bold h5 mb-3">Need another image format?</h2>
                <p class="text-secondary">This page starts with JPG selected. The Image Converter explains the available output choices and their browser-specific limits.</p>
                <a href="{{ route('image.converter') }}" class="btn btn-outline-primary">Explore the Image Converter</a>
            </div>
        </div>
    </div>
</section>

<section class="crop-benefits-section">

    <div class="container">

        <div class="crop-benefits-heading">

            <span>
                WHY USE X Convertifire
            </span>

            <h2>
                Simple. Fast.
                <strong>Reliable.</strong>
            </h2>

            <p>
                Convert multiple images without complicated software.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-lg-4 col-md-6">

                <div class="crop-benefit-card">

                    <div class="crop-benefit-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                    <div>

                        <h4>
                            Bulk Conversion
                        </h4>

                        <p>
                            Upload multiple images and convert
                            them all at once.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="crop-benefit-card">

                    <div class="crop-benefit-icon">
                        <i class="fas fa-file-image"></i>
                    </div>

                    <div>

                        <h4>
                            Multiple Formats
                        </h4>

                        <p>
                            Convert images to JPG, JPEG, PNG,
                            WebP or PDF.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="crop-benefit-card">

                    <div class="crop-benefit-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>

                    <div>

                        <h4>
                            Secure & Private
                        </h4>

                        <p>
                            Your images remain on your device
                            during conversion.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

</main>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

{{-- ZIP LIBRARY --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>


<script>

$(document).ready(function () {

    let selectedFiles = [];
    let convertedFiles = [];

    const MAX_SIZE = 50 * 1024 * 1024;


    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    function formatFileSize(bytes) {

        if (bytes < 1024) {
            return bytes + ' B';
        }

        if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(1) + ' KB';
        }

        return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
    }


    /*
     * Remove original extension only.
     *
     * Example:
     * photo.jpg -> photo
     * my.image.png -> my.image
     */
    function cleanFileName(name) {

        return name.replace(/\.[^/.]+$/, '');

    }


    /*
     * Make safe file name.
     */
    function safeFileName(name) {

        return name
            .replace(/[<>:"/\\|?*\x00-\x1F]/g, '_')
            .trim();

    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE DIMENSIONS
    |--------------------------------------------------------------------------
    */

    function getImageDimensions(file) {

        return new Promise(function (resolve) {

            const reader = new FileReader();

            reader.onload = function (event) {

                const img = new Image();

                img.onload = function () {

                    resolve({
                        width: img.naturalWidth,
                        height: img.naturalHeight,
                        image: img
                    });

                };

                img.onerror = function () {

                    resolve({
                        width: 0,
                        height: 0,
                        image: null
                    });

                };

                img.src = event.target.result;

            };

            reader.onerror = function () {

                resolve({
                    width: 0,
                    height: 0,
                    image: null
                });

            };

            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATE FILE
    |--------------------------------------------------------------------------
    */

    function isValidImage(file) {

        if (file.size > MAX_SIZE) {

            alert(
                file.name +
                ' is larger than 50MB and was skipped.'
            );

            return false;
        }


        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
            'image/gif',
            'image/svg+xml'
        ];


        const extension = file.name
            .split('.')
            .pop()
            .toLowerCase();


        const allowedExtensions = [
            'jpg',
            'jpeg',
            'png',
            'webp',
            'gif',
            'svg'
        ];


        if (
            !allowedTypes.includes(file.type) &&
            !allowedExtensions.includes(extension)
        ) {

            alert(
                file.name +
                ' is not a supported image.'
            );

            return false;
        }


        return true;

    }


    /*
    |--------------------------------------------------------------------------
    | ADD FILES
    |--------------------------------------------------------------------------
    */

    async function addFiles(files) {

        if (!files || !files.length) {
            return;
        }


        const newFiles = Array.from(files);


        for (const file of newFiles) {

            if (!isValidImage(file)) {
                continue;
            }


            const duplicate = selectedFiles.some(function (existing) {

                return (
                    existing.name === file.name &&
                    existing.size === file.size &&
                    existing.lastModified === file.lastModified
                );

            });


            if (!duplicate) {
                selectedFiles.push(file);
            }

        }


        if (!selectedFiles.length) {
            return;
        }


        renderImageGrid();


        $('#imageUploadSection')
            .stop(true, true)
            .slideUp(350);


        $('#converterSection')
            .stop(true, true)
            .slideDown(450);


        setTimeout(function () {

            $('html, body').animate({

                scrollTop:
                    $('#converterSection').offset().top - 25

            }, 550);

        }, 150);

    }


    /*
    |--------------------------------------------------------------------------
    | RENDER IMAGE GRID
    |--------------------------------------------------------------------------
    */

    async function renderImageGrid() {

        const grid = $('#imageGrid');

        grid.empty();


        $('#imageCount').text(
            selectedFiles.length
        );


        if (!selectedFiles.length) {

            $('#emptyImagesMessage').show();

            return;
        }


        $('#emptyImagesMessage').hide();


        for (
            let index = 0;
            index < selectedFiles.length;
            index++
        ) {

            const file = selectedFiles[index];

            const imageInfo =
                await getImageDimensions(file);


            const objectURL =
                URL.createObjectURL(file);


            const card = $(`
                <div class="modern-image-card">

                    <div class="modern-image-preview">

                        <img
                            src="${objectURL}"
                            alt="${file.name}"
                        >

                        <span class="modern-image-number">
                            ${index + 1}
                        </span>

                        <button
                            type="button"
                            class="modern-remove-image"
                            data-index="${index}"
                            title="Remove image"
                        >
                            <i class="fas fa-times"></i>
                        </button>

                    </div>


                    <div class="modern-image-info">

                        <div class="modern-file-name">

                            <span class="file-type-dot"></span>

                            <strong title="${file.name}">
                                ${file.name}
                            </strong>

                        </div>


                        <div class="modern-file-meta">

                            <span>
                                <i class="fas fa-expand"></i>
                                ${
                                    imageInfo.width
                                    ? imageInfo.width + ' × ' +
                                      imageInfo.height + ' px'
                                    : 'Image'
                                }
                            </span>

                            <span>
                                <i class="fas fa-database"></i>
                                ${formatFileSize(file.size)}
                            </span>

                        </div>

                    </div>

                </div>
            `);


            grid.append(card);


            card.find('img').on('load', function () {

                URL.revokeObjectURL(objectURL);

            });

        }

    }


    /*
    |--------------------------------------------------------------------------
    | INPUT
    |--------------------------------------------------------------------------
    */

    $('#imageInput').on('change', function () {

        addFiles(this.files);

        $(this).val('');

    });


    /*
    |--------------------------------------------------------------------------
    | DRAG & DROP
    |--------------------------------------------------------------------------
    */

    $('#imageUploadBox')

        .on('dragover', function (e) {

            e.preventDefault();

            $(this).addClass('dragging');

        })

        .on('dragleave', function () {

            $(this).removeClass('dragging');

        })

        .on('drop', function (e) {

            e.preventDefault();

            $(this).removeClass('dragging');

            const files =
                e.originalEvent
                    .dataTransfer
                    .files;

            addFiles(files);

        });


    /*
    |--------------------------------------------------------------------------
    | ADD MORE
    |--------------------------------------------------------------------------
    */

    $('#addImagesButton, #emptyAddButton').on(
        'click',
        function () {

            $('html, body').animate({

                scrollTop:
                    $('#imageUploadSection').offset().top - 20

            }, 550);


            setTimeout(function () {

                $('#imageUploadSection')
                    .stop(true, true)
                    .slideDown(450);

            }, 150);


            setTimeout(function () {

                $('#imageInput').trigger('click');

            }, 500);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | REMOVE IMAGE
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.modern-remove-image',
        function () {

            const index =
                parseInt(
                    $(this).data('index')
                );


            selectedFiles.splice(index, 1);

            convertedFiles = [];


            $('#conversionResult').hide();

            $('#downloadButton').hide();


            $('#convertButton')
                .show()
                .prop('disabled', false)
                .html(`
                    <span class="action-icon">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </span>

                    <span class="action-text">
                        <strong>Convert Images</strong>
                        <small>Start conversion</small>
                    </span>

                    <i class="fas fa-arrow-right action-arrow"></i>
                `);


            renderImageGrid();


            if (!selectedFiles.length) {

                $('#converterSection')
                    .stop(true, true)
                    .slideUp(300);


                setTimeout(function () {

                    $('#imageUploadSection')
                        .stop(true, true)
                        .slideDown(400);

                }, 300);

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | FORMAT CARDS
    |--------------------------------------------------------------------------
    */

    $('.format-card').on('click', function () {

        const format = $(this).data('format');


        $('.format-card')
            .removeClass('active');


        $(this)
            .addClass('active');


        $('#outputFormat')
            .val(format)
            .trigger('change');


        $('#selectedFormatText')
            .text(format.toUpperCase());

    });


    /*
    |--------------------------------------------------------------------------
    | QUALITY CARDS
    |--------------------------------------------------------------------------
    */

    $('.quality-option').on('click', function () {

        const value =
            $(this)
                .find('input')
                .val();


        $('.quality-option')
            .removeClass('active');


        $(this)
            .addClass('active');


        $('#imageQuality')
            .val(value)
            .trigger('change');

    });


    /*
    |--------------------------------------------------------------------------
    | OUTPUT FORMAT
    |--------------------------------------------------------------------------
    */

    $('#outputFormat').on('change', function () {

        const format = $(this).val();


        $('.format-card')
            .removeClass('active');


        $('.format-card[data-format="' + format + '"]')
            .addClass('active');


        $('#selectedFormatText')
            .text(format.toUpperCase());


        if (format === 'pdf') {

            $('#qualityWrapper')
                .stop(true, true)
                .slideUp(150);


            $('#pdfOptions')
                .stop(true, true)
                .slideDown(200);

        } else {

            $('#qualityWrapper')
                .stop(true, true)
                .slideDown(150);


            $('#pdfOptions')
                .stop(true, true)
                .slideUp(200);

        }


        convertedFiles = [];


        $('#conversionResult').hide();

        $('#downloadButton').hide();


        $('#convertButton')
            .show()
            .prop('disabled', false)
            .html(`
                <span class="action-icon">
                    <i class="fas fa-wand-magic-sparkles"></i>
                </span>

                <span class="action-text">
                    <strong>Convert Images</strong>
                    <small>Start conversion</small>
                </span>

                <i class="fas fa-arrow-right action-arrow"></i>
            `);

    });


    /*
    |--------------------------------------------------------------------------
    | CANVAS
    |--------------------------------------------------------------------------
    */

    function createCanvas(width, height) {

        const canvas =
            document.createElement('canvas');


        canvas.width =
            Math.max(
                1,
                Math.round(width)
            );


        canvas.height =
            Math.max(
                1,
                Math.round(height)
            );


        return canvas;

    }


    /*
    |--------------------------------------------------------------------------
    | LOAD IMAGE
    |--------------------------------------------------------------------------
    */

    function loadImage(file) {

        return new Promise(function (resolve, reject) {

            const reader =
                new FileReader();


            reader.onload = function (event) {

                const img =
                    new Image();


                img.onload = function () {

                    resolve(img);

                };


                img.onerror = function () {

                    reject(
                        new Error(
                            'Unable to read ' +
                            file.name
                        )
                    );

                };


                img.src =
                    event.target.result;

            };


            reader.onerror = function () {

                reject(
                    new Error(
                        'Unable to read ' +
                        file.name
                    )
                );

            };


            reader.readAsDataURL(file);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | DRAW IMAGE
    |--------------------------------------------------------------------------
    */

    function drawImage(
        image,
        canvas,
        background = null
    ) {

        const ctx =
            canvas.getContext('2d');


        if (background) {

            ctx.fillStyle =
                background;


            ctx.fillRect(
                0,
                0,
                canvas.width,
                canvas.height
            );

        }


        ctx.imageSmoothingEnabled =
            true;


        ctx.imageSmoothingQuality =
            'high';


        ctx.drawImage(
            image,
            0,
            0,
            canvas.width,
            canvas.height
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CANVAS TO BLOB
    |--------------------------------------------------------------------------
    */

    function canvasToBlob(
        canvas,
        mimeType,
        quality
    ) {

        return new Promise(function (resolve) {

            canvas.toBlob(
                function (blob) {
                    resolve(blob);
                },
                mimeType,
                quality
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CONVERT SINGLE IMAGE
    |--------------------------------------------------------------------------
    */

    async function convertSingleImage(
        file,
        format
    ) {

        const image =
            await loadImage(file);


        const width =
            image.naturalWidth;


        const height =
            image.naturalHeight;


        const canvas =
            createCanvas(
                width,
                height
            );


        let mimeType;

        let extension;

        let quality =
            parseFloat(
                $('#imageQuality').val()
            );


        switch (format) {

            case 'jpg':

                mimeType =
                    'image/jpeg';

                extension =
                    'jpg';

                break;


            case 'jpeg':

                mimeType =
                    'image/jpeg';

                extension =
                    'jpeg';

                break;


            case 'png':

                mimeType =
                    'image/png';

                extension =
                    'png';

                quality =
                    undefined;

                break;


            case 'webp':

                mimeType =
                    'image/webp';

                extension =
                    'webp';

                break;


            default:

                throw new Error(
                    'Unsupported image format.'
                );

        }


        /*
         * JPG/JPEG does not support transparency.
         * White background is therefore used.
         */

        if (
            format === 'jpg' ||
            format === 'jpeg'
        ) {

            drawImage(
                image,
                canvas,
                '#ffffff'
            );

        } else {

            drawImage(
                image,
                canvas,
                null
            );

        }


        const blob =
            await canvasToBlob(
                canvas,
                mimeType,
                quality
            );


        if (!blob) {

            throw new Error(
                'Unable to convert ' +
                file.name
            );

        }


        /*
         * IMPORTANT:
         *
         * Keep the ORIGINAL filename.
         *
         * photo.png -> photo.jpg
         * image.webp -> image.png
         */

        const originalName =
            cleanFileName(file.name);


        return {

            blob: blob,

            name:
                safeFileName(
                    originalName +
                    '.' +
                    extension
                )

        };

    }


    /*
    |--------------------------------------------------------------------------
    | CONVERT ONE IMAGE TO ONE PDF
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    | Every image gets its OWN PDF.
    |
    | image1.jpg -> image1.pdf
    | image2.png -> image2.pdf
    | image3.webp -> image3.pdf
    |
    */

    async function convertSingleImageToPDF(file) {

        if (
            typeof window.jspdf ===
            'undefined'
        ) {

            throw new Error(
                'PDF converter could not be loaded.'
            );

        }


        const { jsPDF } =
            window.jspdf;


        const pageSize =
            $('#pdfPageSize').val();


        let orientation =
            $('#pdfOrientation').val();


        const image =
            await loadImage(file);


        /*
         * Auto orientation is based on
         * THIS image, not the first image.
         */

        if (
            orientation ===
            'auto'
        ) {

            orientation =
                image.naturalWidth >
                image.naturalHeight
                    ? 'landscape'
                    : 'portrait';

        }


        let pdf;


        /*
         * IMAGE SIZE
         */

        if (
            pageSize ===
            'image'
        ) {

            const width =
                image.naturalWidth *
                0.75;


            const height =
                image.naturalHeight *
                0.75;


            pdf =
                new jsPDF({

                    orientation:
                        orientation,

                    unit:
                        'pt',

                    format: [
                        width,
                        height
                    ]

                });

        }

        /*
         * A4 / LETTER
         */

        else {

            pdf =
                new jsPDF({

                    orientation:
                        orientation,

                    unit:
                        'mm',

                    format:
                        pageSize

                });

        }


        /*
         * Create canvas.
         */

        const canvas =
            createCanvas(
                image.naturalWidth,
                image.naturalHeight
            );


        /*
         * PDF uses white background.
         */

        drawImage(
            image,
            canvas,
            '#ffffff'
        );


        /*
         * Convert image to JPEG
         * before placing into PDF.
         */

        const imageData =
            canvas.toDataURL(
                'image/jpeg',
                0.92
            );


        const pageWidth =
            pdf.internal.pageSize
                .getWidth();


        const pageHeight =
            pdf.internal.pageSize
                .getHeight();


        /*
         * IMAGE SIZE PDF
         */

        if (
            pageSize ===
            'image'
        ) {

            const width =
                image.naturalWidth *
                0.75;


            const height =
                image.naturalHeight *
                0.75;


            pdf.addImage(
                imageData,
                'JPEG',
                0,
                0,
                width,
                height
            );

        }

        /*
         * A4 / LETTER
         */

        else {

            const imageRatio =
                image.naturalWidth /
                image.naturalHeight;


            const pageRatio =
                pageWidth /
                pageHeight;


            let imageWidth;

            let imageHeight;


            /*
             * Fit image inside PDF page.
             */

            if (
                imageRatio >
                pageRatio
            ) {

                imageWidth =
                    pageWidth;

                imageHeight =
                    pageWidth /
                    imageRatio;

            } else {

                imageHeight =
                    pageHeight;

                imageWidth =
                    pageHeight *
                    imageRatio;

            }


            /*
             * Center image.
             */

            const x =
                (
                    pageWidth -
                    imageWidth
                ) / 2;


            const y =
                (
                    pageHeight -
                    imageHeight
                ) / 2;


            pdf.addImage(
                imageData,
                'JPEG',
                x,
                y,
                imageWidth,
                imageHeight
            );

        }


        /*
         * ORIGINAL FILE NAME
         *
         * invoice.jpg -> invoice.pdf
         */

        const originalName =
            cleanFileName(file.name);


        return {

            blob:
                pdf.output('blob'),

            name:
                safeFileName(
                    originalName +
                    '.pdf'
                )

        };

    }


    /*
    |--------------------------------------------------------------------------
    | PROGRESS
    |--------------------------------------------------------------------------
    */

    function updateProgress(
        current,
        total
    ) {

        const percentage =
            Math.round(
                (current / total) *
                100
            );


        $('#progressText').text(
            current + ' / ' + total
        );


        $('#progressBar')
            .css(
                'width',
                percentage + '%'
            );


        $('#progressPercentage')
            .text(percentage);

    }


    /*
    |--------------------------------------------------------------------------
    | CONVERT BUTTON
    |--------------------------------------------------------------------------
    */

    $('#convertButton').on(
        'click',
        async function () {

            if (!selectedFiles.length) {

                alert(
                    'Please add at least one image.'
                );

                return;

            }


            const button =
                $(this);


            const format =
                $('#outputFormat').val();


            convertedFiles = [];


            $('#conversionResult').hide();

            $('#downloadButton').hide();


            button
                .prop('disabled', true)
                .html(`
                    <span class="action-icon">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>

                    <span class="action-text">
                        <strong>Converting...</strong>
                        <small>Please wait</small>
                    </span>
                `);


            $('#addImagesButton')
                .prop('disabled', true);


            $('#conversionProgress')
                .stop(true, true)
                .slideDown(250);


            $('#progressBar')
                .css('width', '0%');


            $('#progressPercentage')
                .text('0');


            $('#progressText')
                .text(
                    '0 / ' +
                    selectedFiles.length
                );


            $('#progressTitle')
                .text(
                    'Converting images...'
                );


            try {

                /*
                 * ======================================================
                 * PDF
                 * ======================================================
                 *
                 * Each image becomes a separate PDF.
                 */

                if (format === 'pdf') {

                    for (
                        let i = 0;
                        i < selectedFiles.length;
                        i++
                    ) {

                        const result =
                            await convertSingleImageToPDF(
                                selectedFiles[i]
                            );


                        convertedFiles.push(
                            result
                        );


                        updateProgress(
                            i + 1,
                            selectedFiles.length
                        );


                        await new Promise(
                            function (resolve) {

                                setTimeout(
                                    resolve,
                                    80
                                );

                            }
                        );

                    }

                }

                /*
                 * ======================================================
                 * JPG / JPEG / PNG / WEBP
                 * ======================================================
                 */

                else {

                    for (
                        let i = 0;
                        i < selectedFiles.length;
                        i++
                    ) {

                        const result =
                            await convertSingleImage(
                                selectedFiles[i],
                                format
                            );


                        convertedFiles.push(
                            result
                        );


                        updateProgress(
                            i + 1,
                            selectedFiles.length
                        );


                        await new Promise(
                            function (resolve) {

                                setTimeout(
                                    resolve,
                                    80
                                );

                            }
                        );

                    }

                }


                /*
                 * COMPLETE
                 */

                $('#progressTitle')
                    .text(
                        'Conversion complete'
                    );


                $('#conversionResult')
                    .stop(true, true)
                    .fadeIn(300);


                $('#resultMessage')
                    .text(
                        selectedFiles.length +
                        ' image' +
                        (
                            selectedFiles.length > 1
                                ? 's have'
                                : ' has'
                        ) +
                        ' been converted to ' +
                        format.toUpperCase() +
                        '.'
                    );


                button.hide();


                /*
                 * SHOW DOWNLOAD
                 */

                $('#downloadButton')
                    .stop(true, true)
                    .fadeIn(300);


            } catch (error) {

                console.error(error);


                alert(
                    error.message ||
                    'Something went wrong while converting the images.'
                );


                button
                    .prop('disabled', false)
                    .html(`
                        <span class="action-icon">
                            <i class="fas fa-wand-magic-sparkles"></i>
                        </span>

                        <span class="action-text">
                            <strong>Convert Images</strong>
                            <small>Start conversion</small>
                        </span>

                        <i class="fas fa-arrow-right action-arrow"></i>
                    `);

            } finally {

                $('#addImagesButton')
                    .prop('disabled', false);

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD ALL AS ZIP
    |--------------------------------------------------------------------------
    |
    | Browser security prevents JavaScript from creating an arbitrary
    | folder on the user's computer and placing multiple downloads
    | inside it.
    |
    | Therefore:
    |
    | converted-images.zip
    |
    | contains:
    |
    | converted-images/
    |     photo1.jpg
    |     photo2.jpg
    |     photo3.jpg
    |
    | This is the reliable cross-browser solution.
    |--------------------------------------------------------------------------
    */

    $('#downloadButton').on(
        'click',
        async function () {

            if (!convertedFiles.length) {

                alert(
                    'No converted files are available.'
                );

                return;

            }


            /*
             * Check JSZip.
             */

            if (
                typeof JSZip ===
                'undefined'
            ) {

                alert(
                    'Download library could not be loaded. Please refresh the page and try again.'
                );

                return;

            }


            const button =
                $(this);


            const originalHTML =
                button.html();


            button
                .prop('disabled', true)
                .html(`
                    <span class="action-icon">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>

                    <span class="action-text">
                        <strong>Preparing...</strong>
                        <small>Creating folder</small>
                    </span>
                `);


            try {

                /*
                 * Create ZIP.
                 */

                const zip =
                    new JSZip();


                /*
                 * Create folder.
                 *
                 * The folder name is:
                 *
                 * converted-images
                 */

                const folder =
                    zip.folder(
                        'converted-images'
                    );


                /*
                 * Prevent duplicate filenames.
                 *
                 * Example:
                 *
                 * photo.jpg
                 * photo.jpg
                 *
                 * becomes:
                 *
                 * photo.jpg
                 * photo (2).jpg
                 */

                const usedNames = {};


                /*
                 * Add every converted file.
                 */

                for (
                    let i = 0;
                    i < convertedFiles.length;
                    i++
                ) {

                    const result =
                        convertedFiles[i];


                    let fileName =
                        safeFileName(
                            result.name
                        );


                    /*
                     * Handle duplicate names.
                     */

                    if (
                        usedNames[fileName]
                    ) {

                        usedNames[fileName]++;

                        const dotIndex =
                            fileName.lastIndexOf('.');


                        if (
                            dotIndex !== -1
                        ) {

                            const base =
                                fileName.substring(
                                    0,
                                    dotIndex
                                );


                            const extension =
                                fileName.substring(
                                    dotIndex
                                );


                            fileName =
                                base +
                                ' (' +
                                usedNames[
                                    result.name
                                ] +
                                ')' +
                                extension;

                        } else {

                            fileName =
                                fileName +
                                ' (' +
                                usedNames[
                                    result.name
                                ] +
                                ')';

                        }

                    } else {

                        usedNames[fileName] = 1;

                    }


                    /*
                     * Add blob to ZIP.
                     */

                    folder.file(
                        fileName,
                        result.blob
                    );


                    /*
                     * Update button progress.
                     */

                    button.find(
                        '.action-text strong'
                    ).text(
                        'Preparing ' +
                        (i + 1) +
                        ' / ' +
                        convertedFiles.length
                    );

                }


                /*
                 * Generate ZIP.
                 */

                const zipBlob =
                    await zip.generateAsync({

                        type: 'blob',

                        compression: 'DEFLATE',

                        compressionOptions: {
                            level: 6
                        }

                    });


                /*
                 * Download ZIP.
                 */

                const url =
                    URL.createObjectURL(
                        zipBlob
                    );


                const link =
                    document.createElement('a');


                link.href =
                    url;


                link.download =
                    'converted-images.zip';


                document.body.appendChild(
                    link
                );


                link.click();


                document.body.removeChild(
                    link
                );


                setTimeout(
                    function () {

                        URL.revokeObjectURL(
                            url
                        );

                    },
                    3000
                );


                /*
                 * Success state.
                 */

                button.html(`
                    <span class="action-icon">
                        <i class="fas fa-check"></i>
                    </span>

                    <span class="action-text">
                        <strong>Downloaded</strong>
                        <small>Folder saved successfully</small>
                    </span>
                `);


                setTimeout(
                    function () {

                        button.html(
                            originalHTML
                        );

                        button.prop(
                            'disabled',
                            false
                        );

                    },
                    2200
                );


            } catch (error) {

                console.error(error);


                alert(
                    'Unable to create the download folder.'
                );


                button
                    .prop('disabled', false)
                    .html(originalHTML);

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | NEW CONVERSION
    |--------------------------------------------------------------------------
    */

    $('#newConversionButton').on(
        'click',
        function () {

            selectedFiles = [];

            convertedFiles = [];


            $('#imageGrid').empty();

            $('#imageCount').text('0');


            $('#conversionResult').hide();

            $('#conversionProgress').hide();


            $('#downloadButton').hide();


            $('#convertButton')
                .show()
                .prop('disabled', false)
                .html(`
                    <span class="action-icon">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </span>

                    <span class="action-text">
                        <strong>Convert Images</strong>
                        <small>Start conversion</small>
                    </span>

                    <i class="fas fa-arrow-right action-arrow"></i>
                `);


            $('#outputFormat')
                .val('jpg')
                .trigger('change');


            $('.format-card')
                .removeClass('active');


            $('.format-card[data-format="jpg"]')
                .addClass('active');


            $('#imageInput').val('');


            $('#converterSection')
                .stop(true, true)
                .slideUp(350);


            setTimeout(function () {

                $('#imageUploadSection')
                    .stop(true, true)
                    .slideDown(450);


                $('html, body').animate({

                    scrollTop:
                        $('#imageUploadSection')
                            .offset()
                            .top - 20

                }, 550);

            }, 250);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CLEAR MEMORY
    |--------------------------------------------------------------------------
    */

    $(window).on(
        'beforeunload',
        function () {

            selectedFiles = [];

            convertedFiles = [];

        }
    );

});

</script>


{{-- =========================================================
SECOND SECTION DESIGN
========================================================== --}}

<style>

/* =========================================================
   MAIN SECTION
========================================================= */

.multi-converter-section {
    padding: 85px 0 95px;
    background:
        linear-gradient(
            180deg,
            #f8fafc 0%,
            #ffffff 100%
        );
}


/* =========================================================
   HEADER
========================================================= */

.modern-converter-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 30px;
    margin-bottom: 32px;
}

.modern-section-label {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 12px;
    border-radius: 30px;
    background: #ecfdf5;
    color: #14532d;
    border: 1px solid #d1fae5;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .2px;
}

.modern-converter-header h2 {
    margin: 14px 0 7px;
    font-size: 43px;
    line-height: 1.1;
    font-weight: 800;
    color: #111827;
    letter-spacing: -1.2px;
}

.modern-converter-header h2 span {
    color: #14532d;
}

.modern-header-content p {
    margin: 0;
    color: #6b7280;
    font-size: 15px;
    max-width: 580px;
}

.modern-image-counter {
    min-width: 205px;
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 14px 17px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(15, 23, 42, .05);
}

.counter-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 12px;
    background: #f0fdf4;
    color: #14532d;
    font-size: 17px;
}

.counter-content strong {
    display: block;
    color: #111827;
    font-size: 23px;
    line-height: 1;
    font-weight: 800;
}

.counter-content span {
    display: block;
    margin-top: 4px;
    color: #8a929c;
    font-size: 12px;
}


/* =========================================================
   MAIN WORKSPACE
========================================================= */

.modern-converter-workspace {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    box-shadow: 0 18px 55px rgba(15, 23, 42, .07);
    overflow: hidden;
}


/* =========================================================
   WORKSPACE HEADER
========================================================= */

.modern-workspace-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 23px 27px;
    border-bottom: 1px solid #eef0f2;
}

.workspace-title {
    display: flex;
    align-items: center;
    gap: 13px;
}

.workspace-title-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #f0fdf4;
    color: #14532d;
    font-size: 17px;
}

.workspace-title h3 {
    margin: 0 0 3px;
    color: #111827;
    font-size: 16px;
    font-weight: 750;
}

.workspace-title p {
    margin: 0;
    color: #8a929c;
    font-size: 12px;
}

.modern-add-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border: 1px solid #14532d;
    background: #ffffff;
    color: #14532d;
    border-radius: 11px;
    padding: 9px 14px 9px 10px;
    font-size: 13px;
    font-weight: 700;
    transition: all .22s ease;
}

.modern-add-button:hover {
    background: #14532d;
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow: 0 7px 18px rgba(20, 83, 45, .18);
}

.modern-add-button:disabled {
    opacity: .55;
    cursor: not-allowed;
    transform: none;
}

.add-button-icon {
    width: 26px;
    height: 26px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 7px;
    background: #ecfdf5;
    color: #14532d;
    transition: all .2s ease;
}

.modern-add-button:hover .add-button-icon {
    background: rgba(255,255,255,.15);
    color: #ffffff;
}


/* =========================================================
   IMAGE GRID
========================================================= */

.modern-image-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    padding: 24px 27px 27px;
}

.modern-image-card {
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #e6e9ed;
    border-radius: 15px;
    transition:
        transform .22s ease,
        box-shadow .22s ease,
        border-color .22s ease;
}

.modern-image-card:hover {
    transform: translateY(-3px);
    border-color: #d1d5db;
    box-shadow: 0 12px 28px rgba(15, 23, 42, .09);
}

.modern-image-preview {
    position: relative;
    height: 155px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background:
        linear-gradient(
            45deg,
            #f8fafc 25%,
            #f1f5f9 25%,
            #f1f5f9 50%,
            #f8fafc 50%,
            #f8fafc 75%,
            #f1f5f9 75%
        );
    background-size: 18px 18px;
}

.modern-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 8px;
}

.modern-image-number {
    position: absolute;
    left: 9px;
    top: 9px;
    min-width: 27px;
    height: 27px;
    padding: 0 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: rgba(17, 24, 39, .78);
    backdrop-filter: blur(5px);
    color: #ffffff;
    font-size: 11px;
    font-weight: 800;
}

.modern-remove-image {
    position: absolute;
    right: 9px;
    top: 9px;
    width: 29px;
    height: 29px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 0;
    border-radius: 8px;
    background: rgba(255,255,255,.95);
    color: #64748b;
    box-shadow: 0 4px 13px rgba(15,23,42,.12);
    transition: all .2s ease;
}

.modern-remove-image:hover {
    background: #dc3545;
    color: #ffffff;
    transform: scale(1.05);
}

.modern-image-info {
    padding: 12px 13px 13px;
}

.modern-file-name {
    display: flex;
    align-items: center;
    gap: 7px;
    min-width: 0;
}

.file-type-dot {
    width: 7px;
    height: 7px;
    flex: 0 0 7px;
    border-radius: 50%;
    background: #22c55e;
}

.modern-file-name strong {
    display: block;
    min-width: 0;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    color: #27303b;
    font-size: 12px;
    font-weight: 700;
}

.modern-file-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 5px;
    margin-top: 8px;
}

.modern-file-meta span {
    color: #8a929c;
    font-size: 10px;
    white-space: nowrap;
}

.modern-file-meta i {
    margin-right: 3px;
    color: #a0a8b2;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.modern-empty-state {
    padding: 55px 20px;
    text-align: center;
    border-top: 1px solid #eef0f2;
}

.empty-state-icon {
    width: 58px;
    height: 58px;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: #f0fdf4;
    color: #14532d;
    font-size: 22px;
}

.modern-empty-state h4 {
    margin: 0 0 6px;
    color: #374151;
    font-size: 16px;
    font-weight: 750;
}

.modern-empty-state p {
    margin: 0 0 18px;
    color: #8a929c;
    font-size: 13px;
}


/* =========================================================
   SETTINGS
========================================================= */

.modern-settings-section {
    margin: 0 27px 27px;
    padding: 25px;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    background: #f8fafc;
}

.modern-settings-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}

.settings-heading-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #ffffff;
    color: #14532d;
    border: 1px solid #dcefe2;
    box-shadow: 0 4px 12px rgba(15,23,42,.04);
}

.modern-settings-header h3 {
    margin: 0 0 3px;
    color: #1f2937;
    font-size: 15px;
    font-weight: 750;
}

.modern-settings-header p {
    margin: 0;
    color: #8a929c;
    font-size: 12px;
}


/* =========================================================
   SETTING LABEL
========================================================= */

.modern-setting-group {
    margin-top: 22px;
}

.modern-setting-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 12px;
}

.setting-title {
    display: block;
    color: #27303b;
    font-size: 13px;
    font-weight: 750;
}

.setting-description {
    display: block;
    margin-top: 3px;
    color: #8a929c;
    font-size: 11px;
}

.selected-format-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 9px;
    border-radius: 8px;
    background: #ecfdf5;
    color: #14532d;
    border: 1px solid #d1fae5;
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
}


/* =========================================================
   FORMAT CARDS
========================================================= */

.format-selector-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}

.format-card {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
    padding: 12px;
    text-align: left;
    border: 1px solid #e1e5e9;
    border-radius: 12px;
    background: #ffffff;
    color: #27303b;
    cursor: pointer;
    transition: all .2s ease;
}

.format-card:hover {
    border-color: #a7cbb4;
    transform: translateY(-1px);
    box-shadow: 0 5px 16px rgba(15,23,42,.05);
}

.format-card.active {
    border-color: #14532d;
    background: #f4fbf6;
    box-shadow:
        0 0 0 2px rgba(20,83,45,.07),
        0 6px 18px rgba(20,83,45,.08);
}

.format-icon {
    width: 37px;
    height: 37px;
    flex: 0 0 37px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    font-size: 14px;
}

.jpg-icon {
    background: #fff7ed;
    color: #ea580c;
}

.jpeg-icon {
    background: #eff6ff;
    color: #2563eb;
}

.png-icon {
    background: #f5f3ff;
    color: #7c3aed;
}

.webp-icon {
    background: #fefce8;
    color: #ca8a04;
}

.pdf-icon {
    background: #fef2f2;
    color: #dc2626;
}

.format-card-content {
    min-width: 0;
}

.format-card-content strong {
    display: block;
    font-size: 12px;
    font-weight: 800;
}

.format-card-content small {
    display: block;
    overflow: hidden;
    margin-top: 2px;
    color: #8a929c;
    font-size: 9px;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.format-check {
    position: absolute;
    right: 7px;
    top: 7px;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #14532d;
    color: #ffffff;
    font-size: 8px;
    opacity: 0;
    transform: scale(.6);
    transition: all .2s ease;
}

.format-card.active .format-check {
    opacity: 1;
    transform: scale(1);
}

.modern-hidden-select {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    opacity: 0 !important;
    pointer-events: none !important;
}


/* =========================================================
   QUALITY
========================================================= */

.quality-selector {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.quality-option {
    position: relative;
    display: block;
    padding: 13px;
    border: 1px solid #e1e5e9;
    border-radius: 11px;
    background: #ffffff;
    cursor: pointer;
    transition: all .2s ease;
}

.quality-option input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.quality-option:hover {
    border-color: #a7cbb4;
}

.quality-option.active {
    border-color: #14532d;
    background: #f4fbf6;
}

.quality-option-content strong {
    display: block;
    color: #27303b;
    font-size: 11px;
    font-weight: 750;
}

.quality-option-content small {
    display: block;
    margin-top: 3px;
    color: #8a929c;
    font-size: 9px;
}

.recommended-label {
    position: absolute;
    top: 7px;
    right: 7px;
    padding: 2px 5px;
    border-radius: 4px;
    background: #dcfce7;
    color: #166534;
    font-size: 7px;
    font-weight: 800;
}


/* =========================================================
   PDF SETTINGS
========================================================= */

.modern-pdf-options {
    margin-top: 18px;
    padding: 17px;
    border: 1px solid #dbe7df;
    border-radius: 13px;
    background: #ffffff;
}

.pdf-options-heading {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 17px;
}

.pdf-heading-icon {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #fef2f2;
    color: #dc2626;
}

.pdf-options-heading strong {
    display: block;
    color: #27303b;
    font-size: 12px;
}

.pdf-options-heading span {
    display: block;
    margin-top: 2px;
    color: #8a929c;
    font-size: 10px;
}

.modern-form-label {
    display: block;
    margin-bottom: 7px;
    color: #374151;
    font-size: 11px;
    font-weight: 700;
}

.modern-form-label i {
    margin-right: 5px;
    color: #14532d;
}

.modern-form-select {
    width: 100%;
    height: 43px;
    padding: 0 13px;
    border: 1px solid #dfe4e8;
    border-radius: 10px;
    background: #ffffff;
    color: #374151;
    font-size: 12px;
    outline: none;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.modern-form-select:focus {
    border-color: #14532d;
    box-shadow: 0 0 0 3px rgba(20,83,45,.08);
}


/* =========================================================
   PROGRESS
========================================================= */

.modern-progress {
    margin: 0 27px 20px;
    padding: 17px 19px;
    border: 1px solid #ccebd6;
    border-radius: 14px;
    background: #f4fbf6;
}

.modern-progress-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 11px;
}

.progress-status {
    display: flex;
    align-items: center;
    gap: 10px;
}

.progress-status-icon {
    width: 33px;
    height: 33px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #ffffff;
    color: #14532d;
}

.progress-status strong {
    display: block;
    color: #14532d;
    font-size: 12px;
}

.progress-status span {
    display: block;
    margin-top: 2px;
    color: #7b8490;
    font-size: 10px;
}

.progress-percent {
    color: #14532d;
    font-size: 13px;
}

.modern-progress-track {
    height: 8px;
    overflow: hidden;
    border-radius: 20px;
    background: #dcefe2;
}

.modern-progress-bar {
    height: 100%;
    border-radius: inherit;
    background: #14532d;
    transition: width .25s ease;
}


/* =========================================================
   SUCCESS
========================================================= */

.modern-success-box {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0 27px 20px;
    padding: 15px 17px;
    border: 1px solid #bbf7d0;
    border-radius: 13px;
    background: #f0fdf4;
}

.success-icon {
    width: 40px;
    height: 40px;
    flex: 0 0 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #14532d;
    color: #ffffff;
}

.success-content {
    min-width: 0;
}

.success-content strong {
    display: block;
    color: #14532d;
    font-size: 13px;
}

.success-content p {
    margin: 3px 0 0;
    color: #6b7280;
    font-size: 11px;
}

.success-badge {
    margin-left: auto;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 8px;
    border-radius: 7px;
    background: #dcfce7;
    color: #166534;
    font-size: 9px;
    font-weight: 750;
}


/* =========================================================
   ACTION AREA
========================================================= */

.modern-action-area {
    display: flex;
    align-items: stretch;
    justify-content: center;
    gap: 11px;
    padding: 0 27px 22px;
}

.modern-primary-action,
.modern-download-action {
    min-width: 280px;
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 11px 13px;
    border: 0;
    border-radius: 12px;
    color: #ffffff;
    text-align: left;
    transition: all .22s ease;
}

.modern-primary-action {
    background: #14532d;
    box-shadow: 0 8px 20px rgba(20,83,45,.18);
}

.modern-primary-action:hover {
    background: #0f4525;
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(20,83,45,.23);
}

.modern-download-action {
    background: #166534;
    box-shadow: 0 8px 20px rgba(22,101,52,.18);
}

.modern-download-action:hover {
    background: #14532d;
    transform: translateY(-2px);
}

.modern-primary-action:disabled,
.modern-download-action:disabled {
    opacity: .65;
    cursor: not-allowed;
    transform: none;
}

.action-icon {
    width: 37px;
    height: 37px;
    flex: 0 0 37px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: rgba(255,255,255,.13);
    font-size: 13px;
}

.action-text {
    flex: 1;
    min-width: 0;
}

.action-text strong {
    display: block;
    font-size: 12px;
    font-weight: 750;
}

.action-text small {
    display: block;
    margin-top: 2px;
    color: rgba(255,255,255,.7);
    font-size: 9px;
}

.action-arrow {
    font-size: 11px;
    opacity: .75;
}

.modern-new-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    min-width: 145px;
    padding: 10px 15px;
    border: 1px solid #d8dde2;
    border-radius: 12px;
    background: #ffffff;
    color: #4b5563;
    font-size: 11px;
    font-weight: 700;
    transition: all .2s ease;
}

.modern-new-action:hover {
    color: #14532d;
    border-color: #a7cbb4;
    background: #f8fcf9;
}


/* =========================================================
   SECURITY
========================================================= */

.modern-security-note {
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 27px 25px;
    padding: 12px 14px;
    border: 1px solid #eef0f2;
    border-radius: 11px;
    background: #fafafa;
}

.security-icon {
    width: 32px;
    height: 32px;
    flex: 0 0 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #f0fdf4;
    color: #14532d;
    font-size: 13px;
}

.modern-security-note strong {
    display: block;
    color: #374151;
    font-size: 10px;
}

.modern-security-note span {
    display: block;
    margin-top: 2px;
    color: #8a929c;
    font-size: 9px;
}

.security-check {
    margin-left: auto;
    color: #22c55e;
    font-size: 14px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1199px) {

    .format-selector-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .modern-image-grid {
        grid-template-columns: repeat(3, 1fr);
    }

}


@media (max-width: 991px) {

    .modern-converter-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .modern-image-counter {
        width: 100%;
    }

    .modern-converter-header h2 {
        font-size: 36px;
    }

    .quality-selector {
        grid-template-columns: repeat(2, 1fr);
    }

    .modern-action-area {
        flex-wrap: wrap;
    }

}


@media (max-width: 767px) {

    .multi-converter-section {
        padding: 55px 0 65px;
    }

    .modern-converter-header h2 {
        font-size: 31px;
    }

    .modern-header-content p {
        font-size: 13px;
    }

    .modern-converter-workspace {
        border-radius: 18px;
    }

    .modern-workspace-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 19px;
    }

    .modern-add-button {
        width: 100%;
    }

    .modern-image-grid {
        grid-template-columns: repeat(2, 1fr);
        padding: 17px;
        gap: 11px;
    }

    .modern-image-preview {
        height: 125px;
    }

    .modern-settings-section {
        margin: 0 17px 17px;
        padding: 17px;
    }

    .format-selector-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .modern-progress,
    .modern-success-box {
        margin-left: 17px;
        margin-right: 17px;
    }

    .modern-action-area {
        flex-direction: column;
        padding-left: 17px;
        padding-right: 17px;
    }

    .modern-primary-action,
    .modern-download-action,
    .modern-new-action {
        width: 100%;
        min-width: 0;
    }

    .modern-security-note {
        margin-left: 17px;
        margin-right: 17px;
    }

}


@media (max-width: 480px) {

    .modern-converter-header h2 {
        font-size: 28px;
    }

    .modern-image-grid {
        grid-template-columns: 1fr 1fr;
    }

    .modern-image-preview {
        height: 105px;
    }

    .modern-image-info {
        padding: 10px;
    }

    .modern-file-meta {
        display: block;
    }

    .modern-file-meta span {
        display: block;
        margin-top: 3px;
    }

    .format-selector-grid {
        grid-template-columns: 1fr;
    }

    .quality-selector {
        grid-template-columns: 1fr 1fr;
    }

    .modern-setting-label {
        align-items: flex-start;
        flex-direction: column;
    }

    .selected-format-badge {
        align-self: flex-start;
    }

    .success-badge {
        display: none;
    }

}

</style>

@endsection
