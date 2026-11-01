<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pupil Progression Correction | FNPS Gusau</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #eaf2ff, #f5f8ff, #dce9ff);
            color: #17345f;
        }

        .school-header {
            background: #ffffff;
            padding: 22px 30px;
            box-shadow: 0 3px 15px rgba(20, 55, 110, 0.08);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .school-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .school-title {
            flex: 1;
            text-align: center;
        }

        .school-title h1 {
            margin: 0;
            color: #123f83;
            font-size: 27px;
            font-weight: 800;
        }

        .school-title p {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        @media (max-width: 600px) {
            .school-header {
                padding: 15px 10px;
            }

            .header-content {
                gap: 8px;
            }

            .school-logo {
                width: 55px;
                height: 55px;
            }

            .school-title h1 {
                font-size: 16px;
            }

            .school-title p {
                font-size: 10px;
                letter-spacing: 0.5px;
            }
        }
    </style>
</head>
<body>

<header class="school-header">
    <div class="header-content">

        <img
            src="{{ asset('images/school-logo.jpeg') }}"
            alt="FNPS Gusau School Logo"
            class="school-logo"
        >

        <div class="school-title">
            <h1>Fatima Nursery and Primary School</h1>
            <p>Gusau, Zamfara State</p>
        </div>

        <img
            src="{{ asset('images/second-school-logo.jpeg') }}"
            alt="FNPS Gusau Second School Logo"
            class="school-logo"
        >

    </div>
</header>
<style>

    .progression-correction-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 24px;
    }

    .progression-correction-header {
        background: linear-gradient(135deg, #123b70, #2563eb);
        color: #ffffff;
        border-radius: 14px;
        padding: 28px;
        margin-bottom: 24px;
    }

    .progression-correction-header h1 {
        margin: 0 0 10px;
        font-size: 26px;
        font-weight: 700;
    }

    .progression-correction-header p {
        margin: 0;
        opacity: 0.9;
        line-height: 1.6;
    }

    .correction-warning {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-left: 5px solid #ea580c;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 24px;
        color: #9a3412;
    }

    .correction-success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
        color: #065f46;
    }

    .correction-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        margin-bottom: 22px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
    }

    .correction-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .correction-card-header h2 {
        margin: 0;
        font-size: 18px;
        color: #123b70;
        font-weight: 700;
    }

    .correction-card-body {
        padding: 22px;
    }

    .correction-pupil-name {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .correction-admission {
        color: #64748b;
        font-size: 13px;
    }

    .correction-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        background: #dbeafe;
        color: #1d4ed8;
    }

    .correction-details {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin: 22px 0;
    }

    .correction-detail-box {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
        background: #ffffff;
    }

    .correction-detail-box h3 {
        font-size: 14px;
        font-weight: 700;
        color: #123b70;
        margin: 0 0 12px;
    }

    .correction-detail-box p {
        margin: 7px 0;
        font-size: 14px;
        color: #475569;
    }

    .correction-detail-box strong {
        color: #1e293b;
    }

    .correction-form {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 18px;
        margin-top: 20px;
    }

    .correction-form label {
        display: block;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .correction-form textarea {
        width: 100%;
        min-height: 110px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 12px;
        font-size: 14px;
        resize: vertical;
        box-sizing: border-box;
    }

    .correction-form textarea:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .correction-form small {
        display: block;
        margin-top: 7px;
        color: #64748b;
    }

    .correction-submit {
        display: inline-block;
        background: #b91c1c;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 11px 18px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 15px;
    }

    .correction-submit:hover {
        background: #991b1b;
    }

    .correction-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .correction-empty {
        text-align: center;
        padding: 45px 20px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
    }

    .correction-empty h2 {
        color: #123b70;
        font-size: 20px;
        margin-bottom: 8px;
    }

    .correction-empty p {
        color: #64748b;
        margin: 0;
    }

    .correction-pagination {
        margin-top: 24px;
    }

    .correction-error {
        color: #b91c1c;
        font-size: 13px;
        margin-top: 6px;
    }

    @media (max-width: 768px) {
        .progression-correction-page {
            padding: 12px;
        }

        .progression-correction-header {
            padding: 20px;
        }

        .progression-correction-header h1 {
            font-size: 22px;
        }

        .correction-details {
            grid-template-columns: 1fr;
        }

        .correction-card-body {
            padding: 15px;
        }
    }

    /* Correction Page Navigation */

    .progression-correction-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .progression-navigation-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 16px;
        border-radius: 9px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s, transform 0.2s;
    }

    .progression-navigation-button:hover {
        transform: translateY(-1px);
    }

    .progression-navigation-button--back {
        background: #ffffff;
        color: #1e4580;
        border: 1px solid #cbd5e1;
    }

    .progression-navigation-button--back:hover {
        background: #edf4ff;
    }

    .progression-navigation-button--audit {
        background: #2563eb;
        color: #ffffff;
        border: 1px solid #2563eb;
    }

    .progression-navigation-button--audit:hover {
        background: #1d4ed8;
    }

    @media (max-width: 600px) {
        .progression-correction-navigation {
            flex-direction: column;
            align-items: stretch;
        }

        .progression-navigation-button {
            width: 100%;
        }
    }
