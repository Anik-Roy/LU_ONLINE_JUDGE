@php
    $id = $_GET["id"];

    $submission = \App\Submission::find($id);
@endphp

{{ $submission->code }}