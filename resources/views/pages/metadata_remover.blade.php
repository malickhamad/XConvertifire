@extends('components.app')

@section('meta')
    <title>Metadata Remover for Images and PDFs | XConvertifire</title>
    <meta name="description"
        content="Remove common metadata from JPG, PNG, WebP images or PDF files in your browser. Preview and download a cleaned copy. Files up to 20 MB.">
@endsection

@section('content')
    <main class="crop-page">

        <!-- Breadcrumb -->
        <section class="crop-breadcrumb-section">
            <div class="container">
                <div class="crop-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                    <span><i class="fas fa-chevron-right"></i></span>
                    <span>Metadata Remover</span>
                </div>
            </div>
        </section>

        <!-- Upload Section -->
        <section class="crop-hero-section" id="uploadSection">
            <div class="container">
                <div class="crop-heading">
                    <span class="crop-small-badge">
                        <i class="fas fa-shield-alt"></i> Privacy Tool
                    </span>

                    <h1>Metadata Remover<br>
                        <span>Clean Common File Metadata.</span>
                    </h1>

                    <p>Re-encode a JPG, PNG or WebP image to remove common embedded metadata, or rebuild a PDF with standard document information fields cleared. Processing runs in your browser.</p>
                </div>

                <div class="crop-upload-box" id="uploadBox" role="button" tabindex="0"
                    aria-label="Click to choose a file">

                    <div class="crop-upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>

                    <h3>Upload your file</h3>
                    <p class="crop-upload-text">Drag &amp; drop your file here or click to browse.</p>

                    <label for="fileInput" class="crop-upload-btn">
                        <i class="fas fa-upload me-2"></i>Choose File
                    </label>

                    <input type="file" id="fileInput" accept="image/jpeg,image/png,image/webp,application/pdf" hidden>

                    <p class="crop-upload-info">JPG, PNG, WebP, PDF | Maximum 20MB</p>

                    <small class="text-secondary">
                        <i class="fas fa-lock me-1"></i>
                        Your file stays in your browser.
                    </small>
                </div>

                <!-- PDF page picker (hidden until a PDF is loaded) -->
                <div id="pdfPagePicker" class="mt-3" style="display:none">
                    <label for="pdfPage" class="form-label fw-semibold">PDF page</label>
                    <div class="d-flex gap-2 align-items-center">
                        <select id="pdfPage" class="form-select" style="max-width:220px"></select>
                        <button type="button" id="loadPdfPageBtn" class="btn btn-primary">
                            <i class="fas fa-sync-alt me-2"></i>Load Page
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Workspace -->
        <section id="workspace" class="compressor-workspace-section" style="display:none">
            <div class="container py-4">

                <!-- Header -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <span class="badge text-bg-primary mb-2">METADATA CLEANER</span>
                        <h2 class="mb-1">Remove Metadata</h2>
                        <p class="text-secondary mb-0">Preview the file and strip its metadata.</p>
                    </div>

                    <button type="button" class="btn btn-outline-light" id="cancelBtn">
                        <i class="fas fa-folder-open me-2"></i>Upload New
                    </button>
                </div>

                <div class="row g-4">

                    <!-- Preview -->
                    <div class="col-lg-8">
                        <div class="wm-editor">

                            <div class="wm-editor-topbar">
                                <span><i class="fas fa-file me-2"></i>File Preview</span>
                                <span class="small text-secondary" id="fileInfo">
                                    <i class="fas fa-info-circle me-1"></i>
                                    No file loaded
                                </span>
                            </div>

                            <div class="wm-canvas-area">
                                <div class="compressor-image-container position-relative">
                                    <canvas id="imageCanvas" class="w-100 d-block"></canvas>
                                </div>
                            </div>

                            <div class="wm-editor-footer">
                                <i class="fas fa-info-circle me-2"></i>
                                This preview shows the file as it will look after metadata removal.
                            </div>
                        </div>

                        <p id="statusText" class="small text-secondary mt-3 mb-0" role="status" aria-live="polite">
                            Upload a file to get started.
                        </p>
                    </div>

                    <!-- Controls -->
                    <div class="col-lg-4">
                        <div class="wm-controls">

                            <div class="wm-controls-heading">
                                <div class="wm-control-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1">Privacy Tools</h5>
                                    <small class="text-secondary">Remove hidden data</small>
                                </div>
                            </div>

                            <hr>

                            <!-- Metadata summary -->
                            <div class="mb-4">
                                <h6 class="fw-semibold mb-2">
                                    <i class="fas fa-search me-2 text-primary"></i>Detected Metadata
                                </h6>
                                <div id="metadataSummary" class="small text-secondary">
                                    Upload a file to inspect metadata.
                                </div>
                            </div>

                            <div class="wm-tip mb-4">
                                <i class="fas fa-lightbulb me-2"></i>
                                <strong>Tip:</strong> Image cleanup redraws and re-encodes the image. PDF cleanup creates a new document, clears common document information fields and sets fixed dates.
                            </div>

                            <!-- Action -->
                            <button type="button" id="removeBtn" class="btn btn-primary w-100 py-3 mb-3" disabled>
                                <i class="fas fa-broom me-2"></i>Remove Metadata
                            </button>

                            <!-- Download -->
                            <button type="button" id="downloadBtn" class="btn btn-success w-100 py-3" style="display:none">
                                <i class="fas fa-download me-2"></i>Download Clean File
                            </button>

                            <div class="wm-privacy mt-4">
                                <i class="fas fa-lock me-2"></i>
                                All processing happens locally in your browser.
                            </div>

                            <small class="d-block text-secondary mt-3">
                                This removes common metadata fields, but it is not a forensic guarantee that every possible hidden or application-specific field is gone. Review the downloaded file when complete metadata removal matters.
                            </small>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="container py-5" aria-labelledby="metadata-remover-guide">
            <div class="row g-4">
                <div class="col-lg-8">
                    <h2 id="metadata-remover-guide" class="text-white fw-bold mb-3">What this metadata remover supports</h2>
                    <p class="text-secondary">The upload control accepts JPG/JPEG, PNG, WebP and PDF files up to 20 MB. For an image, the tool reads the file in your browser, draws it onto a canvas and re-encodes it. This process removes common embedded image data such as EXIF fields, including GPS coordinates when present. The image is re-encoded, so JPEG or WebP output may differ slightly from the original.</p>

                    <h3 class="text-white fw-bold h5 mt-4">How PDF metadata is handled</h3>
                    <p class="text-secondary">For a PDF, the tool builds a new document by copying its pages, clearing standard fields such as title, author, subject, keywords, creator and producer, and setting fixed creation and modification dates. It keeps the page content, but rebuilding a PDF may not preserve every interactive feature, digital signature, annotation, attachment or application-specific property.</p>

                    <h3 class="text-white fw-bold h5 mt-4">What the result does not guarantee</h3>
                    <p class="text-secondary mb-0">The tool targets common embedded metadata. It does not inspect every possible file structure or guarantee forensic removal of every hidden field. Check the downloaded copy before sharing it if complete metadata removal is important.</p>
                </div>
                <div class="col-lg-4">
                    <div class="p-4 rounded border border-secondary h-100">
                        <h2 class="text-white fw-bold h5 mb-3">How to use the tool</h2>
                        <ol class="text-secondary ps-3 mb-0">
                            <li class="mb-2">Choose a supported image or PDF under 20 MB.</li>
                            <li class="mb-2">Review the preview and any detected metadata fields.</li>
                            <li class="mb-2">Select Remove Metadata and wait for the cleaned copy.</li>
                            <li>Download the result and review it before sharing.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .wm-editor,
        .wm-controls {
            background: #111827;
            color: #fff;
            border: 1px solid #263449;
            border-radius: 16px;
            overflow: hidden;
        }

        .wm-editor-topbar,
        .wm-editor-footer {
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .wm-editor-topbar {
            border-bottom: 1px solid #263449;
        }

        .wm-canvas-area {
            padding: 16px;
            background: #0b1120;
            max-height: 500px;
            overflow: auto;
        }

        .wm-canvas-area canvas {
            max-width: 100%;
            height: auto;
        }

        .wm-editor-footer {
            justify-content: flex-start;
            border-top: 1px solid #263449;
            color: #c2ccda;
            font-size: 13px;
        }

        .wm-controls {
            padding: 22px;
        }

        .wm-controls-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .wm-control-icon {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #173b73;
            color: #8bc1ff;
            font-size: 20px;
            flex-shrink: 0;
        }

        .wm-tip {
            padding: 13px;
            border-radius: 10px;
            background: #172b43;
            color: #d5e5ff;
            font-size: 13px;
        }

        .wm-privacy {
            color: #a8b5c7;
            font-size: 13px;
        }

        #uploadBox {
            cursor: pointer;
        }

        #uploadBox.drag-active {
            border-color: #0d6efd;
            background-color: rgba(13, 110, 253, .08);
        }

        #uploadBox label {
            cursor: pointer;
        }

        .meta-chip {
            display: inline-block;
            background: #1e2d44;
            color: #c2d4f0;
            border-radius: 6px;
            padding: 2px 8px;
            margin: 2px 4px 2px 0;
            font-size: 11px;
        }

        @media (max-width: 575px) {
            .wm-controls {
                padding: 16px;
            }

            .wm-editor-topbar,
            .wm-editor-footer {
                padding: 12px;
            }

            .wm-canvas-area {
                padding: 8px;
            }
        }
    </style>
