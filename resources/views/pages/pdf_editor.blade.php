@extends('components.app')
@section('meta')
    <title>FREE PDF Editor: Edit PDF Online FREE | XConvertifire</title>
    <meta name="description"
        content="Edit PDF files online for FREE with XConvertifire. Add, edit, or delete text, undo changes, and download your updated PDF quickly and securely.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="FREE PDF Editor: Edit PDF Online FREE | XConvertifire">
    <meta property="og:description"
        content="Edit PDF files online for FREE with XConvertifire. Add, edit, or delete text, undo changes, and download your updated PDF quickly and securely.">
    <meta property="og:url" content="{{ route('pdf.editor') }}">
    <meta property="og:site_name" content="XConvertifire">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">
    <meta property="og:image:alt" content="XConvertifire PDF Editor">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="FREE PDF Editor: Edit PDF Online FREE | XConvertifire">
    <meta name="twitter:description"
        content="Edit PDF files online for FREE with XConvertifire. Add, edit, or delete text, undo changes, and download your updated PDF quickly and securely.">
    <meta name="twitter:image" content="{{ asset('assets/images/logo.png') }}">
@endsection
@section('content')
    <style>
        .seo-card {
            background: #151515 !important;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            border-radius: 1rem !important;
        }

        .seo-card .accordion-button {
            background: #151515 !important;
            color: #fff !important;
            box-shadow: none !important;
        }

        .seo-card .accordion-button:not(.collapsed) {
            background: rgba(59, 130, 246, 0.08) !important;
            color: #60a5fa !important;
        }

        .seo-card .accordion-button::after {
            filter: invert(1);
        }

        .seo-card .accordion-body {
            background: #151515 !important;
            color: rgba(255, 255, 255, 0.7) !important;
        }
    </style>

    <main class="bg-black" style="margin-top:90px;">
        {{-- =========================================================
            FIRST SECTION
            KEEPING YOUR EXISTING DESIGN
        ========================================================== --}}
        <section class="crop-hero-section" id="pdfUploadSection">
            <section class="mb-5">
                <div class="container">
                    <div class="crop-breadcrumb">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                        <i class="fas fa-chevron-right mx-2"></i>
                        <span>PDF Editor</span>
                    </div>
                </div>
            </section>

            <div class="container">
                <div class="crop-heading text-center">
                    <div class="crop-small-badge">
                        <i class="fas fa-file-pdf me-2"></i>
                        PDF Tool
                    </div>
                    <h1>
                        Edit PDF Text
                        <br>
                        <span>Online for Free</span>
                    </h1>
                    <p>
                        Edit selectable text, add text boxes, apply available formatting,
                        and download an updated copy. Results depend on the PDF's text and layout.
                    </p>
                </div>
                <div class="crop-upload-box mx-auto cursor-pointer" id="uploadArea"
                    onclick="document.getElementById('pdfFileInput').click()">
                    <div class="crop-upload-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h4 class="text-white mb-2">
                        Upload your PDF
                    </h4>
                    <p class="text-secondary mb-4">
                        Drag & drop your PDF here or choose a file
                    </p>
                    <label for="pdfFileInput" class="crop-upload-btn">
                        <i class="fas fa-upload me-2"></i>
                        Choose PDF
                    </label>
                    <input type="file" id="pdfFileInput" class="d-none" accept=".pdf,application/pdf">
                    <div class="small text-secondary mt-3">
                        PDF files only
                        <br>
                        Maximum file size: 50MB
                    </div>
                </div>
            </div>
        </section>
        {{-- =========================================================
            PDF EDITOR
        ========================================================== --}}
        <section id="pdfEditorSection" class="d-none pb-5">
            <div class="container-fluid px-lg-4">
                {{-- =================================================
                    EDITOR WORKSPACE
                ================================================== --}}
                <div class="pdf-workspace">
                    {{-- PAGE SIDEBAR --}}
                    <aside class="pdf-sidebar">
                        <div class="pdf-sidebar-header">
                            <div class="sidebar-title">
                                <span class="sidebar-title-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </span>
                                <div>
                                    <strong>Pages</strong>
                                    <small>PDF document</small>
                                </div>
                            </div>
                        </div>
                        <div id="pdfThumbnails" class="pdf-thumbnails-list">
                        </div>
                    </aside>
                    {{-- MAIN EDITOR --}}
                    <div class="pdf-main-area">
                        {{-- INFO BAR --}}
                        <div class="pdf-info-bar">
                            <div class="pdf-editor-status">
                                <span class="status-icon">
                                    <i class="fas fa-mouse-pointer"></i>
                                </span>
                                <div>
                                    <span class="status-label">
                                        Editing
                                    </span>
                                    <span id="editorStatus">
                                        Click any PDF text to edit
                                    </span>
                                </div>
                            </div>
                            <div class="pdf-editor-tip">
                                {{-- <i class="fas fa-lightbulb"></i>
                                <span>
                                    Select text to change its font, size,
                                    style or color
                                </span> --}}
                                <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-primary"
                                    onclick="return confirm('Upload a new PDF? Your current edits will be lost.');">
                                    <i class="fas fa-file-upload me-1"></i>
                                    Upload New PDF
                                </a>
                            </div>
                        </div>
                        {{-- PDF PAGES --}}
                        <div id="pdfPagesContainer" class="pdf-pages-container">
                        </div>
                    </div>

                    {{-- =================================================
                        EDITOR TOOLBAR (RIGHT SIDE)
                    ================================================== --}}
                    <div class="pdf-editor-toolbar">
                        <div class="pdf-toolbar-top">
                            <div class="pdf-toolbar-left">
                                {{-- HISTORY --}}
                                <div class="pdf-toolbar-group">
                                    <div class="pdf-group-label">
                                        <i class="fas fa-history"></i>
                                        History
                                    </div>
                                    <div class="pdf-button-row">
                                        <button type="button" class="pdf-tool-btn" id="undoBtn" title="Undo">
                                            <i class="fas fa-undo"></i>
                                            <span>Undo</span>
                                        </button>
                                        <button type="button" class="pdf-tool-btn" id="redoBtn" title="Redo">
                                            <i class="fas fa-redo"></i>
                                            <span>Redo</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="toolbar-divider"></div>
                                {{-- EDIT --}}
                                <div class="pdf-toolbar-group">
                                    <div class="pdf-group-label">
                                        <i class="fas fa-pen"></i>
                                        Edit
                                    </div>
                                    <div class="pdf-button-row">
                                        <button type="button" class="pdf-tool-btn pdf-add-text-btn" id="addTextBtn"
                                            title="Add a new text box">
                                            <i class="fas fa-plus"></i>
                                            <span>Add Text</span>
                                        </button>
                                        <button type="button" class="pdf-tool-btn danger-tool" id="deleteTextBtn"
                                            title="Delete selected text">
                                            <i class="fas fa-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="toolbar-divider"></div>
                                {{-- TEXT --}}
                                <div class="pdf-toolbar-group">
                                    <div class="pdf-group-label">
                                        <i class="fas fa-font"></i>
                                        Text
                                    </div>
                                    <div class="pdf-button-row">
                                        {{-- FONT --}}
                                        <div class="pdf-control-box">
                                            <div class="pdf-control-icon">
                                                <i class="fas fa-font"></i>
                                            </div>
                                            <div class="pdf-control-content">
                                                <span>Font</span>
                                                <select id="fontFamilySelect" class="pdf-select">
                                                    <option value="Helvetica">
                                                        Helvetica
                                                    </option>
                                                    <option value="Times-Roman">
                                                        Times New Roman
                                                    </option>
                                                    <option value="Courier">
                                                        Courier
                                                    </option>
                                                    <option value="Arial">
                                                        Arial
                                                    </option>
                                                    <option value="Georgia">
                                                        Georgia
                                                    </option>
                                                    <option value="Verdana">
                                                        Verdana
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- SIZE --}}
                                        <div class="pdf-control-box pdf-size-box">
                                            <div class="pdf-control-icon">
                                                <i class="fas fa-text-height"></i>
                                            </div>
                                            <div class="pdf-control-content">
                                                <span>Size</span>
                                                <select id="fontSizeSelect" class="pdf-select">
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12" selected>12</option>
                                                    <option value="14">14</option>
                                                    <option value="16">16</option>
                                                    <option value="18">18</option>
                                                    <option value="20">20</option>
                                                    <option value="24">24</option>
                                                    <option value="28">28</option>
                                                    <option value="32">32</option>
                                                    <option value="36">36</option>
                                                    <option value="42">42</option>
                                                    <option value="48">48</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="toolbar-divider"></div>
                                {{-- FORMAT --}}
                                <div class="pdf-toolbar-group">
                                    <div class="pdf-group-label">
                                        <i class="fas fa-sliders-h"></i>
                                        Format
                                    </div>
                                    <div class="pdf-button-row">
                                        <button type="button" class="pdf-format-btn" data-format="bold" id="boldBtn"
                                            title="Bold">
                                            <i class="fas fa-bold"></i>
                                        </button>
                                        <button type="button" class="pdf-format-btn" data-format="italic"
                                            id="italicBtn" title="Italic">
                                            <i class="fas fa-italic"></i>
                                        </button>
                                        <button type="button" class="pdf-format-btn" data-format="underline"
                                            id="underlineBtn" title="Underline">
                                            <i class="fas fa-underline"></i>
                                        </button>
                                        {{-- COLOR --}}
                                        <div class="color-picker-wrapper">
                                            <button type="button" class="pdf-color-btn" id="textColorButton"
                                                title="Change text color">
                                                <span class="color-icon">
                                                    <i class="fas fa-palette"></i>
                                                </span>
                                                <span class="color-bar" id="currentColorBar"></span>
                                            </button>
                                            <input type="color" id="textColorPicker" value="#111111">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- RIGHT CONTROLS --}}
                            <div class="pdf-toolbar-right">
                                {{-- ZOOM --}}
                                <div class="pdf-zoom-control">
                                    <span class="pdf-zoom-label">
                                        <i class="fas fa-search"></i>
                                        Zoom
                                    </span>
                                    <div class="pdf-zoom-buttons">
                                        <button type="button" class="pdf-tool-btn" id="zoomOutBtn" title="Zoom out">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span id="zoomValue" class="zoom-value">
                                            100%
                                        </span>
                                        <button type="button" class="pdf-tool-btn" id="zoomInBtn" title="Zoom in">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- DOWNLOAD --}}
                                <button type="button" class="pdf-download-btn" id="downloadPdfBtn">
                                    <span class="download-icon">
                                        <i class="fas fa-download"></i>
                                    </span>
                                    <span>
                                        Download PDF
                                    </span>
                                </button>
                            </div>
                        </div>
                        {{-- QUICK HELP --}}
                        <div class="pdf-toolbar-help">
                            <div>
                                <i class="fas fa-info-circle"></i>
                                <span>
                                    Click any text to edit it directly
                                </span>
                            </div>
                            <div class="pdf-help-items">
                                <span>
                                    <kbd>Ctrl</kbd> + <kbd>Z</kbd>
                                    Undo
                                </span>
                                <span>
                                    <kbd>Ctrl</kbd> + <kbd>C</kbd>
                                    Copy
                                </span>
                                <span>
                                    <kbd>Ctrl</kbd> + <kbd>V</kbd>
                                    Paste
                                </span>
                                <span>
                                    <kbd>Ctrl</kbd> + <kbd>S</kbd>
                                    Download
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{-- =========================================================
            LOADER
        ========================================================== --}}
        <div id="pdfLoadingOverlay" class="pdf-loading-overlay d-none">
            <div class="pdf-loader-box">
                <div class="pdf-loader-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="spinner-border text-primary mb-3" role="status">
                </div>
                <div id="pdfLoadingText" class="text-white">
                    Preparing PDF...
                </div>
                <div class="pdf-loader-subtitle">
                    Please wait while your PDF is being prepared
                </div>
            </div>
        </div>
        <!-- <section class="pdf-editor-seo-section">
                <div class="container">
                    <div class="pdf-editor-seo-wrap">
                        <h2>Free Online PDF Editor</h2>
                        <p>An online PDF editor helps you make focused text changes without first rebuilding a document in another application. XConvertifire lets you edit PDF online by selecting text the page can extract, adding new text boxes, applying the available formatting controls, and downloading an updated PDF.</p>
                        <p>This free PDF editor online works with extractable text and new text overlays on a rendered view of each page. It is useful for small corrections, labels, or notes, but it is not a complete document reconstruction system. What you can change depends on how a PDF was created and how its content is encoded.</p>

                        <h2>How to Edit a PDF Online</h2>
                        <p>Use the upload area and editor controls to make changes, then inspect the result before saving it.</p>
                        <div class="row g-3 pdf-editor-seo-steps">
                            <div class="col-md-6">
                                <article class="pdf-editor-seo-step">
                                    <h3>1. Upload Your PDF</h3>
                                    <p>Choose a PDF from your device or drag it into the upload area. Files up to 50 MB are accepted. The page loads the document into its editor and displays its pages for review. A password-protected, damaged, unusually structured, or otherwise unsupported file may not load as expected.</p>
                                </article>
                            </div>
                            <div class="col-md-6">
                                <article class="pdf-editor-seo-step">
                                    <h3>2. Select or Add Text</h3>
                                    <p>Click text that the editor can identify to work with an existing text element. To add content that is not already on the page, choose <strong>Add Text</strong> to create a new text box. A scanned page is an image, so its printed words are not selectable text in this editor.</p>
                                </article>
                            </div>
                            <div class="col-md-6">
                                <article class="pdf-editor-seo-step">
                                    <h3>3. Adjust Your Changes</h3>
                                    <p>Use the font, size, color, bold, italic, and underline controls for supported text. Position added text with the editor's existing controls. Check alignment, line breaks, and nearby content as you work, because replacement text may not fit the same space as the original.</p>
                                </article>
                            </div>
                            <div class="col-md-6">
                                <article class="pdf-editor-seo-step">
                                    <h3>4. Download the Edited PDF</h3>
                                    <p>Review the edited pages in the workspace, including pages you did not change, before choosing <strong>Download PDF</strong>. Open the downloaded file in a PDF reader and inspect it again. For more extensive text editing, you may find it useful to <a href="{{ route('pdf.to.word') }}">convert a PDF to Word</a>, then use <a href="{{ route('word.pdf.index') }}">Word to PDF</a> when you are ready to export.</p>
                                </article>
                            </div>
                        </div>

                        <h2>Edit Existing PDF Text</h2>
                        <p>When the editor can extract text from a PDF page, selecting a text element lets you change its content and apply the available formatting. The page is rendered as a visual reference, while editable text elements are reconstructed over that rendered view for interaction and export. This process does not fully reconstruct the PDF's original text structure or every relationship between its text, fonts, and layout.</p>
                        <p>PDFs vary in how they store text. A file may use unusual character mappings, embedded fonts, separate glyphs, or layout instructions that make extraction incomplete. In those cases, some words may not be selectable, or a change may not align exactly with the original. If the selected text does not behave as expected, keep the source file and avoid relying on the edited copy without a careful review.</p>

                        <h2>Add New Text to a PDF</h2>
                        <p>The <strong>Add Text</strong> control creates a text box that can be used for a short label, a note, or additional information. Enter the wording, then position the new text using the editor's existing controls. Use a concise amount of text and check its placement against the page content, since a new box may overlap other material or extend beyond the intended area.</p>
                        <p>New text is not the same as changing the PDF's underlying page design. This editor provides text editing and text-box overlays; it does not offer general-purpose insertion of images, signatures, shapes, or other objects. If your document needs those kinds of changes, choose an application designed for that work.</p>

                        <h2>Change PDF Text Fonts, Sizes and Colors</h2>
                        <p>For a selected or added text element, the toolbar provides font selection, font-size choices, and a text-color control. Bold, italic, and underline options are also available. These controls can help make a small correction or added note clearer, but they do not guarantee that the edited text will look identical to the original PDF.</p>
                        <p>The available output fonts may differ from fonts embedded in the source document. A replacement font can have different character widths and shapes, which may change line breaks or spacing. Preview each change at a useful zoom level, and check the exported page because the final appearance can differ from the editing view.</p>

                        <h2>Undo, Redo and Navigate PDF Pages</h2>
                        <p>Use Undo and Redo to move through supported editing actions. The zoom controls help you inspect small text and page details, while the page thumbnails provide previews for moving through a multi-page document. These are navigation and review aids, not controls for rearranging or rebuilding the pages.</p>
                        <p>Before downloading, revisit pages with edits and scan the remaining pages for unexpected display issues. Undo or redo a change if needed, then inspect the downloaded PDF separately. Keeping the original gives you a way back if an edit or export does not meet your needs.</p>

                        <h2>PDF Text Editing vs Scanned Documents</h2>
                        <p>A PDF with extractable text contains characters the editor can identify and select. A scanned PDF often contains a page-sized image instead. Although both files may look like pages of text, selecting and changing text requires the content to be available as text rather than only as pixels.</p>
                        <p>This editor does not provide optical character recognition (OCR). It cannot turn words embedded in a scanned image into editable text by itself. If a scan needs text recognition, first use a suitable OCR tool to create a text-enabled PDF, then check the recognized text for errors before editing it here.</p>

                        <h2>Understanding PDF Text Removal and Redaction</h2>
                        <p>The <strong>Delete Text</strong> control can visually remove a selected text element in the edited view. For changed or deleted text, export may place a white mask over the original content and draw replacement text where applicable. A white mask changes what is visible on the page; it does not necessarily remove the original text or other underlying PDF data.</p>
                        <p><strong>Do not rely on this editor to securely redact passwords, identity numbers, financial details, or other confidential information.</strong> Visually covering text is not secure redaction, and underlying content may remain recoverable. For sensitive material, use a suitable redaction tool that actually removes the underlying information and provides a way to verify that the removal is complete. When appropriate, obtain qualified guidance before sharing the document.</p>

                        <h2>How to Preserve PDF Formatting When Editing</h2>
                        <p>PDFs can contain carefully positioned text, embedded fonts, and complex page layouts. Editing one text element does not rebuild the entire composition. Replacement text may use a different font, wrap onto another line, or shift relative to nearby content. The available export fonts may not include the original embedded font, and unsupported characters may be omitted during export.</p>
                        <p>Non-Latin scripts, including Urdu and Arabic, and complex text shaping may be limited by the current export process. Do not assume full Unicode support. Test important characters on a copy, download the result, and inspect every page in a PDF reader before using or sharing it.</p>

                        <h2>Tips for Editing PDF Documents Online</h2>
                        <ul>
                            <li>Start with a PDF that contains selectable text for edits to existing wording.</li>
                            <li>Keep an unchanged copy of the original before you make edits.</li>
                            <li>Choose a suitable font size and check line breaks and spacing near each change.</li>
                            <li>Review every edited page and open the downloaded PDF in a separate reader.</li>
                            <li>Test special characters on a copy before relying on them in the final document.</li>
                            <li>Do not use visual text masking for confidential or security-sensitive redaction.</li>
                        </ul>

                        <h2>Frequently Asked Questions About PDF Editing</h2>
                        <div class="pdf-editor-seo-faq">
                            <article>
                                <h3>Is XConvertifire's PDF Editor free?</h3>
                                <p>The editor is presented as a free online tool. Upload limits and document compatibility still apply, and you should review the result before relying on it.</p>
                            </article>
                            <article>
                                <h3>Can I edit PDF text online?</h3>
                                <p>You can edit text that the editor can extract, add text boxes, apply available formatting, and download an updated PDF. Not every PDF stores its text in a form that can be edited accurately.</p>
                            </article>
                            <article>
                                <h3>How do I add new text to a PDF?</h3>
                                <p>Upload the PDF, choose <strong>Add Text</strong>, enter your content, position the new text box with the existing controls, and review the page before downloading.</p>
                            </article>
                            <article>
                                <h3>Can I change the font or color of PDF text?</h3>
                                <p>The toolbar includes font, size, color, bold, italic, and underline controls for supported text. Available fonts may not match the source PDF's embedded fonts, so exact visual matching is not guaranteed.</p>
                            </article>
                            <article>
                                <h3>Can I delete text from a PDF?</h3>
                                <p>The Delete Text control can visually remove selected text in the edited output. It should not be treated as secure removal of the underlying PDF content.</p>
                            </article>
                            <article>
                                <h3>Does deleting text permanently remove it from the PDF?</h3>
                                <p>Not necessarily. The export may cover original content with a white mask, which can leave underlying information in the PDF. Do not use this method as secure redaction.</p>
                            </article>
                            <article>
                                <h3>Can I securely redact confidential information?</h3>
                                <p>No. Use a dedicated redaction tool that removes sensitive data from the underlying document and lets you verify the result. Do not rely on this editor to redact confidential information.</p>
                            </article>
                            <article>
                                <h3>Can I edit a scanned PDF?</h3>
                                <p>This editor does not include OCR. Text that appears only inside a scanned page image is not selectable for editing here. Use an OCR tool first if you need recognized text, then check its accuracy.</p>
                            </article>
                            <article>
                                <h3>What is the maximum PDF upload size?</h3>
                                <p>The upload interface lists a maximum file size of 50 MB.</p>
                            </article>
                            <article>
                                <h3>Can I undo and redo edits?</h3>
                                <p>Yes. The editor has Undo and Redo controls for supported editing actions. Review the page after undoing or reapplying a change.</p>
                            </article>
                            <article>
                                <h3>Does the editor support multi-page PDFs?</h3>
                                <p>The editor displays PDF page previews and thumbnails for navigating the document. How a particular file loads can depend on its structure and compatibility.</p>
                            </article>
                            <article>
                                <h3>Will the original PDF formatting be preserved?</h3>
                                <p>Exact preservation is not guaranteed. Different fonts, text widths, line wrapping, complex layouts, or export limitations can change the appearance. Inspect the downloaded file page by page.</p>
                            </article>
                            <article>
                                <h3>Can I edit Urdu or other non-Latin text?</h3>
                                <p>Support is not guaranteed. The current export process may omit unsupported characters or fail to handle complex text shaping. Test a copy and verify the downloaded result before depending on it.</p>
                            </article>
                            <article>
                                <h3>How do I download an edited PDF?</h3>
                                <p>Review the pages in the editor, then select <strong>Download PDF</strong>. Open the downloaded file in a PDF reader and check that the content and layout are as expected.</p>
                            </article>
                            <article>
                                <h3>Is PDF editing performed in the browser?</h3>
                                <p>This page renders and edits the selected document through browser-loaded PDF.js and pdf-lib libraries. Their project pages explain <a href="https://mozilla.github.io/pdf.js/" target="_blank" rel="noopener noreferrer">PDF.js rendering</a> and <a href="https://pdf-lib.js.org/" target="_blank" rel="noopener noreferrer">PDF document creation and modification</a>. This description is not a privacy or security guarantee; consider the document's sensitivity before uploading it.</p>
                            </article>
                        </div>

                        <div class="pdf-editor-seo-final">
                            <h2>Edit Your PDF Online for Free</h2>
                            <p>Upload your PDF, update selectable text, add new text and download your edited document with XConvertifire.</p>
                            <a href="#pdfUploadSection" class="pdf-editor-seo-cta" id="pdfEditorSeoCta">Edit Your PDF Now</a>
                        </div>
                    </div>
                </div>
            </section> -->

        <section class="py-5">
            <div class="container" style="max-width: 1080px;">

                <!-- ═══ HERO ═══ -->
                <div class="seo-card shadow-lg mb-5">
                    <div class="card-body p-4 p-md-5">
                        <span
                            class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">
                            <i class="fas fa-file-pdf me-1"></i> PDF Editing Guide
                        </span>
                        <h2 class="text-white fw-bold mb-3">Free Online PDF Editor</h2>
                        <p class="text-secondary mb-3">An online PDF editor helps you make focused text changes without
                            first rebuilding a document in another application. XConvertifire lets you edit PDF online by
                            selecting text the page can extract, adding new text boxes, applying the available formatting
                            controls, and downloading an updated PDF.</p>
                        <p class="text-secondary mb-0">This free PDF editor online works with extractable text and new text
                            overlays on a rendered view of each page. It is useful for small corrections, labels, or notes,
                            but it is not a complete document reconstruction system. What you can change depends on how a
                            PDF was created and how its content is encoded.</p>
                    </div>
                </div>

                <!-- ═══ STEPS ═══ -->
                <div class="text-center mb-4">
                    <span
                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">How
                        It Works</span>
                    <h2 class="text-white fw-bold mb-2">How to Edit a PDF Online</h2>
                    <p class="text-secondary mb-0">Use the upload area and editor controls to make changes, then inspect
                        the result before saving it.</p>
                </div>

                <div class="row g-3 mb-5">
                    <div class="col-lg-3 col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3"
                                    style="width:48px;height:48px;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-2">1. Upload Your PDF</h3>
                                <p class="text-secondary small mb-0">Choose a PDF from your device or drag it into the
                                    upload area. Files up to 50 MB are accepted. The page loads the document into its editor
                                    and displays its pages for review. A password-protected, damaged, unusually structured,
                                    or otherwise unsupported file may not load as expected.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3"
                                    style="width:48px;height:48px;">
                                    <i class="fas fa-mouse-pointer"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-2">2. Select or Add Text</h3>
                                <p class="text-secondary small mb-0">Click text that the editor can identify to work with
                                    an existing text element. To add content that is not already on the page, choose <strong
                                        class="text-white">Add Text</strong> to create a new text box. A scanned page is an
                                    image, so its printed words are not selectable text in this editor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3"
                                    style="width:48px;height:48px;">
                                    <i class="fas fa-sliders-h"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-2">3. Adjust Your Changes</h3>
                                <p class="text-secondary small mb-0">Use the font, size, color, bold, italic, and underline
                                    controls for supported text. Position added text with the editor's existing controls.
                                    Check alignment, line breaks, and nearby content as you work, because replacement text
                                    may not fit the same space as the original.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 border border-primary border-opacity-25 text-primary mb-3"
                                    style="width:48px;height:48px;">
                                    <i class="fas fa-download"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-2">4. Download the Edited PDF</h3>
                                <p class="text-secondary small mb-0">Review the edited pages in the workspace, including
                                    pages you did not change, before choosing <strong class="text-white">Download
                                        PDF</strong>. Open the downloaded file in a PDF reader and inspect it again. For
                                    more extensive text editing, you may find it useful to <a
                                        href="{{ route('pdf.to.word') }}">convert a PDF to Word</a>, then use <a
                                        href="{{ route('word.pdf.index') }}">Word to PDF</a> when you are ready to export.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══ EDIT EXISTING TEXT ═══ -->
                <div class="seo-card shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="text-white fw-bold h4 mb-3">Edit Existing PDF Text</h2>
                        <p class="text-secondary mb-3">When the editor can extract text from a PDF page, selecting a text
                            element lets you change its content and apply the available formatting. The page is rendered as
                            a visual reference, while editable text elements are reconstructed over that rendered view for
                            interaction and export. This process does not fully reconstruct the PDF's original text
                            structure or every relationship between its text, fonts, and layout.</p>
                        <p class="text-secondary mb-0">PDFs vary in how they store text. A file may use unusual character
                            mappings, embedded fonts, separate glyphs, or layout instructions that make extraction
                            incomplete. In those cases, some words may not be selectable, or a change may not align exactly
                            with the original. If the selected text does not behave as expected, keep the source file and
                            avoid relying on the edited copy without a careful review.</p>
                    </div>
                </div>

                <!-- ═══ ADD NEW TEXT & FORMATTING ═══ -->
                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-success bg-opacity-10 border border-success border-opacity-25 text-success mb-3"
                                    style="width:44px;height:44px;">
                                    <i class="fas fa-plus-square"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-3">Add New Text to a PDF</h3>
                                <p class="text-secondary small mb-3">The <strong class="text-white">Add Text</strong>
                                    control creates a text box that can be used for a short label, a note, or additional
                                    information. Enter the wording, then position the new text using the editor's existing
                                    controls. Use a concise amount of text and check its placement against the page content,
                                    since a new box may overlap other material or extend beyond the intended area.</p>
                                <p class="text-secondary small mb-0">New text is not the same as changing the PDF's
                                    underlying page design. This editor provides text editing and text-box overlays; it does
                                    not offer general-purpose insertion of images, signatures, shapes, or other objects. If
                                    your document needs those kinds of changes, choose an application designed for that
                                    work.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 text-warning mb-3"
                                    style="width:44px;height:44px;">
                                    <i class="fas fa-font"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-3">Change PDF Text Fonts, Sizes and Colors</h3>
                                <p class="text-secondary small mb-3">For a selected or added text element, the toolbar
                                    provides font selection, font-size choices, and a text-color control. Bold, italic, and
                                    underline options are also available. These controls can help make a small correction or
                                    added note clearer, but they do not guarantee that the edited text will look identical
                                    to the original PDF.</p>
                                <p class="text-secondary small mb-0">The available output fonts may differ from fonts
                                    embedded in the source document. A replacement font can have different character widths
                                    and shapes, which may change line breaks or spacing. Preview each change at a useful
                                    zoom level, and check the exported page because the final appearance can differ from the
                                    editing view.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══ UNDO / NAVIGATE ═══ -->
                <div class="seo-card shadow-sm mb-5">
                    <div class="card-body p-4 p-md-5">
                        <span
                            class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-3 py-2 mb-3">Navigation
                            & Review</span>
                        <h2 class="text-white fw-bold h4 mb-3">Undo, Redo and Navigate PDF Pages</h2>
                        <p class="text-secondary mb-3">Use Undo and Redo to move through supported editing actions. The
                            zoom controls help you inspect small text and page details, while the page thumbnails provide
                            previews for moving through a multi-page document. These are navigation and review aids, not
                            controls for rearranging or rebuilding the pages.</p>
                        <p class="text-secondary mb-0">Before downloading, revisit pages with edits and scan the remaining
                            pages for unexpected display issues. Undo or redo a change if needed, then inspect the
                            downloaded PDF separately. Keeping the original gives you a way back if an edit or export does
                            not meet your needs.</p>
                    </div>
                </div>

                <!-- ═══ SCANNED DOCS vs TEXT + REDACTION ═══ -->
                <div class="text-center mb-4 mt-5">
                    <span
                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">Limitations
                        & Safety</span>
                    <h2 class="text-white fw-bold mb-0">Scanned Documents and Redaction</h2>
                </div>

                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="seo-card h-100 shadow-sm">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-info bg-opacity-10 border border-info border-opacity-25 text-info mb-3"
                                    style="width:44px;height:44px;">
                                    <i class="fas fa-file-image"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-3">PDF Text Editing vs Scanned Documents</h3>
                                <p class="text-secondary small mb-3">A PDF with extractable text contains characters the
                                    editor can identify and select. A scanned PDF often contains a page-sized image instead.
                                    Although both files may look like pages of text, selecting and changing text requires
                                    the content to be available as text rather than only as pixels.</p>
                                <p class="text-secondary small mb-0">This editor does not provide optical character
                                    recognition (OCR). It cannot turn words embedded in a scanned image into editable text
                                    by itself. If a scan needs text recognition, first use a suitable OCR tool to create a
                                    text-enabled PDF, then check the recognized text for errors before editing it here.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="seo-card h-100 shadow-sm" style="border-color: rgba(239, 68, 68, 0.35) !important;">
                            <div class="card-body p-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-danger bg-opacity-10 border border-danger border-opacity-25 text-danger mb-3"
                                    style="width:44px;height:44px;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h3 class="h6 text-white fw-semibold mb-3">Understanding PDF Text Removal and Redaction
                                </h3>
                                <p class="text-secondary small mb-3">The <strong class="text-white">Delete Text</strong>
                                    control can visually remove a selected text element in the edited view. For changed or
                                    deleted text, export may place a white mask over the original content and draw
                                    replacement text where applicable. A white mask changes what is visible on the page; it
                                    does not necessarily remove the original text or other underlying PDF data.</p>
                                <p class="text-secondary small mb-0"><strong class="text-danger">Do not rely on this
                                        editor to securely redact passwords, identity numbers, financial details, or other
                                        confidential information.</strong> Visually covering text is not secure redaction,
                                    and underlying content may remain recoverable. For sensitive material, use a suitable
                                    redaction tool that actually removes the underlying information and provides a way to
                                    verify that the removal is complete. When appropriate, obtain qualified guidance before
                                    sharing the document.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══ PRESERVING FORMATTING ═══ -->
                <div class="seo-card shadow-sm mb-5">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="text-white fw-bold h4 mb-3">How to Preserve PDF Formatting When Editing</h2>
                        <p class="text-secondary mb-3">PDFs can contain carefully positioned text, embedded fonts, and
                            complex page layouts. Editing one text element does not rebuild the entire composition.
                            Replacement text may use a different font, wrap onto another line, or shift relative to nearby
                            content. The available export fonts may not include the original embedded font, and unsupported
                            characters may be omitted during export.</p>
                        <p class="text-secondary mb-0">Non-Latin scripts, including Urdu and Arabic, and complex text
                            shaping may be limited by the current export process. Do not assume full Unicode support. Test
                            important characters on a copy, download the result, and inspect every page in a PDF reader
                            before using or sharing it.</p>
                    </div>
                </div>

                <!-- ═══ TIPS ═══ -->
                <div class="seo-card shadow-sm mb-5">
                    <div class="card-body p-4 p-md-5">
                        <span
                            class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 mb-3">Best
                            Practices</span>
                        <h2 class="text-white fw-bold h4 mb-4">Tips for Editing PDF Documents Online</h2>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                                <p class="text-secondary small mb-0">Start with a PDF that contains selectable text for
                                    edits to existing wording.</p>
                            </div>
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                                <p class="text-secondary small mb-0">Keep an unchanged copy of the original before you make
                                    edits.</p>
                            </div>
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                                <p class="text-secondary small mb-0">Choose a suitable font size and check line breaks and
                                    spacing near each change.</p>
                            </div>
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                                <p class="text-secondary small mb-0">Review every edited page and open the downloaded PDF
                                    in a separate reader.</p>
                            </div>
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                                <p class="text-secondary small mb-0">Test special characters on a copy before relying on
                                    them in the final document.</p>
                            </div>
                            <div class="d-flex gap-3">
                                <i class="fas fa-check-circle text-success mt-1 flex-shrink-0"></i>
                                <p class="text-secondary small mb-0">Do not use visual text masking for confidential or
                                    security-sensitive redaction.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ═══ FAQ ═══ -->
                <div class="text-center mb-4 mt-5">
                    <span
                        class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3">FAQ</span>
                    <h2 class="text-white fw-bold mb-0">Frequently Asked Questions About PDF Editing</h2>
                </div>

                <div class="accordion mb-5" id="pdfEditorFaqAccordion">

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqOne">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Is XConvertifire's PDF Editor free?
                            </button>
                        </h3>
                        <div id="pdfFaqOne" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                The editor is presented as a free online tool. Upload limits and document compatibility
                                still apply, and you should review the result before relying on it.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqTwo">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I edit PDF text online?
                            </button>
                        </h3>
                        <div id="pdfFaqTwo" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                You can edit text that the editor can extract, add text boxes, apply available formatting,
                                and download an updated PDF. Not every PDF stores its text in a form that can be edited
                                accurately.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqThree">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                How do I add new text to a PDF?
                            </button>
                        </h3>
                        <div id="pdfFaqThree" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                Upload the PDF, choose <strong>Add Text</strong>, enter your content, position the new text
                                box with the existing controls, and review the page before downloading.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqFour">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I change the font or color of PDF text?
                            </button>
                        </h3>
                        <div id="pdfFaqFour" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                The toolbar includes font, size, color, bold, italic, and underline controls for supported
                                text. Available fonts may not match the source PDF's embedded fonts, so exact visual
                                matching is not guaranteed.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqFive">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I delete text from a PDF?
                            </button>
                        </h3>
                        <div id="pdfFaqFive" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                The Delete Text control can visually remove selected text in the edited output. It should
                                not be treated as secure removal of the underlying PDF content.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqSix">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Does deleting text permanently remove it from the PDF?
                            </button>
                        </h3>
                        <div id="pdfFaqSix" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                Not necessarily. The export may cover original content with a white mask, which can leave
                                underlying information in the PDF. Do not use this method as secure redaction.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqSeven">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I securely redact confidential information?
                            </button>
                        </h3>
                        <div id="pdfFaqSeven" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                No. Use a dedicated redaction tool that removes sensitive data from the underlying document
                                and lets you verify the result. Do not rely on this editor to redact confidential
                                information.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqEight">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I edit a scanned PDF?
                            </button>
                        </h3>
                        <div id="pdfFaqEight" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                This editor does not include OCR. Text that appears only inside a scanned page image is not
                                selectable for editing here. Use an OCR tool first if you need recognized text, then check
                                its accuracy.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqNine">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                What is the maximum PDF upload size?
                            </button>
                        </h3>
                        <div id="pdfFaqNine" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                The upload interface lists a maximum file size of 50 MB.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqTen">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I undo and redo edits?
                            </button>
                        </h3>
                        <div id="pdfFaqTen" class="accordion-collapse collapse" data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                Yes. The editor has Undo and Redo controls for supported editing actions. Review the page
                                after undoing or reapplying a change.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqEleven">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Does the editor support multi-page PDFs?
                            </button>
                        </h3>
                        <div id="pdfFaqEleven" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                The editor displays PDF page previews and thumbnails for navigating the document. How a
                                particular file loads can depend on its structure and compatibility.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqTwelve">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Will the original PDF formatting be preserved?
                            </button>
                        </h3>
                        <div id="pdfFaqTwelve" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                Exact preservation is not guaranteed. Different fonts, text widths, line wrapping, complex
                                layouts, or export limitations can change the appearance. Inspect the downloaded file page
                                by page.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqThirteen">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Can I edit Urdu or other non-Latin text?
                            </button>
                        </h3>
                        <div id="pdfFaqThirteen" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                Support is not guaranteed. The current export process may omit unsupported characters or
                                fail to handle complex text shaping. Test a copy and verify the downloaded result before
                                depending on it.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card mb-2 overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqFourteen">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                How do I download an edited PDF?
                            </button>
                        </h3>
                        <div id="pdfFaqFourteen" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                Review the pages in the editor, then select <strong>Download PDF</strong>. Open the
                                downloaded file in a PDF reader and check that the content and layout are as expected.
                            </div>
                        </div>
                    </div>

                    <div class="seo-card overflow-hidden">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#pdfFaqFifteen">
                                <i class="fas fa-question-circle text-primary me-2"></i>
                                Is PDF editing performed in the browser?
                            </button>
                        </h3>
                        <div id="pdfFaqFifteen" class="accordion-collapse collapse"
                            data-bs-parent="#pdfEditorFaqAccordion">
                            <div class="accordion-body small">
                                This page renders and edits the selected document through browser-loaded PDF.js and pdf-lib
                                libraries. Their project pages explain <a href="https://mozilla.github.io/pdf.js/"
                                    target="_blank" rel="noopener noreferrer">PDF.js rendering</a> and <a
                                    href="https://pdf-lib.js.org/" target="_blank" rel="noopener noreferrer">PDF document
                                    creation and modification</a>. This description is not a privacy or security guarantee;
                                consider the document's sensitivity before uploading it.
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ═══ FINAL CTA ═══ -->
                <div class="seo-card shadow-lg">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h2 class="text-white fw-bold mb-3">Edit Your PDF Online for Free</h2>
                        <p class="text-secondary mb-4 mx-auto" style="max-width: 620px;">Upload your PDF, update
                            selectable text, add new text and download your edited document with XConvertifire.</p>
                        <a href="#pdfUploadSection" class="btn btn-primary btn-lg fw-semibold px-4 py-2"
                            id="pdfEditorSeoCta">
                            <i class="fas fa-file-pdf me-2"></i>Edit Your PDF Now
                        </a>
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection
@section('scripts')
    {{-- PDF.JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    {{-- PDF-LIB --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
    <style>
        /* =========================================================
                           EDITOR MAIN
                        ========================================================== */
        #pdfEditorSection {
            background:
                radial-gradient(circle at 50% 0%,
                    rgba(13, 110, 253, .08),
                    transparent 38%),
                #050505;
            min-height: calc(100vh - 70px);
            padding-top: 4px;
        }

        /* =========================================================
                           TOOLBAR (RIGHT SIDE)
                        ========================================================== */
        .pdf-editor-toolbar {
            width: 330px;
            min-width: 330px;
            flex-shrink: 0;
            background: linear-gradient(180deg, #111, #0c0c0c);
            border-left: 1px solid #292929;
            padding: 14px 12px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .pdf-editor-toolbar .pdf-toolbar-top {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .pdf-editor-toolbar .pdf-toolbar-left,
        .pdf-editor-toolbar .pdf-toolbar-right {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            width: 100%;
            gap: 10px;
        }

        .pdf-editor-toolbar .pdf-toolbar-group {
            width: 100%;
        }

        .pdf-editor-toolbar .pdf-button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .pdf-editor-toolbar .pdf-control-box {
            width: 100%;
            min-width: 0;
        }

        .pdf-editor-toolbar .pdf-select {
            width: 100%;
        }

        .pdf-editor-toolbar .toolbar-divider {
            width: 100%;
            height: 1px;
            margin: 4px 0;
            background: linear-gradient(to right, transparent, #353535, transparent);
        }

        .pdf-editor-toolbar .pdf-toolbar-help {
            flex-direction: column;
            align-items: flex-start;
            gap: 6px;
        }

        .pdf-editor-toolbar .pdf-help-items {
            flex-wrap: wrap;
            gap: 8px;
        }

        /* =========================================================
                           TOOL BUTTONS
                        ========================================================== */
        .pdf-tool-btn,
        .pdf-format-btn,
        .pdf-color-btn {
            height: 38px;
            min-width: 38px;
            border: 1px solid #303030;
            background: #181818;
            color: #cfcfcf;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition:
                background .18s ease,
                border-color .18s ease,
                color .18s ease,
                transform .18s ease,
                box-shadow .18s ease;
            cursor: pointer;
            font-size: 13px;
        }

        .pdf-tool-btn span {
            font-size: 12px;
            font-weight: 600;
        }

        .pdf-tool-btn:hover,
        .pdf-format-btn:hover,
        .pdf-color-btn:hover {
            background: #202020;
            border-color: #0d6efd;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, .12);
        }

        .pdf-tool-btn:active,
        .pdf-format-btn:active,
        .pdf-color-btn:active {
            transform: translateY(0);
        }

        .pdf-tool-btn:disabled {
            opacity: .32;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .pdf-tool-btn.active,
        .pdf-format-btn.active {
            background: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 5px 18px rgba(13, 110, 253, .25);
        }

        .pdf-add-text-btn {
            padding: 0 13px;
            background: rgba(13, 110, 253, .12);
            color: #65a8ff;
            border-color: rgba(13, 110, 253, .38);
        }

        .pdf-add-text-btn:hover {
            background: #0d6efd;
            color: #fff;
        }

        .danger-tool {
            padding: 0 12px;
        }

        .danger-tool:hover {
            background: #dc3545 !important;
            border-color: #dc3545 !important;
            color: #fff !important;
            box-shadow: 0 5px 18px rgba(220, 53, 69, .2);
        }

        /* =========================================================
                           FONT / SIZE CONTROLS
                        ========================================================== */
        .pdf-control-box {
            height: 38px;
            min-width: 190px;
            background: #181818;
            border: 1px solid #303030;
            border-radius: 9px;
            display: flex;
            align-items: center;
            overflow: hidden;
            transition: .2s;
        }

        .pdf-control-box:hover {
            border-color: #454545;
        }

        .pdf-control-icon {
            width: 34px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            background: rgba(13, 110, 253, .06);
            border-right: 1px solid #2b2b2b;
            font-size: 11px;
            flex-shrink: 0;
        }

        .pdf-control-content {
            display: flex;
            align-items: center;
            height: 100%;
            flex: 1;
            min-width: 0;
        }

        .pdf-control-content>span {
            color: #666;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
            font-weight: 700;
            padding: 0 8px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .pdf-select {
            height: 36px;
            min-width: 60px;
            flex: 1;
            background: #181818;
            color: #eee;
            border: 0;
            padding: 0 20px 0 4px;
            outline: none;
            font-size: 12px;
            cursor: pointer;
        }

        .pdf-select:focus {
            box-shadow: none;
        }

        .pdf-select option {
            background: #171717;
            color: #fff;
        }

        .pdf-size-box {
            min-width: 105px;
        }

        .pdf-size-box .pdf-select {
            min-width: 48px;
        }

        /* =========================================================
                           COLOR
                        ========================================================== */
        .color-picker-wrapper {
            position: relative;
        }

        .pdf-color-btn {
            width: 42px;
            padding: 5px;
            flex-direction: column;
            gap: 2px;
            background: #181818;
        }

        .color-icon {
            font-size: 12px;
            line-height: 12px;
            color: #ddd;
        }

        .color-bar {
            width: 24px;
            height: 4px;
            border-radius: 10px;
            background: #111;
            display: block;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, .12);
        }

        #textColorPicker {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
            pointer-events: none;
        }

        /* =========================================================
                           ZOOM
                        ========================================================== */
        .pdf-zoom-control {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .pdf-zoom-label {
            color: #686868;
            font-size: 9px;
            line-height: 1;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pdf-zoom-label i {
            color: #0d6efd;
        }

        .pdf-zoom-buttons {
            display: flex;
            align-items: center;
            gap: 4px;
            height: 38px;
            background: #151515;
            border: 1px solid #303030;
            border-radius: 9px;
            padding: 0 4px;
        }

        .pdf-zoom-buttons .pdf-tool-btn {
            border: 0;
            background: transparent;
            box-shadow: none;
            height: 30px;
            min-width: 30px;
            border-radius: 6px;
        }

        .pdf-zoom-buttons .pdf-tool-btn:hover {
            background: #252525;
        }

        .zoom-value {
            color: #e4e4e4;
            font-size: 11px;
            min-width: 43px;
            text-align: center;
            font-weight: 700;
        }

        /* =========================================================
                           DOWNLOAD
                        ========================================================== */
        .pdf-download-btn {
            height: 42px;
            border: 0;
            border-radius: 10px;
            padding: 0 15px;
            background: linear-gradient(135deg,
                    #0d6efd,
                    #075bd8);
            color: #fff;
            font-weight: 700;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            cursor: pointer;
            box-shadow:
                0 7px 22px rgba(13, 110, 253, .25);
            transition: .2s;
            white-space: nowrap;
        }

        .pdf-download-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 10px 28px rgba(13, 110, 253, .35);
        }

        .pdf-download-btn:active {
            transform: translateY(0);
        }

        .pdf-download-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        .download-icon {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .14);
            flex-shrink: 0;
        }

        /* =========================================================
                           TOOLBAR HELP
                        ========================================================== */
        .pdf-toolbar-help {
            margin-top: 12px;
            padding: 8px 10px;
            border-top: 1px solid #252525;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            color: #666;
            font-size: 10px;
        }

        .pdf-toolbar-help>div:first-child {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pdf-toolbar-help>div:first-child i {
            color: #0d6efd;
        }

        .pdf-help-items {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .pdf-help-items span {
            white-space: nowrap;
        }

        kbd {
            background: #202020;
            border: 1px solid #373737;
            border-bottom-color: #444;
            border-radius: 4px;
            padding: 2px 5px;
            color: #aaa;
            font-size: 9px;
            font-family: inherit;
        }

        /* =========================================================
                           WORKSPACE
                        ========================================================== */
        .pdf-workspace {
            display: flex;
            background: #0a0a0a;
            border: 1px solid #242424;
            border-radius: 16px;
            overflow: hidden;
            height: calc(100vh - 100px);
            min-height: 600px;
            margin-top: 20px;
            box-shadow:
                0 18px 55px rgba(0, 0, 0, .35);
        }

        /* =========================================================
                           SIDEBAR (smaller)
                        ========================================================== */
        .pdf-sidebar {
            width: 130px;
            min-width: 130px;
            background:
                linear-gradient(180deg,
                    #111,
                    #0c0c0c);
            border-right: 1px solid #252525;
            display: flex;
            flex-direction: column;
        }

        .pdf-sidebar-header {
            padding: 12px 10px 10px;
            border-bottom: 1px solid #252525;
            background: #111;
        }

        .sidebar-title {
            color: #ddd;
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .sidebar-title strong {
            display: block;
            color: #ddd;
            font-size: 11px;
            line-height: 1.2;
        }

        .sidebar-title small {
            display: block;
            color: #555;
            font-size: 8px;
            font-weight: 500;
            margin-top: 2px;
        }

        .sidebar-title-icon {
            width: 26px;
            height: 26px;
            border-radius: 7px;
            background: rgba(13, 110, 253, .12);
            border: 1px solid rgba(13, 110, 253, .25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #4e9aff;
            font-size: 11px;
            flex-shrink: 0;
        }

        .pdf-thumbnails-list {
            flex: 1;
            padding: 10px 8px;
            overflow-y: auto;
        }

        .pdf-thumbnails-list::-webkit-scrollbar,
        .pdf-pages-container::-webkit-scrollbar,
        .pdf-editor-toolbar::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }

        .pdf-thumbnails-list::-webkit-scrollbar-track,
        .pdf-pages-container::-webkit-scrollbar-track,
        .pdf-editor-toolbar::-webkit-scrollbar-track {
            background: #0b0b0b;
        }

        .pdf-thumbnails-list::-webkit-scrollbar-thumb,
        .pdf-pages-container::-webkit-scrollbar-thumb,
        .pdf-editor-toolbar::-webkit-scrollbar-thumb {
            background: #303030;
            border-radius: 10px;
        }

        .pdf-thumbnails-list::-webkit-scrollbar-thumb:hover,
        .pdf-pages-container::-webkit-scrollbar-thumb:hover,
        .pdf-editor-toolbar::-webkit-scrollbar-thumb:hover {
            background: #0d6efd;
        }

        .pdf-thumbnail {
            position: relative;
            background: #171717;
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 4px;
            margin-bottom: 8px;
            cursor: pointer;
            transition:
                border-color .18s ease,
                background .18s ease,
                transform .18s ease,
                box-shadow .18s ease;
        }

        .pdf-thumbnail:hover {
            background: #1d1d1d;
            border-color: #315f9e;
            transform: translateY(-1px);
        }

        .pdf-thumbnail.active {
            background: #171d27;
            border-color: #0d6efd;
            box-shadow:
                0 0 0 2px rgba(13, 110, 253, .12),
                0 7px 20px rgba(0, 0, 0, .25);
        }

        .pdf-thumbnail canvas {
            display: block;
            width: 100%;
            height: auto;
            background: white;
            border-radius: 4px;
        }

        .pdf-thumb-number {
            color: #686868;
            font-size: 8px;
            font-weight: 600;
            text-align: center;
            margin-top: 4px;
        }

        .pdf-thumbnail.active .pdf-thumb-number {
            color: #62a5ff;
        }

        /* =========================================================
                           MAIN AREA
                        ========================================================== */
        .pdf-main-area {
            flex: 1;
            min-width: 0;
            background:
                radial-gradient(circle at 50% 0%,
                    #202020 0,
                    #171717 45%,
                    #141414 100%);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* =========================================================
                           INFO BAR
                        ========================================================== */
        .pdf-info-bar {
            min-height: 50px;
            border-bottom: 1px solid #292929;
            background: rgba(14, 14, 14, .88);
            color: #aaa;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            font-size: 11px;
            flex-shrink: 0;
        }

        .pdf-editor-status {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }

        .status-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(13, 110, 253, .1);
            border: 1px solid rgba(13, 110, 253, .2);
            color: #4e9aff;
            flex-shrink: 0;
        }

        .pdf-editor-status>div {
            min-width: 0;
        }

        .status-label {
            color: #555;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 700;
            display: block;
            line-height: 1;
            margin-bottom: 3px;
        }

        #editorStatus {
            color: #bbb;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pdf-editor-tip {
            color: #666;
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .pdf-editor-tip i {
            color: #e3a93f;
        }

        /* =========================================================
                           PDF PAGES
                        ========================================================== */
        .pdf-pages-container {
            flex: 1;
            padding: 34px;
            overflow: auto;
            min-height: 0;
            background:
                radial-gradient(circle at center,
                    rgba(255, 255, 255, .025),
                    transparent 45%);
            scrollbar-width: thin;
            scrollbar-color: #3a3a3a #0b0b0b;
        }

        .pdf-pages-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .pdf-pages-container::-webkit-scrollbar-track {
            background: #0b0b0b;
            border-radius: 4px;
        }

        .pdf-pages-container::-webkit-scrollbar-thumb {
            background: #303030;
            border-radius: 10px;
            border: 1px solid #1f1f1f;
        }

        .pdf-pages-container::-webkit-scrollbar-thumb:hover {
            background: #0d6efd;
        }

        .pdf-page-wrapper {
            position: relative;
            background: #fff;
            margin: 0 auto 38px;
            box-shadow:
                0 16px 45px rgba(0, 0, 0, .5),
                0 3px 8px rgba(0, 0, 0, .2);
            transform-origin: top center;
            transition: box-shadow .2s ease;
        }

        .pdf-page-wrapper:hover {
            box-shadow:
                0 20px 55px rgba(0, 0, 0, .55),
                0 0 0 1px rgba(255, 255, 255, .08);
        }

        .pdf-page-canvas {
            display: block;
            position: absolute;
            inset: 0;
        }

        .pdf-text-layer {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        /* =========================================================
                           EDITABLE TEXT
                        ========================================================== */
        .pdf-editable-text {
            position: absolute;
            display: block;
            margin: 0;
            padding: 0;
            border: 0;
            outline: none;
            background: transparent;
            white-space: pre-wrap;
            word-break: normal;
            overflow: visible;
            pointer-events: auto;
            cursor: text;
            line-height: 1.15;
            min-width: 3px;
            z-index: 10;
            transition:
                background .12s ease,
                outline-color .12s ease;
        }

        .pdf-editable-text:hover {
            background: rgba(13, 110, 253, .045);
        }

        .pdf-editable-text:focus {
            background: rgba(13, 110, 253, .065);
            outline: 1px solid rgba(13, 110, 253, .4);
            outline-offset: 2px;
        }

        .pdf-text-mask {
            position: absolute;
            background: white;
            z-index: 5;
            pointer-events: none;
        }

        /* =========================================================
                           ADDED TEXT
                        ========================================================== */
        .pdf-added-text {
            border: 1px dashed rgba(13, 110, 253, .75);
            background: rgba(255, 255, 255, .92);
            cursor: move;
            resize: both;
            overflow: auto;
            min-width: 80px;
            min-height: 28px;
            z-index: 30;
            padding: 5px 7px !important;
            box-shadow:
                0 5px 18px rgba(13, 110, 253, .08);
        }

        .pdf-added-text:hover {
            border-color: #0d6efd;
            background: rgba(255, 255, 255, .96);
        }

        .pdf-added-text:focus {
            border: 1px solid #0d6efd;
            box-shadow:
                0 0 0 3px rgba(13, 110, 253, .12);
            cursor: text;
        }

        .pdf-added-handle {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #0d6efd;
            right: -4px;
            bottom: -4px;
            pointer-events: none;
        }

        .pdf-selection-highlight {
            outline: 2px solid rgba(13, 110, 253, .7) !important;
            outline-offset: 2px;
        }

        /* =========================================================
                           LOADER
                        ========================================================== */
        .pdf-loading-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(0, 0, 0, .86);
            backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
        }

        .pdf-loading-overlay:not(.d-none) {
            display: flex;
        }

        .pdf-loader-box {
            background:
                linear-gradient(145deg,
                    #181818,
                    #101010);
            border: 1px solid #303030;
            border-radius: 17px;
            padding: 30px 40px;
            min-width: 290px;
            text-align: center;
            box-shadow:
                0 25px 80px rgba(0, 0, 0, .55);
        }

        .pdf-loader-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(13, 110, 253, .1);
            border: 1px solid rgba(13, 110, 253, .25);
            color: #0d6efd;
            font-size: 20px;
        }

        .pdf-loader-box .spinner-border {
            width: 22px;
            height: 22px;
            border-width: 2px;
        }

        .pdf-loader-subtitle {
            color: #555;
            font-size: 10px;
            margin-top: 7px;
        }

        /* =========================================================
                           RESPONSIVE
                        ========================================================== */

        /* Large tablets / small laptops */
        @media(max-width: 1200px) {
            .pdf-editor-toolbar {
                width: 200px;
                min-width: 200px;
            }

            .pdf-sidebar {
                width: 120px;
                min-width: 120px;
            }
        }

        /* Tablets */
        @media(max-width: 992px) {
            .pdf-sidebar {
                width: 110px;
                min-width: 110px;
            }

            .pdf-editor-toolbar {
                width: 190px;
                min-width: 190px;
            }

            .pdf-pages-container {
                padding: 20px 14px;
            }

            .pdf-workspace {
                height: auto;
                min-height: calc(100vh - 120px);
            }

            .pdf-main-area {
                max-height: calc(100vh - 140px);
            }
        }

        /* Small tablets / large phones: stack into column */
        @media(max-width: 768px) {
            .pdf-workspace {
                flex-direction: column;
                height: auto;
                min-height: 0;
                margin-top: 12px;
                border-radius: 12px;
            }

            .pdf-sidebar {
                display: none;
            }

            .pdf-main-area {
                max-height: 60vh;
            }

            .pdf-editor-toolbar {
                width: 100%;
                min-width: 100%;
                border-left: 0;
                border-top: 1px solid #252525;
                flex-direction: row;
                flex-wrap: wrap;
                align-items: flex-start;
                padding: 10px;
                gap: 8px;
                max-height: none;
                overflow-y: visible;
            }

            .pdf-editor-toolbar .pdf-toolbar-top {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 8px;
            }

            .pdf-editor-toolbar .pdf-toolbar-left,
            .pdf-editor-toolbar .pdf-toolbar-right {
                flex-direction: row;
                flex-wrap: wrap;
                width: auto;
                gap: 6px;
            }

            .pdf-toolbar-group {
                width: auto;
                flex: 0 0 auto;
            }

            .pdf-editor-toolbar .pdf-control-box {
                width: auto;
                min-width: 130px;
            }

            .pdf-editor-toolbar .pdf-select {
                width: auto;
                min-width: 80px;
            }

            .pdf-editor-toolbar .toolbar-divider {
                display: none;
            }

            .pdf-editor-toolbar .pdf-toolbar-help {
                display: none;
            }

            .pdf-download-btn {
                width: auto;
                flex: 1;
                min-width: 130px;
            }

            .pdf-info-bar {
                padding: 8px 10px;
            }

            .pdf-editor-tip {
                display: none;
            }

            .pdf-pages-container {
                padding: 16px 10px;
            }

            .pdf-group-label {
                display: none;
            }

            .pdf-tool-btn span {
                display: none;
            }

            .pdf-add-text-btn span,
            .danger-tool span {
                display: inline;
            }
        }

        /* Phones */
        @media(max-width: 520px) {
            .pdf-workspace {
                margin-top: 8px;
                border-radius: 10px;
            }

            .pdf-editor-toolbar {
                padding: 8px;
                gap: 6px;
            }

            .pdf-editor-toolbar .pdf-control-box {
                min-width: 110px;
            }

            .pdf-editor-toolbar .pdf-select {
                min-width: 60px;
            }

            .pdf-download-btn {
                width: 100%;
                flex: 1 1 100%;
            }

            .pdf-tool-btn,
            .pdf-format-btn {
                height: 34px;
                min-width: 34px;
            }

            .pdf-zoom-buttons {
                padding: 0 2px;
            }

            .zoom-value {
                min-width: 36px;
                font-size: 10px;
            }

            .pdf-info-bar {
                font-size: 10px;
            }

            #editorStatus {
                font-size: 10px;
            }
        }

        .pdf-editor-seo-section {
            background: #050505;
            color: #e5e7eb;
            padding: 64px 0;
        }

        .pdf-editor-seo-wrap {
            max-width: 1100px;
            margin: 0 auto;
        }

        .pdf-editor-seo-wrap>h2 {
            color: #fff;
            font-size: clamp(1.45rem, 2.5vw, 2rem);
            line-height: 1.3;
            margin: 0 0 14px;
        }

        .pdf-editor-seo-wrap>h2:not(:first-child) {
            margin-top: 42px;
        }

        .pdf-editor-seo-wrap p,
        .pdf-editor-seo-wrap li {
            color: #c2c7d0;
            font-size: 1rem;
            line-height: 1.75;
        }

        .pdf-editor-seo-wrap a:not(.pdf-editor-seo-cta) {
            color: #78b7ff;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .pdf-editor-seo-steps {
            margin-top: 8px;
        }

        .pdf-editor-seo-step,
        .pdf-editor-seo-faq article {
            height: 100%;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 12px;
            background: #0c0d10;
            padding: 20px;
        }

        .pdf-editor-seo-step h3,
        .pdf-editor-seo-faq h3 {
            color: #fff;
            font-size: 1.08rem;
            line-height: 1.45;
            margin: 0 0 10px;
        }

        .pdf-editor-seo-step p,
        .pdf-editor-seo-faq p {
            margin: 0;
        }

        .pdf-editor-seo-wrap ul {
            padding-left: 1.25rem;
        }

        .pdf-editor-seo-wrap li+li {
            margin-top: 8px;
        }

        .pdf-editor-seo-faq {
            display: grid;
            gap: 12px;
        }

        .pdf-editor-seo-final {
            margin-top: 46px;
            padding: 30px 24px;
            border: 1px solid rgba(13, 110, 253, .4);
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(13, 110, 253, .13), rgba(12, 13, 16, .96));
            text-align: center;
        }

        .pdf-editor-seo-final h2 {
            color: #fff;
            font-size: clamp(1.4rem, 2.5vw, 1.9rem);
            margin: 0 0 10px;
        }

        .pdf-editor-seo-final p {
            max-width: 680px;
            margin: 0 auto 20px;
        }

        .pdf-editor-seo-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 24px;
            border-radius: 8px;
            background: #0d6efd;
            color: #fff;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
        }

        .pdf-editor-seo-cta:hover,
        .pdf-editor-seo-cta:focus-visible {
            background: #0b5ed7;
            color: #fff;
        }

        @media (max-width: 575.98px) {
            .pdf-editor-seo-section {
                padding: 44px 0;
            }

            .pdf-editor-seo-wrap>h2:not(:first-child) {
                margin-top: 34px;
            }

            .pdf-editor-seo-final {
                padding: 24px 16px;
            }

            .pdf-editor-seo-cta {
                width: 100%;
            }
        }
    </style>
    <style>
        /* ---------- PDF editor refinements ---------- */
        .pdf-pages-container {
            position: relative;
        }

        .pdf-page-wrapper {
            background: #fff;
            flex-shrink: 0;
        }

        .pdf-page-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #9aa0a6;
        }

        .pdf-text-layer {
            overflow: visible;
        }

        /* The white mask only appears while text is focused or modified */
        .pdf-text-mask {
            display: none;
        }

        .pdf-editable-text {
            white-space: pre;
            line-height: 1;
            width: max-content;
            max-width: none;
            caret-color: #0d6efd;
            border-radius: 2px;
            transition: none;
            -webkit-text-size-adjust: none;
        }

        .pdf-editable-text:hover {
            background: rgba(13, 110, 253, .10);
            outline: 1px solid rgba(13, 110, 253, .35);
            outline-offset: 1px;
        }

        .pdf-editable-text:focus {
            background: transparent;
            outline: 2px solid rgba(13, 110, 253, .65);
            outline-offset: 2px;
        }

        .pdf-selection-highlight {
            outline: 2px solid rgba(13, 110, 253, .7) !important;
            outline-offset: 2px;
        }

        /* Added text boxes */
        .pdf-added-box {
            position: absolute;
            z-index: 30;
            pointer-events: auto;
        }

        .pdf-added-box .pdf-added-text {
            position: relative;
            left: auto;
            top: auto;
            border: 0;
            padding: 0 !important;
            resize: none;
            overflow: visible;
            cursor: text;
            min-width: 40px;
            min-height: 1em;
            background: transparent;
            box-shadow: none;
            line-height: 1.2;
        }

        .pdf-added-box:hover .pdf-added-text,
        .pdf-added-box.selected .pdf-added-text {
            outline: 1px dashed rgba(13, 110, 253, .85);
            outline-offset: 3px;
            background: transparent;
        }

        .pdf-drag-handle {
            position: absolute;
            left: -2px;
            top: -22px;
            height: 22px;
            min-width: 28px;
            padding: 0 8px;
            border-radius: 6px 6px 6px 0;
            background: #0d6efd;
            color: #fff;
            font-size: 11px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: grab;
            touch-action: none;
            user-select: none;
            z-index: 2;
        }

        .pdf-drag-handle:active {
            cursor: grabbing;
        }

        .pdf-added-box:hover .pdf-drag-handle,
        .pdf-added-box.selected .pdf-drag-handle,
        .pdf-added-box:focus-within .pdf-drag-handle {
            display: flex;
        }
    </style>

    <script>
        $(function() {
            'use strict';

            pdfjsLib.GlobalWorkerOptions.workerSrc =
                'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

            const {
                PDFDocument,
                StandardFonts,
                rgb,
                degrees
            } = PDFLib;

            /* =====================================================
               CONSTANTS
            ====================================================== */
            const ZOOM_STEPS = [0.5, 0.75, 1, 1.25, 1.5, 2, 2.5, 3];
            const MAX_CANVAS_PIXELS = 16000000;
            const DEFAULT_COLOR = '#111111';

            const FONT_STACKS = {
                'Helvetica': '"Helvetica Neue", Helvetica, Arial, sans-serif',
                'Times-Roman': '"Times New Roman", Times, serif',
                'Courier': '"Courier New", Courier, monospace'
            };

            // ascent and descent ratios, used to place the baseline exactly on screen
            const FONT_METRICS = {
                'Helvetica': {
                    a: 0.905,
                    d: 0.212
                },
                'Times-Roman': {
                    a: 0.891,
                    d: 0.216
                },
                'Courier': {
                    a: 0.833,
                    d: 0.300
                }
            };

            // order: regular, bold, italic, bold italic
            const STD_FONTS = {
                'Helvetica': ['Helvetica', 'HelveticaBold', 'HelveticaOblique', 'HelveticaBoldOblique'],
                'Times-Roman': ['TimesRoman', 'TimesRomanBold', 'TimesRomanItalic', 'TimesRomanBoldItalic'],
                'Courier': ['Courier', 'CourierBold', 'CourierOblique', 'CourierBoldOblique']
            };

            const NORMALIZE_MAP = {
                '\u00a0': ' ',
                '\u2009': ' ',
                '\u202f': ' ',
                '\u2002': ' ',
                '\u2003': ' ',
                '\u2212': '-',
                '\u2010': '-',
                '\u2011': '-',
                '\ufb00': 'ff',
                '\ufb01': 'fi',
                '\ufb02': 'fl',
                '\ufb03': 'ffi',
                '\ufb04': 'ffl'
            };

            const PLAINTEXT_ONLY = (function() {
                try {
                    const el = document.createElement('div');
                    el.contentEditable = 'plaintext-only';
                    return el.contentEditable === 'plaintext-only';
                } catch (e) {
                    return false;
                }
            })();

            /* =====================================================
               STATE
            ====================================================== */
            let pdfDocument = null;
            let originalPdfBytes = null;
            let originalFileName = 'document.pdf';

            let pages = [];
            let pdfPages = [];
            let pageState = {};
            let dom = {};
            const colorCache = {};
            const sampledPages = new Set();

            let selectedTextId = null;
            let focusedId = null;

            let zoom = 1;
            let renderEpoch = 0;
            let observer = null;
            let zoomTimer = null;
            let thumbEpoch = 0;
            let scrollTick = false;
            let exporting = false;

            let history = [];
            let historyIndex = -1;
            let historyTimer = null;

            let supportedSet = null;

            /* =====================================================
               SMALL HELPERS
            ====================================================== */
            function showLoading(text) {
                $('#pdfLoadingText').text(text || 'Preparing PDF...');
                $('#pdfLoadingOverlay').removeClass('d-none');
            }

            function hideLoading() {
                $('#pdfLoadingOverlay').addClass('d-none');
            }

            function setStatus(text) {
                $('#editorStatus').text(text);
            }

            function uid(prefix) {
                return (prefix || 'id') + '_' + Date.now().toString(36) + '_' +
                    Math.random().toString(36).substring(2, 8);
            }

            function clamp(v, min, max) {
                return Math.min(max, Math.max(min, v));
            }

            function round2(v) {
                return Math.round(v * 100) / 100;
            }

            function hexToRgb(hex) {
                hex = String(hex || DEFAULT_COLOR).replace('#', '');
                if (hex.length === 3) {
                    hex = hex.split('').map(function(x) {
                        return x + x;
                    }).join('');
                }
                return {
                    r: parseInt(hex.substring(0, 2), 16) / 255,
                    g: parseInt(hex.substring(2, 4), 16) / 255,
                    b: parseInt(hex.substring(4, 6), 16) / 255
                };
            }

            function toHex(r, g, b) {
                return '#' + [r, g, b].map(function(x) {
                    return clamp(Math.round(x), 0, 255).toString(16).padStart(2, '0');
                }).join('');
            }

            function normalizeText(str) {
                return String(str || '').replace(/[\u00a0\u2009\u202f\u2002\u2003\u2212\u2010\u2011\ufb00-\ufb04]/g,
                    function(ch) {
                        return NORMALIZE_MAP[ch] || ch;
                    });
            }

            function getPlainText(el) {
                return (el.innerText || el.textContent || '')
                    .replace(/\u00a0/g, ' ')
                    .replace(/\r/g, '')
                    .replace(/\n$/, '');
            }

            function pageWrapper(pageId) {
                return $('.pdf-page-wrapper[data-page-id="' + pageId + '"]');
            }

            function baselineOffset(family, lineHeight) {
                const m = FONT_METRICS[family] || FONT_METRICS.Helvetica;
                return (lineHeight - (m.a + m.d)) / 2 + m.a;
            }

            function getPixelRatio(w, h) {
                let r = Math.min(window.devicePixelRatio || 1, 2);
                if (w * h * r * r > MAX_CANVAS_PIXELS) {
                    r = Math.sqrt(MAX_CANVAS_PIXELS / (w * h));
                }
                return Math.max(r, 0.5);
            }

            /* =====================================================
               SUPPORTED CHARACTERS (standard PDF fonts)
            ====================================================== */
            async function ensureSupportedSet() {
                if (supportedSet) {
                    return;
                }
                try {
                    const tmp = await PDFDocument.create();
                    const font = await tmp.embedFont(StandardFonts.Helvetica);
                    supportedSet = new Set(font.getCharacterSet());
                } catch (e) {
                    supportedSet = new Set();
                    for (let i = 32; i <= 126; i++) {
                        supportedSet.add(i);
                    }
                    for (let i = 160; i <= 255; i++) {
                        supportedSet.add(i);
                    }
                    [0x20AC, 0x2018, 0x2019, 0x201C, 0x201D, 0x2013, 0x2014, 0x2022, 0x2026, 0x2122,
                        0x2020, 0x2021, 0x2030, 0x0152, 0x0153, 0x0160, 0x0161, 0x0178, 0x017D,
                        0x017E, 0x2039, 0x203A, 0x201A, 0x201E, 0x0192, 0x02C6, 0x02DC
                    ].forEach(function(c) {
                        supportedSet.add(c);
                    });
                }
            }

            function isSupportedString(str) {
                const clean = normalizeText(str);
                for (const ch of clean) {
                    const cp = ch.codePointAt(0);
                    if (cp < 32 || ch === '\n' || ch === '\t') {
                        continue;
                    }
                    if (!supportedSet.has(cp)) {
                        return false;
                    }
                }
                return true;
            }

            function sanitizeForExport(str, dropped) {
                let out = '';
                for (const ch of normalizeText(str)) {
                    const cp = ch.codePointAt(0);
                    if (ch === '\n') {
                        out += ch;
                        continue;
                    }
                    if (ch === '\t') {
                        out += '    ';
                        continue;
                    }
                    if (cp < 32 || cp === 127) {
                        continue;
                    }
                    if (/[\u200B-\u200D\uFEFF]/.test(ch)) {
                        continue;
                    }
                    if (supportedSet.has(cp)) {
                        out += ch;
                    } else {
                        dropped.add(ch);
                    }
                }
                return out;
            }

            /* =====================================================
               TEXT MODEL
            ====================================================== */
            function isModified(t) {
                if (t.added || t.deleted) {
                    return true;
                }
                const o = t.orig;
                return t.text !== o.text ||
                    t.fontFamily !== o.fontFamily ||
                    t.fontSize !== o.fontSize ||
                    t.bold !== o.bold ||
                    t.italic !== o.italic ||
                    t.underline !== o.underline ||
                    t.color !== o.color ||
                    Math.abs(t.x - o.x) > 0.01 ||
                    Math.abs(t.baseline - o.baseline) > 0.01;
            }

            function resetToOrig(t) {
                const o = t.orig;
                t.text = o.text;
                t.fontFamily = o.fontFamily;
                t.fontSize = o.fontSize;
                t.bold = o.bold;
                t.italic = o.italic;
                t.underline = o.underline;
                t.color = o.color;
                t.x = o.x;
                t.baseline = o.baseline;
                t.deleted = false;
            }

            function pickState(t) {
                return {
                    id: t.id,
                    pageId: t.pageId,
                    added: t.added,
                    deleted: t.deleted,
                    text: t.text,
                    fontFamily: t.fontFamily,
                    fontSize: t.fontSize,
                    bold: t.bold,
                    italic: t.italic,
                    underline: t.underline,
                    color: t.color,
                    x: t.x,
                    baseline: t.baseline,
                    width: t.width
                };
            }

            function textColor(t) {
                const c = colorCache[t.id];
                return t.color || (c && c.color) || DEFAULT_COLOR;
            }

            function bgColor(t) {
                const c = colorCache[t.id];
                return (c && c.bg) || '#ffffff';
            }

            // area of the original text that must be covered when text is changed
            // area of the original text that must be covered when text is changed
            function maskRect(t) {
                const o = t.added ? t : t.orig;
                let width = o.width + 2;

                // never let the mask reach into the next block on the same line
                if (!t.added) {
                    const pd = pages.find(function(p) {
                        return p.id === t.pageId;
                    });
                    if (pd) {
                        pd.texts.forEach(function(n) {
                            if (n.id === t.id || n.added || !n.orig) {
                                return;
                            }
                            const no = n.orig;
                            if (Math.abs(no.baseline - o.baseline) < o.fontSize * 0.6 && no.x > o.x + 1) {
                                width = Math.min(width, no.x - o.x - 0.5);
                            }
                        });
                    }
                }

                return {
                    left: o.x - 0.5,
                    top: o.baseline - o.fontSize * 0.85,
                    width: Math.max(width, 1),
                    height: o.fontSize * 1.1
                };
            }

            function findText(id) {
                for (const p of pages) {
                    const found = p.texts.find(function(t) {
                        return t.id === id;
                    });
                    if (found) {
                        return found;
                    }
                }
                return null;
            }

            function getSelectedText() {
                return selectedTextId ? findText(selectedTextId) : null;
            }

            function lineCount(s) {
                return (String(s || '').match(/\n/g) || []).length + 1;
            }

            function shiftBelow(t, deltaLines) {
                if (!deltaLines || t.added) {
                    return;
                }
                const pd = pages.find(function(p) {
                    return p.id === t.pageId;
                });
                if (!pd) {
                    return;
                }
                const amount = deltaLines * t.fontSize * 1.2;
                const left = t.x - 2;
                const right = t.x + Math.max(t.width, t.orig ? t.orig.width : 0) + 2;
                pd.texts.forEach(function(b) {
                    if (b.id === t.id || b.added || b.locked || b.deleted) {
                        return;
                    }
                    if (b.baseline <= t.baseline + 1) {
                        return;
                    }
                    const bRight = b.x + Math.max(b.width, b.orig ? b.orig.width : 0);
                    if (bRight < left || b.x > right) {
                        return;
                    }
                    b.baseline = round2(b.baseline + amount);
                    applyVisual(b);
                });
            }

            /* =====================================================
               HISTORY
            ====================================================== */
            function createSnapshot() {
                const out = [];
                pages.forEach(function(p) {
                    p.texts.forEach(function(t) {
                        if (t.added || t.deleted || isModified(t)) {
                            out.push(pickState(t));
                        }
                    });
                });
                return JSON.stringify(out);
            }

            function restoreSnapshot(snapshot) {
                const list = JSON.parse(snapshot);
                const byId = {};
                list.forEach(function(e) {
                    byId[e.id] = e;
                });

                pages.forEach(function(p) {
                    p.texts = p.texts.filter(function(t) {
                        return !t.added;
                    });
                    p.texts.forEach(function(t) {
                        resetToOrig(t);
                        if (byId[t.id]) {
                            Object.assign(t, byId[t.id]);
                        }
                    });
                    list.forEach(function(e) {
                        if (e.added && e.pageId === p.id) {
                            p.texts.push(Object.assign({
                                orig: null,
                                locked: false
                            }, e));
                        }
                    });
                });

                if (selectedTextId && !findText(selectedTextId)) {
                    selectedTextId = null;
                }
                focusedId = null;
                if (document.activeElement && document.activeElement.blur &&
                    $(document.activeElement).hasClass('pdf-editable-text')) {
                    document.activeElement.blur();
                }
                pages.forEach(function(p) {
                    const st = pageState[p.id];
                    if (st && st.rendered) {
                        buildTextLayer(p);
                    }
                });
            }

            function commitSnapshot() {
                const snap = createSnapshot();
                if (history[historyIndex] === snap) {
                    updateHistoryButtons();
                    return;
                }
                history = history.slice(0, historyIndex + 1);
                history.push(snap);
                historyIndex = history.length - 1;
                if (history.length > 100) {
                    history.shift();
                    historyIndex--;
                }
                updateHistoryButtons();
            }

            function saveHistory() {
                clearTimeout(historyTimer);
                $('#undoBtn').prop('disabled', false);
                historyTimer = setTimeout(function() {
                    historyTimer = null;
                    commitSnapshot();
                }, 350);
            }

            function saveHistoryImmediately() {
                clearTimeout(historyTimer);
                historyTimer = null;
                commitSnapshot();
            }

            function flushHistory() {
                if (historyTimer) {
                    clearTimeout(historyTimer);
                    historyTimer = null;
                    commitSnapshot();
                }
            }

            function updateHistoryButtons() {
                $('#undoBtn').prop('disabled', historyIndex <= 0);
                $('#redoBtn').prop('disabled', historyIndex >= history.length - 1);
            }

            function undo() {
                flushHistory();
                if (historyIndex <= 0) {
                    return;
                }
                historyIndex--;
                restoreSnapshot(history[historyIndex]);
                updateHistoryButtons();
            }

            function redo() {
                flushHistory();
                if (historyIndex >= history.length - 1) {
                    return;
                }
                historyIndex++;
                restoreSnapshot(history[historyIndex]);
                updateHistoryButtons();
            }

            $('#undoBtn').on('click', undo);
            $('#redoBtn').on('click', redo);

            /* =====================================================
               FILE UPLOAD
            ====================================================== */
            $('#pdfFileInput').on('change', function() {
                const file = this.files[0];
                this.value = '';
                if (file) {
                    loadPdf(file);
                }
            });

            $('#uploadArea').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('border-primary');
            });

            $('#uploadArea').on('dragleave', function() {
                $(this).removeClass('border-primary');
            });

            $('#uploadArea').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('border-primary');
                const file = e.originalEvent.dataTransfer.files[0];
                if (file) {
                    loadPdf(file);
                }
            });

            // a missed drop should not navigate away from the page
            $(window).on('dragover drop', function(e) {
                e.preventDefault();
            });

            function detectFont(page, item, styles) {
                let name = '';
                let bold = false;
                let italic = false;
                try {
                    if (page.commonObjs.has(item.fontName)) {
                        const f = page.commonObjs.get(item.fontName);
                        name = String(f.name || '');
                        bold = !!f.bold;
                        italic = !!f.italic;
                    }
                } catch (e) {
                    /* font info is optional */ }

                const n = name.replace(/^[A-Z]{6}\+/, '').toLowerCase();
                if (/bold|black|heavy|semibold|demi/.test(n)) {
                    bold = true;
                }
                if (/italic|oblique/.test(n)) {
                    italic = true;
                }

                const generic = ((styles[item.fontName] || {}).fontFamily || '').toLowerCase();
                let family = 'Helvetica';
                if (/courier|mono|consol|typewriter/.test(n) || generic === 'monospace') {
                    family = 'Courier';
                } else if (/times|serif|georgia|garamond|palatino|cambria|minion/.test(n) && !/sans/.test(n)) {
                    family = 'Times-Roman';
                } else if (generic === 'serif' && !/arial|helvet|sans|calibri|verdana|tahoma/.test(n)) {
                    family = 'Times-Roman';
                }
                return {
                    family: family,
                    bold: bold,
                    italic: italic
                };
            }

            async function extractTexts(page, pd, viewport) {
                try {
                    await page.getOperatorList();
                } catch (e) {
                    /* loads fonts, optional */ }
                const content = await page.getTextContent({
                    disableCombineTextItems: true
                });
                const styles = content.styles || {};
                const runs = [];
                let cur = null;

                function flush() {
                    if (cur) {
                        runs.push(cur);
                        cur = null;
                    }
                }

                content.items.forEach(function(item) {
                    if (typeof item.str !== 'string' || !item.str.length) {
                        return;
                    }

                    const m = pdfjsLib.Util.transform(viewport.transform, item.transform);
                    const fs = Math.hypot(m[2], m[3]);
                    if (!isFinite(fs) || fs < 1) {
                        return;
                    }
                    // only upright, left to right text is editable
                    if (!(m[0] > 0 && m[3] < 0 && Math.abs(m[1]) < fs * 0.02)) {
                        return;
                    }

                    const f = detectFont(page, item, styles);
                    const str = normalizeText(item.str);
                    const x = m[4];
                    const base = m[5];
                    const w = Math.max(Number(item.width) || 0, 0);

                    if (cur &&
                        cur.family === f.family && cur.bold === f.bold && cur.italic === f.italic &&
                        Math.abs(cur.fontSize - fs) < Math.max(0.4, fs * 0.04) &&
                        Math.abs(cur.baseline - base) < fs * 0.2) {
                        const gap = x - (cur.x + cur.width);
                        // a normal word space is about 0.25-0.33 of the font size, anything much bigger is a new column
                        const isSpaceItem = !str.trim() || !cur.text.trim();
                        if (gap > -fs * 0.15 && (gap < fs * 0.45 || (isSpaceItem && gap < fs * 0.8))) {
                            let sep = '';
                            if (gap > fs * 0.12 && !/\s$/.test(cur.text) && !/^\s/.test(str)) {
                                sep = ' ';
                            }
                            cur.text += sep + str;
                            cur.width = Math.max(cur.width, x + w - cur.x);
                            return;
                        }
                    }

                    flush();
                    cur = {
                        text: str,
                        x: x,
                        baseline: base,
                        width: w,
                        fontSize: fs,
                        family: f.family,
                        bold: f.bold,
                        italic: f.italic
                    };
                });
                flush();

                let lockedCount = 0;
                runs.forEach(function(r) {
                    if (!r.text.trim()) {
                        return;
                    }
                    // skip duplicated overprint text (fake bold)
                    const dup = pd.texts.some(function(t) {
                        return t.text === r.text && Math.abs(t.x - r.x) < 1 && Math.abs(t
                            .baseline - r.baseline) < 1;
                    });
                    if (dup) {
                        return;
                    }

                    const locked = !isSupportedString(r.text);
                    if (locked) {
                        lockedCount++;
                    }
                    const base = {
                        text: r.text,
                        fontFamily: r.family,
                        fontSize: round2(r.fontSize),
                        bold: r.bold,
                        italic: r.italic,
                        underline: false,
                        color: null,
                        x: round2(r.x),
                        baseline: round2(r.baseline),
                        width: round2(Math.max(r.width, 3))
                    };
                    pd.texts.push({
                        id: uid('t'),
                        pageId: pd.id,
                        text: base.text,
                        x: base.x,
                        baseline: base.baseline,
                        width: base.width,
                        fontSize: base.fontSize,
                        fontFamily: base.fontFamily,
                        bold: base.bold,
                        italic: base.italic,
                        underline: false,
                        color: null,
                        deleted: false,
                        added: false,
                        locked: locked,
                        orig: base
                    });
                });
                return lockedCount;
            }

            async function loadPdf(file) {
                if (!file) {
                    return;
                }
                if (!(file.type === 'application/pdf' || /\.pdf$/i.test(file.name))) {
                    alert('Please select a PDF file.');
                    return;
                }
                if (file.size > 50 * 1024 * 1024) {
                    alert('Maximum PDF size is 50MB.');
                    return;
                }

                showLoading('Reading PDF...');
                try {
                    await ensureSupportedSet();
                    originalFileName = file.name;
                    originalPdfBytes = new Uint8Array(await file.arrayBuffer());

                    $('#pdfLoadingText').text('Checking PDF...');
                    let probe;
                    try {
                        probe = await PDFDocument.load(originalPdfBytes.slice(0), {
                            ignoreEncryption: true,
                            updateMetadata: false
                        });
                    } catch (e) {
                        throw new Error('This PDF has a structure the editor cannot save safely.');
                    }
                    if (probe.isEncrypted) {
                        throw new Error('This PDF is encrypted, so it cannot be edited and saved here.');
                    }
                    probe = null;

                    try {
                        pdfDocument = await pdfjsLib.getDocument({
                            data: originalPdfBytes.slice(0)
                        }).promise;
                    } catch (e) {
                        if (e && e.name === 'PasswordException') {
                            throw new Error('This PDF is password protected.');
                        }
                        throw e;
                    }

                    // reset state
                    if (observer) {
                        observer.disconnect();
                    }
                    pages = [];
                    pdfPages = [];
                    pageState = {};
                    dom = {};
                    Object.keys(colorCache).forEach(function(k) {
                        delete colorCache[k];
                    });
                    sampledPages.clear();
                    selectedTextId = null;
                    focusedId = null;
                    renderEpoch++;

                    let totalTexts = 0;
                    let lockedTotal = 0;

                    for (let n = 1; n <= pdfDocument.numPages; n++) {
                        $('#pdfLoadingText').text('Reading page ' + n + ' of ' + pdfDocument.numPages + '...');
                        const page = await pdfDocument.getPage(n);
                        const viewport = page.getViewport({
                            scale: 1
                        });
                        const pd = {
                            id: uid('page'),
                            pageNumber: n,
                            width: viewport.width,
                            height: viewport.height,
                            rotation: (((page.rotate || 0) % 360) + 360) % 360,
                            view: page.view,
                            texts: []
                        };
                        lockedTotal += await extractTexts(page, pd, viewport);
                        totalTexts += pd.texts.length;
                        pdfPages.push(page);
                        pages.push(pd);
                    }

                    $('#pdfUploadSection').addClass('d-none');
                    $('#pdfEditorSection').removeClass('d-none');

                    // fit the first page to the available width
                    const container = $('#pdfPagesContainer')[0];
                    const cs = window.getComputedStyle(container);
                    const pad = (parseFloat(cs.paddingLeft) || 0) + (parseFloat(cs.paddingRight) || 0);
                    const maxW = Math.max.apply(null, pages.map(function(p) {
                        return p.width;
                    }));
                    zoom = clamp(round2((container.clientWidth - pad) / maxW), 0.5, 1.25);
                    $('#zoomValue').text(Math.round(zoom * 100) + '%');

                    setupObserver();
                    buildPageShells();

                    history = [];
                    historyIndex = -1;
                    commitSnapshot();

                    setTimeout(buildThumbnails, 600);
                    hideLoading();

                    if (totalTexts === 0) {
                        setStatus('No selectable text found. Use Add Text to place new text');
                        alert(
                            'No selectable text was found. This PDF looks like a scan, so you can only add new text boxes.');
                    } else if (lockedTotal > 0) {
                        setStatus('PDF loaded. ' + lockedTotal +
                            ' text block(s) in unsupported scripts are locked');
                    } else {
                        setStatus('PDF loaded. Click any text to edit');
                    }
                } catch (error) {
                    console.error(error);
                    hideLoading();
                    alert('Unable to open this PDF.\n\n' + (error.message || error));
                }
            }

            /* split blocks that contain wide empty gaps (table columns written as one string) */
            function splitWideBlocks(pd, ctx, canvas, scale) {
                let img;
                try {
                    img = ctx.getImageData(0, 0, canvas.width, canvas.height);
                } catch (e) {
                    return;
                }
                const W = canvas.width,
                    H = canvas.height,
                    data = img.data;
                const measure = document.createElement('canvas').getContext('2d');
                const out = [];

                pd.texts.forEach(function(t) {
                    if (t.added || t.locked || !/\S\s+\S/.test(t.text)) {
                        out.push(t);
                        return;
                    }

                    const fs = t.fontSize;
                    const x0 = Math.max(0, Math.floor(t.x * scale));
                    const x1 = Math.min(W, Math.ceil((t.x + t.width) * scale));
                    const y0 = Math.max(0, Math.floor((t.baseline - fs * 0.8) * scale));
                    const y1 = Math.min(H, Math.ceil((t.baseline + fs * 0.2) * scale));
                    if (x1 - x0 < 4 || y1 <= y0) {
                        out.push(t);
                        return;
                    }

                    const bi = (y0 * W + x0) * 4;
                    const bg = [data[bi], data[bi + 1], data[bi + 2]];

                    // which pixel columns contain ink
                    const ink = [];
                    for (let x = x0; x < x1; x++) {
                        let has = false;
                        for (let y = y0; y < y1 && !has; y++) {
                            const i = (y * W + x) * 4;
                            const d = Math.abs(data[i] - bg[0]) + Math.abs(data[i + 1] - bg[1]) + Math.abs(
                                data[i + 2] - bg[2]);
                            if (d > 90) {
                                has = true;
                            }
                        }
                        ink.push(has);
                    }

                    // segments separated by gaps wider than a normal word space
                    const minGap = fs * 0.6 * scale;
                    const segs = [];
                    let start = -1,
                        lastInk = -1;
                    for (let i = 0; i < ink.length; i++) {
                        if (!ink[i]) {
                            continue;
                        }
                        if (start < 0) {
                            start = i;
                        } else if (i - lastInk - 1 >= minGap) {
                            segs.push([start, lastInk]);
                            start = i;
                        }
                        lastInk = i;
                    }
                    if (start >= 0) {
                        segs.push([start, lastInk]);
                    }
                    if (segs.length < 2) {
                        out.push(t);
                        return;
                    }

                    const words = t.text.split(/\s+/).filter(Boolean);
                    if (words.length < segs.length) {
                        out.push(t);
                        return;
                    }

                    // give words to segments by comparing measured word widths with each segment width
                    const style = (t.italic ? 'italic ' : '') + (t.bold ? '700 ' : '400 ') + fs + 'px ' +
                        (FONT_STACKS[t.fontFamily] || FONT_STACKS.Helvetica);
                    measure.font = style;
                    const groups = [];
                    let wi = 0;
                    for (let s = 0; s < segs.length; s++) {
                        const segW = (segs[s][1] - segs[s][0] + 1) / scale;
                        const left = segs.length - s - 1;
                        if (s === segs.length - 1) {
                            groups.push(words.slice(wi));
                            break;
                        }
                        const g = [words[wi++]];
                        while (wi < words.length - left) {
                            const next = g.concat(words[wi]).join(' ');
                            if (measure.measureText(next).width <= segW * 1.08) {
                                g.push(words[wi++]);
                            } else {
                                break;
                            }
                        }
                        groups.push(g);
                    }

                    groups.forEach(function(g, s) {
                        const gx = round2(t.x + (segs[s][0] - 0) / scale);
                        const gw = round2(Math.max((segs[s][1] - segs[s][0] + 1) / scale, 3));
                        const text = g.join(' ');
                        const base = {
                            text: text,
                            fontFamily: t.fontFamily,
                            fontSize: t.fontSize,
                            bold: t.bold,
                            italic: t.italic,
                            underline: false,
                            color: null,
                            x: gx,
                            baseline: t.baseline,
                            width: gw
                        };
                        out.push({
                            id: uid('t'),
                            pageId: t.pageId,
                            text: text,
                            x: gx,
                            baseline: t.baseline,
                            width: gw,
                            fontSize: t.fontSize,
                            fontFamily: t.fontFamily,
                            bold: t.bold,
                            italic: t.italic,
                            underline: false,
                            color: null,
                            deleted: false,
                            added: false,
                            locked: t.locked,
                            orig: base
                        });
                    });
                });

                pd.texts = out;
            }

            /* =====================================================
               PAGE SHELLS AND LAZY RENDERING
            ====================================================== */
            function setupObserver() {
                observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        const id = entry.target.getAttribute('data-page-id');
                        const pd = pages.find(function(p) {
                            return p.id === id;
                        });
                        const st = pd && pageState[pd.id];
                        if (!pd || !st) {
                            return;
                        }
                        st.visible = entry.isIntersecting;
                        if (entry.isIntersecting) {
                            renderPage(pd);
                        } else {
                            unrenderPage(pd);
                        }
                    });
                }, {
                    root: $('#pdfPagesContainer')[0],
                    rootMargin: '1500px 0px'
                });
            }

            function buildPageShells() {
                const container = $('#pdfPagesContainer').empty();
                pages.forEach(function(pd) {
                    pageState[pd.id] = {
                        rendered: false,
                        busy: false,
                        again: false,
                        visible: false,
                        task: null
                    };
                    const wrapper = $('<div class="pdf-page-wrapper"></div>')
                        .attr('data-page-id', pd.id)
                        .css({
                            width: pd.width * zoom + 'px',
                            height: pd.height * zoom + 'px'
                        });
                    wrapper.append(
                        '<div class="pdf-page-placeholder"><div class="spinner-border spinner-border-sm"></div></div>'
                        );
                    wrapper.append('<div class="pdf-text-layer"></div>');
                    container.append(wrapper);
                    observer.observe(wrapper[0]);
                });
            }

            async function renderPage(pd) {
                const st = pageState[pd.id];
                if (!st) {
                    return;
                }
                if (st.busy) {
                    st.again = true;
                    return;
                }
                st.busy = true;
                const epoch = renderEpoch;

                try {
                    const page = pdfPages[pd.pageNumber - 1];
                    const cssW = pd.width * zoom;
                    const cssH = pd.height * zoom;
                    const ratio = getPixelRatio(cssW, cssH);
                    const renderViewport = page.getViewport({
                        scale: zoom * ratio
                    });

                    const canvas = document.createElement('canvas');
                    canvas.className = 'pdf-page-canvas';
                    canvas.width = Math.floor(renderViewport.width);
                    canvas.height = Math.floor(renderViewport.height);
                    canvas.style.width = cssW + 'px';
                    canvas.style.height = cssH + 'px';
                    const ctx = canvas.getContext('2d', {
                        alpha: false
                    });

                    st.task = page.render({
                        canvasContext: ctx,
                        viewport: renderViewport
                    });
                    await st.task.promise;
                    st.task = null;

                    const wrapper = pageWrapper(pd.id);
                    if (epoch !== renderEpoch) {
                        st.again = true;
                        return;
                    }
                    if (!wrapper.length || !st.visible) {
                        return;
                    }

                    wrapper.find('.pdf-page-canvas').remove();
                    wrapper.find('.pdf-page-placeholder').remove();
                    wrapper.css({
                        width: cssW + 'px',
                        height: cssH + 'px'
                    }).prepend(canvas);

                    if (!sampledPages.has(pd.id)) {
                        sampledPages.add(pd.id);
                        splitWideBlocks(pd, ctx, canvas, renderViewport.scale);
                        sampleColors(pd, ctx, canvas, renderViewport.scale);
                    }

                    buildTextLayer(pd);
                    st.rendered = true;
                } catch (err) {
                    st.task = null;
                    if (!(err && err.name === 'RenderingCancelledException')) {
                        console.error(err);
                    }
                } finally {
                    st.busy = false;
                    if (st.again) {
                        st.again = false;
                        if (st.visible) {
                            renderPage(pd);
                        }
                    }
                }
            }

            function unrenderPage(pd) {
                const st = pageState[pd.id];
                if (!st || !st.rendered || st.busy) {
                    return;
                }
                const sel = getSelectedText();
                if (sel && sel.pageId === pd.id) {
                    return;
                }

                const wrapper = pageWrapper(pd.id);
                wrapper.find('.pdf-page-canvas').remove();
                wrapper.find('.pdf-text-layer').empty();
                if (!wrapper.find('.pdf-page-placeholder').length) {
                    wrapper.prepend(
                        '<div class="pdf-page-placeholder"><div class="spinner-border spinner-border-sm"></div></div>'
                        );
                }
                Object.keys(dom).forEach(function(k) {
                    if (dom[k].pageId === pd.id) {
                        delete dom[k];
                    }
                });
                try {
                    pdfPages[pd.pageNumber - 1].cleanup();
                } catch (e) {
                    /* ignore */ }
                st.rendered = false;
            }

            /* =====================================================
               COLOR SAMPLING (background and text color of originals)
            ====================================================== */
            function sampleColors(pd, ctx, canvas, scale) {
                let img;
                try {
                    img = ctx.getImageData(0, 0, canvas.width, canvas.height);
                } catch (e) {
                    return;
                }
                const data = img.data;
                const W = canvas.width;
                const H = canvas.height;

                pd.texts.forEach(function(t) {
                    if (t.added || t.locked || colorCache[t.id]) {
                        return;
                    }

                    const r = maskRect(t);
                    const x0 = Math.max(0, Math.floor(r.left * scale));
                    const y0 = Math.max(0, Math.floor(r.top * scale));
                    const x1 = Math.min(W, Math.ceil((r.left + r.width) * scale));
                    const y1 = Math.min(H, Math.ceil((r.top + r.height) * scale));
                    if (x1 <= x0 || y1 <= y0) {
                        return;
                    }

                    const stepX = Math.max(1, Math.floor((x1 - x0) / 220));
                    const stepY = Math.max(1, Math.floor((y1 - y0) / 40));

                    const bins = {};
                    let best = null;
                    for (let y = y0; y < y1; y += stepY) {
                        for (let x = x0; x < x1; x += stepX) {
                            const i = (y * W + x) * 4;
                            const key = ((data[i] >> 4) << 8) | ((data[i + 1] >> 4) << 4) | (data[i + 2] >>
                                4);
                            const b = bins[key] || (bins[key] = {
                                n: 0,
                                r: 0,
                                g: 0,
                                b: 0
                            });
                            b.n++;
                            b.r += data[i];
                            b.g += data[i + 1];
                            b.b += data[i + 2];
                            if (!best || b.n > best.n) {
                                best = b;
                            }
                        }
                    }
                    if (!best) {
                        return;
                    }

                    const bg = {
                        r: best.r / best.n,
                        g: best.g / best.n,
                        b: best.b / best.n
                    };
                    let maxDist = 0;
                    for (let y = y0; y < y1; y += stepY) {
                        for (let x = x0; x < x1; x += stepX) {
                            const i = (y * W + x) * 4;
                            const d = Math.pow(data[i] - bg.r, 2) + Math.pow(data[i + 1] - bg.g, 2) + Math
                                .pow(data[i + 2] - bg.b, 2);
                            if (d > maxDist) {
                                maxDist = d;
                            }
                        }
                    }

                    let color = null;
                    if (maxDist > 2500) {
                        let sr = 0,
                            sg = 0,
                            sb = 0,
                            n = 0;
                        const limit = maxDist * 0.8;
                        for (let y = y0; y < y1; y += stepY) {
                            for (let x = x0; x < x1; x += stepX) {
                                const i = (y * W + x) * 4;
                                const d = Math.pow(data[i] - bg.r, 2) + Math.pow(data[i + 1] - bg.g, 2) +
                                    Math.pow(data[i + 2] - bg.b, 2);
                                if (d >= limit) {
                                    sr += data[i];
                                    sg += data[i + 1];
                                    sb += data[i + 2];
                                    n++;
                                }
                            }
                        }
                        if (n) {
                            color = toHex(sr / n, sg / n, sb / n);
                        }
                    }
                    colorCache[t.id] = {
                        bg: toHex(bg.r, bg.g, bg.b),
                        color: color
                    };
                });
            }

            /* =====================================================
               TEXT LAYER
            ====================================================== */
            function buildTextLayer(pd) {
                const layer = pageWrapper(pd.id).find('.pdf-text-layer').empty();
                Object.keys(dom).forEach(function(k) {
                    if (dom[k].pageId === pd.id) {
                        delete dom[k];
                    }
                });
                const focusedText = focusedId && findText(focusedId);
                if (focusedText && focusedText.pageId === pd.id) {
                    focusedId = null;
                }

                pd.texts.forEach(function(t) {
                    createTextNodes(pd, t, layer);
                });
            }

            function createTextNodes(pd, t, layer) {
                if (t.locked) {
                    return;
                }
                const id = t.id;
                const refs = {
                    pageId: pd.id
                };

                if (!t.added) {
                    refs.mask = $('<div class="pdf-text-mask"></div>');
                    layer.append(refs.mask);
                }
                dom[id] = refs;

                if (t.deleted) {
                    applyVisual(t);
                    return;
                }

                const editor = $('<div class="pdf-editable-text"></div>')
                    .attr('contenteditable', PLAINTEXT_ONLY ? 'plaintext-only' : 'true')
                    .attr('spellcheck', 'false')
                    .attr('data-text-id', id)
                    .text(t.text);
                refs.editor = editor;

                editor.on('focus', function() {
                    focusedId = id;
                    selectText(id);
                    const cur = findText(id);
                    if (cur) {
                        applyVisual(cur);
                    }
                });

                editor.on('blur', function() {
                    if (focusedId === id) {
                        focusedId = null;
                    }
                    const cur = findText(id);
                    if (cur) {
                        applyVisual(cur);
                    }
                });

                editor.on('input', function() {
                    const cur = findText(id);
                    if (!cur) {
                        return;
                    }
                    const before = lineCount(cur.text);
                    const value = getPlainText(this);
                    cur.text = value;
                    shiftBelow(cur, lineCount(value) - before);
                    applyVisual(cur);
                    saveHistory();
                    if (!isSupportedString(value)) {
                        setStatus(
                            'Some characters are not supported by PDF standard fonts and will be left out'
                            );
                    }
                });

                editor.on('keydown', function(e) {
                    const cur = findText(id);
                    if (!cur) {
                        return;
                    }
                    if (e.key === 'Enter') {
                        if (!PLAINTEXT_ONLY) {
                            e.preventDefault();
                            document.execCommand('insertLineBreak');
                        }
                        return;
                    }
                    if ((e.ctrlKey || e.metaKey) && !e.altKey) {
                        const k = e.key.toLowerCase();
                        if (k === 'b') {
                            e.preventDefault();
                            toggleFormat('bold');
                        }
                        if (k === 'i') {
                            e.preventDefault();
                            toggleFormat('italic');
                        }
                        if (k === 'u') {
                            e.preventDefault();
                            toggleFormat('underline');
                        }
                    }
                });

                editor.on('paste', function(e) {
                    e.preventDefault();
                    const cb = (e.originalEvent || e).clipboardData;
                    if (!cb) {
                        return;
                    }
                    const cur = findText(id);
                    let s = cb.getData('text/plain') || '';
                    s = s.replace(/\r/g, '');
                    document.execCommand('insertText', false, s);
                });

                editor.on('drop', function(e) {
                    e.preventDefault();
                });

                if (t.added) {
                    const box = $('<div class="pdf-added-box"></div>');
                    const handle = $(
                        '<div class="pdf-drag-handle" contenteditable="false" title="Drag to move"><i class="fas fa-arrows-alt"></i></div>'
                        );
                    box.append(handle, editor);
                    layer.append(box);
                    refs.box = box;
                    editor.addClass('pdf-added-text');
                    enableDrag(handle[0], id);
                } else {
                    layer.append(editor);
                }

                if (selectedTextId === id) {
                    editor.addClass('pdf-selection-highlight');
                    if (refs.box) {
                        refs.box.addClass('selected');
                    }
                }
                applyVisual(t);
            }

            function applyVisual(t) {
                const r = dom[t.id];
                if (!r) {
                    return;
                }
                const modified = isModified(t);
                const focused = focusedId === t.id;

                if (r.mask) {
                    const m = maskRect(t);
                    r.mask.css({
                        left: m.left * zoom + 'px',
                        top: m.top * zoom + 'px',
                        width: m.width * zoom + 'px',
                        height: m.height * zoom + 'px',
                        background: bgColor(t),
                        display: (modified || focused) ? 'block' : 'none'
                    });
                }

                if (!r.editor) {
                    return;
                }
                const lh = (t.added || t.text.indexOf('\n') > -1) ? 1.2 : 1;
                const left = t.x * zoom;
                const top = (t.baseline - baselineOffset(t.fontFamily, lh) * t.fontSize) * zoom;
                const visible = t.added || modified || focused;

                const css = {
                    fontSize: t.fontSize * zoom + 'px',
                    fontFamily: FONT_STACKS[t.fontFamily] || FONT_STACKS.Helvetica,
                    fontWeight: t.bold ? '700' : '400',
                    fontStyle: t.italic ? 'italic' : 'normal',
                    textDecoration: t.underline ? 'underline' : 'none',
                    color: visible ? textColor(t) : 'transparent',
                    lineHeight: String(lh)
                };

                if (t.added) {
                    r.box.css({
                        left: left + 'px',
                        top: top + 'px'
                    });
                } else {
                    css.left = left + 'px';
                    css.top = top + 'px';
                    css.minWidth = Math.max(t.orig.width, 4) * zoom + 'px';
                    css.minHeight = t.fontSize * zoom + 'px';
                }
                r.editor.css(css);
            }

            /* =====================================================
               SELECTION
            ====================================================== */
            function selectText(id) {
                if (selectedTextId && selectedTextId !== id) {
                    const prev = dom[selectedTextId];
                    if (prev) {
                        if (prev.editor) {
                            prev.editor.removeClass('pdf-selection-highlight');
                        }
                        if (prev.box) {
                            prev.box.removeClass('selected');
                        }
                    }
                }
                selectedTextId = id;
                const r = dom[id];
                if (r) {
                    if (r.editor) {
                        r.editor.addClass('pdf-selection-highlight');
                    }
                    if (r.box) {
                        r.box.addClass('selected');
                    }
                }
                const t = findText(id);
                if (!t) {
                    return;
                }
                updateToolbar(t);
                setStatus(t.added ? 'Added text selected. Use the blue handle to move it' :
                    'Editing text. Press Enter when you are done');
            }

            function deselect() {
                if (!selectedTextId) {
                    return;
                }
                const r = dom[selectedTextId];
                if (r) {
                    if (r.editor) {
                        r.editor.removeClass('pdf-selection-highlight');
                    }
                    if (r.box) {
                        r.box.removeClass('selected');
                    }
                }
                selectedTextId = null;
                setStatus('Click any PDF text to edit');
            }

            $(document).on('pointerdown', function(e) {
                if ($('#pdfEditorSection').hasClass('d-none')) {
                    return;
                }
                if ($(e.target).closest(
                        '.pdf-editable-text, .pdf-added-box, .pdf-editor-toolbar, #pdfLoadingOverlay')
                    .length) {
                    return;
                }
                deselect();
            });

            /* =====================================================
               TOOLBAR
            ====================================================== */
            $('#fontFamilySelect').html(
                '<option value="Helvetica">Helvetica / Arial</option>' +
                '<option value="Times-Roman">Times New Roman</option>' +
                '<option value="Courier">Courier</option>'
            );

            // keep the caret in the text box when a toolbar button is pressed
            $('.pdf-editor-toolbar').on('mousedown', 'button', function(e) {
                e.preventDefault();
            });

            function updateToolbar(t) {
                if (!t) {
                    return;
                }
                $('#fontFamilySelect').val(t.fontFamily || 'Helvetica');

                const size = Math.round(t.fontSize * 2) / 2;
                const select = $('#fontSizeSelect');
                const exists = select.find('option').filter(function() {
                    return parseFloat(this.value) === size;
                }).length;
                if (!exists) {
                    const next = select.find('option').filter(function() {
                        return parseFloat(this.value) > size;
                    }).first();
                    const opt = $('<option></option>').val(size).text(size);
                    if (next.length) {
                        opt.insertBefore(next);
                    } else {
                        select.append(opt);
                    }
                }
                select.val(String(size));

                $('#boldBtn').toggleClass('active', !!t.bold);
                $('#italicBtn').toggleClass('active', !!t.italic);
                $('#underlineBtn').toggleClass('active', !!t.underline);

                const color = textColor(t);
                $('#currentColorBar').css('background', color);
                $('#textColorPicker').val(/^#[0-9a-f]{6}$/i.test(color) ? color : DEFAULT_COLOR);
            }

            function refocus(t) {
                const r = dom[t.id];
                if (r && r.editor) {
                    r.editor[0].focus({
                        preventScroll: true
                    });
                }
            }

            function mutateSelected(fn, debounced) {
                const t = getSelectedText();
                if (!t) {
                    setStatus('Click a piece of text first');
                    return null;
                }
                fn(t);
                applyVisual(t);
                updateToolbar(t);
                if (debounced) {
                    saveHistory();
                } else {
                    saveHistoryImmediately();
                }
                return t;
            }

            function toggleFormat(fmt) {
                mutateSelected(function(t) {
                    t[fmt] = !t[fmt];
                });
            }

            $('#fontFamilySelect').on('change', function() {
                const value = $(this).val();
                const t = mutateSelected(function(t) {
                    t.fontFamily = value;
                });
                if (t) {
                    refocus(t);
                }
            });

            $('#fontSizeSelect').on('change', function() {
                const value = parseFloat($(this).val());
                const t = mutateSelected(function(t) {
                    t.fontSize = value;
                });
                if (t) {
                    refocus(t);
                }
            });

            $('.pdf-format-btn').on('click', function() {
                toggleFormat($(this).data('format'));
            });

            $('#textColorButton').on('click', function() {
                $('#textColorPicker')[0].click();
            });

            $('#textColorPicker').on('input change', function() {
                const color = $(this).val();
                $('#currentColorBar').css('background', color);
                mutateSelected(function(t) {
                    t.color = color;
                }, true);
            });

            /* =====================================================
               ADD TEXT
            ====================================================== */
            function getCurrentPage() {
                const container = $('#pdfPagesContainer')[0];
                const cr = container.getBoundingClientRect();
                const mid = cr.top + cr.height * 0.35;
                let best = null;
                let bestDist = Infinity;
                pages.forEach(function(pd) {
                    const el = pageWrapper(pd.id)[0];
                    if (!el) {
                        return;
                    }
                    const r = el.getBoundingClientRect();
                    if (r.top <= mid && r.bottom >= mid) {
                        best = pd;
                        bestDist = -1;
                    } else if (bestDist >= 0) {
                        const d = Math.min(Math.abs(r.top - mid), Math.abs(r.bottom - mid));
                        if (d < bestDist) {
                            bestDist = d;
                            best = pd;
                        }
                    }
                });
                return best || pages[0] || null;
            }

            $('#addTextBtn').on('click', function() {
                const pd = getCurrentPage();
                if (!pd) {
                    return;
                }

                const container = $('#pdfPagesContainer')[0];
                const wrapperEl = pageWrapper(pd.id)[0];
                const cr = container.getBoundingClientRect();
                const wr = wrapperEl.getBoundingClientRect();

                const fs = parseFloat($('#fontSizeSelect').val()) || 14;
                let x = (cr.left + cr.width / 2 - wr.left) / zoom - 40;
                let base = (cr.top + cr.height / 2 - wr.top) / zoom;
                x = clamp(x, 20, Math.max(20, pd.width - 160));
                base = clamp(base, fs + 20, Math.max(fs + 20, pd.height - 20));

                const nt = {
                    id: uid('added'),
                    pageId: pd.id,
                    text: 'Type here',
                    x: round2(x),
                    baseline: round2(base),
                    width: 120,
                    fontSize: fs,
                    fontFamily: $('#fontFamilySelect').val() || 'Helvetica',
                    bold: false,
                    italic: false,
                    underline: false,
                    color: $('#textColorPicker').val() || DEFAULT_COLOR,
                    deleted: false,
                    added: true,
                    locked: false,
                    orig: null
                };
                pd.texts.push(nt);
                saveHistoryImmediately();
                buildTextLayer(pd);

                const r = dom[nt.id];
                if (r && r.editor) {
                    const el = r.editor[0];
                    el.focus();
                    try {
                        const range = document.createRange();
                        range.selectNodeContents(el);
                        const sel = window.getSelection();
                        sel.removeAllRanges();
                        sel.addRange(range);
                    } catch (e) {
                        /* ignore */ }
                }
            });

            function enableDrag(handleEl, id) {
                handleEl.addEventListener('pointerdown', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const t = findText(id);
                    if (!t) {
                        return;
                    }
                    const pd = pages.find(function(p) {
                        return p.id === t.pageId;
                    });
                    const startX = e.clientX;
                    const startY = e.clientY;
                    const ox = t.x;
                    const ob = t.baseline;
                    selectText(id);
                    try {
                        handleEl.setPointerCapture(e.pointerId);
                    } catch (err) {
                        /* ignore */ }

                    function move(ev) {
                        const cur = findText(id);
                        if (!cur) {
                            return;
                        }
                        cur.x = clamp(ox + (ev.clientX - startX) / zoom, 0, pd.width - 10);
                        cur.baseline = clamp(ob + (ev.clientY - startY) / zoom, 5, pd.height);
                        applyVisual(cur);
                    }

                    function up() {
                        handleEl.removeEventListener('pointermove', move);
                        handleEl.removeEventListener('pointerup', up);
                        handleEl.removeEventListener('pointercancel', up);
                        const cur = findText(id);
                        if (cur) {
                            cur.x = round2(cur.x);
                            cur.baseline = round2(cur.baseline);
                        }
                        saveHistoryImmediately();
                    }

                    handleEl.addEventListener('pointermove', move);
                    handleEl.addEventListener('pointerup', up);
                    handleEl.addEventListener('pointercancel', up);
                });
            }

            /* =====================================================
               DELETE
            ====================================================== */
            function deleteSelected() {
                const t = getSelectedText();
                if (!t) {
                    setStatus('Click a piece of text first');
                    return;
                }
                const pd = pages.find(function(p) {
                    return p.id === t.pageId;
                });
                if (t.added) {
                    pd.texts = pd.texts.filter(function(x) {
                        return x.id !== t.id;
                    });
                } else {
                    t.deleted = true;
                    t.text = '';
                }
                selectedTextId = null;
                focusedId = null;
                if (document.activeElement && document.activeElement.blur) {
                    document.activeElement.blur();
                }
                saveHistoryImmediately();
                buildTextLayer(pd);
                setStatus('Text deleted');
            }

            $('#deleteTextBtn').on('click', deleteSelected);

            /* =====================================================
               ZOOM
            ====================================================== */
            function setZoom(value) {
                value = round2(clamp(value, 0.5, 3));
                if (value === zoom || !pages.length) {
                    return;
                }

                const container = $('#pdfPagesContainer')[0];
                const centerRatio = (container.scrollTop + container.clientHeight / 2) /
                    Math.max(1, container.scrollHeight);

                zoom = value;
                renderEpoch++;
                $('#zoomValue').text(Math.round(zoom * 100) + '%');

                pages.forEach(function(pd) {
                    const w = pageWrapper(pd.id);
                    const size = {
                        width: pd.width * zoom + 'px',
                        height: pd.height * zoom + 'px'
                    };
                    w.css(size);
                    w.find('.pdf-page-canvas').css(size);
                    w.find('.pdf-text-layer').empty();
                });
                dom = {};
                focusedId = null;

                container.scrollTop = centerRatio * container.scrollHeight - container.clientHeight / 2;

                clearTimeout(zoomTimer);
                zoomTimer = setTimeout(function() {
                    pages.forEach(function(pd) {
                        const st = pageState[pd.id];
                        if (st && st.visible) {
                            renderPage(pd);
                        }
                    });
                }, 150);
            }

            $('#zoomInBtn').on('click', function() {
                const next = ZOOM_STEPS.find(function(z) {
                    return z > zoom + 0.001;
                });
                if (next) {
                    setZoom(next);
                }
            });

            $('#zoomOutBtn').on('click', function() {
                const prev = ZOOM_STEPS.slice().reverse().find(function(z) {
                    return z < zoom - 0.001;
                });
                if (prev) {
                    setZoom(prev);
                }
            });

            let wheelLock = 0;
            $('#pdfPagesContainer')[0].addEventListener('wheel', function(e) {
                if (!(e.ctrlKey || e.metaKey)) {
                    return;
                }
                e.preventDefault();
                const now = Date.now();
                if (now - wheelLock < 120) {
                    return;
                }
                wheelLock = now;
                $(e.deltaY < 0 ? '#zoomInBtn' : '#zoomOutBtn').trigger('click');
            }, {
                passive: false
            });

            /* =====================================================
               THUMBNAILS
            ====================================================== */
            async function buildThumbnails() {
                const epoch = ++thumbEpoch;
                const list = $('#pdfThumbnails').empty();

                pages.forEach(function(pd) {
                    const item = $('<div class="pdf-thumbnail"></div>').attr('data-page-id', pd.id);
                    item.append('<canvas></canvas>');
                    item.append($('<div class="pdf-thumb-number"></div>').text('Page ' + pd
                    .pageNumber));
                    item.on('click', function() {
                        scrollToPage(pd.id);
                    });
                    list.append(item);
                });
                updateActiveThumbnail();

                for (const pd of pages) {
                    if (epoch !== thumbEpoch) {
                        return;
                    }
                    const page = pdfPages[pd.pageNumber - 1];
                    const canvas = list.find('.pdf-thumbnail[data-page-id="' + pd.id + '"] canvas')[0];
                    if (!page || !canvas) {
                        continue;
                    }
                    const vp = page.getViewport({
                        scale: 220 / pd.width
                    });
                    canvas.width = Math.floor(vp.width);
                    canvas.height = Math.floor(vp.height);
                    try {
                        await page.render({
                            canvasContext: canvas.getContext('2d'),
                            viewport: vp
                        }).promise;
                    } catch (e) {
                        /* ignore thumbnail errors */ }
                    await new Promise(function(resolve) {
                        setTimeout(resolve, 0);
                    });
                }
            }

            function scrollToPage(pageId) {
                const el = pageWrapper(pageId)[0];
                const container = $('#pdfPagesContainer')[0];
                if (!el) {
                    return;
                }
                const top = container.scrollTop + (el.getBoundingClientRect().top - container
                .getBoundingClientRect().top) - 20;
                container.scrollTo({
                    top: top,
                    behavior: 'smooth'
                });
            }

            function updateActiveThumbnail() {
                const pd = getCurrentPage();
                if (!pd) {
                    return;
                }
                const list = $('#pdfThumbnails');
                const thumbs = list.find('.pdf-thumbnail');
                thumbs.removeClass('active');
                const active = thumbs.filter('[data-page-id="' + pd.id + '"]').addClass('active')[0];
                if (active) {
                    const lr = list[0].getBoundingClientRect();
                    const ar = active.getBoundingClientRect();
                    if (ar.top < lr.top) {
                        list[0].scrollTop -= (lr.top - ar.top) + 8;
                    } else if (ar.bottom > lr.bottom) {
                        list[0].scrollTop += (ar.bottom - lr.bottom) + 8;
                    }
                }
            }

            $('#pdfPagesContainer').on('scroll', function() {
                if (scrollTick) {
                    return;
                }
                scrollTick = true;
                requestAnimationFrame(function() {
                    scrollTick = false;
                    updateActiveThumbnail();
                });
            });

            /* =====================================================
               KEYBOARD
            ====================================================== */
            $(document).on('keydown', function(e) {
                if ($('#pdfEditorSection').hasClass('d-none')) {
                    return;
                }
                const mod = e.ctrlKey || e.metaKey;
                const key = (e.key || '').toLowerCase();

                if (mod && key === 's') {
                    e.preventDefault();
                    exportPdf();
                    return;
                }
                if (mod && key === 'z' && !e.shiftKey) {
                    e.preventDefault();
                    undo();
                    return;
                }
                if (mod && (key === 'y' || (key === 'z' && e.shiftKey))) {
                    e.preventDefault();
                    redo();
                    return;
                }
                if (key === 'escape') {
                    if (document.activeElement && document.activeElement.blur) {
                        document.activeElement.blur();
                    }
                    deselect();
                    return;
                }
                if (key === 'delete' && selectedTextId) {
                    const a = document.activeElement;
                    const typing = a && (a.isContentEditable || /^(INPUT|SELECT|TEXTAREA)$/.test(a
                    .tagName));
                    if (!typing) {
                        e.preventDefault();
                        deleteSelected();
                    }
                }
            });

            window.addEventListener('beforeunload', function(e) {
                if (historyIndex > 0 || historyTimer) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            /* =====================================================
               EXPORT
            ====================================================== */
            // viewport point (scale 1) to PDF user space, including page rotation
            function toUser(pd, vx, vy) {
                const x0 = pd.view[0];
                const y0 = pd.view[1];
                const W = pd.view[2] - x0;
                const H = pd.view[3] - y0;
                let ux, uy;
                switch (pd.rotation) {
                    case 90:
                        ux = vy;
                        uy = vx;
                        break;
                    case 180:
                        ux = W - vx;
                        uy = vy;
                        break;
                    case 270:
                        ux = W - vy;
                        uy = H - vx;
                        break;
                    default:
                        ux = vx;
                        uy = H - vy;
                }
                return {
                    x: x0 + ux,
                    y: y0 + uy
                };
            }

            function drawMask(page, pd, t) {
                const m = maskRect(t);
                const a = toUser(pd, m.left, m.top);
                const b = toUser(pd, m.left + m.width, m.top + m.height);
                const c = hexToRgb(bgColor(t));
                page.drawRectangle({
                    x: Math.min(a.x, b.x),
                    y: Math.min(a.y, b.y),
                    width: Math.abs(a.x - b.x),
                    height: Math.abs(a.y - b.y),
                    color: rgb(c.r, c.g, c.b),
                    borderWidth: 0
                });
            }

            function drawTextBlock(page, pd, t, clean, font) {
                const fs = t.fontSize;
                const lineHeight = fs * 1.2;
                const c = hexToRgb(textColor(t));
                const rotation = degrees(pd.rotation);

                clean.split('\n').forEach(function(line, i) {
                    if (!line) {
                        return;
                    }
                    const base = t.baseline + i * lineHeight;
                    const p = toUser(pd, t.x, base);
                    page.drawText(line, {
                        x: p.x,
                        y: p.y,
                        size: fs,
                        font: font,
                        color: rgb(c.r, c.g, c.b),
                        rotate: rotation
                    });
                    if (t.underline) {
                        const w = font.widthOfTextAtSize(line, fs);
                        const u1 = toUser(pd, t.x, base + fs * 0.12);
                        const u2 = toUser(pd, t.x + w, base + fs * 0.12);
                        page.drawLine({
                            start: u1,
                            end: u2,
                            thickness: Math.max(0.5, fs * 0.05),
                            color: rgb(c.r, c.g, c.b)
                        });
                    }
                });
            }

            async function exportPdf() {
                if (!originalPdfBytes) {
                    alert('Please upload a PDF first.');
                    return;
                }
                if (exporting) {
                    return;
                }
                exporting = true;
                flushHistory();

                const button = $('#downloadPdfBtn').prop('disabled', true);
                showLoading('Creating your edited PDF...');
                const dropped = new Set();

                try {
                    const pdfDoc = await PDFDocument.load(originalPdfBytes.slice(0), {
                        ignoreEncryption: true,
                        updateMetadata: false
                    });
                    if (pdfDoc.getPageCount() !== pages.length) {
                        throw new Error('The page count of the saved file does not match the editor.');
                    }

                    const fontCache = {};
                    async function getFont(t) {
                        const list = STD_FONTS[t.fontFamily] || STD_FONTS.Helvetica;
                        const name = list[(t.bold ? 1 : 0) + (t.italic ? 2 : 0)];
                        if (!fontCache[name]) {
                            fontCache[name] = await pdfDoc.embedFont(StandardFonts[name]);
                        }
                        return fontCache[name];
                    }

                    for (let i = 0; i < pages.length; i++) {
                        const pd = pages[i];
                        const edits = pd.texts.filter(function(t) {
                            return !t.locked && (t.added || t.deleted || isModified(t));
                        });
                        if (!edits.length) {
                            continue;
                        }

                        $('#pdfLoadingText').text('Writing page ' + (i + 1) + ' of ' + pages.length + '...');
                        const page = pdfDoc.getPage(i);

                        // all masks first so a mask never covers new text
                        edits.forEach(function(t) {
                            if (!t.added) {
                                drawMask(page, pd, t);
                            }
                        });

                        for (const t of edits) {
                            if (t.deleted) {
                                continue;
                            }
                            const clean = sanitizeForExport(t.text, dropped);
                            if (!clean.trim()) {
                                continue;
                            }
                            drawTextBlock(page, pd, t, clean, await getFont(t));
                        }
                    }

                    $('#pdfLoadingText').text('Finalizing PDF...');
                    const bytes = await pdfDoc.save({
                        useObjectStreams: false
                    });
                    const blob = new Blob([bytes], {
                        type: 'application/pdf'
                    });
                    const url = URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = originalFileName.replace(/\.pdf$/i, '') + '-edited.pdf';
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    setTimeout(function() {
                        URL.revokeObjectURL(url);
                    }, 4000);

                    setStatus('PDF downloaded successfully');
                    hideLoading();

                    if (dropped.size) {
                        alert('Your PDF was downloaded.\n\nThese characters are not supported by the standard PDF fonts and were left out:\n' +
                            Array.from(dropped).slice(0, 30).join(' '));
                    }
                } catch (error) {
                    console.error('PDF EXPORT ERROR:', error);
                    hideLoading();
                    alert('Unable to create the edited PDF.\n\n' + (error && error.message ? error.message :
                        error));
                } finally {
                    exporting = false;
                    button.prop('disabled', false);
                }
            }

            $('#downloadPdfBtn').on('click', exportPdf);

            updateHistoryButtons();
        });
    </script>
    <script>
        const pdfEditorSeoCta = document.getElementById('pdfEditorSeoCta');

        if (pdfEditorSeoCta) {
            pdfEditorSeoCta.addEventListener('click', function(event) {
                const uploadSection = document.getElementById('pdfUploadSection');
                const editorSection = document.getElementById('pdfEditorSection');
                const isVisible = function(element) {
                    return element &&
                        !element.classList.contains('d-none') &&
                        window.getComputedStyle(element).display !== 'none' &&
                        element.getClientRects().length > 0;
                };
                const target = isVisible(uploadSection) ? uploadSection :
                    (isVisible(editorSection) ? editorSection : null);

                if (!target) {
                    return;
                }

                event.preventDefault();
                const reduceMotion = window.matchMedia(
                    '(prefers-reduced-motion: reduce)'
                ).matches;

                target.scrollIntoView({
                    behavior: reduceMotion ? 'auto' : 'smooth',
                    block: 'start'
                });
            });
        }
    </script>
@endsection
