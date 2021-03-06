<div class="container v-center">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    @if ($searchResult == null)
                    <h2>Please enter your search keyword</h2>
                    @else
                    <h2>
                    {{ count($searchResult) }} results found for: <span class="text-navy">{{ $decodedString }}</span>
                    </h2>
                    @foreach($searchResult as $video)
                    <div class="hr-line-dashed"></div>
                    <div class="search-result">
                        <h3><a href="{{ URL::to('/') }}/video/{{ $video->id}}">{{ ucwords($video->title) }}</a></h3>
                        <a href="/video/{{ $video->id}}" class="search-link">
                        {{ URL::to('/') }}/view/video/{{ $video->id}}</a>
                        <p>{{  $video->description }}</p>
                    </div>
                    @endforeach
                    <div class="hr-line-dashed"></div>
                    
                    <div class="text-center">
                        <div class="btn-group">
                            <!-- Pagination -->
                            {!! $searchResult->render() !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>