@endsection

@section('scripts')
    <!-- PDF.js for reading PDFs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>

    <!-- pdf-lib for writing PDFs back out -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>

    <!-- EXIF reader for previewing image metadata -->
    <script src="https://cdn.jsdelivr.net/npm/exif-js@2.3.0/exif.min.js"></script>

    <script>
        $(function() {
            const canvas = document.getElementById('imageCanvas');
            const ctx = canvas.getContext('2d');

            let image = new Image();
            let imageUrl = null;
            let fileName = 'cleaned-file';
            let outputMime = 'image/png';
            let outputExt = 'png';

            let hasImage = false;
            let resultReady = false;
            let originalFile = null;

            // PDF state
            let pdfDoc = null;
            let currentPdfFile = null;
            let currentPdfBytes = null;
            let currentPdfPage = 1;

            function status(message) {
                $('#statusText').text(message);
            }

            function updateButtons() {
                $('#downloadBtn').toggle(resultReady);
                $('#removeBtn').prop('disabled', !hasImage);
            }

            function resetResult() {
                resultReady = false;
                updateButtons();
            }

            function fileSizeLabel(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
            }

            /* ----------------------------------------------------------------
               Metadata inspection (read-only preview)
            ---------------------------------------------------------------- */
            function inspectImageMetadata(file) {
                $('#metadataSummary').html('<span class="text-secondary">Scanning image metadata...</span>');

                const reader = new FileReader();
                reader.onload = function(e) {
                    try {
                        const exif = EXIF.readFromBinaryFile(e.target.result);
                        const parts = [];

                        function chip(label, value) {
                            if (value !== undefined && value !== null && value !== '') {
                                parts.push('<span class="meta-chip">' + label + ': ' + value + '</span>');
                            }
                        }

                        chip('Make', exif.Make);
                        chip('Model', exif.Model);
                        chip('Software', exif.Software);
                        chip('DateTime', exif.DateTimeOriginal || exif.DateTime);
                        chip('Artist', exif.Artist);
                        chip('Copyright', exif.Copyright);

                        if (exif.GPSLatitude && exif.GPSLongitude) {
                            chip('GPS', 'Present');
                        }

                        // Count total tags
                        const tagCount = Object.keys(exif).length;
                        if (tagCount > 0) {
                            parts.push('<span class="meta-chip">~' + tagCount + ' EXIF tags</span>');
                        }

                        if (parts.length) {
                            $('#metadataSummary').html(parts.join(' '));
                        } else {
                            $('#metadataSummary').html(
                                '<span class="text-success"><i class="fas fa-check-circle me-1"></i>No obvious EXIF metadata found.</span>'
                            );
                        }
                    } catch (err) {
                        // EXIF reader throws if no EXIF block
                        $('#metadataSummary').html(
                            '<span class="text-success"><i class="fas fa-check-circle me-1"></i>No EXIF metadata detected (or format unsupported).</span>'
                        );
                    }
                };
                reader.onerror = function() {
                    $('#metadataSummary').html('<span class="text-warning">Could not scan metadata.</span>');
                };
                reader.readAsArrayBuffer(file.slice(0, 512 * 1024)); // first 512KB is enough for EXIF
            }

            async function inspectPdfMetadata(bytes) {
                $('#metadataSummary').html('<span class="text-secondary">Scanning PDF metadata...</span>');
                try {
                    const {
                        PDFDocument
                    } = PDFLib;
                    const doc = await PDFDocument.load(bytes, {
                        ignoreEncryption: true,
                        updateMetadata: false
                    });
                    const parts = [];

                    const title = doc.getTitle();
                    const author = doc.getAuthor();
                    const subject = doc.getSubject();
                    const keywords = doc.getKeywords();
                    const creator = doc.getCreator();
                    const producer = doc.getProducer();
                    const creationDate = doc.getCreationDate();
                    const modDate = doc.getModificationDate();

                    function chip(label, value) {
                        if (value !== undefined && value !== null && value !== '') {
                            parts.push('<span class="meta-chip">' + label + ': ' + value + '</span>');
                        }
                    }

                    chip('Title', title);
                    chip('Author', author);
                    chip('Subject', subject);
                    chip('Keywords', keywords);
                    chip('Creator', creator);
                    chip('Producer', producer);
                    if (creationDate) chip('Created', creationDate.toISOString().slice(0, 10));
                    if (modDate) chip('Modified', modDate.toISOString().slice(0, 10));

                    if (parts.length) {
                        $('#metadataSummary').html(parts.join(' '));
                    } else {
                        $('#metadataSummary').html(
                            '<span class="text-success"><i class="fas fa-check-circle me-1"></i>No document metadata fields found.</span>'
                        );
                    }
                } catch (err) {
                    console.error(err);
                    $('#metadataSummary').html(
                    '<span class="text-warning">Could not read PDF metadata.</span>');
                }
            }

            /* ----------------------------------------------------------------
               Adopt a source into the preview canvas
            ---------------------------------------------------------------- */
            function adoptSource(source, name, mime, ext) {
                image = source;

                const w = source.naturalWidth || source.width;
                const h = source.naturalHeight || source.height;

                canvas.width = w;
                canvas.height = h;

                hasImage = true;
                resultReady = false;

                outputMime = mime;
                outputExt = ext;
                fileName = name.replace(/\.[^.]+$/, '') + '-cleaned.' + ext;

                ctx.clearRect(0, 0, w, h);
                ctx.drawImage(image, 0, 0);

                updateButtons();

                $('#uploadSection').hide();
                $('#workspace').show();
                status('File loaded. Click "Remove Metadata" to clean it.');
            }

            /* ----------------------------------------------------------------
               Image loader
            ---------------------------------------------------------------- */
            function loadImageFile(file) {
                if (imageUrl) URL.revokeObjectURL(imageUrl);

                const url = URL.createObjectURL(file);
                imageUrl = url;
                const newImage = new Image();

                originalFile = file;
                status('Loading image...');

                let mime = file.type || 'image/png';
                let ext = ({
                    'image/jpeg': 'jpg',
                    'image/png': 'png',
                    'image/webp': 'webp'
                })[mime] || 'png';

                newImage.onload = function() {
                    if (imageUrl !== url) {
                        URL.revokeObjectURL(url);
                        return;
                    }
                    $('#fileInfo').html(
                        '<i class="fas fa-file-image me-1"></i>' +
                        (file.name || 'image') + ' • ' + fileSizeLabel(file.size)
                    );
                    adoptSource(newImage, file.name, mime, ext);
                    inspectImageMetadata(file);
                    URL.revokeObjectURL(url);
                    imageUrl = null;
                };

                newImage.onerror = function() {
                    if (imageUrl === url) {
                        URL.revokeObjectURL(url);
                        imageUrl = null;
                        alert('Unable to open this image. Please try another file.');
                        status('Could not load the image.');
                    }
                };

                newImage.src = url;
            }

            /* ----------------------------------------------------------------
               PDF loader
            ---------------------------------------------------------------- */
            async function renderPdfPage(pageNum) {
                if (!pdfDoc) return;
                status('Rendering PDF page ' + pageNum + '...');

                try {
                    currentPdfPage = pageNum;
                    const page = await pdfDoc.getPage(pageNum);
                    const viewport = page.getViewport({
                        scale: 2
                    });

                    const off = document.createElement('canvas');
                    off.width = Math.floor(viewport.width);
                    off.height = Math.floor(viewport.height);

                    await page.render({
                        canvasContext: off.getContext('2d'),
                        viewport: viewport
                    }).promise;

                    const baseName = (currentPdfFile?.name || 'document')
                        .replace(/\.[^.]+$/, '') + '-page-' + pageNum;

                    adoptSource(off, baseName, 'application/pdf', 'pdf');
                    $('#fileInfo').html(
                        '<i class="fas fa-file-pdf me-1"></i>' +
                        (currentPdfFile.name || 'document.pdf') +
                        ' • Page ' + pageNum + ' of ' + pdfDoc.numPages
                    );
                    status('PDF page ' + pageNum + ' loaded. Click "Remove Metadata" to clean it.');
                } catch (err) {
                    console.error(err);
                    alert('Could not render this PDF page.');
                    status('Failed to render the PDF page.');
                }
            }

            async function loadPdfFile(file) {
                currentPdfFile = file;
                originalFile = file;
                status('Reading PDF...');

                try {
                    const buf = await file.arrayBuffer();
                    currentPdfBytes = new Uint8Array(buf);
                    pdfDoc = await pdfjsLib.getDocument({
                        data: currentPdfBytes.slice()
                    }).promise;

                    const $sel = $('#pdfPage').empty();
                    for (let i = 1; i <= pdfDoc.numPages; i++) {
                        $sel.append(new Option('Page ' + i, i));
                    }
                    $('#pdfPagePicker').show();

                    inspectPdfMetadata(currentPdfBytes);
                    await renderPdfPage(1);
                } catch (err) {
                    console.error(err);
                    pdfDoc = null;
                    currentPdfFile = null;
                    currentPdfBytes = null;
                    $('#pdfPagePicker').hide();
                    alert('Could not read this PDF. Please try another file.');
                    status('Failed to load the PDF.');
                }
            }

            /* ----------------------------------------------------------------
               Dispatch
            ---------------------------------------------------------------- */
            function handleFile(file) {
                if (!file) return;

                if (file.size > 20 * 1024 * 1024) {
                    alert('Maximum file size is 20MB.');
                    return;
                }

                const type = file.type;
                const name = (file.name || '').toLowerCase();

                if (['image/jpeg', 'image/png', 'image/webp'].includes(type)) {
                    $('#pdfPagePicker').hide();
                    pdfDoc = null;
                    currentPdfFile = null;
                    currentPdfBytes = null;
                    loadImageFile(file);
                    return;
                }

                if (type === 'application/pdf' || name.endsWith('.pdf')) {
                    loadPdfFile(file);
                    return;
                }

                alert('Please select a JPG, PNG, WebP image or a PDF file.');
            }

            /* ----------------------------------------------------------------
               Upload box
            ---------------------------------------------------------------- */
            $('#uploadBox').on('click', function(e) {
                if ($(e.target).closest('label').length) return;
                document.getElementById('fileInput').click();
            });

            $('#uploadBox').on('keydown', function(e) {
                if (e.target !== this) return;
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    document.getElementById('fileInput').click();
                }
            });

            $('#fileInput').on('change', function() {
                handleFile(this.files[0]);
                this.value = '';
            });

            $('#uploadBox')
                .on('dragenter dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-active');
                })
                .on('dragleave', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-active');
                })
                .on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-active');
                    handleFile(e.originalEvent.dataTransfer.files[0]);
                });

            /* ----------------------------------------------------------------
               PDF page switching
            ---------------------------------------------------------------- */
            $('#loadPdfPageBtn').on('click', function() {
                const n = Number($('#pdfPage').val());
                if (n && pdfDoc) renderPdfPage(n);
            });

            /* ----------------------------------------------------------------
               Remove Metadata action
            ---------------------------------------------------------------- */
            $('#removeBtn').on('click', async function() {
                if (!hasImage) return;

                if (outputMime === 'application/pdf') {
                    await removePdfMetadata();
                } else {
                    removeImageMetadata();
                }
            });

            /* --- Image: re-encode, which drops EXIF/ICC/XMP --- */
            function removeImageMetadata() {
                status('Removing image metadata...');

                // Re-drawing the image onto a canvas and re-encoding strips EXIF,
                // GPS, XMP, IPTC, and most other embedded metadata.
                let sourceCanvas = canvas;
                if (outputMime === 'image/jpeg') {
                    const flat = document.createElement('canvas');
                    flat.width = canvas.width;
                    flat.height = canvas.height;
                    const fctx = flat.getContext('2d');
                    fctx.fillStyle = '#ffffff';
                    fctx.fillRect(0, 0, flat.width, flat.height);
                    fctx.drawImage(canvas, 0, 0);
                    sourceCanvas = flat;
                }

                const quality = outputMime === 'image/jpeg' || outputMime === 'image/webp' ? 0.92 : undefined;

                sourceCanvas.toBlob(function(blob) {
                    if (!blob) {
                        status('Unable to create the cleaned image. Please try again.');
                        return;
                    }
                    resultReady = true;
                    updateButtons();
                    status('Common image metadata removed from the re-encoded copy. Click Download to save.');
                    $('#metadataSummary').html(
                        '<span class="text-success"><i class="fas fa-check-circle me-1"></i>Common image metadata removed. Ready to download.</span>'
                    );
                    // Store the clean blob for download
                    window.__cleanBlob = blob;
                    window.__cleanName = fileName;
                }, outputMime, quality);
            }

            /* --- PDF: rebuild with pdf-lib, clearing info dictionary --- */
            async function removePdfMetadata() {
                try {
                    status('Removing PDF metadata...');

                    const {
                        PDFDocument
                    } = PDFLib;

                    // Load original with metadata
                    const originalDoc = await PDFDocument.load(currentPdfBytes, {
                        ignoreEncryption: true
                    });

                    // Create a fresh PDF and copy pages over — this drops document info,
                    // XMP metadata, and other non-page data.
                    const cleanDoc = await PDFDocument.create();

                    // Copy all pages
                    const pageIndices = originalDoc.getPageIndices();
                    const copiedPages = await cleanDoc.copyPages(originalDoc, pageIndices);
                    copiedPages.forEach(p => cleanDoc.addPage(p));

                    // Explicitly clear any info dictionary fields
                    cleanDoc.setTitle('');
                    cleanDoc.setAuthor('');
                    cleanDoc.setSubject('');
                    cleanDoc.setKeywords([]);
                    cleanDoc.setCreator('');
                    cleanDoc.setProducer('');
                    cleanDoc.setCreationDate(new Date(0));
                    cleanDoc.setModificationDate(new Date(0));

                    const outBytes = await cleanDoc.save();
                    const blob = new Blob([outBytes], {
                        type: 'application/pdf'
                    });

                    window.__cleanBlob = blob;
                    window.__cleanName = fileName;

                    resultReady = true;
                    updateButtons();
                    status('Standard PDF information fields cleared. Other pages were kept unchanged. Click Download to save.');
                    $('#metadataSummary').html(
                        '<span class="text-success"><i class="fas fa-check-circle me-1"></i>Standard PDF information fields cleared. Ready to download.</span>'
                    );
                } catch (err) {
                    console.error(err);
                    status('Could not clean the PDF. Try again or use a different file.');
                    alert('Failed to clean PDF metadata: ' + (err.message || err));
                }
            }

            /* ----------------------------------------------------------------
               Download
            ---------------------------------------------------------------- */
            $('#downloadBtn').on('click', function() {
                if (!resultReady || !window.__cleanBlob) return;
                triggerDownload(window.__cleanBlob, window.__cleanName || fileName);
                status('Download started.');
            });

            function triggerDownload(blob, name) {
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = name;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                setTimeout(() => URL.revokeObjectURL(url), 1000);
            }

            /* ----------------------------------------------------------------
               Upload New
            ---------------------------------------------------------------- */
            $('#cancelBtn').on('click', function() {
                if (imageUrl) URL.revokeObjectURL(imageUrl);
                imageUrl = null;
                pdfDoc = null;
                currentPdfFile = null;
                currentPdfBytes = null;
                currentPdfPage = 1;
                originalFile = null;
                window.__cleanBlob = null;
                window.__cleanName = null;

                hasImage = false;
                resultReady = false;
                image = new Image();

                canvas.width = 0;
                canvas.height = 0;

                outputMime = 'image/png';
                outputExt = 'png';
                fileName = 'cleaned-file.png';

                $('#pdfPagePicker').hide();
                $('#workspace').hide();
                $('#uploadSection').show();
                $('#fileInfo').html('<i class="fas fa-info-circle me-1"></i>No file loaded');
                $('#metadataSummary').html('Upload a file to inspect metadata.');
                updateButtons();
                status('Upload a file to get started.');

                document.getElementById('fileInput').click();
            });
        });
    </script>
@endsection
