<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FNPS Gusau Pupil Result</title>

    <style>
        @page {
            margin: 28px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        
        .school-header {
            position: relative;
            text-align: center;
            border-bottom: 2px solid #174a7e;
            padding: 5px 100px 12px;
            margin-bottom: 20px;
            min-height: 85px;
            border-bottom: 2px solid #174a7e;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        

        .school-logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 130px;
            height: 130px;
            object-fit: contain;
        }

        .school-logo-right {
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .school-name {
            font-size: 22px;
            font-weight: bold;
            color: #174a7e;
            margin: 0 0 6px;
        }

        .report-title {
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
        }

        .student-info {
            width: 100%;
            margin-bottom: 20px;
        }

        .student-info td {
            padding: 6px 4px;
            vertical-align: top;
        }

        table.results {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        .results th,
        .results td {
            border: 1px solid #bbb;
            padding: 8px 6px;
            text-align: center;
        }

        .results th {
            background: #eaf0f7;
            font-weight: bold;
        }

        .results td.subject {
            text-align: left;
        }

        .results tfoot td {
            font-weight: bold;
            background: #f5f7fa;
        }

        .results tfoot td.total-label {
            text-align: right;
        }

        .footer {
            margin-top: 45px;
            width: 100%;
        }

        .signature-line {
            position: relative;
            width: 100%;
            height: 75px;
        }

        .signature-label {
            display: inline-block;
            vertical-align: bottom;
            padding-bottom: 5px;
            font-weight: bold;
        }

        .signature-space {
            display: inline-block;
            position: relative;
            width: 280px;
            height: 55px;
            border-bottom: 1px solid #222;
            vertical-align: bottom;
        }

        .signature-image {
            position: absolute;
            bottom: 0;
            left: 10px;
            width: 170px;
            height: 55px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    
    
    <div class="school-header">

        <!-- Left school logo -->
        <img
            src="{{ public_path('images/school-logo.jpeg') }}"
            class="school-logo"
            alt="FNPS Gusau School Logo"
        >

        <!-- Right school logo -->
        <img
            src="{{ public_path('images/second-school-logo.jpeg') }}"
            class="school-logo-right"
            alt="Second School Logo"
        >

        <!-- Centered school information -->
        <p class="school-name">Fatima Nursery and Primary School, Gusau</p>
        <br>Behind Dominican College Gusau, Zamfara State.

        <p>School Academic Report</p>

        <p class="report-title">
            PUPIL TERMLY RESULT SHEET
        </p>

    </div>
    <table class="student-info">
        <tr>
            <td>
                <strong>Pupil's Name:</strong>
                {{ $student->last_name }},
                {{ $student->first_name }}
                {{ $student->middle_name }}
            </td>

            <td>
                <strong>Admission No.:</strong>
                {{ $student->admission_number }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Class:</strong>
                {{ $enrollment->section->classLevel->name }}
                — {{ $enrollment->section->name }}
            </td>

            <td>
                <strong>Academic Session:</strong>
                {{ $session->name }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Term:</strong>
                {{ $term }}
            </td>

            <td></td>
        </tr>
    </table>

    @php
        $grandTotal = 0;
        $completedSubjects = 0;
    @endphp

    <table class="results">

        <thead>
            <tr>
                <th>Subject</th>
                <th>First Assessment<br>/20</th>
                <th>Second Assessment<br>/20</th>
                <th>Exam<br>/60</th>
                <th>Total<br>/100</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($results as $result)

                @php
                    $complete = $result->first_assessment !== null
                        && $result->second_assessment !== null
                        && $result->exam !== null;

                    $total = $complete
                        ? (float) $result->first_assessment
                            + (float) $result->second_assessment
                            + (float) $result->exam
                        : null;

                    if ($total !== null) {
                        $grandTotal += $total;
                        $completedSubjects++;
                    }
                @endphp

                <tr>
                    <td class="subject">
                        {{ $result->subject->name }}
                    </td>

                    <td>
                        {{ $result->first_assessment ?? '—' }}
                    </td>

                    <td>
                        {{ $result->second_assessment ?? '—' }}
                    </td>

                    <td>
                        {{ $result->exam ?? '—' }}
                    </td>

                    <td>
                        {{ $total !== null
                            ? number_format($total, 2)
                            : 'Incomplete' }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        No results have been recorded.
                    </td>
                </tr>

            @endforelse

        </tbody>

        
        <tfoot>

            <tr>
                <td colspan="4" class="total-label">
                    TOTAL
                </td>

                <td>
                    {{ number_format($grandTotal, 2) }}
                </td>
            </tr>

            <tr>
                <td colspan="4" class="total-label">
                    AVERAGE
                </td>

                <td>
                    {{ $completedSubjects > 0
                        ? number_format(
                            $grandTotal / $completedSubjects,
                            2
                        )
                        : '—' }}
                </td>
            </tr>

        </tfoot>


    </table>

    <div class="footer">

        <div class="signature-line">

            <span class="signature-label">
                Exam Officer's Signature:
            </span>

            <span class="signature-space">

                <img
                    src="{{ public_path('images/exam-officer-signature.png') }}"
                    class="signature-image"
                    alt="Exam Officer's Signature"
                >

            </span>

        </div>

    </div>

</body>
</html>
