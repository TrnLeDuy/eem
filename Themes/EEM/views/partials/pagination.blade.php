@if ($paginator->hasPages())
<div class="bg-white">
    <div class="section-content box-sort-in m-b15">
        <div class="pagination-bx gray clearfix">
            <ul class="pagination justify-content-center">
                @if ($paginator->onFirstPage())
                    <li class="previous disabled"><a href="javascript:void(0);"><i class="ti-arrow-left"></i></a></li>
                @else
                    <li class="previous"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="ti-arrow-left"></i></a></li>
                @endif
                
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled"><a href="javascript:void(0);">{{ $element }}</a></li>
                    @endif
                    
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="javascript:void(0);">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                
                @if ($paginator->hasMorePages())
                    <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="ti-arrow-right"></i></a></li>
                @else
                    <li class="next disabled"><a href="javascript:void(0);"><i class="ti-arrow-right"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endif