</style>

<div class="progression-correction-page">
    <!-- Correction Page Navigation -->
    <div class="progression-correction-header">
        <h1>Progression Correction and Reversal</h1>

        <p>
            Super Admin control panel for reviewing and correcting pupil
            promotion, repetition, demotion, and transfer records.
            Every correction requires a reason and preserves an audit trail.
        </p>
    </div>

    <div class="correction-warning">
        <strong>Important:</strong>
        Progression corrections affect official pupil enrollment history.
        Review the original progression carefully before submitting a correction.
        Corrections are recorded permanently and should only be performed
        when authorized.
    </div>
     <div class="progression-correction-navigation">

        <a
            href="/staff/dashboard"
            class="progression-navigation-button progression-navigation-button--back"
        >
            ← Staff Dashboard
        </a>

        <a
            href="{{ route('pupil-progression.audits') }}"
            class="progression-navigation-button progression-navigation-button--audit"
        >
            Audit History →
        </a>

    </div>

    @if(session('success'))
        <div class="correction-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->has('reason'))
        <div class="correction-warning">
            {{ $errors->first('reason') }}
        </div>
    @endif

    @forelse($audits as $audit)

        <div class="correction-card">

            <div class="correction-card-header">

                <div>
                    <h2>
                        Progression Audit #{{ $audit->id }}
                    </h2>

                    <div class="correction-admission">
                        Recorded:
                        {{ $audit->created_at?->format('d M Y, h:i A') ?? 'Not available' }}
                    </div>
                </div>

                <span class="correction-badge">
                    {{ ucfirst($audit->action) }}
                </span>

            </div>

            <div class="correction-card-body">

                <div class="correction-pupil-name">

                    @if($audit->student)
                        {{ $audit->student->first_name }}
                        {{ $audit->student->middle_name }}
                        {{ $audit->student->last_name }}
                    @else
                        Student record unavailable
                    @endif

                </div>

                <div class="correction-admission">

                    Admission Number:

                    {{ $audit->student->admission_number ?? 'Not available' }}

                </div>

                <div class="correction-details">

                    <div class="correction-detail-box">

                        <h3>Original Enrollment</h3>

                        <p>
                            <strong>Academic Session:</strong>

                            {{ $audit->sourceEnrollment?->academicSession?->name
                                ?? 'Not available' }}
                        </p>

                        <p>
                            <strong>Class:</strong>

                            {{ $audit->sourceSection?->classLevel?->name
                                ?? 'Not available' }}
                        </p>

                        <p>
                            <strong>Section:</strong>

                            {{ $audit->sourceSection?->name
                                ?? 'Not available' }}
                        </p>

                    </div>

                    <div class="correction-detail-box">

                        <h3>Destination Enrollment</h3>

                        <p>
                            <strong>Academic Session:</strong>

                            {{ $audit->destinationEnrollment?->academicSession?->name
                                ?? 'Not available' }}
                        </p>

                        <p>
                            <strong>Class:</strong>

                            {{ $audit->destinationSection?->classLevel?->name
                                ?? 'Not available' }}
                        </p>

                        <p>
                            <strong>Section:</strong>

                            {{ $audit->destinationSection?->name
                                ?? 'Not available' }}
                        </p>

                    </div>

                </div>

                <div class="correction-detail-box">

                    <h3>Original Progression Information</h3>

                    <p>
                        <strong>Action:</strong>

                        {{ ucfirst($audit->action) }}
                    </p>

                    <p>
                        <strong>Recorded By:</strong>

                        {{ $audit->performedBy?->name ?? 'Not available' }}
                    </p>

                    <p>
                        <strong>Original Note:</strong>

                        {{ $audit->note ?: 'No original note was recorded.' }}
                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route(
                        'pupil-progression-corrections.reverse',
                        $audit
                    ) }}"
                    class="correction-form"
                    onsubmit="return confirm(
                        'Are you sure you want to submit this progression correction? Review the pupil and progression details carefully.'
                    );"
                >

                    @csrf

                    <label for="reason-{{ $audit->id }}">
                        Reason for Correction
                    </label>

                    <textarea
                        id="reason-{{ $audit->id }}"
                        name="reason"
                        required
                        minlength="10"
                        maxlength="2000"
                        placeholder="Explain why this progression must be corrected. Include the authorization or supporting reason."
                    >{{ old('reason') }}</textarea>

                    <small>
                        Minimum 10 characters.
                        Maximum 2,000 characters.
                        This reason will be preserved in the correction history.
                    </small>

                    @error('reason')
                        <div class="correction-error">
                            {{ $message }}
                        </div>
                    @enderror

                    <button
                        type="submit"
                        class="correction-submit"
                    >
                        Submit Progression Correction
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="correction-empty">

            <h2>No Progression Audits Available</h2>

            <p>
                There are currently no progression records available
                for correction.
            </p>

        </div>

    @endforelse

    <div class="correction-pagination">

        {{ $audits->links() }}

    </div>

</div>

</body>
</html>
