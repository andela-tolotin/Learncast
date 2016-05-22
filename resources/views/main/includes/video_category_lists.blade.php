<div class="bounceInDown container v-center animated bg-white">
  <h3 align="center" class="video_category"> {{ $categoryName }}</h3>
  <div class="main-grids">
    @if (count($myVideos) > 0)
    @foreach ($myVideos->chunk(4) as $chunk)
    <div class="top-grids">
      @foreach ($chunk as $video)
      <div class="col-md-4 resent-grid recommended-grid slider-top-grids">
        <div class="resent-grid-img recommended-grid-img">
          <a class=" btn btn-primary" href="/view/video/{{ $video->id }}"><img src="http://img.youtube.com/vi/{{ $video->url }}/mqdefault.jpg" class="img-responsive youtube-thumbnails" alt="{{ $video->title}}"></a>
          <div class="time">
            <p></p>
          </div>
          <div class="clck">
          </div>
        </div>
        <div class="resent-grid-info recommended-grid-info">
          <h3><a class="" href="/view/video/{{ $video->id }}">{{ ucwords($video->title) }}</a></h3>
          <ul>
            <li>
             <p class="author author-info views"><a href="#" class="author"> 
              <i class="glyphicon glyphicon-user" aria-hidden="true"></i> {{ ucwords($video->user->username) }}</a>
            </p>
          </li>
          <li class="right-list"><p class="views views-info"> <i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i> {{ $video->views }} view(s)</p></li>
        </ul>
      </div>
    </div>  
    @endforeach    
  </div>
  @endforeach
  <div class="container">
 <div class="row">
   <div class="col-md-12">
     {!! $myVideos->render() !!}
   </div>
 </div>
</div>
</div>
  @else 
  <h4 align="center" class="video_category text-danger">Oops! videos are not available for display!</h4>
  @endif 
</div>