<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Batch Pupil Progression | FNPS Gusau</title>

    <style>
        :root {
            --primary: #1764d8;
            --primary-dark: #104da9;
            --primary-light: #eaf2ff;
            --background: #edf3ff;
            --text: #172b4d;
            --muted: #64748b;
            --border: #dbe5f3;
            --white: #ffffff;
            --success: #15803d;
            --warning: #b45309;
            --danger: #dc2626;
            --shadow: 0 10px 30px rgba(30, 64, 125, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 28px 16px;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(
                135deg,
                #eaf2ff 0%,
                #f5f8ff 50%,
                #dce9ff 100%
            );
            color: var(--text);
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1250px;
            margin: 0 auto;
        }

        .page-header {
            background: var(--white);
            border: 1px solid rgba(219, 229, 243, 0.9);
            border-radius: 22px;
            padding: 24px 28px;
            margin-bottom: 25px;
            box-shadow: var(--shadow);
        }

        .school-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding-bottom: 22px;
            border-bottom: 1px solid var(--border);
        }

        .school-logo {
            width: 130px;
            height: 130px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-name {
            flex: 1;
            text-align: center;
            min-width: 180px;
        }

        .school-name h2 {
            margin: 0 0 7px;
            color: #174a96;
            font-size: 23px;
            font-weight: 800;
            letter-spacing: 0.3px;
        }

        .school-name p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding-top: 22px;
        }

        .page-heading h1 {
            margin: 0 0 8px;
            color: #163e78;
            font-size: 27px;
            font-weight: 800;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 14px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 1px solid transparent;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
            font-family: inherit;
        }

        .btn:hover {
            transform: translateY(-1px);
            filter: brightness(0.97);
        }

        .btn:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        .btn-primary {
            color: #fff;
            background: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            color: var(--primary);
            background: #fff;
            border-color: #c7d9f5;
        }

        .btn-success {
            color: #fff;
            background: #15803d;
        }

        .btn-danger {
            color: #fff;
            background: #dc2626;
        }

        .btn-secondary {
            color: #334155;
            background: #e8edf5;
            border-color: #d5deeb;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 12px;
        }

        .alert {
            border-radius: 12px;
            padding: 15px 17px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            line-height: 1.6;
            font-size: 14px;
        }

        .alert-success {
            color: #166534;
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .alert-danger {
            color: #991b1b;
            background: #fef2f2;
            border-color: #fecaca;
        }

        .alert-warning {
            color: #92400e;
            background: #fffbeb;
            border-color: #fde68a;
        }

        .alert-info {
            color: #1e40af;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .alert ul {
            padding-left: 22px;
            margin-top: 8px;
        }

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 18px;
            margin-bottom: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 19px 23px;
            background: linear-gradient(135deg, #f5f9ff, #eaf2ff);
            border-bottom: 1px solid var(--border);
            color: #174a96;
            font-size: 15px;
            font-weight: 800;
        }

        .step-number {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: #fff;
            font-size: 13px;
            flex-shrink: 0;
        }

        .card-body {
            padding: 24px;
        }

        .row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .row.two-column {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .form-group {
            min-width: 0;
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #334b6e;
            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            display: block;
            width: 100%;
            min-height: 46px;
            padding: 11px 13px;
            border: 1px solid #cbd8e9;
            border-radius: 10px;
            background: #fff;
            color: #1e293b;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            border-color: #4d8ce5;
            box-shadow: 0 0 0 3px rgba(23, 100, 216, 0.12);
        }

        .form-control:disabled {
            background: #f1f5f9;
            color: #64748b;
            cursor: not-allowed;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 95px;
        }

        .text-muted {
            color: var(--muted);
            font-size: 13px;
        }

        .section-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 22px;
        }

        .section-toolbar strong {
            color: #1e3a64;
            font-size: 15px;
        }

        .toolbar-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            background: #fff;
        }

        .table th {
            padding: 14px 16px;
            text-align: left;
            white-space: nowrap;
            background: #edf4ff;
            color: #234879;
            font-size: 12px;
            font-weight: 800;
            border-bottom: 1px solid #d7e4f6;
        }

        .table td {
            padding: 13px 16px;
            border-bottom: 1px solid #e7edf6;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:nth-child(even) {
            background: #f8fbff;
        }

        .table tbody tr:hover {
            background: #eef5ff;
        }

        .table input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .review-summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin: 22px 0;
        }

        .summary-item {
            padding: 16px;
            border: 1px solid #dce7f6;
            border-radius: 12px;
            background: #f7faff;
        }

        .summary-item span {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-item strong {
            color: #1d477e;
            font-size: 14px;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .review-warning {
            margin-bottom: 22px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .footer-note {
            text-align: center;
            color: #718096;
            font-size: 12px;
            padding: 10px 0 4px;
        }

        @media (max-width: 850px) {
            .row,
            .row.two-column {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .review-summary {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 14px 10px;
            }

            .page-header {
                padding: 18px;
                border-radius: 16px;
            }

            .school-header {
                justify-content: center;
                gap: 12px;
            }

            .school-logo {
                width: 55px;
                height: 55px;
            }

            .school-name {
                order: 3;
                flex-basis: 100%;
            }

            .school-name h2 {
                font-size: 18px;
            }

            .page-heading {
                align-items: flex-start;
            }

            .page-heading h1 {
                font-size: 23px;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                flex: 1;
            }

            .card-header {
                padding: 16px;
            }

            .card-body {
                padding: 17px;
            }

            .row,
            .row.two-column {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .section-toolbar {
                align-items: flex-start;
            }

            .toolbar-actions {
                width: 100%;
            }

            .toolbar-actions .btn {
                flex: 1;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="page-header">

        <div class="school-header">

            <img
                src="{{ asset('images/school-logo.jpeg') }}"
                alt="Fatima Nursery and Primary School Logo"
                class="school-logo"
            >

            <div class="school-name">
                <h2>Fatima Nursery and Primary School</h2>
                <p>Gusau, Zamfara State</p>
            </div>

            <img
                src="{{ asset('images/second-school-logo.jpeg') }}"
                alt="School Logo"
                class="school-logo"
            >

        </div>

        <div class="page-heading">

            <div>
                <h1>Batch Pupil Progression</h1>

                <p>
                    Promote, repeat, demote, or transfer multiple pupils safely.
                    Review every movement before processing.
                </p>
            </div>

            <div class="header-actions">

                <a href="{{ route('staff.dashboard') }}"
                   class="btn btn-outline">
                    ← Staff Dashboard
                </a>

                <a href="{{ route('pupil-progression.audits') }}"
                   class="btn btn-primary">
                    Audit History
                </a>

            </div>

        </div>

    </header>


    @if(session('success'))
        <div class="alert alert-success">
            <strong>Success!</strong>
            {{ session('success') }}
        </div>
    @endif


    @if($errors->any())
        <div class="alert alert-danger">

            <strong>Please check the following:</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    @php
        $batchResults = session('batch_results');
    @endphp


    @if(is_array($batchResults))

        <div class="card">

            <div class="card-header">
                <span class="step-number">✓</span>
                Batch Processing Results
            </div>

            <div class="card-body">

                <div class="review-summary">

                    <div class="summary-item">
                        <span>Successful Movements</span>
                        <strong>
                            {{ count($batchResults['success'] ?? []) }}
                        </strong>
                    </div>

                    <div class="summary-item">
                        <span>Failed Movements</span>
                        <strong>
                            {{ count($batchResults['failed'] ?? []) }}
                        </strong>
                    </div>

                    <div class="summary-item">
                        <span>Processing Status</span>
                        <strong>
                            {{ count($batchResults['failed'] ?? []) > 0
                                ? 'Completed with some failures'
                                : 'Completed' }}
                        </strong>
                    </div>

                </div>


                @if(count($batchResults['failed'] ?? []) > 0)

                    <div class="alert alert-warning">

                        <strong>Movements that could not be completed:</strong>

                        <ul>
                            @foreach($batchResults['failed'] as $failure)
                                <li>
                                    Pupil ID {{ $failure['student_id'] }}:
                                    {{ $failure['reason'] }}
                                </li>
                            @endforeach
                        </ul>

                    </div>

                @endif

            </div>

        </div>

    @endif


    {{-- STEP 1: SELECT SOURCE CLASS --}}

    <div class="card">

        <div class="card-header">
            <span class="step-number">1</span>
            Select Source Class
        </div>

        <div class="card-body">

            <div class="row">

                <div class="form-group">

                    <label for="source_session_id">
                        Academic Session
                    </label>

                    <select id="source_session_id" class="form-control">

                        <option value="">
                            Select academic session
                        </option>

                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}">
                                {{ $session->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label for="source_class_id">
                        Class
                    </label>

                    <select id="source_class_id" class="form-control">

                        <option value="">
                            Select class
                        </option>

                        @foreach($classLevels as $classLevel)
                            <option value="{{ $classLevel->id }}">
                                {{ $classLevel->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label for="source_section_id">
                        Section
                    </label>

                    <select id="source_section_id" class="form-control">

                        <option value="">
                            Select section
                        </option>

                    </select>

                </div>

            </div>


            <button type="button"
                    id="load-pupils"
                    class="btn btn-primary">

                Load Pupils

            </button>


            <div id="load-message" style="margin-top: 18px;"></div>

        </div>

    </div>


    {{-- STEP 2: SELECT PUPILS --}}

    <div id="pupil-card" class="card" style="display:none;">

        <div class="card-header">
            <span class="step-number">2</span>
            Select Pupils
        </div>

        <div class="card-body">

            <div class="section-toolbar">

                <div>

                    <strong id="source-description"></strong>

                    <div class="text-muted" style="margin-top: 7px;">
                        <span id="pupil-count">0</span>
                    </div>

                </div>


                <div class="toolbar-actions">

                    <button type="button"
                            id="select-all"
                            class="btn btn-sm btn-outline">

                        Select All

                    </button>

                    <button type="button"
                            id="clear-selection"
                            class="btn btn-sm btn-secondary">

                        Clear Selection

                    </button>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Admission Number</th>
                            <th>Pupil Name</th>
                        </tr>
                    </thead>

                    <tbody id="pupil-table-body">
                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- STEP 3: CHOOSE MOVEMENT --}}

    <div id="movement-card" class="card" style="display:none;">

        <div class="card-header">
            <span class="step-number">3</span>
            Choose Movement
        </div>

        <div class="card-body">

            <div class="row">

                <div class="form-group">

                    <label for="action">
                        Movement Action
                    </label>

                    <select id="action" class="form-control">

                        <option value="">
                            Select action
                        </option>

                        <option value="promote">
                            Promote
                        </option>

                        <option value="repeat">
                            Repeat
                        </option>

                        <option value="demote">
                            Demote
                        </option>

                        <option value="transfer">
                            Transfer
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="destination_session_id">
                        Destination Academic Session
                    </label>

                    <select id="destination_session_id" class="form-control">

                        <option value="">
                            Select destination session
                        </option>

                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}">
                                {{ $session->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label for="destination_class_id">
                        Destination Class
                    </label>

                    <select id="destination_class_id" class="form-control">

                        <option value="">
                            Select destination class
                        </option>

                        @foreach($classLevels as $classLevel)
                            <option value="{{ $classLevel->id }}">
                                {{ $classLevel->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label for="destination_section_id">
                        Destination Section
                    </label>

                    <select id="destination_section_id" class="form-control">

                        <option value="">
                            Select destination section
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label for="note">
                        Note (optional)
                    </label>

                    <textarea id="note"
                              class="form-control"
                              rows="2"
                              maxlength="1000"
                              placeholder="Reason for this batch movement"></textarea>

                </div>

            </div>


            <div id="movement-message" style="margin-bottom: 18px;"></div>


            <button type="button"
                    id="review-button"
                    class="btn btn-success">

                Review Batch

            </button>

        </div>

    </div>


    {{-- STEP 4: REVIEW AND CONFIRM --}}

    <div id="review-card" class="card" style="display:none;">

        <div class="card-header">
            <span class="step-number">4</span>
            Review and Confirm
        </div>

        <div class="card-body">

            <div class="alert alert-warning review-warning">

                <strong>Important:</strong>

                Please review the selected pupils and destination carefully.
                Once confirmed, each movement will be processed individually.

            </div>


            <div class="review-summary">

                <div class="summary-item">

                    <span>Movement Action</span>

                    <strong id="review-action"></strong>

                </div>


                <div class="summary-item">

                    <span>Source Class</span>

                    <strong id="review-source"></strong>

                </div>


                <div class="summary-item">

                    <span>Destination</span>

                    <strong id="review-destination"></strong>

                </div>

            </div>


            <div class="summary-item" style="margin-bottom: 22px;">

                <span>Selected Pupils</span>

                <strong id="review-count"></strong>

            </div>


            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Admission Number</th>
                            <th>Pupil Name</th>
                        </tr>
                    </thead>

                    <tbody id="review-table-body">
                    </tbody>

                </table>

            </div>


            <form method="POST"
                  action="{{ route('batch-pupil-progression.store') }}"
                  id="batch-form">

                @csrf


                <input type="hidden"
                       name="source_session_id"
                       id="form-source-session">


                <input type="hidden"
                       name="source_section_id"
                       id="form-source-section">


                <input type="hidden"
                       name="action"
                       id="form-action">


                <input type="hidden"
                       name="destination_session_id"
                       id="form-destination-session">


                <input type="hidden"
                       name="destination_section_id"
                       id="form-destination-section">


                <input type="hidden"
                       name="note"
                       id="form-note">


                <div id="form-student-ids"></div>


                <div class="form-actions">

                    <button type="submit"
                            id="confirm-button"
                            class="btn btn-danger">

                        Confirm and Process Batch

                    </button>


                    <button type="button"
                            id="cancel-review"
                            class="btn btn-secondary">

                        Go Back

                    </button>

                </div>

            </form>

        </div>

    </div>


    <div class="footer-note">
        Fatima Nursery and Primary School · Gusau, Zamfara State
    </div>

</div>


@php
    $classLevelsForJs = $classLevels->map(function ($classLevel) {
        return [
            'id' => $classLevel->id,
            'name' => $classLevel->name,
            'sort_order' => $classLevel->sort_order,
            'sections' => $classLevel->sections->map(function ($section) {
                return [
                    'id' => $section->id,
                    'name' => $section->name,
                ];
            })->values(),
        ];
    })->values();
@endphp


<script>
document.addEventListener('DOMContentLoaded', function () {

    const classLevels = @json($classLevelsForJs);

    const sourceSession = document.getElementById('source_session_id');
    const sourceClass = document.getElementById('source_class_id');
    const sourceSection = document.getElementById('source_section_id');

    const destinationSession = document.getElementById('destination_session_id');
    const destinationClass = document.getElementById('destination_class_id');
    const destinationSection = document.getElementById('destination_section_id');

    const action = document.getElementById('action');

    const pupilCard = document.getElementById('pupil-card');
    const movementCard = document.getElementById('movement-card');
    const reviewCard = document.getElementById('review-card');

    const pupilTableBody = document.getElementById('pupil-table-body');
    const reviewTableBody = document.getElementById('review-table-body');

    const loadMessage = document.getElementById('load-message');
    const movementMessage = document.getElementById('movement-message');

    let pupils = [];


    function escapeHtml(value) {

        return String(value ?? '').replace(/[&<>"']/g, function (character) {

            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[character];

        });

    }


    function getClassLevel(classId) {

        return classLevels.find(level =>
            String(level.id) === String(classId)
        );

    }


    function populateSections(classSelect, sectionSelect) {

        sectionSelect.innerHTML =
            '<option value="">Select section</option>';

        const level = getClassLevel(classSelect.value);

        if (!level) {
            return;
        }

        level.sections.forEach(section => {

            const option = document.createElement('option');

            option.value = section.id;
            option.textContent = section.name;

            sectionSelect.appendChild(option);

        });

    }


    sourceClass.addEventListener('change', function () {

        populateSections(sourceClass, sourceSection);

    });


    destinationClass.addEventListener('change', function () {

        populateSections(destinationClass, destinationSection);

    });


    function selectedPupils() {

        const selectedIds = Array.from(
            pupilTableBody.querySelectorAll('input[type="checkbox"]:checked')
        ).map(input => String(input.value));

        return pupils.filter(pupil =>
            selectedIds.includes(String(pupil.student_id))
        );

    }


    function updateSelectedCount() {

        document.getElementById('pupil-count').textContent =
            pupils.length + ' loaded / ' +
            selectedPupils().length + ' selected';

    }


    function renderPupils() {

        pupilTableBody.innerHTML = '';

        pupils.forEach(pupil => {

            const row = document.createElement('tr');

            row.innerHTML = `
                <td>
                    <input type="checkbox"
                           class="pupil-checkbox"
                           value="${escapeHtml(pupil.student_id)}">
                </td>

                <td>${escapeHtml(pupil.admission_number)}</td>

                <td>${escapeHtml(pupil.name)}</td>
            `;

            pupilTableBody.appendChild(row);

        });


        pupilTableBody.querySelectorAll('.pupil-checkbox').forEach(input => {

            input.addEventListener('change', updateSelectedCount);

        });


        updateSelectedCount();

    }


    document.getElementById('select-all').addEventListener('click', function () {

        pupilTableBody.querySelectorAll('.pupil-checkbox').forEach(input => {

            input.checked = true;

        });

        updateSelectedCount();

    });


    document.getElementById('clear-selection').addEventListener('click', function () {

        pupilTableBody.querySelectorAll('.pupil-checkbox').forEach(input => {

            input.checked = false;

        });

        updateSelectedCount();

    });


    document.getElementById('load-pupils').addEventListener('click', async function () {

        loadMessage.innerHTML = '';

        if (!sourceSession.value || !sourceSection.value) {

            loadMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Select an academic session, class, and section first.' +
                '</div>';

            return;

        }


        this.disabled = true;
        this.textContent = 'Loading...';

        pupilCard.style.display = 'none';
        movementCard.style.display = 'none';
        reviewCard.style.display = 'none';


        try {

            const url = new URL(
                @json(route('batch-pupil-progression.pupils')),
                window.location.origin
            );

            url.searchParams.set(
                'source_session_id',
                sourceSession.value
            );

            url.searchParams.set(
                'source_section_id',
                sourceSection.value
            );


            const response = await fetch(url, {

                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }

            });


            const data = await response.json();


            if (!response.ok) {

                const message =
                    data.message || 'Unable to load pupils.';

                throw new Error(message);

            }


            pupils = data.pupils || [];


            document.getElementById('source-description').textContent =
                data.section.class_name +
                ' - ' +
                data.section.section_name;


            renderPupils();


            pupilCard.style.display = 'block';

            movementCard.style.display =
                pupils.length ? 'block' : 'none';


            if (pupils.length === 0) {

                loadMessage.innerHTML =
                    '<div class="alert alert-info">' +
                    'No currently enrolled pupils were found in this section.' +
                    '</div>';

            } else {

                loadMessage.innerHTML =
                    '<div class="alert alert-success">' +
                    'Pupils loaded successfully.' +
                    '</div>';

            }


        } catch (error) {

            loadMessage.innerHTML =
                '<div class="alert alert-danger">' +
                escapeHtml(error.message) +
                '</div>';

        } finally {

            this.disabled = false;
            this.textContent = 'Load Pupils';

        }

    });


    function updateDestinationRules() {

        const selectedAction = action.value;
        const sourceSessionId = sourceSession.value;


        if (selectedAction === 'transfer') {

            destinationSession.value = sourceSessionId;
            destinationSession.disabled = true;

        } else {

            destinationSession.disabled = false;

        }


        movementMessage.innerHTML = '';


        if (selectedAction === 'promote') {

            movementMessage.innerHTML =
                '<div class="alert alert-info">' +
                'Choose a higher class level and a different later academic session.' +
                '</div>';

        } else if (selectedAction === 'repeat') {

            movementMessage.innerHTML =
                '<div class="alert alert-info">' +
                'Choose the same class level in a different later academic session.' +
                '</div>';

        } else if (selectedAction === 'demote') {

            movementMessage.innerHTML =
                '<div class="alert alert-info">' +
                'Choose a lower class level and a different later academic session.' +
                '</div>';

        } else if (selectedAction === 'transfer') {

            movementMessage.innerHTML =
                '<div class="alert alert-info">' +
                'Transfer stays in the same academic session. ' +
                'Pupils with result records cannot be transferred.' +
                '</div>';

        }

    }


    action.addEventListener('change', updateDestinationRules);


    function reviewBatch() {

        movementMessage.innerHTML = '';

        const selected = selectedPupils();


        if (selected.length === 0) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Select at least one pupil.' +
                '</div>';

            return;

        }


        if (!action.value) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Choose a movement action.' +
                '</div>';

            return;

        }


        if (!destinationSession.value || !destinationSection.value) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Choose the destination session and section.' +
                '</div>';

            return;

        }


        const sourceLevel = getClassLevel(sourceClass.value);

        const destinationLevel = getClassLevel(destinationClass.value);


        if (!sourceLevel || !destinationLevel) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Choose valid source and destination classes.' +
                '</div>';

            return;

        }


        if (
            action.value === 'promote' &&
            destinationLevel.sort_order <= sourceLevel.sort_order
        ) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Promotion requires a higher class level.' +
                '</div>';

            return;

        }


        if (
            action.value === 'repeat' &&
            destinationLevel.sort_order !== sourceLevel.sort_order
        ) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Repetition requires the same class level.' +
                '</div>';

            return;

        }


        if (
            action.value === 'demote' &&
            destinationLevel.sort_order >= sourceLevel.sort_order
        ) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Demotion requires a lower class level.' +
                '</div>';

            return;

        }


        if (
            action.value === 'transfer' &&
            destinationSection.value === sourceSection.value
        ) {

            movementMessage.innerHTML =
                '<div class="alert alert-warning">' +
                'Choose a different section for transfer.' +
                '</div>';

            return;

        }


        document.getElementById('review-action').textContent =
            action.options[action.selectedIndex].text;


        document.getElementById('review-source').textContent =
            sourceClass.options[sourceClass.selectedIndex].text +
            ' - ' +
            sourceSection.options[sourceSection.selectedIndex].text;


        document.getElementById('review-destination').textContent =
            destinationClass.options[destinationClass.selectedIndex].text +
            ' - ' +
            destinationSection.options[destinationSection.selectedIndex].text;


        document.getElementById('review-count').textContent =
            selected.length;


        reviewTableBody.innerHTML = '';


        selected.forEach(pupil => {

            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${escapeHtml(pupil.admission_number)}</td>
                <td>${escapeHtml(pupil.name)}</td>
            `;

            reviewTableBody.appendChild(row);

        });


        document.getElementById('form-source-session').value =
            sourceSession.value;


        document.getElementById('form-source-section').value =
            sourceSection.value;


        document.getElementById('form-action').value =
            action.value;


        document.getElementById('form-destination-session').value =
            destinationSession.value;


        document.getElementById('form-destination-section').value =
            destinationSection.value;


        document.getElementById('form-note').value =
            document.getElementById('note').value;


        const hiddenIds = document.getElementById('form-student-ids');

        hiddenIds.innerHTML = '';


        selected.forEach(pupil => {

            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = 'student_ids[]';
            input.value = pupil.student_id;

            hiddenIds.appendChild(input);

        });


        reviewCard.style.display = 'block';


        reviewCard.scrollIntoView({

            behavior: 'smooth',
            block: 'start'

        });

    }


    document.getElementById('review-button').addEventListener(
        'click',
        reviewBatch
    );


    document.getElementById('cancel-review').addEventListener('click', function () {

        reviewCard.style.display = 'none';

        movementCard.scrollIntoView({

            behavior: 'smooth',
            block: 'start'

        });

    });


    document.getElementById('batch-form').addEventListener('submit', function (event) {

        const selected = selectedPupils();


        if (selected.length === 0) {

            event.preventDefault();

            alert('No pupils are selected.');

            return;

        }


        const confirmed = confirm(

            'Are you sure you want to process ' +
            selected.length +
            ' pupil movement(s)? This action will update enrolments ' +
            'and create progression audit records.'

        );


        if (!confirmed) {

            event.preventDefault();

        } else {

            const button = document.getElementById('confirm-button');

            button.disabled = true;
            button.textContent = 'Processing batch...';

        }

    });


    updateDestinationRules();

});
</script>

</body>
</html>