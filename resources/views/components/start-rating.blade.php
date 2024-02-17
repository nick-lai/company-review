@if ($rating)
    <span class="flex items-center justify-center">
        {!!
            sprintf(
                '%s%s%s',
                str_repeat('<span class="icon-[ion--star]"></span>', floor($rating)),
                floor($rating) !== $rating ? '<span class="icon-[ion--star-half]"></span>' : '',
                str_repeat('<span class="icon-[ion--star-outline]"></span>', floor(10 - $rating)),
            )
        !!}
        <small class="mx-1">({{ number_format($rating, 2) }})</small>
    </span>
@else
    尚無評論
@endif
