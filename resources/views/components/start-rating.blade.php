@if ($rating)
    {{ mb_str_pad(str_repeat('★', round($rating)), 5, '☆') }}
@else
    No rating yet
@endif
