<?php

namespace App\Http\Controllers;

use App\Models\StudentResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResultPublicationController extends Controller
{
    public function publish(StudentResult $result): RedirectResponse
    {
        $result->load('enrollment', 'subject');

        abort_unless(
            $result->status === 'submitted'
                && $result->first_assessment !== null
                && $result->second_assessment !== null
                && $result->exam !== null,
            422,
            'Only complete, submitted results can be published.'
        );

        $result->published_at = now();
        $result->save();

        return back()->with(
            'success',
            'The result for ' . $result->subject->name . ' has been published.'
        );
    }

    public function unpublish(StudentResult $result): RedirectResponse
    {
        $result->published_at = null;
        $result->save();

        return back()->with(
            'success',
            'The result has been unpublished.'
        );
    }
}
